<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller
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
	
	public function index()
	{
		$data["page"]  = "home_admin";
        $data["title"] = "Home Administrator";
		$this->load->view('templates/template', $data);
	}
	
    private function cek_login()
    {
        if( ! $this->session->userdata('isLoggedInADM') OR $this->session->userdata('isLoggedInADM') === FALSE)
        {
            redirect("adm");
        }
    }
}
