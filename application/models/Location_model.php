<?php

class Location_model extends CI_Model
{
    public function get_australian_states()
    {
        return $this->db
            ->select('ID, Short_name, Long_name')
            ->get('australianStates')
            ->result_object();
    }

    public function get_australian_suburbs_by_state($state_id)
    {
        return $this->db
            ->select('Suburb, Postcode')
            ->where('State_ID', $state_id)
            ->get('australianSuburbs');
    }
}
