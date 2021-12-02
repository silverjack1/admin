<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_auth');
		$this->load->model('M_semester');
		$this->load->model('M_master_semester');
		$this->load->model('M_tahun_ajaran');
	}
	
	public function index() {
		$session = $this->session->userdata('status');

		if ($session == '') {
			$this->load->view('login');
		} else {
			redirect('Beranda');
		}
	}

	public function setHalamanAbsensi(){
		$this->session->set_userdata('posisi_halaman', 'absensi');
		redirect('Home');
	}

	public function setHalamanSPP(){
		$this->session->set_userdata('posisi_halaman', 'spp');
		redirect('Home');
	}

	public function setHalamanRapor(){
		$this->session->set_userdata('posisi_halaman', 'rapor');
		redirect('Home');
	}

	public function setHalamanSekolah(){
		$this->session->set_userdata('posisi_halaman', 'sekolah');
		redirect('Home');
	}

	public function login() {
		$this->form_validation->set_rules('username', 'Username', 'required|max_length[18]');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() == TRUE){
			$username = trim($_POST['username']);
			$password = trim($_POST['password']);

			$data = $this->M_auth->login($username, $password);

			// $tanggal = date('d');
			// $bulan = date('m');
			// $tahun = date('Y');

			$tahun_ajaran=$semester="";

			$today = date('Y-m-d');
			$master_semester=$this->M_master_semester->select_by_date($today);

			if($master_semester->num_rows() == 1){
				$tahun_ajaran = $this->M_tahun_ajaran->select_by_id($master_semester->row()->id_tahun)->tahun;
				$semester = $master_semester->row()->id_semester;	
			}else{
				$master_semester=$this->M_master_semester->select_top();
				$tahun_ajaran = $this->M_tahun_ajaran->select_by_id($master_semester->id_tahun)->tahun;
				$semester = $master_semester->id_semester;
			}
			
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

			if ($data == false) {
				$this->session->set_flashdata('error_msg', 'Username / Password Anda Salah.');
				redirect('Auth');
			} else {
				$session = [
					'userdata' => $data,
					'status' => "Loged in",
					'tahun_ajaran_default' => $tahun_ajaran,
					'semester_default' => $semester
				];
				$this->session->set_userdata($session);
				redirect('Beranda');

			}
		} else {
			$this->session->set_flashdata('error_msg', validation_errors());
			redirect('Auth');
		}
	}

	public function logout() {
		$this->session->sess_destroy();
		redirect('Auth');
	}

}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */