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
