-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Feb 22, 2019 at 04:49 PM
-- Server version: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `NetworkingWebsite`
--

-- --------------------------------------------------------

--
-- Table structure for table `ADDRESSES`
--

CREATE TABLE `ADDRESSES` (
  `ID` int(11) NOT NULL,
  `STREET_ADDRESS` varchar(45) DEFAULT NULL,
  `CITY` varchar(45) DEFAULT NULL,
  `STATE` varchar(45) DEFAULT NULL,
  `ZIP_CODE` int(11) DEFAULT NULL,
  `USERS_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `EDUCATION`
--

CREATE TABLE `EDUCATION` (
  `ID` int(11) NOT NULL,
  `SCHOOL` varchar(45) DEFAULT NULL,
  `DEGREE` varchar(45) DEFAULT NULL,
  `START_YEAR` varchar(45) DEFAULT NULL,
  `END_YEAR` varchar(45) DEFAULT NULL,
  `ADDITIONAL_INFORMATION` varchar(45) DEFAULT NULL,
  `USERS_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `GROUPS`
--

CREATE TABLE `GROUPS` (
  `ID` int(11) NOT NULL,
  `GROUP_NAME` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `PERSONAL_INFORMATION`
--

CREATE TABLE `PERSONAL_INFORMATION` (
  `ID` int(11) NOT NULL,
  `BIOGRAPHY` varchar(45) DEFAULT NULL,
  `CURRENT_POSITION` varchar(45) DEFAULT NULL,
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
  `SKILLS_NAME` varchar(45) DEFAULT NULL,
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
  `SUSPEND` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `USER_GROUPS`
--

CREATE TABLE `USER_GROUPS` (
  `ID` int(11) NOT NULL,
  `USERS_ID` int(11) NOT NULL,
  `GROUPS_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `WORK_EXPERIENCE`
--

CREATE TABLE `WORK_EXPERIENCE` (
  `ID` int(11) NOT NULL,
  `POSITION` varchar(45) DEFAULT NULL,
  `COMPANY` varchar(45) DEFAULT NULL,
  `START_YEAR` varchar(45) DEFAULT NULL,
  `END_YEAR` varchar(45) DEFAULT NULL,
  `ADDITIONAL_INFORMATION` varchar(45) DEFAULT NULL,
  `USERS_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ADDRESSES`
--
ALTER TABLE `ADDRESSES`
  ADD PRIMARY KEY (`ID`,`USERS_ID`),
  ADD KEY `fk_ADDRESSES_USERS1_idx` (`USERS_ID`);

--
-- Indexes for table `EDUCATION`
--
ALTER TABLE `EDUCATION`
  ADD PRIMARY KEY (`ID`,`USERS_ID`),
  ADD KEY `fk_EDUCATION_USERS_idx` (`USERS_ID`);

--
-- Indexes for table `GROUPS`
--
ALTER TABLE `GROUPS`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `PERSONAL_INFORMATION`
--
ALTER TABLE `PERSONAL_INFORMATION`
  ADD PRIMARY KEY (`ID`,`USERS_ID`),
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
-- Indexes for table `USER_GROUPS`
--
ALTER TABLE `USER_GROUPS`
  ADD PRIMARY KEY (`ID`,`USERS_ID`),
  ADD KEY `fk_USER_GROUPS_GROUPS1_idx` (`GROUPS_ID`),
  ADD KEY `fk_USER_GROUPS_USERS1_idx` (`USERS_ID`);

--
-- Indexes for table `WORK_EXPERIENCE`
--
ALTER TABLE `WORK_EXPERIENCE`
  ADD PRIMARY KEY (`ID`,`USERS_ID`),
  ADD KEY `fk_WORK_EXPERIENCE_USERS1_idx` (`USERS_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ADDRESSES`
--
ALTER TABLE `ADDRESSES`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `EDUCATION`
--
ALTER TABLE `EDUCATION`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `WORK_EXPERIENCE`
--
ALTER TABLE `WORK_EXPERIENCE`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ADDRESSES`
--
ALTER TABLE `ADDRESSES`
  ADD CONSTRAINT `fk_ADDRESSES_USERS1` FOREIGN KEY (`USERS_ID`) REFERENCES `USERS` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `EDUCATION`
--
ALTER TABLE `EDUCATION`
  ADD CONSTRAINT `fk_EDUCATION_USERS` FOREIGN KEY (`USERS_ID`) REFERENCES `USERS` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `PERSONAL_INFORMATION`
--
ALTER TABLE `PERSONAL_INFORMATION`
  ADD CONSTRAINT `fk_PERSONAL_INFORMATION_USERS1` FOREIGN KEY (`USERS_ID`) REFERENCES `USERS` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `SKILLS`
--
ALTER TABLE `SKILLS`
  ADD CONSTRAINT `fk_SKILLS_USERS1` FOREIGN KEY (`USERS_ID`) REFERENCES `USERS` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `USER_GROUPS`
--
ALTER TABLE `USER_GROUPS`
  ADD CONSTRAINT `fk_USER_GROUPS_GROUPS1` FOREIGN KEY (`GROUPS_ID`) REFERENCES `GROUPS` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_USER_GROUPS_USERS1` FOREIGN KEY (`USERS_ID`) REFERENCES `USERS` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `WORK_EXPERIENCE`
--
ALTER TABLE `WORK_EXPERIENCE`
  ADD CONSTRAINT `fk_WORK_EXPERIENCE_USERS1` FOREIGN KEY (`USERS_ID`) REFERENCES `USERS` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
