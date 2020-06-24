<?php

class Transaction_model extends CI_Model
{
    public function sale($nonce, $amount, $customer_id, $product_ids)
    {
        $gateway = new Braintree\Gateway($this->config->item('braintree'));

        $result = $gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonce,
            'options' => [
                'submitForSettlement' => True
            ],
        ]);

        if ($result->success) {
            $this->save([
                'Customer_ID' => $customer_id,
                'Sales_Amount' => $result->transaction->amount,
                'Fees_Amount' => $result->transaction->paypal['transactionFeeAmount'] ?? 0,
                'Currency' => $result->transaction->currencyIsoCode,
                'Transaction_Date' => $result->transaction->createdAt->format('Y-m-d h:m:s'),
                'Transaction_Key' => $result->transaction->id,
            ], $product_ids);
            return $result->transaction->id;
        } else {
            throw new Exception($result->transaction->status);
        }
    }

    public function token()
    {
        $gateway = new Braintree\Gateway($this->config->item('braintree'));
        return $gateway->clientToken()->generate();
    }

    public function save($transaction_data, $product_ids)
    {
        $this->db->insert('Transactions', $transaction_data);
        $transaction_id = $this->db->insert_id();

        $data = array_map(function ($product_id) use ($transaction_id) {
            return [
                'Assessment_ID' => $product_id,
                'Transaction_ID' => $transaction_id,
            ];
        }, $product_ids);
        $this->db->insert_batch('AssessmentsToTransactions', $data);
    }

    public function send_email($customer_id, $transaction_key)
    {
        $result = $this->db
            ->select('a.Name, a.URL')
            ->from('Transactions as t')
            ->join('AssessmentsToTransactions as at', 'at.Transaction_ID = t.ID')
            ->join('DISCAssessments as a', 'a.ID = at.Assessment_ID')
            ->where('t.Transaction_Key', $transaction_key)
            ->get();

        $message = '';
        while ($row = $result->unbuffered_row()) {
            $message .= $row->Name . ' ' . base_url('survey/' . $row->URL . '/' . $transaction_key) . "\n";
        }

        $customer = $this->customer->get_by_id($customer_id);

        $this->email
            ->from($this->email->smtp_user, 'ImpactPersona')
            ->to($customer->Email)
            ->subject('DISC Test')
            ->message($message)
            ->send();
    }
}
