-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 16, 2021 at 08:05 PM
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

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`puteriaisyiyah`@`localhost` PROCEDURE `procedure_hapus_akun` (`id_user` INT(11))  begin
delete from tabel_akun where id_user = id_user;
end$$

CREATE DEFINER=`puteriaisyiyah`@`localhost` PROCEDURE `procedure_hapus_album` (`id_album` INT(11))  begin
delete from tabel_album where id_album = id_album;
end$$

CREATE DEFINER=`puteriaisyiyah`@`localhost` PROCEDURE `procedure_hapus_anak` (`id_anak` INT(11))  begin
delete from tabel_anak where id_anak = id_anak;
end$$

CREATE DEFINER=`puteriaisyiyah`@`localhost` PROCEDURE `procedure_hapus_berita` (`id_berita` INT(11))  begin
delete from tabel_berita where id_berita = id_berita;
end$$

CREATE DEFINER=`puteriaisyiyah`@`localhost` PROCEDURE `procedure_hapus_donasi` (`id_donasi` INT(11))  begin
delete from tabel_donasi where id_donasi = id_donasi;
end$$

CREATE DEFINER=`puteriaisyiyah`@`localhost` PROCEDURE `procedure_hapus_foto` (`id_foto` INT(11))  delete from tabel_donasi where id_foto = id_foto;$$

CREATE DEFINER=`puteriaisyiyah`@`localhost` PROCEDURE `procedure_hapus_inventaris` (`id_inventaris` INT(11))  begin
delete from tabel_inventaris where id_inventaris = id_inventaris;
end$$

CREATE DEFINER=`puteriaisyiyah`@`localhost` PROCEDURE `procedure_hapus_pengurus` (`id_pengurus` INT(11))  begin
delete from tabel_pengurus where id_pengurus = id_pengurus;
end$$

--
-- Functions
--
CREATE DEFINER=`puteriaisyiyah`@`localhost` FUNCTION `function_jumlah_anak` (`status_anak` INT(1)) RETURNS INT(11) begin
declare jumlah_anak int;
select count(*) into jumlah_anak from tabel_anak where status_anak = status_anak;
return jumlah_anak;
end$$

CREATE DEFINER=`puteriaisyiyah`@`localhost` FUNCTION `function_jumlah_pengurus` (`status_pengurus` INT(1)) RETURNS INT(11) begin
declare jumlah_pengurus int;
select count(*) into jumlah_pengurus from tabel_pengurus where status_pengurus = status_pengurus;
return jumlah_pengurus;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `log_akun`
--

CREATE TABLE `log_akun` (
  `id_log` int(11) NOT NULL,
  `nama_user` varchar(100) DEFAULT NULL,
  `email_user` varchar(100) NOT NULL,
  `nomorhp_user` varchar(13) DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  `alamat_user` text DEFAULT NULL,
  `jk_user` enum('L','P') DEFAULT NULL,
  `status_user` varchar(20) NOT NULL,
  `waktu_log_akun` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `log_inventaris`
--

CREATE TABLE `log_inventaris` (
  `id_log` int(11) NOT NULL,
  `id_inventaris` int(11) NOT NULL,
  `nama_inventaris` varchar(100) NOT NULL,
  `inventaris_lantai` int(1) NOT NULL,
  `jumlah_inventaris` int(3) NOT NULL,
  `status_inventaris` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

--
-- Triggers `tabel_akun`
--
DELIMITER $$
CREATE TRIGGER `trigger_hapus_akun` BEFORE DELETE ON `tabel_akun` FOR EACH ROW INSERT INTO log_akun SET
nama_user = old.nama_user, email_user = old.email_user, nomorhp_user = old.nomorhp_user, password = old.password, alamat_user = old.alamat_user, jk_user = old.jk_user, status_user = "Dihapus", waktu_log_akun = now()
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tabel_album`
--

CREATE TABLE `tabel_album` (
  `id_album` int(11) NOT NULL,
  `nama_album` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Triggers `tabel_album`
--
DELIMITER $$
CREATE TRIGGER `trigger_hapus_album` AFTER DELETE ON `tabel_album` FOR EACH ROW DELETE FROM tabel_foto WHERE id_album = old.id_album
$$
DELIMITER ;

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

--
-- Triggers `tabel_anak`
--
DELIMITER $$
CREATE TRIGGER `trigger_hapus_kesehatan` AFTER DELETE ON `tabel_anak` FOR EACH ROW DELETE FROM tabel_kesehatan WHERE id_anak = old.id_anak
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `trigger_hapus_ortu` AFTER DELETE ON `tabel_anak` FOR EACH ROW DELETE FROM tabel_ortu WHERE id_anak = old.id_anak
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tabel_berita`
--

CREATE TABLE `tabel_berita` (
  `id_berita` int(11) NOT NULL,
  `tanggal_berita` date NOT NULL,
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
  `jumlah_donasi` varchar(50) NOT NULL,
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

--
-- Triggers `tabel_inventaris`
--
DELIMITER $$
CREATE TRIGGER `trigger_hapus_inventaris` BEFORE DELETE ON `tabel_inventaris` FOR EACH ROW UPDATE log_inventaris SET
status_inventaris = "Tidak Tersedia Lagi" WHERE id_inventaris = old.id_inventaris
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `trigger_tambah_inventaris` AFTER INSERT ON `tabel_inventaris` FOR EACH ROW INSERT INTO log_inventaris SET
id_inventaris = new.id_inventaris, nama_inventaris = new.nama_inventaris, inventaris_lantai = new.inventaris_lantai, jumlah_inventaris = new.jumlah_inventaris, status_inventaris = "Tersedia"
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `trigger_ubah_inventaris` AFTER UPDATE ON `tabel_inventaris` FOR EACH ROW UPDATE log_inventaris SET
nama_inventaris = new.nama_inventaris, inventaris_lantai = new.inventaris_lantai, jumlah_inventaris = new.jumlah_inventaris WHERE id_inventaris = old.id_inventaris
$$
DELIMITER ;

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

--
-- Dumping data for table `tabel_panti`
--

INSERT INTO `tabel_panti` (`id_biodata`, `jenis_biodata`, `isi_biodata`) VALUES
(1, 'Alamat', 'Jl. Santun No. 17, Sudirejo I, Kec. Medan Kota, Kota Medan, Sumatera Utara 20218'),
(2, 'Email', 'puteriaisyiyah@gmail.com'),
(3, 'Telepon ', '(061) 7863466'),
(4, 'Ketua ', 'Zulbaidah, BA'),
(6, 'Nama Panti', 'Panti Asuhan Puteri Aisyiyah');

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
  `tanggal_token` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_akun`
-- (See below for the actual view)
--
CREATE TABLE `view_akun` (
`id_user` int(11)
,`nama_user` varchar(100)
,`email_user` varchar(100)
,`alamat_user` text
,`tmpt_lahir_user` varchar(100)
,`tgl_lahir_user` date
,`jk_user` enum('L','P')
,`waktu_log_akun` datetime
,`status_user` varchar(20)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_anak`
-- (See below for the actual view)
--
CREATE TABLE `view_anak` (
`nama_anak` varchar(100)
,`asal_anak` varchar(100)
,`id_anak` int(11)
,`tgl_lahir_anak` date
,`jk_anak` enum('L','P')
,`pendidikan_anak` varchar(50)
,`tgl_masuk_anak` date
,`agama_anak` varchar(100)
,`kewarganegaraan_anak` varchar(100)
,`alamat_anak` text
,`anak_ke` int(2)
,`jlh_saudara_pr` int(2)
,`jlh_saudara_lk` int(2)
,`jlh_saudara_tiri` int(2)
,`status_ortu` varchar(100)
,`status_anak` int(1)
,`bb_anak` int(3)
,`tb_anak` int(3)
,`goldar_anak` enum('O','A','B','AB')
,`penyakit_bawaan` text
,`nama_ayah` varchar(100)
,`umur_ayah` int(3)
,`nama_ibu` varchar(100)
,`umur_ibu` int(3)
,`pekerjaan_ayah` varchar(100)
,`pekerjaan_ibu` varchar(100)
,`pendidikan_ayah` varchar(100)
,`pendidikan_ibu` varchar(100)
,`alamat_ortu` text
);

-- --------------------------------------------------------

--
-- Structure for view `view_akun`
--
DROP TABLE IF EXISTS `view_akun`;

CREATE ALGORITHM=UNDEFINED DEFINER=`puteriaisyiyah`@`localhost` SQL SECURITY DEFINER VIEW `view_akun`  AS SELECT `a`.`id_user` AS `id_user`, `a`.`nama_user` AS `nama_user`, `a`.`email_user` AS `email_user`, `a`.`alamat_user` AS `alamat_user`, `a`.`tmpt_lahir_user` AS `tmpt_lahir_user`, `a`.`tgl_lahir_user` AS `tgl_lahir_user`, `a`.`jk_user` AS `jk_user`, `l`.`waktu_log_akun` AS `waktu_log_akun`, `l`.`status_user` AS `status_user` FROM (`tabel_akun` `a` join `log_akun` `l` on(`a`.`email_user` = `l`.`email_user`)) ;

-- --------------------------------------------------------

--
-- Structure for view `view_anak`
--
DROP TABLE IF EXISTS `view_anak`;

CREATE ALGORITHM=UNDEFINED DEFINER=`puteriaisyiyah`@`localhost` SQL SECURITY DEFINER VIEW `view_anak`  AS SELECT `a`.`nama_anak` AS `nama_anak`, `a`.`asal_anak` AS `asal_anak`, `a`.`id_anak` AS `id_anak`, `a`.`tgl_lahir_anak` AS `tgl_lahir_anak`, `a`.`jk_anak` AS `jk_anak`, `a`.`pendidikan_anak` AS `pendidikan_anak`, `a`.`tgl_masuk_anak` AS `tgl_masuk_anak`, `a`.`agama_anak` AS `agama_anak`, `a`.`kewarganegaraan_anak` AS `kewarganegaraan_anak`, `a`.`alamat_anak` AS `alamat_anak`, `a`.`anak_ke` AS `anak_ke`, `a`.`jlh_saudara_pr` AS `jlh_saudara_pr`, `a`.`jlh_saudara_lk` AS `jlh_saudara_lk`, `a`.`jlh_saudara_tiri` AS `jlh_saudara_tiri`, `a`.`status_ortu` AS `status_ortu`, `a`.`status_anak` AS `status_anak`, `k`.`bb_anak` AS `bb_anak`, `k`.`tb_anak` AS `tb_anak`, `k`.`goldar_anak` AS `goldar_anak`, `k`.`penyakit_bawaan` AS `penyakit_bawaan`, `o`.`nama_ayah` AS `nama_ayah`, `o`.`umur_ayah` AS `umur_ayah`, `o`.`nama_ibu` AS `nama_ibu`, `o`.`umur_ibu` AS `umur_ibu`, `o`.`pekerjaan_ayah` AS `pekerjaan_ayah`, `o`.`pekerjaan_ibu` AS `pekerjaan_ibu`, `o`.`pendidikan_ayah` AS `pendidikan_ayah`, `o`.`pendidikan_ibu` AS `pendidikan_ibu`, `o`.`alamat_ortu` AS `alamat_ortu` FROM ((`tabel_anak` `a` join `tabel_kesehatan` `k` on(`a`.`id_anak` = `k`.`id_anak`)) join `tabel_ortu` `o` on(`a`.`id_anak` = `o`.`id_anak`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `log_akun`
--
ALTER TABLE `log_akun`
  ADD PRIMARY KEY (`id_log`),
  ADD UNIQUE KEY `email_user` (`email_user`,`nomorhp_user`);

--
-- Indexes for table `log_inventaris`
--
ALTER TABLE `log_inventaris`
  ADD PRIMARY KEY (`id_log`);

--
-- Indexes for table `tabel_akun`
--
ALTER TABLE `tabel_akun`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email_user` (`email_user`,`nomorhp_user`);

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
-- AUTO_INCREMENT for table `log_akun`
--
ALTER TABLE `log_akun`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `log_inventaris`
--
ALTER TABLE `log_inventaris`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `id_anak` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id_inventaris` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `id_biodata` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tabel_pengurus`
--
ALTER TABLE `tabel_pengurus`
  MODIFY `id_pengurus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
