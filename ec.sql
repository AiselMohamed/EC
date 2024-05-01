-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: May 01, 2024 at 06:20 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ec`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `msg_id` int(250) NOT NULL,
  `incoming_msg_id` int(250) NOT NULL,
  `outgoing_msg_id` int(250) NOT NULL,
  `msg` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `id` int(10) NOT NULL,
  `Username` varchar(250) NOT NULL,
  `Email` varchar(250) NOT NULL,
  `Country` varchar(250) NOT NULL,
  `MainLanguage` varchar(250) NOT NULL,
  `Password` varchar(250) NOT NULL,
  `Img` varchar(500) NOT NULL,
  `Status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`id`, `Username`, `Email`, `Country`, `MainLanguage`, `Password`, `Img`, `Status`) VALUES
(1, 'aisel', 'aiselmohamed48@gmail.com', 'egypt', 'english', '123', '', ''),
(3, 'maryam', 'aisel20-00264@student.eelu.edu.eg', 'asdsd', 'asdsa', '123456', '', ''),
(4, 'aisel', 'aiselmohmed48@gmail.com', 'egypt', 'english', 'mn,', 'download (1).png', 'Active now'),
(5, 'aisel', 'aisel00264@student.eelu.edu.eg', 'asdsd', 'english', 'mn,', 'download (2).png', 'Active now'),
(6, 'aisel', 'aiselmohd48@gmail.com', 'egypt', 'asdsa', 'mn,', 'download (1).png', 'Active now'),
(7, 'aisel', 'aisehamed48@gmail.com', 'egypt', 'english', '123', 'CSS3_logo.svg.png', 'Active now'),
(8, 'aisel', 'aisamed48@gmail.com', 'egypt', 'english', '879', 'CSS3_logo.svg.png', 'Active now'),
(9, 'aisel', '0264@student.eelu.edu.eg', 'asdsd', 'khghhg', '123', 'CSS3_logo.svg.png', 'Active now'),
(10, 'mohamed', 'mohamed48@gmail.com', 'egypt', 'asdsa', '444', 'CSS3_logo.svg.png', 'Active now'),
(11, 'mohamed', 'amed48@gmail.com', 'egypt', 'asdsa', '444', 'download (1).png', 'Active now'),
(12, 'mohamed', '0-00264@student.eelu.edu.eg', 'egypt', 'asdsa', '444', 'download (1).png', 'Active now'),
(13, 'mohamed', 'ed48@gmail.com', 'ghfk', 'hg,h', '444', 'download (1).png', 'Active now'),
(14, 'mohamed', 'd48@gmail.com', 'hf', 'mvn', '444', 'download (1).png', 'Active now'),
(15, 'mohamed', 'mohamed4@gmail.com', ',j', 'm', '444', 'CSS3_logo.svg.png', 'Active now'),
(16, 'aisel', 'aiselmoh@gmail.com', 'Egypt', 'english', 'mn,', 'download (1).png', 'Active now'),
(17, 'aisel', 'aisoh@gmail.com', 'Egypt', 'english', 'jhjb', 'download (1).png', 'Active now'),
(18, 'mohamed', 'aiselmohnmnvamed48@gmail.com', 'egypt', 'english', 'ASD123@@@gh12', 'download (2).png', 'Active now');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(250) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
