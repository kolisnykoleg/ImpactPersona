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
