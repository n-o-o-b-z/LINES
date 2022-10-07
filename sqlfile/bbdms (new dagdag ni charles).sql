-- phpMyAdmin SQL Dump
-- version 5.3.0-dev+20220506.44a5cb2d56
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 13, 2022 at 12:47 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bbdms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `updationDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `Email`, `Password`, `updationDate`) VALUES
(1, 'charles.bernadez2001@gmail.com ', '21232f297a57a5a743894a0e4a801fc3', '2022-09-03 13:09:31');

-- --------------------------------------------------------

--
-- Table structure for table `codes`
--

CREATE TABLE `codes` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `code` varchar(5) NOT NULL,
  `expire` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `codes`
--

INSERT INTO `codes` (`id`, `email`, `code`, `expire`) VALUES
(1, 'charles.bernadez2001@gmail.com', '66462', 1662198206),
(2, 'charles.bernadez2001@gmail.com', '18423', 1662198546),
(3, 'charles.bernadez2001@gmail.com', '44513', 1662198798),
(4, 'charles.bernadez2001@gmail.com', '64799', 1662203566),
(5, 'charles.bernadez2001@gmail.com', '73122', 1662204394),
(6, 'charles.bernadez2001@gmail.com', '98859', 1662204487),
(7, 'charles.bernadez2001@gmail.com', '26944', 1662205344),
(8, 'charles.bernadez2001@gmail.com', '78001', 1662207154),
(9, 'charles.bernadez2001@gmail.com', '75298', 1662207483),
(10, 'charles.bernadez2001@gmail.com', '82258', 1662208030),
(11, 'charles.bernadez2001@gmail.com', '39226', 1662208381),
(12, 'charles.bernadez2001@gmail.com', '71563', 1662208702),
(13, 'charles.bernadez2001@gmail.com', '10750', 1662208918),
(14, 'charles.bernadez2001@gmail.com', '20189', 1662209323),
(15, 'charles.bernadez2001@gmail.com', '59709', 1662209500),
(16, 'charles.bernadez2001@gmail.com', '26480', 1662209797),
(17, 'charles.bernadez2001@gmail.com', '66639', 1662209930),
(18, 'charles.bernadez2001@gmail.com', '46587', 1662210269),
(19, 'charles.bernadez2001@gmail.com', '67386', 1662210591);

-- --------------------------------------------------------

--
-- Table structure for table `tblblooddonars`
--

CREATE TABLE `tblblooddonars` (
  `id` int(11) NOT NULL,
  `FullName` varchar(100) DEFAULT NULL,
  `MobileNumber` char(11) DEFAULT NULL,
  `EmailId` varchar(100) DEFAULT NULL,
  `Gender` varchar(20) DEFAULT NULL,
  `BirthDay` date DEFAULT NULL,
  `BloodGroup` varchar(20) DEFAULT NULL,
  `Purok` varchar(10) NOT NULL,
  `Barangay` varchar(255) DEFAULT NULL,
  `Message` mediumtext DEFAULT NULL,
  `PostingDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblblooddonars`
--

INSERT INTO `tblblooddonars` (`id`, `FullName`, `MobileNumber`, `EmailId`, `Gender`, `BirthDay`, `BloodGroup`, `Purok`, `Barangay`, `Message`, `PostingDate`, `status`) VALUES
(36, 'Charles P. Bernadez', '19512659595', 'charles.bernadez2001@gmail.com', 'Male', '2001-01-01', 'O+', 'P-1', 'Bakiad', 'donor', '2022-09-12 10:17:34', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblbloodgroup`
--

CREATE TABLE `tblbloodgroup` (
  `id` int(11) NOT NULL,
  `BloodGroup` varchar(20) DEFAULT NULL,
  `PostingDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblbloodgroup`
--

INSERT INTO `tblbloodgroup` (`id`, `BloodGroup`, `PostingDate`) VALUES
(1, 'A-', '2017-06-30 20:33:50'),
(2, 'AB-', '2017-06-30 20:34:00'),
(3, 'O-', '2017-06-30 20:34:05'),
(4, 'A-', '2017-06-30 20:34:10'),
(5, 'A+', '2017-06-30 20:34:13'),
(7, 'AB+', '2020-07-17 08:49:36'),
(8, 'Hindi pa alam', '2022-09-06 10:08:15'),
(9, 'O+', '2022-09-09 10:40:17');

-- --------------------------------------------------------

--
-- Table structure for table `tblcontactusinfo`
--

CREATE TABLE `tblcontactusinfo` (
  `id` int(11) NOT NULL,
  `Address` tinytext DEFAULT NULL,
  `EmailId` varchar(255) DEFAULT NULL,
  `ContactNo` char(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcontactusinfo`
--

INSERT INTO `tblcontactusinfo` (`id`, `Address`, `EmailId`, `ContactNo`) VALUES
(1, 'P-2, Barangay Bakiad																						', 'bakiad2022@gmail.com', '09486670890');

-- --------------------------------------------------------

--
-- Table structure for table `tblcontactusquery`
--

CREATE TABLE `tblcontactusquery` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `EmailId` varchar(120) DEFAULT NULL,
  `ContactNumber` char(11) DEFAULT NULL,
  `Message` longtext DEFAULT NULL,
  `PostingDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcontactusquery`
--

INSERT INTO `tblcontactusquery` (`id`, `name`, `EmailId`, `ContactNumber`, `Message`, `PostingDate`, `status`) VALUES
(11, 'Charles P. Bernadez', 'charles.bernadez2001@gmail.com', '19512659595', 'Hello Good Day!\r\nI\'m from RHU Labo, we would like to inform you we will be having a Blood Letting Activity this coming September 22, 2022, at Labo Sports Plaza Complex from 8 am to 5 pm. We will be inviting your community to participate in this incoming activity.\r\n\r\nFrom the Municipal Office of RHU Labo.\r\nThank You and Godbless.', '2022-09-09 10:50:56', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblpages`
--

CREATE TABLE `tblpages` (
  `id` int(11) NOT NULL,
  `PageName` varchar(255) DEFAULT NULL,
  `type` varchar(255) NOT NULL DEFAULT '',
  `detail` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblpages`
--

INSERT INTO `tblpages` (`id`, `PageName`, `type`, `detail`) VALUES
(2, 'Announcement', 'announcement', '<div style=\"box-sizing: inherit; color: rgb(41, 43, 44); font-family: -apple-system, system-ui, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, sans-serif; font-size: 16px;\">BLOOD DONATION</div><div style=\"box-sizing: inherit; color: rgb(41, 43, 44); font-family: -apple-system, system-ui, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, sans-serif; font-size: 16px;\">SEPTEMBER 20,2022<br style=\"box-sizing: inherit;\"></div><div style=\"box-sizing: inherit; color: rgb(41, 43, 44); font-family: -apple-system, system-ui, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, sans-serif; font-size: 16px;\">VENUE AT SPORTS PLAZA</div>'),
(3, 'About Us ', 'aboutus', '<span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 16px; text-align: justify;\">We are the Barangay Bakiad Healthcare Workers aiming and seeking voluntary participation of our residents who are willful donors to support the Philippines Red Cross (PRC) and Department of Health (DOH) Blood Donation Program by sending willing donors to the blood donation site given by the Municipal Rural Health Unit of Labo in our Barangay Health Care Centers. This website will be used in utilizing the use of technology as a way of dissemination of information by advocating the visitors of this site and the users of the mobile application. Also aims for spreading awareness among the resident of Barangay Bakiad.</span>'),
(4, 'The Need For Blood', 'needforblood', '<p class=\"MsoNormal\" style=\"text-align: justify; \"><span style=\"font-size: 11.5pt; line-height: 107%; font-family: Arial, sans-serif; color: rgb(49, 49, 49); background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\">Napakadaming may sakit ang\nnangangailangan ng dugo. Magtanong sa inyong barangay o health center, maaaring\nmay blood donation drive sa inyong lugar. Huwag nang antayin may mangailangan\nng ating dugo, magbigay tayo ng taos puso.</span><span style=\"font-family:\n&quot;Arial&quot;,sans-serif\"><o:p></o:p></span></p>		'),
(5, 'Blood Tips', 'bloodtips', '<p class=\"MsoNormal\" style=\"text-align: justify; \"><span style=\"font-size: 11.5pt; line-height: 107%; font-family: Arial, sans-serif; color: rgb(49, 49, 49); background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\">Huwag kumain bago mag doante. Gawin ito pagkatapos. Sa Katunayan, nagbibigay pa sila ng meryenda habang nagdodonate. Maari naman uminom ng tubig bago maga donate. Huwag magdonate kung masama ang pakiramdam. Huwag manigarilyo at uminom ng alak bago mag donate. At higit sa lahat, huwag magpupuyat sa gabi bago mag donate.&nbsp;</span></p>				\n										'),
(6, 'Who you could Help', 'whocouldyouhelp', '<p class=\"MsoNormal\" style=\"text-align: justify; \"><span style=\"font-size: 11.5pt; line-height: 107%; font-family: Arial, sans-serif; color: rgb(49, 49, 49); background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\">Napakadaming may sakit ang nangangailangan ng dugo. Magtanong sa inyong barangay o health center, maaaring may blood donation drive sa inyong lugar. Huwag nang antayin may mangailangan ng ating dugo, magbigay tayo ng taos puso.</span><span style=\"font-family: &quot;Arial&quot;,sans-serif\"><o:p></o:p></span></p>');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `codes`
--
ALTER TABLE `codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `code` (`code`),
  ADD KEY `expire` (`expire`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `tblblooddonars`
--
ALTER TABLE `tblblooddonars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblbloodgroup`
--
ALTER TABLE `tblbloodgroup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblcontactusinfo`
--
ALTER TABLE `tblcontactusinfo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblcontactusquery`
--
ALTER TABLE `tblcontactusquery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblpages`
--
ALTER TABLE `tblpages`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `codes`
--
ALTER TABLE `codes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tblblooddonars`
--
ALTER TABLE `tblblooddonars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `tblbloodgroup`
--
ALTER TABLE `tblbloodgroup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tblcontactusinfo`
--
ALTER TABLE `tblcontactusinfo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblcontactusquery`
--
ALTER TABLE `tblcontactusquery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tblpages`
--
ALTER TABLE `tblpages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;



