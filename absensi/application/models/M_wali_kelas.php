<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_wali_kelas extends CI_Model {
	public function select_all_wali_kelas() {
		$sql = "SELECT * FROM wali_kelas";

		$data = $this->db->query($sql);

		return $data->result();
	}

	// public function select_all() {
	// 	$sql = " SELECT * FROM wali_kelas, pegawai, kelas, tahun_ajaran WHERE wali_kelas.NIP=pegawai.NIP AND wali_kelas.id_kelas=kelas.id_kelas AND wali_kelas.id_tahun=tahun_ajaran.id_tahun AND (pegawai.id_jabatan= 2 OR pegawai.id_jabatan=3) ORDER BY tahun_ajaran.tahun DESC";

	// 	$data = $this->db->query($sql);

	// 	return $data->result();
	// }

	public function select_all_by_ta($id_tahun){
		$sql = " SELECT * FROM wali_kelas, pegawai, kelas, tahun_ajaran WHERE wali_kelas.NIP=pegawai.NIP AND wali_kelas.id_kelas=kelas.id_kelas AND wali_kelas.id_tahun=tahun_ajaran.id_tahun AND (pegawai.id_jabatan= 2 OR pegawai.id_jabatan=3) AND wali_kelas.id_tahun = '{$id_tahun}' ORDER BY kelas.id_kelas";

		$data = $this->db->query($sql);

		return $data->result();
	}

	public function select_all_by_ta_limit($id_tahun){
		$sql = " SELECT * FROM wali_kelas, pegawai, kelas, tahun_ajaran WHERE wali_kelas.NIP=pegawai.NIP AND wali_kelas.id_kelas=kelas.id_kelas AND wali_kelas.id_tahun=tahun_ajaran.id_tahun AND (pegawai.id_jabatan= 2 OR pegawai.id_jabatan=3) AND wali_kelas.id_tahun = '{$id_tahun}' ORDER BY kelas.id_kelas LIMIT 1";

		$data = $this->db->query($sql);

		return $data->row();
	}
	public function select_by_id($id) {
		$sql = "SELECT * FROM wali_kelas WHERE id_wali_kelas = '{$id}'";

		$data = $this->db->query($sql);

		return $data->row();
	}


	public function insert($data) {
		$sql = "INSERT INTO wali_kelas VALUES('','" .$data['NIP'] ."','" .$data['id_kelas'] ."','" .$data['id_tahun'] ."')";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function insert_batch($data) {
		$this->db->insert_batch('wali_kelas', $data);
		
		return $this->db->affected_rows();
	}

	public function update($data) {
		$sql = "UPDATE wali_kelas SET NIP ='" .$data['NIP'] ."', id_kelas='" .$data['id_kelas'] ."', id_tahun='" .$data['id_tahun'] ."' WHERE id_wali_kelas ='" .$data['id_wali_kelas'] ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function delete($id) {
		$sql_1 = "SELECT * FROM anggota_kelas WHERE id_wali_kelas='" .$id ."'";

		if($this->db->query($sql_1)->num_rows() > 0){
			return 0;
		}else{
			$sql = "DELETE FROM wali_kelas WHERE id_wali_kelas='" .$id ."'";

			$this->db->query($sql);

			return $this->db->affected_rows();
		}
	}

	// public function check_nama($nama) {
	// 	$this->db->where('jenis_biaya', $nama);
	// 	$data = $this->db->get('mastertabelbiaya');

	// 	return $data->num_rows();
	// }

	public function total_rows() {
		$data = $this->db->get('wali_kelas');

		return $data->num_rows();
	}

	// public function select_pengajar($id_mapel) {
	// 	$this->db->select('*');
	// 	$this->db->from('pengajar');
	// 	$this->db->where('id_mapel', $id_mapel);
		
	// 	$data = $this->db->get();

	// 	return $data->num_rows();
	// }

	public function cek_duplikat_guru($NIP, $id_tahun){
		$sql = "SELECT * FROM wali_kelas, kelas, pegawai WHERE wali_kelas.id_kelas=kelas.id_kelas AND pegawai.NIP=wali_kelas.NIP AND wali_kelas.NIP ='{$NIP}' AND wali_kelas.id_tahun='{$id_tahun}'";

		$data = $this->db->query($sql);
		
		return $data;
	}

	public function cek_duplikat_wali($id_kelas, $id_tahun){
		$sql = "SELECT * FROM wali_kelas, kelas, pegawai WHERE wali_kelas.id_kelas=kelas.id_kelas AND pegawai.NIP=wali_kelas.NIP AND wali_kelas.id_kelas ='{$id_kelas}' AND wali_kelas.id_tahun='{$id_tahun}'";

		$data = $this->db->query($sql);
		
		return $data;
	}

}

/* End of file M_kota.php */
/* Location: ./application/models/M_kota.php */