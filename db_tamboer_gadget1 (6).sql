-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2024 at 07:37 AM
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
-- Database: `db_tamboer_gadget1`
--

-- --------------------------------------------------------

--
-- Table structure for table `laporan_keuangan`
--

CREATE TABLE `laporan_keuangan` (
  `id_keuangan` int(11) NOT NULL,
  `tahun` year(4) NOT NULL,
  `bulan` varchar(20) NOT NULL,
  `total_penjualan` decimal(15,2) DEFAULT 0.00,
  `total_pengeluaran` decimal(15,2) DEFAULT 0.00,
  `total_pemasukan` decimal(15,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pemasukan`
--

CREATE TABLE `pemasukan` (
  `id_pemasukan` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` text DEFAULT NULL,
  `sumber_dana` varchar(50) DEFAULT NULL,
  `jumlah` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pemasukan`
--

INSERT INTO `pemasukan` (`id_pemasukan`, `tanggal`, `keterangan`, `sumber_dana`, `jumlah`) VALUES
(2, '2024-11-14', 'Modal Awal', 'Dana Pribadi', 50000000.00);

-- --------------------------------------------------------

--
-- Table structure for table `pengeluaran`
--

CREATE TABLE `pengeluaran` (
  `id_pengeluaran` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` text DEFAULT NULL,
  `jumlah` int(11) NOT NULL,
  `harga_satuan` decimal(15,2) NOT NULL,
  `total_harga` decimal(15,2) GENERATED ALWAYS AS (`jumlah` * `harga_satuan`) STORED
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengeluaran`
--

INSERT INTO `pengeluaran` (`id_pengeluaran`, `tanggal`, `keterangan`, `jumlah`, `harga_satuan`) VALUES
(7, '2024-11-02', 'Biaya Iklan Media Sosial', 1, 500000.00),
(8, '2024-11-03', 'Pembelian Etalase Baru', 1, 2500000.00),
(9, '2024-11-04', 'Biaya Pemeliharaan Toko', 1, 750000.00);

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `id_penjualan` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `id_varian` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `harga_jual` decimal(15,2) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total_harga` decimal(15,2) NOT NULL,
  `metode_pembayaran` enum('Tunai','Transfer') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`id_penjualan`, `tanggal`, `id_varian`, `id_user`, `harga_jual`, `jumlah`, `total_harga`, `metode_pembayaran`) VALUES
(36, '2024-11-15', 42, 3, 6000000.00, 1, 6000000.00, 'Tunai'),
(39, '2024-11-15', 54, 3, 5000000.00, 3, 15000000.00, 'Tunai');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `nama_hp` varchar(20) NOT NULL,
  `merek` varchar(15) NOT NULL,
  `model` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `tanggal`, `nama_hp`, `merek`, `model`) VALUES
(13, '2024-11-01', 'Galaxy S21', 'Samsung', 'S21-Base'),
(14, '2024-11-02', 'iPhone 13', 'Apple', '13-Pro'),
(15, '2024-11-03', 'Mi 11', 'Xiaomi', '11-Ultra'),
(16, '2024-11-04', 'Reno5', 'Oppo', 'Reno5-A'),
(19, '2024-11-07', 'P40', 'Huawei', 'P40-Pro'),
(20, '2024-11-08', 'OnePlus 9', 'OnePlus', '9-Pro'),
(21, '2024-11-09', 'Pixel 5', 'Google', '5-XL'),
(22, '2024-11-10', 'Xperia 5 II', 'Sony', '5-II'),
(23, '2024-11-15', 'Galaxy A55', 'Samsung', 'A55');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('pemilik','pegawai') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nama`, `username`, `password`, `role`) VALUES
(3, 'Aisyah', 'aisyah', '$2y$10$95ojMXUGTzOtgvVjnjhRz.P8oJPEHhmhSNSyHFf0kdz2g5ZsEuuRC', 'pemilik'),
(5, 'Pemilik', 'pemilik', 'pemilik', 'pemilik'),
(6, 'Pegawai', 'pegawai', '$2y$10$QeuAa28FOhoFkgk0fUgyrOq.BSL.VpUnt2VVc8oOnQEWd5R.Z3pdi', 'pegawai');

-- --------------------------------------------------------

--
-- Table structure for table `varian`
--

CREATE TABLE `varian` (
  `id_varian` int(11) NOT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `ram` varchar(10) DEFAULT NULL,
  `warna` varchar(50) DEFAULT NULL,
  `penyimpanan` varchar(10) DEFAULT NULL,
  `kondisi` enum('Baru','Bekas') NOT NULL DEFAULT 'Baru',
  `harga_masuk` decimal(15,2) NOT NULL,
  `harga_jual` decimal(15,2) NOT NULL,
  `stok` int(11) NOT NULL,
  `status` enum('Tersedia','Kosong') DEFAULT 'Tersedia'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `varian`
--

INSERT INTO `varian` (`id_varian`, `id_produk`, `ram`, `warna`, `penyimpanan`, `kondisi`, `harga_masuk`, `harga_jual`, `stok`, `status`) VALUES
(41, 13, '8GB', 'Phantom Gray', '128GB', 'Baru', 9500000.00, 10000000.00, 10, 'Tersedia'),
(42, 14, '4GB', 'Blue', '64GB', 'Bekas', 5000000.00, 6000000.00, 11, 'Tersedia'),
(43, 15, '6GB', 'Gray', '128GB', 'Baru', 9000000.00, 10008000.00, 20, 'Tersedia'),
(44, 16, '8GB', 'White', '128GB', 'Baru', 9200000.00, 9800000.00, 0, 'Tersedia'),
(47, 19, '12GB', 'Blue', '512GB', 'Baru', 11000000.00, 11500000.00, 3, 'Tersedia'),
(48, 20, '8GB', 'Green', '128GB', 'Bekas', 8500000.00, 9000000.00, 6, 'Tersedia'),
(49, 21, '4GB', 'Red', '64GB', 'Baru', 5700000.00, 6200000.00, 0, 'Kosong'),
(50, 22, '6GB', 'Phantom Black', '256GB', 'Baru', 9300000.00, 9800000.00, 9, 'Tersedia'),
(51, 13, '12GB', 'Blue', '512GB', 'Baru', 10500000.00, 11000000.00, 0, 'Kosong'),
(52, 14, '8GB', 'Gold', '128GB', 'Bekas', 7500000.00, 8000000.00, 7, 'Tersedia'),
(53, 15, '4GB', 'White', '64GB', 'Baru', 5000000.00, 5500000.00, 14, 'Tersedia'),
(54, 23, '8', 'Blue', '128', 'Baru', 4000000.00, 5000000.00, 0, 'Tersedia'),
(55, 23, '12', 'Navy', '256', 'Baru', 5000000.00, 6000000.00, 1, 'Tersedia');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `laporan_keuangan`
--
ALTER TABLE `laporan_keuangan`
  ADD PRIMARY KEY (`id_keuangan`);

--
-- Indexes for table `pemasukan`
--
ALTER TABLE `pemasukan`
  ADD PRIMARY KEY (`id_pemasukan`),
  ADD KEY `tanggal` (`tanggal`);

--
-- Indexes for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD PRIMARY KEY (`id_pengeluaran`),
  ADD KEY `tanggal` (`tanggal`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id_penjualan`),
  ADD KEY `penjualan_ibfk_2` (`id_user`),
  ADD KEY `tanggal` (`tanggal`),
  ADD KEY `penjualan_ibfk_1` (`id_varian`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `varian`
--
ALTER TABLE `varian`
  ADD PRIMARY KEY (`id_varian`),
  ADD KEY `varian_ibfk_1` (`id_produk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `laporan_keuangan`
--
ALTER TABLE `laporan_keuangan`
  MODIFY `id_keuangan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pemasukan`
--
ALTER TABLE `pemasukan`
  MODIFY `id_pemasukan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  MODIFY `id_pengeluaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id_penjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `varian`
--
ALTER TABLE `varian`
  MODIFY `id_varian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD CONSTRAINT `penjualan_ibfk_1` FOREIGN KEY (`id_varian`) REFERENCES `varian` (`id_varian`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `penjualan_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `varian`
--
ALTER TABLE `varian`
  ADD CONSTRAINT `varian_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
