-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 15, 2013 at 05:17 PM
-- Server version: 5.5.20
-- PHP Version: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hr_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `hr_accounts`
--

DROP TABLE IF EXISTS `hr_accounts`;
CREATE TABLE IF NOT EXISTS `hr_accounts` (
  `account_id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(45) DEFAULT NULL,
  `mname` varchar(45) DEFAULT NULL,
  `lname` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `address` varchar(45) DEFAULT NULL,
  `profession` int(11) DEFAULT NULL,
  `DOB` date DEFAULT NULL,
  `gender` varchar(15) DEFAULT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `active` enum('1','0') DEFAULT '1',
  `type_id` int(11) DEFAULT NULL,
  `resume_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`account_id`),
  KEY `type_id` (`type_id`),
  KEY `resume_id` (`resume_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `hr_accounts`
--

INSERT INTO `hr_accounts` (`account_id`, `fname`, `mname`, `lname`, `email`, `phone`, `address`, `profession`, `DOB`, `gender`, `username`, `password`, `active`, `type_id`, `resume_id`) VALUES
(1, 'administrator', NULL, NULL, 'admin', NULL, NULL, NULL, NULL, NULL, NULL, '21232f297a57a5a743894a0e4a801fc3', '1', 1, NULL),
(2, 'dummy1', 'dummy1', 'dummy1', 'dummy1@yahoo.com', '09270000000', 'Cagayan de Oro City', 0, '0000-00-00', 'Male', NULL, '275876e34cf609db118f3d84b799a790', '1', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `hr_account_type`
--

DROP TABLE IF EXISTS `hr_account_type`;
CREATE TABLE IF NOT EXISTS `hr_account_type` (
  `type_id` int(11) NOT NULL AUTO_INCREMENT,
  `type_name` varchar(45) DEFAULT NULL,
  `alevel` int(11) DEFAULT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `hr_account_type`
--

INSERT INTO `hr_account_type` (`type_id`, `type_name`, `alevel`) VALUES
(1, 'human resource', 1),
(2, 'staff', 2),
(3, 'volunteer', 3);

-- --------------------------------------------------------

--
-- Table structure for table `hr_education`
--

DROP TABLE IF EXISTS `hr_education`;
CREATE TABLE IF NOT EXISTS `hr_education` (
  `educ_id` int(11) NOT NULL AUTO_INCREMENT,
  `degree` varchar(50) NOT NULL,
  `location` varchar(50) NOT NULL,
  `school_name` mediumtext,
  `year_started` varchar(50) DEFAULT NULL,
  `year_ended` varchar(50) DEFAULT NULL,
  `area_of_study` varchar(45) DEFAULT NULL,
  `resume_id` int(11) DEFAULT NULL,
  `active` enum('1','0') NOT NULL DEFAULT '1',
  PRIMARY KEY (`educ_id`),
  KEY `resume_id` (`resume_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `hr_education`
--

INSERT INTO `hr_education` (`educ_id`, `degree`, `location`, `school_name`, `year_started`, `year_ended`, `area_of_study`, `resume_id`, `active`) VALUES
(1, 'PhD.', 'CDO City', 'Xavier University', '2005', '2010', 'Biology', 1, '1');

-- --------------------------------------------------------

--
-- Table structure for table `hr_jobs`
--

DROP TABLE IF EXISTS `hr_jobs`;
CREATE TABLE IF NOT EXISTS `hr_jobs` (
  `job_id` int(11) NOT NULL AUTO_INCREMENT,
  `job_title` varchar(45) DEFAULT NULL,
  `job_description` mediumtext,
  `location` varchar(45) DEFAULT NULL,
  `number_of_employee` int(11) DEFAULT NULL,
  `posted_date` date DEFAULT NULL,
  `plannned_start` date NOT NULL,
  `contract_start_date` date DEFAULT NULL,
  `contract_end_date` date DEFAULT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `cat_id` int(11) NOT NULL,
  `account_id` int(11) DEFAULT NULL,
  `active` enum('1','0') DEFAULT '1',
  PRIMARY KEY (`job_id`),
  KEY `account_id` (`account_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `hr_jobs`
--

INSERT INTO `hr_jobs` (`job_id`, `job_title`, `job_description`, `location`, `number_of_employee`, `posted_date`, `plannned_start`, `contract_start_date`, `contract_end_date`, `status`, `cat_id`, `account_id`, `active`) VALUES
(1, 'Medical Mission', 'I need 10 Doctors.', 'Brgy. Lumbia, CDO', 10, '2012-10-15', '0000-00-00', NULL, NULL, '1', 32, 1, '1'),
(2, 'Nurse', 'asd', 'center', 4, '2012-12-07', '0000-00-00', NULL, NULL, '1', 1, 1, '1');

-- --------------------------------------------------------

--
-- Table structure for table `hr_job_applicant`
--

DROP TABLE IF EXISTS `hr_job_applicant`;
CREATE TABLE IF NOT EXISTS `hr_job_applicant` (
  `applicant_id` int(11) NOT NULL AUTO_INCREMENT,
  `applied_date` date DEFAULT NULL,
  `hired` enum('1','0') NOT NULL DEFAULT '0',
  `hired_date` date DEFAULT NULL,
  `fired` enum('1','0') NOT NULL DEFAULT '0',
  `fired_date` date NOT NULL,
  `reject` enum('1','0') NOT NULL,
  `job_id` int(11) DEFAULT NULL,
  `account_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`applicant_id`),
  KEY `job_id` (`job_id`),
  KEY `account_id` (`account_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `hr_job_applicant`
--

INSERT INTO `hr_job_applicant` (`applicant_id`, `applied_date`, `hired`, `hired_date`, `fired`, `fired_date`, `reject`, `job_id`, `account_id`) VALUES
(1, '2012-10-15', '1', '2012-10-15', '0', '0000-00-00', '1', 1, 2),
(2, '2013-01-16', '1', '2013-01-16', '0', '0000-00-00', '1', 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `hr_job_categories`
--

DROP TABLE IF EXISTS `hr_job_categories`;
CREATE TABLE IF NOT EXISTS `hr_job_categories` (
  `cat_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  `cat_name` varchar(150) NOT NULL DEFAULT '',
  `active` enum('1','0') NOT NULL DEFAULT '1',
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hr_job_categories`
--

INSERT INTO `hr_job_categories` (`cat_id`, `cat_name`, `active`) VALUES
(1, 'Accounting & Finance', '1'),
(2, 'Administration', '1'),
(3, 'Advertising/PR', '1'),
(4, 'Casino Credit', '1'),
(5, 'Casino Operations', '1'),
(6, 'Catering/Convention Services', '1'),
(7, 'Child Care', '1'),
(8, 'Community & Government Relations', '1'),
(9, 'Compliance', '1'),
(10, 'Construction & Project Development', '1'),
(11, 'Consultant', '1'),
(12, 'Design & Construction', '1'),
(13, 'Development/Real Estate', '1'),
(14, 'Engineering', '1'),
(15, 'Entertainment', '1'),
(16, 'Environmental Health/Safety', '1'),
(17, 'Executive Management', '1'),
(18, 'Facilities', '1'),
(19, 'Food/Beverage', '1'),
(20, 'Golf', '1'),
(21, 'Hotel Operations', '1'),
(22, 'HR & Training', '1'),
(23, 'Information Technology', '1'),
(24, 'Internal Audit', '1'),
(25, 'Internship', '1'),
(26, 'Internet Gaming', '1'),
(27, 'Internet', '1'),
(28, 'Investor Relations', '1'),
(29, 'Legal/General Counsel', '1'),
(30, 'Manufacturing', '1'),
(31, 'Marine Operations', '1'),
(32, 'Medical', '1'),
(33, 'Office Services', '1'),
(34, 'Player Development', '1'),
(35, 'Purchasing/Receiving', '1'),
(36, 'Retail Sales', '1'),
(37, 'Risk Management', '1'),
(38, 'Sales & Marketing', '1'),
(39, 'Security', '1'),
(40, 'Slot Management', '1'),
(41, 'Software', '1'),
(42, 'Spa Operations', '1'),
(43, 'Surveillance', '1'),
(44, 'Transportation/Parking', '1'),
(45, 'Part-time', '1'),
(46, 'Temporary', '1'),
(47, 'Sumer', '1'),
(48, 'Seasonal', '1'),
(49, 'Internships', '1');

-- --------------------------------------------------------

--
-- Table structure for table `hr_notifications`
--

DROP TABLE IF EXISTS `hr_notifications`;
CREATE TABLE IF NOT EXISTS `hr_notifications` (
  `notification_id` int(11) NOT NULL AUTO_INCREMENT,
  `message` varchar(500) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `read` enum('1','0') NOT NULL DEFAULT '1',
  `account_id` int(11) DEFAULT NULL,
  `active` enum('1','0') DEFAULT '1',
  PRIMARY KEY (`notification_id`),
  KEY `account_id` (`account_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `hr_notifications`
--

INSERT INTO `hr_notifications` (`notification_id`, `message`, `date`, `read`, `account_id`, `active`) VALUES
(1, 'CONGRATULATIONS!!! You just been invited for an interview for applying  Medical Mission Job. Please Come in the Ecoville Office after two business hours', '2012-10-15', '1', 2, '0'),
(2, 'CONGRATULATIONS!!! You just been invited for an interview for applying  Nurse Job. Please Come in the Ecoville Office after two business hours', '2013-01-16', '1', 2, '1');

-- --------------------------------------------------------

--
-- Table structure for table `hr_resume`
--

DROP TABLE IF EXISTS `hr_resume`;
CREATE TABLE IF NOT EXISTS `hr_resume` (
  `resume_id` int(11) NOT NULL AUTO_INCREMENT,
  `objective` mediumtext NOT NULL,
  `account_id` int(11) NOT NULL,
  `active` enum('1','0') NOT NULL DEFAULT '1',
  PRIMARY KEY (`resume_id`),
  KEY `account_id` (`account_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `hr_resume`
--

INSERT INTO `hr_resume` (`resume_id`, `objective`, `account_id`, `active`) VALUES
(1, 'To help and to serve the people.', 2, '1');

-- --------------------------------------------------------

--
-- Table structure for table `hr_skill_catalog`
--

DROP TABLE IF EXISTS `hr_skill_catalog`;
CREATE TABLE IF NOT EXISTS `hr_skill_catalog` (
  `skill_id` int(11) NOT NULL AUTO_INCREMENT,
  `skill` varchar(50) NOT NULL,
  `job_type_id` int(11) NOT NULL,
  `active` enum('1','0') NOT NULL DEFAULT '1',
  PRIMARY KEY (`skill_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `hr_skill_catalog`
--

INSERT INTO `hr_skill_catalog` (`skill_id`, `skill`, `job_type_id`, `active`) VALUES
(1, 'Dentist', 32, '1'),
(2, 'Civil Engineer', 14, '1');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hr_accounts`
--
ALTER TABLE `hr_accounts`
  ADD CONSTRAINT `hr_accounts_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `hr_account_type` (`type_id`),
  ADD CONSTRAINT `hr_accounts_ibfk_2` FOREIGN KEY (`resume_id`) REFERENCES `hr_resume` (`resume_id`);

--
-- Constraints for table `hr_education`
--
ALTER TABLE `hr_education`
  ADD CONSTRAINT `hr_education_ibfk_1` FOREIGN KEY (`resume_id`) REFERENCES `hr_resume` (`resume_id`);

--
-- Constraints for table `hr_jobs`
--
ALTER TABLE `hr_jobs`
  ADD CONSTRAINT `hr_jobs_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `hr_accounts` (`account_id`);

--
-- Constraints for table `hr_job_applicant`
--
ALTER TABLE `hr_job_applicant`
  ADD CONSTRAINT `hr_job_applicant_ibfk_1` FOREIGN KEY (`job_id`) REFERENCES `hr_jobs` (`job_id`),
  ADD CONSTRAINT `hr_job_applicant_ibfk_2` FOREIGN KEY (`account_id`) REFERENCES `hr_accounts` (`account_id`);

--
-- Constraints for table `hr_notifications`
--
ALTER TABLE `hr_notifications`
  ADD CONSTRAINT `hr_notifications_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `hr_accounts` (`account_id`);

--
-- Constraints for table `hr_resume`
--
ALTER TABLE `hr_resume`
  ADD CONSTRAINT `hr_resume_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `hr_accounts` (`account_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
