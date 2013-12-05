-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 05, 2013 at 10:04 AM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `spngroup_saigonlh`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category_news`
--

CREATE TABLE IF NOT EXISTS `tbl_category_news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `order` int(11) NOT NULL,
  `key` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tbl_category_news`
--

INSERT INTO `tbl_category_news` (`id`, `name`, `order`, `key`) VALUES
(1, 'Danh mục tin 1', 2, 'danh-muc-tin-1'),
(2, 'Danh mục tin 2', 0, 'danh-muc-tin-2'),
(3, 'Danh mục tin 3', 0, 'danh-muc-tin-3'),
(4, 'Danh mục tin 4', 0, 'danh-muc-tin-4'),
(5, 'Danh mục tin 5', 6, 'danh-muc-tin-5');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_news`
--

CREATE TABLE IF NOT EXISTS `tbl_news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_category` int(11) DEFAULT NULL,
  `author` varchar(50) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `content` longtext NOT NULL,
  `title` text NOT NULL,
  `type` int(11) NOT NULL DEFAULT '0',
  `key` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `foreign_field` (`id_category`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `tbl_news`
--

INSERT INTO `tbl_news` (`id`, `id_category`, `author`, `date`, `content`, `title`, `type`, `key`) VALUES
(5, 2, 'Toàn', '2013-11-24 17:00:00', '<p>\r\n	default</p>\r\n', 'Tin tức 1', 1, 'tin-tuc-1-5'),
(7, 2, 'Tác giả', '2013-11-25 08:01:19', '', 'Tin tức 3', 0, 'tin-tuc-3-'),
(8, 2, 'Toàn', '2013-12-04 17:00:00', '<p>\r\n	default</p>\r\n', 'Tin tức 2', 1, 'tin-tuc-2-8'),
(9, 2, 'Người Đưa Tin', '2013-12-04 17:00:00', '<p>\r\n	Tr&iacute;ch dẫn tin tức</p>\r\n', 'Tin tức 4', 0, 'tin-tuc-4-9'),
(10, 2, 'Người Đưa Tin', '2013-12-05 08:38:23', '<p>\r\n	Nội dung tin</p>\r\n', 'Tin tức 6', 1, 'tin-tuc-6-'),
(11, 2, 'Người Đưa Tin', '2013-12-05 08:38:32', '<p>\r\n	Nội dung tin</p>\r\n', 'Tin tức 7', 0, 'tin-tuc-7-'),
(12, 2, 'Người Đưa Tin', '2013-12-05 08:38:41', '<p>\r\n	Nội dung tin</p>\r\n', 'Tin tức 8', 0, 'tin-tuc-8-'),
(13, 2, 'Người Đưa Tin', '2013-12-05 08:38:51', '<p>\r\n	Nội dung tin</p>\r\n', 'Tin tức 9', 0, 'tin-tuc-9-'),
(14, 2, 'Người Đưa Tin', '2013-12-05 08:39:02', '<p>\r\n	Nội dung tin</p>\r\n', 'Tin tức 10', 0, 'tin-tuc-10-'),
(15, 2, 'Người Đưa Tin', '2013-12-05 08:39:09', '<p>\r\n	Nội dung tin</p>\r\n', 'Tin tức 11', 0, 'tin-tuc-11-'),
(16, 2, 'Người Đưa Tin', '2013-12-05 08:39:18', '<p>\r\n	Nội dung tin</p>\r\n', 'Tin tức 12', 0, 'tin-tuc-12-'),
(17, 2, 'Người Đưa Tin', '2013-12-05 08:39:27', '<p>\r\n	Nội dung tin</p>\r\n', 'Tin tức 13', 0, 'tin-tuc-13-'),
(18, 2, 'Người Đưa Tin', '2013-12-05 08:39:35', '<p>\r\n	Nội dung tin</p>\r\n', 'Tin tức 14', 0, 'tin-tuc-14-'),
(19, 2, 'Người Đưa Tin', '2013-12-05 08:39:44', '<p>\r\n	Nội dung tin</p>\r\n', 'Tin tức 15', 0, 'tin-tuc-15-');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_project`
--

CREATE TABLE IF NOT EXISTS `tbl_project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `key` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `tbl_project`
--

INSERT INTO `tbl_project` (`id`, `name`, `description`, `type`, `key`) VALUES
(1, 'Khu căn hộ An Phú', 'Khu căn hộ An Phú', 0, 0),
(2, 'Dragon Hill Residence and Suites', 'Dragon Hill Residence and Suites', 1, 0),
(5, 'Khu căn hộ An Phú 2', 'Khu căn hộ An Phú 2', 0, 0),
(6, 'Khu căn hộ Đại Đồng Tiến', 'Khu căn hộ Đại Đồng Tiến', 0, 0),
(7, 'Khu phức hợp 277 Nguyễn Văn Linh', 'Khu phức hợp 277 Nguyễn Văn Linh', 0, 0),
(8, 'Tòa nhà Diamon Plaza', 'Tòa nhà Diamon Plaza', 0, 0),
(9, 'Đại siêu thị Đông Á', 'Đại siêu thị Đông Á', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_project_album`
--

CREATE TABLE IF NOT EXISTS `tbl_project_album` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_project` int(11) NOT NULL,
  `name` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `description` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `key` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tbl_project_album`
--

INSERT INTO `tbl_project_album` (`id`, `id_project`, `name`, `date`, `description`, `key`) VALUES
(1, 2, 'Album 4', '2013-11-22 08:06:16', 'Năm 2013', 0),
(3, 2, 'Album 3', '2013-11-22 08:06:16', 'Album 3', 0),
(4, 2, 'Album 2', '2013-11-22 08:06:16', 'Album 2', 0),
(5, 2, 'Album 1', '2013-11-22 08:06:16', 'Album 1', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_project_document`
--

CREATE TABLE IF NOT EXISTS `tbl_project_document` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_project` int(11) NOT NULL,
  `name` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `url` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `key` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_project_document`
--

INSERT INTO `tbl_project_document` (`id`, `id_project`, `name`, `date`, `url`, `description`, `key`) VALUES
(1, 2, 'Tài liệu 1', '2013-11-22 07:58:12', 'http://mediafire.com', 'Tài liệu 1', 0),
(2, 2, 'Tài liệu 2', '2013-11-22 07:58:30', 'http://mediafire.com', 'Tài liệu 2', 0),
(3, 2, 'Tài liệu 3', '2013-11-22 07:58:44', 'http://mediafire.com', 'Tài liệu 3', 0),
(4, 2, 'Tài liệu 4', '2013-11-22 07:59:01', 'http://mediafire.com', 'Tài liệu 4', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_project_news`
--

CREATE TABLE IF NOT EXISTS `tbl_project_news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_project` int(11) NOT NULL,
  `name` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `description` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `key` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tbl_project_news`
--

INSERT INTO `tbl_project_news` (`id`, `id_project`, `name`, `date`, `description`, `key`) VALUES
(5, 2, 'Tin tức 2', '2013-11-22 08:06:34', 'Tin tức 2', 0),
(6, 2, 'Tin tức 1', '2013-11-22 08:06:34', 'Tin tức 1', 0),
(7, 2, 'Tin tức 3', '2013-11-22 08:06:34', 'Tin tức 3', 0),
(8, 2, 'Tin tức 4', '2013-11-22 08:06:34', 'Tin tức 4', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_project_product`
--

CREATE TABLE IF NOT EXISTS `tbl_project_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_project` int(11) NOT NULL,
  `name` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `description` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `key` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_project_product`
--

INSERT INTO `tbl_project_product` (`id`, `id_project`, `name`, `date`, `description`, `key`) VALUES
(1, 2, 'Nhà ăn', '2013-11-22 07:52:11', 'Nhà ăn', 0),
(2, 2, 'Bãi đỗ xe', '2013-11-22 07:52:17', 'Bãi đỗ xe', 0),
(3, 2, 'Khu vui chơi công cộng', '2013-11-22 07:51:32', 'Khu vui chơi công cộng', 0),
(4, 2, 'Công viên cây xanh', '2013-11-22 07:52:30', 'Công viên cây xanh', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_project_video`
--

CREATE TABLE IF NOT EXISTS `tbl_project_video` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_project` int(11) NOT NULL,
  `name` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `url` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `key` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_project_video`
--

INSERT INTO `tbl_project_video` (`id`, `id_project`, `name`, `date`, `url`, `description`, `key`) VALUES
(1, 2, 'Video 4', '2013-11-22 07:38:29', 'http://youtube.com', 'Video 4', 0),
(2, 2, 'Video 3', '2013-11-22 07:38:40', 'http://youtube.com', 'Video 3', 0),
(3, 2, 'Video 2', '2013-11-22 07:38:50', 'http://youtube.com', 'Video 2', 0),
(4, 2, 'Video 1', '2013-11-22 07:36:56', 'http://youtube.com', 'Video 1', 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `name`, `email`, `pass`, `gender`, `note`, `datecreate`, `dateupdate`, `dateactivity`, `type`, `code`) VALUES
(1, 'Quản lý', 'admin@gmail.com', 'admin123456', 0, ' Người quản lý hệ thống', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 4, ''),
(2, 'Tuan Bui Thanh', 'tuanbuithanh@gmail.com', 'admin123456', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
