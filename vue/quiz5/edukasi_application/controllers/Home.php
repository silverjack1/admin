<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

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
	
	public function index()
	{
		$data["page"]  = "home_user";
		$data["title"] = "Assalamu'alaikum";
		$this->load->view('template/template',$data);
	}
	
	private function cek_login()
    {
        if( ! $this->session->userdata('isLoggedInUSR') OR $this->session->userdata('isLoggedInUSR') === FALSE)
        {
            redirect("auth");
        }
    }
}
