<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pegawai extends CI_Model {
	public function select_all() {
		//ngeJoin menggunakan Where
		$sql = "SELECT * FROM pegawai, jabatan WHERE pegawai.id_jabatan =  jabatan.id_jabatan";
		$data = $this->db->query($sql);

		return $data->result();
	}

	public function select_guru()
	{
		$sql = "SELECT * FROM pegawai, jabatan WHERE pegawai.id_jabatan =  jabatan.id_jabatan AND (pegawai.id_jabatan=2 OR pegawai.id_jabatan=3)";
		$data = $this->db->query($sql);

		return $data->result();
	}
	public function select_by_id_login($id) {
		//ngeJoin menggunakan Where
		$sql = "SELECT * FROM pegawai, jabatan WHERE pegawai.id_jabatan =  jabatan.id_jabatan AND NIP='{$id}'";
		$data = $this->db->query($sql);

		return $data->row();
	}

	public function select_by_id($id) {
		$sql = "SELECT * FROM pegawai WHERE NIP = '{$id}'";

		$data = $this->db->query($sql);

		return $data->row();
	}

	public function select_all_jabatan(){
		$sql = "SELECT * FROM jabatan";
		$data = $this->db->query($sql);

		return $data->result();
	}

	// public function select_by_pegawai($id) {
	// 	$sql = " SELECT pegawai.id AS id, pegawai.nama AS pegawai, pegawai.telp AS telp, kota.nama AS kota, kelamin.nama AS kelamin, posisi.nama AS posisi FROM pegawai, kota, kelamin, posisi WHERE pegawai.id_kelamin = kelamin.id AND pegawai.id_posisi = posisi.id AND pegawai.id_kota = kota.id AND pegawai.id_posisi={$id}";

	// 	$data = $this->db->query($sql);

	// 	return $data->result();
	// }

	public function insert($data) {
		$sql = "INSERT INTO pegawai VALUES('" .$data['NIP'] ."','" .$data['nama_pegawai'] ."','" .$data['alamat'] ."','" .$data['email'] ."','" .$data['password'] ."','" .$data['status'] ."','" .$data['foto'] ."','" .$data['id_jabatan'] ."')";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function insert_batch($data) {
		$this->db->insert_batch('pegawai', $data);
		
		return $this->db->affected_rows();
	}

	public function update($data) {
		$sql = "UPDATE pegawai SET nama_pegawai='" .$data['nama_pegawai'] ."', alamat='" .$data['alamat'] ."', email='" .$data['email'] ."', password='" .$data['password'] ."', status='" .$data['status'] ."', foto='" .$data['foto'] ."', id_jabatan='" .$data['id_jabatan'] ."' WHERE NIP='" .$data['NIP'] ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function updateProfil($data, $id) {
		$sql = "UPDATE pegawai SET nama_pegawai='" .$data['nama'] ."', alamat='" .$data['alamat'] ."', email='" .$data['email'] ."', foto='" .$data['foto'] ."' WHERE NIP='" .$id ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function updateProfil2($data, $id) {
		$sql = "UPDATE pegawai SET nama_pegawai='" .$data['nama'] ."', alamat='" .$data['alamat'] ."', email='" .$data['email'] ."' WHERE NIP='" .$id ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function updatePassword($data, $id) {
		$sql = "UPDATE pegawai SET password='" .$data['password'] ."' WHERE NIP='" .$id ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function delete($id) {
		$sql_1 = "SELECT * FROM pengabsen WHERE NIP='" .$id ."'";
		$sql_2 = "SELECT * FROM pengajar WHERE NIP='" .$id ."'";
		$sql_3 = "SELECT * FROM spp WHERE NIP='" .$id ."'";
		$sql_4 = "SELECT * FROM wali_kelas WHERE NIP='" .$id ."'";

		if(($this->db->query($sql_1)->num_rows() > 0) OR ($this->db->query($sql_2)->num_rows() > 0) OR
			($this->db->query($sql_3)->num_rows() > 0) OR ($this->db->query($sql_4)->num_rows() > 0)){
			return 0;
		}else{
			$sql = "DELETE FROM pegawai WHERE NIP='" .$id ."'";

			$this->db->query($sql);

			return $this->db->affected_rows();
		}
	}

	public function check_nama($nama) {
		$this->db->where('nama_pegawai', $nama);
		$data = $this->db->get('pegawai');

		return $data->num_rows();
	}

	public function check_nip($nip) {
		$this->db->where('nip', $nip);
		$data = $this->db->get('pegawai');

		return $data->num_rows();
	}

	public function total_rows() {
		$data = $this->db->get('pegawai
			');

		return $data->num_rows();
	}
}

/* End of file M_posisi.php */
/* Location: ./application/models/M_posisi.php */