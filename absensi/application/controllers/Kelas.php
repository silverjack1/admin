<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelas extends AUTH_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_kelas');
		$this->load->model('M_siswa');
		$this->load->model('M_tahun_ajaran');
		$this->load->model('M_wali_kelas');
	}

	public function index() {
		$data['userdata'] 	= $this->userdata;
		$data['dataKelas'] 	= $this->M_kelas->select_all();
		$data['dataTahunAjaran'] 	= $this->M_tahun_ajaran->select_all();

		$data['page'] 		= "kelas";
		$data['judul'] 		= "Data Kelas";
		$data['deskripsi'] 	= "Kelola Data Kelas";

		$data['modal_tambah_kelas'] = show_my_modal('modals/modal_tambah_kelas', 'tambah-kelas', $data);

		$this->template->views('kelas/home', $data);
	}

	public function tampil() {
		$data['dataKelas'] = $this->M_kelas->select_all();
		$this->load->view('Kelas/list_data', $data);
	}

	public function prosesTambah() {
		$this->form_validation->set_rules('nama_kelas', 'Kelas', 'trim|required');

		$data 	= $this->input->post();
		$data['nama_kelas'] = strtoupper($data['nama_kelas']);
		$validasi_kesamaan = $this->M_kelas->check_nama($data['nama_kelas']);
		
			if ($this->form_validation->run() == TRUE) {
				if ($validasi_kesamaan == 0) {
					if ($this->M_kelas->cek_format_kelas($data['nama_kelas']) == TRUE) {
					
						$result = $this->M_kelas->insert($data);

						if ($result > 0) {
							$out['status'] = '';
							$out['msg'] = show_succ_msg('Data kelas Berhasil ditambahkan', '20px');
						} else {
							$out['status'] = '';
							$out['msg'] = show_err_msg('Data kelas Gagal ditambahkan', '20px');
						}
					}
					else{
						$out['status'] = 'form';
						$out['msg'] = show_err_msg('<br>Format Nama kelas salah!<br> Contoh : X-Bahasa-1', '15px');
					}
				}
				else{
					$out['status'] = 'form';
					$out['msg'] = show_err_msg('<br>Nama kelas '.$data['nama_kelas'].' sudah ada', '15px');
				}
			} else {
				$out['status'] = 'form';
				$out['msg'] = show_err_msg(validation_errors());
			}
		
		echo json_encode($out);

	}

	public function update() {
		$data['userdata'] 	= $this->userdata;

		$id_kelas 				= trim($_POST['id_kelas']);
		$data['dataKelas'] 	= $this->M_kelas->select_by_id($id_kelas);

		echo show_my_modal('modals/modal_update_kelas', 'update-kelas', $data);
	}

	public function prosesUpdate() {
		$this->form_validation->set_rules('nama_kelas', 'Kelas', 'trim|required');

		$data 	= $this->input->post();
		$data['nama_kelas'] = strtoupper($data['nama_kelas']);
		$validasi_kesamaan = $this->M_kelas->check_nama($data['nama_kelas']);
		if ($this->form_validation->run() == TRUE) {
			if ($validasi_kesamaan == 0) {
				if ($this->M_kelas->cek_format_kelas($data['nama_kelas']) == TRUE) {
					$result = $this->M_kelas->update($data);

					if ($result > 0) {
						$out['status'] = '';
						$out['msg'] = show_succ_msg('Data kelas Berhasil diubah', '20px');
					} else {
						$out['status'] = '';
						$out['msg'] = show_succ_msg('Data kelas Gagal diubah', '20px');
					}
				}
				else{
					$out['status'] = 'form';
					$out['msg'] = show_err_msg('<br>Format Nama kelas salah!<br> Contoh : X-Bahasa-1', '15px');
				}
			}
			else{
				$out['status'] = 'form';
				$out['msg'] = show_err_msg('<br>Nama kelas '.$data['nama_kelas'].' sudah ada', '15px');
			}
		} else {
			$out['status'] = 'form';
			$out['msg'] = show_err_msg(validation_errors());
		}

		echo json_encode($out);
	}

	public function delete() {
		$id_kelas = $_POST['id_kelas'];
		$result = $this->M_kelas->delete($id_kelas);
		
		if ($result > 0) {
			echo show_succ_msg('Data kelas Berhasil dihapus', '20px');
		} else {
			echo show_err_msg('Data kelas Gagal dihapus karena digunakan di data lain', '20px');
		}
	}

	// public function detail() {
	// 	$data['userdata'] 	= $this->userdata;

	// 	$id 				= trim($_POST['id_kelas']);
	// 	$data['kelas'] = $this->M_kelas->select_by_id($id);
	// 	$data['jumlahKelas'] = $this->M_kelas->total_rows();
	// 	$data['dataTahunAjaran'] = $this->M_tahun_ajaran->select_all();
	// 	$data['dataSiswa'] = $this->M_siswa->select_by_kelas($id);

	// 	echo show_my_modal('modals/modal_detail_kelas', 'detail-kelas', $data, 'lg');
	// }

	public function export() {
		error_reporting(E_ALL);
    
		include_once './assets/phpexcel/Classes/PHPExcel.php';
		$objPHPExcel = new PHPExcel();

		$data = $this->M_kelas->select_all();

		$objPHPExcel = new PHPExcel(); 
		$objPHPExcel->setActiveSheetIndex(0); 

		$objPHPExcel->getActiveSheet()->SetCellValue('A1', "ID Kelas"); 
		$objPHPExcel->getActiveSheet()->SetCellValue('B1', "Nama kelas");

		$rowCount = 2;
		foreach($data as $value){
		    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $value->id_kelas); 
		    $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $value->nama_kelas); 
		    $rowCount++; 
		} 

		$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); 
		$objWriter->save('./assets/excel/Data kelas.xlsx'); 

		$this->load->helper('download');
		force_download('./assets/excel/Data kelas.xlsx', NULL);
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
						$check = $this->M_kelas->check_nama($value['B']);

						if ($check != 1) {
							$resultData[$index]['nama_kelas'] = ucwords($value['B']);
						}
					}
					$index++;
				}

				unlink('./assets/excel/' .$data['file_name']);

				if (count($resultData) != 0) {
					$result = $this->M_kelas->insert_batch($resultData);
					if ($result > 0) {
						$this->session->set_flashdata('msg', show_succ_msg('Data kelas Berhasil diimport ke database'));
						redirect('Kelas');
					}
				} else {
					$this->session->set_flashdata('msg', show_msg('Data kelas Gagal diimport ke database (Data Sudah terubah)', 'warning', 'fa-warning'));
					redirect('Kelas');
				}

			}
		}
	}

	public function tampilSiswaByKelas($id){
		$data['userdata'] 	= $this->userdata;

		$data['tahun_ajaran_default'] = $this->session->userdata('tahun_ajaran_default');
		$data['tahun_ajaran'] = $this->M_tahun_ajaran->select_by_tahun($data['tahun_ajaran_default'])->id_tahun;

		// $id 				= trim($_POST['id_kelas']);
		$data['kelas'] = $this->M_kelas->select_by_id($id);
		$data['jumlahKelas'] = $this->M_kelas->total_rows();
		$data['dataTahunAjaran'] = $this->M_tahun_ajaran->select_all();
		// $data['dataSiswa'] = $this->M_siswa->select_by_kelas_ta($id, $data['tahun_ajaran']);

		$this->session->set_userdata('siswa_kelas', $id);

		$data['page'] 		= "kelas";
		$data['judul'] 		= "Data Kelas";
		$data['deskripsi'] 	= "Kelola Data Kelas";

		$this->template->views('kelas/siswa_kelas', $data);

	}

	public function selectSiswaTAKelas()
	{
		// $this->form_validation->set_rules('tahun_ajaran', 'Tahun Ajaran', 'trim|required');
		// if ($this->form_validation->run() == TRUE) {
			// $data['userdata'] 	= $this->userdata;

			// $post = $this->input->post();
			$data["id_tahun"] = $_POST['id_tahun'];
			$id_kelas = $this->session->userdata('siswa_kelas');


			// $id_tahun 				= trim($_POST['tahun_ajaran']);
			// $data['kelas'] = $this->M_kelas->select_by_id($id_kelas);
			// $data['jumlahKelas'] = $this->M_kelas->total_rows();
			// $data['dataTahunAjaran'] = $this->M_tahun_ajaran->select_all();
			// $data['dataSiswa'] = $this->M_siswa->select_by_kelas($id);
			$data['dataSiswa'] = $this->M_siswa->select_by_kelas_ta($id_kelas, $data["id_tahun"]);

			// $data['page'] 		= "kelas";
			// $data['judul'] 		= "Data Kelas";
			// $data['deskripsi'] 	= "Kelola Data Kelas";

			$this->load->view('kelas/siswa_kelas_list_data', $data);
		// }
		// else{
		// 	$this->session->set_flashdata('msg', show_err_msg(validation_errors()));
		// 	redirect('Kelas/tampilSiswaByKelas/'.$id_kelas);
		// }
	}

	public function kelola_siswa() {
		$data['userdata'] 	= $this->userdata;

		$data['page'] 		= "kelas";
		$data['judul'] 		= "Data Siswa Per Kelas";
		$data['deskripsi'] 	= "Kelola Data Siswa";


		$data['tahun_ajaran_default'] = $this->session->userdata('tahun_ajaran_default');
		$data['tahun_ajaran'] = $this->M_tahun_ajaran->select_by_tahun($data['tahun_ajaran_default'])->id_tahun;
		

		$this->session->set_userdata('id_tahun_kelola_siswa', $data['tahun_ajaran']);

		$tahun_ajaran = explode("/", $data['tahun_ajaran_default']);
		$data['tahun_ajaran_sesudah'] = (intval($tahun_ajaran[0])+1).'/'.(intval($tahun_ajaran[1])+1);
		

		if($this->M_tahun_ajaran->select_by_tahun($data['tahun_ajaran_sesudah']) == NULL){
			$data['id_ta_sesudah']=99999;
		}else{
			$data['id_ta_sesudah']=$this->M_tahun_ajaran->select_by_tahun($data['tahun_ajaran_sesudah'])->id_tahun;
		}

		$data['dataKelasAsal'] 	= $this->M_wali_kelas->select_all_by_ta($data['tahun_ajaran']);
		$data['dataKelasBaru'] 	= $this->M_wali_kelas->select_all_by_ta($data['id_ta_sesudah']);
		$data['dataTahunAjaran'] 	= $this->M_tahun_ajaran->select_all();
		$data['dataSiswa'] = $this->M_siswa->select_by_tahun_ajaran('',$data['tahun_ajaran'], $data['id_ta_sesudah'] );
		$this->template->views('Kelas/kelola_siswa', $data);
	}

	public function kelola_siswa_filter() {
		$data['userdata'] 	= $this->userdata;

		$data['page'] 		= "kelas";
		$data['judul'] 		= "Data Siswa Per Kelas";
		$data['deskripsi'] 	= "Kelola Data Siswa";

		if ( ! isset($_POST['tahun_ajaran']) && !isset($_POST['kelas'])) {
			$id_tahun = $this->session->userdata('id_tahun_kelola_siswa');
			$id_kelas = $this->session->userdata('id_kelas_kelola_siswa');
		}
		else{
			$id_tahun= $_POST['tahun_ajaran'];
			$id_kelas= $_POST['kelas'];

			$this->session->set_userdata('id_kelas_kelola_siswa', $id_kelas);
			$this->session->set_userdata('id_tahun_kelola_siswa', $id_tahun);
		}
		
		$data['id_kelas'] = $id_kelas;
		$data['tahun_ajaran'] = $this->M_tahun_ajaran->select_by_id($id_tahun);

		$tahun_ajaran = explode("/", $data['tahun_ajaran']->tahun);
		$data['tahun_ajaran_sesudah'] = (intval($tahun_ajaran[0])+1).'/'.(intval($tahun_ajaran[1])+1);


		if($this->M_tahun_ajaran->select_by_tahun($data['tahun_ajaran_sesudah']) == NULL){
			$data['id_ta_sesudah']=99999;
		}else{
			$data['id_ta_sesudah']=$this->M_tahun_ajaran->select_by_tahun($data['tahun_ajaran_sesudah'])->id_tahun;
		}

		$data['dataKelasAsal'] 	= $this->M_wali_kelas->select_all_by_ta($id_tahun);
		$data['dataKelasBaru'] 	= $this->M_wali_kelas->select_all_by_ta($data['id_ta_sesudah']);
		$data['dataTahunAjaran'] 	= $this->M_tahun_ajaran->select_all();
		$data['dataSiswa'] = $this->M_siswa->select_by_tahun_ajaran($id_kelas, $id_tahun, $data['id_ta_sesudah']);
		$this->template->views('Kelas/list_data_kelola_siswa', $data);
	}

	public function kelola_load_kelas(){
		$id_tahun = $_POST['id_tahun'];

		$data['dataKelasAsal'] 	= $this->M_wali_kelas->select_all_by_ta($id_tahun);

		$this->load->view('kelas/kelola_load_kelas', $data);
	}

	public function tambahSiswakeKelas(){
		$data 	= $this->input->post();

		$required = TRUE;
		foreach ($data["kelas_baru"] as $NIS => $id_kelas) {
			// if ($id_kelas == '') {
			// 	$required = FALSE;
			// 	break;
			// }
		}
		
		if ($required == TRUE) {

			$result = $this->M_kelas->insertSiswa($data);

			if ($result == TRUE) {
				$this->session->set_flashdata('msg', show_succ_msg('Data Siswa Berhasil Dikelola, Silakan Cek Detail Kelas'));
				redirect('Kelas');
			} else {
				$this->session->set_flashdata('msg', show_err_msg('Data Siswa Gagal Dikelola'));
				redirect('Kelas');
			}
		} else {
			$this->session->set_flashdata('msg', show_err_msg('Data Kelas harus Dipilih'));
			redirect('Kelas/kelola_siswa_filter');
		}
	}
}

/* End of file kelas.php */
/* Location: ./application/controllers/kelas.php */