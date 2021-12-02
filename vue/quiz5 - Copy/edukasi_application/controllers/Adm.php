<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Adm extends CI_Controller
{
	/*
	 * @autor KangAgus <sumarna.agus@gmail.com>
     */
	 
	function __construct()
	{
		parent::__construct();
		$this->output->enable_profiler(FALSE);
		$this->load->model("admin_model","am");
		$this->load->model("master_model", "mm");
		date_default_timezone_set("Asia/Jakarta");
	}

    function index()
    {
		if($this->session->userdata('isLoggedInADM') === TRUE)
        {
        	redirect('dashboard');
        }else{
			$this->load->view('view_admin/home_login');
        }
    }
	
    function validate_credential()
    {
		if($this->input->post('btn_login') === 'btn_login')
		{
			$find = array("//","\\");
			$username=str_replace($find,"'",$this->input->post('txt_user_name'));
			$password=str_replace($find,"'",$this->input->post('txt_user_password'));
			
			$filter_username=$this->anti_xss($username,TRUE);
			$filter_password=$this->anti_xss($password,TRUE);
			
			$cek_admin = $this->am->validate($filter_username,$filter_password);
			if($cek_admin)
			{
				$u_agent=$_SERVER['HTTP_USER_AGENT'];
				$is_mobile = preg_match('/android.+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge|maemo|meego.+mobile|midp|mmp|netfront|opera m(ob|in)i|palm(os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$u_agent);
				if($is_mobile){ $device='Mobile'; }else{ $device='Desktop'; }

				$data = array(		
					'adminId'       => $cek_admin->admin_id,
					'adminNpp'      => $cek_admin->admin_npp,
					'adminNama'     => $cek_admin->admin_nama,
					'userDevice'    => $device,
					'waktuLogin'    => date('Y-m-d H:i:s'),
					'isLoggedInADM' => TRUE
				);
				
				$this->session->set_userdata($data);
				redirect("dashboard");
				
			}else{
				$data['error'] = "Username atau Password salah";
				$this->load->view('view_admin/home_login');
			}
		}
		else
		{
			$data['error'] = "Anda harus login terlebih dahulu";
			$this->load->view('view_admin/home_login');
		}
    }
	
	function logout()
	{
		if($this->session->userdata('isLoggedInADM') === TRUE)
        {
			$user_id=$this->session->userdata('siswaId');
			$waktu_masuk=$this->session->userdata('waktuLogin');
			$waktu_keluar=date('Y-m-d H:i:s');
			
			if($waktu_masuk=="" || $waktu_keluar=="" || $user_id==""){
				$this->session->sess_destroy();
				redirect("adm");
			}else{
				$this->session->sess_destroy();
				redirect("adm");
			}
			
        }else{
			$this->session->sess_destroy();
			redirect("adm");
		}
	}
	
	function disabled()
    {
		$this->session->sess_destroy();
		$this->load->view('templates/info_javascript');
	}
	
	function warning()
	{
		$data["page"] = "templates/info_access";
        $data["title"] = "Input is Denied";
		$this->load->view('templates/template', $data);
	}
	
	function forbidden()
	{
		$data["page"] = "templates/info_access";
        $data["title"] = "Access is Denied";
		$this->load->view('templates/template', $data);
	}
	
	function anti_xss($string)
	{
		$filter=stripslashes(strip_tags(htmlspecialchars(trim($string),ENT_QUOTES)));
		return $filter;
	}
}
