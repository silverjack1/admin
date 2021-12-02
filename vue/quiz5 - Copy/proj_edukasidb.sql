-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 30, 2019 at 09:31 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `proj_edukasidb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_npp` varchar(255) DEFAULT NULL,
  `admin_nama` varchar(255) NOT NULL,
  `admin_username` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  `admin_is_delete` int(11) DEFAULT '0',
  `admin_update_by` int(11) DEFAULT NULL,
  `admin_update_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_npp`, `admin_nama`, `admin_username`, `admin_password`, `admin_is_delete`, `admin_update_by`, `admin_update_date`) VALUES
(1, 'ADMINISTRATOR', 'Agus Sumarna', 'kangagus', '1ec9aacf21d135d882d21d63f33752d0', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_bidang_studi`
--

CREATE TABLE `m_bidang_studi` (
  `bds_id` int(11) NOT NULL,
  `bds_ket` varchar(255) NOT NULL,
  `bds_jenjang` int(11) NOT NULL,
  `bds_is_delete` int(11) DEFAULT '0',
  `bds_update_by` int(11) DEFAULT NULL,
  `bds_update_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_bidang_studi`
--

INSERT INTO `m_bidang_studi` (`bds_id`, `bds_ket`, `bds_jenjang`, `bds_is_delete`, `bds_update_by`, `bds_update_date`) VALUES
(1, 'Agama Islam', 4, 0, NULL, NULL),
(2, 'Internet', 4, 0, NULL, NULL),
(3, 'Kimia', 4, 0, NULL, NULL),
(4, 'Ekonomi', 4, 0, NULL, NULL),
(5, 'Tambah Mata Pelajaran', 4, 0, 1, '2019-12-24 16:54:42');

-- --------------------------------------------------------

--
-- Table structure for table `m_jenis_kelamin`
--

CREATE TABLE `m_jenis_kelamin` (
  `jkel_id` int(11) NOT NULL,
  `jkel_ket` varchar(255) NOT NULL,
  `jkel_is_delete` int(11) DEFAULT '0',
  `jkel_update_by` int(11) DEFAULT NULL,
  `jkel_update_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_jenis_kelamin`
--

INSERT INTO `m_jenis_kelamin` (`jkel_id`, `jkel_ket`, `jkel_is_delete`, `jkel_update_by`, `jkel_update_date`) VALUES
(1, 'Laki-Laki', 0, NULL, NULL),
(2, 'Perempuan', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_jenjang`
--

CREATE TABLE `m_jenjang` (
  `jenjang_id` int(11) NOT NULL,
  `jenjang_ket` varchar(255) NOT NULL,
  `jenjang_is_delete` int(11) DEFAULT '0',
  `jenjang_update_by` int(11) DEFAULT NULL,
  `jenjang_update_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_jenjang`
--

INSERT INTO `m_jenjang` (`jenjang_id`, `jenjang_ket`, `jenjang_is_delete`, `jenjang_update_by`, `jenjang_update_date`) VALUES
(1, 'TK', 0, NULL, NULL),
(2, 'SD', 0, NULL, NULL),
(3, 'SMP', 0, NULL, NULL),
(4, 'SMA', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_jurusan`
--

CREATE TABLE `m_jurusan` (
  `jurusan_id` int(11) NOT NULL,
  `jurusan_ket` varchar(255) NOT NULL,
  `jurusan_is_delete` int(11) DEFAULT '0',
  `jurusan_update_by` int(11) DEFAULT NULL,
  `jurusan_update_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_jurusan`
--

INSERT INTO `m_jurusan` (`jurusan_id`, `jurusan_ket`, `jurusan_is_delete`, `jurusan_update_by`, `jurusan_update_date`) VALUES
(1, 'IPA', 0, NULL, NULL),
(2, 'IPS', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_tahun_ajaran`
--

CREATE TABLE `m_tahun_ajaran` (
  `ta_id` int(11) NOT NULL,
  `ta_kode` varchar(255) NOT NULL,
  `ta_tahun1` int(11) NOT NULL,
  `ta_tahun2` int(11) NOT NULL,
  `ta_is_delete` int(11) DEFAULT '0',
  `ta_update_by` int(11) DEFAULT NULL,
  `ta_update_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_tahun_ajaran`
--

INSERT INTO `m_tahun_ajaran` (`ta_id`, `ta_kode`, `ta_tahun1`, `ta_tahun2`, `ta_is_delete`, `ta_update_by`, `ta_update_date`) VALUES
(1, '1011', 2010, 2011, 0, NULL, NULL),
(2, '1112', 2011, 2012, 0, NULL, NULL),
(3, '1213', 2012, 2013, 0, NULL, NULL),
(4, '1314', 2013, 2014, 0, NULL, NULL),
(5, '1415', 2014, 2015, 0, NULL, NULL),
(6, '1516', 2015, 2016, 0, NULL, NULL),
(7, '1617', 2016, 2017, 0, NULL, NULL),
(8, '1718', 2017, 2018, 0, NULL, NULL),
(9, '1819', 2018, 2019, 0, NULL, NULL),
(10, '1920', 2019, 2020, 0, NULL, NULL),
(11, '2021', 2020, 2021, 0, NULL, NULL),
(12, '2122', 2021, 2022, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `siswa_id` int(11) NOT NULL,
  `siswa_nis` varchar(255) NOT NULL,
  `siswa_nama` varchar(255) NOT NULL,
  `siswa_username` varchar(255) NOT NULL,
  `siswa_password` varchar(255) NOT NULL,
  `siswa_tahun` int(11) NOT NULL,
  `siswa_jenjang` int(11) NOT NULL,
  `siswa_kelas` int(11) NOT NULL,
  `siswa_jurusan` int(11) NOT NULL,
  `siswa_kelamin` int(11) NOT NULL,
  `siswa_is_delete` int(11) DEFAULT '0',
  `siswa_update_by` int(11) DEFAULT NULL,
  `siswa_update_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`siswa_id`, `siswa_nis`, `siswa_nama`, `siswa_username`, `siswa_password`, `siswa_tahun`, `siswa_jenjang`, `siswa_kelas`, `siswa_jurusan`, `siswa_kelamin`, `siswa_is_delete`, `siswa_update_by`, `siswa_update_date`) VALUES
(1, 'SIS2017001', 'Muhammad Fattan Imtiyaz', 'siswa001', 'e172dd95f4feb21412a692e73929961e', 7, 4, 12, 1, 1, 0, 1, '2019-02-04 01:17:03'),
(2, 'SIS2017002', 'Indana Naura Imtiyaz', 'siswa002', 'e172dd95f4feb21412a692e73929961e', 7, 4, 12, 1, 2, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ujian_detail`
--

CREATE TABLE `ujian_detail` (
  `uj_id` int(11) NOT NULL,
  `uj_judul` int(11) NOT NULL,
  `uj_soal` int(11) NOT NULL,
  `uj_is_delete` int(11) NOT NULL,
  `uj_update_by` int(11) NOT NULL,
  `uj_update_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ujian_detail`
--

INSERT INTO `ujian_detail` (`uj_id`, `uj_judul`, `uj_soal`, `uj_is_delete`, `uj_update_by`, `uj_update_date`) VALUES
(1, 1, 1, 1, 0, '2017-05-17 11:59:54'),
(2, 1, 2, 1, 0, '2017-05-17 11:59:52'),
(3, 1, 3, 1, 0, '2017-05-17 11:59:48'),
(4, 1, 4, 1, 0, '2017-05-17 11:59:23'),
(5, 1, 5, 1, 0, '2017-05-17 11:48:42'),
(6, 1, 1, 0, 1, '2017-05-17 12:01:33'),
(7, 1, 2, 0, 1, '2017-05-17 12:01:35'),
(8, 1, 3, 0, 1, '2017-05-17 12:01:37'),
(9, 1, 4, 0, 1, '2017-05-17 12:01:39'),
(10, 1, 5, 0, 1, '2017-05-17 12:01:41'),
(11, 2, 6, 0, 1, '2019-01-29 06:19:38'),
(12, 2, 7, 0, 1, '2019-01-29 06:19:44'),
(13, 2, 8, 0, 1, '2019-01-29 06:19:50'),
(14, 2, 9, 0, 1, '2019-01-29 06:19:55'),
(15, 2, 10, 0, 1, '2019-01-29 06:20:01');

-- --------------------------------------------------------

--
-- Table structure for table `ujian_jawab`
--

CREATE TABLE `ujian_jawab` (
  `jawab_id` int(11) NOT NULL,
  `jawab_judul` int(11) NOT NULL,
  `jawab_kode` varchar(255) NOT NULL,
  `jawab_soal` longtext NOT NULL,
  `jawab_submit` longtext NOT NULL,
  `jawab_benar` int(11) NOT NULL,
  `jawab_salah` int(11) NOT NULL,
  `jawab_kosong` int(11) NOT NULL,
  `jawab_nilai` decimal(5,2) NOT NULL,
  `jawab_tgl_mulai` datetime NOT NULL,
  `jawab_tgl_selesai` datetime NOT NULL,
  `jawab_tgl_timer` datetime NOT NULL,
  `jawab_status` enum('Y','N') NOT NULL,
  `jawab_device` varchar(255) NOT NULL,
  `jawab_is_delete` int(11) NOT NULL,
  `jawab_update_by` int(11) NOT NULL,
  `jawab_update_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ujian_judul`
--

CREATE TABLE `ujian_judul` (
  `judul_id` int(11) NOT NULL,
  `judul_tahun` int(11) NOT NULL,
  `judul_tingkat` int(11) NOT NULL,
  `judul_kelas` int(11) NOT NULL,
  `judul_jurusan` int(11) NOT NULL,
  `judul_studi` int(11) NOT NULL,
  `judul_tgl_mulai` date DEFAULT NULL,
  `judul_tgl_selesai` date DEFAULT NULL,
  `judul_jam_mulai` varchar(5) DEFAULT NULL,
  `judul_jam_selesai` varchar(5) DEFAULT NULL,
  `judul_keterangan` text NOT NULL,
  `judul_waktu` int(11) NOT NULL,
  `judul_type` int(11) NOT NULL COMMENT 'soal satuan / semua',
  `judul_mode` int(11) NOT NULL COMMENT 'random soal ujian',
  `judul_acak` int(11) NOT NULL COMMENT 'random pilihan',
  `judul_akses` int(11) NOT NULL COMMENT 'dibuka / ditutup',
  `judul_parent` int(11) NOT NULL DEFAULT '0',
  `judul_token` int(11) NOT NULL DEFAULT '0',
  `judul_is_delete` int(11) NOT NULL,
  `judul_update_date` datetime NOT NULL,
  `judul_update_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ujian_judul`
--

INSERT INTO `ujian_judul` (`judul_id`, `judul_tahun`, `judul_tingkat`, `judul_kelas`, `judul_jurusan`, `judul_studi`, `judul_tgl_mulai`, `judul_tgl_selesai`, `judul_jam_mulai`, `judul_jam_selesai`, `judul_keterangan`, `judul_waktu`, `judul_type`, `judul_mode`, `judul_acak`, `judul_akses`, `judul_parent`, `judul_token`, `judul_is_delete`, `judul_update_date`, `judul_update_by`) VALUES
(1, 2, 4, 12, 0, 1, '2017-05-10', '0000-00-00', '', '', 'Pengetahuan Dasar Islam', 5, 1, 2, 2, 1, 3, 1, 0, '2019-05-04 16:39:52', 1),
(2, 2, 4, 12, 0, 2, '2019-01-29', '0000-00-00', '', '', 'Pengenalan Website', 5, 2, 1, 1, 1, 3, 0, 0, '2019-05-04 14:44:45', 1),
(3, 2, 4, 12, 0, 4, '2019-05-04', '0000-00-00', '', '', 'Ujian Utama Siswa', 0, 1, 1, 1, 1, 0, 0, 0, '2019-05-04 16:37:18', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ujian_materi`
--

CREATE TABLE `ujian_materi` (
  `materi_id` int(11) NOT NULL,
  `materi_ket` varchar(255) NOT NULL,
  `materi_url` varchar(255) NOT NULL,
  `materi_tahun` int(11) NOT NULL,
  `materi_tingkat` int(11) NOT NULL,
  `materi_kelas` int(11) NOT NULL,
  `materi_jurusan` int(11) NOT NULL,
  `materi_studi` int(11) NOT NULL,
  `materi_akses` int(11) NOT NULL DEFAULT '1',
  `materi_parent` int(11) NOT NULL DEFAULT '0',
  `materi_is_delete` int(11) NOT NULL,
  `materi_update_by` int(11) NOT NULL,
  `materi_update_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ujian_materi`
--

INSERT INTO `ujian_materi` (`materi_id`, `materi_ket`, `materi_url`, `materi_tahun`, `materi_tingkat`, `materi_kelas`, `materi_jurusan`, `materi_studi`, `materi_akses`, `materi_parent`, `materi_is_delete`, `materi_update_by`, `materi_update_date`) VALUES
(1, 'Materi Pertama', 'materi_1549217272.jpg', 1, 4, 12, 1, 2, 1, 2, 0, 1, '2019-05-08 15:52:38'),
(2, 'Materi siswa', '', 1, 4, 12, 0, 4, 1, 0, 0, 1, '2019-05-08 15:52:10');

-- --------------------------------------------------------

--
-- Table structure for table `ujian_random`
--

CREATE TABLE `ujian_random` (
  `uj_id` int(11) NOT NULL,
  `uj_judul` int(11) NOT NULL,
  `uj_siswa` int(11) NOT NULL,
  `uj_soal` int(11) NOT NULL,
  `uj_is_delete` int(11) NOT NULL,
  `uj_update_by` int(11) NOT NULL,
  `uj_update_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ujian_soal`
--

CREATE TABLE `ujian_soal` (
  `soal_id` int(11) NOT NULL,
  `soal_tahun` int(11) NOT NULL,
  `soal_tingkat` int(11) NOT NULL,
  `soal_kelas` int(11) NOT NULL,
  `soal_jurusan` int(11) NOT NULL,
  `soal_studi` int(11) NOT NULL,
  `soal_bobot` int(11) DEFAULT NULL,
  `soal_lampiran` varchar(255) DEFAULT NULL,
  `soal_pertanyaan` longtext NOT NULL,
  `soal_opsi_a` longtext NOT NULL,
  `soal_opsi_b` longtext NOT NULL,
  `soal_opsi_c` longtext NOT NULL,
  `soal_opsi_d` longtext NOT NULL,
  `soal_opsi_e` longtext NOT NULL,
  `soal_jawaban` varchar(5) NOT NULL,
  `soal_is_delete` int(11) NOT NULL,
  `soal_update_date` datetime NOT NULL,
  `soal_update_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ujian_soal`
--

INSERT INTO `ujian_soal` (`soal_id`, `soal_tahun`, `soal_tingkat`, `soal_kelas`, `soal_jurusan`, `soal_studi`, `soal_bobot`, `soal_lampiran`, `soal_pertanyaan`, `soal_opsi_a`, `soal_opsi_b`, `soal_opsi_c`, `soal_opsi_d`, `soal_opsi_e`, `soal_jawaban`, `soal_is_delete`, `soal_update_date`, `soal_update_by`) VALUES
(1, 2, 4, 12, 0, 1, 0, '', '<p>Zakat merupakan ketentuan Allah yang berhubungan dengan...</p>', '<p>Harta benda</p>', '<p>Jasmani</p>', '<p>Jiwa</p>', '<p>Kedudukan</p>', '<p>Rohani</p>', 'A', 0, '2019-01-30 00:47:48', 1),
(2, 2, 4, 12, 0, 1, 0, '', '<p>Perbuatan riya dapat dikatakan sebagai...</p>', '<p>Nifak</p>', '<p>Zalim</p>', '<p>Hasad</p>', '<p>Kekafiran</p>', '<p>Syirik kecil</p>', 'E', 0, '2019-01-30 00:48:14', 1),
(3, 2, 4, 12, 0, 1, 0, '', '<p>Berbuat buruk adalah aktualisasi dari...</p>', '<p>Hasil kerja iblis</p>', '<p>Lingkaran syeitan</p>', '<p>Perbuatan makhluk gaib</p>', '<p>Sifat manusia</p>', '<p>Lemahnya iman</p>', 'E', 0, '2019-01-30 00:48:34', 1),
(4, 2, 4, 12, 0, 1, 0, '', '<p>Meninggalkan shalat adalah contoh perbuatan...</p>', '<p>Zalim</p>', '<p>Diskriminasi</p>', '<p>Riya</p>', '<p>Sumah</p>', '<p>Aniaya</p>', 'A', 0, '2019-01-30 00:48:55', 1),
(5, 2, 4, 12, 0, 1, 0, '', '<p>Diskriminasi adalah...</p>', '<p>Iri</p>', '<p>Melampui batas</p>', '<p>Perbedaan perlakuan</p>', '<p>Takabur</p>', '<p>Tinggi hati</p>', 'C', 0, '2019-01-30 00:49:13', 1),
(6, 2, 4, 12, 0, 2, 0, NULL, '<p>Apa kepanjangan dari WWW ?</p>', '<p>World Wide Web</p>', '<p>Wide World Web</p>', '<p>Web Wide World</p>', '<p>World Web Wide</p>', '<p>Web World Wide</p>', 'A', 0, '2019-01-30 00:51:17', 1),
(7, 2, 4, 12, 0, 2, 0, NULL, '<p>Apa Fungsi atribut \"align\" dalam HTML ?</p>', '<p>Mengatur panjang</p>', '<p>Tebal garis tepi</p>', '<p>Perataan tabel</p>', '<p>Mengatur lebar</p>', '<p>Latar belakang</p>', 'C', 0, '2019-01-29 13:01:26', 1),
(8, 2, 4, 12, 0, 2, 0, NULL, '<p>Apa attribut untuk memberi gambar pada  belakang web ?</p>', '<p>Fontcolor</p>', '<p>Body</p>', '<p>Bgcolor</p>', '<p>Body background</p>', '<p>Head</p>', 'D', 0, '2019-01-30 00:53:25', 1),
(9, 2, 4, 12, 0, 2, 0, NULL, '<p>Apa Kepanjangan dari HTML ?</p>', '<p>Hyper Text Manual Language</p>', '<p>Hypno Terminal Maximal List</p>', '<p>Hyper Text Mark-up Language</p>', '<p>Horizon Terminal Mark-up List</p>', '<p>Hyper Text Mark-up List</p>', 'C', 0, '2019-01-30 00:50:52', 1),
(10, 2, 4, 12, 0, 2, 0, NULL, '<p>Apa type form untuk menerima masukan lebih dari satu ?</p>', '<p>Radio</p>', '<p>Password</p>', '<p>Submit</p>', '<p>Checkbox</p>', '<p>Button</p>', 'D', 0, '2019-01-30 01:12:13', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ujian_token`
--

CREATE TABLE `ujian_token` (
  `token_id` int(11) NOT NULL,
  `token_kode` varchar(10) NOT NULL,
  `token_ujian` int(11) NOT NULL,
  `token_is_delete` int(11) NOT NULL,
  `token_update_by` int(11) NOT NULL,
  `token_update_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ujian_token`
--

INSERT INTO `ujian_token` (`token_id`, `token_kode`, `token_ujian`, `token_is_delete`, `token_update_by`, `token_update_date`) VALUES
(1, '12345', 1, 0, 0, '2019-05-04 16:42:06');

-- --------------------------------------------------------

--
-- Table structure for table `ujian_upload`
--

CREATE TABLE `ujian_upload` (
  `upload_id` int(11) NOT NULL,
  `upload_ket` varchar(255) NOT NULL,
  `upload_url` varchar(255) NOT NULL,
  `upload_is_delete` int(11) NOT NULL,
  `upload_update_by` int(11) NOT NULL,
  `upload_update_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ujian_upload`
--

INSERT INTO `ujian_upload` (`upload_id`, `upload_ket`, `upload_url`, `upload_is_delete`, `upload_update_by`, `upload_update_date`) VALUES
(1, 'Media Pertama', 'upload_1549218123.jpg', 0, 1, '2019-02-04 01:22:03');

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_bidang_studi`
-- (See below for the actual view)
--
CREATE TABLE `v_bidang_studi` (
`bds_id` int(11)
,`bds_ket` varchar(255)
,`bds_jenjang` int(11)
,`bds_is_delete` int(11)
,`jenjang_id` int(11)
,`jenjang_ket` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_ujian_detail`
-- (See below for the actual view)
--
CREATE TABLE `v_ujian_detail` (
`soal_id` int(11)
,`soal_pertanyaan` longtext
,`soal_bobot` int(11)
,`soal_lampiran` varchar(255)
,`soal_opsi_a` longtext
,`soal_opsi_b` longtext
,`soal_opsi_c` longtext
,`soal_opsi_d` longtext
,`soal_opsi_e` longtext
,`soal_jawaban` varchar(5)
,`ta_id` int(11)
,`ta_tahun1` int(11)
,`ta_tahun2` int(11)
,`bds_id` int(11)
,`bds_ket` varchar(255)
,`jenjang_id` int(11)
,`jenjang_ket` varchar(255)
,`jurusan_id` int(11)
,`jurusan_ket` varchar(255)
,`soal_kelas` int(11)
,`soal_is_delete` int(11)
,`judul_id` int(11)
,`judul_keterangan` text
,`judul_tgl_mulai` date
,`judul_tgl_selesai` date
,`judul_waktu` int(11)
,`jd_ta_id` int(11)
,`jd_tahun1` int(11)
,`jd_tahun2` int(11)
,`jd_bds_id` int(11)
,`jd_bds_ket` varchar(255)
,`jd_jenjang_id` int(11)
,`jd_jenjang_ket` varchar(255)
,`jd_jurusan_id` int(11)
,`jd_jurusan_ket` varchar(255)
,`judul_is_delete` int(11)
,`uj_id` int(11)
,`uj_judul` int(11)
,`uj_soal` int(11)
,`uj_is_delete` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_ujian_jawab`
-- (See below for the actual view)
--
CREATE TABLE `v_ujian_jawab` (
`jawab_id` int(11)
,`jawab_judul` int(11)
,`jawab_kode` varchar(255)
,`jawab_soal` longtext
,`jawab_submit` longtext
,`jawab_benar` int(11)
,`jawab_salah` int(11)
,`jawab_kosong` int(11)
,`jawab_nilai` decimal(5,2)
,`jawab_tgl_mulai` datetime
,`jawab_tgl_selesai` datetime
,`jawab_tgl_timer` datetime
,`jawab_status` enum('Y','N')
,`jawab_device` varchar(255)
,`jawab_is_delete` int(11)
,`judul_id` int(11)
,`judul_tahun` int(11)
,`judul_tingkat` int(11)
,`judul_kelas` int(11)
,`judul_jurusan` int(11)
,`judul_studi` int(11)
,`judul_tgl_mulai` date
,`judul_tgl_selesai` date
,`judul_keterangan` text
,`judul_waktu` int(11)
,`judul_type` int(11)
,`judul_is_delete` int(11)
,`siswa_username` varchar(255)
,`siswa_tahun` int(11)
,`siswa_kelas` int(11)
,`siswa_jenjang` int(11)
,`siswa_jurusan` int(11)
,`siswa_nama` varchar(255)
,`siswa_nis` varchar(255)
,`jenjang_ket` varchar(255)
,`bds_ket` varchar(255)
,`ta_id` int(11)
,`ta_tahun1` int(11)
,`ta_tahun2` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_ujian_judul`
-- (See below for the actual view)
--
CREATE TABLE `v_ujian_judul` (
`judul_id` int(11)
,`judul_tahun` int(11)
,`judul_tingkat` int(11)
,`judul_kelas` int(11)
,`judul_jurusan` int(11)
,`judul_studi` int(11)
,`judul_tgl_mulai` date
,`judul_tgl_selesai` date
,`judul_jam_mulai` varchar(5)
,`judul_jam_selesai` varchar(5)
,`judul_keterangan` text
,`judul_waktu` int(11)
,`judul_type` int(11)
,`judul_mode` int(11)
,`judul_acak` int(11)
,`judul_akses` int(11)
,`judul_parent` int(11)
,`judul_token` int(11)
,`judul_is_delete` int(11)
,`judul_update_date` datetime
,`judul_update_by` int(11)
,`judul_parent_ket` text
,`ta_id` int(11)
,`ta_kode` varchar(255)
,`ta_tahun1` int(11)
,`ta_tahun2` int(11)
,`jurusan_id` int(11)
,`jurusan_ket` varchar(255)
,`bds_id` int(11)
,`bds_ket` varchar(255)
,`bds_jenjang` int(11)
,`jenjang_id` int(11)
,`jenjang_ket` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_ujian_materi`
-- (See below for the actual view)
--
CREATE TABLE `v_ujian_materi` (
`materi_id` int(11)
,`materi_ket` varchar(255)
,`materi_url` varchar(255)
,`materi_tahun` int(11)
,`materi_tingkat` int(11)
,`materi_kelas` int(11)
,`materi_jurusan` int(11)
,`materi_studi` int(11)
,`materi_akses` int(11)
,`materi_parent` int(11)
,`materi_is_delete` int(11)
,`materi_update_by` int(11)
,`materi_update_date` datetime
,`materi_parent_ket` varchar(255)
,`ta_id` int(11)
,`ta_kode` varchar(255)
,`ta_tahun1` int(11)
,`ta_tahun2` int(11)
,`jurusan_id` int(11)
,`jurusan_ket` varchar(255)
,`bds_id` int(11)
,`bds_ket` varchar(255)
,`jenjang_id` int(11)
,`jenjang_ket` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_ujian_random`
-- (See below for the actual view)
--
CREATE TABLE `v_ujian_random` (
`soal_id` int(11)
,`soal_pertanyaan` longtext
,`soal_bobot` int(11)
,`soal_lampiran` varchar(255)
,`soal_opsi_a` longtext
,`soal_opsi_b` longtext
,`soal_opsi_c` longtext
,`soal_opsi_d` longtext
,`soal_opsi_e` longtext
,`soal_jawaban` varchar(5)
,`ta_id` int(11)
,`ta_tahun1` int(11)
,`ta_tahun2` int(11)
,`bds_id` int(11)
,`bds_ket` varchar(255)
,`jenjang_id` int(11)
,`jenjang_ket` varchar(255)
,`jurusan_id` int(11)
,`jurusan_ket` varchar(255)
,`soal_kelas` int(11)
,`soal_is_delete` int(11)
,`judul_id` int(11)
,`judul_keterangan` text
,`judul_tgl_mulai` date
,`judul_tgl_selesai` date
,`judul_waktu` int(11)
,`jd_ta_id` int(11)
,`jd_tahun1` int(11)
,`jd_tahun2` int(11)
,`jd_bds_id` int(11)
,`jd_bds_ket` varchar(255)
,`jd_jenjang_id` int(11)
,`jd_jenjang_ket` varchar(255)
,`jd_jurusan_id` int(11)
,`jd_jurusan_ket` varchar(255)
,`judul_is_delete` int(11)
,`uj_id` int(11)
,`uj_judul` int(11)
,`uj_siswa` int(11)
,`uj_soal` int(11)
,`uj_is_delete` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_ujian_soal`
-- (See below for the actual view)
--
CREATE TABLE `v_ujian_soal` (
`soal_id` int(11)
,`soal_tahun` int(11)
,`soal_tingkat` int(11)
,`soal_kelas` int(11)
,`soal_jurusan` int(11)
,`soal_studi` int(11)
,`soal_bobot` int(11)
,`soal_lampiran` varchar(255)
,`soal_pertanyaan` longtext
,`soal_opsi_a` longtext
,`soal_opsi_b` longtext
,`soal_opsi_c` longtext
,`soal_opsi_d` longtext
,`soal_opsi_e` longtext
,`soal_jawaban` varchar(5)
,`soal_is_delete` int(11)
,`soal_update_date` datetime
,`soal_update_by` int(11)
,`ta_id` int(11)
,`ta_kode` varchar(255)
,`ta_tahun1` int(11)
,`ta_tahun2` int(11)
,`jurusan_id` int(11)
,`jurusan_ket` varchar(255)
,`bds_id` int(11)
,`bds_ket` varchar(255)
,`bds_jenjang` int(11)
,`jenjang_id` int(11)
,`jenjang_ket` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_ujian_token`
-- (See below for the actual view)
--
CREATE TABLE `v_ujian_token` (
`token_id` int(11)
,`token_kode` varchar(10)
,`token_ujian` int(11)
,`token_is_delete` int(11)
,`token_update_by` int(11)
,`token_update_date` datetime
,`judul_id` int(11)
,`judul_keterangan` text
);

-- --------------------------------------------------------

--
-- Structure for view `v_bidang_studi`
--
DROP TABLE IF EXISTS `v_bidang_studi`;

CREATE  VIEW `v_bidang_studi`  AS  select `studi`.`bds_id` AS `bds_id`,`studi`.`bds_ket` AS `bds_ket`,`studi`.`bds_jenjang` AS `bds_jenjang`,`studi`.`bds_is_delete` AS `bds_is_delete`,`jenjang`.`jenjang_id` AS `jenjang_id`,`jenjang`.`jenjang_ket` AS `jenjang_ket` from (`m_bidang_studi` `studi` left join `m_jenjang` `jenjang` on((`studi`.`bds_jenjang` = `jenjang`.`jenjang_id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `v_ujian_detail`
--
DROP TABLE IF EXISTS `v_ujian_detail`;

CREATE  VIEW `v_ujian_detail`  AS  select `soal`.`soal_id` AS `soal_id`,`soal`.`soal_pertanyaan` AS `soal_pertanyaan`,`soal`.`soal_bobot` AS `soal_bobot`,`soal`.`soal_lampiran` AS `soal_lampiran`,`soal`.`soal_opsi_a` AS `soal_opsi_a`,`soal`.`soal_opsi_b` AS `soal_opsi_b`,`soal`.`soal_opsi_c` AS `soal_opsi_c`,`soal`.`soal_opsi_d` AS `soal_opsi_d`,`soal`.`soal_opsi_e` AS `soal_opsi_e`,`soal`.`soal_jawaban` AS `soal_jawaban`,`soal`.`ta_id` AS `ta_id`,`soal`.`ta_tahun1` AS `ta_tahun1`,`soal`.`ta_tahun2` AS `ta_tahun2`,`soal`.`bds_id` AS `bds_id`,`soal`.`bds_ket` AS `bds_ket`,`soal`.`jenjang_id` AS `jenjang_id`,`soal`.`jenjang_ket` AS `jenjang_ket`,`soal`.`jurusan_id` AS `jurusan_id`,`soal`.`jurusan_ket` AS `jurusan_ket`,`soal`.`soal_kelas` AS `soal_kelas`,`soal`.`soal_is_delete` AS `soal_is_delete`,`judul`.`judul_id` AS `judul_id`,`judul`.`judul_keterangan` AS `judul_keterangan`,`judul`.`judul_tgl_mulai` AS `judul_tgl_mulai`,`judul`.`judul_tgl_selesai` AS `judul_tgl_selesai`,`judul`.`judul_waktu` AS `judul_waktu`,`judul`.`ta_id` AS `jd_ta_id`,`judul`.`ta_tahun1` AS `jd_tahun1`,`judul`.`ta_tahun2` AS `jd_tahun2`,`judul`.`bds_id` AS `jd_bds_id`,`judul`.`bds_ket` AS `jd_bds_ket`,`judul`.`jenjang_id` AS `jd_jenjang_id`,`judul`.`jenjang_ket` AS `jd_jenjang_ket`,`judul`.`jurusan_id` AS `jd_jurusan_id`,`judul`.`jurusan_ket` AS `jd_jurusan_ket`,`judul`.`judul_is_delete` AS `judul_is_delete`,`detail`.`uj_id` AS `uj_id`,`detail`.`uj_judul` AS `uj_judul`,`detail`.`uj_soal` AS `uj_soal`,`detail`.`uj_is_delete` AS `uj_is_delete` from ((`ujian_detail` `detail` left join `v_ujian_soal` `soal` on((`detail`.`uj_soal` = `soal`.`soal_id`))) left join `v_ujian_judul` `judul` on((`detail`.`uj_judul` = `judul`.`judul_id`))) where ((`soal`.`soal_is_delete` = 0) and (`judul`.`judul_is_delete` = 0)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_ujian_jawab`
--
DROP TABLE IF EXISTS `v_ujian_jawab`;

CREATE  VIEW `v_ujian_jawab`  AS  select `jawab`.`jawab_id` AS `jawab_id`,`jawab`.`jawab_judul` AS `jawab_judul`,`jawab`.`jawab_kode` AS `jawab_kode`,`jawab`.`jawab_soal` AS `jawab_soal`,`jawab`.`jawab_submit` AS `jawab_submit`,`jawab`.`jawab_benar` AS `jawab_benar`,`jawab`.`jawab_salah` AS `jawab_salah`,`jawab`.`jawab_kosong` AS `jawab_kosong`,`jawab`.`jawab_nilai` AS `jawab_nilai`,`jawab`.`jawab_tgl_mulai` AS `jawab_tgl_mulai`,`jawab`.`jawab_tgl_selesai` AS `jawab_tgl_selesai`,`jawab`.`jawab_tgl_timer` AS `jawab_tgl_timer`,`jawab`.`jawab_status` AS `jawab_status`,`jawab`.`jawab_device` AS `jawab_device`,`jawab`.`jawab_is_delete` AS `jawab_is_delete`,`judul`.`judul_id` AS `judul_id`,`judul`.`judul_tahun` AS `judul_tahun`,`judul`.`judul_tingkat` AS `judul_tingkat`,`judul`.`judul_kelas` AS `judul_kelas`,`judul`.`judul_jurusan` AS `judul_jurusan`,`judul`.`judul_studi` AS `judul_studi`,`judul`.`judul_tgl_mulai` AS `judul_tgl_mulai`,`judul`.`judul_tgl_selesai` AS `judul_tgl_selesai`,`judul`.`judul_keterangan` AS `judul_keterangan`,`judul`.`judul_waktu` AS `judul_waktu`,`judul`.`judul_type` AS `judul_type`,`judul`.`judul_is_delete` AS `judul_is_delete`,`siswa`.`siswa_username` AS `siswa_username`,`siswa`.`siswa_tahun` AS `siswa_tahun`,`siswa`.`siswa_kelas` AS `siswa_kelas`,`siswa`.`siswa_jenjang` AS `siswa_jenjang`,`siswa`.`siswa_jurusan` AS `siswa_jurusan`,`siswa`.`siswa_nama` AS `siswa_nama`,`siswa`.`siswa_nis` AS `siswa_nis`,`jenjang`.`jenjang_ket` AS `jenjang_ket`,`studi`.`bds_ket` AS `bds_ket`,`tahun`.`ta_id` AS `ta_id`,`tahun`.`ta_tahun1` AS `ta_tahun1`,`tahun`.`ta_tahun2` AS `ta_tahun2` from (((((`ujian_jawab` `jawab` left join `ujian_judul` `judul` on((`jawab`.`jawab_judul` = `judul`.`judul_id`))) left join `m_bidang_studi` `studi` on((`judul`.`judul_studi` = `studi`.`bds_id`))) left join `siswa` on((`jawab`.`jawab_kode` = `siswa`.`siswa_id`))) left join `m_jenjang` `jenjang` on((`siswa`.`siswa_jenjang` = `jenjang`.`jenjang_id`))) left join `m_tahun_ajaran` `tahun` on((`siswa`.`siswa_tahun` = `tahun`.`ta_id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `v_ujian_judul`
--
DROP TABLE IF EXISTS `v_ujian_judul`;

CREATE  VIEW `v_ujian_judul`  AS  select `judul`.`judul_id` AS `judul_id`,`judul`.`judul_tahun` AS `judul_tahun`,`judul`.`judul_tingkat` AS `judul_tingkat`,`judul`.`judul_kelas` AS `judul_kelas`,`judul`.`judul_jurusan` AS `judul_jurusan`,`judul`.`judul_studi` AS `judul_studi`,`judul`.`judul_tgl_mulai` AS `judul_tgl_mulai`,`judul`.`judul_tgl_selesai` AS `judul_tgl_selesai`,`judul`.`judul_jam_mulai` AS `judul_jam_mulai`,`judul`.`judul_jam_selesai` AS `judul_jam_selesai`,`judul`.`judul_keterangan` AS `judul_keterangan`,`judul`.`judul_waktu` AS `judul_waktu`,`judul`.`judul_type` AS `judul_type`,`judul`.`judul_mode` AS `judul_mode`,`judul`.`judul_acak` AS `judul_acak`,`judul`.`judul_akses` AS `judul_akses`,`judul`.`judul_parent` AS `judul_parent`,`judul`.`judul_token` AS `judul_token`,`judul`.`judul_is_delete` AS `judul_is_delete`,`judul`.`judul_update_date` AS `judul_update_date`,`judul`.`judul_update_by` AS `judul_update_by`,`parent`.`judul_keterangan` AS `judul_parent_ket`,`tahun`.`ta_id` AS `ta_id`,`tahun`.`ta_kode` AS `ta_kode`,`tahun`.`ta_tahun1` AS `ta_tahun1`,`tahun`.`ta_tahun2` AS `ta_tahun2`,`jurusan`.`jurusan_id` AS `jurusan_id`,`jurusan`.`jurusan_ket` AS `jurusan_ket`,`studi`.`bds_id` AS `bds_id`,`studi`.`bds_ket` AS `bds_ket`,`studi`.`bds_jenjang` AS `bds_jenjang`,`studi`.`jenjang_id` AS `jenjang_id`,`studi`.`jenjang_ket` AS `jenjang_ket` from ((((`ujian_judul` `judul` left join `m_tahun_ajaran` `tahun` on((`judul`.`judul_tahun` = `tahun`.`ta_id`))) left join `ujian_judul` `parent` on((`judul`.`judul_parent` = `parent`.`judul_id`))) left join `m_jurusan` `jurusan` on((`judul`.`judul_jurusan` = `jurusan`.`jurusan_id`))) left join `v_bidang_studi` `studi` on((`judul`.`judul_studi` = `studi`.`bds_id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `v_ujian_materi`
--
DROP TABLE IF EXISTS `v_ujian_materi`;

CREATE  VIEW `v_ujian_materi`  AS  select `materi`.`materi_id` AS `materi_id`,`materi`.`materi_ket` AS `materi_ket`,`materi`.`materi_url` AS `materi_url`,`materi`.`materi_tahun` AS `materi_tahun`,`materi`.`materi_tingkat` AS `materi_tingkat`,`materi`.`materi_kelas` AS `materi_kelas`,`materi`.`materi_jurusan` AS `materi_jurusan`,`materi`.`materi_studi` AS `materi_studi`,`materi`.`materi_akses` AS `materi_akses`,`materi`.`materi_parent` AS `materi_parent`,`materi`.`materi_is_delete` AS `materi_is_delete`,`materi`.`materi_update_by` AS `materi_update_by`,`materi`.`materi_update_date` AS `materi_update_date`,`parent`.`materi_ket` AS `materi_parent_ket`,`tahun`.`ta_id` AS `ta_id`,`tahun`.`ta_kode` AS `ta_kode`,`tahun`.`ta_tahun1` AS `ta_tahun1`,`tahun`.`ta_tahun2` AS `ta_tahun2`,`jurusan`.`jurusan_id` AS `jurusan_id`,`jurusan`.`jurusan_ket` AS `jurusan_ket`,`studi`.`bds_id` AS `bds_id`,`studi`.`bds_ket` AS `bds_ket`,`studi`.`jenjang_id` AS `jenjang_id`,`studi`.`jenjang_ket` AS `jenjang_ket` from ((((`ujian_materi` `materi` left join `m_tahun_ajaran` `tahun` on((`materi`.`materi_tahun` = `tahun`.`ta_id`))) left join `ujian_materi` `parent` on((`materi`.`materi_parent` = `parent`.`materi_id`))) left join `m_jurusan` `jurusan` on((`materi`.`materi_jurusan` = `jurusan`.`jurusan_id`))) left join `v_bidang_studi` `studi` on((`materi`.`materi_studi` = `studi`.`bds_id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `v_ujian_random`
--
DROP TABLE IF EXISTS `v_ujian_random`;

CREATE  VIEW `v_ujian_random`  AS  select `soal`.`soal_id` AS `soal_id`,`soal`.`soal_pertanyaan` AS `soal_pertanyaan`,`soal`.`soal_bobot` AS `soal_bobot`,`soal`.`soal_lampiran` AS `soal_lampiran`,`soal`.`soal_opsi_a` AS `soal_opsi_a`,`soal`.`soal_opsi_b` AS `soal_opsi_b`,`soal`.`soal_opsi_c` AS `soal_opsi_c`,`soal`.`soal_opsi_d` AS `soal_opsi_d`,`soal`.`soal_opsi_e` AS `soal_opsi_e`,`soal`.`soal_jawaban` AS `soal_jawaban`,`soal`.`ta_id` AS `ta_id`,`soal`.`ta_tahun1` AS `ta_tahun1`,`soal`.`ta_tahun2` AS `ta_tahun2`,`soal`.`bds_id` AS `bds_id`,`soal`.`bds_ket` AS `bds_ket`,`soal`.`jenjang_id` AS `jenjang_id`,`soal`.`jenjang_ket` AS `jenjang_ket`,`soal`.`jurusan_id` AS `jurusan_id`,`soal`.`jurusan_ket` AS `jurusan_ket`,`soal`.`soal_kelas` AS `soal_kelas`,`soal`.`soal_is_delete` AS `soal_is_delete`,`judul`.`judul_id` AS `judul_id`,`judul`.`judul_keterangan` AS `judul_keterangan`,`judul`.`judul_tgl_mulai` AS `judul_tgl_mulai`,`judul`.`judul_tgl_selesai` AS `judul_tgl_selesai`,`judul`.`judul_waktu` AS `judul_waktu`,`judul`.`ta_id` AS `jd_ta_id`,`judul`.`ta_tahun1` AS `jd_tahun1`,`judul`.`ta_tahun2` AS `jd_tahun2`,`judul`.`bds_id` AS `jd_bds_id`,`judul`.`bds_ket` AS `jd_bds_ket`,`judul`.`jenjang_id` AS `jd_jenjang_id`,`judul`.`jenjang_ket` AS `jd_jenjang_ket`,`judul`.`jurusan_id` AS `jd_jurusan_id`,`judul`.`jurusan_ket` AS `jd_jurusan_ket`,`judul`.`judul_is_delete` AS `judul_is_delete`,`detail`.`uj_id` AS `uj_id`,`detail`.`uj_judul` AS `uj_judul`,`detail`.`uj_siswa` AS `uj_siswa`,`detail`.`uj_soal` AS `uj_soal`,`detail`.`uj_is_delete` AS `uj_is_delete` from ((`ujian_random` `detail` left join `v_ujian_soal` `soal` on((`detail`.`uj_soal` = `soal`.`soal_id`))) left join `v_ujian_judul` `judul` on((`detail`.`uj_judul` = `judul`.`judul_id`))) where ((`soal`.`soal_is_delete` = 0) and (`judul`.`judul_is_delete` = 0)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_ujian_soal`
--
DROP TABLE IF EXISTS `v_ujian_soal`;

CREATE  VIEW `v_ujian_soal`  AS  select `soal`.`soal_id` AS `soal_id`,`soal`.`soal_tahun` AS `soal_tahun`,`soal`.`soal_tingkat` AS `soal_tingkat`,`soal`.`soal_kelas` AS `soal_kelas`,`soal`.`soal_jurusan` AS `soal_jurusan`,`soal`.`soal_studi` AS `soal_studi`,`soal`.`soal_bobot` AS `soal_bobot`,`soal`.`soal_lampiran` AS `soal_lampiran`,`soal`.`soal_pertanyaan` AS `soal_pertanyaan`,`soal`.`soal_opsi_a` AS `soal_opsi_a`,`soal`.`soal_opsi_b` AS `soal_opsi_b`,`soal`.`soal_opsi_c` AS `soal_opsi_c`,`soal`.`soal_opsi_d` AS `soal_opsi_d`,`soal`.`soal_opsi_e` AS `soal_opsi_e`,`soal`.`soal_jawaban` AS `soal_jawaban`,`soal`.`soal_is_delete` AS `soal_is_delete`,`soal`.`soal_update_date` AS `soal_update_date`,`soal`.`soal_update_by` AS `soal_update_by`,`tahun`.`ta_id` AS `ta_id`,`tahun`.`ta_kode` AS `ta_kode`,`tahun`.`ta_tahun1` AS `ta_tahun1`,`tahun`.`ta_tahun2` AS `ta_tahun2`,`jurusan`.`jurusan_id` AS `jurusan_id`,`jurusan`.`jurusan_ket` AS `jurusan_ket`,`studi`.`bds_id` AS `bds_id`,`studi`.`bds_ket` AS `bds_ket`,`studi`.`bds_jenjang` AS `bds_jenjang`,`studi`.`jenjang_id` AS `jenjang_id`,`studi`.`jenjang_ket` AS `jenjang_ket` from (((`ujian_soal` `soal` left join `m_tahun_ajaran` `tahun` on((`soal`.`soal_tahun` = `tahun`.`ta_id`))) left join `m_jurusan` `jurusan` on((`soal`.`soal_jurusan` = `jurusan`.`jurusan_id`))) left join `v_bidang_studi` `studi` on((`soal`.`soal_studi` = `studi`.`bds_id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `v_ujian_token`
--
DROP TABLE IF EXISTS `v_ujian_token`;

CREATE  VIEW `v_ujian_token`  AS  select `ujian_token`.`token_id` AS `token_id`,`ujian_token`.`token_kode` AS `token_kode`,`ujian_token`.`token_ujian` AS `token_ujian`,`ujian_token`.`token_is_delete` AS `token_is_delete`,`ujian_token`.`token_update_by` AS `token_update_by`,`ujian_token`.`token_update_date` AS `token_update_date`,`ujian_judul`.`judul_id` AS `judul_id`,`ujian_judul`.`judul_keterangan` AS `judul_keterangan` from (`ujian_token` left join `ujian_judul` on((`ujian_token`.`token_ujian` = `ujian_judul`.`judul_id`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD KEY `admin_nama` (`admin_nama`),
  ADD KEY `admin_npp` (`admin_npp`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `m_bidang_studi`
--
ALTER TABLE `m_bidang_studi`
  ADD PRIMARY KEY (`bds_id`);

--
-- Indexes for table `m_jenis_kelamin`
--
ALTER TABLE `m_jenis_kelamin`
  ADD PRIMARY KEY (`jkel_id`);

--
-- Indexes for table `m_jenjang`
--
ALTER TABLE `m_jenjang`
  ADD PRIMARY KEY (`jenjang_id`);

--
-- Indexes for table `m_jurusan`
--
ALTER TABLE `m_jurusan`
  ADD PRIMARY KEY (`jurusan_id`);

--
-- Indexes for table `m_tahun_ajaran`
--
ALTER TABLE `m_tahun_ajaran`
  ADD PRIMARY KEY (`ta_id`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`siswa_id`);

--
-- Indexes for table `ujian_detail`
--
ALTER TABLE `ujian_detail`
  ADD PRIMARY KEY (`uj_id`),
  ADD KEY `uj_judul` (`uj_judul`),
  ADD KEY `uj_soal` (`uj_soal`);

--
-- Indexes for table `ujian_jawab`
--
ALTER TABLE `ujian_jawab`
  ADD PRIMARY KEY (`jawab_id`),
  ADD KEY `jawab_judul` (`jawab_judul`),
  ADD KEY `jawab_kode` (`jawab_kode`);

--
-- Indexes for table `ujian_judul`
--
ALTER TABLE `ujian_judul`
  ADD PRIMARY KEY (`judul_id`);

--
-- Indexes for table `ujian_materi`
--
ALTER TABLE `ujian_materi`
  ADD PRIMARY KEY (`materi_id`);

--
-- Indexes for table `ujian_random`
--
ALTER TABLE `ujian_random`
  ADD PRIMARY KEY (`uj_id`),
  ADD KEY `uj_judul` (`uj_judul`),
  ADD KEY `uj_soal` (`uj_soal`);

--
-- Indexes for table `ujian_soal`
--
ALTER TABLE `ujian_soal`
  ADD PRIMARY KEY (`soal_id`);

--
-- Indexes for table `ujian_token`
--
ALTER TABLE `ujian_token`
  ADD PRIMARY KEY (`token_id`);

--
-- Indexes for table `ujian_upload`
--
ALTER TABLE `ujian_upload`
  ADD PRIMARY KEY (`upload_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `m_bidang_studi`
--
ALTER TABLE `m_bidang_studi`
  MODIFY `bds_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `m_jenis_kelamin`
--
ALTER TABLE `m_jenis_kelamin`
  MODIFY `jkel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `m_jenjang`
--
ALTER TABLE `m_jenjang`
  MODIFY `jenjang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `m_jurusan`
--
ALTER TABLE `m_jurusan`
  MODIFY `jurusan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `m_tahun_ajaran`
--
ALTER TABLE `m_tahun_ajaran`
  MODIFY `ta_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `siswa_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ujian_detail`
--
ALTER TABLE `ujian_detail`
  MODIFY `uj_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `ujian_jawab`
--
ALTER TABLE `ujian_jawab`
  MODIFY `jawab_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ujian_judul`
--
ALTER TABLE `ujian_judul`
  MODIFY `judul_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ujian_materi`
--
ALTER TABLE `ujian_materi`
  MODIFY `materi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ujian_random`
--
ALTER TABLE `ujian_random`
  MODIFY `uj_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ujian_soal`
--
ALTER TABLE `ujian_soal`
  MODIFY `soal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `ujian_token`
--
ALTER TABLE `ujian_token`
  MODIFY `token_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ujian_upload`
--
ALTER TABLE `ujian_upload`
  MODIFY `upload_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
