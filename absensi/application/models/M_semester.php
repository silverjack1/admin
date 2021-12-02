<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_semester extends CI_Model {
	public function select_all() {
		$this->db->select('*');
		$this->db->from('semester');

		$data = $this->db->get();

		return $data->result();
	}

	public function select_by_id($id_semester) {
		$sql = "SELECT * FROM semester WHERE id_semester = '{$id_semester}'";

		$data = $this->db->query($sql);

		return $data->row();
	}

	public function select_by_tahun($id_tahun) {
		$sql = "SELECT * FROM tahun_ajaran WHERE tahun = '{$id_tahun}'";

		$data = $this->db->query($sql);

		return $data->row();
	}

	// public function select_tahun_ajaran_saatini(){
	// 	$tanggal = date('d');
	// 	$bulan = date('n');
	// 	$tahun = date('Y');
	// 	if(intval($bulan)<=7 && intval($tanggal<=15)){
	// 		$tahun_ajaran= (intval($tahun)-1).'/'.$tahun;
	// 	}
	// 	else{
	// 		$tahun_ajaran= $tahun.'/'.(intval($tahun)+1);
	// 	}

	// 	$sql = "SELECT * FROM tahun_ajaran WHERE tahun='{$tahun_ajaran}'";
	// 	$data = $this->db->query($sql);
	// 	return $data->row();

	// }


	public function insert($data) {
		$sql = "INSERT INTO tahun_ajaran VALUES('','" .$data['tahun'] ."')";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function insert_batch($data) {
		$this->db->insert_batch('tahun_ajaran', $data);
		
		return $this->db->affected_rows();
	}

	public function update($data) {
		$sql = "UPDATE tahun_ajaran SET tahun ='" .$data['tahun'] ."' WHERE id_tahun ='" .$data['id_tahun'] ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function delete($id_tahun) {
		$sql = "DELETE FROM tahun_ajaran WHERE id_tahun='" .$id_tahun ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function check_nama($tahun) {
		$this->db->where('tahun', $tahun);
		$data = $this->db->get('tahun_ajaran');

		return $data->num_rows();
	}

	public function total_rows() {
		$data = $this->db->get('tahun_ajaran');

		return $data->num_rows();
	}
}

/* End of file M_kota.php */
/* Location: ./application/models/M_kota.php */