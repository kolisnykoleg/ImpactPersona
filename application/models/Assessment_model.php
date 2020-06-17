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

    public function get_assessment($customer_id, $assessment_id)
    {
        $result = $this->db
            ->select('s.Answer_Type, a.DISC')
            ->from('DISCSurveys as s')
            ->join('DISCAnswers as a', 'a.ID = s.Answer_ID')
            ->where(['s.Customer_ID' => $customer_id, 's.Assessment_ID' => $assessment_id])
            ->get();

        $assessment = [
            'least' => array_fill_keys(['D', 'I', 'S', 'C'], 0),
            'most' => array_fill_keys(['D', 'I', 'S', 'C'], 0),
        ];
        while ($row = $result->unbuffered_row()) {
            $assessment[$row->Answer_Type][$row->DISC]++;
        }

        return $assessment;
    }

    public function send_results($to, $results)
    {
        $this->email
            ->from($this->email->smtp_user, 'ImpactPersona')
            ->to($to)
            ->subject('DISC Test Results')
            ->message($results)
            ->send();
    }
}
