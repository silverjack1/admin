<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

	function validate($username, $userpassword, $field="*")
    {		
		$sql = "select ".$field." from siswa where siswa_username='".$username."' and siswa_password=md5('".$userpassword."') and siswa_is_delete=0";
		
		$query = $this->db->query($sql);
        return $query->num_rows() == 1 ? $query->row() : FALSE;
    }
	
	function check_password($password)
	{
		$siswaId = $this->session->userdata("siswaId");
		$sql = "select count(*) as jml from siswa where siswa_id='".$siswaId."' and siswa_password='".md5($password)."'";
		
		$qry = $this->db->query($sql);
        return $qry->row();
	}
	
	function update_password($data = array())
    {
        $new_password = md5($data["new_password"]);
		$siswaId = $this->session->userdata("siswaId");
        
		$date = date('Y-m-d H:i:s');
		$sql  = "update siswa set siswa_password='".$new_password."', siswa_update_date='".$date."' where siswa_id='".$siswaId."'";
		
        $qry = $this->db->query($sql);
        return $this->db->affected_rows();
    }
}