<?php

class Customer_model extends CI_Model
{
    public function create($customer_data)
    {
        if ($this->db->insert('Customers', $customer_data)) {
            return $this->db->insert_id();
        } else {
            throw new Exception($this->db->error()['message']);
        }
    }

    public function get_by_id($customer_id)
    {
        return $this->db
            ->get_where('Customers', ['id' => $customer_id])
            ->row();
    }

    public function full_name($customer_id) {
        $customer = $this->get_by_id($customer_id);
        return $customer->Firstname . ' ' . $customer->Surname;
    }
}
