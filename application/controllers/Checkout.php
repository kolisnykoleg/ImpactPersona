<?php

class Checkout extends CI_Controller
{
    public function index()
    {
        $this->cart_update('Price_USD');
        $data['australian_states'] = $this->location->get_australian_states();
        $data['assessments'] = $this->assessment->get_all_active();

        $this->load->view('header');
        $this->load->view('checkout', $data);
        $this->load->view('footer');
    }

    public function purchase()
    {
        try {
            $customer_id = $this->add_customer();
            $this->session->set_userdata('customer_id', $customer_id);
            redirect('/transaction-complete');
        } catch (Exception $e) {
            redirect('/transaction-failed');
        }
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
        $customer = $this->customer->get_by_id($this->session->customer_id);
        $data['customer_name'] = $customer->Firstname . ' ' . $customer->Surname;

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

    private function cart_update($currency)
    {
        $assessments = $this->assessment->get_all_active();
        $assessments = array_map(function ($assessment) use ($currency) {
            $assessment->Price = $assessment->{$currency};
            unset(
                $assessment->Price_AUD,
                $assessment->Price_USD
            );
            return $assessment;
        }, $assessments);

        $total = $this->cart_total($assessments, $currency);

        $this->session->set_userdata('cart', [
            'assessments' => $assessments,
            'total' => $total,
        ]);
    }

    private function cart_total($assessments)
    {
        return array_reduce($assessments, function ($total, $assessment) {
            return $total + $assessment->Price;
        }, 0);
    }

    public function cart()
    {
        echo json_encode($this->session->cart);
    }

    public function cart_delete()
    {
        $id = $this->input->post('id');
        $assessments = $this->session->cart['assessments'];
        foreach ($assessments as $i => $assessment) {
            if ($assessment->ID == $id) {
                unset($assessments[$i]);
                break;
            }
        }
        $assessments = array_values($assessments);

        $total = $this->cart_total($assessments);

        $this->session->set_userdata('cart', [
            'assessments' => $assessments,
            'total' => $total,
        ]);
    }

    public function cart_currency()
    {
        $currency = $this->input->post('country') == 'Australia'
            ? 'Price_AUD'
            : 'Price_USD';

        $this->cart_update($currency);
    }

}
