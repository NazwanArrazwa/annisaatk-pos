<?php
//==================================== HOME ====================================
if ($page == 'home') {

?>
    <!-- ***** Main Banner Area Start ***** -->
    <!-- PRE LOADER -->
    <section class="preloader">
        <div class="spinner">

            <span class="spinner-rotate"></span>

        </div>
    </section>
    <div class="swiper-container" id="top">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <div class="slide-inner" style="background-image:url(assets/images/home-page-1.png)">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="header-text">

                                    <h2>Temukan <em>Alat Tulis</em> yang Tepat untuk Setiap <em>Kebutuhan!</em></h2>
                                    <div class="div-dec"></div>
                                    <p></p>
                                    <div class="buttons">
                                        <div class="green-button scroll-to-section">
                                            <a href="#berita">Discover More</a>
                                        </div>
                                        <div class="orange-button">
                                            <a href="#">Contact Us</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="slide-inner" style="background-image:url(assets/images/home-page-2.png)">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="header-text">
                                    <h2> Memberikan <em>Layanan Terbaik </em>Dan<em> Produk Terpercaya </em> untuk Anda!</h2>
                                    <div class="div-dec"></div>
                                    <p></p>
                                    <div class="buttons">
                                        <div class="green-button scroll-to-section">
                                            <a href="#berita">Discover More</a>
                                        </div>
                                        <div class="orange-button">
                                            <a href="#">Contact Us</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="slide-inner" style="background-image:url(assets/images/home-page-3.png)">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="header-text">
                                    <h2>Menghadirkan <em>Solusi Alat Tulis</em> yang Membuat <em>Hidup Lebih Berwarna!</em></h2>
                                    <div class="div-dec"></div>
                                    <p></p>
                                    <div class="buttons">
                                        <div class="green-button scroll-to-section">
                                            <a href="#berita">Discover More</a>
                                        </div>
                                        <div class="orange-button">
                                            <a href="#">Contact Us</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

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
                        <?php
                        $counter = 0;
                        foreach ($berita as $b) :
                            if ($counter >= 3) {
                                break; // Menghentikan iterasi setelah mencapai batas 4
                            }
                        ?>
                    </div>

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

                                <p class="isiBerita"><?= $isiBerita; ?>
                                </p>

                            </div>


                        </div>

                    <?php
                            $counter++;
                        endforeach ?>
                    </div>

                </div>

            </div>

        </div>
    </section>

    <section class="top-section" id="tentangKami">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="left-image">
                        <img src="assets/images/about-left-image.jpg" alt="">
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

    <section class="map section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div id="map">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2791.78997548554!2d144.9805125252687!3d-37.84132841005892!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad6681f3e9cb7e1%3A0x9d52778f56cab5a8!2sFawkner%20Park!5e1!3m2!1sen!2sth!4v1648201596364!5m2!1sen!2sth" width="100%" height="450px" frameborder="0" style="border:0; border-radius: 5px; position: relative; z-index: 2;" allowfullscreen=""></iframe>
                    </div>
                </div>
                <div class="col-lg-10 offset-lg-1 mb-5">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="info-item">
                                <i class="fa fa-envelope"></i>
                                <h4>Email Address</h4>
                                <a href="#">info@company.com</a>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="info-item">
                                <i class="fa fa-phone"></i>
                                <h4>Phone Number</h4>
                                <a href="#">010-020-0340</a>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="info-item">
                                <i class="fa fa-map-marked-alt"></i>
                                <h4>Address</h4>
                                <a href="#">Victoria, Australia</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


<?php
}


?>