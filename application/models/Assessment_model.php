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

        $disc = array_fill_keys(['D', 'I', 'S', 'C'], 0);
        $assessment = [
            'least' => $disc,
            'most' => $disc,
        ];
        while ($row = $result->unbuffered_row()) {
            $assessment[$row->Answer_Type][$row->DISC]++;
        }

        return $assessment;
    }

    public function send_results($results)
    {
        $this->email
            ->from($this->email->smtp_user, 'ImpactPersona')
            ->to('kolisnykoleg@gmail.com'/*'scott.holland@rgbsolutions.com.au'*/)
            ->subject('DISC Test Results')
            ->message($results)
            ->send();
    }

    public function get_by_url_and_transaction($url, $transaction_key)
    {
        return $this->db
            ->select('a.*')
            ->from('DISCAssessments as a')
            ->join('AssessmentsToTransactions as at', 'at.Assessment_ID = a.ID')
            ->join('Transactions as t', 't.ID = at.Transaction_ID')
            ->where([
                'a.URL' => $url,
                't.Transaction_Key' => $transaction_key
            ])
            ->get()
            ->row();
    }

    public function update_questionnaire_status($assessment_id, $transaction_key, $status)
    {
        $id = $this->db
            ->select('at.ID')
            ->from('AssessmentsToTransactions as at')
            ->join('Transactions as t', 't.ID = at.Transaction_ID')
            ->where([
                'at.Assessment_ID' => $assessment_id,
                't.Transaction_Key' => $transaction_key,
            ])
            ->get()
            ->row()
            ->ID;

        return $this->db->update('AssessmentsToTransactions', ['Questionnaire_Status' => $status], ['ID' => $id]);
    }
}
