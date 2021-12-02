<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wali_Kelas extends AUTH_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_wali_kelas');
		$this->load->model('M_pegawai');
		$this->load->model('M_kelas');
		$this->load->model('M_tahun_ajaran');
	}

	public function index() {
		$data['userdata'] 	= $this->userdata;
		// $data['dataWali_Kelas'] 	= $this->M_wali_kelas->select_all();

		$data['tahun_ajaran_default'] = $this->session->userdata('tahun_ajaran_default');
		$data['tahun_ajaran'] = $this->M_tahun_ajaran->select_by_tahun($data['tahun_ajaran_default'])->id_tahun;

		$data['dataPegawai'] 	= $this->M_pegawai->select_guru();
		$data['dataKelas'] 	= $this->M_kelas->select_all();
		$data['dataTahun_ajaran'] 	= $this->M_tahun_ajaran->select_all();


		$data['page'] 		= "wali_kelas";
		$data['judul'] 		= "Data Tabel Wali Kelas";
		$data['deskripsi'] 	= "Kelola Data Wali Kelas";

		$data['modal_tambah_wali_kelas'] = show_my_modal('modals/modal_tambah_wali_kelas', 'tambah-wali_kelas', $data);

		$this->template->views('wali_kelas/home', $data);
	}

	// public function tampil() {
	// 	$data['tahun_ajaran_default'] = $this->session->userdata('tahun_ajaran_default');
	// 	$data['tahun_ajaran'] = $this->M_tahun_ajaran->select_by_tahun($data['tahun_ajaran_default'])->id_tahun;

	// 	$data['dataWali_Kelas'] = $this->M_wali_kelas->filter_wk_ta($data['tahun_ajaran']);

	// 	$this->load->view('wali_kelas/list_data', $data);
	// }

	public function tampil(){
		$id_tahun = $_POST['id_tahun'];

		$data['dataWali_Kelas'] = $this->M_wali_kelas->select_all_by_ta($id_tahun);

		$this->load->view('wali_kelas/list_data', $data);

	}

	public function prosesTambah() {
		$this->form_validation->set_rules('NIP', 'NIP', 'trim|required');
		$this->form_validation->set_rules('id_kelas', 'Kelas', 'trim|required');
		$this->form_validation->set_rules('id_tahun', 'Tahun Ajaran', 'trim|required');

		$data 	= $this->input->post();

		$cek_kesamaan_guru = $this->M_wali_kelas->cek_duplikat_guru($data['NIP'], $data['id_tahun']);
		$cek_kesamaan_wali = $this->M_wali_kelas->cek_duplikat_wali($data['id_kelas'], $data['id_tahun']);

		if ($this->form_validation->run() == TRUE) {
			if ($cek_kesamaan_guru->num_rows() == 0) {
				if ($cek_kesamaan_wali->num_rows() == 0) {
					$result = $this->M_wali_kelas->insert($data);

					if ($result > 0) {
						$out['status'] = '';
						$out['msg'] = show_succ_msg('Data Wali Kelas Berhasil ditambahkan', '20px');
					} else {
						$out['status'] = '';
						$out['msg'] = show_err_msg('Data Wali Kelas Gagal ditambahkan', '20px');
					}
				}
				else{
				$out['status'] = 'form';
				$out['msg'] = show_err_msg('Kelas '.$cek_kesamaan_wali->row()->nama_kelas.' Sudah Memiliki Wali Kelas', '15px');
				}
			}
			else{
				$out['status'] = 'form';
				$out['msg'] = show_err_msg('Guru '.$cek_kesamaan_guru->row()->nama_pegawai.' Sudah Menjadi Wali Kelas di Kelas '.$cek_kesamaan_guru->row()->nama_kelas.'', '15px');
			}
		} else {
			$out['status'] = 'form';
			$out['msg'] = show_err_msg(validation_errors());
		}

		echo json_encode($out);
	}

	public function update() {
		$data['userdata'] 	= $this->userdata;

		$id_wali_kelas				= trim($_POST['id_wali_kelas']);
		$data['dataWali_Kelas'] 	= $this->M_wali_kelas->select_by_id($id_wali_kelas);
		$data['dataPegawai'] 	= $this->M_pegawai->select_guru();
		$data['dataKelas'] 	= $this->M_kelas->select_all();
		$data['dataTahun_ajaran'] 	= $this->M_tahun_ajaran->select_all();

		echo show_my_modal('modals/modal_update_wali_kelas', 'update-wali_kelas', $data);
	}

	public function prosesUpdate() {
		$this->form_validation->set_rules('NIP', 'NIP', 'trim|required');
		$this->form_validation->set_rules('id_kelas', 'Kelas', 'trim|required');
		$this->form_validation->set_rules('id_tahun', 'Tahun Ajaran', 'trim|required');

		$data 	= $this->input->post();

		$data_db = $this->M_wali_kelas->select_by_id($data["id_wali_kelas"]);
		
		// $cek_kesamaan_guru = $this->M_wali_kelas->cek_duplikat_guru($data['NIP'], $data['id_tahun']);
		// $cek_kesamaan_wali = $this->M_wali_kelas->cek_duplikat_wali($data['id_kelas'], $data['id_tahun']);

		if ($this->form_validation->run() == TRUE) {
			// if ($cek_kesamaan_guru->num_rows() == 0) {
			// 	if ($cek_kesamaan_wali->num_rows() == 0) {
					$result = $this->M_wali_kelas->update($data);

					if ($result > 0) {
						$out['status'] = '';
						$out['msg'] = show_succ_msg('Data Wali Kelas Berhasil diubah', '20px');
					} else {
						$out['status'] = '';
						$out['msg'] = show_succ_msg('Data Wali Kelas Gagal diubah', '20px');
					}
			// 	}
			// 	else{
			// 	$out['status'] = 'form';
			// 	$out['msg'] = show_err_msg('Kelas '.$cek_kesamaan_wali->row()->nama_kelas.' Sudah Memiliki Wali Kelas', '15px');
			// 	}
			// }
			// else{
			// 	$out['status'] = 'form';
			// 	$out['msg'] = show_err_msg('Guru '.$cek_kesamaan_guru->row()->nama_pegawai.' Sudah Mengajar di Kelas '.$cek_kesamaan_guru->row()->nama_kelas.'', '15px');
			// }
		} else {
			$out['status'] = 'form';
			$out['msg'] = show_err_msg(validation_errors());
		}

		echo json_encode($out);
	}

	public function delete() {
		$id_wali_kelas = $_POST['id_wali_kelas'];
		// $cek_pengajar = $this->M_master->select_pengajar($id_biaya); 
	
		$result = $this->M_wali_kelas->delete($id_wali_kelas);
		if ($result > 0){
			echo show_succ_msg('Data Wali Kelas Berhasil dihapus', '20px');	
		}
		else{
			echo show_err_msg('Data Wali Kelas Gagal dihapus karena digunakan di data lain', '20px');	
		}
	}

	// public function detail() {
	// 	$data['userdata'] 	= $this->userdata;

	// 	$id_mapel 				= trim($_POST['id_mapel']);
	// 	$data['kota'] = $this->M_kota->select_by_id($id);
	// 	$data['jumlahKota'] = $this->M_kota->total_rows();
	// 	$data['dataKota'] = $this->M_kota->select_by_pegawai($id);

	// 	echo show_my_modal('modals/modal_detail_kota', 'detail-kota', $data, 'lg');
	// }

	public function export() {
		error_reporting(E_ALL);
    
		include_once './assets/phpexcel/Classes/PHPExcel.php';
		$objPHPExcel = new PHPExcel();

		$data = $this->M_wali_kelas->select_all();

		$objPHPExcel = new PHPExcel(); 
		$objPHPExcel->setActiveSheetIndex(0); 

		$objPHPExcel->getActiveSheet()->SetCellValue('A1', "ID Wali Kelas"); 
		$objPHPExcel->getActiveSheet()->SetCellValue('B1', "NIP"); 
		$objPHPExcel->getActiveSheet()->SetCellValue('C1', "ID Kelas");
		$objPHPExcel->getActiveSheet()->SetCellValue('D1', "ID Tahun");

		$rowCount = 2;
		foreach($data as $value){
		    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $value->id_wali_kelas); 
		    $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $value->NIP); 
		    $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, $value->id_kelas); 
		    $objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, $value->id_tahun); 
		    $rowCount++; 
		} 

		$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); 
		$objWriter->save('./assets/excel/Data Wali Kelas.xlsx'); 

		$this->load->helper('download');
		force_download('./assets/excel/Data Wali Kelas.xlsx', NULL);
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
						// $check = $this->M_wali_kelas->check_nama($value['A']);

						// if ($check != 1) {
							$resultData[$index]['NIP'] = ucwords($value['B']);
							$resultData[$index]['id_kelas'] = ucwords($value['C']);
							$resultData[$index]['id_tahun'] = ucwords($value['D']);
						// }
					}
					$index++;
				}

				unlink('./assets/excel/' .$data['file_name']);

				if (count($resultData) != 0) {
					$result = $this->M_wali_kelas->insert_batch($resultData);
					if ($result > 0) {
						$this->session->set_flashdata('msg', show_succ_msg('Data Wali Kelas Berhasil diimport ke database'));
						redirect('Wali_Kelas');
					}
				} else {
					$this->session->set_flashdata('msg', show_msg('Data Wali Kelas diimport ke database (Data Sudah terupdate)', 'warning', 'fa-warning'));
					redirect('Wali_Kelas');
				}

			}
		}
	}
}

/* End of file Kota.php */
/* Location: ./application/controllers/Kota.php */