-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2015 at 05:55 AM
-- Server version: 5.6.21
-- PHP Version: 5.5.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `spncom_caytretramdot_hangdacaocap`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_album`
--

CREATE TABLE IF NOT EXISTS `tbl_album` (
`id` int(11) NOT NULL,
  `date` date NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `note` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `order` int(11) NOT NULL,
  `viewed` bigint(20) NOT NULL,
  `liked` bigint(20) NOT NULL,
  `key` varchar(125) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_attribute`
--

CREATE TABLE IF NOT EXISTS `tbl_attribute` (
`id` int(11) NOT NULL,
  `id_gattribute` int(11) NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_attribute_product`
--

CREATE TABLE IF NOT EXISTS `tbl_attribute_product` (
`id` int(11) NOT NULL,
  `name` text COLLATE utf8_unicode_ci,
  `material` text COLLATE utf8_unicode_ci,
  `size` text COLLATE utf8_unicode_ci,
  `color` text COLLATE utf8_unicode_ci,
  `guarantee` int(3) DEFAULT NULL,
  `note` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_attribute_product`
--

INSERT INTO `tbl_attribute_product` (`id`, `name`, `material`, `size`, `color`, `guarantee`, `note`) VALUES
(1, 'GN001', 'Da Cá Sấu', '38-44', 'Nâu Đất', 12, NULL),
(2, 'GN002', 'Da Trăn', '37-43', 'Nâu', 12, NULL),
(3, 'GN003', 'Da Bò', '38-44', 'Vàng Đất', 12, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_branch`
--

CREATE TABLE IF NOT EXISTS `tbl_branch` (
`id` int(11) NOT NULL,
  `name` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(160) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `x` double NOT NULL,
  `y` double NOT NULL,
  `phone1` varchar(25) NOT NULL,
  `phone2` varchar(25) NOT NULL,
  `email1` varchar(50) NOT NULL,
  `email2` varchar(50) NOT NULL,
  `order` int(11) NOT NULL,
  `logo` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_branch`
--

INSERT INTO `tbl_branch` (`id`, `name`, `address`, `x`, `y`, `phone1`, `phone2`, `email1`, `email2`, `order`, `logo`) VALUES
(1, 'Hàng Da Cao Cấp TP HCM', 'P.Tân Bình, TP Hồ Chí Minh', 10.766388, 106.681717, '0919 000 000', '080 001 002', 'hangdacaocap@gmail.com', 'hangdacaocap@gmail.com', 1, 'data/images/logo_hangdacaocap.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE IF NOT EXISTS `tbl_category` (
`id` int(11) NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `key` varchar(250) NOT NULL,
  `order` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `name`, `key`, `order`) VALUES
(14, 'Giày Nam', 'giay-nam', 1),
(15, 'Bóp - Ví Nam', 'bop-vi-nam', 2),
(16, 'Thắt lưng nam', 'that-lung-nam', 3),
(17, 'Dép da', 'dep-da', 4),
(18, 'Túi xách nữ', 'tui-xach-nu', 1),
(19, 'Bóp ví nữ', 'bop-vi-nu', 2),
(20, 'Thắt lưng nữ', 'that-lung-nu', 3),
(21, 'Giày Nữ', 'giay-nu', 4),
(22, 'Phụ kiện', 'phu-kien', 5);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category1`
--

CREATE TABLE IF NOT EXISTS `tbl_category1` (
`id` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  `id_presentation` int(11) NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `info` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `key` varchar(250) NOT NULL,
  `order` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_config`
--

CREATE TABLE IF NOT EXISTS `tbl_config` (
`id` int(11) NOT NULL,
  `param` varchar(125) COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(256) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_config`
--

INSERT INTO `tbl_config` (`id`, `param`, `value`) VALUES
(5, 'DISCOUNT', '0'),
(6, 'ROW_PER_PAGE', '20'),
(7, 'GUEST_VISIT', '2060'),
(9, 'THEME', 'light-blue'),
(10, 'NAME', 'HÀNG DA CAO CẤP VĨNH LONG'),
(11, 'ADDRESS', 'F4 TP VĨNH LONG TỈNH VĨNH LONG'),
(13, 'CATEGORY_AUTO', '3'),
(14, 'SWITCH_BOARD_CALL', '1'),
(15, 'RECEIPT_VIRTUAL_DOUBLE', '0'),
(16, 'POST_POLICY', '39'),
(19, 'EVERY_5_MINUTES', '2000'),
(22, 'SLOGAN', 'HÀNG DA CAO CẤP'),
(23, 'POST_INTRODUCTION', '39'),
(24, 'POST_FAQ', '39'),
(28, 'POST_POLICY', '5'),
(29, 'N_MONTH_LOG', '1'),
(30, 'PRESENTATION_HOME', '2'),
(31, 'CONTACT_NAME', 'ANH MINH TRÍ'),
(32, 'CONTACT_YAHOOMESSENGER', 'hangdacaocap@yahoo.com'),
(33, 'CONTACT_SKYPE', 'hangdacaocap@skype.com'),
(34, 'CONTACT_GTALK', 'hangdacaocap@gmail.com'),
(35, 'PHONE1', '0918 000000'),
(36, 'PHONE2', '08 000 000'),
(37, 'PRESENTATION_INTRO', '3'),
(38, 'MENU_MAIN', '14'),
(39, 'MARQUEE_WELCOME', 'KHU ẨM THỰC SINH THÁI ĐẦM SEN CAO LÃNH hân hạnh kính chào quí khách ...'),
(40, 'PRESENTATION_CATEGORY_COURSE', '4');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_feed`
--

CREATE TABLE IF NOT EXISTS `tbl_feed` (
`id` int(11) NOT NULL,
  `email` varchar(120) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_feed`
--

INSERT INTO `tbl_feed` (`id`, `email`) VALUES
(5, 'tuanbuithanh@gmail.com'),
(7, 'thanhbao@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_gattribute`
--

CREATE TABLE IF NOT EXISTS `tbl_gattribute` (
`id` int(11) NOT NULL,
  `name` varchar(120) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `order` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_guest`
--

CREATE TABLE IF NOT EXISTS `tbl_guest` (
`id` int(11) NOT NULL,
  `ip` varchar(16) CHARACTER SET latin1 NOT NULL,
  `entry_time` varchar(32) CHARACTER SET latin1 NOT NULL,
  `exit_time` varchar(32) CHARACTER SET latin1 NOT NULL,
  `agent` varchar(16) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=128 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_guest`
--

INSERT INTO `tbl_guest` (`id`, `ip`, `entry_time`, `exit_time`, `agent`) VALUES
(127, '127.0.0.1', '1428378262', '1428381862', '127.0.0.1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_image`
--

CREATE TABLE IF NOT EXISTS `tbl_image` (
`id` int(11) NOT NULL,
  `id_album` int(11) NOT NULL,
  `date` date NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_image`
--

INSERT INTO `tbl_image` (`id`, `id_album`, `date`, `name`, `url`) VALUES
(1, 1, '2014-10-04', 'Bảng hiệu', 'https://lh4.googleusercontent.com/-1g-5bYQ_Agk/VDH93yVTA_I/AAAAAAAAAEw/Ez3m6r8v3EE/s800/10418866_1465269870400987_8218539771848556939_n.jpg'),
(2, 1, '2014-10-04', 'Sàn gỗ 01', 'https://lh3.googleusercontent.com/-_VXcIdggLpM/VDH94EwJBNI/AAAAAAAAAEs/V_yB3pgNNK8/s800/10443347_1464687470459227_8633754900093893968_n.jpg'),
(3, 1, '2014-10-06', 'Sàn gỗ 02', 'https://lh5.googleusercontent.com/-GdefC50-F8o/VDH94Z5i6_I/AAAAAAAAAE0/UsxwH-TG_70/s800/10659379_1461943087400332_1553419119315127166_n.jpg'),
(4, 1, '2014-10-06', 'Sàn gỗ 03', 'https://lh5.googleusercontent.com/-PSshQS7T3os/VDH95UKK3hI/AAAAAAAAAFA/bufSZEy0WtI/s800/10685372_1464538620474112_4089167064051959397_n.jpg'),
(5, 1, '2014-10-06', 'Sàn gỗ 04', 'https://lh6.googleusercontent.com/-fKVQPeKtbBI/VDH95wcBCvI/AAAAAAAAAFE/t7sXzowh9tw/s800/1743494_1464687317125909_2497768799796592084_n.jpg'),
(6, 3, '2014-10-06', 'H1', 'https://lh4.googleusercontent.com/-Qq9cnW3pZqY/VDIANlKPFyI/AAAAAAAAAFs/3SUYCEnQiHo/s800/10170829_1422595514668423_3065423059543235689_n.jpg'),
(7, 3, '2014-10-06', 'H2', 'https://lh6.googleusercontent.com/-K7AJSFTnjB0/VDIAN3M8ZAI/AAAAAAAAAFo/wsRLv_A2OU0/s800/10556239_1445079442420030_6434380587780299311_n.jpg'),
(8, 3, '2014-10-06', 'H3', 'https://lh5.googleusercontent.com/-hLk2wJD4e0Q/VDIANnUYJ3I/AAAAAAAAAFk/wDQknt7p1P0/s800/10628528_1451159778478663_7281121535465719910_n.jpg'),
(9, 3, '2014-10-06', 'H4', 'https://lh4.googleusercontent.com/-r10YuDiLa30/VDIAPNb1E7I/AAAAAAAAAF4/81OYebPtOuw/s800/1508622_1387695551491753_1530884249_n.jpg'),
(10, 3, '2014-10-06', 'H5', 'https://lh5.googleusercontent.com/-lWOsy5qimMI/VDIAP21rdyI/AAAAAAAAAGA/0DifnVT1PQU/s800/1533734_1422599661334675_384148614664481862_n.jpg'),
(11, 3, '2014-10-06', 'H6', 'https://lh5.googleusercontent.com/-b56Krr1lXao/VDIAPzGH3NI/AAAAAAAAAGI/CKDwt_2oIO0/s800/1535746_1386292741632034_1992081859_n.jpg'),
(12, 3, '2014-10-06', 'H7', 'https://lh6.googleusercontent.com/-p9NX9sJ6j4E/VDIAQQ--VdI/AAAAAAAAAGQ/WIDYyfLfEPI/s800/1560710_1444247675836540_4286562385572070038_n.jpg'),
(13, 3, '2014-10-06', 'H8', 'https://lh6.googleusercontent.com/-Pj5-LMtNSZM/VDIARJXnnkI/AAAAAAAAAGY/OspZJBokWes/s800/1604384_1387708711490437_1142157316_n.jpg'),
(14, 3, '2014-10-06', 'H9', 'https://lh5.googleusercontent.com/-tBe7u4JjzJg/VDIARZFVGII/AAAAAAAAAGg/bTghpki6-FM/s800/1622622_1387708641490444_1511319210_n.jpg'),
(15, 3, '2014-10-06', 'H10', 'https://lh5.googleusercontent.com/-O4sC1lpQcZ0/VDIASNc6eQI/AAAAAAAAAGo/25r-_XF065E/s800/1661149_1387708574823784_1464162325_n.jpg'),
(16, 3, '2014-10-06', 'H11', 'https://lh4.googleusercontent.com/--aOn0ljtPUU/VDIASmFTITI/AAAAAAAAAGw/BqYO-dJEG_w/s800/1896820_1405918583002783_1364794503_n.jpg'),
(17, 3, '2014-10-06', 'H12', 'https://lh4.googleusercontent.com/-XmzzWbddXgY/VDIATGK9n0I/AAAAAAAAAG4/F81N8hGJ43Q/s800/1920372_1405125169748791_1108648154_n.jpg'),
(18, 3, '2014-10-06', 'H13', 'https://lh3.googleusercontent.com/-FtZSLtc17-Y/VDIATcZn9MI/AAAAAAAAAG8/PE6uzJyC5w4/s800/1959500_1405422363052405_518011300_n.jpg'),
(19, 3, '2014-10-06', 'H14', 'https://lh5.googleusercontent.com/-gHMi8QC6RSw/VDIAUfXdFTI/AAAAAAAAAHE/9ybYh7HFLUc/s800/1962709_1407241076203867_2043859986_n.jpg'),
(20, 3, '2014-10-06', 'H15', 'https://lh6.googleusercontent.com/-t6rtzWnR6xE/VDIAU5cUC0I/AAAAAAAAAHQ/Pre373XpUac/s800/1977247_1405124476415527_1489486376_n.jpg'),
(21, 3, '2014-10-06', 'H16', 'https://lh4.googleusercontent.com/-wvZ8Gkexc5A/VDIAVFm5vVI/AAAAAAAAAHU/rDO-BikKzww/s800/1979554_1405410886386886_1580256029_n.jpg'),
(22, 2, '2014-10-06', 'H1', 'https://lh4.googleusercontent.com/-k9TTuUiaBo8/VDIHwIatznI/AAAAAAAAAIA/HC_wp5Uzd_0/s800/10171228_1424583887802919_8338530293853861554_n.jpg'),
(23, 2, '2014-10-06', 'H2', 'https://lh5.googleusercontent.com/-DXve8xt9cdo/VDIHwBECIYI/AAAAAAAAAH8/Og-qvTn6fVg/s800/10291098_1424841347777173_3072764612356423321_n.jpg'),
(24, 2, '2014-10-06', 'H3', 'https://lh5.googleusercontent.com/-N6qB-GC0ifo/VDIHwa4J8hI/AAAAAAAAAIE/QsKm8rFP60U/s800/10298995_1424840821110559_5882128866856890397_n.jpg'),
(25, 2, '2014-10-06', 'H4', 'https://lh6.googleusercontent.com/-dUKSZCZwiVQ/VDIHxKEzGiI/AAAAAAAAAIQ/AQ6AH2KteSk/s800/10308248_1424840951110546_3546740929937543041_n.jpg'),
(26, 2, '2014-10-06', 'H5', 'https://lh6.googleusercontent.com/-jKWKUiiMbYk/VDIHxylg2BI/AAAAAAAAAJM/HeOth5ahGKs/s800/10313374_1424583847802923_5004531940291926472_n.jpg'),
(27, 2, '2014-10-06', 'H6', 'https://lh4.googleusercontent.com/-o1DRHio-5_4/VDIHx29iX-I/AAAAAAAAAIY/Z9cFfNsIswE/s800/10325723_1424841034443871_1127582290109628748_n.jpg'),
(28, 2, '2014-10-06', 'H7', 'https://lh5.googleusercontent.com/-YE2fCPULxZw/VDIHyRvl6lI/AAAAAAAAAIg/8OGYdD-DzQA/s800/10329268_1424840764443898_5476328842475404005_n.jpg'),
(29, 2, '2014-10-06', 'H8', 'https://lh4.googleusercontent.com/-Sk1Tnf51piE/VDIHy_GeLBI/AAAAAAAAAIo/rqrfH3rbE0c/s800/10345774_1424841271110514_7542850291847304216_n.jpg'),
(30, 2, '2014-10-06', 'H9', 'https://lh6.googleusercontent.com/-FDb7XEKJRag/VDIHzRNiUlI/AAAAAAAAAIw/kkTxspE3U1E/s800/10369719_1424841014443873_8059632976541230462_n.jpg'),
(31, 2, '2014-10-06', 'H10', 'https://lh4.googleusercontent.com/-kcff1JYYJ3U/VDIH0LshRaI/AAAAAAAAAI4/hcBiGtoQEYY/s800/10376756_1424841191110522_4902148628721069645_n.jpg'),
(32, 2, '2014-10-06', 'H11', 'https://lh5.googleusercontent.com/-djxjkr9qtus/VDIH053zInI/AAAAAAAAAJA/fWMTIsRr1dU/s800/1609964_1424840734443901_1459373300302615850_n.jpg'),
(33, 2, '2014-10-06', 'H12', 'https://lh3.googleusercontent.com/-Rezcw7koNxU/VDIH1Az8YkI/AAAAAAAAAJI/K4oDAZLZacY/s800/1782068_1424841214443853_827774110070987884_n.jpg'),
(34, 4, '2014-10-07', 'H1', 'https://lh4.googleusercontent.com/-33911BdMRMY/VDOYiotulpI/AAAAAAAAAKE/Sbvtt018Qn0/s800/001.JPG'),
(35, 4, '2014-10-07', 'H2', 'https://lh5.googleusercontent.com/-epPmuITCj0c/VDOYiVIAJsI/AAAAAAAAAKA/ZfqbglDf76Q/s800/002.JPG'),
(36, 4, '2014-10-07', 'H3', 'https://lh5.googleusercontent.com/-_iXjzsRan6c/VDOYjG8phnI/AAAAAAAAAKI/lGhjR-XmOD8/s800/003.jpg'),
(37, 4, '2014-10-07', 'H4', 'https://lh3.googleusercontent.com/-N3zcLhUqjW8/VDOYj1cQGFI/AAAAAAAAAKQ/GgoaPMul88c/s800/004.jpg'),
(38, 4, '2014-10-07', 'H5', 'https://lh6.googleusercontent.com/-GeQIinprN_A/VDOYlOUSPQI/AAAAAAAAAKk/aT2CGYqoayQ/s800/006.jpg'),
(39, 4, '2014-10-07', 'H6', 'https://lh3.googleusercontent.com/-5I764Vq345I/VDOYll3R63I/AAAAAAAAAKs/NtVwpjwP1yQ/s800/007.jpg'),
(40, 4, '2014-10-07', 'H7', 'https://lh3.googleusercontent.com/-8mTuuiQQe10/VDOYnd5yp8I/AAAAAAAAAK4/pEJaS6vm2ms/s800/009.jpg'),
(41, 4, '2014-10-07', 'H8', 'https://lh3.googleusercontent.com/-kZVRjN7eKFk/VDOYoV8OpdI/AAAAAAAAALE/IqKabYUVlQs/s800/010.jpg'),
(42, 4, '2014-10-07', 'H9', 'https://lh6.googleusercontent.com/-FekDISeC818/VDOYoygfcgI/AAAAAAAAALM/O1wGJnhpjIY/s800/011.jpg'),
(43, 4, '2014-10-07', 'H10', 'https://lh5.googleusercontent.com/-DG1BZmP_g-s/VDOYpe08jcI/AAAAAAAAALQ/9TE2lnOPjF8/s800/012.jpg'),
(44, 4, '2014-10-07', 'H11', 'https://lh3.googleusercontent.com/-ZiV6DBOYB9g/VDOYqIXPodI/AAAAAAAAALY/fNHQewsyyjY/s800/013.jpg'),
(45, 4, '2014-10-07', 'H12', 'https://lh5.googleusercontent.com/-dWfCGFsaLKw/VDOYrfjU0LI/AAAAAAAAALg/8uAq2QPeO-U/s800/014.jpg'),
(46, 4, '2014-10-07', 'H13', 'https://lh6.googleusercontent.com/-yZVHXJQOdbs/VDOYsS2pmfI/AAAAAAAAALo/Rqydy0p3-C4/s800/015.jpg'),
(47, 4, '2014-10-07', 'H14', 'https://lh3.googleusercontent.com/-FGIim8mCThs/VDOYti1NZ-I/AAAAAAAAAL0/VNlzXKrw92Y/s800/016.jpg'),
(48, 4, '2014-10-07', 'H15', 'https://lh4.googleusercontent.com/-zU6MRPpErEc/VDOYuFbo4aI/AAAAAAAAAL8/vy-uw1fWWiU/s800/017.jpg'),
(49, 4, '2014-10-07', 'H16', 'https://lh4.googleusercontent.com/-weeCZe2f97I/VDOYu_-9bGI/AAAAAAAAAME/QRa5UbGHW1k/s800/018.jpg'),
(50, 4, '2014-10-07', 'H17', 'https://lh3.googleusercontent.com/-_0M5264p_tg/VDOYv0E0VBI/AAAAAAAAAMQ/3ZbQMa-2f6g/s800/019.jpg'),
(51, 4, '2014-10-07', 'H18', 'https://lh3.googleusercontent.com/-zPxhB7UuntA/VDOYwtx5fCI/AAAAAAAAAMY/Vp_fL6jgWKI/s800/020.jpg'),
(52, 4, '2014-10-07', 'H19', 'https://lh3.googleusercontent.com/-Z8Xcu8r-2CE/VDOYxWkSlhI/AAAAAAAAAMg/NzoLEggd--Q/s800/021.jpg'),
(53, 4, '2014-10-07', 'H20', 'https://lh3.googleusercontent.com/-UzJeWw6vPJ8/VDOYyId3S8I/AAAAAAAAAMo/pAbld-wrxdc/s800/022.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_linked`
--

CREATE TABLE IF NOT EXISTS `tbl_linked` (
`id` int(11) NOT NULL,
  `name` varchar(120) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `logo` varchar(150) NOT NULL,
  `website` varchar(150) NOT NULL,
  `note` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `order` int(11) NOT NULL,
  `key` varchar(150) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_linked`
--

INSERT INTO `tbl_linked` (`id`, `name`, `logo`, `website`, `note`, `order`, `key`) VALUES
(1, 'Đài Phát Thanh TH Đồng Tháp', 'https://lh6.googleusercontent.com/-PsSuQlUufeI/VE5pKvm5gfI/AAAAAAAAAAg/d59Ve04zHtY/s288/LogoTHDT.png', 'http://thdt.vn/', 'Đài Phát Thanh TH Đồng Tháp', 1, 'dai-phat-thanh-th-dong-thap'),
(2, 'Công Ty Cổ Phần Du Lịch Đồng Tháp', 'https://lh3.googleusercontent.com/-K8ddN6st6Pc/VE5seiGS72I/AAAAAAAAABI/HT97rJAM_q4/s800/logoDuLichDongThap.jpg', 'http://dongthaptourist.com', 'Công Ty Cổ Phần Du Lịch Đồng Tháp', 2, 'cong-ty-co-phan-du-lich-dong-thap'),
(3, 'Hồng Sen Tửu', 'https://lh6.googleusercontent.com/-Cd1qdYkQJik/VE5pLLEfVCI/AAAAAAAAAAs/r2VWRvneI9k/s288/logoHongSenTuu.jpg', 'http://hongsentuu.com/', 'Hồng Sen Tửu', 3, 'hong-sen-tuu'),
(4, 'Khu Du Lịch Gáo Giồng', 'https://lh3.googleusercontent.com/-LMf5OfY4yF0/VE9YSBhjh6I/AAAAAAAAADY/Bvq3UOpGya0/s800/logoGaoGiong.png', 'http://dulichgaogiong.com/', 'Khu Du Lịch Gáo Giồng', 4, 'khu-du-lich-gao-giong'),
(5, 'Vườn quốc gia Tràm Chim Tam Nông', 'https://lh3.googleusercontent.com/-_qCsGIRWpwQ/VE9asJhbOII/AAAAAAAAADk/3DR11GMysZU/s800/logoTramChim.png', 'http://tramchim.com.vn/', 'Vườn quốc gia Tràm Chim Tam Nông', 5, 'vuon-quoc-gia-tram-chim-tam-nong');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_manufacturer`
--

CREATE TABLE IF NOT EXISTS `tbl_manufacturer` (
`id` int(11) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(150) NOT NULL,
  `order` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_manufacturer`
--

INSERT INTO `tbl_manufacturer` (`id`, `name`, `image`, `order`) VALUES
(16, 'Bia Việt Nam', 'https://lh4.googleusercontent.com/-H9QITMmqsUQ/U1fwdfbPsVI/AAAAAAAAAFM/W7URoxH_6kc/s800/seriesthi-1374916795.jpg', 2),
(29, 'Trong Nước', '', 3),
(30, 'Nhập Khẩu', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_post`
--

CREATE TABLE IF NOT EXISTS `tbl_post` (
`id` int(11) NOT NULL,
  `title` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `author` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `time` datetime NOT NULL,
  `count` int(11) NOT NULL,
  `viewed` int(11) NOT NULL,
  `liked` int(11) NOT NULL,
  `key` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_post`
--

INSERT INTO `tbl_post` (`id`, `title`, `content`, `author`, `time`, `count`, `viewed`, `liked`, `key`) VALUES
(69, 'Dịch vụ chăm sóc đồ da cao cấp', '\r\nimage016\r\n\r\nBạn có những món đồ da cao cấp và quý giá, như chiếc ví, dây lưng, túi xách hay có thể là bộ ghế salon… theo thời gian sử dụng bị xuống cấp và đôi khi có thể gặp tai nạn đáng tiếc như xước, rách, bạc màu. Với Báo Đỏ Furniture, thay mới không phải là giải pháp duy nhất. Chúng tôi với đầy đủ công nghệ, những kỹ thuật viên được đào tạo bài bản và giàu kinh nghiệm cùng sản phẩm chăm sóc da, nội thất hàng đầu thế giới tự tin sẽ làm cho bạn bất ngờ và hài lòng.\r\n\r\nBáo Đỏ Furniture mang đến cho bạn các dịch vụ với chất lượng toàn diện:  \r\n\r\n- Tư vấn sử dụng và chăm sóc đồ da hiệu quả\r\n\r\n- Chăm sóc, làm mới đồ da\r\n\r\n- Sửa chữa, phục chế đồ da\r\n\r\nDòng sản phẩm cao cấp Furniture Clinic được nhập khẩu từ Vương quốc Anh, quốc gia hàng đầu về công nghệ da trên thế giới. Với công nghệ phục hồi da tiên tiến nhất,dòng sản phẩm Furniture Clinic giúp xử lý các vấn đề đối với các sản phẩm bằng da mà chúng ta rất quan tâm như phai màu, bong tróc, trầy xước, rách, cháy, thủng... mà việc thay thế và bọc lại rất tốn kém và làm mất đi tính thẩm mỹ.', 'BBT', '0000-00-00 00:00:00', 0, 0, 0, ''),
(70, 'Đồ da cao cấp EASH giảm giá 50% cho Hội viên NShape', '<div class="desc" style="color: rgb(0, 0, 0); font-family: arial; font-size: 13px; line-height: 18px;">\r\n	EASH l&agrave; nh&agrave; ph&acirc;n phối v&agrave; l&agrave; đại l&yacute; độc quyền của c&aacute;c thương hiệu Ch&acirc;u &Acirc;u như Gino Rossi, Tosca Blu, ..., được franchise tại Việt Nam những thương hiệu quốc tế Mammut, Bossanjerasu.</div>\r\n<div class="content" style="color: rgb(0, 0, 0); font-family: arial; font-size: 13px; line-height: 18px;">\r\n	<p style="text-align: justify;">\r\n		Tặng voucher giảm 50% cho Hội vi&ecirc;n NShape<br />\r\n		Tặng thẻ Sapphire kh&ocirc;ng cần t&iacute;ch điểm<br />\r\n		Vui l&ograve;ng li&ecirc;n hệ Lễ t&acirc;n để lấy voucher</p>\r\n	<p style="text-align: center;">\r\n		<img alt="" src="http://nshape.hanoicdc.net/uploads/images/userfiles/5.khuyenmai/eash_nshape_fitness.jpg" style="border: 0px; max-width: 100%;" /></p>\r\n	<p>\r\n		<br />\r\n		<br />\r\n		Hệ thống cửa h&agrave;ng của EASH:<br />\r\n		1. EASH B&agrave; Triệu: Gian h&agrave;ng L3-K4, tầng 3 TTTM Vincom 2, số 191 B&agrave; Triệu, Hai B&agrave; Trưng, H&agrave; Nội. ĐT : 04 222 06912<br />\r\n		2. EASH Royal: B1-R3-22, tầng B1, TTTM Royal City, số 72A Nguyễn Tr&atilde;i, Thanh Xu&acirc;n, H&agrave; Nội. ĐT: 04 666 42289<br />\r\n		3. GINO ROSSI: B1-R6-37, tầng B1, TTTM Royal City, số 72A Nguyễn Tr&atilde;i, Thanh Xu&acirc;n, H&agrave; Nội.&nbsp; ĐT : 04 66818185<br />\r\n		4. TOSCA BLU: Tầng 2, Diamond Plaza, số 34 L&ecirc; Duẩn, Quận 1, TP. Hồ Ch&iacute; Minh. ĐT: 08 627 29863<br />\r\n		5. EASH Times City: Số 14 đường Thanh Ni&ecirc;n, tầng B1, TTTM Times City, 458 Minh Khai, Ho&agrave;ng Mai, H&agrave; Nội. ĐT : 043 200 7599<br />\r\n		6. EASH Long Bi&ecirc;n: Gian h&agrave;ng L1-22, tầng 1 TTTM Vincom Long Bi&ecirc;n, S&agrave;i Đồng, Long Bi&ecirc;n, H&agrave; Nội. ĐT : 043 657 4517<br />\r\n		7. EASH T&acirc;y Sơn: Ph&ograve;ng 1102, tầng 11, t&ograve;a nh&agrave; Oriental, số 324 T&acirc;y Sơn, Đống Đa, H&agrave; Nội. ĐT : 090 741 2222<br />\r\n		http://eash.vn/</p>\r\n</div>\r\n<p>\r\n	&nbsp;</p>\r\n', 'nshapefitness.vn', '0000-00-00 00:00:00', 100, 0, 0, 'do-da-cao-cap-eash-giam-gia-50-cho-hoi-vien-nshape-1428294648'),
(71, 'EASH’s Clearance Sale', '<p align="center" style="box-sizing: border-box; margin: 10px 0px; color: rgb(51, 51, 51); font-family: Arial; line-height: 15.6000003814697px;">\r\n	<strong style="box-sizing: border-box; font-family: arial, helvetica, sans-serif; font-size: 14px;"><em style="box-sizing: border-box;">Từ 25/2/2014 đến 31/3/2014, để ch&agrave;o đ&oacute;n Quốc tế phụ nữ v&agrave; Valentine trắng, &ldquo;EASH&rsquo;s Clearance Sale&rdquo; ưu đ&atilde;i cực đ&atilde;, giảm gi&aacute; tới 70% c&ugrave;ng h&agrave;ng loạt những sản phẩm đồng gi&aacute; kh&aacute;c.</em></strong></p>\r\n<p style="box-sizing: border-box; margin: 10px 0px; color: rgb(51, 51, 51); font-family: Arial; line-height: 15.6000003814697px;">\r\n	<span style="box-sizing: border-box; font-size: 14px;"><span style="box-sizing: border-box; font-family: arial, helvetica, sans-serif;">Th&aacute;ng 3 mở m&agrave;n rộn r&agrave;ng với ng&agrave;y t&ocirc;n vinh một nửa thế giới 8/3. C&ugrave;ng với đ&oacute;, Valentine trắng l&agrave; một dịp l&atilde;ng mạn cho tất thảy những cặp đ&ocirc;i y&ecirc;u nhau được một lần nữa thể hiện t&igrave;nh cảm của m&igrave;nh.</span></span></p>\r\n<p style="box-sizing: border-box; margin: 10px 0px; color: rgb(51, 51, 51); font-family: Arial; line-height: 15.6000003814697px;">\r\n	<span style="box-sizing: border-box; font-size: 14px;"><span style="box-sizing: border-box; font-family: arial, helvetica, sans-serif;">Nh&acirc;n dịp n&agrave;y, EASH mở chương tr&igrave;nh &ldquo;EASH&rsquo;s Clearance Sale&rdquo; giảm gi&aacute; tới 70% tr&ecirc;n tất cả c&aacute;c mặt h&agrave;ng. Ngo&agrave;i ra, EASH đồng gi&aacute; thắt lưng từ 150K, v&iacute; từ 690K, t&uacute;i từ 1220K, gi&agrave;y từ 1690K v&agrave; nhiều sản phẩm đồng gi&aacute; kh&aacute;c.</span></span></p>\r\n<p style="box-sizing: border-box; margin: 10px 0px; color: rgb(51, 51, 51); font-family: Arial; line-height: 15.6000003814697px;">\r\n	<span style="box-sizing: border-box; font-size: 14px;"><span style="box-sizing: border-box; font-family: arial, helvetica, sans-serif;">EASH hiện l&agrave; hệ thống ph&acirc;n phối độc quyền đồ da cao cấp của hơn 10 thương hiệu tại ch&acirc;u &Acirc;u như Gino Rossi, Tosca Blu, Chiarugi&hellip; Những sản phẩm từ da thật với thiết kế tinh tế, kiểu d&aacute;ng đa dạng l&agrave; sự kết hợp thời trang h&agrave;i h&ograve;a, độc đ&aacute;o của hai ch&acirc;u lục &Acirc;u &Aacute;, mang đến cho người Việt Nam những trải nghiệm ti&ecirc;u d&ugrave;ng chất lượng v&agrave; ph&ugrave; hợp nhất. Từ thắt lưng, t&uacute;i x&aacute;ch, v&iacute; đến gi&agrave;y da&hellip; c&aacute;c sản phẩm đều c&oacute; sự giao thoa giữa hai nền văn h&oacute;a trong những thiết kế sang trọng v&agrave; đầy c&aacute; t&iacute;nh.</span></span></p>\r\n<p style="box-sizing: border-box; margin: 10px 0px; color: rgb(51, 51, 51); font-family: Arial; line-height: 15.6000003814697px;">\r\n	<span style="box-sizing: border-box; font-size: 14px;"><span style="box-sizing: border-box; font-family: arial, helvetica, sans-serif;">Sự phong ph&uacute; v&agrave; hấp dẫn của những sản phẩm đồ da ch&acirc;u &Acirc;u tại EASH chắc chắn sẽ l&agrave;m cho c&aacute;c t&iacute;n đồ thời trang phải xi&ecirc;u l&ograve;ng.</span></span></p>\r\n<p style="box-sizing: border-box; margin: 10px 0px; color: rgb(51, 51, 51); font-family: Arial; line-height: 15.6000003814697px; text-align: center;">\r\n	<img alt="" src="http://gurkha.vn/sites/default/files/1_12.jpg" style="box-sizing: border-box; border: 0px; vertical-align: middle; max-width: 100%; height: 400px; width: 600px;" /></p>\r\n<p style="box-sizing: border-box; margin: 10px 0px; color: rgb(51, 51, 51); font-family: Arial; line-height: 15.6000003814697px; text-align: center;">\r\n	<span style="box-sizing: border-box; font-size: 14px;"><span style="box-sizing: border-box; font-family: arial, helvetica, sans-serif;">Những mẫu t&uacute;i x&aacute;ch EFORA l&agrave; sự kết hợp ho&agrave;n hảo của phong c&aacute;ch thời trang giữa hai ch&acirc;u lục, đ&uacute;ng như t&ecirc;n gọi &ldquo;Europe for Asia&rdquo;.</span></span></p>\r\n<p style="box-sizing: border-box; margin: 10px 0px; color: rgb(51, 51, 51); font-family: Arial; line-height: 15.6000003814697px; text-align: center;">\r\n	<span style="box-sizing: border-box; font-size: 14px;"><span style="box-sizing: border-box; font-family: arial, helvetica, sans-serif;">Gi&aacute; ni&ecirc;m yết&nbsp;<strike style="box-sizing: border-box;">4.960.000 VNĐ</strike>&nbsp;chỉ c&ograve;n 1.800.000 VNĐ</span></span></p>\r\n<p style="box-sizing: border-box; margin: 10px 0px; color: rgb(51, 51, 51); font-family: Arial; line-height: 15.6000003814697px; text-align: center;">\r\n	<img alt="" src="http://gurkha.vn/sites/default/files/2_13.jpg" style="box-sizing: border-box; border: 0px; vertical-align: middle; max-width: 100%; height: 400px; width: 600px;" /></p>\r\n<p style="box-sizing: border-box; margin: 10px 0px; color: rgb(51, 51, 51); font-family: Arial; line-height: 15.6000003814697px; text-align: center;">\r\n	<span style="box-sizing: border-box; font-size: 14px;"><span style="box-sizing: border-box; font-family: arial, helvetica, sans-serif;">Gi&aacute; ni&ecirc;m yết&nbsp;<strike style="box-sizing: border-box;">4.480.000 VNĐ</strike>&nbsp;chỉ c&ograve;n 1.800.000 VNĐ</span></span></p>\r\n<p style="box-sizing: border-box; margin: 10px 0px; color: rgb(51, 51, 51); font-family: Arial; line-height: 15.6000003814697px; text-align: center;">\r\n	<img alt="" src="http://gurkha.vn/sites/default/files/3_14.jpg" style="box-sizing: border-box; border: 0px; vertical-align: middle; max-width: 100%; height: 400px; width: 600px;" /></p>\r\n<p style="box-sizing: border-box; margin: 10px 0px; color: rgb(51, 51, 51); font-family: Arial; line-height: 15.6000003814697px; text-align: center;">\r\n	<span style="box-sizing: border-box; font-size: 14px;"><span style="box-sizing: border-box; font-family: arial, helvetica, sans-serif;">Trẻ trung, kh&aacute;c biệt với những mẫu t&uacute;i Tosca Blu thời thượng v&agrave; phong c&aacute;ch.</span></span></p>\r\n<p style="box-sizing: border-box; margin: 10px 0px; color: rgb(51, 51, 51); font-family: Arial; line-height: 15.6000003814697px; text-align: center;">\r\n	<span style="box-sizing: border-box; font-size: 14px;"><span style="box-sizing: border-box; font-family: arial, helvetica, sans-serif;">Gi&aacute; ni&ecirc;m yết&nbsp;<strike style="box-sizing: border-box;">6.480.000 VNĐ</strike>&nbsp;chỉ c&ograve;n 3.000.000 VNĐ</span></span></p>\r\n<p style="box-sizing: border-box; margin: 10px 0px; color: rgb(51, 51, 51); font-family: Arial; line-height: 15.6000003814697px; text-align: center;">\r\n	<img alt="" src="http://gurkha.vn/sites/default/files/4_7.jpg" style="box-sizing: border-box; border: 0px; vertical-align: middle; max-width: 100%; height: 400px; width: 600px;" /></p>\r\n<p style="box-sizing: border-box; margin: 10px 0px; color: rgb(51, 51, 51); font-family: Arial; line-height: 15.6000003814697px; text-align: center;">\r\n	<span style="box-sizing: border-box; font-size: 14px;"><span style="box-sizing: border-box; font-family: arial, helvetica, sans-serif;">D&aacute;ng t&uacute;i quai ngắn điệu đ&agrave; của Tosca Blu.</span></span></p>\r\n<p style="box-sizing: border-box; margin: 10px 0px; color: rgb(51, 51, 51); font-family: Arial; line-height: 15.6000003814697px; text-align: center;">\r\n	<span style="box-sizing: border-box; font-size: 14px;"><span style="box-sizing: border-box; font-family: arial, helvetica, sans-serif;">Gi&aacute; ni&ecirc;m yết:&nbsp;<strike style="box-sizing: border-box;">12.579.000 VNĐ</strike>&nbsp;chỉ c&ograve;n 4.500.000 VNĐ</span></span></p>\r\n<p style="box-sizing: border-box; margin: 10px 0px; color: rgb(51, 51, 51); font-family: Arial; line-height: 15.6000003814697px; text-align: center;">\r\n	<img alt="" src="http://gurkha.vn/sites/default/files/5_8.jpg" style="box-sizing: border-box; border: 0px; vertical-align: middle; max-width: 100%; height: 642px; width: 960px;" /></p>\r\n<p style="box-sizing: border-box; margin: 10px 0px; color: rgb(51, 51, 51); font-family: Arial; line-height: 15.6000003814697px; text-align: center;">\r\n	<span style="box-sizing: border-box; font-size: 14px;"><span style="box-sizing: border-box; font-family: arial, helvetica, sans-serif;">Chất liệu da thật mềm mại v&agrave; kiểu d&aacute;ng hiện đại l&agrave; n&eacute;t quyến rũ cho chiếc t&uacute;i Tosca Blu</span></span></p>\r\n<p style="box-sizing: border-box; margin: 10px 0px; color: rgb(51, 51, 51); font-family: Arial; line-height: 15.6000003814697px; text-align: center;">\r\n	<span style="box-sizing: border-box; font-size: 14px;"><span style="box-sizing: border-box; font-family: arial, helvetica, sans-serif;">Gi&aacute; ni&ecirc;m yết&nbsp;<strike style="box-sizing: border-box;">13.440.000 VNĐ</strike>&nbsp;chỉ c&ograve;n 4.500.000 VNĐ</span></span></p>\r\n<p style="box-sizing: border-box; margin: 10px 0px; color: rgb(51, 51, 51); font-family: Arial; line-height: 15.6000003814697px; text-align: center;">\r\n	<img alt="" src="http://gurkha.vn/sites/default/files/6_5.jpg" style="box-sizing: border-box; border: 0px; vertical-align: middle; max-width: 100%; height: 400px; width: 600px;" /></p>\r\n<p style="box-sizing: border-box; margin: 10px 0px; color: rgb(51, 51, 51); font-family: Arial; line-height: 15.6000003814697px; text-align: center;">\r\n	<span style="box-sizing: border-box; font-size: 14px;"><span style="box-sizing: border-box; font-family: arial, helvetica, sans-serif;">M&agrave;u hồng trẻ trung v&agrave; d&aacute;ng t&uacute;i big size đầy năng động.</span></span></p>\r\n<p style="box-sizing: border-box; margin: 10px 0px; color: rgb(51, 51, 51); font-family: Arial; line-height: 15.6000003814697px; text-align: center;">\r\n	<span style="box-sizing: border-box; font-size: 14px;"><span style="box-sizing: border-box; font-family: arial, helvetica, sans-serif;">Gi&aacute; ni&ecirc;m yết&nbsp;<strike style="box-sizing: border-box;">7.360.000 VNĐ</strike>&nbsp;chỉ c&ograve;n 3.000.000 VNĐ</span></span></p>\r\n<p style="box-sizing: border-box; margin: 10px 0px; color: rgb(51, 51, 51); font-family: Arial; line-height: 15.6000003814697px; text-align: center;">\r\n	<img alt="" src="http://gurkha.vn/sites/default/files/7_3.jpg" style="box-sizing: border-box; border: 0px; vertical-align: middle; max-width: 100%; height: 960px; width: 720px;" /></p>\r\n<p style="box-sizing: border-box; margin: 10px 0px; color: rgb(51, 51, 51); font-family: Arial; line-height: 15.6000003814697px;">\r\n	<span style="box-sizing: border-box; font-size: 14px;"><span style="box-sizing: border-box; font-family: arial, helvetica, sans-serif;">Những mẫu gi&agrave;y độc đ&aacute;o v&agrave; ph&aacute; c&aacute;ch xuất xứ từ Italy.</span></span></p>\r\n<p style="box-sizing: border-box; margin: 10px 0px; color: rgb(51, 51, 51); font-family: Arial; line-height: 15.6000003814697px; text-align: center;">\r\n	<span style="box-sizing: border-box; font-size: 14px;"><span style="box-sizing: border-box; font-family: arial, helvetica, sans-serif;"><img alt="" src="http://gurkha.vn/sites/default/files/10_10.jpg" style="box-sizing: border-box; border: 0px; vertical-align: middle; max-width: 100%; height: 367px; width: 391px;" /></span></span></p>\r\n<p style="box-sizing: border-box; margin: 10px 0px; color: rgb(51, 51, 51); font-family: Arial; line-height: 15.6000003814697px; text-align: center;">\r\n	<span style="box-sizing: border-box; font-size: 14px;"><span style="box-sizing: border-box; font-family: arial, helvetica, sans-serif;">Gi&agrave;y nam gi&aacute; ni&ecirc;m yết từ&nbsp;<strike style="box-sizing: border-box;">4.500.000 &ndash; 4.790.000 VNĐ</strike>&nbsp;c&ograve;n 2.290.000 VNĐ</span></span></p>\r\n<p style="box-sizing: border-box; margin: 10px 0px; color: rgb(51, 51, 51); font-family: Arial; line-height: 15.6000003814697px; text-align: center;">\r\n	<span style="box-sizing: border-box; font-size: 14px;"><span style="box-sizing: border-box; font-family: arial, helvetica, sans-serif;"><img alt="" src="http://gurkha.vn/sites/default/files/11_8.jpg" style="box-sizing: border-box; border: 0px; vertical-align: middle; max-width: 100%; height: 400px; width: 600px;" /></span></span></p>\r\n<p style="box-sizing: border-box; margin: 10px 0px; color: rgb(51, 51, 51); font-family: Arial; line-height: 15.6000003814697px; text-align: center;">\r\n	<span style="box-sizing: border-box; font-size: 14px;"><span style="box-sizing: border-box; font-family: arial, helvetica, sans-serif;">Gi&agrave;y cao g&oacute;t nữ gi&aacute; ni&ecirc;m yết&nbsp;<strike style="box-sizing: border-box;">4.922.000 VNĐ&nbsp;</strike>chỉ c&ograve;n 1.690.000 VNĐ</span></span></p>\r\n<p style="box-sizing: border-box; margin: 10px 0px; color: rgb(51, 51, 51); font-family: Arial; line-height: 15.6000003814697px; text-align: center;">\r\n	&nbsp;</p>\r\n<p style="box-sizing: border-box; margin: 10px 0px; color: rgb(51, 51, 51); font-family: Arial; line-height: 15.6000003814697px; text-align: center;">\r\n	<img alt="" src="http://gurkha.vn/sites/default/files/12_10.jpg" style="box-sizing: border-box; border: 0px; vertical-align: middle; max-width: 100%; height: 346px; width: 373px;" /></p>\r\n<p style="box-sizing: border-box; margin: 10px 0px; color: rgb(51, 51, 51); font-family: Arial; line-height: 15.6000003814697px; text-align: center;">\r\n	<span style="box-sizing: border-box; font-size: 14px;"><span style="box-sizing: border-box; font-family: arial, helvetica, sans-serif;">Những kiểu d&aacute;ng v&iacute; hiện đại từ những nh&agrave; thiết kế h&agrave;ng đầu, li&ecirc;n tục cập nhật c&aacute;c xu hướng thời trang tr&ecirc;n thế giới.</span></span></p>\r\n<p style="box-sizing: border-box; margin: 10px 0px; color: rgb(51, 51, 51); font-family: Arial; line-height: 15.6000003814697px; text-align: center;">\r\n	<span style="box-sizing: border-box; font-size: 14px;"><span style="box-sizing: border-box; font-family: arial, helvetica, sans-serif;">Gi&aacute; ni&ecirc;m yết :&nbsp;<strike style="box-sizing: border-box;">2.280.000 VNĐ v&agrave; 2.480.000 VNĐ</strike></span></span></p>\r\n<p style="box-sizing: border-box; margin: 10px 0px; color: rgb(51, 51, 51); font-family: Arial; line-height: 15.6000003814697px; text-align: center;">\r\n	<span style="box-sizing: border-box; font-size: 14px;"><span style="box-sizing: border-box; font-family: arial, helvetica, sans-serif;">Gi&aacute; trong chương tr&igrave;nh: 800 000 VNĐ</span></span></p>\r\n<p style="box-sizing: border-box; margin: 10px 0px; color: rgb(51, 51, 51); font-family: Arial; line-height: 15.6000003814697px; text-align: center;">\r\n	<img alt="" src="http://gurkha.vn/sites/default/files/14_8.jpg" style="box-sizing: border-box; border: 0px; vertical-align: middle; max-width: 100%; height: 400px; width: 600px;" /></p>\r\n<p style="box-sizing: border-box; margin: 10px 0px; color: rgb(51, 51, 51); font-family: Arial; line-height: 15.6000003814697px;">\r\n	<span style="box-sizing: border-box; font-size: 14px;"><span style="box-sizing: border-box; font-family: arial, helvetica, sans-serif;">Thắt lưng l&agrave; item nhỏ nhưng kh&ocirc;ng thể thiếu cho bộ trang phục th&ecirc;m lịch l&atilde;m, chỉn chu.</span></span></p>\r\n<p style="box-sizing: border-box; margin: 10px 0px; color: rgb(51, 51, 51); font-family: Arial; line-height: 15.6000003814697px;">\r\n	<span style="box-sizing: border-box; font-size: 14px;"><span style="box-sizing: border-box; font-family: arial, helvetica, sans-serif;">Thắt lưng đồng gi&aacute; 150.000 VNĐ</span></span></p>\r\n<p style="box-sizing: border-box; margin: 10px 0px; color: rgb(51, 51, 51); font-family: Arial; line-height: 15.6000003814697px;">\r\n	<span style="box-sizing: border-box; font-size: 14px;"><span style="box-sizing: border-box; font-family: arial, helvetica, sans-serif;">Để c&oacute; được những trải nghiệm tuyệt vời, vui l&ograve;ng li&ecirc;n hệ hệ thống ph&acirc;n phối đồ da cao cấp EASH:</span></span></p>\r\n<p style="box-sizing: border-box; margin: 10px 0px; color: rgb(51, 51, 51); font-family: Arial; line-height: 15.6000003814697px;">\r\n	<span style="box-sizing: border-box; font-size: 14px;"><span style="box-sizing: border-box; font-family: arial, helvetica, sans-serif;">Hotline : 090 741 2222</span></span></p>\r\n<p style="box-sizing: border-box; margin: 10px 0px; color: rgb(51, 51, 51); font-family: Arial; line-height: 15.6000003814697px;">\r\n	<span style="box-sizing: border-box; font-size: 14px;"><span style="box-sizing: border-box; font-family: arial, helvetica, sans-serif;">Website :&nbsp;<a href="http://hn.24h.com.vn/redirectout.php?to=aHR0cDovL3d3dy5lYXNoLnZu" style="box-sizing: border-box; color: rgb(66, 139, 202); text-decoration: none; background: transparent;" target="_blank">www.eash.vn</a></span></span></p>\r\n<p style="box-sizing: border-box; margin: 10px 0px; color: rgb(51, 51, 51); font-family: Arial; line-height: 15.6000003814697px;">\r\n	<span style="box-sizing: border-box; font-size: 14px;"><span style="box-sizing: border-box; font-family: arial, helvetica, sans-serif;">Facebook:&nbsp;<a href="https://www.facebook.com/EASH.VN" style="box-sizing: border-box; color: rgb(66, 139, 202); text-decoration: none; background: transparent;">https://www.facebook.com/EASH.VN</a></span></span></p>\r\n<p style="box-sizing: border-box; margin: 10px 0px; color: rgb(51, 51, 51); font-family: Arial; line-height: 15.6000003814697px;">\r\n	<span style="box-sizing: border-box; font-size: 14px;"><span style="box-sizing: border-box; font-family: arial, helvetica, sans-serif;">Chương tr&igrave;nh &aacute;p dụng tại c&aacute;c cửa h&agrave;ng:</span></span></p>\r\n<p style="box-sizing: border-box; margin: 10px 0px; color: rgb(51, 51, 51); font-family: Arial; line-height: 15.6000003814697px;">\r\n	<span style="box-sizing: border-box; font-size: 14px;"><span style="box-sizing: border-box; font-family: arial, helvetica, sans-serif;"><strong style="box-sizing: border-box;">EASH B&agrave; Triệu</strong>: Gian h&agrave;ng L3-K4, tầng 3 TTTM Vincom 2, số 191 B&agrave; Triệu, Hai B&agrave; Trưng, H&agrave; Nội.</span></span></p>\r\n<p style="box-sizing: border-box; margin: 10px 0px; color: rgb(51, 51, 51); font-family: Arial; line-height: 15.6000003814697px;">\r\n	<span style="box-sizing: border-box; font-size: 14px;"><span style="box-sizing: border-box; font-family: arial, helvetica, sans-serif;"><strong style="box-sizing: border-box;">EASH Royal</strong>: B1-R3-22, tầng B1, TTTM Royal City, số 72A Nguyễn Tr&atilde;i, Thanh Xu&acirc;n, H&agrave; Nội.</span></span></p>\r\n<p style="box-sizing: border-box; margin: 10px 0px; color: rgb(51, 51, 51); font-family: Arial; line-height: 15.6000003814697px;">\r\n	<span style="box-sizing: border-box; font-size: 14px;"><span style="box-sizing: border-box; font-family: arial, helvetica, sans-serif;"><strong style="box-sizing: border-box;">Gino Rossi:</strong>&nbsp;B1-R6-37, tầng B1, TTTM Royal City, số 72A Nguyễn Tr&atilde;i, Thanh Xu&acirc;n, H&agrave; Nội.</span></span></p>\r\n<p style="box-sizing: border-box; margin: 10px 0px; color: rgb(51, 51, 51); font-family: Arial; line-height: 15.6000003814697px;">\r\n	<span style="box-sizing: border-box; font-size: 14px;"><span style="box-sizing: border-box; font-family: arial, helvetica, sans-serif;"><strong style="box-sizing: border-box;">EASH Times City:</strong>&nbsp;Số 14 đường Thanh Ni&ecirc;n, tầng B1, TTTM Times City, 458 Minh Khai, Ho&agrave;ng Mai, H&agrave; Nội.</span></span></p>\r\n', 'www.eash.vn', '0000-00-00 00:00:00', 0, 1, 0, 'eashs-clearance-sale-1428294689'),
(72, 'Vẻ quyến rũ của đồ da cao cấp', '<header style="box-sizing: border-box; margin: 8px 0px 0px; padding: 0px; border: 0px; outline: 0px; font-size: 14px; vertical-align: baseline; color: rgb(0, 0, 0); font-family: Arial, sans-serif; line-height: 18px; background: transparent;">\r\n	<div class="summary" style="box-sizing: border-box; margin: 0px; padding: 8px 0px; border: 0px; outline: 0px; font-size: 1.16em; vertical-align: baseline; color: rgb(68, 68, 68); line-height: 1.4; font-family: ''Times New Roman'', Times, serif; font-weight: bold; background: transparent;">\r\n		<p itemprop="description" style="box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; outline: 0px; font-size: 16.2399997711182px; vertical-align: baseline; background: transparent;">\r\n			Bất biến với thời gian bởi sự thanh lịch qu&yacute; ph&aacute;i, những chiếc t&uacute;i da hay gi&agrave;y da của Dolly lu&ocirc;n l&agrave; niềm mơ ước của những người say m&ecirc; thời trang.</p>\r\n	</div>\r\n</header>\r\n<article style="box-sizing: border-box; margin: 0px 20px 0px 0px; padding: 0px; border: 0px; outline: 0px; font-size: 14px; vertical-align: baseline; float: left; position: inherit; z-index: 1; width: 480px; color: rgb(0, 0, 0); cursor: default; font-family: Arial, sans-serif; line-height: 18px; background: transparent;">\r\n	<div class="content" itemprop="articleBody" style="box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; outline: 0px; font-size: 1.16em; vertical-align: baseline; font-family: ''Times New Roman'', Times, serif; line-height: 1.4; background: transparent;">\r\n		<table cellpadding="0" cellspacing="0" class="picture" style="box-sizing: border-box; margin: 8px 0px; padding: 0px; border: 0px; outline: 0px; font-size: 12px; vertical-align: baseline; border-collapse: collapse; border-spacing: 0px; width: 480px; font-family: Arial, Helvetica, sans-serif; line-height: 14px; color: rgb(51, 51, 51); clear: both; position: relative; background: transparent;">\r\n			<tbody style="box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent;">\r\n				<tr style="box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent;">\r\n					<td class="pic" style="box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; position: relative; background: transparent;">\r\n						<img alt="Vẻ quyến rũ của đồ da cao cấp" src="http://img.v3.news.zdn.vn/w660/Uploaded/JAC2_N3/2013_11_05/An_tuong_bo_suu_tap_da_cao_cap_cua_Dolly_1.jpg" style="box-sizing: border-box; margin: 0px 0px -3px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; max-width: 100%; width: 480px; height: auto; cursor: pointer; background: transparent;" /></td>\r\n				</tr>\r\n				<tr style="box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent;">\r\n				</tr>\r\n			</tbody>\r\n		</table>\r\n		<p style="box-sizing: border-box; margin: 8px 0px; padding: 0px; border: 0px; outline: 0px; font-size: 16.2399997711182px; vertical-align: baseline; background: transparent;">\r\n			Sự quyến rũ đến từ c&aacute;c sản phẩm l&agrave;m bằng chất liệu da thật c&ograve;n đến từ cảm gi&aacute;c mềm mại v&agrave; &ecirc;m &aacute;i như việc bạn đang &ocirc;m ấp một ch&uacute; m&egrave;o con đ&aacute;ng y&ecirc;u.</p>\r\n		<p style="box-sizing: border-box; margin: 8px 0px; padding: 0px; border: 0px; outline: 0px; font-size: 16.2399997711182px; vertical-align: baseline; background: transparent;">\r\n			So với c&aacute;c chất liệu kh&aacute;c, sản phẩm l&agrave;m từ chất liệu da thật lu&ocirc;n c&oacute; gi&aacute; cao hơn, mang đến sự sang trọng v&agrave; đẳng cấp cho người sử dụng. Với chất liệu n&agrave;y, Dolly đ&atilde; l&agrave;m lu&ocirc;n l&agrave;m mới c&aacute;c sản phẩm của m&igrave;nh bằng c&aacute;ch cho ra đời những sản phẩm h&agrave;i h&ograve;a về m&agrave;u sắc v&agrave; thiết kế nhưng kh&ocirc;ng k&eacute;m phần tinh tế để c&oacute; thể đ&aacute;p ứng được nhu cầu ng&agrave;y c&agrave;ng cao của ph&aacute;i đẹp.</p>\r\n		<table cellpadding="0" cellspacing="0" class="picture" style="box-sizing: border-box; margin: 8px 0px; padding: 0px; border: 0px; outline: 0px; font-size: 12px; vertical-align: baseline; border-collapse: collapse; border-spacing: 0px; width: 480px; font-family: Arial, Helvetica, sans-serif; line-height: 14px; color: rgb(51, 51, 51); clear: both; position: relative; background: transparent;">\r\n			<tbody style="box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent;">\r\n				<tr style="box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent;">\r\n					<td class="pic" style="box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; position: relative; background: transparent;">\r\n						<img alt="Vẻ quyến rũ của đồ da cao cấp" src="http://img.v3.news.zdn.vn/w660/Uploaded/JAC2_N3/2013_11_05/An_tuong_bo_suu_tap_da_cao_cap_cua_Dolly_3.jpg" style="box-sizing: border-box; margin: 0px 0px -3px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; max-width: 100%; width: 480px; height: auto; cursor: pointer; background: transparent;" /></td>\r\n				</tr>\r\n				<tr style="box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent;">\r\n					<td class="pCaption caption" style="box-sizing: border-box; margin: 0px; padding: 5px 0px; border: 0px; outline: 0px; vertical-align: baseline; position: relative; line-height: 16px; background: transparent;">\r\n						Những cung b&acirc;̣c sắc màu của giày da Dolly.</td>\r\n				</tr>\r\n			</tbody>\r\n		</table>\r\n		<table cellpadding="0" cellspacing="0" class="picture" style="box-sizing: border-box; margin: 8px 0px; padding: 0px; border: 0px; outline: 0px; font-size: 12px; vertical-align: baseline; border-collapse: collapse; border-spacing: 0px; width: 480px; font-family: Arial, Helvetica, sans-serif; line-height: 14px; color: rgb(51, 51, 51); clear: both; position: relative; background: transparent;">\r\n			<tbody style="box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent;">\r\n				<tr style="box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent;">\r\n					<td class="pic" style="box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; position: relative; background: transparent;">\r\n						<img alt="Vẻ quyến rũ của đồ da cao cấp" src="http://img.v3.news.zdn.vn/w660/Uploaded/JAC2_N3/2013_11_05/An_tuong_bo_suu_tap_da_cao_cap_cua_Dolly_4.JPG" style="box-sizing: border-box; margin: 0px 0px -3px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; max-width: 100%; width: 480px; height: auto; cursor: pointer; background: transparent;" /></td>\r\n				</tr>\r\n				<tr style="box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent;">\r\n				</tr>\r\n			</tbody>\r\n		</table>\r\n		<table cellpadding="0" cellspacing="0" class="picture" style="box-sizing: border-box; margin: 8px 0px; padding: 0px; border: 0px; outline: 0px; font-size: 12px; vertical-align: baseline; border-collapse: collapse; border-spacing: 0px; width: 480px; font-family: Arial, Helvetica, sans-serif; line-height: 14px; color: rgb(51, 51, 51); clear: both; position: relative; background: transparent;">\r\n			<tbody style="box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent;">\r\n				<tr style="box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent;">\r\n					<td class="pic" style="box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; position: relative; background: transparent;">\r\n						<img alt="Vẻ quyến rũ của đồ da cao cấp" src="http://img.v3.news.zdn.vn/w660/Uploaded/JAC2_N3/2013_11_05/dolly_8.jpg" style="box-sizing: border-box; margin: 0px 0px -3px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; max-width: 100%; width: 480px; height: auto; cursor: pointer; background: transparent;" /></td>\r\n				</tr>\r\n				<tr style="box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent;">\r\n					<td class="pCaption caption" style="box-sizing: border-box; margin: 0px; padding: 5px 0px; border: 0px; outline: 0px; vertical-align: baseline; position: relative; line-height: 16px; background: transparent;">\r\n						Đ&acirc;̀u tư chi&ecirc;́c ví bằng da b&ecirc;̀n, đẹp th&ecirc;́ này th&acirc;̣t kh&ocirc;ng u&ocirc;̉ng phí chút nào.</td>\r\n				</tr>\r\n			</tbody>\r\n		</table>\r\n		<table cellpadding="0" cellspacing="0" class="picture" style="box-sizing: border-box; margin: 8px 0px; padding: 0px; border: 0px; outline: 0px; font-size: 12px; vertical-align: baseline; border-collapse: collapse; border-spacing: 0px; width: 480px; font-family: Arial, Helvetica, sans-serif; line-height: 14px; color: rgb(51, 51, 51); clear: both; position: relative; background: transparent;">\r\n			<tbody style="box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent;">\r\n				<tr style="box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent;">\r\n					<td class="pic" style="box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; position: relative; background: transparent;">\r\n						<img alt="Vẻ quyến rũ của đồ da cao cấp" src="http://img.v3.news.zdn.vn/w660/Uploaded/JAC2_N3/2013_11_05/An_tuong_bo_suu_tap_da_cao_cap_cua_Dolly_2.JPG" style="box-sizing: border-box; margin: 0px 0px -3px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; max-width: 100%; width: 480px; height: auto; cursor: pointer; background: transparent;" /></td>\r\n				</tr>\r\n				<tr style="box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent;">\r\n					<td class="pCaption caption" style="box-sizing: border-box; margin: 0px; padding: 5px 0px; border: 0px; outline: 0px; vertical-align: baseline; position: relative; line-height: 16px; background: transparent;">\r\n						Với sản phẩm l&agrave;m từ chất liệu da thật bạn sẽ cảm nhận được sự kh&aacute;c biệt, c&agrave;ng d&ugrave;ng bạn sẽ c&agrave;ng cảm nhận được sự mềm mại của n&oacute;.</td>\r\n				</tr>\r\n			</tbody>\r\n		</table>\r\n		<p style="box-sizing: border-box; margin: 8px 0px; padding: 0px; border: 0px; outline: 0px; font-size: 16.2399997711182px; vertical-align: baseline; background: transparent;">\r\n			Người xưa vẫn thường c&oacute; c&acirc;u &ldquo;tiền n&agrave;o của nấy&rdquo; v&igrave; vậy bạn h&atilde;y tự tin sở hữu những sản phẩm l&agrave;m từ chất liệu da thật của thời trang Dolly để cảm nhận được những lợi ích mà nó đem lại. Đầu tư khoản tiền kh&ocirc;ng nhỏ để thu về một sản phẩm gi&aacute; trị với thời gian sử dụng l&acirc;u d&agrave;i cũng như thể hiện được cái gu th&acirc;̣t ch&acirc;́t của bạn quả thật l&agrave; kh&ocirc;ng hề bị lỗ.</p>\r\n		<table cellpadding="0" cellspacing="0" class="picture" style="box-sizing: border-box; margin: 8px 0px; padding: 0px; border: 0px; outline: 0px; font-size: 12px; vertical-align: baseline; border-collapse: collapse; border-spacing: 0px; width: 480px; font-family: Arial, Helvetica, sans-serif; line-height: 14px; color: rgb(51, 51, 51); clear: both; position: relative; background: transparent;">\r\n			<tbody style="box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent;">\r\n				<tr style="box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent;">\r\n					<td class="pic" style="box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; position: relative; background: transparent;">\r\n						<img alt="Vẻ quyến rũ của đồ da cao cấp" src="http://img.v3.news.zdn.vn/w660/Uploaded/JAC2_N3/2013_11_05/An_tuong_bo_suu_tap_da_cao_cap_cua_Dolly_5.jpg" style="box-sizing: border-box; margin: 0px 0px -3px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; max-width: 100%; width: 480px; height: auto; cursor: pointer; background: transparent;" /></td>\r\n				</tr>\r\n				<tr style="box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent;">\r\n				</tr>\r\n			</tbody>\r\n		</table>\r\n		<table cellpadding="0" cellspacing="0" class="picture" style="box-sizing: border-box; margin: 8px 0px; padding: 0px; border: 0px; outline: 0px; font-size: 12px; vertical-align: baseline; border-collapse: collapse; border-spacing: 0px; width: 480px; font-family: Arial, Helvetica, sans-serif; line-height: 14px; color: rgb(51, 51, 51); clear: both; position: relative; background: transparent;">\r\n			<tbody style="box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent;">\r\n				<tr style="box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent;">\r\n					<td class="pic" style="box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; position: relative; background: transparent;">\r\n						<img alt="Vẻ quyến rũ của đồ da cao cấp" src="http://img.v3.news.zdn.vn/w660/Uploaded/JAC2_N3/2013_11_05/An_tuong_bo_suu_tap_da_cao_cap_cua_Dolly_6.jpg" style="box-sizing: border-box; margin: 0px 0px -3px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; max-width: 100%; width: 480px; height: auto; cursor: pointer; background: transparent;" /></td>\r\n				</tr>\r\n				<tr style="box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent;">\r\n				</tr>\r\n			</tbody>\r\n		</table>\r\n		<table cellpadding="0" cellspacing="0" class="picture" style="box-sizing: border-box; margin: 8px 0px; padding: 0px; border: 0px; outline: 0px; font-size: 12px; vertical-align: baseline; border-collapse: collapse; border-spacing: 0px; width: 480px; font-family: Arial, Helvetica, sans-serif; line-height: 14px; color: rgb(51, 51, 51); clear: both; position: relative; background: transparent;">\r\n			<tbody style="box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent;">\r\n				<tr style="box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent;">\r\n					<td class="pic" style="box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; position: relative; background: transparent;">\r\n						<img alt="Vẻ quyến rũ của đồ da cao cấp" src="http://img.v3.news.zdn.vn/w660/Uploaded/JAC2_N3/2013_11_05/An_tuong_bo_suu_tap_da_cao_cap_cua_Dolly_7.jpg" style="box-sizing: border-box; margin: 0px 0px -3px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; max-width: 100%; width: 480px; height: auto; cursor: pointer; background: transparent;" /></td>\r\n				</tr>\r\n				<tr style="box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent;">\r\n				</tr>\r\n			</tbody>\r\n		</table>\r\n		<p style="box-sizing: border-box; margin: 8px 0px; padding: 0px; border: 0px; outline: 0px; font-size: 16.2399997711182px; vertical-align: baseline; background: transparent;">\r\n			<a href="https://www.facebook.com/DollyVietNam" style="box-sizing: border-box; margin: 0px; padding: 0px; font-size: 16.2399997711182px; vertical-align: baseline; text-decoration: none; color: rgb(0, 119, 179); background: transparent;" target="_blank">Gia nh&acirc;̣p fanpage</a>&nbsp;đểcó cơ h&ocirc;̣i tham gia nhi&ecirc;̀u chương trình h&acirc;́p d&acirc;̃n dành cho thành vi&ecirc;n.</p>\r\n		<p style="box-sizing: border-box; margin: 8px 0px; padding: 0px; border: 0px; outline: 0px; font-size: 16.2399997711182px; vertical-align: baseline; background: transparent;">\r\n			Xem th&ocirc;ng tin chi tiết tại website:&nbsp;<a href="http://www.dolly.vn/" style="box-sizing: border-box; margin: 0px; padding: 0px; font-size: 16.2399997711182px; vertical-align: baseline; text-decoration: none; color: rgb(0, 119, 179); background: transparent;" target="_blank">www.Dolly.vn</a></p>\r\n		<p style="box-sizing: border-box; margin: 8px 0px; padding: 0px; border: 0px; outline: 0px; font-size: 16.2399997711182px; vertical-align: baseline; background: transparent;">\r\n			S&ocirc;́ hotline (08)38368071 - Ext: 102</p>\r\n		<p style="box-sizing: border-box; margin: 8px 0px; padding: 0px; border: 0px; outline: 0px; font-size: 16.2399997711182px; vertical-align: baseline; background: transparent;">\r\n			Hoặc email: dollyshoes@dolly.vn</p>\r\n		<p style="box-sizing: border-box; margin: 8px 0px; padding: 0px; border: 0px; outline: 0px; font-size: 16.2399997711182px; vertical-align: baseline; background: transparent;">\r\n			H&ecirc;̣ th&ocirc;́ng showroom của Dolly:</p>\r\n		<p style="box-sizing: border-box; margin: 8px 0px; padding: 0px; border: 0px; outline: 0px; font-size: 16.2399997711182px; vertical-align: baseline; background: transparent;">\r\n			+ 275 Ph&ocirc;́ Hu&ecirc;́, Q.Hai Ba Trung, H&agrave; Nội</p>\r\n		<p style="box-sizing: border-box; margin: 8px 0px; padding: 0px; border: 0px; outline: 0px; font-size: 16.2399997711182px; vertical-align: baseline; background: transparent;">\r\n			+451 L&ecirc; Văn Sỹ, P.12, Q.3, TP.HCM.</p>\r\n		<p style="box-sizing: border-box; margin: 8px 0px; padding: 0px; border: 0px; outline: 0px; font-size: 16.2399997711182px; vertical-align: baseline; background: transparent;">\r\n			(08)35261517</p>\r\n		<p style="box-sizing: border-box; margin: 8px 0px; padding: 0px; border: 0px; outline: 0px; font-size: 16.2399997711182px; vertical-align: baseline; background: transparent;">\r\n			+424B Nguyễn Đ&igrave;nh Chiểu, P.4, Q.3, TP.HCM.</p>\r\n		<p style="box-sizing: border-box; margin: 8px 0px; padding: 0px; border: 0px; outline: 0px; font-size: 16.2399997711182px; vertical-align: baseline; background: transparent;">\r\n			(08)62908910</p>\r\n		<p style="box-sizing: border-box; margin: 8px 0px; padding: 0px; border: 0px; outline: 0px; font-size: 16.2399997711182px; vertical-align: baseline; background: transparent;">\r\n			+353 Hai Ba Trung, 8 Ward, District 3, HCMC.</p>\r\n		<p style="box-sizing: border-box; margin: 8px 0px; padding: 0px; border: 0px; outline: 0px; font-size: 16.2399997711182px; vertical-align: baseline; background: transparent;">\r\n			(08)38209812</p>\r\n		<p style="box-sizing: border-box; margin: 8px 0px; padding: 0px; border: 0px; outline: 0px; font-size: 16.2399997711182px; vertical-align: baseline; background: transparent;">\r\n			+335 Nguyễn Tr&atilde;i, P.7, Q.5, TP.HCM.</p>\r\n		<p style="box-sizing: border-box; margin: 8px 0px; padding: 0px; border: 0px; outline: 0px; font-size: 16.2399997711182px; vertical-align: baseline; background: transparent;">\r\n			(08) 38367659</p>\r\n		<p style="box-sizing: border-box; margin: 8px 0px; padding: 0px; border: 0px; outline: 0px; font-size: 16.2399997711182px; vertical-align: baseline; background: transparent;">\r\n			+70 Nguyễn Tr&atilde;i, P.An Hội, Q.Ninh Kieu, TP.Cần Thơ</p>\r\n		<p style="box-sizing: border-box; margin: 8px 0px; padding: 0px; border: 0px; outline: 0px; font-size: 16.2399997711182px; vertical-align: baseline; background: transparent;">\r\n			(0710) 6253245</p>\r\n		<p style="box-sizing: border-box; margin: 8px 0px; padding: 0px; border: 0px; outline: 0px; font-size: 16.2399997711182px; vertical-align: baseline; background: transparent;">\r\n			Tư liệu: DollyVN</p>\r\n	</div>\r\n</article>\r\n<p>\r\n	&nbsp;</p>\r\n', 'DollyVN', '0000-00-00 00:00:00', 0, 2, 0, 've-quyen-ru-cua-do-da-cao-cap-1428294797');
INSERT INTO `tbl_post` (`id`, `title`, `content`, `author`, `time`, `count`, `viewed`, `liked`, `key`) VALUES
(73, 'Chiếm trọn ánh nhìn của nàng nhờ thắt lưng da', '<p>\r\n	<span style="font-family:arial,helvetica,sans-serif;"><span style="font-size:14px;">Bạn sắp c&oacute; một cuộc hẹn với c&ocirc; g&aacute;i m&agrave; bạn thầm thương nhớ bấy l&acirc;u nay? Bạn l&uacute;ng t&uacute;ng trong c&aacute;ch lựa chọn cho m&igrave;nh phong c&aacute;ch thời trang ph&ugrave; hợp. V&agrave; c&aacute;ch l&agrave;m thế n&agrave;o ghi điểm cho n&agrave;ng ngay từ &aacute;nh nh&igrave;n đầu ti&ecirc;n.</span></span></p>\r\n<p>\r\n	<span style="font-family:arial,helvetica,sans-serif;"><span style="font-size:14px;">Để Diogini nhắc bạn một v&agrave;i mẹo nhỏ nh&eacute;.</span></span></p>\r\n<p>\r\n	<br />\r\n	<br />\r\n	<span style="font-family:arial,helvetica,sans-serif;"><span style="font-size:14px;">Trang phục đơn giản</span></span></p>\r\n<p>\r\n	<span style="font-family:arial,helvetica,sans-serif;"><span style="font-size:14px;">C&oacute; thể so s&aacute;nh&nbsp;cuộc hẹn&nbsp;của bạn tương đương với t&igrave;nh huống bạn đi phỏng vấn xin việc vậy. Tuy bạn kh&ocirc;ng cần sơ mi quần &acirc;u qu&aacute; gọn g&agrave;ng nhưng ti&ecirc;u ch&iacute; trang phục của bạn vẫn cần sự cẩn thận cần thiết t&ugrave;y theo ho&agrave;n cảnh kh&ocirc;ng gian cuộc hẹn của bạn.</span></span></p>\r\n<p>\r\n	<span style="font-family:arial,helvetica,sans-serif;"><span style="font-size:14px;">Nếu bạn mặc một bộ quần &aacute;o luộm thuộm hay trang phục ko ăn rơ với nhau sẽ để lại cho đối t&aacute;c của bạn một suy nghĩ ban đầu kh&ocirc;ng thực sự tốt.</span></span></p>\r\n<p>\r\n	<span style="font-family:arial,helvetica,sans-serif;"><span style="font-size:14px;">Sự m&agrave;u m&egrave; l&ograve;e loẹt hay c&aacute;c phục trang kh&aacute;c kiểu kh&aacute;c thường th&iacute;ch hợp với c&aacute;c cuộc hẹn tiếp sau n&agrave;y khi bạn muốn thể hiện phong c&aacute;ch của bản th&acirc;n.</span></span></p>\r\n<div>\r\n	<span style="font-family:arial,helvetica,sans-serif;"><span style="font-size:14px;"><img alt="" id="irc_mi" src="http://img.v3.news.zdn.vn/w660/Uploaded/JAC1_N3/2014_03_12/Lam_nen_phong_cach_thoi_trang_nam_cung_Dockers_1.jpg" /></span></span></div>\r\n<p>\r\n	<span style="font-family:arial,helvetica,sans-serif;"><span style="font-size:14px;">Điểm nhấn cho trang phục</span></span></p>\r\n<p>\r\n	<span style="font-family:arial,helvetica,sans-serif;"><span style="font-size:14px;">Điểm nhấn tr&ecirc;n trang phục nam giới thường thu h&uacute;t &aacute;nh nh&igrave;n của phụ nữ. Cụ thể, thường c&aacute;c bạn g&aacute;i hay c&oacute; xu hướng để mắt đến c&aacute;c phụ kiện trang phục như gi&agrave;y hay&nbsp;thắt lưng&nbsp;của ph&aacute;i mạnh.</span></span></p>\r\n<p>\r\n	<br />\r\n	<span style="font-family:arial,helvetica,sans-serif;"><span style="font-size:14px;"><img alt="http://minichino.com.vn/san-pham/252/day-lung-cao-cap-acciaio-made-in-italy.htm" src="http://image.tantinh.net/domain/boutique/9883N%20%283%29.JPG" />&nbsp;</span></span></p>\r\n<h2>\r\n	<span style="font-family:arial,helvetica,sans-serif;"><span style="font-size:14px;">Thắt Lưng Da Cao Cấp</span></span></h2>\r\n<p>\r\n	<span style="font-family:arial,helvetica,sans-serif;"><span style="font-size:14px;">Trong b&agrave;i viết n&agrave;y, xin được bỏ qua đ&ocirc;i gi&agrave;y m&agrave; hướng đến chiếc thắt lưng m&agrave; bạn lựa chọn sử dụng.</span></span></p>\r\n<p>\r\n	<span style="font-family:arial,helvetica,sans-serif;"><span style="font-size:14px;">Chiếc thắt lưng m&agrave; bạn d&ugrave;ng n&ecirc;n l&agrave; một chiếc&nbsp;thắt lưng&nbsp;h&agrave;ng chuẩn, c&oacute; thương hiệu r&otilde; r&agrave;ng th&igrave; c&agrave;ng tốt v&agrave; n&ecirc;n l&agrave; một chiếc thắt lưng kh&oacute;a xỏ lỗ đơn giản.</span></span></p>\r\n<p>\r\n	<span style="font-family:arial,helvetica,sans-serif;"><span style="font-size:14px;">Như đ&atilde; n&oacute;i ở phần tr&ecirc;n, sự cầu k&igrave; kiểu c&aacute;ch chỉ th&iacute;ch hợp cho những cuộc hẹn tiếp sau n&agrave;y, khi mối quan hệ trở n&ecirc;n tốt hơn. Đặc biệt, kiểu&nbsp;d&acirc;y lưng&nbsp;kh&oacute;a xỏ lỗ n&agrave;y rất dễ d&agrave;ng kết hợp được với những loại trang phục hay c&aacute;c kiểu quần kh&aacute;c nhau m&agrave; kh&ocirc;ng sợ bị lệch t&ocirc;ng hay lỗi mốt. Từ chiếc quần jean, kaki hay cả quần &acirc;u sang trọng.&nbsp;&nbsp;</span></span></p>\r\n<p>\r\n	<br />\r\n	&nbsp;</p>\r\n<h2>\r\n	<br />\r\n	<span style="font-family:arial,helvetica,sans-serif;"><span style="font-size:14px;"><img alt="http://minichino.com.vn/san-pham/184/day-lung-da-cao-cap-acciaio-made-in-italy.htm" src="http://image.tantinh.net/domain/boutique/IMG_1452.JPG" /></span></span></h2>\r\n<h2>\r\n	<span style="font-family:arial,helvetica,sans-serif;"><span style="font-size:14px;">Thắt Lưng Da Nam H&agrave;ng Hiệu</span></span></h2>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	<span style="font-family:arial,helvetica,sans-serif;"><span style="font-size:14px;">&nbsp;</span></span></p>\r\n<p>\r\n	<span style="font-family:arial,helvetica,sans-serif;"><span style="font-size:14px;">Ngo&agrave;i ra, chiếc thắt lưng m&agrave; bạn chọn cũng n&ecirc;n được để &yacute; chăm ch&uacute;t vệ sinh. Điều n&agrave;y cũng đ&ograve;i hỏi bạn phải c&oacute; sự quan t&acirc;m thường xuy&ecirc;n đến chiếc&nbsp;d&acirc;y dabạn đeo b&ecirc;n người h&agrave;ng ng&agrave;y.</span></span></p>\r\n<p>\r\n	<span style="font-family:arial,helvetica,sans-serif;"><span style="font-size:14px;">Đầu tư một ch&uacute;t nhưng thu lại được những kết quả như mong muốn l&agrave; điều m&agrave; hầu hết ai cũng hi vọng. C&aacute;c bạn nam cũng đừng ngần ngại r&uacute;t hầu bao để sở hữu một chiếc&nbsp;<a href="http://www.italyboutique.com.vn/that-lung-da-nam-b1086644.html">thắt lưng da&nbsp;</a>h&agrave;ng hiệu nh&eacute;. N&oacute; sẽ gi&uacute;p bạn n&acirc;ng tầng đẳng cấp trong mắt đối t&aacute;c đấy.</span></span></p>\r\n', 'BBT', '0000-00-00 00:00:00', 0, 0, 0, 'chiem-tron-anh-nhin-cua-nang-nho-that-lung-da-1428294851'),
(74, 'Vì đôi giày tây là một phần của thế giới đàn ông', '<p>\r\n	<span style="font-size:14px;"><span style="font-family:arial,helvetica,sans-serif;">Bạn c&oacute; bao giờ thắc mắc tại sao đ&agrave;n &ocirc;ng lu&ocirc;n đơn giản về thời trang hơn chị em phụ nữ, họ kh&ocirc;ng qu&aacute; cầu kỳ khi chọn mua những m&oacute;n đồ cho m&igrave;nh hay tủ quần &aacute;o của họ kh&ocirc;ng chứa đầy n&agrave;o &aacute;o n&agrave;o v&aacute;y như tủ quần &aacute;o của ph&aacute;i đẹp , nhưng khi nhắc đến gi&agrave;y th&igrave; dường như lại như một sự đam m&ecirc; v&ocirc; tận vậy???<br />\r\n	Kh&ocirc;ng hẳn l&agrave; ph&aacute;i mạnh kh&ocirc;ng để &yacute; đến vẻ bề ngo&agrave;i như ph&aacute;i đẹp, c&oacute; một sự thật khiến bạn bất ngờ l&agrave; họ cũng quan t&acirc;m đến h&igrave;nh ảnh của m&igrave;nh khi xuất hiện trước người kh&aacute;c kh&ocirc;ng chỉ như m&agrave; c&oacute; khi c&ograve;n l&agrave; hơn cả chị em phụ nữ. Bạn thắc mắc tại sao ư??</span></span></p>\r\n<p>\r\n	<span style="font-size:14px;"><span style="font-family:arial,helvetica,sans-serif;">Từ xưa &ocirc;ng cha ta đ&atilde; c&oacute; c&acirc;u &ldquo; tr&ocirc;ng mặt m&agrave; bắt h&igrave;nh dong&rdquo; đ&oacute; l&agrave; điều kh&ocirc;ng n&ecirc;n nhưng ta chẳng thể&nbsp; phủ nhận c&acirc;u n&oacute;i ấy bởi con người ta ai cũng vậy, sinh ra đ&atilde; đều biết y&ecirc;u c&aacute;i đẹp, m&agrave; những mối quan hệ cuả ph&aacute;i mạnh đ&ocirc;i khi phức tạp hơn chị em kh&aacute; nhiều, v&igrave; vậy họ lu&ocirc;n để &yacute; đến h&igrave;nh ảnh bản th&acirc;n, chỉ l&agrave; c&aacute;ch họ thể hiện y&ecirc;n tĩnh hơn,lặng lẽ hơn c&aacute;c n&agrave;ng m&agrave; th&ocirc;i.</span></span></p>\r\n<p>\r\n	<br />\r\n	<span style="font-size:14px;"><span style="font-family:arial,helvetica,sans-serif;"><img alt="http://minichino.com.vn/san-pham/266/giay-nam-cao-cap-caponi-code-1923-ebano.htm" src="http://image.tantinh.net/domain/boutique/1923%20%282%29.JPG" /></span></span></p>\r\n<h2>\r\n	<span style="font-size:14px;"><span style="font-family:arial,helvetica,sans-serif;">Gi&agrave;y T&acirc;y C&ocirc;ng Sở</span></span></h2>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	<span style="font-size:14px;"><span style="font-family:arial,helvetica,sans-serif;">C&oacute; một cuộc điều tra khảo s&aacute;t về sự quan t&acirc;m của đ&agrave;n &ocirc;ng&nbsp; về thời trang đ&atilde; diễn ra v&agrave; thu được kết quả c&oacute; tới 85% đ&agrave;n &ocirc;ng thừa nhận họ c&oacute; niềm y&ecirc;u th&iacute;ch bất tận với&nbsp;gi&agrave;y da. Khi được hỏi l&yacute; do tại sao th&igrave; dưới đ&acirc;y l&agrave; một số c&acirc;u trả lời th&ocirc;ng dụng nhất:</span></span></p>\r\n<p>\r\n	<span style="font-size:14px;"><span style="font-family:arial,helvetica,sans-serif;">-Thật ra t&ocirc;i cũng chẳng l&yacute; giải nổi tại sao, c&oacute; lẽ n&oacute; l&agrave; một c&aacute;i g&igrave; đ&oacute; như l&agrave; sự y&ecirc;u th&iacute;ch tự nhi&ecirc;n th&ocirc;i</span></span></p>\r\n<p>\r\n	<span style="font-size:14px;"><span style="font-family:arial,helvetica,sans-serif;">-<a href="http://www.italyboutique.com.vn/">Gi&agrave;y da</a>&nbsp;gần như gắn liền với cuộc sống cũng như c&ocirc;ng việc hằng ng&agrave;y của t&ocirc;i vậy</span></span></p>\r\n<p>\r\n	<span style="font-size:14px;"><span style="font-family:arial,helvetica,sans-serif;">-Bạn thử tưởng tượng t&ocirc;i mặc suit l&agrave; đi d&eacute;p&nbsp; t&ocirc;ng xem! Chỉ nghĩ th&ocirc;i m&agrave; t&ocirc;i nổi cả da g&agrave; rồi.</span></span></p>\r\n<h2>\r\n	<span style="font-size:14px;"><span style="font-family:arial,helvetica,sans-serif;"><img alt="" src="http://image.tantinh.net/domain/boutique/1_1%20%289%29.jpg" /></span></span></h2>\r\n<h2>\r\n	<span style="font-size:14px;"><span style="font-family:arial,helvetica,sans-serif;">Gi&agrave;y Da Cao Cấp</span></span></h2>\r\n<p>\r\n	<span style="font-size:14px;"><span style="font-family:arial,helvetica,sans-serif;">Với c&aacute;nh m&agrave;y r&acirc;u vest chỉ cần v&agrave;i bộ, sơ mi c&oacute; thể kh&ocirc;ng qu&aacute; nhiều nhưng bạn thử ngắm tủ gi&agrave;y của họ m&agrave; xem, kh&ocirc;ng qu&aacute; nhiều như ph&aacute;i đẹp nhưng lại l&agrave; cả một bộ sưu tập, từ gi&agrave;y thể thao, đến gi&agrave;y đi chơi,&nbsp;gi&agrave;y&nbsp;đi l&agrave;m, gi&agrave;y đi tiệc&hellip; Gi&agrave;y được ph&aacute;i mạnh lu&ocirc;n ch&uacute; trọng ,v&igrave; theo họ gi&agrave;y l&agrave; một trong những m&oacute;n đồ khẳng định đẳng cấp ph&aacute;i mạnh, một đ&ocirc;i gi&agrave;y tốt sẽ l&agrave; người bạn đồng h&agrave;nh l&yacute; tưởng của họ.</span></span></p>\r\n<p>\r\n	<span style="font-size:14px;"><span style="font-family:arial,helvetica,sans-serif;">Đến giờ th&igrave; bạn đ&atilde; c&oacute; hiểu tại sao đ&agrave;n &ocirc;ng lại lu&ocirc;n rất kỹ t&iacute;nh khi chọn gi&agrave;y rồi, đ&uacute;ng kh&ocirc;ng n&agrave;o?</span></span></p>\r\n', 'BBT', '0000-00-00 00:00:00', 0, 1, 0, 'vi-doi-giay-tay-la-mot-phan-cua-the-gioi-dan-ong-1428294883'),
(75, 'Những ý tưởng về giày da trong tương lai', '<p>\r\n	<span style="font-size:14px;"><span style="font-family:arial,helvetica,sans-serif;">&nbsp;Bạn lu&ocirc;n suy nghĩ về cuộc sống tương lai m&igrave;nh như thế n&agrave;o, về c&ocirc;ng việc, t&igrave;nh y&ecirc;u hay bạn b&egrave; nhưng liệu bạn c&oacute; thử một lần nghĩ đến việc tương lai trang phục của m&igrave;nh như thế n&agrave;o kh&ocirc;ng??? Bạn sẽ thấy v&ocirc; c&ugrave;ng th&uacute; vị khi nghĩ về những đ&ocirc;i&nbsp;<a href="http://www.italyboutique.com.vn/">gi&agrave;y da nam cao cấp</a>&nbsp;trong tương lai đấy. Thử xem nh&eacute;!!!</span></span></p>\r\n<p>\r\n	<br />\r\n	<span style="font-size:14px;"><span style="font-family:arial,helvetica,sans-serif;">Điều m&agrave; thường thấy nhiều qu&yacute; &ocirc;ng kh&ocirc;ng th&iacute;ch ở&nbsp;gi&agrave;y da&nbsp;cao cấp&nbsp;hiện nay đ&oacute; l&agrave; khi d&iacute;nh nước th&igrave; đ&ocirc;i gi&agrave;y y&ecirc;u qu&yacute; của bạn sẽ bị hỏng. Trong tương lai sẽ c&oacute; những đ&ocirc;i gi&agrave;y vẫn l&agrave;m bằng da nhưng bạn tha hồ đi ch&uacute;ng kể cả dưới trời mưa, thậm ch&iacute; khi bạn giẫm cả v&agrave;o một vũng nước th&igrave; đ&ocirc;i gi&agrave;y của bạn vẫn đẹp v&agrave; kh&ocirc;ng hề bị hỏng.</span></span><br />\r\n	&nbsp;</p>\r\n<div>\r\n	<span style="font-size:14px;"><span style="font-family:arial,helvetica,sans-serif;"><img alt="http://minichino.com.vn/san-pham/237/giay-cong-so-cao-cap-minichino-made-in-italy.htm" src="http://image.tantinh.net/domain/boutique/Giay%20Au%20cao%20cap%20(7).jpg" style="height: 400px; width: 600px;" /></span></span>\r\n	<h2>\r\n		<span style="font-size:14px;"><span style="font-family:arial,helvetica,sans-serif;">Gi&agrave;y Da C&ocirc;ng Sở</span></span></h2>\r\n</div>\r\n<p>\r\n	<span style="font-size:14px;"><span style="font-family:arial,helvetica,sans-serif;">Bạn muốn mua một đ&ocirc;i&nbsp;gi&agrave;y da&nbsp;c&oacute; d&acirc;y bởi sự lịch sự của ch&uacute;ng nhưng rất ngại buộc d&acirc;y cho gi&agrave;y? Đừng lo sẽ c&oacute; những đ&ocirc;i gi&agrave;y da cao cấp tự buộc d&acirc;y c&ocirc;ng việc của bạn chỉ l&agrave; xỏ ch&acirc;n v&agrave;o đ&ocirc;i gi&agrave;y da ấy m&agrave; th&ocirc;i.</span></span></p>\r\n<p>\r\n	<span style="font-size:14px;"><span style="font-family:arial,helvetica,sans-serif;">Đ&ocirc;i l&uacute;c bạn thấy kh&ocirc;ng h&agrave;i l&ograve;ng với chiều cao của m&igrave;nh, c&oacute; khi lại qu&aacute; cao, c&oacute; khi lại qu&aacute; thấp khiến bạn gặp kh&oacute; khăn trong giao tiếp th&igrave; rất cần một đ&ocirc;i gi&agrave;y da c&oacute; thể điều chỉnh chiều cao. G&oacute;t của ch&uacute;ng c&oacute; thể tự động n&acirc;ng l&ecirc;n hoặc hạ xuống t&ugrave;y theo y&ecirc;u cầu của bạn.</span></span></p>\r\n<p>\r\n	<br />\r\n	<span style="font-size:14px;"><span style="font-family:arial,helvetica,sans-serif;"><img alt="" src="http://image.tantinh.net/domain/boutique/1466%20(3).JPG" style="height: 400px; width: 600px;" /></span></span></p>\r\n<p>\r\n	<span style="font-size:14px;"><span style="font-family:arial,helvetica,sans-serif;">Bạn hay phải đi lại nhiều v&agrave; kh&ocirc;ng c&oacute; thời gian để m&aacute;t xa cho đ&ocirc;i ch&acirc;n của m&igrave;nh th&igrave; h&atilde;y tưởng tượng rằng trong tương lai sẽ c&oacute; những đ&ocirc;i gi&agrave;y da vừa đẹp m&agrave; lại c&oacute; thể m&aacute;t xa cho đ&ocirc;i ch&acirc;n cần mẫn của bạn ngay cả khi bạn đang phải di chuyển.</span></span></p>\r\n<p>\r\n	<span style="font-size:14px;"><span style="font-family:arial,helvetica,sans-serif;">Mặc d&ugrave; cụm từ l&oacute;t gi&agrave;y khử m&ugrave;i kh&ocirc;ng c&ograve;n mới nhưng kh&ocirc;ng phải h&atilde;ng gi&agrave;y da n&agrave;o cũng đ&atilde; ứng dụng c&ocirc;ng nghệ sản xuất n&agrave;y. Kh&ocirc;ng chỉ tiết kiệm cho bạn khoản mua l&oacute;t gi&agrave;y m&agrave; c&ograve;n gi&uacute;p bạn kh&ocirc;ng c&ograve;n kh&oacute; chịu khi l&oacute;t gi&agrave;y bị x&ocirc; xệch.&nbsp; Bạn đang t&igrave;m những đ&ocirc;i gi&agrave;y như vậy? Kh&ocirc;ng kh&oacute; đ&acirc;u, với hai thương hiệu MINICHINO v&agrave; CAPONI c&aacute;c sản phẩm của hai thương hiệu n&agrave;y vừa đảm bảo bền, đẹp m&agrave; c&ograve;n&nbsp;đ&aacute;nh bay m&ugrave;i&nbsp;cho đ&ocirc;i ch&acirc;n của bạn nữa đấy.</span></span></p>\r\n<p>\r\n	<br />\r\n	<span style="font-size:14px;"><span style="font-family:arial,helvetica,sans-serif;"><img alt="" src="http://image.tantinh.net/domain/boutique/1_4551%20(5).JPG" style="height: 400px; width: 600px;" /></span></span></p>\r\n<h2>\r\n	<span style="font-size:14px;"><span style="font-family:arial,helvetica,sans-serif;">Gi&agrave;y T&acirc;y Cao Cấp</span></span></h2>\r\n<p>\r\n	<span style="font-size:14px;"><span style="font-family:arial,helvetica,sans-serif;">Bạn thấy đ&ocirc;i&nbsp;gi&agrave;y da nam&nbsp;trong tương lai c&oacute; tuyệt hảo kh&ocirc;ng ?? Tuy nhi&ecirc;n đ&oacute; chỉ l&agrave; tương lai c&ograve;n b&acirc;y giờ bạn h&atilde;y đến với DIOGINI để đem về cho m&igrave;nh những đ&ocirc;i gi&agrave;y da cao cấp đi th&ocirc;i!!!</span></span></p>\r\n', 'BBT', '0000-00-00 00:00:00', 0, 5, 0, 'nhung-y-tuong-ve-giay-da-trong-tuong-lai-1428294918'),
(76, 'Thắt lưng da xỏ lỗ không bao giờ lỗi mốt', '<p>\r\n	<span style="font-family:arial,helvetica,sans-serif;">Ng&agrave;y nay tr&ecirc;n thị trường thời trang xuất hiện v&ocirc; số c&aacute;c loại sản phẩm phục vụ cho nhu cầu l&agrave;m đẹp của con người, chỉ n&oacute;i đơn giản một loại sản phẩm như thắt lưng da th&ocirc;i m&agrave; c&oacute; thể ph&acirc;n loại theo chất lượng, kiểu d&aacute;ng, loại da, kiểu kh&oacute;a&hellip; V&agrave; việc một t&iacute;n đồ thời trang th&ocirc;ng minh n&ecirc;n l&agrave;m l&agrave; lựa chọn cho m&igrave;nh được những sản phẩm vừa hợp thời trang m&agrave; lại kh&ocirc;ng lo sợ lỗi mốt.</span></p>\r\n<p>\r\n	<span style="font-family:arial,helvetica,sans-serif;">Nh&igrave;n lại thị trường thời trang v&agrave;i năm về trước hay n&oacute;i nhỏ hơn l&agrave; về mặt h&agrave;ng cụ thể ch&uacute;ng ta đang nhắc tới l&agrave;&nbsp;<a href="http://minichino.com.vn/loai-san-pham/2/that-lung-da-nam-cao-cap.htm">thắt lưng da</a>. Chỉ l&ugrave;i lại v&agrave;o khoảng năm 2009-2010 th&ocirc;i th&igrave; khi n&oacute; những chiếc thắt lưng với mặt bấm, hay k&eacute;o trục c&ugrave;ng những họa tiết trang tr&iacute; cầu kỳ, mạ sắc s&aacute;ng ch&oacute;i đang l&agrave;m mưa l&agrave;m gi&oacute; tr&ecirc;n thị trường. C&ograve;n b&acirc;y giờ ch&uacute;ng ra sao? Bạn sẽ nhận được những c&aacute;i nh&igrave;n &yacute; nhị khi mang những loại thắt lưng n&agrave;y v&agrave;o năm 2015 đ&oacute;, những mẫu thắt lưng đ&oacute; giờ được coi thật hoa h&ograve;e, cố l&agrave;m sang hay thậm ch&iacute; l&agrave; qu&ecirc; m&ugrave;a.</span></p>\r\n<p>\r\n	<span style="font-family:arial,helvetica,sans-serif;">Thời trang như con dao hai lưỡi, n&oacute; dễ d&agrave;ng gi&uacute;p bạn ghi h&igrave;nh ảnh đẹp trước mắt mọi người những cũng l&agrave; ph&aacute;t đ&acirc;m tr&iacute; mạng nếu như bạn kh&ocirc;ng phải l&agrave; con người tinh tế ,nắm bắt được xu hướng.</span></p>\r\n<div>\r\n	<span style="font-family:arial,helvetica,sans-serif;"><img alt="http://minichino.com.vn/san-pham/242/that-lung-da-cao-cap-adpel-made-in-italy.htm" src="http://image.tantinh.net/domain/boutique/1_9526G.JPG" /></span>\r\n	<h2>\r\n		<span style="font-family:arial,helvetica,sans-serif;">Thắt Lưng Da C&ocirc;ng Sở</span></h2>\r\n</div>\r\n<p>\r\n	<span style="font-family:arial,helvetica,sans-serif;">Thời trang d&ugrave; c&oacute; thay đổi như thế n&agrave;o th&igrave; n&oacute; vẫn lu&ocirc;n c&oacute; một ti&ecirc;u ch&iacute; đ&aacute;nh gi&aacute; cố định đ&oacute; l&agrave; sự h&agrave;i h&ograve;a. Tại sao v&agrave;o thời điểm những năm 2009-2010 nếu bạn d&ugrave;ng một chiếc&nbsp;thắt lưng da xỏ lỗ&nbsp;kh&ocirc;ng bị xem l&agrave; qu&ecirc; m&ugrave;a v&agrave; cho đến nay tại thời điểm hiện tại bạn vẫn c&oacute; thể tự tin diện một chiếc thắt lưng xỏ lỗ ra ngo&agrave;i??? C&acirc;u trả lời ở sự h&agrave;i h&ograve;a từ sự đơn giản.</span></p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	<span style="font-family:arial,helvetica,sans-serif;">Thắt lưng kh&oacute;a xỏ lỗ c&oacute; từ h&agrave;ng trăm năm trước, n&oacute; được coi như loạithắt lưng kinh điển&nbsp;của c&aacute;c d&ograve;ng thắt lưng, nhưng ch&iacute;nh sự đơn giản ấy lại tạo cho người mặc một vẻ đẹp sang trọng, lịch l&atilde;m&nbsp; nếu như bạn biết c&aacute;ch sử dụng. Chẳng vậy m&agrave; qua bao nhi&ecirc;u năm loại thắt lưng n&agrave;y vẫn chưa bước v&agrave;o giai đoạn suy tho&aacute;i trong chu kỳ sống của m&igrave;nh.</span></p>\r\n<div>\r\n	<span style="font-family:arial,helvetica,sans-serif;"><img alt="" src="http://image.tantinh.net/domain/boutique/9532G%20(2).JPG" /></span>\r\n	<h2>\r\n		<span style="font-family:arial,helvetica,sans-serif;">Thắt Lưng Nam H&agrave;ng Hiệu</span></h2>\r\n</div>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	<span style="font-family:arial,helvetica,sans-serif;">Vậy nếu bạn l&agrave; một người y&ecirc;u thời trang th&ocirc;ng minh, th&igrave; h&atilde;y &aacute;p dụng nguy&ecirc;n l&yacute; cơ bản của thời trang &ldquo; vẻ đẹp vĩnh cửu của sự h&agrave;i h&ograve;a xuất&nbsp; từ những g&igrave; đơn giản nhất&rdquo;. H&atilde;y chọn cho m&igrave;nh một chiếc thắt lưng da xỏ lỗ để lu&ocirc;n giữ được gu thời trang&nbsp; lịch l&atilde;m của m&igrave;nh.</span></p>\r\n', '', '0000-00-00 00:00:00', 0, 3, 0, 'that-lung-da-xo-lo-khong-bao-gio-loi-mot-1428295194'),
(77, 'Bí quyết đi giày da mới thoải mái', '<p>\r\n	<span style="font-family:arial,helvetica,sans-serif;"><span style="font-size:14px;">Khi bạn mua một đ&ocirc;i&nbsp;gi&agrave;y da&nbsp;d&ugrave; c&oacute; vừa ch&acirc;n đi chăng nữa bạn vẫn sẽ c&oacute; ch&uacute;t kh&oacute; chịu khi mới đi nhất l&agrave; bị đau ch&acirc;n. Vậy c&oacute; c&aacute;ch n&agrave;o chữa căn bệnh ấy kh&ocirc;ng? Bạn h&atilde;y bỏ t&uacute;i những b&iacute; quyết sau để khi cần th&igrave; d&ugrave;ng nh&eacute;.</span></span></p>\r\n<div>\r\n	&nbsp;</div>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	<span style="font-family:arial,helvetica,sans-serif;"><span style="font-size:14px;">Mỗi ng&agrave;y n&ecirc;n xỏ ch&acirc;n v&agrave;o đ&ocirc;i gi&agrave;y v&agrave; đi lại v&agrave;i v&ograve;ng trong nh&agrave;. Khi bạn chỉ mua đ&ocirc;i gi&agrave;y da để d&ugrave;ng khi c&oacute; dịp đặc biệt m&agrave; b&acirc;y giờ chưa d&ugrave;ng đến th&igrave; bạn n&ecirc;n xỏ ch&acirc;n v&agrave;o gi&agrave;y đi lại trước để đến khi c&oacute; việc bạn c&oacute; thể thoải m&aacute;i đi tr&ecirc;n đ&ocirc;i&nbsp;<a href="http://minichino.com.vn/loai-san-pham/1/giay-da-nam-cao-cap.htm">gi&agrave;y da nam cao cấp</a>&nbsp;mới của m&igrave;nh.</span></span></p>\r\n<div>\r\n	<span style="font-family:arial,helvetica,sans-serif;"><span style="font-size:14px;"><img alt="" src="http://image.tantinh.net/domain/boutique/IMG_3413.JPG" /></span></span></div>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	<span style="font-family:arial,helvetica,sans-serif;"><span style="font-size:14px;">H&atilde;y để gi&agrave;y da gi&atilde;n dần mỗi ng&agrave;y. Khi mới sắm một đ&ocirc;i gi&agrave;y da cho m&igrave;nh bạn kh&ocirc;ng n&ecirc;n đi thường xuy&ecirc;n tr&aacute;nh việc gi&agrave;y chưa gi&atilde;n m&agrave; ch&acirc;n bạn đ&atilde; bị sưng tấy l&ecirc;n rồi nh&eacute;. Bạn n&ecirc;n d&ugrave;ng tr&aacute;o đổi giữa gi&agrave;y mới v&agrave; gi&agrave;y cũ đến khi gi&agrave;y mới đ&atilde; ho&agrave;n to&agrave;nthoải m&aacute;i&nbsp;rồi th&igrave; bạn c&oacute; thể tha hồ đi tr&ecirc;n đ&ocirc;i gi&agrave;y da mới.</span></span></p>\r\n<p>\r\n	<span style="font-family:arial,helvetica,sans-serif;"><span style="font-size:14px;">Một c&aacute;ch nữa đ&oacute; l&agrave; khi n&agrave;o bạn ngồi nhiều nhất l&agrave; khi bạn đang ở văn ph&ograve;ng th&igrave; n&ecirc;n xỏ ch&acirc;n v&agrave;o đ&ocirc;i gi&agrave;y da mới bởi l&agrave;m như vậy sẽ gi&uacute;p bạn kh&ocirc;ng tốn nhiều thời gian m&agrave; gi&agrave;y vẫn c&oacute; thể gi&atilde;n ra thoải m&aacute;i.</span></span></p>\r\n<p>\r\n	<span style="font-family:arial,helvetica,sans-serif;"><span style="font-size:14px;">Nếu như bạn kh&ocirc;ng c&oacute; thời gian m&agrave; muốn sử dụng đ&ocirc;i gi&agrave;y n&agrave;y thường xuy&ecirc;n th&igrave; tốt nhất bạn n&ecirc;n mua một chiếc khu&ocirc;n l&oacute;t gi&agrave;y.</span></span></p>\r\n<div>\r\n	<span style="font-family:arial,helvetica,sans-serif;"><span style="font-size:14px;"><img alt="" src="http://image.tantinh.net/domain/boutique/2_501-Nero-7.JPG" /></span></span></div>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	<span style="font-family:arial,helvetica,sans-serif;"><span style="font-size:14px;">V&agrave; một c&aacute;ch cuối c&ugrave;ng v&agrave; tiện lợi nhất đ&oacute; l&agrave; bạn h&atilde;y đến DIOGINI sắm một đ&ocirc;i&nbsp;gi&agrave;y da cao cấp&nbsp;ở đ&acirc;y. Với hai d&ograve;ng sản phẩm ch&iacute;nh đ&oacute; l&agrave; MINICHINO v&agrave; CAPONI c&aacute;c mẫu gi&agrave;y da đều l&agrave;m từ da b&ograve; nguy&ecirc;n chất khi bạn sử dụng sẽ c&oacute; cảm gi&aacute;c như đi bộ tr&ecirc;n da mềm v&agrave; đặc biệt mỗi đ&ocirc;i gi&agrave;y đều c&oacute; một miếng l&oacute;t gi&agrave;y được l&agrave;m từ một miếng da c&oacute; t&aacute;c dụng&nbsp;khử m&ugrave;i, tho&aacute;t mồ h&ocirc;i nhanh gi&uacute;p ch&acirc;n bạn lu&ocirc;n kh&ocirc; tho&aacute;ng. Sau v&agrave;i ng&agrave;y sử dụng da gi&agrave;y sẽ mềm ch&uacute;t nhưng kh&ocirc;ng hề mất form mẫu ban đầu tạo cho bạn cảm gi&aacute;c thoải m&aacute;i m&agrave; đ&ocirc;i gi&agrave;y vẫn kh&ocirc;ng hề bị mất form.</span></span></p>\r\n<div>\r\n	<span style="font-family:arial,helvetica,sans-serif;"><span style="font-size:14px;"><img alt="" src="http://image.tantinh.net/domain/boutique/IMG_8990.JPG" /></span></span></div>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	<span style="font-family:arial,helvetica,sans-serif;"><span style="font-size:14px;">&nbsp;Để c&oacute; thể đi ngay đ&ocirc;i gi&agrave;y da m&agrave; m&igrave;nh mới sắm m&agrave; kh&ocirc;ng lo bị đau ch&acirc;n th&igrave; sao bạn kh&ocirc;ng đến với</span></span></p>\r\n<h2>\r\n	<span style="font-family:arial,helvetica,sans-serif;"><span style="font-size:14px;">DIOGINI</span></span></h2>\r\n<p>\r\n	<span style="font-family:arial,helvetica,sans-serif;"><span style="font-size:14px;">để mua v&agrave; cảm nhận!!!!</span></span></p>\r\n', 'BBT', '0000-00-00 00:00:00', 0, 1, 0, 'bi-quyet-di-giay-da-moi-thoai-mai-1428295255');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_post_tag`
--

CREATE TABLE IF NOT EXISTS `tbl_post_tag` (
`id` int(11) NOT NULL,
  `id_post` int(11) NOT NULL,
  `id_tag` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_post_tag`
--

INSERT INTO `tbl_post_tag` (`id`, `id_post`, `id_tag`) VALUES
(65, 70, 8),
(66, 71, 8),
(67, 72, 2),
(68, 73, 2),
(69, 74, 2),
(70, 75, 2),
(71, 76, 2),
(72, 77, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_presentation`
--

CREATE TABLE IF NOT EXISTS `tbl_presentation` (
`id` int(11) NOT NULL,
  `name` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `order` int(11) NOT NULL,
  `key` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE IF NOT EXISTS `tbl_product` (
`id` int(9) NOT NULL,
  `idsupplier` int(11) NOT NULL,
  `idcategory` int(11) NOT NULL,
  `idmanufacturer` int(11) NOT NULL,
  `idattributeproduct` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `price1` int(12) NOT NULL,
  `price2` int(12) NOT NULL,
  `viewed` int(11) NOT NULL,
  `liked` int(11) NOT NULL,
  `key` varchar(250) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=166 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`id`, `idsupplier`, `idcategory`, `idmanufacturer`, `idattributeproduct`, `name`, `code`, `price1`, `price2`, `viewed`, `liked`, `key`) VALUES
(144, 12, 15, 30, 3, 'Bóp Nam Da Cá Sấu', 'BNCS1215144', 1500000, 0, 0, 0, 'bop-nam-da-ca-sau-1412609889'),
(145, 12, 15, 30, 1, 'Bóp Nam Da Cá Sấu', 'BNCS1215145', 1000000, 0, 0, 0, 'bop-nam-da-ca-sau-1412516543'),
(146, 12, 16, 30, 2, 'Dây Nịt Da Đà Điểu', 'ADT087N', 1300000, 0, 0, 0, 'day-nit-da-da-dieu-1412516670'),
(147, 12, 16, 30, 3, 'Dây Nịt Da Cá Sấu', 'ADT084N', 2000000, 0, 0, 0, 'day-nit-da-ca-sau-1412516832'),
(148, 12, 17, 30, 1, 'Dép Sabo Da Cá Sấu', 'ADT083E', 2500000, 0, 0, 0, 'dep-sabo-ca-sau-1412609866'),
(149, 12, 17, 30, 2, 'Dép Sabo Da Cá Sấu', 'ADT082E', 1800000, 0, 0, 0, 'dep-sabo-ca-sau-1412609872'),
(150, 12, 18, 30, 3, 'Túi Xách Nữ Da Cá Sấu', 'ADT018', 3600000, 0, 0, 0, 'tui-xach-nu-da-ca-sau-1412609879'),
(151, 12, 18, 30, 1, 'Túi Xách Nữ Da Trăn', 'ADT015', 2750000, 0, 0, 0, 'tui-xach-nu-da-tran-1412609918'),
(152, 12, 19, 30, 2, 'Ví Nữ Da Cá Sấu Gấp 3', 'ADT039V', 3100000, 0, 0, 0, 'vi-nu-da-ca-sau-gap-3-1412624116'),
(153, 12, 19, 30, 3, 'Ví Nữ Da Cá Sấu Gấp 3', 'ADT041V', 3900000, 0, 0, 0, 'vi-nu-da-ca-sau-gap-3-1412610317'),
(154, 12, 20, 30, 1, 'Thắt Lưng Nữ Da Cá Sấu', 'ADT091L', 1250000, 0, 0, 0, 'that-lung-nu-da-ca-sau-1413445171'),
(155, 12, 22, 30, 3, 'Thắt Lưng Nữ Da Cá Sấu', 'ADT090L', 1250000, 0, 0, 0, 'that-lung-nu-da-ca-sau-1413445638'),
(158, 12, 15, 30, 3, 'Bóp Nam Da Đà Điểu', 'BNCS1215148', 1100000, 0, 0, 0, 'giay-nam-da-da-dieu-141251613568496'),
(159, 12, 15, 30, 1, 'Bóp Nam Da Cá Sấu', 'ADT049B', 1300000, 0, 0, 0, 'bop-nam-da-ca-sau-14125165431585'),
(160, 12, 18, 30, 2, 'Túi Xách Nữ Da Trăn', 'ADT015', 7500000, 0, 0, 0, 'tui-xach-nu-da-tran-150304123468'),
(161, 12, 18, 30, 3, 'Túi Xách Nữ Da Cá Sấu', 'ADT008', 1050000, 0, 0, 0, 'tui-xach-nu-da-tran-150304125841157'),
(162, 12, 14, 30, 2, 'Giầy Nam Da Cá Sấu', 'GN1748630', 1200000, 1200000, 10, 1, 'giay-nam-da-ca-sau-01'),
(163, 12, 14, 30, 1, 'Giầy Nam Da Cá Sấu', 'GN001023456', 1000000, 1000000, 1, 1, 'giay-nam-da-ca-sau'),
(164, 12, 14, 30, 1, 'Giầy Nam Da trăn', 'GNT0124588', 1500000, 1500000, 1, 1, 'giay-nam-da-tran'),
(165, 12, 14, 30, 2, 'Giầy Nam Da trăn Loại 1', 'GNT0124588', 1800000, 1800000, 1, 1, 'giay-nam-da-tran-01');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_attribute`
--

CREATE TABLE IF NOT EXISTS `tbl_product_attribute` (
`id` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `id_attribute` int(11) NOT NULL,
  `value` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_image`
--

CREATE TABLE IF NOT EXISTS `tbl_product_image` (
`id` int(11) NOT NULL,
  `idproduct` int(11) NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `url` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=225 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_info`
--

CREATE TABLE IF NOT EXISTS `tbl_product_info` (
`id` int(11) NOT NULL,
  `idproduct` int(11) NOT NULL,
  `image1` varchar(150) NOT NULL,
  `image2` varchar(150) NOT NULL,
  `info` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=137 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_product_info`
--

INSERT INTO `tbl_product_info` (`id`, `idproduct`, `image1`, `image2`, `info`) VALUES
(111, 147, '/mvc/templates/front/img/item-2/6.jpg', '/mvc/templates/front/img/item-2/6.jpg', '<p>\r\n	<font color="#000000" face="Verdana, Geneva, sans-serif" size="2"><span style="line-height: 20.7999992370605px;">Video giới thiệu m&oacute;n C&aacute; L&oacute;c nướng trui của Đ&agrave;i Truyền H&igrave;nh Đồng Th&aacute;p thực hiện.</span></font></p>\r\n<p>\r\n	<iframe align="middle" frameborder="0" height="480" scrolling="no" src="http://www.youtube.com/embed/5u43mMzSLmk" width="100%"></iframe></p>\r\n<p>\r\n	&nbsp;</p>\r\n'),
(112, 146, '/mvc/templates/front/img/item/1.jpg', '/mvc/templates/front/img/item/1.jpg', '<p>\r\n	<iframe frameborder="0" height="480" scrolling="no" src="http://www.youtube.com/embed/BEx436PJf_0" width="100%"></iframe></p>\r\n'),
(113, 145, '/mvc/templates/front/img/item-2/2.jpg', '/mvc/templates/front/img/item/2.jpg', '<p>\r\n	C&aacute; l&oacute;c kho tộ</p>\r\n'),
(114, 144, '/mvc/templates/front/img/item-2/3.jpg', '/mvc/templates/front/img/item/3.jpg', '<p>\r\n	Lẩu ch&aacute;o c&aacute;</p>\r\n'),
(117, 152, '/mvc/templates/front/img/item/6.jpg', '/mvc/templates/front/img/item/6.jpg', '<p>\r\n	<span style="color: rgb(0, 0, 0); font-family: Verdana, Geneva, sans-serif; font-size: 13px; line-height: 20.7999992370605px;">Những ng&agrave;y mưa, nước nổi khắp c&aacute;c c&aacute;nh đồng. Thời điểm n&agrave;y cũng l&agrave; l&uacute;c ốc bươu xuất hiện kh&aacute; nhiều sau bao ng&agrave;y tr&aacute;nh nắng.</span><br style="color: rgb(0, 0, 0); font-family: Verdana, Geneva, sans-serif; font-size: 13px; line-height: 20.7999992370605px;" />\r\n	<br style="color: rgb(0, 0, 0); font-family: Verdana, Geneva, sans-serif; font-size: 13px; line-height: 20.7999992370605px;" />\r\n	<span style="color: rgb(0, 0, 0); font-family: Verdana, Geneva, sans-serif; font-size: 13px; line-height: 20.7999992370605px;">Ốc bươu l&agrave; một m&oacute;n d&acirc;n d&atilde; được nhiều người th&iacute;ch từ l&acirc;u nay. D&ugrave; l&agrave;m m&oacute;n g&igrave; th&igrave; c&ocirc;ng đoạn trước ti&ecirc;n l&agrave; phải đem to&agrave;n bộ số ốc ng&acirc;m nước lạnh, xả đi xả lại nhiều lần trong ng&agrave;y. C&oacute; người sợ ốc ốm mất ngon n&ecirc;n thường ng&acirc;m ốc với nước vo gạo, c&aacute;ch n&agrave;y vừa l&agrave;m cho ốc mau ra chất b&ugrave;n vừa l&agrave;m cho con ốc giữ được chất dinh dưỡng nhờ h&uacute;t từ nước gạo.</span><br style="color: rgb(0, 0, 0); font-family: Verdana, Geneva, sans-serif; font-size: 13px; line-height: 20.7999992370605px;" />\r\n	<br style="color: rgb(0, 0, 0); font-family: Verdana, Geneva, sans-serif; font-size: 13px; line-height: 20.7999992370605px;" />\r\n	<span style="color: rgb(0, 0, 0); font-family: Verdana, Geneva, sans-serif; font-size: 13px; line-height: 20.7999992370605px;">C&aacute;c m&oacute;n truyền thống của ốc bươu l&acirc;u nay th&igrave; vẫn cứ hấp sả, luộc, um chuối xanh. Thế nhưng, chẳng lẽ cứ mấy m&oacute;n n&agrave;y ăn ho&agrave;i th&igrave; cũng ch&aacute;n. Mới đ&acirc;y, c&aacute;c chị ở x&oacute;m t&ocirc;i lại &ldquo;ph&aacute;t minh&rdquo; ra một m&oacute;n mới ho&agrave;n to&agrave;n, vừa lạ vừa ngon lại mang ch&uacute;t d&aacute;ng dấp ph&ugrave; hợp với văn h&oacute;a ẩm thực của người Việt, đ&oacute; ch&iacute;nh l&agrave; m&oacute;n ốc bươu xốt nước cốt dừa.</span><br style="color: rgb(0, 0, 0); font-family: Verdana, Geneva, sans-serif; font-size: 13px; line-height: 20.7999992370605px;" />\r\n	<br style="color: rgb(0, 0, 0); font-family: Verdana, Geneva, sans-serif; font-size: 13px; line-height: 20.7999992370605px;" />\r\n	<img pagespeed_url_hash="1422104211" src="http://www.bepnhata.com/img/b5d9679f5deac444a40baf2fc7a90aa56d50c93326f6cd52024ffdb21f1cd9f23931046fbfef2eea63fe.jpg" style="margin: 0px; padding: 0px; border: none; color: rgb(0, 0, 0); font-family: Verdana, Geneva, sans-serif; font-size: 13px; line-height: 20.7999992370605px;" /><br style="color: rgb(0, 0, 0); font-family: Verdana, Geneva, sans-serif; font-size: 13px; line-height: 20.7999992370605px;" />\r\n	<br style="color: rgb(0, 0, 0); font-family: Verdana, Geneva, sans-serif; font-size: 13px; line-height: 20.7999992370605px;" />\r\n	<i style="color: rgb(0, 0, 0); font-family: Verdana, Geneva, sans-serif; font-size: 13px; line-height: 20.7999992370605px;">Ốc bươu xốt nước cốt dừa l&agrave; một m&oacute;n hảo hạng</i><br style="color: rgb(0, 0, 0); font-family: Verdana, Geneva, sans-serif; font-size: 13px; line-height: 20.7999992370605px;" />\r\n	<span style="color: rgb(0, 0, 0); font-family: Verdana, Geneva, sans-serif; font-size: 13px; line-height: 20.7999992370605px;">Ốc c&oacute; rồi, dừa vườn nh&agrave; th&igrave; kh&ocirc;ng thiếu. Thường c&aacute;c chị chọn loại dừa vừa gi&agrave;. Tr&aacute;i dừa bổ ra, lấy nước để ri&ecirc;ng rồi d&ugrave;ng c&acirc;y s&ograve; hay c&aacute;i nắp chai bia nạo phần cơm dừa ra từng sợi mảnh, cho v&agrave;o cối gi&atilde; thật nhuyễn. Sau khi gi&atilde; xong, cho phần nước dừa đ&atilde; để ri&ecirc;ng v&agrave;o phần cơm dừa rồi d&ugrave;ng tay trộn đều cho nước dừa v&agrave; cơm dừa h&ograve;a quyện.</span><br style="color: rgb(0, 0, 0); font-family: Verdana, Geneva, sans-serif; font-size: 13px; line-height: 20.7999992370605px;" />\r\n	<br style="color: rgb(0, 0, 0); font-family: Verdana, Geneva, sans-serif; font-size: 13px; line-height: 20.7999992370605px;" />\r\n	<span style="color: rgb(0, 0, 0); font-family: Verdana, Geneva, sans-serif; font-size: 13px; line-height: 20.7999992370605px;">Sau đ&oacute; lược lấy phần nước cốt dừa c&oacute; m&agrave;u trắng đục đem đổ v&agrave;o nồi ốc đ&atilde; ướp gia vị trước đ&oacute;. Đợi một ch&uacute;t cho nước cốt dừa thấm đều từng con ốc rồi đậy nắp đem bắc l&ecirc;n bếp, cứ thế nấu đến khi n&agrave;o nước cốt ngấm v&agrave;o thịt ốc v&agrave; chỉ c&ograve;n xăm xấp trong nồi ốc th&igrave; c&oacute; thể khui nồi d&ugrave;ng được.</span><br style="color: rgb(0, 0, 0); font-family: Verdana, Geneva, sans-serif; font-size: 13px; line-height: 20.7999992370605px;" />\r\n	<br style="color: rgb(0, 0, 0); font-family: Verdana, Geneva, sans-serif; font-size: 13px; line-height: 20.7999992370605px;" />\r\n	<span style="color: rgb(0, 0, 0); font-family: Verdana, Geneva, sans-serif; font-size: 13px; line-height: 20.7999992370605px;">Ốc bươu xốt nước cốt dừa l&agrave; một m&oacute;n hảo hạng. Ốc được m&uacute;c ra đĩa, tỏa hơi thơm phức. D&ugrave; ở qu&ecirc; nhưng c&aacute;c chị cũng l&yacute; giải rất hợp t&igrave;nh hợp l&yacute;, l&agrave; ăn ốc nước dừa c&oacute; t&iacute;nh m&aacute;t rất dễ bị h&agrave;n n&ecirc;n nhất thiết phải c&oacute; ch&eacute;n mắm gừng, &iacute;t đọt rau răm để kề b&ecirc;n mới c&acirc;n bằng &acirc;m dương trong t&igrave; vị, nếu c&oacute; ch&uacute;t rượu ng&acirc;m nhấm nh&aacute;p c&agrave;ng hay.</span><br style="color: rgb(0, 0, 0); font-family: Verdana, Geneva, sans-serif; font-size: 13px; line-height: 20.7999992370605px;" />\r\n	<br style="color: rgb(0, 0, 0); font-family: Verdana, Geneva, sans-serif; font-size: 13px; line-height: 20.7999992370605px;" />\r\n	<span style="color: rgb(0, 0, 0); font-family: Verdana, Geneva, sans-serif; font-size: 13px; line-height: 20.7999992370605px;">Phải n&oacute;i với m&oacute;n n&agrave;y, con ốc bươu từ nơi b&ugrave;n s&acirc;u lấm l&aacute;p đ&atilde; h&oacute;a th&acirc;n th&agrave;nh một đặc sản ẩm thực độc đ&aacute;o trong m&ugrave;a nước nổi.</span></p>\r\n'),
(118, 151, '/mvc/templates/front/img/item-3/7.jpg', '/mvc/templates/front/img/item/7.jpg', ''),
(119, 150, '/mvc/templates/front/img/item-3/8.jpg', '/mvc/templates/front/img/item/8.jpg', '<p style="text-align: justify;">\r\n	<font color="#000000" face="Verdana, Geneva, sans-serif" size="2"><span style="line-height: 20.7999992370605px;">Video giới thiệu m&oacute;n Ốc nướng ti&ecirc;u do Đ&agrave;i TH Đồng Th&aacute;p thực hiện</span></font></p>\r\n<p style="text-align: justify;">\r\n	<font color="#000000" face="Verdana, Geneva, sans-serif" size="2"><span style="line-height: 20.7999992370605px;"><iframe frameborder="0" height="480" scrolling="no" src="http://www.youtube.com/embed/noIRBGRf1Xk" width="100%"></iframe></span></font></p>\r\n'),
(120, 148, '/mvc/templates/front/img/item/1.jpg', '/mvc/templates/front/img/item-2/1.jpg', '<p>\r\n	<span style="color: rgb(0, 0, 0); font-family: Verdana, Geneva, sans-serif; font-size: 13px; line-height: 20.7999992370605px;">Ăn một ch&eacute;n canh n&oacute;ng cuối bữa ăn trước l&uacute;c tr&aacute;ng miệng đ&atilde; trở th&agrave;nh th&oacute;i quen trong những bữa cơm Việt. Thực đơn c&aacute;c m&oacute;n canh th&igrave; phong ph&uacute; v&ocirc; c&ugrave;ng, trong đ&oacute; c&oacute;&nbsp;canh chuối&nbsp;xanh nấu ốc.</span><br style="color: rgb(0, 0, 0); font-family: Verdana, Geneva, sans-serif; font-size: 13px; line-height: 20.7999992370605px;" />\r\n	<br style="color: rgb(0, 0, 0); font-family: Verdana, Geneva, sans-serif; font-size: 13px; line-height: 20.7999992370605px;" />\r\n	<span style="color: rgb(0, 0, 0); font-family: Verdana, Geneva, sans-serif; font-size: 13px; line-height: 20.7999992370605px;">Những tr&aacute;i&nbsp;chuối xanh được chọn lọc kỹ lưỡng l&agrave; những quả ngon nhất trong buồng, m&igrave;nh nẩy, căng tr&ograve;n. Chuối được gọt vỏ, ng&acirc;m trong nước pha giấm cho &ldquo;nhả&rdquo; mủ. Xắt chuối th&agrave;nh l&aacute;t vừa, tr&uacute;t v&agrave;o nồi luộc ch&iacute;n. Vớt ra, gi&atilde; chuối nhuyễn vừa phải, rồi cho th&ecirc;m ch&uacute;t muối, đường v&agrave; ti&ecirc;u.</span><br style="color: rgb(0, 0, 0); font-family: Verdana, Geneva, sans-serif; font-size: 13px; line-height: 20.7999992370605px;" />\r\n	<br style="color: rgb(0, 0, 0); font-family: Verdana, Geneva, sans-serif; font-size: 13px; line-height: 20.7999992370605px;" />\r\n	<span style="color: rgb(0, 0, 0); font-family: Verdana, Geneva, sans-serif; font-size: 13px; line-height: 20.7999992370605px;">Ốc bươu l&agrave;m sạch, ướp gia vị cho thấm. Khử dầu, ngon nhất l&agrave; dầu từ hạt đậu phộng &eacute;p, thơm lừng cả gian bếp; khi dầu vừa ch&iacute;n tới cho v&agrave;o ch&uacute;t h&agrave;nh băm nhỏ. X&agrave;o ch&iacute;n ốc, sau đ&oacute; cho cho chuối v&agrave;o x&agrave;o chung, đổ lượng nước vừa đủ v&agrave;o nấu s&ocirc;i l&ecirc;n, n&ecirc;m cho vừa miệng.</span><br style="color: rgb(0, 0, 0); font-family: Verdana, Geneva, sans-serif; font-size: 13px; line-height: 20.7999992370605px;" />\r\n	<br style="color: rgb(0, 0, 0); font-family: Verdana, Geneva, sans-serif; font-size: 13px; line-height: 20.7999992370605px;" />\r\n	<span style="color: rgb(0, 0, 0); font-family: Verdana, Geneva, sans-serif; font-size: 13px; line-height: 20.7999992370605px;">&nbsp;</span><br style="color: rgb(0, 0, 0); font-family: Verdana, Geneva, sans-serif; font-size: 13px; line-height: 20.7999992370605px;" />\r\n	<img pagespeed_url_hash="268396196" src="http://www.bepnhata.com/img/b5d9679f5deac444a40baf2fc7a90aa56d50ce3327f6cf52034ffdb21f1bd9f233350a65bfef2eea63fe.jpg" style="margin: 0px; padding: 0px; border: none; color: rgb(0, 0, 0); font-family: Verdana, Geneva, sans-serif; font-size: 13px; line-height: 20.7999992370605px;" /><br style="color: rgb(0, 0, 0); font-family: Verdana, Geneva, sans-serif; font-size: 13px; line-height: 20.7999992370605px;" />\r\n	<br style="color: rgb(0, 0, 0); font-family: Verdana, Geneva, sans-serif; font-size: 13px; line-height: 20.7999992370605px;" />\r\n	<span style="color: rgb(0, 0, 0); font-family: Verdana, Geneva, sans-serif; font-size: 13px; line-height: 20.7999992370605px;">Nguy&ecirc;n liệu nấu canh chuối ốc</span><br style="color: rgb(0, 0, 0); font-family: Verdana, Geneva, sans-serif; font-size: 13px; line-height: 20.7999992370605px;" />\r\n	<br style="color: rgb(0, 0, 0); font-family: Verdana, Geneva, sans-serif; font-size: 13px; line-height: 20.7999992370605px;" />\r\n	<span style="color: rgb(0, 0, 0); font-family: Verdana, Geneva, sans-serif; font-size: 13px; line-height: 20.7999992370605px;">Canh chuối ốc kh&aacute; dễ nấu nhưng nấu cho ngon th&igrave;... kh&ocirc;ng dễ. Phải thật tỉ mỉ trong từng c&ocirc;ng đoạn sơ chế chuối, ốc; sao cho chuối vừa ch&iacute;n tới, kh&ocirc;ng qu&aacute; cứng cũng kh&ocirc;ng bị nh&atilde;o. M&oacute;n canh ngon l&agrave; sự h&ograve;a quyện của nhiều yếu tố. Đậu phộng rang gi&atilde; vừa cho v&agrave;o canh th&ecirc;m vị b&ugrave;i b&ugrave;i. Rau m&ugrave;i ng&ograve; gai xắt nhỏ cho v&agrave;o canh dậy m&ugrave;i thơm đậm đ&agrave;, kh&oacute; qu&ecirc;n.&nbsp;</span></p>\r\n'),
(121, 149, '/mvc/templates/front/img/item/2.jpg', '/mvc/templates/front/img/item-2/2.jpg', '<p style="list-style: none; margin: 0px 0px 10px; padding: 0px; color: rgb(0, 0, 0); font-family: arial; font-size: 14px; text-align: justify;">\r\n	<span style="font-family: Verdana, Geneva, sans-serif; font-size: 13px; line-height: 20.7999992370605px;">Những chiếc vỏ ốc to đ&ugrave;ng, được nhồi đầy thịt, ăn k&egrave;m với l&aacute; t&iacute;a t&ocirc; c&ugrave;ng ch&eacute;n nước chấm đậm đ&agrave; cho bạn cảm gi&aacute;c ngon miệng v&agrave; kh&ocirc;ng ng&aacute;n.</span><br style="font-family: Verdana, Geneva, sans-serif; font-size: 13px; line-height: 20.7999992370605px;" />\r\n	<span style="font-family: Verdana, Geneva, sans-serif; font-size: 13px; line-height: 20.7999992370605px;">Đ&acirc;y l&agrave; m&oacute;n ăn mang hương vị Bắc nhưng đ&atilde; được biến tấu cho ph&ugrave; hợp với khẩu vị của người Nam. Khi chế biến m&oacute;n ăn n&agrave;y, người Bắc thường hấp chung ốc với l&aacute; gừng để m&oacute;n ăn c&oacute; vị cay v&agrave; thơm, tuy nhi&ecirc;n, người Nam đ&atilde; thay thế bằng sả, hương thơm của sả thấm đẫm v&agrave;o trong thịt ốc khi hấp ch&iacute;n l&agrave;m tăng th&ecirc;m hương vị cho m&oacute;n ăn.</span><br style="font-family: Verdana, Geneva, sans-serif; font-size: 13px; line-height: 20.7999992370605px;" />\r\n	<br style="font-family: Verdana, Geneva, sans-serif; font-size: 13px; line-height: 20.7999992370605px;" />\r\n	<img pagespeed_url_hash="3009743152" src="http://www.bepnhata.com/img/b5d9679f5deac444a40baf2fc7a90aa56d50ce3328f6c84e1655e2b01e19c5ec30340c6fd08131ae79e9d3.jpg" style="margin: 0px; padding: 0px; border: none; font-family: Verdana, Geneva, sans-serif; font-size: 13px; line-height: 20.7999992370605px;" /><br style="font-family: Verdana, Geneva, sans-serif; font-size: 13px; line-height: 20.7999992370605px;" />\r\n	<br style="font-family: Verdana, Geneva, sans-serif; font-size: 13px; line-height: 20.7999992370605px;" />\r\n	<span style="font-family: Verdana, Geneva, sans-serif; font-size: 13px; line-height: 20.7999992370605px;">Mặc d&ugrave; chỉ b&aacute;n duy nhất một loại ốc bươu nhồi thịt, nhưng qu&aacute;n ốc đường Nguyễn Văn Giai (quận 1) lu&ocirc;n đ&ocirc;ng kh&aacute;ch. Ngo&agrave;i ra, đ&acirc;y c&ograve;n l&agrave; đại l&yacute; chuy&ecirc;n bỏ sỉ cho c&aacute;c nh&agrave; h&agrave;ng, qu&aacute;n ăn ở S&agrave;i G&ograve;n.</span><br style="font-family: Verdana, Geneva, sans-serif; font-size: 13px; line-height: 20.7999992370605px;" />\r\n	<br style="font-family: Verdana, Geneva, sans-serif; font-size: 13px; line-height: 20.7999992370605px;" />\r\n	<span style="font-family: Verdana, Geneva, sans-serif; font-size: 13px; line-height: 20.7999992370605px;">Nhắc đến m&oacute;n n&agrave;y th&igrave; kh&ocirc;ng thể bỏ qua qu&aacute;n ốc tr&ecirc;n đường Nguyễn Văn Giai (quận 1). Chỉ b&aacute;n duy nhất một loại ốc bươu nhồi thịt nhưng qu&aacute;n đ&atilde; tồn tại hơn mười năm nay v&agrave; trở th&agrave;nh địa điểm quen thuộc của những t&iacute;n đồ tr&oacute;t m&ecirc; hương vị thơm ngon, đậm đ&agrave; của m&oacute;n ăn n&agrave;y.</span><br style="font-family: Verdana, Geneva, sans-serif; font-size: 13px; line-height: 20.7999992370605px;" />\r\n	<br style="font-family: Verdana, Geneva, sans-serif; font-size: 13px; line-height: 20.7999992370605px;" />\r\n	<span style="font-family: Verdana, Geneva, sans-serif; font-size: 13px; line-height: 20.7999992370605px;">Những con ốc bươu nhồi thịt ở đ&acirc;y lu&ocirc;n được thực kh&aacute;ch đ&aacute;nh gi&aacute; cao về hương vị thơm ngon v&agrave; sự hấp dẫn của n&oacute;. Theo chị chủ qu&aacute;n, m&oacute;n ăn n&agrave;y c&oacute; th&agrave;nh phần đơn giản, kh&ocirc;ng kh&oacute; chế biến nhưng sự tỉ mỉ v&agrave; cẩn thận th&igrave; kh&ocirc;ng thừa. Ốc bươu sau khi mua về, được ng&acirc;m trong nước vo gạo cho hết nhớt, rửa lại bằng nước sạch rồi đem luộc ch&iacute;n. Vớt ốc ra, loại bỏ phần ruột ốc để tr&aacute;nh m&ugrave;i b&ugrave;n, phần thịt rửa lại với nước cốt chanh pha ch&uacute;t muối. Vỏ ốc chần qua nước s&ocirc;i, để r&aacute;o.</span><br style="font-family: Verdana, Geneva, sans-serif; font-size: 13px; line-height: 20.7999992370605px;" />\r\n	<br style="font-family: Verdana, Geneva, sans-serif; font-size: 13px; line-height: 20.7999992370605px;" />\r\n	<img pagespeed_url_hash="4094265121" src="http://www.bepnhata.com/img/b5d9679f5deac444a40baf2fc7a90aa56d50ce3328f6c84e1655e2b01e19c5ec30340c6fd08132ae79e9d3.jpg" style="margin: 0px; padding: 0px; border: none; font-family: Verdana, Geneva, sans-serif; font-size: 13px; line-height: 20.7999992370605px;" /><br style="font-family: Verdana, Geneva, sans-serif; font-size: 13px; line-height: 20.7999992370605px;" />\r\n	<br style="font-family: Verdana, Geneva, sans-serif; font-size: 13px; line-height: 20.7999992370605px;" />\r\n	<span style="font-family: Verdana, Geneva, sans-serif; font-size: 13px; line-height: 20.7999992370605px;">Ốc bươu nhồi thịt l&agrave; m&oacute;n ăn của người Bắc đ&atilde; được biến tấu cho ph&ugrave; hợp với hương vị của người Nam.</span><br style="font-family: Verdana, Geneva, sans-serif; font-size: 13px; line-height: 20.7999992370605px;" />\r\n	<br style="font-family: Verdana, Geneva, sans-serif; font-size: 13px; line-height: 20.7999992370605px;" />\r\n	<span style="font-family: Verdana, Geneva, sans-serif; font-size: 13px; line-height: 20.7999992370605px;">Phần nh&acirc;n nhồi trong vỏ ốc được chế biến từ thịt ốc luộc ch&iacute;n, th&aacute;i l&aacute;t mỏng, trộn chung với hỗn hợp thịt băm, gi&ograve; sống, nấm m&egrave;o được n&ecirc;m gia vị vừa ăn. Sau khi chuẩn bị xong phần nh&acirc;n, người b&aacute;n vo th&agrave;nh từng vi&ecirc;n nhỏ, quấn quanh một cọng sả nhỏ, nh&eacute;t v&agrave;o th&acirc;n ốc v&agrave; đem hấp ch&iacute;n. M&oacute;n ăn tăng th&ecirc;m hương vị cay nồng khi được điểm xuyết th&ecirc;m một v&agrave;i l&aacute;t ớt mỏng.</span><br style="font-family: Verdana, Geneva, sans-serif; font-size: 13px; line-height: 20.7999992370605px;" />\r\n	<br style="font-family: Verdana, Geneva, sans-serif; font-size: 13px; line-height: 20.7999992370605px;" />\r\n	<span style="font-family: Verdana, Geneva, sans-serif; font-size: 13px; line-height: 20.7999992370605px;">M&oacute;n n&agrave;y ngon nhất khi d&ugrave;ng n&oacute;ng, vị ngọt của phần nh&acirc;n h&ograve;a c&ugrave;ng với hương thơm của sả thật quyến rũ. Ch&eacute;n nước mắm gừng được pha hơi sền sệt, c&ugrave;ng c&aacute;c loại rau ăn k&egrave;m như t&iacute;a t&ocirc;, rau răm vừa gi&uacute;p giải h&agrave;n vừa l&agrave;m cho m&oacute;n ăn th&ecirc;m đậm đ&agrave; v&agrave; kh&ocirc;ng cho cảm gi&aacute;c ng&aacute;n.</span><br style="font-family: Verdana, Geneva, sans-serif; font-size: 13px; line-height: 20.7999992370605px;" />\r\n	<br style="font-family: Verdana, Geneva, sans-serif; font-size: 13px; line-height: 20.7999992370605px;" />\r\n	<img pagespeed_url_hash="883819794" src="http://www.bepnhata.com/img/b5d9679f5deac444a40baf2fc7a90aa56d50ce3328f6c84e1655e2b01e19c5ec30340c6fd08133ae79e9d3.jpg" style="margin: 0px; padding: 0px; border: none; font-family: Verdana, Geneva, sans-serif; font-size: 13px; line-height: 20.7999992370605px;" /><br style="font-family: Verdana, Geneva, sans-serif; font-size: 13px; line-height: 20.7999992370605px;" />\r\n	<br style="font-family: Verdana, Geneva, sans-serif; font-size: 13px; line-height: 20.7999992370605px;" />\r\n	<span style="font-family: Verdana, Geneva, sans-serif; font-size: 13px; line-height: 20.7999992370605px;">M&oacute;n ốc bươu nhồi thịt sẽ tăng th&ecirc;m hương vị khi được ăn k&egrave;m với l&aacute; t&iacute;a t&ocirc; c&ugrave;ng ch&eacute;n nước mắm gừng.</span><br style="font-family: Verdana, Geneva, sans-serif; font-size: 13px; line-height: 20.7999992370605px;" />\r\n	<br style="font-family: Verdana, Geneva, sans-serif; font-size: 13px; line-height: 20.7999992370605px;" />\r\n	<span style="font-family: Verdana, Geneva, sans-serif; font-size: 13px; line-height: 20.7999992370605px;">Nếu bạn chưa thưởng thức m&oacute;n ốc thơm ngon n&agrave;y c&oacute; thể gh&eacute; đến khu ẩm thực L&agrave;ng Sen ch&uacute;ng t&ocirc;i. Theo thời gi&aacute; hiện nay mỗi con ốc c&oacute; gi&aacute; 5.000 đồng.</span></p>\r\n'),
(122, 153, '/mvc/templates/front/img/item-2/3.jpg', '/mvc/templates/front/img/item-2/3.jpg', '<p>\r\n	Video m&oacute;n ốc hấp mẻ do Đ&agrave;i TH Đồng Th&aacute;p thực hiện:</p>\r\n<p>\r\n	<iframe frameborder="0" height="480" scrolling="no" src="http://www.youtube.com/embed/mP0LO9JLA8Y" width="100%"></iframe></p>\r\n'),
(123, 154, '/mvc/templates/front/img/item-2/4.jpg', '/mvc/templates/front/img/item-2/4.jpg', '<p>\r\n	<iframe frameborder="0" height="480" scrolling="no" src="http://www.youtube.com/embed/7PtD4mNXcUc" width="100%"></iframe></p>\r\n'),
(124, 155, '/mvc/templates/front/img/item-2/5.jpg', '/mvc/templates/front/img/item-2/5.jpg', '<p>\r\n	<iframe frameborder="0" height="480" scrolling="no" src="http://www.youtube.com/embed/2Ue7qWKThis" width="100%"></iframe></p>\r\n'),
(127, 158, '/mvc/templates/front/img/item-2/4.jpg', '/mvc/templates/front/img/item-2/4.jpg', ''),
(128, 159, '/mvc/templates/front/img/item-2/2.jpg', '/mvc/templates/front/img/item-2/2.jpg', ''),
(129, 160, '/mvc/templates/front/img/item-3/3.jpg', '/mvc/templates/front/img/item-3/3.jpg', ''),
(130, 161, '/mvc/templates/front/img/item-3/7.jpg', '/mvc/templates/front/img/item-3/7.jpg', ''),
(131, 162, '/mvc/templates/front/img/item/2.jpg', '/mvc/templates/front/img/item/2.jpg', ''),
(132, 163, '/mvc/templates/front/img/item/5.jpg', '/mvc/templates/front/img/item/3.jpg', ''),
(133, 164, '/mvc/templates/front/img/item/6.jpg', '/mvc/templates/front/img/item/6.jpg', ''),
(134, 165, '/mvc/templates/front/img/item/7.jpg', '/mvc/templates/front/img/item/7.jpg', ''),
(135, 164, '/mvc/templates/front/img/item/6.jpg', '/mvc/templates/front/img/item/6.jpg', ''),
(136, 165, '/mvc/templates/front/img/item/7.jpg', '/mvc/templates/front/img/item/7.jpg', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_slide`
--

CREATE TABLE IF NOT EXISTS `tbl_slide` (
`id` int(11) NOT NULL,
  `idpresentation` int(11) NOT NULL,
  `name` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `order` int(11) NOT NULL,
  `note` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(250) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_storyline`
--

CREATE TABLE IF NOT EXISTS `tbl_storyline` (
`id` int(11) NOT NULL,
  `date` date NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(150) NOT NULL,
  `title` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `note` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_storyline`
--

INSERT INTO `tbl_storyline` (`id`, `date`, `name`, `image`, `title`, `note`) VALUES
(2, '2014-04-26', 'Thanh Tuấn', 'https://lh5.googleusercontent.com/-feGBuj_C9Y8/U1q7ts_A8cI/AAAAAAAAAO4/Qr9uFO3c__U/s800/Tuan.jpg', 'Dịch vụ tốt', 'Mình đã ăn tại đây rồi, thức ăn với vị trí nói chung là good, cung cách nhân viên phục vụ vui vẻ.'),
(3, '2014-04-19', 'Công Toàn', 'https://lh4.googleusercontent.com/-KZnP4shBhBk/U1q5NFgdxYI/AAAAAAAAAOM/awi2-iXGaI0/s800/Toan.jpg', 'Món ăn đa dạng', 'Vừa rồi tôi có về Việt Nam ghé qua Làng Sen đồ ăn rất ngon phục vụ tốt đàn ca tài tử rất hay. Năm tới tôi sẽ trở lại Cám ơn toàn thể nhà hàng. Chào tạm biệt ! '),
(4, '2014-04-15', 'Anh Thư', 'https://lh6.googleusercontent.com/-E3RB1sBcHhU/U1q5NLq3HoI/AAAAAAAAAOQ/zeJAT-g5q3o/s800/Thu.jpg', 'Giá cả hợp lý', 'Thức ăn rất ngon, tôi thích nhất là món tàu hủ non chiên, ốc nướng tiêu ...'),
(5, '2014-04-09', 'Quí Hữu', 'https://lh5.googleusercontent.com/-pUqoZWiJDY4/U1q5NCj22yI/AAAAAAAAAOI/l6Q125WLgeA/s800/Huu.jpg', 'Khung cảnh lý tưởng', 'Quán nằm trên hồ sen, khung cảnh thoáng mát hữu tình và đẹp... Mình thích món ốc nướng tiêu ở đây, phải nói là quá ngon luôn. ');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_supplier`
--

CREATE TABLE IF NOT EXISTS `tbl_supplier` (
`id` int(9) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `note` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `debt` bigint(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_supplier`
--

INSERT INTO `tbl_supplier` (`id`, `name`, `phone`, `address`, `note`, `debt`) VALUES
(12, 'Công ty ABC', '0919 001 002', 'TP Hồ Chí Minh', 'TP Hồ Chí Minh', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tag`
--

CREATE TABLE IF NOT EXISTS `tbl_tag` (
`id` int(11) NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `key` varchar(250) NOT NULL,
  `order` int(11) NOT NULL,
  `position` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_tag`
--

INSERT INTO `tbl_tag` (`id`, `name`, `key`, `order`, `position`) VALUES
(1, 'Thông báo', 'thong-bao', 1, 1),
(2, 'Tin Tức', 'tin-tuc', 2, 1),
(3, 'Văn hóa ẩm thực', 'van-hoa-am-thuc', 3, 1),
(6, 'Chính sách', 'chinh-sach', 4, 1),
(7, 'Riêng tư', 'rieng-tu', 1, 2),
(8, 'Khuyến mãi', 'khuyen-mai', 1, 3),
(9, 'Địa điểm du lịch', 'dia-diem-du-lich', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
`id` int(11) NOT NULL,
  `name` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pass` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` int(11) NOT NULL,
  `note` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `datecreate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dateupdate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `dateactivity` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `type` tinyint(4) NOT NULL,
  `code` varchar(13) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `name`, `email`, `pass`, `gender`, `note`, `datecreate`, `dateupdate`, `dateactivity`, `type`, `code`) VALUES
(3, 'Bán hàng', 'banhang@gmail.com', '123456', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, ''),
(4, 'Quản lý', 'quanly@gmail.com', '123456', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 4, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_video`
--

CREATE TABLE IF NOT EXISTS `tbl_video` (
`id` int(11) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `note` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(250) NOT NULL,
  `viewed` int(11) NOT NULL,
  `liked` int(11) NOT NULL,
  `key` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_video`
--

INSERT INTO `tbl_video` (`id`, `name`, `date`, `note`, `url`, `viewed`, `liked`, `key`) VALUES
(2, 'Du Lịch Đồng Tháp [ Góc Nhìn Flycam ]', '2014-10-06', 'Du Lịch Đồng Tháp [ Góc Nhìn Flycam ]', 'http://www.youtube.com/embed/JqmsHZQvLO8', 31, 0, 'du-lich-dong-thap-goc-nhin-flycam-'),
(3, 'Khu du lịch Sinh Thái U Minh Thượng', '2014-10-05', 'Khu du lịch Sinh Thái U Minh Thượng', 'http://www.youtube.com/embed/-1AsOwUEEhk', 22, 0, 'khu-du-lich-sinh-thai-u-minh-thuong'),
(4, 'Đồng Tháp - Có một nơi như thế', '2014-10-06', 'Đồng Tháp - Có một nơi như thế', 'http://www.youtube.com/embed/EfTNGt7PVCE', 21, 0, 'dong-thap-co-mot-noi-nhu-the'),
(5, 'Nông dân Đồng Tháp với cánh đồng sen du lịch', '2014-10-07', 'Nông dân Đồng Tháp với cánh đồng sen du lịch', 'http://www.youtube.com/embed/nevyjKwPbXg', 35, 0, 'nong-dan-dong-thap-voi-canh-dong-sen-du-lich'),
(6, 'Nhịp sống miền Tây: Đồng Tháp Mười mùa sen', '2014-10-16', 'Nhịp sống miền Tây: Đồng Tháp Mười mùa sen', 'http://www.youtube.com/embed/n_ivp8OJ3o8', 17, 0, 'nhip-song-mien-tay-dong-thap-muoi-mua-sen'),
(7, 'Chuyện lạ về loài sen vua "cõng" người', '2014-10-16', 'Chuyện lạ về loài sen vua "cõng" người', 'http://www.youtube.com/embed/GoPac3l_1D8', 17, 0, 'chuyen-la-ve-loai-sen-vua-cong-nguoi'),
(8, 'Đặc sản rượu Đồng Tháp - Hồng sen tửu', '2014-10-16', 'Đặc sản rượu Đồng Tháp - Hồng sen tửu', 'http://www.youtube.com/embed/OENpiy9pptM', 23, 0, 'dac-san-ruou-dong-thap-hong-sen-tuu');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_album`
--
ALTER TABLE `tbl_album`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_attribute`
--
ALTER TABLE `tbl_attribute`
 ADD PRIMARY KEY (`id`), ADD KEY `id_gattribute` (`id_gattribute`);

--
-- Indexes for table `tbl_attribute_product`
--
ALTER TABLE `tbl_attribute_product`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_branch`
--
ALTER TABLE `tbl_branch`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_category1`
--
ALTER TABLE `tbl_category1`
 ADD PRIMARY KEY (`id`), ADD KEY `id_category` (`id_category`);

--
-- Indexes for table `tbl_config`
--
ALTER TABLE `tbl_config`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_feed`
--
ALTER TABLE `tbl_feed`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_gattribute`
--
ALTER TABLE `tbl_gattribute`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_guest`
--
ALTER TABLE `tbl_guest`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_image`
--
ALTER TABLE `tbl_image`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_linked`
--
ALTER TABLE `tbl_linked`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_manufacturer`
--
ALTER TABLE `tbl_manufacturer`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_post`
--
ALTER TABLE `tbl_post`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_post_tag`
--
ALTER TABLE `tbl_post_tag`
 ADD PRIMARY KEY (`id`), ADD KEY `id_post` (`id_post`), ADD KEY `id_tag` (`id_tag`);

--
-- Indexes for table `tbl_presentation`
--
ALTER TABLE `tbl_presentation`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
 ADD PRIMARY KEY (`id`), ADD KEY `tbl_resource_1` (`idsupplier`), ADD KEY `idmanufacturer` (`idmanufacturer`), ADD KEY `idcategory` (`idcategory`);

--
-- Indexes for table `tbl_product_attribute`
--
ALTER TABLE `tbl_product_attribute`
 ADD PRIMARY KEY (`id`), ADD KEY `id_product` (`id_product`), ADD KEY `id_attribute` (`id_attribute`);

--
-- Indexes for table `tbl_product_image`
--
ALTER TABLE `tbl_product_image`
 ADD PRIMARY KEY (`id`), ADD KEY `idresource` (`idproduct`);

--
-- Indexes for table `tbl_product_info`
--
ALTER TABLE `tbl_product_info`
 ADD PRIMARY KEY (`id`), ADD KEY `idproduct` (`idproduct`), ADD KEY `idproduct_2` (`idproduct`);

--
-- Indexes for table `tbl_slide`
--
ALTER TABLE `tbl_slide`
 ADD PRIMARY KEY (`id`), ADD KEY `idpresentation` (`idpresentation`);

--
-- Indexes for table `tbl_storyline`
--
ALTER TABLE `tbl_storyline`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_tag`
--
ALTER TABLE `tbl_tag`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_video`
--
ALTER TABLE `tbl_video`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_album`
--
ALTER TABLE `tbl_album`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_attribute`
--
ALTER TABLE `tbl_attribute`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_attribute_product`
--
ALTER TABLE `tbl_attribute_product`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_branch`
--
ALTER TABLE `tbl_branch`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `tbl_category1`
--
ALTER TABLE `tbl_category1`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=72;
--
-- AUTO_INCREMENT for table `tbl_config`
--
ALTER TABLE `tbl_config`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `tbl_feed`
--
ALTER TABLE `tbl_feed`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `tbl_gattribute`
--
ALTER TABLE `tbl_gattribute`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_guest`
--
ALTER TABLE `tbl_guest`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=128;
--
-- AUTO_INCREMENT for table `tbl_image`
--
ALTER TABLE `tbl_image`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT for table `tbl_linked`
--
ALTER TABLE `tbl_linked`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tbl_manufacturer`
--
ALTER TABLE `tbl_manufacturer`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `tbl_post`
--
ALTER TABLE `tbl_post`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=78;
--
-- AUTO_INCREMENT for table `tbl_post_tag`
--
ALTER TABLE `tbl_post_tag`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=73;
--
-- AUTO_INCREMENT for table `tbl_presentation`
--
ALTER TABLE `tbl_presentation`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
MODIFY `id` int(9) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=166;
--
-- AUTO_INCREMENT for table `tbl_product_attribute`
--
ALTER TABLE `tbl_product_attribute`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_product_image`
--
ALTER TABLE `tbl_product_image`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=225;
--
-- AUTO_INCREMENT for table `tbl_product_info`
--
ALTER TABLE `tbl_product_info`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=137;
--
-- AUTO_INCREMENT for table `tbl_slide`
--
ALTER TABLE `tbl_slide`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `tbl_storyline`
--
ALTER TABLE `tbl_storyline`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
MODIFY `id` int(9) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `tbl_tag`
--
ALTER TABLE `tbl_tag`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_video`
--
ALTER TABLE `tbl_video`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_attribute`
--
ALTER TABLE `tbl_attribute`
ADD CONSTRAINT `tbl_attribute_ibfk_1` FOREIGN KEY (`id_gattribute`) REFERENCES `tbl_gattribute` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_category1`
--
ALTER TABLE `tbl_category1`
ADD CONSTRAINT `tbl_category1_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `tbl_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_post_tag`
--
ALTER TABLE `tbl_post_tag`
ADD CONSTRAINT `tbl_post_tag_ibfk_1` FOREIGN KEY (`id_post`) REFERENCES `tbl_post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `tbl_post_tag_ibfk_2` FOREIGN KEY (`id_tag`) REFERENCES `tbl_tag` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_product`
--
ALTER TABLE `tbl_product`
ADD CONSTRAINT `tbl_category_01` FOREIGN KEY (`idcategory`) REFERENCES `tbl_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `tbl_resource_1` FOREIGN KEY (`idsupplier`) REFERENCES `tbl_supplier` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_product_attribute`
--
ALTER TABLE `tbl_product_attribute`
ADD CONSTRAINT `tbl_product_attribute_ibfk_1` FOREIGN KEY (`id_product`) REFERENCES `tbl_product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `tbl_product_attribute_ibfk_2` FOREIGN KEY (`id_attribute`) REFERENCES `tbl_attribute` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_product_image`
--
ALTER TABLE `tbl_product_image`
ADD CONSTRAINT `tbl_product_image_ibfk_1` FOREIGN KEY (`idproduct`) REFERENCES `tbl_product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_product_info`
--
ALTER TABLE `tbl_product_info`
ADD CONSTRAINT `tbl_product_info_ibfk_1` FOREIGN KEY (`idproduct`) REFERENCES `tbl_product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_slide`
--
ALTER TABLE `tbl_slide`
ADD CONSTRAINT `tbl_slide_ibfk_1` FOREIGN KEY (`idpresentation`) REFERENCES `tbl_presentation` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
