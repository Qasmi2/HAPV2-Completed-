-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2017 at 07:20 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `protalv2`
--

-- --------------------------------------------------------

--
-- Table structure for table `bloodappeal`
--

CREATE TABLE `bloodappeal` (
  `appealID` int(11) NOT NULL,
  `bloodGroup` varchar(11) NOT NULL,
  `bloodQuantity` varchar(100) NOT NULL,
  `hospitalAddress` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `appealDetail` varchar(1000) DEFAULT NULL,
  `tokenCode` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bloodappeal`
--

INSERT INTO `bloodappeal` (`appealID`, `bloodGroup`, `bloodQuantity`, `hospitalAddress`, `city`, `country`, `appealDetail`, `tokenCode`) VALUES
(3, 'B+', '500ml', 'PIMS', 'Islamabad', 'PK', 'Need B+ Blood', '4fb0d7bb83293182399cdd86c062f658'),
(4, 'A-', '400ml', 'Islamabad Pakistan', 'Islamabad', 'PK', 'detail about blood appeal', '4fc77ad1f437550daa6042a186113e08'),
(5, 'AB+', '800ml', 'Islamic International Hospital ', 'Islamabad', 'PK', 'Need AB+Blood as soon as possible ', '117c4ec1c0df0a4a824cf7901020d198');

-- --------------------------------------------------------

--
-- Table structure for table `otherappeal`
--

CREATE TABLE `otherappeal` (
  `appealID` int(11) NOT NULL,
  `appealName` varchar(11) NOT NULL,
  `appealAddress` varchar(11) NOT NULL,
  `appealCity` varchar(11) NOT NULL,
  `appealResources` varchar(100) NOT NULL,
  `appealQuantity` varchar(100) NOT NULL,
  `appealDetail` varchar(1000) DEFAULT NULL,
  `tokenCode` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `otherappeal`
--

INSERT INTO `otherappeal` (`appealID`, `appealName`, `appealAddress`, `appealCity`, `appealResources`, `appealQuantity`, `appealDetail`, `tokenCode`) VALUES
(2, 'Need Food', 'collage Roa', 'RawalPindi', '["Food items"]', '["33"]', 'Need Food Items ', '0ad475d1e149a844b2864637ca91735e'),
(3, 'Need Medici', 'Street no.2', 'RawalPindi', '["Medicine"]', '["33"]', 'Need medicine Items ', '87f3574bc9bf6825186e14b587fa68b9'),
(4, 'otherappeal', 'otherappeal', 'cityrequire', '["notingre"]', '["notingrequire"]', 'descriptionaboutEvent', '60c1817d8d325a78995dbe346e088ff9'),
(5, 'Need Water ', 'Iqbal town', 'Islamabad', '["water "]', '["5 "]', 'Need water here as soon as possible ', '85fd589f3f88a02debf22f28d537cc45');

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `taskID` int(11) NOT NULL,
  `taskName` varchar(100) NOT NULL,
  `taskAddress` varchar(100) DEFAULT NULL,
  `taskCity` varchar(100) DEFAULT NULL,
  `taskDetail` varchar(1000) NOT NULL,
  `taskProgreess` varchar(100) DEFAULT NULL,
  `eventID` int(11) DEFAULT NULL,
  `volunteerID` int(11) DEFAULT NULL,
  `managerID` int(11) DEFAULT NULL,
  `taskStatus` enum('Y','N') NOT NULL DEFAULT 'N',
  `taskVarify` enum('Y','N') NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`taskID`, `taskName`, `taskAddress`, `taskCity`, `taskDetail`, `taskProgreess`, `eventID`, `volunteerID`, `managerID`, `taskStatus`, `taskVarify`) VALUES
(1, 'testing', 'testingAddress', 'cityTesting', 'testingdetail', 'incomplete', 1, 3, 5, 'Y', 'N'),
(2, 'Food ', 'address require', 'city require', 'detaile require', 'incomplete', 1, 4, 5, 'Y', 'N'),
(4, 'arrange Ambulances ', 'H-8/2 street no.2', 'Islamabad', 'Arrange Ambulances and go to accident place ', 'initiate', 9, NULL, NULL, 'Y', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `adminEmail` varchar(100) NOT NULL,
  `adminPass` varchar(100) NOT NULL,
  `tokenCode` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`adminEmail`, `adminPass`, `tokenCode`) VALUES
('gul@yahoo.com', 'gul', 'tokenCodegul');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_event`
--

CREATE TABLE `tbl_event` (
  `eventID` int(11) NOT NULL,
  `eventName` varchar(11) NOT NULL,
  `eventAddress` varchar(100) NOT NULL,
  `eventCity` varchar(100) NOT NULL,
  `eventState` varchar(100) NOT NULL,
  `eventResources` varchar(100) NOT NULL,
  `eventQuantities` varchar(100) NOT NULL,
  `eventDetail` varchar(1000) NOT NULL,
  `managerID` int(11) DEFAULT NULL,
  `tokenCode` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_event`
--

INSERT INTO `tbl_event` (`eventID`, `eventName`, `eventAddress`, `eventCity`, `eventState`, `eventResources`, `eventQuantities`, `eventDetail`, `managerID`, `tokenCode`) VALUES
(1, 'earthQuick', 'Iqbal town', 'Islamabad', 'PK', '["Rescue Equipments","noting"]', '["2","nothing"]', 'eath quick', 5, '2930aaf5c6f998cbea4b2206181346ad'),
(2, 'FireOnBuild', 'E11 islamabad', 'Islamabad', 'PK', '["Rescue Equipments","volunteers"]', '["5","3"]', 'Need volunteers to overcome the fire ,', 5, 'd01592c2d3d42c5ebf8c3c9d91da5570'),
(4, 'Accident', 'Islamabad Expressway ', 'Islamabad', 'PK', 'null', 'null', 'Need Ambulances ', 5, '6d4d2fbfadcd99dcfda96e416bd18cf8'),
(5, 'Fire on Bui', 'G-6 Sector ', 'Islamabad', 'PK', '["Fist Aid","nothing"]', '["2","nothing"]', 'Need equipment that help to save people', 5, '787d08487bc1fe0573496b37171ae473'),
(6, 'foodAppeal', 'f8 markaz', 'Islamabad', 'PK', '["Food","floor"]', '["5","10"]', 'urgent need ', 5, 'fcb690ed8f081ca4327fe037670894d5'),
(9, 'foodAppeal', 'Iqbal town', 'Islamabad', 'PK', '["Food","Volunteers"]', '["5","2"]', 'need 5 volunteers to help and server the food', 5, 'ee9d7d320abfe80ef999eaaad2922cfa'),
(10, 'Accident', 'H-8/2 street no.2', 'Islamabad', 'PK', '["nothing","ambulance"]', '["nothing","3"]', 'need 4 Ambulances ', 5, '20f3ecb9e763a32f8b694353409ee7cc');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_manager`
--

CREATE TABLE `tbl_manager` (
  `managerID` int(11) NOT NULL,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_manager`
--

INSERT INTO `tbl_manager` (`managerID`, `userID`) VALUES
(5, 14),
(6, 18);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `userID` int(11) NOT NULL,
  `userName` varchar(100) NOT NULL,
  `userEmail` varchar(100) NOT NULL,
  `userPass` varchar(100) NOT NULL,
  `userAge` varchar(100) DEFAULT NULL,
  `userGender` varchar(100) DEFAULT NULL,
  `userEducation` varchar(100) DEFAULT NULL,
  `userPhone` varchar(100) DEFAULT NULL,
  `userAbout` varchar(1000) DEFAULT NULL,
  `userAddress` varchar(500) DEFAULT NULL,
  `userCity` varchar(100) DEFAULT NULL,
  `userCountry` varchar(100) DEFAULT NULL,
  `userRole` varchar(100) NOT NULL,
  `userStatus` enum('Y','N') NOT NULL DEFAULT 'N',
  `userVarify` enum('Y','N') NOT NULL DEFAULT 'N',
  `tokenCode` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`userID`, `userName`, `userEmail`, `userPass`, `userAge`, `userGender`, `userEducation`, `userPhone`, `userAbout`, `userAddress`, `userCity`, `userCountry`, `userRole`, `userStatus`, `userVarify`, `tokenCode`) VALUES
(14, 'Nadeem Qasmi', 'nadeemqasmi40@yahoo.com', '2fbf11ed2e4c9f0e5bb7e66320076f7e', '23', 'male', 'bse', '03364526002', 'I worked as a manager ', 'Iqbal town', 'Islamabad', 'PK', 'manager', 'Y', 'Y', 'de8296f973182ee030ac62bdfbac01e2'),
(15, 'qasmi', 'qasmi40@yahoo.com', '2fbf11ed2e4c9f0e5bb7e66320076f7e', '23', 'male', 'bse', '03344218955', 'volunteers work as ', 'Iqbal town', 'Islamabad', 'PK', 'volunteer', 'Y', 'Y', 'a2f3daea14f6bed9572266a9064bc997'),
(16, 'syed mudassar', 'akhtarmudassar@yahoo.com', '81dc9bdb52d04dc20036dbd8313ed055', '21', 'male', 'bachlors', '+923331111111', 'i ere', 'islamad e11 1', 'Isb', 'PK', 'volunteer', 'Y', 'Y', '150502da3771861b44a21d9ee382a019'),
(17, 'Nabeel Yaseen ', 'nabeelyaseen94@outlook.com', '6127c94780277fa64acb99d9e97e0f87', '22', 'male', 'bse', '+923331111111', 'hello wanna join you as volunteere', 'abc-khannapul', 'Islamabad', 'PK', 'volunteer', 'Y', 'Y', '27aca1b36a168354b15549e979b49791'),
(18, 'fedo', 'nadeemqasmi40@hotmail.com', '62cdf75b97d222b6396b84ea003de42f', '23', 'male', 'bse', '00303202020', 'I can able to manager ......', 'G/6-3', 'Islamabad', 'PK', 'manager', 'Y', 'Y', 'a43b914aac2c324f83b90966962bab7e');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_volunteer`
--

CREATE TABLE `tbl_volunteer` (
  `volunteerID` int(11) NOT NULL,
  `userID` int(11) DEFAULT NULL,
  `eventID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_volunteer`
--

INSERT INTO `tbl_volunteer` (`volunteerID`, `userID`, `eventID`) VALUES
(3, 15, 6),
(4, 16, 1),
(5, 17, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bloodappeal`
--
ALTER TABLE `bloodappeal`
  ADD PRIMARY KEY (`appealID`);

--
-- Indexes for table `otherappeal`
--
ALTER TABLE `otherappeal`
  ADD PRIMARY KEY (`appealID`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`taskID`),
  ADD UNIQUE KEY `taskID` (`taskID`),
  ADD KEY `eventID` (`eventID`),
  ADD KEY `volunteerID` (`volunteerID`),
  ADD KEY `managerID` (`managerID`);

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`adminEmail`);

--
-- Indexes for table `tbl_event`
--
ALTER TABLE `tbl_event`
  ADD PRIMARY KEY (`eventID`),
  ADD UNIQUE KEY `eventID` (`eventID`),
  ADD KEY `managerID` (`managerID`);

--
-- Indexes for table `tbl_manager`
--
ALTER TABLE `tbl_manager`
  ADD PRIMARY KEY (`managerID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `userEmail` (`userEmail`);

--
-- Indexes for table `tbl_volunteer`
--
ALTER TABLE `tbl_volunteer`
  ADD PRIMARY KEY (`volunteerID`),
  ADD KEY `eventID` (`eventID`),
  ADD KEY `userID` (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bloodappeal`
--
ALTER TABLE `bloodappeal`
  MODIFY `appealID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `otherappeal`
--
ALTER TABLE `otherappeal`
  MODIFY `appealID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `taskID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_event`
--
ALTER TABLE `tbl_event`
  MODIFY `eventID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `tbl_manager`
--
ALTER TABLE `tbl_manager`
  MODIFY `managerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `tbl_volunteer`
--
ALTER TABLE `tbl_volunteer`
  MODIFY `volunteerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `task_ibfk_1` FOREIGN KEY (`eventID`) REFERENCES `tbl_event` (`eventID`),
  ADD CONSTRAINT `task_ibfk_2` FOREIGN KEY (`volunteerID`) REFERENCES `tbl_volunteer` (`volunteerID`),
  ADD CONSTRAINT `task_ibfk_3` FOREIGN KEY (`managerID`) REFERENCES `tbl_manager` (`managerID`);

--
-- Constraints for table `tbl_event`
--
ALTER TABLE `tbl_event`
  ADD CONSTRAINT `tbl_event_ibfk_1` FOREIGN KEY (`managerID`) REFERENCES `tbl_manager` (`managerID`);

--
-- Constraints for table `tbl_manager`
--
ALTER TABLE `tbl_manager`
  ADD CONSTRAINT `tbl_manager_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `tbl_users` (`userID`);

--
-- Constraints for table `tbl_volunteer`
--
ALTER TABLE `tbl_volunteer`
  ADD CONSTRAINT `tbl_volunteer_ibfk_1` FOREIGN KEY (`eventID`) REFERENCES `tbl_event` (`eventID`),
  ADD CONSTRAINT `tbl_volunteer_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `tbl_users` (`userID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
