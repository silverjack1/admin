<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Ujian_upload extends CI_Controller
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

        $this->load->helper(array('form', 'url', 'file'));
        $this->load->library('upload');
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
		
		$data["page"] = "view_admin/ujian_upload/home";
        $data["title"] = "upload media";
		$this->load->view('templates/template', $data);
	}
	
	function upload_ajax()
	{
		$requestData= $_REQUEST;
		$columns = array( 
			0 => 'upload_id',
			1 => 'upload_ket',
			2 => 'upload_url',
		);
		
		$res_tot = $this->mm->count_all_data("ujian_upload", NULL, "upload");
		$tot_data = $res_tot->jml;

		$order_by = $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir'];
		$offset = $requestData['start'];
		$limit = $requestData['length'];

		if( !empty($requestData['search']['value']) )
		{
			$where = "(upload_ket LIKE '%".$requestData['search']['value']."%')";
			
			$res = $this->mm->get_search_data("ujian_upload", $where, "upload", $order_by, $limit, $offset);
			
			$res_filtered_tot = $this->mm->count_all_data("ujian_upload", $where, "upload");
			$tot_filtered = $res_filtered_tot->jml;
		}
		else
		{
			$res = $this->mm->get_all_data("ujian_upload", "upload", $order_by, $limit, $offset);
			$tot_filtered = $tot_data;
		}
		
		$data = array();if(!empty($res)){
		foreach($res as $row)
		{
			$random = rand();
			$id = base64_encode($random."-".$row->upload_id);
			$edit = base64_encode($random."-edit");
			$delete = base64_encode($random."-delete");

			$upload_ket = $row->upload_ket;
            $upload_url = $row->upload_url;
			
			$nestedData = array();
			$nestedData[] = $row->upload_id;
			$nestedData[] = "<a href='".base_url("assets/filemedia/".$upload_url)."' target='_blank'>".strtoupper($upload_ket)."</a>";
			$nestedData[] = "<div class='col-sm-12'><input onClick=\"this.setSelectionRange(0, this.value.length)\" type='text' class='form-control' id='media' value='".strtolower(base_url("assets/filemedia/").$row->upload_url)."'></div>";
			$nestedData[] = "
            <a href='javascript:void(0)' oncontextmenu=\"editklik_function('".$edit."','".$id."'); return false;\" onClick=edit_function('".$edit."','".$id."'); class='btn btn-sm btn-info' title=\"Edit\"><i class='fa fa-check'></i></a>            
            <a href='javascript:void(0)' oncontextmenu=\"delklik_function('".$delete."','".$id."','".$upload_url."'); return false;\" onClick=del_function('".$delete."','".$id."','".$upload_url."'); class='btn btn-sm btn-danger' title=\"Delete\"><i class='fa fa-trash'></i></a>";

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
	
	function delete_upload()
	{
        $lampiran = $this->input->get("fl");
		
        $id = $this->input->get("id");
		$id_decrypt = base64_decode("$id");
		$id_upload = explode("-",$id_decrypt);
        $upload = $id_upload[1];

		$m = $this->input->get("m");
		$m_decrypt = base64_decode("$m");
		$method = explode("-",$m_decrypt);
		
		if($id && $method[1] === "delete")
		{
			$this->mm->delete_data("ujian_upload","upload", "upload_id",$upload);
            unlink("assets/filemedia/".$lampiran);
			
			$rand = rand();
			$msg = base64_encode($rand."-Data berhasil dihapus");
			$alert = base64_encode($rand."-success");
			redirect(site_url("ujian_upload/index?m=".$msg."&a=".$alert));
		}else{
			redirect(site_url("ujian_upload"));
		}
	}
	
	function form()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('txt_upload_ket', 'Nama File', 'required');
		
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
				$id_upload = $soal[1];
				
				$data["qry_upload"] = $this->mm->get_data_by_id("upload_id",$id_upload,"ujian_upload","upload");
			}

			$data["page"] = "view_admin/ujian_upload/form";
			$data["title"] = "upload media";
			$this->load->view('templates/template', $data);
		}
		else
		{
			if($this->input->post("btn_simpan") === "btn_simpan")
			{
				$user_id = $this->session->userdata("adminId");
                $upload_ket = $this->input->post("txt_upload_ket");

				$cekdata="upload_ket like '".$upload_ket."'";
				$cek_file = $this->mm->check_duplicate("ujian_upload", "upload" ,$cekdata);
				if($cek_file->jml === "0")
				{
                    $nmfile = "upload_".time();
					$config['upload_path']   = './assets/filemedia/';
					$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp|mp3|wav|pdf|docx|doc|pptx|ppt'; 
					$config['max_size']  = '10000000';  //max 10MB
					$config['file_name'] = $nmfile; 
			 
					$this->upload->initialize($config);
					
					if($_FILES['fileuser']['name'])
					{
						if ($this->upload->do_upload('fileuser'))
						{
							$ups=$this->upload->data();
							$lampiran=$ups['file_name'];
						}else{
							echo $this->upload->display_errors();
						}	
					}else{
						$lampiran=$this->input->post("hdd_file_lama");
					}

                    $field[] = "upload_ket,";
                    $field[] = "upload_url,";
				    $field[] = "upload_is_delete,";
				    $field[] = "upload_update_by,";
				    $field[] = "upload_update_date";

				    $data[] = "'".$upload_ket."',";
                    $data[] = "'".$this->anti_xss($lampiran)."',";
				    $data[] = "0,";
				    $data[] = "".$user_id.",";
				    $data[] = "'".date("Y-m-d H:i:s")."'";
	
				    $insert_data = $this->mm->insert_data("ujian_upload", $field, $data);
				    if($insert_data === 1)
				    {
					    $rand = rand();
					    $msg = base64_encode($rand."-Data berhasil ditambah");
					    $alert = base64_encode($rand."-success");
					    redirect(site_url("ujian_upload/index?m=".$msg."&a=".$alert));
				    }
				    else
				    {
					    $msg = base64_encode($rand."-Data tidak berhasil ditambah");
					    $alert = base64_encode($rand."-danger");
					    redirect(site_url("ujian_upload/index?m=".$msg."&a=".$alert));
				    }

                }else{
					?>
					<script type="text/javascript">
					alert("Nama File Sudah Ada!");
					window.history.back();
					</script>
					<?php
				}
			}
			elseif ($this->input->post("btn_simpan") === "btn_ubah")
			{	
				$user_id = $this->session->userdata("adminId");
				$upload_id  = $this->input->post("hdd_upload_id");
                $upload_url = $this->input->post("hdd_file_lama");
                $upload_ket = $this->input->post("txt_upload_ket");
				
				$data["upload_ket"]     = "'".$this->input->post("txt_upload_ket")."',";
				$data["upload_update_by"]   = "".$user_id.",";
				$data["upload_update_date"] = "'".date("Y-m-d H:i:s")."'";

				$update_data = $this->mm->update_data("ujian_upload", "upload_id", $upload_id, $data);
				if($update_data === 1)
				{
					$rand  = rand();
					$msg   = base64_encode($rand."-Data berhasil diubah");
					$alert = base64_encode($rand."-success");
                    redirect(site_url("ujian_upload/index?m=".$msg."&a=".$alert));
				}
				else
				{
                    $rand  = rand();					
                    $msg   = base64_encode($rand."-Data tidak berhasil diubah");
					$alert = base64_encode($rand."-danger");
					redirect(site_url("ujian_upload/index?m=".$msg."&a=".$alert));
				}
			}else{
				redirect(site_url("upload"));
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
