-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 12, 2023 at 01:44 PM
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
(6, 'Mengantongi Laba pada Alat Tulis Kantor', '<p>Alat tulis kantor (ATK) merupakan perlengkapan yang sangat dibutuhkan demi berlangsungnya operasional kantor. Selain instansi pemerintah, kantor-kantor swasta dan sekolah juga sangat membutuhkan ATK. Di tengah tingginya kebutuhan itu, prospek bisnis ATK sangat menjanjikan. Tak heran, kini toko ATK gampang sekali dijumpai di berbagai lokasi.<br />\r\n<br />\r\nMeski sudah dikerumuni banyak pemain, toh toko ATK tetap ramai dikunjungi pembeli. Itulah yang mendorong toko Annisa ATK Banjarmasin berani menawarkan kemitraan toko ATK.</p>\r\n', 'berita_6_112252.jpg', 'admin', '2023-07-18 03:22:52');

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
(1, '', 'Umum', '', NULL, 0, '2023-06-07 13:59:07');

-- --------------------------------------------------------

--
-- Table structure for table `tb_satuan`
--

CREATE TABLE `tb_satuan` (
  `id_satuan` int(11) NOT NULL,
  `nm_satuan` char(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(1, '0001-02082023', 1, '2023-08-02 22:30:59', '20000', '17400', '1', 1, '0'),
(2, '0002-02082023', 1, '2023-08-02 22:31:29', '20000', '17400', '1', 1, '0'),
(3, '0003-02082023', 1, '2023-08-02 22:32:30', '20000', '17400', '1', 1, '0'),
(4, '0004-02082023', 1, '2023-08-02 22:32:59', '20000', '17400', '1', 1, '0'),
(5, '0005-02082023', 1, '2023-08-02 22:35:32', '20000', '17400', '1', 1, '0'),
(6, '0006-02082023', 1, '2023-08-02 22:39:29', '20000', '17400', '1', 1, '0'),
(7, '0007-02082023', 1, '2023-08-02 22:41:06', '20000', '20000', '1', 1, '0'),
(8, '0008-02082023', 1, '2023-08-02 22:41:26', '22222', '17400', '1', 1, '0'),
(9, '0009-02082023', 1, '2023-08-02 22:42:00', '20000', '20000', '2', 1, '0'),
(10, '0010-02082023', 1, '2023-08-02 22:53:46', '22222', '17400', '1', 1, '0'),
(11, '0011-02082023', 1, '2023-08-02 22:54:31', '20000', '17400', '1', 1, '0'),
(12, '0012-02082023', 1, '2023-08-02 22:55:21', '105000', '104800', '5', 1, '0'),
(13, '0013-02082023', 1, '2023-08-02 23:00:04', '20000', '17400', '1', 1, '0'),
(14, '0001-03082023', 1, '2023-08-03 23:02:10', '300000', '252200', '5', 1, '0'),
(15, '0001-05082023', 1, '2023-08-05 09:51:18', '3000000', '3000000', '100', 1, '0'),
(16, '0002-05082023', 1, '2023-08-05 10:24:05', '3000000', '2934800', '31', 1, '0');

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
(1, 1, 1, '1', '17400', '998'),
(2, 2, 1, '1', '17400', '997'),
(3, 3, 1, '1', '17400', '996'),
(4, 4, 1, '1', '17400', '995'),
(5, 5, 1, '1', '17400', '994'),
(6, 6, 1, '1', '17400', '993'),
(7, 7, 4, '1', '20000', '99'),
(8, 8, 1, '1', '17400', '992'),
(9, 9, 3, '2', '10000', '40'),
(10, 10, 1, '1', '17400', '991'),
(11, 11, 1, '1', '17400', '990'),
(12, 12, 1, '2', '17400', '988'),
(13, 12, 2, '1', '40000', '996'),
(14, 12, 3, '1', '10000', '39'),
(15, 12, 4, '1', '20000', '98'),
(16, 13, 1, '1', '17400', '987'),
(17, 14, 1, '3', '17400', '984'),
(18, 14, 5, '2', '100000', '98'),
(19, 15, 7, '100', '30000', '1900'),
(20, 16, 1, '2', '17400', '982'),
(21, 16, 5, '29', '100000', '69');

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
  ADD UNIQUE KEY `barcode` (`barcode`),
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
  MODIFY `id_barang` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_berita`
--
ALTER TABLE `tb_berita`
  MODIFY `id_berita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_satuan`
--
ALTER TABLE `tb_satuan`
  MODIFY `id_satuan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_supplier`
--
ALTER TABLE `tb_supplier`
  MODIFY `id_supplier` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_toko`
--
ALTER TABLE `tb_toko`
  MODIFY `id_toko` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tb_transaksi_detail`
--
ALTER TABLE `tb_transaksi_detail`
  MODIFY `id_transaksi_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

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
