<?php

class Assessment_model extends CI_Model
{
    public function get_all_active()
    {
        return $this->db
            ->select('ID, Name, Description_Short, Price_AUD, Price_USD')
            ->where('Active_Status', '1')
            ->get('DISCAssessments')
            ->result();
    }

    public function save_survey($data)
    {
        return $this->db->insert_batch('DISCSurveys', $data);
    }
}
