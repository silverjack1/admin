<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_mapel extends CI_Model {
	public function select_all() {
		$this->db->select('*');
		$this->db->from('mapel');

		$data = $this->db->get();

		return $data->result();
	}

	public function select_by_id($id_mapel) {
		$sql = "SELECT * FROM mapel WHERE id_mapel = '{$id_mapel}'";

		$data = $this->db->query($sql);

		return $data->row();
	}


	public function insert($data) {
		$sql = "INSERT INTO mapel VALUES('','" .$data['nama_mapel'] ."')";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function insert_batch($data) {
		$this->db->insert_batch('mapel', $data);
		
		return $this->db->affected_rows();
	}

	public function update($data) {
		$sql = "UPDATE mapel SET nama_mapel ='" .$data['nama_mapel'] ."' WHERE id_mapel ='" .$data['id_mapel'] ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function delete($id_mapel) {
		$sql = "DELETE FROM mapel WHERE id_mapel='" .$id_mapel ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function check_nama($nama_mapel) {
		$this->db->where('nama_mapel', $nama_mapel);
		$data = $this->db->get('mapel');

		return $data->num_rows();
	}

	public function total_rows() {
		$data = $this->db->get('mapel');

		return $data->num_rows();
	}

	public function select_pengajar($id_mapel) {
		$this->db->select('*');
		$this->db->from('pengajar');
		$this->db->where('id_mapel', $id_mapel);
		
		$data = $this->db->get();

		return $data->num_rows();
	}
}

/* End of file M_kota.php */
/* Location: ./application/models/M_kota.php */