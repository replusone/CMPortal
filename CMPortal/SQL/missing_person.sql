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
-- Table structure for table `missing_person`
--

CREATE TABLE `missing_person` (
  `id` int(11) NOT NULL,
  `full_name` varchar(64) NOT NULL,
  `place_of_birth` varchar(32) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `physical_desc` varchar(1024) DEFAULT NULL,
  `last_seen` varchar(512) DEFAULT NULL,
  `picture` varchar(256) DEFAULT NULL,
  `voter_id` varchar(10) DEFAULT NULL,
  `aadhaar_id` varchar(12) DEFAULT NULL,
  `other_details` varchar(1024) DEFAULT NULL,
  `user_email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `missing_person`
--

INSERT INTO `missing_person` (`id`, `full_name`, `place_of_birth`, `date_of_birth`, `physical_desc`, `last_seen`, `picture`, `voter_id`, `aadhaar_id`, `other_details`, `user_email`) VALUES
(1, 'Prajwal Kumar', 'Barasat', '1961-04-14', 'Tall, Stout figure, Light-brown skin tone, Light facial Hair', 'Barasat, Champadali More, 11-02-2017', 'images/missing/21802b471b.jpg', 'TIQ4987ID9', '725485664589', '', 'saha.sudip.app@gmail.com'),
(2, 'Subho Haldar', 'Banglore', '1976-02-20', 'Medium height, Skinny figure, Dark-brown skin tone', 'Vhishannagar, Chindi More, 12-02-2005', 'images/missing/f4c3aa376a.jpg', 'TIQ4546464', '456278565458', '', 'saha.sudip.app@gmail.com'),
(3, 'Rakhal Mukherjee', 'Barrackpore', '1985-05-14', 'Tall, Healthy, Dark-brown skin tone', 'Barrackpore, Chiriya More, 15-02-2017', 'images/missing/e0d21039e9.jpg', 'TIQ4304903', '745688554745', '', 'saha.sudip.app@gmail.com'),
(4, 'Laksman Patel', 'Begusarai', '1988-10-04', 'Short height, Light-brown skin tone, Big fuzzy hair', 'Katre Vihar, 12-02-2017', 'images/missing/5e06493773.jpg', 'TIQ5305646', '465466876546', '', 'saha.sudip.app@gmail.com'),
(5, 'Sahin Molla', 'Barasat', '1983-09-21', 'Medium height, Light-brown skin-tone, Curly hair', 'Duttapukur, Hathkhola More, 15-08-2016', 'images/missing/6d002c8b50.jpg', 'TIQ3958353', '745232245499', '', 'saha.sudip.app@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `missing_person`
--
ALTER TABLE `missing_person`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `missing_person`
--
ALTER TABLE `missing_person`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
