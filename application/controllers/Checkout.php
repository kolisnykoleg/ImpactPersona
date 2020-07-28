<?php

class Checkout extends CI_Controller
{
    public function index()
    {
        $data['countries'] = $this->location->get_countries();
        $data['australian_states'] = $this->location->get_australian_states();
        $data['token'] = $this->transaction->token();

        $this->load->view('header');
        $this->load->view('checkout', $data);
        $this->load->view('footer');
    }

    public function purchase()
    {
        try {
            $customer_id = $this->add_customer();

            $nonce = $this->input->post('nonce');
            $amount = $this->session->cart['total'];
            $product_ids = array_map(function ($assessment) {
                return $assessment->ID;
            }, $this->session->cart['assessments']);
            $transaction_key = $this->transaction->sale($nonce, $amount, $customer_id, $product_ids);

            $this->transaction->send_email($customer_id, $transaction_key);

            $this->session->set_userdata('transaction_key', $transaction_key);
            $this->session->set_userdata('customer_id', $customer_id);
            redirect('/transaction-complete');
        } catch (Exception $e) {
            redirect('/transaction-failed');
        }
    }

    public function manually_purchase()
    {
        $customer_id = $this->add_customer();
        $transaction_key = uniqid('manually_');
        $product_id = $this->input->post('Questionnaire');
        $price = $this->input->post('Price');
        $assessments = $this->db
            ->get_where('DISCAssessments', ['ID' => $product_id])
            ->result();
        $this->session->set_userdata('cart', [
            'assessments' => $assessments,
            'total' => $price,
        ]);

        $this->transaction->save([
            'Customer_ID' => $customer_id,
            'Sales_Amount' => $price,
            'Fees_Amount' => 0,
            'Currency' => 'AUD',
            'Transaction_Date' => date('Y-m-d h:m:s'),
            'Transaction_Key' => $transaction_key,
        ], [$product_id]);

        $this->transaction->send_email($customer_id, $transaction_key);

        $this->session->set_userdata('transaction_key', $transaction_key);
        $this->session->set_userdata('customer_id', $customer_id);
        $this->session->unset_userdata('cart');
        redirect('/transaction-complete');
    }

    private function add_customer()
    {
        $firstname = $this->input->post('Firstname', true);
        $surname = $this->input->post('Surname', true);
        $email = $this->input->post('Email', true);
        $phone = $this->input->post('Phone', true);
        $country = $this->input->post('Country', true);
        $state = $this->input->post('State', true);
        $zip = $this->input->post('Zip', true);

        $state_id = $this->input->post('australian_state');
        $suburb_zip = $this->input->post('australian_suburb', true);
        if ($australian_location = $this->location->get_australian_location($state_id, $suburb_zip)) {
            list($state, $zip) = $australian_location;
        }

        return $this->customer->create([
            'Firstname' => $firstname,
            'Surname' => $surname,
            'Email' => $email,
            'Phone' => $phone,
            'Country' => $country,
            'State' => $state,
            'Zip' => $zip,
        ]);
    }

    public function complete()
    {
        $data['customer_name'] = $this->customer->full_name($this->session->customer_id);
        $data['receipt_number'] = strtoupper($this->session->transaction_key);

        $this->load->view('header');
        $this->load->view('transaction_complete', $data);
        $this->load->view('footer');
    }

    public function failed()
    {
        $this->load->view('header');
        $this->load->view('transaction_failed');
        $this->load->view('footer');
    }

    public function manually()
    {
        $data['countries'] = $this->location->get_countries();
        $data['australian_states'] = $this->location->get_australian_states();
        $data['token'] = $this->transaction->token();
        $data['manually'] = true;
        $data['assessments'] = $this->assessment->get_all_active();

        $this->load->view('header');
        $this->load->view('checkout', $data);
        $this->load->view('footer');
    }
}
