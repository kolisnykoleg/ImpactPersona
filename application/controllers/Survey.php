<?php

class Survey extends CI_Controller
{
    public function index()
    {
        $data['questions'] = $this->question->get_all();
        $data['questions_num'] = count($data['questions']);

        $this->load->view('header');
        $this->load->view('survey', $data);
        $this->load->view('footer');
    }
}
