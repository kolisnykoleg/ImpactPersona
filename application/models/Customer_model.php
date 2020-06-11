<?php

class Customer_model extends CI_Model
{
    public function create($customer_data)
    {
        return $this->db->insert('customers', $customer_data);
    }
}
