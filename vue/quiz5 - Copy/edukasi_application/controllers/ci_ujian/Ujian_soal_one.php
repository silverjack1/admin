<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ujian_soal_one extends CI_Controller
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
		$id = $this->input->get("id");
		$id_decrypt = base64_decode($id);
		$judul = explode("-",$id_decrypt);
		$judul_id = $judul[1];
		
		//ambil id siswa di session
		$judul_kode = $this->session->userdata("siswaId");
		
		//untuk mengambil soal satu per satu
		$dataPerhalaman = 1;
		
		//apabila variable halaman sudah didefinisikan, gunakan nomor halaman tersebut
		$page=$this->input->get('pg');
		if(isset($page) && $page!="")
        {
			if(isset($page)){
				$nohalaman = $page;
			}else{ 
				$nohalaman = 1;
			}
		}else{
			redirect(site_url("auth/warning"));
		}

		//parameter query
		$parameter_1 = " uj_judul=".$judul_id." AND uj_siswa=".$judul_kode." AND uj";
		$parameter_2 = " uj_judul=".$judul_id." AND uj_siswa=".$judul_kode;
		
		//untuk menampilkan soal dengan teknik paging
		$offset  = ($nohalaman-1) * $dataPerhalaman;
		$query_0 = $this->mm->get_all_soal_siswa("v_ujian_random", "uj_id", $parameter_1, $dataPerhalaman, $offset);
		
		//untuk menampilkan jumlah soal
		$query_1 = $this->mm->get_all_data("v_ujian_random",$parameter_1,"uj_id","200","0");
		$query_2 = $this->mm->check_duplicate("v_ujian_random", "uj", $parameter_2);
		$jumlah  = $query_2->jml;
		
		$result  = $query_0;
		$jumData = $jumlah;
		
		//menentukan jumlah nomor halaman yang muncul berdasarkan jumlah semua data
		$jumhalaman = ceil($jumData/$dataPerhalaman);
		
		$data["result"]      = $result;
		$data["jumData"]     = $jumData;
		$data["jumhalaman"]  = $jumhalaman;
		$data["nohalaman"]   = $nohalaman;
		$data["offset"]      = $offset;
		
		$data["res_soal"]    = $query_1;
		$data["jumlah"]      = $jumlah;
		$data["judul_id"]    = $judul_id;
		$data["judul_kode"]  = $judul_kode;
		
		//menampilkan soal siswa dan soal jawab
		$list_id_soal	= "";
		$list_jw_soal 	= "";
		foreach ($query_1 as $d) {
			$list_id_soal .= $d->soal_id.",";
			$list_jw_soal .= $d->soal_id."::0,";
		}
		
		$list_id_soalku = substr($list_id_soal, 0, -1);
		$list_jw_soalku = substr($list_jw_soal, 0, -1);
		
		//cari info judul ujian
		$qry_judul   = $this->mm->get_data_by_id("judul_id",$judul_id,"v_ujian_judul","judul");
		if($qry_judul->jurusan_ket==""){
			$jurusan="";
		}else{
			$jurusan=" / ".$qry_judul->jurusan_ket;
		}
		
		$judul_bds     = $qry_judul->bds_ket." / ".strtoupper($qry_judul->judul_kelas)." ".strtoupper($qry_judul->jenjang_ket).$jurusan;
		$judul_waktu   = $qry_judul->judul_waktu;
		$judul_ket     = $qry_judul->judul_keterangan;
        $judul_acak    = $qry_judul->judul_acak;
		$judul_mode    = $qry_judul->judul_mode;
		$judul_type    = $qry_judul->judul_type;
		$judul_akses   = $qry_judul->judul_akses;
		$waktu_selesai = $this->tambah_jam_sql($judul_waktu);
		$jam = date("Y-m-d H:i:s");
		
		//device yang digunakan siswa untuk ujian
		$jawab_device = $this->session->userdata("userDevice");

		//insert nilai awal ujian
		$fields[] = "jawab_judul,";
		$fields[] = "jawab_kode,";
		$fields[] = "jawab_soal,";
		$fields[] = "jawab_submit,";
		
		$fields[] = "jawab_benar,";
		$fields[] = "jawab_salah,";
		$fields[] = "jawab_kosong,";
		$fields[] = "jawab_nilai,";
		
		$fields[] = "jawab_tgl_mulai,";
		$fields[] = "jawab_tgl_timer,";
		$fields[] = "jawab_status,";
		$fields[] = "jawab_device,";
		
		$fields[] = "jawab_is_delete,";
		$fields[] = "jawab_update_by,";
		$fields[] = "jawab_update_date";
		
		$datas[] = "".$this->anti_xss($judul_id).",";
		$datas[] = "'".$this->anti_xss($judul_kode)."',";
		$datas[] = "'".$this->anti_xss($list_id_soalku)."',";
		$datas[] = "'".$this->anti_xss($list_jw_soalku)."',";
		
		$datas[] = "".$this->anti_xss(0).",";
		$datas[] = "".$this->anti_xss(0).",";
		$datas[] = "".$this->anti_xss(0).",";
		$datas[] = "".$this->anti_xss(0).",";
		
		$datas[] = "'".$jam."',";
		$datas[] = "ADDTIME('".$jam."','".$waktu_selesai."'),";
		$datas[] = "'Y',";
		$datas[] = "'".$jawab_device."',";
		
		$datas[] = "0,";
		$datas[] = "1,";
		$datas[] = "'".date("Y-m-d H:i:s")."'";
		
		//jika sudah mulai, saat di refresh tidak insert kembali
		$cekdata="jawab_judul=".$judul_id." AND jawab_kode=".$judul_kode." AND jawab_is_delete=0";
		$cek_jawab=$this->mm->check_duplicate("ujian_jawab","jawab",$cekdata);
		if($cek_jawab->jml==0){
			$insert_data = $this->mm->insert_data("ujian_jawab", $fields, $datas);
		}
		
		//jika user yang sudah selesai menjawab ingin kembali ke halamn soal. pakai teknik flag status
		$cekdatas="jawab_judul=".$judul_id." AND jawab_kode=".$judul_kode." AND jawab_status='Y'";
		$cek_valid=$this->mm->check_duplicate("ujian_jawab","jawab",$cekdatas);
		$cek_result=$cek_valid->jml;
		if($cek_result==0){
			redirect(site_url("ujian_online"));
		}

		//jika tidak ada akses, maka redirect ke halaman ujian
		if($judul_akses!=1){
			redirect(site_url("ujian_online"));
		}

        //jika bukan type satuan, maka redirect ke type semua
		if($judul_type!=1){
			redirect(site_url("ujian_soal_all?m=".$mkrip."&id=".$get_id."&s=".$skrip));
		}
		
		//untuk mencari waktu timer
		$parameter = "'".$judul_kode."' AND jawab_judul=".$judul_id." AND jawab_status='Y'";
		$qry_jawab = $this->mm->get_data_by_id("jawab_kode",$parameter,"ujian_jawab","jawab");
		$jawab_mulai = $qry_jawab->jawab_tgl_mulai;
		$jawab_timer = $qry_jawab->jawab_tgl_timer;
		$jawab_submit = $qry_jawab->jawab_submit;
		
		//untuk menandai jawaban soal
		if(!empty($result)){
			foreach($result as $row)
			{
				$cari_soal_id=$row->soal_id;
			}
		}else{
			redirect(site_url("adm/warning"));
		}
		
		$dijawab="";
		$ditandai="";
		$array_jwb = explode(",",$jawab_submit);
		foreach ($array_jwb as $jwb) 
		{
			$string_jwb = explode(":",$jwb);
			$soal=$string_jwb[0];
			$jawab=$string_jwb[1];
			$tandai=$string_jwb[2];
			
			if($soal==$cari_soal_id){
				$dijawab  .= $jawab;
				$ditandai .= $tandai;
			}
		}
		
		$data["dijawab"]      = $dijawab;
		$data["ditandai"]     = $ditandai;
		$data["judul_bds"]    = $judul_bds;
		$data["judul_ket"]    = $judul_ket;
        $data["judul_acak"]   = $judul_acak;
		$data["judul_waktu"]  = $judul_waktu;
		$data["jawab_mulai"]  = $jawab_mulai;
		$data["jawab_timer"]  = $jawab_timer;
        $data["jawab_submit"] = $jawab_submit;

		$data["page"] = "view_ujian/form_siswa_soal_one";
		$this->load->view('template/template', $data);
    }
	
	function tambah_jam_sql($menit) 
    {
		$str = "";
		if ($menit < 60) {
			$str = "00:".str_pad($menit, 2, "0", STR_PAD_LEFT).":00";
		} else if ($menit >= 60) {
			$mod = $menit % 60;
			$bg = floor($menit / 60);
			$str = str_pad($bg, 2, "0", STR_PAD_LEFT).":".str_pad($mod, 2, "0", STR_PAD_LEFT).":00";
		}
		return $str;
	}
	
	//untuk memproses jawaban per soal
	function submit()
	{
		$submit = $this->input->post('submit');
		if(isset($submit)){
			$id = $this->input->get('id');
			$pg = $this->input->get('pg');

			$judul_id=$this->input->post("judul_id");
			$judul_kode=$this->input->post("judul_kode");
			$jumlah=$this->input->post("jumlah");
			$soal_no=$this->input->post("soal_no");
			$soal_id=$this->input->post("soal_id");
			$pilihan=$this->input->post("pilihan");
			$cek_kembali=$this->input->post("cek_kembali");
			
			//tampilkan array jawaban siswa
			$parameter = "'".$judul_kode."' AND jawab_judul=".$judul_id." AND jawab_status='Y'";
			$qry_jawab = $this->mm->get_data_by_id("jawab_kode",$parameter,"ujian_jawab","jawab");
			$jawab_submit = $qry_jawab->jawab_submit;
			
			$array_jwb = explode(",",$jawab_submit);
			$update = "";
			foreach ($array_jwb as $jwb) 
			{
				$string_jwb = explode(":",$jwb);
				$soal=$string_jwb[0];
				$jawab=$string_jwb[1];
				$cek_lagi=$string_jwb[2];
				
				if($soal==$soal_id){
					$jawabanku = $soal.":".$pilihan.":".$cek_kembali;
				}else{
					$jawabanku = $soal.":".$jawab.":".$cek_lagi;
				}
				
				$update .= $jawabanku.",";
			}
			
			$update = substr($update, 0, -1);
			$datum["jawab_submit"] = "'".$update."'";
			$param_qry = $judul_id." AND jawab_kode='".$judul_kode."' AND jawab_status='Y'";
			$update_jawaban = $this->mm->update_data("ujian_jawab", "jawab_judul", $param_qry, $datum);
			
			//jika ini nomor terakhir dari semua soal
			if($jumlah==$soal_no){
				
				//tampilkan array jawaban siswa
				$parameter = "'".$judul_kode."' AND jawab_judul=".$judul_id." AND jawab_status='Y'";
				$qry_jawab = $this->mm->get_data_by_id("jawab_kode",$parameter,"ujian_jawab","jawab");
				$jawab_submit = $qry_jawab->jawab_submit;
				
				$score=0;
				$benar=0;
				$salah=0;
				$kosong=0;

				$array_jwb = explode(",",$jawab_submit);
				foreach ($array_jwb as $jwb) 
				{
					$string_jwb = explode(":",$jwb);
					$soal=$string_jwb[0];
					$jawab=$string_jwb[1];

					//jika user tidak memilih jawaban
					if (empty($jawab)){
						$kosong++;
					}
					
					//cocokan jawaban user dengan jawaban di database
					$param = " soal_jawaban='".$jawab."' AND soal_id=".$soal;
					$query = $this->mm->check_duplicate("ujian_soal", "soal", $param);
					$cek = $query->jml;
					
					if($cek==1){
						//jika jawaban cocok (benar)
						$benar++;
					}else{
						//jika salah
						$salah++;
					}
				}
				
				$nilaiku = ($benar/$jumlah)*100;
				$score = $nilaiku;
				$salahku = $salah-$kosong;
				
				$datas["jawab_benar"]        = "".$benar.",";
				$datas["jawab_salah"]        = "".$salahku.",";
				$datas["jawab_kosong"]       = "".$kosong.",";
				$datas["jawab_nilai"]        = "".$score.",";
				
				$datas["jawab_tgl_selesai"]  = "'".date("Y-m-d H:i:s")."',";
				$datas["jawab_status"]       = "'N',";
				$datas["jawab_update_by"]    = "1,";
				$datas["jawab_update_date"]  = "'".date("Y-m-d H:i:s")."'";
				
				$param_update = $judul_id." AND jawab_kode='".$judul_kode."' AND jawab_status='Y'";
				$update_data = $this->mm->update_data("ujian_jawab", "jawab_judul", $param_update, $datas);
				
				redirect(site_url("ujian_online/hasil?jd=".$id));	
				
			}else{
				$token1 = "bismillah@edukasi#ri32".date('Y-m-d H:i:s');
				$token2 = "alhamdulillah@edukasi#ri32".date('Y-m-d H:i:s');
				
				$random = rand();
				$mkrip  = base64_encode($random."-".$token1);
				$skrip  = base64_encode($random."-".$token2);
				
				redirect(site_url("ujian_soal_one?m=".$mkrip."&id=".$id."&pg=".$pg."&s=".$skrip));
			}
		
		}else{
			$this->session->sess_destroy();
			redirect("auth");
		}
	}
	
	//untuk memproses jawaban jika waktunya habis
	function finish()
    {
		$id = $this->input->get('id');
		$id_decrypt = base64_decode($id);
		$judul = explode("-",$id_decrypt);
		$judul_id = $judul[1];
	
		//ambil id siswa di session
		$judul_kode = $this->session->userdata("siswaId");
		
		//tampilkan array jawaban siswa
		$parameter = "'".$judul_kode."' AND jawab_judul=".$judul_id." AND jawab_status='Y'";
		$qry_jawab = $this->mm->get_data_by_id("jawab_kode",$parameter,"ujian_jawab","jawab");
		$jawab_submit = $qry_jawab->jawab_submit;
		
		$score=0;
		$benar=0;
		$salah=0;
		$kosong=0;

		$array_jwb = explode(",",$jawab_submit);
		foreach ($array_jwb as $jwb) 
		{
			$string_jwb = explode(":",$jwb);
			$soal=$string_jwb[0];
			$jawab=$string_jwb[1];
			
			//jika user tidak memilih jawaban
			if (empty($jawab)){
				$kosong++;
			}
			
			//cocokan jawaban user dengan jawaban di database
			$param = " soal_jawaban='".$jawab."' AND soal_id=".$soal;
			$query = $this->mm->check_duplicate("ujian_soal", "soal", $param);
			$cek = $query->jml;
			
			if($cek==1){
				//jika jawaban cocok (benar)
				$benar++;
			}else{
				//jika salah
				$salah++;
			}
		}

		$jumlah  = $benar+$salah+$kosong;
		$nilaiku = ($benar/$jumlah)*100;
		$score   = $nilaiku;
		$salahku = $salah-$kosong;
		
		$datas["jawab_benar"]        = "".$benar.",";
		$datas["jawab_salah"]        = "".$salahku.",";
		$datas["jawab_kosong"]       = "".$kosong.",";
		$datas["jawab_nilai"]        = "".$score.",";
		
		$datas["jawab_tgl_selesai"]  = "'".date("Y-m-d H:i:s")."',";
		$datas["jawab_status"]       = "'N',";
		$datas["jawab_update_by"]    = "1,";
		$datas["jawab_update_date"]  = "'".date("Y-m-d H:i:s")."'";
		
		$param_update = $judul_id." AND jawab_kode='".$judul_kode."' AND jawab_status='Y'";
		$update_data = $this->mm->update_data("ujian_jawab", "jawab_judul", $param_update, $datas);
		
		redirect(site_url("ujian_online/hasil?jd=".$id));	
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
