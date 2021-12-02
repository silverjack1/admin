<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_tahun_ajaran extends CI_Model {
	public function select_all() {
		$this->db->select('*');
		$this->db->from('tahun_ajaran');
		$this->db->order_by('tahun');

		$data = $this->db->get();

		return $data->result(); //result barise akih
	}

	public function select_by_id($id_tahun) {
		$sql = "SELECT * FROM tahun_ajaran WHERE id_tahun = '{$id_tahun}'";

		$data = $this->db->query($sql);

		return $data->row(); // ssatu baris aja
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
		$sql_1 = "SELECT * FROM absensi WHERE id_tahun='" .$id_tahun ."'";
		$sql_2 = "SELECT * FROM pengajar WHERE id_tahun='" .$id_tahun ."'";
		$sql_3 = "SELECT * FROM spp WHERE id_tahun='" .$id_tahun ."'";
		$sql_4 = "SELECT * FROM wali_kelas WHERE id_tahun='" .$id_tahun ."'";

		if(($this->db->query($sql_1)->num_rows() > 0) OR ($this->db->query($sql_2)->num_rows() > 0) OR
			($this->db->query($sql_3)->num_rows() > 0) OR ($this->db->query($sql_4)->num_rows() > 0)){
			return 0;
		}else{
			$sql = "DELETE FROM tahun_ajaran WHERE id_tahun='" .$id_tahun ."'";

			$this->db->query($sql);

			return $this->db->affected_rows();	
		}

		
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

	public function tahun_untuk_spp($tahun_masuk) {
		$sql = "SELECT * FROM tahun_ajaran WHERE CAST(SUBSTRING(tahun, 1, 4) AS SIGNED)>=".$tahun_masuk." ORDER BY tahun ASC";

		$data = $this->db->query($sql);

		return $data->result(); //menampilkan baris yang berubah ada berapa
	}



	public function cek_format_tahun_ajaran($str){
		$str = explode('/', $str);

		if (sizeof($str)==1) {
			return FALSE;
		}
		else if(sizeof($str)==2){
			if (is_int(intval($str[0])) && is_int(intval($str[1]))) {
				if (intval($str[1]) -intval($str[0]) == 1) {
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
}

/* End of file M_kota.php */
/* Location: ./application/models/M_kota.php */