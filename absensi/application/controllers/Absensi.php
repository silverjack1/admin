<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Absensi extends AUTH_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_absensi');
		$this->load->model('M_kelas');
		$this->load->model('M_siswa');
		$this->load->model('M_master_semester');
		$this->load->model('M_tahun_ajaran');
		// $this->load->model('M_semester');
	}

	public function index() {
		$data['userdata'] 	= $this->userdata;
		// $data['dataKelas'] 	= $this->M_kelas->select_all();
		$data['dataTahunAjaran'] = $this->M_tahun_ajaran->select_all();
		// $data['dataSiswa'] = $this->M_siswa->select_all();
		$data['tanggal'] = date('Y-m-d');
		$data['tahun_ajaran_default'] = $this->session->userdata('tahun_ajaran_default');
		$data['tahun_ajaran'] = $this->M_tahun_ajaran->select_by_tahun($data['tahun_ajaran_default'])->id_tahun;

		$data['page'] 		= "absensi";
		$data['judul'] 		= "Data Absensi";
		$data['deskripsi'] 	= "Kelola Data Absensi";

		$this->session->set_userdata('id_tahun_absen', $data['tahun_ajaran']);
		$this->session->set_userdata('tanggal_absen', $data['tanggal']);

		// $data['modal_tambah_absensi'] = show_my_modal('modals/modal_tambah_absensi', 'tambah-absensi', $data);

		$this->template->views('absensi/home', $data);
	}

	public function tampil() {
		$data['tanggal'] = date('Y-m-d');
		$data['tahun_ajaran_default'] = $this->session->userdata('tahun_ajaran_default');
		$data['tahun_ajaran'] = $this->M_tahun_ajaran->select_by_tahun($data['tahun_ajaran_default'])->id_tahun;


		if($this->session->userdata('userdata')->id_jabatan == 1 || $this->session->userdata('userdata')->id_jabatan == 4) {
			$data['dataKelas'] = $this->M_kelas->select_for_absensi($data['tanggal'], $data['tahun_ajaran']);	
		}
		else if($this->session->userdata('userdata')->id_jabatan == 2 || $this->session->userdata('userdata')->id_jabatan == 3){
			$data['dataKelas'] = $this->M_kelas->selectByPengajar($this->session->userdata('userdata')->NIP, $data['tanggal'], $data['tahun_ajaran']);	
		}
		
		$this->load->view('Absensi/list_data', $data);
	}

	public function filter_absensi(){
		$post = $this->input->post();

		if( ! isset($post['tahun_ajaran'])){
			$post['tahun_ajaran']=$this->session->userdata('id_tahun_absen');
		}

		if( ! isset($post['tanggal'])){
			$post['tanggal']=$this->session->userdata('tanggal_absen');
		}
		

		$this->session->set_userdata('id_tahun_absen', $post['tahun_ajaran']);
		$this->session->set_userdata('tanggal_absen', $post['tanggal']);

		$data['userdata'] 	= $this->userdata;

		$data['page'] 		= "absensi";
		$data['judul'] 		= "Data Absensi";
		$data['deskripsi'] 	= "Kelola Data Absensi";
		
		$data['dataTahunAjaran'] = $this->M_tahun_ajaran->select_all();

		$data['tanggal'] = $post['tanggal'];
		$data['tahun_ajaran'] = $this->M_tahun_ajaran->select_by_id($post['tahun_ajaran']);

		if($this->session->userdata('userdata')->id_jabatan == 1 || $this->session->userdata('userdata')->id_jabatan == 4) {
			$data['dataKelas'] = $this->M_kelas->select_for_absensi($data['tanggal'], $data['tahun_ajaran']->id_tahun);	
		}
		else if($this->session->userdata('userdata')->id_jabatan == 2 || $this->session->userdata('userdata')->id_jabatan == 3){
			$data['dataKelas'] = $this->M_kelas->selectByPengajar($this->session->userdata('userdata')->NIP, $data['tanggal'], $data['tahun_ajaran']->id_tahun);
		}

		$this->template->views('absensi/tampil_absensi_filter', $data);

	}

	public function prosesTambah() {
		// $this->form_validation->set_rules('nama_kelas', 'Kelas', 'trim|required');

		$data 	= $this->input->post();

		// if ($this->form_validation->run() == TRUE) {
			$data['NIP']= $this->session->userdata('userdata')->NIP;

			$result = $this->M_absensi->insert($data);

			if ($result == TRUE) {
				$this->session->set_flashdata('msg', show_succ_msg('Absensi Berhasil, Silakan Cek Rekapitulasi Harian'));
				redirect('Absensi');
			} else {
				$this->session->set_flashdata('msg', show_err_msg('Prosen Absensi Gagal'));
				redirect('Absensi');
			}
		// } else {
		// 	$out['status'] = 'form';
		// 	$out['msg'] = show_err_msg(validation_errors());
		// }

		// echo json_encode($out);
	}

	public function kehadiran($id){
		$data['userdata'] 	= $this->userdata;

		$array = explode('_', $id);
		$data['id_kelas'] = $array[0];
		$data['tanggal'] = $array[1];
		$data['id_tahun'] = $array[2];

		// $tanggal = $data["tanggal"][8].$data["tanggal"][9];
		// $bulan = $data["tanggal"][5].$data["tanggal"][6];
		// $tahun = $data["tanggal"][0].$data["tanggal"][1].$data["tanggal"][2].$data["tanggal"][3];

		// if (intval($bulan) < 7) {
		// 	$tahun_ajaran = (intval($tahun)-1).'/'.$tahun;	
		// 	$semester = 2;
		// }
		// else if(intval($bulan >7)){
		// 	$tahun_ajaran = $tahun.'/'.(intval($tahun)+1);	
		// 	$semester = 1;	
		// }
		// else{
		// 	if (intval($tanggal<=15)) {
		// 		$tahun_ajaran = (intval($tahun)-1).'/'.$tahun;	
		// 		$semester = 2;
		// 	}
		// 	else{
		// 		$tahun_ajaran = $tahun.'/'.(intval($tahun)+1);		
		// 		$semester = 1;
		// 	}
		// }

		$semester = $this->M_master_semester->select_by_date($data["tanggal"]);

		if($semester->num_rows() == 1){
			if($semester->row()->id_tahun == $data['id_tahun']){
				$data['id_master_semester'] = $semester->row()->id_master_semester;
			}
			else{
				$data['id_master_semester'] = "";
			}
		}else{
			$data['id_master_semester'] = "";
		}

		
		$data['kelas'] = $this->M_kelas->select_by_id($data['id_kelas']);
		$data['jumlahKelas'] = $this->M_kelas->total_rows();
		$data['dataTahunAjaran'] = $this->M_tahun_ajaran->select_all();
		$data['semester'] = $data['id_master_semester'];
		
		$data['tahun_ajaran'] = $this->M_tahun_ajaran->select_by_id($data['id_tahun']);

		$data['dataSiswa'] = $this->M_siswa->select_for_absensi($data['id_kelas'], $data['id_tahun']);
		$data['dataAbsensi'] = $this->M_absensi->select_by_kelas_ta_tgl($data['id_kelas'], $data["id_tahun"], $data['tanggal']);

		$data['page'] 		= "absensi";
		$data['judul'] 		= "Data Absensi";
		$data['deskripsi'] 	= "Kelola Data Absensi";

		$this->template->views('absensi/form_absensi', $data);

	}

	public function update_rekap_absen($post)
	{
		
		// if ($this->form_validation->run() == TRUE) {
			$data['userdata'] 	= $this->userdata;
			$array = explode("_", $post);
			$data['tanggal'] = $array[1];
			$data['tahun_ajaran'] = $array[2];

			// $tanggal = $data["tanggal"][8].$data["tanggal"][9];
			// $bulan = $data["tanggal"][5].$data["tanggal"][6];
			// $tahun = $data["tanggal"][0].$data["tanggal"][1].$data["tanggal"][2].$data["tanggal"][3];

			// if (intval($bulan) < 7) {
			// 	$tahun_ajaran = (intval($tahun)-1).'/'.$tahun;	
			// 	$semester = 2;
			// }
			// else if(intval($bulan >7)){
			// 	$tahun_ajaran = $tahun.'/'.(intval($tahun)+1);	
			// 	$semester = 1;	
			// }
			// else{
			// 	if (intval($tanggal<=15)) {
			// 		$tahun_ajaran = (intval($tahun)-1).'/'.$tahun;	
			// 		$semester = 2;
			// 	}
			// 	else{
			// 		$tahun_ajaran = $tahun.'/'.(intval($tahun)+1);		
			// 		$semester = 1;
			// 	}
			// }

			$semester = $this->M_master_semester->select_by_date($data["tanggal"]);

			if($semester->num_rows() == 1){
				if($semester->row()->id_tahun == $data['id_tahun']){
					$data['id_master_semester'] = $semester->row()->id_master_semester;
				}
				else{
					$data['id_master_semester'] = "";
				}
			}else{
				$data['id_master_semester'] = "";
			}

			// $id_tahun 				= trim($_POST['tahun_ajaran']);
			$data['kelas'] = $this->M_kelas->select_by_id($array[0]);
			$data['jumlahKelas'] = $this->M_kelas->total_rows();
			$data['dataTahunAjaran'] = $this->M_tahun_ajaran->select_all();
			$data['semester'] = $data['id_master_semester'];
			// $data['dataSiswa'] = $this->M_siswa->select_by_kelas($id);
			$data['dataSiswa'] = $this->M_siswa->select_by_kelas_ta($array[0], $data['tahun_ajaran']);
			$data['dataAbsensi'] = $this->M_absensi->select_by_kelas_ta_tgl($array[0], $data["tahun_ajaran"], $data['tanggal']);

			$data['page'] 		= "absensi";
			$data['judul'] 		= "Data Absensi";
			$data['deskripsi'] 	= "Kelola Data Absensi";

			$this->template->views('absensi/form_absensi', $data);
		// }
		// else{
		// 	$this->session->set_flashdata('msg', show_err_msg(validation_errors()));
		// 	redirect('Absensi/kehadiran/'.$id_kelas);
		// }
	}
}

/* End of file kelas.php */
/* Location: ./application/controllers/kelas.php */