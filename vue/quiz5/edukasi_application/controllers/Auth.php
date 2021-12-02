<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller
{
	/*
	 * @autor KangAgus <sumarna.agus@gmail.com>
     */
	
	function __construct()
	{
		parent::__construct();
		$this->output->enable_profiler(FALSE);
		$this->load->model("auth_model","am");
		$this->load->model("master_model", "mm");
		date_default_timezone_set("Asia/Jakarta");
	}

    function index()
    {
		if($this->session->userdata('isLoggedInUSR') === TRUE)
        {
        	redirect('home');
        }else{
			$this->load->view('view_login/home_login');
			//$this->load->view('view_login/home_close');
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
			
			$cek_siswa = $this->am->validate($filter_username,$filter_password);
			if($cek_siswa)
			{
				$u_agent=$_SERVER['HTTP_USER_AGENT'];
				$is_mobile = preg_match('/android.+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge|maemo|meego.+mobile|midp|mmp|netfront|opera m(ob|in)i|palm(os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$u_agent);
				if($is_mobile){ $device='Mobile'; }else{ $device='Desktop'; }
				
				$parameter="'".$username."' AND siswa_password=md5('".$password."')";
				$cari_data = $this->mm->get_data_by_id("siswa_username",$parameter,"siswa","siswa");
				
				if($cari_data->siswa_jenjang=="1"){ $jenjangku="TK";}
				if($cari_data->siswa_jenjang=="2"){ $jenjangku="SD";}
				if($cari_data->siswa_jenjang=="3"){ $jenjangku="SMP";}
				if($cari_data->siswa_jenjang=="4"){ $jenjangku="SMA";}
				
				if($cari_data->siswa_jurusan=="1"){ $jurusanku="IPA";}
				if($cari_data->siswa_jurusan=="2"){ $jurusanku="IPS";}

				$data = array(		
					'userDevice'    => $device,
					'jenjang_ket'   => $jenjangku,
					'jurusan_ket'   => $jurusanku,
					'siswaId'       => $cek_siswa->siswa_id,
					'siswaNama'     => $cek_siswa->siswa_nama,
					'siswaNis'      => $cek_siswa->siswa_nis,
					'siswaJenjang'  => $cek_siswa->siswa_jenjang,
					'siswaJurusan'  => $cek_siswa->siswa_jurusan,
					'siswaKelas'    => $cek_siswa->siswa_kelas,
					'waktuLogin'    => $waktu_masuk=date('Y-m-d H:i:s'),
					'isLoggedInUSR' => TRUE
				);
				
				$this->session->set_userdata($data);
				redirect("home");
				
			}else{
				$data['error'] = "Username atau Password salah";
				$this->load->view('view_login/home_login');
			}
		}
		else
		{
			$data['error'] = "Anda harus login terlebih dahulu";
			$this->load->view('view_login/home_login');
		}
    }
	
	function update_password()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('txt_old_password', 'Password Lama', 'trim|required');
		$this->form_validation->set_rules('txt_new_password', 'Password Baru', 'trim|required|matches[txt_confirm_password]');
		$this->form_validation->set_rules('txt_confirm_password', 'Password Confirmation', 'required');

		if ($this->form_validation->run() == FALSE)
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
			
			$data["title"] = "Password";
			$data["page"] = "view_login/form";
			$this->load->view("template/template", $data);
		}
		else
		{
			$data["old_password"] = $this->input->post("txt_old_password");
			$data["new_password"] = $this->input->post("txt_new_password");
			$data["confirm_password"] = $this->input->post("txt_confirm_password");
			
			$cek_old_password = $this->am->check_password($data["old_password"]);

			if($cek_old_password->jml === "1")
			{
				$update = $this->am->update_password($data);

				$data["title"] = "Ubah Password";
				$data["status"] = "success";
				$data["page"] = "view_login/form";
				$data["message"] = "Password Berhasil diubah. Silahkan Logout dan Login kembali";
				$this->load->view("template/template", $data);
			}
			else
			{
				$data["title"] = "Ubah Password";
				$data["status"] = "danger";
				$data["page"] = "view_login/form";
				$data["message"] = "Password Lama tidak sama";
				$this->load->view("template/template", $data);
			}
		}
	}
	
	function logout()
	{
		if($this->session->userdata('isLoggedInUSR') === TRUE)
        {
			$user_id=$this->session->userdata('siswaId');
			$waktu_masuk=$this->session->userdata('waktuLogin');
			$waktu_keluar=date('Y-m-d H:i:s');
			
			if($waktu_masuk=="" || $waktu_keluar=="" || $user_id==""){
				$this->session->sess_destroy();
				redirect("auth");
			}else{
				$this->session->sess_destroy();
				redirect("auth");
			}
			
        }else{
			$this->session->sess_destroy();
			redirect("auth");
		}
	}
	
	function disabled()
    {
		$this->session->sess_destroy();
		$this->load->view('template/info_javascript');
	}
	
	function warning()
	{
		$data["page"] = "template/info_access";
        $data["title"] = "Input is Denied";
		$this->load->view('template/template', $data);
	}
	
	function forbidden()
	{
		$data["page"] = "template/info_access";
        $data["title"] = "Access is Denied";
		$this->load->view('template/template', $data);
	}
	
	function anti_xss($string)
	{
		$filter=stripslashes(strip_tags(htmlspecialchars(trim($string),ENT_QUOTES)));
		return $filter;
	}
}
