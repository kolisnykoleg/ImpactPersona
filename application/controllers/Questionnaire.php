<?php

class Questionnaire extends CI_Controller
{
    public function index()
    {
        $data['questions'] = $this->question->get_all();
        $data['questions_num'] = count($data['questions']);

        $this->load->view('header');
        $this->load->view('questionnaire', $data);
        $this->load->view('footer');
    }
}
