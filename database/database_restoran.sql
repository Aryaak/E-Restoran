-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Mar 2020 pada 12.55
-- Versi server: 10.1.38-MariaDB
-- Versi PHP: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `database_restoran`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tabel_kategori`
--

CREATE TABLE `tabel_kategori` (
  `id_kategori` int(11) NOT NULL,
  `kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tabel_kategori`
--

INSERT INTO `tabel_kategori` (`id_kategori`, `kategori`) VALUES
(1, 'Minuman'),
(3, 'Mainan'),
(8, 'Makanan'),
(15, 'Buah-buahan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tabel_menu`
--

CREATE TABLE `tabel_menu` (
  `id_menu` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `menu` varchar(100) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `harga` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tabel_menu`
--

INSERT INTO `tabel_menu` (`id_menu`, `id_kategori`, `menu`, `gambar`, `harga`) VALUES
(14, 1, 'Es Teh', 'teh.jpg', 3000),
(15, 1, 'Pop Ice', 'pop.jpg', 2500),
(16, 8, 'Nasi Goreng', 'nasgor.jpg', 10000),
(17, 8, 'Soto', 'soto.jpg', 6000),
(19, 15, 'Apel', 'apel.jpg', 2000),
(20, 15, 'Jeruk', 'jeruk.jpg', 2000),
(21, 8, 'Ayam Kecap', 'ayamkecap.jpg', 6000),
(22, 8, 'Mie Rebus', 'mierebus.jpg', 5000),
(23, 8, 'Rawon', 'rawon.jpg', 8000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tabel_order`
--

CREATE TABLE `tabel_order` (
  `id_order` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `tanggal_order` date NOT NULL,
  `total` float NOT NULL DEFAULT '0',
  `bayar` float NOT NULL DEFAULT '0',
  `kembali` float NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tabel_order`
--

INSERT INTO `tabel_order` (`id_order`, `id_pelanggan`, `tanggal_order`, `total`, `bayar`, `kembali`, `status`) VALUES
(1, 7, '2020-03-16', 7500, 8000, 500, 1),
(2, 7, '2020-03-16', 4000, 5000, 1000, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tabel_order_detail`
--

CREATE TABLE `tabel_order_detail` (
  `id_order_detail` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `menu` varchar(100) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga_jual` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tabel_order_detail`
--

INSERT INTO `tabel_order_detail` (`id_order_detail`, `id_order`, `id_menu`, `menu`, `jumlah`, `harga_jual`) VALUES
(136, 1, 15, 'Pop Ice', 1, 2500),
(137, 1, 22, 'Mie Rebus', 1, 5000),
(138, 2, 20, 'Jeruk', 1, 2000),
(139, 2, 19, 'Apel', 1, 2000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tabel_pelanggan`
--

CREATE TABLE `tabel_pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `pelanggan` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `telepon` int(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `aktif` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tabel_pelanggan`
--

INSERT INTO `tabel_pelanggan` (`id_pelanggan`, `pelanggan`, `alamat`, `telepon`, `email`, `password`, `aktif`) VALUES
(5, 'Rahmat', 'Surabaya', 8888, 'rahmat778@gmail.com', '$2y$10$re3d.rgIcj1U0ZKW9zYz6Oq9NawEEd/TTrrxYzcB9.QH1sSZ4Iij2', 1),
(6, 'Arya', 'Gresik', 394343, 'arya548@gmail.com', '$2y$10$mSKW0b.ru27dMDYu8pTXie0OamonD7g0616OIsBjD4HFdqQqFOCV6', 1),
(7, 'Wahyu', 'Sidoarjo', 343843, 'wahyu038@gmail.com', '$2y$10$gSmMN3Z39Rdy//3rwZaK1OwWccuHzH1K3LA4l7l54cvZmisBQ1qHa', 1),
(8, 'ayra222', 'ayra222', 82031231, 'ayra222@gmail.com', '$2y$10$nuulNl3YeZLx5KxTVF7CLOok0O2NuypkEGsXnVxGF0t1rwSovdeAe', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tabel_user`
--

CREATE TABLE `tabel_user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` varchar(100) NOT NULL,
  `aktif` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tabel_user`
--

INSERT INTO `tabel_user` (`id_user`, `nama`, `email`, `password`, `level`, `aktif`) VALUES
(12, 'aryarizky', 'aryarizky@gmail.com', '$2y$10$hSdrr4bFwYLWbTP/3Od1b.snNbugqSHluErRefUq9uhvfwN8UhoOW', 'admin', 1),
(13, 'wahyu', 'wahyu@gmail.com', '$2y$10$tK6FOtAcO/x.E3bm702.WuKyTZwz9P/vcvJEc1/wU6I5OoHfTTsHu', 'koki', 1),
(14, 'dimas', 'dimas@gmail.com', '$2y$10$TlN3tuTRjnGpKKYFrStCDOsPu1RFP3DjxLg0HsmT.Na0f8TD/bYC.', 'kasir', 1),
(15, 'Bayu', 'bayu@gmail.com', '$2y$10$LMACo03GLyo9DVVeE9Hb8.oGHrxriI.6v.hBYeEjmKD8gYMLu1kW2', 'kasir', 1);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `view_order`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `view_order` (
`id_order` int(11)
,`id_pelanggan` int(11)
,`tanggal_order` date
,`total` float
,`bayar` float
,`kembali` float
,`status` int(11)
,`pelanggan` varchar(100)
,`alamat` varchar(100)
,`telepon` int(100)
,`email` varchar(100)
,`password` varchar(100)
,`aktif` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `view_order_detail`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `view_order_detail` (
`id_order_detail` int(11)
,`id_order` int(11)
,`id_menu` int(11)
,`jumlah` int(11)
,`harga_jual` float
,`id_kategori` int(11)
,`menu` varchar(100)
,`gambar` varchar(100)
,`harga` float
,`kategori` varchar(100)
,`id_pelanggan` int(11)
,`tanggal_order` date
,`total` float
,`bayar` float
,`kembali` float
,`status` int(11)
,`pelanggan` varchar(100)
,`alamat` varchar(100)
,`telepon` int(100)
,`email` varchar(100)
,`password` varchar(100)
,`aktif` int(11)
);

-- --------------------------------------------------------

--
-- Struktur untuk view `view_order`
--
DROP TABLE IF EXISTS `view_order`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_order`  AS  select `tabel_order`.`id_order` AS `id_order`,`tabel_order`.`id_pelanggan` AS `id_pelanggan`,`tabel_order`.`tanggal_order` AS `tanggal_order`,`tabel_order`.`total` AS `total`,`tabel_order`.`bayar` AS `bayar`,`tabel_order`.`kembali` AS `kembali`,`tabel_order`.`status` AS `status`,`tabel_pelanggan`.`pelanggan` AS `pelanggan`,`tabel_pelanggan`.`alamat` AS `alamat`,`tabel_pelanggan`.`telepon` AS `telepon`,`tabel_pelanggan`.`email` AS `email`,`tabel_pelanggan`.`password` AS `password`,`tabel_pelanggan`.`aktif` AS `aktif` from (`tabel_pelanggan` join `tabel_order` on((`tabel_pelanggan`.`id_pelanggan` = `tabel_order`.`id_pelanggan`))) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `view_order_detail`
--
DROP TABLE IF EXISTS `view_order_detail`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_order_detail`  AS  select `tabel_order_detail`.`id_order_detail` AS `id_order_detail`,`tabel_order_detail`.`id_order` AS `id_order`,`tabel_order_detail`.`id_menu` AS `id_menu`,`tabel_order_detail`.`jumlah` AS `jumlah`,`tabel_order_detail`.`harga_jual` AS `harga_jual`,`tabel_menu`.`id_kategori` AS `id_kategori`,`tabel_menu`.`menu` AS `menu`,`tabel_menu`.`gambar` AS `gambar`,`tabel_menu`.`harga` AS `harga`,`tabel_kategori`.`kategori` AS `kategori`,`tabel_order`.`id_pelanggan` AS `id_pelanggan`,`tabel_order`.`tanggal_order` AS `tanggal_order`,`tabel_order`.`total` AS `total`,`tabel_order`.`bayar` AS `bayar`,`tabel_order`.`kembali` AS `kembali`,`tabel_order`.`status` AS `status`,`tabel_pelanggan`.`pelanggan` AS `pelanggan`,`tabel_pelanggan`.`alamat` AS `alamat`,`tabel_pelanggan`.`telepon` AS `telepon`,`tabel_pelanggan`.`email` AS `email`,`tabel_pelanggan`.`password` AS `password`,`tabel_pelanggan`.`aktif` AS `aktif` from ((((`tabel_order_detail` join `tabel_order` on((`tabel_order_detail`.`id_order` = `tabel_order`.`id_order`))) join `tabel_pelanggan` on((`tabel_order`.`id_pelanggan` = `tabel_pelanggan`.`id_pelanggan`))) join `tabel_menu` on((`tabel_order_detail`.`id_menu` = `tabel_menu`.`id_menu`))) join `tabel_kategori` on((`tabel_menu`.`id_kategori` = `tabel_kategori`.`id_kategori`))) ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tabel_kategori`
--
ALTER TABLE `tabel_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `tabel_menu`
--
ALTER TABLE `tabel_menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indeks untuk tabel `tabel_order`
--
ALTER TABLE `tabel_order`
  ADD PRIMARY KEY (`id_order`);

--
-- Indeks untuk tabel `tabel_order_detail`
--
ALTER TABLE `tabel_order_detail`
  ADD PRIMARY KEY (`id_order_detail`);

--
-- Indeks untuk tabel `tabel_pelanggan`
--
ALTER TABLE `tabel_pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indeks untuk tabel `tabel_user`
--
ALTER TABLE `tabel_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tabel_kategori`
--
ALTER TABLE `tabel_kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `tabel_menu`
--
ALTER TABLE `tabel_menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `tabel_order_detail`
--
ALTER TABLE `tabel_order_detail`
  MODIFY `id_order_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;

--
-- AUTO_INCREMENT untuk tabel `tabel_pelanggan`
--
ALTER TABLE `tabel_pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tabel_user`
--
ALTER TABLE `tabel_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
