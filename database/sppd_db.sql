-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 22, 2024 at 03:55 PM
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
  `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `method` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `filename` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `transaction_id` (`transaction_id`)
) ENGINE=InnoDB AUTO_INCREMENT=90 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_history`
--

INSERT INTO `payment_history` (`id`, `transaction_id`, `amount`, `method`, `filename`, `date_created`, `date_updated`) VALUES
(4, 3, 25, '0', NULL, '2022-01-26 14:16:31', '2024-10-30 12:17:09'),
(5, 3, 25, '0', NULL, '2022-01-26 14:16:41', '2024-10-30 12:17:11'),
(7, 5, 1500, '0', NULL, '2022-01-26 14:20:06', '2024-10-30 12:17:13'),
(8, 5, 2640, '0', NULL, '2022-01-26 14:20:50', '2024-10-30 12:17:14'),
(74, 81, 0, 'QR', NULL, '2024-10-30 12:45:36', NULL),
(75, 81, 0, 'QR', NULL, '2024-10-30 12:53:07', NULL),
(76, 82, 0, 'QR', NULL, '2024-11-09 17:59:49', NULL),
(77, 83, 0, 'QR', NULL, '2024-11-14 22:09:44', NULL),
(78, 83, 3, 'QR', NULL, '2024-11-14 22:09:59', NULL),
(79, 83, 4, 'QR', NULL, '2024-11-14 22:10:03', NULL),
(89, 101, 5, 'QR', '20241122-233234-test2.pdf', '2024-11-22 23:32:34', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `price_list`
--

DROP TABLE IF EXISTS `price_list`;
CREATE TABLE IF NOT EXISTS `price_list` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_id` int NOT NULL,
  `size` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
(4, 1, 'A3 (297 x 420 mm)', 6, 1, 0, '2022-01-26 09:52:05', '2024-11-09 17:53:03'),
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
  `meta_field` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `id` int NOT NULL AUTO_INCREMENT,
  `transaction_id` int NOT NULL,
  `price_id` int NOT NULL,
  `price` float NOT NULL DEFAULT '0',
  `quantity` float NOT NULL DEFAULT '0',
  `filename` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total` float NOT NULL DEFAULT '0',
  `date_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `transaction_id` (`transaction_id`),
  KEY `price_id` (`price_id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaction_items`
--

INSERT INTO `transaction_items` (`id`, `transaction_id`, `price_id`, `price`, `quantity`, `filename`, `total`, `date_updated`) VALUES
(16, 81, 3, 5, 2, '81-0-JHEV_Terma.pdf', 10, '2024-10-30 12:45:36'),
(17, 82, 4, 6, 3, '82-a05a966b-b274-469b-873f-4f47fb856b18.pdf', 18, '2024-11-09 17:59:49'),
(18, 83, 4, 6, 15, '83-BUSINESS_CHANGES_13012023.pdf', 90, '2024-11-14 22:09:44'),
(36, 101, 3, 5, 1, '101-slot.txt', 5, '2024-11-22 23:32:34');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_list`
--

DROP TABLE IF EXISTS `transaction_list`;
CREATE TABLE IF NOT EXISTS `transaction_list` (
  `id` int NOT NULL AUTO_INCREMENT,
  `code` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int DEFAULT NULL,
  `client_name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_contact` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_amount` float NOT NULL DEFAULT '0',
  `paid_amount` float NOT NULL DEFAULT '0',
  `balance` float NOT NULL DEFAULT '0',
  `payment_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=Unpaid, 1=partially paid, 2= paid',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=pending, 1= On-process, 2= done',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaction_list`
--

INSERT INTO `transaction_list` (`id`, `code`, `user_id`, `client_name`, `client_contact`, `client_address`, `total_amount`, `paid_amount`, `balance`, `payment_status`, `status`, `date_created`, `date_updated`) VALUES
(3, '202201-00001', NULL, 'John D Smith', '09123456789', 'Sample Address only', 78, 50, 28, 1, 0, '2022-01-26 13:06:16', '2022-01-26 14:16:41'),
(5, '202201-00002', NULL, 'Claire Blake', '09789456123', 'Over Here', 4140, 4140, 0, 2, 2, '2022-01-26 14:20:06', '2022-01-26 14:26:09'),
(81, '202410-00001', 7, 'Guest', 'N/Asdasa', '', 10, 0, 10, 0, 0, '2024-10-30 12:45:36', '2024-10-30 12:45:36'),
(82, '202411-00001', 1, 'Adminstratorasdasd', 'asdasda', '', 18, 0, 18, 0, 0, '2024-11-09 17:59:49', '2024-11-09 17:59:49'),
(83, '202411-00002', 1, 'Adminstrator', '2313', '', 90, 7, 83, 1, 0, '2024-11-14 22:09:44', '2024-11-14 22:10:03'),
(101, '202411-00003', 1, 'Adminstrator', '121211', '', 5, 5, 0, 2, 0, '2024-11-22 23:32:34', '2024-11-22 23:32:34');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `firstname` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `middlename` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `lastname` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_login` datetime DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `status` int NOT NULL DEFAULT '1' COMMENT '0=not verified, 1 = verified',
  `reset_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `middlename`, `lastname`, `email`, `phone`, `username`, `password`, `avatar`, `last_login`, `type`, `status`, `reset_token`, `date_added`, `date_updated`) VALUES
(1, 'Adminstrator', NULL, 'Admin', '', NULL, 'admin', 'a8f5f167f44f4964e6c998dee827110c', 'uploads/avatar-1.png?v=1639468007', NULL, 1, 1, NULL, '2021-01-20 14:02:37', '2024-10-27 01:00:33'),
(7, 'Samantha', NULL, 'Lou', 'asdasdasdsa@asdsa', NULL, 'sam23', 'a8f5f167f44f4964e6c998dee827110c', 'uploads/avatar-7.png?v=1643180426', NULL, 2, 1, NULL, '2022-01-26 15:00:26', '2024-11-15 13:33:34'),
(8, 'asdas', NULL, 'dasdasd', '', '1212', 'asdasd', 'e93ccf5ffc90eefcc0bdb81f87d25d1a', NULL, NULL, 1, 1, NULL, '2024-10-30 13:03:56', NULL),
(10, 'asd', NULL, 'asd', '', '123123', 'asd123', 'a8f5f167f44f4964e6c998dee827110c', NULL, NULL, 0, 1, NULL, '2024-11-09 17:54:18', NULL),
(11, 'asdd', NULL, 'asdd', '', '01123881290', 'asdasd33', '9000134040fdb4d43e75e78edc1bfa42', NULL, NULL, 2, 1, NULL, '2024-11-09 18:02:10', NULL),
(12, 'sdasd', NULL, 'asdasdsad', 'test@gmail.com', '4123123', 'fdsa', '7c6a5b52c331e595797e875a7f6cda4f', NULL, NULL, 2, 1, NULL, '2024-11-09 18:32:48', '2024-11-15 14:07:03');

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
