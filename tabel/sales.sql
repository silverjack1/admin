-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 17, 2016 at 03:41 PM
-- Server version: 5.6.14
-- PHP Version: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tutorial`
--

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE IF NOT EXISTS `sales` (
  `id_transaksi` int(11) NOT NULL AUTO_INCREMENT,
  `id_produk` int(11) NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `kuantitas` tinyint(4) NOT NULL,
  `harga` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  PRIMARY KEY (`id_transaksi`),
  KEY `id_produk` (`id_produk`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id_transaksi`, `id_produk`, `tgl_transaksi`, `kuantitas`, `harga`, `id_pelanggan`) VALUES
(1, 100, '2016-09-20', 8, 265000, 1),
(2, 100, '2016-10-11', 3, 270000, 2),
(3, 101, '2016-08-17', 8, 250000, 2),
(4, 101, '2016-08-24', 12, 380000, 2),
(5, 101, '2016-05-10', 12, 250000, 1),
(6, 101, '2016-05-04', 11, 375000, 1),
(7, 101, '2016-07-15', 3, 265000, 1),
(8, 100, '2016-05-19', 4, 250000, 1),
(9, 101, '2016-06-17', 12, 255000, 2),
(10, 100, '2016-09-11', 12, 280000, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;