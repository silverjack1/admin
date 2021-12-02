<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pengajar extends CI_Model {
	public function select_all_pengajar() {
		$sql = "SELECT * FROM pengajar";

		$data = $this->db->query($sql);

		return $data->result();
	}

	// public function select_all() {
	// 	$sql = " SELECT * FROM pengajar, pegawai, kelas,mapel, tahun_ajaran WHERE pengajar.NIP=pegawai.NIP AND pengajar.id_kelas=kelas.id_kelas AND pengajar.id_mapel=mapel.id_mapel AND pengajar.id_tahun=tahun_ajaran.id_tahun AND (pegawai.id_jabatan=2 OR pegawai.id_jabatan=3) ORDER BY tahun_ajaran.tahun  DESC";

	// 	$data = $this->db->query($sql);

	// 	return $data->result();
	// }

	public function select_all($id_tahun) {
		$sql = " SELECT * FROM pengajar, pegawai, kelas,mapel, tahun_ajaran WHERE pengajar.NIP=pegawai.NIP AND pengajar.id_kelas=kelas.id_kelas AND pengajar.id_mapel=mapel.id_mapel AND pengajar.id_tahun=tahun_ajaran.id_tahun AND (pegawai.id_jabatan=2 OR pegawai.id_jabatan=3) AND pengajar.id_tahun = '{$id_tahun}' ORDER BY pengajar.NIP, pengajar.id_kelas";

		$data = $this->db->query($sql);

		return $data->result();
	}

	public function select_by_tahun($id_tahun) {
		$sql = " SELECT * FROM pengajar, pegawai, kelas,mapel, tahun_ajaran WHERE pengajar.NIP=pegawai.NIP AND pengajar.id_kelas=kelas.id_kelas AND pengajar.id_mapel=mapel.id_mapel AND pengajar.id_tahun=tahun_ajaran.id_tahun AND (pegawai.id_jabatan=2 OR pegawai.id_jabatan=3) AND tahun_ajaran.id_tahun='{$id_tahun}' ORDER BY tahun_ajaran.tahun DESC";

		$data = $this->db->query($sql);

		return $data->result();
	}

	public function select_by_id($id) {
		$sql = "SELECT * FROM pengajar WHERE id_pengajar = '{$id}'";

		$data = $this->db->query($sql);

		return $data->row();
	}

	public function select_by_mapel($id) {
		$sql = "SELECT DISTINCT pengajar.NIP, nama_pegawai FROM pengajar, mapel, pegawai WHERE pengajar.NIP=pegawai.NIP AND mapel.id_mapel=pengajar.id_mapel AND mapel.id_mapel = '{$id}'";

		$data = $this->db->query($sql);

		return $data->result();
	}


	public function insert($data) {
		$sql = "INSERT INTO pengajar VALUES('','" .$data['NIP'] ."','" .$data['id_kelas'] ."','" .$data['id_mapel'] ."','" .$data['id_tahun'] ."')";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function insert_batch($data) {
		$this->db->insert_batch('pengajar', $data);
		
		return $this->db->affected_rows();
	}

	public function update($data) {
		$sql = "UPDATE pengajar SET NIP ='" .$data['NIP'] ."', id_kelas='" .$data['id_kelas'] ."', id_mapel='" .$data['id_mapel'] ."', id_tahun='" .$data['id_tahun'] ."' WHERE id_pengajar ='" .$data['id_pengajar'] ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function delete($id) {
		$sql = "DELETE FROM pengajar WHERE id_pengajar='" .$id ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function check_mapel_tahun_kelas($mapel, $tahun, $kelas) {
		$this->db->where('id_mapel', $mapel);
		$this->db->where('id_tahun', $tahun);
		$this->db->where('id_kelas', $kelas);
		$data = $this->db->get('pengajar');

		return $data;
	}

	public function check_pengajar_tahun_kelas($NIP, $tahun, $kelas) {
		$this->db->where('NIP', $NIP);
		$this->db->where('id_tahun', $tahun);
		$this->db->where('id_kelas', $kelas);
		$data = $this->db->get('pengajar');

		return $data;
	}

	public function total_rows() {
		$data = $this->db->get('pengajar');

		return $data->num_rows();
	}

	// public function select_pengajar($id_mapel) {
	// 	$this->db->select('*');
	// 	$this->db->from('pengajar');
	// 	$this->db->where('id_mapel', $id_mapel);
		
	// 	$data = $this->db->get();

	// 	return $data->num_rows();
	// }
}

/* End of file M_kota.php */
/* Location: ./application/models/M_kota.php */