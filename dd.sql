-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 09, 2017 at 09:56 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bw`
--

-- --------------------------------------------------------

--
-- Table structure for table `inf_applications`
--

CREATE TABLE `inf_applications` (
  `application_id` int(11) NOT NULL,
  `application_userid` int(11) NOT NULL,
  `application_code` varchar(64) NOT NULL,
  `application_type` int(11) NOT NULL,
  `application_faction` int(11) NOT NULL DEFAULT '0',
  `application_status` int(11) NOT NULL DEFAULT '0',
  `application_questions` text NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `inf_complaints`
--

CREATE TABLE `inf_complaints` (
  `complaint_id` int(11) NOT NULL,
  `complaint_userid` int(11) NOT NULL,
  `complaint_foruserid` int(11) NOT NULL,
  `complaint_code` varchar(32) NOT NULL,
  `complaint_status` int(11) NOT NULL DEFAULT '0',
  `complaint_type` int(11) NOT NULL,
  `complaint_faction` int(11) NOT NULL DEFAULT '0',
  `complaint_reason` text NOT NULL,
  `complaint_description` text NOT NULL,
  `complaint_proof` varchar(128) NOT NULL,
  `complaint_comments` text NOT NULL,
  `complaint_action` varchar(32) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `inf_options`
--

CREATE TABLE `inf_options` (
  `option_id` int(11) NOT NULL,
  `option_name` varchar(32) NOT NULL,
  `option_value` text NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `inf_options` (`option_id`, `option_name`, `option_value`, `updated_at`, `created_at`) VALUES
(1, 'factionQuestions', '["Cate ore poti fi activ pe server?", "De ce doriti sa intrati in aceasta factiune?", "Sunteti de acord sa stati minim 1 saptamana in aceasta factiune?", "Ati citit Regulamentul?", "Veti respecta membrii ce au rank-ul mai mare si leaderul?", "Alte precizari aveti ?"]', '2016-12-04 02:25:59', '0000-00-00 00:00:00'),
(2, 'leaderQuestions', '["ad","asd?","te?","asd"]', '2017-01-14 17:48:15', '0000-00-00 00:00:00'),
(3, 'helperQuestions', '["helper111?","helepr222???","dsds","test?","ddd"]', '2017-01-14 17:37:51', '0000-00-00 00:00:00'),
(4, 'factionQuestions2', '["Cate ore poti fi activ pe server?","De ce doriti sa intrati in aceasta factiune?","Sunteti de acord sa stati minim 1 saptamana in aceasta factiune?","Ati citit Regulamentul?","Veti respecta membrii ce au rank-ul mai mare si leaderul?","Alte precizari aveti ?","dd","dddd"]', '2017-01-01 10:19:44', '0000-00-00 00:00:00'),
(5, 'leaderAppStatus', '0', '2017-01-14 17:47:18', '0000-00-00 00:00:00'),
(6, 'helperAppStatus', '0', '2017-01-14 17:47:15', '0000-00-00 00:00:00');
-- --------------------------------------------------------

--
-- Table structure for table `inf_tickets`
--

CREATE TABLE `inf_tickets` (
  `ticket_id` int(11) NOT NULL,
  `ticket_userid` int(11) NOT NULL,
  `ticket_code` varchar(64) NOT NULL,
  `ticket_status` int(11) NOT NULL DEFAULT '0',
  `ticket_type` text NOT NULL,
  `ticket_description` text NOT NULL,
  `ticket_comments` text NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `inf_unban`
--

CREATE TABLE `inf_unban` (
  `unban_id` int(11) NOT NULL,
  `unban_userid` int(11) NOT NULL,
  `unban_status` int(11) NOT NULL DEFAULT '0',
  `unban_code` varchar(32) NOT NULL,
  `unban_img` varchar(128) NOT NULL,
  `unban_reason` varchar(128) NOT NULL,
  `unban_description` text NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 09, 2017 at 11:23 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bw1`
--

-- --------------------------------------------------------

--
-- Table structure for table `emails`
--

CREATE TABLE `emails` (
  `ID` int(11) NOT NULL,
  `playerid` int(11) NOT NULL,
  `giverid` int(11) NOT NULL DEFAULT '0',
  `Message` varchar(500) NOT NULL,
  `EmailRead` int(11) NOT NULL DEFAULT '1',
  `LinkPanel` text NOT NULL,
  `Time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `emails`
--

--
-- Indexes for dumped tables
--

--
-- Indexes for table `emails`
--
ALTER TABLE `emails`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `emails`
--
ALTER TABLE `emails`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `inf_applications`
--
ALTER TABLE `inf_applications`
  ADD PRIMARY KEY (`application_id`);

--
-- Indexes for table `inf_complaints`
--
ALTER TABLE `inf_complaints`
  ADD PRIMARY KEY (`complaint_id`);

--
-- Indexes for table `inf_options`
--
ALTER TABLE `inf_options`
  ADD PRIMARY KEY (`option_id`);

--
-- Indexes for table `inf_tickets`
--
ALTER TABLE `inf_tickets`
  ADD PRIMARY KEY (`ticket_id`);

--
-- Indexes for table `inf_unban`
--
ALTER TABLE `inf_unban`
  ADD PRIMARY KEY (`unban_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `inf_applications`
--
ALTER TABLE `inf_applications`
  MODIFY `application_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `inf_complaints`
--
ALTER TABLE `inf_complaints`
  MODIFY `complaint_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `inf_options`
--
ALTER TABLE `inf_options`
  MODIFY `option_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `inf_tickets`
--
ALTER TABLE `inf_tickets`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `inf_unban`
--
ALTER TABLE `inf_unban`
  MODIFY `unban_id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
