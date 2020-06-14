<?php

class Location_model extends CI_Model
{
    public function get_australian_states()
    {
        return $this->db
            ->select('ID, Short_name, Long_name')
            ->get('AustralianStates')
            ->result();
    }

    public function get_australian_suburbs_by_state($state_id)
    {
        return $this->db
            ->select('Suburb, Postcode')
            ->where('State_ID', $state_id)
            ->get('AustralianSuburbs');
    }

    public function get_australian_state_by_id($state_id)
    {
        return $this->db
            ->select('Short_Name, Long_Name')
            ->where('ID', $state_id)
            ->get('AustralianStates')
            ->row();
    }

    public function get_australian_location($state_id, $suburb_zip)
    {
        if (empty($state_id) || empty($suburb_zip)) {
            return null;
        }
        $state = $this->get_australian_state_by_id($state_id);
        list($suburb, $zip) = array_map('trim', explode(',', $suburb_zip));
        return [
            $suburb . ' ' . $state->Short_Name,
            $zip
        ];
    }
}
