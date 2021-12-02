<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_Semester extends AUTH_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_master_semester');
		$this->load->model('M_tahun_ajaran');
		$this->load->model('M_semester');
		$this->load->model('M_pengajar');
	}

	public function index() {
		$data['userdata'] 	= $this->userdata;
		$data['dataMasterSemester'] 	= $this->M_master_semester->select_all();

		//data buat form tambah
		$data['dataSemester'] 	= $this->M_semester->select_all();
		$data['dataTahunAjaran'] 	= $this->M_tahun_ajaran->select_all();

		$data['page'] 		= "master_semester";
		$data['judul'] 		= "Data Semester";
		$data['deskripsi'] 	= "Kelola Data Semester";

		$data['modal_tambah_master_semester'] = show_my_modal('modals/modal_tambah_master_semester', 'tambah-master-semester', $data);

		$this->template->views('master_semester/home', $data);
	}

	public function tampil() {
		$data['dataMasterSemester'] = $this->M_master_semester->select_all();
		$this->load->view('master_semester/list_data', $data);
	}

	public function prosesTambah() {
		$this->form_validation->set_rules('id_semester', 'Semester', 'trim|required');
		$this->form_validation->set_rules('id_tahun', 'Tahun Ajaran', 'trim|required');
		$this->form_validation->set_rules('tanggal_mulai', 'Tanggal Mulai', 'trim|required');
		$this->form_validation->set_rules('tanggal_akhir', 'Tanggal Akhir', 'trim|required');

		$data 	= $this->input->post();
		// $data['nama_mapel'] = ucwords($data['nama_mapel']);
		// $validasi_kesamaan = $this->M_master_semester->check_nama($data['nama_mapel']);
		if ($this->form_validation->run() == TRUE) {
			// if ($validasi_kesamaan == 0) {
				$tahun_ajaran = $this->M_tahun_ajaran->select_by_id($data['id_tahun']);
				$semester = $this->M_semester->select_by_id($data['id_semester']);
				$data['nama_semester'] = $semester->semester.' '.$tahun_ajaran->tahun;
				$result = $this->M_master_semester->insert($data);

				if ($result > 0) {
					$out['status'] = '';
					$out['msg'] = show_succ_msg('Data Mata Pelajaran Berhasil ditambahkan', '20px');
				} else {
					$out['status'] = '';
					$out['msg'] = show_err_msg('Data Mata Pelajaran Gagal ditambahkan', '20px');
				}
			// }
			// else{
			// 	$out['status'] = 'form';
			// 	$out['msg'] = show_err_msg('<br>Mata Pelajaran '.$data['nama_mapel'].' sudah ada', '15px');
			// }
		} else {
			$out['status'] = 'form';
			$out['msg'] = show_err_msg(validation_errors());
		}

		echo json_encode($out);
	}

	public function update() {
		$data['userdata'] 	= $this->userdata;

		//data buat form update
		$data['dataSemester'] 	= $this->M_semester->select_all();
		$data['dataTahunAjaran'] 	= $this->M_tahun_ajaran->select_all();

		$id_master_semester				= trim($_POST['id_master_semester']);
		$data['dataMasterSemester'] 	= $this->M_master_semester->select_by_id($id_master_semester);

		echo show_my_modal('modals/modal_update_master_semester', 'update-master-semester', $data);
	}

	public function prosesUpdate() {
		$this->form_validation->set_rules('id_semester', 'Semester', 'trim|required');
		$this->form_validation->set_rules('id_tahun', 'Tahun Ajaran', 'trim|required');
		$this->form_validation->set_rules('tanggal_mulai', 'Tanggal Mulai', 'trim|required');
		$this->form_validation->set_rules('tanggal_akhir', 'Tanggal Akhir', 'trim|required');

		$data 	= $this->input->post();
		// $data['nama_mapel'] = ucwords($data['nama_mapel']);
		// $validasi_kesamaan = $this->M_master_semester->check_nama($data['nama_mapel']);
		if ($this->form_validation->run() == TRUE) {
			// if ($validasi_kesamaan == 0) {
				$tahun_ajaran = $this->M_tahun_ajaran->select_by_id($data['id_tahun']);
				$semester = $this->M_semester->select_by_id($data['id_semester']);
				$data['nama_semester'] = $semester->semester.' '.$tahun_ajaran->tahun;
				$result = $this->M_master_semester->update($data);

				if ($result > 0) {
					$out['status'] = '';
					$out['msg'] = show_succ_msg('Data Semester Berhasil diubah', '20px');
				} else {
					$out['status'] = '';
					$out['msg'] = show_succ_msg('Data Semester Gagal diubah', '20px');
				}
			// }
			// else{
			// 	$out['status'] = 'form';
			// 	$out['msg'] = show_err_msg('<br>Mata Pelajaran '.$data['nama_mapel'].' sudah ada', '15px');
			// }
		} else {
			$out['status'] = 'form';
			$out['msg'] = show_err_msg(validation_errors());
		}

		echo json_encode($out);
	}

	public function delete() {
		$id_master_semester = $_POST['id_master_semester'];
		// $cek_pengajar = $this->M_master_semester->select_pengajar($id_master_semester); 
	
		// if ($cek_pengajar == 0) {
			$result = $this->M_master_semester->delete($id_master_semester);
			if ($result > 0){
				echo show_succ_msg('Data Semester Berhasil dihapus', '20px');	
			}
			else{
				echo show_err_msg('Data Semester Gagal dihapus', '20px');	
			}
		// } else {
		// 	echo show_err_msg('Data Mata Pelajaran Gagal dihapus! Cek Tabel Pengajar', '20px');
		// }
	}

}

/* End of file Master_Semester.php */
/* Location: ./application/controllers/Kota.php */
