-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 06, 2018 at 06:31 AM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `phone`, `password`) VALUES
(1, 'Shashank Vaibhav', '7992250559', 'happy'),
(2, 'Ranjan Kumar Jha', '8521438777', 'ranjan'),
(3, 'a', 'a', 'a');

-- --------------------------------------------------------

--
-- Table structure for table `attendence`
--

DROP TABLE IF EXISTS `attendence`;
CREATE TABLE IF NOT EXISTS `attendence` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lid` int(11) NOT NULL,
  `date` date NOT NULL,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attendence`
--

INSERT INTO `attendence` (`id`, `lid`, `date`, `status`) VALUES
(1, 1, '2018-05-27', 'PRESENT'),
(2, 1, '2018-05-25', 'PRESENT'),
(3, 2, '2018-05-27', 'PRESENT'),
(4, 1, '2018-05-29', 'PRESENT'),
(5, 2, '2018-05-29', 'PRESENT'),
(6, 2, '2018-05-30', 'PRESENT'),
(7, 1, '2018-05-30', 'PRESENT'),
(8, 10, '2018-05-31', 'PRESENT'),
(9, 1, '2018-05-31', 'PRESENT'),
(10, 2, '2018-05-31', 'PRESENT'),
(11, 1, '2018-06-05', 'PRESENT'),
(12, 2, '2018-06-05', 'PRESENT'),
(13, 1, '2018-06-06', 'PRESENT'),
(14, 2, '2018-06-06', 'PRESENT');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

DROP TABLE IF EXISTS `login`;
CREATE TABLE IF NOT EXISTS `login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `college` varchar(100) NOT NULL,
  `registration` varchar(50) NOT NULL,
  `semester` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `name`, `college`, `registration`, `semester`, `phone`, `password`) VALUES
(1, 'Shashank Vaibhav', 'College of Engineering Bhubaneswar', '1501219164', '7th', '7992250559', 'happy'),
(2, 'Ranjan Kumar Jha', 'College of Engineering Bhubaneswar', '1501219114', '7th', '8521438777', 'ranjan'),
(10, 'a', 'a', 'a', 'a', 'a', 'a');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
