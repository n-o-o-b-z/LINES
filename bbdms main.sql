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
  `updationDate` timestamp NOT NULL,
  `Full_name` varchar(50) NOT NULL DEFAULT 'NULL',
  `status` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

DROP TABLE IF EXISTS `donate_request`;
CREATE TABLE `donate_request` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `volume_request` int DEFAULT NULL,
  `status` int DEFAULT '0',
  `request_to` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `donation_history`;
CREATE TABLE `donation_history` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `blood_type_id` int NOT NULL,
  `donation_date` timestamp NOT NULL,
  `status` int NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `event_donors`;
CREATE TABLE `event_donors` (
  `id` int NOT NULL AUTO_INCREMENT,
  `announcement_id` int NOT NULL,
  `user_id` int NOT NULL,
  `status` int NOT NULL,
  `donated_volume` int DEFAULT NULL,
  `created_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `permission_id` int DEFAULT NULL,
  `name` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  PRIMARY KEY (`id`),
  UNIQUE KEY `EmailId` (`EmailId`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=latin1;

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

INSERT INTO `admin` (`id`, `role_id`, `Email`, `Password`, `updationDate`, `Full_name`, `status`) VALUES
(1, 1, 'charles.bernadez2001@gmail.com ', '21232f297a57a5a743894a0e4a801fc3', '2022-09-03 21:09:31', 'Charles Bernadez', 0);
INSERT INTO `admin` (`id`, `role_id`, `Email`, `Password`, `updationDate`, `Full_name`, `status`) VALUES
(3, 3, 'rhu@admin.com', '21232f297a57a5a743894a0e4a801fc3', '2022-10-09 18:11:56', 'RHU', 0);
INSERT INTO `admin` (`id`, `role_id`, `Email`, `Password`, `updationDate`, `Full_name`, `status`) VALUES
(4, 4, 'hospital@gmail.com', '21232f297a57a5a743894a0e4a801fc3', '2022-10-09 18:16:14', 'Hospital', 2);

INSERT INTO `announcement` (`id`, `title`, `date`, `banner`, `location`, `organizer`, `details`, `is_hidden`) VALUES
(1, 'Blood camps', '2022-10-31 03:25:00', NULL, 'Omamuri', 'Carlo Cabanelas', NULL, 0);
INSERT INTO `announcement` (`id`, `title`, `date`, `banner`, `location`, `organizer`, `details`, `is_hidden`) VALUES
(2, 'White blood', '2022-07-10 09:00:00', NULL, 'Lady Anne', 'Charles Bernadez', NULL, 0);
INSERT INTO `announcement` (`id`, `title`, `date`, `banner`, `location`, `organizer`, `details`, `is_hidden`) VALUES
(3, 'White blood', '2022-07-10 09:00:00', NULL, 'Lady Anne', 'Charles Bernadez', 'asdasdasd', 1);
INSERT INTO `announcement` (`id`, `title`, `date`, `banner`, `location`, `organizer`, `details`, `is_hidden`) VALUES
(24, 'DAET LADY ANNE', '2022-10-12 09:51:00', NULL, 'LADY ANNE', 'Carlo Cabanelas', 'PUNTA KAYO MGA ULOLS', 0),
(27, 'Nezuko!', '2022-10-13 14:36:00', '../../images/uploads/844021demon-slayer-nezuko-pfp-2.jpg', 'Nagoya, Japan', 'Masashi Kishimoto', 'Hello ako si Nezuko!', 0);

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

INSERT INTO `donate_request` (`id`, `user_id`, `volume_request`, `status`, `request_to`, `created_at`) VALUES
(66, 43, NULL, 0, 51, NULL);




INSERT INTO `event_donors` (`id`, `announcement_id`, `user_id`, `status`, `donated_volume`, `created_at`) VALUES
(44, 27, 51, 0, NULL, '2022-10-12 00:00:00');
INSERT INTO `event_donors` (`id`, `announcement_id`, `user_id`, `status`, `donated_volume`, `created_at`) VALUES
(45, 1, 51, 0, NULL, '2022-10-12 00:00:00');
INSERT INTO `event_donors` (`id`, `announcement_id`, `user_id`, `status`, `donated_volume`, `created_at`) VALUES
(46, 2, 51, 0, NULL, '2022-10-12 00:00:00');
INSERT INTO `event_donors` (`id`, `announcement_id`, `user_id`, `status`, `donated_volume`, `created_at`) VALUES
(47, 24, 51, 0, NULL, '2022-10-12 00:00:00');

INSERT INTO `roles` (`id`, `permission_id`, `name`) VALUES
(1, NULL, 'Admin');
INSERT INTO `roles` (`id`, `permission_id`, `name`) VALUES
(3, NULL, 'RHU');
INSERT INTO `roles` (`id`, `permission_id`, `name`) VALUES
(4, NULL, 'Hospital');

INSERT INTO `tblblooddonars` (`id`, `FullName`, `MobileNumber`, `EmailId`, `password`, `Gender`, `BirthDay`, `age`, `BloodGroup`, `Purok`, `Barangay`, `Message`, `PostingDate`, `status`) VALUES
(36, 'Charles P. Bernadez', '19512659595', 'charles.bernadez2001@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'Male', '2001-01-01', NULL, 'O+', 'P-1', 'Bakiad', 'donor', '2022-09-12 18:17:34', 0);
INSERT INTO `tblblooddonars` (`id`, `FullName`, `MobileNumber`, `EmailId`, `password`, `Gender`, `BirthDay`, `age`, `BloodGroup`, `Purok`, `Barangay`, `Message`, `PostingDate`, `status`) VALUES
(40, 'Dexter Macabangon', '12312', 'dex@example.com', '21232f297a57a5a743894a0e4a801fc3', 'Male', '2000-01-01', 22, 'A-', 'wqeqwe`qw', 'qweqwe`', 'waedasdasdas', '2022-10-05 23:16:26', 0);
INSERT INTO `tblblooddonars` (`id`, `FullName`, `MobileNumber`, `EmailId`, `password`, `Gender`, `BirthDay`, `age`, `BloodGroup`, `Purok`, `Barangay`, `Message`, `PostingDate`, `status`) VALUES
(41, 'John Doe', '23423', 'johndoe@admin.com', '21232f297a57a5a743894a0e4a801fc3', 'Male', '2001-06-05', 21, 'A-', 'p-3', 'cabusay', '12312321', '2022-10-10 12:43:10', 0);
INSERT INTO `tblblooddonars` (`id`, `FullName`, `MobileNumber`, `EmailId`, `password`, `Gender`, `BirthDay`, `age`, `BloodGroup`, `Purok`, `Barangay`, `Message`, `PostingDate`, `status`) VALUES
(43, 'Jane Doe', 'asdasdas', 'jdoe@admin.com', '21232f297a57a5a743894a0e4a801fc3', 'Male', '2001-10-17', 21, 'A-', 'P-1', 'Cabusay', 'asdasdas', '2022-10-10 13:41:57', 0),
(50, 'Julian Felipe', 'asdasdas', 'jfelipe@admin.com', '21232f297a57a5a743894a0e4a801fc3', 'Male', '2001-01-01', 21, 'A+', 'qwdas', 'dasdsad', 'aqweqew', '2022-10-10 15:19:06', 0),
(51, 'Ronald Doctor', '0902193111', 'ronald@admin.com', '21232f297a57a5a743894a0e4a801fc3', 'Male', '2001-01-01', 21, 'A-', 'test purok', 'test barangay', 'test message', '2022-10-10 15:20:20', 0);

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
(8, 'AKO LANG TO', '2022-09-06 18:08:15'),
(9, 'O+', '2022-09-09 18:40:17'),
(30, 'teasd', '2022-10-07 22:48:23');

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