-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 27, 2023 at 04:47 PM
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
  `id_barang` int(11) NOT NULL,
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
(1, '01', 'pensil', 27, '3000', '1000', 30, NULL, 1, 1),
(2, '02', 'Kotak Pensil', 1093, '12000', '10000', 0, NULL, 1, 1),
(3, '03', 'tipex', 308, '12800', '10000', 10, NULL, 1, 1);

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
(1, 'Toko ATK Modern \"AnnisaATK\"', '<p>Dunia perbelanjaan ATK (Alat Tulis Kantor) semakin menggeliat dengan hadirnya toko ATK modern terbaru, &quot;AnnisaATK&quot;, yang memberikan pengalaman belanja yang inovatif dan inspiratif bagi para pelanggan.&nbsp;</p>\r\n', 'berita_1.jpg', 'admin', '2023-06-13 06:44:55'),
(2, 'Grand Opening toko Annisa ATK di Banjarmasin', '<p>Banjarmasin,2023- Telah hadir toko Alat Tulis Kantor dengan nama Annisa ATK yang berada dijalan kelayan b dan disana akan ada promo setiap pembelanjaan nya.</p>\r\n', 'berita_2.png', 'admin', '2023-06-13 06:49:48');

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
(1, 'Alat Tulis');

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
(2, 'fiensanz12345@gmail.com', 'Nazwan', '123', 'Jalan Karang Anyar, Gang Selamat, Malintang, Kec gambut, Banjar, Kalimantan Selatan', 1, '2023-06-07 05:54:49');

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
(1, 'Pcs');

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
  `instagram` char(50) NOT NULL,
  `facebook` char(50) NOT NULL,
  `x` char(100) NOT NULL,
  `y` char(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_toko`
--

INSERT INTO `tb_toko` (`id_toko`, `nm_toko`, `no_telp`, `alamat`, `instagram`, `facebook`, `x`, `y`) VALUES
(1, 'Annisa ATK', '089691825337', 'Jalan Kelayan B No 10', '@Annisaatkbjm', 'Annisa_ATK_BJM', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `kode_transaksi` char(225) DEFAULT NULL,
  `kasir` int(11) DEFAULT NULL,
  `waktu` datetime NOT NULL,
  `harga` char(100) NOT NULL,
  `total_brg` char(100) NOT NULL,
  `last_qty` char(100) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`id_transaksi`, `kode_transaksi`, `kasir`, `waktu`, `harga`, `total_brg`, `last_qty`, `id_pelanggan`, `id_barang`) VALUES
(1, '0001-25062023', 1, '2023-06-25 04:49:09', '12000', '10', '1097', 1, 2),
(2, '0002-25062023', 1, '2023-06-25 05:47:22', '12000', '2', '1095', 1, 2),
(3, '0002-25062023', 1, '2023-06-25 05:47:22', '11520', '1', '310', 1, 3),
(4, '0002-25062023', 1, '2023-06-25 05:47:22', '2100', '1', '27', 1, 1),
(5, '0001-26062023', 1, '2023-06-26 03:14:16', '12000', '2', '1093', 1, 2),
(6, '0001-26062023', 1, '2023-06-26 03:14:16', '11520', '2', '308', 1, 3);

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
  ADD KEY `id_barang` (`id_barang`),
  ADD KEY `id_pelanggan` (`id_pelanggan`),
  ADD KEY `id_user` (`kasir`);

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
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_berita`
--
ALTER TABLE `tb_berita`
  MODIFY `id_berita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_satuan`
--
ALTER TABLE `tb_satuan`
  MODIFY `id_satuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
