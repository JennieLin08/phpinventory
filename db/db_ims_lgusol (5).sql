-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2024 at 03:02 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ims_lgusol`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_audittrail`
--

CREATE TABLE `tbl_audittrail` (
  `id` int(11) NOT NULL,
  `trans_id` varchar(155) NOT NULL,
  `trans_type` varchar(100) NOT NULL,
  `descs` varchar(155) NOT NULL,
  `action` varchar(155) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(155) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `trans_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_audittrail`
--

INSERT INTO `tbl_audittrail` (`id`, `trans_id`, `trans_type`, `descs`, `action`, `user_id`, `user_name`, `date_created`, `trans_date`) VALUES
(3, '', 'Employee', 'Rio Joy', 'Add', 1, 'Admin', '2023-12-20 15:02:21', NULL),
(4, '12', 'Employee', 'Rio Joy', 'delete', 0, 'root', '2023-12-20 15:17:32', NULL),
(5, '11', 'Employee', 'Jona Tane', 'update', 0, 'root', '2023-12-20 15:19:07', NULL),
(6, '', 'Supplier', 'supplier 1', 'Add', 1, 'Admin', '2023-12-20 15:25:20', NULL),
(7, '15', 'Supplier', 'supplier 1 2', 'update', 1, 'Admin', '2023-12-20 15:25:50', NULL),
(8, '15', 'Supplier', 'supplier 1 2', 'delete', 1, 'Admin', '2023-12-20 15:26:39', NULL),
(9, '', 'Item and add transaction', 'LAPTOP', 'Add', 1, 'Admin', '2023-12-21 00:56:21', NULL),
(10, '35', 'Item', 'LAPTOP HP', 'update', 0, 'root', '2023-12-21 01:02:56', NULL),
(11, '35', 'Item', 'LAPTOP HP SILVER', 'update', 1, 'Admin', '2023-12-21 01:27:38', NULL),
(12, '', 'Item', 'Computer printerSSSS', 'Add', 1, 'Admin', '2023-12-21 01:29:00', NULL),
(13, '36', 'Item', 'Computer printerSSSS', 'delete', 0, 'root', '2023-12-21 01:29:18', NULL),
(14, '', 'Item', 'test item', 'Add', 1, 'Admin', '2023-12-21 01:34:53', NULL),
(15, '37', 'Item', 'test item', 'update', 1, 'Admin', '2023-12-21 01:37:18', NULL),
(16, '37', 'Item', 'test item', 'update', 1, 'Admin', '2023-12-21 01:37:39', NULL),
(17, '37', 'Item', 'test item', 'update', 1, 'Admin', '2023-12-21 01:38:46', NULL),
(18, '37', 'Item', 'test item', 'delete', 1, 'Admin', '2023-12-21 12:20:24', NULL),
(19, '16', 'Supplier', 'supplier\'s 1 \' 2', 'update', 1, 'Admin', '2023-12-21 12:41:27', NULL),
(20, '16', 'Supplier', 'supplier\'s 1 \'2', 'update', 1, 'Admin', '2023-12-21 12:42:56', NULL),
(21, '16', 'Supplier', 'supplier\'s 1 \'2,', 'update', 1, 'Admin', '2023-12-21 12:43:06', NULL),
(22, '', 'Supplier', 'supplier , 3', 'Add', 1, 'Admin', '2023-12-21 12:43:35', NULL),
(23, '', 'add transaction', 'LAPTOP HP SILVER', 'Add', 1, 'Admin', '2023-12-21 12:46:14', NULL),
(24, '', 'Item', 'sala set', 'Add', 1, 'Admin', '2023-12-21 13:02:19', NULL),
(25, '61', 'add transaction', 'LAPTOP HP SILVER', 'update', 1, 'Admin', '2023-12-21 13:10:01', NULL),
(26, '', 'add transaction', 'LAPTOP HP SILVER', 'Add', 1, 'Admin', '2023-12-21 13:11:38', NULL),
(27, '', 'add transaction', 'LAPTOP HP SILVER', 'Add', 1, 'Admin', '2023-12-21 13:12:12', NULL),
(28, '63', 'add transaction', '', 'delete', 1, 'Admin', '2023-12-21 13:12:19', NULL),
(29, '63', 'add transaction', '', 'delete', 1, 'Admin', '2023-12-21 13:14:32', NULL),
(30, '62', 'add transaction', 'LAPTOP HP SILVER', 'delete', 1, 'Admin', '2023-12-21 13:15:29', NULL),
(31, '', 'Item and add transaction', 'Computer printer', 'Add', 1, 'Admin', '2023-12-21 13:17:07', NULL),
(32, '', 'release transaction', 'Computer printer', 'Release', 1, 'Admin', '2023-12-21 13:18:31', NULL),
(33, '', 'release transaction', 'Computer printer / Jona Tane', 'Release', 1, 'Admin', '2023-12-21 13:21:18', NULL),
(34, '67', 'release transaction', 'Computer printer / Jona Tane', 'update', 1, 'Admin', '2023-12-21 13:23:44', NULL),
(35, '67', 'release transaction', 'Computer printer / Jona Tane', 'delete', 1, 'Admin', '2023-12-21 13:27:52', NULL),
(36, '66', 'release transaction', 'Computer printer / Jona Tane', 'delete', 1, 'Admin', '2023-12-21 13:39:27', NULL),
(37, '', 'release transaction', 'LAPTOP HP SILVER / Jona Tane', 'Release', 1, 'Admin', '2023-12-21 14:02:44', NULL),
(38, '66', 'release transaction', 'Computer printer / Jona Tane', 'delete', 1, 'Admin', '2023-12-21 14:02:47', NULL),
(39, '', 'MR Transfer', 'LAPTOP HP SILVER / Jona Tane', 'Transfer', 1, 'Admin', '2023-12-21 14:17:12', NULL),
(40, '', 'release transaction', 'LAPTOP HP SILVER / Jona Tane', 'Release', 1, 'Admin', '2023-12-29 05:45:02', NULL),
(41, '', 'Employee', 'jennie Lin', 'Add', 1, 'Admin', '2023-12-30 14:32:08', NULL),
(42, '', 'Item', 'TISSUE', 'Add', 1, 'Admin', '2023-12-30 15:12:41', NULL),
(43, '38', 'Item', 'sala set', 'update', 1, 'Admin', '2023-12-30 15:17:56', NULL),
(44, '', 'Item', 'TISSUE', 'Add', 1, 'Admin', '2023-12-30 15:19:20', NULL),
(45, '', 'add transaction', 'TISSUE', 'Add', 1, 'Admin', '2023-12-30 15:20:01', NULL),
(46, '', 'Employee', 'Lea JOy', 'Add', 1, 'Admin', '2023-12-30 15:35:40', NULL),
(47, '', 'add transaction', 'LAPTOP HP SILVER', 'Add', 1, 'Admin', '2023-12-30 16:24:09', NULL),
(48, '', 'Item', 'light bulb', 'Add', 1, 'Admin', '2023-12-30 16:25:24', NULL),
(49, '', 'add transaction', 'LAPTOP HP SILVER', 'Add', 1, 'Admin', '2023-12-30 16:30:04', NULL),
(50, '', 'Item', 'light# bulb', 'Add', 1, 'Admin', '2023-12-30 16:35:04', NULL),
(51, '43', 'Item', 'light# bulb', 'update', 1, 'Admin', '2023-12-30 16:35:44', NULL),
(52, '43', 'Item', 'light# bulb', 'update', 1, 'Admin', '2023-12-30 16:38:25', NULL),
(53, '', 'add transaction', 'light# bulb', 'Add', 1, 'Admin', '2023-12-30 16:38:52', NULL),
(54, '42', 'Item', 'light bulb', 'update', 1, 'Admin', '2023-12-30 16:41:31', NULL),
(55, '42', 'Item', 'light bulb', 'delete', 1, 'Admin', '2023-12-30 16:41:44', NULL),
(56, '44', 'Item', 'test item\'', 'update', 1, 'Admin', '2024-01-02 07:14:32', NULL),
(57, '44', 'Item', 'test item \'', 'update', 1, 'Admin', '2024-01-02 07:21:22', NULL),
(58, '44', 'Item', 'test item \':,./\\]}[{;', 'update', 1, 'Admin', '2024-01-02 07:28:21', NULL),
(59, '44', 'Item', 'test item dfgzf', 'update', 1, 'Admin', '2024-01-02 07:30:59', NULL),
(60, '', 'Supplier', 'sup 1\'', 'Add', 1, 'Admin', '2024-01-02 10:18:13', NULL),
(61, '18', 'Supplier', 'sup 1\'\'', 'update', 1, 'Admin', '2024-01-02 10:18:21', NULL),
(62, '18', 'Supplier', 'sup 1\'\'`', 'update', 1, 'Admin', '2024-01-02 10:18:30', NULL),
(63, '18', 'Supplier', 'sup 1\'\'`\"', 'update', 1, 'Admin', '2024-01-02 10:18:56', NULL),
(64, '44', 'Item', 'test item dfgzf\'`', 'update', 1, 'Admin', '2024-01-02 10:19:14', NULL),
(65, '', 'release transaction', 'Computer printer / Lea JOy', 'Release', 1, 'Admin', '2024-01-02 23:52:28', NULL),
(66, '', 'add transaction', 'test item dfgzf\'`', 'Add', 1, 'Admin', '2024-01-03 02:07:12', NULL),
(67, '', 'release transaction', 'LAPTOP HP SILVER / jennie Lin', 'Release', 1, 'Admin', '2024-01-03 07:11:34', NULL),
(68, '', 'Item', 'test item 1', 'Add', 1, 'Admin', '2024-01-03 15:59:50', NULL),
(69, '', 'add transaction', 'test item 1', 'Add', 1, 'Admin', '2024-01-03 16:00:27', NULL),
(70, '', 'release transaction', 'test item 1 / jennie Lin', 'Release', 1, 'Admin', '2024-01-03 16:23:38', NULL),
(71, '', 'release transaction', 'TISSUE / Jona Tane', 'Release', 1, 'Admin', '2024-01-03 17:09:29', NULL),
(72, '', 'Item', 'test item 2', 'Add', 1, 'Admin', '2024-01-04 04:19:12', NULL),
(73, '', 'Item', 'alcohol', 'Add', 1, 'Admin', '2024-01-04 11:47:06', NULL),
(74, '47', 'Item', 'alcohol', 'update', 1, 'Admin', '2024-01-04 11:48:33', NULL),
(75, '', 'Item', 'tesy item 4', 'Add', 1, 'Admin', '2024-01-04 15:03:44', NULL),
(76, '47', 'Item', 'alcohol', 'update', 1, 'Admin', '2024-01-04 15:28:41', NULL),
(77, '', 'add transaction', 'alcohol', 'Add', 1, 'Admin', '2024-01-04 15:31:59', NULL),
(78, '', 'add transaction', 'alcohol', 'Add', 1, 'Admin', '2024-01-04 15:54:54', NULL),
(79, '', 'add transaction', 'alcohol', 'Add', 1, 'Admin', '2024-01-04 15:57:40', NULL),
(80, '', 'add transaction', 'alcohol', 'Add', 1, 'Admin', '2024-01-04 16:01:32', NULL),
(81, '', 'add transaction', 'alcohol', 'Add', 1, 'Admin', '2024-01-04 16:54:26', NULL),
(82, '', 'release transaction', 'alcohol / Jona Tane', 'Release', 1, 'Admin', '2024-01-05 02:33:14', NULL),
(83, '', 'release transaction', 'alcohol / Jona Tane', 'Release', 1, 'Admin', '2024-01-05 02:56:23', NULL),
(84, '41', 'Item', 'TISSUE', 'update', 1, 'Admin', '2024-01-05 03:12:52', NULL),
(85, '47', 'Item', 'alcohol', 'update', 1, 'Admin', '2024-01-05 03:13:04', NULL),
(86, '', 'add transaction', 'alcohol', 'Add', 1, 'Admin', '2024-01-05 03:13:43', NULL),
(87, '', 'add transaction', 'alcohol', 'Add', 1, 'Admin', '2024-01-05 03:14:02', NULL),
(88, '', 'add transaction', 'TISSUE', 'Add', 1, 'Admin', '2024-01-05 03:14:52', NULL),
(89, '89', 'add transaction', 'alcohol', 'update', 1, 'Admin', '2024-01-05 03:15:24', NULL),
(90, '88', 'add transaction', 'alcohol', 'update', 1, 'Admin', '2024-01-05 03:15:50', NULL),
(91, '89', 'add transaction', 'alcohol', 'update', 1, 'Admin', '2024-01-05 03:15:56', NULL),
(92, '89', 'add transaction', 'alcohol', 'update', 1, 'Admin', '2024-01-05 03:25:07', NULL),
(93, '88', 'add transaction', 'alcohol', 'update', 1, 'Admin', '2024-01-05 03:25:14', NULL),
(94, '', 'release transaction', 'alcohol / Lea JOy', 'Release', 1, 'Admin', '2024-01-05 03:27:57', NULL),
(95, '90', 'add transaction', 'TISSUE', 'update', 1, 'Admin', '2024-01-05 03:50:10', NULL),
(96, '41', 'Item', 'TISSUE', 'update', 1, 'Admin', '2024-01-05 03:51:18', NULL),
(97, '', 'add transaction', 'TISSUE', 'Add', 1, 'Admin', '2024-01-05 03:51:51', NULL),
(98, '41', 'Item', 'TISSUE', 'update', 1, 'Admin', '2024-01-05 03:56:35', NULL),
(99, '92', 'add transaction', 'TISSUE', 'update', 1, 'Admin', '2024-01-05 03:57:54', NULL),
(100, '90', 'add transaction', 'TISSUE', 'update', 1, 'Admin', '2024-01-05 03:58:15', NULL),
(101, '41', 'Item', 'TISSUE', 'update', 1, 'Admin', '2024-01-05 03:59:49', NULL),
(102, '', 'release transaction', 'TISSUE / Jona Tane', 'Release', 1, 'Admin', '2024-01-05 04:01:45', NULL),
(103, '93', 'release transaction', 'TISSUE / Jona Tane', 'update', 1, 'Admin', '2024-01-05 04:26:52', NULL),
(104, '', 'MR Transfer', 'TISSUE / jennie Lin', 'Transfer', 1, 'Admin', '2024-01-05 05:38:28', NULL),
(105, '', 'MR Transfer', 'alcohol / jennie Lin', 'Transfer', 1, 'Admin', '2024-01-05 05:46:38', NULL),
(106, '', 'release transaction', 'TISSUE / Jona Tane', 'Release', 1, 'Admin', '2024-01-05 05:50:34', NULL),
(107, '', 'release transaction', 'TISSUE / Jona Tane', 'Release', 1, 'Admin', '2024-01-05 05:51:05', NULL),
(108, '', 'MR Transfer', 'TISSUE / jennie Lin', 'Transfer', 1, 'Admin', '2024-01-05 05:51:50', NULL),
(109, '96', 'release transaction', 'TISSUE / Jona Tane', 'update', 1, 'Admin', '2024-01-05 05:56:59', NULL),
(110, '91', 'release transaction', 'alcohol / Lea JOy', 'update', 1, 'Admin', '2024-01-05 05:57:13', NULL),
(111, '', 'MR Transfer', 'TISSUE / jennie Lin', 'Transfer', 1, 'Admin', '2024-01-05 05:57:26', NULL),
(112, '', 'Item', 'Ballpen', 'Add', 1, 'Admin', '2024-01-05 07:25:33', NULL),
(113, '', 'add transaction', 'Ballpen', 'Add', 1, 'Admin', '2024-01-05 07:26:13', NULL),
(114, '', 'release transaction', 'Ballpen / Jona Tane', 'Release', 1, 'Admin', '2024-01-05 07:26:37', NULL),
(115, '', 'release transaction', 'TISSUE / jennie Lin', 'Release', 1, 'Admin', '2024-01-05 09:13:18', NULL),
(116, '', 'add transaction', 'Computer printer', 'Add', 1, 'Admin', '2024-01-05 09:38:01', NULL),
(117, '39', 'Item', 'Computer printer', 'update', 1, 'Admin', '2024-01-05 09:38:28', NULL),
(118, '103', 'add transaction', 'Computer printer', 'update', 1, 'Admin', '2024-01-05 09:38:34', NULL),
(119, '47', 'Item', 'alcohol', 'update', 1, 'Admin', '2024-01-11 09:04:30', NULL),
(120, '47', 'Item', 'alcohol', 'update', 1, 'Admin', '2024-01-11 09:28:47', NULL),
(121, '', 'add transaction', 'alcohol', 'Add', 1, 'Admin', '2024-01-11 10:45:00', NULL),
(122, '', 'add transaction', 'alcohol', 'Add', 1, 'Admin', '2024-01-11 11:38:26', NULL),
(123, '', 'add transaction', 'alcohol', 'Add', 1, 'Admin', '2024-01-11 11:43:44', NULL),
(124, '', 'add transaction', 'alcohol', 'Add', 1, 'Admin', '2024-01-11 11:45:22', NULL),
(125, '', 'add transaction', 'alcohol', 'Add', 1, 'Admin', '2024-01-11 11:47:36', NULL),
(126, '', 'add transaction', 'alcohol', 'Add', 1, 'Admin', '2024-01-11 11:50:49', NULL),
(127, '', 'add transaction', 'alcohol', 'Add', 1, 'Admin', '2024-01-11 11:55:52', NULL),
(128, '', 'add transaction', 'alcohol', 'Add', 1, 'Admin', '2024-01-11 12:08:55', NULL),
(129, '', 'add transaction', 'alcohol', 'Add', 1, 'Admin', '2024-01-11 12:11:14', NULL),
(130, '112', 'add transaction', 'alcohol', 'update', 1, 'Admin', '2024-01-11 12:15:35', NULL),
(131, '112', 'add transaction', 'alcohol', 'update', 1, 'Admin', '2024-01-11 12:19:44', NULL),
(132, '', 'add transaction', 'alcohol', 'Add', 1, 'Admin', '2024-01-12 01:34:38', NULL),
(133, '', 'add transaction', 'alcohol', 'Add', 1, 'Admin', '2024-01-12 01:37:28', NULL),
(134, '', 'add transaction', 'alcohol', 'Add', 1, 'Admin', '2024-01-12 01:39:49', NULL),
(135, '', 'add transaction', 'alcohol', 'Add', 1, 'Admin', '2024-01-12 01:43:10', NULL),
(136, '116', 'add transaction', 'alcohol', 'update', 1, 'Admin', '2024-01-12 01:46:16', NULL),
(137, '', 'release transaction', 'alcohol / jennie Lin', 'Release', 1, 'Admin', '2024-01-12 01:47:05', NULL),
(138, '', 'add transaction', 'Computer printer', 'Add', 1, 'Admin', '2024-01-12 01:51:27', NULL),
(139, '116', 'add transaction', 'alcohol', 'update', 1, 'Admin', '2024-01-12 01:54:01', NULL),
(140, '49', 'Item', 'Ballpen', 'update', 1, 'Admin', '2024-01-12 01:54:59', NULL),
(141, '', 'add transaction', 'Ballpen', 'Add', 1, 'Admin', '2024-01-12 01:55:37', NULL),
(142, '100', 'add transaction', 'Ballpen', 'delete', 1, 'Admin', '2024-01-12 01:56:37', NULL),
(143, '119', 'add transaction', 'Ballpen', 'update', 1, 'Admin', '2024-01-12 01:56:53', NULL),
(144, '101', 'release transaction', 'Ballpen / Jona Tane', 'update', 1, 'Admin', '2024-01-12 01:57:29', NULL),
(145, '', 'add transaction', 'Ballpen', 'Add', 1, 'Admin', '2024-01-12 01:58:05', NULL),
(146, '', 'release transaction', 'Ballpen / Jona Tane', 'Release', 1, 'Admin', '2024-01-12 01:58:31', NULL),
(147, '47', 'Item', 'alcohol\"', 'update', 1, 'Admin', '2024-01-12 03:19:18', NULL),
(148, '47', 'Item', 'alcohol\"', 'update', 1, 'Admin', '2024-01-12 03:27:20', NULL),
(149, '47', 'Item', 'alcohol\"', 'update', 1, 'Admin', '2024-01-12 03:27:40', NULL),
(150, '', 'Add item and transaction', 'test item 5\"', 'Add', 1, 'Admin', '2024-01-12 07:47:45', NULL),
(151, '50', 'Item', 'test item 5\"', 'update', 1, 'Admin', '2024-01-12 07:51:35', NULL),
(152, '', 'Add item and transaction', 'test item 6\"', 'Add', 1, 'Admin', '2024-01-12 07:54:00', NULL),
(153, '', 'Item', 'test item 7', 'Add', 1, 'Admin', '2024-01-12 07:59:49', NULL),
(154, '', 'Item', 'aaa', 'Add', 1, 'Admin', '2024-01-12 09:16:33', NULL),
(155, '', 'Item', 'bbb', 'Add', 1, 'Admin', '2024-01-12 09:16:44', NULL),
(156, '', 'CATEGORY', 'caty name 1', 'CREATED', 1, 'Admin', '2024-01-14 05:23:50', NULL),
(157, '43', 'Item', 'light# bulb', 'delete', 1, 'Admin', '2024-01-14 11:55:10', NULL),
(158, '', 'Add item and transaction', 'laptop', 'Add', 1, 'Admin', '2024-01-14 11:56:16', NULL),
(159, '', 'add transaction', 'alcohol\"', 'Add', 1, 'Admin', '2024-01-14 13:40:16', NULL),
(160, '', 'add transaction', 'Computer printer', 'Add', 1, 'Admin', '2024-01-14 13:40:54', NULL),
(161, '', 'Item', 'spec tish', 'Add', 1, 'Admin', '2024-01-14 13:56:00', NULL),
(162, '', 'add transaction', 'spec tish', 'Add', 1, 'Admin', '2024-01-14 13:56:20', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `cat_id` int(11) NOT NULL,
  `order_list` int(11) NOT NULL,
  `cat_name` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `date_update` datetime DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`cat_id`, `order_list`, `cat_name`, `status`, `user_id`, `user_name`, `date_update`, `date_created`) VALUES
(60, 1, '223 - IT EQUIPMENT AND SOFTWARE', 'Active', 0, '', NULL, '2023-12-15 16:08:57'),
(61, 2, '222 - FURNITURE AND FIXTURE', 'Active', 0, '', NULL, '2023-12-15 16:08:57'),
(62, 3, '100 - SAMPLE CATEGORY it is', 'Active', 0, '', NULL, '2023-12-16 09:23:28'),
(64, 0, '200 - OFFICE SUPPLIES', 'Active', 0, '', NULL, '2023-12-16 23:37:35'),
(67, 1, 'test_cat', 'Active', 0, '', NULL, '2024-01-14 13:17:49'),
(68, 1, 'catname', 'Active', 0, '', NULL, '2024-01-14 13:20:00'),
(71, 1, 'caty name', 'Active', 0, '', NULL, '2024-01-14 13:23:01'),
(73, 2, 'caty name 2', 'Active', 0, '', NULL, '2024-01-14 13:23:50');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee`
--

CREATE TABLE `tbl_employee` (
  `emp_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `address` varchar(150) NOT NULL,
  `section` varchar(100) NOT NULL,
  `office` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `date_update` datetime DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_employee`
--

INSERT INTO `tbl_employee` (`emp_id`, `name`, `mobile`, `address`, `section`, `office`, `status`, `user_id`, `user_name`, `date_update`, `date_created`) VALUES
(11, 'Jona Tane', '555', ' Solano', 'IT', 'VMO', 'Active', 0, '', NULL, '2023-12-20 14:44:11'),
(12, 'Rio Joy', '999', ' Solano', 'IT', 'VMO', 'deleted', 0, '', NULL, '2023-12-20 15:02:21'),
(13, 'jennie Lin', '888', ' Solano', 'IT', 'VMO', 'Active', 0, '', NULL, '2023-12-30 14:32:08'),
(14, 'Lea JOy', '0', ' Solano', 'GSO', 'VMO', 'Active', 0, '', NULL, '2023-12-30 15:35:40');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_item`
--

CREATE TABLE `tbl_item` (
  `item_id` int(11) NOT NULL,
  `item_name` varchar(150) NOT NULL,
  `item_code` varchar(150) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(150) NOT NULL,
  `sup_id` int(11) NOT NULL,
  `sup_name` varchar(150) NOT NULL,
  `description` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `unit` varchar(50) NOT NULL,
  `unit_group` varchar(100) NOT NULL,
  `amount` decimal(8,4) NOT NULL,
  `total` decimal(9,4) NOT NULL,
  `trans_date` date NOT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `status` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `date_update` datetime DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_item`
--

INSERT INTO `tbl_item` (`item_id`, `item_name`, `item_code`, `cat_id`, `cat_name`, `sup_id`, `sup_name`, `description`, `qty`, `unit`, `unit_group`, `amount`, `total`, `trans_date`, `remarks`, `status`, `user_id`, `user_name`, `date_update`, `date_created`) VALUES
(39, 'Computer printer', 'SN#SMXK019554', 60, '223 - IT EQUIPMENT AND SOFTWARE', 16, 'supplier\'s 1 \'2,', '', 1, 'pc', 'pc', 9999.9999, 99999.9999, '2023-12-21', '', 'Active', 0, '', NULL, '2023-12-21 21:17:07'),
(41, 'TISSUE', 'TS#01', 64, '200 - OFFICE SUPPLIES', 0, '', 'tissue desc', 10, 'Roll/s', 'Roll/s', 0.0000, 0.0000, '0000-00-00', '', 'Active', 0, '', NULL, '2023-12-30 23:19:20'),
(43, 'light# bulb', 'lb', 62, '100 - SAMPLE CATEGORY it is', 0, '', '', 0, 'Gallon', 'Gallon', 0.0000, 0.0000, '0000-00-00', '', 'deleted', 0, '', NULL, '2023-12-31 00:35:04'),
(47, 'alcohol\"', 'alc', 64, '200 - OFFICE SUPPLIES', 0, '', 'alcohol', 20, 'Bottle/s', 'Box/es', 0.0000, 0.0000, '0000-00-00', '', 'Active', 0, '', NULL, '2024-01-04 19:47:06'),
(55, 'laptop', 'lappy', 60, '223 - IT EQUIPMENT AND SOFTWARE', 0, '', 'desc', 1, 'Pc/s', 'Pc/s', 0.0000, 0.0000, '0000-00-00', '', 'Active', 0, '', NULL, '2024-01-14 19:56:15'),
(56, 'spec tish', 'st', 60, '223 - IT EQUIPMENT AND SOFTWARE', 0, '', 'desc', 1, 'Bag/s', 'Bag/s', 0.0000, 0.0000, '0000-00-00', '', 'Active', 0, '', NULL, '2024-01-14 21:56:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_itemtrans`
--

CREATE TABLE `tbl_itemtrans` (
  `id` int(11) NOT NULL,
  `trans_type` varchar(100) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `emp_name` varchar(150) NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_name` varchar(150) NOT NULL,
  `item_code` varchar(150) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(150) NOT NULL,
  `sup_id` int(11) NOT NULL,
  `sup_name` varchar(150) NOT NULL,
  `description` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `qty_2` int(11) NOT NULL,
  `qty_ind` int(11) NOT NULL,
  `qty_rls_ind` int(100) NOT NULL,
  `release_qty` int(11) NOT NULL,
  `unit` varchar(50) NOT NULL,
  `unit_2` varchar(100) NOT NULL,
  `amount` decimal(13,4) NOT NULL,
  `amount_2` decimal(13,4) NOT NULL,
  `total` decimal(13,4) NOT NULL,
  `rls_total` decimal(13,4) NOT NULL,
  `trans_date` date NOT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `status` varchar(50) NOT NULL,
  `eul` varchar(100) NOT NULL,
  `warehouse` varchar(100) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ref_id` int(11) NOT NULL,
  `ref_trans` varchar(100) NOT NULL,
  `from_id` int(11) NOT NULL,
  `from_name` varchar(100) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_update` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_itemtrans`
--

INSERT INTO `tbl_itemtrans` (`id`, `trans_type`, `emp_id`, `emp_name`, `item_id`, `item_name`, `item_code`, `cat_id`, `cat_name`, `sup_id`, `sup_name`, `description`, `qty`, `qty_2`, `qty_ind`, `qty_rls_ind`, `release_qty`, `unit`, `unit_2`, `amount`, `amount_2`, `total`, `rls_total`, `trans_date`, `remarks`, `status`, `eul`, `warehouse`, `user_name`, `user_id`, `ref_id`, `ref_trans`, `from_id`, `from_name`, `date_created`, `date_update`) VALUES
(88, 'add', 0, '', 47, 'alcohol', 'alc', 64, '200 - OFFICE SUPPLIES', 0, '', 'alcohol', 3, 0, 60, 0, 0, 'Box/es', '', 5000.0000, 0.0000, 15000.0000, 0.0000, '2024-01-05', '', 'Active', '5', 'Main', 'Admin', 1, 0, '', 0, '', '2024-01-05 11:13:43', '2024-01-05 11:25:14'),
(89, 'add', 0, '', 47, 'alcohol', 'alc', 64, '200 - OFFICE SUPPLIES', 0, '', 'alcohol', 5, 0, 5, 0, 0, 'Bottle/s', '', 500.0000, 0.0000, 2500.0000, 0.0000, '2024-01-05', '', 'Active', '2', 'Main', 'Admin', 1, 0, '', 0, '', '2024-01-05 11:14:02', '2024-01-05 11:25:07'),
(90, 'add', 0, '', 41, 'TISSUE', 'TS#01', 64, '200 - OFFICE SUPPLIES', 0, '', '', 5, 0, 50, 0, 0, 'Set/s', '', 500.0000, 0.0000, 2500.0000, 0.0000, '2024-01-05', '', 'Active', '3', 'Main', 'Admin', 1, 0, '', 0, '', '2024-01-05 11:14:52', '2024-01-05 11:58:15'),
(91, 'Released', 14, 'Lea JOy', 47, 'alcohol', 'alc', 64, '200 - OFFICE SUPPLIES', 0, '', 'alcohol', 0, 0, 0, 5, 5, 'Bottle/s', '', 0.0000, 0.0000, 0.0000, 0.0000, '2024-01-05', '', 'Active', '', '', 'Admin', 1, 0, '', 0, '', '2024-01-05 11:27:57', '2024-01-05 01:57:13'),
(92, 'add', 0, '', 41, 'TISSUE', 'TS#01', 64, '200 - OFFICE SUPPLIES', 0, '', '', 5, 0, 5, 0, 0, 'Roll/s', '', 500.0000, 0.0000, 2500.0000, 0.0000, '2024-01-05', '', 'Active', '1', 'Main', 'Admin', 1, 0, '', 0, '', '2024-01-05 11:51:51', '2024-01-05 11:57:54'),
(96, 'Released', 11, 'Jona Tane', 41, 'TISSUE', 'TS#01', 64, '200 - OFFICE SUPPLIES', 0, '', 'tissue desc', 0, 0, 0, 2, 2, 'Roll/s', '', 0.0000, 0.0000, 0.0000, 0.0000, '2024-01-05', ' / (3) Transferred to jennie Lin', 'Active', '', '', 'Admin', 1, 0, '', 0, '', '2024-01-05 13:50:34', '2024-01-05 01:56:59'),
(97, 'Released', 11, 'Jona Tane', 41, 'TISSUE', 'TS#01', 64, '200 - OFFICE SUPPLIES', 0, '', 'tissue desc', 0, 0, 0, 5, 5, 'Roll/s', '', 0.0000, 0.0000, 0.0000, 0.0000, '2024-01-05', '', 'Active', '', '', 'Admin', 1, 0, '', 0, '', '2024-01-05 13:51:05', NULL),
(99, 'Transfer', 13, 'jennie Lin', 41, 'TISSUE', 'TS#01', 64, '200 - OFFICE SUPPLIES', 0, '', 'tissue desc', 0, 0, 0, 3, 3, 'Roll/s', '', 0.0000, 0.0000, 0.0000, 0.0000, '2024-01-05', '', 'Active', '', '', 'Admin', 1, 96, '', 11, 'Jona Tane', '2024-01-05 13:57:26', NULL),
(100, 'add', 0, '', 49, 'Ballpen', 'bp', 64, '200 - OFFICE SUPPLIES', 0, '', 'Ballpen', 2, 0, 40, 0, 0, 'Box/es', '', 150.0000, 0.0000, 300.0000, 0.0000, '2024-01-05', '', 'deleted', '5', 'Main', 'Admin', 1, 0, '', 0, '', '2024-01-05 15:26:13', '2024-01-12 09:56:37'),
(101, 'Released', 11, 'Jona Tane', 49, 'Ballpen', 'bp', 64, '200 - OFFICE SUPPLIES', 0, '', 'Ballpen', 0, 0, 0, 5, 5, 'Pc/s', '', 0.0000, 0.0000, 0.0000, 0.0000, '2024-01-05', '', 'Active', '', '', 'Admin', 1, 0, '', 0, '', '2024-01-05 15:26:37', '2024-01-12 09:57:29'),
(102, 'Released', 13, 'jennie Lin', 41, 'TISSUE', 'TS#01', 64, '200 - OFFICE SUPPLIES', 0, '', 'tissue desc', 0, 0, 0, 40, 40, 'Roll/s', '', 0.0000, 0.0000, 0.0000, 0.0000, '2024-01-05', '', 'Active', '', '', 'Admin', 1, 0, '', 0, '', '2024-01-05 17:13:18', NULL),
(103, 'add', 0, '', 39, 'Computer printer', 'SN#SMXK019554', 60, '223 - IT EQUIPMENT AND SOFTWARE', 0, '', '', 5, 0, 5, 0, 0, 'pc', '', 50000.0000, 0.0000, 250000.0000, 0.0000, '2024-01-05', '', 'Active', '5 yrs', 'Main', 'Admin', 1, 0, '', 0, '', '2024-01-05 17:38:01', '2024-01-05 05:38:34'),
(104, 'add', 0, '', 47, 'alcohol', 'alc', 64, '200 - OFFICE SUPPLIES', 0, '', 'alcohol', 3, 0, 23, 0, 0, 'Box/es', '', 4600.0000, 0.0000, 105800.0000, 0.0000, '2024-01-11', '', 'deleted', '3', 'Main', 'Admin', 1, 0, '', 0, '', '2024-01-11 18:45:00', '2024-01-12 06:08:40'),
(105, 'add', 0, '', 47, 'alcohol', 'alc', 64, '200 - OFFICE SUPPLIES', 0, '', 'alcohol', 2, 43, 3, 0, 0, 'Box/es', 'Bottle/s', 200.0000, 10.0000, 0.0000, 0.0000, '2024-01-11', '', 'deleted', '5', 'Main', 'Admin', 1, 0, '', 0, '', '2024-01-11 19:38:26', '2024-01-12 06:08:40'),
(106, 'add', 0, '', 47, 'alcohol', 'alc', 64, '200 - OFFICE SUPPLIES', 0, '', 'alcohol', 2, 3, 43, 0, 0, 'Box/es', 'Bottle/s', 200.3000, 20.0000, 0.0000, 0.0000, '2024-01-11', '', 'deleted', '1', 'Main', 'Admin', 1, 0, '', 0, '', '2024-01-11 19:43:44', '2024-01-12 06:08:40'),
(107, 'add', 0, '', 47, 'alcohol', 'alc', 64, '200 - OFFICE SUPPLIES', 0, '', 'alcohol', 3, 2, 62, 0, 0, 'Box/es', 'Bottle/s', 50.0000, 5.0000, 500.0000, 0.0000, '2024-01-11', '', 'deleted', '1', 'Main', 'Admin', 1, 0, '', 0, '', '2024-01-11 19:45:22', '2024-01-12 06:08:40'),
(108, 'add', 0, '', 47, 'alcohol', 'alc', 64, '200 - OFFICE SUPPLIES', 0, '', 'alcohol', 2, 2, 42, 0, 0, 'Box/es', 'Bottle/s', 50.0000, 20.0000, 0.0000, 0.0000, '2024-01-11', '', 'deleted', '1', 'Main', 'Admin', 1, 0, '', 0, '', '2024-01-11 19:47:36', '2024-01-12 06:08:40'),
(109, 'add', 0, '', 47, 'alcohol', 'alc', 64, '200 - OFFICE SUPPLIES', 0, '', 'alcohol', 3, 5, 8, 0, 0, 'Bottle/s', 'Bottle/s', 200.0000, 10.0000, 0.0000, 0.0000, '2024-01-11', '', 'Active', '2', 'Main', 'Admin', 1, 0, '', 0, '', '2024-01-11 19:50:49', NULL),
(110, 'add', 0, '', 47, 'alcohol', 'alc', 64, '200 - OFFICE SUPPLIES', 0, '', 'alcohol', 5, 0, 100, 0, 0, 'Box/es', 'Bottle/s', 200.0000, 0.0000, 0.0000, 0.0000, '2024-01-11', '', 'Active', '1', 'Main', 'Admin', 1, 0, '', 0, '', '2024-01-11 19:55:52', NULL),
(111, 'add', 0, '', 47, 'alcohol', 'alc', 64, '200 - OFFICE SUPPLIES', 0, '', 'alcohol', 5, 0, 5, 0, 0, 'Bottle/s', 'Bottle/s', 100.0000, 0.0000, 500.0000, 0.0000, '2024-01-11', '', 'Active', '1', 'Main', 'Admin', 1, 0, '', 0, '', '2024-01-11 20:08:55', NULL),
(112, 'add', 0, '', 47, 'alcohol', 'alc', 64, '200 - OFFICE SUPPLIES', 0, '', 'alcohol', 2, 10, 50, 0, 0, 'Box/es', 'Bottle/s', 200.0000, 30.0000, 700.0000, 0.0000, '2024-01-11', '', 'Active', '2', 'Main', 'Admin', 1, 0, '', 0, '', '2024-01-11 20:11:14', '2024-01-11 08:19:44'),
(113, 'add', 0, '', 47, 'alcohol', 'alc', 64, '200 - OFFICE SUPPLIES', 18, 'sup 1\'\'`', 'alcohol', 2, 0, 2, 0, 0, 'Bottle/s', 'Bottle/s', 10.0000, 0.0000, 20.0000, 0.0000, '2024-01-12', '', 'Active', '1', 'Main', 'Admin', 1, 0, '', 0, '', '2024-01-12 09:34:38', NULL),
(114, 'add', 0, '', 47, 'alcohol', 'alc', 64, '200 - OFFICE SUPPLIES', 0, '', 'alcohol', 2, 3, 43, 0, 0, 'Box/es', 'Bottle/s', 100.6500, 5.0000, 216.9600, 0.0000, '2024-01-12', '', 'Active', '2', 'Main', 'Admin', 1, 0, '', 0, '', '2024-01-12 09:37:28', NULL),
(115, 'add', 0, '', 47, 'alcohol', 'alc', 64, '200 - OFFICE SUPPLIES', 0, '', 'alcohol', 3, 3, 63, 0, 0, 'Box/es', 'Bottle/s', 100.6540, 11.0000, 334.6260, 0.0000, '2024-01-12', '', 'Active', '2', 'Main', 'Admin', 1, 0, '', 0, '', '2024-01-12 09:39:49', NULL),
(116, 'add', 0, '', 47, 'alcohol', 'alc', 64, '200 - OFFICE SUPPLIES', 0, '', 'alcohol', 2, 10, 50, 0, 0, 'Box/es', 'Bottle/s', 152.2640, 10.5550, 410.0780, 0.0000, '2024-01-12', '', 'Active', '2', 'Main', 'Admin', 1, 0, '', 0, '', '2024-01-12 09:43:10', '2024-01-12 09:54:01'),
(117, 'Released', 13, 'jennie Lin', 47, 'alcohol', 'alc', 64, '200 - OFFICE SUPPLIES', 0, '', 'alcohol', 0, 0, 0, 50, 50, 'Bottle/s', '', 0.0000, 0.0000, 0.0000, 0.0000, '2024-01-12', '', 'Active', '', '', 'Admin', 1, 0, '', 0, '', '2024-01-12 09:47:05', NULL),
(118, 'add', 0, '', 39, 'Computer printer', 'SN#SMXK019554', 60, '223 - IT EQUIPMENT AND SOFTWARE', 0, '', '', 5, 0, 5, 0, 0, 'pc', 'pc', 50000.0000, 0.0000, 250000.0000, 0.0000, '2024-01-12', '', 'Active', '5', 'Main', 'Admin', 1, 0, '', 0, '', '2024-01-12 09:51:27', NULL),
(119, 'add', 0, '', 49, 'Ballpen', 'bp', 64, '200 - OFFICE SUPPLIES', 0, '', 'Ballpen', 1, 5, 25, 0, 0, 'Box/es', 'Box/es', 75.0000, 7.0000, 110.0000, 0.0000, '2024-01-12', '', 'Active', '2', 'Main', 'Admin', 1, 0, '', 0, '', '2024-01-12 09:55:37', '2024-01-12 09:56:53'),
(120, 'add', 0, '', 49, 'Ballpen', 'bp', 64, '200 - OFFICE SUPPLIES', 0, '', 'Ballpen', 5, 0, 5, 0, 0, 'Pc/s', 'Pc/s', 7.0000, 0.0000, 35.0000, 0.0000, '2024-01-12', '', 'Active', '1', 'Main', 'Admin', 1, 0, '', 0, '', '2024-01-12 09:58:05', NULL),
(121, 'Released', 11, 'Jona Tane', 49, 'Ballpen', 'bp', 64, '200 - OFFICE SUPPLIES', 0, '', 'Ballpen', 0, 0, 0, 3, 3, 'Pc/s', '', 0.0000, 0.0000, 0.0000, 0.0000, '2024-01-12', '', 'Active', '', '', 'Admin', 1, 0, '', 0, '', '2024-01-12 09:58:31', NULL),
(122, 'add', 0, '', 50, 'test item 5\"', 'test item5', 0, '100 - SAMPLE CATEGORY it is', 17, 'supplier , 3', '', 1, 3, 13, 0, 0, 'Box/es', 'Pc/s', 100.0000, 10.0000, 130.0000, 0.0000, '2024-01-12', '', 'deleted', '2', 'Main', 'Admin', 1, 0, '', 0, '', '2024-01-12 15:47:45', '2024-01-12 05:11:41'),
(123, 'add', 0, '', 51, 'test item 6\"', 'code6', 0, '100 - SAMPLE CATEGORY it is', 17, 'supplier , 3', 'eyyyy', 3, 2, 60, 0, 0, 'Rim', 'Rim', 500.0000, 150.0000, 1800.0000, 0.0000, '2024-01-12', '', 'deleted', '2months', 'Main', 'Admin', 1, 0, '', 0, '', '2024-01-12 15:54:00', '2024-01-12 05:11:41'),
(124, 'add', 0, '', 55, 'laptop', 'lappy', 0, '223 - IT EQUIPMENT AND SOFTWARE', 0, 'na', 'desc', 10, 0, 10, 0, 0, 'Pc/s', 'Pc/s', 30000.0000, 0.0000, 300000.0000, 0.0000, '2024-01-14', '', 'Active', '2', 'Main', 'Admin', 1, 0, '', 0, '', '2024-01-14 19:56:15', NULL),
(125, 'add', 0, '', 47, 'alcohol\"', 'alc', 64, '200 - OFFICE SUPPLIES', 0, '', 'alcohol', 1, 2, 22, 0, 0, 'Box/es', 'Bottle/s', 300.0000, 30.0000, 360.0000, 0.0000, '2024-01-14', '', 'Active', '2', 'Main', 'Admin', 1, 0, '', 0, '', '2024-01-14 21:40:16', NULL),
(126, 'add', 0, '', 39, 'Computer printer', 'SN#SMXK019554', 60, '223 - IT EQUIPMENT AND SOFTWARE', 0, '', '', 1, 0, 1, 0, 0, 'pc', 'pc', 30000.0000, 0.0000, 30000.0000, 0.0000, '2024-01-14', '', 'Active', '10', 'Main', 'Admin', 1, 0, '', 0, '', '2024-01-14 21:40:54', NULL),
(127, 'add', 0, '', 56, 'spec tish', 'st', 60, '223 - IT EQUIPMENT AND SOFTWARE', 0, '', 'desc', 1, 0, 1, 0, 0, 'Bag/s', 'Bag/s', 100.0000, 0.0000, 100.0000, 0.0000, '2024-01-14', '', 'Active', '2', 'Main', 'Admin', 1, 0, '', 0, '', '2024-01-14 21:56:20', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_notif_category`
--

CREATE TABLE `tbl_notif_category` (
  `id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_notif_category`
--

INSERT INTO `tbl_notif_category` (`id`, `cat_id`, `cat_name`, `status`, `date_created`) VALUES
(1, 64, '200-OFFICE SUPPLIES', 'Active', '2024-01-05 15:22:23');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_supplier`
--

CREATE TABLE `tbl_supplier` (
  `sup_id` int(11) NOT NULL,
  `supplier_name` varchar(100) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `address` varchar(150) NOT NULL,
  `tin` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `date_update` datetime DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_supplier`
--

INSERT INTO `tbl_supplier` (`sup_id`, `supplier_name`, `mobile`, `address`, `tin`, `status`, `user_id`, `user_name`, `date_update`, `date_created`) VALUES
(15, 'supplier 1 2', '758', ' solano', '555', 'deleted', 1, 'Admin', '2023-12-20 11:26:39', '2023-12-20 15:25:20'),
(16, 'supplier\'s 1 \'2,', '555', ' solano', '555-555-555', 'Active', 1, 'Admin', '2023-12-21 08:43:06', '2023-12-21 12:34:31'),
(17, 'supplier , 3', '0', ' solano', '555-88', 'Active', 1, 'Admin', NULL, '2023-12-21 12:43:35'),
(18, 'sup 1\'\'`\"', '555', ' Sola', '555-555', 'Active', 1, 'Admin', '2024-01-02 06:18:56', '2024-01-02 10:18:13');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_trans_add`
--

CREATE TABLE `tbl_trans_add` (
  `add_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_name` varchar(150) NOT NULL,
  `item_code` varchar(150) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(150) NOT NULL,
  `sup_id` int(11) NOT NULL,
  `sup_name` varchar(150) NOT NULL,
  `description` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `unit` varchar(50) NOT NULL,
  `amount` decimal(8,4) NOT NULL,
  `total` decimal(9,4) NOT NULL,
  `trans_date` date NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `remarks` varchar(255) DEFAULT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_trans_release`
--

CREATE TABLE `tbl_trans_release` (
  `rls_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `emp_name` varchar(150) NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `item_code` varchar(100) NOT NULL,
  `qty` int(11) NOT NULL,
  `unit` varchar(50) NOT NULL,
  `condition` varchar(150) NOT NULL,
  `cost` decimal(8,4) NOT NULL,
  `trans_date` date NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `remarks` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_unit`
--

CREATE TABLE `tbl_unit` (
  `id` int(11) NOT NULL,
  `unit_name` varchar(100) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `userid` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`userid`, `email`, `password`, `name`, `type`, `status`, `date_created`) VALUES
(1, 'admin@mail.com', 'admin123', 'Admin', 'admin', 'Active', '2023-12-15 08:07:40'),
(2, 'encoder1@mail.com', 'encoder123', 'encoder 1', 'encoder', 'Active', '2023-12-16 14:33:54'),
(3, 'manager@mail.com', 'manager123', 'manager', 'manager', 'Active', '2023-12-16 15:27:28');

-- --------------------------------------------------------

--
-- Stand-in structure for view `total_amount`
-- (See below for the actual view)
--
CREATE TABLE `total_amount` (
`total` decimal(35,4)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_inventory_list`
-- (See below for the actual view)
--
CREATE TABLE `view_inventory_list` (
`Row` bigint(21)
,`item_id` int(11)
,`item_name` varchar(150)
,`cat_id` int(11)
,`cat_name` varchar(150)
,`qty` decimal(32,0)
,`rls_qty` decimal(65,0)
,`avail_stocks` decimal(65,0)
,`total` decimal(35,4)
,`latest_stock_date` date
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_inv_summary`
-- (See below for the actual view)
--
CREATE TABLE `view_inv_summary` (
`Row` bigint(21)
,`item_id` int(11)
,`item_name` varchar(150)
,`item_code` varchar(150)
,`cat_id` int(11)
,`cat_name` varchar(150)
,`qty` decimal(32,0)
,`rls_qty` decimal(65,0)
,`avail_stocks` decimal(65,0)
,`total` decimal(35,4)
,`latest_stock_date` date
,`unit_ind` varchar(50)
,`unit_group` varchar(100)
,`item_qty_ind` int(11)
);

-- --------------------------------------------------------

--
-- Structure for view `total_amount`
--
DROP TABLE IF EXISTS `total_amount`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `total_amount`  AS SELECT sum(`tbl_itemtrans`.`total`) AS `total` FROM `tbl_itemtrans` WHERE `tbl_itemtrans`.`status` = 'Active' AND `tbl_itemtrans`.`trans_type` = 'add' ;

-- --------------------------------------------------------

--
-- Structure for view `view_inventory_list`
--
DROP TABLE IF EXISTS `view_inventory_list`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_inventory_list`  AS SELECT row_number() over ( order by `t`.`item_name`) AS `Row`, `t`.`item_id` AS `item_id`, `t`.`item_name` AS `item_name`, `t`.`cat_id` AS `cat_id`, `t`.`cat_name` AS `cat_name`, sum(`t`.`qty_ind`) AS `qty`, sum(`t`.`qty_rls_ind`) AS `rls_qty`, sum(`t`.`qty_ind` - `t`.`qty_rls_ind`) AS `avail_stocks`, `a`.`total` AS `total`, `a`.`latest_stock_date` AS `latest_stock_date` FROM (`tbl_itemtrans` `t` join (select `tbl_itemtrans`.`item_id` AS `item_id`,sum(`tbl_itemtrans`.`total`) AS `total`,max(`tbl_itemtrans`.`trans_date`) AS `latest_stock_date` from `tbl_itemtrans` where `tbl_itemtrans`.`trans_type` = 'add' and `tbl_itemtrans`.`status` = 'Active' group by `tbl_itemtrans`.`item_id`) `a` on(`a`.`item_id` = `t`.`item_id`)) GROUP BY `t`.`item_id` ORDER BY `t`.`item_name` ASC ;

-- --------------------------------------------------------

--
-- Structure for view `view_inv_summary`
--
DROP TABLE IF EXISTS `view_inv_summary`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_inv_summary`  AS SELECT row_number() over ( order by `t`.`item_name`) AS `Row`, `i`.`item_id` AS `item_id`, `t`.`item_name` AS `item_name`, `i`.`item_code` AS `item_code`, `t`.`cat_id` AS `cat_id`, `t`.`cat_name` AS `cat_name`, sum(`t`.`qty_ind`) AS `qty`, sum(`t`.`qty_rls_ind`) AS `rls_qty`, sum(`t`.`qty_ind` - `t`.`qty_rls_ind`) AS `avail_stocks`, `a`.`total` AS `total`, `a`.`latest_stock_date` AS `latest_stock_date`, `i`.`unit_ind` AS `unit_ind`, `i`.`unit_group` AS `unit_group`, `i`.`item_qty_ind` AS `item_qty_ind` FROM ((`tbl_itemtrans` `t` join (select `tbl_itemtrans`.`item_id` AS `item_id`,sum(`tbl_itemtrans`.`total`) AS `total`,max(`tbl_itemtrans`.`trans_date`) AS `latest_stock_date` from `tbl_itemtrans` where `tbl_itemtrans`.`trans_type` = 'add' and `tbl_itemtrans`.`status` = 'Active' group by `tbl_itemtrans`.`item_id`) `a` on(`a`.`item_id` = `t`.`item_id`)) join (select `tbl_item`.`item_id` AS `item_id`,`tbl_item`.`item_code` AS `item_code`,`tbl_item`.`qty` AS `item_qty_ind`,`tbl_item`.`unit` AS `unit_ind`,`tbl_item`.`unit_group` AS `unit_group` from `tbl_item` where `tbl_item`.`status` = 'Active') `i` on(`i`.`item_id` = `t`.`item_id`)) GROUP BY `i`.`item_id` ORDER BY `t`.`item_name` ASC ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_audittrail`
--
ALTER TABLE `tbl_audittrail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`cat_id`),
  ADD UNIQUE KEY `cat_name` (`cat_name`);

--
-- Indexes for table `tbl_employee`
--
ALTER TABLE `tbl_employee`
  ADD PRIMARY KEY (`emp_id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `tbl_item`
--
ALTER TABLE `tbl_item`
  ADD PRIMARY KEY (`item_id`),
  ADD UNIQUE KEY `item_name` (`item_name`);

--
-- Indexes for table `tbl_itemtrans`
--
ALTER TABLE `tbl_itemtrans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_notif_category`
--
ALTER TABLE `tbl_notif_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  ADD PRIMARY KEY (`sup_id`),
  ADD UNIQUE KEY `supplier_name` (`supplier_name`);

--
-- Indexes for table `tbl_trans_add`
--
ALTER TABLE `tbl_trans_add`
  ADD PRIMARY KEY (`add_id`),
  ADD UNIQUE KEY `item_name` (`item_name`);

--
-- Indexes for table `tbl_trans_release`
--
ALTER TABLE `tbl_trans_release`
  ADD PRIMARY KEY (`rls_id`);

--
-- Indexes for table `tbl_unit`
--
ALTER TABLE `tbl_unit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`userid`),
  ADD UNIQUE KEY `name` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_audittrail`
--
ALTER TABLE `tbl_audittrail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=163;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `tbl_employee`
--
ALTER TABLE `tbl_employee`
  MODIFY `emp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_item`
--
ALTER TABLE `tbl_item`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `tbl_itemtrans`
--
ALTER TABLE `tbl_itemtrans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT for table `tbl_notif_category`
--
ALTER TABLE `tbl_notif_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  MODIFY `sup_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_trans_add`
--
ALTER TABLE `tbl_trans_add`
  MODIFY `add_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_trans_release`
--
ALTER TABLE `tbl_trans_release`
  MODIFY `rls_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_unit`
--
ALTER TABLE `tbl_unit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
