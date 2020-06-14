<?php

class Survey extends CI_Controller
{
    public function index()
    {
        if (!$this->session->has_userdata('customer_id')) {
            redirect(base_url('/checkout'));
        }

        $assessment_id = $this->session->cart['assessments'][0]->ID;
        $data['questions'] = $this->question->get_all($assessment_id);
        $data['questions_num'] = count($data['questions']);

        $this->load->view('header');
        $this->load->view('survey', $data);
        $this->load->view('footer');
    }

    public function save()
    {
        $data = [];
        $customer_id = $this->session->customer_id;
        $assessment_id = $this->session->cart['assessments'][0]->ID;
        $questions = $this->input->post('questions');
        foreach ($questions as $question_id => $answer) {
            foreach ($answer as $answer_type => $answer_id) {
                $data[] = [
                    'Customer_ID' => $customer_id,
                    'Assessment_ID' => $assessment_id,
                    'Question_ID' => $question_id,
                    'Answer_ID' => $answer_id,
                    'Answer_Type' => $answer_type,
                ];
            }
        }

        $this->assessment->save_survey($data);
    }
}
