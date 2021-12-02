<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Studi extends CI_Controller
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
		
		$data["page"] = "view_admin/studi/home";
        $data["title"] = "bidang studi";
		$this->load->view('templates/template', $data);
	}
	
	function data_ajax()
	{
		$requestData= $_REQUEST;
		$columns = array( 
			0 => 'bds_id', 
			1 => 'bds_ket',
			2 => 'bds_jenjang',
		);
		
		$res_tot = $this->mm->count_all_data("m_bidang_studi", NULL, "bds");
		$tot_data = $res_tot->jml;

		$order_by = $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir'];
		$offset = $requestData['start'];
		$limit = $requestData['length'];

		if( !empty($requestData['search']['value']) )
		{
			$where = "(bds_ket LIKE '%".$requestData['search']['value']."%')";
			$res = $this->mm->get_search_data("m_bidang_studi", $where, "bds", $order_by, $limit, $offset);
			
			$res_filtered_tot = $this->mm->count_all_data("m_bidang_studi", $where, "bds");
			$tot_filtered = $res_filtered_tot->jml;
		}
		else
		{
			$res = $this->mm->get_all_data("m_bidang_studi", "bds", $order_by, $limit, $offset);
			$tot_filtered = $tot_data;
		}
		
		$data = array();if(!empty($res)){
		foreach($res as $row)
		{
			$random = rand();
			$id = base64_encode($random."-".$row->bds_id);
			$edit = base64_encode($random."-edit");
			$delete = base64_encode($random."-delete");
			
			if ($row->bds_jenjang == 1){$jenjang="TK";}
			if ($row->bds_jenjang == 2){$jenjang="SD";}
			if ($row->bds_jenjang == 3){$jenjang="SMP";}
			if ($row->bds_jenjang == 4){$jenjang="SMA";}
			
			$nestedData = array();
			$nestedData[] = $row->bds_id;
			$nestedData[] = "<a href='javascrip:;'>".strtoupper($row->bds_ket)."</a>";
			$nestedData[] = $jenjang;
            $nestedData[] = "
			<a href='javascript:void(0)' onClick=edit_function('".$edit."','".$id."');  class='btn btn-sm btn-info' title=\"Edit\"><i class='fa fa-check'></i></a>
			<a href='javascript:void(0)' onClick=del_function('".$delete."','".$id."'); class='btn btn-sm btn-danger' title=\"Delete\"><i class='fa fa-trash'></i></a>
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
	
	function delete_data()
	{
		$id = $this->input->get("id");
		$id_decrypt = base64_decode("$id");
		$id_data = explode("-",$id_decrypt);
		
		$m = $this->input->get("m");
		$m_decrypt = base64_decode("$m");
		$method = explode("-",$m_decrypt);
		
		if($id && $method[1] === "delete")
		{
			$this->mm->delete_data("m_bidang_studi","bds", "bds_id",$id_data[1]);
			
			$rand = rand();
			$msg = base64_encode($rand."-Data berhasil dihapus");
			$alert = base64_encode($rand."-success");
			redirect(site_url("studi?m=".$msg."&a=".$alert));
		}else{
			redirect(site_url("studi"));
		}
	}
	
	function form()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('txt_studi', 'Nama Studi', 'required');
		
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
				$studi = explode("-",$id_decrypt);
				$id_studi = $studi[1];
				 
				if($id_studi=="" || is_numeric($id_studi)==FALSE){
					redirect(site_url("auth/warning"));
				}

				$data["qry_data"] = $this->mm->get_data_by_id("bds_id",$id_studi,"m_bidang_studi","bds");
			}
			
			$data["page"] = "view_admin/studi/form";
			$data["title"] = "bidang studi";
			$this->load->view('templates/template', $data);
		}
		else
		{
			if($this->input->post("btn_simpan") === "btn_simpan")
			{
				$user_id = $this->session->userdata("adminId");
				
				$field[] = "bds_ket,";
				$field[] = "bds_jenjang,";
				$field[] = "bds_is_delete,";
				$field[] = "bds_update_by,";
				$field[] = "bds_update_date";	
				
				$data[] = "'".$this->anti_xss($bds_ket=$this->input->post("txt_studi"))."',";
				$data[] = "'".$this->input->post("opt_jenjang")."',";
				$data[] = "0,";
				$data[] = "".$user_id.",";
				$data[] = "'".date("Y-m-d H:i:s")."'";
				
				$cekdata="bds_ket LIKE '".$bds_ket."'";
				$cek_qry = $this->mm->check_duplicate("m_bidang_studi", "bds" ,$cekdata);
				if($cek_qry->jml === "0")
				{
					$insert_data = $this->mm->insert_data("m_bidang_studi", $field, $data);
					if($insert_data === 1)
					{
						$rand = rand();
						$msg = base64_encode($rand."-Data berhasil ditambah");
						$alert = base64_encode($rand."-success");
						redirect(site_url("studi/index?m=".$msg."&a=".$alert));
					}
					else
					{
						$msg = base64_encode($rand."-Data tidak berhasil ditambah");
						$alert = base64_encode($rand."-danger");
						redirect(site_url("studi/index?m=".$msg."&a=".$alert));
					}
				}
				else
				{
					?>
					<script type="text/javascript">
					alert("Nama Studi sudah ada");
					window.history.back();
					</script>
					<?php
				}
			}
			elseif ($this->input->post("btn_simpan") === "btn_ubah")
			{
				$user_id  = $this->session->userdata("adminId");
				$bds_id = "'".$this->input->post("hdd_bds_id")."'";
				
				$data["bds_ket"] = "'".$this->anti_xss($this->input->post("txt_studi"))."',";
				$data["bds_jenjang"] = "'".$this->anti_xss($this->input->post("opt_jenjang"))."',";
				$data["bds_update_by"] = "".$user_id.",";
				$data["bds_update_date"] = "'".date("Y-m-d H:i:s")."'";
				
				$update_data = $this->mm->update_data("m_bidang_studi", "bds_id", $bds_id, $data);
				if($update_data === 1)
				{
					$rand = rand();
					$msg = base64_encode($rand."-Data berhasil diubah");
					$alert = base64_encode($rand."-success");
					redirect(site_url("studi?m=".$msg."&a=".$alert));
				}
				else
				{
					$msg = base64_encode($rand."-Data tidak berhasil diubah");
					$alert = base64_encode($rand."-danger");
					redirect(site_url("studi?m=".$msg."&a=".$alert));
				}	
			}
			else
			{
				redirect(site_url("studi"));
			}
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
