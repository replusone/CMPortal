-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2017 at 07:31 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lr`
--

-- --------------------------------------------------------

--
-- Table structure for table `poll`
--

CREATE TABLE `poll` (
  `poll_id` int(10) UNSIGNED NOT NULL,
  `poll_topic` varchar(255) NOT NULL,
  `poll_state` varchar(32) NOT NULL,
  `poll_city` varchar(32) NOT NULL,
  `up_vote` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `down_vote` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `active` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `poll`
--

INSERT INTO `poll` (`poll_id`, `poll_topic`, `poll_state`, `poll_city`, `up_vote`, `down_vote`, `active`) VALUES
(1, 'A few new non-police members will be appointed to make a PC party team.', 'West Bengal', 'Kolkata', 2, 0, 1),
(2, 'No smoking in public from today midnight.', 'West Bengal', 'Kolkata', 0, 2, 1),
(3, 'Small bars/night clubs on the highways will be banned effectively from today midnight.', 'West Bengal', 'Barrackpore', 0, 2, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `poll`
--
ALTER TABLE `poll`
  ADD PRIMARY KEY (`poll_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `poll`
--
ALTER TABLE `poll`
  MODIFY `poll_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
