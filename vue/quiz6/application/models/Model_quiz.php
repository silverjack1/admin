<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_quiz extends CI_Model
{
    public function getAllQuiz()
    {
        return $this->db->get('quiz')->result_array();
    }
    public function getSoal()
    {
        $databeOfQuestions = array();
        $result = $this->db->get('quiz');

        foreach ($result->result() as $row) {
            //$row is an object - attributes are column names
            $databeOfQuestions[] = array(
                'id' => $row->id_soal,
                'question_name' => $row->soal,
                'answer1' => $row->option1,
                'answer2' => $row->option2,
                'answer3' => $row->option3,
                'answer4' => $row->option4
            );
        }
        return $databeOfQuestions;
    }

    public function getData($table)
    {
        $this->db->order_by($table, 'RANDOM');
        $this->db->limit(2);
        $this->db->order_by(15, 'RANDOM');
        return $this->db->get($table);
    }
}
