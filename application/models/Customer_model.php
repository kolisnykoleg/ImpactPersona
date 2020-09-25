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

    public function create_end_user($data)
    {
        if ($this->db->insert('EndUsers', $data)) {
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

    public function get_end_user_by_id($id)
    {
        return $this->db
            ->get_where('EndUsers', ['ID' => $id])
            ->row();
    }

    public function full_name($customer_id)
    {
        $customer = $this->get_by_id($customer_id);
        return $customer->Firstname . ' ' . $customer->Surname;
    }

    public function get_by_transaction($transaction_key)
    {
        return $this->db
            ->select('c.*')
            ->from('Customers as c')
            ->join('Transactions as t', 't.Customer_ID = c.ID')
            ->where('t.Transaction_Key', $transaction_key)
            ->get()
            ->row();
    }
}
