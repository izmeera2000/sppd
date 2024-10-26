-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 26, 2024 at 07:06 PM
-- Server version: 8.3.0
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sppd_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `category_list`
--

DROP TABLE IF EXISTS `category_list`;
CREATE TABLE IF NOT EXISTS `category_list` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `delete_flag` tinyint(1) NOT NULL DEFAULT '0',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category_list`
--

INSERT INTO `category_list` (`id`, `name`, `description`, `status`, `delete_flag`, `date_created`, `date_updated`) VALUES
(1, 'Documents', 'This category is for the document types of printing.', 1, 0, '2022-01-26 09:22:05', NULL),
(2, 'Tarpaulin', 'This printing category is for the banners or tarpaulins.', 1, 0, '2022-01-26 09:22:52', NULL),
(3, 'Shirt', 'This category is for all shirt printing.', 1, 0, '2022-01-26 09:23:20', NULL),
(4, 'Sample 101', 'Sample 101', 0, 0, '2022-01-26 09:24:17', '2022-01-26 09:24:25'),
(5, 'To Delete', 'Sample deleted Category.', 0, 1, '2022-01-26 09:25:12', '2022-01-26 09:25:37');

-- --------------------------------------------------------

--
-- Table structure for table `payment_history`
--

DROP TABLE IF EXISTS `payment_history`;
CREATE TABLE IF NOT EXISTS `payment_history` (
  `id` int NOT NULL AUTO_INCREMENT,
  `transaction_id` int NOT NULL,
  `amount` float NOT NULL DEFAULT '0',
  `method` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `transaction_id` (`transaction_id`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_history`
--

INSERT INTO `payment_history` (`id`, `transaction_id`, `amount`, `method`, `date_created`, `date_updated`) VALUES
(4, 3, 25, NULL, '2022-01-26 14:16:31', NULL),
(5, 3, 25, NULL, '2022-01-26 14:16:41', NULL),
(7, 5, 1500, NULL, '2022-01-26 14:20:06', '2022-01-26 14:20:30'),
(8, 5, 2640, NULL, '2022-01-26 14:20:50', NULL),
(66, 73, 0, NULL, '2024-10-21 16:55:48', NULL),
(67, 74, 35, NULL, '2024-10-27 01:02:37', '2024-10-27 01:06:54');

-- --------------------------------------------------------

--
-- Table structure for table `price_list`
--

DROP TABLE IF EXISTS `price_list`;
CREATE TABLE IF NOT EXISTS `price_list` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_id` int NOT NULL,
  `size` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` float NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `delete_flag` tinyint(1) NOT NULL DEFAULT '0',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `price_list`
--

INSERT INTO `price_list` (`id`, `category_id`, `size`, `price`, `status`, `delete_flag`, `date_created`, `date_updated`) VALUES
(1, 1, 'Legal (8.5 X 14 in)', 5, 1, 0, '2022-01-26 09:50:30', '2022-01-26 10:22:10'),
(2, 1, 'Short (8.5 x 10.5 in)', 3, 1, 0, '2022-01-26 09:51:26', '2022-01-26 10:22:17'),
(3, 1, 'A4 (210 x 297 mm)', 5, 1, 0, '2022-01-26 09:51:46', NULL),
(4, 1, 'A3 (297 x 420 mm)', 6, 1, 0, '2022-01-26 09:52:05', NULL),
(5, 1, 'Α0 (84.1 x 118.9 cm)', 50, 1, 0, '2022-01-26 09:54:03', NULL),
(6, 2, '2 x 3 ft.', 200, 1, 0, '2022-01-26 09:55:53', NULL),
(7, 2, ' 4 x 2 ft', 250, 1, 0, '2022-01-26 09:56:16', '2022-01-26 09:56:58'),
(8, 2, '3 x 4 ft.', 300, 1, 0, '2022-01-26 09:56:33', '2022-01-26 09:57:11'),
(9, 2, '4 x 4 ft.', 350, 1, 0, '2022-01-26 09:56:43', '2022-01-26 09:57:22'),
(10, 3, 'A4 Front and Back', 250, 1, 0, '2022-01-26 10:18:13', NULL),
(12, 3, '8.5 x 14.5 Front 4 x 6 back ', 220, 1, 0, '2022-01-26 10:19:18', NULL),
(13, 3, 'A4 Front Only', 180, 1, 0, '2022-01-26 10:19:36', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `system_info`
--

DROP TABLE IF EXISTS `system_info`;
CREATE TABLE IF NOT EXISTS `system_info` (
  `id` int NOT NULL AUTO_INCREMENT,
  `meta_field` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `system_info`
--

INSERT INTO `system_info` (`id`, `meta_field`, `meta_value`) VALUES
(1, 'name', 'Sistem Pengurusan Percetakan Dokumen'),
(6, 'short_name', 'SPPD'),
(11, 'logo', 'uploads/logo-1729962317.png'),
(13, 'user_avatar', 'uploads/user_avatar.jpg'),
(14, 'cover', 'uploads/cover-1643159372.png');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_items`
--

DROP TABLE IF EXISTS `transaction_items`;
CREATE TABLE IF NOT EXISTS `transaction_items` (
  `transaction_id` int NOT NULL,
  `price_id` int NOT NULL,
  `price` float NOT NULL DEFAULT '0',
  `quantity` float NOT NULL DEFAULT '0',
  `filename` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total` float NOT NULL DEFAULT '0',
  `date_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  KEY `transaction_id` (`transaction_id`),
  KEY `price_id` (`price_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaction_items`
--

INSERT INTO `transaction_items` (`transaction_id`, `price_id`, `price`, `quantity`, `filename`, `total`, `date_updated`) VALUES
(3, 4, 6, 3, '0', 18, '2022-01-26 13:42:06'),
(3, 3, 5, 6, '0', 30, '2022-01-26 13:42:06'),
(3, 1, 5, 6, '0', 30, '2022-01-26 13:42:06'),
(5, 12, 220, 5, '0', 1100, '2022-01-26 14:20:06'),
(5, 10, 250, 10, '0', 2500, '2022-01-26 14:20:06'),
(5, 13, 180, 3, '0', 540, '2022-01-26 14:20:06'),
(69, 3, 5, 2, '69-0-JHEV_Terma.pdf', 10, '2024-10-21 16:50:05'),
(71, 3, 5, 2, '71-0-JHEV_Terma.pdf', 10, '2024-10-21 16:52:44'),
(72, 3, 5, 2, '72-0-JHEV_Terma.pdf', 10, '2024-10-21 16:53:39'),
(73, 3, 5, 2, '73-0-JHEV_Terma.pdf', 10, '2024-10-21 16:55:48'),
(74, 3, 5, 7, '74-BORANG KEBAJIKAN JHEV.BK.2019 kemaskini.pdf', 35, '2024-10-27 01:02:37');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_list`
--

DROP TABLE IF EXISTS `transaction_list`;
CREATE TABLE IF NOT EXISTS `transaction_list` (
  `id` int NOT NULL AUTO_INCREMENT,
  `code` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_contact` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_amount` float NOT NULL DEFAULT '0',
  `paid_amount` float NOT NULL DEFAULT '0',
  `balance` float NOT NULL DEFAULT '0',
  `payment_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=Unpaid, 1=partially paid, 2= paid',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=pending, 1= On-process, 2= done',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaction_list`
--

INSERT INTO `transaction_list` (`id`, `code`, `client_name`, `client_contact`, `client_address`, `total_amount`, `paid_amount`, `balance`, `payment_status`, `status`, `date_created`, `date_updated`) VALUES
(3, '202201-00001', 'John D Smith', '09123456789', 'Sample Address only', 78, 50, 28, 1, 0, '2022-01-26 13:06:16', '2022-01-26 14:16:41'),
(5, '202201-00002', 'Claire Blake', '09789456123', 'Over Here', 4140, 4140, 0, 2, 2, '2022-01-26 14:20:06', '2022-01-26 14:26:09'),
(69, '202410-00001', 'asdasGuest', 'N/Adasdasd', '', 10, 0, 0, 0, 0, '2024-10-21 16:50:05', NULL),
(71, '202410-00002', 'Guest', 'N/Aasd', '', 10, 0, 0, 0, 0, '2024-10-21 16:52:44', NULL),
(72, '202410-00003', 'Guest', 'Nasdasd/A', '', 10, 0, 0, 0, 0, '2024-10-21 16:53:39', NULL),
(73, '202410-00004', 'Guest', 'N/Aasdasd', '', 10, 0, 10, 0, 0, '2024-10-21 16:55:48', '2024-10-21 16:55:48'),
(74, '202410-00005', 'Guest', 'N/Adsad', '', 35, 35, 0, 2, 0, '2024-10-27 01:02:37', '2024-10-27 01:06:54');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `firstname` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middlename` text COLLATE utf8mb4_unicode_ci,
  `lastname` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` text COLLATE utf8mb4_unicode_ci,
  `last_login` datetime DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `status` int NOT NULL DEFAULT '1' COMMENT '0=not verified, 1 = verified',
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `middlename`, `lastname`, `username`, `password`, `avatar`, `last_login`, `type`, `status`, `date_added`, `date_updated`) VALUES
(1, 'Adminstrator', NULL, 'Admin', 'admin', 'a8f5f167f44f4964e6c998dee827110c', 'uploads/avatar-1.png?v=1639468007', NULL, 1, 1, '2021-01-20 14:02:37', '2024-10-27 01:00:33'),
(7, 'Samantha', NULL, 'Lou', 'sam23', 'a8f5f167f44f4964e6c998dee827110c', 'uploads/avatar-7.png?v=1643180426', NULL, 2, 1, '2022-01-26 15:00:26', '2024-10-21 00:39:06');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `payment_history`
--
ALTER TABLE `payment_history`
  ADD CONSTRAINT `payment_history_ibfk_1` FOREIGN KEY (`transaction_id`) REFERENCES `transaction_list` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `price_list`
--
ALTER TABLE `price_list`
  ADD CONSTRAINT `price_list_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category_list` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transaction_items`
--
ALTER TABLE `transaction_items`
  ADD CONSTRAINT `transaction_items_ibfk_1` FOREIGN KEY (`transaction_id`) REFERENCES `transaction_list` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaction_items_ibfk_2` FOREIGN KEY (`price_id`) REFERENCES `price_list` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
