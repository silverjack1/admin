<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_absensi extends CI_Model {
	public function select_all() {
		$this->db->select('*');
		$this->db->from('absensi');
		// $this->db->join('wali_kelas','wali_kelas.id_kelas=kelas.id_kelas');
		// $this->db->where('id_tahun', $this->session->userdata('tahun_ajaran'));

		$data = $this->db->get();

		return $data->result();
	}

	public function select_by_id($id_absensi) {
		$sql = "SELECT * FROM absensi WHERE id_absensi = '{$id_absensi}'";

		$data = $this->db->query($sql);

		return $data->row();
	}

	public function select_for_laporan($id_kelas, $id_semester, $id_tahun){
		$query = "SELECT siswa.NIS, siswa.nama_siswa, 
					/*hadir*/
					IFNULL((SELECT COUNT(absensi.presensi)
					FROM absensi, master_semester
					WHERE absensi.presensi='Hadir'
					AND master_semester.id_master_semester=absensi.id_master_semester
					AND master_semester.id_semester='{$id_semester}'
					AND master_semester.id_tahun='{$id_tahun}'
					AND absensi.NIS=siswa.NIS
					AND absensi.NIS IN(SELECT siswa.NIS
									FROM siswa, wali_kelas, anggota_kelas
									WHERE wali_kelas.id_wali_kelas=anggota_kelas.id_wali_kelas
									AND anggota_kelas.NIS = siswa.NIS
									AND wali_kelas.id_kelas = '{$id_kelas}'
									ORDER BY siswa.NIS ASC)
					GROUP BY absensi.NIS
					ORDER BY absensi.NIS ASC), 0) AS hadir,

					/*sakit*/
					IFNULL((SELECT COUNT(absensi.presensi)
					FROM absensi, master_semester
					WHERE absensi.presensi='Sakit'
					AND master_semester.id_master_semester=absensi.id_master_semester
					AND master_semester.id_semester='{$id_semester}'
					AND master_semester.id_tahun='{$id_tahun}'
					AND absensi.NIS=siswa.NIS
					AND absensi.NIS IN(SELECT siswa.NIS
									FROM siswa, wali_kelas, anggota_kelas
									WHERE wali_kelas.id_wali_kelas=anggota_kelas.id_wali_kelas
									AND anggota_kelas.NIS = siswa.NIS
									AND wali_kelas.id_kelas = '{$id_kelas}'
									ORDER BY siswa.NIS ASC)
					GROUP BY absensi.NIS
					ORDER BY absensi.NIS ASC), 0) AS sakit,

					/*ijin*/
					IFNULL((SELECT COUNT(absensi.presensi)
					FROM absensi, master_semester
					WHERE absensi.presensi='Ijin'
					AND master_semester.id_master_semester=absensi.id_master_semester
					AND master_semester.id_semester='{$id_semester}'
					AND master_semester.id_tahun='{$id_tahun}'
					AND absensi.NIS=siswa.NIS
					AND absensi.NIS IN(SELECT siswa.NIS
									FROM siswa, wali_kelas, anggota_kelas
									WHERE wali_kelas.id_wali_kelas=anggota_kelas.id_wali_kelas
									AND anggota_kelas.NIS = siswa.NIS
									AND wali_kelas.id_kelas = '{$id_kelas}'
									ORDER BY siswa.NIS ASC)
					GROUP BY absensi.NIS
					ORDER BY absensi.NIS ASC), 0) AS ijin,

					/*tanpa keterangan*/
					IFNULL((SELECT COUNT(absensi.presensi)
					FROM absensi, master_semester
					WHERE absensi.presensi='Tanpa Keterangan'
					AND master_semester.id_master_semester=absensi.id_master_semester
					AND master_semester.id_semester='{$id_semester}'
					AND master_semester.id_tahun='{$id_tahun}'
					AND absensi.NIS=siswa.NIS
					AND absensi.NIS IN(SELECT siswa.NIS
									FROM siswa, wali_kelas, anggota_kelas
									WHERE wali_kelas.id_wali_kelas=anggota_kelas.id_wali_kelas
									AND anggota_kelas.NIS = siswa.NIS
									AND wali_kelas.id_kelas = '{$id_kelas}'
									ORDER BY siswa.NIS ASC)
					GROUP BY absensi.NIS
					ORDER BY absensi.NIS ASC), 0) AS alasan

				FROM siswa, wali_kelas, anggota_kelas 
				-- WHERE absensi.NIS=siswa.NIS 
				-- AND absensi.id_master_semester AND master_semester.id_master_semester
				WHERE wali_kelas.id_wali_kelas=anggota_kelas.id_wali_kelas 
				AND anggota_kelas.NIS=siswa.NIS 
				-- AND master_semester.id_tahun=wali_kelas.id_tahun 
				AND id_kelas='{$id_kelas}' 
				AND wali_kelas.id_tahun='{$id_tahun}' 
				-- AND master_semester.id_semester='{$id_semester}'
				GROUP BY siswa.NIS
				ORDER BY siswa.NIS ASC";
			
		$data = $this->db->query($query);

		return $data;
	}

	public function select_status_presensi(){
		$sql = "SELECT DISTINCT presensi FROM absensi";

		$data = $this->db->query($sql);

		return $data;
	}

	public function count_presensi($presensi, $tanggal){
		$sql = "SELECT COUNT(*) AS jml FROM absensi WHERE tanggal_presensi='{$tanggal}' AND presensi='{$presensi}'";

		$data = $this->db->query($sql);

		return $data->row();
	}

	public function count_absensi($tanggal){
		$sql = "SELECT COUNT(*) AS jml FROM absensi WHERE tanggal_presensi='{$tanggal}'";

		$data = $this->db->query($sql);

		return $data->row();
	}

	// public function select_by_pegawai($id) {
	// 	$sql = " SELECT pegawai.id AS id, pegawai.nama AS pegawai, pegawai.telp AS telp, kota.nama AS kota, kelamin.nama AS kelamin, posisi.nama AS posisi FROM pegawai, kota, kelamin, posisi WHERE pegawai.id_kelamin = kelamin.id AND pegawai.id_posisi = posisi.id AND pegawai.id_kota = kota.id AND pegawai.id_kota={$id}";

	// 	$data = $this->db->query($sql);

	// 	return $data->result();
	// }
	public function select_by_kelas_ta_tgl($id_kelas, $id_tahun, $tanggal_presensi){
		$query = "SELECT * FROM absensi, siswa, wali_kelas, anggota_kelas, master_semester WHERE absensi.NIS=siswa.NIS AND wali_kelas.id_wali_kelas=anggota_kelas.id_wali_kelas AND anggota_kelas.NIS=siswa.NIS AND master_semester.id_tahun=wali_kelas.id_tahun AND id_kelas='{$id_kelas}' AND master_semester.id_tahun='{$id_tahun}' AND absensi.id_master_semester=master_semester.id_master_semester AND tanggal_presensi='{$tanggal_presensi}'";
			
		$data = $this->db->query($query);

		return $data;
	}

	public function insert($data) {

		if($data['semester']==""){
			return FALSE;
		}
		$this->db->trans_start();
		$this->db->trans_strict(FALSE);

		foreach ($data["absensi"] as $NIS => $presensi) {
			$data["NIS"] = $NIS;
			$data["presensi"] = $presensi;

			$query = "SELECT id_absensi FROM absensi, master_semester WHERE NIS='{$data["NIS"]}' AND id_tahun='{$data["tahun_ajaran"]}' AND tanggal_presensi='{$data["tanggal"]}' AND master_semester.id_master_semester=absensi.id_master_semester";
			
			$result = $this->db->query($query);

			if ($result->num_rows() == 0) {
				$sql = "INSERT INTO absensi VALUES('','" .$data['NIS'] ."','" .$data['semester'] ."','" .$data['tanggal'] ."','" .$data['presensi'] ."')";
				$this->db->query($sql);

				$sql = "SELECT id_absensi FROM absensi ORDER BY id_absensi DESC LIMIT 1";
				$id_absensi = $this->db->query($sql)->row()->id_absensi;


				$sql = "INSERT INTO pengabsen VALUES('".$id_absensi."','" .$data['NIP'] ."')";
				$this->db->query($sql);
			}
			else{
				$id = $result->row()->id_absensi;
				$sql = "SELECT NIP FROM pengabsen WHERE NIP='{$data["NIP"]}' AND id_absensi='{$id}'";
				
				if($this->db->query($sql)->num_rows()==0){
					$sql = "UPDATE absensi SET presensi='" .$data['presensi'] ."' WHERE id_absensi='{$id}'";
					$this->db->query($sql);

					$sql = "INSERT INTO pengabsen VALUES('".$id."','" .$data['NIP'] ."')";
					$this->db->query($sql);
				}
				else{
					$sql = "UPDATE absensi SET presensi='" .$data['presensi'] ."' WHERE id_absensi='{$id}'";
					$this->db->query($sql);
				}

				// $this->db->query($sql);
			}
		}
		// foreach ($data["presensi"] as $id_bulan) {
				// $data["id_bulan"] = $id_bulan;
				// $sql = "INSERT INTO spp VALUES('','" .$data['NIS'] ."','" .$data['id_bulan'] ."','" .$data['id_tahun'] ."','" .$data['tanggal_bayar'] ."','" .$data['NIP'] ."','" .$data['status_pembayaran'] ."','" .$data['nominal'] ."')";
				// $this->db->query($sql);
		// }

		$this->db->trans_complete();

		if ($this->db->trans_status()==FALSE) {
			$this->db->trans_rollback();
			return FALSE;
		}
		else{
			$this->db->trans_commit();
			return TRUE;
		}
	}

	public function insert_batch($data) {
		$this->db->insert_batch('kelas', $data);
		
		return $this->db->affected_rows();
	}

	public function update($data) {
		$sql = "UPDATE kelas SET nama_kelas='" .$data['nama_kelas'] ."' WHERE id_kelas='" .$data['id_kelas'] ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function delete($id_kelas) {
		$sql = "DELETE FROM kelas WHERE id_kelas='" .$id_kelas ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function check_nama($nama_kelas) {
		$this->db->where('nama_kelas', $nama_kelas);
		$data = $this->db->get('kelas');

		return $data->num_rows();
	}

	public function total_rows() {
		$data = $this->db->get('kelas');

		return $data->num_rows();
	}
}

/* End of file M_kota.php */
/* Location: ./application/models/M_kota.php */
