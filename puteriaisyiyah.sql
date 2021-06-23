-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2021 at 01:42 PM
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
CREATE DEFINER=`puteriaisyiyah`@`localhost` PROCEDURE `procedure_hapus_album` (IN `id` INT(11))  begin
delete from tabel_album where id_album = id;
end$$

CREATE DEFINER=`puteriaisyiyah`@`localhost` PROCEDURE `procedure_hapus_anak` (IN `id` INT(11))  begin
delete from tabel_anak where id_anak = id;
end$$

CREATE DEFINER=`puteriaisyiyah`@`localhost` PROCEDURE `procedure_hapus_berita` (IN `id` INT(11))  begin
delete from tabel_berita where id_berita = id;
end$$

CREATE DEFINER=`puteriaisyiyah`@`localhost` PROCEDURE `procedure_hapus_donasi` (IN `id` INT(11))  begin
delete from tabel_donasi where id_donasi = id;
end$$

CREATE DEFINER=`puteriaisyiyah`@`localhost` PROCEDURE `procedure_hapus_donatur` (IN `id` INT(11))  begin
delete from tabel_donatur where id_donatur = id;
end$$

CREATE DEFINER=`puteriaisyiyah`@`localhost` PROCEDURE `procedure_hapus_foto` (IN `id` INT(11))  delete from tabel_foto where id_foto = id$$

CREATE DEFINER=`puteriaisyiyah`@`localhost` PROCEDURE `procedure_hapus_inventaris` (IN `id` INT(11))  begin
delete from tabel_inventaris where id_inventaris = id;
end$$

CREATE DEFINER=`puteriaisyiyah`@`localhost` PROCEDURE `procedure_hapus_jenis_donasi` (IN `id` INT(11))  begin
delete from jenis_donasi where id_jenis_donasi = id;
end$$

CREATE DEFINER=`puteriaisyiyah`@`localhost` PROCEDURE `procedure_hapus_pengurus` (IN `id` INT(11))  begin
delete from tabel_pengurus where id_pengurus = id;
end$$

--
-- Functions
--
CREATE DEFINER=`puteriaisyiyah`@`localhost` FUNCTION `function_jumlah_anak` (`par_status_anak` INT(1)) RETURNS INT(11) begin
declare jumlah_anak int;
select count(*) into jumlah_anak from tabel_anak where status_anak = par_status_anak;
return jumlah_anak;
end$$

CREATE DEFINER=`puteriaisyiyah`@`localhost` FUNCTION `function_jumlah_pengurus` (`par_status_pengurus` INT(1)) RETURNS INT(11) begin
declare jumlah_pengurus int;
select count(*) into jumlah_pengurus from tabel_pengurus where status_pengurus = par_status_pengurus;
return jumlah_pengurus;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `jenis_donasi`
--

CREATE TABLE `jenis_donasi` (
  `id_jenis_donasi` int(11) NOT NULL,
  `jenis_donasi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jenis_donasi`
--

INSERT INTO `jenis_donasi` (`id_jenis_donasi`, `jenis_donasi`) VALUES
(1, 'Uang'),
(2, 'Beras'),
(3, 'Sembako'),
(4, 'Fasilitas'),
(5, 'Lainnya');

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
  `waktu_log_akun` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `log_akun`
--

INSERT INTO `log_akun` (`id_log`, `nama_user`, `email_user`, `nomorhp_user`, `password`, `alamat_user`, `jk_user`, `status_user`, `waktu_log_akun`) VALUES
(1, 'Panti Asuhan Puteri Aisyiyah', 'puteriaisyiyah@gmail.com', NULL, '8f315d491f7abd6d8cc7a057b3994688bc92db1e', NULL, NULL, 'Terdaftar', '2021-05-18 14:08:15'),
(2, 'Dinda Julia Putri', 'dindajuliap30@gmail.com', '082388373276', 'a3f184733ccecf3b36fdeb97588778f0ee2a6a49', 'Jl. Belibis 9 No. 127', 'P', 'Terdaftar', '2021-06-06 11:12:32'),
(3, 'Milpa Wahyuni Siregar', 'milpawahyuni771@gmail.com', '081277681539', '55362e127cbc07df525a7faf8dc2962774972773', 'Jl. Jamin Ginting Gg. Pelita Sempit', 'P', 'Terdaftar', '2021-06-02 08:12:08'),
(4, 'Meina Lisa', 'meinalisa02@gmail.com', '085260498159', 'cf783ba9c8eb3f9897030e44617ad3de368f47d6', 'Delitua Gg. Gedek', 'P', 'Terdaftar', '2021-05-25 11:27:32'),
(5, 'Fildzah Alifia Lubis', 'fildzah.alifia01@gmail.com', '082275878876', '133f2fff7adb9879b61859de7041ed80a89a9f24', 'Jl. Prof HM. Yamin SH. Gg. Kelambir', 'P', 'Dihapus', '2021-06-19 21:41:11'),
(6, 'Alya Syafitri', 'alyasyafitri@outlook.com', '082166924912', '700fcb439cc63d7caa63f21ee8daff740a4330c3', 'Jl. SM. Raja km. 6,1 Medan', 'P', 'Terdaftar', '2021-06-08 07:12:32'),
(7, 'Ibnu Hafidz', 'ibnuhafidz@gmail.com', '085272998875', '7299f6b82836ddf8633aadb7848ed5c5776f0047', 'Desa Namo Tualang Biru-Biru Gg. Mulia', 'L', 'Terdaftar', '2021-05-31 07:12:32'),
(8, 'Indri Sari', 'indrisari18@gmail.com', '082262955811', '86c40dfda64f0f8d9d522d472f358c655373aae4', 'Perumahan Monaco Sidodadi No. 23A', 'P', 'Terdaftar', '2021-06-01 10:12:32'),
(9, 'Alfariz Usman', 'usmanalfariz@gmail.com', '087742963174', '12ee9f367f379af3f1a86ffa1932cced1b0ff62c', 'Jl. Pertahanan Gg. Keluarga Patumbak', 'L', 'Terdaftar', '2021-06-06 08:12:32'),
(10, 'Hasnah Nurul', 'hasnahnurull@gmail.com', '083117715071', '2c577aed3118da08c041a7886dac1a7519f5453c', 'Jl. Stasiun Gg. Mawar No. 12', 'P', 'Dihapus', '2021-06-19 23:52:03'),
(11, 'Regatama Ginting', 'regaginting@gmail.com', '081305617079', '6f6c7a098269de4ad1588b1820f471f28f54765d', 'Jl. Pahlawan Ujung No.35', 'L', 'Terdaftar', '2021-06-08 09:12:32'),
(12, 'Reza Fadlan', 'reza.fadlan@gmail.com', '089527488241', 'c2c035fdf6170d48dc1f0d129776bf2ca17b1a72', 'Jl. Biru Psr 6 Armed No. 127', 'L', 'Dihapus', '2021-06-03 14:12:32'),
(13, 'Riski Adha', 'riskiiadha@gmail.com', '081942969020', '51923a3a270cf965bf7e140b14f38cf94bcb0a45', 'Jl. Karya Jaya No. 48 Medan', 'L', 'Terdaftar', '2021-06-15 13:12:32'),
(14, 'Yossy Harahap', 'yosiegraciella03@gmail.com', '083854230521', '8d82bcd15cb9f7c85a45326607f9f6cd200d91da', 'Jl. Rela Gg. Wakaf Talun Kenas', 'P', 'Terdaftar', '2021-06-11 15:12:32'),
(15, 'Sabilla Salima', 'salimaa5799@gmail.com', '081203816435', '41efc53ced40d1bc6d6dfcd4185a7ac2e835d321', 'Jl. Brigjend. Zein Hamid Gg. Antara', 'P', 'Terdaftar', '2021-05-28 12:33:32'),
(16, 'Farhan Kelana', 'farhannkelkel@gmail.com', '082313228184', '76b6aa5a388456c87bfbf513b5d8e4f3c423badd', 'Jl. Ardagusema Gg. Makmur', 'L', 'Terdaftar', '2021-06-14 12:12:32'),
(17, 'Novita Sari', 'novitasari41@gmail.com', '087759231863', '4023e0ee6dfcb43fb0fa058ef81a95bd459e9243', 'Jl. Pembela Gg. Anggrek No. 41', 'P', 'Terdaftar', '2021-06-03 09:12:32');

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
(1, 'Panti Asuhan Puteri Aisyiyah', 'puteriaisyiyah@gmail.com', NULL, '8f315d491f7abd6d8cc7a057b3994688bc92db1e', NULL, NULL, NULL, NULL, 1, 1),
(2, 'Dinda Julia Putri', 'dindajuliap30@gmail.com', '082388373276', 'a3f184733ccecf3b36fdeb97588778f0ee2a6a49', 'Jl. Belibis 9 No. 127', 'Banda Aceh', '2001-07-30', 'P', 2, 1),
(3, 'Milpa Wahyuni Siregar', 'milpawahyuni771@gmail.com', '081277681539', '55362e127cbc07df525a7faf8dc2962774972773', 'Jl. Jamin Ginting Gg. Pelita Sempit', 'Napa', '2001-06-23', 'P', 2, 1),
(4, 'Meina Lisa', 'meinalisa02@gmail.com', '085260498159', 'cf783ba9c8eb3f9897030e44617ad3de368f47d6', 'Delitua Gg. Gedek', 'Medan', '2002-04-09', 'P', 2, 1),
(5, 'Fildzah Alifia Lubis', 'fildzah.alifia01@gmail.com', '082275878876', '133f2fff7adb9879b61859de7041ed80a89a9f24', 'Jl. Prof HM. Yamin SH. Gg. Kelambir', 'Medan', '2001-08-27', 'P', 2, 0),
(6, 'Alya Syafitri', 'alyasyafitri@outlook.com', '082166924912', '700fcb439cc63d7caa63f21ee8daff740a4330c3', 'Jl. SM. Raja km. 6,1 Medan', 'Medan', '2001-11-26', 'P', 2, 1),
(7, 'Ibnu Hafidz', 'ibnuhafidz@gmail.com', '085272998875', '7299f6b82836ddf8633aadb7848ed5c5776f0047', 'Desa Namo Tualang Biru-Biru Gg. Mulia', 'Biru-biru', '2001-03-15', 'L', 2, 1),
(8, 'Indri Sari', 'indrisari18@gmail.com', '082262955811', '86c40dfda64f0f8d9d522d472f358c655373aae4', 'Perumahan Monaco Sidodadi No. 23A', 'Medan', '2001-08-18', 'P', 2, 1),
(9, 'Alfariz Usman', 'usmanalfariz@gmail.com', '087742963174', '12ee9f367f379af3f1a86ffa1932cced1b0ff62c', 'Jl. Pertahanan Gg. Keluarga Patumbak', 'Berastagi', '2001-09-10', 'L', 2, 1),
(10, 'Hasnah Nurul', 'hasnahnurull@gmail.com', '083117715071', '2c577aed3118da08c041a7886dac1a7519f5453c', 'Jl. Stasiun Gg. Mawar No. 12', 'Bukittinggi', '1999-10-19', 'P', 2, 0),
(11, 'Regatama Ginting', 'regaginting@gmail.com', '081305617079', '6f6c7a098269de4ad1588b1820f471f28f54765d', 'Jl. Pahlawan Ujung No.35', 'Medan', '1995-04-15', 'L', 2, 1),
(12, 'Reza Fadlan', 'reza.fadlan@gmail.com', '089527488241', 'c2c035fdf6170d48dc1f0d129776bf2ca17b1a72', 'Jl. Biru Psr 6 Armed No. 127', 'Medan', '2001-08-13', 'L', 2, 0),
(13, 'Riski Adha', 'riskiiadha@gmail.com', '081942969020', '51923a3a270cf965bf7e140b14f38cf94bcb0a45', 'Jl. Karya Jaya No. 48 Medan', 'Medan', '2000-06-16', 'L', 2, 1),
(14, 'Yossy Harahap', 'yosiegraciella03@gmail.com', '083854230521', '8d82bcd15cb9f7c85a45326607f9f6cd200d91da', 'Jl. Rela Gg. Wakaf Talun Kenas', 'Talun Kenas', '1997-12-03', 'P', 2, 1),
(15, 'Sabilla Salima', 'salimaa5799@gmail.com', '081203816435', '41efc53ced40d1bc6d6dfcd4185a7ac2e835d321', 'Jl. Brigjend. Zein Hamid Gg. Antara', 'Pancur Batu', '1999-07-05', 'P', 2, 1),
(16, 'Farhan Kelana', 'farhannkelkel@gmail.com', '082313228184', '76b6aa5a388456c87bfbf513b5d8e4f3c423badd', 'Jl. Ardagusema Gg. Makmur', 'Riau', '2000-05-11', 'L', 2, 1),
(17, 'Novita Sari', 'novitasari41@gmail.com', '087759231863', '4023e0ee6dfcb43fb0fa058ef81a95bd459e9243', 'Jl. Pembela Gg. Anggrek No. 41', 'Pematang Siantar', '2001-01-04', 'P', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tabel_album`
--

CREATE TABLE `tabel_album` (
  `id_album` int(11) NOT NULL,
  `nama_album` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tabel_album`
--

INSERT INTO `tabel_album` (`id_album`, `nama_album`) VALUES
(1, 'Bantuan'),
(2, 'Kegiatan');

--
-- Triggers `tabel_album`
--
DELIMITER $$
CREATE TRIGGER `trigger_hapus_album` BEFORE DELETE ON `tabel_album` FOR EACH ROW DELETE FROM tabel_foto WHERE id_album = old.id_album
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
  `tgl_lahir_anak` date NOT NULL,
  `jk_anak` enum('L','P') NOT NULL,
  `pendidikan_anak` varchar(50) NOT NULL,
  `tgl_masuk_anak` date NOT NULL,
  `agama_anak` varchar(100) DEFAULT NULL,
  `kewarganegaraan_anak` varchar(100) DEFAULT NULL,
  `alamat_anak` text DEFAULT NULL,
  `anak_ke` int(2) DEFAULT NULL,
  `jlh_saudara_pr` int(2) DEFAULT NULL,
  `jlh_saudara_lk` int(2) DEFAULT NULL,
  `jlh_saudara_tiri` int(2) DEFAULT NULL,
  `status_ortu` enum('Yatim','Piatu','Yatim Piatu','Ekonomi Lemah') DEFAULT NULL,
  `status_anak` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tabel_anak`
--

INSERT INTO `tabel_anak` (`id_anak`, `nama_anak`, `asal_anak`, `tgl_lahir_anak`, `jk_anak`, `pendidikan_anak`, `tgl_masuk_anak`, `agama_anak`, `kewarganegaraan_anak`, `alamat_anak`, `anak_ke`, `jlh_saudara_pr`, `jlh_saudara_lk`, `jlh_saudara_tiri`, `status_ortu`, `status_anak`) VALUES
(1, 'Anita Ade Lestari', 'Medan', '2006-04-21', 'P', 'Sd', '2012-07-13', 'Islam', 'Indonesia', 'Jl. Selamat No. 5', 1, 9, 1, 2, 'Ekonomi Lemah', 1),
(2, 'Inna Yati Fitri', 'Dairi', '2008-06-24', 'P', 'SD', '2015-07-25', 'Islam', 'Indonesia', 'Jl. Rukun No. 20', 4, 2, 1, NULL, 'Ekonomi Lemah', 1),
(3, 'Aqidah Trisna Utami', 'Medan', '2002-07-17', 'P', 'SD', '2010-10-13', 'Islam', 'Indonesia', 'Jl. Pendidikan Gg. Sejahtera No. 8', 2, NULL, 1, NULL, 'Ekonomi Lemah', 0),
(4, 'Mawangi Masitah', 'Meulaboh', '2018-02-07', 'P', 'Belum Bersekolah', '2021-03-24', 'Islam', 'Indonesia', 'Jl. Belibis No. 1', NULL, NULL, NULL, NULL, 'Yatim Piatu', 1),
(5, 'Derina Kito Nasution', 'Medan', '2015-08-05', 'P', 'TK', '2020-11-19', 'Islam', 'Indonesia', 'Jl. Siderujo Hilir No. 82', 1, NULL, NULL, NULL, 'Yatim Piatu', 1),
(7, 'Lisnawati Hasibuan', 'Binjai', '2005-11-29', 'P', 'SD', '2012-06-02', 'Islam', 'Indonesia', 'Jl. Semangka No. 9', 1, 1, 1, NULL, 'Piatu', 1),
(8, 'Siti Syahputri', 'Siblga', '2000-12-15', 'P', 'SD', '2007-02-22', 'Islam', 'Indonesia', NULL, 3, NULL, 2, NULL, 'Yatim Piatu', 0),
(9, 'Moni Bella Sari', 'Medan', '2011-06-06', 'P', 'Belum Bersekolah', '2012-09-02', 'Islam', 'Indonesia', NULL, NULL, NULL, NULL, NULL, 'Yatim Piatu', 1),
(10, 'Wendi Maulinda', 'Tebing Tinggi', '2017-11-04', 'P', 'TK', '2020-06-21', 'Islam', 'Indonesia', 'Jl. Merdeka Gg. Nuri No. 31', 1, 2, 1, 1, 'Ekonomi Lemah', 1);

--
-- Triggers `tabel_anak`
--
DELIMITER $$
CREATE TRIGGER `trigger_hapus_kesehatan` BEFORE DELETE ON `tabel_anak` FOR EACH ROW DELETE FROM tabel_kesehatan WHERE id_anak = old.id_anak
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `trigger_hapus_ortu` BEFORE DELETE ON `tabel_anak` FOR EACH ROW DELETE FROM tabel_ortu WHERE id_anak = old.id_anak
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

--
-- Dumping data for table `tabel_berita`
--

INSERT INTO `tabel_berita` (`id_berita`, `tanggal_berita`, `judul_berita`, `cover_berita`, `isi_berita`) VALUES
(1, '2021-06-13', 'HUT Bhayangkara, Poldasu Bantu 3 Panti Asuhan', 'poldasu.jpg', '<p>Sebagai wujud sinergitas Polri dalam memberikan pelayanan pada masyarakat, Polda Sumut memberikan bantuan kepada 3 panti asuhan di Medan Kegiatan sosial ini juga merupakan salah satu rangkaian kegiatan peringatan ulang tahun ke 70 Polri yang jatuh pada 1 Juli 2016. Wakil Ketua Bhayangkari Poldasu, Ny. Adhi Prawoto didampingi Kabid Humas Poldasu, AKBP Rina Sari Ginting dalam arahannya, Selasa (7/6) mengatakan, bantuan yang diberikan pada anak-anak panti asuhan merupakan bukti bahwa Polri hadir di tengah-tengah masyarakat.</p>\r\n\r\n<p>Pihaknya berharap bantuan ini dapat memberikan manfaat bagi kelangsungan pendidikan untuk anak-anak panti asuhan. &ldquo;Kami datang ke sini untuk berbagi kasih pada adik-adik penghuni panti asuhan. Harapannya apa yang kami berikan bermanfaat dan dapat digunakan sebaik mungkin,&rdquo; jelasnya.</p>\r\n\r\n<p>Tiga panti asuhan yang dikunjungi rombongan Wakil Ketua Bhayangkara yakni Panti Asuhan Putri Aisyiyah Jalan Santun nomor 17 Teladan Medan, Panti Asuhan Bait Allah Jalan Binjai km 7,5 Medan dan Panti Asuhan Yayasan Setia SLB-C Karya Tulus Tuntungan. Kabih Humas Poldasu, AKBP Rina Sari Ginting mengatakan, polisi ada dan hadir untuk melayani masyarakat. Namun, dalam menjalankan tugas harus ada kerjasama dan sinergitas pada semua lapisan masyarakat.</p>\r\n\r\n<p>&ldquo;Kami sangat terbuka untuk memberikan pelayanan pada masyarakat. Kami juga berharap pada masyarakat bisa menyampaikan saran dan harapan melalui tugas pokok dan fungi Polri,&rdquo; jelas Kabid Humas.</p>\r\n\r\n<p>Sementara, mewakili pimpinan Panti Asuhan Putri Aisyiyah, Hj Zulbaidah mengatakan, pihaknya sangat berterimakasih kepada Poldasu karena telah memilih panti asuhan yang sudah beroperasi sejak tahun 1969 ini. Di panti asuhan yang mereka kelola ini setidaknya ada 100 anak perempuan dari berbagai latar belakang dan wilayah.</p>\r\n\r\n<p>&ldquo;Kami sangat berterimakasih karena panti asuhan ini dipilih menjadi salah satu lokasi yang dikunjungi Poldasu. Anak-anak panti asuhan ini berasal dari berbagai daerah seperti Karo, Aceh dan Sumatera Barat. Kami hanya akan menampung anak-anak yang ingin sekolah saja,&rdquo; tandasnya.</p>'),
(2, '2021-06-14', 'Honda Arista Berbagi Bersama Anak Yatim', 'HONDA.jpg', '<p>Di Bulan Ramadan 1440 Hijriah, Honda Arista Grup menggelar berbuka puasa bersama 40 anak yatim piatu di Medan. Kegiatan ini dihadiri langsung Kepala Cabang Honda Arista Grup, Suandy Wijaya berserta seluruh karyawan Honda Arista Grup. Acara berbuka puasa bersama ini digelar di Showroom Honda di Jalan Sisingamangaraja Medan, Selasa (28/5) kemarin.</p>\r\n\r\n<p>Kegiatan ini, bertujuan sebagai kepedulian Honda Arista kepada puluhan anak yatim piatu berasal dari Panti Asuhan Putri Aisyiyah dan Panti Asuhan Putra Ar-Ridho di Medan.</p>\r\n\r\n<p>Selain berbuka puasa bersama, acara diisi dengan tausyiah oleh Ustad Drs. Asrul Siregar MA dan pemberian santunan kepada puluhan anak yatim piatu berupa perlengkapan sekolah, uang tunai dan sembako.</p>\r\n\r\n<p>&ldquo;Kegiatan berbuka puasa bersama ini, sebagai wujud kepedulian Honda Arista kepada adik-adik dan apa kita berikan dapat digunakan dengan baik dan mendapatkan berkah,&rdquo; ucap Kepala Cabang Honda Arista Grup, Suandy Wijaya.</p>'),
(3, '2021-06-15', 'Wabup Rohil Meresmikan Perpustakaan Panti Asuhan Putri Aisyiyah', 'perpustakaan.jpg', '<p>Wakil Bupati Rokan Hilir (Wabup) Drs H. Jamiludin menghadiri acara penyerahan bantuan kepada Panti Asuhan Putri Aisyiyah oleh pengusaha dari Kota Medan pasangan Erwin Halim dan Darwati kesuma, Kamis-(6/10/17).</p>\r\n\r\n<p>Hadir di acara penyerahan bantuan berbentuk sembako, buku perpustakaan untuk kebutuhan anak anak panti yaitu Kadisdikbud, HM.Rusli Syarief,S.Sos, Anggota DPRD Provinsi Riau, Siswaja Mulyadi, para pejabat tinggi pratama dilingkungan pemdakab Rohil beserta rombongan perusahaan Super Net Nusantara. Puluhan orang anak-anak panti yang terdiri dari anak yatim dan piatu itu tampak begitu antusias menyambut kedatangan Wabup dan rombongan para dermawan itu.</p>\r\n\r\n<p>Diacara itu, Wabup juga berkesempatan meresmikan perpustakaan Panti Asuhan Putri Aisyiyah yang dibawah naungan Muhammadiyah tersebut. Selain menerima bantuan sembako, Panti Asuhan Putri Aisyiyah juga menerima buku-buku bacaan dari Anggota DPRD Provinsi Riau, Siswaja Mulyadi.</p>\r\n\r\n<p>Dalam sambutannya, Wabup menyampaikan bahwa berdasarkan Undang-undang RI Negara bertanggungjawab terhadap fakir miskin dan anak terlantar. &ldquo;Selain Negara, dalam hal ini pemerintah daerah seyogya nya bertanggung jawab atas anak anak kurang mampu, fakir miskin sesuai amanah UUD RI. Maka selayaknya kita berterimakasih dan bersyukur atas perhatian dari kalangan non pemerintah yang telah mau berbagi,&rdquo; Kata Jamiludin.</p>\r\n\r\n<p>Menurutnya, selama ini kita mengenal pengusaha Baut dari jakarta yang dermawan, dan sekarang ditambah lagi pengusaha keturunan tionghoa dari Medan yang tergabung dalam wadah Supernet Nusantara,&rdquo; Ungkapnya.</p>\r\n\r\n<p>&ldquo;Kita berharap akan muncul tokoh tokoh lainnya untuk melakukan hal baik ini,&rdquo; Pungkas Wabup. Darwati kesuma mengatakan, untuk memajukan satu bangsa,dan kualitas bangsa itu tergantung pada kualitas pendidikannya. Makanya pendidikan anak bangsa itu sangat penting,&rdquo; Kata Derwati.</p>\r\n\r\n<p>Perlengkapan perpustakaan yang disumbangkan oleh Super Net itu sudah di tata dan disusun sedemikian rupa supaya anak-anak panti lebih mudah menulis dan membaca. &ldquo;Kita mengadakan perpustakaan, ada meja-meja, agar anak-anak mudah untuk membaca dan menulis. Kemudian dinding perpustakaan sudah di kasi lukisan supaya anak-anak panti bisa lebih nyaman, karena kita ingin menumbuhkan minat baca anak-anak karena apaun ceritanya untuk memajukan kualitas satu bangsa itu bergantung daripada kualitas pendidikan, jadi pendidikan anak bangsa itu sangat penting,&rdquo; Ujarnya.</p>\r\n\r\n<p>Pihaknya berharap agar perpustakaan yang telah di bantu bisa di bermanfaat bagi anak-anak Panti Asuhan Putri Aisyiyah sebagaimana mestinya supaya anak panti bisa lebih cerdas, semakin minat membaca dan kelak berguna bagi nusa dan bangsa, harapnya. Dikatakan Derwati, dalam mendukung kegiatan-kegiatan sosial bukan di Panti Asuhan Putri Aisyiyah saja, pihaknya juga turut memberikan perhatian kepada panti-panti sosial lainnya di Rokan Hilir, pungkasnya.</p>\r\n\r\n<p>Dikesempatan itu, Anggota DPRD Provinsi Riau, Siswaja Mulyadi mengataka bahwa dirinya mempunyai hubungan fiskologis dengan panti, sebelumnya Ia sudah beberapa kali datang ke panti Asuhan Putri Aisyiyah tersebut dalam rangka kegiatan sosial. &ldquo; Saya sering berkoordinasi dengan pihak panti Asuhan Putri Aisyiyah ini, apakah itu membicarakan masalah bantuan, dan masalah operasional panti, itu sering kita koordinasikan, dan kita terus mendukung kegiatan-kegiatan sosial yang ada di Rohil,&rdquo; Kata Siswaja Mulyadi.</p>\r\n\r\n<p>Dia juga menyampaikan bahwa pihaknya selalu membantu, dan bilamana ada keluhan-keluhan atau ada pihak panti ingin mengharapkan bantuan sosial dari pemerintah Provinsi Riau pihaknya siap untuk membantu.</p>\r\n\r\n<p>&ldquo;Sebelumnya kita sudah sampaikan kepada pengurus Panti Asuhan Putri Aisyiyah ini untuk mengajukan proposal, tapi masalahnya saya melihat aturah hibah di undang-undang nomor 23 tahun 2014 itu, disampaikan bahwa yayasan yang bisa menerima hibah harus berbadan hukum Indonesia, sementara Panti Asuhan Putri Aisyiyah ini berada di bawah yayasan Muhammadiyah dan itu yayasan yang berpusat di Jakarta, jadi mereka harus mengurus surat-surat penunjukan perwakilan untuk di daerah dan itu baru bisa di bantu, tapi dibantunya bukan melalui kerekening pantinya tapi ke rekening yayasan Muhammadiyah pusat karena sentralnya di pusat Muhammadiyah&rdquo; Kata Siswaja Mulyadi.</p>\r\n\r\n<p>Dicontohkannya, seperti tahun lalu dirinya sudah pernah mengusahakan bantuan hibah untuk salah satu yayasan yang ada di Rohil, seperti yayasan Al-Ikhlas yang ada Bagan Batu. melalui APBD Provinsi Riau mereka bisa cair 200 juta, kenapa mekanismenya lebih gampang karena yayasan itu berdiiri sendiri di Rohil berpusat di Bagn Batu. Dirinya melihat panti Asuhan Putri Aisyiyah perlu mengurur lagi Administrasi agar mudah mengakomodir bantuan hibah melaui APBD Provinsi Riau, pungkasnya.</p>'),
(4, '2021-06-16', 'Kunjungi Panti Asuhan Aisyiyah, Bobby Nasution Berharap Keberkahan untuk Semua', 'Bobby.jpeg', '<p>Mencari keberkahan menuju pencalonan Walikota Medan, Bobby Nasution bersilaturahmi dengan anak yatim piatu di Panti Asuhan Aisyiyah Putri, Jalan Santun No 17 Teladan, Medan Kota, Selasa (21/7/2020).</p>\r\n\r\n<p>Suami Kahiyang Ayu ini disambut hangat pengurus panti, Zulbaidah dan kader-kader Muhammadiyah. Adalah Dokter Spesialis Obgyn, Ade Taufiq, Sekretaris Fraksi PAN, Edi Syahputra, Direktur PUD Pembangunan, Putrama Alkhairi, Ketua Forum Wilayah Lembaga Sosial Anak-Panti Sosial Asuhan Anak (FW-LKSA-PSAA) Sumut, Rafdinal dan Bendahara Majelis Pemberdayaan Masyarakat (MPM) PP Muhammadiyah, Nasrullah tampak turut berhadir di lokasi.</p>\r\n\r\n<p>Sebelum menyapa anak panti, pengusaha milenial ini bincang-bincang terlebih dahulu dengan pengurus panti di Kantor Pimpinan Daerah Aisyiyah Kota Medan yang juga berada di lingkungan panti.</p>\r\n\r\n<p>Dalam kesempatan ini, pengurus menjelaskan tentang panti yang didirikan salah satu organisasi otonom bagi perempuan Muhammadiyah ini. Di Medan, Panti Asuhan Aisyiyah ada 5 cabang dengan 300 anak asuh. Selain anak asuh yang tinggal di panti, ada juga anak asuh yang dirawat oleh keluarganya.</p>\r\n\r\n<p>Tak lama, Bobby Nasution kemudian dipandu ke aula yang berada di lantai dua gedung. Pengusaha property inipun disambut dengan salam oleh anak-anak panti. Dalam kata sambutannya, Rafdinal sebagai Ketua FW-LKSA-PSAA Sumut mengungkapkan, keberhasilan seseorang merupakan takdir Tuhan. &ldquo;Jika Bobby ditakdirkan untuk Medan, sebesar dan sekeras apapun dihalangi, pasti akan memimpin Medan. Begitu juga sebaliknya,&rdquo; ucap Wakil Ketua GNPF-Ulama Sumut ini.</p>\r\n\r\n<p>Karenanya, sambung dia, ikhtiar dan doa penting dilakukan. Salah satu bentuk ikhtiar yang disarankannya adalah menyantuni anak yatim dan anak panti asuhan. &ldquo;Karena salah satu keberkahan di dalam menjalani kehidupan, ketika kita peduli dengan anak yatim di panti asuhan,&rdquo; tuturnya.</p>\r\n\r\n<p>Sesuai jargon #KolaborasiMedanBerkah, lanjut sosok yang akrab disapa Buya ini, Bobby Nasution akan mendapatkan keberkahan dalam memimpin Medan ketika peduli dengan anak yatim. &ldquo;Biasanya, doa anak yatim akan makbul. Yang penting ikhlas dan memperhatikan anak yatim, pasti akan didoakan,&rdquo; urainya.</p>\r\n\r\n<p>Di kesempatan ini Rafdinal juga mengaku miris melihat minimnya perhatian Pemko Medan kepada panti asuhan. Disebutkannya, ada sebanyak 46 panti asuhan di Kota Medan. Sayangnya, Dinas Sosial Kota Medan hanya menganggarkan Rp200 juta/tahun untuk ke-46 panti asuhan. Padahal, APBD Kota Medan mencapai Rp6 triliun. Untuk itu, Rafdinal berharap Bobby Nasution tidak melupakan anak yatim dan orang miskin saat memimpin Kota Medan nantinya. Sehingga keberkahan pun selalu menghampiri.</p>\r\n\r\n<p>Sementara itu Bobby Nasution menyampaikan apresiasinya kepada PD Aisyiyah Kota Medan karena berkomitmen merawat dan mengasuh banyak anak yatim piatu. Alumnus S-2 Agribisnis IPB ini pun menyatakan komitmen dan kepeduliannya terhadap masa depan anak-anak. Ini selaras dengan komitmennya menjadikan Medan Berkah.</p>\r\n\r\n<p>&ldquo;Saya ucapkan terima kasih atas sambutan yang luar biasa kepada saya dan teman-teman. Mudah-mudahan kedatangan saya ke sini (panti asuhan, red) bisa membawa keberkahan bagi semuanya. Dan perjuangan kami bisa mendapat keberkahan dari Allah SWT,&rdquo; ucap ayah dari Sedah Mirah Nasution ini.</p>\r\n\r\n<p>Dengan visi #KolaborasiMedanBerkah, Bobby berharap dapat memberikan perubahan lebih baik di Kota Medan. Lantaran menurut dia, perkembangan Medan masih bisa lebih baik lagi, sepanjang kolaborasi terjalin bagus.</p>\r\n\r\n<p>&ldquo;Kurang baiknya Medan, mungkin karena kurangnya perhatian pada anak panti asuhan, sehingga kurang keberkahan. Keberkahan ini, kami harapkan bisa kami dapatkan dari anak panti. Sehingga keberkahan Kota Medan bisa lebih besar lagi,&rdquo; tandasnya.</p>'),
(5, '2021-06-17', 'Bulan Ramadan, PDIP Sumut Serahkan Bingkisan untuk Empat Panti Asuhan', 'PDIP.jpg', '<p>DPD PDIP Sumut serahkan bingkisan tali asih kepada empat panti asuhan di Medan, Minggu (10/6/2018).</p>\r\n\r\n<p>Kegiatan sosial ini digelar dalam rangka Bulan Ramadan 1439 Hijriah. Bingkisan berupa bahan-bahan pokok ini diserahkan secara simbolis oleh Ketua DPD PDIP Sumut Japorman Saragih kepada Wakil Ketua DPD PDIP Sumut Meinarty Rehulina Bangun dan ustaz Syahrul Ependi Siregar. Kata Japorman, kegiatan semacam ini rutin digelar partainya tiap Bulan Ramadan.</p>\r\n\r\n<p>&quot;Bantuan yang diserahkan kepada empat panti asuhan ini sebagai wujud kepedulian unsur pengurus di DPD PDIP Sumut berbagi kasih. Kita berharap bantuan tersebut bermanfaat bagi anak-anak asuh yang berada di panti asuhan,&quot; ujar Japorman.</p>\r\n\r\n<p>Empat panti asuhan yang memeroleh bingkisan tersebut yakni Yayasan Al- Ikhlasiah Ispensyah Panti Asuhan Zahra Jalan Flamboyan III Tanjung Selamat, Panti Asuhan Yayasan Amal Al-Washliyah Jalan Karya Jaya Medan Johor, Panti Asuhan Putri Aisyiyah Jalan Santun Medan dan Panti Asuhan Al Jami&#39;atul Washliyah Jalan Ismaliyah Medan.</p>\r\n\r\n<p>Sementara itu, ustaz Syahrul Ependi Siregar yang didampingi Wakil Ketua DPD PDIP Sumut Meinarty Rehulina Bangun mengatakan, kegiatan sosial ini tak lain merupakan bentuk silaturahmi serta kepedulian antara sesama.</p>\r\n\r\n<p>&quot;Kegiatan sosial ini semata-mata berbagi kasih dan bersilaturahmi dengan para penghuni di Panti Asuhan. Semoga silaturahmi yang dijalin selama ini tetap berlangsung hingga tahun-tahun mendatang. Tentunya atas rido dan berkah Allah SWT,&quot; ujar ustaz Syahrul.</p>'),
(6, '2021-06-18', '100 Anak Berbagi Cerita dengan Wali Kota', '100anak.jpg', '<p>Sekitar 100 anak dari tiga panti asuhan di Kota Medan berkesempatan bertemu langsung dengan Wali Kota Medan Dzulmi Eldin pada kegiatan silaturahim gagasan komunitas Pejuang Sedekah Mandiri (PSM) di Pendopo Rumah Dinas Wali Kota Medan, kemarin.</p>\r\n\r\n<p>Ketiga panti asuhan itu adalah Putri Aisyiyah, Bani Adam, dan Darul Aitam. Selain bertatap muka dan berdialog dengan Eldin pada kegiatan bertema &ldquo;Anak Yatim Bersama Sang Tokoh&rdquo; itu, penghuni panti asuhan yang belum memiliki akta kelahiran dan hadir pada kegiatan itu dijanjikan pengurusannya oleh Eldin melalui Kepala Bagian (Kabag) Agama dan Pendidikan Kota Medan Sekretariat Daerah Kota (Setdako) Medan, Ilyas, dan Dinas Kependudukan dan Catatan Sipil (Disdukcapil) Kota Medan.</p>\r\n\r\n<p>&ldquo;Berapa jumlah anak panti yang belum memiliki akta kelahiran di sini? Tolong Pejuang Sedekah Mandiri untuk berkoordinasi dengan Kabag Agama agar nanti dibuatkan akta kelahirannya pada Disdukcapil,&rdquo; kata Eldin.</p>\r\n\r\n<p>Para anak panti asuhan juga sempat berdialog dengan orang nomor satu di pemerintahan Kota Medan itu. Dengan tingkah polos walau agak malu-malu, beberapa anak mengajukan beberapa pertanyaan. Misalnya ada yang bertanya &ldquo;Enak atau tidak menjadi wali kota&rdquo;, ajakan mengunjungi panti asuhan hingga pertanyaan &ldquo;Apakah Bapak pernah tinggal di panti asuhan?&rdquo;</p>\r\n\r\n<p>Eldin pun meladeni semua pertanyaan anak-anak panti asuhan itu. &ldquo;Kadang enak kadang tidak. Jadi wali kota terkadang tidak punya waktu untuk kelurga karena pelayanan kepada masyarakat. Tapi harus diingat, apapun yang kita lakukan, kita harus mensyukuri Dalam hidup, banyak yang akan kita lalui, tetapi yang paling penting itu adalah apa yang bisa kita perbuat, tanpa memandang siapa kita, tetapi kita bisa dipandang dengan apa yang kita perbuat,&rdquo; ujarnya menasihati.</p>\r\n\r\n<p>Eldin juga berpesan kepada anak-anak panti asuhan untuk terus belajar, tidak hanya dari sekolah, tetapi juga menimba pelajaran lewat orang lain. Eldin juga mengapresiasi kegiatan yang dilakukan Komunitas PSM yang terus memberikan manfaat dan menebar kebajikan kepada sesama.</p>\r\n\r\n<p>Tidak hanya Eldin yang hadir pada kegiatan itu, namun beberapa tokoh, seperti Anggota DPRD Kota Medan Ilhamsyah, Kepala Bidang Pemberdayaan Masyarakat (Kabid Pemmas) BNN Sumut Safwan Khayat yang turut memberikan penjelasan tentang bahaya narkoba.</p>\r\n\r\n<p>Dzulmi Eldin juga memberikan bingkisan dan uang kepada masing-masing anak yang dilakukan secara simbolis. Kegiatan itu juga diisi dengan tausiah oleh ustad Muhammad Iqbal, serta kegiatan interaktif lainnya, seperti kuis dengan hadiah menarik bagi anak-anak yang bisa menjawab pertanyaan dengan benar.</p>\r\n\r\n<p>Kegiatan itu diakhiri dengan salat zuhur berjamaah dan makan siang. Perwakilan PSM, Arif Dermawan mengatakan, kegiatan bertema &ldquo;Anak Yatim Bersama Sang Tokoh&rdquo; itu merupakan kegiatan perdana selain aneka kegiatan kemanusiaan yang dijalankan komunitas non-profit tersebut setiap bulannya.</p>\r\n\r\n<p>&ldquo;Kegiatan ini pertama kali kami lakukan dan ke depannya kami berencana untuk melakukan kegiatan serupa dengan mempertemukan tokoh-tokoh Sumut dan Medan. Ada beberapa tokoh yang sudah memberikan respon terkait kegiatan ini,&rdquo; kata Arif.</p>');

-- --------------------------------------------------------

--
-- Table structure for table `tabel_donasi`
--

CREATE TABLE `tabel_donasi` (
  `id_donasi` int(11) NOT NULL,
  `nama_donatur` varchar(100) NOT NULL,
  `jumlah_donasi` varchar(50) NOT NULL,
  `jenis_donasi` varchar(50) NOT NULL,
  `ket_donasi` text DEFAULT NULL,
  `bukti_tf` varchar(100) DEFAULT NULL,
  `tgl_donasi` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tabel_donasi`
--

INSERT INTO `tabel_donasi` (`id_donasi`, `nama_donatur`, `jumlah_donasi`, `jenis_donasi`, `ket_donasi`, `bukti_tf`, `tgl_donasi`) VALUES
(1, 'Dinda Julia Putri', '10 Kg', 'Beras', '', NULL, '2021-05-20'),
(2, 'Meina Lisa', 'Rp. 100.000', 'Uang', '', 'donasi8.jpg', '2021-05-04'),
(3, 'Fildzah Alifia Lubis', '10 Kg', 'Beras', '', NULL, '2021-02-02'),
(4, 'Milpa Wahyuni Siregar', 'Rp. 200.000', 'Uang', 'Sedekah', 'donasi13.jpg', '2021-06-09'),
(5, 'Alya Syafitri', 'Rp. 500.000', 'Uang', 'Nazar', 'donasi31.jpg', '2021-06-09'),
(6, 'Marlina Halim', '10 Kg Gula', 'Sembako', '', NULL, '2021-06-05'),
(7, 'Ralin Misara', 'Rp. 700.000', 'Uang', 'Berbagi', 'donasi41.JPG', '2021-06-05'),
(8, 'Yunus Azuhri', 'Rp. 1.000.000', 'Uang', 'Sedekah', 'donasi51.jpg', '2021-05-04'),
(9, 'Reza Muhammad', 'Rp. 600.000', 'Uang', 'Sedekah', 'donasi61.jpg', '2021-05-04');

-- --------------------------------------------------------

--
-- Table structure for table `tabel_donatur`
--

CREATE TABLE `tabel_donatur` (
  `id_donatur` int(11) NOT NULL,
  `nama_donatur` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tabel_donatur`
--

INSERT INTO `tabel_donatur` (`id_donatur`, `nama_donatur`) VALUES
(1, 'Dinda Julia Putri'),
(2, 'Meina Lisa'),
(3, 'Fildzah Alifia Lubis'),
(4, 'Milpa Wahyuni Siregar'),
(5, 'Alya Syafitri'),
(6, 'Marlina Halim'),
(7, 'Ralin Misara'),
(8, 'Yunus Azuhri'),
(9, 'Reza Muhammad');

-- --------------------------------------------------------

--
-- Table structure for table `tabel_foto`
--

CREATE TABLE `tabel_foto` (
  `id_foto` int(11) NOT NULL,
  `id_album` int(11) NOT NULL,
  `file_foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tabel_foto`
--

INSERT INTO `tabel_foto` (`id_foto`, `id_album`, `file_foto`) VALUES
(1, 1, '1.jpg'),
(2, 1, '2.jpg'),
(3, 1, 'Bobby.jpeg'),
(4, 1, 'DAAITV.png'),
(5, 1, 'HONDA.jpg'),
(6, 2, 'acara1.jpg'),
(7, 2, 'acara2.jpg'),
(8, 2, 'acara3.jpg');

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
-- Dumping data for table `tabel_inventaris`
--

INSERT INTO `tabel_inventaris` (`id_inventaris`, `nama_inventaris`, `inventaris_lantai`, `jumlah_inventaris`) VALUES
(1, 'Lapangan Olahraga', 1, 1),
(2, 'Kantor PDA Kota Medan', 1, 1),
(3, 'Kantor Pimpinan Panti Asuhan', 1, 1),
(4, 'Kantor Tata Usaha / Administrasi', 1, 1),
(5, 'Ruang Istirahat Pengurus', 1, 1),
(6, 'Gudang Alat-Alat', 1, 1),
(7, 'Gudang Pangan', 1, 1),
(8, 'Ruang Tidur Anak', 1, 4),
(9, 'Lemari Anak', 1, 4),
(10, 'Ruang Makan', 1, 1),
(11, 'Ruang Belajar', 1, 4),
(12, 'Ruang Dapur / Tempat Masak', 1, 1),
(13, 'Ruang Kamar Mandi / WC ', 1, 12),
(14, 'Garasi', 1, 1),
(15, 'Mobil', 1, 1),
(16, 'Rumah Sewa ', 1, 4),
(17, 'Komputer', 1, 2),
(18, 'Ruang Keterampilan Menjahit', 2, 1),
(19, 'Ruang Perpustakaan', 2, 1),
(20, 'Aula Pertemuan', 2, 1),
(21, 'Mushalla', 2, 1),
(22, 'Ruang Rapat / Sidang', 2, 1),
(23, 'Gudang Sandang', 2, 1),
(24, 'Gudang Peralatan', 2, 1),
(25, 'Gudang Pakaian Layak Pakai', 2, 1),
(26, 'Tempat Penjemuran', 1, 1),
(27, 'Ruang Kamar Mandi / WC', 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tabel_kesehatan`
--

CREATE TABLE `tabel_kesehatan` (
  `id_kesehatan` int(11) NOT NULL,
  `id_anak` int(11) NOT NULL,
  `bb_anak` int(3) NOT NULL,
  `tb_anak` int(3) NOT NULL,
  `goldar_anak` enum('O','A','B','AB') DEFAULT NULL,
  `penyakit_bawaan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tabel_kesehatan`
--

INSERT INTO `tabel_kesehatan` (`id_kesehatan`, `id_anak`, `bb_anak`, `tb_anak`, `goldar_anak`, `penyakit_bawaan`) VALUES
(1, 1, 23, 122, 'B', ''),
(2, 2, 23, 119, 'AB', 'Sinusitis'),
(3, 3, 28, 123, 'B', NULL),
(4, 4, 40, 150, 'AB', 'Alergi Ayam'),
(5, 5, 18, 87, 'O', NULL),
(7, 7, 22, 109, 'A', NULL),
(8, 8, 26, 125, 'B', 'Asma'),
(9, 9, 18, 92, 'B', 'Penyakit Jantung'),
(10, 10, 22, 120, 'O', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tabel_ortu`
--

CREATE TABLE `tabel_ortu` (
  `id_ortu` int(11) NOT NULL,
  `id_anak` int(11) NOT NULL,
  `nama_ayah` varchar(100) DEFAULT NULL,
  `umur_ayah` int(3) DEFAULT NULL,
  `nama_ibu` varchar(100) DEFAULT NULL,
  `umur_ibu` int(3) DEFAULT NULL,
  `pekerjaan_ayah` varchar(100) DEFAULT NULL,
  `pendidikan_ayah` varchar(100) DEFAULT NULL,
  `pekerjaan_ibu` varchar(100) DEFAULT NULL,
  `pendidikan_ibu` varchar(100) DEFAULT NULL,
  `alamat_ortu` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tabel_ortu`
--

INSERT INTO `tabel_ortu` (`id_ortu`, `id_anak`, `nama_ayah`, `umur_ayah`, `nama_ibu`, `umur_ibu`, `pekerjaan_ayah`, `pendidikan_ayah`, `pekerjaan_ibu`, `pendidikan_ibu`, `alamat_ortu`) VALUES
(1, 1, 'Budi Beno', 36, 'Nani Saroh', 33, 'Petani', 'SMP', 'Berjualan Kue', 'SMP', 'Jl. Selamat No. 5'),
(2, 2, 'Joko Surijo', 39, 'Medinah Sofi', 38, 'Tukang Becak', 'SD', 'Ibu Rumah Tangga', 'SMP', 'Jl. Rukun No. 20'),
(3, 3, 'Memet Nuro', 32, 'Dewina May Lusi', 30, 'Berjualan Bakso', 'SMP', NULL, NULL, 'Jl. Pendidikan Gg. Sejahtera No. 8'),
(4, 4, 'Joni Ravi', 45, 'Zaski Mona', 40, '', NULL, '', NULL, ''),
(5, 5, 'Pandi Gunawan Nasution', 31, 'Cika Nevi Putri', 32, NULL, NULL, NULL, NULL, 'Jl. Siderujo Hilir No. 82'),
(7, 7, 'Dodit Tono Hasibuan', 42, NULL, NULL, 'Semir Sepatu', 'SD', NULL, NULL, 'Jl. Semangka No. 9'),
(8, 8, 'Samsuddin', 41, 'Fentika Sari', 37, NULL, NULL, NULL, NULL, NULL),
(9, 9, 'Diki Kurniawan', 33, 'Dessi Atika', 31, NULL, 'SMA', NULL, 'SMA', NULL),
(10, 10, NULL, NULL, 'Reskita Gita', 41, NULL, NULL, 'Pedagang Asongan', 'SMP', 'Jl. Merdeka Gg. Nuri No. 31');

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
(3, 'Password ', '8f315d491f7abd6d8cc7a057b3994688bc92db1e'),
(4, 'Telepon ', '(061) 7863466'),
(6, 'Ketua', 'Zulbaidah, BA'),
(7, 'Nama Panti', 'Panti Asuhan Puteri Aisyiyah'),
(8, 'Foto Panti', 'profil.jpeg');

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

--
-- Dumping data for table `tabel_pengurus`
--

INSERT INTO `tabel_pengurus` (`id_pengurus`, `nama_pengurus`, `tmpt_lahir_pengurus`, `tgl_lahir_pengurus`, `jk_pengurus`, `pendidikan_pengurus`, `alamat_pengurus`, `nomorhp_pengurus`, `jabatan_pengurus`, `periode_kepengurusan`, `status_pengurus`) VALUES
(1, 'Hj. Zulbaidah, Ba', 'Pariaman', '1957-10-13', 'P', 'S1 Ekonomi', 'Jl. Pelopor No. 12 Belakang Pon Teladan Timur, Kec. Medan Kota', '081397815405', 'Ketua Panti', '2020-2025', 1),
(2, 'Yusnar. B', 'Medan', '1944-09-17', 'P', 'SMA', 'Jl. Turi Gg. Bengkok No.17 Kel. Medan Timur', '081376756213', 'Sekretaris Panti', '2020-2025', 1),
(3, 'Hj. Sofiah', 'Medan', '1958-08-08', 'P', 'SLTA', 'Jl. Kutilang 8 No. 240', '(061) 7538559', 'Bendahara I Panti', '2020-2025', 1),
(4, 'Hj. Mariani HS.', 'Bukit Tinggi', '1945-01-01', 'P', 'SLTA', 'Jl. Tangguk Bongkar X No. 27B', '(061) 735544', 'Bendahara II Panti', '2020-2025', 1),
(5, 'Ida Simbolon', 'Pematang Siantar', '1970-12-15', 'P', 'SLTA', 'Jalan Kuali No. 12', '085364022897', 'Koord. Bidang Pembinaan', '2020-2025', 1),
(6, 'Aisyah', 'Medan', '1961-01-25', 'P', 'SLTA', 'Jalan Mencirim', '089582518338', 'Anggota Bidang Pembinaan', '2020-2025', 1),
(7, 'Rosmiani Silitonga, BA', 'Medan', '1957-03-09', 'P', 'S1 Sastra', 'Jl. Sagu Raya No. 17 Simalingkar', '(061) 836-193', 'Anggota Bidang Pembinaan', '2020-2025', 1),
(8, 'Rosalia Lubis', 'Padang Sidimpuan', '1982-02-11', 'P', 'SLTA', 'Jl. Aluminium No.36', '081165338064', 'Koord. Bidang Usaha', '2020-2025', 1),
(9, 'Ratna Sitanggang', 'Tarutung', '1973-01-29', 'P', 'SLTA', 'Jalan Pand No. 10', '082267370853', 'Anggota Bidang Usaha', '2015-2020', 0),
(10, 'Murniati', 'Pagar Merbau', '1969-06-09', 'P', 'SLTA', 'Jl. Sawah Desa Sukamaju ', '082288487684', 'Koord. Bidang Humas', '2015-2020', 0),
(11, 'Sri Rahmawaty', 'Sidikalang', '1963-08-08', 'P', 'SMA', 'Jalan Duyung No. 20 ', '081338636770', 'Anggota Bidang Humas', '2015-2020', 0);

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
,`nomorhp_user` varchar(13)
,`alamat_user` text
,`tmpt_lahir_user` varchar(100)
,`tgl_lahir_user` date
,`jk_user` enum('L','P')
,`role_id` int(1)
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
,`status_ortu` enum('Yatim','Piatu','Yatim Piatu','Ekonomi Lemah')
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

CREATE ALGORITHM=UNDEFINED DEFINER=`puteriaisyiyah`@`localhost` SQL SECURITY DEFINER VIEW `view_akun`  AS SELECT `a`.`id_user` AS `id_user`, `a`.`nama_user` AS `nama_user`, `a`.`email_user` AS `email_user`, `a`.`nomorhp_user` AS `nomorhp_user`, `a`.`alamat_user` AS `alamat_user`, `a`.`tmpt_lahir_user` AS `tmpt_lahir_user`, `a`.`tgl_lahir_user` AS `tgl_lahir_user`, `a`.`jk_user` AS `jk_user`, `a`.`role_id` AS `role_id`, `l`.`waktu_log_akun` AS `waktu_log_akun`, `l`.`status_user` AS `status_user` FROM (`tabel_akun` `a` join `log_akun` `l` on(`a`.`email_user` = `l`.`email_user`)) ;

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
-- Indexes for table `jenis_donasi`
--
ALTER TABLE `jenis_donasi`
  ADD PRIMARY KEY (`id_jenis_donasi`);

--
-- Indexes for table `log_akun`
--
ALTER TABLE `log_akun`
  ADD PRIMARY KEY (`id_log`),
  ADD UNIQUE KEY `email_user` (`email_user`,`nomorhp_user`);

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
-- Indexes for table `tabel_donatur`
--
ALTER TABLE `tabel_donatur`
  ADD PRIMARY KEY (`id_donatur`);

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
-- AUTO_INCREMENT for table `jenis_donasi`
--
ALTER TABLE `jenis_donasi`
  MODIFY `id_jenis_donasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `log_akun`
--
ALTER TABLE `log_akun`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tabel_akun`
--
ALTER TABLE `tabel_akun`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tabel_album`
--
ALTER TABLE `tabel_album`
  MODIFY `id_album` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tabel_anak`
--
ALTER TABLE `tabel_anak`
  MODIFY `id_anak` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tabel_berita`
--
ALTER TABLE `tabel_berita`
  MODIFY `id_berita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tabel_donasi`
--
ALTER TABLE `tabel_donasi`
  MODIFY `id_donasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tabel_donatur`
--
ALTER TABLE `tabel_donatur`
  MODIFY `id_donatur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tabel_foto`
--
ALTER TABLE `tabel_foto`
  MODIFY `id_foto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tabel_inventaris`
--
ALTER TABLE `tabel_inventaris`
  MODIFY `id_inventaris` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tabel_kesehatan`
--
ALTER TABLE `tabel_kesehatan`
  MODIFY `id_kesehatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tabel_ortu`
--
ALTER TABLE `tabel_ortu`
  MODIFY `id_ortu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tabel_panti`
--
ALTER TABLE `tabel_panti`
  MODIFY `id_biodata` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tabel_pengurus`
--
ALTER TABLE `tabel_pengurus`
  MODIFY `id_pengurus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id_token` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
