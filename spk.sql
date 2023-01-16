-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2022 at 09:10 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spk`
--

-- --------------------------------------------------------

--
-- Table structure for table `bobot`
--

CREATE TABLE `bobot` (
  `selisih` tinyint(3) NOT NULL,
  `bobot` float NOT NULL,
  `keterangan` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bobot`
--

INSERT INTO `bobot` (`selisih`, `bobot`, `keterangan`) VALUES
(0, 5, 'Tidak ada  selisih (kompetensi,sesuai dgn yang dibutuhkan)'),
(1, 4.5, 'Kompetensi individu kelebihan 1 tingkat'),
(-1, 4, 'Kompetensi individu kekurangan 1 tingkat'),
(2, 3.5, 'Kompetensi individu kelebihan 2 tingkat'),
(-2, 3, 'Kompetensi individu kekurangan 2 tingkat'),
(3, 2.5, 'Kompetensi individu kelebihan 3 tingkat'),
(-3, 2, 'Kompetensi individu kekurangan 3 tingkat'),
(4, 1.5, 'Kompetensi individu kelebihan 4 tingkat'),
(-4, 1, 'Kompetensi individu kekurangan 4 tingkat');

-- --------------------------------------------------------

--
-- Table structure for table `data_alternatif`
--

CREATE TABLE `data_alternatif` (
  `id_karyawan` tinyint(3) UNSIGNED NOT NULL,
  `nama_karyawan` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_alternatif`
--

INSERT INTO `data_alternatif` (`id_karyawan`, `nama_karyawan`) VALUES
(1, 'Kasmiyati'),
(2, 'Kasimun'),
(3, 'Joko Budi'),
(4, 'Tri Solo'),
(5, 'Ismiyati'),
(6, 'Supriyanto');

-- --------------------------------------------------------

--
-- Table structure for table `data_kriteria`
--

CREATE TABLE `data_kriteria` (
  `id_aspek` tinyint(3) UNSIGNED NOT NULL,
  `nama_aspek` varchar(100) NOT NULL,
  `bobot` float NOT NULL,
  `bobot_core` float NOT NULL,
  `bobot_secondary` float NOT NULL,
  `nama_singkat` char(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_kriteria`
--

INSERT INTO `data_kriteria` (`id_aspek`, `nama_aspek`, `bobot`, `bobot_core`, `bobot_secondary`, `nama_singkat`) VALUES
(1, 'Capaian SKP', 60, 70, 30, 'C'),
(2, 'Perilaku Kerja', 40, 60, 40, 'P');

-- --------------------------------------------------------

--
-- Table structure for table `data_sample`
--

CREATE TABLE `data_sample` (
  `id_sample` int(11) UNSIGNED NOT NULL,
  `karyawan` tinyint(3) UNSIGNED DEFAULT NULL,
  `faktor` tinyint(3) UNSIGNED DEFAULT NULL,
  `nilai` float UNSIGNED DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_sample`
--

INSERT INTO `data_sample` (`id_sample`, `karyawan`, `faktor`, `nilai`) VALUES
(1, 1, 1, 81),
(2, 1, 2, 83.33),
(3, 1, 3, 84.1),
(4, 1, 4, 83.32),
(5, 1, 5, 83.3),
(6, 1, 6, 83.3),
(7, 1, 7, 85),
(8, 2, 1, 82.53),
(9, 2, 2, 82.41),
(10, 2, 3, 85),
(11, 2, 4, 82.33),
(12, 2, 5, 84.33),
(13, 2, 6, 83),
(14, 2, 7, 83),
(22, 3, 1, 82.47),
(23, 3, 2, 82.44),
(24, 3, 3, 83),
(25, 3, 4, 85),
(26, 3, 5, 86),
(27, 3, 6, 83),
(28, 3, 7, 86),
(29, 4, 1, 83.32),
(30, 4, 2, 81.33),
(31, 4, 3, 81.5),
(32, 4, 4, 81.5),
(33, 4, 5, 81),
(34, 4, 6, 82.5),
(35, 4, 7, 83.5),
(36, 5, 1, 81.58),
(37, 5, 2, 82.25),
(38, 5, 3, 82),
(39, 5, 4, 81.33),
(40, 5, 5, 81.67),
(41, 5, 6, 81.33),
(42, 5, 7, 81),
(43, 6, 1, 81.1),
(44, 6, 2, 81.55),
(45, 6, 3, 83),
(46, 6, 4, 81.33),
(47, 6, 5, 79),
(48, 6, 6, 81.33),
(49, 6, 7, 78.86);

-- --------------------------------------------------------

--
-- Table structure for table `data_subkriteria`
--

CREATE TABLE `data_subkriteria` (
  `id_sub` tinyint(4) NOT NULL,
  `kriteria` tinyint(4) NOT NULL COMMENT 'FK data_kriteria',
  `nama_sub` varchar(30) NOT NULL,
  `bobot_standar_pm` tinyint(4) NOT NULL,
  `bobot_standar_saw` decimal(4,2) NOT NULL,
  `jenis` enum('C','S') DEFAULT NULL COMMENT 'C=Core;S=Secondary',
  `jns_saw` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_subkriteria`
--

INSERT INTO `data_subkriteria` (`id_sub`, `kriteria`, `nama_sub`, `bobot_standar_pm`, `bobot_standar_saw`, `jenis`, `jns_saw`) VALUES
(1, 1, 'Tugas Utama', 5, '0.20', 'C', 'Benefit'),
(2, 1, 'Tugas Penunjang', 4, '0.10', 'S', 'Benefit'),
(3, 2, 'Orientasi', 3, '0.10', 'S', 'Benefit'),
(4, 2, 'Integritas', 4, '0.15', 'C', 'Benefit'),
(5, 2, 'Komitmen', 3, '0.10', 'S', 'Benefit'),
(6, 2, 'Disiplin', 4, '0.15', 'C', 'Benefit'),
(7, 2, 'Kerjasama', 5, '0.20', 'C', 'Benefit');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bobot`
--
ALTER TABLE `bobot`
  ADD PRIMARY KEY (`selisih`);

--
-- Indexes for table `data_alternatif`
--
ALTER TABLE `data_alternatif`
  ADD PRIMARY KEY (`id_karyawan`);

--
-- Indexes for table `data_kriteria`
--
ALTER TABLE `data_kriteria`
  ADD PRIMARY KEY (`id_aspek`);

--
-- Indexes for table `data_sample`
--
ALTER TABLE `data_sample`
  ADD PRIMARY KEY (`id_sample`),
  ADD KEY `karyawan` (`karyawan`);

--
-- Indexes for table `data_subkriteria`
--
ALTER TABLE `data_subkriteria`
  ADD PRIMARY KEY (`id_sub`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_alternatif`
--
ALTER TABLE `data_alternatif`
  MODIFY `id_karyawan` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `data_kriteria`
--
ALTER TABLE `data_kriteria`
  MODIFY `id_aspek` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `data_sample`
--
ALTER TABLE `data_sample`
  MODIFY `id_sample` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
