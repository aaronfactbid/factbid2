-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 04, 2023 at 01:49 PM
-- Server version: 10.3.37-MariaDB-0ubuntu0.20.04.1
-- PHP Version: 7.4.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `factbid`
--

-- --------------------------------------------------------

--
-- Table structure for table `bid`
--

CREATE TABLE `bid` (
  `id_bid` int(11) NOT NULL,
  `id_hashtag` int(11) DEFAULT NULL,
  `author` varchar(30) DEFAULT NULL,
  `author_id` varchar(50) DEFAULT NULL,
  `tweet_id` varchar(50) DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  `currency` varchar(4) DEFAULT NULL,
  `amount` int(11) UNSIGNED DEFAULT NULL,
  `sort` int(11) UNSIGNED DEFAULT NULL,
  `exclude` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `claim`
--

CREATE TABLE `claim` (
  `id_claim` int(11) UNSIGNED NOT NULL,
  `id_hashtag` int(11) UNSIGNED DEFAULT NULL,
  `author` varchar(30) DEFAULT NULL,
  `author_id` varchar(30) DEFAULT NULL,
  `tweet_id` varchar(50) DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  `sort` int(11) DEFAULT NULL,
  `exclude` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hashtag`
--

CREATE TABLE `hashtag` (
  `id_hashtag` int(11) UNSIGNED NOT NULL,
  `hashtag` varchar(50) NOT NULL,
  `author` varchar(50) NOT NULL,
  `bids` int(11) UNSIGNED DEFAULT NULL,
  `total` int(11) UNSIGNED DEFAULT NULL,
  `claims` int(11) UNSIGNED DEFAULT NULL,
  `author_id` varchar(30) DEFAULT NULL,
  `tweet_id` varchar(30) DEFAULT NULL,
  `title` varchar(270) DEFAULT NULL,
  `sort` int(11) UNSIGNED DEFAULT NULL,
  `exclude` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hashtag`
--

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bid`
--
ALTER TABLE `bid`
  ADD PRIMARY KEY (`id_bid`),
  ADD KEY `id_hashtag` (`id_hashtag`,`sort`);

--
-- Indexes for table `claim`
--
ALTER TABLE `claim`
  ADD PRIMARY KEY (`id_claim`);

--
-- Indexes for table `hashtag`
--
ALTER TABLE `hashtag`
  ADD PRIMARY KEY (`id_hashtag`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bid`
--
ALTER TABLE `bid`
  MODIFY `id_bid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `claim`
--
ALTER TABLE `claim`
  MODIFY `id_claim` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hashtag`
--
ALTER TABLE `hashtag`
  MODIFY `id_hashtag` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
