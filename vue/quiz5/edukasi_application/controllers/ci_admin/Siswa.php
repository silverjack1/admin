<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa extends CI_Controller
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
		
		$data["page"] = "view_admin/siswa/home";
        $data["title"] = "data siswa";
		$this->load->view('templates/template', $data);
	}
	
	function siswa_ajax()
	{
		$requestData= $_REQUEST;
		$columns = array( 
			0 => '',
			1 => 'siswa_id', 
			2 => 'siswa_nama',
			3 => 'siswa_nis',
			4 => 'siswa_kelamin',
			5 => 'siswa_jenjang',
			6 => 'siswa_kelas',
			7 => 'siswa_jurusan'
		);
		
		$res_tot = $this->mm->count_all_data("siswa", NULL, "siswa");
		$tot_data = $res_tot->jml;

		$order_by = $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir'];
		$offset = $requestData['start'];
		$limit = $requestData['length'];

		if( !empty($requestData['search']['value']) )
		{
			$where = "(siswa_nama LIKE '%".$requestData['search']['value']."%')";
			$res = $this->mm->get_search_data("siswa", $where, "siswa", $order_by, $limit, $offset);
			
			$res_filtered_tot = $this->mm->count_all_data("siswa", $where, "siswa");
			$tot_filtered = $res_filtered_tot->jml;
		}
		else
		{
			$res = $this->mm->get_all_data("siswa", "siswa", $order_by, $limit, $offset);
			$tot_filtered = $tot_data;
		}
		
		$data = array();if(!empty($res)){
		foreach($res as $row)
		{
			$random = rand();
			$id = base64_encode($random."-".$row->siswa_id);
			$edit = base64_encode($random."-edit");
			$delete = base64_encode($random."-delete");
			
			if ($row->siswa_kelamin == 1){$kelamin="<span class='label label-info'>LAKI-LAKI</span>";}
			if ($row->siswa_kelamin == 2){$kelamin="<span class='label label-warning'>PEREMPUAN</span>";}
			
			if ($row->siswa_jurusan == 1){$jurusan="IPA";}
			if ($row->siswa_jurusan == 2){$jurusan="IPS";}
			if ($row->siswa_jurusan == 0){$jurusan="";}
			
			if ($row->siswa_jenjang == 1){$jenjang="TK";}
			if ($row->siswa_jenjang == 2){$jenjang="SD";}
			if ($row->siswa_jenjang == 3){$jenjang="SMP";}
			if ($row->siswa_jenjang == 4){$jenjang="SMA";}
			
			$nestedData = array();
			$nestedData[] = "
			<a href='javascript:void(0)' onClick=edit_function('".$edit."','".$id."');  class='btn btn-sm btn-info' title=\"Edit\"><i class='fa fa-check'></i></a>
			<a href='javascript:void(0)' onClick=del_function('".$delete."','".$id."'); class='btn btn-sm btn-danger' title=\"Delete\"><i class='fa fa-trash'></i></a>
			";
			$nestedData[] = $row->siswa_id;
			$nestedData[] = "<a href='javascrip:;'>".strtoupper($row->siswa_nama)."</a>";
			$nestedData[] = strtoupper($row->siswa_nis);
			$nestedData[] = $kelamin;
			$nestedData[] = $jenjang;
			$nestedData[] = strtoupper($row->siswa_kelas);
			$nestedData[] = $jurusan;
			
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
	
	function delete_siswa()
	{
		$id = $this->input->get("id");
		$id_decrypt = base64_decode("$id");
		$id_siswa = explode("-",$id_decrypt);
		
		$m = $this->input->get("m");
		$m_decrypt = base64_decode("$m");
		$method = explode("-",$m_decrypt);
		
		if($id && $method[1] === "delete")
        {
			$this->mm->delete_data("siswa","siswa", "siswa_id",$id_siswa[1]);
			
			$rand = rand();
			$msg = base64_encode($rand."-Data berhasil dihapus");
			$alert = base64_encode($rand."-success");
			redirect(site_url("siswa?m=".$msg."&a=".$alert));
		}else{
			redirect(site_url("siswa"));
		}
	}
	
	function form()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('siswa_nama', 'Nama Siswa', 'required');
		
		if ($this->form_validation->run() === FALSE)
		{
			$m = $this->input->get("m");
			$m_decrypt = base64_decode($m);
			$method = explode("-",$m_decrypt);
			$mode_ket = $method[1];

			if($mode_ket === "edit")
			{
				$id = $this->input->get("id");
				$id_decrypt = base64_decode($id);
				$siswa = explode("-",$id_decrypt);
				$id_siswa = $siswa[1];
				
				//pencegahan server error (changed) 
				if($id_siswa=="" || is_numeric($id_siswa)==FALSE){
					redirect(site_url("auth/warning"));
				}

				$data["qry_siswa"] = $this->mm->get_data_by_id("siswa_id",$id_siswa,"siswa","siswa");
			}
			
			$data["page"] = "view_admin/siswa/form";
			$data["title"] = "data siswa";
			$this->load->view('templates/template', $data);
		}
		else
		{
			if($this->input->post("btn_simpan") === "btn_simpan")
			{
				$user_id = $this->session->userdata("adminId");
				
				$field[] = "siswa_nama,";
				$field[] = "siswa_nis,";
				$field[] = "siswa_kelamin,";
				$field[] = "siswa_jenjang,";
				$field[] = "siswa_jurusan,";
				$field[] = "siswa_kelas,";
				$field[] = "siswa_username,";
				$field[] = "siswa_password,";
		
				$field[] = "siswa_is_delete,";
				$field[] = "siswa_update_by,";
				$field[] = "siswa_update_date";
				
				$username = $this->input->post("siswa_username");
				$password_lama = $this->input->post("hdd_password_lama");
				$password_baru = $this->input->post("siswa_password");
				
				if($password_baru==""){
					$password = $password_lama;
				}else{
					$password = md5($password_baru);
				}
				
				$data[] = "'".$this->anti_xss($siswa_nama=$this->input->post("siswa_nama"))."',";
				$data[] = "'".$this->anti_xss($siswa_nama=$this->input->post("siswa_nis"))."',";
				$data[] = "'".$this->input->post("siswa_kelamin")."',";
				$data[] = "'".$this->input->post("siswa_jenjang")."',";
				$data[] = "'".$this->input->post("siswa_jurusan")."',";
				$data[] = "'".$this->input->post("siswa_kelas")."',";
				$data[] = "'".$this->anti_xss($username)."',";
				$data[] = "'".$this->anti_xss($password)."',";
				
				$data[] = "0,";
				$data[] = "".$user_id.",";
				$data[] = "'".date("Y-m-d H:i:s")."'";
				
				//cek jika ada data yang sama
				$cekdata="siswa_nama LIKE '".$siswa_nama."'";
				$cek_siswa = $this->mm->check_duplicate("siswa", "siswa" ,$cekdata);
				
				if($cek_siswa->jml === "0")
				{
					$insert_data = $this->mm->insert_data("siswa", $field, $data);
					if($insert_data === 1)
					{
						$rand = rand();
						$msg = base64_encode($rand."-Data berhasil ditambah");
						$alert = base64_encode($rand."-success");
						redirect(site_url("siswa/index?m=".$msg."&a=".$alert));
					}
					else
					{
						$msg = base64_encode($rand."-Data tidak berhasil ditambah");
						$alert = base64_encode($rand."-danger");
						redirect(site_url("siswa/index?m=".$msg."&a=".$alert));
					}
				}
				else
				{
					?>
					<script type="text/javascript">
					alert("Nama siswa sudah ada");
					window.history.back();
					</script>
					<?php
				}
			}
			elseif ($this->input->post("btn_simpan") === "btn_ubah")
			{
				$user_id  = $this->session->userdata("adminId");
				$siswa_id = "'".$this->input->post("hdd_siswa_id")."'";
				
				$username = $this->input->post("siswa_username");
				$password_lama = $this->input->post("hdd_password_lama");
				$password_baru = $this->input->post("siswa_password");
				
				if($password_baru==""){
					$password = $password_lama;
				}else{
					$password = md5($password_baru);
				}
				
				$data["siswa_nama"] = "'".$this->anti_xss($this->input->post("siswa_nama"))."',";
				$data["siswa_nis"]  = "'".$this->anti_xss($this->input->post("siswa_nis"))."',";
				$data["siswa_kelamin"] = "'".$this->anti_xss($this->input->post("siswa_kelamin"))."',";
				$data["siswa_jenjang"] = "'".$this->anti_xss($this->input->post("siswa_jenjang"))."',";
				$data["siswa_jurusan"] = "'".$this->anti_xss($this->input->post("siswa_jurusan"))."',";
				$data["siswa_kelas"]   = "'".$this->anti_xss($this->input->post("siswa_kelas"))."',";
				$data["siswa_username"]   = "'".$username."',";
				$data["siswa_password"]   = "'".$password."',";
				
				$data["siswa_update_by"] = "".$user_id.",";
				$data["siswa_update_date"] = "'".date("Y-m-d H:i:s")."'";
				
				$update_data = $this->mm->update_data("siswa", "siswa_id", $siswa_id, $data);
				if($update_data === 1)
				{
					$rand = rand();
					$msg = base64_encode($rand."-Data berhasil diubah");
					$alert = base64_encode($rand."-success");
					redirect(site_url("siswa?m=".$msg."&a=".$alert));
				}
				else
				{
					$msg = base64_encode($rand."-Data tidak berhasil diubah");
					$alert = base64_encode($rand."-danger");
					redirect(site_url("siswa?m=".$msg."&a=".$alert));
				}	
			}
			else
			{
				redirect(site_url("siswa"));
			}
		}
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
