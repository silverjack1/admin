<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_kelas extends CI_Model {
	public function select_all() {
		$this->db->select('*');
		$this->db->from('kelas');
		// $this->db->join('wali_kelas','wali_kelas.id_kelas=kelas.id_kelas');
		// $this->db->where('id_tahun', $this->session->userdata('tahun_ajaran'));

		$data = $this->db->get();

		return $data->result();
	}

	public function select_for_absensi($tanggal, $tahun_ajaran){
		$sql = "SELECT id_kelas, nama_kelas, 
					IFNULL((SELECT COUNT(absensi.id_absensi)
                            FROM absensi 
                            JOIN pengabsen
                            JOIN pegawai
                            JOIN master_semester
                            WHERE master_semester.id_tahun='{$tahun_ajaran}'
                            AND master_semester.id_master_semester=master_semester.id_master_semester
                            AND pengabsen.id_absensi=absensi.id_absensi
                            AND pengabsen.NIP = pegawai.NIP
                            AND (pegawai.id_jabatan=4 OR pegawai.id_jabatan=1)
                            AND tanggal_presensi='{$tanggal}'
                    		AND absensi.NIS IN (SELECT siswa.NIS 
                                      FROM siswa, anggota_kelas, kelas kls, wali_kelas
                                        WHERE siswa.NIS=anggota_kelas.NIS
                                        AND anggota_kelas.id_wali_kelas=wali_kelas.id_wali_kelas
                                        AND wali_kelas.id_kelas=kls.id_kelas					
                                        AND id_tahun = '{$tahun_ajaran}'
                                        AND kls.id_kelas =kelas.id_kelas
                                     )

					), 0) AS status_absen 
				FROM kelas";

		$data = $this->db->query($sql);

		return $data->result();
	}

	public function select_by_id($id_kelas) {
		$sql = "SELECT * FROM kelas WHERE id_kelas = '{$id_kelas}'";

		$data = $this->db->query($sql);

		return $data->row();
	}

	public function select_limit() {
		$sql = "SELECT * FROM kelas ORDER BY id_kelas ASC LIMIT 1";

		$data = $this->db->query($sql);

		return $data->row();
	}

	// public function select_by_pegawai($id) {
	// 	$sql = " SELECT pegawai.id AS id, pegawai.nama AS pegawai, pegawai.telp AS telp, kota.nama AS kota, kelamin.nama AS kelamin, posisi.nama AS posisi FROM pegawai, kota, kelamin, posisi WHERE pegawai.id_kelamin = kelamin.id AND pegawai.id_posisi = posisi.id AND pegawai.id_kota = kota.id AND pegawai.id_kota={$id}";

	// 	$data = $this->db->query($sql);

	// 	return $data->result();
	// }

	public function selectByPengajar($NIP, $tanggal, $tahun_ajaran){
		$sql  = "SELECT kelas.id_kelas, nama_kelas,
					IFNULL((SELECT COUNT( absensi.id_absensi)
                            FROM absensi 
                            JOIN pengabsen
                            JOIN pegawai
                            JOIN master_semester
                            WHERE master_semester.id_tahun='{$tahun_ajaran}'
                            AND pengabsen.id_absensi=absensi.id_absensi
                            AND pengabsen.NIP = pegawai.NIP
                            AND master_semester.id_master_semester=absensi.id_master_semester
                            AND pegawai.NIP='{$NIP}'
                            AND tanggal_presensi='{$tanggal}'
                    		AND absensi.NIS IN (SELECT siswa.NIS 
                                      FROM siswa, anggota_kelas, kelas kls, wali_kelas
                                        WHERE siswa.NIS=anggota_kelas.NIS
                                        AND anggota_kelas.id_wali_kelas=wali_kelas.id_wali_kelas
                                        AND wali_kelas.id_kelas=kls.id_kelas					
                                        AND id_tahun = '{$tahun_ajaran}'
                                        AND kls.id_kelas =kelas.id_kelas
                                     )
					), 0) AS status_absen 

				 FROM kelas, pengajar, tahun_ajaran WHERE kelas.id_kelas=pengajar.id_kelas AND pengajar.id_tahun = tahun_ajaran.id_tahun AND pengajar.NIP='{$NIP}' AND tahun_ajaran.id_tahun='{$tahun_ajaran}'";

		$data = $this->db->query($sql);

		return $data->result();
	}

	public function selectByPengajarLimit($NIP, $tahun_ajaran){
		$sql  = "SELECT * FROM kelas, pengajar, tahun_ajaran WHERE kelas.id_kelas=pengajar.id_kelas AND pengajar.id_tahun = tahun_ajaran.id_tahun AND pengajar.NIP='{$NIP}' AND tahun_ajaran.id_tahun='{$tahun_ajaran}' LIMIT 1";

		$data = $this->db->query($sql);

		return $data->row();
	}

	public function insert($data) {
		$sql = "INSERT INTO kelas VALUES('','".$data['nama_kelas']."')";

		$this->db->query($sql);

		return $this->db->affected_rows();
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
		$sql_1 = "SELECT * FROM pengajar WHERE id_kelas='" .$id_kelas ."'";
		
		$sql_2 = "SELECT * FROM wali_kelas WHERE id_kelas='" .$id_kelas ."'";
		

		if(($this->db->query($sql_1)->num_rows() > 0) OR ($this->db->query($sql_2)->num_rows() > 0)){
			return 0;
		}
		else{
			$sql = "DELETE FROM kelas WHERE id_kelas='" .$id_kelas ."'";

			$this->db->query($sql);

			return $this->db->affected_rows();
		}
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

	public function cek_format_kelas($str){
		$str = explode('-', $str);

		if (sizeof($str)==1) {
			return FALSE;
		}
		else if(sizeof($str)==3){
			if ($str[0] == 'X' || $str[0] == 'XI' || $str[0] == 'XII') {
				if ($str[1] == 'BAHASA' || $str[1] == 'IPA' || $str[1] == 'IPS') {
					if (is_int(intval($str[2]))) {
						if(intval($str[2]) >0){
							return TRUE;
						}
						else{
							return FALSE;
						}
					}
					else{
						return FALSE;
					}
				}

				else{
					return FALSE;
				}
			}
			else{
				return FALSE;
			}
		}
		else{
			return FALSE;
		}
	}

	public function insertSiswa($data){
		$this->db->trans_start();
		$this->db->trans_strict(FALSE);

		foreach ($data["kelas_baru"] as $NIS => $id_kelas) {
			// $data["NIS"] = $NIS;
			// $data["id_kelas"] = $id_kelas;

			$query = "SELECT id_wali_kelas FROM wali_kelas WHERE id_kelas='{$id_kelas}' AND id_tahun='{$data["tahun_ajaran_sesudah"]}'";
			$result = $this->db->query($query)->row();

			$query_data = "SELECT * FROM anggota_kelas, wali_kelas WHERE NIS='{$NIS}' AND wali_kelas.id_wali_kelas=anggota_kelas.id_wali_kelas AND wali_kelas.id_tahun='{$data["tahun_ajaran_sesudah"]}'";
			$result_data = $this->db->query($query_data);

			if ($result_data->num_rows() == 0) {
				$sql = "INSERT INTO anggota_kelas VALUES('" .$result->id_wali_kelas ."','" .$NIS ."')";
				$this->db->query($sql);
			}
			else{
				$id_wali_kelas = $result_data->row()->id_wali_kelas;
				$sql1 = "DELETE FROM anggota_kelas WHERE  id_wali_kelas='{$id_wali_kelas}' AND NIS='{$NIS}'";
				$this->db->query($sql1);

				$sql2 = "INSERT INTO anggota_kelas VALUES('" .$result->id_wali_kelas ."','" .$NIS ."')";
				$this->db->query($sql2);				
			}
		}

		foreach ($data["kelas_asal"] as $NIS => $id_kelas) {
			// $data["NIS"] = $NIS;
			// $data["id_kelas"] = $id_kelas;
			if($id_kelas != ""){
				$query = "SELECT id_wali_kelas FROM wali_kelas WHERE id_kelas='{$id_kelas}' AND id_tahun='{$data["tahun_ajaran_sebelum"]}'";
				$result = $this->db->query($query)->row();

				$query_data = "SELECT * FROM anggota_kelas, wali_kelas WHERE NIS='{$NIS}' AND wali_kelas.id_wali_kelas=anggota_kelas.id_wali_kelas AND wali_kelas.id_tahun='{$data["tahun_ajaran_sebelum"]}'";
				$result_data = $this->db->query($query_data);

				if ($result_data->num_rows() == 0) {
					$sql = "INSERT INTO anggota_kelas VALUES('" .$result->id_wali_kelas ."','" .$NIS ."')";
					$this->db->query($sql);
				}
				else{
					$id_wali_kelas = $result_data->row()->id_wali_kelas;
					$sql1 = "DELETE FROM anggota_kelas WHERE  id_wali_kelas='{$id_wali_kelas}' AND NIS='{$NIS}'";
					$this->db->query($sql1);

					$sql2 = "INSERT INTO anggota_kelas VALUES('" .$result->id_wali_kelas ."','" .$NIS ."')";
					$this->db->query($sql2);				
				}
			}
		}
		
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
}

/* End of file M_kota.php */
/* Location: ./application/models/M_kota.php */
