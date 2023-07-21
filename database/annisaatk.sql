-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 10, 2023 at 02:06 PM
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
-- Table structure for table `tb_bank`
--

CREATE TABLE `tb_bank` (
  `id_rek` int(11) NOT NULL,
  `nm_bank` char(100) NOT NULL,
  `rekening` char(100) NOT NULL,
  `nm_pemilik_rek` char(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(1, '01', 'pensil', 995, '3000', '1000', 0, NULL, 1, 1),
(2, '02', 'Kotak Pensil', 190, '12000', '10000', 0, NULL, 1, 1),
(3, '03', 'tipex', 282, '12800', '10000', 10, NULL, 1, 1),
(4, '8996001321522', 'Permen Kiss', 993, '20000', '10000', 0, NULL, 1, 1),
(5, '05', 'Kipas Angin', 234, '500000', '100000', 0, NULL, 1, 1),
(6, '061', 'Permen Mentos', 986, '15000', '10000', 0, NULL, 1, 1),
(7, '8996001321511', 'Lampu Neon', 996, '3000', '1000', 0, NULL, 1, 1);

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
(1, 'Toko ATK Modern \"AnnisaATK\"', '<p>Dunia perbelanjaan ATK (Alat Tulis Kantor) semakin menggeliat dengan hadirnya toko ATK modern terbaru, &quot;AnnisaATK&quot;, yang memberikan pengalaman belanja yang inovatif dan inspiratif bagi para pelanggan.&nbsp;</p>\r\n', 'berita_1.jpg', 'admin', '2023-06-12 22:44:55'),
(2, 'Grand Opening toko Annisa ATK di Banjarmasin', '<p>Nantikan GrandOpening dengan nama toko Annisa ATK Banjarmasin dan di toko tersebut nantinya akan menjual beberapa Alat Tulis Kantor (ATK) dengan harga yang terjangkau, Toko ATK ini berada di Komplek Grand Mahantas, Blok F, No.71, Kelurahan Pemurus Dalam, Banjarmasin Selatan.</p>\r\n\r\n<p>Annisa ATK Banjarmasin&nbsp; adalah solusi untuk memberi kemudahan bagi masyarakat dalam memenuhi hasrat konsumtifnya, terutama yang membutuhkan penunjang ATK dan kebutuhan dibidang pendidikan.</p>\r\n', 'berita_2_20230708.png', 'admin', '2023-07-08 00:26:09'),
(6, 'Mengantongi Laba pada Alat Tulis Kantor', '<p>Alat tulis kantor (ATK) merupakan perlengkapan yang sangat dibutuhkan demi berlangsungnya operasional kantor. Selain instansi pemerintah, kantor-kantor swasta dan sekolah juga sangat membutuhkan ATK. Di tengah tingginya kebutuhan itu, prospek bisnis ATK sangat menjanjikan. Tak heran, kini toko ATK gampang sekali dijumpai di berbagai lokasi.<br />\r\n<br />\r\nMeski sudah dikerumuni banyak pemain, toh toko ATK tetap ramai dikunjungi pembeli. Itulah yang mendorong toko Annisa ATK Banjarmasin berani menawarkan kemitraan toko ATK.</p>\r\n', 'berita_6.jpg', 'admin', '2023-07-08 01:58:36');

-- --------------------------------------------------------

--
-- Table structure for table `tb_config`
--

CREATE TABLE `tb_config` (
  `id_config` int(11) NOT NULL,
  `email` char(100) NOT NULL,
  `pass` char(255) NOT NULL
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
(1, 'Junet', '089692815667', 'Jl Kenangan 12');

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
  `instagram` char(50) NOT NULL,
  `facebook` char(50) NOT NULL,
  `longitude` char(100) NOT NULL,
  `latitude` char(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_toko`
--

INSERT INTO `tb_toko` (`id_toko`, `nm_toko`, `no_telp`, `alamat`, `email`, `instagram`, `facebook`, `longitude`, `latitude`) VALUES
(1, 'Annisa ATK', '085752687248', 'Banjarmasin, Kalimantan Selatan', 'annisaatkbjm@gmail.com', '@Annisaatkbjm', 'Annisa_ATK_BJM', '114.58205904593228', '-3.294986967885569');

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
(1, '0001-10072023', 1, '2023-07-10 19:38:09', '3000', '3000', '1', 2, '1'),
(2, '0002-10072023', 1, '2023-07-10 19:46:01', '3000', '3000', '1', 2, '1');

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi_detail`
--

CREATE TABLE `tb_transaksi_detail` (
  `id_transaksi_detail` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `jumlah_jual` char(100) NOT NULL,
  `hrg_jual` char(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_transaksi_detail`
--

INSERT INTO `tb_transaksi_detail` (`id_transaksi_detail`, `id_transaksi`, `id_barang`, `jumlah_jual`, `hrg_jual`) VALUES
(1, 1, 1, '1', '3000'),
(2, 2, 1, '1', '3000');

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
-- Indexes for table `tb_bank`
--
ALTER TABLE `tb_bank`
  ADD PRIMARY KEY (`id_rek`);

--
-- Indexes for table `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `tb_berita`
--
ALTER TABLE `tb_berita`
  ADD PRIMARY KEY (`id_berita`);

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
  ADD PRIMARY KEY (`id_transaksi_detail`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_bank`
--
ALTER TABLE `tb_bank`
  MODIFY `id_rek` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_barang`
--
ALTER TABLE `tb_barang`
  MODIFY `id_barang` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_berita`
--
ALTER TABLE `tb_berita`
  MODIFY `id_berita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
  MODIFY `id_supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_toko`
--
ALTER TABLE `tb_toko`
  MODIFY `id_toko` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_transaksi_detail`
--
ALTER TABLE `tb_transaksi_detail`
  MODIFY `id_transaksi_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
