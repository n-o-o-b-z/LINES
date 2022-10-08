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
  `Email` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `updationDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `announcement`;
CREATE TABLE `announcement` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `location` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `organizer` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `tbl_active_donors`;
CREATE TABLE `tbl_active_donors` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `blood_type_id` int NOT NULL,
  `donation_date` timestamp NOT NULL,
  `status` int NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `tblbloodgroup`;
CREATE TABLE `tblbloodgroup` (
  `id` int NOT NULL AUTO_INCREMENT,
  `BloodGroup` varchar(20) DEFAULT NULL,
  `PostingDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `tblpages`;
CREATE TABLE `tblpages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `PageName` varchar(255) DEFAULT NULL,
  `type` varchar(255) NOT NULL DEFAULT '',
  `detail` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

INSERT INTO `admin` (`id`, `Email`, `Password`, `updationDate`) VALUES
(1, 'charles.bernadez2001@gmail.com ', '21232f297a57a5a743894a0e4a801fc3', '2022-09-03 21:09:31');


INSERT INTO `announcement` (`id`, `title`, `date`, `location`, `organizer`) VALUES
(1, 'Blood camp', '2022-07-07 01:00:00', 'Omamuri', 'Carlo Cabanela');
INSERT INTO `announcement` (`id`, `title`, `date`, `location`, `organizer`) VALUES
(2, 'White blood', '2022-07-10 09:00:00', 'Lady Anne', 'Charles Bernadez');
INSERT INTO `announcement` (`id`, `title`, `date`, `location`, `organizer`) VALUES
(3, 'White blood', '2022-07-10 09:00:00', 'Lady Anne', 'Charles Bernadez');

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
(19, 'charles.bernadez2001@gmail.com', '67386', 1662210591);



INSERT INTO `tblblooddonars` (`id`, `FullName`, `MobileNumber`, `EmailId`, `password`, `Gender`, `BirthDay`, `age`, `BloodGroup`, `Purok`, `Barangay`, `Message`, `PostingDate`, `status`) VALUES
(36, 'Charles P. Bernadez', '19512659595', 'charles.bernadez2001@gmail.com', '', 'Male', '2001-01-01', NULL, 'O+', 'P-1', 'Bakiad', 'donor', '2022-09-12 18:17:34', 1);
INSERT INTO `tblblooddonars` (`id`, `FullName`, `MobileNumber`, `EmailId`, `password`, `Gender`, `BirthDay`, `age`, `BloodGroup`, `Purok`, `Barangay`, `Message`, `PostingDate`, `status`) VALUES
(37, 'Dexter Macabangon', '12312', 'dex1@example.com', '', 'Male', '2000-01-01', 22, 'A-', 'wqeqwe`qw', 'qweqwe`', 'waedasdasdas', '2022-10-05 22:29:21', 1);
INSERT INTO `tblblooddonars` (`id`, `FullName`, `MobileNumber`, `EmailId`, `password`, `Gender`, `BirthDay`, `age`, `BloodGroup`, `Purok`, `Barangay`, `Message`, `PostingDate`, `status`) VALUES
(38, 'Dexter Macabangon', '12312', 'dex2@example.com', '', 'Male', '2000-01-01', 22, 'A-', 'wqeqwe`qw', 'qweqwe`', 'waedasdasdas', '2022-10-05 22:52:07', 1);
INSERT INTO `tblblooddonars` (`id`, `FullName`, `MobileNumber`, `EmailId`, `password`, `Gender`, `BirthDay`, `age`, `BloodGroup`, `Purok`, `Barangay`, `Message`, `PostingDate`, `status`) VALUES
(39, 'Charles Bernadez', '01239210391', 'dex@example.com', '21232f297a57a5a743894a0e4a801fc3', 'Male', '2001-01-01', 21, 'A-', 'P-1', 'Bakiad', 'i want to be a hero', '2022-10-05 23:02:15', 0),
(40, 'Dexter Macabangon', '12312', 'dex@example.com', '', 'Male', '2000-01-01', 22, 'A-', 'wqeqwe`qw', 'qweqwe`', 'waedasdasdas', '2022-10-05 23:16:26', 0);

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
(8, 'RH-', '2022-09-06 18:08:15'),
(9, 'O+', '2022-09-09 18:40:17');

INSERT INTO `tblcontactusinfo` (`id`, `Address`, `EmailId`, `ContactNo`) VALUES
(1, 'P-2, Barangay Bakiad																						', 'bakiad2022@gmail.com', '09486670890');


INSERT INTO `tblcontactusquery` (`id`, `name`, `EmailId`, `ContactNumber`, `Message`, `PostingDate`, `status`) VALUES
(11, 'Charles P. Bernadez', 'charles.bernadez2001@gmail.com', '19512659595', 'Hello Good Day!\r\nI\'m from RHU Labo, we would like to inform you we will be having a Blood Letting Activity this coming September 22, 2022, at Labo Sports Plaza Complex from 8 am to 5 pm. We will be inviting your community to participate in this incoming activity.\r\n\r\nFrom the Municipal Office of RHU Labo.\r\nThank You and Godbless.', '2022-09-09 18:50:56', NULL);


INSERT INTO `tblpages` (`id`, `PageName`, `type`, `detail`) VALUES
(2, 'Announcement', 'announcement', '<div style=\"box-sizing: inherit; color: rgb(41, 43, 44); font-family: -apple-system, system-ui, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, sans-serif; font-size: 16px;\">BLOOD DONATION</div><div style=\"box-sizing: inherit; color: rgb(41, 43, 44); font-family: -apple-system, system-ui, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, sans-serif; font-size: 16px;\">SEPTEMBER 20,2022<br style=\"box-sizing: inherit;\"></div><div style=\"box-sizing: inherit; color: rgb(41, 43, 44); font-family: -apple-system, system-ui, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, sans-serif; font-size: 16px;\">VENUE AT SPORTS PLAZA</div>');
INSERT INTO `tblpages` (`id`, `PageName`, `type`, `detail`) VALUES
(3, 'About Us ', 'aboutus', '<span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 16px; text-align: justify;\">We are the Barangay Bakiad Healthcare Workers aiming and seeking voluntary participation of our residents who are willful donors to support the Philippines Red Cross (PRC) and Department of Health (DOH) Blood Donation Program by sending willing donors to the blood donation site given by the Municipal Rural Health Unit of Labo in our Barangay Health Care Centers. This website will be used in utilizing the use of technology as a way of dissemination of information by advocating the visitors of this site and the users of the mobile application. Also aims for spreading awareness among the resident of Barangay Bakiad.</span>');
INSERT INTO `tblpages` (`id`, `PageName`, `type`, `detail`) VALUES
(4, 'The Need For Blood', 'needforblood', '<p class=\"MsoNormal\" style=\"text-align: justify; \"><span style=\"font-size: 11.5pt; line-height: 107%; font-family: Arial, sans-serif; color: rgb(49, 49, 49); background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\">Napakadaming may sakit ang\nnangangailangan ng dugo. Magtanong sa inyong barangay o health center, maaaring\nmay blood donation drive sa inyong lugar. Huwag nang antayin may mangailangan\nng ating dugo, magbigay tayo ng taos puso.</span><span style=\"font-family:\n&quot;Arial&quot;,sans-serif\"><o:p></o:p></span></p>		');
INSERT INTO `tblpages` (`id`, `PageName`, `type`, `detail`) VALUES
(5, 'Blood Tips', 'bloodtips', '<p class=\"MsoNormal\" style=\"text-align: justify; \"><span style=\"font-size: 11.5pt; line-height: 107%; font-family: Arial, sans-serif; color: rgb(49, 49, 49); background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\">Huwag kumain bago mag doante. Gawin ito pagkatapos. Sa Katunayan, nagbibigay pa sila ng meryenda habang nagdodonate. Maari naman uminom ng tubig bago maga donate. Huwag magdonate kung masama ang pakiramdam. Huwag manigarilyo at uminom ng alak bago mag donate. At higit sa lahat, huwag magpupuyat sa gabi bago mag donate.&nbsp;</span></p>				\n										'),
(6, 'Who you could Help', 'whocouldyouhelp', '<p class=\"MsoNormal\" style=\"text-align: justify; \"><span style=\"font-size: 11.5pt; line-height: 107%; font-family: Arial, sans-serif; color: rgb(49, 49, 49); background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\">Napakadaming may sakit ang nangangailangan ng dugo. Magtanong sa inyong barangay o health center, maaaring may blood donation drive sa inyong lugar. Huwag nang antayin may mangailangan ng ating dugo, magbigay tayo ng taos puso.</span><span style=\"font-family: &quot;Arial&quot;,sans-serif\"><o:p></o:p></span></p>');


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;