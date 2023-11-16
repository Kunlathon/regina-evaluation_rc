-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 25, 2023 at 06:47 AM
-- Server version: 8.0.27
-- PHP Version: 8.0.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rc_summer`
--

-- --------------------------------------------------------

--
-- Table structure for table `system_summer`
--

CREATE TABLE `system_summer` (
  `ss_id` int NOT NULL,
  `test_system` enum('OFF','ON') COLLATE utf8mb4_unicode_ci NOT NULL,
  `OFFONDateTime` datetime NOT NULL,
  `EndDateTime` datetime NOT NULL,
  `data_yaer` int NOT NULL,
  `data_term` int NOT NULL,
  `data_summer` int NOT NULL,
  `time_add` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `system_summer`
--

INSERT INTO `system_summer` (`ss_id`, `test_system`, `OFFONDateTime`, `EndDateTime`, `data_yaer`, `data_term`, `data_summer`, `time_add`) VALUES
(2023900401, 'ON', '2023-01-19 08:00:00', '2023-01-30 00:00:00', 2566, 1, 2566, '2023-01-24 13:58:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `system_summer`
--
ALTER TABLE `system_summer`
  ADD PRIMARY KEY (`ss_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
