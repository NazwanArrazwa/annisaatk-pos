<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kasir extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_kasir');
        $this->login_kah();
    }

    public function login_kah()
    {
        if ($this->session->has_userdata('username') && $this->session->userdata('id_level') == 3)
            return TRUE;
        else
            $this
                ->session
                ->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        Anda Harus Login Terlebih Dahulu
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
        </div>');
        redirect(base_url('login'));
    }

    public function index()
    {
        $data['title']    = 'Admin | Home';
        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar');
        $this->load->view('admin/topbar');
        $this->load->view('admin/isi');
        $this->load->view('admin/footer');
    }
}
