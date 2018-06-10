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
-- Table structure for table `fir`
--

CREATE TABLE `fir` (
  `fir_id` int(11) NOT NULL,
  `fir_no` varchar(13) NOT NULL,
  `crime_main` varchar(32) NOT NULL,
  `crime_sub` varchar(32) NOT NULL,
  `first_name` varchar(32) NOT NULL,
  `last_name` varchar(32) NOT NULL,
  `aadhaar_id` varchar(12) NOT NULL,
  `statement` varchar(2048) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_state` varchar(32) NOT NULL,
  `user_city` varchar(32) NOT NULL,
  `date` date NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fir`
--

INSERT INTO `fir` (`fir_id`, `fir_no`, `crime_main`, `crime_sub`, `first_name`, `last_name`, `aadhaar_id`, `statement`, `user_email`, `user_state`, `user_city`, `date`, `status`) VALUES
(1, 'FIR1496335996', 'Personal Crimes', 'Assault', 'Sudip', 'Saha', '785225853655', 'I was brutally assaulted by 3 unknown assailants.', 'saha.sudip.app@gmail.com', 'West Bengal', 'Barasat', '2017-06-01', 1),
(2, 'FIR1496336332', 'Personal Crimes', 'False Imprisonment', 'Subhojit', 'Goswami', '486646413534', 'I am being falsely accused and defamed of dubious circumstances.', 'goswamisubhojit1947@gmail.com', 'West Bengal', 'Barrackpore', '2017-06-01', 0),
(3, 'FIR1496336506', 'Personal Crimes', 'Assault', 'Souvik', 'Dey', '788952554545', 'I was brutally assaulted by 3 unknown assailants.', 'deysouvik199@rediffmail.com', 'West Bengal', 'Barrackpore', '2017-06-01', 0),
(4, 'FIR1496336577', 'Personal Crimes', 'False Imprisonment', 'Simran', 'Agarwall', '789556565646', 'I am being falsely accused and defamed of dubious circumstances.', 'simran.agarwall1805@gmail.com', 'West Bengal', 'Kolkata', '2017-06-01', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fir`
--
ALTER TABLE `fir`
  ADD PRIMARY KEY (`fir_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fir`
--
ALTER TABLE `fir`
  MODIFY `fir_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
