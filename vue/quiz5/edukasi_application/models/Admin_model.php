<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

	function validate($username, $userpassword, $field="*")
    {		
		$sql = "select ".$field." from admin where admin_username='".$username."' and admin_password=md5('".$userpassword."') and admin_is_delete=0";
		
		$query = $this->db->query($sql);
        return $query->num_rows() == 1 ? $query->row() : FALSE;
    }
	
	function check_password($password)
	{
		$username = $this->session->userdata("userName");
		$sql = "select count(*) as jml from admin where admin_username='".$username."' and admin_password='".md5($password)."'";
		
		$qry = $this->db->query($sql);
        return $qry->row();
	}
	
	function update_password($data = array())
    {
        $old_password = $data["old_password"];
        $new_password = md5($data["new_password"]);
		$username = $this->session->userdata("userName");
       
	    $date = date('Y-m-d H:i:s');
		$sql = "update admin set admin_password='".$new_password."', admin_update_date='".$date."' where admin_username='".$username."'";
		
        $qry = $this->db->query($sql);
        return $this->db->affected_rows();
    }
}