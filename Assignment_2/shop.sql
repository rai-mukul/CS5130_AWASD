-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 07, 2023 at 10:17 PM
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
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrators`
--

CREATE TABLE `administrators` (
  `adminID` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `administrators`
--

INSERT INTO `administrators` (`adminID`, `email`, `password`, `firstname`, `lastname`) VALUES
(1, 'admin@ucmo.edu', '$2y$10$tEIwaYzFlJyvBIvVfnaI7ugWycm32Eax/JzKO.6dljhSsHA42O85e', 'Admin', 'Admin'),
(2, 'joel@ucmo.edu', '$2y$10$v62XTXpWyXgYDUmrofE8UuOYhmmwWOBkEbV4EEcN.lpk.oH0.Ns5O', 'Joel', 'Sung'),
(3, 'sys@ucmo.edu', '$2y$10$xR2fMgi4ncOgT5inGr68R.H5yeax2HVN6nEWB0qodpzebsdn4.m.2', 'sys', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(60) NOT NULL,
  `firstname` varchar(60) NOT NULL,
  `lastname` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `email`, `password`, `firstname`, `lastname`) VALUES
(1, 'joel@ucmo.edu', '$2y$10$eW9JTLX.7POyc6NcubxL8e6KT/JUZHVGPo6IJdr91g/eeg0GpUNgi', 'Joel', 'Sung'),
(2, 'brian@ucmo.edu', '$2y$10$ZXReCWvgQDYm0IDxIdNjteAiBItn/PAWoFmIuVsBdYGh5YOzw34OC', 'Brian', 'Beeson'),
(3, 'ted@ucmo.edu', '$2y$10$zA1CE9Dk4.j8dQaUV9TStukyxNX43whzGkcjI2WZcSzD0rmfN0Bju', 'Ted', 'Cruz');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrators`
--
ALTER TABLE `administrators`
  ADD PRIMARY KEY (`adminID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `emailAddress` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrators`
--
ALTER TABLE `administrators`
  MODIFY `adminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
