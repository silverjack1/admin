<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{


    public function index()
    {
        $data['judul'] = 'Sistem Manajemen Siswa';
        $this->load->view('template/header', $data);
        $this->load->view('template/footer');
    }
    public function uploadSiswa()
    {
        $data['judul'] = 'Upload Data Siswa';
        $this->load->view('template/header', $data);
        $this->load->view('template/footer');
    }
}
