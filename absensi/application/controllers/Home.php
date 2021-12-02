<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends AUTH_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_pegawai');
		$this->load->model('M_kelas');
		$this->load->model('M_mapel');
		$this->load->model('M_siswa');
		$this->load->model('M_absensi');
		$this->load->model('M_tahun_ajaran');
		$this->load->model('M_master_semester');
	}

	public function index() {
		$data['jml_pegawai'] 	= $this->M_pegawai->total_rows();
		$data['jml_kelas'] 	= $this->M_kelas->total_rows();
		$data['jml_mapel'] 		= $this->M_mapel->total_rows();
		$data['jml_siswa'] 		= $this->M_siswa->total_rows();
		$data['userdata'] 		= $this->userdata;

		$rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');

		$date = date('Y-m-d');
		
		$presensi 				= $this->M_absensi->select_status_presensi()->result();

		if($this->M_absensi->select_status_presensi()->num_rows()==0){
			$index = 0;
		    $color = '#' .$rand[rand(0,15)] .$rand[rand(0,15)] .$rand[rand(0,15)] .$rand[rand(0,15)] .$rand[rand(0,15)] .$rand[rand(0,15)];

			$data_presensi[$index]['value'] = 0;
			$data_presensi[$index]['color'] = $color;
			$data_presensi[$index]['highlight'] = $color;
			$data_presensi[$index]['label'] = "";
			
		}else{
			$index = 0;
			foreach ($presensi as $value) {
			    $color = '#' .$rand[rand(0,15)] .$rand[rand(0,15)] .$rand[rand(0,15)] .$rand[rand(0,15)] .$rand[rand(0,15)] .$rand[rand(0,15)];

				$count_presensi = $this->M_absensi->count_presensi($value->presensi, $date);

				$data_presensi[$index]['value'] = $count_presensi->jml;
				$data_presensi[$index]['color'] = $color;
				$data_presensi[$index]['highlight'] = $color;
				$data_presensi[$index]['label'] = $value->presensi;
				
				$index++;
			}	
		}
		

		$absensi[0] = "Sudah Diabsen";
		$absensi[1] = "Belum Diabsen";
		$index = 0;
		for ($i=0; $i<=1; $i++) {
		    $color = '#'.$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)];

			$count_absensi = $this->M_absensi->count_absensi($date);

			if ($absensi[$i]=="Sudah Diabsen") {
				$data_absensi[$index]['value'] = $count_absensi->jml;
			}
			else if($absensi[$i]=="Belum Diabsen"){
				
					$total = $this->M_siswa->count_by_tahun_ajaran($this->M_tahun_ajaran->select_by_tahun($this->session->userdata('tahun_ajaran_default'))->id_tahun);
					$data_absensi[$index]['value'] = $total->jml - $count_absensi->jml;
				
				
				
			}

			
			$data_absensi[$index]['color'] = $color;
			$data_absensi[$index]['highlight'] = $color;
			$data_absensi[$index]['label'] = $absensi[$i];
			
			$index++;
		}

		$data['data_presensi'] = json_encode($data_presensi);
		$data['data_absensi'] = json_encode($data_absensi);

		$data['master_semester']=$this->M_master_semester->select_by_date($date);
		if($data['master_semester']->num_rows() == 1){
				$data['tahun_ajaran'] = $this->M_tahun_ajaran->select_by_id($data['master_semester']->row()->id_tahun)->tahun;
				$data['semester'] = $data['master_semester']->row()->id_semester;	
		}

		$data['page'] 			= "home";
		$data['judul'] 			= "Beranda";
		$data['deskripsi'] 		= "Data Administrasi SMAN 1 Grabag";
		$this->template->views('home', $data);
	}
}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */