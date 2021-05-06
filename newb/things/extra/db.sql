-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 02, 2020 at 04:20 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `2`
--

-- --------------------------------------------------------

--
-- Table structure for table `all_notif`
--

CREATE TABLE `all_notif` (
  `notif_id` int(11) NOT NULL,
  `sms_not` varchar(60) NOT NULL,
  `log_not` varchar(60) NOT NULL,
  `trans_not` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `all_notif`
--

INSERT INTO `all_notif` (`notif_id`, `sms_not`, `log_not`, `trans_not`) VALUES
(1, 'Not Available', 'On', 'On');

-- --------------------------------------------------------

--
-- Table structure for table `auth_otp`
--

CREATE TABLE `auth_otp` (
  `id` int(11) NOT NULL,
  `otp` varchar(10) CHARACTER SET latin1 NOT NULL,
  `expired` int(11) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `bill_code`
--

CREATE TABLE `bill_code` (
  `code_stage_id` int(11) NOT NULL,
  `stage_name` varchar(90) NOT NULL DEFAULT '',
  `stage_n` varchar(90) NOT NULL DEFAULT '',
  `code_n` varchar(90) NOT NULL DEFAULT '',
  `date_cr` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bill_stage`
--

CREATE TABLE `bill_stage` (
  `bill_stage_id` int(11) NOT NULL,
  `stage_name` varchar(90) NOT NULL DEFAULT '',
  `stage_n` varchar(90) NOT NULL DEFAULT '',
  `date_cr` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `credit_info`
--

CREATE TABLE `credit_info` (
  `transact_id` int(11) NOT NULL,
  `payee_name` varchar(60) NOT NULL DEFAULT '',
  `payee_accnt` varchar(100) NOT NULL DEFAULT '',
  `cust_name` varchar(60) NOT NULL DEFAULT '',
  `accnt_nmb` varchar(60) NOT NULL DEFAULT '',
  `trans_type` varchar(60) NOT NULL DEFAULT '',
  `narratn` text NOT NULL,
  `amt_cred` varchar(90) NOT NULL DEFAULT '',
  `amt_dep` varchar(90) NOT NULL DEFAULT '',
  `dat_pay` varchar(60) NOT NULL DEFAULT '',
  `email` varchar(60) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `curr_type`
--

CREATE TABLE `curr_type` (
  `curr_id` int(11) NOT NULL,
  `accnt_nmb` varchar(90) NOT NULL DEFAULT '',
  `curr_type` varchar(90) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Table structure for table `customer_info`
--

CREATE TABLE `customer_info` (
  `customer_id` int(11) NOT NULL,
  `cust_name` varchar(60) NOT NULL DEFAULT '',
  `email` varchar(60) NOT NULL DEFAULT '',
  `phn_nmb` varchar(60) NOT NULL DEFAULT '',
  `addrs` varchar(60) NOT NULL DEFAULT '',
  `username` varchar(60) NOT NULL DEFAULT '',
  `pass` varchar(60) NOT NULL DEFAULT '',
  `day_birth` date NOT NULL DEFAULT '0000-00-00',
  `country` varchar(60) NOT NULL DEFAULT '',
  `acct_nmb` varchar(60) NOT NULL DEFAULT '',
  `zip_code` varchar(60) NOT NULL DEFAULT '',
  `swift_code` varchar(90) NOT NULL DEFAULT '',
  `cust_photo` text NOT NULL,
  `current_log_time` varchar(90) NOT NULL DEFAULT '',
  `last_log_time` varchar(90) NOT NULL DEFAULT '',    
  `cust_trans_stat` varchar(90) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transfer_info`
--

CREATE TABLE `transfer_info` (
  `trans_id` int(11) NOT NULL,
  `acct_nmb` varchar(60) NOT NULL DEFAULT '',
  `to_accnt` varchar(60) NOT NULL DEFAULT '',
  `ben_name` varchar(60) NOT NULL DEFAULT '',
  `ben_phn` varchar(60) NOT NULL DEFAULT '',
  `bank_name` varchar(60) NOT NULL DEFAULT '',
  `country_user` varchar(90) NOT NULL DEFAULT '',
  `swift_code` varchar(60) NOT NULL DEFAULT '',
  `sort_code` varchar(60) NOT NULL DEFAULT '',
  `amt_trans` varchar(60) NOT NULL DEFAULT '',
  `trans_stat` varchar(60) NOT NULL DEFAULT '',
  `date_trans` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_table`
--

CREATE TABLE `user_table` (
  `user_id` int(11) NOT NULL,
  `cust_id` int(11) NOT NULL DEFAULT 0,
  `fullname` varchar(60) NOT NULL DEFAULT '',
  `sexs` varchar(60) NOT NULL DEFAULT '',
  `addrs` varchar(60) NOT NULL DEFAULT '',
  `email` varchar(60) NOT NULL DEFAULT '',
  `phn_nmb` varchar(60) NOT NULL DEFAULT '',
  `username` varchar(60) NOT NULL DEFAULT '',
  `pass` varchar(90) NOT NULL DEFAULT '',
  `access_lvl` varchar(90) NOT NULL DEFAULT '',
  `forgot_pass_identity` varchar(32) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `status` enum('1','0') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `otp_status` varchar(99) DEFAULT NULL,
  `suspend_status` varchar(60) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_table`
--

INSERT INTO `user_table` (`user_id`, `cust_id`, `fullname`, `sexs`, `addrs`, `email`, `phn_nmb`, `username`, `pass`, `access_lvl`, `forgot_pass_identity`, `created`, `modified`, `status`, `otp_status`, `suspend_status`) VALUES
(1, 0, 'ADMINISTRATION', 'NILL', 'NILL', '', 'NILL', 'admin', 'admin1234', '3', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', '', ''),
(2, 0, 'ADMINISTRATION', 'NILL', 'NILL', '', 'NILL', 'admin', '1234', '3', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `all_notif`
--
ALTER TABLE `all_notif`
  ADD PRIMARY KEY (`notif_id`);

--
-- Indexes for table `bill_code`
--
ALTER TABLE `bill_code`
  ADD PRIMARY KEY (`code_stage_id`);

--
-- Indexes for table `bill_stage`
--
ALTER TABLE `bill_stage`
  ADD PRIMARY KEY (`bill_stage_id`);

--
-- Indexes for table `credit_info`
--
ALTER TABLE `credit_info`
  ADD PRIMARY KEY (`transact_id`);

--
-- Indexes for table `curr_type`
--
ALTER TABLE `curr_type`
  ADD PRIMARY KEY (`curr_id`);

--
-- Indexes for table `customer_info`
--
ALTER TABLE `customer_info`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `transfer_info`
--
ALTER TABLE `transfer_info`
  ADD PRIMARY KEY (`trans_id`);

--
-- Indexes for table `user_table`
--
ALTER TABLE `user_table`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `all_notif`
--
ALTER TABLE `all_notif`
  MODIFY `notif_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bill_code`
--
ALTER TABLE `bill_code`
  MODIFY `code_stage_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bill_stage`
--
ALTER TABLE `bill_stage`
  MODIFY `bill_stage_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `credit_info`
--
ALTER TABLE `credit_info`
  MODIFY `transact_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `curr_type`
--
ALTER TABLE `curr_type`
  MODIFY `curr_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_info`
--
ALTER TABLE `customer_info`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transfer_info`
--
ALTER TABLE `transfer_info`
  MODIFY `trans_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_table`
--
ALTER TABLE `user_table`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
