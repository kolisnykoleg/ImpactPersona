<?php

class Locations extends CI_Controller
{
    public function get_australian_suburbs()
    {
        $state_id = $this->input->post('state_id');
        $suburbs = $this->location->get_australian_suburbs_by_state($state_id);

        echo '<option></option>';
        while ($row = $suburbs->unbuffered_row()) {
            echo '<option>', $row->Suburb, ', ', $row->Postcode, '</option>';
        }
    }
}
