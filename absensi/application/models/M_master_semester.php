<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_master_semester extends CI_Model {
	public function select_all() {
		$this->db->select('*');
		$this->db->from('master_semester');

		$data = $this->db->get();

		return $data->result();
	}

	public function select_by_id($id_master_semester) {
		$sql = "SELECT * FROM master_semester WHERE id_master_semester = '{$id_master_semester}'";

		$data = $this->db->query($sql);

		return $data->row();
	}


	public function select_by_date($date) {
		$sql = "SELECT * FROM master_semester WHERE '{$date}' BETWEEN tanggal_mulai AND tanggal_akhir";

		$data = $this->db->query($sql);

		return $data;
	}

	public function select_top() {
		$sql = "SELECT * FROM master_semester ORDER BY id_master_semester DESC LIMIT 1";

		$data = $this->db->query($sql);

		return $data->row();
	}

	public function insert($data) {
		$sql = "INSERT INTO master_semester VALUES('','" .$data['nama_semester'] ."','" .$data['id_tahun'] ."','" .$data['id_semester'] ."','" .$data['tanggal_mulai'] ."','" .$data['tanggal_akhir'] ."')";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function update($data) {
		$sql = "UPDATE master_semester SET nama_semester ='" .$data['nama_semester'] ."', id_tahun='" .$data['id_tahun'] ."', id_semester='" .$data['id_semester'] ."', tanggal_mulai='" .$data['tanggal_mulai'] ."', tanggal_akhir='" .$data['tanggal_akhir'] ."' WHERE id_master_semester ='" .$data['id_master_semester'] ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function delete($id_master_semester) {
		$sql = "DELETE FROM master_semester WHERE id_master_semester='" .$id_master_semester ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function check_nama($nama_mapel) {
		$this->db->where('nama_mapel', $nama_mapel);
		$data = $this->db->get('mapel');

		return $data->num_rows();
	}

	public function total_rows() {
		$data = $this->db->get('master_semester');

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