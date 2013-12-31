-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 31, 2013 at 09:26 AM
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
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `type1` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `investors` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `stretch` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `payment` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `date_start` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `date_end` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `type` int(11) NOT NULL,
  `key` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

--
-- Dumping data for table `tbl_project`
--

INSERT INTO `tbl_project` (`id`, `name`, `description`, `address`, `type1`, `investors`, `stretch`, `payment`, `date_start`, `date_end`, `type`, `key`) VALUES
(1, 'Khu căn hộ An Phú', '<p style="text-align: justify;">\r\n	Tọa lạc ngay trung t&acirc;m Quận 3, dự &aacute;n khu căn hộ cao cấp Saigon Pavillon được đ&aacute;nh gi&aacute; l&agrave; dự &aacute;n cao cấp nhất trong khu vực với vị tr&iacute; tiếp gi&aacute;p ba con đường th&ocirc;ng tho&aacute;ng, kiến tr&uacute;c sang trọng v&agrave; đầy đủ những tiện &iacute;ch tuyệt vời d&agrave;nh cho những cư d&acirc;n tương lai tại đ&acirc;y.</p>\r\n<h5 style="text-align: justify;">\r\n	<strong>Thiết kế kiến tr&uacute;c</strong></h5>\r\n<p style="text-align: justify;">\r\n	Được thiết kế theo ti&ecirc;u chuẩn v&agrave; phong c&aacute;ch kiến tr&uacute;c kiểu Ph&aacute;p, khu căn hộ Saigon Pavillon c&oacute; diện t&iacute;ch mỗi s&agrave;n l&agrave; 1.571,8m&sup2;, hệ số sử dụng đất l&agrave; 6,7 v&agrave; chiều cao c&ocirc;ng tr&igrave;nh l&agrave; 12 tầng cao v&agrave; 3 tầng hầm d&agrave;nh cho b&atilde;i đậu xe v&agrave; tầng kỹ thuật. To&agrave;n bộ diện t&iacute;ch tầng trệt v&agrave; tầng lửng được sử dụng cho những tiện &iacute;ch c&ocirc;ng cộng như: si&ecirc;u thị, nh&agrave; h&agrave;ng, qu&aacute;n caf&eacute;,...</p>\r\n<p style="text-align: justify;">\r\n	Tr&ecirc;n tầng thượng sẽ bố tr&iacute; hồ bơi v&agrave; ph&ograve;ng tập thể dục nhằm phục vụ cho cộng đồng d&acirc;n cư sống trong c&aacute;c căn hộ của Saigon Pavillon. Từ tầng 2 trở l&ecirc;n l&agrave; c&aacute;c căn hộ được trang bị tiện nghi cao cấp với nhiều dạng thiết kế kh&aacute;c nhau ph&ugrave; hợp cho mọi nhu cầu về nh&agrave; ở. Căn hộ được bố tr&iacute; hiệu quả, c&aacute;c ph&ograve;ng đều c&oacute; lối ra v&agrave;o để chiếu s&aacute;ng v&agrave; th&ocirc;ng gi&oacute; tự nhi&ecirc;n, từ ban c&ocirc;ng. Ph&ograve;ng ngủ được bố tr&iacute; xa ph&ograve;ng kh&aacute;ch để c&aacute;ch ly ho&agrave;n to&agrave;n tiếng ồn.</p>\r\n<p style="text-align: justify;">\r\n	Đặc biệt, to&agrave;n bộ căn hộ đều được bố tr&iacute; đại sảnh sang trọng với ngăn để vật dụng hoặc gi&agrave;y d&eacute;p. Gian bếp th&igrave; được chủ đầu tư kỹ lưỡng thiết kế theo khuynh hướng mở ra ph&ograve;ng kh&aacute;ch nhưng vẫn tạo cảm gi&aacute;c k&iacute;n đ&aacute;o v&agrave; ấm c&uacute;ng. Ri&ecirc;ng ph&ograve;ng kh&aacute;ch v&agrave; ph&ograve;ng ăn sẽ nối với nhau tạo cảm gi&aacute;c kh&ocirc;ng gian rộng, tho&aacute;ng đ&atilde;ng hơn.</p>\r\n<p style="text-align: justify;">\r\n	&nbsp;</p>\r\n<h5 style="text-align: justify;">\r\n	<strong>Kh&ocirc;ng gian sống sang trọng v&agrave; an to&agrave;n</strong></h5>\r\n<p style="text-align: justify;">\r\n	Nh&igrave;n tổng thể, bố cục của tất cả căn hộ ở đ&acirc;y đều c&oacute; h&igrave;nh dạng vu&ocirc;ng vức ph&ugrave; hợp với sở th&iacute;ch v&agrave; quan niệm phong thủy về nơi cư tr&uacute; của đa số người d&acirc;n Việt Nam. B&ecirc;n cạnh đ&oacute;, khu căn hộ c&ograve;n được trang bị tiện &iacute;ch hiện đại phục vụ cho những nhu cầu thiết thực của cư d&acirc;n như: hệ thống thang m&aacute;y cao cấp d&agrave;nh cho kh&aacute;ch sạn 5 sao, hệ thống m&aacute;y ph&aacute;t điện dự ph&ograve;ng, hệ thống b&aacute;o ch&aacute;y v&agrave; chữa ch&aacute;y tự động, hệ thống gas trung t&acirc;m bảo đảm t&iacute;nh thẩm mỹ v&agrave; độ an to&agrave;n cao.</p>\r\n<p style="text-align: justify;">\r\n	Trong mỗi căn hộ đều được trang bị đầy đủ hệ thống đ&egrave;n thắp s&aacute;ng; trang thiết bị vệ sinh cao cấp; bếp của Teka, mặt bếp sử dụng đ&aacute; granite; hệ thống tủ bếp được xử l&yacute; chống thấm v&agrave; mối mọt; s&agrave;n nh&agrave; l&oacute;t gạch ceramic cao cấp, ở những khu vực thường xuy&ecirc;n tiếp x&uacute;c với nước như nh&agrave; tắm, nh&agrave; vệ sinh, ph&ograve;ng giặt v&agrave; ban c&ocirc;ng đều được sử dụng gạch ceramic chống trượt; tủ gỗ &acirc;m tường trong mỗi ph&ograve;ng ngủ; m&aacute;y nước n&oacute;ng; điện thoại, internet tốc độ cao, truyền h&igrave;nh c&aacute;p, intercom. Đặc biệt, mỗi căn hộ được bố tr&iacute; một chỗ đậu xe &ocirc;t&ocirc; tại tầng hầm miễn ph&iacute;. Hồ bơi v&agrave; ph&ograve;ng tập thể dục, ph&iacute; quản l&yacute; t&ograve;a nh&agrave; cũng được miễn ph&iacute; ho&agrave;n to&agrave;n cho cư d&acirc;n.</p>\r\n<p style="text-align: justify;">\r\n	C&oacute; thể n&oacute;i Saigon Pavillon ngo&agrave;i việc đ&aacute;p ứng c&aacute;c chỉ ti&ecirc;u về kết cấu kiến tr&uacute;c, khả năng kh&aacute;ng chấn v&agrave; kỹ thuật x&acirc;y dựng th&igrave; đ&acirc;y c&ograve;n l&agrave; nơi an cư l&yacute; tưởng cho mọi gia đ&igrave;nh.</p>\r\n<p style="text-align: justify;">\r\n	Dự &aacute;n n&agrave;y được đầu tư khoảng 800 tỷ đồng. Dự kiến ho&agrave;n tất sau thời gian 18 th&aacute;ng thi c&ocirc;ng.</p>\r\n', 'KDC An Cư 5, Phường Mân Thái, Quận Sơn Trà, Đà Nẵng', 'Căn hộ', 'Công ty Cổ phần Bảo Phước', '1.000m2', '200 tỷ VNĐ', '2012-06-30 17:00:00', '2014-06-30 17:00:00', 1, 'khu-can-ho-an-phu'),
(2, 'Dragon Hill Residence and Suites', '<p>\r\n	Dragon Hill Residence and Suites</p>\r\n', '123/ABC TP.Hồ Chí Minh', 'Cao ốc', 'Công ty Cổ phần Bảo Phước', '20.000 mét vuông', '500 tỷ VNĐ', '2013-12-30 17:00:00', '2013-12-30 17:00:00', 0, 'dragon-hill-residence-and-suites'),
(5, 'Khu căn hộ An Phú 2', '<p>\r\n	Khu căn hộ An Ph&uacute; 2</p>\r\n', 'KDC An Cư 5, Phường Mân Thái, Quận Sơn Trà, Đà Nẵng', 'Căn hộ', 'Công ty Cổ phần Bảo Phước', '1.000m2', '200 tỷ VNĐ', '2013-12-30 17:00:00', '2013-12-30 17:00:00', 0, 'khu-can-ho-an-phu-2'),
(6, 'Khu căn hộ Đại Đồng Tiến', '<p>\r\n	Khu căn hộ Đại Đồng Tiến</p>\r\n', '', '', '', '', '', '2013-12-30 17:00:00', '2013-12-30 17:00:00', 0, 'khu-can-ho-dai-dong-tien'),
(7, 'Khu phức hợp 277 Nguyễn Văn Linh', '<p>\r\n	Khu phức hợp 277 Nguyễn Văn Linh</p>\r\n', '', '', '', '', '', '2013-12-30 17:00:00', '2013-12-30 17:00:00', 0, 'khu-phuc-hop-277-nguyen-van-linh'),
(8, 'Tòa nhà Diamon Plaza', '<p>\r\n	T&ograve;a nh&agrave; Diamon Plaza</p>\r\n', '', '', '', '', '', '2013-12-30 17:00:00', '2013-12-30 17:00:00', 0, 'toa-nha-diamon-plaza'),
(9, 'Đại siêu thị Đông Á', '<p>\r\n	Đại si&ecirc;u thị Đ&ocirc;ng &Aacute;</p>\r\n', '', '', '', '', '', '2013-12-30 17:00:00', '2013-12-30 17:00:00', 0, 'dai-sieu-thi-dong-a');

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
