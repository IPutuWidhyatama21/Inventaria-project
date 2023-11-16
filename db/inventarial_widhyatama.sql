-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 16, 2023 at 06:15 AM
-- Server version: 8.1.0
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventarial_widhyatama`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int NOT NULL,
  `nama_barang` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
  `keterangan` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `stok` int NOT NULL,
  `id_rak` int NOT NULL,
  `gambar` text COLLATE utf8mb4_general_ci NOT NULL,
  `kolom` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`, `keterangan`, `stok`, `id_rak`, `gambar`, `kolom`) VALUES
(21, 'Sendok', 'Besi', 12, 3, '65558a9318c32.jpg', 6),
(23, 'Piring', 'Barang Pecah Belah', 15, 3, '6555707b265fa.jpg', 5),
(24, 'Cup Plastik', 'Plastik', 15, 1, '655563d62561b.jpg', 1),
(25, 'Sendok 2', 'Besi', 20, 3, '6555af927d56a.jpg', 7);

-- --------------------------------------------------------

--
-- Table structure for table `rak`
--

CREATE TABLE `rak` (
  `id_rak` int NOT NULL,
  `nama_rak` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
  `jumlah_kolom` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rak`
--

INSERT INTO `rak` (`id_rak`, `nama_rak`, `jumlah_kolom`) VALUES
(1, 'A7', 5),
(2, 'A1', 6),
(3, 'A01', 12);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int NOT NULL,
  `username` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
  `password` text COLLATE utf8mb4_general_ci NOT NULL,
  `status` enum('2','1') COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `status`) VALUES
(1, 'admin', '$2y$10$QVWc..K1HeFmZHfb4X/JzOdQGgWquJm2yOG4328yl6SNYsJHI/Noa', '1'),
(10, 'Rama', '$2y$10$IVaSKLBN7XBKoOYCNQdPfebucEITj3uMP/08HlLr48zdLtB5tZCZm', '2'),
(11, 'Nanda', '$2y$10$Eo2b13MGpkAnwb26ASZ3DeiNBrG.JHBLPquJSxGq.2wven/8yw4NS', '2'),
(14, 'Putra', '$2y$10$HtSWdK9mzyIpfm4bAonZF.wtlRt./9Xb7aoDNT08UcSS8B8Y5c1Fy', '2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD KEY `id_rak` (`id_rak`);

--
-- Indexes for table `rak`
--
ALTER TABLE `rak`
  ADD PRIMARY KEY (`id_rak`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `rak`
--
ALTER TABLE `rak`
  MODIFY `id_rak` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`id_rak`) REFERENCES `rak` (`id_rak`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
