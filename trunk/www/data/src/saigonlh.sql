-- phpMyAdmin SQL Dump
-- version 3.5.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 07, 2013 at 04:27 PM
-- Server version: 5.5.30-30.2
-- PHP Version: 5.3.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `spngroup_quanan_muoiotxanh`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_app`
--

CREATE TABLE IF NOT EXISTS `tbl_app` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(125) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 NOT NULL,
  `banner` varchar(125) CHARACTER SET utf8 NOT NULL,
  `prefix` varchar(50) CHARACTER SET utf8 NOT NULL,
  `alias` varchar(256) CHARACTER SET utf8 NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_activity` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `type` tinyint(4) NOT NULL,
  `page_view` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_app`
--

INSERT INTO `tbl_app` (`id`, `name`, `phone`, `address`, `email`, `banner`, `prefix`, `alias`, `date_created`, `date_modified`, `date_activity`, `type`, `page_view`) VALUES
(1, 'Demo 1', '0919 111 222', 'P5 - TPVL', '', 'data/images/banner/logo.png', 'tbl_', 'tbl_', '2012-06-30 22:00:00', '0000-00-00 00:00:00', '2012-12-26 13:28:02', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE IF NOT EXISTS `tbl_category` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `picture` binary(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=52 ;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `name`, `picture`) VALUES
(28, 'Khai Vị', NULL),
(29, 'Cơm', NULL),
(30, 'Mì', NULL),
(31, 'Bò', NULL),
(32, 'Mực', NULL),
(33, 'Ếch', NULL),
(34, 'Vịt xiêm', NULL),
(35, 'Chân gà', NULL),
(36, 'Cánh gà', NULL),
(37, 'Sườn heo', NULL),
(38, 'Vú heo', NULL),
(39, 'Lươn', NULL),
(40, 'Bồ câu', NULL),
(42, 'các loai cá', NULL),
(46, 'Các món gỏi', NULL),
(47, 'Hải sản (nước mắm sữa)', NULL),
(48, 'Lẩu', NULL),
(49, 'Dồi trường', NULL),
(50, 'Bao tử', NULL),
(51, 'bia', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_collect_general`
--

CREATE TABLE IF NOT EXISTS `tbl_collect_general` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_term` int(11) NOT NULL,
  `date` date NOT NULL,
  `value` int(11) NOT NULL,
  `note` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tbl_collect_1` (`id_term`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tbl_collect_general`
--

INSERT INTO `tbl_collect_general` (`id`, `id_term`, `date`, `value`, `note`) VALUES
(5, 2, '2013-05-18', 1000000, 'd'),
(6, 3, '2013-08-08', 200000, 'Thử'),
(8, 2, '2013-09-26', 250000, 'thu phụ phẩm');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_config`
--

CREATE TABLE IF NOT EXISTS `tbl_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `param` varchar(125) COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tbl_config`
--

INSERT INTO `tbl_config` (`id`, `param`, `value`) VALUES
(1, 'ROW_PER_PAGE', '12'),
(5, 'DISCOUNT', '10'),
(6, 'EVERY_5_MINUTES', '2000'),
(7, 'GUEST_VISIT', '2'),
(8, 'THEME', 'grey');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_course`
--

CREATE TABLE IF NOT EXISTS `tbl_course` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idcategory` int(25) DEFAULT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `shortname` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `unit` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price1` bigint(20) NOT NULL,
  `price2` bigint(20) NOT NULL,
  `price3` bigint(20) NOT NULL,
  `price4` bigint(20) NOT NULL,
  `picture` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rate` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `foreign_field` (`idcategory`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=367 ;

--
-- Dumping data for table `tbl_course`
--

INSERT INTO `tbl_course` (`id`, `idcategory`, `name`, `shortname`, `unit`, `price1`, `price2`, `price3`, `price4`, `picture`, `rate`) VALUES
(245, 28, 'đậu hủ sữa chiên giòn', 'đậu hủ sữa chiên giòn', 'Dĩa', 35000, 0, 0, 0, '', 0),
(246, 28, 'đậu hủ sữa xốt tứ xuyên', 'đậu hủ sữa xốt tứ xuyên', 'Dĩa', 35000, 0, 0, 0, '', 0),
(247, 28, 'hột vịt lộn rang me', 'hột vịt lộn rang me', 'Trứng', 10000, 0, 0, 0, '', 0),
(248, 28, 'cút lộn luộc, rang muối ớt, rang me', 'cút lộn luộc, rang muối ớt, rang me', 'chục', 25000, 0, 0, 0, '', 0),
(249, 28, 'hột gà lộn rang muối', 'hột gà lộn rang muối', 'Trứng', 10000, 0, 0, 0, '', 0),
(250, 28, 'khoai tây chiên sốt bơ đường', 'khoai tây chiên sốt bơ đường', 'Dĩa', 30000, 0, 0, 0, '', 0),
(251, 28, 'rau muống xào tỏi, xào chao', 'rau muống xào tỏi, xào chao', 'Dĩa', 25000, 0, 0, 0, '', 0),
(252, 28, 'khô mực nướng', 'khô mực nướng', 'Con', 50000, 0, 0, 0, '', 0),
(253, 28, 'cơm cháy kho quẹt', 'cơm cháy kho quẹt', 'Dĩa', 50000, 0, 0, 0, '', 0),
(254, 28, 'chả cá thát lát chiên giòn, hấp cải xanh', 'chả cá thát lát chiên giòn, hấp cải xanh', 'Dĩa', 50000, 0, 0, 0, '', 0),
(255, 28, 'rau luộc thập cẩm + kho quẹt', 'rau luộc thập cẩm + kho quẹt', 'Dĩa', 50000, 0, 0, 0, '', 0),
(256, 28, 'Đặc Biệt: lạp xưởng tươi nướng Cần Đước', 'Đặc Biệt: lạp xưởng tươi nướng Cần Đước', 'Dĩa', 60000, 0, 0, 0, '', 0),
(257, 29, 'cơm dương châu', ' cơm dương châu', 'Dĩa', 55000, 0, 0, 0, '', 0),
(258, 29, ' cơm cá mặn', 'cơm cá mặn', 'Dĩa', 55000, 0, 0, 0, '', 0),
(259, 29, 'cơm chiên muối ớt xanh', 'cơm chiên muối ớt xanh', 'Dĩa', 55000, 0, 0, 0, '', 0),
(260, 29, 'cơm hải sản', 'cơm hải sản', 'Dĩa', 55000, 0, 0, 0, '', 0),
(261, 30, 'mì xào hải sản', 'mì xào hải sản', 'Dĩa', 55000, 0, 0, 0, '', 0),
(262, 30, 'mì xào thập cẩm', 'mì xào thập cẩm', 'Dĩa', 55000, 0, 0, 0, '', 0),
(263, 31, 'bò xào cải mầm', 'bò xào cải mầm', 'Dĩa', 70000, 0, 0, 0, '', 0),
(264, 31, 'bò nướng lá lốt', 'bò nướng lá lốt', 'Dĩa', 70000, 0, 0, 0, '', 0),
(265, 31, 'bắp bò xào càng cua(rau muống)', 'bắp bò xào càng cua(rau muống)', 'Dĩa', 70000, 0, 0, 0, '', 0),
(266, 31, 'bắp bò nướng mọi', 'bắp bò nướng mọi', 'Dĩa', 70000, 0, 0, 0, '', 0),
(267, 31, 'bắp bò nướng muối ớt', 'bắp bò nướng muối ớt', 'Dĩa', 70000, 0, 0, 0, '', 0),
(268, 31, 'lòng bò luộc sả', 'lòng bò luộc sả', 'Dĩa', 50000, 0, 0, 0, '', 0),
(269, 32, 'mực nướng (sả ớt, muối ớt)', 'mực nướng (sả ớt, muối ớt)', 'Dĩa', 60000, 0, 0, 0, '', 0),
(270, 32, 'mực chiên nước mắm', 'mực chiên nước mắm', 'Dĩa', 60000, 0, 0, 0, '', 0),
(271, 32, 'mực trứng hấp', 'mực trứng hấp', 'Dĩa', 60000, 0, 0, 0, '', 0),
(272, 32, 'mực chiên giòn', 'mực chiên giòn', 'Dĩa', 60000, 0, 0, 0, '', 0),
(273, 33, 'ếch để da chiên giòn', 'ếch để da chiên giòn', 'Dĩa', 50000, 0, 0, 0, '', 0),
(274, 33, 'ếch bầm lá cách', 'ếch bầm lá cách', 'Dĩa', 50000, 0, 0, 0, '', 0),
(275, 33, 'ếch sốt me', 'ếch sốt me', 'Dĩa', 50000, 0, 0, 0, '', 0),
(276, 33, 'lẩu ếch măng chua', 'lẩu ếch măng chua', 'lẩu', 120000, 0, 0, 0, '', 0),
(277, 34, 'ram me', 'ram me', 'Dĩa', 60000, 0, 0, 0, '', 0),
(278, 34, 'nướng giả chồn', 'nướng giả chồn', 'Dĩa', 60000, 0, 0, 0, '', 0),
(279, 34, 'nấu giả cầy', 'nấu giả cầy', 'lẩu', 120000, 0, 0, 0, '', 0),
(281, 34, 'lẩu vịt xiêm nấu măng chua', 'lẩu vịt xiêm nấu măng chua', 'lẩu', 120000, 0, 0, 0, '', 0),
(283, 35, 'nướng muối ớt, chiên nước mắm', 'nướng muối ớt, chiên nước mắm', 'Dĩa', 50000, 0, 0, 0, '', 0),
(284, 35, 'hấp hành', 'hấp hành', 'Dĩa', 50000, 0, 0, 0, '', 0),
(285, 36, 'chiên nước mắm, chiên bơ', 'chiên nước mắm, chiên bơ', 'Dĩa', 50000, 0, 0, 0, '', 0),
(286, 36, 'nướng muối ớt', 'nướng muối ớt', 'Dĩa', 50000, 0, 0, 0, '', 0),
(287, 36, 'rang me', 'rang me', 'Dĩa', 50000, 0, 0, 0, '', 0),
(288, 37, 'chiên nước mắm', 'chiên nước mắm', 'Dĩa', 50000, 0, 0, 0, '', 0),
(289, 37, 'nướng sả ớt, muối ớt', 'nướng sả ớt, muối ớt', 'Dĩa', 50000, 0, 0, 0, '', 0),
(290, 37, 'nấu dưa cải', 'nấu dưa cải', 'lẩu', 120000, 0, 0, 0, '', 0),
(291, 37, 'nướng kiểu Nga', 'nướng kiểu Nga', 'Dĩa', 60000, 0, 0, 0, '', 0),
(292, 38, 'chiên giòn, nước mắm', 'chiên giòn, nước mắm', 'Dĩa', 55000, 0, 0, 0, '', 0),
(293, 38, 'nướng chao', 'nướng chao', 'Dĩa', 55000, 0, 0, 0, '', 0),
(294, 38, 'nướng sa tế', 'nướng sa tế', 'Dĩa', 55000, 0, 0, 0, '', 0),
(295, 39, 'nướng rau râm', 'nướng rau râm', 'Dĩa', 60000, 0, 0, 0, '', 0),
(296, 39, 'rang me', 'rang me', 'Dĩa', 60000, 0, 0, 0, '', 0),
(297, 39, 'nướng mọi', 'nướng mọi', 'Dĩa', 60000, 0, 0, 0, '', 0),
(298, 39, 'um lá cách', 'um lá cách', 'Dĩa', 60000, 0, 0, 0, '', 0),
(299, 40, 'Rôti', 'Rôti', 'Con', 70000, 0, 0, 0, '', 0),
(300, 40, 'nướng muối ớt', 'nướng muối ớt', 'Con', 70000, 0, 0, 0, '', 0),
(301, 40, 'xào lá cách', 'xào lá cách', 'Con', 70000, 0, 0, 0, '', 0),
(302, 40, 'quay miệt vườn', 'quay miệt vườn', 'Con', 70000, 0, 0, 0, '', 0),
(303, 42, 'Cá dứa một nắng chiên giòn(theo thời giá)', 'Cá dứa một nắng chiên giòn(theo thời giá)', 'Dĩa', 0, 0, 0, 0, '', 0),
(304, 42, 'Cá dứa một nắng chiên nước mắm(theo thời giá)', 'Cá dứa một nắng chiên nước mắm(theo thời giá)', 'Dĩa', 0, 0, 0, 0, '', 0),
(305, 42, 'Cá dứa một nắng nướng muối ớt(theo thời giá)', 'Cá dứa một nắng nướng muối ớt(theo thời giá)', 'Dĩa', 0, 0, 0, 0, '', 0),
(306, 42, 'Cá dứa một nắng ram me(theo thời giá)', 'Cá dứa một nắng ram me(theo thời giá)', 'Dĩa', 0, 0, 0, 0, '', 0),
(307, 42, 'Cá gúng chiên nước mắm', 'Cá gúng chiên nước mắm', 'Dĩa', 69000, 0, 0, 0, '', 0),
(308, 42, 'Lẩu cá gúng (canh chua, măng chua, dưa cải)', 'Lẩu cá gúng (canh chua, măng chua, dưa cải)', 'lẩu', 120000, 0, 0, 0, '', 0),
(310, 42, 'Cá nhồng, cá chèo bẻo nướng muối ớt', 'Cá nhồng, cá chèo bẻo nướng muối ớt', 'Dĩa', 69000, 0, 0, 0, '', 0),
(311, 42, 'Cá nhồng chiên nước mắm', 'Cá nhồng chiên nước mắm', 'Dĩa', 69000, 0, 0, 0, '', 0),
(312, 42, 'Lẩu cá nhồng', 'Lẩu cá nhồng', 'lẩu', 120000, 0, 0, 0, '', 0),
(313, 42, 'Cá kèo chiên giòn(theo thời giá)', 'Cá kèo chiên giòn(theo thời giá)', 'Dĩa', 0, 0, 0, 0, '', 0),
(314, 42, 'Cá kèo nướng muối ớt(theo thời giá)', 'Cá kèo nướng muối ớt(theo thời giá)', 'Dĩa', 0, 0, 0, 0, '', 0),
(317, 42, 'Cá kèo chiên nước mắm(theo thời giá)', 'Cá kèo chiên nước mắm(theo thời giá)', 'Dĩa', 0, 0, 0, 0, '', 0),
(318, 42, 'Lẩu cá kèo lá giang', 'Lẩu cá kèo lá giang', 'Cái', 0, 0, 0, 0, '', 0),
(319, 42, 'Hàm cá nướng muối ớt xanh', 'Hàm cá nướng muối ớt xanh', 'Dĩa', 0, 0, 0, 0, '', 0),
(320, 46, 'Gỏi đu đủ thái lan', 'Gỏi đu đủ thái lan', 'Dĩa', 49000, 0, 0, 0, '', 0),
(321, 46, 'Gỏi ốc đắng cải mầm', 'Gỏi ốc đắng cải mầm', 'Dĩa', 49000, 0, 0, 0, '', 0),
(322, 46, 'Gỏi xoài ốc giác', 'Gỏi xoài ốc giác', 'Dĩa', 49000, 0, 0, 0, '', 0),
(323, 46, 'Gỏi xoài tôm khô', 'Gỏi xoài tôm khô', 'Dĩa', 49000, 0, 0, 0, '', 0),
(324, 46, 'Gỏi bò hấp thấu', 'Gỏi bò hấp thấu', 'Dĩa', 65000, 0, 0, 0, '', 0),
(325, 47, 'Ốc bưu nướng tiêu, dồn thịt', 'Ốc bưu nướng tiêu, dồn thịt', 'Dĩa', 39000, 0, 0, 0, '', 0),
(326, 47, 'Ốc đắng rang muối ớt, luộc sả', 'Ốc đắng rang muối ớt, luộc sả', 'Dĩa', 39000, 0, 0, 0, '', 0),
(327, 47, 'Nghêu hấp sả, hấp thái', 'Nghêu hấp sả, hấp thái', 'Dĩa', 50000, 0, 0, 0, '', 0),
(328, 47, 'Càng ghẹ rang me, rang muối ớt, cháy tỏi', 'Càng ghẹ rang me, rang muối ớt, cháy tỏi', 'Dĩa', 70000, 0, 0, 0, '', 0),
(329, 47, 'Sò huyết nướng mọi, rang me, cháy tỏi', 'Sò huyết nướng mọi, rang me, cháy tỏi', 'Dĩa', 39000, 0, 0, 0, '', 0),
(330, 47, 'Hàu nướng phô mai, mỡ hành', 'Hàu nướng phô mai, mỡ hành', 'Con', 15000, 0, 0, 0, '', 0),
(331, 47, 'Sò lông nướng mỡ hành', 'Sò lông nướng mỡ hành', 'Dĩa', 39000, 0, 0, 0, '', 0),
(332, 47, 'Sò điệp nướng phô mai, mỡ hành', 'Sò điệp nướng phô mai, mỡ hành', 'Dĩa', 59000, 0, 0, 0, '', 0),
(333, 47, 'Bạch tuột nướng muối ớt, nhúng giấm-mẻ', 'Bạch tuột nướng muối ớt, nhúng giấm-mẻ', 'Dĩa', 65000, 0, 0, 0, '', 0),
(334, 47, 'Tôm chiên nước mắm nhỉ, nướng muối ớt, hấp bia, hấp nước dừa(theo thời giá)', 'Tôm chiên nước mắm nhỉ, nướng muối ớt, hấp bia, hấp nước dừa(theo thời giá)', 'Dĩa', 0, 0, 0, 0, '', 0),
(335, 47, 'Cua- Ghẹ : rang muối hột, rang me, hấp bia (tính kg)(theo thời giá)', 'Cua- Ghẹ : rang muối hột, rang me, hấp bia (tính kg)(theo thời giá)', 'Dĩa', 0, 0, 0, 0, '', 0),
(336, 47, 'Mực một nắng : chiên giòn, nướng sa tế, nướng muối ớt(theo thời giá)', 'Mực một nắng : chiên giòn, nướng sa tế, nướng muối ớt(theo thời giá)', 'Dĩa', 0, 0, 0, 0, '', 0),
(337, 48, 'lẩu cua đồng', 'lẩu cua đồng', 'lẩu', 120000, 0, 0, 0, '', 0),
(338, 48, 'lẩu ếch đồng măng chua', 'lẩu ếch đồng măng chua', 'lẩu', 120000, 0, 0, 0, '', 0),
(339, 48, 'vịt xiêm nấu măng chua', 'vịt xiêm nấu măng chua', 'lẩu', 120000, 0, 0, 0, '', 0),
(340, 48, 'vịt xiêm nấu dưa cải', 'vịt xiêm nấu dưa cải', 'lẩu', 120000, 0, 0, 0, '', 0),
(341, 48, 'lẩu thái', 'lẩu thái', 'lẩu', 120000, 0, 0, 0, '', 0),
(342, 48, 'lẩu nấm', 'lẩu nấm', 'lẩu', 120000, 0, 0, 0, '', 0),
(343, 48, 'lẩu hải sản', 'lẩu hải sản', 'lẩu', 120000, 0, 0, 0, '', 0),
(344, 48, 'lẩu ghẹ nấu dứa(theo thời giá)', 'lẩu ghẹ nấu dứa(theo thời giá)', 'lẩu', 0, 0, 0, 0, '', 0),
(345, 49, 'Xào dưa cải', 'Xào dưa cải', 'Dĩa', 70000, 0, 0, 0, '', 0),
(346, 49, 'Chiên giòn', 'Chiên giòn', 'Dĩa', 70000, 0, 0, 0, '', 0),
(347, 49, 'Chiên nước mắm', 'Chiên nước mắm', 'Dĩa', 70000, 0, 0, 0, '', 0),
(348, 49, 'Chiên tiêu', 'Chiên tiêu', 'Dĩa', 70000, 0, 0, 0, '', 0),
(349, 50, 'Xào dưa cải', 'Xào dưa cải', 'Dĩa', 55000, 0, 0, 0, '', 0),
(350, 50, 'Hầm tiêu xanh', 'Hầm tiêu xanh', 'Dĩa', 55000, 0, 0, 0, '', 0),
(351, 50, 'Chiên tiêu', 'Chiên tiêu', 'Dĩa', 55000, 0, 0, 0, '', 0),
(352, 50, 'Chiên nước mắm', 'Chiên nước mắm', 'Dĩa', 55000, 0, 0, 0, '', 0),
(353, 50, 'Xào nắm Đông Cô', 'Xào nắm Đông Cô', 'Dĩa', 55000, 0, 0, 0, '', 0),
(354, 51, '333', '', 'Lon', 12000, 0, 0, 0, '', 0),
(355, 51, '222', '', 'Lon', 23000, 0, 0, 0, '', 0),
(356, 28, 'Khoai tây chiên', 'khoai tây chiên', 'Dĩa', 25000, 0, 0, 0, '', 0),
(357, 28, 'khô mực sốt me', 'khô mực sốt me', 'Con', 50000, 0, 0, 0, '', 0),
(358, 28, 'khô mực chiên nước mắm', 'khô mực chiên nước mắm', 'Con', 50000, 0, 0, 0, '', 0),
(359, 28, 'Hột gà, hột vịt', 'Hột gà, hột vịt', 'Trứng', 5000, 0, 0, 0, '', 0),
(360, 28, 'Nướng nem tươi muối ớt xanh', 'Nướng nem tươi muối ớt xanh', 'Dĩa', 60000, 0, 0, 0, '', 0),
(361, 30, 'mì xào bò', 'mì xào bò', 'Dĩa', 60000, 0, 0, 0, '', 0),
(363, 31, 'bắp bò ngăm giấm', 'bắp bò ngăm giấm', 'Dĩa', 70000, 0, 0, 0, '', 0),
(365, 42, 'Lẩu cá kèo lá giang', 'lẩu cá kèo lá giang', 'lẩu', 120000, 0, 0, 0, '', 0),
(366, 48, 'lẩu chèo bẻo', 'lẩu chèo bẻo', 'lẩu', 120000, 0, 0, 0, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

CREATE TABLE IF NOT EXISTS `tbl_customer` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `card` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `note` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `discount` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`id`, `name`, `type`, `card`, `phone`, `address`, `note`, `discount`) VALUES
(1, 'Khách Hàng Vãng Lai', 0, '893970784300', '0945030709', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_domain`
--

CREATE TABLE IF NOT EXISTS `tbl_domain` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

--
-- Dumping data for table `tbl_domain`
--

INSERT INTO `tbl_domain` (`id`, `name`) VALUES
(1, 'TUM A'),
(2, 'TUM B'),
(4, 'TUM 1'),
(5, 'TUM 2'),
(6, 'TUM 3'),
(7, 'TUM 4'),
(8, 'TUM 5'),
(9, 'TUM 6'),
(10, 'VIP1'),
(11, 'VIP2');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee`
--

CREATE TABLE IF NOT EXISTS `tbl_employee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `job` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `gender` tinyint(2) NOT NULL,
  `phone` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `salary_base` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tbl_employee`
--

INSERT INTO `tbl_employee` (`id`, `name`, `job`, `gender`, `phone`, `address`, `salary_base`) VALUES
(1, 'Nguyễn Văn A', '', 1, '0946 111 222', 'Vĩnh Long', 900000),
(2, 'Trần Văn B', 'Tiếp tân', 0, '0986 222 333', 'Cần Thơ', 900000),
(3, 'Lê Thị C', 'Tiếp tân', 1, '', 'Sóc Trăng', 900000),
(5, 'Đào Thị E', 'Tiếp tân', 1, '', 'An Giang', 900000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_guest`
--

CREATE TABLE IF NOT EXISTS `tbl_guest` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(16) CHARACTER SET latin1 NOT NULL,
  `entry_time` varchar(32) CHARACTER SET latin1 NOT NULL,
  `exit_time` varchar(32) CHARACTER SET latin1 NOT NULL,
  `agent` varchar(16) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=56 ;

--
-- Dumping data for table `tbl_guest`
--

INSERT INTO `tbl_guest` (`id`, `ip`, `entry_time`, `exit_time`, `agent`) VALUES
(55, '113.169.91.113', '1381180794', '1381184394', '113.169.91.113');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order_import`
--

CREATE TABLE IF NOT EXISTS `tbl_order_import` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idsupplier` int(11) NOT NULL,
  `date` date NOT NULL,
  `description` varchar(50) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tbl_order_import_1` (`idsupplier`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tbl_order_import`
--

INSERT INTO `tbl_order_import` (`id`, `idsupplier`, `date`, `description`) VALUES
(1, 11, '2013-10-07', 'ABC'),
(2, 6, '2013-10-07', ''),
(3, 8, '2013-10-07', ''),
(4, 1, '2013-10-07', ''),
(5, 1, '2013-10-07', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order_import_detail`
--

CREATE TABLE IF NOT EXISTS `tbl_order_import_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idorder` int(11) NOT NULL,
  `idresource` int(11) NOT NULL,
  `count` float NOT NULL,
  `price` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tbl_order_import_detail_1` (`idorder`),
  KEY `tbl_order_import_detail_2` (`idresource`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tbl_order_import_detail`
--

INSERT INTO `tbl_order_import_detail` (`id`, `idorder`, `idresource`, `count`, `price`) VALUES
(1, 1, 45, 1, 350000),
(2, 1, 46, 2, 350000),
(3, 2, 27, 100, 2500),
(4, 3, 19, 2, 313000),
(5, 4, 1, 4, 5000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_paid_general`
--

CREATE TABLE IF NOT EXISTS `tbl_paid_general` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_term` int(11) NOT NULL,
  `date` date NOT NULL,
  `value` int(11) NOT NULL,
  `note` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tbl_paid_1` (`id_term`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=89 ;

--
-- Dumping data for table `tbl_paid_general`
--

INSERT INTO `tbl_paid_general` (`id`, `id_term`, `date`, `value`, `note`) VALUES
(46, 11, '2013-04-23', 34000, 'Trái cây cúng'),
(47, 10, '2013-04-24', 65000, 'Tiền chợ'),
(48, 11, '2013-04-24', 21000, 'Mua hóa đơn bán lẻ\r\n'),
(49, 10, '2013-04-25', 177000, 'Tiền chợ'),
(50, 11, '2013-04-25', 26000, 'Bông cúng+bọc đựng da cá basa'),
(51, 10, '2013-04-26', 100000, 'Tiền chợ'),
(52, 10, '2013-04-27', 102000, 'Tiền chợ'),
(53, 11, '2013-08-24', 168000, 'Trả tiền vật liệu(cát)+bình nước lọc(2 bình)'),
(54, 10, '2013-04-28', 103000, 'Tiền chợ'),
(55, 10, '2013-04-29', 126000, 'Tiền chợ'),
(56, 11, '2013-04-29', 19000, 'Muối+ớt làm rang muối'),
(57, 10, '2013-05-01', 95000, 'Tiền chợ'),
(58, 11, '2013-05-01', 24000, 'Bao kiếng trái cây(3 bao)'),
(59, 10, '2013-05-03', 183000, 'Tiền chợ'),
(60, 10, '2013-05-02', 62000, 'Tiền chợ'),
(61, 10, '2013-05-04', 85000, 'Tiền chợ'),
(62, 10, '2013-05-05', 89000, 'Tiền chợ\r\n'),
(63, 10, '2013-05-06', 32000, 'Tiền chợ'),
(64, 4, '2013-04-30', 10500000, 'Lương NV chưa tính phụ cấp'),
(65, 1, '2013-04-30', 6000000, ''),
(66, 2, '2013-04-30', 1500000, 'Tạm tính'),
(67, 10, '2013-05-07', 211000, 'Tiền chợ\r\n'),
(68, 11, '2013-05-07', 136000, 'Nấu cháo gà( Anh Khoa)\r\n'),
(69, 11, '2013-05-08', 7000, 'Mua hóa đơn bán lẻ'),
(70, 10, '2013-05-08', 115000, 'Tiền chợ'),
(71, 10, '2013-05-09', 117000, 'Tiền chợ'),
(72, 11, '2013-05-10', 6000, 'Cafe cho tài xế của khách'),
(73, 10, '2013-05-10', 81000, 'Tiền chợ'),
(74, 10, '2013-05-11', 99000, 'Tiền chợ\r\n'),
(75, 10, '2013-05-12', 330000, 'Tiền chợ'),
(76, 10, '2013-05-13', 85000, 'Tiền chợ\r\n'),
(77, 10, '2013-05-14', 74500, 'Tiền chợ'),
(78, 11, '2013-08-19', 141000, 'Mua chổi+cây lau nhà'),
(79, 3, '2013-04-30', 5600000, 'Thuế TTĐB'),
(80, 12, '2013-04-30', 3250000, 'chi tiền đầu chai cho NV'),
(81, 10, '2013-05-15', 221000, ''),
(82, 10, '2013-05-16', 106000, ''),
(83, 10, '2013-05-17', 129000, ''),
(85, 10, '2013-05-18', 99000, ''),
(86, 10, '2013-05-19', 85000, ''),
(87, 11, '2013-08-21', 414000, 'Bình gas+nguyên liệu làm motor'),
(88, 10, '2013-05-20', 40000, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pay_roll`
--

CREATE TABLE IF NOT EXISTS `tbl_pay_roll` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idemployee` int(11) NOT NULL,
  `date` date NOT NULL,
  `state` int(11) NOT NULL,
  `extra` int(11) NOT NULL,
  `late` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tbl_pay_roll_1` (`idemployee`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=178 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_resource`
--

CREATE TABLE IF NOT EXISTS `tbl_resource` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `idsupplier` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `unit` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `price` int(10) NOT NULL,
  `description` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tbl_resource_1` (`idsupplier`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=77 ;

--
-- Dumping data for table `tbl_resource`
--

INSERT INTO `tbl_resource` (`id`, `idsupplier`, `name`, `unit`, `price`, `description`) VALUES
(1, 1, 'Nước đá ống', 'Kg', 5000, 'Nước đá dùng để uống trà, cafe'),
(2, 1, 'Nước đá ướp', 'Cây', 0, 'Dùng để ướp lạnh'),
(3, 1, 'Nước đá viên', 'Kg', 0, 'Viên cưa dùng uống bia'),
(17, 6, 'Bánh', 'Bịch', 0, ''),
(19, 8, 'Heniken', 'Két', 313000, ''),
(20, 8, 'Heniken', 'Thùng', 362000, ''),
(21, 8, 'Sài gòn đỏ', 'Két', 132000, ''),
(22, 8, 'Sài gòn XK', 'Két', 178000, ''),
(23, 8, 'Sài Gòn XK', 'Thùng', 261500, ''),
(24, 8, 'Bia 333', 'Thùng', 207000, ''),
(25, 8, 'Tiger Bạc', 'Két', 260000, ''),
(26, 8, 'Tiger', 'Két', 238000, ''),
(27, 6, 'Xúc Xích', 'Bịch', 2500, ''),
(28, 6, 'CW DOUBLEMINT', 'Hộp', 0, ''),
(29, 6, 'Chả Giò', 'Bịch', 0, ''),
(30, 6, 'Khô Bò', 'Bịch', 0, ''),
(31, 6, 'Mít Sấy', 'Bịch', 0, ''),
(32, 6, 'Đậu Phộng ', 'Bịch', 0, ''),
(34, 9, 'Trái Cây', 'Dĩa', 0, ''),
(35, 9, 'Đậu Phộng sấy', 'Bịch', 0, ''),
(36, 9, 'Đậu Phộng chiên', 'Bịch', 0, ''),
(39, 9, 'Thuốc Craven', 'Cây', 165000, ''),
(40, 9, 'Thuốc 555', 'Cây', 235000, ''),
(43, 9, 'Quẹt gas', 'Hộp', 85000, ''),
(44, 9, 'Đậu Nành', 'Gói', 3000, 'Mua ngoài'),
(45, 11, 'Cơm Cháy', 'Thùng', 350000, ''),
(46, 11, 'Cá Cơm', 'Thùng', 350000, '0'),
(58, 9, 'Khô Mực', 'Con', 0, ''),
(59, 9, 'Khô_Mực', 'Con', 0, ''),
(60, 8, 'Sting', 'Thùng', 173000, ''),
(61, 9, 'Khăn Lạnh', 'Hộp', 27000, ''),
(62, 8, 'Tiger', 'Thùng', 280000, ''),
(63, 8, 'Lavie', 'Thùng', 86000, ''),
(65, 9, 'Thuốc Hút', 'Cây', 155000, ''),
(66, 9, 'Bánh tráng rế', 'Bịch', 15000, 'Bánh tráng gói chả giò rế'),
(67, 9, 'Thịt ghẹ', 'Kg', 80000, 'Thịt ghẹ gói chả giò rế'),
(68, 9, 'Khoai cao', 'Kg', 30000, 'Khoai cao gói chả giò rế'),
(69, 8, '7 Up', 'Thùng', 153000, ''),
(70, 8, 'Trà Xanh', 'Thùng', 158000, ''),
(71, 8, 'Red_Bull', 'Thùng', 186000, ''),
(72, 8, 'Pepsi', 'Thùng', 153000, ''),
(73, 8, 'Cam', 'Thùng', 130000, ''),
(74, 8, 'Dr Thanh', 'Thùng', 186000, ''),
(75, 8, 'Nước Yến', 'Thùng', 142000, ''),
(76, 8, 'Sting', 'Thùng', 173000, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_session`
--

CREATE TABLE IF NOT EXISTS `tbl_session` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idtable` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `idcustomer` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  `datetimeend` datetime DEFAULT NULL,
  `note` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `discount_value` int(11) NOT NULL,
  `discount_percent` int(11) NOT NULL,
  `surtax` int(11) NOT NULL,
  `payment` int(11) NOT NULL,
  `value` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idtable` (`idtable`),
  KEY `iduser` (`iduser`),
  KEY `tbl_session_3` (`idcustomer`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_session`
--

INSERT INTO `tbl_session` (`id`, `idtable`, `iduser`, `idcustomer`, `datetime`, `datetimeend`, `note`, `status`, `discount_value`, `discount_percent`, `surtax`, `payment`, `value`) VALUES
(1, 1, 1, 1, '2013-10-08 04:26:44', '2013-10-08 04:26:44', '', 0, 0, 10, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_session_detail`
--

CREATE TABLE IF NOT EXISTS `tbl_session_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idsession` int(11) NOT NULL,
  `idcourse` int(11) NOT NULL,
  `count` int(11) NOT NULL,
  `price` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idsession` (`idsession`),
  KEY `idcourse` (`idcourse`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_session_detail`
--

INSERT INTO `tbl_session_detail` (`id`, `idsession`, `idcourse`, `count`, `price`) VALUES
(1, 1, 352, 1, 55000),
(2, 1, 351, 1, 55000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_supplier`
--

CREATE TABLE IF NOT EXISTS `tbl_supplier` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `note` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `debt` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

--
-- Dumping data for table `tbl_supplier`
--

INSERT INTO `tbl_supplier` (`id`, `name`, `phone`, `address`, `note`, `debt`) VALUES
(1, 'ĐL Nước Đá', '0703456456', 'Trí Phường 4', 'Cung cấp nước đá', 0),
(6, 'Coop Mart', '070', 'Vĩnh Long', 'Cung cấp mọi thứ', 0),
(8, 'Nhà PP Đoan Trang', '0703 822 227 - ', '64/6N Trần Phú P4 TP Vĩnh Long', '', 0),
(9, 'KHÁC', '', '', '', 0),
(11, 'CH Tuấn', '', 'P4, TPVL', 'Cung cấp thực phẩm', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_table`
--

CREATE TABLE IF NOT EXISTS `tbl_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iddomain` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `iduser` int(11) DEFAULT NULL,
  `type` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `iddomain` (`iddomain`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=74 ;

--
-- Dumping data for table `tbl_table`
--

INSERT INTO `tbl_table` (`id`, `iddomain`, `name`, `iduser`, `type`) VALUES
(1, 1, 'A1', 1, '0'),
(2, 1, 'A2', 1, '0'),
(49, 4, '1', 1, '0'),
(50, 4, '2', 1, '0'),
(51, 4, '3', 1, '0'),
(52, 4, '4', 1, '0'),
(53, 4, '5', 1, '0'),
(54, 4, '6', 1, '0'),
(55, 4, '7', 1, '0'),
(56, 4, '8', 1, '0'),
(57, 4, '9', 1, '0'),
(58, 4, '10', 1, '0'),
(61, 1, 'A3', 1, '0'),
(62, 1, 'A4', 1, '0'),
(63, 1, 'A5', 1, '0'),
(64, 1, 'A6', 1, '0'),
(65, 1, 'A7', 1, '0'),
(66, 1, 'A8', 1, '0'),
(67, 2, 'B1', 1, '0'),
(68, 2, 'B2', 1, '0'),
(69, 2, 'B3', 1, '0'),
(70, 2, 'B4', 1, '0'),
(71, 2, 'B4', 1, '0'),
(72, 2, 'B5', 1, '0'),
(73, 2, 'B6', 1, '0');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_term`
--

CREATE TABLE IF NOT EXISTS `tbl_term` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Dumping data for table `tbl_term`
--

INSERT INTO `tbl_term` (`id`, `name`, `type`) VALUES
(1, 'Tiền Điện', 0),
(2, 'Tiền Nước', 0),
(3, 'Thuế', 0),
(4, 'Lương Nhân Viên', 0),
(10, 'Tiền Ăn Nhân Viên', 0),
(11, 'CP Khác', 0),
(12, 'Tiền Phụ Cấp', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_term_collect`
--

CREATE TABLE IF NOT EXISTS `tbl_term_collect` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_term_collect`
--

INSERT INTO `tbl_term_collect` (`id`, `name`) VALUES
(2, 'Phụ Phẩm'),
(3, 'Đặc Biệt');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tracking`
--

CREATE TABLE IF NOT EXISTS `tbl_tracking` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `tbl_tracking`
--

INSERT INTO `tbl_tracking` (`id`, `date_start`, `date_end`) VALUES
(1, '2013-08-01', '2013-08-31'),
(3, '2013-10-01', '2013-10-31'),
(4, '2013-11-01', '2013-11-30'),
(5, '2013-12-01', '2013-12-31'),
(7, '2013-09-01', '2013-09-30');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_unit`
--

CREATE TABLE IF NOT EXISTS `tbl_unit` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=26 ;

--
-- Dumping data for table `tbl_unit`
--

INSERT INTO `tbl_unit` (`id`, `name`) VALUES
(1, 'Ly'),
(2, 'Điếu'),
(3, 'Chai'),
(4, 'Lon'),
(5, 'Dĩa'),
(6, 'Thùng'),
(7, 'Kết'),
(9, 'Bịch'),
(10, 'Gói'),
(11, 'Cái'),
(12, 'Cây'),
(13, 'Giờ'),
(14, 'Bao'),
(15, 'Con'),
(16, 'Kg'),
(17, 'Hộp'),
(18, 'Hủ'),
(19, 'Trái'),
(20, 'Trứng'),
(21, 'Kg'),
(22, 'chục'),
(23, 'lẩu');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pass` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` int(11) NOT NULL,
  `note` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `datecreate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dateupdate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `dateactivity` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `type` tinyint(4) NOT NULL,
  `code` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `name`, `email`, `pass`, `gender`, `note`, `datecreate`, `dateupdate`, `dateactivity`, `type`, `code`) VALUES
(1, 'Quản lý', 'muoiotxanh@gmail.com', 'admin123456', 0, ' Người quản lý hệ thống', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 4, ''),
(2, 'Quí Hữu', 'quihuu@gmail.com', '123456', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, ''),
(9, 'Bán hàng 1', 'banhang1@gmail.com', '123456', 1, '', '2013-08-14 07:31:11', '2013-08-14 07:31:11', '2013-08-14 07:31:11', 1, '');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_collect_general`
--
ALTER TABLE `tbl_collect_general`
  ADD CONSTRAINT `tbl_collect_general_1` FOREIGN KEY (`id_term`) REFERENCES `tbl_term_collect` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_course`
--
ALTER TABLE `tbl_course`
  ADD CONSTRAINT `tbl_course_1` FOREIGN KEY (`idcategory`) REFERENCES `tbl_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_order_import`
--
ALTER TABLE `tbl_order_import`
  ADD CONSTRAINT `tbl_order_import_1` FOREIGN KEY (`idsupplier`) REFERENCES `tbl_supplier` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_order_import_detail`
--
ALTER TABLE `tbl_order_import_detail`
  ADD CONSTRAINT `tbl_order_import_detail_1` FOREIGN KEY (`idorder`) REFERENCES `tbl_order_import` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_order_import_detail_2` FOREIGN KEY (`idresource`) REFERENCES `tbl_resource` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_paid_general`
--
ALTER TABLE `tbl_paid_general`
  ADD CONSTRAINT `tbl_paid_general_1` FOREIGN KEY (`id_term`) REFERENCES `tbl_term` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_pay_roll`
--
ALTER TABLE `tbl_pay_roll`
  ADD CONSTRAINT `tbl_pay_roll_1` FOREIGN KEY (`idemployee`) REFERENCES `tbl_employee` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_resource`
--
ALTER TABLE `tbl_resource`
  ADD CONSTRAINT `tbl_resource_1` FOREIGN KEY (`idsupplier`) REFERENCES `tbl_supplier` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_session`
--
ALTER TABLE `tbl_session`
  ADD CONSTRAINT `tbl_session_1` FOREIGN KEY (`idtable`) REFERENCES `tbl_table` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_session_2` FOREIGN KEY (`iduser`) REFERENCES `tbl_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_session_3` FOREIGN KEY (`idcustomer`) REFERENCES `tbl_customer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_session_detail`
--
ALTER TABLE `tbl_session_detail`
  ADD CONSTRAINT `tbl_session_detail_1` FOREIGN KEY (`idsession`) REFERENCES `tbl_session` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_session_detail_2` FOREIGN KEY (`idcourse`) REFERENCES `tbl_course` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_table`
--
ALTER TABLE `tbl_table`
  ADD CONSTRAINT `tbl_table_1` FOREIGN KEY (`iddomain`) REFERENCES `tbl_domain` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
