<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rekap_Absen extends AUTH_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_absensi');
		$this->load->model('M_kelas');
		$this->load->model('M_siswa');
		$this->load->model('M_tahun_ajaran');
	}

	public function index() {
		$data['userdata'] 	= $this->userdata;
		$data['dataKelas'] 	= $this->M_kelas->select_all();
		$data['dataTahunAjaran'] = $this->M_tahun_ajaran->select_all();
		$data['dataSiswa'] = $this->M_siswa->select_all();

		$data['tahun_ajaran_default'] = $this->session->userdata('tahun_ajaran_default');
		$data['tahun_ajaran'] = $this->M_tahun_ajaran->select_by_tahun($data['tahun_ajaran_default'])->id_tahun;


		$data['page'] 		= "rekap_absen";
		$data['judul'] 		= "Rekapitulasi Absensi";
		$data['deskripsi'] 	= "Kelola Rekapitulasi Absensi";


		$this->template->views('rekap_absen/home', $data);
	}

	public function tampil() {
		$data['tahun_ajaran_default'] = $this->session->userdata('tahun_ajaran_default');
		$data['tahun_ajaran'] = $this->M_tahun_ajaran->select_by_tahun($data['tahun_ajaran_default'])->id_tahun;

		if($this->session->userdata('userdata')->id_jabatan == 1 || $this->session->userdata('userdata')->id_jabatan == 4) {
			$data['dataKelas'] = $this->M_kelas->select_for_absensi($data['tanggal'], $data['tahun_ajaran']->id_tahun);	
		}
		else if($this->session->userdata('userdata')->id_jabatan == 2 || $this->session->userdata('userdata')->id_jabatan == 3){
			$data['dataKelas'] = $this->M_kelas->selectByPengajar($this->session->userdata('userdata')->NIP, $data['tanggal'], $data['tahun_ajaran']);	
		}
		
		$this->load->view('rekap_absen/list_data', $data);
	}

	

	public function detail() {
		$data['userdata'] 	= $this->userdata;

		$data['tahun_ajaran_default'] = $this->session->userdata('tahun_ajaran_default');
		$data['tahun_ajaran'] = $this->M_tahun_ajaran->select_by_tahun($data['tahun_ajaran_default'])->id_tahun;

		$id 				= trim($_POST['id_kelas']);
		$data['kelas'] = $this->M_kelas->select_by_id($id);
		$data['jumlahKelas'] = $this->M_kelas->total_rows();
		// $data['dataTahunAjaran'] = $this->M_tahun_ajaran->select_all();
		// $data['dataSiswa'] = $this->M_siswa->select_by_kelas($id);
		$data['dataAbsensi'] = $this->M_absensi->select_by_kelas_ta_tgl($id, $data["tahun_ajaran"], date('Y-m-d'));

		echo show_my_modal('modals/modal_detail_rekap_absen', 'detail-rekap-absen', $data, 'lg');
	}

	

	public function filter_tanggal_tahun_ajaran(){
		$data['userdata'] 	= $this->userdata;

		$data['dataTahunAjaran'] = $this->M_tahun_ajaran->select_all();
		

		$data['page'] 		= "rekap_absen";
		$data['judul'] 		= "Rekapitulasi Absensi";
		$data['deskripsi'] 	= "Kelola Rekapitulasi Absensi";

		$post = $this->input->post();
		$data['tanggal'] = $post["tanggal"];
		$data['tahun_ajaran'] = $post["tahun_ajaran"];

		if($this->session->userdata('userdata')->id_jabatan == 1 || $this->session->userdata('userdata')->id_jabatan == 4) {
			$data['dataKelas'] = $this->M_kelas->select_for_absensi($data['tanggal'], $data['tahun_ajaran']);	
		}
		else if($this->session->userdata('userdata')->id_jabatan == 2 || $this->session->userdata('userdata')->id_jabatan == 3){
			$data['dataKelas'] = $this->M_kelas->selectByPengajar($this->session->userdata('userdata')->NIP, $data['tanggal'], $data['tahun_ajaran']);		
		}
		
		$this->template->views('rekap_absen/filter_tanggal_tahun_ajaran', $data);
	}

	public function detailFilter() {
		$data['userdata'] 	= $this->userdata;

		$post 				= trim($_POST['data_rabsen']);
		$array = explode("/", $post);
		$data['tahun_ajaran'] = $this->M_tahun_ajaran->select_by_id($array[2]);
		$data['kelas'] = $this->M_kelas->select_by_id($array[0]);
		$data['tanggal'] = $array[1];
		$data['jumlahKelas'] = $this->M_kelas->total_rows();
		// $data['dataTahunAjaran'] = $this->M_tahun_ajaran->select_all();
		// $data['dataSiswa'] = $this->M_siswa->select_by_kelas($id);
		$data['dataAbsensi'] = $this->M_absensi->select_by_kelas_ta_tgl($array[0], $array[2], $data["tanggal"]);

		echo show_my_modal('modals/modal_detail_rekap_absen_filter', 'detail-rekap-absen-filter', $data, 'lg');
	}
}

/* End of file kelas.php */
/* Location: ./application/controllers/kelas.php */