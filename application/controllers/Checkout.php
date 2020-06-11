<?php

class Checkout extends CI_Controller
{
    public function index()
    {
        $data['australian_states'] = $this->location->get_australian_states();

        $this->load->view('header');
        $this->load->view('checkout', $data);
        $this->load->view('footer');
    }

    public function purchase()
    {
        $data = $this->input->post(null, true);
        $state_id = $data['australian_state'];
        $suburb_zip = $data['australian_suburb'];

        if ($australian_location = $this->location->get_australian_location($state_id, $suburb_zip)) {
            list($data['State'], $data['Zip']) = $australian_location;
        }
        unset(
            $data['australian_state'],
            $data['australian_suburb']
        );

        $customer_create = $this->customer->create([
            'Firstname' => $data['Firstname'],
            'Surname' => $data['Surname'],
            'Email' => $data['Email'],
            'Phone' => $data['Phone'],
            'Country' => $data['Country'],
            'State' => $data['State'],
            'Zip' => $data['Zip'],
        ]);
    }

    public function complete()
    {
        $this->load->view('header');
        $this->load->view('transaction_complete');
        $this->load->view('footer');
    }

    public function failed()
    {
        $this->load->view('header');
        $this->load->view('transaction_failed');
        $this->load->view('footer');
    }
}
