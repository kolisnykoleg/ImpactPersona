<?php

class Transaction_model extends CI_Model
{
    public function sale($nonce, $amount, $currency, $customer_id, $product_id)
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
                'Product_ID' => $product_id,
                'Sales_Amount' => $result->transaction->amount,
                'Currency' => $result->transaction->currencyIsoCode,
                'Transaction_Date' => $result->transaction->createdAt->format('Y-m-d h:m:s'),
                'Transaction_Key' => $result->transaction->id,
            ]);
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

    public function save($transaction_data)
    {
        return $this->db->insert('Transactions', $transaction_data);
    }
}
