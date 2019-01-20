-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jan 20, 2019 at 07:33 PM
-- Server version: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `NetworkingWebsite`
--

-- --------------------------------------------------------

--
-- Table structure for table `USERS`
--

CREATE TABLE `USERS` (
  `ID` int(11) NOT NULL,
  `FIRSTNAME` varchar(45) DEFAULT NULL,
  `LASTNAME` varchar(45) DEFAULT NULL,
  `EMAIL` varchar(45) DEFAULT NULL,
  `USERNAME` varchar(45) DEFAULT NULL,
  `PASSWORD` varchar(45) DEFAULT NULL,
  `ROLE` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `USERS`
--

INSERT INTO `USERS` (`ID`, `FIRSTNAME`, `LASTNAME`, `EMAIL`, `USERNAME`, `PASSWORD`, `ROLE`) VALUES
(1, 'Mariah', 'Valenzuela', 'Mariahv08@gmail.com', 'Mariah', '1', NULL),
(2, 'Mariah', 'Valenzuela', 'Mariahv08@gmail.com', 'Mariah', '1', NULL),
(3, 'Mickey', 'Navarro', 'almicke@yahoo.com', 'Mick', 'mick', NULL),
(4, 'Mickey', 'Navarro', 'almicke@yahoo.com', 'Mick', 'mick', NULL),
(5, 'Jane', 'Doe', 'JaneDoe@gmail.com', 'Jane', 'Doe', NULL),
(6, 'Jane', 'Doe', 'JaneDoe@gmail.com', 'Jane', 'Doe', NULL),
(7, 'John', 'Doe', 'JohnDoe@gmail.com', 'John', 'doe', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `USERS`
--
ALTER TABLE `USERS`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `USERS`
--
ALTER TABLE `USERS`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
