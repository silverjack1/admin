<?php

class Getquestions extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getQuestions($category) {
        $this->load->database();
        $databeOfQuestions = array();
        $result = $this->db->get_where('quiz', array('category_id' => $category));

        foreach ($result->result() as $row) {
            //$row is an object - attributes are column names
            $databeOfQuestions[] = array('id' => $row->id_soal,
                'question_name' => $row->soal,
                'answer1' => $row->option1,
                'answer2' => $row->option2,
                'answer3' => $row->option3,
                'answer4' => $row->option4);
        }
        return $databeOfQuestions;
    }

    function checkAnswer($answer1, $answer2, $answer3, $answer4, $answer5, $category) {
        $this->load->database();
        $dbanswer = array();
        $result = $this->db->get_where('quiz', array('category_id' => $category));

        foreach ($result->result() as $row) {
            //$row is an object - attributes are column names
            $dbanswer[] = $row->jawaban;
        }
        //var_dump($dbanswer[0]);
        $good=0;
        if ($answer1 == $dbanswer[0]){
            $good++;
        }
        if ($answer2 == $dbanswer[1]){
            $good++;
        }
        if ($answer3 == $dbanswer[2]){
            $good++;
        }  
        if ($answer4 == $dbanswer[3]){
            $good++;
        }
        if ($answer5 == $dbanswer[4]){
            $good++;
        }
        
        //var_dump($good);
        return $good;
    }

}
