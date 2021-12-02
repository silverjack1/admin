<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Index extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('M_Index');
	}

	public function index()
	{
		$this->load->view('V_Index');
	}

	function ambilData(){
		$data = $this->M_Index->getData();
		echo json_encode($data);
	}

	function ambilDataByNoinduk(){
		$noinduk = $this->input->post('noinduk');
		$data = $this->M_Index->getDataByNoinduk($noinduk);
		echo json_encode($data);
	}

	function hapusData(){
		$noinduk = $this->input->post('noinduk');
		$data = $this->M_Index->deleteData($noinduk);
		echo json_encode($data);
	}

	function tambahData(){
		$noinduk 	= $this->input->post('noinduk');
		$nama 		= $this->input->post('nama');
		$alamat 	= $this->input->post('alamat');
		$hobi 		= $this->input->post('hobi');

		$data = ['noinduk' => $noinduk, 'nama' => $nama, 'hobi' => $hobi , 'alamat' => $alamat];
		$data = $this->M_Index->insertData($data);
		echo json_encode($data);
	}

	function perbaruiData(){
		$noinduk 	= $this->input->post('noinduk');
		$nama 		= $this->input->post('nama');
		$alamat 	= $this->input->post('alamat');
		$hobi 		= $this->input->post('hobi');

		$data = ['noinduk' => $noinduk, 'nama' => $nama, 'hobi' => $hobi , 'alamat' => $alamat];

		$data = $this->M_Index->updateData($noinduk,$data);
		
		echo json_encode($data);
	}
}
