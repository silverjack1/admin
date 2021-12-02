-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 27, 2011 at 09:16 PM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_ujianonline`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id_admin` int(2) NOT NULL AUTO_INCREMENT,
  `nama_admin` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama_admin`, `username`, `password`) VALUES
(1, 'Administrator Web', 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `tabel_nilai`
--

CREATE TABLE IF NOT EXISTS `tabel_nilai` (
  `id_nilai` int(4) NOT NULL AUTO_INCREMENT,
  `id_user` int(4) NOT NULL,
  `benar` int(4) NOT NULL,
  `salah` int(4) NOT NULL,
  `kosong` int(4) NOT NULL,
  `point` int(4) NOT NULL,
  `tanggal` date NOT NULL,
  PRIMARY KEY (`id_nilai`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `tabel_nilai`
--

INSERT INTO `tabel_nilai` (`id_nilai`, `id_user`, `benar`, `salah`, `kosong`, `point`, `tanggal`) VALUES
(1, 7, 1, 3, 1, 5, '2011-02-13'),
(2, 7, 1, 3, 1, 5, '2011-02-13'),
(3, 7, 5, 0, 0, 25, '2011-02-13'),
(4, 6, 4, 1, 0, 20, '2011-02-13'),
(5, 6, 4, 1, 0, 20, '2011-02-13'),
(6, 6, 0, 4, 1, 0, '2011-02-24'),
(7, 12, 5, 0, 0, 25, '2011-11-20'),
(8, 5, 2, 3, 0, 10, '2011-11-21'),
(9, 5, 2, 1, 2, 10, '2011-11-26'),
(10, 13, 1, 4, 0, 5, '2011-12-27'),
(11, 13, 5, 1, 0, 25, '2011-12-27');

-- --------------------------------------------------------

--
-- Table structure for table `tabel_soal`
--

CREATE TABLE IF NOT EXISTS `tabel_soal` (
  `id_soal` int(4) NOT NULL AUTO_INCREMENT,
  `pertanyaan` varchar(100) NOT NULL,
  `pilihan_a` varchar(100) NOT NULL,
  `pilihan_b` varchar(100) NOT NULL,
  `pilihan_c` varchar(100) NOT NULL,
  `pilihan_d` varchar(100) NOT NULL,
  `jawaban` varchar(100) NOT NULL,
  `publish` enum('yes','no') NOT NULL,
  `tipe` int(2) NOT NULL,
  PRIMARY KEY (`id_soal`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `tabel_soal`
--

INSERT INTO `tabel_soal` (`id_soal`, `pertanyaan`, `pilihan_a`, `pilihan_b`, `pilihan_c`, `pilihan_d`, `jawaban`, `publish`, `tipe`) VALUES
(2, 'Agus Ke Kampus Pakai Apa?', 'Mobil', 'Motor', 'Pesawat', 'Jalan Kaki', 'B', 'yes', 1),
(3, 'Warna Kesukaan Kamu Apa?', 'Merah', 'Kuning', 'Biru', 'Orange', 'C', 'yes', 1),
(4, 'Binatang Kesukaan Kamu Apa?', 'Kucing', 'Harimau', 'Kelinci', 'Kodok', 'A', 'yes', 1),
(5, 'Makanan Kesukaan Kamu Apa?', 'Mie Ayam', 'Sate', 'Bakso', 'Nasi Goreng', 'D', 'yes', 1),
(6, 'Olah Raga Kesukaan Kamu Apa?', 'Badminton', 'Bola', 'Voli', 'Jalan Kaki', 'A', 'yes', 1),
(8, 'Siapa Nama Pacar Kamu?', 'Cinta Laura', 'Sandra Dewi', 'Adinda Larasati', 'Siera', 'C', 'no', 1),
(9, 'Pertanyaan Anda?', 'Jawab A', 'Jawab B', 'Jawab C', 'Jawab D', 'C', 'yes', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tabel_user`
--

CREATE TABLE IF NOT EXISTS `tabel_user` (
  `id_user` int(4) NOT NULL AUTO_INCREMENT,
  `nama_user` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `gambar_user` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `username` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `password` varchar(50) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=14 ;

--
-- Dumping data for table `tabel_user`
--

INSERT INTO `tabel_user` (`id_user`, `nama_user`, `gambar_user`, `username`, `password`) VALUES
(6, 'Adinda Larasati', './gambar/Dinda.jpg', 'dinda', '594280c6ddc94399a392934cac9d80d5'),
(5, 'Agus Sumarna', './gambar/AgusSumarna.jpg', 'agus', 'fdf169558242ee051cca1479770ebac3'),
(7, 'Dedi Ruswandi', './gambar/termenung.jpg', 'dedi', 'c5897fbcc14ddcf30dca31b2735c3d7e'),
(8, 'Asep Ruspayadi', './gambar/Gray_Cat.jpg', 'asep', 'dc855efb0dc7476760afaa1b281665f1'),
(9, 'Sinta', './gambar/rizky.jpg', 'sinta', '08ca451b5ef1a7c86763d31e7711a522'),
(10, 'Dede', './gambar/895-21-02-2011.JPG', 'dede', 'b4be1c568a6dc02dcaf2849852bdb13e'),
(11, 'Cumi', './gambar/timer-ujian-online.PNG', 'cumi', '202cb962ac59075b964b07152d234b70'),
(12, 'Fitri', './gambar/dss-ri32.jpg', 'fitri', '534a0b7aa872ad1340d0071cbfa38697'),
(13, 'Fitri Cantik', './gambar/14.JPG', 'fitri', '202cb962ac59075b964b07152d234b70');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
