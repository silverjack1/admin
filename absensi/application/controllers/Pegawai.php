<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai extends AUTH_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_pegawai');
	}

	public function index() {
		$data['userdata'] 	= $this->userdata;
		$data['dataPegawai'] = $this->M_pegawai->select_all();
		$data['dataJabatan'] = $this->M_pegawai->select_all_jabatan();

		$data['page'] 		= "pegawai";
		$data['judul'] 		= "Data Pegawai";
		$data['deskripsi'] 	= "Kelola Data Pegawai";

		$data['modal_tambah_pegawai'] = show_my_modal('modals/modal_tambah_pegawai', 'tambah-pegawai', $data);

		$this->template->views('pegawai/home', $data);
	}

	public function tampil() {
		$data['dataPegawai'] = $this->M_pegawai->select_all();
		$this->load->view('pegawai/list_data', $data);
	}

	public function tambah()	{
		$data['userdata'] 	= $this->userdata;
		$data['dataJabatan'] = $this->M_pegawai->select_all_jabatan();

		$data['page'] 		= "pegawai";
		$data['judul'] 		= "Data Pegawai";
		$data['deskripsi'] 	= "Kelola Data Pegawai";

		$this->template->views('pegawai/form_tambah_pegawai', $data);

	}

	public function prosesTambah() {
		$this->form_validation->set_rules('NIP', 'NIP', 'trim|required|max_length[18]');
		$this->form_validation->set_rules('nama_pegawai', 'Nama Pegawai', 'trim|required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required');
		$this->form_validation->set_rules('status', 'Status', 'trim|required');
		$this->form_validation->set_rules('id_jabatan', 'Jabatan', 'trim|required');

		$data 	= $this->input->post();
		$data['foto']="logo-user.png";
		$password = $data['password'];
		$data['password'] = md5($password);
		if ($this->form_validation->run() == TRUE) {
			if($this->M_pegawai->check_nip($data['NIP']) == 0){
				$config['upload_path'] = './assets/img/';
				$config['allowed_types'] = 'jpg|png';
				$config['overwrite'] = true;
				
				$this->load->library('upload', $config);
				
				if (!$this->upload->do_upload('foto')){
					$error = array('error' => $this->upload->display_errors());
				}
				else{
					$data_foto = $this->upload->data();
					$data['foto'] = $data_foto['file_name'];
				}

				$result = $this->M_pegawai->insert($data);

				if ($result > 0) {
					$this->session->set_flashdata('msg', show_succ_msg('Data Pegawai Berhasil ditambah'));
					redirect('Pegawai');
				} else {
					$this->session->set_flashdata('msg', show_err_msg('Data Pegawai Gagal ditambah'));
					redirect('Pegawai');
				}
			}
			else{
				$this->session->set_flashdata('msg', show_err_msg('Pegawai Dengan NIP '.$data['NIP'].' Sudah Ada!'));
				redirect('Pegawai/tambah');
			}
		} else {
			$this->session->set_flashdata('msg', show_err_msg(validation_errors()));
			redirect('Pegawai/tambah');
		}

		// echo json_encode($out);
	}

	public function update($id) {
		$data['userdata'] 	= $this->userdata;
		$data['page'] 		= "pegawai";
		$data['judul'] 		= "Data Pegawai";
		$data['deskripsi'] 	= "Kelola Data Pegawai";

		// $id 				= trim($_POST['NIP']);
		$data['dataPegawai'] = $this->M_pegawai->select_by_id($id);
		$data['dataJabatan'] = $this->M_pegawai->select_all_jabatan();

		// echo show_my_modal('modals/modal_update_pegawai', 'update-pegawai', $data);
		$this->template->views('pegawai/form_update_pegawai', $data);
	}

	public function prosesUpdate($NIP) {
		$this->form_validation->set_rules('NIP', 'NIP', 'trim|required');
		$this->form_validation->set_rules('nama_pegawai', 'Nama Pegawai', 'trim|required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required');
		// $this->form_validation->set_rules('password', 'Password', 'trim|required');
		$this->form_validation->set_rules('status', 'Status', 'trim|required');
		$this->form_validation->set_rules('id_jabatan', 'Jabatan', 'trim|required');
		// $this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		// $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
		// $this->form_validation->set_rules('email', 'Email', 'trim|required');


		// $id = $this->userdata->NIP;
		$data = $this->input->post();
		$password = $data['password'];
		$data['password'] = md5($password);
		$data['foto'] = $data['foto_lama'];
		// $id = $NIP;	
		if ($this->form_validation->run() == TRUE) {
			$config['upload_path'] = './assets/img/';
			$config['allowed_types'] = 'jpg|png';
			$config['overwrite'] = true;
			
			$this->load->library('upload', $config);
			
			if (!$this->upload->do_upload('foto')){
				$error = array('error' => $this->upload->display_errors());
			}
			else{
				$data_foto = $this->upload->data();
				$data['foto'] = $data_foto['file_name'];
			}

			$result = $this->M_pegawai->update($data);
			if ($result > 0) {
				// $this->updateProfil();
				if($this->session->userdata('userdata')->NIP == $NIP){
					$data_pegawai = $this->M_pegawai->select_by_id_login($this->userdata->NIP);

					$this->session->set_userdata('userdata', $data_pegawai);
					$this->userdata = $this->session->userdata('userdata');
				}
				$this->session->set_flashdata('msg', show_succ_msg('Data Profile Berhasil diubah'));
				redirect('Pegawai');
			} else {
				$this->session->set_flashdata('msg', show_err_msg('Data Profile Gagal diubah'));
				redirect('Pegawai');
			}
		} else {
			$this->session->set_flashdata('msg', show_err_msg(validation_errors()));
			redirect('Pegawai/update/'.$NIP);
		}

		// $data 	= $this->input->post();
		// $password = $data['password'];
		// $data['password'] = md5($password);
		// // if ($this->form_validation->run() == TRUE) {
		// 	$config['upload_path'] = './assets/img/';
		// 	$config['allowed_types'] = 'jpg|png';
		// 	// $config['file_name']            = $data['NIP'];
  //   		// $config['overwrite']			= true;
  //   		// $config['max_size']             = 1024; // 1MB
			
		// 	$this->load->library('upload', $config);
			
		// 	if (!$this->upload->do_upload('foto')){
		// 		$error = array('error' => $this->upload->display_errors());
		// 			// print_r($this->upload->display_errors());

		// 	}
		// 	else{
		// 		$data_foto = $this->upload->data();
		// 		$data['foto'] = $data_foto['file_name'];
		// 	}

		// 	$result = $this->M_pegawai->update($data);

		// 	if ($result > 0) {
		// 		$out['status'] = '';
		// 		$out['msg'] = show_succ_msg('Data Pegawai Berhasil diupdate', '20px');
		// 	} else {
		// 		$out['status'] = '';
		// 		$out['msg'] = show_succ_msg('Data Pegawai Gagal diupdate', '20px');
		// 	}
		// } else {
		// 	$out['status'] = 'form';
		// 	$out['msg'] = show_err_msg(validation_errors());
		// }


		// echo json_encode($out);
	}

	public function delete() {
		$id = $_POST['NIP'];
		$result = $this->M_pegawai->delete($id);
		
		if ($result > 0) {
			echo show_succ_msg('Data Pegawai Berhasil dihapus', '20px');
		} else {
			echo show_err_msg('Data Pegawai Gagal dihapus karena digunakan di data lain', '20px');
		}
	}

	public function detail() {
		$data['userdata'] 	= $this->userdata;

		$id 				= trim($_POST['NIP']);
		$data['pegawai'] = $this->M_pegawai->select_by_id_login($id);

		echo show_my_modal('modals/modal_detail_pegawai', 'detail-pegawai', $data, 'lg');
	}

	public function export() {
		error_reporting(E_ALL);
    
		include_once './assets/phpexcel/Classes/PHPExcel.php';
		$objPHPExcel = new PHPExcel();

		$data = $this->M_pegawai->select_all();

		$objPHPExcel = new PHPExcel(); 
		$objPHPExcel->setActiveSheetIndex(0); 
		$rowCount = 1; 

		$objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, "NIP"); 
		$objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, "Nama Pegawai");

		$objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, "Alamat");

		$objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, "Email");

		$objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, "Password");

		$objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, "Status");

		$objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, "Foto");

		$objPHPExcel->getActiveSheet()->SetCellValue('H'.$rowCount, "Jabatan");
		$rowCount++;

		foreach($data as $value){
		    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $value->NIP); 

		    $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $value->nama_pegawai);

		    $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, $value->alamat);

		    $objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, $value->email);

		    $objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, $value->password); 

		    $objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, $value->status);

		    $objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, $value->foto);

		    $objPHPExcel->getActiveSheet()->SetCellValue('H'.$rowCount, $value->nama_jabatan);
		    $rowCount++; 
		} 

		$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); 
		$objWriter->save('./assets/excel/Data Pegawai.xlsx'); 

		$this->load->helper('download');
		force_download('./assets/excel/Data Pegawai.xlsx', NULL);
	}

	public function import() {
		$this->form_validation->set_rules('excel', 'File', 'trim|required');

		if ($_FILES['excel']['name'] == '') {
			$this->session->set_flashdata('msg', 'File harus diisi');
		} else {
			$config['upload_path'] = './assets/excel/';
			$config['allowed_types'] = 'xls|xlsx';
			
			$this->load->library('upload', $config);
			
			if ( ! $this->upload->do_upload('excel')){
				$error = array('error' => $this->upload->display_errors());
			}
			else{
				$data = $this->upload->data();
				
				error_reporting(E_ALL);
				date_default_timezone_set('Asia/Jakarta');

				include './assets/phpexcel/Classes/PHPExcel/IOFactory.php';

				$inputFileName = './assets/excel/' .$data['file_name'];
				$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
				$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);

				$index = 0;
				foreach ($sheetData as $key => $value) {
					if ($key != 1) {
						$check = $this->M_pegawai->check_nama($value['B']);

						if ($check != 1) {
							$resultData[$index]['nama_pegawai'] = ucwords($value['B']);
							$resultData[$index]['alamat'] = ucwords($value['C']);
							$resultData[$index]['email'] = ucwords($value['D']);
							$resultData[$index]['password'] = ucwords($value['E']);
							$resultData[$index]['status'] = ucwords($value['F']);
							$resultData[$index]['foto'] = ucwords($value['G']);
							$resultData[$index]['nama_jabatan'] = ucwords($value['H']);
						}
					}
					$index++;
				}

				unlink('./assets/excel/' .$data['file_name']);

				if (count($resultData) != 0) {
					$result = $this->M_pegawai->insert_batch($resultData);
					if ($result > 0) {
						$this->session->set_flashdata('msg', show_succ_msg('Data Pegawai Berhasil diimport ke database'));
						redirect('Pegawai');
					}
				} else {
					$this->session->set_flashdata('msg', show_msg('Data Pegawai Gagal diimport ke database (Data Sudah terupdate)', 'warning', 'fa-warning'));
					redirect('Pegawai');
				}

			}
		}
	}
}

/* End of file Pegawai.php */
/* Location: ./application/controllers/Posisi.php */