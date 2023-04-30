-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2023 at 10:25 AM
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
-- Database: `banking`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `deposit` int(11) NOT NULL,
  `withdraw` int(11) NOT NULL,
  `totalAmount` int(11) NOT NULL,
  `createdOn` timestamp NOT NULL DEFAULT current_timestamp(),
  `modifiedOn` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `isDeleted` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `userID`, `deposit`, `withdraw`, `totalAmount`, `createdOn`, `modifiedOn`, `isDeleted`) VALUES
(1, 1, 2000, 0, 2000, '2023-04-29 06:06:05', '2023-04-29 06:06:05', b'0'),
(2, 0, 3000, 0, 1000, '2023-04-29 07:03:15', '2023-04-29 07:03:15', b'0'),
(3, 0, 3000, 0, 1000, '2023-04-29 07:04:00', '2023-04-29 07:04:00', b'0'),
(4, 1, 1000, 0, 3000, '2023-04-29 07:05:50', '2023-04-29 07:05:50', b'0'),
(5, 1, 1000, 0, 4000, '2023-04-29 07:06:23', '2023-04-29 07:06:23', b'0'),
(6, 1, 1000, 0, 5000, '2023-04-29 07:19:24', '2023-04-29 07:19:24', b'0'),
(7, 1, 1000, 0, 6000, '2023-04-29 07:20:39', '2023-04-29 07:20:39', b'0'),
(8, 1, 1000, 0, 5000, '2023-04-29 07:28:05', '2023-04-29 07:28:05', b'0'),
(9, 1, 0, 1000, 4000, '2023-04-29 07:29:21', '2023-04-29 07:29:21', b'0'),
(10, 1, 1000, 0, 5000, '2023-04-29 07:47:38', '2023-04-29 07:47:38', b'0'),
(11, 1, 0, 1000, 4000, '2023-04-29 07:47:43', '2023-04-29 07:47:43', b'0'),
(12, 1, 100, 0, 4100, '2023-04-29 10:40:03', '2023-04-29 10:40:03', b'0'),
(13, 1, 0, 100, 4000, '2023-04-29 10:45:27', '2023-04-29 10:45:27', b'0'),
(14, 1, 0, 100, 3900, '2023-04-29 10:48:42', '2023-04-29 10:48:42', b'0'),
(15, 1, 0, 100, 3800, '2023-04-29 10:49:22', '2023-04-29 10:49:22', b'0'),
(16, 1, 0, 100, 3700, '2023-04-29 10:49:49', '2023-04-29 10:49:49', b'0'),
(17, 1, 0, 100, 3600, '2023-04-29 10:53:03', '2023-04-29 10:53:03', b'0'),
(18, 1, 0, 100, 3500, '2023-04-29 10:55:23', '2023-04-29 10:55:23', b'0'),
(19, 1, 100, 0, 3600, '2023-04-29 10:55:48', '2023-04-29 10:55:48', b'0'),
(20, 1, 0, 100, 3500, '2023-04-29 10:56:09', '2023-04-29 10:56:09', b'0'),
(21, 1, 100, 0, 3600, '2023-04-29 12:50:34', '2023-04-29 12:50:34', b'0'),
(22, 1, 0, 100, 3500, '2023-04-29 13:18:09', '2023-04-29 13:18:09', b'0');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `emailID` varchar(60) NOT NULL,
  `password` varchar(100) NOT NULL,
  `userFlag` bit(1) DEFAULT NULL,
  `accessToken` text DEFAULT NULL,
  `createdOn` timestamp NOT NULL DEFAULT current_timestamp(),
  `modifiedOn` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `isDeleted` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `emailID`, `password`, `userFlag`, `accessToken`, `createdOn`, `modifiedOn`, `isDeleted`) VALUES
(1, 'Sushil Kumar Gupta', 'sushilgupta.2712@gmail.com', '12345', b'0', 'a8e9103050b7040af3d23c9e6d32b54aaf53', '2023-04-28 18:17:25', '2023-04-29 12:50:26', b'0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
