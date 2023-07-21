<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Berita extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_berita');
        $this->login_kah();
    }

    public function login_kah()
    {
        if ($this->session->has_userdata('username') && $this->session->userdata('id_level') == 2)
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
        $this->load->view('admin/dashboard');
        $this->load->view('admin/footer');
    }

    public function save_orders()
    {
        $toko             = $this->m_admin->cari_toko();
        $bayar            = $this->input->post('bayar');
        $kode_transaksi   = $this->input->post('kode_transaksi');
        $kembali          = $this->input->post('kembali');
        $diskon           = $this->input->post('diskon'); // Get the discount value from the input
        $no               = 1;
        $output           = '';

        $output .= '<link rel="stylesheet" href="' . base_url('assets/css/print.css') . '">';
        $output .= '
        <div class="ticket">
        <img src="' . base_url('assets/images/annisaatk-logo.png') . '" alt="Logo">
        
        ';
        $output .= '<p class="centered">' . $kode_transaksi . '
        <br>' . $toko->alamat . '
        <br>' . $toko->no_telp . '</p>';
        //<div style="text-align: center; font-size: 20px; font-weight: bolder;">' . $toko->nm_toko . '</div>
        $output .= '
        
        <div style="text-align: center; font-weight: bolder;">' . $kode_transaksi . '</div>
        <div style="text-align: center; font-weight: bolder;">' . $toko->alamat . ' ' . $toko->no_telp . '</div>
        <div style="text-align: center; font-weight: bolder;" id="time_transaction" data-transaction="' . date('Y-m-d  h:i:s') . '">' . date('Y-m-d  h:i:s') . '</div>
    ';
        $output .= '<div style="border-top:1px dashed; border-bottom:1px dashed; margin: 20px 0;">'; // body

        $output .= '<div style="display: flex; border-bottom:1px dashed; margin-bottom: 10px;">
        <div style="width: 10%; font-weight: bolder;">No</div>
        <div style="width: 40%; font-weight: bolder;">Nama</div>
        <div style="width: 15%; font-weight: bolder; text-align: center;">Qty</div>
        <div style="width: 35%; font-weight: bolder;">Sub Total</div>
    </div>';

        foreach ($this->cart->contents() as $row) {
            $output .= '
            <div style="display: flex; margin-bottom: 10px;">
                <div style="width: 10%; font-weight: bolder;">' . $no++ . '</div>
                <div style="width: 40%; font-weight: bolder;">' . $row['name'] . '</div>
                <div style="width: 15%; font-weight: bolder; text-align: center;">' . $row['qty'] . '</div>
                <div style="width: 35%; font-weight: bolder;">Rp.' . number_format($row['subtotal'], 0, ',', '.')  . '</div>
            </div>';
        }

        $output .= '</div>';

        $total = $this->cart->total(); // Total awal sebelum diskon
        if ($diskon) {
            // Mengubah diskon dari persen menjadi nilai desimal
            $diskon_decimal = $diskon / 100;
            // Menghitung diskon berdasarkan total
            $diskon_amount = $total * $diskon_decimal;
            // Mengurangi total dengan diskon
            $total -= $diskon_amount;
        }

        $output .= '
        <div style="display: flex;">
            <div style="width: 60%; font-weight: bolder; text-align: right;">Total</div>
            <div style="width: 5%; font-weight: bolder; text-align: center;">:</div>
            <div style="width: 35%; font-weight: bolder;">Rp.' . number_format($total, 0, ',', '.') . '</div>
        </div>
    ';

        $output .= '
        <div style="display: flex;">
            <div style="width: 60%; font-weight: bolder; text-align: right;">Bayar</div>
            <div style="width: 5%; font-weight: bolder; text-align: center;">:</div>
            <div style="width: 35%; font-weight: bolder;">Rp.' . number_format($bayar, 0, ',', '.') . '</div>
        </div>
    ';

        if ($diskon) {
            $output .= '
            <div style="display: flex;">
                <div style="width: 60%; font-weight: bolder; text-align: right;">Diskon</div>
                <div style="width: 5%; font-weight: bolder; text-align: center;">:</div>
                <div style="width: 35%; font-weight: bolder;">Rp.' . number_format($diskon_amount, 0, ',', '.') . '</div>
            </div>
        ';
        }

        $output .= '
        <div style="display: flex;">
            <div style="width: 60%; font-weight: bolder; text-align: right;">Kembali</div>
            <div style="width: 5%; font-weight: bolder; text-align: center;">:</div>
            <div style="width: 35%; font-weight: bolder;">Rp.' . number_format($kembali, 0, ',', '.') . '</div>
        </div>
    ';

        $output .= '<div style="text-align:center; font-weight: bolder; margin: 20px 0;">
        Terimakasih atas kunjungan anda
    </div>';

        // Mengembalikan hasil sebagai response AJAX
        echo $output;
    }
}
