<?php

class M_admin extends CI_Model
{

    // var $table_1 = 'tb_transaksi';
    // var $column_order = array(null, 'waktu', 'harga');
    // var $column_search = array('waktu', 'harga');
    // var $order = array('waktu' => 'desc');

    ///////////// DASHBOARD //////////////////////
    public function dtTahunan()
    {
        $data = [];

        for ($i = 1; $i <= 12; $i++) {
            $query  = $this->db->query('select sum(harga * total_brg) as total from tb_transaksi where month(waktu)=' . $i . '');
            $data[] = $query->row()->total === null ? 0 : $query->row()->total;
        }

        return $data;
    }

    public function sum_daily()
    {
        $query = $this->db->query('select sum(harga * total_brg) as total from tb_transaksi where day(waktu)=' . date('d') . '');

        return $query->row()->total;
    }

    ///////////// KASIR /////////////////
    public function generate_kode_unik($tanggal)
    {
        $this->db->select_max('kode_transaksi');
        $this->db->from('tb_transaksi'); // Ganti dengan nama tabel transaksi yang sesuai
        $this->db->where('DATE(waktu)', $tanggal);
        $query = $this->db->get();

        $last_kode_transaksi = $query->row()->kode_transaksi;
        $new_kode_unik = $last_kode_transaksi !== null ? intval($last_kode_transaksi) + 1 : 1;
        $new_kode_unik = str_pad($new_kode_unik, 4, '0', STR_PAD_LEFT); // Padding dengan nol di depan jika kurang dari 4 digit

        return $new_kode_unik;
    }

    // Menggunakan fungsi untuk mendapatkan No Telp Pelanggan berdasarkan Untuk Mengambil Nama Pelanggan Dan Diskon
    public function getPelangganDataByNoTelp($noTelp)
    {
        // Query untuk mengambil data pelanggan berdasarkan no_telp
        $this->db->where('no_telp', $noTelp);
        $query = $this->db->get('tb_pelanggan');

        if ($query->num_rows() > 0) {
            $row = $query->row();

            // Mengembalikan data pelanggan dalam bentuk array
            return array(
                'nm_pelanggan' => $row->nm_pelanggan,
                'diskon' => $row->diskon,
                // Tambahkan kolom lainnya sesuai kebutuhan
            );
        } else {
            return false;
        }
    }


    public function getDefaultCustomer()
    {
        // Mengambil nilai dari kolom nm_pelanggan yang pertama
        $this->db->select('nm_pelanggan');
        $this->db->from('tb_pelanggan');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $row = $query->first_row(); // atau bisa menggunakan row()
            return $row->nm_pelanggan;
        }

        return null;
    }

    // Menggunakan fungsi di m_admin untuk mendapatkan ID pelanggan berdasarkan nama
    public function get_pelanggan_id($nm_pelanggan)
    {
        // Gantikan "nama_pelanggan" dengan nama kolom yang sesuai di tabel pelanggan
        $this->db->select('id_pelanggan');
        $this->db->where('nm_pelanggan', $nm_pelanggan);
        $query = $this->db->get('tb_pelanggan');

        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->id_pelanggan;
        } else {
            return null;
        }
    }

    // public function invoice()
    // {
    //     $sql = "SELECT MAX(MID(kode_transaksi,9,4)) AS invoice FROM tb_transaksi WHERE MID (kode_transaksi,3,6) = DATE_FORMAT(CURDATE(),'%y%m%d')";
    //     $query = $this->db->query($sql);
    //     if($query->num_rows() > 0){
    //         $row = $query->row();
    //         $n   = ((int)$row->kode_transaksi) + 1;
    //         $no  = sprintf("%'.04d", $n);
    //     }else{
    //         $no = "0001";
    //     }
    //     $invoice = "MP".date('ymd').$no;
    //     return $invoice;
    // }


    public function buat_order($data)
    {
        return $this->db->insert('tb_transaksi', $data);
    }

    public function checkStock($product_id, $quantity)
    {
        // Query untuk mengambil stok produk dari basis data
        $query = $this->db->select('qty')
            ->where('barcode', $product_id)
            ->get('tb_barang');

        if ($query->num_rows() > 0) {
            $product = $query->row();
            $stock = $product->qty;

            // Memeriksa apakah stok cukup
            if ($stock >= $quantity) {
                return true; // Stok cukup
            } else {
                return false; // Stok kurang
            }
        }

        return false; // Produk tidak ditemukan
    }

    public function updateStock($product_id, $quantity)
    {
        // Ambil stok saat ini dari database
        $current_stock = $this->db->select('qty')
            ->where('id_barang', $product_id)
            ->get('tb_barang')
            ->row()
            ->qty;

        // Hitung stok baru setelah penambahan
        $new_stock = $current_stock - $quantity;

        // Update stok di database
        $this->db->set('qty', $new_stock)
            ->where('id_barang', $product_id)
            ->update('tb_barang');
    }

    public function increaseStock($product_id, $quantity)
    {
        // Ambil stok saat ini dari database
        $current_stock = $this->db->select('qty')
            ->where('id_barang', $product_id)
            ->get('tb_barang')
            ->row()
            ->qty;

        // Hitung stok baru setelah penambahan
        $new_stock = $current_stock + $quantity;

        // Update stok di database
        $this->db->set('qty', $new_stock)
            ->where('id_barang', $product_id)
            ->update('tb_barang');
    }

    //////////////// BARANG ////////////////
    public function dtBarang($id = FALSE)
    {
        $this->db->select('*');
        $this->db->from('tb_barang b');
        $this->db->join('tb_kategori k', 'b.id_kategori = k.id_kategori', 'left');
        $this->db->join('tb_satuan s', 's.id_satuan = b.id_satuan', 'left');
        $query = $this->db->get();
        $results = $query->result_array();

        foreach ($results as &$result) {
            if ($result['promo'] > 0) {
                $promoPrice = $result['hrg_jual'] - ($result['hrg_jual'] * $result['promo'] / 100);
                $result['hrg_jual'] = intval($promoPrice);
            }
        }

        return $results;
    }

    public function dtBarangTambah()
    {
        $data = array(
            'barcode' => $this->input->post('barcode'),
            'nm_barang' => $this->input->post('nm_barang'),
            'hrg_jual' => $this->input->post('hrg_jual'),
            'hrg_beli' => $this->input->post('hrg_beli'),
            'id_kategori' => $this->input->post('id_kategori'),
            'id_satuan' => $this->input->post('id_satuan'),
            'promo' => $this->input->post('promo'),
            'qty' => $this->input->post('qty')
        );
        return $this->db->insert('tb_barang', $data);
    }

    public function dtBarangEdit($id)
    {
        $data = array(
            'barcode' => $this->input->post('barcode'),
            'nm_barang' => $this->input->post('nm_barang'),
            'hrg_jual' => $this->input->post('hrg_jual'),
            'hrg_beli' => $this->input->post('hrg_beli'),
            'id_kategori' => $this->input->post('id_kategori'),
            'id_satuan' => $this->input->post('id_satuan'),
            'promo' => $this->input->post('promo'),
            'qty' => $this->input->post('qty')
        );
        $this->db->where('id_barang', $id);
        return $this->db->update('tb_barang', $data);
    }

    public function dropdown_kategori()
    {
        $query = $this->db->get('tb_kategori');
        $result = $query->result();

        $id_kategori = array('-Pilih-');
        $nm_kategori = array('-Pilih-');

        for ($i = 0; $i < count($result); $i++) {
            array_push($id_kategori, $result[$i]->id_kategori);
            array_push($nm_kategori, $result[$i]->nm_kategori);
        }
        return array_combine($id_kategori, $nm_kategori);
    }

    public function dropdown_satuan()
    {
        $query = $this->db->get('tb_satuan');
        $result = $query->result();

        $id_satuan = array('-Pilih-');
        $nm_satuan = array('-Pilih-');

        for ($i = 0; $i < count($result); $i++) {
            array_push($id_satuan, $result[$i]->id_satuan);
            array_push($nm_satuan, $result[$i]->nm_satuan);
        }
        return array_combine($id_satuan, $nm_satuan);
    }



    public function dtKategoriBarang($id = FALSE)
    {

        $this->db->select('*');
        $this->db->from('tb_kategori');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function dtSatuanBarang($id = FALSE)
    {

        $this->db->select('*');
        $this->db->from('tb_satuan');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_barang_qty($product_id)
    {
        $this->db->select('qty');
        $this->db->where('id_barang', $product_id);

        return $this->db->get('tb_barang')->row();
    }

    public function update_barang_qty($id, $qty)
    {
        $this->db->set('qty', $qty);
        $this->db->where('id_barang', $id);

        return $this->db->update('tb_barang');
    }

    function cari_barcode($key)
    {
        $this->db->where('barcode', $key);
        $query = $this->db->get('tb_barang');
        return $query->row_array();
    }


    // public function getProdukById($id)
    // {
    //     // Kueri untuk mengambil data produk berdasarkan id_produk
    //     $this->db->select('*');
    //     $this->db->from('tb_barang');
    //     $this->db->where('id_barang', $id);
    //     return $this->db->get()->row_array();
    // }

    // public function getProdukByBarcode($barcode)
    // {
    //     // Kueri untuk mengambil data produk berdasarkan barcode
    //     $this->db->select('*');
    //     $this->db->from('tb_barang');
    //     $this->db->where('barcode', $barcode);
    //     return $this->db->get()->row_array();
    // }

    //=============== PELANGGAN ===========================
    public function dtPelanggan($id = FALSE)
    {
        $this->db->select('*');
        $this->db->from('tb_pelanggan');
        $this->db->where_not_in('nm_pelanggan', ['Umum']); // Menggunakan WHERE NOT IN untuk memfilter baris dengan nm_pelanggan bukan 'Umum'
        $query = $this->db->get();
        return $query->result_array();
    }


    public function dtPelangganTambah()
    {
        $data = array(
            'email' => $this->input->post('email'),
            'nm_pelanggan' => $this->input->post('nm_pelanggan'),
            'no_telp' => $this->input->post('no_telp'),
            'alamat' => $this->input->post('alamat'),
            'diskon' => $this->input->post('diskon'),
        );

        return $this->db->insert('tb_pelanggan', $data);
    }

    public function dtPelangganEdit($id)
    {
        $data = array(
            'email' => $this->input->post('email'),
            'nm_pelanggan' => $this->input->post('nm_pelanggan'),
            'no_telp' => $this->input->post('no_telp'),
            'alamat' => $this->input->post('alamat'),
            'diskon' => $this->input->post('diskon'),
        );
        $this->db->where('id_pelanggan', $id);
        return $this->db->update('tb_pelanggan', $data);
    }

    //===============  BERITA ===================
    public function dtBerita($id = FALSE)
    {

        $this->db->select('*');
        $this->db->from('tb_berita');
        $this->db->order_by('id_berita', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function dtBeritaTambah()
    {
        $data = array(
            'judul_berita' => $this->input->post('judul_berita'),
            'isi_berita' => $this->input->post('isi_berita'),
            'gambar_berita' => $this->upload->data('file_name'),
            'nama_pengirim' => $this->input->post('nama_pengirim'),
        );

        return $this->db->insert('tb_berita', $data);
    }

    public function updateNamaGambar($id, $file_name)
    {
        $data = array(
            'gambar_berita' => $file_name
        );

        $this->db->where('id_berita', $id);
        $this->db->update('tb_berita', $data);
    }


    public function dtBeritaEdit($id, $nm_gambar_baru)
    {
        $data = array(
            'judul_berita' => $this->input->post('judul_berita'),
            'isi_berita' => $this->input->post('isi_berita'),
            'gambar_berita' => $nm_gambar_baru,
            'nama_pengirim' => $this->input->post('nama_pengirim'),
        );

        $this->db->where('id_berita', $id);
        return $this->db->update('tb_berita', $data);
    }

    //================== USER ==================
    public function dtUser($id = FALSE)
    {

        $this->db->select('*');
        $this->db->from('tb_user');
        $query = $this->db->get();
        return $query->result_array();
    }


    // ============== PROFIL TOKO =================
    public function dtProfilToko($id = FALSE)
    {

        $this->db->select('*');
        $this->db->from('tb_toko');
        $query = $this->db->get();
        return $query->result();
    }

    // ============== CONFIG EMAIL ==============

    public function dtConfigEmail($id = FALSE)
    {

        $this->db->select('*');
        $this->db->from('tb_config');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function dtConfigEmailEdit($id)
    {
        $data = array(
            'email' => $this->input->post('email'),
            'pass' => $this->input->post('pass'),
        );
        $this->db->where('id_config', $id);
        return $this->db->update('tb_config', $data);
    }


    public function cari_toko()
    {
        $this->db->select('*');

        return $this->db->get('tb_toko')->row();
    }

    public function get_email_config()
    {
        $query = $this->db->get('tb_config');

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }


    //=========== SUPPLIER =================
    public function dtSupplier($id = FALSE)
    {

        $this->db->select('*');
        $this->db->from('tb_supplier');
        // $this->db->join('tb_kategori k', 'b.id_kategori = k.id_kategori', 'left');
        // $this->db->join('tb_satuan s', 's.id_satuan = b.id_satuan', 'left');
        $query = $this->db->get();
        return $query->result_array();
    }



    public function dtTransaksi()
    {
        $this->db->select('t.id_transaksi, SUM(t.total_brg) AS total_brg, t.kode_transaksi, t.waktu, SUM(t.harga * total_brg) AS harga, p.diskon, p.nm_pelanggan, u.username');
        $this->db->from('tb_transaksi t');
        $this->db->join('tb_barang b', 't.id_barang = b.id_barang', 'left');
        $this->db->join('tb_pelanggan p', 'p.id_pelanggan = t.id_pelanggan', 'left');
        $this->db->join('tb_user u', 'u.id_level = t.kasir', 'left');
        $this->db->group_by('t.kode_transaksi');
        $this->db->order_by('t.waktu', 'DESC');
        $query = $this->db->get();
        $results = $query->result_array();


        return $results;
    }




    public function dt_transaksi_detil($id)
    {
        $this->db->select('t.id_transaksi, t.kode_transaksi, t.waktu, t.harga, p.diskon, p.nm_pelanggan, u.username, b.nm_barang, t.total_brg');
        $this->db->from('tb_transaksi t');
        $this->db->join('tb_barang b', 't.id_barang = b.id_barang', 'left');
        $this->db->join('tb_pelanggan p', 'p.id_pelanggan = t.id_pelanggan', 'left');
        $this->db->join('tb_user u', 'u.id_level = t.kasir', 'left');
        // $this->db->group_by('t.kode_transaksi');
        $this->db->where('kode_transaksi', $id);
        $query = $this->db->get();

        return $query->result_array();
    }


    public function dtTransaksiBarang($startdate, $enddate)
    {
        $this->db->select('t.waktu, b.nm_barang, t.total_brg, b.qty, t.harga, t.last_qty, b.barcode');
        $this->db->from('tb_transaksi t');
        $this->db->join('tb_barang b', 't.id_barang = b.id_barang');
        if ($startdate !== NULL && $enddate !== NULL) {
            $this->db->where('DATE(t.waktu) >=', $startdate);
            $this->db->where('DATE(t.waktu) <=', $enddate);
        }
        // $this->db->group_by('tanggal');
        $this->db->order_by('waktu', 'DESC');
        $this->db->where('DATE(t.waktu) >= DATE_SUB(CURDATE(), INTERVAL 30 DAY)');
        $this->db->where('DATE(t.waktu) <= CURDATE()');
        $query = $this->db->get();
        $transaksi = $query->result_array();

        return $transaksi;
    }



    public function dtLaporanKeuangan($startdate, $enddate)
    {
        $this->db->select('DATE(t.waktu) as tanggal, SUM(t.harga - b.hrg_beli) as total_harga');
        $this->db->from('tb_transaksi t');
        $this->db->join('tb_barang b', 't.id_barang = b.id_barang');
        if ($startdate !== NULL && $enddate !== NULL) {
            $this->db->where('DATE(t.waktu) >=', $startdate);
            $this->db->where('DATE(t.waktu) <=', $enddate);
        }

        $this->db->group_by('tanggal');
        $this->db->order_by('tanggal', 'ASC');
        $this->db->where('DATE(t.waktu) >= DATE_SUB(CURDATE(), INTERVAL 30 DAY)');
        $this->db->where('DATE(t.waktu) <= CURDATE()');
        $query = $this->db->get();
        $transaksi = $query->result_array();

        return $transaksi;
    }




    // public function filterlaporan($daterange)
    // {
    //     $this->db->where('waktu >=', $daterange[1]);
    //     $this->db->where('waktu <=', $daterange[1]);

    //     return $this->db->get('tb_transaksi');
    // }

    // private function _get_datatables_query()
    // {
    //     if ($this->input->post('tgl_awal')) {
    //         $tgl_awal = $this->input->post('tgl_awal');
    //         $tgl_akhir = $this->input->post('tgl_akhir');
    //         $tgl_a = substr($tgl_awal, 0, 10);
    //         $tgl_b = substr($tgl_akhir, 14, 11);
    //         $this->db->where('waktu >=', $tgl_a);
    //         $this->db->where('waktu <=', $tgl_b);
    //     }

    //     $this->db->from($this->table_1);

    //     $i = 0;
    //     if (isset($_POST['search']) && !empty($_POST['search']['value'])) {
    //         foreach ($this->column_search as $item) {
    //             if ($i === 0) {
    //                 $this->db->group_start();
    //                 $this->db->like($item, $_POST['search']['value']);
    //             } else {
    //                 $this->db->or_like($item, $_POST['search']['value']);
    //             }

    //             if (count($this->column_search) - 1 == $i) {
    //                 $this->db->group_end();
    //             }
    //             $i++;
    //         }
    //     }

    //     if (isset($_POST['order'])) {
    //         $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
    //     } else if (isset($this->order)) {
    //         $order = $this->order;
    //         $this->db->order_by(key($order), $order[key($order)]);
    //     }
    // }

    // function get_datatables()
    // {
    //     $this->_get_datatables_query();
    //     if ($_POST['length'] != -1) {
    //         $this->db->limit($_POST['length'], $_POST['start']);
    //     }
    //     $query = $this->db->get();
    //     return $query->result();
    // }

    // function count_filtered()
    // {
    //     $this->_get_datatables_query();
    //     $query = $this->db->get();
    //     return $query->num_rows();
    // }

    // public function count_all()
    // {
    //     $this->_get_datatables_query();
    //     $query = $this->db->get();
    //     return $this->db->count_all_results();
    // }









    // public function getTransaksiDetail($kodeTransaksi)
    // {
    //     $this->db->where('kode_transaksi', $kodeTransaksi);
    //     $query = $this->db->get('tb_transaksi');
    //     return $query->result();
    // }
}
