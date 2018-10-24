-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 24, 2018 at 09:26 AM
-- Server version: 5.5.60-MariaDB
-- PHP Version: 7.1.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `atm`
--

-- --------------------------------------------------------

--
-- Table structure for table `bank_note`
--

CREATE TABLE `bank_note` (
  `id` int(10) UNSIGNED NOT NULL,
  `bank_note_type` int(10) UNSIGNED NOT NULL,
  `amount` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bank_note`
--

INSERT INTO `bank_note` (`id`, `bank_note_type`, `amount`, `created_at`, `updated_at`) VALUES
(1, 20, 1000, '2018-10-23 05:15:17', '2018-10-23 06:54:53'),
(2, 50, 1000, '2018-10-23 05:15:17', '2018-10-23 06:50:56'),
(3, 100, 1000, '2018-10-23 05:15:18', '2018-10-23 06:50:56'),
(4, 500, 1000, '2018-10-23 05:15:18', '2018-10-23 06:54:47'),
(5, 1000, 1000, '2018-10-23 05:15:18', '2018-10-23 07:11:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bank_note`
--
ALTER TABLE `bank_note`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bank_note`
--
ALTER TABLE `bank_note`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
