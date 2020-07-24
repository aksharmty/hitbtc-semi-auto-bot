-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 24, 2020 at 03:14 AM
-- Server version: 5.6.41-84.1
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ishwakbi_bot`
--

-- --------------------------------------------------------

--
-- Table structure for table `trade2`
--

CREATE TABLE `trade2` (
  `id` int(225) NOT NULL,
  `pair` varchar(100) NOT NULL,
  `currency` varchar(225) NOT NULL,
  `price` varchar(225) NOT NULL,
  `sell` varchar(50) NOT NULL,
  `sellprice` varchar(225) NOT NULL,
  `type` varchar(50) NOT NULL,
  `quantity` varchar(50) NOT NULL,
  `lastbal` varchar(50) NOT NULL,
  `selldate` varchar(50) NOT NULL,
  `dlastbal` varchar(50) NOT NULL,
  `date` datetime NOT NULL,
  `clientOrderId` varchar(225) NOT NULL,
  `rsilow` varchar(50) NOT NULL,
  `rsihigh` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `trade2`
--
ALTER TABLE `trade2`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `trade2`
--
ALTER TABLE `trade2`
  MODIFY `id` int(225) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
