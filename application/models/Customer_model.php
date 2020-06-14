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
}
