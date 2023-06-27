<?php

class M_berita extends CI_Model
{
    public function dtBerita($id = FALSE)
    {

        $this->db->select('*');
        $this->db->from('tb_berita');
        $this->db->order_by('id_berita', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function dtBeritaDetail($id)
    {

        $this->db->select('*');
        $this->db->from('tb_berita');
        $this->db->where('id_berita', $id);
        $query = $this->db->get();
        return $query->row_array();
    }
}
