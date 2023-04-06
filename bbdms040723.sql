/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `role_id` int NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `updationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Full_name` varchar(50) NOT NULL DEFAULT 'NULL',
  `status` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `announcement`;
CREATE TABLE `announcement` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `date` datetime NOT NULL,
  `banner` varchar(225) DEFAULT NULL,
  `location` varchar(50) DEFAULT NULL,
  `organizer` varchar(50) DEFAULT NULL,
  `details` varchar(225) DEFAULT NULL,
  `is_hidden` int(1) unsigned zerofill NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

DROP TABLE IF EXISTS `appointments`;
CREATE TABLE `appointments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `requester_id` int DEFAULT NULL,
  `accepter_id` int DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `status` int DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `donated_volume` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

DROP TABLE IF EXISTS `barangays`;
CREATE TABLE `barangays` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

DROP TABLE IF EXISTS `codes`;
CREATE TABLE `codes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `code` varchar(5) NOT NULL,
  `expire` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `code` (`code`),
  KEY `expire` (`expire`),
  KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

DROP TABLE IF EXISTS `donate_request`;
CREATE TABLE `donate_request` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `volume_request` int DEFAULT NULL,
  `status` int DEFAULT '0',
  `request_to` int DEFAULT NULL,
  `is_expired` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

DROP TABLE IF EXISTS `donation_history`;
CREATE TABLE `donation_history` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `blood_type_id` varchar(255) NOT NULL,
  `donation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int NOT NULL,
  `created_at` datetime NOT NULL,
  `donated_volume` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

DROP TABLE IF EXISTS `event_donors`;
CREATE TABLE `event_donors` (
  `id` int NOT NULL AUTO_INCREMENT,
  `announcement_id` int NOT NULL,
  `user_id` int NOT NULL,
  `status` int NOT NULL,
  `donated_volume` int DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `permission_id` int DEFAULT NULL,
  `name` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

DROP TABLE IF EXISTS `tblblooddonars`;
CREATE TABLE `tblblooddonars` (
  `id` int NOT NULL AUTO_INCREMENT,
  `FullName` varchar(100) DEFAULT NULL,
  `MobileNumber` char(11) DEFAULT NULL,
  `EmailId` varchar(100) NOT NULL,
  `password` varchar(250) NOT NULL DEFAULT '',
  `Gender` varchar(20) DEFAULT NULL,
  `BirthDay` date DEFAULT NULL,
  `age` int DEFAULT NULL,
  `BloodGroup` varchar(20) DEFAULT NULL,
  `Purok` varchar(10) NOT NULL,
  `Barangay` varchar(255) DEFAULT NULL,
  `Message` mediumtext,
  `PostingDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `can_donate` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `EmailId` (`EmailId`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `tblbloodgroup`;
CREATE TABLE `tblbloodgroup` (
  `id` int NOT NULL AUTO_INCREMENT,
  `BloodGroup` varchar(20) NOT NULL,
  `PostingDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `tblcontactusinfo`;
CREATE TABLE `tblcontactusinfo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `Address` tinytext,
  `EmailId` varchar(255) DEFAULT NULL,
  `ContactNo` char(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `tblcontactusquery`;
CREATE TABLE `tblcontactusquery` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `EmailId` varchar(120) DEFAULT NULL,
  `ContactNumber` char(11) DEFAULT NULL,
  `Message` longtext,
  `PostingDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int DEFAULT NULL,
  `is_opened` int unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `tblpages`;
CREATE TABLE `tblpages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `PageName` varchar(255) DEFAULT NULL,
  `type` varchar(255) NOT NULL DEFAULT '',
  `detail` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

INSERT INTO `admin` (`id`, `role_id`, `Email`, `Password`, `updationDate`, `Full_name`, `status`) VALUES
(1, 1, 'charles.bernadez2001@gmail.com ', '21232f297a57a5a743894a0e4a801fc3', '2022-09-03 21:09:31', 'Charles Bernadez', 0);
INSERT INTO `admin` (`id`, `role_id`, `Email`, `Password`, `updationDate`, `Full_name`, `status`) VALUES
(3, 3, 'rhu@admin.com', '21232f297a57a5a743894a0e4a801fc3', '2022-10-09 18:11:56', 'RHU', 0);
INSERT INTO `admin` (`id`, `role_id`, `Email`, `Password`, `updationDate`, `Full_name`, `status`) VALUES
(4, 4, 'hospital@gmail.com', '21232f297a57a5a743894a0e4a801fc3', '2022-10-09 18:16:14', 'Hospital', 0);

INSERT INTO `announcement` (`id`, `title`, `date`, `banner`, `location`, `organizer`, `details`, `is_hidden`) VALUES
(1, 'Blood camps', '2022-10-31 03:25:00', NULL, 'Omamuri', 'Carlo Cabanelas', NULL, 0);
INSERT INTO `announcement` (`id`, `title`, `date`, `banner`, `location`, `organizer`, `details`, `is_hidden`) VALUES
(24, 'DAET LADY ANNE', '2022-10-12 09:51:00', NULL, 'LADY ANNE', 'Carlo Cabanelas', 'PUNTA KAYO MGA ULOLS', 0);
INSERT INTO `announcement` (`id`, `title`, `date`, `banner`, `location`, `organizer`, `details`, `is_hidden`) VALUES
(27, 'Nezuko!', '2022-10-13 14:36:00', '../../images/uploads/844021demon-slayer-nezuko-pfp-2.jpg', 'Nagoya, Japan', 'Masashi Kishimoto', 'Hello ako si Nezuko!', 0);
INSERT INTO `announcement` (`id`, `title`, `date`, `banner`, `location`, `organizer`, `details`, `is_hidden`) VALUES
(28, 'Blood letting activity', '2022-10-17 00:00:00', '../../images/uploads/849924ccs.jpg', 'Mabini', 'RHU', 'Dev test', 0);

INSERT INTO `appointments` (`id`, `requester_id`, `accepter_id`, `date`, `location`, `message`, `status`, `created_at`, `donated_volume`) VALUES
(79, 36, 41, '2023-04-06 11:21:00', 'ANY', NULL, 0, '2023-04-06 23:21:14', NULL);
INSERT INTO `appointments` (`id`, `requester_id`, `accepter_id`, `date`, `location`, `message`, `status`, `created_at`, `donated_volume`) VALUES
(80, 36, 41, '2023-04-06 11:21:00', 'ANY', NULL, 0, '2023-04-06 23:21:14', NULL);
INSERT INTO `appointments` (`id`, `requester_id`, `accepter_id`, `date`, `location`, `message`, `status`, `created_at`, `donated_volume`) VALUES
(81, 36, 41, '2023-04-06 11:21:00', 'ANY', NULL, 0, '2023-04-06 23:21:14', NULL);
INSERT INTO `appointments` (`id`, `requester_id`, `accepter_id`, `date`, `location`, `message`, `status`, `created_at`, `donated_volume`) VALUES
(82, 36, 41, '2023-04-06 11:21:00', 'ANY', NULL, 0, '2023-04-06 23:21:14', NULL);

INSERT INTO `barangays` (`id`, `name`) VALUES
(2, 'Awitan');
INSERT INTO `barangays` (`id`, `name`) VALUES
(3, 'Awitan');
INSERT INTO `barangays` (`id`, `name`) VALUES
(4, 'Baay');
INSERT INTO `barangays` (`id`, `name`) VALUES
(5, 'Bagacay'),
(6, 'Bagong Silang I'),
(7, 'Bagong Silang II'),
(8, 'Bagong Silang III'),
(9, 'Bakiad'),
(10, 'Bautista'),
(11, 'Bayabas'),
(12, 'Bayan-bayan'),
(13, 'Benit'),
(14, 'Bulhao'),
(15, 'Cabatuhan'),
(16, 'Cabusay'),
(17, 'Calabasa'),
(18, 'Canapawan'),
(19, 'Daguit'),
(20, 'Dalas'),
(21, 'Dumagmang'),
(22, 'Exciban'),
(23, 'Fundado'),
(24, 'Guinacutan'),
(25, 'Guisican'),
(26, 'Gumamela (Poblacion)'),
(27, 'Iberica'),
(28, 'Kalamunding (Poblacion)'),
(29, 'Lugi'),
(30, 'Mabilo I'),
(31, 'Mabilo II'),
(32, 'Macogon'),
(33, 'Mahawan-hawan'),
(34, 'Malangcao-Basud'),
(35, 'Malasugui'),
(36, 'Malatap'),
(37, 'Malaya'),
(38, 'Malibago'),
(39, 'Maot'),
(40, 'Masalong'),
(41, 'Matanlang'),
(42, 'Napaod'),
(43, 'Pag-asa'),
(44, 'Pangpang'),
(45, 'Pinya (Poblacion)'),
(46, 'San Antonio'),
(47, 'San Francisco (Poblacion)'),
(48, 'Santa Cruz'),
(49, 'Submakin'),
(50, 'Talobatib'),
(51, 'Tigbinan'),
(52, 'Tulay Na Lupa');

INSERT INTO `codes` (`id`, `email`, `code`, `expire`) VALUES
(1, 'charles.bernadez2001@gmail.com', '66462', 1662198206);
INSERT INTO `codes` (`id`, `email`, `code`, `expire`) VALUES
(2, 'charles.bernadez2001@gmail.com', '18423', 1662198546);
INSERT INTO `codes` (`id`, `email`, `code`, `expire`) VALUES
(3, 'charles.bernadez2001@gmail.com', '44513', 1662198798);
INSERT INTO `codes` (`id`, `email`, `code`, `expire`) VALUES
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
(19, 'charles.bernadez2001@gmail.com', '67386', 1662210591),
(20, 'charles.bernadez2001@gmail.com', '80255', 1674662781),
(21, 'charles.bernadez2001@gmail.com', '35660', 1674662910),
(22, 'charles.bernadez2001@gmail.com', '22451', 1674662953),
(23, 'charles.bernadez2001@gmail.com', '52271', 1674663024),
(24, 'charles.bernadez2001@gmail.com', '33116', 1674663045),
(25, 'charles.bernadez2001@gmail.com', '24033', 1674663074);

INSERT INTO `donate_request` (`id`, `user_id`, `volume_request`, `status`, `request_to`, `is_expired`, `created_at`) VALUES
(95, 36, NULL, 0, 51, 0, '2023-04-06 19:57:48');
INSERT INTO `donate_request` (`id`, `user_id`, `volume_request`, `status`, `request_to`, `is_expired`, `created_at`) VALUES
(96, 41, NULL, 1, 36, 0, '2023-04-06 23:19:57');




INSERT INTO `event_donors` (`id`, `announcement_id`, `user_id`, `status`, `donated_volume`, `created_at`) VALUES
(44, 27, 51, 0, NULL, '2022-10-12 00:00:00');
INSERT INTO `event_donors` (`id`, `announcement_id`, `user_id`, `status`, `donated_volume`, `created_at`) VALUES
(45, 1, 51, 0, NULL, '2022-10-12 00:00:00');
INSERT INTO `event_donors` (`id`, `announcement_id`, `user_id`, `status`, `donated_volume`, `created_at`) VALUES
(46, 2, 51, 0, NULL, '2022-10-12 00:00:00');
INSERT INTO `event_donors` (`id`, `announcement_id`, `user_id`, `status`, `donated_volume`, `created_at`) VALUES
(47, 24, 51, 0, NULL, '2022-10-12 00:00:00'),
(48, 27, 50, 1, NULL, '2022-10-16 00:00:00'),
(49, 3, 51, 0, NULL, '2022-10-22 00:00:00'),
(50, 28, 51, 0, NULL, '2022-10-22 00:00:00');

INSERT INTO `roles` (`id`, `permission_id`, `name`) VALUES
(1, NULL, 'Admin');
INSERT INTO `roles` (`id`, `permission_id`, `name`) VALUES
(3, NULL, 'RHU');
INSERT INTO `roles` (`id`, `permission_id`, `name`) VALUES
(4, NULL, 'Hospital');

INSERT INTO `tblblooddonars` (`id`, `FullName`, `MobileNumber`, `EmailId`, `password`, `Gender`, `BirthDay`, `age`, `BloodGroup`, `Purok`, `Barangay`, `Message`, `PostingDate`, `status`, `image`, `can_donate`) VALUES
(36, 'Charles P. Bernadez', '19512659595', 'charles.bernadez2001@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'Male', '2001-01-01', 21, 'A-', 'P-1', 'Bakiad', 'donor', '2022-09-12 18:17:34', 0, './../images/uploads/247093active.webp', 0);
INSERT INTO `tblblooddonars` (`id`, `FullName`, `MobileNumber`, `EmailId`, `password`, `Gender`, `BirthDay`, `age`, `BloodGroup`, `Purok`, `Barangay`, `Message`, `PostingDate`, `status`, `image`, `can_donate`) VALUES
(41, 'John Doe', '23423', 'johndoe@admin.com', '21232f297a57a5a743894a0e4a801fc3', 'Male', '2001-06-05', 21, 'A-', 'p-3', 'cabusay', '12312321', '2022-10-10 12:43:10', 0, NULL, 0);
INSERT INTO `tblblooddonars` (`id`, `FullName`, `MobileNumber`, `EmailId`, `password`, `Gender`, `BirthDay`, `age`, `BloodGroup`, `Purok`, `Barangay`, `Message`, `PostingDate`, `status`, `image`, `can_donate`) VALUES
(43, 'Jane Doe', '12132131', 'jdoe@admin.com', '21232f297a57a5a743894a0e4a801fc3', 'Male', '2001-10-17', 21, 'A-', 'P-1', 'Cabusay', 'asdasdasasdasdasasdasdasasdasdasasdasdasasdasdasasdasdasasdasdasasdasdasasdasdasasdasdasasdasdasasdasdasasdasdasasdasdasasdasdasasdasdasasdasdasasdasdasasdasdasasdasdasasdasdasasdasdasasdasdasasdasdasasdasdasasdasdasasdasdasasdasdasasdasdasasdasdasasdasdasasdasdasasdasdasasdasdasasdasdasasdasdasasdasdasasdasdasasdasdasasdasdasasdasdasasdasdasasdasdas', '2022-10-10 13:41:57', 0, './../images/uploads/538850274931355_5097644930256787_7673320439151991784_n.jpg', 0);
INSERT INTO `tblblooddonars` (`id`, `FullName`, `MobileNumber`, `EmailId`, `password`, `Gender`, `BirthDay`, `age`, `BloodGroup`, `Purok`, `Barangay`, `Message`, `PostingDate`, `status`, `image`, `can_donate`) VALUES
(50, 'Julian Felipe', 'asdasdas', 'jfelipe@admin.com', '21232f297a57a5a743894a0e4a801fc3', 'Male', '2001-01-01', 21, 'A+', 'qwdas', 'dasdsad', 'aqweqew', '2022-10-10 15:19:06', 0, NULL, 1),
(51, 'Ronald Doctor', '0902193111', 'ronald@admin.com', '21232f297a57a5a743894a0e4a801fc3', 'Male', '2001-01-01', 21, 'A-', 'test purok', 'test barangay', 'test message', '2022-10-10 15:20:20', 0, './../images/uploads/886401791910demon-slayer-nezuko-pfp-2.jpg', 0),
(53, 'Johnny Sins', '09486670890', 'sinsBirth@gmail.com', '680aca0199e2c7bef47405c05b5fb6ab', 'Male', '2001-01-01', 21, 'O+', 'P-3', 'Kalamunding', 'Donor ini', '2022-10-17 10:39:45', 0, NULL, 0),
(54, 'JohnPApa', '09486670890', 'papa@gmail.com', '0ac6cd34e2fac333bf0ee3cd06bdcf96', 'Male', '2001-01-01', 21, 'O+', 'P-3', 'Bakiad', 'donor ini', '2022-10-17 10:40:54', 2, NULL, 0),
(56, 'Marina Trench', '19512659595', 'tin@gmail.com', 'd8578edf8458ce06fbc5bb76a58c5ca4', 'Female', '2000-05-23', 23, 'A-', 'P-1', 'Kalamunding (Poblacion)', 'Donor', '2023-03-22 22:20:55', 1, NULL, 0),
(57, 'Ogie Diaz', '19512659595', 'ogie@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Male', '1998-03-23', 25, 'A-', 'P-2', 'Kalamunding (Poblacion)', 'Donor', '2023-03-22 22:28:10', 1, NULL, 0),
(66, 'rico blanco', '12345676789', 'rico@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Male', '1988-07-21', 35, 'A-', 'P-2', 'Kalamunding (Poblacion)', 'Donor', '2023-03-22 22:39:07', 1, NULL, 0),
(69, 'rico blanco', '12345676789', 'ric@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Male', '1995-05-25', 28, 'A-', 'P-3', 'Kalamunding (Poblacion)', 'Donor', '2023-03-22 22:45:56', 1, NULL, 0),
(77, 'rico blanco', '12345676789', 'ic@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Male', '1999-05-27', 24, 'A-', 'P-2', 'Kalamunding (Poblacion)', 'Donor', '2023-03-22 22:55:34', 1, NULL, 0);

INSERT INTO `tblbloodgroup` (`id`, `BloodGroup`, `PostingDate`) VALUES
(1, 'A-', '2017-07-01 04:33:50');
INSERT INTO `tblbloodgroup` (`id`, `BloodGroup`, `PostingDate`) VALUES
(2, 'AB-', '2017-07-01 04:34:00');
INSERT INTO `tblbloodgroup` (`id`, `BloodGroup`, `PostingDate`) VALUES
(3, 'O-', '2017-07-01 04:34:05');
INSERT INTO `tblbloodgroup` (`id`, `BloodGroup`, `PostingDate`) VALUES
(4, 'A-', '2017-07-01 04:34:10'),
(5, 'A+', '2017-07-01 04:34:13'),
(7, 'AB+', '2020-07-17 16:49:36'),
(9, 'O+', '2022-09-09 18:40:17');

INSERT INTO `tblcontactusinfo` (`id`, `Address`, `EmailId`, `ContactNo`) VALUES
(1, 'P-2, Barangay Bakiad																						', 'bakiad2022@gmail.com', '09486670890');


INSERT INTO `tblcontactusquery` (`id`, `name`, `EmailId`, `ContactNumber`, `Message`, `PostingDate`, `status`, `is_opened`) VALUES
(11, 'Charles P. Bernadez', 'charles.bernadez2001@gmail.com', '19512659595', 'Hello Good Day!\r\nI\'m from RHU Labo, we would like to inform you we will be having a Blood Letting Activity this coming September 22, 2022, at Labo Sports Plaza Complex from 8 am to 5 pm. We will be inviting your community to participate in this incoming activity.\r\n\r\nFrom the Municipal Office of RHU Labo.\r\nThank You and Godbless.', '2022-09-09 18:50:56', NULL, 0);
INSERT INTO `tblcontactusquery` (`id`, `name`, `EmailId`, `ContactNumber`, `Message`, `PostingDate`, `status`, `is_opened`) VALUES
(12, 'Red Haired Shanks', 'akagami@gmail.com', '1951265792', 'test on test', '2023-01-20 00:44:58', NULL, 0);


INSERT INTO `tblpages` (`id`, `PageName`, `type`, `detail`) VALUES
(2, 'Announcement', 'announcement', '<div style=\"box-sizing: inherit; color: rgb(41, 43, 44); font-family: -apple-system, system-ui, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, sans-serif; font-size: 16px;\">BLOOD DONATION</div><div style=\"box-sizing: inherit; color: rgb(41, 43, 44); font-family: -apple-system, system-ui, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, sans-serif; font-size: 16px;\">SEPTEMBER 20,2022<br style=\"box-sizing: inherit;\"></div><div style=\"box-sizing: inherit; color: rgb(41, 43, 44); font-family: -apple-system, system-ui, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, sans-serif; font-size: 16px;\">VENUE AT SPORTS PLAZA</div>');
INSERT INTO `tblpages` (`id`, `PageName`, `type`, `detail`) VALUES
(3, 'About Us ', 'aboutus', '<span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 16px; text-align: justify;\">We are the Barangay Bakiad Healthcare Workers aiming and seeking voluntary participation of our residents who are willful donors to support the Philippines Red Cross (PRC) and Department of Health (DOH) Blood Donation Program by sending willing donors to the blood donation site given by the Municipal Rural Health Unit of Labo in our Barangay Health Care Centers. This website will be used in utilizing the use of technology as a way of dissemination of information by advocating the visitors of this site and the users of the mobile application. Also aims for spreading awareness among the resident of Barangay Bakiad.</span>');
INSERT INTO `tblpages` (`id`, `PageName`, `type`, `detail`) VALUES
(4, 'The Need For Blood', 'needforblood', '<p class=\"MsoNormal\" style=\"text-align: justify; \"><span style=\"font-size: 11.5pt; line-height: 107%; font-family: Arial, sans-serif; color: rgb(49, 49, 49); background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\">Napakadaming may sakit ang nangangailangan ng dugo. Magtanong sa inyong barangay o health center, maaaring may blood donation drive sa inyong lugar. Huwag nang antayin may mangailangan ng ating dugo, magbigay tayo ng taos puso. Ang padodonate ng dugo ay isang simpleng gawain na hindi lamang nakakatulong sa iba, kundi nakakatulong din sa ating sarili. Ang dugo na iyong donasyon ay mamaring magbigay ng buhay sa isang tao na nangangailangan nito. Sa pamamagitan ng ating pagkakaisa at pagtulong sa isa\'t isa, maaari nating matugunan ang pangangailangan ng dugo sa ating bansa.</span><span style=\"font-family: &quot;Arial&quot;,sans-serif\"><o:p></o:p></span></p>');
INSERT INTO `tblpages` (`id`, `PageName`, `type`, `detail`) VALUES
(5, 'Blood Tips', 'bloodtips', '<p class=\"MsoNormal\" style=\"text-align: justify; \"><span style=\"font-size: 11.5pt; line-height: 107%; font-family: Arial, sans-serif; color: rgb(49, 49, 49); background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\">Mga Dapat Malaman Bago Magdonate ng Dugo: Nasa 350 hanggang 500 ml na dugo ang kinukuha sa isang session ng blood donation. Mapapalitan ang nawalang dugo sa loob ng tatlo hanggang apat na linggo. Ang blood donation ay isinasagawa sa loob ng 25 minuto. Ang isang taong healthy ay maaaring magdonate ng dugo every three months. Ang bawat unit ng dugong nakolekta ay ineexamine bago isalin bago isalin sa pasyente para malaman kung ito ba ay positibo sa HIV, Malaria, Sysphilis, Hepatitis B at C. Maaaring magdonate kung: Nasa mabuting kalusugan at hindi puyat at uminom ng alak bago ang donasyon. Nasa edad 16 hanggang 65 taong gulang. May timbang na hindi bababa ng 110 pounds. Ang blood pressure ay nasa pagitan ng Systolic: 90-160 mmHg, Diastolic: 60-100 mmHg. Pasado sa physical and health history assessments.</span><span style=\"font-family: &quot;Arial&quot;,sans-serif\"><o:p></o:p></span></p>'),
(6, 'Who you could Help', 'whocouldyouhelp', '<p class=\"MsoNormal\" style=\"text-align: justify; \"><span style=\"font-size: 11.5pt; line-height: 107%; font-family: Arial, sans-serif; color: rgb(49, 49, 49); background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\">Kapag nagbigay ka ng dugo, ikaw ay tumutulong sa mga pasyenteng nangangailangan ng dugo para sa kanilang mga pangangailangan sa kalusugan, tulad ng mga pasyente na may leukemia, anemia, o kailangan ng transplants sa organ. Ang dugo na iyong ibinigay ay maaari ring gamitin para sa mga emergency cases, tulad ng sa mga trahedya o aksidente. Sa pamamagitan ng pagbibigay ng dugo, ikaw ay nakakatulong sa pagpapahaba ng buhay ng mga tao at pagbibigay ng pag-asa sa kanilang buhay.</span><span style=\"font-family: &quot;Arial&quot;,sans-serif\"><o:p></o:p></span></p>');


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;