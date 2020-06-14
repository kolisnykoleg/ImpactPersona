<?php

class Question_model extends CI_Model
{
    public function get_all($assessment_id)
    {
        $query = $this->db
            ->select('q.ID, Question, Answer, a.ID as Answer_ID')
            ->from('DISCQuestions AS q')
            ->join('DISCAnswers AS a', 'a.Question_ID = q.ID')
            ->join('DISCQuestionsToAssessments as qa', 'qa.Question_ID = q.ID')
            ->where('qa.Assessment_ID', $assessment_id)
            ->get();

        $questions = [];
        while ($row = $query->unbuffered_row()) {
            $questions[$row->ID]['question'] = $row->Question;
            $questions[$row->ID]['answers'][$row->Answer_ID] = $row->Answer;
        }

        return $questions;
    }
}
