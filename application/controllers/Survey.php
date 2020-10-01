<?php

class Survey extends CI_Controller
{
    public function index($url = null, $transaction_key = null)
    {
        if (!($url && $transaction_key)) {
            redirect('/');
        }

        $assessment = $this->assessment->get_by_url_and_transaction($url, $transaction_key);

        if (empty($assessment)) {
            redirect('/');
        }

        $this->session->set_userdata('assessment_id', $assessment->ID);
        $this->session->set_userdata('transaction_key', $transaction_key);

        $data['questions'] = $this->question->get_all($assessment->ID);
        $data['questions_num'] = count($data['questions']);

        $this->load->view('header');
        $this->load->view('survey', $data);
        $this->load->view('footer');
    }

    public function completed()
    {
        $assessment_id = $this->session->assessment_id;
        $transaction_key = $this->session->transaction_key;
        $questions = $this->input->post('questions');

        if (!($questions && $assessment_id && $transaction_key)) {
            redirect('/');
        }

        $customer = $this->customer->get_by_transaction($transaction_key);

        $data = [];
        foreach ($questions as $question_id => $answer) {
            foreach ($answer as $answer_type => $answer_id) {
                $data[] = [
                    'Customer_ID' => $customer->ID,
                    'Assessment_ID' => $assessment_id,
                    'Question_ID' => $question_id,
                    'Answer_ID' => $answer_id,
                    'Answer_Type' => $answer_type,
                ];
            }
        }

        $this->assessment->save_survey($data);
        $this->assessment->update_questionnaire_status($assessment_id, $transaction_key, 'y');

        $results_data = [
            'results' => $this->assessment->get_assessment($customer->ID, $assessment_id),
            'customer' => $customer,
        ];

        $end_user = $this->db
            ->select('e.*')
            ->from('Customers AS c')
            ->join('Transactions as t', 'c.ID = t.Customer_ID')
            ->join('EndUsers as e', 't.ID = e.Transaction_ID')
            ->where('c.ID', $customer->ID)
            ->get()
            ->row();

        if (!empty($end_user)) {
            $results_data['end_user'] = $end_user;
        }

        $results = json_encode($results_data, JSON_PRETTY_PRINT);

        $this->assessment->send_results($results);

        $this->session->sess_destroy();

        $data['customer_name'] = $this->customer->full_name($customer->ID);

        $this->load->view('header');
        $this->load->view('survey_complete', $data);
        $this->load->view('footer');
    }
}
