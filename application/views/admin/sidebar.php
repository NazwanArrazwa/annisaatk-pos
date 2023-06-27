<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url('admin') ?>">
    <div class="sidebar-brand-icon rotate-n-15">
      <i class="fa-solid fa-cart-shopping"></i>
    </div>
    <div class="sidebar-brand-text mx-3">AnnisaATK</div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider">
  <!-- Heading -->
  <div class="sidebar-heading">
    Dashboard
  </div>
  <?php
  $menu_master0 = array('home');
  $menu_master1 = array('kasir');
  $menu_master2 = array('penjualanBarang', 'laporanKeuangan');
  $menu_master3 = array('riwayatTransaksi', 'transaksiDetail');
  $menu_master4 = array('barang', 'barangTambah', 'barangEdit', 'kategoriBarang', 'satuanBarang', 'kategoriTambah', 'kategoriEdit', 'satuanTambah', 'satuanEdit');
  $menu_master5 = array('pelanggan', 'pelangganTambah', 'pelangganEdit');
  $menu_master6 = array('berita', 'beritaTambah', 'beritaEdit');
  $menu_master7 = array('user');
  $menu_master8 = array('profilToko', 'profilTokoTambah', 'profilTokoEdit');
  $menu_master9 = array('configEmail', 'configEmailEdit');
  $menu_master10 = array('supplier');
  $menu_master11 = array('suplyBarang');
  ?>
  <!-- Nav Item - Dashboard -->
  <li class="nav-item <?php
                      if (in_array($page, $menu_master0))
                        echo "active";
                      ?>">

    <a class="nav-link" href="<?php echo base_url('admin') ?>">
      <i class="fas fa-fw fa-home"></i>
      <span>Dashboard</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    Menu
  </div>

  <!-- Nav Item - Tables -->
  <li class="nav-item <?php
                      if (in_array($page, $menu_master1))
                        echo "active";
                      ?>">
    <a class="nav-link" href="<?php echo base_url('admin/kasir') ?>">
      <i class="fas fa-fw fa-cash-register"></i>
      <span>Kasir</span></a>
  </li>
  <li class="nav-item <?php
                      if (in_array($page, $menu_master2))
                        echo "active";
                      ?>">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseReport" aria-expanded="true" aria-controls="collapseProduct">
      <i class="fas fa-clipboard"></i>
      <span>Laporan Penjualan</span>
    </a>
    <div id="collapseReport" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" id="product" href="<?= site_url() ?>admin/penjualanBarang"><i class="fas fas fa-clipboard"></i> Penjualan Barang</a>
        <a class="collapse-item" id="product_kind" href="<?= site_url() ?>admin/laporanKeuangan"><i class="fa-solid fa-table"></i></i> laporan Pendapatan</a>
      </div>
    </div>
  </li>
  </li>
  <li class="nav-item <?php
                      if (in_array($page, $menu_master3))
                        echo "active";
                      ?>">
    <a class=" nav-link" href="<?php echo base_url('admin/riwayatTransaksi') ?>">
      <i class="fas fa-fw fa-calendar"></i>
      <span>Riwayat Transaksi</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">
  <!-- Heading -->
  <div class="sidebar-heading">
    Menu
  </div>

  <li class="nav-item <?php
                      if (in_array($page, $menu_master4))
                        echo "active";
                      ?>">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProduct" aria-expanded="true" aria-controls="collapseProduct">
      <i class="fas fa-box"></i>
      <span>Barang</span>
    </a>
    <div id="collapseProduct" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" id="product" href="<?= site_url() ?>admin/barang"><i class="fas fas fa-box"></i> Barang</a>
        <a class="collapse-item" id="product_kind" href="<?= site_url() ?>admin/kategoriBarang"><i class="far fa-chart-bar"></i> Kategori</a>
        <a class="collapse-item" id="product_unit" href="<?= site_url() ?>admin/satuanBarang"><i class="far fa-chart-bar"></i> Satuan</a>
      </div>
    </div>
  </li>
  <li class="nav-item <?php
                      if (in_array($page, $menu_master5))
                        echo "active";
                      ?>">
    <a class="nav-link " href="<?php echo base_url('admin/pelanggan') ?>">
      <i class="fas fa-fw fa-id-card"></i>
      <span>Pelanggan</span></a>
  </li>
  <li class="nav-item <?php
                      if (in_array($page, $menu_master6))
                        echo "active";
                      ?>">
    <a class="nav-link" href="<?php echo base_url('admin/berita') ?>">
      <i class="fas fa-fw fa-newspaper"></i>
      <span>Berita</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    Settings
  </div>

  <li class="nav-item <?php
                      if (in_array($page, $menu_master7))
                        echo "active";
                      ?>">
    <a class=" nav-link" href="<?php echo base_url('admin/user') ?>">
      <i class="fas fa-fw fa-user"></i>
      <span>User</span></a>
  </li>
  <li class="nav-item <?php
                      if (in_array($page, $menu_master8))
                        echo "active";
                      ?>">
    <a class=" nav-link" href="<?php echo base_url('admin/profilToko') ?>">
      <i class="fas fa-fw fa-shop"></i>
      <span>Profil Toko</span></a>
  </li>
  <li class="nav-item <?php
                      if (in_array($page, $menu_master9))
                        echo "active";
                      ?>">
    <a class=" nav-link" href="<?php echo base_url('admin/configEmail') ?>">
      <i class="fas fa-fw fa-gear"></i>
      <span>Config Email</span></a>
  </li>
  <!-- Divider -->
  <hr class="sidebar-divider">
  <!-- Heading -->
  <div class="sidebar-heading">
    Menu
  </div>
  <li class="nav-item <?php
                      if (in_array($page, $menu_master10))
                        echo "active";
                      ?>">
    <a class=" nav-link" href="<?php echo base_url('admin/supplier') ?>">
      <i class="fas fa-fw fa-truck-field"></i>
      <span>Supplier</span></a>
  </li>
  <li class="nav-item <?php
                      if (in_array($page, $menu_master11))
                        echo "active";
                      ?>">
    <a class=" nav-link" href="<?php echo base_url('admin/suplyBarang') ?>">
      <i class="fa-solid fa-truck-ramp-box"></i>
      <span>Suply Barang</span></a>
  </li>
  <!-- Nav Item - Pages Collapse Menu
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-cog"></i>
          <span>Components</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Custom Components:</h6>
            <a class="collapse-item" href="buttons.html">Buttons</a>
            <a class="collapse-item" href="cards.html">Cards</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Utilities Collapse Menu
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-wrench"></i>
          <span>Utilities</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Custom Utilities:</h6>
            <a class="collapse-item" href="utilities-color.html">Colors</a>
            <a class="collapse-item" href="utilities-border.html">Borders</a>
            <a class="collapse-item" href="utilities-animation.html">Animations</a>
            <a class="collapse-item" href="utilities-other.html">Other</a>
          </div>
        </div>
      </li>

      <!-- Divider
      <hr class="sidebar-divider">

      <!-- Heading 
      <div class="sidebar-heading">
        Addons
      </div>

      <!-- Nav Item - Pages Collapse Menu 
      <li class="nav-item active">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
          <i class="fas fa-fw fa-folder"></i>
          <span>Pages</span>
        </a>
        <div id="collapsePages" class="collapse show" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Login Screens:</h6>
            <a class="collapse-item" href="login.html">Login</a>
            <a class="collapse-item" href="register.html">Register</a>
            <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
            <div class="collapse-divider"></div>
            <h6 class="collapse-header">Other Pages:</h6>
            <a class="collapse-item" href="404.html">404 Page</a>
            <a class="collapse-item active" href="blank.html">Blank Page</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Charts 
      <li class="nav-item">
        <a class="nav-link" href="charts.html">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Charts</span></a>
      </li> -->



  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>
<!-- End of Sidebar -->