-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 06, 2013 at 08:01 AM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `spnsoft_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `123appnet_customer_story`
--

CREATE TABLE IF NOT EXISTS `123appnet_customer_story` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `url_doc` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `123appnet_customer_story`
--

INSERT INTO `123appnet_customer_story` (`id`, `name`, `url_doc`) VALUES
(1, 'Bánh Rế Hoàng Thúy', 'https://docs.google.com/presentation/embed?id=1d06suimxrV0pYL5PsHvATr0pvl4Yp4x_gFcB8OlthVE&start=false&loop=false&delayms=3000'),
(2, 'Trại cá Ánh Nguyệt', 'https://docs.google.com/presentation/embed?id=138Z9ovdIwcPCUxxw5ie6jjhLEZCikJYQRa3P2pry15c&start=false&loop=false&delayms=3000'),
(3, 'Cafe NICE', 'https://docs.google.com/presentation/embed?id=1LcG1x3H08XtEny9Xm4k2pLAG6YAkA_5Q8FdHw2fjWpw&start=false&loop=false&delayms=3000'),
(4, 'Thức ăn gia súc Minh Tài', 'https://docs.google.com/presentation/embed?id=1pZ1MVyMea473spxGY-gv-zev6l99dJWOEvl3ziS9mqk&start=false&loop=false&delayms=3000'),
(5, 'Thức ăn thủy sản Ba Đức', 'https://docs.google.com/presentation/embed?id=1hu8k7OAmQ1zYuKv40xsLRLiiNpkI-H6vhmPDq44SnP4&start=false&loop=false&delayms=3000'),
(6, 'Đại lý phân phối Sáu Giàu', 'https://docs.google.com/presentation/embed?id=1C8mF_SUmQjDO91phno0bhnG3eGUBBXFkGYXIHLkmAFs&start=false&loop=false&delayms=3000');

-- --------------------------------------------------------

--
-- Table structure for table `123appnet_guest`
--

CREATE TABLE IF NOT EXISTS `123appnet_guest` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(16) NOT NULL,
  `entry_time` varchar(32) NOT NULL,
  `exit_time` varchar(32) NOT NULL,
  `agent` varchar(16) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=95 ;

--
-- Dumping data for table `123appnet_guest`
--

INSERT INTO `123appnet_guest` (`id`, `ip`, `entry_time`, `exit_time`, `agent`) VALUES
(93, '192.168.1.3', '1356760196', '1356763796', '192.168.1.3'),
(94, '127.0.0.1', '1357142858', '1357229258', '127.0.0.1');

-- --------------------------------------------------------

--
-- Table structure for table `123appnet_project`
--

CREATE TABLE IF NOT EXISTS `123appnet_project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `url_doc` varchar(250) NOT NULL,
  `url_pic` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `123appnet_project`
--


-- --------------------------------------------------------

--
-- Table structure for table `123appnet_service`
--

CREATE TABLE IF NOT EXISTS `123appnet_service` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `url_doc` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `123appnet_service`
--

INSERT INTO `123appnet_service` (`id`, `name`, `url_doc`) VALUES
(1, '1. Domain & Hosting', 'https://docs.google.com/presentation/embed?id=1V3-G6CRWn-pYPIjAoIfo9vgGmuaIn9Z3JtDZzexPmsg&start=false&loop=false&delayms=3000'),
(2, '2. Sao lưu & phục hồi dữ liệu', 'https://docs.google.com/presentation/embed?id=1B_zwfVxChUD8GIwYKoQ2iSdfz60sgl3yo50WvqnirJ0&start=false&loop=false&delayms=3000'),
(3, '3. Tư vấn & thiết kế', 'https://docs.google.com/presentation/embed?id=1nDPBPxYPGcjwislxT5J0R-tWffEKfAO-HK1RreT5Qow&start=false&loop=false&delayms=3000');

-- --------------------------------------------------------

--
-- Table structure for table `123appnet_solution`
--

CREATE TABLE IF NOT EXISTS `123appnet_solution` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `url_doc` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `123appnet_solution`
--

INSERT INTO `123appnet_solution` (`id`, `name`, `url_doc`) VALUES
(1, '1. Ứng dụng Web', 'https://docs.google.com/presentation/embed?id=1d5Fs7bKLGfyEoFD7x8Xq1PNxm50ulZryJGCFSHVh6mU&start=false&loop=false&delayms=3000'),
(2, '2. CMS', 'https://docs.google.com/presentation/embed?id=1DSzMeJWClueLd0Zjh7Nojrh3oic6k1Bp26hI0VaOQ_M&start=false&loop=false&delayms=3000'),
(3, '3. eCommerce', 'https://docs.google.com/presentation/embed?id=1Oo9L5Jm0EYCJDz9mkiN3bSQcYIGDgDKEqTFrHq31gnA&start=false&loop=false&delayms=3000'),
(4, '4. Video Streamming', 'https://docs.google.com/presentation/embed?id=1PUYEU2pcabRzQTOqTueRkGfMQCaYPmDaBoFiYQG4Krs&start=false&loop=false&delayms=3000'),
(5, '5. Hệ thống Web tích hợp', 'https://docs.google.com/presentation/embed?id=1UjWXweg1fNMIGE_Le7dJOdzmxDVisiRQRs1Mc-kBoRQ&start=false&loop=false&delayms=3000');

-- --------------------------------------------------------

--
-- Table structure for table `123appnet_technical`
--

CREATE TABLE IF NOT EXISTS `123appnet_technical` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `url_doc` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `123appnet_technical`
--

INSERT INTO `123appnet_technical` (`id`, `name`, `url_doc`) VALUES
(1, 'QR Code', 'https://docs.google.com/presentation/embed?id=16DHaxFX3VmTRXoLHwVqgVD98zkDl4TZC8phhVQ-jAQI&start=false&loop=false&delayms=3000'),
(2, 'Barcode', 'https://docs.google.com/presentation/embed?id=1ofAMuBBSvpCL99rHQFBTqlor--2fUxwL0zlgSP6mgnM&start=false&loop=false&delayms=3000'),
(3, 'HTML 5', 'https://docs.google.com/presentation/embed?id=1W18HjbfU3eAK9v6wQqQLpo3lrMzug5ISB7KWTfNloRM&start=false&loop=false&delayms=3000'),
(4, 'PHP TAL', 'https://docs.google.com/presentation/embed?id=1gT14JcG3qYCw69wAAy4LmCEux17GbOvFSaUDdEdsDKw&start=false&loop=false&delayms=3000'),
(5, 'JQuery', 'https://docs.google.com/presentation/embed?id=1WkU4seNtddA5RXCoOm-skWf1WcUHQTBBtblcew567KY&start=false&loop=false&delayms=3000'),
(6, 'JQuery Mobile', 'https://docs.google.com/presentation/embed?id=1-X6dCMjW5sTsX1ZIV9Pkd1-d6uMGL0HBYXlpvnfy_k0&start=false&loop=false&delayms=3000');
