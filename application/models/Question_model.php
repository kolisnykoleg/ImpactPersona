<?php

class Question_model extends CI_Model
{
    public function get_all()
    {
        $query = $this->db
            ->select('q.ID, Question, Answer')
            ->from('discQuestions AS q')
            ->join('discAnswers AS a', 'a.Question_ID = q.ID')
            ->get();

        $questions = [];
        while ($row = $query->unbuffered_row()) {
            $questions[$row->ID]['question'] = $row->Question;
            $questions[$row->ID]['answers'][] = $row->Answer;
        }

        return $questions;
    }
}
