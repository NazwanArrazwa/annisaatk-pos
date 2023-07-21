<?php
//==================================== HOME ====================================
if ($page == 'home') {

?>
    <!-- ***** Main Banner Area Start ***** -->
    <!-- PRE LOADER -->
    <section class="preloader">
        <div class="cart-loader">
            <div class="graph-loading">
                <span class="graph-loading__bar"></span>
                <span class="graph-loading__bar"></span>
                <span class="graph-loading__bar"></span>
                <span class="graph-loading__bar"></span>
                <span class="graph-loading__bar"></span>
            </div>
        </div>
        </div>
    </section>

    <section id="top">
        <div class="main-banner" id="top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="owl-carousel owl-banner">
                            <div class="item item-1">
                                <div class="header-text">
                                    <h2>Temukan <em>Alat Tulis</em> yang Tepat untuk Setiap <em>Kebutuhan!</em></h2>
                                    <!-- <p>Scholar is free CSS template designed by TemplateMo for online educational related websites. This layout is based on the famous Bootstrap v5.3.0 framework.</p> -->
                                    <div class="buttons">
                                        <div class="main-button scroll-to-section">
                                            <a href="#berita">Telusuri Lebih Lanjut</a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="item item-2">
                                <div class="header-text">

                                    <h2> Memberikan <em>Layanan Terbaik </em>Dan<em> Produk Terpercaya </em> untuk Anda!</h2>
                                    <!-- <p>You are allowed to use this template for any educational or commercial purpose. You are not allowed to re-distribute the template ZIP file on any other website.</p> -->
                                    <div class="buttons">
                                        <div class="main-button scroll-to-section">
                                            <a href="#berita">Telusuri Lebih Lanjut</a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="item item-3">
                                <div class="header-text">

                                    <h2>Menghadirkan <em>Solusi Alat Tulis</em> yang Membuat <em>Hidup Lebih Berwarna!</em></h2>
                                    <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod temporious incididunt ut labore et dolore magna aliqua suspendisse.</p> -->
                                    <div class="buttons">
                                        <div class="main-button scroll-to-section">
                                            <a href="#berita">Telusuri Lebih Lanjut</a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Main Banner Area End ***** -->

    <!-- Banner Ends Here -->
    <section class="berita-terbaru" id="berita">
        <div class="latest-products">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-heading">
                            <h2>Berita Terbaru</h2>
                            <a href="<?php echo base_url('landing/semuaBerita'); ?>">Lihat Semua Berita <i class="fa fa-angle-right"></i></a>
                        </div>
                    </div>

                    <?php
                    $counter = 0;
                    if (empty($berita)) {
                    ?>
                        <!-- Error Page -->
                        <div class="error">
                            <div class="container-floud">
                                <div class="col-xs-12 ground-color text-center">
                                    <div class="container-error-404">
                                        <div class="clip">
                                            <div class="shadow"><span class="digit thirdDigit"></span></div>
                                        </div>
                                        <div class="clip">
                                            <div class="shadow"><span class="digit secondDigit"></span></div>
                                        </div>
                                        <div class="clip">
                                            <div class="shadow"><span class="digit firstDigit"></span></div>
                                        </div>
                                        <div class="msg">OH!<span class="triangle"></span></div>
                                    </div>
                                    <h2 class="h1">Maaf! Berita Yang Anda Cari Tidak Ditemukan</h2>
                                </div>
                            </div>
                        </div>
                        <!-- Error Page -->
                        <?php
                    } else {
                        foreach ($berita as $b) :
                            if ($counter >= 3) {
                                break; // Menghentikan iterasi setelah mencapai batas 3
                            }
                        ?>
                            <div class="col-md-4">
                                <div class="product-item">
                                    <a href="<?php echo base_url('landing/berita/') . $b['id_berita']; ?>"><img class="gambarBeritaTerbaru" src="<?php echo base_url('uploads/gambarBerita/'); ?><?= $b['gambar_berita']; ?>"></a>
                                    <div class="down-content">
                                        <a href="<?php echo base_url('landing/berita/') . $b['id_berita']; ?>">
                                            <h4><?= $b['judul_berita']; ?></h4>
                                        </a>
                                        <?php
                                        $batasanKarakter = 100;
                                        $isiBerita =  $b['isi_berita'];
                                        if (strlen($isiBerita) > $batasanKarakter) {
                                            $isiBerita = substr($isiBerita, 0, $batasanKarakter) . '...';
                                        }
                                        ?>
                                        <p class="isiBerita"><?= $isiBerita; ?></p>
                                    </div>
                                </div>
                            </div>
                    <?php
                            $counter++;
                        endforeach;
                    }
                    ?>

                </div>
            </div>
        </div>
    </section>



    <section class="top-section" id="tentangKami">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="left-image">
                        <img src="<?php echo base_url('assets/') ?>images/content-img-2.jpg" alt="">
                    </div>
                </div>
                <div class="col-lg-6 align-self-center mb-5">
                    <div class="accordions is-first-expanded">
                        <article class="accordion">
                            <div class="accordion-head">
                                <span>Apa sih Toko AnnisaATK itu?</span>
                                <span class="icon">
                                    <i class="icon fa fa-chevron-right"></i>
                                </span>
                            </div>
                            <div class="accordion-body">
                                <div class="content">
                                    <p>Toko Annisa ATK Banjarmasin adalah jenis usaha yang bergerak di bidang penjualan alat tulis kantor (ATK) meliputi berbagai macam produk seperti pensil, pulpen, penghapus, kertas, map, dan banyak lagi. <br><br> Toko Annisa ATK Banjarmasin biasanya menyediakan berbagai jenis ATK untuk memenuhi kebutuhan perorangan, perkantoran, dan institusi lainnya.
                                    </p>
                                </div>
                            </div>
                        </article>
                        <article class="accordion">
                            <div class="accordion-head">
                                <span>Bagaimana kualitas produk yang dijual di toko AnnisaATK?</span>
                                <span class="icon">
                                    <i class="icon fa fa-chevron-right"></i>
                                </span>
                            </div>
                            <div class="accordion-body">
                                <div class="content">
                                    <p>Kualitas produk yang dijual di toko AnnisaATK sangat dijaga dan menjadi prioritas utama. Toko Annisa berkomitmen untuk menyediakan produk berkualitas tinggi kepada pelanggan.
                                    </p>
                                </div>
                            </div>
                        </article>
                        <article class="accordion">
                            <div class="accordion-head">
                                <span>Keuntungan Saat Berbelanja Di Toko AnnisaATK?</span>
                                <span class="icon">
                                    <i class="icon fa fa-chevron-right"></i>
                                </span>
                            </div>
                            <div class="accordion-body">
                                <div class="content">
                                    <p>Keuntungan berbelanja di toko Annisa ATK Banjarmasin yaitu pilihan Produk yang lengkap toko Annisa ATK ini biasanya menawarkan beragam produk seperti pensil, pulpen, penghapus, buku catatan, kertas, dan banyak lagi. <br><br> Anda dapat menemukan semua alat tulis yang Anda butuhkan dalam satu tempat, sehingga Anda tidak perlu berkunjung ke beberapa toko yang berbeda kemudian kualitas dan Keaslian Produk dari toko Annisa ATK Banjarmasin yang baik menyediakan produk-produk berkualitas</p>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
            </div>

    </section>

    <section class="map section" id="hubungikami">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div id="map">
                        <!-- <div style="width: 100%"><iframe width="100%" height="600" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q=politeknik%20negeri%20banjarmasin+(AnnisaATK%20Banjarmasin)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"><a href="https://www.maps.ie/distance-area-calculator.html">area maps</a></iframe></div> -->
                    </div>
                </div>
                <div class="col-lg-10 offset-lg-1 mb-5">
                    <div class="row">
                        <?php foreach ($toko as $t) : ?>
                            <div class="col-lg-4">
                                <div class="info-item">
                                    <i class="fa fa-envelope"></i>
                                    <h4>Email</h4>
                                    <a href="mailto:<?php echo $t->email; ?>"><?php echo $t->email; ?></a>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="info-item">
                                    <i class="fa fa-phone"></i>
                                    <h4>Phone Number</h4>
                                    <a href="#"><?php echo $t->no_telp; ?></a>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="info-item">
                                    <i class="fa fa-map-marked-alt"></i>
                                    <h4>Alamat</h4>
                                    <a href="#"><?php echo $t->alamat; ?></a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php
    //==================================== semua_berita ====================================
} else if ($page == 'berita_semua') {

?>
    <!-- PRE LOADER -->
    <section class="preloader">
        <div class="spinner">

            <span class="spinner-rotate"></span>

        </div>
    </section>
    <!-- Banner Ends Here -->
    <section class="berita-terbaru" id="berita">
        <div class="latest-products">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-heading">
                            <h2>Semua Berita</h2>
                        </div>
                        <?php if (empty($berita)) : ?>



                            <!-- Error Page -->
                            <div class="section">
                                <h1 class="error">404</h1>
                                <div class="page">Maaf! Berita Yang Kamu Cari Tidak Ditemukan</div>
                                <a class="back-home" href="<?php echo base_url('/') ?>">Kembali Ke Home</a>
                            </div>
                            <br><br><br><br><br><br><br><br><br><br><br>
                            <!-- Error Page -->


                        <?php endif; ?>
                        <?php

                        foreach ($berita as $b) :
                        ?>
                    </div>

                    <div class="col-md-6">
                        <div class="product-item">

                            <a href="<?php echo base_url('landing/berita/') . $b['id_berita']; ?>"><img class="gambarBerita" src="<?php echo base_url('uploads/gambarBerita/'); ?><?= $b['gambar_berita']; ?>" alt=""></a>
                            <div class="down-content">
                                <a href="<?php echo base_url('landing/berita/') . $b['id_berita']; ?>">
                                    <h4><?= $b['judul_berita']; ?></h4>
                                </a>
                                <?php
                                $batasanKarakter = 100;
                                $isiBerita =  $b['isi_berita'];
                                if (strlen($isiBerita) > $batasanKarakter) {
                                    $isiBerita = substr($isiBerita, 0, $batasanKarakter) . '...';
                                }
                                ?>

                                <p class="isiBerita"><?= $isiBerita; ?>
                                </p>

                            </div>


                        </div>

                    <?php endforeach ?>

                    </div>
                    <?= $this->pagination->create_links(); ?>
                </div>

            </div>



        </div>
    </section>

<?php
}

//==================================== beritaDetail ====================================
else if ($page == 'berita') {
?>

    <div class="page-heading">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="header-text">
                        <h2>Berita</h2>
                        <div class="div-dec"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="what-we-do">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="left-content">

                        <img src="<?php echo base_url('uploads/gambarBerita/'); ?><?= $b['gambar_berita']; ?>" alt="">
                        <h3><?php echo $b['judul_berita']; ?></h3>
                        <h4> <i>Penulis :</i> <?php echo $b['nama_pengirim']; ?></h4>
                        <div class="card-text">
                            <p>
                                <?php
                                // echo $b['isi_berita'];
                                $isi_berita = $b['isi_berita'];
                                $modified_isi_berita = str_replace('<p>', '<p class="isiDetailBerita">', $isi_berita);
                                echo $modified_isi_berita;
                                ?>
                            </p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner Ends Here -->
    <section class="berita-terbaru" id="berita">
        <div class="latest-products">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-heading">
                            <h2>Berita Lainnya</h2>
                            <a href="<?php echo base_url('landing/semuaBerita'); ?>">Lihat Semua Berita <i class="fa fa-angle-right"></i></a>
                            <?php foreach ($berita_lainnya as $berita) : ?>
                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="product-item">

                            <a href="<?php echo base_url('landing/berita/') . $berita['id_berita']; ?>"><img src="<?php echo base_url('uploads/gambarBerita/'); ?><?= $berita['gambar_berita']; ?>" alt=""></a>
                            <div class="down-content">
                                <a href="<?php echo base_url('landing/berita/') . $berita['id_berita']; ?>">
                                    <h4><?= $berita['judul_berita']; ?></h4>
                                </a>
                                <?php
                                $batasanKarakter = 100;
                                $isiBerita =  $berita['isi_berita'];
                                if (strlen($isiBerita) > $batasanKarakter) {
                                    $isiBerita = substr($isiBerita, 0, $batasanKarakter) . '...';
                                }
                                ?>

                                <p class="isiBerita"><?= $isiBerita; ?>
                                </p>

                            </div>
                        <?php endforeach; ?>

                        </div>


                    </div>

                </div>

            </div>

        </div>
    </section>

<?php
}

//==================================== hubungiKami ====================================
else if ($page == 'hubungiKami') {
?>
    <section class="preloader">
        <div class="spinner">

            <span class="spinner-rotate"></span>

        </div>
    </section>
    <div class="page-heading">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="header-text">
                        <h2>Hubungi Kami</h2>
                        <div class="div-dec"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>




<?php
}


?>