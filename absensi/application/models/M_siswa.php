<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_siswa extends CI_Model {
	public function select_all() {
		$data = $this->db->get('siswa');

		return $data->result();
	}

	public function select_by_id($id) {
		$sql = "SELECT * FROM siswa WHERE NIS = '{$id}'";

		$data = $this->db->query($sql);

		return $data->row();
	}

	public function select_for_absensi($id_kelas, $tahun) {
		$sql = "SELECT * FROM siswa, kelas, anggota_kelas, wali_kelas, tahun_ajaran WHERE siswa.NIS=anggota_kelas.NIS AND anggota_kelas.id_wali_kelas=wali_kelas.id_wali_kelas AND wali_kelas.id_kelas=kelas.id_kelas AND wali_kelas.id_tahun=tahun_ajaran.id_tahun AND  kelas.id_kelas = '{$id_kelas}' AND tahun_ajaran.id_tahun='{$tahun}' AND status_siswa='Aktif'";

		$data = $this->db->query($sql);

		return $data->result();
	}

	public function select_by_kelas_ta($id_kelas, $id_tahun) {
		// $post = $this->input->post();
		// $id_tahun = $post["tahun_ajaran"];
		$sql = "SELECT * FROM siswa, kelas, anggota_kelas, wali_kelas, tahun_ajaran WHERE siswa.NIS=anggota_kelas.NIS AND anggota_kelas.id_wali_kelas=wali_kelas.id_wali_kelas AND wali_kelas.id_kelas=kelas.id_kelas AND wali_kelas.id_tahun=tahun_ajaran.id_tahun AND  kelas.id_kelas = '{$id_kelas}' AND tahun_ajaran.id_tahun='{$id_tahun}'";

		$data = $this->db->query($sql);

		return $data->result();
	}

	public function select_by_pegawai($id) {
		$sql = " SELECT pegawai.id AS id, pegawai.nama AS pegawai, pegawai.telp AS telp, kota.nama AS kota, kelamin.nama AS kelamin, posisi.nama AS posisi FROM pegawai, kota, kelamin, posisi WHERE pegawai.id_kelamin = kelamin.id AND pegawai.id_posisi = posisi.id AND pegawai.id_kota = kota.id AND pegawai.id_posisi={$id}";

		$data = $this->db->query($sql);

		return $data->result();
	}

	public function insert($data) {
		$sql = "INSERT INTO siswa VALUES('" .$data['NIS'] ."','" .$data['nama_siswa'] ."','" .$data['tahun_masuk'] ."','" .$data['tempat_lahir'] ."','" .$data['tanggal_lahir'] ."','" .$data['jenis_kelamin'] ."','" .$data['alamat'] ."','" .$data['foto'] ."','" .$data['status_siswa'] ."')";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function insert_batch($data) {
		$this->db->insert_batch('siswa', $data);
		
		return $this->db->affected_rows();
	}

	public function update($data) {
		$sql = "UPDATE siswa SET nama_siswa='" .$data['nama_siswa'] ."', tahun_masuk='" .$data['tahun_masuk'] ."', tempat_lahir='" .$data['tempat_lahir'] ."', tanggal_lahir='" .$data['tanggal_lahir'] ."', jenis_kelamin='" .$data['jenis_kelamin'] ."', alamat='" .$data['alamat'] ."', foto='" .$data['foto'] ."', status_siswa='" .$data['status_siswa'] ."' WHERE NIS='" .$data['NIS'] ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function delete($id) {
		$sql_1 = "SELECT * FROM absensi WHERE NIS='" .$id ."'";
		$sql_2 = "SELECT * FROM anggota_kelas WHERE NIS='" .$id ."'";
		$sql_3 = "SELECT * FROM potongan WHERE NIS='" .$id ."'";
		$sql_4 = "SELECT * FROM spp WHERE NIS='" .$id ."'";

		if(($this->db->query($sql_1)->num_rows() > 0) OR ($this->db->query($sql_2)->num_rows() > 0) OR
			($this->db->query($sql_3)->num_rows() > 0) OR ($this->db->query($sql_4)->num_rows() > 0)){
			return 0;
		}else{
			$sql = "DELETE FROM siswa WHERE NIS='" .$id ."'";

			$this->db->query($sql);

			return $this->db->affected_rows();
		}
	}

	public function check_nama($nama) {
		$this->db->where('nama_siswa', $nama);
		$data = $this->db->get('siswa');

		return $data->num_rows();
	}

	public function total_rows() {
		$data = $this->db->get('siswa');

		return $data->num_rows();
	}

	public function select_detail_siswa($tahun, $NIS) {
		$sql = "SELECT * FROM siswa, kelas, anggota_kelas, wali_kelas, tahun_ajaran WHERE siswa.NIS=anggota_kelas.NIS AND anggota_kelas.id_wali_kelas=wali_kelas.id_wali_kelas AND wali_kelas.id_kelas=kelas.id_kelas AND wali_kelas.id_tahun=tahun_ajaran.id_tahun AND tahun_ajaran.id_tahun='{$tahun}' AND siswa.NIS = '{$NIS}'";

		$data = $this->db->query($sql);

		return $data->row();
	}

	public function count_by_tahun_ajaran($tahun_ajaran){
		$sql = "SELECT COUNT(*) AS jml FROM siswa, anggota_kelas, wali_kelas, tahun_ajaran WHERE siswa.NIS=anggota_kelas.NIS AND anggota_kelas.id_wali_kelas=wali_kelas.id_wali_kelas AND  wali_kelas.id_tahun=tahun_ajaran.id_tahun AND tahun_ajaran.id_tahun='{$tahun_ajaran}' AND status_siswa='Aktif'";

		$data = $this->db->query($sql);

		return $data->row();
	}

	public function select_by_tahun_ajaran($id_kelas,$tahun_ajaran_asal, $tahun_ajaran_baru){
		if($id_kelas != ''){
			$sql = "SELECT siswa.NIS as NIS, siswa.nama_siswa as nama_siswa,

					IFNULL((SELECT kls1.nama_kelas
					FROM kelas kls1, anggota_kelas ak1, wali_kelas wk1, tahun_ajaran ta1
					WHERE kls1.id_kelas = wk1.id_kelas
					AND wk1.id_wali_kelas= ak1.id_wali_kelas
					AND ak1.NIS=siswa.NIS
					AND wk1.id_tahun=ta1.id_tahun
					AND ta1.id_tahun= '{$tahun_ajaran_asal}'), 'Siswa Baru') AS nama_kelas_asal,

					IFNULL((SELECT kls2.nama_kelas
					FROM kelas kls2, anggota_kelas ak2, wali_kelas wk2, tahun_ajaran ta2
					WHERE kls2.id_kelas = wk2.id_kelas
					AND wk2.id_wali_kelas= ak2.id_wali_kelas
					AND ak2.NIS=siswa.NIS
					AND wk2.id_tahun=ta2.id_tahun
					AND ta2.id_tahun= $tahun_ajaran_baru), '-') AS nama_kelas_baru

				FROM siswa,kelas, anggota_kelas, wali_kelas, tahun_ajaran
				WHERE kelas.id_kelas = wali_kelas.id_kelas
				AND wali_kelas.id_wali_kelas= anggota_kelas.id_wali_kelas
				AND anggota_kelas.NIS=siswa.NIS
				AND wali_kelas.id_tahun=tahun_ajaran.id_tahun
				AND tahun_ajaran.id_tahun= '{$tahun_ajaran_asal}'
				AND kelas.id_kelas= '{$id_kelas}'";
		}
		else{
			$sql = "SELECT siswa.NIS as NIS, siswa.nama_siswa as nama_siswa,

					IFNULL((SELECT kls1.nama_kelas
					FROM kelas kls1, anggota_kelas ak1, wali_kelas wk1, tahun_ajaran ta1
					WHERE kls1.id_kelas = wk1.id_kelas
					AND wk1.id_wali_kelas= ak1.id_wali_kelas
					AND ak1.NIS=siswa.NIS
					AND wk1.id_tahun=ta1.id_tahun
					AND ta1.id_tahun= '{$tahun_ajaran_asal}'), 'Siswa Baru') AS nama_kelas_asal,

					IFNULL((SELECT kls2.nama_kelas
					FROM kelas kls2, anggota_kelas ak2, wali_kelas wk2, tahun_ajaran ta2
					WHERE kls2.id_kelas = wk2.id_kelas
					AND wk2.id_wali_kelas= ak2.id_wali_kelas
					AND ak2.NIS=siswa.NIS
					AND wk2.id_tahun=ta2.id_tahun
					AND ta2.id_tahun= '{$tahun_ajaran_baru}'), '-') AS nama_kelas_baru

					FROM siswa
					WHERE siswa.NIS NOT IN ( SELECT anggota_kelas.NIS FROM kelas, anggota_kelas, wali_kelas, tahun_ajaran
	                                        WHERE kelas.id_kelas = wali_kelas.id_kelas
	                                        AND wali_kelas.id_wali_kelas= anggota_kelas.id_wali_kelas
	                                        AND anggota_kelas.NIS=siswa.NIS
	                                        AND wali_kelas.id_tahun=tahun_ajaran.id_tahun

	                                        AND tahun_ajaran.id_tahun= '{$tahun_ajaran_asal}')
	                       AND siswa.tahun_masuk= SUBSTRING((SELECT ta.tahun FROM tahun_ajaran ta WHERE id_tahun = '{$tahun_ajaran_asal}'), 1,4)";

		}

		// $sql = "SELECT siswa.NIS AS NIS, siswa.nama_siswa AS nama_siswa, kelas.nama_kelas AS nama_kelas FROM siswa 
		// 		LEFT JOIN anggota_kelas ON siswa.NIS=anggota_kelas.NIS
		// 		LEFT JOIN wali_kelas ON wali_kelas.id_wali_kelas= anggota_kelas.id_wali_kelas
		// 		LEFT JOIN tahun_ajaran ON wali_kelas.id_tahun=tahun_ajaran.id_tahun
		// 		LEFT JOIN kelas ON kelas.id_kelas = wali_kelas.id_kelas
		// 		WHERE siswa.status_siswa='Aktif'";

		$data = $this->db->query($sql);

		return $data->result();
	}

	public function check_nis($nis) {
		$this->db->where('nis', $nis);
		$data = $this->db->get('siswa');

		return $data->num_rows();
	}
}

/* End of file M_posisi.php */
/* Location: ./application/models/M_posisi.php */