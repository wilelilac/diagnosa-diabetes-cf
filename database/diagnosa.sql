-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2023 at 04:53 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `diagnosa`
--

-- --------------------------------------------------------

--
-- Table structure for table `catatanmedis`
--

CREATE TABLE `catatanmedis` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nilai` varchar(255) NOT NULL,
  `penyakit` varchar(255) NOT NULL,
  `tgl_diagnosa` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `catatanmedis`
--

INSERT INTO `catatanmedis` (`id`, `nama`, `nilai`, `penyakit`, `tgl_diagnosa`) VALUES
(1, 'Muhammad Wildan', '76%', 'Diabetes Tipe 2', '2023-06-08'),
(2, 'Muhammad Wildan', '90.6544%', 'Diabetes Tipe Khusus', '2023-06-08'),
(3, 'Muhammad Wildan', '93.16%', 'Diabetes Tipe 2', '2023-06-08'),
(4, 'Muhammad Wildan', '77.152%', 'Diabetes Tipe 2', '2023-06-08'),
(5, 'faisal khoiri ', '66.4%', 'Diabetes Tipe 2', '0000-00-00'),
(6, 'Muhammad Wildan', '79%', 'Diabetes Tipe 2', '0000-00-00'),
(7, 'Muhammad Wildan', '79%', 'Diabetes Tipe 2', '2023-06-08'),
(8, 'Muhammad Wildan', '82%', 'Diabtes Tipe 1', '2023-06-08');

-- --------------------------------------------------------

--
-- Table structure for table `gejala`
--

CREATE TABLE `gejala` (
  `id_gejala` int(12) NOT NULL,
  `nama_gejala` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `gejala`
--

INSERT INTO `gejala` (`id_gejala`, `nama_gejala`) VALUES
(1, 'Umur anda dibawah 20 tahun'),
(2, 'Umur anda diatas 20 tahun'),
(3, 'Orang tua penderita diabetes tipe 1'),
(4, 'Orang tua penderita diabetes tipe 2'),
(5, 'Berat badan lebih dari 20% dari berat badan normal'),
(6, 'Dalam masa hamil'),
(7, 'Pasca Radiasi'),
(8, 'Pasca Kemoterapi'),
(9, 'Timbulnya rasa kesemutan (mati rasa) atau sakit pada tangan atau kaki'),
(10, 'Sering merasa haus'),
(11, 'Sering kencing '),
(12, 'Rasa lapar berlebihan '),
(13, 'Turunnya berat badan tanpa alasan yang jelas'),
(14, 'Kadar protein Cpeptide rendah'),
(15, 'Kadar protein Cpeptide tinggi'),
(16, 'Mudah merasa lelah'),
(17, 'Nafas berbau seperti buah'),
(18, 'Pandangan mata kurang jelas'),
(19, 'Timbulnya luka pada kaki yang tak kunjung sembuh'),
(20, 'Mual/Muntah/Sakit Perut'),
(21, 'Mulut kering'),
(22, 'Merasa gatal-gatal'),
(23, 'Sebelumnya pernah mengidap penyakit tertentu dan mengkonsumsi obat yang dapat mengganggu kadar gula '),
(24, 'Badan terasa lemas/Sering Mengantuk'),
(25, 'Kepala merasa sering pusing');

-- --------------------------------------------------------

--
-- Table structure for table `pengetahuan`
--

CREATE TABLE `pengetahuan` (
  `id_pengetahuan` int(11) NOT NULL,
  `kode_penyakit` varchar(100) NOT NULL,
  `id_gejala` int(12) NOT NULL,
  `mb` float NOT NULL,
  `md` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `pengetahuan`
--

INSERT INTO `pengetahuan` (`id_pengetahuan`, `kode_penyakit`, `id_gejala`, `mb`, `md`) VALUES
(1, 'A', 1, 1, 0.7),
(2, 'B', 2, 1, 0.7),
(3, 'A', 3, 0.4, 0.5),
(4, 'B', 4, -0.4, 0.5),
(5, 'B', 5, 1, 0.6),
(6, 'C', 5, 1, 0.6),
(7, 'C', 6, 1, 0.9),
(8, 'D', 7, 0.6, 0.9),
(9, 'D', 8, 1, 0.9),
(10, 'A', 9, 1, 0.4),
(11, 'B', 9, 1, 0.4),
(12, 'D', 9, 1, 0.4),
(13, 'A', 10, 1, 0.7),
(14, 'B', 10, 1, 0.7),
(15, 'C', 10, 1, 0.7),
(16, 'D', 10, 1, 0.7),
(17, 'C', 9, 1, 0.4),
(18, 'B', 11, 1, 0.7),
(19, 'C', 11, 1, 0.7),
(20, 'D', 11, 1, 0.7),
(21, 'B', 12, 1, 0.7),
(22, 'C', 12, 1, 0.7),
(23, 'D', 12, 1, 0.7),
(24, 'A', 13, 1, 0.4),
(25, 'B', 13, 1, 0.4),
(26, 'A', 14, 1, 0.9),
(27, 'B', 15, 0, 0.9),
(28, 'C', 15, 0, 0.9),
(29, 'D', 15, 0, 0.9),
(30, 'A', 16, 1, 0.4),
(31, 'C', 16, 1, 0.4),
(32, 'D', 16, 1, 0.4),
(33, 'A', 17, 1, 0.8),
(34, 'B', 18, 1, 0.3),
(35, 'D', 18, 1, 0.3),
(36, 'A', 19, -1, 0.7),
(37, 'B', 19, -1, 0.7),
(38, 'B', 19, -1, 0.7),
(39, 'C', 19, -1, 0.7),
(40, 'D', 19, -1, 0.7),
(41, 'A', 20, 1, 0.3),
(42, 'B', 20, 1, 0.3),
(43, 'C', 20, 1, 0.3),
(44, 'D', 20, 1, 0.3),
(45, 'A', 21, 0, 0.2),
(46, 'B', 21, 0, 0.2),
(47, 'C', 21, 0, 0.2),
(48, 'D', 21, 0, 0.2),
(49, 'A', 22, 1, 0.1),
(50, 'B', 22, 1, 0.1),
(51, 'C', 22, 1, 0.1),
(52, 'D', 22, 1, 0.1),
(53, 'D', 23, 1, 0.8),
(54, 'A', 24, 1, 0.1),
(55, 'B', 24, 1, 0.1),
(56, 'C', 24, 1, 0.1),
(57, 'D', 24, 1, 0.1),
(58, 'A', 25, 1, 0.1),
(59, 'B', 25, 1, 0.1),
(60, 'C', 25, 1, 0.1),
(61, 'D', 25, 1, 0.1);

-- --------------------------------------------------------

--
-- Table structure for table `penyakit`
--

CREATE TABLE `penyakit` (
  `id_penyakit` int(12) NOT NULL,
  `kode_penyakit` varchar(100) NOT NULL,
  `nama_penyakit` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `penyakit`
--

INSERT INTO `penyakit` (`id_penyakit`, `kode_penyakit`, `nama_penyakit`) VALUES
(1, 'A', 'Diabtes Tipe 1'),
(2, 'B', 'Diabetes Tipe 2'),
(3, 'C', 'Diabetes Gestasional'),
(4, 'D', 'Diabetes Tipe Khusus');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(250) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `umur` int(11) NOT NULL,
  `tb` int(11) NOT NULL,
  `bb` int(11) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `password` varchar(250) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `nama`, `email`, `umur`, `tb`, `bb`, `no_hp`, `password`, `status`) VALUES
(1, 'tegarrss', 'tergar sri sumantri', 'togar981@yahoo.co.id', 19, 165, 70, '0859102868989', '$2y$10$iFAC3NIn2D6rWgy7UFGbC.LZB1KpvqupivbrDbqryC0G2AwUdZXGy', 'user'),
(12123, 'admin', 'admin', 'admin', 20, 150, 50, '08951222', '$2y$10$huakxP0MLo5A/P6uFG.7jujKP6b0jc17cK1j9lG9pCUAJqjdO8F/G', 'admin'),
(12125, 'wildan', 'Muhammad Wildan', 'mwildan@gmail.com', 22, 184, 75, '08169696969', '$2y$10$DAV9UFBRDoCPr6wyvNxjfucK/cG9h2glkrv8g7evZdlnIeMux0X3G', 'user'),
(12126, 'admin2', 'admin2', 'admin2@gmail.com', 0, 0, 0, '081420420420', '$2y$10$r0sQJWp.ewrqS82vEQYFeuXPKt4Nzm4fE6QikgW2R8sEc7btx8v/C', 'admin'),
(12128, 'faisal', 'faisal khoiri ', 'faisal@gmail.com', 21, 165, 60, '0987654321', '$2y$10$QUcohhAC1sJaCLs9PeUSz.hrUhRYTGoPu/e9j13kBWbF.VYZbjheu', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `catatanmedis`
--
ALTER TABLE `catatanmedis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gejala`
--
ALTER TABLE `gejala`
  ADD PRIMARY KEY (`id_gejala`);

--
-- Indexes for table `pengetahuan`
--
ALTER TABLE `pengetahuan`
  ADD PRIMARY KEY (`id_pengetahuan`);

--
-- Indexes for table `penyakit`
--
ALTER TABLE `penyakit`
  ADD PRIMARY KEY (`id_penyakit`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `catatanmedis`
--
ALTER TABLE `catatanmedis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `gejala`
--
ALTER TABLE `gejala`
  MODIFY `id_gejala` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `pengetahuan`
--
ALTER TABLE `pengetahuan`
  MODIFY `id_pengetahuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `penyakit`
--
ALTER TABLE `penyakit`
  MODIFY `id_penyakit` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12129;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
