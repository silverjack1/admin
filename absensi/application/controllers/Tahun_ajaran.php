<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tahun_ajaran extends AUTH_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_tahun_ajaran');
	}

	public function index() {
		$data['userdata'] = $this->userdata;
		$data['dataTahun_ajaran'] = $this->M_tahun_ajaran->select_all();
		// $data['dataPosisi'] = $this->M_posisi->select_all();
		// $data['dataKota'] = $this->M_kota->select_all();

		$data['page'] = "tahun_ajaran";
		$data['judul'] = "Data Tahun Ajaran";
		$data['deskripsi'] = "Kelola Data Tahun Ajaran";

		$data['modal_tambah_tahun_ajaran'] = show_my_modal('modals/modal_tambah_tahun_ajaran', 'tambah-tahun_ajaran', $data);

		$this->template->views('tahun_ajaran/home', $data);
	}

	public function tampil() {
		$data['dataTahun_ajaran'] = $this->M_tahun_ajaran->select_all();
		$this->load->view('tahun_ajaran/list_data', $data);
	}

	public function prosesTambah() {
		// $this->form_validation->set_rules('id_tahun', 'id_tahun', 'trim|required');
		$this->form_validation->set_rules('tahun', 'Tahun', 'trim|required');

		$data = $this->input->post();
		$validasi_kesamaan = $this->M_tahun_ajaran->check_nama($data['tahun']);
		if ($this->form_validation->run() == TRUE) {
			if ($validasi_kesamaan == 0) {
				if ($this->M_tahun_ajaran->cek_format_tahun_ajaran($data['tahun']) == TRUE) {
					$result = $this->M_tahun_ajaran->insert($data);

					if ($result > 0) {
						$out['status'] = '';
						$out['msg'] = show_succ_msg('Data Tahun Ajaran Berhasil ditambahkan', '20px');
					} else {
						$out['status'] = '';
						$out['msg'] = show_err_msg('Data Tahun Ajaran Gagal ditambahkan', '20px');
					}
				}
				else{
					$out['status'] = 'form';
					$out['msg'] = show_err_msg('<br>Format Tahun Ajaran salah!<br> Contoh : 2019/2020', '15px');
				}
			}
			else{
				$out['status'] = 'form';
				$out['msg'] = show_err_msg('<br>Tahun Ajaran '.$data['tahun'].' sudah ada', '15px');
			}
		} else {
			$out['status'] = 'form';
			$out['msg'] = show_err_msg(validation_errors());
		}

		echo json_encode($out);
	}

	public function update() {
		$id = trim($_POST['id_tahun']);

		$data['dataTahun_ajaran'] = $this->M_tahun_ajaran->select_by_id($id);

		echo show_my_modal('modals/modal_update_tahun_ajaran', 'update-tahun_ajaran', $data);
	}

	public function prosesUpdate() {
		// $this->form_validation->set_rules('id_tahun', 'id_tahun', 'trim|required');
		$this->form_validation->set_rules('tahun', 'Tahun', 'trim|required');
		
		$data = $this->input->post();
		$validasi_kesamaan = $this->M_tahun_ajaran->check_nama($data['tahun']);
		if ($this->form_validation->run() == TRUE) {
			if ($validasi_kesamaan == 0) {
				if ($this->M_tahun_ajaran->cek_format_tahun_ajaran($data['tahun']) == TRUE) {
					$result = $this->M_tahun_ajaran->update($data);

					if ($result > 0) {
						$out['status'] = '';
						$out['msg'] = show_succ_msg('Data Tahun Ajaran Berhasil diubah', '20px');
					} else {
						$out['status'] = '';
						$out['msg'] = show_succ_msg('Data Tahun Ajaran Gagal diubah', '20px');
					}
				}
				else{
					$out['status'] = 'form';
					$out['msg'] = show_err_msg('<br>Format Tahun Ajaran salah!<br> Contoh : 2019/2020', '15px');
				}
			}
			else{
				$out['status'] = 'form';
				$out['msg'] = show_err_msg('<br>Tahun Ajaran '.$data['tahun'].' sudah ada', '15px');
			}
		} else {
			$out['status'] = 'form';
			$out['msg'] = show_err_msg(validation_errors());
		}

		echo json_encode($out);
	}

	public function delete() {
		$id_tahun = $_POST['id_tahun'];
		$result = $this->M_tahun_ajaran->delete($id_tahun);

		if ($result > 0) {
			echo show_succ_msg('Data Tahun Ajaran Berhasil dihapus', '20px');
		} else {
			echo show_err_msg('Data Tahun Ajaran Gagal dihapus karena digunakan di data lain', '20px');
		}
	}

	public function export() {
		error_reporting(E_ALL);
    
		include_once './assets/phpexcel/Classes/PHPExcel.php';
		$objPHPExcel = new PHPExcel();

		$data = $this->M_tahun_ajaran->select_all();

		$objPHPExcel = new PHPExcel(); 
		$objPHPExcel->setActiveSheetIndex(0); 
		$rowCount = 1; 

		$objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, "ID");
		$objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, "Tahun");
		$rowCount++;

		foreach($data as $value){
		    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $value->id_tahun); 
		    $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $value->tahun); 
		    // $objPHPExcel->getActiveSheet()->setCellValueExplicit('C'.$rowCount, $value->telp, PHPExcel_Cell_DataType::TYPE_STRING);
		    // $objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, $value->id_kota); 
		    // $objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, $value->id_kelamin); 
		    // $objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, $value->id_posisi); 
		    // $objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, $value->status); 
		    $rowCount++; 
		} 

		$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); 
		$objWriter->save('./assets/excel/Data Tahun_ajaran.xlsx'); 

		$this->load->helper('download');
		force_download('./assets/excel/Data Tahun_ajaran.xlsx', NULL);
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
						$id = md5(DATE('ymdhms').rand());
						$check = $this->M_tahun_ajaran->check_nama($value['B']);

						if ($check != 1) {
							$resultData[$index]['tahun'] = ucwords($value['B']);
						}
					}
					$index++;
				}

				unlink('./assets/excel/' .$data['file_name']);

				if (count($resultData) != 0) {
					$result = $this->M_tahun_ajaran->insert_batch($resultData);
					if ($result > 0) {
						$this->session->set_flashdata('msg', show_succ_msg('Data Tahun Ajaran Berhasil diimport ke database'));
						redirect('Tahun_ajaran');
					}
				} else {
					$this->session->set_flashdata('msg', show_msg('Data Tahun Ajaran Gagal diimport ke database (Data Sudah terubah)', 'warning', 'fa-warning'));
					redirect('Tahun_ajaran');
				}

			}
		}
	}
}

/* End of file Tahun_ajaran.php */
/* Location: ./application/controllers/Tahun_ajaran.php */