<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Quiz extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_quiz');
        $this->load->library('form_validation');
    }
    public function index()
    {
        $data['judul'] = 'Quiz';
        $data['quiz'] = $this->Model_quiz->getSoal();
        $this->load->view('templates/header', $data);
        $this->load->view('quiz/index');
        $this->load->view('templates/footer');
    }
    public function ambilData()
    {
        $dataquiz = $this->Model_quiz->getData('quiz')->result();
        echo json_encode($dataquiz);
    }
}
