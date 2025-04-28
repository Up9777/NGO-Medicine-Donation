-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 04, 2024 at 01:35 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ngo`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_login`
--

CREATE TABLE `admin_login` (
  `id` int(100) NOT NULL,
  `uname` varchar(100) NOT NULL,
  `pass` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_login`
--

INSERT INTO `admin_login` (`id`, `uname`, `pass`) VALUES
(1, 'asif1406', '1406'),
(2, 'asif', '123');

-- --------------------------------------------------------

--
-- Table structure for table `donations`
--

CREATE TABLE `donations` (
  `id` int(50) NOT NULL,
  `Your_name` varchar(100) NOT NULL,
  `Contact_number` varchar(100) NOT NULL,
  `Address` varchar(50) NOT NULL,
  `Medicine_name` varchar(100) NOT NULL,
  `Tablet_count` varchar(100) NOT NULL,
  `Purchased_date` date NOT NULL,
  `Expiry_date` date NOT NULL,
  `Details` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `donations`
--

INSERT INTO `donations` (`id`, `Your_name`, `Contact_number`, `Address`, `Medicine_name`, `Tablet_count`, `Purchased_date`, `Expiry_date`, `Details`) VALUES
(6, 'ASIF MULANI', '+919422100136', 'Sangli', 'Dicrorate er 500mg', '1', '2023-03-26', '2023-03-31', 'okk'),
(7, 'ASIF SALIM MULANI', '+919422100136', 'Opp.old Police Line Khanbhag Sangli', 'Dicrorate ', '50', '2023-03-26', '2023-03-30', 'ok');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(100) NOT NULL,
  `Your_name` varchar(100) NOT NULL,
  `Contact_number` varchar(100) NOT NULL,
  `Address` varchar(100) NOT NULL,
  `Comment` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `Your_name`, `Contact_number`, `Address`, `Comment`) VALUES
(1, 'ASIF ', '+919422100136', 'Sangli', ''),
(5, 'ASIF ', '+919422100136', 'Opp.old Police Line Khanbhag Sangli', 'Feedback'),
(6, 'ASIF MULANI', '+919422100136', 'Opp.old Police Line Khanbhag Sangli', 'Feedback'),
(7, 'ASIF SALIM MULANI', '+919422100136', 'Opp.old Police Line Khanbhag Sangli', 'Feedback');

-- --------------------------------------------------------

--
-- Table structure for table `ngo_login`
--

CREATE TABLE `ngo_login` (
  `id` int(50) NOT NULL,
  `uname` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ngo_login`
--

INSERT INTO `ngo_login` (`id`, `uname`, `phone`, `city`, `email`, `pass`) VALUES
(2, 'Healthcare center', '+919422100136', 'Sangli', 'asifmulani1001@gmail.com', '123'),
(5, 'Healthcare center', '+919422100136', 'Sangli', 'asifmulani1001@gmail.com', '123');

-- --------------------------------------------------------

--
-- Table structure for table `user_login`
--

CREATE TABLE `user_login` (
  `id` int(50) NOT NULL,
  `uname` varchar(50) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `age` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pass` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_login`
--

INSERT INTO `user_login` (`id`, `uname`, `gender`, `age`, `phone`, `city`, `email`, `pass`) VALUES
(5, 'asif', 'male', '24', '+919422100136', 'Sangli', 'asifmulani1001@gmail.com', '1234'),
(6, 'asif', 'male', '25', '+919422100136', 'Sangli', 'asifmulani1001@gmail.com', '123'),
(7, 'asif', 'male', '25', '+919422100136', 'Sangli', 'asifmulani1001@gmail.com', '123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_login`
--
ALTER TABLE `admin_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `donations`
--
ALTER TABLE `donations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `ngo_login`
--
ALTER TABLE `ngo_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_login`
--
ALTER TABLE `user_login`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_login`
--
ALTER TABLE `admin_login`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `donations`
--
ALTER TABLE `donations`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `ngo_login`
--
ALTER TABLE `ngo_login`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_login`
--
ALTER TABLE `user_login`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
