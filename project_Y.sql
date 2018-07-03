-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 22, 2018 at 11:43 PM
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
-- Database: `project_Y`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(255) NOT NULL,
  `username` varchar(35) CHARACTER SET latin1 NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `password`) VALUES
(1, 'administrator', '$2y$10$kXZRnAbNAj0MHWaffa1ZsOI4qOppCvYEpe.BlUkmn67urbEfnjv2u');

-- --------------------------------------------------------

--
-- Table structure for table `beneficiary_c1`
--

CREATE TABLE `beneficiary_c1` (
  `beneficiary_id` int(12) NOT NULL,
  `beneficiary_client_id` int(12) NOT NULL,
  `account_num` int(8) NOT NULL,
  `sort_code` int(6) NOT NULL,
  `beneficiary_client_full_name` varchar(70) COLLATE utf8mb4_unicode_ci NOT NULL,
  `beneficiary_saved_us` varchar(35) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `beneficiary_c1`
--

INSERT INTO `beneficiary_c1` (`beneficiary_id`, `beneficiary_client_id`, `account_num`, `sort_code`, `beneficiary_client_full_name`, `beneficiary_saved_us`) VALUES
(1, 2, 84154886, 112233, 'Luke Spring', 'luke');

-- --------------------------------------------------------

--
-- Table structure for table `beneficiary_c2`
--

CREATE TABLE `beneficiary_c2` (
  `beneficiary_id` int(12) NOT NULL,
  `beneficiary_client_id` int(12) NOT NULL,
  `account_num` int(8) NOT NULL,
  `sort_code` int(6) NOT NULL,
  `beneficiary_client_full_name` varchar(70) COLLATE utf8mb4_unicode_ci NOT NULL,
  `beneficiary_saved_us` varchar(35) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `beneficiary_c3`
--

CREATE TABLE `beneficiary_c3` (
  `beneficiary_id` int(12) NOT NULL,
  `beneficiary_client_id` int(12) NOT NULL,
  `account_num` int(8) NOT NULL,
  `sort_code` int(6) NOT NULL,
  `beneficiary_client_full_name` varchar(70) COLLATE utf8mb4_unicode_ci NOT NULL,
  `beneficiary_saved_us` varchar(35) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bookkeeping_c1`
--

CREATE TABLE `bookkeeping_c1` (
  `transaction_id` int(12) NOT NULL,
  `date_time` datetime NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `money_in` float NOT NULL,
  `money_out` float NOT NULL,
  `bank_balance` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(17, '2018-02-20 16:53:25', 'P2P - Transferred to autumn mark -> AN: 75654321 SC:334455  ', 0, 20.99, 10747),
(18, '2018-02-20 16:57:40', 'P2P - Transferred to autumn mark -> AN: 75654321 SC:334455  ', 0, 0.5, 10700),
(19, '2018-02-22 13:17:51', 'P2P - Cash withdrawl  winter matthew -> AN: 75885799 SC:223344  ', 0, 50, 10650),
(20, '2018-02-23 14:48:25', 'P2P - Transferred to spring luke -> AN: 75695461 SC:112233  ', 0, 25, 10600),
(21, '2018-03-02 19:36:09', 'P2P - Cash withdrawl  Winter Matthew -> AN: 75885799 SC:223344  ', 0, 580, 10020),
(22, '2018-03-10 13:49:23', 'P2P - Transferred to Spring Luke -> AN: 75695461 SC:112233  ', 0, 20, 10000),
(23, '2018-03-10 14:09:46', 'P2P - Cash withdrawl  Winter Matthew -> AN: 75885799 SC:223344  ', 0, 1000, 9000),
(24, '2018-04-03 20:16:18', 'P2P - Transferred to Autumn Mark -> AN: 87654322 SC:334345', 0, 500, 8500),
(25, '2018-04-03 20:16:49', 'P2P - Transferred to Autumn Mark -> AN: 87654322 SC:334345', 0, 25, 8475),
(26, '2018-04-03 20:28:20', 'P2P - Transferred to Autumn Mark -> AN: 87654322 SC:334345', 0, 5, 8469),
(27, '2018-04-03 20:33:25', 'P2P - Transferred to Autumn Mark -> AN: 87654322 SC:334345', 0, 10.5, 8458.5),
(28, '2018-04-03 20:34:09', 'P2P - Transferred to Autumn Mark -> AN: 87654322 SC:334345', 0, 8.5, 8450),
(29, '2018-04-03 20:34:45', 'P2P - Transferred to Autumn Mark -> AN: 87654322 SC:334345', 0, 0.99, 8449.01),
(30, '2018-04-03 20:39:37', 'P2P - Transferred to Spring Luke -> AN: 87654321 SC:112233', 0, 20.99, 8428.02),
(31, '2018-04-04 14:24:55', 'P2P - Received from  Pasqua Elisa -> AN: 87654328 SC:154987', 0.55, 0, 8428.57),
(32, '2018-04-04 16:24:10', 'P2P - Cash withdrawl Matthew Winter -> AN: 87654320 SC: 223344', 0, 150.55, 8278.02),
(33, '2018-04-06 14:13:38', 'P2P - Transferred to Autumn Mark -> AN: 87654322 SC:334345', 0, 20, 8258.02),
(34, '2018-04-06 15:38:57', 'P2P - Cash withdrawl Matthew Winter -> AN: 87654320 SC: 223344', 0, 0.55, 8257.47),
(35, '2018-04-09 21:19:50', 'P2P - Cash withdrawl Matthew Winter -> AN: 87654320 SC: 223344', 0, 0, 8257.47),
(36, '2018-04-09 21:21:15', 'P2P - Cash withdrawl Matthew Winter -> AN: 87654320 SC: 223344', 0, 5.5, 8251.97),
(37, '2018-04-14 16:06:18', 'P2P - Cash withdrawl Matthew Winter -> AN: 87654320 SC: 223344', 0, 51, 8200.97),
(38, '2018-04-17 23:04:37', 'P2P - Cash withdrawl Matthew Winter -> AN: 87654320 SC: 223344', 0, 55, 8145.97),
(39, '2018-04-25 15:34:07', 'P2P - Transferred to Spring Luke -> AN: 84154886 SC:112233', 0, 44.55, 8101.42),
(40, '2018-05-09 14:35:26', 'P2P - Transferred to Spring Luke -> AN: 84154886 SC:112233', 0, 85.6, 8015.82),
(41, '2018-05-15 22:13:46', 'P2P - Transferred to Spring Luke -> AN: 84154886 SC:112233', 0, 12, 8003.82);

-- --------------------------------------------------------

--
-- Table structure for table `bookkeeping_c2`
--

CREATE TABLE `bookkeeping_c2` (
  `transaction_id` int(12) NOT NULL,
  `date_time` datetime NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `money_in` float NOT NULL,
  `money_out` float NOT NULL,
  `bank_balance` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookkeeping_c2`
--

INSERT INTO `bookkeeping_c2` (`transaction_id`, `date_time`, `description`, `money_in`, `money_out`, `bank_balance`) VALUES
(1, '2018-04-17 23:32:27', 'Opening Balance', 1000, 0, 1000),
(2, '2018-04-25 15:34:07', 'P2P - Received from  Winter Matthew -> AN: 87654320 SC:223344', 44.55, 0, 1044.55),
(3, '2018-05-09 14:35:26', 'P2P - Received from  Winter Matthew -> AN: 87654320 SC:223344', 85.6, 0, 1130.15),
(4, '2018-05-15 22:13:46', 'P2P - Received from  Winter Matthew -> AN: 87654320 SC:223344', 12, 0, 1142.15);

-- --------------------------------------------------------

--
-- Table structure for table `bookkeeping_c3`
--

CREATE TABLE `bookkeeping_c3` (
  `transaction_id` int(12) NOT NULL,
  `date_time` datetime NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `money_in` float NOT NULL,
  `money_out` float NOT NULL,
  `bank_balance` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookkeeping_c3`
--

INSERT INTO `bookkeeping_c3` (`transaction_id`, `date_time`, `description`, `money_in`, `money_out`, `bank_balance`) VALUES
(1, '2018-04-25 11:14:14', 'Opening Balance', 1000, 0, 1000);

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `client_id` int(12) NOT NULL,
  `firstname` varchar(35) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` varchar(35) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `d_o_b` date NOT NULL,
  `sex` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `p_a_n` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(35) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_num` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `account_num` int(8) NOT NULL,
  `sort_code` int(6) NOT NULL,
  `pin` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(35) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`client_id`, `firstname`, `surname`, `d_o_b`, `sex`, `p_a_n`, `email`, `phone_num`, `address`, `account_num`, `sort_code`, `pin`, `username`, `password`) VALUES
(1, 'Matthew', 'Winter', '1993-05-11', 'male', '$2y$10$URInMRN1cJtDUq.J42vf5Op6QhBjHhPDAuFH/2ztmyUNFtlm4OhvG', 'matthew.winter@projectY.com', '07584879562', 'Apartment 46, Gospel Street\r\nB348DW, Birmingham, UK', 87654320, 223344, '$2y$10$CQI7OCp1TP1O1EsObXDbjO5BDdeMa5QItXn3c4m34W4UegH.9F8AS', 'Matt123', '$2y$10$.QEn.at0qFWXUBb80RbzD.S5EG/DKdZHGAWmMvx6qc1oImrMlO/t6'),
(2, 'Luke', 'Spring', '1994-12-11', 'male', '$2y$10$snvVL6cz1vhZRKVAr2SOeuNZxOYxfsA/P0nmEMYxr3z04h9mv0Sge', 'luke.spring@projectY.com', '07598845665', 'Apartment 46, Gospel Street\r\nB348DW, Birmingham, UK', 84154886, 112233, '$2y$10$A2oX9c4b4yTrC76o2i9BGu1IrjKLTWeCZ50BWjImuGTGGfG/FgBNC', 'Luke123', '$2y$10$zN4OqAfdtdgBdmyT3pStee004KU6arAqYOo6HqTZut3PW0l./UATS'),
(3, 'Mark', 'Autumn', '1988-05-05', 'male', '$2y$10$vD9vkJdYAlTFHZ0NSx25jOGLXf.XXpAU9czu1vquPID0dYR1OhLtq', 'mark.autumn@projectY.com', '0751484584', 'Apartment 3, Garden Street\r\nB037JS, London,UK', 87654323, 548965, '$2y$10$dDGfyef.6yZoUEUYi3tL6urh3N8YWV3FG8MFcJ16cSQjDMak5omGi', 'Mark123', '$2y$10$mJxBhqqm1yHFtnbk/TTnp.RwkugPYKYpLZS1gTD0lRW/w9ytn6aLe');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `beneficiary_c1`
--
ALTER TABLE `beneficiary_c1`
  ADD PRIMARY KEY (`beneficiary_id`),
  ADD UNIQUE KEY `beneficiary_client_id_2` (`beneficiary_client_id`),
  ADD UNIQUE KEY `account_num_2` (`account_num`),
  ADD UNIQUE KEY `sort_code` (`sort_code`),
  ADD KEY `beneficiary_client_id` (`beneficiary_client_id`),
  ADD KEY `account_num` (`account_num`,`sort_code`);

--
-- Indexes for table `beneficiary_c2`
--
ALTER TABLE `beneficiary_c2`
  ADD PRIMARY KEY (`beneficiary_id`),
  ADD UNIQUE KEY `beneficiary_client_id` (`beneficiary_client_id`),
  ADD UNIQUE KEY `account_num` (`account_num`),
  ADD UNIQUE KEY `sort_code` (`sort_code`);

--
-- Indexes for table `beneficiary_c3`
--
ALTER TABLE `beneficiary_c3`
  ADD PRIMARY KEY (`beneficiary_id`),
  ADD UNIQUE KEY `beneficiary_client_id` (`beneficiary_client_id`),
  ADD UNIQUE KEY `account_num` (`account_num`),
  ADD UNIQUE KEY `sort_code` (`sort_code`);

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
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`client_id`),
  ADD UNIQUE KEY `sort_code` (`sort_code`),
  ADD UNIQUE KEY `account_num_2` (`account_num`),
  ADD UNIQUE KEY `username_2` (`username`),
  ADD KEY `p_a_n` (`p_a_n`(191)),
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
  MODIFY `beneficiary_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `beneficiary_c2`
--
ALTER TABLE `beneficiary_c2`
  MODIFY `beneficiary_id` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `beneficiary_c3`
--
ALTER TABLE `beneficiary_c3`
  MODIFY `beneficiary_id` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bookkeeping_c1`
--
ALTER TABLE `bookkeeping_c1`
  MODIFY `transaction_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `bookkeeping_c2`
--
ALTER TABLE `bookkeeping_c2`
  MODIFY `transaction_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `bookkeeping_c3`
--
ALTER TABLE `bookkeeping_c3`
  MODIFY `transaction_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `client_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
