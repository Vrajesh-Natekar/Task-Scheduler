-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 09, 2021 at 07:53 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `task_scheduler`
--

-- --------------------------------------------------------

--
-- Table structure for table `task_scheduler`
--

CREATE TABLE `task_scheduler` (
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `task_scheduler`
--

INSERT INTO `task_scheduler` (`date`, `start_time`, `end_time`, `comment`) VALUES
('2021-07-07', '03:30:00', '03:40:00', 'client'),
('2021-07-07', '15:50:00', '16:00:00', 'Client 2 meeting'),
('2021-07-07', '16:00:00', '16:10:00', 'client 3 meeting'),
('2021-07-09', '12:00:00', '13:00:00', 'Client 3 Meeting'),
('2021-07-10', '10:20:00', '10:30:00', 'A small talk'),
('2021-07-09', '11:00:00', '11:30:00', 'Mathematics Lecture'),
('2021-07-09', '09:00:00', '11:00:00', 'Sample test');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
