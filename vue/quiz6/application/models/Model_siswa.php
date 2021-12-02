<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_siswa extends CI_Model
{
        public function getAllSiswa()
        {
                return $this->db->get('siswi')->result_array();
        }
        public function tambahSiswa()
        {
                $data = [
                        'nama' => $this->input->post('nama', true)
                ];

                $this->db->insert('siswi', $data);
                redirect('siswa');
        }
        public function hapusSiswa($id)
        {
                $this->db->where('id', $id);
                $this->db->delete('siswi');
                redirect('siswa');
        }
        public function detailSiswa($id)
        {
                return $this->db->get_where('siswi', ['id' => $id])->row_array();
        }
}
