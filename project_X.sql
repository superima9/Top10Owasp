-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 22, 2018 at 11:42 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_X`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(255) NOT NULL,
  `username` varchar(355) NOT NULL,
  `password` varchar(355) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `password`) VALUES
(1, 'admin', 'password321');

-- --------------------------------------------------------

--
-- Table structure for table `beneficiary_c1`
--

CREATE TABLE `beneficiary_c1` (
  `beneficiary_id` int(255) NOT NULL,
  `beneficiary_client_id` int(255) DEFAULT NULL,
  `account_num` int(30) DEFAULT NULL,
  `sort_code` int(25) DEFAULT NULL,
  `beneficiary_client_full_name` varchar(355) DEFAULT NULL,
  `beneficiary_saved_us` varchar(355) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `beneficiary_c1`
--

INSERT INTO `beneficiary_c1` (`beneficiary_id`, `beneficiary_client_id`, `account_num`, `sort_code`, `beneficiary_client_full_name`, `beneficiary_saved_us`) VALUES
(7, 3, 87654322, 334455, 'mark autumn', 'marc'),
(8, 5, 87654324, 167333, 'Paul Romans', '<!--#echo var=\"DOCUMENT_NAME\"-->'),
(11, 2, 87654321, 112233, 'Luke Spring', '<!--#echo var=\"DOCUMENT_NAME\"-->');

-- --------------------------------------------------------

--
-- Table structure for table `beneficiary_c2`
--

CREATE TABLE `beneficiary_c2` (
  `beneficiary_id` int(255) NOT NULL,
  `beneficiary_client_id` int(255) DEFAULT NULL,
  `account_num` int(30) DEFAULT NULL,
  `sort_code` int(25) DEFAULT NULL,
  `beneficiary_client_full_name` varchar(355) DEFAULT NULL,
  `beneficiary_saved_us` varchar(355) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `beneficiary_c2`
--

INSERT INTO `beneficiary_c2` (`beneficiary_id`, `beneficiary_client_id`, `account_num`, `sort_code`, `beneficiary_client_full_name`, `beneficiary_saved_us`) VALUES
(3, 3, 87654322, 334345, 'Mark Autumn', 'marc'),
(4, 4, 87654323, 445566, 'John Summer', 'jon'),
(5, 1, 87654320, 223344, 'Matthew Winter', 'mat'),
(6, 5, 87654324, 167333, 'Paul Romans', 'pal');

-- --------------------------------------------------------

--
-- Table structure for table `beneficiary_c3`
--

CREATE TABLE `beneficiary_c3` (
  `beneficiary_id` int(255) NOT NULL,
  `beneficiary_client_id` int(255) DEFAULT NULL,
  `account_num` int(30) DEFAULT NULL,
  `sort_code` int(25) DEFAULT NULL,
  `beneficiary_client_full_name` varchar(355) DEFAULT NULL,
  `beneficiary_saved_us` varchar(355) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `beneficiary_c4`
--

CREATE TABLE `beneficiary_c4` (
  `beneficiary_id` int(255) NOT NULL,
  `beneficiary_client_id` int(255) DEFAULT NULL,
  `account_num` int(30) DEFAULT NULL,
  `sort_code` int(25) DEFAULT NULL,
  `beneficiary_client_full_name` varchar(355) DEFAULT NULL,
  `beneficiary_saved_us` varchar(355) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `beneficiary_c5`
--

CREATE TABLE `beneficiary_c5` (
  `beneficiary_id` int(255) NOT NULL,
  `beneficiary_client_id` int(255) DEFAULT NULL,
  `account_num` int(30) DEFAULT NULL,
  `sort_code` int(25) DEFAULT NULL,
  `beneficiary_client_full_name` varchar(355) DEFAULT NULL,
  `beneficiary_saved_us` varchar(355) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `beneficiary_c6`
--

CREATE TABLE `beneficiary_c6` (
  `beneficiary_id` int(255) NOT NULL,
  `beneficiary_client_id` int(255) DEFAULT NULL,
  `account_num` int(30) DEFAULT NULL,
  `sort_code` int(25) DEFAULT NULL,
  `beneficiary_client_full_name` varchar(355) DEFAULT NULL,
  `beneficiary_saved_us` varchar(355) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bookkeeping_c1`
--

CREATE TABLE `bookkeeping_c1` (
  `transaction_id` int(255) NOT NULL,
  `date_time` datetime DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `money_in` int(11) DEFAULT NULL,
  `money_out` int(11) DEFAULT NULL,
  `bank_balance` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bookkeeping_c1`
--

INSERT INTO `bookkeeping_c1` (`transaction_id`, `date_time`, `description`, `money_in`, `money_out`, `bank_balance`) VALUES
(1, '2018-02-01 10:00:00', 'Opening Balance', 17500, 0, 17500),
(2, '2018-02-20 15:40:04', 'P2P - Tranferred tojohn summer -> AN: 75695461 SC:445566', 0, 500, 17000),
(3, '2018-02-20 15:40:49', 'P2P - Tranferred tojohn summer -> AN: 75695461 SC:445566', 0, 500, 16500),
(4, '2018-02-20 15:41:10', 'P2P - Tranferred tojohn summer -> AN: 75695461 SC:445566', 0, 500, 16000),
(5, '2018-02-20 15:41:40', 'P2P - Tranferred tojohn summer -> AN: 75695461 SC:445566', 0, 500, 15500),
(6, '2018-02-20 15:44:06', 'P2P - Tranferred tojohn summer -> AN: 75695461 SC:445566', 0, 500, 15000),
(7, '2018-02-20 15:47:10', 'P2P - Tranferred to summer john -> AN: 75695461 SC:445566', 0, 500, 14500),
(8, '2018-02-20 15:50:09', 'P2P - Tranferred to summer john -> AN: 75695461 SC:445566', 0, 500, 14000),
(9, '2018-02-20 15:58:03', 'P2P - Received from winter matthew -> AN: 75885799 SC:223344', 0, 500, 13500),
(10, '2018-02-20 16:02:59', 'P2P - Received from winter matthew -> AN: 75885799 SC:223344  ', 0, 500, 13000),
(11, '2018-02-20 16:03:57', 'P2P - Received from winter matthew -> AN: 75885799 SC:223344  ', 0, 500, 12500),
(12, '2018-02-20 16:07:06', 'P2P - Received from winter matthew -> AN: 75885799 SC:223344  ', 0, 200, 12300),
(13, '2018-02-20 16:13:46', 'P2P - Received from winter matthew -> AN: 75885799 SC:223344  ', 0, 500, 11800),
(14, '2018-02-20 16:17:47', 'P2P - Transferred to spring luke -> AN: 75695461 SC:112233  ', 0, 1000, 10800),
(15, '2018-02-20 16:49:13', 'P2P - Transferred to autumn mark -> AN: 75654321 SC:334455  ', 0, 11, 10789),
(16, '2018-02-20 16:50:40', 'P2P - Transferred to autumn mark -> AN: 75654321 SC:334455  ', 0, 21, 10768),
(17, '2018-02-20 16:53:25', 'P2P - Transferred to autumn mark -> AN: 75654321 SC:334455  ', 0, 21, 10747),
(18, '2018-02-20 16:57:40', 'P2P - Transferred to autumn mark -> AN: 75654321 SC:334455  ', 0, 0, 10700),
(19, '2018-02-22 13:17:51', 'P2P - Cash withdrawl  winter matthew -> AN: 75885799 SC:223344  ', 0, 50, 10650),
(20, '2018-02-23 14:48:25', 'P2P - Transferred to spring luke -> AN: 75695461 SC:112233  ', 0, 25, 10600),
(21, '2018-03-02 19:36:09', 'P2P - Cash withdrawl  Winter Matthew -> AN: 75885799 SC:223344  ', 0, 580, 10020),
(22, '2018-03-10 13:49:23', 'P2P - Transferred to Spring Luke -> AN: 75695461 SC:112233  ', 0, 20, 10000),
(23, '2018-03-10 14:09:46', 'P2P - Cash withdrawl  Winter Matthew -> AN: 75885799 SC:223344  ', 0, 1000, 9000),
(24, '2018-04-24 18:25:22', 'P2P - Transferred to Autumn Mark -> AN: 87654322 SC:334345  ', 0, 5, 9000),
(25, '2018-04-24 18:25:34', 'P2P - Transferred to Autumn Mark -> AN: 87654322 SC:334345  ', 0, 5, 9000),
(26, '2018-04-24 18:28:35', 'P2P - Transferred to Spring Luke -> AN: 87654321 SC:112233  ', 0, 55, 8940),
(27, '2018-04-24 23:03:10', 'P2P - Transferred to Summer John -> AN: 87654323 SC:445566  ', 0, 16, 8920),
(28, '2018-04-25 15:00:33', 'P2P - Transferred to Summer John -> AN: 87654323 SC:445566  ', 0, 16, 8900),
(29, '2018-04-25 15:01:18', 'P2P - Transferred to Summer John -> AN: 87654323 SC:445566  ', 0, 16, 8880),
(30, '2018-04-25 16:17:35', 'P2P - Transferred to Summer John -> AN: 87654323 SC:445566  ', 0, 16, 8860),
(31, '2018-04-25 16:17:58', 'P2P - Transferred to Summer John -> AN: 87654323 SC:445566  ', 0, 16, 8840),
(32, '2018-05-08 21:07:41', 'P2P - Transferred to Summer John -> AN: 87654323 SC:445566  ', 0, 16, 8820),
(33, '2018-05-08 21:07:44', 'P2P - Transferred to Summer John -> AN: 87654323 SC:445566  ', 0, 16, 8800),
(34, '2018-05-08 21:08:30', 'P2P - Transferred to Summer John -> AN: 87654323 SC:445566  ', 0, 16, 8780),
(35, '2018-05-08 22:22:21', 'P2P - Transferred to Summer John -> AN: 87654323 SC:445566  ', 0, 16, 8760),
(36, '2018-05-08 22:45:14', 'P2P - Transferred to Summer John -> AN: 87654323 SC:445566  ', 0, 16, 8740),
(37, '2018-05-08 22:46:20', 'P2P - Transferred to Summer John -> AN: 87654323 SC:445566  ', 0, 16, 8720),
(38, '2018-05-08 22:46:48', 'P2P - Transferred to Summer John -> AN: 87654323 SC:445566  ', 0, 16, 8700),
(39, '2018-05-08 23:08:44', 'P2P - Transferred to Summer John -> AN: 87654323 SC:445566  ', 0, 16, 8680),
(40, '2018-05-08 23:09:21', 'P2P - Transferred to Summer John -> AN: 87654323 SC:445566  ', 0, 16, 8660),
(41, '2018-05-08 23:09:22', 'P2P - Transferred to Summer John -> AN: 87654323 SC:445566  ', 0, 16, 8640),
(42, '2018-05-09 12:29:40', 'P2P - Transferred to Summer John -> AN: 87654323 SC:445566  ', 0, 16, 8620),
(43, '2018-05-09 14:38:00', 'P2P - Transferred to Summer John -> AN: 87654323 SC:445566  ', 0, 16, 8600),
(44, '2018-05-09 14:38:22', 'P2P - Transferred to Summer John -> AN: 87654323 SC:445566  ', 0, 16, 8580),
(45, '2018-05-09 14:40:30', 'P2P - Transferred to Summer John -> AN: 87654323 SC:445566  ', 0, 16, 8560),
(46, '2018-05-14 13:14:41', 'P2P - Transferred to Summer John -> AN: 87654323 SC:445566  ', 0, 16, 8540),
(47, '2018-05-15 21:02:46', 'P2P - Transferred to Summer John -> AN: 87654323 SC:445566  ', 0, 16, 8520),
(48, '2018-05-15 21:06:56', 'P2P - Transferred to Summer John -> AN: 87654323 SC:445566  ', 0, 16, 8500),
(49, '2018-05-15 21:52:13', 'P2P - Transferred to Autumn Mark -> AN: 87654322 SC:334345  ', 0, 100, 8400),
(50, '2018-05-15 21:53:40', 'P2P - Transferred to Summer John -> AN: 87654323 SC:445566  ', 0, 16, 8380),
(51, '2018-05-15 21:55:08', 'P2P - Transferred to Summer John -> AN: 87654323 SC:445566  ', 0, 50, 8330),
(52, '2018-05-15 21:55:09', 'P2P - Transferred to Summer John -> AN: 87654323 SC:445566  ', 0, 50, 8280),
(53, '2018-05-15 21:57:55', 'P2P - Transferred to Summer John -> AN: 87654323 SC:445566  ', 0, 200, 8080),
(54, '2018-05-16 21:04:36', 'P2P - Transferred to Winter Matthew -> AN: 351329 SC:4465  ', 0, 200, 7880),
(55, '2018-05-16 21:04:36', 'P2P - Received from  Winter Matthew -> AN: 351329 SC:4465', 200, 0, 17700),
(56, '2018-05-16 21:06:56', 'P2P - Transferred to Winter Matthew -> AN: 351329 SC:4465  ', 0, 200, 17500),
(57, '2018-05-16 21:06:56', 'P2P - Received from  Winter Matthew -> AN: 351329 SC:4465', 200, 0, 17700),
(58, '2018-05-16 21:06:57', 'P2P - Transferred to Winter Matthew -> AN: 351329 SC:4465  ', 0, 200, 17500),
(59, '2018-05-16 21:06:57', 'P2P - Received from  Winter Matthew -> AN: 351329 SC:4465', 200, 0, 17700),
(60, '2018-06-04 16:48:04', 'P2P - Transferred to Winter Matthew -> AN: 351329 SC:4465  ', 0, 200, 17500),
(61, '2018-06-04 16:48:04', 'P2P - Received from  Winter Matthew -> AN: 351329 SC:4465', 200, 0, 17700),
(62, '2018-06-04 16:48:38', 'P2P - Transferred to Winter Matthew -> AN: 351329 SC:4465  ', 0, 200, 17500),
(63, '2018-06-04 16:48:38', 'P2P - Received from  Winter Matthew -> AN: 351329 SC:4465', 200, 0, 17700),
(64, '2018-06-04 16:49:41', 'P2P - Transferred to Winter Matthew -> AN: 351329 SC:4465  ', 0, 200, 17500),
(65, '2018-06-04 16:49:41', 'P2P - Received from  Winter Matthew -> AN: 351329 SC:4465', 200, 0, 17700),
(66, '2018-06-04 16:51:26', 'P2P - Transferred to Winter Matthew -> AN: 351329 SC:4465  ', 0, 200, 17500),
(67, '2018-06-04 16:51:26', 'P2P - Received from  Winter Matthew -> AN: 351329 SC:4465', 200, 0, 17700),
(68, '2018-06-04 16:51:39', 'P2P - Transferred to Winter Matthew -> AN: 351329 SC:4465  ', 0, 200, 17500),
(69, '2018-06-04 16:51:39', 'P2P - Received from  Winter Matthew -> AN: 351329 SC:4465', 200, 0, 17700);

-- --------------------------------------------------------

--
-- Table structure for table `bookkeeping_c2`
--

CREATE TABLE `bookkeeping_c2` (
  `transaction_id` int(255) NOT NULL,
  `date_time` datetime DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `money_in` float DEFAULT NULL,
  `money_out` float DEFAULT NULL,
  `bank_balance` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bookkeeping_c2`
--

INSERT INTO `bookkeeping_c2` (`transaction_id`, `date_time`, `description`, `money_in`, `money_out`, `bank_balance`) VALUES
(1, '2018-02-01 10:00:00', 'Opening Balance', 1500, 0, 1500),
(2, '2018-02-20 16:13:47', 'P2P - Tranferred to spring luke -> AN: 75695461 SC:112233', 500, 0, 2000),
(3, '2018-02-20 16:17:47', 'P2P - Received from  winter matthew -> AN: 75885799 SC:223344', 1000, 0, 2500),
(4, '2018-02-23 14:48:25', 'P2P - Received from  winter matthew -> AN: 75885799 SC:223344', 25, 0, 1520),
(5, '2018-03-10 13:49:23', 'P2P - Received from  Winter Matthew -> AN: 75885799 SC:223344', 20, 0, 1520),
(6, '2018-03-20 13:04:54', 'P2P - Transferred to Summer John -> AN: 87654323 SC:445566  ', 0, 7, 1510),
(7, '2018-03-20 13:07:36', 'P2P - Transferred to Summer John -> AN: 87654323 SC:445566  ', 0, 7, 1500),
(8, '2018-03-20 13:31:42', 'P2P - Cash withdrawl  Spring Luke -> AN: 87654321 SC:112233  ', 0, 3, 1497),
(9, '2018-03-23 14:25:46', 'P2P - Transferred to Summer John -> AN: 87654323 SC:445566  ', 0, 50, 1450),
(10, '2018-04-24 18:28:35', 'P2P - Received from  Winter Matthew -> AN: 87654320 SC:223344', 55, 0, 1560),
(11, '2018-04-24 18:50:25', 'P2P - Transferred to Summer John -> AN: 87654323 SC:445566  ', 0, 0, 1560),
(12, '2018-04-24 18:51:56', 'P2P - Transferred to   -> AN:  SC:  ', 0, 30, 1530),
(13, '2018-04-24 18:52:16', 'P2P - Transferred to   -> AN:  SC:  ', 0, 30, 1500),
(14, '2018-04-24 18:54:17', 'P2P - Transferred to   -> AN:  SC:  ', 0, 0, 1500),
(15, '2018-04-24 19:01:15', 'P2P - Transferred to   -> AN:  SC:  ', 0, 0, 1500),
(16, '2018-04-24 19:01:30', 'P2P - Transferred to Summer John -> AN: 87654323 SC:445566  ', 0, 5, 1500),
(17, '2018-04-24 19:03:38', 'P2P - Transferred to Spring Luke -> AN: 87654321 SC:112233  ', 0, 100, 1400),
(18, '2018-04-24 19:03:38', 'P2P - Received from  Spring Luke -> AN: 87654321 SC:112233', 100, 0, 1600),
(19, '2018-04-24 19:06:51', 'P2P - Transferred to Summer John -> AN: 87654323 SC:445566  ', 0, 5, 1600),
(20, '2018-04-24 19:07:36', 'P2P - Transferred to Summer John -> AN: 87654323 SC:445566  ', 0, 16.5, 1580),
(21, '2018-04-24 19:13:05', 'P2P - Transferred to Summer John -> AN: 87654323 SC:445566  ', 0, 16.5, 1560),
(22, '2018-04-24 19:13:36', 'P2P - Transferred to Summer John -> AN: 87654323 SC:445566  ', 0, 16.5, 1540),
(23, '2018-04-24 19:18:03', 'P2P - Transferred to Summer John -> AN: 87654323 SC:445566  ', 0, 16.5, 1520),
(24, '2018-04-24 19:18:25', 'P2P - Transferred to Summer John -> AN: 87654323 SC:445566  ', 0, 16.5, 1500),
(25, '2018-04-24 19:19:30', 'P2P - Transferred to Summer John -> AN: 87654323 SC:445566  ', 0, 16.5, 1480),
(26, '2018-04-24 19:19:59', 'P2P - Transferred to Summer John -> AN: 87654323 SC:445566  ', 0, 16.5, 1460),
(27, '2018-04-24 22:28:56', 'P2P - Transferred to Summer John -> AN: 87654323 SC:445566  ', 0, 16.5, 1440),
(28, '2018-04-24 22:28:59', 'P2P - Transferred to Summer John -> AN: 87654323 SC:445566  ', 0, 16.5, 1420),
(29, '2018-04-24 22:41:20', 'P2P - Transferred to Summer John -> AN: 87654323 SC:445566  ', 0, 16.5, 1400),
(30, '2018-04-25 15:18:29', 'P2P - Transferred to Summer John -> AN: 87654323 SC:445566  ', 0, 16.5, 1380),
(31, '2018-04-25 15:21:11', 'P2P - Transferred to Summer John -> AN: 87654323 SC:445566  ', 0, 16.5, 1360),
(32, '2018-04-25 15:21:18', 'P2P - Transferred to Summer John -> AN: 87654323 SC:445566  ', 0, 16.5, 1340),
(33, '2018-04-25 15:30:04', 'P2P - Transferred to Summer John -> AN: 87654323 SC:445566  ', 0, 16.5, 1320);

-- --------------------------------------------------------

--
-- Table structure for table `bookkeeping_c3`
--

CREATE TABLE `bookkeeping_c3` (
  `transaction_id` int(255) NOT NULL,
  `date_time` datetime DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `money_in` float DEFAULT NULL,
  `money_out` float DEFAULT NULL,
  `bank_balance` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bookkeeping_c3`
--

INSERT INTO `bookkeeping_c3` (`transaction_id`, `date_time`, `description`, `money_in`, `money_out`, `bank_balance`) VALUES
(1, '2018-02-01 11:00:00', 'Opening Balance', 100000, 0, 100000),
(2, '2018-02-20 16:49:13', 'P2P - Received from  winter matthew -> AN: 75885799 SC:223344', 11, 0, 100011),
(3, '2018-02-20 16:50:40', 'P2P - Received from  winter matthew -> AN: 75885799 SC:223344', 21, 0, 100021),
(4, '2018-02-20 16:53:25', 'P2P - Received from  winter matthew -> AN: 75885799 SC:223344', 20.99, 0, 100021),
(5, '2018-02-20 16:57:40', 'P2P - Received from  winter matthew -> AN: 75885799 SC:223344', 0.5, 0, 100000),
(6, '2018-02-24 12:07:44', 'P2P - Received from  joy kim -> AN: 54653521 SC:667788', 10, 0, 100000),
(7, '2018-04-24 18:25:22', 'P2P - Received from  Winter Matthew -> AN: 87654320 SC:223344', 5, 0, 100000),
(8, '2018-04-24 18:25:34', 'P2P - Received from  Winter Matthew -> AN: 87654320 SC:223344', 5, 0, 100000),
(9, '2018-05-15 21:52:13', 'P2P - Received from  Winter Matthew -> AN: 351329 SC:4465', 100, 0, 100000);

-- --------------------------------------------------------

--
-- Table structure for table `bookkeeping_c4`
--

CREATE TABLE `bookkeeping_c4` (
  `transaction_id` int(255) NOT NULL,
  `date_time` datetime DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `money_in` float DEFAULT NULL,
  `money_out` float DEFAULT NULL,
  `bank_balance` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bookkeeping_c4`
--

INSERT INTO `bookkeeping_c4` (`transaction_id`, `date_time`, `description`, `money_in`, `money_out`, `bank_balance`) VALUES
(1, '2018-02-01 12:00:00', 'Opening Balance', 500000, 0, 500000),
(2, '2018-02-20 16:02:59', 'P2P - Tranferred to summer john -> AN: 75695461 SC:445566', 500, 0, 500500),
(3, '2018-02-20 16:03:57', 'P2P - Tranferred to summer john -> AN: 75695461 SC:445566', 500, 0, 500500),
(4, '2018-02-20 16:07:06', 'P2P - Tranferred to summer john -> AN: 75695461 SC:445566', 200, 0, 500200),
(5, '2018-03-20 13:04:54', 'P2P - Received from  Spring Luke -> AN: 87654321 SC:112233', 7, 0, 500000),
(6, '2018-03-20 13:07:36', 'P2P - Received from  Spring Luke -> AN: 87654321 SC:112233', 7, 0, 500000),
(7, '2018-03-23 14:25:46', 'P2P - Received from  Spring Luke -> AN: 87654321 SC:112233', 50, 0, 500000),
(8, '2018-04-24 18:50:25', 'P2P - Received from  Spring Luke -> AN: 87654321 SC:112233', 0, 0, 500000),
(9, '2018-04-24 19:01:30', 'P2P - Received from  Spring Luke -> AN: 87654321 SC:112233', 5, 0, 500000),
(10, '2018-04-24 19:06:51', 'P2P - Received from  Spring Luke -> AN: 87654321 SC:112233', 5, 0, 500000),
(11, '2018-04-24 19:07:36', 'P2P - Received from  Spring Luke -> AN: 87654321 SC:112233', 16.5, 0, 500000),
(12, '2018-04-24 19:13:05', 'P2P - Received from  Spring Luke -> AN: 87654321 SC:112233', 16.5, 0, 500000),
(13, '2018-04-24 19:13:37', 'P2P - Received from  Spring Luke -> AN: 87654321 SC:112233', 16.5, 0, 500000),
(14, '2018-04-24 19:18:03', 'P2P - Received from  Spring Luke -> AN: 87654321 SC:112233', 16.5, 0, 500000),
(15, '2018-04-24 19:18:25', 'P2P - Received from  Spring Luke -> AN: 87654321 SC:112233', 16.5, 0, 500000),
(16, '2018-04-24 19:19:30', 'P2P - Received from  Spring Luke -> AN: 87654321 SC:112233', 16.5, 0, 500000),
(17, '2018-04-24 19:19:59', 'P2P - Received from  Spring Luke -> AN: 87654321 SC:112233', 16.5, 0, 500000),
(18, '2018-04-24 22:28:56', 'P2P - Received from  Spring Luke -> AN: 87654321 SC:112233', 16.5, 0, 500000),
(19, '2018-04-24 22:28:59', 'P2P - Received from  Spring Luke -> AN: 87654321 SC:112233', 16.5, 0, 500000),
(20, '2018-04-24 22:41:20', 'P2P - Received from  Spring Luke -> AN: 87654321 SC:112233', 16.5, 0, 500000),
(21, '2018-04-24 23:03:10', 'P2P - Received from  Winter Matthew -> AN: 87654320 SC:223344', 16.5, 0, 500000),
(22, '2018-04-25 15:00:34', 'P2P - Received from  Winter Matthew -> AN: 87654320 SC:223344', 16.5, 0, 500000),
(23, '2018-04-25 15:01:18', 'P2P - Received from  Winter Matthew -> AN: 87654320 SC:223344', 16.5, 0, 500000),
(24, '2018-04-25 15:18:29', 'P2P - Received from  Spring Luke -> AN: 87654321 SC:112233', 16.5, 0, 500000),
(25, '2018-04-25 15:21:12', 'P2P - Received from  Spring Luke -> AN: 87654321 SC:112233', 16.5, 0, 500000),
(26, '2018-04-25 15:21:19', 'P2P - Received from  Spring Luke -> AN: 87654321 SC:112233', 16.5, 0, 500000),
(27, '2018-04-25 15:30:04', 'P2P - Received from  Spring Luke -> AN: 87654321 SC:112233', 16.5, 0, 500000),
(28, '2018-04-25 16:17:36', 'P2P - Received from  Winter Matthew -> AN: 87654320 SC:223344', 16.5, 0, 500000),
(29, '2018-04-25 16:17:59', 'P2P - Received from  Winter Matthew -> AN: 87654320 SC:223344', 16.5, 0, 500000),
(30, '2018-05-08 21:07:41', 'P2P - Received from  Winter Matthew -> AN: 87654320 SC:223344', 16.5, 0, 500000),
(31, '2018-05-08 21:07:44', 'P2P - Received from  Winter Matthew -> AN: 87654320 SC:223344', 16.5, 0, 500000),
(32, '2018-05-08 21:08:30', 'P2P - Received from  Winter Matthew -> AN: 87654320 SC:223344', 16.5, 0, 500000),
(33, '2018-05-08 22:22:21', 'P2P - Received from  Winter Matthew -> AN: 87654320 SC:223344', 16.5, 0, 500000),
(34, '2018-05-08 22:45:14', 'P2P - Received from  Winter Matthew -> AN: 87654320 SC:223344', 16.5, 0, 500000),
(35, '2018-05-08 22:46:20', 'P2P - Received from  Winter Matthew -> AN: 87654320 SC:223344', 16.5, 0, 500000),
(36, '2018-05-08 22:46:48', 'P2P - Received from  Winter Matthew -> AN: 87654320 SC:223344', 16.5, 0, 500000),
(37, '2018-05-08 23:08:44', 'P2P - Received from  Winter Matthew -> AN: 87654320 SC:223344', 16.5, 0, 500000),
(38, '2018-05-08 23:09:21', 'P2P - Received from  Winter Matthew -> AN: 87654320 SC:223344', 16.5, 0, 500000),
(39, '2018-05-08 23:09:22', 'P2P - Received from  Winter Matthew -> AN: 87654320 SC:223344', 16.5, 0, 500000),
(40, '2018-05-09 12:29:40', 'P2P - Received from  Winter Matthew -> AN: 87654320 SC:223344', 16.5, 0, 500000),
(41, '2018-05-09 14:38:00', 'P2P - Received from  Winter Matthew -> AN: 87654320 SC:223344', 16.5, 0, 500000),
(42, '2018-05-09 14:38:22', 'P2P - Received from  Winter Matthew -> AN: 87654320 SC:223344', 16.5, 0, 500000),
(43, '2018-05-09 14:40:31', 'P2P - Received from  Winter Matthew -> AN: 87654320 SC:223344', 16.5, 0, 500000),
(44, '2018-05-14 13:14:42', 'P2P - Received from    -> AN: 0 SC:0', 16.5, 0, 500000),
(45, '2018-05-15 21:02:47', 'P2P - Received from  Winter Matthew -> AN: 351329 SC:4465', 16.5, 0, 500000),
(46, '2018-05-15 21:06:56', 'P2P - Received from  Winter Matthew -> AN: 351329 SC:4465', 16.5, 0, 500000),
(47, '2018-05-15 21:53:40', 'P2P - Received from  Winter Matthew -> AN: 351329 SC:4465', 16.5, 0, 500000),
(48, '2018-05-15 21:55:08', 'P2P - Received from  Winter Matthew -> AN: 351329 SC:4465', 50, 0, 500000),
(49, '2018-05-15 21:55:09', 'P2P - Received from  Winter Matthew -> AN: 351329 SC:4465', 50, 0, 500000),
(50, '2018-05-15 21:57:55', 'P2P - Received from  Winter Matthew -> AN: 351329 SC:4465', 200, 0, 500000);

-- --------------------------------------------------------

--
-- Table structure for table `bookkeeping_c5`
--

CREATE TABLE `bookkeeping_c5` (
  `transaction_id` int(255) NOT NULL,
  `date_time` datetime DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `money_in` float DEFAULT NULL,
  `money_out` float DEFAULT NULL,
  `bank_balance` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bookkeeping_c5`
--

INSERT INTO `bookkeeping_c5` (`transaction_id`, `date_time`, `description`, `money_in`, `money_out`, `bank_balance`) VALUES
(1, '2018-03-02 20:26:00', 'Opening Balance', 1000, 0, 1000);

-- --------------------------------------------------------

--
-- Table structure for table `bookkeeping_c6`
--

CREATE TABLE `bookkeeping_c6` (
  `transaction_id` int(12) NOT NULL,
  `date_time` datetime DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `money_in` float DEFAULT NULL,
  `money_out` float DEFAULT NULL,
  `bank_balance` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bookkeeping_c6`
--

INSERT INTO `bookkeeping_c6` (`transaction_id`, `date_time`, `description`, `money_in`, `money_out`, `bank_balance`) VALUES
(1, '2018-03-18 20:44:56', 'Opening Balance', 1000, 0, 1000);

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `client_id` int(255) NOT NULL,
  `firstname` varchar(355) DEFAULT NULL,
  `surname` varchar(355) DEFAULT NULL,
  `d_o_b` date DEFAULT NULL,
  `sex` varchar(30) DEFAULT NULL,
  `p_a_n` varchar(50) DEFAULT NULL,
  `email` varchar(75) DEFAULT NULL,
  `phone_num` varchar(50) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `account_num` int(30) DEFAULT NULL,
  `sort_code` int(25) DEFAULT NULL,
  `pin` int(40) DEFAULT NULL,
  `username` varchar(355) DEFAULT NULL,
  `password` varchar(355) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`client_id`, `firstname`, `surname`, `d_o_b`, `sex`, `p_a_n`, `email`, `phone_num`, `address`, `account_num`, `sort_code`, `pin`, `username`, `password`) VALUES
(1, 'Matthew', 'Winter', '2000-11-11', 'male', '5155848697258632', '<script>window.location(', '07584879561', '5 Park Road\r\nApartment 2, B3892y, Birmingham, UK\r\n<script>alert(\"ciao\");</script>', 351329, 4465, 12345, 'mat', 'password'),
(2, 'Luke', 'Spring', '1994-01-11', 'male', '5155948697258732', 'ww', 'w', '<script>alert(\"ciao\");</script>', 87654321, 112233, 1111, 'luke', 'secret5'),
(3, 'Mark', 'Autumn', '1887-08-08', 'male', '5154444697258532', 'mark.autumn@projectY.com', '07388112345', 'Apartment 3, Garden Street\r\nB037JS, London', 87654322, 334345, 2345, 'mark', 'love123'),
(4, 'John', 'Summer', '1987-01-05', 'male', '5155848652691475', 'john.summer@projectY.com', '07688188345', 'Apartment 1,\r\nStar Road,\r\nB455NI\r\nIsrael', 87654323, 445566, 1346, 'john', 'love321'),
(5, 'Paul', 'Romans', '1980-05-01', 'male', '5154444697258333', 'paul.romans@projectY.com', '07388164848', 'Apartment 13,\r\nParis Road,\r\nB145UI\r\nBirmingham', 87654324, 167333, 3333, 'pau', 'faith'),
(6, 'Mary', 'Season', '1988-05-05', 'male', ' 	5155848696468632 ', 'mary.season@projectX.com', '0751484587', 'Apartment 3, Garden Street\r\nB037JS, London', 87654325, 7654, 7654, 'mary', 'pass');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `beneficiary_c1`
--
ALTER TABLE `beneficiary_c1`
  ADD PRIMARY KEY (`beneficiary_id`),
  ADD UNIQUE KEY `beneficiary_client_id_2` (`beneficiary_client_id`),
  ADD KEY `beneficiary_client_id` (`beneficiary_client_id`),
  ADD KEY `account_num` (`account_num`,`sort_code`);

--
-- Indexes for table `beneficiary_c2`
--
ALTER TABLE `beneficiary_c2`
  ADD PRIMARY KEY (`beneficiary_id`),
  ADD KEY `beneficiary_client_id` (`beneficiary_client_id`),
  ADD KEY `account_num` (`account_num`,`sort_code`);

--
-- Indexes for table `beneficiary_c3`
--
ALTER TABLE `beneficiary_c3`
  ADD PRIMARY KEY (`beneficiary_id`),
  ADD KEY `beneficiary_client_id` (`beneficiary_client_id`),
  ADD KEY `account_num` (`account_num`,`sort_code`);

--
-- Indexes for table `beneficiary_c4`
--
ALTER TABLE `beneficiary_c4`
  ADD PRIMARY KEY (`beneficiary_id`),
  ADD KEY `beneficiary_client_id` (`beneficiary_client_id`),
  ADD KEY `account_num` (`account_num`,`sort_code`);

--
-- Indexes for table `beneficiary_c5`
--
ALTER TABLE `beneficiary_c5`
  ADD PRIMARY KEY (`beneficiary_id`),
  ADD UNIQUE KEY `beneficiary_client_id` (`beneficiary_client_id`),
  ADD UNIQUE KEY `account_num` (`account_num`),
  ADD UNIQUE KEY `sort_code` (`sort_code`),
  ADD UNIQUE KEY `beneficiary_client_full_name` (`beneficiary_client_full_name`);

--
-- Indexes for table `beneficiary_c6`
--
ALTER TABLE `beneficiary_c6`
  ADD PRIMARY KEY (`beneficiary_id`),
  ADD UNIQUE KEY `beneficiary_client_id` (`beneficiary_client_id`),
  ADD UNIQUE KEY `account_num` (`account_num`),
  ADD UNIQUE KEY `sort_code` (`sort_code`),
  ADD UNIQUE KEY `beneficiary_client_full_name` (`beneficiary_client_full_name`);

--
-- Indexes for table `bookkeeping_c1`
--
ALTER TABLE `bookkeeping_c1`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `bookkeeping_c2`
--
ALTER TABLE `bookkeeping_c2`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `bookkeeping_c3`
--
ALTER TABLE `bookkeeping_c3`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `bookkeeping_c4`
--
ALTER TABLE `bookkeeping_c4`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `bookkeeping_c5`
--
ALTER TABLE `bookkeeping_c5`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `bookkeeping_c6`
--
ALTER TABLE `bookkeeping_c6`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`client_id`),
  ADD KEY `p_a_n` (`p_a_n`),
  ADD KEY `phone_num` (`phone_num`),
  ADD KEY `email` (`email`),
  ADD KEY `account_num` (`account_num`),
  ADD KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `beneficiary_c1`
--
ALTER TABLE `beneficiary_c1`
  MODIFY `beneficiary_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `beneficiary_c2`
--
ALTER TABLE `beneficiary_c2`
  MODIFY `beneficiary_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `beneficiary_c3`
--
ALTER TABLE `beneficiary_c3`
  MODIFY `beneficiary_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `beneficiary_c4`
--
ALTER TABLE `beneficiary_c4`
  MODIFY `beneficiary_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `beneficiary_c5`
--
ALTER TABLE `beneficiary_c5`
  MODIFY `beneficiary_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `beneficiary_c6`
--
ALTER TABLE `beneficiary_c6`
  MODIFY `beneficiary_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bookkeeping_c1`
--
ALTER TABLE `bookkeeping_c1`
  MODIFY `transaction_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `bookkeeping_c2`
--
ALTER TABLE `bookkeeping_c2`
  MODIFY `transaction_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `bookkeeping_c3`
--
ALTER TABLE `bookkeeping_c3`
  MODIFY `transaction_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `bookkeeping_c4`
--
ALTER TABLE `bookkeeping_c4`
  MODIFY `transaction_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `bookkeeping_c5`
--
ALTER TABLE `bookkeeping_c5`
  MODIFY `transaction_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bookkeeping_c6`
--
ALTER TABLE `bookkeeping_c6`
  MODIFY `transaction_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `client_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
