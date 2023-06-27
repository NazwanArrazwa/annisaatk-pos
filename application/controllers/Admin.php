<?php
defined('BASEPATH') or exit('No direct script access allowed');
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_admin');
        $this->load->library('cart');
        $this->login_kah();
    }

    public function login_kah()
    {

        if ($this->session->has_userdata('username') && $this->session->userdata('id_level') == 1)
            return TRUE;
        else
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        Anda Harus Login Terlebih Dahulu
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
        </div>');
        redirect(base_url('login'));
    }

    //============== DASHBOARD ============//

    public function index()
    {
        $data['title']    = 'Admin | Home';
        $data['page']    = 'home';
        $data['jml_barang']    = $this->m_umum->jumlah_record_tabel('tb_barang');
        $data['jml_pelanggan'] = $this->m_umum->jumlah_record_tabel('tb_pelanggan', 'nm_pelanggan', ['Umum']);
        $data['jml_supplier']    = $this->m_umum->jumlah_record_tabel('tb_supplier');
        $data['pendapatan_harian'] = $this->m_admin->sum_daily('tb_transaksi');
        $this->tampil($data);
    }

    public function penjualanTahunan()
    {
        $this->load->model('m_admin');
        $data = $this->m_admin->dtTahunan();
        echo json_encode($data);
    }

    //============== TOPBAR ============//

    public function profile()
    {
        $data['title']    = 'Admin | Profile';
        $data['page']    = 'profile';
        $data['profile'] = $this->m_admin->dtUser();
        $this->tampil($data);
    }

    public function changePassword()
    {
        $data['title']    = 'Admin | Ubah Password';
        $data['page']    = 'changePassword';
        $data['username'] = $this->db->get_where('tb_user')->row_array();

        // Mengatur aturan validasi
        $this->form_validation->set_rules('current_password', 'Password Saat Ini', 'required|trim', array('required' => '%s harus diisi.'));
        $this->form_validation->set_rules('new_password1', 'Password Baru', 'required|trim|matches[new_password2]', array('required' => '%s harus diisi.', 'matches' => '%s Harus Sesuai'));
        $this->form_validation->set_rules('new_password2', 'Ulangi Password Baru', 'required|trim|matches[new_password1]', array('required' => '%s harus diisi.', 'matches' => '%s Harus Sesuai'));

        if ($this->form_validation->run() == FALSE) {
            // Menampilkan form ubah password dengan pesan validasi error
            $this->tampil($data);
        } else {
            // Melakukan hash pada password saat ini menggunakan MD5
            $current_password = md5($this->input->post('current_password'));
            $new_password = $this->input->post('new_password1');

            if ($current_password !== $data['username']['password']) {
                // Password saat ini tidak cocok
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Password Saat Ini Salah
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
            </div>');
                redirect(base_url('admin/changePassword'));
            } else {
                if ($current_password == md5($new_password)) {
                    // Password baru sama dengan password saat ini
                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Password Yang Baru Tidak Boleh Sama Dengan Password Saat Ini
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
            </div>');
                    redirect(base_url('admin/changePassword'));
                } else {
                    // Memperbarui password di database
                    $this->db->set('password', md5($new_password));
                    $this->db->where('username', $data['username']['username']);
                    $this->db->update('tb_user');

                    $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Password berhasil diubah
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
            </div>');
                    redirect(base_url('admin/changePassword'));
                }
            }
        }
    }

    //============== KASIR ============//

    public function kasir()
    {
        $data['title']    = 'Admin | Kasir';
        $data['page']    = 'kasir';
        $data['barang'] = $this->m_admin->dtBarang();
        $data['pelanggan'] = $this->m_admin->dtPelanggan();
        $data['defaultValue'] = $this->m_admin->getDefaultCustomer();
        $this->tampil($data);
    }

    public function get_pelanggan_data()
    {
        $noTelp = $this->input->get('no_telp'); // Ambil no_telp dari parameter GET

        // Mengambil data pelanggan berdasarkan no_telp dari model
        $dataPelanggan = $this->m_admin->getPelangganDataByNoTelp($noTelp);

        // Mengembalikan data dalam format JSON
        if ($dataPelanggan) {
            $response = array(
                'success' => true,
                'nm_pelanggan' => $dataPelanggan['nm_pelanggan'],
                'diskon' => $dataPelanggan['diskon']
            );
        } else {
            $response = array(
                'success' => false,
                'message' => 'Tidak ada data pelanggan yang ditemukan.'
            );
        }

        // Mengirimkan respons JSON
        header('Content-Type: application/json');
        echo json_encode($response);
    }


    public function addBarangBarcode()
    {
        $barcode = $this->input->post('barcode');

        // Lakukan query atau logika untuk mendapatkan informasi barang berdasarkan barcode dari database atau sumber data lainnya
        $barang = $this->db->get_where('tb_barang', array('barcode' => $barcode))->row();

        if ($barang) {
            $data = array(
                'id' => $barang->barcode, // Gunakan barcode sebagai ID produk
                'qty' => 1, // Jumlah barang, dapat disesuaikan
                'price' => $barang->hrg_jual, // Harga barang dari tabel barang
                'name' => $barang->nm_barang, // Nama barang dari tabel barang
            );

            $this->cart->insert($data);
            echo $this->viewKeranjang();
        } else {
            // Barang tidak ditemukan, lakukan tindakan yang sesuai, seperti menampilkan pesan error
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Barang Tidak Ditemukan
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
            </div>');
            echo $this->viewKeranjang();
        }
    }


    public function addBarang()
    {
        $product_id = $this->input->post('product_id');
        $product_name = $this->input->post('product_name');
        $quantity = $this->input->post('quantity');
        $product_price = $this->input->post('product_price');

        // Pengecekan stok menggunakan model ProductModel
        $is_stock_available = $this->m_admin->checkStock($product_id, $quantity);

        if ($is_stock_available) {
            // Jumlah yang diinput cukup, tambahkan produk ke keranjang
            $data = array(
                'id' => $product_id,
                'name' => $product_name,
                'qty' => $quantity,
                'price' => $product_price
            );
            $this->cart->insert($data);

            // Update stok di database
            $this->m_admin->updateStock($product_id, $quantity);

            // Tampilkan keranjang belanja yang diperbarui
            echo $this->viewKeranjang();
        } else {
            // Jumlah yang diinput melebihi stok yang tersedia
            echo 'false';
        }
    }

    // public function updateStock()
    // {
    //     $product_id = $this->input->post('product_id');
    //     $quantity = $this->input->post('quantity');

    //     // Panggil model ProductModel untuk melakukan pembaruan stok
    //     $this->m_admin->updateStock($product_id, $quantity);

    //     // Respon dengan status sukses
    //     echo 'success';
    // }


    //method load data
    public function load()
    {
        echo $this->viewKeranjang();
    }

    //method hapus produk dari keranjang
    public function removeBarang()
    {
        // Ambil id unique dari product yang akan dihapus dari cart
        $row_id = $_POST["row_id"];

        // Ambil informasi produk yang akan dihapus
        $removed_product = $this->cart->get_item($row_id);

        // Hapus produk dari keranjang
        $data = [
            'rowid' => $row_id,
            'qty' => 0
        ];
        $this->cart->update($data);

        // Kembalikan stok barang yang dihapus
        $product_id = $removed_product['id'];
        $quantity = $removed_product['qty'];

        // Panggil model ProductModel untuk mengembalikan stok
        $this->m_admin->increaseStock($product_id, $quantity);

        // Tampilkan keranjang belanja yang diperbarui
        echo $this->viewKeranjang();
    }

    //method kosongkan keranjang
    public function clear_cart()
    {

        // Mengembalikan stok barang dalam keranjang
        foreach ($this->cart->contents() as $item) {
            $product_id = $item['id'];
            $quantity = $item['qty'];

            // Panggil model ProductModel untuk mengembalikan stok
            $this->m_admin->increaseStock($product_id, $quantity);
        }

        $this->cart->destroy();

        echo $this->viewKeranjang();
    }

    public function viewKeranjang()
    {
        $data['barang'] = $this->m_admin->dtBarang();

        $output = '';
        $output .= '
        <div align="right">

        <button type="button" id="clear_cart" class="btn btn-sm btn-warning mb-3"><i class="fa fa-shopping-cart"></i> Kosongkan</button>
    </div>
        <table id="shoping_cart_table" class="table table-stiped table-bordered table-penjualan">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th>Barcode</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th width="15%">Jumlah</th>
                
                <th>Subtotal</th>
                <th width="15%"><i class="fa fa-cog"></i></th>
            </tr>
    ';
        $count = 0;
        foreach ($this->cart->contents() as $item) {
            $count++;
            $no = 1;
            $output .= '
        <tr>
        <td>' . $no++ . '</td>
            <td><span class="badge badge-primary">' . $item["id"] . '</span></td>
            <td>' . $item["name"] . '</td>
            <td>' .  'Rp. ' . number_format($item["price"], 0, ',', '.') . '</td>
            <td>' . $item["qty"] . '</td>
            <td>' .  'Rp. ' . number_format($item["subtotal"], 0, ',', '.') . '</td>
            <td><button type="button" name="remove" class="btn btn-danger btn-sm remove_inventory" id="' . $item['rowid'] . '"><i class="fa fa-trash"></i></button></td>
        </tr>
        ';
        }
        $output .= '';

        if ($count == 0) {
            $output = "<table id='shoping_cart_table' class='table table-stiped table-bordered table-penjualan'>
            <thead>
                <tr>
                <th width='5%'>No</th>
                <th>Barcode</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th width='15%'>Jumlah</th>
                
                <th>Subtotal</th>
                <th width='15%'><i class='fa fa-cog'></i></th>
                </tr>
            </thead>
            <tbody>
            
            </tbody>

        </table>
        <span class='badge badge-danger'><i class='fa fa-shopping-cart'></i> Keranjang belanja kosong</span>
       ";
        }
        return $output;
    }

    // public function viewKeranjang()
    // {
    //     $data['barang'] = $this->m_admin->dtBarang();

    //     $output = '';
    //     $output .= '
    // <div align="right">
    //     <button type="button" id="clear_cart" class="btn btn-sm btn-warning mb-3"><i class="fa fa-shopping-cart"></i> Kosongkan</button>
    // </div>
    // <table id="shoping_cart_table" class="table table-stiped table-bordered table-penjualan">
    //     <thead>
    //         <tr>
    //             <th width="5%">No</th>
    //             <th>Barcode</th>
    //             <th>Nama Barang</th>
    //             <th>Harga</th>
    //             <th width="15%">Jumlah</th>
    //             <th>Subtotal</th>
    //             <th width="15%"><i class="fa fa-cog"></i></th>
    //         </tr>
    // ';
    //     $count = 0;
    //     foreach ($this->cart->contents() as $item) {
    //         $count++;
    //         $no = 1;

    //         // Pemeriksaan stok barang
    //         $stock_available = $this->m_admin->get_barang_qty($item['id'])->qty;
    //         if ($item['qty'] > $stock_available) {
    //             $output .= '
    //         <tr>
    //             <td colspan="7" style="color: red;">Jumlah melebihi stok yang tersedia</td>
    //         </tr>
    //         ';
    //         } else {
    //             $output .= '
    //         <tr>
    //             <td>' . $no++ . '</td>
    //             <td><span class="badge badge-primary">' . $item["id"] . '</span></td>
    //             <td>' . $item["name"] . '</td>
    //             <td>' . 'Rp. ' . number_format($item["price"], 0, ',', '.') . '</td>
    //             <td>' . $item["qty"] . '</td>
    //             <td>' . 'Rp. ' . number_format($item["subtotal"], 0, ',', '.') . '</td>
    //             <td><button type="button" name="remove" class="btn btn-danger btn-sm remove_inventory" id="' . $item['rowid'] . '"><i class="fa fa-trash"></i></button></td>
    //         </tr>
    //         ';
    //         }
    //     }
    //     $output .= '';

    //     if ($count == 0) {
    //         $output = "<table id='shoping_cart_table' class='table table-stiped table-bordered table-penjualan'>
    //     <thead>
    //         <tr>
    //             <th width='5%'>No</th>
    //             <th>Barcode</th>
    //             <th>Nama Barang</th>
    //             <th>Harga</th>
    //             <th width='15%'>Jumlah</th>
    //             <th>Subtotal</th>
    //             <th width='15%'><i class='fa fa-cog'></i></th>
    //         </tr>
    //     </thead>
    //     <tbody>

    //     </tbody>
    //     </table>
    //     <span class='badge badge-danger'><i class='fa fa-shopping-cart'></i> Keranjang belanja kosong</span>
    //     ";
    //     }
    //     return $output;
    // }

    public function save_orders()
    {
        $toko             = $this->m_admin->cari_toko();
        $bayar            = $this->input->post('bayar');
        $kode_transaksi   = $this->input->post('kode_transaksi');
        $kembali          = $this->input->post('kembali');
        $diskon           = $this->input->post('diskon'); // Get the discount value from the input
        $no               = 1;
        $output           = '';

        $output .= '<div>';

        $output .= '
        <div style="text-align: center; font-size: 20px; font-weight: bold;">' . $toko->nm_toko . '</div>
        <div style="text-align: center">' . $kode_transaksi . '</div>
        <div style="text-align: center">' . $toko->alamat . ' ' . $toko->no_telp . '</div>
        <div style="text-align: center" id="time_transaction" data-transaction="' . date('Y-m-d  h:i:s') . '">' . date('Y-m-d  h:i:s') . '</div>
    ';
        $output .= '<div style="border-top:1px dashed; border-bottom:1px dashed; margin: 20px 0;">'; // body

        $output .= '<div style="display: flex; border-bottom:1px dashed; margin-bottom: 10px;">
        <div style="width: 10%; font-weight: bold;">No</div>
        <div style="width: 40%; font-weight: bold;">Nama</div>
        <div style="width: 15%; font-weight: bold; text-align: center;">Qty</div>
        <div style="width: 35%; font-weight: bold;">Sub Total</div>
    </div>';

        foreach ($this->cart->contents() as $row) {
            $output .= '
            <div style="display: flex; margin-bottom: 10px;">
                <div style="width: 10%;">' . $no++ . '</div>
                <div style="width: 40%;">' . $row['name'] . '</div>
                <div style="width: 15%; text-align: center;">' . $row['qty'] . '</div>
                <div style="width: 35%;">Rp.' . number_format($row['subtotal'], 0, ',', '.')  . '</div>
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
            <div style="width: 60%; text-align: right;">Total</div>
            <div style="width: 5%; text-align: center;">:</div>
            <div style="width: 35%;">Rp.' . number_format($total, 0, ',', '.') . '</div>
        </div>
    ';

        $output .= '
        <div style="display: flex;">
            <div style="width: 60%; text-align: right;">Bayar</div>
            <div style="width: 5%; text-align: center;">:</div>
            <div style="width: 35%;">Rp.' . number_format($bayar, 0, ',', '.') . '</div>
        </div>
    ';

        if ($diskon) {
            $output .= '
            <div style="display: flex;">
                <div style="width: 60%; text-align: right;">Diskon</div>
                <div style="width: 5%; text-align: center;">:</div>
                <div style="width: 35%;">Rp.' . number_format($diskon_amount, 0, ',', '.') . '</div>
            </div>
        ';
        }

        $output .= '
        <div style="display: flex;">
            <div style="width: 60%; text-align: right;">Kembali</div>
            <div style="width: 5%; text-align: center;">:</div>
            <div style="width: 35%;">Rp.' . number_format($kembali, 0, ',', '.') . '</div>
        </div>
    ';

        $output .= '<div style="text-align:center; margin: 20px 0;">
        Terimakasih atas kunjungan anda
    </div>';

        // Mengembalikan hasil sebagai response AJAX
        echo $output;
    }

    public function create_transaction()
    {

        date_default_timezone_set('Asia/Makassar'); // Set zona waktu ke WITA (Asia/Makassar)

        // $code_transaction = $this->input->post('code_transaction');
        $kode_transaksi   = $this->input->post('kode_transaksi');
        $nm_pelanggan = $this->input->post('nm_pelanggan');
        $response         = [];
        if ($this->cart->contents() !== []) {
            $kasir = $this->session->userdata('id_level');
            foreach ($this->cart->contents() as $cart) {

                // Menggunakan fungsi di m_admin untuk mendapatkan ID pelanggan berdasarkan nama
                $id_pelanggan = $this->m_admin->get_pelanggan_id($nm_pelanggan);

                $res      = $this->m_admin->get_barang_qty($cart['id']);
                $last_qty = $res->qty; // - $cart['qty']

                $order = [
                    'kode_transaksi'         => $kode_transaksi,
                    'kasir'                  => $kasir,
                    'waktu'                  => date('Y-m-d h:i:s'),
                    'harga'                  => $cart['price'],
                    'total_brg'              => $cart['qty'],
                    'id_barang'              => $cart['id'],
                    'id_pelanggan'           => $id_pelanggan,
                    'last_qty'                => $last_qty,
                ];


                $this->m_admin->buat_order($order);
                $this->m_admin->update_barang_qty($cart['id'], $last_qty);
            }
            $this->cart->destroy();

            $response = [
                'status'  => 200,
                'message' => 'success',
            ];
        } else {
            $response = [
                'status'  => 500,
                'message' => 'internal server error',
            ];
        }
        echo json_encode($response);
    }

    public function generate_kode_transaksi()
    {
        $date = new DateTime();
        $kode_unik = $this->m_admin->generate_kode_unik($date->format('Y-m-d'));

        $tanggal = $date->format('dmY');
        $kode_transaksi = str_pad($kode_unik, 4, '0', STR_PAD_LEFT) . '-' . $tanggal;

        $response = [
            'status' => 200,
            'kode_transaksi' => $kode_transaksi
        ];

        echo json_encode($response);
    }


    public function getSubtotal()
    {
        $subtotal = $this->cart->total();
        echo $subtotal;
    }

    //============== LAPORAN PENJUALAN ============//
    public function penjualanBarang()
    {
        $data['title']    = 'Admin | Penjualan Barang';
        $data['page']    = 'penjualanBarang';
        // Mengambil rentang tanggal dari input form
        $startdate = $this->input->get('startdate', TRUE);
        $enddate = $this->input->get('enddate', TRUE);

        $data['transaksi'] = $this->m_admin->dtTransaksiBarang($startdate, $enddate);


        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Mengatur font menjadi Times New Roman
        $style = $sheet->getStyle('A:G');
        $font = $style->getFont();
        $font->setName('Times New Roman');

        $sheet->mergeCells('A1:G1');
        $sheet->setCellValue('A1', 'Laporan Penjualan Barang Toko AnnisaATK');

        $sheet->setCellValue('A2', 'Tanggal');
        $sheet->setCellValue('B2', 'Barcode Barang');
        $sheet->setCellValue('C2', 'Barang Yang Terjual');
        $sheet->setCellValue('D2', 'Jumlah');
        $sheet->setCellValue('E2', 'Harga Satuan');
        $sheet->setCellValue('F2', 'Harga Total');
        $sheet->setCellValue('G2', 'Sisa Stok');

        // Dapatkan objek gaya (style) sel A1
        $style = $sheet->getStyle('A1');
        // Dapatkan objek perataan (alignment) dari objek gaya (style)
        $alignment = $style->getAlignment();
        // Aktifkan wrap teks pada perataan (alignment)
        $alignment->setWrapText(true);

        // Mengatur tinggi baris pada baris pertama
        $rowHeight = 33; // Tinggi baris dalam satuan "point"
        $sheet->getRowDimension(1)->setRowHeight($rowHeight);



        // Inisialisasi variabel total
        $total = 0;
        // Isi data dari array $data['laporan'] ke dalam sheet
        $row = 3; // Mulai dari baris kedua
        foreach ($data['transaksi'] as $laporan) {
            $sheet->setCellValue('A' . $row, $laporan['waktu']);
            $sheet->setCellValue('B' . $row, $laporan['barcode']);
            $sheet->setCellValue('C' . $row, $laporan['nm_barang']);
            $sheet->setCellValue('D' . $row, $laporan['total_brg']);
            $sheet->setCellValue('E' . $row, $laporan['harga']);

            // Menambahkan nilai total_harga ke total
            $total = $laporan['harga'] * $laporan['total_brg'];

            $sheet->setCellValue('F' . $row, $total);
            $sheet->setCellValue('G' . $row, $laporan['last_qty']);
            $row++;
        }



        // // Menggabungkan sel dari kolom A hingga E untuk judul "Total"
        // $sheet->mergeCells('A' . $row . ':D' . $row);
        // $sheet->setCellValue('A' . $row, 'Total');
        // $sheet->setCellValue('E' . $row, $total);

        // Set lebar kolom A dan B sesuai panjang teks terpanjang
        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(true);
        $sheet->getColumnDimension('F')->setAutoSize(true);
        $sheet->getColumnDimension('G')->setAutoSize(true);

        $lastRow = $sheet->getHighestRow();
        $lastColumn = $sheet->getHighestColumn();

        // Mendapatkan objek perataan (alignment) dari objek gaya (style)
        $alignment = $style->getAlignment();

        // Mengatur perataan teks menjadi tengah (middle align)
        $alignment->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

        $alignment = $sheet->getStyle('A1:G' . $lastRow)->getAlignment();
        $alignment->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        // Menambahkan border pada setiap sel
        $borderStyle = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ];


        $sheet->getStyle('A2:' . $lastColumn . $lastRow)->applyFromArray($borderStyle);

        // Memberi warna pada sel A1 hingga B1
        $columnStyle = [
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => [
                    'rgb' => '00FFFF', // Ganti dengan kode warna yang diinginkan
                ],
            ],
        ];

        $sheet->getStyle('A1:' . $lastColumn . '1')->applyFromArray($columnStyle);


        $writer = new Xlsx($spreadsheet);
        // Simpan file Excel ke direktori
        $filename = 'penjualan_barang.xlsx';
        $savePath = 'Excel/PenjualanBarang/' . $filename;
        $writer->save($savePath);
        $data['downloadLink'] = base_url('admin/downloadPenjualanBarang/' . $filename); // Buat link download menggunakan base_url dan nama file

        $this->tampil($data);
    }

    public function downloadPenjualanBarang($filename)
    {
        // Tentukan path lengkap file Excel yang akan didownload
        $filePath = 'Excel/PenjualanBarang/' . $filename; // Sesuaikan dengan path yang sesuai pada server Anda

        //     $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        //     Data Berhasil Di Export
        //     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        //     <span aria-hidden="true">&times;</span>
        //   </button>
        //     </div>');

        // Mengirim file Excel sebagai respons download ke browser
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        readfile($filePath);
    }

    public function laporanKeuangan()
    {
        $data['title'] = 'Admin | Laporan Keuangan';
        $data['page'] = 'laporanKeuangan';

        // Mengambil rentang tanggal dari input form
        $startdate = $this->input->get('startdate', TRUE);
        $enddate = $this->input->get('enddate', TRUE);

        $data['laporan'] = $this->m_admin->dtLaporanKeuangan($startdate, $enddate);
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Mengatur font menjadi Times New Roman
        $style = $sheet->getStyle('A:B');
        $font = $style->getFont();
        $font->setName('Times New Roman');

        $sheet->mergeCells('A1:B1');
        $sheet->setCellValue('A1', 'Laporan Keuangan Toko AnnisaATK');

        $sheet->setCellValue('A2', 'Tanggal');
        $sheet->setCellValue('B2', 'Keuntungan');

        // Dapatkan objek gaya (style) sel A1
        $style = $sheet->getStyle('A1');
        // Dapatkan objek perataan (alignment) dari objek gaya (style)
        $alignment = $style->getAlignment();
        // Aktifkan wrap teks pada perataan (alignment)
        $alignment->setWrapText(true);

        // Mengatur tinggi baris pada baris pertama
        $rowHeight = 33; // Tinggi baris dalam satuan "point"
        $sheet->getRowDimension(1)->setRowHeight($rowHeight);


        // Inisialisasi variabel total
        $total = 0;
        // Isi data dari array $data['laporan'] ke dalam sheet
        $row = 3; // Mulai dari baris kedua
        foreach ($data['laporan'] as $laporan) {
            $sheet->setCellValue('A' . $row, $laporan['tanggal']);
            $sheet->setCellValue('B' . $row, $laporan['total_harga']);
            $row++;
            // Menambahkan nilai total_harga ke total
            $total += $laporan['total_harga'];
        }

        // Menyimpan nilai total pada kolom B, baris terakhir
        $sheet->setCellValue('A' . $row, 'Total');
        $sheet->setCellValue('B' . $row, $total);

        // Set lebar kolom A dan B sesuai panjang teks terpanjang
        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);

        $lastRow = $sheet->getHighestRow();
        $lastColumn = $sheet->getHighestColumn();

        // Mendapatkan objek perataan (alignment) dari objek gaya (style)
        $alignment = $style->getAlignment();

        // Mengatur perataan teks menjadi tengah (middle align)
        $alignment->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

        $alignment = $sheet->getStyle('A1:B' . $lastRow)->getAlignment();
        $alignment->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        // Menambahkan border pada setiap sel
        $borderStyle = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ];


        $sheet->getStyle('A2:' . $lastColumn . $lastRow)->applyFromArray($borderStyle);

        // Memberi warna pada sel A1 hingga B1
        $columnStyle = [
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => [
                    'rgb' => '00FFFF', // Ganti dengan kode warna yang diinginkan
                ],
            ],
        ];

        $sheet->getStyle('A1:' . $lastColumn . '1')->applyFromArray($columnStyle);

        $writer = new Xlsx($spreadsheet);
        // Simpan file Excel ke direktori
        $filename = 'laporan_keuangan.xlsx';
        $savePath = 'Excel/LaporanKeuangan/' . $filename;
        $writer->save($savePath);

        $data['downloadLink'] = base_url('admin/downloadLaporanKeuangan/' . $filename); // Buat link download menggunakan base_url dan nama file

        $this->tampil($data);
    }


    public function downloadLaporanKeuangan($filename)
    {
        // Tentukan path lengkap file Excel yang akan didownload
        $filePath = 'Excel/Laporan_Keuangan/' . $filename; // Sesuaikan dengan path yang sesuai pada server Anda

        //     $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        //     Data Berhasil Di Export
        //     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        //     <span aria-hidden="true">&times;</span>
        //   </button>
        //     </div>');

        // Mengirim file Excel sebagai respons download ke browser
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        readfile($filePath);
    }



    // public function laporanKeuangan()
    // {
    //     $data['title']    = 'Admin | Riwayat Transaksi';
    //     $data['page']    = 'laporanKeuangan';
    //     if ($this->input->is_ajax_request()) {
    //         $transaksi = $this->m_admin->dtLaporanKeuangan();

    //         $response = array(
    //             'data' => $transaksi
    //         );

    //         header('Content-Type: application/json');
    //         echo json_encode($response);
    //         exit;
    //     }

    //     $this->tampil($data);
    // }


    // public function laporanKeuanganTable()
    // {
    //     $list = $this->m_admin->get_datatables();
    //     $data = array();
    //     $no = $_POST['start'];
    //     foreach ($list as $data_siswa) {
    //         $no++;
    //         $row = array();
    //         $row[] = $data_siswa->waktu;
    //         $row[] = $data_siswa->harga;
    //         $data[] = $row;
    //     }

    //     $output = array(
    //         "draw" => $_POST['draw'],
    //         "recordsTotal" => $this->m_admin->count_all(),
    //         "recordsFiltered" => $this->m_admin->count_filtered(),
    //         "data" => $data,
    //     );

    //     // Output the JSON data
    //     echo json_encode($output);
    // }





    //============== RIWAYAT TRANSAKSI ============//
    public function riwayatTransaksi()
    {
        $data['title']    = 'Admin | Riwayat Transaksi';
        $data['page']    = 'riwayatTransaksi';
        $data['transaksi'] = $this->m_admin->dtTransaksi();
        $this->tampil($data);
    }

    public function transaksiDetail($id)
    {
        $data['title']    = 'Admin | Riwayat Transaksi';
        $data['page'] = 'transaksiDetail';
        $data['detail'] = $this->m_admin->dt_transaksi_detil($id);

        $this->tampil($data);
    }

    public function transaksiHapus($id)
    {
        $this->m_umum->hapus_data('tb_transaksi', 'kode_transaksi', $id);
        redirect(base_url('admin/riwayatTransaksi'));
    }



    //============== BARANG ============//

    public function barang()
    {
        $data['title']    = 'Admin | Barang';
        $data['page']    = 'barang';
        $data['barang'] = $this->m_admin->dtBarang();
        $this->tampil($data);
    }

    public function barangTambah()
    {
        $data['title']    = 'Admin | Barang';
        $data['page']    = 'barangTambah';
        $data['ddkategori'] = $this->m_admin->dropdown_kategori();
        $data['ddsatuan'] = $this->m_admin->dropdown_satuan();
        $this->form_validation->set_rules('barcode', 'Barcode', 'callback_barcode_exists');
        $this->form_validation->set_rules('nm_barang', 'Nama Barang', 'required', array('required' => '%s harus diisi.'));
        $this->form_validation->set_rules('hrg_jual', 'Harga Jual', 'required', array('required' => '%s harus diisi.'));
        $this->form_validation->set_rules('hrg_beli', 'Harga Beli', 'required', array('required' => '%s harus diisi.'));
        $this->form_validation->set_rules('id_kategori', 'Pilih Kategori Barang', 'callback_dd_cek');
        $this->form_validation->set_rules('id_satuan', 'Pilih Satuan Barang', 'callback_dd_cek');
        $this->form_validation->set_rules('qty', 'Jumlah Barang', 'required', array('required' => '%s harus diisi.'));


        if ($this->form_validation->run() === FALSE) {
            $this->tampil($data);
        } else {
            $this->m_admin->dtBarangTambah();
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Data Berhasil Ditambahkan
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
            </div>');
            redirect(base_url('admin/barang'));
        }
    }

    public function barangEdit($id = FALSE)
    {
        $data['title'] = 'Admin | Barang';
        $data['page'] = 'barangEdit';
        $data['b'] = $this->m_umum->cari_data('tb_barang', 'id_barang', $id);
        $data['ddkategori'] = $this->m_admin->dropdown_kategori();
        $data['ddsatuan'] = $this->m_admin->dropdown_satuan();

        $this->form_validation->set_rules('nm_barang', 'Nama Barang', 'required', array('required' => '%s harus diisi.'));
        $this->form_validation->set_rules('hrg_jual', 'Harga Jual', 'required', array('required' => '%s harus diisi.'));
        $this->form_validation->set_rules('hrg_beli', 'Harga Beli', 'required', array('required' => '%s harus diisi.'));
        $this->form_validation->set_rules('id_kategori', 'Pilih Kategori Barang', 'callback_dd_cek');
        $this->form_validation->set_rules('id_satuan', 'Pilih Satuan Barang', 'callback_dd_cek');
        $this->form_validation->set_rules('qty', 'Jumlah Barang', 'required', array('required' => '%s harus diisi.'));

        // Validasi barcode
        $barcodelama = $this->m_admin->cari_barcode($this->input->post('barcode'));

        // Jika barcode Lama ada dan ID sebelumnya tidak sama dengan ID Barang saat ini
        // Jalankan validasi 'barcode' dengan menggunakan metode validasi kustom 'barcode_cek'
        if ($barcodelama && $barcodelama['id_barang'] != $id) {
            $this->form_validation->set_rules('barcode', 'Barcode', 'callback_barcode_exists');
        }

        if ($this->form_validation->run() === FALSE) {
            $this->tampil($data);
        } else {
            $this->m_admin->dtBarangEdit($id);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Data Berhasil Diedit
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
            </div>');
            redirect(base_url('admin/barang'));
        }
    }


    public function kategoriBarang()
    {
        $data['title']    = 'Admin | Barang';
        $data['page']    = 'kategoriBarang';
        $data['katbarang'] = $this->m_admin->dtKategoriBarang();
        $this->tampil($data);
    }

    public function satuanBarang()
    {
        $data['title']    = 'Admin | Barang';
        $data['page']    = 'satuanBarang';
        $data['satbarang'] = $this->m_admin->dtSatuanBarang();
        $this->tampil($data);
    }


    public function barangHapus($id)
    {
        $this->m_umum->hapus_data('tb_barang', 'id_barang', $id);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        Data Berhasil Terhapus
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
        </div>');
        redirect(base_url('admin/barang'));
    }

    //============== PELANGGAN ============//

    public function pelanggan()
    {
        $data['title']    = 'Admin | Pelanggan';
        $data['page']    = 'pelanggan';
        $data['pelanggan'] = $this->m_admin->dtPelanggan();
        $this->tampil($data);
    }

    public function pelangganTambah()
    {
        $data['title']    = 'Admin | Pelanggan';
        $data['page']    = 'pelangganTambah';
        $this->form_validation->set_rules(
            'email',
            'Email',
            'required|valid_email|is_unique[tb_pelanggan.email]',
            array(
                'required' => '%s harus diisi.',
                'is_unique' => ' %s Sudah Terdaftar.'
            )
        );
        $this->form_validation->set_rules('nm_pelanggan', 'Nama Pelanggan', 'required', array('required' => '%s harus diisi.'));
        $this->form_validation->set_rules('no_telp', 'Nomor Telepon', 'required', array('required' => '%s harus diisi.'));
        $this->form_validation->set_rules('alamat', 'Alamat', 'required', array('required' => '%s harus diisi.'));
        $this->form_validation->set_rules('diskon', 'Diskon', 'required', array('required' => '%s harus diisi.'));

        if ($this->form_validation->run() === FALSE) {
            $this->tampil($data);
        } else {
            $this->m_admin->dtPelangganTambah();
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Data Berhasil Ditambahkan
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
            </div>');
            redirect(base_url('admin/pelanggan'));
        }
    }

    public function pelangganEdit($id = FALSE)
    {
        $data['title'] = 'Admin | Pelanggan';
        $data['page'] = 'pelangganEdit';
        $this->form_validation->set_rules(
            'email',
            'Email',
            'required|valid_email',
            array(
                'required' => '%s harus diisi.'
            )
        );
        $this->form_validation->set_rules('nm_pelanggan', 'Nama Pelanggan', 'required', array('required' => '%s harus diisi.'));
        $this->form_validation->set_rules('no_telp', 'Nomor Telepon', 'required', array('required' => '%s harus diisi.'));
        $this->form_validation->set_rules('alamat', 'Alamat', 'required', array('required' => '%s harus diisi.'));
        $this->form_validation->set_rules('diskon', 'Diskon', 'required', array('required' => '%s harus diisi.'));
        $data['p'] = $this->m_umum->cari_data('tb_pelanggan', 'id_pelanggan', $id);
        if ($this->form_validation->run() === FALSE) {
            $this->tampil($data);
        } else {
            $this->m_admin->dtPelangganEdit($id);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Data Berhasil Diedit
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
            </div>');
            redirect(base_url('admin/pelanggan'));
        }
    }

    public function pelangganHapus($id)
    {
        $this->m_umum->hapus_data('tb_pelanggan', 'id_pelanggan', $id);
        redirect(base_url('admin/pelanggan'));
    }

    //============== BERITA ============//


    public function berita()
    {
        $data['title']    = 'Admin | Berita';
        $data['page']    = 'berita';
        $data['berita'] = $this->m_admin->dtBerita();
        $this->tampil($data);
    }

    public function beritaTambah()
    {
        $data = array();
        $data['title'] = 'Admin | Berita';
        $data['page'] = 'beritaTambah';
        $config['upload_path'] = './uploads/gambarBerita/';
        $config['allowed_types'] = 'gif|jpg|png';
        // $config['file_name'] = 'Berita_' . 'Tanggal_' . date('d m y') . '_';

        $this->load->library('upload', $config);

        $this->form_validation->set_rules('judul_berita', 'Judul Berita', 'required', array('required' => '%s harus diisi.'));
        $this->form_validation->set_rules('isi_berita', 'Isi Berita', 'required', array('required' => '%s harus diisi.'));
        $this->form_validation->set_rules('gambar_berita', 'Gambar Berita', 'callback_file_check');
        $this->form_validation->set_rules('nama_pengirim', 'Nama Pengirim', 'required', array('required' => '%s harus diisi.'));

        if ($this->form_validation->run() === FALSE || !$this->upload->do_upload('gambar_berita')) {
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('error', $error);
            $this->tampil($data);
        } else {
            $this->m_admin->dtBeritaTambah();

            // Dapatkan id_berita yang baru ditambahkan
            $id = $this->db->insert_id();

            // Membentuk nama file berdasarkan id_berita
            $file_name = 'berita_' . $id;

            // Perbarui nama file
            $uploadgambar = $this->upload->data('full_path');
            $nm_gambar_baru = $file_name . '.' . pathinfo($uploadgambar, PATHINFO_EXTENSION);
            $nm_ekstensi_gambar = $config['upload_path'] . $nm_gambar_baru;

            if (rename($uploadgambar, $nm_ekstensi_gambar)) {
                // Update nama file dalam model
                $this->m_admin->updateNamaGambar($id, $nm_gambar_baru);
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                 File Gagal Diubah
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
                 </button>
                 </div>');
                $this->tampil($data);
            }

            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
         Data Berhasil Ditambahkan
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">&times;</span>
         </button>
         </div>');

            redirect(base_url('admin/berita'));
        }
    }


    public function beritaEdit($id = FALSE)
    {
        $data['title'] = 'Admin | Edit Berita';
        $data['page'] = 'beritaEdit';

        // Validasi form
        $this->form_validation->set_rules('judul_berita', 'Judul Berita', 'required', array('required' => 'Judul Berita harus diisi.'));
        $this->form_validation->set_rules('isi_berita', 'Isi Berita', 'required', array('required' => 'Isi Berita harus diisi.'));
        $this->form_validation->set_rules('nama_pengirim', 'Nama Pengirim', 'required', array('required' => 'Nama Pengirim harus diisi.'));

        // Ambil data berita berdasarkan id
        $data['b'] = $this->m_umum->cari_data('tb_berita', 'id_berita', $id);

        if ($this->form_validation->run() == FALSE) {
            // Jika validasi gagal, tampilkan halaman edit berita   
            $this->tampil($data);
        } else {
            // Menyimpan nama gambar_berita yang lama
            $gambar_berita_lama = $data['b']['gambar_berita'];

            if ($_FILES['gambar_berita']['name']) {
                $config['upload_path'] = './uploads/gambarBerita/';
                $config['allowed_types'] = 'gif|jpg|png';

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('gambar_berita')) {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', $error);
                    $this->tampil($data);
                } else {
                    // Dapatkan nama file baru berdasarkan id_berita
                    $file_name = 'berita_' . $id;

                    // Perbarui nama file
                    $uploadgambar = $this->upload->data();
                    $nm_gambar_baru = $file_name . '.' . pathinfo($uploadgambar['file_name'], PATHINFO_EXTENSION);
                    $nm_ekstensi_gambar = $config['upload_path'] . $nm_gambar_baru;

                    // Hapus gambar_berita lama jika ada
                    if ($gambar_berita_lama && file_exists('./uploads/gambarBerita/' . $gambar_berita_lama)) {
                        unlink('./uploads/gambarBerita/' . $gambar_berita_lama);
                    }

                    // Pindahkan file gambar baru ke lokasi yang ditentukan
                    rename($uploadgambar['full_path'], $nm_ekstensi_gambar);

                    // Panggil fungsi untuk menyimpan data berita dengan gambar baru
                    $this->m_admin->dtBeritaEdit($id, $nm_gambar_baru);
                }
            } else {
                // Jika tidak ada gambar baru diunggah, panggil fungsi untuk menyimpan data berita tanpa perubahan gambar
                $this->m_admin->dtBeritaEdit($id, $gambar_berita_lama);
            }

            // Set pesan sukses
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
             Berita berhasil diperbarui
             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
             </button>
         </div>');

            // Redirect ke halaman daftar berita
            redirect(base_url('admin/berita'));
        }
    }


    public function beritaHapus($id)
    {
        $berita = $this->m_umum->cari_data('tb_berita', 'id_berita', $id);
        $gambar_berita = $berita['gambar_berita']; // Ambil nama file gambar_berita

        // Hapus data berita dari database
        $this->m_umum->hapus_data('tb_berita', 'id_berita', $id);

        // Hapus file gambar_berita jika ada
        if ($gambar_berita) {
            unlink('./uploads/gambarBerita/' . $gambar_berita);
        }
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
         Berita berhasil Dihapus
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
         </button>
     </div>');
        // Redirect ke halaman daftar berita
        redirect(base_url('admin/berita'));
    }




    //============== USER ============//

    public function user()
    {
        $data['title']    = 'Admin | User';
        $data['page']    = 'user';
        $data['user'] = $this->m_admin->dtUser();
        $this->tampil($data);
    }

    public function userEdit($id = FALSE)
    {
        $data['title']    = 'Admin | User';
        $data['page']    = 'userEdit';
        $data['u'] = $this->m_umum->cari_data('tb_user', 'username', $id);
        $this->tampil($data);
    }


    //============== PROFIL TOKO ============//

    public function profilToko()
    {
        $data['title']    = 'Admin | Profil Toko';
        $data['page']    = 'profilToko';
        $data['toko'] = $this->m_admin->dtProfilToko();
        $this->tampil($data);
    }

    //============== CONFIG EMAIL ============//


    public function configEmail()
    {
        $data['title']    = 'Admin | Config Email';
        $data['page']    = 'configEmail';
        $data['config'] = $this->m_admin->dtConfigEmail();
        $this->tampil($data);
    }

    public function configEmailEdit($id = FALSE)
    {
        $data['title']    = 'Admin | Config Email';
        $data['page']    = 'configEmailEdit';
        $data['config'] = $this->m_admin->dtConfigEmail();
        $data['c'] = $this->m_umum->cari_data('tb_config', 'id_config', $id);
        $this->form_validation->set_rules('email', 'Email', 'required', array('required' => '%s harus diisi.'));
        $this->form_validation->set_rules('pass', 'Password', 'required', array('required' => '%s harus diisi.'));
        if ($this->form_validation->run() === FALSE) {
            $this->tampil($data);
        } else {
            $this->m_admin->dtConfigEmailEdit($id);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Data Berhasil Diedit
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
            </div>');
            redirect(base_url('admin/configEmail'));
        }
    }

    public function supplier()
    {
        $data['title']    = 'Admin | Supplier';
        $data['page']    = 'supplier';
        $data['supplier'] = $this->m_admin->dtSupplier();
        $this->tampil($data);
    }

    // public function addPelanggan()
    // {
    //     if ($this->m_admin->dt_pelanggan_tambah() > 0) {
    //         $message['status'] = 'success';
    //     } else {
    //         $message['status'] = 'failed';
    //     };

    //     $this->output->set_content_type('application/json')->set_output(json_encode($message));
    // }


    //============ Tools ===============
    function file_check($str)
    {
        $file = $_FILES['gambar_berita']['name'];

        // Cek apakah file tidak diunggah
        if (empty($file)) {
            $this->form_validation->set_message('file_check', 'File belum ditambahkan.');
            return FALSE;
        }

        $allowed_types = array('gif', 'jpg', 'png');
        $file_ext = pathinfo($file, PATHINFO_EXTENSION);

        if (!in_array($file_ext, $allowed_types)) {
            $this->form_validation->set_message('file_check', 'Ekstensi file yang diunggah tidak valid.');
            return FALSE;
        }

        return TRUE;
    }

    function dd_cek($str)    //Untuk Validasi DropDown jika tidak dipilih
    {
        if ($str == '-Pilih-') {
            $this->form_validation->set_message('dd_cek', 'Harus dipilih');
            return FALSE;
        } else
            return TRUE;
    }

    function barcode_exists($key)
    {
        // Panggil model atau lakukan pengecekan ke database sesuai dengan kebutuhan
        $barcode_exists = $this->m_admin->cari_barcode($key);


        if ($barcode_exists) {
            $this->form_validation->set_message('barcode_exists', 'Barcode Sudah Ada');
            return false;
        } else {
            return true;
        }
    }

    public function tanggal_indonesia($tanggal, $tampilkan_hari = true)
    {
        $hari = array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu');
        $bulan = array(
            1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus',
            'September', 'Oktober', 'November', 'Desember'
        );

        $split = explode('-', $tanggal);
        $tahun = $split[0];
        $bulanIndex = (int)$split[1];
        $tanggal = (int)$split[2];

        $result = '';
        if ($tampilkan_hari) {
            $result .= $hari[date('w', strtotime($tanggal))];
            $result .= ', ';
        }
        $result .= $tanggal . ' ' . $bulan[$bulanIndex] . ' ' . $tahun;

        return $result;
    }


    function tampil($data)
    {
        $data['nama_user'] = $this->db->get_where('tb_user', ['username' =>
        $this->session->userdata('username')])->row_array();
        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar');
        $this->load->view('admin/topbar');
        $this->load->view('admin/isi');
        $this->load->view('admin/footer');
    }
}
