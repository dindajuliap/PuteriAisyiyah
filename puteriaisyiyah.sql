-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2021 at 01:32 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

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
-- Table structure for table `tabel_akun`
--

CREATE TABLE `tabel_akun` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(100) DEFAULT NULL,
  `email_user` varchar(100) NOT NULL,
  `nomorhp_user` varchar(13) DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  `alamat_user` text DEFAULT NULL,
  `tmpt_lahir_user` varchar(100) DEFAULT NULL,
  `tgl_lahir_user` date DEFAULT NULL,
  `jk_user` enum('L','P') DEFAULT NULL,
  `role_id` int(1) DEFAULT NULL,
  `status_user` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tabel_akun`
--

INSERT INTO `tabel_akun` (`id_user`, `nama_user`, `email_user`, `nomorhp_user`, `password`, `alamat_user`, `tmpt_lahir_user`, `tgl_lahir_user`, `jk_user`, `role_id`, `status_user`) VALUES
(1, 'Panti Asuhan Puteri Aisyiyah', 'puteriaisyiyah@gmail.com', NULL, '8f315d491f7abd6d8cc7a057b3994688bc92db1e', NULL, NULL, NULL, NULL, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tabel_album`
--

CREATE TABLE `tabel_album` (
  `id_album` int(11) NOT NULL,
  `nama_album` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tabel_anak`
--

CREATE TABLE `tabel_anak` (
  `id_anak` int(11) NOT NULL,
  `nama_anak` varchar(100) NOT NULL,
  `asal_anak` varchar(100) DEFAULT NULL,
  `tgl_lahir_anak` date DEFAULT NULL,
  `jk_anak` enum('L','P') NOT NULL,
  `pendidikan_anak` varchar(50) DEFAULT NULL,
  `tgl_masuk_anak` date NOT NULL,
  `agama_anak` varchar(100) DEFAULT NULL,
  `kewarganegaraan_anak` varchar(100) DEFAULT NULL,
  `alamat_anak` text DEFAULT NULL,
  `anak_ke` int(2) NOT NULL,
  `jlh_saudara_pr` int(2) DEFAULT NULL,
  `jlh_saudara_lk` int(2) DEFAULT NULL,
  `jlh_saudara_tiri` int(2) DEFAULT NULL,
  `status_ortu` varchar(100) DEFAULT NULL,
  `status_anak` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tabel_berita`
--

CREATE TABLE `tabel_berita` (
  `id_berita` int(11) NOT NULL,
  `judul_berita` varchar(100) NOT NULL,
  `cover_berita` varchar(100) NOT NULL,
  `isi_berita` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tabel_donasi`
--

CREATE TABLE `tabel_donasi` (
  `id_donasi` int(11) NOT NULL,
  `nama_donatur` varchar(100) NOT NULL,
  `jumlah_donasi` int(11) NOT NULL,
  `jenis_donasi` varchar(50) NOT NULL,
  `ket_donasi` text NOT NULL,
  `bukti_tf` varchar(100) DEFAULT NULL,
  `tgl_donasi` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tabel_foto`
--

CREATE TABLE `tabel_foto` (
  `id_foto` int(11) NOT NULL,
  `id_album` int(11) NOT NULL,
  `file_foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tabel_inventaris`
--

CREATE TABLE `tabel_inventaris` (
  `id_inventaris` int(11) NOT NULL,
  `nama_inventaris` varchar(100) NOT NULL,
  `inventaris_lantai` int(1) NOT NULL,
  `jumlah_inventaris` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tabel_kesehatan`
--

CREATE TABLE `tabel_kesehatan` (
  `id_kesehatan` int(11) NOT NULL,
  `id_anak` int(11) NOT NULL,
  `bb_anak` int(3) NOT NULL,
  `tb_anak` int(3) NOT NULL,
  `goldar_anak` enum('O','A','B','AB') NOT NULL,
  `penyakit_bawaan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tabel_ortu`
--

CREATE TABLE `tabel_ortu` (
  `id_ortu` int(11) NOT NULL,
  `id_anak` int(11) NOT NULL,
  `nama_ayah` varchar(100) NOT NULL,
  `umur_ayah` int(3) NOT NULL,
  `nama_ibu` varchar(100) NOT NULL,
  `umur_ibu` int(3) NOT NULL,
  `pekerjaan_ayah` varchar(100) NOT NULL,
  `pendidikan_ayah` varchar(100) NOT NULL,
  `pekerjaan_ibu` varchar(100) NOT NULL,
  `pendidikan_ibu` varchar(100) NOT NULL,
  `alamat_ortu` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tabel_panti`
--

CREATE TABLE `tabel_panti` (
  `id_biodata` int(11) NOT NULL,
  `jenis_biodata` varchar(100) NOT NULL,
  `isi_biodata` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tabel_pengurus`
--

CREATE TABLE `tabel_pengurus` (
  `id_pengurus` int(11) NOT NULL,
  `nama_pengurus` varchar(100) NOT NULL,
  `tmpt_lahir_pengurus` varchar(100) NOT NULL,
  `tgl_lahir_pengurus` date NOT NULL,
  `jk_pengurus` enum('L','P') NOT NULL,
  `pendidikan_pengurus` varchar(50) NOT NULL,
  `alamat_pengurus` varchar(100) NOT NULL,
  `nomorhp_pengurus` varchar(13) NOT NULL,
  `jabatan_pengurus` varchar(100) NOT NULL,
  `periode_kepengurusan` varchar(100) NOT NULL,
  `status_pengurus` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_token`
--

CREATE TABLE `user_token` (
  `id_token` int(11) NOT NULL,
  `email_user` varchar(100) NOT NULL,
  `token` varchar(255) NOT NULL,
  `tanggal_daftar` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tabel_akun`
--
ALTER TABLE `tabel_akun`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `tabel_album`
--
ALTER TABLE `tabel_album`
  ADD PRIMARY KEY (`id_album`);

--
-- Indexes for table `tabel_anak`
--
ALTER TABLE `tabel_anak`
  ADD PRIMARY KEY (`id_anak`);

--
-- Indexes for table `tabel_berita`
--
ALTER TABLE `tabel_berita`
  ADD PRIMARY KEY (`id_berita`);

--
-- Indexes for table `tabel_donasi`
--
ALTER TABLE `tabel_donasi`
  ADD PRIMARY KEY (`id_donasi`);

--
-- Indexes for table `tabel_foto`
--
ALTER TABLE `tabel_foto`
  ADD PRIMARY KEY (`id_foto`),
  ADD KEY `id_album` (`id_album`);

--
-- Indexes for table `tabel_inventaris`
--
ALTER TABLE `tabel_inventaris`
  ADD PRIMARY KEY (`id_inventaris`);

--
-- Indexes for table `tabel_kesehatan`
--
ALTER TABLE `tabel_kesehatan`
  ADD PRIMARY KEY (`id_kesehatan`),
  ADD KEY `id_anak1` (`id_anak`);

--
-- Indexes for table `tabel_ortu`
--
ALTER TABLE `tabel_ortu`
  ADD PRIMARY KEY (`id_ortu`),
  ADD KEY `id_anak2` (`id_anak`);

--
-- Indexes for table `tabel_panti`
--
ALTER TABLE `tabel_panti`
  ADD PRIMARY KEY (`id_biodata`);

--
-- Indexes for table `tabel_pengurus`
--
ALTER TABLE `tabel_pengurus`
  ADD PRIMARY KEY (`id_pengurus`);

--
-- Indexes for table `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id_token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tabel_akun`
--
ALTER TABLE `tabel_akun`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tabel_album`
--
ALTER TABLE `tabel_album`
  MODIFY `id_album` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tabel_anak`
--
ALTER TABLE `tabel_anak`
  MODIFY `id_anak` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tabel_berita`
--
ALTER TABLE `tabel_berita`
  MODIFY `id_berita` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tabel_donasi`
--
ALTER TABLE `tabel_donasi`
  MODIFY `id_donasi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tabel_foto`
--
ALTER TABLE `tabel_foto`
  MODIFY `id_foto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tabel_inventaris`
--
ALTER TABLE `tabel_inventaris`
  MODIFY `id_inventaris` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tabel_kesehatan`
--
ALTER TABLE `tabel_kesehatan`
  MODIFY `id_kesehatan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tabel_ortu`
--
ALTER TABLE `tabel_ortu`
  MODIFY `id_ortu` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tabel_panti`
--
ALTER TABLE `tabel_panti`
  MODIFY `id_biodata` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tabel_pengurus`
--
ALTER TABLE `tabel_pengurus`
  MODIFY `id_pengurus` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id_token` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tabel_foto`
--
ALTER TABLE `tabel_foto`
  ADD CONSTRAINT `id_album` FOREIGN KEY (`id_album`) REFERENCES `tabel_album` (`id_album`);

--
-- Constraints for table `tabel_kesehatan`
--
ALTER TABLE `tabel_kesehatan`
  ADD CONSTRAINT `id_anak1` FOREIGN KEY (`id_anak`) REFERENCES `tabel_anak` (`id_anak`);

--
-- Constraints for table `tabel_ortu`
--
ALTER TABLE `tabel_ortu`
  ADD CONSTRAINT `id_anak2` FOREIGN KEY (`id_anak`) REFERENCES `tabel_anak` (`id_anak`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
