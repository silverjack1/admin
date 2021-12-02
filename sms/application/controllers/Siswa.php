<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Siswa extends CI_Controller
{


    public function index()
    {
        $this->load->model('siswaModel');
        $data['judul'] = 'Data Siswa';
        $data['siswa'] = $this->siswaModel->getAllSiswa();
        $this->load->view('template/header', $data);
        $this->load->view('siswa/datasiswa');
        $this->load->view('template/footer');
    }
    public function tambahsiswa()
    {
        $this->load->model('siswaModel');
        $data['judul'] = 'Tambah Data Siswa';
        $data['siswa'] = $this->siswaModel->getAllSiswa();
        $this->load->view('template/header', $data);
        $this->load->view('siswa/tambahsiswa');
        $this->load->view('template/footer');
    }
}
