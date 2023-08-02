-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 02, 2023 at 11:32 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `annisaatk`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_barang`
--

CREATE TABLE `tb_barang` (
  `id_barang` int(100) NOT NULL,
  `barcode` char(128) NOT NULL,
  `nm_barang` char(50) NOT NULL,
  `qty` int(50) NOT NULL,
  `hrg_jual` char(50) NOT NULL,
  `hrg_beli` char(50) NOT NULL,
  `promo` int(11) NOT NULL,
  `id_supplier` int(50) DEFAULT NULL,
  `id_kategori` int(11) NOT NULL,
  `id_satuan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_barang`
--

INSERT INTO `tb_barang` (`id_barang`, `barcode`, `nm_barang`, `qty`, `hrg_jual`, `hrg_beli`, `promo`, `id_supplier`, `id_kategori`, `id_satuan`) VALUES
(1, '03', 'Rak Sepatu', 0, '20000', '10000', 13, 2, 1, 1),
(2, '099320180921', 'Kotak Pensil', 999, '40000', '20000', 0, 1, 1, 1),
(3, '055', 'USB', 44, '10000', '9000', 0, 2, 1, 1),
(4, '0823017', 'Surya 12', 100, '20000', '12000', 0, 1, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_berita`
--

CREATE TABLE `tb_berita` (
  `id_berita` int(11) NOT NULL,
  `judul_berita` char(100) NOT NULL,
  `isi_berita` text NOT NULL,
  `gambar_berita` char(100) NOT NULL,
  `nama_pengirim` char(100) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_berita`
--

INSERT INTO `tb_berita` (`id_berita`, `judul_berita`, `isi_berita`, `gambar_berita`, `nama_pengirim`, `tanggal`) VALUES
(1, 'Toko ATK Modern \"AnnisaATK\"', '<p>Dunia perbelanjaan ATK (Alat Tulis Kantor) semakin menggeliat dengan hadirnya toko ATK modern terbaru, &quot;AnnisaATK&quot;, yang memberikan pengalaman belanja yang inovatif dan inspiratif bagi para pelanggan.&nbsp;</p>\r\n', 'berita_1_220053.jpg', 'admin', '2023-07-10 14:00:53'),
(2, 'Grand Opening toko Annisa ATK di Banjarmasin', '<p>Nantikan GrandOpening dengan nama toko Annisa ATK Banjarmasin dan di toko tersebut nantinya akan menjual beberapa Alat Tulis Kantor (ATK) dengan harga yang terjangkau, Toko ATK ini berada di Komplek Grand Mahantas, Blok F, No.71, Kelurahan Pemurus Dalam, Banjarmasin Selatan.</p>\r\n\r\n<p>Annisa ATK Banjarmasin&nbsp; adalah solusi untuk memberi kemudahan bagi masyarakat dalam memenuhi hasrat konsumtifnya, terutama yang membutuhkan penunjang ATK dan kebutuhan dibidang pendidikan.</p>\r\n', 'berita_2_165328.png', 'admin', '2023-07-11 08:53:28'),
(6, 'Mengantongi Laba pada Alat Tulis Kantor', '<p>Alat tulis kantor (ATK) merupakan perlengkapan yang sangat dibutuhkan demi berlangsungnya operasional kantor. Selain instansi pemerintah, kantor-kantor swasta dan sekolah juga sangat membutuhkan ATK. Di tengah tingginya kebutuhan itu, prospek bisnis ATK sangat menjanjikan. Tak heran, kini toko ATK gampang sekali dijumpai di berbagai lokasi.<br />\r\n<br />\r\nMeski sudah dikerumuni banyak pemain, toh toko ATK tetap ramai dikunjungi pembeli. Itulah yang mendorong toko Annisa ATK Banjarmasin berani menawarkan kemitraan toko ATK.</p>\r\n', 'berita_6_112252.jpg', 'admin', '2023-07-18 03:22:52'),
(10, 'fhaoifhwaofigaofgiawogif', '<p>afhwaugwaoufaoufgawo</p>\r\n', 'berita_101690789170.jpg', 'admin', '2023-07-31 07:39:30'),
(11, 'Perpustakaan Poliban', 'Ini adalah deskripsi Perpustakaan poliban', 'berita_111690858158.jpg', 'admin', '2023-08-01 02:49:18');

-- --------------------------------------------------------

--
-- Table structure for table `tb_config`
--

CREATE TABLE `tb_config` (
  `id_config` int(11) NOT NULL,
  `email` char(100) NOT NULL,
  `pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_config`
--

INSERT INTO `tb_config` (`id_config`, `email`, `pass`) VALUES
(1, 'annisaatkbjm@gmail.com', 'gcdcatghpqedjboz');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategori`
--

CREATE TABLE `tb_kategori` (
  `id_kategori` int(11) NOT NULL,
  `nm_kategori` char(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_kategori`
--

INSERT INTO `tb_kategori` (`id_kategori`, `nm_kategori`) VALUES
(1, 'Alat Tulis'),
(2, 'Makanan'),
(4, 'Alat Makan');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pelanggan`
--

CREATE TABLE `tb_pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `email` char(100) NOT NULL,
  `nm_pelanggan` char(100) NOT NULL,
  `no_telp` char(100) NOT NULL,
  `alamat` char(100) DEFAULT NULL,
  `diskon` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_pelanggan`
--

INSERT INTO `tb_pelanggan` (`id_pelanggan`, `email`, `nm_pelanggan`, `no_telp`, `alamat`, `diskon`, `date_created`) VALUES
(1, '', 'Umum', '', NULL, 0, '2023-06-07 13:59:07'),
(2, 'fiensanz12345@gmail.com', 'Nazwan', '123', 'Jalan Karang Anyar, Gang Selamat, Malintang, Kec gambut, Banjar, Kalimantan Selatan', 1, '2023-06-07 05:54:49'),
(5, 'nzunfair1@gmail.com', 'Adelia Comel', '089691825337', 'Jl PurnaSakti No 7', 1, '2023-07-08 01:26:35');

-- --------------------------------------------------------

--
-- Table structure for table `tb_satuan`
--

CREATE TABLE `tb_satuan` (
  `id_satuan` int(11) NOT NULL,
  `nm_satuan` char(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_satuan`
--

INSERT INTO `tb_satuan` (`id_satuan`, `nm_satuan`) VALUES
(1, 'Pcs'),
(2, 'Bh');

-- --------------------------------------------------------

--
-- Table structure for table `tb_supplier`
--

CREATE TABLE `tb_supplier` (
  `id_supplier` int(11) NOT NULL,
  `nm_supplier` char(100) NOT NULL,
  `no_telp` char(100) NOT NULL,
  `alamat` char(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_supplier`
--

INSERT INTO `tb_supplier` (`id_supplier`, `nm_supplier`, `no_telp`, `alamat`) VALUES
(1, 'Junet', '089692815667', 'Jl Kenangan 12'),
(2, 'Habibie', '0877777771', 'Jl PurnaSakti No 7');

-- --------------------------------------------------------

--
-- Table structure for table `tb_toko`
--

CREATE TABLE `tb_toko` (
  `id_toko` int(11) NOT NULL,
  `nm_toko` char(50) NOT NULL,
  `no_telp` char(50) NOT NULL,
  `alamat` char(50) NOT NULL,
  `email` char(50) NOT NULL,
  `longitude` char(100) NOT NULL,
  `latitude` char(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_toko`
--

INSERT INTO `tb_toko` (`id_toko`, `nm_toko`, `no_telp`, `alamat`, `email`, `longitude`, `latitude`) VALUES
(1, 'Annisa ATK', '085752687248', 'Banjarmasin, Kalimantan Selatan', 'annisaatkbjm@gmail.com', '114.6125535495408', '-3.358965654981691');

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `kode_transaksi` char(225) DEFAULT NULL,
  `kasir` int(11) DEFAULT NULL,
  `waktu` datetime NOT NULL,
  `jumlah_bayar` char(100) NOT NULL,
  `total_hrg` char(100) NOT NULL,
  `total_brg` char(100) NOT NULL,
  `id_pelanggan` int(11) DEFAULT NULL,
  `diskon` char(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`id_transaksi`, `kode_transaksi`, `kasir`, `waktu`, `jumlah_bayar`, `total_hrg`, `total_brg`, `id_pelanggan`, `diskon`) VALUES
(1, '0001-11072023', 1, '2023-07-11 16:26:46', '15000', '15000', '2', 1, '0'),
(2, '0001-24072023', 1, '2023-07-24 15:28:04', '50000', '48000', '4', 1, '0'),
(3, '0002-24072023', 1, '2023-07-24 15:28:54', '10000', '9000', '3', 1, '0'),
(4, '0003-24072023', 1, '2023-07-24 20:33:49', '50000', '46000', '4', 1, '0'),
(5, '0001-25072023', 1, '2023-07-25 10:03:42', '100000', '6000', '2', 1, '0'),
(6, '0001-26072023', 1, '2023-07-26 13:57:32', '40000', '40000', '2', 1, '0'),
(7, '0002-26072023', 1, '2023-07-26 13:58:19', '20000', '20000', '1', 1, '0'),
(8, '0001-02082023', 1, '2023-08-02 14:16:41', '40000', '40000', '1', 1, '0'),
(9, '0002-02082023', 1, '2023-08-02 14:18:12', '80000', '80000', '2', 1, '0'),
(10, '0003-02082023', 1, '2023-08-02 14:20:53', '40000', '40000', '1', 1, '0'),
(11, '0003-02082023', 1, '2023-08-02 14:21:38', '40000', '40000', '1', 1, '0'),
(12, '0004-02082023', 1, '2023-08-02 17:29:20', '300000', '40000', '1', 1, '0');

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi_detail`
--

CREATE TABLE `tb_transaksi_detail` (
  `id_transaksi_detail` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `jumlah_jual` char(100) NOT NULL,
  `hrg_jual` char(100) NOT NULL,
  `last_qty` char(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_transaksi_detail`
--

INSERT INTO `tb_transaksi_detail` (`id_transaksi_detail`, `id_transaksi`, `id_barang`, `jumlah_jual`, `hrg_jual`, `last_qty`) VALUES
(1, 1, 1, '1', '3000', '994'),
(2, 1, 2, '1', '12000', '189'),
(3, 2, 6, '3', '15000', '983'),
(4, 2, 1, '1', '3000', '993'),
(5, 3, 1, '3', '3000', '990'),
(6, 4, 1, '2', '3000', '1011'),
(7, 4, 4, '2', '20000', '1014'),
(8, 5, 1, '2', '3000', '1009'),
(9, 6, 1, '2', '20000', '998'),
(10, 7, 1, '1', '20000', '997'),
(11, 8, 2, '1', '40000', '1004'),
(12, 9, 2, '2', '40000', '1002'),
(13, 10, 2, '1', '40000', '1001'),
(14, 11, 2, '1', '40000', '1000'),
(15, 12, 2, '1', '40000', '999');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `username` char(50) NOT NULL,
  `email` char(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_level` tinyint(11) NOT NULL,
  `token` char(128) NOT NULL,
  `token_expiry` char(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`username`, `email`, `password`, `id_level`, `token`, `token_expiry`) VALUES
('admin', 'fiensanz12345@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 1, '', ''),
('berita', 'nzunfair@gmail.com', '0a3b36b190030c92ed9ed66d89a8d917', 2, '', ''),
('kasir', 'nzunfair1@gmail.com', 'c7911af3adbd12a035b289556d96470a', 3, '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD KEY `id_supplier` (`id_supplier`),
  ADD KEY `id_kategori` (`id_kategori`),
  ADD KEY `id_satuan` (`id_satuan`);

--
-- Indexes for table `tb_berita`
--
ALTER TABLE `tb_berita`
  ADD PRIMARY KEY (`id_berita`),
  ADD KEY `nama_pengirim` (`nama_pengirim`);

--
-- Indexes for table `tb_config`
--
ALTER TABLE `tb_config`
  ADD PRIMARY KEY (`id_config`);

--
-- Indexes for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `tb_satuan`
--
ALTER TABLE `tb_satuan`
  ADD PRIMARY KEY (`id_satuan`);

--
-- Indexes for table `tb_supplier`
--
ALTER TABLE `tb_supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indexes for table `tb_toko`
--
ALTER TABLE `tb_toko`
  ADD PRIMARY KEY (`id_toko`);

--
-- Indexes for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_pelanggan` (`id_pelanggan`),
  ADD KEY `id_user` (`kasir`);

--
-- Indexes for table `tb_transaksi_detail`
--
ALTER TABLE `tb_transaksi_detail`
  ADD PRIMARY KEY (`id_transaksi_detail`),
  ADD KEY `id_transaksi` (`id_transaksi`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_barang`
--
ALTER TABLE `tb_barang`
  MODIFY `id_barang` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_berita`
--
ALTER TABLE `tb_berita`
  MODIFY `id_berita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_satuan`
--
ALTER TABLE `tb_satuan`
  MODIFY `id_satuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_supplier`
--
ALTER TABLE `tb_supplier`
  MODIFY `id_supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_toko`
--
ALTER TABLE `tb_toko`
  MODIFY `id_toko` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tb_transaksi_detail`
--
ALTER TABLE `tb_transaksi_detail`
  MODIFY `id_transaksi_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD CONSTRAINT `tb_barang_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `tb_kategori` (`id_kategori`),
  ADD CONSTRAINT `tb_barang_ibfk_2` FOREIGN KEY (`id_satuan`) REFERENCES `tb_satuan` (`id_satuan`),
  ADD CONSTRAINT `tb_barang_ibfk_3` FOREIGN KEY (`id_supplier`) REFERENCES `tb_supplier` (`id_supplier`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
