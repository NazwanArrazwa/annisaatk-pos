<?php

class M_landing extends CI_Model
{
    public function dtBerita($id = FALSE)
    {

        $this->db->select('*');
        $this->db->from('tb_berita');
        $this->db->order_by('id_berita', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function dtBatasBerita($limit, $start)
    {
        $this->db->order_by('id_berita', 'DESC');
        return $this->db->get('tb_berita', $limit, $start)->result_array();
    }

    public function hitungSemuaBerita()
    {
        return $this->db->get('tb_berita')->num_rows();
    }

    public function getBeritaLainnya($id, $limit = 3)
    {
        $this->db->select('*');
        $this->db->from('tb_berita');
        $this->db->where('id_berita !=', $id);
        $this->db->order_by('RAND()');
        $this->db->limit($limit);
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

    // public function dtBeritaDetail1($id)
    // {
    //     return $this->db->get_where('tb_berita', array('id_berita' => $id))->result();

    //     // $this->db->select('*');
    //     // $this->db->from('tb_berita');
    //     // $this->db->where('id_berita', $id);
    //     // $query = $this->db->get();
    //     // return $query->row_array();
    // }
}
