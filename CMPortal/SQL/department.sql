-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2017 at 07:30 PM
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
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `user_id` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `password_recover` int(1) NOT NULL DEFAULT '0',
  `first_name` varchar(32) NOT NULL,
  `last_name` varchar(32) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` bigint(10) NOT NULL,
  `badge_no` varchar(12) NOT NULL,
  `state` varchar(32) NOT NULL,
  `city` varchar(32) NOT NULL,
  `profile` varchar(1024) NOT NULL,
  `admin` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`user_id`, `username`, `password`, `password_recover`, `first_name`, `last_name`, `email`, `phone`, `badge_no`, `state`, `city`, `profile`, `admin`) VALUES
(1, 'user1', 'dd4b21e9ef71e1291183a46b913ae6f2', 0, 'Souvik', 'Bhattachrya', 'souvik.new.me@gmail.com', 8981987025, 'SP405FT95888', 'West Bengal', 'Barasat', 'https://ucarecdn.com/c4ddb9fd-207e-4098-a1c6-76c8f27fa668/-/crop/326x326/128,0/-/preview/', 0),
(2, 'user2', 'dd4b21e9ef71e1291183a46b913ae6f2', 0, 'Sucheta', 'Gupta', 'suchetagupta100@gmail.com', 9674152548, 'SP0453GHK593', 'West Bengal', 'Kolkata', 'https://ucarecdn.com/0f625106-d498-4236-8cac-b3a023c1d0a7/-/crop/249x249/73,47/-/preview/', 0),
(3, 'user3', 'dd4b21e9ef71e1291183a46b913ae6f2', 0, 'Arpan', 'Paul', 'arpanaizy@gmail.com', 8981045908, 'J654HDJOIHDD', 'West Bengal', 'Barrackpore', 'https://ucarecdn.com/ba56963c-63b0-44dc-b06a-c00839fa1bd5/-/crop/140x140/157,74/-/preview/', 0),
(4, 'user4', 'dd4b21e9ef71e1291183a46b913ae6f2', 0, 'Rahul', 'Joshi', 'saha.sudip.4.9@gmail.com', 8296267430, 'FTFCT2654498', 'West Bengal', 'Kolkata', 'https://ucarecdn.com/0e3a9e47-7eef-4e15-8bc3-1e6282de5793/-/crop/223x223/86,30/-/preview/', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
