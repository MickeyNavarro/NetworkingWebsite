-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Feb 06, 2019 at 08:01 AM
-- Server version: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `NetworkingWebsite`
--

-- --------------------------------------------------------

--
-- Table structure for table `PERSONAL_INFORMATION`
--

CREATE TABLE `PERSONAL_INFORMATION` (
  `ID` int(11) NOT NULL,
  `LOCATION` varchar(45) DEFAULT NULL,
  `BIOGRAPHY` varchar(45) DEFAULT NULL,
  `CONTACT_EMAIL` varchar(45) DEFAULT NULL,
  `PHONE_NUMBER` varchar(45) DEFAULT NULL,
  `PHOTO` varchar(45) DEFAULT NULL,
  `USERS_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `SKILLS`
--

CREATE TABLE `SKILLS` (
  `ID` int(11) NOT NULL,
  `SKILL_NAME` varchar(45) DEFAULT NULL,
  `USERS_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `ROLE` int(11) DEFAULT NULL,
  `SUSPEND` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `USERS`
--

INSERT INTO `USERS` (`ID`, `FIRSTNAME`, `LASTNAME`, `EMAIL`, `USERNAME`, `PASSWORD`, `ROLE`, `SUSPEND`) VALUES
(1, 'Mariah', 'Valenzuela', 'Mariahv08@gmail.com', 'Mariah', '1', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `USERS_EDUCATION`
--

CREATE TABLE `USERS_EDUCATION` (
  `ID` int(11) NOT NULL,
  `SCHOOL` varchar(45) DEFAULT NULL,
  `DEGREE` varchar(45) DEFAULT NULL,
  `START_YEAR` varchar(45) DEFAULT NULL,
  `END_YEAR` varchar(45) DEFAULT NULL,
  `ADDITIONAL_INFO` varchar(45) DEFAULT NULL,
  `USERS_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `USER_WORK_EXPERIENCE`
--

CREATE TABLE `USER_WORK_EXPERIENCE` (
  `ID` int(11) NOT NULL,
  `POSITION` varchar(45) DEFAULT NULL,
  `COMPANY` varchar(45) DEFAULT NULL,
  `LOCATION` text NOT NULL,
  `START_YEAR` varchar(45) DEFAULT NULL,
  `END_YEAR` varchar(45) DEFAULT NULL,
  `ADDITIONAL_INFORMATION` varchar(45) DEFAULT NULL,
  `USERS_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `PERSONAL_INFORMATION`
--
ALTER TABLE `PERSONAL_INFORMATION`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_PERSONAL_INFORMATION_USERS1_idx` (`USERS_ID`);

--
-- Indexes for table `SKILLS`
--
ALTER TABLE `SKILLS`
  ADD PRIMARY KEY (`ID`,`USERS_ID`),
  ADD KEY `fk_SKILLS_USERS1_idx` (`USERS_ID`);

--
-- Indexes for table `USERS`
--
ALTER TABLE `USERS`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `USERS_EDUCATION`
--
ALTER TABLE `USERS_EDUCATION`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_USERS_EDUCATION_USERS1_idx` (`USERS_ID`);

--
-- Indexes for table `USER_WORK_EXPERIENCE`
--
ALTER TABLE `USER_WORK_EXPERIENCE`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_USER_WORK_EXPERIENCE_USERS1_idx` (`USERS_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `PERSONAL_INFORMATION`
--
ALTER TABLE `PERSONAL_INFORMATION`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `SKILLS`
--
ALTER TABLE `SKILLS`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `USERS`
--
ALTER TABLE `USERS`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `USERS_EDUCATION`
--
ALTER TABLE `USERS_EDUCATION`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `USER_WORK_EXPERIENCE`
--
ALTER TABLE `USER_WORK_EXPERIENCE`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `PERSONAL_INFORMATION`
--
ALTER TABLE `PERSONAL_INFORMATION`
  ADD CONSTRAINT `fk_PERSONAL_INFORMATION_USERS1` FOREIGN KEY (`USERS_ID`) REFERENCES `USERS` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `SKILLS`
--
ALTER TABLE `SKILLS`
  ADD CONSTRAINT `fk_SKILLS_USERS1` FOREIGN KEY (`USERS_ID`) REFERENCES `USERS` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `USERS_EDUCATION`
--
ALTER TABLE `USERS_EDUCATION`
  ADD CONSTRAINT `fk_USERS_EDUCATION_USERS1` FOREIGN KEY (`USERS_ID`) REFERENCES `USERS` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `USER_WORK_EXPERIENCE`
--
ALTER TABLE `USER_WORK_EXPERIENCE`
  ADD CONSTRAINT `fk_USER_WORK_EXPERIENCE_USERS1` FOREIGN KEY (`USERS_ID`) REFERENCES `USERS` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;
