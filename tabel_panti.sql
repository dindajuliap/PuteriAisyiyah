-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 15, 2021 at 04:24 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `puteriaisyiyah`
--

-- --------------------------------------------------------

--
-- Table structure for table `tabel_panti`
--

CREATE TABLE `tabel_panti` (
  `id_biodata` int(11) NOT NULL,
  `jenis_biodata` varchar(100) NOT NULL,
  `isi_biodata` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tabel_panti`
--

INSERT INTO `tabel_panti` (`id_biodata`, `jenis_biodata`, `isi_biodata`) VALUES
(1, 'Alamat', 'Jl. Santun No. 17, Sudirejo I, Kec. Medan Kota, Kota Medan, Sumatera Utara 20218'),
(2, 'E-mail', 'puteriaisyiyah@gmail.com'),
(3, 'Telepon ', '061-7863466'),
(4, 'Ketua ', 'Zulbaidah,BA'),
(5, 'PANTI ASUHAN', 'PUTERI AISYIYAH');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tabel_panti`
--
ALTER TABLE `tabel_panti`
  ADD PRIMARY KEY (`id_biodata`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tabel_panti`
--
ALTER TABLE `tabel_panti`
  MODIFY `id_biodata` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
