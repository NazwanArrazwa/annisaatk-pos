<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url('admin') ?>">
    <div class="sidebar-brand-icon rotate-n-15">
      <i class="fa-solid fa-cart-shopping"></i>
    </div>
    <div class="sidebar-brand-text mx-3">AnnisaATK</div>
  </a>

  <?php
  $menu_master0 = array('dashboard');
  $menu_master1 = array('kasir');
  $menu_master2 = array('penjualanBarang', 'laporanPendapatan');
  $menu_master3 = array('riwayatTransaksi', 'transaksiDetail');
  $menu_master4 = array('barang', 'barangTambah', 'barangEdit', 'kategoriBarang', 'satuanBarang', 'kategoriTambah', 'kategoriEdit', 'satuanTambah', 'satuanEdit', 'tampilBarcode');
  $menu_master5 = array('pelanggan', 'pelangganTambah', 'pelangganEdit');
  $menu_master6 = array('berita', 'beritaTambah', 'beritaEdit');
  $menu_master7 = array('user', 'userEdit');
  $menu_master8 = array('profilToko', 'profilTokoTambah', 'profilTokoEdit');
  $menu_master9 = array('configEmail', 'configEmailEdit');
  $menu_master10 = array('supplier', 'supplierTambah', 'supplierEdit');
  $menu_master11 = array('suplyBarang');
  ?>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    Dashboard
  </div>

  <!-- Nav Item - Dashboard -->
  <li class="nav-item <?php if (in_array($page, $menu_master0)) echo "active"; ?>">
    <a class="nav-link" href="<?php echo base_url('admin') ?>">
      <i class="fas fa-fw fa-home"></i>
      <span>Dashboard</span>
    </a>
  </li>

  <?php if ($data_user['id_level'] == 1 || $data_user['id_level'] == 3) : ?>
    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
      Menu
    </div>

    <!-- Nav Item - Kasir -->
    <li class="nav-item <?php if (in_array($page, $menu_master1)) echo "active"; ?>">
      <a class="nav-link" href="<?php echo base_url('admin/kasir') ?>">
        <i class="fas fa-fw fa-cash-register"></i>
        <span>Kasir</span>
      </a>
    </li>


  <?php endif; ?>

  <?php if ($data_user['id_level'] == 1) : ?>
    <!-- Nav Item - Laporan Penjualan -->
    <li class="nav-item <?php if (in_array($page, $menu_master2)) echo "active"; ?>">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseReport" aria-expanded="true" aria-controls="collapseReport">
        <i class="fas fa-clipboard"></i>
        <span>Laporan Penjualan</span>
      </a>
      <div id="collapseReport" class="collapse" aria-labelledby="headingReport" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item" href="<?= site_url() ?>admin/penjualanBarang"><i class="fa fa-clipboard"></i> Penjualan Barang</a>
          <a class="collapse-item" href="<?= site_url() ?>admin/laporanKeuangan"><i class="fa fa-table"></i> Laporan Pendapatan</a>
        </div>
      </div>
    </li>

    <!-- Nav Item - Riwayat Transaksi -->
    <li class="nav-item <?php if (in_array($page, $menu_master3)) echo "active"; ?>">
      <a class="nav-link" href="<?php echo base_url('admin/riwayatTransaksi') ?>">
        <i class="fas fa-fw fa-calendar"></i>
        <span>Riwayat Transaksi</span>
      </a>
    </li>

  <?php endif; ?>



  <?php if ($data_user['id_level'] == 1) : ?>
    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
      Menu
    </div>

    <!-- Nav Item - Barang -->
    <li class="nav-item <?php if (in_array($page, $menu_master4)) echo "active"; ?>">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProduct" aria-expanded="true" aria-controls="collapseProduct">
        <i class="fas fa-box"></i>
        <span>Barang</span>
      </a>
      <div id="collapseProduct" class="collapse" aria-labelledby="headingProduct" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item" href="<?= site_url() ?>admin/barang"><i class="fa fa-box"></i> Barang</a>
          <a class="collapse-item" href="<?= site_url() ?>admin/kategoriBarang"><i class="fa fa-list"></i> Kategori</a>
          <a class="collapse-item" href="<?= site_url() ?>admin/satuanBarang"><i class="fa fa-list"></i> Satuan</a>
        </div>
      </div>
    </li>

    <!-- Nav Item - Pelanggan -->
    <li class="nav-item <?php if (in_array($page, $menu_master5)) echo "active"; ?>">
      <a class="nav-link" href="<?php echo base_url('admin/pelanggan') ?>">
        <i class="fas fa-fw fa-id-card"></i>
        <span>Pelanggan</span>
      </a>
    </li>
  <?php endif; ?>

  <?php if ($data_user['id_level'] == 1 || $data_user['id_level'] == 2) : ?>
    <!-- Nav Item - Berita -->
    <li class="nav-item <?php if (in_array($page, $menu_master6)) echo "active"; ?>">
      <a class="nav-link" href="<?php echo base_url('admin/berita') ?>">
        <i class="fas fa-fw fa-newspaper"></i>
        <span>Berita</span>
      </a>
    </li>

  <?php endif; ?>

  <?php if ($data_user['id_level'] == 1) : ?>
    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
      Settings
    </div>

    <!-- Nav Item - User -->
    <li class="nav-item <?php if (in_array($page, $menu_master7)) echo "active"; ?>">
      <a class="nav-link" href="<?php echo base_url('admin/user') ?>">
        <i class="fas fa-fw fa-user"></i>
        <span>User</span>
      </a>
    </li>

    <!-- Nav Item - Profil Toko -->
    <li class="nav-item <?php if (in_array($page, $menu_master8)) echo "active"; ?>">
      <a class="nav-link" href="<?php echo base_url('admin/profilToko') ?>">
        <i class="fas fa-fw fa-shop"></i>
        <span>Profil Toko</span>
      </a>
    </li>

    <!-- Nav Item - Config Email -->
    <li class="nav-item <?php if (in_array($page, $menu_master9)) echo "active"; ?>">
      <a class="nav-link" href="<?php echo base_url('admin/configEmail') ?>">
        <i class="fas fa-fw fa-gear"></i>
        <span>Config Email</span>
      </a>
    </li>

  <?php endif; ?>

  <?php if ($data_user['id_level'] == 1) : ?>
    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
      Menu
    </div>

    <!-- Nav Item - Supplier -->
    <li class="nav-item <?php if (in_array($page, $menu_master10)) echo "active"; ?>">
      <a class="nav-link" href="<?php echo base_url('admin/supplier') ?>">
        <i class="fas fa-fw fa-truck-field"></i>
        <span>Supplier</span>
      </a>
    </li>

    <!-- Nav Item - Suply Barang -->
    <!--<li class="nav-item <?php if (in_array($page, $menu_master11)) echo "active"; ?>">-->
    <!--  <a class="nav-link" href="<?php echo base_url('admin/suplyBarang') ?>">-->
    <!--    <i class="fa-solid fa-truck-ramp-box"></i>-->
    <!--    <span>Suply Barang</span>-->
    <!--  </a>-->
    <!--</li>-->
  <?php endif; ?>

  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>
<!-- End of Sidebar -->