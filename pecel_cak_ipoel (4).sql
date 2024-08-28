-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 28, 2024 at 04:28 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pecel_cak_ipoel`
--

-- --------------------------------------------------------

--
-- Table structure for table `laporan_bulanan`
--

CREATE TABLE `laporan_bulanan` (
  `id_laporan` int(11) NOT NULL,
  `tahun` int(4) NOT NULL,
  `bulan` int(2) NOT NULL,
  `total_pemasukan` int(11) NOT NULL,
  `total_pengeluaran` int(11) NOT NULL,
  `total_penjualan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `laporan_bulanan`
--

INSERT INTO `laporan_bulanan` (`id_laporan`, `tahun`, `bulan`, `total_pemasukan`, `total_pengeluaran`, `total_penjualan`) VALUES
(1, 2024, 7, 800000, 100000, 880000);

-- --------------------------------------------------------

--
-- Table structure for table `pemasukan`
--

CREATE TABLE `pemasukan` (
  `id_pemasukan` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `ket_pemasukan` text NOT NULL,
  `sumber` varchar(100) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pemasukan`
--

INSERT INTO `pemasukan` (`id_pemasukan`, `tanggal`, `ket_pemasukan`, `sumber`, `jumlah`) VALUES
(1, '2024-07-01', 'Saldo Awal', 'Pribadi', 200000),
(5, '2024-07-20', 'Pendapatan Penjualan ', 'Hasil Penjualan', 450000),
(6, '2023-10-16', 'Pendapatan Penjualan ', 'Hasil Penjualan', 50000),
(9, '2024-08-06', 'Pendapatan Penjualan ', 'Hasil Penjualan', 200000);

-- --------------------------------------------------------

--
-- Table structure for table `pengeluaran`
--

CREATE TABLE `pengeluaran` (
  `id_pengeluaran` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `uraian` text NOT NULL,
  `jumlah` int(11) NOT NULL,
  `satuan` varchar(50) NOT NULL,
  `harga_satuan` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengeluaran`
--

INSERT INTO `pengeluaran` (`id_pengeluaran`, `tanggal`, `uraian`, `jumlah`, `satuan`, `harga_satuan`, `total_harga`) VALUES
(12, '2024-07-19', 'Kacang', 2, 'Kilo', 20000, 40000),
(13, '2024-07-19', 'Karet', 1, 'Pack', 10000, 10000),
(17, '2024-07-18', 'Tempe', 15, 'Potong', 3000, 45000),
(18, '2024-07-18', 'Tauge', 10, 'kg', 10000, 100000),
(19, '2024-07-19', 'Daging Sapi', 5, 'kg', 50000, 250000),
(22, '2024-08-04', 'Ikan', 2, 'kg', 8000, 16000),
(23, '2024-08-16', 'Ikan', 4, 'kg', 6000, 24000),
(25, '2024-08-06', 'Daging Sapi', 9, 'kg', 8000, 72000);

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `id_penjualan` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `jumlah_produksi` int(11) NOT NULL,
  `terjual` int(11) NOT NULL,
  `sisa` int(11) NOT NULL,
  `harga_perbungkus` int(11) NOT NULL,
  `hasil_pendapatan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`id_penjualan`, `tanggal`, `jumlah_produksi`, `terjual`, `sisa`, `harga_perbungkus`, `hasil_pendapatan`) VALUES
(3, '2024-07-18', 30, 21, 9, 8000, 168000),
(5, '2024-07-19', 30, 15, 15, 8000, 120000),
(8, '2024-07-24', 30, 27, 3, 8000, 216000),
(9, '2024-07-08', 30, 20, 10, 8000, 160000),
(10, '2024-07-30', 30, 29, 1, 8000, 232000),
(11, '2024-07-23', 30, 30, 0, 8000, 240000),
(12, '2024-08-02', 30, 27, 3, 8000, 216000),
(13, '2024-08-07', 30, 23, 7, 8000, 184000),
(14, '2024-08-20', 30, 6, 24, 8000, 48000),
(15, '2024-08-04', 30, 30, 0, 8000, 240000),
(16, '2024-08-04', 30, 30, 0, 8000, 0),
(17, '2024-08-04', 30, 12, 18, 8000, 96000),
(18, '2024-08-03', 30, 13, 17, 8000, 104000),
(19, '2024-08-02', 30, 20, 10, 8000, 160000),
(20, '2024-08-01', 30, 5, 25, 8000, 40000);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','kasir') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'admin', 'admin', 'admin'),
(2, 'kasir', 'kasir', 'kasir');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `laporan_bulanan`
--
ALTER TABLE `laporan_bulanan`
  ADD PRIMARY KEY (`id_laporan`);

--
-- Indexes for table `pemasukan`
--
ALTER TABLE `pemasukan`
  ADD PRIMARY KEY (`id_pemasukan`),
  ADD KEY `idx_tanggal_pemasukan` (`tanggal`);

--
-- Indexes for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD PRIMARY KEY (`id_pengeluaran`),
  ADD KEY `idx_tanggal_pengeluaran` (`tanggal`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id_penjualan`),
  ADD KEY `idx_tanggal_penjualan` (`tanggal`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `laporan_bulanan`
--
ALTER TABLE `laporan_bulanan`
  MODIFY `id_laporan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pemasukan`
--
ALTER TABLE `pemasukan`
  MODIFY `id_pemasukan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  MODIFY `id_pengeluaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id_penjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
