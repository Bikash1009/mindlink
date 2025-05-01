-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 01, 2025 at 05:17 PM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mindlink`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

DROP TABLE IF EXISTS `activities`;
CREATE TABLE IF NOT EXISTS `activities` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `price` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`id`, `name`, `price`, `link`, `image`) VALUES
(1, 'How to Ease Anxiety ', 'This activity will show you the steps on how you can ease your anxiety. ', 'https://www.youtube.com/watch?v=RAtPZLTt-Xg&ab_channel=KHOU11', 'ac1.png'),
(2, 'No More Depression', 'This activity will guide you on how you can fight with your depression and start living with a healthy mental health.', 'https://www.youtube.com/watch?v=sWfNosruPPw&ab_channel=TherapyinaNutshell', 'acc4.jpg'),
(3, 'Enrich Perspective', 'This activity will help you to improve your way of thinking about every aspects in life.', 'https://www.youtube.com/watch?v=bEusrD8g-dM&ab_channel=TEDxTalks', 'ac2.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `aemail` varchar(255) NOT NULL,
  `apassword` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`aemail`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`aemail`, `apassword`) VALUES
('admin@gmail.com', '123');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

DROP TABLE IF EXISTS `appointment`;
CREATE TABLE IF NOT EXISTS `appointment` (
  `appoid` int NOT NULL AUTO_INCREMENT,
  `pid` int DEFAULT NULL,
  `apponum` int DEFAULT NULL,
  `scheduleid` int DEFAULT NULL,
  `appodate` date DEFAULT NULL,
  PRIMARY KEY (`appoid`),
  KEY `pid` (`pid`),
  KEY `scheduleid` (`scheduleid`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`appoid`, `pid`, `apponum`, `scheduleid`, `appodate`) VALUES
(1, 1, 1, 1, '2022-06-03'),
(8, 3, 1, 10, '2023-06-16');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `parent_id` int DEFAULT NULL,
  `comment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `sender` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

DROP TABLE IF EXISTS `doctor`;
CREATE TABLE IF NOT EXISTS `doctor` (
  `docid` int NOT NULL AUTO_INCREMENT,
  `docemail` varchar(255) DEFAULT NULL,
  `docname` varchar(255) DEFAULT NULL,
  `docpassword` varchar(255) DEFAULT NULL,
  `docnic` varchar(15) DEFAULT NULL,
  `doctel` varchar(15) DEFAULT NULL,
  `specialties` int DEFAULT NULL,
  PRIMARY KEY (`docid`),
  KEY `specialties` (`specialties`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`docid`, `docemail`, `docname`, `docpassword`, `docnic`, `doctel`, `specialties`) VALUES
(2, 'drmekhala@gmail.com', 'Dr Mekhala Sarker', '123', 'AD121234', '0102964440', 1),
(3, 'drali@gmail.com', 'Dr Ali Khan', '123', 'GH123343', '123124345', 7),
(4, 'drsaad@gmail.com', 'Dr Saad Rahman', '123', 'GH123343', '0102961112', 4);

-- --------------------------------------------------------

--
-- Table structure for table `moderator`
--

DROP TABLE IF EXISTS `moderator`;
CREATE TABLE IF NOT EXISTS `moderator` (
  `mid` int NOT NULL AUTO_INCREMENT,
  `memail` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `mname` varchar(255) DEFAULT NULL,
  `mpassword` varchar(255) DEFAULT NULL,
  `maddress` text,
  `mnic` varchar(20) DEFAULT NULL,
  `mdob` date DEFAULT NULL,
  `mtel` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`mid`),
  UNIQUE KEY `memail` (`memail`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `moderator`
--

INSERT INTO `moderator` (`mid`, `memail`, `mname`, `mpassword`, `maddress`, `mnic`, `mdob`, `mtel`) VALUES
(1, 'safal1@gmail.com', 'safal Acharya', 'safal', 'Pokhara-23', '', '0000-00-00', '0712345678');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `price` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `name`, `price`, `link`, `image`) VALUES
(1, 'Mental Health Awareness Fair', 'The Mental Health Awareness Fair is an event dedicated to promoting mental well-being, raising awareness about mental health issues, and fostering a supportive and inclusive community. ', 'https://hr.unm.edu/articles/newsletter/mental-health-awareness-fair-may-11', 'mental.png');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

DROP TABLE IF EXISTS `patient`;
CREATE TABLE IF NOT EXISTS `patient` (
  `pid` int NOT NULL AUTO_INCREMENT,
  `pemail` varchar(255) DEFAULT NULL,
  `pname` varchar(255) DEFAULT NULL,
  `ppassword` varchar(255) DEFAULT NULL,
  `paddress` varchar(255) DEFAULT NULL,
  `pnic` varchar(15) DEFAULT NULL,
  `pdob` date DEFAULT NULL,
  `ptel` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`pid`, `pemail`, `pname`, `ppassword`, `paddress`, `pnic`, `pdob`, `ptel`) VALUES
(3, 'saif@gmail.com', 'Saif Khan', '123', 'International House of Universiti Malaya, Jalan 17/2, Petaling Jaya, Selangor, Malaysia', 'WX123444', '2000-06-08', '0145278541'),
(4, 'irfan@gmail.com', 'Irfan Haque', '123', 'Kota damansara', 'AS2121D3', '1999-06-17', '0113123213'),
(5, 'bikyy.prj10@gmail.com', 'Bikas Parajuli', 'asur', 'Pokhara-23', '', '2000-09-12', '9098415439'),
(6, 'pappu@gmail.com', 'pappu yadav', 'pappu', 'Pokhara-23', '', '2001-01-01', '9098415438'),
(7, 'pappu.yadav@gmail.com', 'pappu yadav', 'pappu', 'Pokhara-23', '', '2001-02-01', '9098415438');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

DROP TABLE IF EXISTS `schedule`;
CREATE TABLE IF NOT EXISTS `schedule` (
  `scheduleid` int NOT NULL AUTO_INCREMENT,
  `docid` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `scheduledate` date DEFAULT NULL,
  `scheduletime` time DEFAULT NULL,
  `nop` int DEFAULT NULL,
  PRIMARY KEY (`scheduleid`),
  KEY `docid` (`docid`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`scheduleid`, `docid`, `title`, `scheduledate`, `scheduletime`, `nop`) VALUES
(1, '1', 'Test Session', '2050-01-01', '18:00:00', 50),
(2, '1', '1', '2022-06-10', '20:36:00', 1),
(3, '1', '12', '2022-06-10', '20:33:00', 1),
(4, '1', '1', '2022-06-10', '12:32:00', 1),
(5, '1', '1', '2022-06-10', '20:35:00', 1),
(6, '1', '12', '2022-06-10', '20:35:00', 1),
(7, '1', '1', '2022-06-24', '20:36:00', 1),
(8, '1', '12', '2022-06-10', '13:33:00', 1),
(10, '3', 'Anxiety', '2023-06-23', '21:30:00', 2),
(11, '4', 'Insomnia', '2023-06-22', '21:40:00', 5);

-- --------------------------------------------------------

--
-- Table structure for table `specialties`
--

DROP TABLE IF EXISTS `specialties`;
CREATE TABLE IF NOT EXISTS `specialties` (
  `id` int NOT NULL,
  `sname` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `specialties`
--

INSERT INTO `specialties` (`id`, `sname`) VALUES
(1, 'Psychiatry'),
(2, 'Psychology'),
(3, 'Psychotherapy'),
(4, 'Therapy'),
(5, 'Rehabilitation'),
(6, 'Child Psychiatry'),
(7, 'Counselling'),
(8, 'Psychopharmacology');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_message`
--

DROP TABLE IF EXISTS `tbl_message`;
CREATE TABLE IF NOT EXISTS `tbl_message` (
  `msg_id` int NOT NULL AUTO_INCREMENT,
  `incoming_msg_id` text NOT NULL,
  `outgoing_msg_id` text NOT NULL,
  `text_message` text NOT NULL,
  `curr_date` text NOT NULL,
  `curr_time` text NOT NULL,
  PRIMARY KEY (`msg_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_message`
--

INSERT INTO `tbl_message` (`msg_id`, `incoming_msg_id`, `outgoing_msg_id`, `text_message`, `curr_date`, `curr_time`) VALUES
(9, '1001498663', '550570333', 'Hello Dr.', 'June 16, 2023 ', '6:51 pm'),
(10, '1202748353', '950674317', 'hi', 'April 30, 2025 ', '10:54 am');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `unique_id` text NOT NULL,
  `img` text NOT NULL,
  `username` text NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `email` text NOT NULL,
  `pass` text NOT NULL,
  `status` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `unique_id`, `img`, `username`, `address`, `dob`, `email`, `pass`, `status`) VALUES
(3, '1001498663', 'images/aa1.jpg', 'Dr Mekhala Sarker', NULL, NULL, 'drmekhala@gmail.com', '$2y$10$5XorbtABmX7BtJXwYa9sSubrb9/u7gkq8si3PZPG/kPN5q18ue5oW', 'Active'),
(4, '1202748353', 'images/aa1.jpg', 'Dr Ali Khan', NULL, NULL, 'drali@gmail.com', '$2y$10$yIOvkGzNpbD.ihvoNKzzAesoDQ5dkLdLgqWwS.iV80004AJRJLPFu', 'Offline'),
(5, '434205875', 'images/aa1.jpg', 'Dr Saad Rahman', NULL, NULL, 'drsaad@gmail.com', '$2y$10$crWUhQmXXNVeyvBXysM0zu7RCVLuU3CJhCEQDNZSi6D.sKf/bp6ua', 'Offline'),
(6, '1571822182', 'images/aa1.jpg', 'Saif', NULL, NULL, 'saif@gmail.com', '$2y$10$cPlTQGbbkPjRHCwLEmavkeB0qg4t/dCEkQGKL6PY7VG4WZuQm05uK', 'Active'),
(7, '550570333', 'images/aa1.jpg', 'Irfan', NULL, NULL, 'irfan@gmail.com', '$2y$10$E7lx66rDYYR714u8L/fQaeHysSy2X2p9lZRN0xHkN8CPfWW7qpDde', 'Active'),
(8, '950674317', 'images/aa1.jpg', 'Bikas', NULL, NULL, 'bikyy.prj10@gmail.com', '$2y$10$7R2XYk5g2XK9V7lH/EtkxOG50F7ioWEav2StXQ90Q.Ao.Frd6B8ty', 'Active'),
(9, '510295927', 'images/aa1.jpg', 'pappu', NULL, NULL, 'pappu@gmail.com', '$2y$10$IG5PQ0bpwmoV9bvCOoaPA.xIGJYO3pmt6rzW0QeEUw9cCZDnEMgf.', 'Offline'),
(10, '140228953', 'images/aa1.jpg', 'pappu', NULL, NULL, 'pappu.yadav@gmail.com', '$2y$10$4fylmcDqVbuAzV/6CSm5jeIkm9r6sAcqwyDsZOcspXTUZh/Ha7D5.', 'Offline'),
(11, '1118771830', 'images/aa1.jpg', 'safal', NULL, NULL, 'safal1@gmail.com', '$2y$10$fV318LjzMCBSZIDv2ZC5qeHO9aBz02wakQFyu5V6moxB/ufWcHcWW', 'Offline');

-- --------------------------------------------------------

--
-- Table structure for table `webuser`
--

DROP TABLE IF EXISTS `webuser`;
CREATE TABLE IF NOT EXISTS `webuser` (
  `email` varchar(255) NOT NULL,
  `usertype` char(1) DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `webuser`
--

INSERT INTO `webuser` (`email`, `usertype`) VALUES
('admin@gmail.com', 'a'),
('drmekhala@gmail.com', 'd'),
('drali@gmail.com', 'd'),
('drsaad@gmail.com', 'd'),
('saif@gmail.com', 'p'),
('irfan@gmail.com', 'p'),
('bikyy.prj10@gmail.com', 'p'),
('moderator1@gmail.com', 'm'),
('pappu@gmail.com', 'p'),
('pappu.yadav@gmail.com', 'p'),
('pukar@gmail.com', 'm'),
('mahesh@gmail.com', 'm'),
('safal1@gmail.com', 'm');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
