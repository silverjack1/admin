<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengajar extends AUTH_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_pengajar');
		$this->load->model('M_pegawai');
		$this->load->model('M_kelas');
		$this->load->model('M_mapel');
		$this->load->model('M_tahun_ajaran');
	}

	public function index() {
		$data['userdata'] 	= $this->userdata;

		$data['tahun_ajaran_default'] = $this->session->userdata('tahun_ajaran_default');
		$data['tahun_ajaran'] = $this->M_tahun_ajaran->select_by_tahun($data['tahun_ajaran_default'])->id_tahun;
		$data['dataPengajar'] 	= $this->M_pengajar->select_by_tahun($data['tahun_ajaran']);

		$data['dataPegawai'] 	= $this->M_pegawai->select_guru();
		$data['dataKelas'] 	= $this->M_kelas->select_all();
		$data['dataMapel'] 	= $this->M_mapel->select_all();
		$data['dataTahunAjaran'] 	= $this->M_tahun_ajaran->select_all();

		$data['page'] 		= "pengajar";
		$data['judul'] 		= "Data Tabel Pengajar";
		$data['deskripsi'] 	= "Kelola Data Pengajar";

		$data['modal_tambah_pengajar'] = show_my_modal('modals/modal_tambah_pengajar', 'tambah-pengajar', $data);

		$this->template->views('pengajar/home', $data);
	}

	// public function tampil() {
	// 	$data['dataPengajar'] = $this->M_pengajar->select_all();
	// 	$this->load->view('pengajar/list_data', $data);
	// }

	public function tampil() {

		$id_tahun = $_POST['id_tahun'];
		$data['dataPengajar'] = $this->M_pengajar->select_all($id_tahun);
		$this->load->view('pengajar/list_data', $data);
	}

	public function prosesTambah() {
		// $this->form_validation->set_rules('id_pengajar', 'id_pengajar', 'trim|required');
		$this->form_validation->set_rules('NIP', 'NIP', 'trim|required');
		$this->form_validation->set_rules('id_kelas', 'Kelas', 'trim|required');
		$this->form_validation->set_rules('id_mapel', 'Mata Pelajaran', 'trim|required');
		$this->form_validation->set_rules('id_tahun', 'Tahun Ajaran', 'trim|required');

		$data 	= $this->input->post();
		if ($this->form_validation->run() == TRUE) {
			if ($this->M_pengajar->check_mapel_tahun_kelas($data['id_mapel'], $data['id_tahun'], $data['id_kelas'])->num_rows()==0) {
				if ($this->M_pengajar->check_pengajar_tahun_kelas($data['NIP'], $data['id_tahun'], $data['id_kelas'])->num_rows()==0) {
					$result = $this->M_pengajar->insert($data);

					if ($result > 0) {
						$out['status'] = '';
						$out['msg'] = show_succ_msg('Data Pengajar Berhasil ditambahkan', '20px');

					} else {
						$out['status'] = '';
						$out['msg'] = show_err_msg('Data Pengajar Gagal ditambahkan', '20px');
					}
				} else {
					$out['status'] = 'form';
					$out['msg'] = show_err_msg('Guru '.$this->M_pegawai->select_by_id($data['NIP'])->nama_pegawai.' Sudah Mengajar di Kelas '.$this->M_kelas->select_by_id($data['id_kelas'])->nama_kelas, '15px');
				}

			} else {
				$out['status'] = 'form';
				$out['msg'] = show_err_msg('Mata Pelajaran '.$this->M_mapel->select_by_id($data['id_mapel'])->nama_mapel.' Sudah Diajar oleh Guru Lain', '15px');
			}
		} else {
			$out['status'] = 'form';
			$out['msg'] = show_err_msg(validation_errors());
		}

		echo json_encode($out);
	}

	public function update() {
		$data['userdata'] 	= $this->userdata;

		$id_pengajar				= trim($_POST['id_pengajar']);
		$data['dataPengajar'] 	= $this->M_pengajar->select_by_id($id_pengajar);
		$data['dataPegawai'] 	= $this->M_pegawai->select_guru();
		$data['dataKelas'] 	= $this->M_kelas->select_all();
		$data['dataMapel'] 	= $this->M_mapel->select_all();
		$data['dataTahunAjaran'] 	= $this->M_tahun_ajaran->select_all();

		echo show_my_modal('modals/modal_update_pengajar', 'update-pengajar', $data);
	}

	public function prosesUpdate() {
		$this->form_validation->set_rules('id_pengajar', 'id_pengajar', 'trim|required');
		$this->form_validation->set_rules('NIP', 'NIP', 'trim|required');
		$this->form_validation->set_rules('id_kelas', 'Kelas', 'trim|required');
		$this->form_validation->set_rules('id_mapel', 'Nama Mapel', 'trim|required');
		$this->form_validation->set_rules('id_tahun', 'Tahun Ajaran', 'trim|required');

		$data 	= $this->input->post();
		if ($this->form_validation->run() == TRUE) {
			$result = $this->M_pengajar->update($data);

			if ($result > 0) {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data Pengajar Berhasil diubah', '20px');
			} else {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data Pengajar Gagal diubah', '20px');
			}
		} else {
			$out['status'] = 'form';
			$out['msg'] = show_err_msg(validation_errors());
		}

		echo json_encode($out);
	}

	public function delete() {
		$id_pengajar = $_POST['id_pengajar'];
		// $cek_pengajar = $this->M_master->select_pengajar($id_biaya); 
	
		$result = $this->M_pengajar->delete($id_pengajar);
		if ($result > 0){
			echo show_succ_msg('Data Pengajar Berhasil dihapus', '20px');	
		}
		else{
			echo show_err_msg('Data Pengajar Gagal dihapus', '20px');	
		}
	}

	public function tampilPengajar(){
		$data['userdata'] 	= $this->userdata;


		$post = $this->input->post();
		$data['tahun_ajaran'] = $post['tahun_ajaran'];

		$data['dataPengajar'] 	= $this->M_pengajar->select_by_tahun($data['tahun_ajaran']);
		$data['dataPegawai'] 	= $this->M_pegawai->select_guru();
		$data['dataKelas'] 	= $this->M_kelas->select_all();
		$data['dataMapel'] 	= $this->M_mapel->select_all();
		$data['dataTahunAjaran'] 	= $this->M_tahun_ajaran->select_all();

		$data['page'] 		= "pengajar";
		$data['judul'] 		= "Data Tabel Pengajar";
		$data['deskripsi'] 	= "Kelola Data Pengajar";

		$data['modal_tambah_pengajar'] = show_my_modal('modals/modal_tambah_pengajar', 'tambah-pengajar', $data);

		$this->template->views('pengajar/list_data', $data);
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

		$data = $this->M_pengajar->select_all();

		$objPHPExcel = new PHPExcel(); 
		$objPHPExcel->setActiveSheetIndex(0); 

		$objPHPExcel->getActiveSheet()->SetCellValue('A1', "ID Pengajar"); 
		$objPHPExcel->getActiveSheet()->SetCellValue('B1', "NIP"); 
		$objPHPExcel->getActiveSheet()->SetCellValue('C1', "ID Kelas");
		$objPHPExcel->getActiveSheet()->SetCellValue('D1', "ID Mapel");

		$rowCount = 2;
		foreach($data as $value){
		    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $value->id_pengajar); 
		    $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $value->NIP); 
		    $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, $value->id_kelas); 
		    $objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, $value->id_mapel); 
		    $rowCount++; 
		} 

		$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); 
		$objWriter->save('./assets/excel/Data Pengajar.xlsx'); 

		$this->load->helper('download');
		force_download('./assets/excel/Data Pengajar.xlsx', NULL);
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
							$resultData[$index]['id_mapel'] = ucwords($value['D']);
						// }
					}
					$index++;
				}

				unlink('./assets/excel/' .$data['file_name']);

				if (count($resultData) != 0) {
					$result = $this->M_pengajar->insert_batch($resultData);
					if ($result > 0) {
						$this->session->set_flashdata('msg', show_succ_msg('Data Pengajar Berhasil diimport ke database'));
						redirect('Pengajar');
					}
				} else {
					$this->session->set_flashdata('msg', show_msg('Data Pengajar diimport ke database (Data Sudah terubah)', 'warning', 'fa-warning'));
					redirect('Pengajar');
				}

			}
		}
	}
}

/* End of file Pengajar.php */
/* Location: ./application/controllers/Pengajar.php */