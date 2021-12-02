<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Ujian_soal extends CI_Controller
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
		
		$data["page"] = "view_admin/ujian_soal/home";
        $data["title"] = "soal ujian";
		$this->load->view('templates/template', $data);
	}
	
	function soal_ajax()
	{
		$requestData= $_REQUEST;
		$columns = array( 
			0 => '',
			1 => 'soal_id', 
			2 => 'soal_pertanyaan',
			3 => 'soal_jawaban',
			4 => 'ta_tahun1',
			5 => 'bds_ket',
			6 => 'jenjang_ket',
			7 => 'soal_kelas'
		);
		
		$res_tot = $this->mm->count_all_data("v_ujian_soal", NULL, "soal");
		$tot_data = $res_tot->jml;

		$order_by = $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir'];
		$offset = $requestData['start'];
		$limit = $requestData['length'];

		if( !empty($requestData['search']['value']) )
		{
			$where = "(soal_pertanyaan LIKE '%".$requestData['search']['value']."%')";
			$res = $this->mm->get_search_data("v_ujian_soal", $where, "soal", $order_by, $limit, $offset);
			
			$res_filtered_tot = $this->mm->count_all_data("v_ujian_soal", $where, "soal");
			$tot_filtered = $res_filtered_tot->jml;
		}
		else
		{
			$res = $this->mm->get_all_data("v_ujian_soal", "soal", $order_by, $limit, $offset);
			$tot_filtered = $tot_data;
		}
		
		$data = array();if(!empty($res)){
		foreach($res as $row)
		{
			$random = rand();
			$id = base64_encode($random."-".$row->soal_id);
			$edit = base64_encode($random."-edit");
			$delete = base64_encode($random."-delete");
			$lampiran=base64_encode($random."-".$row->soal_lampiran);
			
			$pertanyaan = $row->soal_pertanyaan;
			$jml = strlen($pertanyaan);
			$jumlah = intval($jml);
	
			if($jumlah>70){
				$soal_tanya = substr($pertanyaan,0,70)."...";
			}else{
				$soal_tanya = $pertanyaan;
			}

            if($row->jurusan_ket==""){
				$jurusan="";
			}else{
				$jurusan=" / ".$row->jurusan_ket;
			}

			if(!empty($row->soal_lampiran)){
				$url = base_url("assets/fileuser/lampiran_soal/".$row->soal_lampiran);
				$lamprianku="<a href=".$url." target='_blank' title='Klik untuk melihat lampiran'><div class=\"uk-badge uk-badge-warning\">Yes</div></a>";
			}else{
				$lamprianku="<div class=\"uk-badge uk-badge-danger\">No</div>";
			}
			
			$nestedData = array();
			$nestedData[] = "
			<a href='javascript:void(0)' oncontextmenu=\"editklik_function('".$edit."','".$id."'); return false;\" onClick=edit_function('".$edit."','".$id."');  class='btn btn-sm btn-info' title=\"Edit\"><i class='fa fa-check'></i></a>
			<a href='javascript:void(0)' oncontextmenu=\"delklik_function('".$delete."','".$id."','".$lampiran."'); return false;\" onClick=del_function('".$delete."','".$id."','".$lampiran."'); class='btn btn-sm btn-danger' title=\"Delete\"><i class='fa fa-trash'></i></a>
			";
			$nestedData[] = $row->soal_id;
			$nestedData[] = $soal_tanya;
			$nestedData[] = strtoupper($row->soal_jawaban);
			$nestedData[] = "<font class='uk-text-danger'>".strtoupper($row->ta_tahun1." / ".$row->ta_tahun2)."</font>";
			$nestedData[] = "<font class='uk-text-danger'>".strtoupper($row->bds_ket)."</font>";
			$nestedData[] = "<font class='uk-text-danger'>".strtoupper($row->jenjang_ket.$jurusan)."</font>";
			$nestedData[] = "<font class='uk-text-danger'>"."</center>".strtoupper($row->soal_kelas)."</center>"."</font>";
			
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
	
	function delete_soal()
	{
		$id = $this->input->get("id");
		$id_decrypt = base64_decode("$id");
		$id_soal = explode("-",$id_decrypt);
		
		$m = $this->input->get("m");
		$m_decrypt = base64_decode("$m");
		$method = explode("-",$m_decrypt);
		
		if($id && $method[1] === "delete")
		{
			$this->mm->delete_data("ujian_soal","soal", "soal_id",$id_soal[1]);
			
			$rand = rand();
			$msg = base64_encode($rand."-Data berhasil dihapus");
			$alert = base64_encode($rand."-success");
			redirect(site_url("ujian_soal/index?m=".$msg."&a=".$alert));
		}else{
			redirect(site_url("soal"));
		}
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
				$soal = explode("-",$id_decrypt);
				$id_soal = $soal[1];
				
				$data["qry_soal"] = $this->mm->get_data_by_id("soal_id",$id_soal,"ujian_soal","soal");
			}
			
			$data["res_ta"]=$this->mm->get_all_data("m_tahun_ajaran","ta","ta_id","100","0");
			$data["qry_jenjang"] = $this->mm->get_all_data("m_jenjang","jenjang","jenjang_id","100","0");
			$data["page"] = "view_admin/ujian_soal/form";
			$data["title"] = "soal ujian";
			$this->load->view('templates/template', $data);
		}
		else
		{
			if($this->input->post("btn_simpan") === "btn_simpan")
			{
				$user_id = $this->session->userdata("adminId");
				$soal_pertanyaan = $this->input->post("txt_soal_pertanyaan");
				$pilihan_a = $this->input->post("txt_opsi_a");
				$pilihan_b = $this->input->post("txt_opsi_b");
				$pilihan_c = $this->input->post("txt_opsi_c");
				$pilihan_d = $this->input->post("txt_opsi_d");
				$pilihan_e = $this->input->post("txt_opsi_e");
				
				$tingkat = $this->input->post("opt_tingkat");
				$kelas   = $this->input->post("opt_kelas");
				$jurusan = $this->input->post("opt_jurusan");
				$tahun   = $this->input->post("opt_tahun");
				$studi   = $this->input->post("opt_studi");
				
				if($soal_pertanyaan=="" || ($pilihan_a=="" || $pilihan_b=="" || $pilihan_c==""))
				{
					$rand = rand();
					$msg = base64_encode($rand."-Pertanyaan harus diisi, dan pilihan minimal 3");
					$alert = base64_encode($rand."-danger");
					redirect(site_url("ujian_soal/proses?m=".$msg."&a=".$alert."&tk=".$tingkat."&kl=".$kelas."&jr=".$jurusan."&th=".$tahun."&st=".$studi));
				}else{
					
					$field[] = "soal_pertanyaan,";
					$field[] = "soal_jawaban,";
					$field[] = "soal_tingkat,";
					$field[] = "soal_kelas,";
					$field[] = "soal_jurusan,";
					$field[] = "soal_tahun,";
					$field[] = "soal_studi,";
					$field[] = "soal_bobot,";
					$field[] = "soal_opsi_a,";
					$field[] = "soal_opsi_b,";
					$field[] = "soal_opsi_c,";
					$field[] = "soal_opsi_d,";
					$field[] = "soal_opsi_e,";
					$field[] = "soal_is_delete,";
					$field[] = "soal_update_by,";
					$field[] = "soal_update_date";
				
					$data[] = "'".$soal_pertanyaan."',";
					$data[] = "'".$this->input->post("opt_jawaban")."',";
					$data[] = "'".$this->input->post("opt_tingkat")."',";
					$data[] = "'".$this->input->post("opt_kelas")."',";
					$data[] = "'".$this->input->post("opt_jurusan")."',";
					$data[] = "'".$this->input->post("opt_tahun")."',";
					$data[] = "'".$this->input->post("opt_studi")."',";
					$data[] = "'".$this->input->post("txt_bobot")."',";
					$data[] = "'".$pilihan_a."',";
					$data[] = "'".$pilihan_b."',";
					$data[] = "'".$pilihan_c."',";
					$data[] = "'".$pilihan_d."',";
					$data[] = "'".$pilihan_e."',";
					$data[] = "0,";
					$data[] = "".$user_id.",";
					$data[] = "'".date("Y-m-d H:i:s")."'";
		
					$insert_data = $this->mm->insert_data("ujian_soal", $field, $data);
					if($insert_data === 1)
					{
						$rand = rand();
						$msg = base64_encode($rand."-Data berhasil ditambah");
						$alert = base64_encode($rand."-success");
						redirect(site_url("ujian_soal/proses?m=".$msg."&a=".$alert."&tk=".$tingkat."&kl=".$kelas."&jr=".$jurusan."&th=".$tahun."&st=".$studi));
					}
					else
					{
						$msg = base64_encode($rand."-Data tidak berhasil ditambah");
						$alert = base64_encode($rand."-danger");
						redirect(site_url("ujian_soal/index?m=".$msg."&a=".$alert));
					}
				}
			}
			elseif ($this->input->post("btn_simpan") === "btn_ubah")
			{	
				$user_id = $this->session->userdata("adminId");
				$soal_id = "'".$this->input->post("txt_soal_id")."'";
				$rand = rand();
				
				$soal_pertanyaan = $this->input->post("txt_soal_pertanyaan");
				$pilihan_a = $this->input->post("txt_opsi_a");
				$pilihan_b = $this->input->post("txt_opsi_b");
				$pilihan_c = $this->input->post("txt_opsi_c");
				$pilihan_d = $this->input->post("txt_opsi_d");
				$pilihan_e = $this->input->post("txt_opsi_e");
				
				$tingkat = $this->input->post("opt_tingkat");
				$kelas   = $this->input->post("opt_kelas");
				$jurusan = $this->input->post("opt_jurusan");
				$tahun   = $this->input->post("opt_tahun");
				$studi   = $this->input->post("opt_studi");
				
				if($soal_pertanyaan=="" || ($pilihan_a=="" || $pilihan_b=="" || $pilihan_c==""))
				{
					$rand = rand();
					$msg = base64_encode($rand."-Pertanyaan harus diisi, dan pilihan minimal 3");
					$alert = base64_encode($rand."-danger");
					$esoal = $this->input->post("hdd_soal_id");
					redirect(site_url("ujian_soal/proses?m=".$msg."&a=".$alert."&tk=".$tingkat."&kl=".$kelas."&jr=".$jurusan."&th=".$tahun."&st=".$studi."&id=".$esoal));
				}
                else
                {
					$data["soal_pertanyaan"] = "'".$soal_pertanyaan."',";
					$data["soal_jawaban"] = "'".$this->input->post("opt_jawaban")."',";
					$data["soal_tingkat"] = "'".$this->input->post("opt_tingkat")."',";
					$data["soal_kelas"]   = "'".$this->input->post("opt_kelas")."',";
					$data["soal_jurusan"] = "'".$this->input->post("opt_jurusan")."',";
					$data["soal_tahun"]   = "'".$this->input->post("opt_tahun")."',";
					$data["soal_studi"]   = "'".$this->input->post("opt_studi")."',";
					$data["soal_bobot"]   = "'".$this->input->post("txt_bobot")."',";
					$data["soal_opsi_a"]  = "'".$pilihan_a."',";
					$data["soal_opsi_b"]  = "'".$pilihan_b."',";
					$data["soal_opsi_c"]  = "'".$pilihan_c."',";
					$data["soal_opsi_d"]  = "'".$pilihan_d."',";
					$data["soal_opsi_e"]  = "'".$pilihan_e."',";
					$data["soal_update_by"]   = "".$user_id.",";
					$data["soal_update_date"] = "'".date("Y-m-d H:i:s")."'";

					$update_data = $this->mm->update_data("ujian_soal", "soal_id", $soal_id, $data);
					if($update_data === 1)
					{
						$rand = rand();
						$msg = base64_encode($rand."-Data berhasil diubah");
						$alert = base64_encode($rand."-success");
						$esoal = $this->input->post("hdd_soal_id");
						redirect(site_url("ujian_soal/proses?m=".$msg."&a=".$alert."&tk=".$tingkat."&kl=".$kelas."&jr=".$jurusan."&th=".$tahun."&st=".$studi."&id=".$esoal));
					}
					else
					{
						$msg = base64_encode($rand."-Data tidak berhasil diubah");
						$alert = base64_encode($rand."-danger");
						redirect(site_url("ujian_soal/index?m=".$msg."&a=".$alert));
					}
				}
			}
			else
			{
				redirect(site_url("soal"));
			}
		}
	}
	
	function proses(){
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

		$data["page"] = "view_admin/ujian_soal/home_sukses";
        $data["title"] = "soal ujian";
		$this->load->view('templates/template', $data);
	}
	
	function kelas_ajax()
	{
		$tingkat = $this->input->get("tingkat");
		$kelas_ku = $this->input->get("kelas_ku");
		
		$kelas_tingkat = array("1"=>array(0=>0),"2"=>array(1=>1,2=>2,3=>3,4=>4,5=>5,6=>6),"3"=>array(7=>7,8=>8,9=>9),"4"=>array(10=>10,11=>11,12=>12));
		$kelas = $kelas_tingkat[$tingkat];
		
		if($tingkat==0){
			?><option value="">Pilih Kelas</option><?php
		}
		
		foreach ($kelas as $key => $row_kelas)
		{
			?><option value="<?php echo $key; ?>" <?php if($key==$kelas_ku){ echo "selected=\"selected\""; } ?>><?php echo $row_kelas; ?></option><?php
		}
	}
	
	function soal_studi_ajax()
	{
		$tingkat = $this->input->get("tingkat");
		$studi_ku = $this->input->get("studi_ku");
		$qry_bd_studi = $this->mm->get_bd_studi_by_jenjang($tingkat);
		
		if($tingkat==0){
			?><option value="">Pilih Bidang Studi</option><?php
		}
		
		foreach ($qry_bd_studi as $row_bd_studi)
		{
			$bds_id=$row_bd_studi->bds_id;
			?><option value="<?php echo $bds_id; ?>" <?php if($bds_id==$studi_ku){ echo "selected=\"selected\""; } ?>><?php echo strtoupper($row_bd_studi->bds_ket); ?></option><?php
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
