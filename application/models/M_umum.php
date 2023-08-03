<?php
class M_umum extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    function validateEmail($email)
    {
        $query = $this->db->query("SELECT * FROM tb_user WHERE email='$email'");
        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return false;
        }
    }

    function updatePasswordhash($data, $email)
    {
        $this->db->where('email', $email);
        $this->db->update('tb_user', $data);
    }

    function getHahsDetails($token)
    {
        $query = $this->db->query("select * from tb_user WHERE token='$token'");
        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return false;
        }
    }

    function updateNewPassword($data, $token)
    {
        $this->db->where('token', $token);
        $this->db->update('tb_user', $data);
    }

    public function cari_data($tabel, $namafield, $isifield)
    {
        $this->db->select('*');
        $this->db->from($tabel);
        $this->db->where($namafield, $isifield);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function cari_barcode($tabel, $namafield, $isifield)
    {
        $this->db->select('*');
        $this->db->from($tabel);
        $this->db->where($namafield, $isifield);
        $query = $this->db->get();
        return $query->row();
    }

    function cek_login()    //Cek apakah user pass ada
    {
        $username = $this->input->post('username');
        $password = md5($this->input->post('password'));
        $query = $this->db->get_where('tb_user', array('username' => $username, 'password' => $password));
        return $query->row_array();
    }

    // function jumlah_record_tabel($tabel)
    // {
    //     $query = $this->db->select("COUNT(*) as num")->get($tabel);
    //     $result = $query->row();
    //     if (isset($result))
    //         return $result->num;
    //     return 0;
    // }

    function jumlah_record_tabel($tabel, $field = null, $values = [])
    {
        if ($field && $values) {
            $this->db->where_not_in($field, $values);
        }

        $query = $this->db->select("COUNT(*) as num")->get($tabel);
        $result = $query->row();

        if (isset($result)) {
            return $result->num;
        }

        return 0;
    }



    function total_setoran($tabel)
    {
        $query = $this->db->select("SUM(jumlah_setoran) as total")->get($tabel);
        $result = $query->row();
        if (isset($result))
            return $result->total;
        return 0;
    }

    function hapus_data($tabel, $kolom, $id)
    {
        $this->db->delete($tabel, array($kolom => $id));
        if (!$this->db->affected_rows())
            return (FALSE);
        else
            return (TRUE);
    }
}
