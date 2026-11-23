-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 23, 2026 at 03:39 PM
-- Server version: 8.4.3
-- PHP Version: 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_rumahhub`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id_user` int NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') DEFAULT 'user',
  `no_hp` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`id_user`, `nama_lengkap`, `email`, `username`, `password`, `role`, `no_hp`) VALUES
(1, 'Admin RumahHub', 'admin@rumahhub.id', 'admin_rh', 'admin123', 'admin', '081234567801'),
(2, 'Nadia Putri', 'nadia.putri@gmail.com', 'nadia_p', 'user123', 'user', '085712345602'),
(3, 'Rizky Pratama', 'rizky.pratama@gmail.com', 'rizky_p', 'user123', 'user', '082198765403');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pesanan`
--

CREATE TABLE `tb_pesanan` (
  `id_pesanan` int NOT NULL,
  `id_user` int NOT NULL,
  `id_properti` int NOT NULL,
  `tgl_pesan` date NOT NULL,
  `total_bayar` bigint NOT NULL,
  `bukti_bayar` varchar(100) DEFAULT NULL,
  `status_pesanan` enum('Menunggu Pembayaran','Menunggu Konfirmasi','Dikonfirmasi','Dibatalkan') DEFAULT 'Menunggu Pembayaran'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_pesanan`
--

INSERT INTO `tb_pesanan` (`id_pesanan`, `id_user`, `id_properti`, `tgl_pesan`, `total_bayar`, `bukti_bayar`, `status_pesanan`) VALUES
(1, 2, 1, '2026-11-23', 550000000, 'bukti_tf_nadia.jpg', 'Menunggu Konfirmasi'),
(2, 3, 2, '2026-11-22', 320000000, 'bukti_tf_rizky.jpg', 'Dikonfirmasi');

-- --------------------------------------------------------

--
-- Table structure for table `tb_properti`
--

CREATE TABLE `tb_properti` (
  `id_properti` int NOT NULL,
  `nama_properti` varchar(100) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `lokasi` text NOT NULL,
  `harga` bigint NOT NULL,
  `deskripsi` text,
  `foto` varchar(100) DEFAULT NULL,
  `status_unit` enum('Tersedia','Terjual','Disewa') DEFAULT 'Tersedia'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_properti`
--

INSERT INTO `tb_properti` (`id_properti`, `nama_properti`, `kategori`, `lokasi`, `harga`, `deskripsi`, `foto`, `status_unit`) VALUES
(1, 'Cluster Green Valley Tipe 45', 'Rumah', 'Jl. Soekarno Hatta No. 12, Malang', 550000000, 'Rumah 2 kamar tidur, 1 kamar mandi, carport, siap huni', 'rumah_minimalis.jpg', 'Tersedia'),
(2, 'Apartemen Soekarno Hatta Studio', 'Apartemen', 'Jl. Soekarno Hatta, Lowokwaru, Malang', 320000000, 'Apartemen modern lokasi strategis dekat area kampus', 'apartemen_modern.jpg', 'Tersedia'),
(3, 'Ruko Central Sawojajar', 'Ruko', 'Jl. Danau Toba, Sawojajar, Malang', 1250000000, 'Ruko komersial 2 lantai di jalur ramai', 'ruko_komersial.jpg', 'Terjual');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `tb_pesanan`
--
ALTER TABLE `tb_pesanan`
  ADD PRIMARY KEY (`id_pesanan`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_properti` (`id_properti`);

--
-- Indexes for table `tb_properti`
--
ALTER TABLE `tb_properti`
  ADD PRIMARY KEY (`id_properti`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_pesanan`
--
ALTER TABLE `tb_pesanan`
  MODIFY `id_pesanan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_properti`
--
ALTER TABLE `tb_properti`
  MODIFY `id_properti` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_pesanan`
--
ALTER TABLE `tb_pesanan`
  ADD CONSTRAINT `tb_pesanan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tb_admin` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_pesanan_ibfk_2` FOREIGN KEY (`id_properti`) REFERENCES `tb_properti` (`id_properti`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
