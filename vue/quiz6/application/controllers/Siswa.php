<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Siswa extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_siswa');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['judul'] = 'Data Siswa';
        $data['siswi'] = $this->Model_siswa->getAllSiswa();
        $this->load->view('templates/header', $data);
        $this->load->view('siswa/index', $data);
        $this->load->view('templates/footer');
    }
    public function tambah()
    {


        $data['judul'] = 'Tambah Data Siswa';
        $this->form_validation->set_rules('nama', 'Nama', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('siswa/tambah', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Model_siswa->tambahSiswa();
        }
    }

    public function hapus($id)
    {
        $this->Model_siswa->hapusSiswa($id);
    }
    public function detail($id)
    {
        $data['judul'] = 'detail Data Siswa';
        $data['siswi'] = $this->Model_siswa->detailSiswa($id);
        $this->load->view('templates/header', $data);
        $this->load->view('siswa/detail', $data);
        $this->load->view('templates/footer');
    }
}
