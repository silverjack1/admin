<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ujian_online extends CI_Controller
{
	/*
	 * @autor KangAgus <sumarna.agus@gmail.com>
     */
	 
	function __construct()
	{
		parent::__construct();
		$this->cek_login();
		$this->output->enable_profiler(FALSE);
		$this->load->model("master_model", "mm");
	}

    function index()
    {
		if($this->input->get("m") && $this->input->get("a"))
		{
			$get_a = $this->input->get("a");
			$dec_a = base64_decode("$get_a");
			$a = explode("-",$dec_a);
			$alert = $a[1];
			
			$get_m = $this->input->get("m");
			$dec_m = base64_decode("$get_m");
			$m = explode("-",$dec_m);
			$message = $m[1];
			
			$data["alert"] = $alert;
			$data["message"] = $message;
			
			if(is_string($alert)==FALSE || ($alert!='success' && $alert!='warning') || is_string($message)==FALSE){
				redirect(site_url("auth/warning"));
			}
		}
		
		$data["page"] = "view_ujian/home_siswa_ujian";
        $data["title"] = "Ujian Online";
		$this->load->view('template/template', $data);
    }
	
	function ujian_ajax()
	{
		$requestData= $_REQUEST;
		$columns = array( 
			0 => '',
			1 => 'judul_keterangan',
			2 => 'judul_waktu',
			3 => '',
			4 => 'judul_studi',
			5 => 'judul_tgl_mulai',
		);
		
		$id_siswa   = $this->session->userdata("siswaId");
		$qry_siswa  = $this->mm->get_data_by_id("siswa_id",$id_siswa,"siswa","siswa");
		$jenjang_id = $qry_siswa->siswa_jenjang;
		$jurusan_id = $qry_siswa->siswa_jurusan;
		$kelas      = $qry_siswa->siswa_kelas;
		
		$get_parent=$this->session->userdata('session_parent_ujian');
		if(isset($get_parent) && $get_parent!=""){
			$dec_m = base64_decode($get_parent);
			$m = explode("-",$dec_m);
			$parent_id = $m[1];
			$filter_parent = "judul_parent=".$parent_id." AND ";
		}else{
			$filter_parent = "judul_parent=0 AND ";
		}
		
		if(!empty($jurusan_id)){
			$parameter = $filter_parent." judul_akses=1 AND judul_kelas=".$kelas." AND (judul_jurusan=".$jurusan_id." OR judul_jurusan=0) AND judul_tingkat=".$jenjang_id." AND ";
		}else{
			$parameter = $filter_parent." judul_akses=1 AND judul_kelas=".$kelas." AND judul_type=1 AND judul_tingkat=".$jenjang_id." AND ";
		}
		
		$res_tot = $this->mm->count_all_data("v_ujian_judul", NULL, $parameter." judul");
		$tot_data = $res_tot->jml;

		$order_by = $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir'];
		$offset = $requestData['start'];
		$limit = $requestData['length'];

		if( !empty($requestData['search']['value']) )
		{
			$where = "(judul_pertanyaan LIKE '%".$requestData['search']['value']."%')";
			$res = $this->mm->get_search_data("v_ujian_judul", $where, $parameter." judul", $order_by, $limit, $offset);
			
			$res_filtered_tot = $this->mm->count_all_data("v_ujian_judul", $where, $parameter." judul");
			$tot_filtered = $res_filtered_tot->jml;
		}
		else
		{
			$res = $this->mm->get_all_data("v_ujian_judul", $parameter." judul", $order_by, $limit, $offset);
			$tot_filtered = $tot_data;
		}
		
		$data = array();if(!empty($res)){
		foreach($res as $row)
		{
			$random = rand();
			$id     = base64_encode($random."-".$row->judul_id);
			$edit   = base64_encode($random."-edit");
			$view   = base64_encode($random."-view");
			$delete = base64_encode($random."-delete");
			
			if($row->jurusan_ket==""){ $jurusan=""; }else{ $jurusan=" / ".$row->jurusan_ket; }
			
			//cek jumlah soal
			$cekdata="uj_judul=".$row->judul_id."";
			$cek_soal=$this->mm->check_duplicate("v_ujian_detail","uj",$cekdata);
			$jumlah=$cek_soal->jml;
			
			//cek jika soal sudah di ujian, tombol pilih disabled
			$cekdata_1="jawab_judul=".$row->judul_id." AND jawab_kode=".$id_siswa." AND jawab_status='N' ";
			$cekdata_2="jawab_judul=".$row->judul_id." AND jawab_kode=".$id_siswa." AND jawab_status='Y' ";
			$cek_jawab_1=$this->mm->check_duplicate("ujian_jawab","jawab",$cekdata_1);
			$cek_jawab_2=$this->mm->check_duplicate("ujian_jawab","jawab",$cekdata_2);
			
			//cek jumlah data parent
			$cekdataparent = "judul_parent = '".$row->judul_id."'";
			$cek_parent = $this->mm->check_duplicate("ujian_judul", "judul" ,$cekdataparent);
			$jumlah_parent = $cek_parent->jml;
			
			if($jumlah_parent>0){$aksesku = "";}else{$aksesku = "disabled";}
			if($aksesku=="disabled" && $jumlah==0){ $tombolku = "disabled"; }else{ $tombolku = ""; }
			
			$nestedData = array();
			if($jumlah!=0 || $row->judul_parent==0){
				if($aksesku=="disabled"){
					if($cek_jawab_1->jml==0){
						if($cek_jawab_2->jml!=0){
							//jika Y, maka sedang dikerjakan
							$nestedData[] = "<a href='javascript:void(0)' onClick=progress_function('".$edit."','".$id."','".$id_siswa."','".$jenjang_id."'); class='btn btn-sm btn-success pull-left' title='Klik untuk kembali mengerjakan'>MENGERJAKAN SOAL</a>";
						}else{
							//jika tidak N, maka belum dikerjakan
							$nestedData[] = "<a href='javascript:void(0)' ".$tombolku." onClick=konfirmasi_function('".$id."'); class='btn btn-sm btn-primary pull-left' title='Klik untuk mengerjakan'>KERJAKAN SOAL</a>";
						}
					}else{
						//jika N, maka sudah di kerjakan
						$nestedData[] = "<a href='javascript:void(0)' onClick=hasil_function('".$id."'); class='btn btn-sm btn-danger pull-left' title='Klik untuk melihat hasil ujian'>SUDAH DIKERJAKAN</a>";
					}
					
					if($cek_jawab_1->jml==0){
						if($cek_jawab_2->jml!=0){
							//jika Y, maka sedang dikerjakan
							$nestedData[] = "<a href='javascript:void(0)' title='Klik untuk kembali mengerjakan' onClick=progress_function('".$edit."','".$id."','".$id_siswa."','".$jenjang_id."'); >".strtoupper($row->judul_keterangan)."</a>";
						}else{
							//jika tidak N, maka belum dikerjakan
							$nestedData[] = "<a href='javascript:void(0)' ".$tombolku." title='Klik untuk mengerjakan' onClick=konfirmasi_function('".$id."');>".strtoupper($row->judul_keterangan)."</a>";
						}
					}else{
						//jika N, maka sudah di kerjakan
						$nestedData[] = "<a href='javascript:void(0)' title='Klik untuk melihat hasil ujian' onClick=hasil_function('".$id."');>".strtoupper($row->judul_keterangan)."</a>";
					}
				}else{
					$nestedData[] = "<a href='javascript:;' onClick=view_function('".$edit."','".$id."'); class='btn btn-sm btn-success' title='Klik untuk buka folder' target='_blank'><i class='fa fa-folder'></i>&nbsp;&nbsp;BUKA FOLDER</a>&nbsp;";
					$nestedData[] = "<a href='javascript:void(0)' title='Klik untuk melihat hasil ujian' onClick=hasil_function('".$id."');>".strtoupper($row->judul_keterangan)."</a>";
				}
			}
			
			$nestedData[] = strtoupper($row->judul_waktu)." Menit";
			$nestedData[] = "<span class='label label-success'>".$jumlah." SOAL</span>";		
			$nestedData[] = "<font color='blues'>".strtoupper($row->bds_ket)." / ".strtoupper($row->judul_kelas)." ".strtoupper($row->jenjang_ket.$jurusan)."</font>";
			$nestedData[] = $row->judul_tgl_mulai;
			
			$data[] = $nestedData;}
		}
		
		$json_data = array(
			"draw"            => intval( $requestData['draw'] ),
			"recordsTotal"    => intval($tot_data),
			"recordsFiltered" => intval($tot_filtered),
			"data"            => $data
		);
		echo json_encode($json_data);
	}
	
	function konfirmasi(){
		//ambil parameter judul
		$id = $this->input->get("id");
		$id_decrypt = base64_decode("$id");
		$judul      = explode("-",$id_decrypt);
		$judul_id   = $judul[1];
		
		//cegah error
		if($judul_id=="" || is_numeric($judul_id)==FALSE){
			//redirect(site_url("auth/warning"));
		}
		
		$qry_judul   = $this->mm->get_data_by_id("judul_id",$judul_id,"v_ujian_judul","judul");
		$judul_waktu = $qry_judul->judul_waktu;
		$judul_ket   = $qry_judul->judul_keterangan;
		$judul_mode  = $qry_judul->judul_mode;
		$judul_type  = $qry_judul->judul_type;
		$judul_akses = $qry_judul->judul_akses;
		$judul_token = $qry_judul->judul_token;
		
		$parameter = "uj_judul=".$judul_id;
		$query_jml = $this->mm->check_duplicate("v_ujian_detail", "uj", $parameter);
		$jumlah    = $query_jml->jml;
		$jumData   = $jumlah;
		
		$data["judul_ket"]   = $judul_ket;
		$data["judul_token"] = $judul_token;
		$data["judul_waktu"] = $judul_waktu;
		$data["jawab_jumlah"]= $jumData;
		
		//jika ujian sedang di kerjakan
		$cekdata = "jawab_judul=".$judul_id." AND jawab_kode=".$this->session->userdata('siswaId')." AND jawab_status='Y'";
		$cek_jawab = $this->mm->check_duplicate("ujian_jawab","jawab",$cekdata);
		if($cek_jawab->jml!=0){ redirect(site_url("ujian_online"));}
		
		$data["page"] = "view_ujian/home_siswa_konfirmasi";
        $data["title"] = "Konfirmasi Ujian";
		$this->load->view('template/template', $data);
	}
	
	function token(){
		$konfirm = $this->input->post('konfirmasi');
		if(isset($konfirm) && $konfirm="KONFIRMASI")
		{
			$judul_token = $this->input->post('token');
			$mo = $this->input->post('mo');
			$bp = $this->input->post('bp');
			$id = $this->input->post('id');
			$kd = $this->input->post('kd');
			$jj = $this->input->post('jj');
			
			$id_decrypt = base64_decode($id);
			$judul = explode("-",$id_decrypt);
			$judul_id = $judul[1];
			
			$cekdata = "token_ujian=".$judul_id." AND token_kode='".$judul_token."'";
			$cek_jawab = $this->mm->check_duplicate("ujian_token","token",$cekdata);
			if($cek_jawab->jml!=0)
			{ 
				$random = rand();
				redirect(site_url("ujian_online/tampil?m=".$mo."&ss=".$bp."&id=".$id."&kd=".$kd."&jj=".$jj));
			}else{
				$rand = rand();
				$msg  = base64_encode($rand."-Token yang Anda masukan tidak valid");
				$alert = base64_encode($rand."-warning");
				redirect(site_url("ujian_online?m=".$msg."&a=".$alert));
			}
			
		}else{
			redirect(site_url("ujian_online"));
		}
	}
	
	function tampil()
	{
		//ambil parameter
		$get_id = $this->input->get("id");
		$dec_id = base64_decode($get_id);
		$id = explode("-",$dec_id);
		$judul_id = $id[1];
		
		//ambil siswa id dari session
		$siswa_id = $this->session->userdata("siswaId");
		
		//ambil data judul
		$qry_judul  = $this->mm->get_data_by_id("judul_id",$judul_id,"ujian_judul","judul");
		$judul_mode = $qry_judul->judul_mode;
        $judul_acak = $qry_judul->judul_acak;
		$judul_type = $qry_judul->judul_type;
		
		//ambil data soal
		$parameter = " AND uj_judul=".$judul_id." order by uj_soal asc";
		$query = $this->mm->get_all_data_by_param("v_ujian_detail", "uj_soal", "uj", $parameter);
		
		//convert data soal kedalam nilai string
		$list_soal = "";
		foreach ($query as $d) {
			$list_soal .= $d->uj_soal.",";
		}
		$list_id_soal=substr($list_soal,0,-1);

		//convert nilai string ke bentuk array
		$nomor = Array();
		$array_soal = explode(",",$list_id_soal);
		$no=0;
		foreach ($array_soal as $soal_nomor) 
		{
			$no=$no+1; 
			$i=$no-1;
			$nomor[$i] = $soal_nomor;
		}
		
		//untuk random nomor soal
		if($judul_mode==1){ shuffle($nomor); }
		
		$list_random	= "";
		foreach ($nomor as $number) 
		{ 
			$list_random .= $number.",";
		} 
		
		//hilangkan tanda koma terakhir
		$list_random_soal = substr($list_random, 0, -1);
		
		//pecahkan nomor soal 
		$array_soal = explode(",",$list_random_soal);
		foreach ($array_soal as $soal_id) 
		{
			$param = "uj_judul=".$judul_id." AND uj_soal=".$soal_id." AND uj_siswa=".$siswa_id;
			$qry_cek = $this->mm->check_duplicate("ujian_random", "uj", $param);
			$cek_soal = $qry_cek->jml;
			if($cek_soal==0){
				$this->mm->insert_soal_random($judul_id,$soal_id,$siswa_id);
			}
		}
	
		$token1 = "bismillah@edukasi#ri32".date('Y-m-d H:i:s');
		$token2 = "alhamdulillah@edukasi#ri32".date('Y-m-d H:i:s');
		
		$random = rand();
		$mkrip  = base64_encode($random."-".$token1);
		$skrip  = base64_encode($random."-".$token2);

        //untuk type tampil soal
		if($judul_type==1){
			redirect(site_url("ujian_soal_one?m=".$mkrip."&id=".$get_id."&pg=1&s=".$skrip));
		}else{
			redirect(site_url("ujian_soal_all?m=".$mkrip."&id=".$get_id."&pg=1&s=".$skrip));
		}
	}
	
	function hasil()
	{
		//ambil judul ujian
		$jd = $this->input->get("jd");
		$jd_decrypt = base64_decode("$jd");
		$judul = explode("-",$jd_decrypt);
		$jawab_judul = $judul[1];
		
		//ambil id siswa di session
		$jawab_kode  = $this->session->userdata("siswaId");

		//jika parameter kosong
		if(!empty($jawab_kode) && !empty($jawab_judul)){
			
			//untuk menampilkan hasil ujian siswa
			$parameter = "'".$jawab_kode."' AND jawab_judul=".$jawab_judul." AND jawab_status='N'";
			$qry_jawab = $this->mm->get_data_by_id("jawab_kode",$parameter,"v_ujian_jawab","jawab");
			
			$jawab_submit = $qry_jawab->jawab_submit; 
			$array_jwb = explode(",",$jawab_submit);
			
			$rekap="";
			foreach ($array_jwb as $jwb) 
			{
				$string_jwb = explode(":",$jwb);
				$soal=$string_jwb[0];
				$jawab=$string_jwb[1];
				
				//cocokan jawaban user dengan jawaban di database
				$param = " soal_jawaban='".$jawab."' AND soal_id=".$soal;
				$query = $this->mm->check_duplicate("ujian_soal", "soal", $param);
				$cek = $query->jml;
				
				if($cek==1){
					//jika jawaban cocok (benar)
					$kunci= $soal.":".$jawab.":"."Benar".":"."<span class='badge bg-blue'>";
				}else{
					//jika salah & kosong
					if(empty($jawab)){
						$kunci= $soal.":".$jawab.":"."Kosong".":"."<span class='badge bg-yellow'>";
					}else{
						$kunci= $soal.":".$jawab.":"."Salah".":"."<span class='badge bg-red'>";
					}
				}
				
				$rekap .= $kunci.",";
			}
		
			$data["nama"] = $qry_jawab->siswa_nama;
			$data["nis"]  = $qry_jawab->siswa_nis;
			$data["bds"]  = $qry_jawab->bds_ket;
			
			$data["jawab_kode"]   = $jawab_kode;
			$data["jawab_judul"]  = $jawab_judul;
			$data["rekap"]   = substr($rekap, 0, -1);;
			$data["benar"]   = $qry_jawab->jawab_benar;
			$data["salah"]   = $qry_jawab->jawab_salah;
			$data["kosong"]  = $qry_jawab->jawab_kosong;
			$data["score"]   = $qry_jawab->jawab_nilai;
			$data["mulai"]   = $qry_jawab->jawab_tgl_mulai;
			$data["selesai"] = $qry_jawab->jawab_tgl_selesai;
			
			//ambil siswa id dari session
			$siswa_id = $this->session->userdata("siswaId");
		
			//hapus data di table ujian random
			$this->mm->delete_soal_random($siswa_id);
			
			$data["page"] = "view_ujian/form_siswa_hasil";
			$this->load->view('template/template', $data);

		}else{
			redirect(site_url("ujian_online"));
		}
	}
	
	function refresh_data()
	{
        $this->session->unset_userdata('session_parent_ujian');
		redirect(site_url("ujian_online"));
	}
	
	function tampil_data()
	{
		$this->session->unset_userdata('session_parent_ujian');
		
		$id = $this->input->get('id');
        $data = array('session_parent_ujian' => $id);
		$this->session->set_userdata($data);	
		
		redirect(site_url("ujian_online"));
	}
	
	function anti_xss($string)
	{
		$filter=stripslashes(strip_tags(htmlspecialchars(trim($string),ENT_QUOTES)));
		return $filter;
	}
	
	private function cek_login()
    {
        if( ! $this->session->userdata('isLoggedInUSR') OR $this->session->userdata('isLoggedInUSR') === FALSE)
        {
            redirect("auth");
        }
    }
}
