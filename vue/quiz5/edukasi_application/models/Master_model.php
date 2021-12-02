<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Master_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
	function get_all_data($table, $is_delete, $order_by=NULL, $limit = "10", $offset="0", $field="*")
	{
		if($order_by === NULL)
		{
			$sql = "SELECT ".$field." FROM ".$table." WHERE ".$is_delete."_is_delete=0 LIMIT ".$limit." OFFSET ".$offset;
		}
		else
		{
			$sql = "SELECT ".$field." FROM ".$table." WHERE ".$is_delete."_is_delete=0 ORDER BY ".$order_by ." LIMIT ".$limit." OFFSET ".$offset;
		}
		
        $qry = $this->db->query($sql);
        return $qry->num_rows() > 0 ? $qry->result() : FALSE;
	}

	function get_all_join_data($table, $type_join="LEFT JOIN", $table_join, $on_join, $is_delete, $order_by=NULL, $limit = "10", $offset="0", $field="*")
	{
		if($order_by === NULL)
		{
			$sql = "SELECT ".$field." FROM ".$table." ".$type_join." ".$table_join." ON ".$on_join." WHERE ".$is_delete."_is_delete=0 LIMIT ".$limit." OFFSET ".$offset;
		}
		else
		{
			$sql = "SELECT ".$field." FROM ".$table." ".$type_join." ".$table_join." ON ".$on_join." WHERE ".$is_delete."_is_delete=0 ORDER BY ".$order_by ." LIMIT ".$limit." OFFSET ".$offset;
		}
		
        $qry = $this->db->query($sql);
        return $qry->num_rows() > 0 ? $qry->result() : FALSE;
	}
	
	function get_search_data($table, $where, $is_delete, $order_by = NULL, $limit = "10", $offset="0", $field="*")
	{
		if($limit=="-1"){
			$limit_ku=" ";
		}
        else
        {
			$limit_ku=" LIMIT ".$limit." OFFSET ".$offset;
		}
		
		if($order_by === NULL)
		{
			$sql = "SELECT ".$field." FROM ".$table." WHERE ".$is_delete."_is_delete=0 AND ".$where.$limit_ku;
		}
		else
		{
			$sql = "SELECT ".$field." FROM ".$table." WHERE ".$is_delete."_is_delete=0 AND ".$where." ORDER BY ".$order_by.$limit_ku;
		}
		
        $qry = $this->db->query($sql);
        return $qry->num_rows() > 0 ? $qry->result() : FALSE;
	}
	
	function get_search_join_data($table, $type_join="LEFT JOIN", $table_join, $on_join, $where, $is_delete, $order_by = NULL, $limit = "10", $offset="0", $field="*")
	{
		if($order_by === NULL)
		{
			$sql = "SELECT ".$field." FROM ".$table." ".$type_join." ".$table_join." ON ".$on_join." WHERE ".$is_delete."_is_delete=0 AND ".$where." LIMIT ".$limit." OFFSET ".$offset;
		}
		else
		{
			$sql = "SELECT ".$field." FROM ".$table." ".$type_join." ".$table_join." ON ".$on_join." WHERE ".$is_delete."_is_delete=0 AND ".$where." ORDER BY ".$order_by." LIMIT ".$limit." OFFSET ".$offset;
		}

        $qry = $this->db->query($sql);
        return $qry->num_rows() > 0 ? $qry->result() : FALSE;
	}
	
	function count_all_data($table, $where = NULL, $is_delete, $field="*")
	{
		if($where === NULL)
		{
			$sql = "SELECT count(".$field.") AS jml FROM ".$table." WHERE ".$is_delete."_is_delete=0";
		}
		else
		{
			$sql = "SELECT count(".$field.") AS jml FROM ".$table." WHERE ".$is_delete."_is_delete=0 AND ".$where;
		}
		
        $qry = $this->db->query($sql);
        return $qry->row();
	}
	
	function count_all_join_data($table, $type_join="LEFT JOIN", $table_join, $on_join, $where = NULL, $is_delete, $field="*")
	{
		if($where === NULL)
		{
			$sql = "SELECT count(".$field.") AS jml FROM ".$table." ".$type_join." ".$table_join." ON ".$on_join." WHERE ".$is_delete."_is_delete=0";
		}
		else
		{
			$sql = "SELECT count(".$field.") AS jml FROM ".$table." ".$type_join." ".$table_join." ON ".$on_join." WHERE ".$is_delete."_is_delete=0 AND ".$where;
		}
		
        $qry = $this->db->query($sql);
        return $qry->row();
	}
	
	function insert_data($table, $field=array(), $data=array())
	{
		$sql = "INSERT INTO ".$table." (";
		for($i=0;$i<count($field);$i++)
		{
			$sql .= $field[$i];
		}
		$sql .= ") VALUES (";
		
		for($i=0;$i<count($data);$i++)
		{
			$sql .= $data[$i];
		}
		$sql .= ")";
		
		$qry = $this->db->query($sql);
		return $this->db->affected_rows();
	}
	
	function update_data($table, $pk, $id, $data=array())
	{
		$sql = "UPDATE ".$table." SET ";
		foreach($data as $key=>$row)
		{
			$sql .= $key."=".$row;
		}
		$sql .= " WHERE ".$pk."=".$id;
		
		$qry = $this->db->query($sql);
		return $this->db->affected_rows();
	}

	function delete_data($table, $field_name, $field_id, $value_id)
	{
		$id = is_int($value_id)===TRUE ? $value_id : "'".$value_id."'";
		$user = $this->session->userdata("userId") ? $this->session->userdata("userId") : 0;
		$date = date("Y-m-d H:i:s");
		
		$sql = "UPDATE ".$table." SET ".$field_name."_is_delete=1, ".$field_name ."_update_by=".$user.", ".$field_name."_update_date='".$date."' WHERE ".$field_id."=".$id;
		
		$qry = $this->db->query($sql);
		return $this->db->affected_rows();
	}
	
	function get_data_by_id($pk, $id, $table, $is_delete)
	{
        $sql = "SELECT * FROM ".$table." WHERE ".$pk."=".$id." AND ".$is_delete."_is_delete=0";
		
        $qry = $this->db->query($sql);
        return $qry->num_rows() > 0 ? $qry->row() : FALSE;
	}
	
	function get_data_join_by_id($pk, $id, $table, $type_join, $table_join, $on_join, $is_delete)
	{
        $sql = "SELECT * FROM ".$table." ".$type_join." ".$table_join." ON ".$on_join." WHERE ".$pk."=".$id." AND ".$is_delete."_is_delete=0";

        $qry = $this->db->query($sql);
        return $qry->num_rows() > 0 ? $qry->row() : FALSE;
	}
	
	function get_data($table, $order_by=NULL, $limit = "10", $offset="0")
	{
		if($order_by === NULL)
		{
			$sql = "SELECT * FROM ".$table." LIMIT ".$limit." OFFSET ".$offset;
		}
		else
		{
			$sql = "SELECT * FROM ".$table." ORDER BY ".$order_by ." LIMIT ".$limit." OFFSET ".$offset;
		}
		
        $qry = $this->db->query($sql);
        return $qry->num_rows() > 0 ? $qry->result() : FALSE;
	}
	
	function check_duplicate($table, $is_delete, $parameter){
		$sql = "SELECT COUNT(*) as jml FROM ".$table." WHERE ".$is_delete."_is_delete=0 AND ".$parameter;

        $qry = $this->db->query($sql);
        return $qry->row();
	}

	function get_all_data_by_param($table, $field, $is_delete, $parameter)
	{
        $sql = "SELECT ".$field." FROM ".$table." WHERE ".$is_delete."_is_delete=0 ".$parameter;

        $qry = $this->db->query($sql);
        return $qry->num_rows() > 0 ? $qry->result() : FALSE;
	}
	
	function get_one_data_by_param($table, $field, $is_delete, $parameter)
	{
        $sql = "SELECT ".$field." FROM ".$table." WHERE ".$is_delete."_is_delete=0 ".$parameter;

        $qry = $this->db->query($sql);
		return $qry->num_rows() > 0 ? $qry->row() : FALSE;
	}
	
	function get_bd_studi_by_jenjang($jenjang)
    {
        $sql = "SELECT * FROM m_bidang_studi WHERE bds_jenjang=".$jenjang." AND bds_is_delete=0";
		
        $qry = $this->db->query($sql);
        return $qry->result();
    }
	
	function get_all_soal_admin($table, $is_delete, $order_by=NULL, $limit = "10", $offset="0", $field="*")
	{
		if($order_by === NULL)
		{
			$sql = "SELECT ".$field." FROM ".$table." WHERE ".$is_delete."_is_delete=0 LIMIT ".$limit." OFFSET ".$offset;
		}
		else
		{
			$sql = "SELECT ".$field." FROM ".$table." WHERE ".$is_delete."_is_delete=0 ORDER BY ".$order_by ." LIMIT ".$limit." OFFSET ".$offset;
		}
		
        $qry = $this->db->query($sql);
        return $qry->num_rows() > 0 ? $qry->result() : FALSE;
	}

	function get_all_soal_siswa($table, $order , $is_delete, $limit, $offset)
	{
		$sql = "SELECT * FROM ".$table." WHERE ".$is_delete."_is_delete=0 ORDER BY ".$order." asc LIMIT ".$limit." OFFSET ".$offset;

		$qry = $this->db->query($sql);
        return $qry->num_rows() > 0 ? $qry->result() : FALSE;
	}
	
	function insert_soal_random($judul,$soal,$siswa)
    {
		
		$sql = "Insert into ujian_random(uj_judul,uj_soal,uj_siswa)VALUES(".$judul.",".$soal.",".$siswa.")";
		
        $this->db->query($sql);
	}
	
	function delete_soal_random($siswa)
    {
		
		$sql = "delete from ujian_random where uj_siswa=".$siswa."";
		
        $this->db->query($sql);
	}
}
