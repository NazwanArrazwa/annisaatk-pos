<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <title><?= $title; ?></title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url('assets/'); ?>bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Memuat library Leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

    <!-- Additional CSS Files -->
    <link rel="icon" href="<?php echo base_url('assets/'); ?>images/annisaatk-logo.png" type="image/ico">
    <link href="<?php echo base_url('assets/'); ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url('assets/'); ?>css/style.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/'); ?>css/owl.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/'); ?>css/animate.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css ">
    <!--

TemplateMo 574 Mexant

https://templatemo.com/tm-574-mexant

-->
</head>

<body>


    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">

                        <!-- ***** Logo Start ***** -->
                        <a href="<?= base_url('/') ?>" class="logo">
                            <img src="<?= base_url('assets/') ?>images/annisaatk-header.png" alt="">
                        </a>
                        <!-- <a href="" class="logo">
                            <h1>Annisa ATK</h1>
                        </a> -->
                        <!-- ***** Logo End ***** -->

                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li class="scroll-to-section"><a href="#top" class="active">Home</a></li>
                            <li class="scroll-to-section"><a href="#berita">Berita</a></li>
                            <li class="scroll-to-section"><a href="#tentangKami">Tentang Kami</a></li>
                            <li class="scroll-to-section"><a href="#hubungikami">Hubungi Kami</a></li>

                            <div class="search-input">
                                <form id="search" method="post" action="<?= base_url('landing/semuaBerita'); ?>">
                                    <input type="text" placeholder="Cari Berita..." name="keyword" autocomplete="off" />

                                    <i class="fa fa-fw fa-search"></i>
                                </form>
                            </div>

                        </ul>




                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>

                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>

    </header>