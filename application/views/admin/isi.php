<?php
//==================================== HOME ====================================
if ($page == 'dashboard') {

?>
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Notifikasi Barang Hampir Habis atau Habis -->
        <?php if ($barang_habis) : ?>
            <div class="row">
                <div class="col">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Perhatian!</strong> Beberapa barang hampir habis atau habis:
                        <ul>
                            <?php foreach ($barang_habis as $barang) : ?>
                                <li><?= $barang->nm_barang ?> (<?= $barang->qty == 0 ? 'Habis' : 'Hampir habis' ?>)</li>
                            <?php endforeach; ?>
                        </ul>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-3">
            <h1 class="h3 mb-4 text-gray-800">Dashboard</h1>
        </div>

        <!-- Content Row -->
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    <?php if ($this->session->userdata('id_level') == 1 || $this->session->userdata('id_level') == 3) : ?>
                                        Jumlah Barang
                                    <?php elseif ($this->session->userdata('id_level') == 2) : ?>
                                        Jumlah Berita
                                    <?php endif; ?>
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800 counter" id="counter">
                                    <?php if ($this->session->userdata('id_level') == 1 || $this->session->userdata('id_level') == 3) : ?>
                                        <?php echo $jml_barang; ?>
                                    <?php elseif ($this->session->userdata('id_level') == 2) : ?>
                                        <?php echo $jml_berita; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <?php if ($this->session->userdata('id_level') == 1 || $this->session->userdata('id_level') == 3) : ?>
                                    <i class="fas fa-box fa-2x text-gray-300"></i>
                                <?php elseif ($this->session->userdata('id_level') == 2) : ?>
                                    <i class="fas fa-newspaper fa-2x text-gray-300"></i>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <?php if ($this->session->userdata('id_level') == 1) : ?>
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Jumlah Pelanggan
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <?php echo $jml_pelanggan; ?>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-id-card fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <?php if ($this->session->userdata('id_level') == 1 || $this->session->userdata('id_level') == 3) : ?>
                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                        Keuntungan Harian
                                    </div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                                Rp. <?= number_format($pendapatan_harian == NULL ? 0 : $pendapatan_harian) ?>
                                            </div>
                                        </div>
                                        <div class="col"></div>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <?php if ($this->session->userdata('id_level') == 1) : ?>
                <!-- Pending Requests Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Jumlah Supplier
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <?php echo $jml_supplier; ?>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fa-solid fa-truck-field fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Content Row -->
        <?php if ($this->session->userdata('id_level') == 1 || $this->session->userdata('id_level') == 3) : ?>
            <div class="row">
                <div class="col">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Pendapatan Bulanan</h6>
                        </div>
                        <div class="card-body">
                            <div class="chart-area">
                                <canvas id="myAreaChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <!-- Content Row -->
        <?php if ($this->session->userdata('id_level') == 1 || $this->session->userdata('id_level') == 3) : ?>
            <div class="row">
                <div class="col">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Barang Terlaris</h6>
                        </div>
                        <div class="card-body">
                            <div class="chart-area">
                                <canvas id="barangTerlarisChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <!-- /.container-fluid -->
    </div>
    <!-- End of Main Content -->

<?php
}

//==================================== Profile ====================================
else if ($page == 'profile') {
?>

<?php
}

//==================================== changePassword ====================================
else if ($page == 'changePassword') {
?>
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-4 text-gray-800">Ubah Password</h1>

        </div>
        <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->
        <?php echo $this->session->flashdata('pesan'); ?>

        <div class="row">
            <div class="col-lg-6">
                <form action="<?= base_url('admin/changePassword'); ?>" method="post">
                    <div class="form-group">
                        <label for="current_password">Password Saat Ini</label>
                        <input type="password" class="form-control" id="current_password" name="current_password">
                        <span class="badge badge-danger"><?php echo strip_tags(form_error('current_password')); ?></span>
                    </div>
                    <div class="form-group">
                        <label for="new_password1">Password Baru</label>
                        <input type="password" class="form-control" id="new_password1" name="new_password1">
                        <span class="badge badge-danger"><?php echo strip_tags(form_error('new_password1')); ?></span>
                    </div>
                    <div class="form-group">
                        <label for="new_password2">Ulangi Password Baru</label>
                        <input type="password" class="form-control" id="new_password2" name="new_password2">
                        <span class="badge badge-danger"><?php echo strip_tags(form_error('new_password2')); ?></span>
                    </div>
                    <div class="div form-group">
                        <button type="submit" class="btn btn-primary">Ubah Password</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->


<?php
}

//==================================== Kasir ====================================
else if ($page == 'kasir') {
?>
    <!-- Begin Page Content -->
    <div id="body" class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-3">
            <h1 class="h3 mb-4 text-gray-800">Kasir</h1>
        </div>
        <!-- Content Row -->
        <style>
            /* Make the modal responsive */
            .modal-dialog modal-xl {
                max-width: 90%;
                margin: 1.75rem auto;
            }

            /* Adjust the modal body padding for smaller screens */
            @media (max-width: 576px) {
                .modal-dialog {
                    margin: 0.5rem;
                }
            }

            @media print {
                #body {
                    display: none;
                }

                @page {
                    margin: 0;
                }

                .modal-dialog {
                    border: none !important;
                }

                sidebar,
                footer,
                .modal-footer,
                .modal-header,
                title,
                .hide-on-print {
                    display: none !important;
                }
            }

            .tampil-bayar {
                font-size: 5em;
                text-align: center;
                height: 100px;
                color: #f0f0f0;
            }

            .tampil-terbilang {
                padding: 10px;
                background: #f0f0f0;
            }

            .table-penjualan tbody tr:last-child {
                display: none;
            }

            /* @media(max-width: 768px) {
                .tampil-bayar {
                    font-size: 3em;
                    height: 70px;
                    padding-top: 5px;
                }
            } */
        </style>


        <div class="row">
            <div class="col-lg-12">
                <div class="box">
                    <div class="box-body">

                        <div class="form-group row">
                            <label for="barcode" class="col-lg-2">Barcode</label>
                            <div class="col-lg-5">
                                <div class="input-group">
                                    <!-- <input type="hidden" name="id_penjualan" id="id_penjualan" value="{{ $id_penjualan }}">
                                        <input type="hidden" name="id_barang" id="id_barang"> -->
                                    <input type="text" class="form-control" name="barcode" id="barcode" autocomplete="off" autofocus>
                                    <span class="input-group-btn">
                                        <button id="btnTampilBarang" data-toggle="modal" data-target="#barangModal" class="btn btn-info btn-flat" type="button">
                                            <i class="fa fa-arrow-right"></i>
                                        </button>

                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- <table id="shoping_cart_table" class="table table-stiped table-bordered table-penjualan">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Barcode</th>
                                    <th>Nama Barang</th>
                                    <th>Harga</th>
                                    <th width="15%">Jumlah</th>
                                    <th>Diskon</th>
                                    <th>Subtotal</th>
                                    <th width="15%"><i class="fa fa-cog"></i></th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>

                        </table> -->
                        <?php echo $this->session->flashdata('pesan'); ?>

                        <div id="cart_detail"></div>

                    </div>
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="tampil-bayar bg-primary">
                                Total:
                                <span id="total_input"></span>
                            </div>

                            <div class="tampil-terbilang">...</div>
                            <div class="form-group row mt-4">
                                <label for="input_bayar" class="col-lg-2 control-label">Bayar</label>
                                <div class="col-lg-8">
                                    <input type="number" id="input_bayar" name="input_bayar" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="input_kembali" class="col-lg-2 control-label">Kembali</label>
                                <div class="col-lg-8">
                                    <input type="text" id="input_kembali" name="input_kembali" class="form-control" value="0" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <form action="#" class="form-penjualan" method="post">

                                <input type="hidden" name="id_penjualan">
                                <input type="hidden" name="total" id="total">
                                <input type="hidden" name="total_item" id="total_item">
                                <input type="hidden" name="bayar" id="bayar">
                                <input type="hidden" name="id_member" id="id_member">


                                <div class="form-group row">
                                    <label for="kode_transaksi" class="col-lg-2 control-label">Invoice</label>
                                    <div class="col-lg-8">
                                        <input type="text" id="kode_transaksi" class=" form-control" readonly>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="kode_member" class="control-label">Customer</label>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="nm_pelanggan" id="kode_member" readonly value="<?php echo $defaultValue; ?>">
                                            <span class="input-group-btn">
                                                <button id="btnTampilMember" data-toggle="modal" data-target="#memberModal" class="btn btn-info btn-flat" type="button"><i class="fa fa-arrow-right"></i></button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="diskon" class="col-lg-2 control-label">Diskon</label>
                                    <div class="col-lg-8">
                                        <input type="text" name="diskon" value="0%" id="diskon" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2 control-label">Kasir</label>
                                    <div class="col-lg-8">
                                        <input type="text" name="username" id="kasir" class="form-control" value="<?= $nama_user['username']; ?>" readonly>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>

                <div class="box-footer">
                    <button id="simpan_transaksi" type="button" onclick="preview_struck()" class="btn btn-primary btn-sm btn-flat pull-right btn-simpan"><i class="fa fa-print"></i> Simpan Transaksi</button>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal Barang -->
    <div class="modal fade" id="barangModal" tabindex="-1" aria-labelledby="barangModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="barangModalLabel">Data Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="modal-body">
                        <table id="barangTable" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Barcode</th>
                                    <th>Nama Barang</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                    <th>Jumlah</th>
                                    <th><i class="fa fa-cog"></i></th>
                                </tr>
                            </thead>
                            <!-- <tbody>
                                <?php
                                $no = 1;
                                foreach ($barang as $b) {
                                ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><span class="badge badge-primary"><?php echo $b['barcode'] ?></span></td>
                                        <td><?php echo $b['nm_barang'] ?></td>
                                        <td><?php echo  'Rp. ' . number_format($b['hrg_jual'], 0, ',', '.') ?></td>
                                        <td><?php echo $b['qty'] ?></td>
                                        <td><input type="text" name="quantity" class="form-control quantity" id="<?php echo $b['barcode']; ?>"></td>
                                        <td>
                                            <button type="button" name="add_cart" class="btn btn-success btn-sm add_cart" data-productname="<?php echo $b['nm_barang']; ?>" data-price="<?php echo $b['hrg_jual']; ?>" data-productid="<?php echo $b['barcode']; ?>" data-productprimary="<?php echo $b['id_barang']; ?>"><i class="fa fa-cart-plus"></i> Tambah</button>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody> -->
                        </table>
                    </div>
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>

        </div>
    </div>



    <!-- /.container-fluid -->
    </div>

    <!-- Modal Member -->
    <div class="modal fade" id="memberModal" tabindex="-1" aria-labelledby="barangModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="barangModalLabel">Data Pelanggan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="modal-body">
                        <table id="memberTable" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nomor Member</th>
                                    <th><i class="fa fa-cog"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;

                                ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><input type="text" name="no_telp" id="no_telp" class="form-control"></td>
                                    <td>
                                        <button type="button" id="btnTambahMember" class="btn btn-success btn-sm"><i class=" fa fa-plus"></i> Tambah</button>
                                    </td>

                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>

        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modal_struck" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close hide-on-print" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                </div>
                <div class="modal-body" id="content_struck"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" OnClick="save_transaction()"><span class="fa fa-print"></span>Simpan</button>
                    <button type="button" class="btn btn-success" OnClick="print_transaction()"><span class="fa fa-print"></span>Cetak dan Simpan</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Main Content -->

    <script src=" <?php echo base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $("body").toggleClass("sidebar-toggled");
            $(".sidebar").toggleClass("toggled");

        });
    </script>

<?php
}

//==================================== Penjualan ====================================
else if ($page == 'penjualanBarang') {
?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Penjualan Barang</h1>

            <div class="dropdown">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary btn-sm" data-target="#modal" data-toggle="modal">
                    <i class="fa-solid fa-calendar-days"></i> Ubah Periode
                </button>
                <!-- <button class="btn btn-warning btn-sm  dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-download"></i> Export</button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="<?php echo $downloadLink; ?>"><i class="fas fa-file-excel fa-sm"></i> Excel</a>



                    <a class="dropdown-item" href="#" target="_blank"><i class=" fas fa-file-pdf fa-sm"></i> PDF</a>
                </div> -->
            </div>

            <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah Pelanggan</a> -->
        </div>
        <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->
        <!-- Modal -->
        <div class="modal fade" id="modal" role="dialog" aria-labelledby="modalLabel" tabindex="-1">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Datepicker</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?php echo base_url('admin/penjualanBarang'); ?>" method="post">
                            <input type="text" class="form-control mb-2" name="startdate" id="startdate" autocomplete="off" placeholder="Tanggal Awal..." required>
                            <input type="text" class="form-control mb-2" name="enddate" id="enddate" autocomplete="off" placeholder="Tanggal Akhir..." req>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary mb-2">Set</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Penjualan Barang</h6>
            </div>


            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped nowrap display" width="100%" cellspacing="0" id="myTable">
                        <thead>
                            <tr>
                                <th class="border-0 text-center">Tanggal</th>
                                <th class="border-0 text-center">Barcode</th>
                                <th class="border-0 text-center">Barang Yang Terjual</th>
                                <th class="border-0 text-center">Jumlah</th>
                                <th class="border-0 text-center">Harga Satuan</th>
                                <th class="border-0 text-center">Harga Total</th>
                                <th class="border-0 text-center">Sisa Stok</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $totalharga = 0;
                            foreach ($transaksi as $lp) {
                            ?>
                                <tr>

                                    <td class="text-center"><?php echo $lp['waktu'] ?></td>
                                    <td class="text-center"><?php echo $lp['barcode'] ?></td>
                                    <td class="text-center"><?php echo $lp['nm_barang']; ?></td>
                                    <td class="text-center"><?php echo $lp['jumlah_jual']; ?></td>
                                    <td class="text-center"><?php echo 'Rp. ' . number_format($lp['hrg_jual'], 0, ',', '.'); ?></td>
                                    <td class="text-center"><?php echo 'Rp. ' . number_format($lp['total_harga'], 0, ',', '.'); ?></td>
                                    <td class="text-center"><?php echo $lp['last_qty'];
                                                            ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>


                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

<?php
}

//==================================== laporan Pendapatan ====================================
else if ($page == 'laporanPendapatan') {
?>


    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Laporan Pendapatan</h1>

            <div class="dropdown">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary btn-sm" data-target="#modal" data-toggle="modal">
                    <i class="fa-solid fa-calendar-days"></i> Ubah Periode
                </button>

            </div>

            <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah Pelanggan</a> -->
        </div>

        <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->

        <?php echo $this->session->flashdata('pesan'); ?>
        <!-- Modal -->
        <div class="modal fade" id="modal" role="dialog" aria-labelledby="modalLabel" tabindex="-1">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Datepicker</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?php echo base_url('admin/laporanKeuangan'); ?>" method="post">
                            <input type="text" class="form-control mb-2" name="startdate" id="startdate" autocomplete="off" placeholder="Tanggal Awal..." required>
                            <input type="text" class="form-control mb-2" name="enddate" id="enddate" autocomplete="off" placeholder="Tanggal Akhir..." req>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary mb-2">Set</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- 
        <div class="col-md-6 col-md-6 col-lg-6">
            <form class="mt-1" method="post" id="form">
                <div class="input-group mb-3">

                    <div class="input-group">
                        <label for="">Range Tanggal</label>
                        <button class="btn btn-default" type="button"></button>
                    </div>
                    <input type="text" class="form-control shawCalRanges" name="rangetgl" id="rangetgl">
                    <div class="input-group-append">
                        <button class="btn btn-info" type="button" id="btn-filter">Set</button>
                    </div>
                </div>
            </form>
        </div> -->

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Laporan Pendapatan</h6>
            </div>

            <div class="card-body">


                <div class="table-responsive no-wrap">
                    <table class="table table-bordered table-striped nowrap display" width="100%" cellspacing="0" id="myTable">
                        <thead>
                            <tr>
                                <th class="border-0 text-center">Tanggal</th>
                                <th class="border-0 text-center">Keuntungan</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $totalharga = 0;
                            foreach ($laporan as $lp) {
                            ?>
                                <tr>

                                    <td class="text-center"><?php echo $lp['tanggal'] ?></td>
                                    <td class="text-center"><?php echo  'Rp. ' . number_format($lp['total_harga'], 0, ',', '.');
                                                            $totalharga += $lp['total_harga'];
                                                            ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>

                        <tfoot>
                            <tr class="bg-dark text-white">
                                <th style="text-align:center" colspan="1">Jumlah</th>
                                <th style="text-align:center"><?= 'Rp. ' . number_format($totalharga, 0, ',', '.'); ?></th>
                            </tr>
                        </tfoot>

                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->



<?php
}

//==================================== Riwayat Transaksi ====================================
else if ($page == 'riwayatTransaksi') {
?>
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Riwayat Transaksi</h1>
        <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Riwayat Transaksi</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Transaksi</th>
                                <th>Waktu</th>
                                <th>Customer</th>
                                <th>Kasir</th>
                                <th>Qty</th>
                                <th>Bayar</th>
                                <th>Total</th>
                                <th>Aksi</th>
                            </tr>

                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($transaksi as $tr) {
                            ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $tr['kode_transaksi'] ?></td>
                                    <td><?php echo $tr['waktu'] ?></td>
                                    <td><?php echo $tr['nm_pelanggan'] ?></td>
                                    <td><?php echo $tr['username'] ?></td>
                                    <td><?php echo $tr['total_brg'] ?></td>
                                    <td><?php echo 'Rp. ' . number_format($tr['jumlah_bayar'], 0, ',', '.'); ?></td>
                                    <td><?php echo 'Rp. ' . number_format($tr['total_hrg'], 0, ',', '.'); ?></td>

                                    <td>
                                        <a href=<?php echo base_url("admin/transaksiDetail/") . $tr['id_transaksi']; ?>><span class="badge badge-success"><i class="fa-solid fa-eye"></i> Detail</span></a> |
                                        <a href=<?php echo base_url("admin/transaksiHapus/") . $tr['id_transaksi']; ?> onclick="return confirm('Yakin menghapus Transaksi : <?php echo $tr['kode_transaksi']; ?> ?');" ;><span class="badge badge-danger"><i class="fa-solid fa-trash"></i> Hapus</span></a>

                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

<?php
}

//--------------------------------- Transaksi Detil ---------------------------------
else if ($page == 'transaksiDetail') {
?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Detail Transaksi - <?php echo $detail[0]['kode_transaksi']; ?></h1>

        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <tbody>
                            <tr>
                                <th>Kode Transaksi</th>
                                <td colspan="3"><?php echo $detail[0]['kode_transaksi']; ?></td>
                            </tr>
                            <tr>
                                <th>Total Harga</th>
                                <td colspan="3"><?php echo 'Rp. ' . number_format($detail[0]['total_hrg'], 0, ',', '.'); ?></td>
                            </tr>
                            <tr>
                                <th>Diskon</th>
                                <td colspan="3"><?php echo $detail[0]['diskon'] . '%'; ?></td>
                            </tr>
                            <tr>
                                <th>Customer</th>
                                <td colspan="3"><?php echo $detail[0]['nm_pelanggan'];
                                                ?></td>
                            </tr>
                            <tr>
                                <th>Kasir</th>
                                <td colspan="3"><?php echo $detail[0]['username'];
                                                ?></td>
                            </tr>
                            <tr>
                                <th>Nama Barang</th>
                                <th>Harga Jual</th>
                                <th>Quantity</th>
                            </tr>
                            <?php foreach ($detail as $d) : ?>
                                <tr>
                                    <td><?php echo $d['nm_barang']; ?></td>
                                    <td><?php echo 'Rp. ' . number_format($d['hrg_jual'], 0, ',', '.'); ?></td>
                                    <td><?php echo $d['jumlah_jual']; ?></td>
                                </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <a href="<?php echo base_url("admin/riwayatTransaksi") ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i> Kembali</a>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->


<?php
}

//==================================== Barang ====================================
else if ($page == 'barang') {
?>
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-4 text-gray-800">Barang</h1>
            <a href="<?php echo base_url("admin/barangTambah") ?>" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-plus"></i> Tambah Barang</a>
        </div>
        <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
        For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->
        <?php echo $this->session->flashdata('pesan'); ?>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Barang</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Barcode</th>
                                <th>Nama Barang</th>
                                <th>Qty</th>
                                <th>Harga Jual</th>
                                <th>Harga Beli</th>
                                <th>Kategori</th>
                                <th>Satuan</th>
                                <th>Promo</th>
                                <th>Supplier</th>
                                <th>Aksi</th>

                            </tr>

                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($barang as $b) { ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><span class="badge badge-primary"><?php echo $b['barcode'] ?></span></td>
                                    <td><?php echo $b['nm_barang'] ?></td>
                                    <td><?php echo $b['qty'] ?></td>
                                    <td><?php echo  'Rp. ' . number_format($b['hrg_jual'], 0, ',', '.') ?></td>
                                    <td><?php echo  'Rp. ' . number_format($b['hrg_beli'], 0, ',', '.') ?></td>
                                    <td><?php echo $b['nm_kategori'] ?></td>
                                    <td><?php echo $b['nm_satuan'] ?></td>
                                    <td><?php echo $b['promo'], '%' ?></td>
                                    <td><?php echo $b['nm_supplier']; ?></td>
                                    <td>
                                        <a href=<?php echo base_url("admin/barangEdit/") . $b['id_barang']; ?>><span class="badge badge-success">Edit</span></a> |
                                        <a href=<?php echo base_url("admin/barangHapus/") . $b['id_barang']; ?> onclick="return confirm('Yakin menghapus Barang : <?php echo $b['nm_barang']; ?> ?');" ;><span class="badge badge-danger">Hapus</span></a>

                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>


                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->
<?php
}

//==================================== Barang Tambah ====================================
else if ($page == 'barangTambah') {
?>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-3">
            <h1 class="h3 mb-0 text-gray-800">Tambah Barang</h1>
        </div>

        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header"><strong>Isi Form Dibawah Ini!</strong></div>
                <div class="card-body">
                    <form method="POST" action="<?php echo base_url("admin/barangTambah") ?>">
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="kategori" class="form-label">Pilih Supplier</label>
                                    <?php echo form_dropdown('id_supplier', $ddsupplier, set_value('id_supplier'), 'class="form-control"'); ?>
                                    <span class="badge badge-warning"><?php echo strip_tags(form_error('id_supplier')); ?></span>

                                </div>
                                <div class="form-group">
                                    <label>Barcode</label>
                                    <input type="text" name="barcode" placeholder="Masukkan Barcode..." value="<?= set_value('barcode') ?>" class="form-control">
                                    <span class="badge badge-danger"><?php echo strip_tags(form_error('barcode')); ?></span>
                                </div>
                                <div class="form-group">
                                    <label>Nama Barang</label>
                                    <input type="text" name="nm_barang" placeholder="Masukkan Nama Barang..." class="form-control">
                                    <span class="badge badge-danger"><?php echo strip_tags(form_error('nm_barang')); ?></span>
                                </div>
                                <div class="form-group">
                                    <label>Harga Jual</label>
                                    <input type="number" name="hrg_jual" placeholder="Masukkan Harga Jual..." class="form-control">
                                    <span class="badge badge-danger"><?php echo strip_tags(form_error('hrg_jual')); ?></span>
                                </div>
                                <div class="form-group">
                                    <label>Harga Beli</label>
                                    <input type="number" name="hrg_beli" placeholder="Masukkan Harga Beli..." class="form-control">
                                    <span class="badge badge-danger"><?php echo strip_tags(form_error('hrg_beli')); ?></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="kategori" class="form-label">Pilih Kategori Barang</label>
                                    <?php echo form_dropdown('id_kategori', $ddkategori, set_value('id_kategori'), 'class="form-control"'); ?>
                                    <span class="badge badge-warning"><?php echo strip_tags(form_error('id_kategori')); ?></span>

                                </div>
                                <div class="form-group">
                                    <label for="satuan" class="form-label">Pilih Satuan Barang</label>
                                    <?php echo form_dropdown('id_satuan', $ddsatuan, set_value('id_satuan'), 'class="form-control"'); ?>
                                    <span class="badge badge-warning"><?php echo strip_tags(form_error('id_satuan')); ?></span>

                                </div>
                                <div class="form-group">
                                    <label>Promo</label>
                                    <input type="number" name="promo" placeholder="Masukkan Promo..." class="form-control">
                                    <span class="badge badge-danger"><?php echo strip_tags(form_error('promo')); ?></span>
                                </div>
                                <div class="form-group">
                                    <label>Jumlah Barang</label>
                                    <input type="number" name="qty" placeholder="Masukkan Jumlah Barang" class="form-control">
                                    <span class="badge badge-danger"><?php echo strip_tags(form_error('qty')); ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="float-right">
                            <a href="<?php echo base_url("admin/barang") ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="reset" class="btn btn-danger"><i class="fa fa-times"></i>&nbsp;&nbsp;Batal</button>
                    </form>
                </div>
            </div>
        </div>


    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->
<?php
}

//==================================== barang Edit ====================================
else if ($page == 'barangEdit') {
?>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-3">
            <h1 class="h3 mb-0 text-gray-800">Edit Barang</h1>
        </div>

        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header"><strong>Isi Form Dibawah Ini!</strong></div>
                <div class="card-body">
                    <form method="POST" action="<?php echo base_url('admin/barangEdit/' . $b['id_barang']); ?>">
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="supplier" class="form-label">Pilih Supplier</label>
                                    <?php echo form_dropdown('id_supplier', $ddsupplier, set_value('id_supplier', $b['id_supplier']), 'class="form-control"'); ?>
                                    <span class="badge badge-warning"><?php echo strip_tags(form_error('id_supplier')); ?></span>

                                </div>
                                <div class="form-group">
                                    <label>Barcode</label>
                                    <input type="text" name="barcode" placeholder="Masukkan Barcode..." value="<?php echo set_value('barcode', $b['barcode']); ?>" class="form-control">
                                    <span class="badge badge-danger"><?php echo strip_tags(form_error('barcode')); ?></span>
                                </div>
                                <div class="form-group">
                                    <label>Nama Barang</label>
                                    <input type="text" name="nm_barang" placeholder="Masukkan Nama Barang..." value="<?php echo set_value('nm_barang', $b['nm_barang']); ?>" class="form-control">
                                    <span class="badge badge-danger"><?php echo strip_tags(form_error('nm_barang')); ?></span>
                                </div>
                                <div class="form-group">
                                    <label>Harga Jual</label>
                                    <input type="text" name="hrg_jual" placeholder="Masukkan Harga Jual..." value="<?php echo set_value('hrg_jual', $b['hrg_jual']); ?>" class="form-control">
                                    <span class="badge badge-danger"><?php echo strip_tags(form_error('hrg_jual')); ?></span>
                                </div>
                                <div class="form-group">
                                    <label>Harga Beli</label>
                                    <input type="text" name="hrg_beli" placeholder="Masukkan Harga Beli..." value="<?php echo set_value('hrg_beli', $b['hrg_beli']); ?>" class="form-control">
                                    <span class="badge badge-danger"><?php echo strip_tags(form_error('hrg_beli')); ?></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="kategori" class="form-label">Pilih Kategori Barang</label>
                                    <?php echo form_dropdown('id_kategori', $ddkategori, set_value('id_kategori', $b['id_kategori']), 'class="form-control"'); ?>
                                    <span class="badge badge-warning"><?php echo strip_tags(form_error('id_kategori')); ?></span>

                                </div>
                                <div class="form-group">
                                    <label for="satuan" class="form-label">Pilih Satuan Barang</label>
                                    <?php echo form_dropdown('id_satuan', $ddsatuan, set_value('id_satuan', $b['id_satuan']), 'class="form-control"'); ?>
                                    <span class="badge badge-warning"><?php echo strip_tags(form_error('id_satuan')); ?></span>

                                </div>
                                <div class="form-group">
                                    <label>Promo</label>
                                    <input type="text" name="promo" placeholder="Masukkan Promo..." value="<?php echo set_value('promo', $b['promo']); ?>" class="form-control">
                                    <span class="badge badge-danger"><?php echo strip_tags(form_error('promo')); ?></span>
                                </div>
                                <div class="form-group">
                                    <label>Jumlah Barang</label>
                                    <input type="number" name="qty" placeholder="Masukkan Jumlah Barang" value="<?php echo set_value('qty', $b['qty']); ?>" class="form-control">
                                    <span class="badge badge-danger"><?php echo strip_tags(form_error('qty')); ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="float-right">
                            <a href="<?php echo base_url("admin/barang") ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="reset" class="btn btn-danger"><i class="fa fa-times"></i>&nbsp;&nbsp;Batal</button>
                    </form>
                </div>
            </div>
        </div>


    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->
<?php
}

//==================================== Kategori Tambah ====================================
else if ($page == 'kategoriBarang') {
?>
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-4 text-gray-800">Kategori Barang</h1>
            <a href="<?php echo base_url("admin/kategoriTambah") ?>" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-plus"></i> Tambah Kategori Barang</a>
        </div>
        <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->
        <?php echo $this->session->flashdata('pesan'); ?>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Kategori Barang</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kategori</th>
                                <th><i class="fa fa-gears"></i></th>
                            </tr>

                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($katbarang as $kb) { ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $kb['nm_kategori'] ?></td>
                                    <td>
                                        <a href=<?php echo base_url("admin/kategoriEdit/") . $kb['id_kategori']; ?>><span class="badge badge-success">Edit</span></a> |
                                        <a href=<?php echo base_url("admin/kategoriHapus/") . $kb['id_kategori']; ?> onclick="return confirm('Yakin menghapus Kategori : <?php echo $kb['nm_kategori']; ?> ?');" ;><span class="badge badge-danger">Hapus</span></a>

                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>


                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->
<?php
}

//==================================== Kategori Tambah ====================================
else if ($page == 'kategoriTambah') {
?>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-3">
            <h1 class="h3 mb-0 text-gray-800">Tambah Kategori Barang</h1>
        </div>

        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header"><strong>Isi Form Dibawah Ini!</strong></div>
                <div class="card-body">
                    <form method="POST" action="<?php echo base_url("admin/kategoriTambah"); ?>">
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Kategori Barang</label>
                                    <input type="text" name="nm_kategori" placeholder="Masukkan Kategori Barang..." value="<?= set_value('nm_kategori') ?>" class="form-control">
                                    <span class="badge badge-danger"><?php echo strip_tags(form_error('nm_kategori')); ?></span>
                                </div>

                            </div>
                        </div>
                        <div class="float-right">
                            <a href="<?php echo base_url("admin/kategoriBarang") ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="reset" class="btn btn-danger"><i class="fa fa-times"></i>&nbsp;&nbsp;Batal</button>
                    </form>
                </div>
            </div>
        </div>


    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

<?php
}

//==================================== Kategori Edit ====================================
else if ($page == 'kategoriEdit') {
?>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-3">
            <h1 class="h3 mb-0 text-gray-800">Edit Kategori Barang</h1>
        </div>

        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header"><strong>Isi Form Dibawah Ini!</strong></div>
                <div class="card-body">
                    <form method="POST" action="<?php echo base_url("admin/kategoriEdit/" . $k['id_kategori']) ?>">
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Kategori Barang</label>
                                    <input type="text" name="nm_kategori" placeholder="Masukkan Kategori Barang..." value="<?php echo set_value('nm_kategori', $k['nm_kategori']); ?>" class="form-control">
                                    <span class="badge badge-danger"><?php echo strip_tags(form_error('nm_kategori')); ?></span>
                                </div>

                            </div>
                        </div>
                        <div class="float-right">
                            <a href="<?php echo base_url("admin/kategoriBarang") ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="reset" class="btn btn-danger"><i class="fa fa-times"></i>&nbsp;&nbsp;Batal</button>
                    </form>
                </div>
            </div>
        </div>


    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

<?php
}

//==================================== Satuan Barang ====================================
else if ($page == 'satuanBarang') {
?>
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-4 text-gray-800">Satuan Barang</h1>
            <a href="<?php echo base_url("admin/satuanTambah") ?>" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-plus"></i> Tambah Satuan Barang</a>
        </div>
        <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->
        <?php echo $this->session->flashdata('pesan'); ?>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Satuan Barang</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Satuan</th>
                                <th><i class="fa fa-gears"></i></th>
                            </tr>

                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($satbarang as $sb) { ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $sb['nm_satuan'] ?></td>
                                    <td>
                                        <a href=<?php echo base_url("admin/satuanEdit/") . $sb['id_satuan']; ?>><span class="badge badge-success">Edit</span></a> |
                                        <a href=<?php echo base_url("admin/satuanHapus/") . $sb['id_satuan']; ?> onclick="return confirm('Yakin menghapus Satuan : <?php echo $sb['nm_satuan']; ?> ?');" ;><span class="badge badge-danger">Hapus</span></a>

                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>


                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->
<?php
}

//==================================== Satuan Tambah ====================================
else if ($page == 'satuanTambah') {
?>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-3">
            <h1 class="h3 mb-0 text-gray-800">Tambah Satuan Barang</h1>
        </div>

        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header"><strong>Isi Form Dibawah Ini!</strong></div>
                <div class="card-body">
                    <form method="POST" action="<?php echo base_url("admin/satuanTambah"); ?>">
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Satuan Barang</label>
                                    <input type="text" name="nm_satuan" placeholder="Masukkan Satuan Barang..." value="<?= set_value('nm_satuan') ?>" class="form-control">
                                    <span class="badge badge-danger"><?php echo strip_tags(form_error('nm_satuan')); ?></span>
                                </div>

                            </div>
                        </div>
                        <div class="float-right">
                            <a href="<?php echo base_url("admin/satuanBarang") ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="reset" class="btn btn-danger"><i class="fa fa-times"></i>&nbsp;&nbsp;Batal</button>
                    </form>
                </div>
            </div>
        </div>


    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->


<?php
}

//==================================== Satuan Edit ====================================
else if ($page == 'satuanEdit') {
?>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-3">
            <h1 class="h3 mb-0 text-gray-800">Edit Satuan Barang</h1>
        </div>

        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header"><strong>Isi Form Dibawah Ini!</strong></div>
                <div class="card-body">
                    <form method="POST" action="<?php echo base_url("admin/satuanEdit/" . $s['id_satuan']) ?>">
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Satuan Barang</label>
                                    <input type="text" name="nm_satuan" placeholder="Masukkan Satuan Barang..." value="<?php echo set_value('nm_satuan', $s['nm_satuan']); ?>" class="form-control">
                                    <span class="badge badge-danger"><?php echo strip_tags(form_error('nm_satuan')); ?></span>
                                </div>

                            </div>
                        </div>
                        <div class="float-right">
                            <a href="<?php echo base_url("admin/satuanBarang") ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="reset" class="btn btn-danger"><i class="fa fa-times"></i>&nbsp;&nbsp;Batal</button>
                    </form>
                </div>

            </div>
        </div>


    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->
<?php
}

//==================================== Pelanggan ====================================
else if ($page == 'pelanggan') {
?>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <?php echo validation_errors('<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>', '</div>'); ?>
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Pelanggan</h1>

            <div class="dropdown">
                <a href="<?php echo base_url("admin/pelangganTambah") ?>" class="btn btn-primary btn-sm "><i class="fa fa-plus"></i> Tambah Pelanggan</a>
                <!-- <button class="btn btn-warning btn-sm  dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-download"></i> Export</button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#" target="_blank"><i class=" fas fa-file-excel fa-sm"></i> Excel</a>
                    <a class="dropdown-item" href="#" target="_blank"><i class=" fas fa-file-pdf fa-sm"></i> PDF</a>
                </div> -->
            </div>

            <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah Pelanggan</a> -->
        </div>
        <?php echo $this->session->flashdata('pesan'); ?>

        <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
        For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Pelanggan</h6>
            </div>
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Email</th>
                                <th>Nama Pelanggan</th>
                                <th>Nomor Telpon</th>
                                <th>Alamat</th>
                                <th>Daftar Sejak</th>
                                <th>Diskon</th>
                                <th>Aksi</th>

                            </tr>

                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($pelanggan as $p) { ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $p['email'] ?></td>
                                    <td><?php echo $p['nm_pelanggan'] ?></td>
                                    <td><?php echo $p['no_telp'] ?></td>
                                    <td><?php echo $p['alamat'] ?></td>
                                    <td><?php echo $p['date_created'] ?></td>
                                    <td><?php echo $p['diskon'], '%' ?></td>
                                    <td>
                                        <a href=<?php echo base_url("admin/pelangganEdit/") . $p['id_pelanggan']; ?>><span class="badge badge-success">Edit</span></a> |
                                        <a href=<?php echo base_url("admin/pelangganHapus/") . $p['id_pelanggan']; ?> onclick="return confirm('Yakin menghapus Pelanggan : <?php echo $p['nm_pelanggan']; ?> ?');" ;><span class="badge badge-danger">Hapus</span></a>

                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->


<?php
}
//==================================== Pelanggan Tambah ====================================
else if ($page == 'pelangganTambah') {
?>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-3">
            <h1 class="h3 mb-0 text-gray-800">Tambah Pelanggan</h1>
        </div>

        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header"><strong>Isi Form Dibawah Ini!</strong></div>
                <div class="card-body">
                    <form method="POST" action="<?php echo base_url("admin/pelangganTambah") ?>">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" placeholder="Masukkan Email" value="<?= set_value('email') ?>" class="form-control">
                            <span class="badge badge-danger"><?php echo strip_tags(form_error('email')); ?></span>
                        </div>
                        <div class="form-group">
                            <label>Nama Pelanggan</label>
                            <input type="text" name="nm_pelanggan" placeholder="Masukkan Nama Pelanggan" class="form-control">
                            <span class="badge badge-danger"><?php echo strip_tags(form_error('nm_pelanggan')); ?></span>
                        </div>
                        <div class="form-group">
                            <label>Nomor Telepon</label>
                            <input type="text" name="no_telp" placeholder="Masukkan Nomor Telepon" class="form-control">
                            <span class="badge badge-danger"><?php echo strip_tags(form_error('no_telp')); ?></span>
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <input type="text" name="alamat" placeholder="Masukkan Alamat" class="form-control">
                            <span class="badge badge-danger"><?php echo strip_tags(form_error('alamat')); ?></span>
                        </div>
                        <div class="form-group">
                            <label>Diskon</label>
                            <input type="text" name="diskon" placeholder="Masukkan Diskon" class="form-control">
                            <span class="badge badge-danger"><?php echo strip_tags(form_error('diskon')); ?></span>
                        </div>
                        <!-- <div class="form-group">
                            <label>Jumlah Barang</label><br>
                            <input type="number" name="jumlah_barang" placeholder="Masukkan Jumlah Barang" class="form-control">
                        </div> -->
                        <div class="float-right">
                            <a href="<?php echo base_url("admin/pelanggan") ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="reset" class="btn btn-danger"><i class="fa fa-times"></i>&nbsp;&nbsp;Batal</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

<?php
}
//==================================== Pelanggan Edit ====================================
else if ($page == 'pelangganEdit') {
?>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-3">
            <h1 class="h3 mb-0 text-gray-800">Edit Pelanggan</h1>
        </div>

        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header"><strong>Isi Form Dibawah Ini!</strong></div>
                <div class="card-body">
                    <form method="POST" action="<?php echo base_url('admin/pelangganEdit/' . $p['id_pelanggan']); ?>">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" placeholder="Masukkan Email" value="<?php echo set_value('email', $p['email']); ?>" class="form-control">
                            <span class="badge badge-danger"><?php echo strip_tags(form_error('email')); ?></span>
                        </div>
                        <div class="form-group">
                            <label>Nama Pelanggan</label>
                            <input type="text" name="nm_pelanggan" placeholder="Masukkan Nama Pelanggan" value="<?php echo set_value('nm_pelanggan', $p['nm_pelanggan']); ?>" class="form-control">
                            <span class="badge badge-danger"><?php echo strip_tags(form_error('nm_pelanggan')); ?></span>
                        </div>
                        <div class="form-group">
                            <label>Nomor Telepon</label>
                            <input type="text" name="no_telp" placeholder="Masukkan Nomor Telepon" value="<?php echo set_value('no_telp', $p['no_telp']); ?>" class="form-control">
                            <span class="badge badge-danger"><?php echo strip_tags(form_error('no_telp')); ?></span>
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <input type="text" name="alamat" placeholder="Masukkan Alamat" value="<?php echo set_value('alamat', $p['alamat']); ?>" class="form-control">
                            <span class="badge badge-danger"><?php echo strip_tags(form_error('alamat')); ?></span>
                        </div>
                        <div class="form-group">
                            <label>Diskon</label>
                            <input type="text" name="diskon" placeholder="Masukkan Diskon" value="<?php echo set_value('diskon', $p['diskon']); ?>" class="form-control">
                            <span class="badge badge-danger"><?php echo strip_tags(form_error('diskon')); ?></span>
                        </div>
                        <!-- <div class="form-group">
                            <label>Jumlah Barang</label><br>
                            <input type="number" name="jumlah_barang" placeholder="Masukkan Jumlah Barang" class="form-control">
                        </div> -->
                        <div class="float-right">
                            <a href="<?php echo base_url("admin/pelanggan") ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="reset" class="btn btn-danger"><i class="fa fa-times"></i>&nbsp;&nbsp;Batal</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

<?php
}

//==================================== Berita ====================================
else if ($page == 'berita') {
?>
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Berita</h1>

            <div class="dropdown">
                <a href="<?php echo base_url("admin/beritaTambah") ?>" class="btn btn-primary btn-sm "><i class="fa fa-plus"></i> Tambah Berita</a>
                <button type="button" class="btn btn-success btn-sm" data-target="#modal" data-toggle="modal">
                    <i class="fa-solid fa-calendar-days"></i> Ubah Periode
                </button>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="modal" role="dialog" aria-labelledby="modalLabel" tabindex="-1">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Datepicker</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?php echo base_url('admin/berita'); ?>" method="post">
                            <input type="text" class="form-control mb-2" name="startdate" id="startdate" placeholder="Tanggal Awal..." autocomplete="off" required>
                            <input type="text" class="form-control mb-2" name="enddate" id="enddate" placeholder="Tanggal Akhir..." autocomplete="off" req>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary mb-2">Set</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
        For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->
        <?php echo $this->session->flashdata('pesan'); ?>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Berita</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul Berita</th>
                                <th>Isi Berita</th>
                                <th>Gambar Berita</th>
                                <th>Pengirim</th>
                                <th>Waktu Dibuat</th>
                                <th class="exclude-export">Aksi</th>

                            </tr>

                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($berita as $b) { ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $b['judul_berita'] ?></td>
                                    <td><?php echo $b['isi_berita'] ?></td>
                                    <td><img src="<?php echo base_url('uploads/gambarBerita') ?>/<?php echo $b['gambar_berita'] ?>" width="150px" alt=""></td>
                                    <td><?php echo $b['nama_pengirim'] ?></td>
                                    <td><?php echo $b['tanggal'] ?></td>
                                    <td>
                                        <a href=<?php echo base_url("admin/beritaEdit/") . $b['id_berita']; ?>><span class="badge badge-success">Edit</span></a> |
                                        <a href=<?php echo base_url("admin/beritaHapus/") . $b['id_berita']; ?> onclick="return confirm('Yakin menghapus Berita : <?php echo $b['judul_berita']; ?> ?');" ;><span class="badge badge-danger">Hapus</span></a>

                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->
<?php
}
//==================================== Berita Tambah ====================================
else if ($page == 'beritaTambah') {
?>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-3">
            <h1 class="h3 mb-0 text-gray-800">Tambah Berita</h1>
        </div>
        <?php echo $this->session->flashdata('error'); ?>

        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header"><strong>Isi Form Dibawah Ini!</strong></div>
                <div class="card-body">
                    <form enctype="multipart/form-data" action="<?php echo base_url("admin/beritaTambah") ?>" method="post">
                        <div class="form-group">
                            <label>Judul Berita</label>
                            <input type="text" name="judul_berita" placeholder="Masukkan Judul Berita" value="<?= set_value('judul_berita') ?>" class="form-control">
                            <span class="badge badge-danger"><?php echo strip_tags(form_error('judul_berita')); ?></span>
                        </div>
                        <div class="form-group">
                            <label>Isi Berita</label>
                            <textarea name="isi_berita" class="form-control" id="customeditor"><?php echo set_value('isi_berita'); ?></textarea>
                            <span class="badge badge-danger"><?php echo strip_tags(form_error('isi_berita')); ?></span>
                        </div>
                        <div class="form-group">
                            <label>Gambar Berita</label>
                            <input type="file" onchange="readURL(this);" name="gambar_berita" class="form-control">
                            <br>
                            <img class="form" id="blah" style="max-width:180px;">
                            <span class="badge badge-danger"><?php echo strip_tags(form_error('gambar_berita')); ?></span>
                        </div>
                        <div class="form-group">
                            <label>Nama Pengirim</label>
                            <input type="text" name="nama_pengirim" value="<?php echo  $nama_user['username']; ?>" readonly class="form-control">
                            <span class="badge badge-danger"><?php echo strip_tags(form_error('username')); ?></span>
                        </div>
                        <!-- <div class="form-group">
                            <label>Jumlah Barang</label><br>
                            <input type="number" name="jumlah_barang" placeholder="Masukkan Jumlah Barang" class="form-control">
                        </div> -->
                        <div class="float-right">
                            <a href="<?php echo base_url("admin/berita") ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="reset" class="btn btn-danger"><i class="fa fa-times"></i>&nbsp;&nbsp;Batal</button>

                    </form>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

<?php
}
//==================================== Berita Edit ====================================
else if ($page == 'beritaEdit') {
?>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-3">
            <h1 class="h3 mb-0 text-gray-800">Edit Berita</h1>
        </div>
        <?php echo $this->session->flashdata('error'); ?>

        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header"><strong>Isi Form Dibawah Ini!</strong></div>
                <div class="card-body">
                    <form enctype="multipart/form-data" action="<?php echo base_url('admin/beritaEdit/' . $b['id_berita']); ?>" method="post">
                        <div class="form-group">
                            <label>Judul Berita</label>
                            <input type="text" name="judul_berita" placeholder="Masukkan Judul Berita" value="<?php echo set_value('judul_berita', $b['judul_berita']); ?>" class="form-control">
                            <span class="badge badge-danger"><?php echo strip_tags(form_error('judul_berita')); ?></span>
                        </div>
                        <div class="form-group">
                            <label>Isi Berita</label>
                            <textarea name="isi_berita" class="form-control" id="customeditor"><?php echo set_value('isi_berita', $b['isi_berita']); ?></textarea>
                            <span class="badge badge-danger"><?php echo strip_tags(form_error('isi_berita')); ?></span>
                        </div>
                        <div class="form-group">
                            <label>Gambar Berita</label>
                            <input type="file" value="<?php echo set_value('gambar_berita', $b['gambar_berita']); ?>" onchange="readURL(this);" name="gambar_berita" class="form-control">
                            <br>
                            <img class="form" src="<?php echo base_url('uploads/gambarBerita/' . $b['gambar_berita']); ?>" id="blah" style="max-width:180px;">
                            <span class="badge badge-danger"><?php echo strip_tags(form_error('gambar_berita')); ?></span>
                        </div>
                        <div class="form-group">
                            <label>Nama Pengirim</label>
                            <input type="text" name="nama_pengirim" value="<?php echo  $nama_user['username']; ?>" readonly class="form-control">
                            <span class="badge badge-danger"><?php echo strip_tags(form_error('username')); ?></span>
                        </div>
                        <!-- <div class="form-group">
                            <label>Jumlah Barang</label><br>
                            <input type="number" name="jumlah_barang" placeholder="Masukkan Jumlah Barang" class="form-control">
                        </div> -->
                        <div class="float-right">
                            <a href="<?php echo base_url("admin/berita") ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="reset" class="btn btn-danger"><i class="fa fa-times"></i>&nbsp;&nbsp;Batal</button>

                    </form>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->


<?php
}

//==================================== User ====================================
else if ($page == 'user') {
?>
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">User</h1>
        <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
        For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->
        <?php echo $this->session->flashdata('pesan'); ?>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data User</h6>
            </div>


            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Password</th>
                                <th>Aksi</th>
                            </tr>

                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($user as $u) { ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $u['username'] ?></td>
                                    <td><?php echo $u['email'] ?></td>
                                    <td><?php echo $u['password'] ?></td>
                                    <td>
                                        <a href=<?php echo base_url("admin/userEdit/") . $u['username']; ?>><span class="badge badge-success">Edit</span></a> |
                                        <a href=<?php echo base_url("admin/userHapus/") . $u['username']; ?> onclick="return confirm('Yakin menghapus User : <?php echo $u['username']; ?> ?');" ;><span class="badge badge-danger">Hapus</span></a>

                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->
<?php
}

//==================================== User Edit ====================================
else if ($page == 'userEdit') {
?>

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-3">
            <h1 class="h3 mb-0 text-gray-800">Edit User</h1>
        </div>
        <?php echo $this->session->flashdata('pesan'); ?>

        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header"><strong>Isi Form Dibawah Ini!</strong></div>
                <div class="card-body">
                    <form enctype="multipart/form-data" action="<?php echo base_url('admin/userEdit/' . $u['username']); ?>" method="post">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" placeholder="Masukkan Username..." value="<?php echo set_value('username', $u['username']); ?>" class="form-control">
                            <span class="badge badge-danger"><?php echo strip_tags(form_error('username')); ?></span>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="email" placeholder="Masukkan Email..." value="<?php echo set_value('email', $u['email']); ?>" class="form-control">
                            <span class="badge badge-danger"><?php echo strip_tags(form_error('email')); ?></span>
                        </div>

                        <!-- <div class="form-group">
                            <label>Jumlah Barang</label><br>
                            <input type="number" name="jumlah_barang" placeholder="Masukkan Jumlah Barang" class="form-control">
                        </div> -->
                        <div class="float-right">
                            <a href="<?php echo base_url("admin/user") ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="reset" class="btn btn-danger"><i class="fa fa-times"></i>&nbsp;&nbsp;Batal</button>

                    </form>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->


<?php
}

//==================================== ProfileToko ====================================
else if ($page == 'profilToko') {
?>

    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-3">
            <h1 class="h3 mb-0 text-gray-800">Profil Toko</h1>
        </div>
        <?php echo $this->session->flashdata('pesan'); ?>
        <div class="row h3">
            <?php foreach ($toko as $t) { ?>
                <div class="col-10">
                </div>
                <div class="col-2">
                    <a href="<?php echo base_url("admin/profilTokoEdit/") . $t['id_toko']; ?>">
                        <i class="far fa-edit"></i>
                    </a>
                </div>
                <div class="col-5 mb-3">
                    Nama
                </div>
                <div class="col-7 d-flex">
                    <div class="pr-2">:</div>
                    <div id="store_name"><?php echo $t['nm_toko'] ?></div>
                </div>
                <div class="col-5 mb-3">
                    Nomor Telepon
                </div>
                <div class="col-7 d-flex">
                    <div class="pr-2">:</div>
                    <div id="no_telp"><?php echo $t['no_telp'] ?></div>
                </div>
                <div class="col-5 mb-3">
                    Alamat
                </div>
                <div class="col-7 d-flex">
                    <div class="pr-2">:</div>
                    <div id="alamat"><?php echo $t['alamat'] ?></div>
                </div>
                <div class="col-5 mb-3">
                    X
                </div>
                <div class="col-7 d-flex">
                    <div class="pr-2">:</div>
                    <div id="store_description"><?php echo $t['longitude'] ?></div>
                </div>

                <div class="col-5 mb-3">
                    Y
                </div>
                <div class="col-7 d-flex">
                    <div class="pr-2">:</div>
                    <div id="store_description"><?php echo $t['latitude'] ?></div>
                </div>

        </div>
    <?php }; ?>
    </div>


    </div>


<?php
}

//==================================== ProfileToko ====================================
else if ($page == 'profilTokoEdit') {
?>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-3">
            <h1 class="h3 mb-0 text-gray-800">Edit Profil Toko</h1>
        </div>
        <?php echo $this->session->flashdata('error'); ?>

        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header"><strong>Isi Form Dibawah Ini!</strong></div>
                <div class="card-body">
                    <form enctype="multipart/form-data" action="<?php echo base_url('admin/profilTokoEdit/' . $t['id_toko']); ?>" method="post">
                        <div class="form-group">
                            <label>Nama Toko</label>
                            <input type="text" name="nm_toko" placeholder="Masukkan Nama Toko..." value="<?php echo set_value('nm_toko', $t['nm_toko']); ?>" class="form-control">
                            <span class="badge badge-danger"><?php echo strip_tags(form_error('nm_toko')); ?></span>
                        </div>
                        <div class="form-group">
                            <label>Nomor Telepon</label>
                            <input type="text" name="no_telp" placeholder="Masukkan Nomor Telepon..." value="<?php echo set_value('no_telp', $t['no_telp']); ?>" class="form-control">
                            <span class="badge badge-danger"><?php echo strip_tags(form_error('no_telp')); ?></span>
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <input type="text" name="alamat" placeholder="Masukkan Alamat..." value="<?php echo set_value('alamat', $t['alamat']); ?>" class="form-control">
                            <span class="badge badge-danger"><?php echo strip_tags(form_error('alamat')); ?></span>
                        </div>
                        <div class="form-group">
                            <label>Lintang / Y</label>
                            <input type="text" name="latitude" placeholder="Masukkan Y pada Maps..." value="<?php echo set_value('latitude', $t['latitude']); ?>" class="form-control">
                            <span class="badge badge-danger"><?php echo strip_tags(form_error('latitude')); ?></span>
                        </div>
                        <div class="form-group">
                            <label>Bujur / X</label>
                            <input type="text" name="longitude" placeholder="Masukkan X dari Maps..." value="<?php echo set_value('longitude', $t['longitude']); ?>" class="form-control">
                            <span class="badge badge-danger"><?php echo strip_tags(form_error('longitude')); ?></span>
                        </div>

                        <!-- <div class="form-group">
                            <label>Jumlah Barang</label><br>
                            <input type="number" name="jumlah_barang" placeholder="Masukkan Jumlah Barang" class="form-control">
                        </div> -->
                        <div class="float-right">
                            <a href="<?php echo base_url("admin/profilToko") ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="reset" class="btn btn-danger"><i class="fa fa-times"></i>&nbsp;&nbsp;Batal</button>

                    </form>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

<?php
}

//==================================== configEmail ====================================
else if ($page == 'configEmail') {
?>
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-4 text-gray-800">Config Email</h1>
        </div>
        <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Config Email</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Email</th>
                                <th>Password</th>
                                <th><i class="fa fa-gear"></i></th>

                            </tr>

                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($config as $c) { ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $c['email'] ?></td>
                                    <td><?php echo $c['pass'] ?></td>


                                    <td>
                                        <a href=<?php echo base_url("admin/configEmailEdit/") . $c['id_config']; ?>><span class="badge badge-success">Edit</span></a>

                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>


                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->
    <!-- Button trigger modal -->

    <!-- Modal -->
    <div class="modal fade" id="modalConfig" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Perhatian !!!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Jika Ingin Mengganti Email, Harap Masukkan Password Berdasarkan APP Password Dari Gmail
                    Caranya :
                    <ol>
                        <li>Masuk Ke Kelola Akun Google</li>
                        <li>Buka Keamanan</li>
                        <li>Buka Verifikasi 2 Langkah</li>
                        <li>Buka Sandi aplikasi</li>
                        <li>Masukkan Aplikasi (Lainnya), Isi Apa Saja</li>
                        <li>Lalu Copy Sandi Aplikasinya</li>
                    </ol>
                    (Usahakan Sandi Aplikasi-Nya Jangan Hilang),
                    Jika Masih Belum Bisa Klik <a target="_blank" href="https://www.youtube.com/results?search_query=app+password+google+new">Cara Mengambil APP Password Gmail</a>
                </div>

            </div>
        </div>
    </div>
<?php
}

//==================================== configEmailEdit ====================================
else if ($page == 'configEmailEdit') {
?>

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-3">
            <h1 class="h3 mb-0 text-gray-800">Edit Config Email</h1>
        </div>
        <?php echo $this->session->flashdata('error'); ?>

        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header"><strong>Isi Form Dibawah Ini!</strong></div>
                <div class="card-body">
                    <form enctype="multipart/form-data" action="<?php echo base_url('admin/configEmailEdit/' . $c['id_config']); ?>" method="post">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="email" placeholder="Masukkan Email..." value="<?php echo set_value('email', $c['email']); ?>" class="form-control">
                            <span class="badge badge-danger"><?php echo strip_tags(form_error('email')); ?></span>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="text" name="pass" placeholder="Masukkan Password (Berdasarkan APP Password Gmail)..." value="<?php echo set_value('pass', $c['pass']); ?>" class="form-control">
                            <span class="badge badge-danger"><?php echo strip_tags(form_error('pass')); ?></span>
                        </div>

                        <!-- <div class="form-group">
                            <label>Jumlah Barang</label><br>
                            <input type="number" name="jumlah_barang" placeholder="Masukkan Jumlah Barang" class="form-control">
                        </div> -->
                        <div class="float-right">
                            <a href="<?php echo base_url("admin/configEmail") ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="reset" class="btn btn-danger"><i class="fa fa-times"></i>&nbsp;&nbsp;Batal</button>

                    </form>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

<?php
}

//==================================== Supplier ====================================
else if ($page == 'supplier') {
?>
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-4 text-gray-800">Supplier</h1>
            <a href="<?php echo base_url("admin/supplierTambah") ?>" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-plus"></i> Tambah Supplier</a>
        </div>
        <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->
        <?php echo $this->session->flashdata('pesan'); ?>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Supplier</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Supplier</th>
                                <th>Nomor Telepon</th>
                                <th>Alamat</th>
                                <th>Aksi</th>
                            </tr>

                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($supplier as $s) { ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $s['nm_supplier'] ?></td> <!--<span class="badge badge-primary"></span>-->
                                    <td><?php echo $s['no_telp'] ?></td>
                                    <td><?php echo $s['alamat'] ?></td>

                                    <td>
                                        <a href=<?php echo base_url("admin/supplierEdit/") . $s['id_supplier']; ?>><span class="badge badge-success">Edit</span></a> |
                                        <a href=<?php echo base_url("admin/supplierHapus/") . $s['id_supplier']; ?> onclick="return confirm('Yakin menghapus Supplier : <?php echo $s['nm_supplier']; ?> ?');" ;><span class="badge badge-danger">Hapus</span></a>

                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>


                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->


<?php
}

//==================================== supplier Tambah ====================================
else if ($page == 'supplierTambah') {
?>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-3">
            <h1 class="h3 mb-0 text-gray-800">Tambah Supplier</h1>
        </div>

        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header"><strong>Isi Form Dibawah Ini!</strong></div>
                <div class="card-body">
                    <form method="POST" action="<?php echo base_url("admin/supplierTambah"); ?>">
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama Supplier</label>
                                    <input type="text" name="nm_supplier" placeholder="Masukkan Nama Supplier..." value="<?= set_value('nm_supplier') ?>" class="form-control">
                                    <span class="badge badge-danger"><?php echo strip_tags(form_error('nm_supplier')); ?></span>
                                </div>
                                <div class="form-group">
                                    <label>Nomor Telepon</label>
                                    <input type="text" name="no_telp" placeholder="Masukkan Nomor Telepon..." value="<?= set_value('no_telp') ?>" class="form-control">
                                    <span class="badge badge-danger"><?php echo strip_tags(form_error('no_telp')); ?></span>
                                </div>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <input type="text" name="alamat" placeholder="Masukkan Alamat..." value="<?= set_value('alamat') ?>" class="form-control">
                                    <span class="badge badge-danger"><?php echo strip_tags(form_error('alamat')); ?></span>
                                </div>

                            </div>
                        </div>
                        <div class="float-right">
                            <a href="<?php echo base_url("admin/supplier") ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="reset" class="btn btn-danger"><i class="fa fa-times"></i>&nbsp;&nbsp;Batal</button>
                    </form>
                </div>
            </div>
        </div>


    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

<?php
}

//==================================== Supplier Edit ====================================
else if ($page == 'supplierEdit') {
?>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-3">
            <h1 class="h3 mb-0 text-gray-800">Edit Supplier</h1>
        </div>

        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header"><strong>Isi Form Dibawah Ini!</strong></div>
                <div class="card-body">
                    <form method="POST" action="<?php echo base_url("admin/supplierEdit/" . $s['id_supplier']) ?>">
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama Supplier</label>
                                    <input type="text" name="nm_supplier" placeholder="Masukkan Kategori Barang..." value="<?php echo set_value('nm_supplier', $s['nm_supplier']); ?>" class="form-control">
                                    <span class="badge badge-danger"><?php echo strip_tags(form_error('nm_supplier')); ?></span>
                                </div>
                                <div class="form-group">
                                    <label>Nomor Telepon</label>
                                    <input type="text" name="no_telp" placeholder="Masukkan Kategori Barang..." value="<?php echo set_value('no_telp', $s['no_telp']); ?>" class="form-control">
                                    <span class="badge badge-danger"><?php echo strip_tags(form_error('no_telp')); ?></span>
                                </div>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <input type="text" name="alamat" placeholder="Masukkan Kategori Barang..." value="<?php echo set_value('alamat', $s['alamat']); ?>" class="form-control">
                                    <span class="badge badge-danger"><?php echo strip_tags(form_error('alamat')); ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="float-right">
                            <a href="<?php echo base_url("admin/supplier") ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="reset" class="btn btn-danger"><i class="fa fa-times"></i>&nbsp;&nbsp;Batal</button>
                    </form>
                </div>
            </div>
        </div>


    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->


<?php
}

//==================================== Suply Barang ====================================
else if ($page == 'suplyBarang') {
?>
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-4 text-gray-800">Supplier</h1>
            <a href="<?php echo base_url("admin/suplyBarangTambah") ?>" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-plus"></i> Tambah Supplier</a>
        </div>

        <?php echo $this->session->flashdata('pesan'); ?>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Barang Supplier</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Barang</th>
                                <th>Nama Supplier</th>
                                <th>Qty</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($barang_supplier as $bs) { ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $bs['nm_barang']; ?></td>
                                    <td><?php echo $bs['nm_supplier']; ?></td>
                                    <td><?php echo $bs['qty']; ?></td>
                                    <td>
                                        <a href="<?php echo base_url("admin/supplierEdit/") . $bs['id_barang_supplier']; ?>"><span class="badge badge-success">Edit</span></a> |
                                        <a href="<?php echo base_url("admin/supplierHapus/") . $bs['id_barang_supplier']; ?>" onclick="return confirm('Yakin menghapus data barang supplier?');"><span class="badge badge-danger">Hapus</span></a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->


    </div>
    <!-- End of Main Content -->


<?php
}

//==================================== Suply Barang ====================================
else if ($page == 'suplyBarangTambah') {
?>
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Tambah Suplai Barang</h1>

        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header"><strong>Tambah Suplai Barang</strong></div>
                <div class="card-body">
                    <form action="<?php echo base_url('admin/prosesTambahSuplai'); ?>" method="POST">
                        <div class="form-group">
                            <label for="id_supplier">Nama Supplier</label>
                            <select class="form-control" id="id_supplier" name="id_supplier">
                                <?php foreach ($supplier as $s) { ?>
                                    <option value="<?php echo $s['id_supplier']; ?>"><?php echo $s['nm_supplier']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="qty">Nama Barang</label>
                            <input type="text" class="form-control" id="nm_barang" name="nm_barang" min="1" required>
                        </div>
                        <div class="form-group">
                            <label for="qty">Harga Jual</label>
                            <input type="number" class="form-control" id="hrg_jual" name="hrg_jual" min="1" required>
                        </div>
                        <div class="form-group">
                            <label for="qty">Harga Beli</label>
                            <input type="number" class="form-control" id="hrg_beli" name="hrg_beli" min="1" required>
                        </div>
                        <div class="form-group">
                            <label for="qty">Qty</label>
                            <input type="number" class="form-control" id="qty" name="qty" min="1" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Tambah Barang</button>
                    </form>
                </div>
            </div>
        </div>


    </div>
    <!-- /.container-fluid -->



    </div>
    <!-- End of Main Content -->

<?php
}


?>