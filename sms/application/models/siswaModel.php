<?php
class siswaModel extends CI_Model
{
    public function getAllSiswa()
    {
        return $this->db->get('datasiswa')->result_array();
    }
}
