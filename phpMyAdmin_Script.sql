-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Apr 29, 2019 at 05:46 AM
-- Server version: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `NetworkingWebsite`
--

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

--
-- Dumping data for table `EDUCATION`
--

INSERT INTO `EDUCATION` (`ID`, `SCHOOL`, `DEGREE`, `START_YEAR`, `END_YEAR`, `ADDITIONAL_INFORMATION`, `USERS_ID`) VALUES
(1, 'Pinnacle High School', 'High School Degree', '2013', '2017', 'asdasda', 1),
(2, 'Grand Canyon University', 'Bachelor\'s', '2017', 'Present', 'None', 1);

-- --------------------------------------------------------

--
-- Table structure for table `GROUPS`
--

CREATE TABLE `GROUPS` (
  `ID` int(11) NOT NULL,
  `GROUP_NAME` varchar(45) DEFAULT NULL,
  `DESCRIPTION` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `GROUPS`
--

INSERT INTO `GROUPS` (`ID`, `GROUP_NAME`, `DESCRIPTION`) VALUES
(1, 'Coders', 'Wow you code!!!!!!!'),
(3, 'Lopes Up', 'Went to GCU!'),
(7, 'Disney', 'You love Disney!!!!'),
(8, 'Coders!!', 'Code and Testing and Others');

-- --------------------------------------------------------

--
-- Table structure for table `JOB_POSTINGS`
--

CREATE TABLE `JOB_POSTINGS` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(45) DEFAULT NULL,
  `COMPANY` varchar(45) DEFAULT NULL,
  `PAY` varchar(45) DEFAULT NULL,
  `DESCRIPTION` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `JOB_POSTINGS`
--

INSERT INTO `JOB_POSTINGS` (`ID`, `NAME`, `COMPANY`, `PAY`, `DESCRIPTION`) VALUES
(1, 'Barista', 'Ducth Bros', '$11/hr', 'Make coffee'),
(8, 'Cashier', 'Target', '$11/hr', 'Must have basic math skills and experience in customer service'),
(9, 'Performer', 'Disneyland', '$15/hr', 'Must be able to sing and dance'),
(10, 'Programmer', 'Soundcloud', '$15/hr', 'Must be able to code in PHP, C#, or Java');

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

--
-- Dumping data for table `SKILLS`
--

INSERT INTO `SKILLS` (`ID`, `SKILLS_NAME`, `USERS_ID`) VALUES
(3, 'Sing', 1),
(4, 'Coding', 1);

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

--
-- Dumping data for table `USERS`
--

INSERT INTO `USERS` (`ID`, `FIRSTNAME`, `LASTNAME`, `EMAIL`, `USERNAME`, `PASSWORD`, `ROLE`, `SUSPEND`) VALUES
(1, 'Mickey', 'Navarro', 'almicke@yahoo.com', 'Mick', 'mickmick', 1, 0),
(2, 'Mickey', 'Mouse', 'Mickey@disney.com', 'Mickey', 'mickey101', 0, 0),
(15, 'Minnie', 'Mouse', 'minnie@disney.com', 'Minnie', 'minnie101', 0, 0),
(16, 'Finn', 'theHuman', 'finn@adventuretime.com', 'Finn', 'mathematical', 0, 1),
(17, 'Donald', 'Duck', 'donald@duck.com', 'Donald', 'donaldduck', 0, 0),
(19, 'Jane', 'Doe', 'janedoe@yahoo.com', 'jane-doe1', 'jane-doe1', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `USERS_GROUPS`
--

CREATE TABLE `USERS_GROUPS` (
  `ID` int(11) NOT NULL,
  `USERS_ID` int(11) NOT NULL,
  `GROUPS_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `USERS_GROUPS`
--

INSERT INTO `USERS_GROUPS` (`ID`, `USERS_ID`, `GROUPS_ID`) VALUES
(12, 1, 1),
(10, 16, 3);

-- --------------------------------------------------------

--
-- Table structure for table `USERS_JOB_POSTINGS`
--

CREATE TABLE `USERS_JOB_POSTINGS` (
  `ID` int(11) NOT NULL,
  `SAVE` int(11) DEFAULT NULL,
  `APPLY` int(11) DEFAULT NULL,
  `USERS_ID` int(11) NOT NULL,
  `JOB_POSTINGS_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `USERS_JOB_POSTINGS`
--

INSERT INTO `USERS_JOB_POSTINGS` (`ID`, `SAVE`, `APPLY`, `USERS_ID`, `JOB_POSTINGS_ID`) VALUES
(7, 1, NULL, 1, 9);

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
-- Dumping data for table `WORK_EXPERIENCE`
--

INSERT INTO `WORK_EXPERIENCE` (`ID`, `POSITION`, `COMPANY`, `START_YEAR`, `END_YEAR`, `ADDITIONAL_INFORMATION`, `USERS_ID`) VALUES
(1, 'Brosita', 'Dutch Bros', '2017', '2019', 'none', 1);

--
-- Indexes for dumped tables
--

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
-- Indexes for table `JOB_POSTINGS`
--
ALTER TABLE `JOB_POSTINGS`
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
-- Indexes for table `USERS_GROUPS`
--
ALTER TABLE `USERS_GROUPS`
  ADD PRIMARY KEY (`ID`,`USERS_ID`),
  ADD KEY `fk_USER_GROUPS_GROUPS1_idx` (`GROUPS_ID`),
  ADD KEY `fk_USER_GROUPS_USERS1_idx` (`USERS_ID`);

--
-- Indexes for table `USERS_JOB_POSTINGS`
--
ALTER TABLE `USERS_JOB_POSTINGS`
  ADD PRIMARY KEY (`ID`,`USERS_ID`),
  ADD KEY `fk_USER_JOB_POSTINGS_USERS1_idx` (`USERS_ID`),
  ADD KEY `fk_USER_JOB_POSTINGS_JOB_POSTINGS1_idx` (`JOB_POSTINGS_ID`);

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
-- AUTO_INCREMENT for table `EDUCATION`
--
ALTER TABLE `EDUCATION`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `GROUPS`
--
ALTER TABLE `GROUPS`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `JOB_POSTINGS`
--
ALTER TABLE `JOB_POSTINGS`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `PERSONAL_INFORMATION`
--
ALTER TABLE `PERSONAL_INFORMATION`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `SKILLS`
--
ALTER TABLE `SKILLS`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `USERS`
--
ALTER TABLE `USERS`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `USERS_GROUPS`
--
ALTER TABLE `USERS_GROUPS`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `USERS_JOB_POSTINGS`
--
ALTER TABLE `USERS_JOB_POSTINGS`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `WORK_EXPERIENCE`
--
ALTER TABLE `WORK_EXPERIENCE`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

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
-- Constraints for table `USERS_GROUPS`
--
ALTER TABLE `USERS_GROUPS`
  ADD CONSTRAINT `fk_USER_GROUPS_GROUPS1` FOREIGN KEY (`GROUPS_ID`) REFERENCES `GROUPS` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_USER_GROUPS_USERS1` FOREIGN KEY (`USERS_ID`) REFERENCES `USERS` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `USERS_JOB_POSTINGS`
--
ALTER TABLE `USERS_JOB_POSTINGS`
  ADD CONSTRAINT `fk_USER_JOB_POSTINGS_JOB_POSTINGS1` FOREIGN KEY (`JOB_POSTINGS_ID`) REFERENCES `JOB_POSTINGS` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_USER_JOB_POSTINGS_USERS1` FOREIGN KEY (`USERS_ID`) REFERENCES `USERS` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `WORK_EXPERIENCE`
--
ALTER TABLE `WORK_EXPERIENCE`
  ADD CONSTRAINT `fk_WORK_EXPERIENCE_USERS1` FOREIGN KEY (`USERS_ID`) REFERENCES `USERS` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
