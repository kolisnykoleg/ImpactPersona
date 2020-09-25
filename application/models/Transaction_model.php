<?php
use Dompdf\Dompdf;

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
        $message = $this->load->view('email_template', [
            'assessments' => $this->session->cart['assessments'],
            'transaction_key' => $transaction_key,
        ], true);

        $customer = $this->customer->get_by_id($customer_id);
        $address = $customer->State . ', ' . $this->location->get_country_by_code($customer->Country);

        $html = $this->load->view('invoice', [
            'name' => $customer->Firstname . ' ' . $customer->Surname,
            'assessments' => $this->session->cart['assessments'],
            'total' => $this->session->cart['total'],
            'transaction_key' => strtoupper($transaction_key),
            'date' => date('j F Y'),
            'address' => $address,
        ], true);

        // reference the Dompdf namespace
        $dompdf = new Dompdf();

        // instantiate and use the dompdf class
        $options = $dompdf->getOptions();
        $options->setIsRemoteEnabled('true');
        $dompdf->setoptions($options);
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $filename = FCPATH . 'Receipt.pdf';
        file_put_contents($filename, $dompdf->output());

        $this->email
            ->from($this->email->smtp_user, 'Impact Persona')
            ->to($customer->Email)
	    ->bcc('charissa@impactpersona.com.au')
            ->subject('Start your DISC Assessment')
            ->message($message)
	    ->attach($filename)
            ->set_mailtype('html')
            ->send();

        unlink($filename);
    }

    public function send_emails_to_end_user($customer_id, $end_user_id, $transaction_key)
    {
        $customer = $this->customer->get_by_id($customer_id);
        $address = $customer->State . ', ' . $this->location->get_country_by_code($customer->Country);

        $end_user = $this->customer->get_end_user_by_id($end_user_id);

        $message = $this->load->view('email_template', [
            'assessments' => $this->session->cart['assessments'],
            'transaction_key' => $transaction_key,
        ], true);

        $this->email
            ->from($this->email->smtp_user, 'Impact Persona')
            ->to($end_user->Email)
            ->cc($customer->Email)
            ->bcc('charissa@impactpersona.com.au')
            ->subject('Start your DISC Assessment')
            ->message($message)
            ->set_mailtype('html')
            ->send();

        $html = $this->load->view('invoice', [
            'name' => $end_user->Firstname . ' ' . $end_user->Surname,
            'assessments' => $this->session->cart['assessments'],
            'total' => $this->session->cart['total'],
            'transaction_key' => strtoupper($transaction_key),
            'date' => date('j F Y'),
            'address' => $address,
        ], true);

        // reference the Dompdf namespace
        $dompdf = new Dompdf();

        // instantiate and use the dompdf class
        $options = $dompdf->getOptions();
        $options->setIsRemoteEnabled('true');
        $dompdf->setoptions($options);
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $filename = FCPATH . 'Receipt.pdf';
        file_put_contents($filename, $dompdf->output());

        $this->email
            ->from($this->email->smtp_user, 'Impact Persona')
            ->to($end_user->Email)
            ->bcc('charissa@impactpersona.com.au')
            ->subject('Receipt')
            ->attach($filename)
            ->set_mailtype('html')
            ->send();

        unlink($filename);
    }

    public function get_by_key($transaction_key)
    {
        return $this->db
            ->get_where('Transactions', ['Transaction_Key' => $transaction_key])
            ->row();
    }
}
