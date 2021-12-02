<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ujian_soal_all extends CI_Controller
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
		//ambil parameter tambahan
		$mkrip = $this->input->get("m");
		$skrip = $this->input->get("s");
		
		//ambil parameter judul
		$get_id = $this->input->get("id");
		$id_decrypt = base64_decode($get_id);
		$judul = explode("-",$id_decrypt);
		$judul_id = $judul[1];
		
		//ambil siswa id dari session
		$siswa_id = $this->session->userdata("siswaId");
		
		//ambil data soal 
		$parameter_1 = " uj_judul=".$judul_id." AND uj_siswa=".$siswa_id." AND uj";
		$query_1 = $this->mm->get_all_data("v_ujian_random",$parameter_1,"uj_id","200","0");
        $data["res_soal"] = $query_1;

        //ambil jumlah soal
        $parameter_2 = " uj_judul=".$judul_id." AND uj_siswa=".$siswa_id;
		$query_2 = $this->mm->check_duplicate("v_ujian_random", "uj", $parameter_2);
		$data["jumlah"] = $query_2->jml;
		$data["judul_id"] = $judul_id;
		$data["judul_kode"] = $siswa_id;
		$data["judul_mulai"] = "'".date("Y-m-d H:i:s")."'";
		
		//menampilkan soal siswa dan soal jawab
		$list_id_soal = "";
		$list_jw_soal = "";
		foreach ($query_1 as $d) {
			$list_id_soal .= $d->soal_id.",";
			$list_jw_soal .= $d->soal_id."::0,";
		}
		$list_id_soalku = substr($list_id_soal, 0, -1);
		$list_jw_soalku = substr($list_jw_soal, 0, -1);
		
		//cari info judul ujian
		$qry_judul   = $this->mm->get_data_by_id("judul_id",$judul_id,"ujian_judul","judul");
		$judul_waktu = $qry_judul->judul_waktu;
		$judul_mode  = $qry_judul->judul_mode;
        $judul_acak  = $qry_judul->judul_acak;
		$judul_type  = $qry_judul->judul_type;
		$judul_akses = $qry_judul->judul_akses;
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
		$datas[] = "'".$this->anti_xss($siswa_id)."',";
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
		$cekdata="jawab_judul=".$judul_id." AND jawab_kode=".$siswa_id." AND jawab_is_delete=0";
		$cek_jawab=$this->mm->check_duplicate("ujian_jawab","jawab",$cekdata);
		if($cek_jawab->jml==0){
			$insert_data = $this->mm->insert_data("ujian_jawab", $fields, $datas);
		}
		
		//jika user yang sudah selesai menjawab ingin kembali ke halamn soal. pakai teknik flag status
		$cekdatas="jawab_judul=".$judul_id." AND jawab_kode=".$siswa_id." AND jawab_status='Y'";
		$cek_valid=$this->mm->check_duplicate("ujian_jawab","jawab",$cekdatas);
		$result=$cek_valid->jml;
		if($result==0){
			redirect(site_url("ujian_online"));
		}
		
		//jika tidak ada akses, maka redirect ke halaman ujian
		if($judul_akses!=1){
			redirect(site_url("ujian_online"));
		}

        //jika bukan type all, maka redirect ke type satuan
		if($judul_type!=2){
			redirect(site_url("ujian_soal_one?m=".$mkrip."&id=".$get_id."&s=".$skrip));
		}
		
		//untuk mencari waktu timer
		$parameter = "'".$siswa_id."' AND jawab_judul=".$judul_id." AND jawab_status='Y'";
		$qry_jawab = $this->mm->get_data_by_id("jawab_kode",$parameter,"ujian_jawab","jawab");
		$jawab_timer = $qry_jawab->jawab_tgl_timer;
		
		$data["jawab_timer"] = $jawab_timer;
        $data["judul_acak"]  = $judul_acak;
		$data["page"] = "view_ujian/form_siswa_soal_all";
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
	
	function submit()
	{
		$submit = $this->input->post('submit');
		if(isset($submit)){

			//data pendukung
			$judul_id=$this->input->post("judul_id");
			$jumlah=$this->input->post("jumlah");

            //ambil siswa id dari session
		    $siswa_id = $this->session->userdata("siswaId");
			
			//data array
			$soal_id=$this->input->post("id");
			$pilihan=$this->input->post("pilihan");
			
			//data enkripsi
			$random = rand();
			$ejudul = base64_encode($random."-".$judul_id);
				
			$score=0;
			$benar=0;
			$salah=0;
			$kosong=0;

			$dijawab="";
			for ($i=0;$i<$jumlah;$i++)
            {
				//id nomor soal
				$nomor=$soal_id[$i];
				
				//jika user tidak memilih jawaban
				if (empty($pilihan[$nomor])){
					$kosong++;
				}

				//jika jawaban tidak ada
				if(!empty($pilihan[$soal_id[$i]])){
					$jawabanku=$pilihan[$soal_id[$i]];
				}else{
					$jawabanku="";
				}
				
				//cocokan jawaban user dengan jawaban di database
				$parameter = " soal_jawaban='".$jawabanku."' AND soal_id=".$nomor;
				$query = $this->mm->check_duplicate("ujian_soal", "soal", $parameter);
				$cek = $query->jml;
				
				if($cek==1){
					//jika jawaban cocok (benar)
					$benar++;
				}else{
					//jika salah
					$salah++;
				}
				
				//update jawaban soal
				if(!empty($pilihan[$nomor])){
					$jawabansoal=$pilihan[$nomor];
				}else{
					$jawabansoal="";
				}
				
				$dijawab .= $nomor.":".$jawabansoal.",";
			}
			
			$nilaiku = ($benar/$jumlah)*100;
			$score = $nilaiku;
			$salahku = $salah-$kosong;

		}else{
			$this->session->sess_destroy();
			redirect("auth");
		}

		$list_jwb_soal = substr($dijawab, 0, -1);
		
		$datas["jawab_benar"]  = "".$benar.",";
		$datas["jawab_salah"]  = "".$salahku.",";
		$datas["jawab_kosong"] = "".$kosong.",";
		$datas["jawab_nilai"]  = "".$score.",";
		$datas["jawab_submit"] = "'".$list_jwb_soal."',";
		
		$datas["jawab_tgl_selesai"] = "'".date("Y-m-d H:i:s")."',";
		$datas["jawab_status"] = "'N',";
		$datas["jawab_update_by"] = "1,";
		$datas["jawab_update_date"] = "'".date("Y-m-d H:i:s")."'";
		
		$param_update = $judul_id." AND jawab_kode='".$siswa_id."' AND jawab_status='Y'";
		$update_data = $this->mm->update_data("ujian_jawab", "jawab_judul", $param_update, $datas);
		
        redirect(site_url("ujian_online/hasil?jd=".$ejudul));
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
