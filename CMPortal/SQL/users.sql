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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) UNSIGNED NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `password_recover` int(1) NOT NULL DEFAULT '0',
  `active` varchar(32) NOT NULL DEFAULT '0',
  `first_name` varchar(32) NOT NULL,
  `last_name` varchar(32) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `date_of_birth` date NOT NULL,
  `email` varchar(1024) NOT NULL,
  `phone` bigint(10) NOT NULL,
  `address1` varchar(35) DEFAULT NULL,
  `address2` varchar(35) DEFAULT NULL,
  `address3` varchar(35) DEFAULT NULL,
  `state` varchar(32) NOT NULL,
  `city` varchar(32) NOT NULL,
  `pincode` int(6) NOT NULL,
  `profile` varchar(1024) NOT NULL,
  `admin` int(1) NOT NULL DEFAULT '0',
  `deactivate_date` date NOT NULL DEFAULT '0000-00-00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `password_recover`, `active`, `first_name`, `last_name`, `gender`, `date_of_birth`, `email`, `phone`, `address1`, `address2`, `address3`, `state`, `city`, `pincode`, `profile`, `admin`, `deactivate_date`) VALUES
(1, 'user1', 'dd4b21e9ef71e1291183a46b913ae6f2', 0, '1', 'Sudip', 'Saha', 'male', '1995-09-19', 'saha.sudip.app@gmail.com', 8013157957, 'Balaka Sangha, Duttapukur', 'Near Railway Watertank', 'North 24 Parganas', 'West Bengal', 'Barasat', 743248, 'https://ucarecdn.com/2364b1c4-a0b9-47fe-a253-a1175e6353f4/-/crop/257x257/51,0/-/preview/', 1, '0000-00-00'),
(2, 'user2', 'dd4b21e9ef71e1291183a46b913ae6f2', 0, '1', 'Subhojit', 'Goswami', 'male', '1996-03-16', 'goswamisubhojit1947@gmail.com', 8584020186, 'Basundhara Apartment, Ghospara', 'Barrackpore', 'North 24 Parganas', 'West Bengal', 'Barrackpore', 700120, 'https://ucarecdn.com/bf16fca6-9251-4275-a83c-7ec9f9734026/-/crop/480x481/0,48/-/preview/', 1, '2017-06-23'),
(3, 'user3', 'dd4b21e9ef71e1291183a46b913ae6f2', 0, '1', 'Souvik', 'Dey', 'male', '1994-09-24', 'deysouvik199@rediffmail.com', 8697874671, 'Chiriya More', '', 'North 24 Parganas', 'West Bengal', 'Barrackpore', 700120, 'https://ucarecdn.com/19015c13-f2a9-479a-b635-464a66b4437d/', 0, '2017-05-15'),
(4, 'user4', 'dd4b21e9ef71e1291183a46b913ae6f2', 0, '1', 'Simran', 'Agarwall', 'female', '1994-05-18', 'simran.agarwall1805@gmail.com', 8820598230, '', '', '', 'West Bengal', 'Kolkata', 711315, 'https://ucarecdn.com/22d6cef1-ce36-4c53-999e-65777acd48e1/-/crop/346x346/0,94/-/preview/', 0, '0000-00-00'),
(5, 'user5', 'dd4b21e9ef71e1291183a46b913ae6f2', 0, '0', 'Subhrangshu', 'Paul', 'male', '1994-11-04', 'subhrangshu47@gmail.com', 7687888331, 'Srijoni Palli', 'Duttapukur Station Road', 'Near Duttapukur Western Union', 'West Bengal', 'Barasat', 743248, '', 0, '0000-00-00'),
(6, 'user6', 'dd4b21e9ef71e1291183a46b913ae6f2', 0, '0', 'Souvik', 'Mondal', 'male', '1994-07-20', 'souvikmondal15@gmail.com', 8981704087, 'Ganganagar', 'Doltala', '', 'West Bengal', 'Kolkata', 700129, '', 0, '0000-00-00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
