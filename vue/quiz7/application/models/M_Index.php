<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Index extends CI_Model {

	function getData(){
		return $this->db->get('tb_siswa')->result();
	}

	function getDataByNoinduk($noinduk){
		$this->db->where('noinduk',$noinduk);
		return $this->db->get('tb_siswa')->result();
	}

	function deleteData($noinduk){
		$this->db->where('noinduk',$noinduk);
		$this->db->delete('tb_siswa');
	}

	function insertData($data){
		$this->db->insert('tb_siswa',$data);
	}

	function updateData($noinduk,$data){
		$this->db->where('noinduk',$noinduk);
		$this->db->update('tb_siswa',$data);
	}
}
