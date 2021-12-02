<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_Absensi extends AUTH_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_absensi');
		$this->load->model('M_kelas');
		$this->load->model('M_siswa');
		$this->load->model('M_tahun_ajaran');
		$this->load->model('M_semester');
	}

	public function index() {
		$data['userdata'] 	= $this->userdata;

		$data['tahun_ajaran_default'] = $this->session->userdata('tahun_ajaran_default');
		$data['semester_default'] = $this->session->userdata('semester_default');
		$data['tahun_ajaran'] = $this->M_tahun_ajaran->select_by_tahun($data['tahun_ajaran_default'])->id_tahun;

		$data['dataTahunAjaran'] = $this->M_tahun_ajaran->select_all();
		$data['dataSemester'] = $this->M_semester->select_all();	

		$data['page'] 		= "laporan_absensi";
		$data['judul'] 		= "Laporan Absensi Per Semester";
		$data['deskripsi'] 	= "Kelola Laporan Absensi";

		$this->template->views('laporan_absensi/home', $data);
	}

	public function tampil() {
		$data['tahun_ajaran_default'] = $this->session->userdata('tahun_ajaran_default');
		$data['semester_default'] = $this->session->userdata('semester_default');
		$data['tahun_ajaran'] = $this->M_tahun_ajaran->select_by_tahun($data['tahun_ajaran_default'])->id_tahun;

		if($this->session->userdata('userdata')->id_jabatan == 1 || $this->session->userdata('userdata')->id_jabatan == 4) {
			$data['dataKelas'] = $this->M_kelas->select_for_absensi('', $data['tahun_ajaran']);	
		}
		else if($this->session->userdata('userdata')->id_jabatan == 2 || $this->session->userdata('userdata')->id_jabatan == 3){
			$data['dataKelas'] = $this->M_kelas->selectByPengajar($this->session->userdata('userdata')->NIP, '', $data['tahun_ajaran']);		
		}
		
		$this->load->view('laporan_absensi/list_data', $data);
	}

	public function filter_semester_tahun_ajaran(){
		$data['userdata'] 	= $this->userdata;

		$data['page'] 		= "laporan_absensi";
		$data['judul'] 		= "Laporan Absensi Per Semester";
		$data['deskripsi'] 	= "Kelola Laporan Absensi";

		$post = $this->input->post();

		$data['semester'] = $post['semester'];
		$data['tahun_ajaran'] = $post['tahun_ajaran'];

		if($this->session->userdata('userdata')->id_jabatan == 1 || $this->session->userdata('userdata')->id_jabatan == 4) {
			$data['dataKelas'] = $this->M_kelas->select_for_absensi('', $data['tahun_ajaran']);	
		}
		else if($this->session->userdata('userdata')->id_jabatan == 2 || $this->session->userdata('userdata')->id_jabatan == 3){
			$data['dataKelas'] = $this->M_kelas->selectByPengajar($this->session->userdata('userdata')->NIP, '', $data['tahun_ajaran']);		
		}

		$data['dataTahunAjaran'] = $this->M_tahun_ajaran->select_all();
		$data['dataSemester'] = $this->M_semester->select_all();	

		$this->template->views('laporan_absensi/filter_semester_tahun_ajaran', $data);
	}

	public function download_pdf($data){
		// pastikan error reporting mati, atau file pdf akan corrupt
        error_reporting(0);

        $array = explode("_", $data);
        $id_kelas = $array[0];
        $id_semester = $array[1];
        $id_tahun = $array[2];

        // parameter OK
        if(! empty($id_kelas) && ! empty($id_semester) && ! empty($id_tahun)){
            // kelas
            $kelas = $this->db->select('nama_kelas')->where('id_kelas', $id_kelas)->get('kelas')->row()->nama_kelas;
            $semester = $this->db->select('semester')->where('id_semester', $id_semester)->get('semester')->row()->semester;
            $tahun = $this->db->select('tahun')->where('id_tahun', $id_tahun)->get('tahun_ajaran')->row()->tahun;

            $parameters=array(
                'paper'=>'A4',
                'orientation'=>'portrait',
            );

            // load library extension class Cezpdf
            // lokasi: ./application/libraries/Pdf.php
            $this->load->library('Pdf', $parameters);

            // pastikan path font benar
            $this->pdf->selectFont(APPPATH.'/third_party/pdf-php/fonts/Helvetica.afm');

           // gambar header, pastikan path gambar benar
           $this->pdf->ezImage(base_url('assets/img/KOP_Surat.JPG'), 0, 550, 'none', 'center');

            // judul rekap
            $this->pdf->ezText("\nLaporan Absensi Kelas $kelas \nSemester $semester $tahun", 15, array('justification'=> 'centre'));
            // $this->pdf->ezText("\nNama 'aleft' Elsa", 12, array('justification'=> 'aleft'));
            // $this->pdf->ezText("Kelas \t\t\t\t\t\t\t\t\t X", 12, array('justification'=> 'left'));

            // spasi judul dengan tabel
            $this->pdf->ezSetDy(-15);

            // jalankan query
            $query = $this->M_absensi->select_for_laporan($id_kelas, $id_semester, $id_tahun);

            // persiapkan data (array) untuk tabel pdf
            $no = 0;
            $i = 0;
            $data_laporan=array();
            foreach ($query->result_array() as $key => $value) {
                // jangan ganti urutan 3 baris ini, atau nomor tidak tampil
                $data_laporan[$key] = $value;
                $data_laporan[$i]['no']= ++$no;
                $i++;
            }

            // header tabel pdf
            $column_header=array(
                'no' => 'No',
                'NIS'=>'NIS',
                'nama_siswa'=>'Nama Siswa',
                'hadir'=>'Hadir',
                'sakit'=>'Sakit',
                'ijin'=>'Ijin',
                'alasan'=>'Tanpa Keterangan',
            );

            // buat tabel pdf
            $this->pdf->ezTable($data_laporan, $column_header);

            $nama_file = 'Laporan_Absensi_Kelas_' . $kelas . '_Semester_' . $semester . '_Tahun_' . $tahun . '.pdf';

            // force download, nama file sesuai dengan $nama_file
            $this->pdf->ezStream(array('Content-Disposition'=>$nama_file));
        }
        // parameter tidak lengkap
        else
        {
            $this->session->set_flashdata('msg', show_err_msg('Proses pembuatan laporan (PDF) gagal. Parameter tidak lengkap.'));
            redirect('Laporan_Absensi');
        }
    
	}

	public function detail() {
		$data['userdata'] 	= $this->userdata;

		$data['tahun_ajaran_default'] = $this->session->userdata('tahun_ajaran_default');
		$data['semester_default'] = $this->session->userdata('semester_default');
		$data['semester'] = $this->M_semester->select_by_id($data['semester_default']);
		$data['tahun_ajaran'] = $this->M_tahun_ajaran->select_by_tahun($data['tahun_ajaran_default'])->id_tahun;

		$id 				= trim($_POST['id_kelas']);
		$data['kelas'] = $this->M_kelas->select_by_id($id);
		
		$data["dataLaporanAbsen"] = $this->M_absensi->select_for_laporan($id, $data['semester_default'], $data['tahun_ajaran']);

		echo show_my_modal('modals/modal_detail_laporan_absen', 'detail-laporan-absen', $data, 'lg');
	}

	public function detailFilter() {
		$data['userdata'] 	= $this->userdata;

		$post 				= trim($_POST['data_labsen']);
		$array = explode("/", $post);
		$data['tahun_ajaran'] = $this->M_tahun_ajaran->select_by_id($array[2]);
		$data['kelas'] = $this->M_kelas->select_by_id($array[0]);
		$data['semester'] = $this->M_semester->select_by_id($array[1]);
		
		$data["dataLaporanAbsen"] = $this->M_absensi->select_for_laporan($array[0], $array[1], $array[2]);

		echo show_my_modal('modals/modal_detail_laporan_absen_filter', 'detail-laporan-absen-filter', $data, 'lg');
	}
}

/* End of file Laporan_Absen.php */
/* Location: ./application/controllers/Laporan_Absen.php */