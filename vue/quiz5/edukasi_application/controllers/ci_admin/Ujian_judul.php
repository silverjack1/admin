<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Ujian_judul extends CI_Controller
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
				redirect(site_url("adm/warning"));
			}
		}
		
		$data["page"] = "view_admin/ujian_judul/home";
        $data["title"] = "kegiatan ujian";
		$this->load->view('templates/template', $data);
	}
	
	function ujian_ajax()
	{
		$requestData= $_REQUEST;
		
		$columns = array( 
			0 => '',
			1 => 'judul_id', 
			2 => 'judul_keterangan',
			3 => 'judul_parent_ket',
			4 => 'judul_tgl_mulai',
            5 => 'judul_studi',
            6 => 'judul_akses',
			7 => 'judul_type',
			8 => 'judul_mode',
            9 => 'judul_acak',
		   10 => '',
		   11 => 'judul_waktu',
		   12 => 'judul_tahun',
		   13 => 'judul_tingkat',
		   14 => 'judul_kelas'
		);
		
		$res_tot = $this->mm->count_all_data("v_ujian_judul", NULL, "judul");
		$tot_data = $res_tot->jml;

		$order_by = $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir'];
		$offset = $requestData['start'];
		$limit = $requestData['length'];

		if( !empty($requestData['search']['value']) )
		{
			$where = "(judul_keterangan LIKE '%".$requestData['search']['value']."%')";
			$res = $this->mm->get_search_data("v_ujian_judul", $where, "judul", $order_by, $limit, $offset);
			
			$res_filtered_tot = $this->mm->count_all_data("v_ujian_judul", $where, "judul");
			$tot_filtered = $res_filtered_tot->jml;
		}
		else
		{
			$res = $this->mm->get_all_data("v_ujian_judul", "judul", $order_by, $limit, $offset);
			$tot_filtered = $tot_data;
		}
		
		$data = array();if(!empty($res)){
		foreach($res as $row)
		{
			$random = rand();
			$id = base64_encode($random."-".$row->judul_id);
			$edit = base64_encode($random."-edit");
			$delete = base64_encode($random."-delete");
			
			if($row->jurusan_ket==""){
				$jurusan="";
			}else{
				$jurusan=" / ".$row->jurusan_ket;
			}
			
			if($row->judul_tgl_selesai=="0000-00-00"){
				$tanggal_ujian=$row->judul_tgl_mulai;
			}else{
				$tanggal_ujian=$row->judul_tgl_mulai." s/d ".$row->judul_tgl_selesai;
			}
			
			if($row->judul_akses==1){
				$judul_akses="<span class='label label-primary'>DIBUKA</span>";
			}else{
				$judul_akses="<span class='label label-warning'>DITUTUP</span>";
			}
			
			if($row->judul_type==1){
				$judul_type="SATUAN";
			}else{
				$judul_type="SEMUA";
			}
			
			if($row->judul_mode==1){
				$judul_mode="YA";
			}else{
				$judul_mode="TIDAK";
			}

            if($row->judul_acak==1){
				$judul_acak="YA";
			}else{
				$judul_acak="TIDAK";
			}
			
			$cekdata="uj_judul=".$row->judul_id."";
			$cek_soal=$this->mm->check_duplicate("ujian_detail","uj",$cekdata);
			$jumlah=$cek_soal->jml;
			
			$nestedData = array();
			$nestedData[] = "
			<a href='javascript:void(0)' oncontextmenu=\"soalklik_function('".$edit."','".$id."');  return false;\" onClick=soal_function('".$edit."','".$id."');  class='btn btn-sm btn-success' title=\"View\">SOAL</a>
			<a href='javascript:void(0)' oncontextmenu=\"editklik_function('".$edit."','".$id."');  return false;\" onClick=edit_function('".$edit."','".$id."');  class='btn btn-sm btn-info' title=\"Edit\"><i class='fa fa-check'></i></a>
			<a href='javascript:void(0)' oncontextmenu=\"delklik_function('".$delete."','".$id."'); return false;\" onClick=del_function('".$delete."','".$id."'); class='btn btn-sm btn-danger' title=\"Delete\"><i class='fa fa-trash'></i></a>
			";
			$nestedData[] = $row->judul_id;
			$nestedData[] = ucwords($row->judul_keterangan);
			$nestedData[] = "<a href='javascript:;'>".ucwords($row->judul_parent_ket)."</a>";
			$nestedData[] = $tanggal_ujian;
            $nestedData[] = "<font color='blues'>".strtoupper($row->bds_ket)."</font>";
            $nestedData[] = $judul_akses;
			$nestedData[] = $judul_type;
			$nestedData[] = $judul_mode;
            $nestedData[] = $judul_acak;
			$nestedData[] = "<div class='uk-badge uk-badge-danger'>".$jumlah." Soal</div>";
			$nestedData[] = strtoupper($row->judul_waktu)." Menit";
			$nestedData[] = strtoupper($row->ta_tahun1." / ".$row->ta_tahun2);
			
			$nestedData[] = strtoupper($row->jenjang_ket.$jurusan);
			$nestedData[] = strtoupper($row->judul_kelas);
			
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
	
	function pilih_soal_ajax()
	{
		$requestData= $_REQUEST;
		$columns = array( 
			0 => 'soal_id', 
			1 => '',
			2 => '',
			3 => '',
			4 => '',
			5 => '',
			6 => ''
		);
		
		$tingkat = $this->input->get("tk");
		$kelas   = $this->input->get("kl");
		$jurusan = $this->input->get("jr");
		$tahun   = $this->input->get("th");
		$studi   = $this->input->get("st");
		
		if($tingkat==""){
			$tingkatku=" 1=1 AND ";
		}else{
			$tingkatku=" soal_tingkat=".$tingkat." AND ";
		}
		
		if($kelas==""){
			$kelasku=" 1=1 AND";
		}else{
			$kelasku=" soal_kelas=".$kelas." AND ";
		}
		
		if($jurusan==""){
			$jurusanku=" 1=1 AND ";
		}else{
			$jurusanku=" (soal_jurusan=".$jurusan." OR soal_jurusan=0) AND ";
		}
		
		if($tahun==""){
			$tahunku=" 1=1 AND ";
		}else{
			$tahunku=" soal_tahun=".$tahun." AND ";
		}
		
		if($studi==""){
			$studiku=" 1=1 AND ";
		}else{
			$studiku=" soal_studi=".$studi." AND ";
		}
		
		$parameter=$tingkatku.$kelasku.$tahunku.$studiku.$jurusanku." soal";
		$res_tot = $this->mm->count_all_data("v_ujian_soal", NULL, $parameter);
		$tot_data = $res_tot->jml;

		$order_by = $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir'];
		$offset = $requestData['start'];
		$limit = $requestData['length'];

		if( !empty($requestData['search']['value']) )
		{
			$where = "(soal_pertanyaan LIKE '%".$requestData['search']['value']."%')";
			$res = $this->mm->get_search_data("v_ujian_soal", $where, $parameter, $order_by, $limit, $offset);
			
			$res_filtered_tot = $this->mm->count_all_data("v_ujian_soal", $where, $parameter);
			$tot_filtered = $res_filtered_tot->jml;
		}
		else
		{
			$res = $this->mm->get_all_soal_admin("v_ujian_soal", $parameter, $order_by, $limit, $offset);
			$tot_filtered = $tot_data;
		}
		
		$jd = $this->input->get("ejd");
		$jd_decrypt = base64_decode("$jd");
		$judul = explode("-",$jd_decrypt);
		$judul_id=$judul[1];
		
		$data = array();if(!empty($res)){
		foreach($res as $row)
		{
			$random = rand();
			$soal_id=$row->soal_id;
			$id = base64_encode($random."-".$soal_id);
			$edit = base64_encode($random."-edit");
			$delete = base64_encode($random."-delete");

			if($row->jurusan_ket==""){
				$jurusan="";
			}else{
				$jurusan=" / ".$row->jurusan_ket;
			}
			
			$pertanyaan = $row->soal_pertanyaan;
			$jml = strlen($pertanyaan);
			if($jml>70){
				$soal_tanya = substr($pertanyaan,0,60)."...";
			}else{
				$soal_tanya = $pertanyaan;
			}
			
			if(!empty($row->soal_lampiran)){
				$url = base_url("assets/fileuser/lampiran_soal/".$row->soal_lampiran);
				$lamprianku="<a href=".$url." target='_blank' title='Klik untuk melihat lampiran'><div class=\"uk-badge uk-badge-warning\">Yes</div></a>";
			}else{
				$lamprianku="<div class=\"uk-badge uk-badge-danger\">No</div>";
			}
			
			$cekdata="uj_judul=".$judul_id." AND uj_soal=".$soal_id."";
			$cek_soal=$this->mm->check_duplicate("ujian_detail","uj",$cekdata);
			if($cek_soal->jml === "0")
			{
				$soalAction="";
			}else{
				$soalAction="disabled";
			}
			
			$nestedData = array();
			$nestedData[] = $soal_id;
			$nestedData[] = $soal_tanya;
			$nestedData[] = "<center>".strtoupper($row->soal_jawaban)."</center>";
			$nestedData[] = "<font class='uk-text-danger'>".strtoupper($row->ta_tahun1." / ".$row->ta_tahun2)."</font>";
			$nestedData[] = "<font class='uk-text-danger'>".strtoupper($row->bds_ket)."</font>";
			$nestedData[] = "<font class='uk-text-danger'>".strtoupper($row->jenjang_ket.$jurusan)."</font>";
			$nestedData[] = "<font class='uk-text-danger'>"."</center>".strtoupper($row->soal_kelas)."</center>"."</font>";
			$nestedData[] = "
			<a href='javascript:void(0)' oncontextmenu=\"viewklik_function('".$edit."','".$id."'); return false;\" onClick=view_function('".$edit."','".$id."'); class='btn btn-sm btn-info' title=\"Lihat Soal\">SOAL</a>
			<a href='javascript:void(0)' ".$soalAction." oncontextmenu=\"addklik_function('".$edit."','".$id."'); return false;\" onClick=add_function('".$edit."','".$id."');  class='btn btn-sm btn-success' title=\"Pilih Soal\">PILIH</a>
			";
			
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
	
	function list_soal_ajax()
	{
		$requestData= $_REQUEST;
		$columns = array( 
			0 => 'soal_id', 
			1 => '',
			2 => '',
			3 => '',
			4 => '',
			5 => '',
            6 => ''
		);
		
		$jd = $this->input->get("ejd");
		$jd_decrypt = base64_decode("$jd");
		$judul = explode("-",$jd_decrypt);
		$judul_id=$judul[1];
		
		$parameter="judul_id=".$judul_id." AND uj_is_delete=0 AND ";
		$res_tot = $this->mm->count_all_data("v_ujian_detail", NULL, $parameter."soal");
		$tot_data = $res_tot->jml;

		$order_by = $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir'];
		$offset = $requestData['start'];
		$limit = $requestData['length'];

		if( !empty($requestData['search']['value']) )
		{
			$where = $parameter."(soal_pertanyaan LIKE '%".$requestData['search']['value']."%')";
			$res = $this->mm->get_search_data("v_ujian_detail", $where, "soal", $order_by, $limit, $offset);
			
			$res_filtered_tot = $this->mm->count_all_data("v_ujian_detail", $where, "soal");
			$tot_filtered = $res_filtered_tot->jml;
		}
		else
		{
			$res = $this->mm->get_all_data("v_ujian_detail", $parameter."soal", $order_by, $limit, $offset);
			$tot_filtered = $tot_data;
		}
		
		$data = array();if(!empty($res)){
		foreach($res as $row)
		{
			$random = rand();
			$id = base64_encode($random."-".$row->uj_id);
			$soal = base64_encode($random."-".$row->soal_id);
			$edit = base64_encode($random."-edit");
			$delete = base64_encode($random."-delete");
			$lampiran=base64_encode($random."-".$row->soal_lampiran);
			
			if($row->jurusan_ket==""){
				$jurusan="";
			}else{
				$jurusan=" / ".$row->jurusan_ket;
			}
			
			$pertanyaan = $row->soal_pertanyaan;
			$jml = strlen($pertanyaan);
			if($jml>70){
				$soal_tanya = substr($pertanyaan,0,70)."...";
			}else{
				$soal_tanya = $pertanyaan;
			}
			
			$nestedData = array();
			$nestedData[] = $offset=$offset+1;
			$nestedData[] = $soal_tanya;
			$nestedData[] = "<center>".strtoupper($row->soal_jawaban)."</center>";
			$nestedData[] = "<font class='uk-text-danger'>".strtoupper($row->ta_tahun1." / ".$row->ta_tahun2)."</font>";
			$nestedData[] = "<font class='uk-text-danger'>".strtoupper($row->bds_ket)."</font>";
			$nestedData[] = "<font class='uk-text-danger'>".strtoupper($row->jenjang_ket.$jurusan)."</font>";
			$nestedData[] = "<font class='uk-text-danger'>"."</center>".strtoupper($row->soal_kelas)."</center>"."</font>";
			$nestedData[] = "
			<a href='javascript:void(0)' oncontextmenu=\"viewklik_function('".$edit."','".$soal."'); return false;\" onClick=view_function('".$edit."','".$soal."'); class='btn btn-sm btn-info' title=\"Lihat Soal\">SOAL</a> 
			<a href='javascript:void(0)' oncontextmenu=\"delklik_function('".$delete."','".$id."'); return false;\" onClick=delete_function('".$delete."','".$id."');  class='btn btn-sm btn-danger' title=\"Batal Soal\">BATAL</a>
			";
			
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
	
	function form_pilih()
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
		
		$id = $this->input->get("id");
		$id_decrypt = base64_decode("$id");
		$judul = explode("-",$id_decrypt);
		$id_judul = $judul[1];
			
		$data["qry_judul"] = $this->mm->get_data_by_id("judul_id",$id_judul,"v_ujian_judul","judul");
		$data["res_ta"]=$this->mm->get_all_data("m_tahun_ajaran","ta","ta_id","100","0");
		$data["qry_jenjang"] = $this->mm->get_all_data("m_jenjang","jenjang","jenjang_id","100","0");
		
		$data["page"] = "view_admin/ujian_judul/form_pilih";
		$data["title"] = "pilih soal ujian";
		$this->load->view('templates/template', $data);
	}

	function form()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('opt_studi', 'Bidang Studi', 'required');
		
		if ($this->form_validation->run() === FALSE)
		{
			$m = $this->input->get("m");
			$m_decrypt = base64_decode("$m");
			$method = explode("-",$m_decrypt);
			$mode_ket = $method[1];
		
			if($mode_ket === "edit")
			{
				$id = $this->input->get("id");
				$id_decrypt = base64_decode("$id");
				$judul = explode("-",$id_decrypt);
				$id_judul = $judul[1];

				$data["qry_judul"] = $this->mm->get_data_by_id("judul_id",$id_judul,"ujian_judul","judul");
			}
			
			$data["res_ta"] = $this->mm->get_all_data("m_tahun_ajaran","ta","ta_id","100","0");
			$data["qry_jenjang"] = $this->mm->get_all_data("m_jenjang","jenjang","jenjang_id","100","0");
			$data["qry_parent"]  = $this->mm->get_all_data("ujian_judul","judul","judul_id","100","0");
			
			$data["page"] = "view_admin/ujian_judul/form";
			$data["title"] = "kegiatan ujian";
			$this->load->view('templates/template', $data);
		}
		else
		{
			if($this->input->post("btn_simpan") === "btn_simpan")
			{
				$user_id = $this->session->userdata("adminId");
				
				$field[] = "judul_parent,";
				$field[] = "judul_tingkat,";
				$field[] = "judul_kelas,";
				$field[] = "judul_akses,";
				$field[] = "judul_type,";
				$field[] = "judul_mode,";
                $field[] = "judul_acak,";
				$field[] = "judul_token,";
				$field[] = "judul_jurusan,";
				$field[] = "judul_tahun,";
				$field[] = "judul_studi,";
				$field[] = "judul_keterangan,";
				$field[] = "judul_waktu,";
				$field[] = "judul_tgl_mulai,";
				$field[] = "judul_tgl_selesai,";
				$field[] = "judul_jam_mulai,";
				$field[] = "judul_jam_selesai,";
				
				$field[] = "judul_is_delete,";
				$field[] = "judul_update_by,";
				$field[] = "judul_update_date";
				
				$data[] = "'".$this->input->post("opt_parent")."',";
				$data[] = "'".$this->input->post("opt_tingkat")."',";
				$data[] = "'".$this->input->post("opt_kelas")."',";
				$data[] = "'".$this->input->post("opt_judul_akses")."',";
				$data[] = "'1',";
				$data[] = "'2',";
                $data[] = "'2',";
				$data[] = "'0',";
				$data[] = "'".$this->input->post("opt_jurusan")."',";
				$data[] = "'".$this->input->post("opt_tahun")."',";
				$data[] = "'".$this->input->post("opt_studi")."',";
				$data[] = "'".$this->input->post("txt_keterangan")."',";
				$data[] = "'".$this->input->post("txt_waktu")."',";
				$data[] = "'".$this->input->post("txt_tgl_mulai")."',";
				$data[] = "'".$this->input->post("txt_tgl_selesai")."',";
				$data[] = "'".$this->input->post("txt_jam_mulai")."',";
				$data[] = "'".$this->input->post("txt_jam_selesai")."',";
				
				$data[] = "0,";
				$data[] = "".$user_id.",";
				$data[] = "'".date("Y-m-d H:i:s")."'";
				
				$judul_ket=$this->input->post("txt_keterangan");
				$cekdata="judul_keterangan like '".$judul_ket."'";
				$cek_file = $this->mm->check_duplicate("ujian_judul", "judul" ,$cekdata);
				
				if($cek_file->jml === "0")
				{
					$insert_data = $this->mm->insert_data("ujian_judul", $field, $data);
					if($insert_data === 1)
					{
						$rand = rand();
						$msg = base64_encode($rand."-Data berhasil ditambah");
						$alert = base64_encode($rand."-success");
						redirect(site_url("ujian_judul/index?m=".$msg."&a=".$alert));
					}
					else
					{
						$msg = base64_encode($rand."-Data tidak berhasil ditambah");
						$alert = base64_encode($rand."-danger");
						redirect(site_url("ujian_judul/index?m=".$msg."&a=".$alert));
					}
					
				}else{
					?>
					<script type="text/javascript">
					alert("Judul Ujian Sudah Ada!");
					window.history.back();
					</script>
					<?php
				}
				
			}
			elseif ($this->input->post("btn_simpan") === "btn_ubah")
			{	
				$user_id = $this->session->userdata("adminId");
				$judul_id = "'".$this->input->post("txt_judul_id")."'";

				$data["judul_tingkat"] = "'".$this->input->post("opt_tingkat")."',";
				$data["judul_kelas"]   = "'".$this->input->post("opt_kelas")."',";
				$data["judul_akses"]   = "'".$this->input->post("opt_judul_akses")."',";
				$data["judul_type"]    = "'1',";
				$data["judul_mode"]    = "'2',";
                $data["judul_acak"]    = "'2',";
				$data["judul_token"]   = "'0',";
				$data["judul_jurusan"] = "'".$this->input->post("opt_jurusan")."',";
				$data["judul_tahun"]   = "'".$this->input->post("opt_tahun")."',";
				$data["judul_studi"]   = "'".$this->input->post("opt_studi")."',";
				$data["judul_parent"]  = "'".$this->input->post("opt_parent")."',";
				$data["judul_keterangan"]  = "'".$this->input->post("txt_keterangan")."',";
				$data["judul_waktu"]   	   = "'".$this->input->post("txt_waktu")."',";
				$data["judul_tgl_mulai"]   = "'".$this->input->post("txt_tgl_mulai")."',";
				$data["judul_tgl_selesai"] = "'".$this->input->post("txt_tgl_selesai")."',";
				$data["judul_jam_mulai"]   = "'".$this->input->post("txt_jam_mulai")."',";
				$data["judul_jam_selesai"] = "'".$this->input->post("txt_jam_selesai")."',";
				$data["judul_update_by"]   = "".$user_id.",";
				$data["judul_update_date"] = "'".date("Y-m-d H:i:s")."'";
				
				$update_data = $this->mm->update_data("ujian_judul", "judul_id", $judul_id, $data);
				if($update_data === 1)
				{
					$rand = rand();
					$msg = base64_encode($rand."-Data berhasil diubah");
					$alert = base64_encode($rand."-success");
					redirect(site_url("ujian_judul/index?m=".$msg."&a=".$alert));
				}
				else
				{
					$msg = base64_encode($rand."-Data tidak berhasil diubah");
					$alert = base64_encode($rand."-danger");
					redirect(site_url("ujian_judul/index?m=".$msg."&a=".$alert));
				}
			}
			else
			{
				redirect(site_url("ujian_judul"));
			}
		}
	}
	
	function delete_ujian()
	{
		$id = $this->input->get("id");
		$id_decrypt = base64_decode("$id");
		$id_soal = explode("-",$id_decrypt);
		
		$m = $this->input->get("m");
		$m_decrypt = base64_decode("$m");
		$method = explode("-",$m_decrypt);
		
		if($id && $method[1] === "delete")
		{
			$this->mm->delete_data("ujian_judul","judul", "judul_id",$id_soal[1]);
			
			$rand = rand();
			$msg = base64_encode($rand."-Data berhasil dihapus");
			$alert = base64_encode($rand."-success");
			redirect(site_url("ujian_judul/index?m=".$msg."&a=".$alert));
		}else{
			redirect(site_url("ujian_judul"));
		}
	}
	
	function submit(){
		$id = $this->input->get("id");
		$id_decrypt = base64_decode("$id");
		$soal = explode("-",$id_decrypt);
		$soal_id = $soal[1];
		
		$jd = $this->input->get("ejd");
		$jd_decrypt = base64_decode("$jd");
		$judul = explode("-",$jd_decrypt);
		$judul_id = $judul[1]; 
		
		$m = $this->input->get("m");
		$m_decrypt = base64_decode("$m");
		$method = explode("-",$m_decrypt);
		$metode = $method[1];
		
		$user_id = $this->session->userdata("adminId");
		
		if($id && $metode == "edit")
		{
			$field[] = "uj_judul,";
			$field[] = "uj_soal,";
			$field[] = "uj_is_delete,";
			$field[] = "uj_update_by,";
			$field[] = "uj_update_date";
			
			$data[] = $judul_id.",";
			$data[] = $soal_id.",";
			$data[] = "0,";
			$data[] = "".$user_id.",";
			$data[] = "'".date("Y-m-d H:i:s")."'";
			
			$insert_data = $this->mm->insert_data("ujian_detail", $field, $data);
			if($insert_data === 1)
			{
				$rand = rand();
				$msg = base64_encode($rand."-Data berhasil disimpan");
				$alert = base64_encode($rand."-success");
				$thn = $this->input->get("th");
				redirect(site_url("ujian_judul/form_pilih?id=".$jd."&th=".$thn."&m=".$msg."&a=".$alert));
			}
			else
			{
				$msg = base64_encode($rand."-Data tidak berhasil disimpan");
				$alert = base64_encode($rand."-danger");
				$thn = $this->input->get("th");
				redirect(site_url("ujian_judul/form_pilih?id=".$jd."&th=".$thn."&m=".$msg."&a=".$alert));
			}
			
		}else{
			redirect(site_url("ujian_judul"));
		}
	}
	
	function batal_soal()
	{
		$thn = $this->input->get("th");
		$id = $this->input->get("id");
		$id_decrypt = base64_decode("$id");
		$detail = explode("-",$id_decrypt);
		$uj_id = $detail[1];
		
		$jd = $this->input->get("ejd");
		$jd_decrypt = base64_decode("$jd");
		$judul = explode("-",$jd_decrypt);
		$judul_id = $judul[1]; 
		
		$m = $this->input->get("m");
		$m_decrypt = base64_decode("$m");
		$method = explode("-",$m_decrypt);
		$metode = $method[1];
			
		if($id && $metode === "delete")
		{
			$this->mm->delete_data("ujian_detail","uj", "uj_id",$uj_id);
			
			$rand = rand();
			$msg = base64_encode($rand."-Data berhasil dihapus");
			$alert = base64_encode($rand."-success");
			redirect(site_url("ujian_judul/form_pilih?id=".$jd."&th=".$thn."&m=".$msg."&a=".$alert));
		}else{
			redirect(site_url("ujian_judul"));
		}
	}
	
	function tampil_data(){
		$th=$this->input->get('th');
		$id=$this->input->get('id');
		$m=$this->input->get('m');
		$a=$this->input->get('a');
		
		$random = rand();
		$eth = base64_encode($random."-".$th);
		redirect(site_url("ujian_judul/form_pilih?id=".$id."&m=".$m."&a=".$a."&th=".$eth));
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
