<?php

class Checkout extends CI_Controller
{
    public function index()
    {
        $this->load->view('header');
        $this->load->view('checkout');
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
