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
  `id_bid` int(11) NOT NULL AUTO_INCREMENT,
  `id_hashtag` int(11) DEFAULT NULL,
  `id_tweet` int(11) DEFAULT NULL,
  `author_username` varchar(255) DEFAULT NULL,
  `author_id` varchar(50) DEFAULT NULL,
  `id_twitter` varchar(30) DEFAULT NULL,
  `created_ts` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `currency` varchar(4) DEFAULT NULL,
  `amount` int(11) unsigned DEFAULT NULL,
  `sort` int(11) unsigned DEFAULT NULL,
  `exclude` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id_bid`),
  KEY `id_hashtag` (`id_hashtag`,`sort`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `claim`
--

CREATE TABLE `claim` (
  `id_claim` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_hashtag` int(11) unsigned DEFAULT NULL,
  `id_tweet` int(11) DEFAULT NULL,
  `author_username` varchar(255) DEFAULT NULL,
  `author_id` varchar(30) DEFAULT NULL,
  `id_twitter` varchar(30) DEFAULT NULL,
  `created_ts` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `sort` int(11) DEFAULT NULL,
  `exclude` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id_claim`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hashtag`
--

CREATE TABLE `hashtag` (
  `id_hashtag` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `hashtag` varchar(50) NOT NULL,
  `id_tweet` int(10) unsigned DEFAULT NULL,
  `author_username` varchar(255) DEFAULT NULL,
  `bids` int(11) unsigned DEFAULT NULL,
  `total` int(11) unsigned DEFAULT NULL,
  `claims` int(11) unsigned DEFAULT NULL,
  `author_id` varchar(30) DEFAULT NULL,
  `id_twitter` varchar(30) DEFAULT NULL,
  `created_ts` timestamp NULL DEFAULT NULL,
  `title` text DEFAULT NULL,
  `sort` int(11) unsigned DEFAULT NULL,
  `exclude` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id_hashtag`),
  UNIQUE KEY `hashtag` (`hashtag`),
  KEY `id_tweet` (`id_tweet`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
