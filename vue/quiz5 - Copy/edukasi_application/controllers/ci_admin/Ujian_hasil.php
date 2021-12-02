<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Ujian_hasil extends CI_Controller
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
		
		$data["page"] = "view_admin/ujian_hasil/home";
        $data["title"] = "hasil ujian";
		$this->load->view('templates/template', $data);
	}
    
	function siswa_ujian_ajax()
	{
		$requestData= $_REQUEST;
		$columns = array(
			0 => '',
			1 => 'jawab_id',
			2 => 'siswa_nama',
			3 => 'siswa_nis',	
			4 => 'siswa_jenjang',				
			5 => 'bds_ket',
			6 => 'judul_type',
			7 => 'judul_keterangan',
			8 => 'jawab_nilai',
		    9 => '',
		   10 => 'jawab_tgl_mulai',
		   11 => 'jawab_tgl_selesai',
		   12 => 'jawab_device',
		);
	
		$order_by = $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir'];
		$offset = $requestData['start'];
		$limit = $requestData['length'];

		$fields="*";
		$parameter = "1=1";
		$res_tot = $this->mm->count_all_data("v_ujian_jawab", $parameter, "jawab", $limit, $offset, $fields);
		$tot_data = $res_tot->jml;

		if( !empty($requestData['search']['value']) )
		{			
			$where  = $parameter." AND (siswa_nama LIKE '%".$requestData['search']['value']."%'";
			$where .= " OR siswa_nis LIKE '%".$requestData['search']['value']."%'";
			$where .= " OR judul_keterangan LIKE '%".$requestData['search']['value']."%')";
			
			$res = $this->mm->get_search_data("v_ujian_jawab", $where, "jawab", $order_by, $limit, $offset, $fields);
			$res_filtered_tot = $this->mm->count_all_data("v_ujian_jawab", $where, "jawab", $limit, $offset, $fields);
			$tot_filtered = $res_filtered_tot->jml;
		}
		else
		{			
			$res = $this->mm->get_search_data("v_ujian_jawab", $parameter, "jawab", $order_by, $limit, $offset, $fields);
			$tot_filtered = $tot_data;
		}
		
		$data = array();if(!empty($res)){
		foreach($res as $row)
		{
			$random = rand();
			$delete = base64_encode($random."-delete");
			$edit = base64_encode($random."-edit");
			$id = base64_encode($random."-".$row->jawab_id);
			
			if($row->siswa_jenjang==1){ $jenjang="TK"; }
			if($row->siswa_jenjang==2){ $jenjang="SD"; }
			if($row->siswa_jenjang==3){ $jenjang="SMP"; }
			if($row->siswa_jenjang==4){ $jenjang="SMA"; }
			
			if($row->siswa_jurusan==1){ $jurusan="IPA"; }else{ $jurusan="IPS"; }
			
			$judul_type="<div class=\"uk-badge uk-badge-primary\"> TRYOUT</div>";
			$jumlah_soal = $row->jawab_benar + $row->jawab_salah + $row->jawab_kosong;
			
			$nestedData = array();
			$nestedData[] = "<a href='javascript:void(0)' oncontextmenu=\"klik_del_function('".$id."','".$delete."'); return false;\" onClick=klik_hapus('".$id."','".$delete."');  class='btn btn-sm btn-danger' title=\"Hapus Hasil Ujian\">Hapus</a>";		
			$nestedData[] = $row->jawab_id;
			$nestedData[] = "<a href='javascript:;'>".strtoupper($row->siswa_nama)."</a>";
			$nestedData[] = strtoupper($row->siswa_nis);
			$nestedData[] = strtoupper($jenjang)." / ".$row->siswa_kelas." ".$jurusan;
			$nestedData[] = strtoupper($row->bds_ket);
			$nestedData[] = $judul_type;
			
			if($jumlah_soal==0){
				$nestedData[] = "<font color='brown'>".strtoupper($row->judul_keterangan)." / ".$row->judul_waktu." Menit </font>";
			}else{
				$nestedData[] = "<font color='brown'>".strtoupper($row->judul_keterangan)." / ".$row->judul_waktu." Menit"." / ".$jumlah_soal." Soal"."</font>";
			}
	
			$nestedData[] = "<div class=\"uk-badge uk-badge-warning\">".$row->jawab_nilai."</div>";
			$nestedData[] = "<span class='label label-success'>B=".$row->jawab_benar."</span> <span class='label label-danger'>S=".$row->jawab_salah."</span> <span class='label label-warning'>K=".$row->jawab_kosong."</span>";
			$nestedData[] = $row->jawab_tgl_mulai;
			$nestedData[] = $row->jawab_tgl_selesai;
			$nestedData[] = strtoupper($row->jawab_device);
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
	
	function hapus()
	{
		$id = $this->input->get("id");
		$id_decrypt = base64_decode("$id");
		$id_jawab = explode("-",$id_decrypt);
		$jawabku = $id_jawab[1];
		
		$m = $this->input->get("m");
		$m_decrypt = base64_decode("$m");
		$method = explode("-",$m_decrypt);
		$mode = $method[1];
		
		if($id && $mode=== "delete")
		{
			$this->mm->delete_data("ujian_jawab","jawab", "jawab_id",$jawabku);
		
			$rand = rand();
			$msg = base64_encode($rand."-Data berhasil dihapus");
			$alert = base64_encode($rand."-success");
			redirect(site_url("ujian_hasil?m=".$msg."&a=".$alert));
		}else{
			redirect(site_url("ujian_hasil"));
		}
	}
	
	function anti_xss($string)
	{
		$filter=stripslashes(strip_tags(htmlspecialchars(trim($string),ENT_QUOTES)));
		return $filter;
	}
	
    private function cek_login()
    {
        if( ! $this->session->userdata('isLoggedInADM') OR $this->session->userdata('isLoggedInADM') === FALSE)
        {
            redirect("adm");
        }
    }
}
