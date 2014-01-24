-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 24, 2014 at 07:14 PM
-- Server version: 5.6.12
-- PHP Version: 5.4.16

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `reqer`
--

-- --------------------------------------------------------

--
-- Table structure for table `actor`
--

CREATE TABLE IF NOT EXISTS `actor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `alias` text NOT NULL,
  `inherits` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `project_id` (`project_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `actor`
--

INSERT INTO `actor` (`id`, `project_id`, `name`, `description`, `alias`, `inherits`) VALUES
(1, 47, 'User', 'A public user of the website.', '', 0),
(2, 47, 'Member', 'A user who has signed up to the website and has credentials.', '', 1),
(3, 47, 'Administrator', '', '', 2),
(4, 47, 'PayPal', '', '', 0),
(5, 48, 'Member', 'User of the system who has an account.', 'none', -1);

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE IF NOT EXISTS `addresses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `address1` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `postcode` varchar(255) DEFAULT NULL,
  `state_id` int(11) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `foreign_key` int(11) NOT NULL DEFAULT '0',
  `type` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=user, 2=company, 3=org, 4=project, 5=contact',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `authassignment`
--

CREATE TABLE IF NOT EXISTS `authassignment` (
  `itemname` varchar(64) NOT NULL,
  `userid` varchar(64) NOT NULL,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`itemname`,`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `authitem`
--

CREATE TABLE IF NOT EXISTS `authitem` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `authitem`
--

INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES
('admin', 2, 'ADMIN - Users who are administrators', NULL, 'N;'),
('author', 2, 'AUTHOR - Users who can create content', NULL, 'N;'),
('editor', 2, 'EDITOR - Users who can publish', NULL, 'N;'),
('reports', 0, 'View reports', NULL, 'N;'),
('reports.view', 2, 'report user', NULL, 'N;'),
('users', 0, 'administer users', NULL, 'N;');

-- --------------------------------------------------------

--
-- Table structure for table `authitemchild`
--

CREATE TABLE IF NOT EXISTS `authitemchild` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `changelog`
--

CREATE TABLE IF NOT EXISTS `changelog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `object` varchar(60) NOT NULL,
  `action` varchar(60) NOT NULL,
  `data` text NOT NULL,
  `modified_user` int(11) NOT NULL,
  `modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE IF NOT EXISTS `company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `foreignid` varchar(255) DEFAULT NULL COMMENT 'ID in external system',
  `name` varchar(255) NOT NULL,
  `description` text,
  `owner_id` int(11) NOT NULL,
  `companyowner_id` int(11) NOT NULL DEFAULT '0',
  `type` int(4) NOT NULL COMMENT '1=Builder, 2=Organisation, 3=PM, 4=Consult',
  `organisationtype` int(4) NOT NULL DEFAULT '0' COMMENT 'type if is organisation 1=supplier, 2=subcontract, 3=client, 4=consultant',
  `trade_id` int(11) NOT NULL DEFAULT '0',
  `modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=507 ;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `foreignid`, `name`, `description`, `owner_id`, `companyowner_id`, `type`, `organisationtype`, `trade_id`, `modified_date`) VALUES
(503, NULL, 'Test Company', 'Testing company', 113, -1, 1, 0, 0, '2013-12-12 21:06:54'),
(504, NULL, 'Test Company', 'ouoeuo', 113, 503, 1, 0, 0, '2013-12-12 21:10:26'),
(505, NULL, 'Test Company', 'ouoeuo', 113, 504, 1, 0, 0, '2013-12-12 21:10:57'),
(506, NULL, 'Knowlen Mowlen', 'aoeu', 113, 505, 2, 0, 0, '2013-12-20 06:00:13');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE IF NOT EXISTS `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '0 = no user',
  `owner_id` int(11) NOT NULL,
  `companyowner_id` int(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL COMMENT 'the company the contact works for',
  PRIMARY KEY (`id`),
  KEY `company_id` (`company_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `firstname`, `lastname`, `phone`, `mobile`, `email`, `user_id`, `owner_id`, `companyowner_id`, `company_id`) VALUES
(1, 'Bill', 'Knowlen', '099090', '909090', 'bill@test.com', 0, 113, 505, 506);

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE IF NOT EXISTS `countries` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `iso` varchar(45) DEFAULT NULL,
  `iso3` varchar(45) DEFAULT NULL,
  `fips` varchar(45) DEFAULT NULL,
  `country` varchar(45) DEFAULT NULL,
  `continent` varchar(45) DEFAULT NULL,
  `currency_code` varchar(45) DEFAULT NULL,
  `currency_name` varchar(45) DEFAULT NULL,
  `phone_prefix` varchar(45) DEFAULT NULL,
  `postal_code` varchar(45) DEFAULT NULL,
  `languages` varchar(45) DEFAULT NULL,
  `geonameid` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `diary`
--

CREATE TABLE IF NOT EXISTS `diary` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `project_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `document`
--

CREATE TABLE IF NOT EXISTS `document` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=project, 2=package',
  `foreign_key` int(11) NOT NULL,
  `document_type` int(11) NOT NULL,
  `modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `foriegn_key` (`foreign_key`),
  KEY `modified` (`modified`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `documenttype`
--

CREATE TABLE IF NOT EXISTS `documenttype` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` bigint(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=61 ;

--
-- Dumping data for table `documenttype`
--

INSERT INTO `documenttype` (`id`, `company_id`, `name`, `description`) VALUES
(56, 505, 'Architectural', 'Architectural'),
(57, 505, 'Engineering', 'Engineering'),
(58, 505, 'Services', 'Services'),
(59, 505, 'Planning', 'Planning'),
(60, 505, 'General', 'General');

-- --------------------------------------------------------

--
-- Table structure for table `documentversion`
--

CREATE TABLE IF NOT EXISTS `documentversion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `document_id` int(11) NOT NULL,
  `version` varchar(30) NOT NULL,
  `date` date NOT NULL,
  `file` varchar(255) NOT NULL,
  `modified` int(11) NOT NULL,
  `modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `modified` (`modified`),
  KEY `document_id` (`document_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `flow`
--

CREATE TABLE IF NOT EXISTS `flow` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `usecase_id` int(11) NOT NULL,
  `main` tinyint(1) NOT NULL,
  `startstep_id` int(11) NOT NULL,
  `rejoinstep_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `usecase_id` (`usecase_id`),
  KEY `startstep_id` (`startstep_id`),
  KEY `rejoinstep_id` (`rejoinstep_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=54 ;

--
-- Dumping data for table `flow`
--

INSERT INTO `flow` (`id`, `name`, `usecase_id`, `main`, `startstep_id`, `rejoinstep_id`) VALUES
(41, 'Main', 8, 1, 0, 0),
(42, 'Main', 9, 1, 0, 0),
(43, 'Main', 10, 1, 0, 0),
(44, 'Main', 11, 1, 0, 0),
(45, 'A', 8, 0, 55, 55),
(46, 'A', 9, 0, 58, 58),
(47, 'Main', 12, 1, 0, 0),
(48, 'Main', 13, 1, 0, 0),
(49, 'Main', 14, 1, 0, 0),
(50, 'Main', 15, 1, 0, 0),
(51, 'Main', 16, 1, 0, 0),
(53, 'Main', 18, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `follower`
--

CREATE TABLE IF NOT EXISTS `follower` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contact_id` int(11) NOT NULL,
  `type` tinyint(2) NOT NULL COMMENT '1=project, 2=package',
  `foreign_key` int(11) NOT NULL,
  `confirmed` tinyint(4) NOT NULL DEFAULT '0',
  `upload` tinyint(2) NOT NULL DEFAULT '0',
  `tenderer` tinyint(1) NOT NULL DEFAULT '0',
  `link` varchar(50) NOT NULL,
  `modified` int(11) NOT NULL,
  `modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `follower`
--

INSERT INTO `follower` (`id`, `contact_id`, `type`, `foreign_key`, `confirmed`, `upload`, `tenderer`, `link`, `modified`, `modified_date`) VALUES
(1, 1, 1, 47, 0, 0, 0, '52b3dd5bd16cb7.20027190', 113, '2013-12-20 06:02:03');

-- --------------------------------------------------------

--
-- Table structure for table `form`
--

CREATE TABLE IF NOT EXISTS `form` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` varchar(30) NOT NULL,
  `name` varchar(255) NOT NULL,
  `project_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `project_id` (`project_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `form`
--

INSERT INTO `form` (`id`, `number`, `name`, `project_id`) VALUES
(5, '1', 'Registration Form', 47),
(6, '2', 'Lost Password Form', 47);

-- --------------------------------------------------------

--
-- Table structure for table `formproperty`
--

CREATE TABLE IF NOT EXISTS `formproperty` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `form_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `form_id` (`form_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `formproperty`
--

INSERT INTO `formproperty` (`id`, `form_id`, `name`, `description`) VALUES
(11, 5, 'First Name', 'First Name of user'),
(12, 5, 'Last Name', 'Users last name'),
(13, 5, 'Username', 'Unique identifier chosen by the user.'),
(14, 5, 'email address', 'valid email address');

-- --------------------------------------------------------

--
-- Table structure for table `iface`
--

CREATE TABLE IF NOT EXISTS `iface` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` int(4) NOT NULL,
  `name` varchar(255) NOT NULL,
  `file` varchar(60) NOT NULL,
  `type_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `type_id` (`type_id`),
  KEY `project_id` (`project_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `iface`
--

INSERT INTO `iface` (`id`, `number`, `name`, `file`, `type_id`, `project_id`) VALUES
(3, 3, 'Login Page', '52d74dda8a85e.png', 1, 47),
(5, 4, 'Sorry Screen', '', 1, 47),
(8, 1, 'Success Screen', '', 1, 47),
(11, 5, 'Register Page', '', 1, 47),
(12, 6, 'Please Validate', '', 1, 47),
(13, 7, 'Welcome Email', '', 3, 47),
(14, 8, 'Ajax Site Search', '', 2, 47),
(16, 9, 'Wine Search Result Accordian', '', 2, 47),
(18, 0, 'Welcome Page', '', 1, 47),
(19, 1, 'Validation Email', '', 3, 47),
(20, 10, 'System Admin New Member Notification Email', '', 3, 47),
(21, 11, 'Form error highlight style', '', 1, 47);

-- --------------------------------------------------------

--
-- Table structure for table `interfacetype`
--

CREATE TABLE IF NOT EXISTS `interfacetype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` varchar(30) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL,
  `project_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `project_id` (`project_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `interfacetype`
--

INSERT INTO `interfacetype` (`id`, `number`, `name`, `project_id`) VALUES
(1, '1', 'Web Interfaces', 47),
(2, '0', 'Not Classified', 47),
(3, '2', 'Email', 47),
(4, '0', 'Not Classified', 48),
(5, '1', 'Web Interface', 48),
(6, '2', 'Email', 48);

-- --------------------------------------------------------

--
-- Table structure for table `link`
--

CREATE TABLE IF NOT EXISTS `link` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sourcetype` int(4) NOT NULL,
  `source_id` int(11) NOT NULL,
  `targettype` int(4) NOT NULL,
  `target_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE IF NOT EXISTS `log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `object` varchar(60) NOT NULL,
  `action` varchar(60) NOT NULL,
  `data` varchar(60) NOT NULL,
  `modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_user` int(11) NOT NULL,
  `version_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `object`
--

CREATE TABLE IF NOT EXISTS `object` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` varchar(30) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `project_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `project_id` (`project_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `object`
--

INSERT INTO `object` (`id`, `number`, `name`, `description`, `project_id`) VALUES
(2, '1', 'Winery', 'A producer of wines.', 47),
(3, '2', 'Label', 'A wine product that is produced over one or more years, resulting in a number of vintages of that label.', 47),
(4, '3', 'Option', 'A  business rule parameter stored for to allow updating from time to time', 47);

-- --------------------------------------------------------

--
-- Table structure for table `objectproperty`
--

CREATE TABLE IF NOT EXISTS `objectproperty` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` varchar(30) NOT NULL,
  `object_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `object_id` (`object_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `objectproperty`
--

INSERT INTO `objectproperty` (`id`, `number`, `object_id`, `name`, `description`) VALUES
(5, '1', 2, 'id', 'unique id'),
(6, '2', 2, 'name', 'Name of Winery'),
(7, '3', 2, 'Latitude', 'Latitude of winery address'),
(8, '4', 2, 'Longitude', 'Longitude of winery address'),
(9, '5', 2, 'Address', 'Address of winery'),
(10, '6', 2, 'Phone Number', 'Contact land line phone number'),
(11, '1', 3, 'Name', 'The name on the label.'),
(12, '2', 3, 'Rating', 'The score out of 5 given to that label by Wine Genius'),
(13, '1', 4, 'Option', 'name of option'),
(14, '2', 4, 'Description', 'Description of option'),
(15, '3', 4, 'Value', 'Value of option');

-- --------------------------------------------------------

--
-- Table structure for table `organisationtype`
--

CREATE TABLE IF NOT EXISTS `organisationtype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `organisationtype`
--

INSERT INTO `organisationtype` (`id`, `name`) VALUES
(1, 'Analyst');

-- --------------------------------------------------------

--
-- Table structure for table `package`
--

CREATE TABLE IF NOT EXISTS `package` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `stage` tinyint(1) NOT NULL DEFAULT '1',
  `sequence` int(6) NOT NULL,
  `project_id` int(11) NOT NULL,
  `budget` decimal(10,2) NOT NULL DEFAULT '0.00',
  `contract_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `extlink` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=696 ;

--
-- Dumping data for table `package`
--

INSERT INTO `package` (`id`, `name`, `stage`, `sequence`, `project_id`, `budget`, `contract_amount`, `extlink`) VALUES
(693, 'Public Website', 1, 1, 47, '0.00', '0.00', NULL),
(694, 'Membership', 1, 2, 47, '0.00', '0.00', NULL),
(695, 'Versioning', 1, 1, 48, '0.00', '0.00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `photo`
--

CREATE TABLE IF NOT EXISTS `photo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file` varchar(60) NOT NULL,
  `project_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `project_id` (`project_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `photo`
--

INSERT INTO `photo` (`id`, `file`, `project_id`, `user_id`, `create_date`) VALUES
(3, '52d74dda8a85e.png', 47, 113, '2014-01-16 03:11:23');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE IF NOT EXISTS `project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  `company_id` int(11) NOT NULL,
  `budget` decimal(10,2) NOT NULL DEFAULT '0.00',
  `claimtype` tinyint(1) NOT NULL DEFAULT '1',
  `stage` int(4) NOT NULL DEFAULT '1' COMMENT '1=bidding, 2=const, 3=finish, 4=tender',
  `extlink` varchar(50) DEFAULT NULL,
  `subcontractterms` text NOT NULL,
  `subcontractretention` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `extlink` (`extlink`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=49 ;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`id`, `name`, `description`, `company_id`, `budget`, `claimtype`, `stage`, `extlink`, `subcontractterms`, `subcontractretention`) VALUES
(47, 'Wine Genius', 'test', 505, '0.00', 1, 1, 'c660a35542e52763d18098132a4815f5', '30 Days after end of month of invoice', '5% held for 45 days'),
(48, 'Reqrap', 'Rapid requirements development system.', 505, '0.00', 1, 1, '9e400e1040cd520987bd3858e825061b', '30 Days after end of month of invoice', '5% held for 45 days');

-- --------------------------------------------------------

--
-- Table structure for table `projectstatus`
--

CREATE TABLE IF NOT EXISTS `projectstatus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createdby` int(11) NOT NULL,
  `note` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `projectstatustype`
--

CREATE TABLE IF NOT EXISTS `projectstatustype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `release`
--

CREATE TABLE IF NOT EXISTS `release` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` varchar(20) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `project_id` int(11) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_user` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `create_user` (`create_user`),
  KEY `project_id` (`project_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `release`
--

INSERT INTO `release` (`id`, `number`, `status`, `project_id`, `create_date`, `create_user`) VALUES
(1, '0.1', 1, 47, '2014-01-16 03:46:15', 113);

-- --------------------------------------------------------

--
-- Table structure for table `rule`
--

CREATE TABLE IF NOT EXISTS `rule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rule_id` int(11) NOT NULL,
  `number` smallint(4) NOT NULL,
  `title` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `project_id` int(11) NOT NULL,
  `version_id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `project_id` (`project_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=75 ;

--
-- Dumping data for table `rule`
--

INSERT INTO `rule` (`id`, `rule_id`, `number`, `title`, `text`, `project_id`, `version_id`, `active`) VALUES
(10, 2, 2, 'Username ', 'Username is a string of alpha-numeric characters, it is unique to each user.', 47, 1, 1),
(14, 3, 3, 'Header displays username', 'The page header shows the logged in user name, or if no user is logged in, a ''login'' link.', 47, 2, 1),
(15, 4, 4, 'email address', 'email address must be a valid email address.', 47, 3, 1),
(16, 5, 5, 'error highlights on forms', 'Errors are highlighted on the form if it redisplays failing validation.  HIghlight style is defined in design.', 47, 4, 1),
(17, 6, 6, 'Ajax Search on Typing', 'After typing two characters an Ajax search is made.', 47, 5, 1),
(18, 7, 7, 'Ajax Site Search Matching', 'Ajax Site Search matches winery and label names and article content with a partial AND match. Matching wines are displayed followed by articles ordered by relevance.', 47, 6, 1),
(22, 8, 8, 'Password Complexity', 'Password must contain a capital letter, a lower case letter and a number.  Must be 6 characters or more.', 47, 7, 1),
(23, 9, 9, 'System Admin email address', 'System Admin email address is set as an option in the database and is editable through the admin system.', 47, 8, 1),
(24, 10, 10, 'User account validation link', 'User account validation link uses a long, unique, non sequential  alpha-numeric string to prevent guessing of link URLs.', 47, 9, 1),
(25, 10, 10, 'Test new version', 'Test new version', 47, 10, 0),
(26, 11, 11, 'Test', 'test version 2', 47, 8, 0),
(27, 11, 11, 'Test', 'test version 3', 47, 9, 0),
(28, 11, 11, 'deleted', 'deleted', 47, 10, 0),
(29, 12, 12, 'Versions', 'Must be version controlled', 47, 11, 0),
(30, 12, 12, 'Versions', 'Must be version controlled in all casese 2', 47, 12, 0),
(31, 12, 12, 'Versions', 'Must be version controlled in all cases 2. Even minor edits.', 47, 13, 0),
(32, 12, 12, 'Versions', 'Must be version controlled in all cases 2. Even minor edits. check this puppy out.', 47, 14, 0),
(35, 13, 13, 'Test display', 'this tests the display of versions', 47, 17, 0),
(36, 13, 13, 'Test display', 'this tests the display of versions. Another version - perhaps a review screen would be better.', 47, 18, 0),
(37, 13, 13, 'Test display', 'this tests the display of versions, this should make version 3 and set it active.', 47, 19, 0),
(38, 13, 13, 'deleted', 'deleted', 47, 20, 0),
(39, 13, 13, 'deleted', 'deleted', 47, 21, 0),
(40, 10, 10, 'deleted', 'deleted', 47, 22, 0),
(41, 12, 12, 'deleted', 'deleted', 47, 23, 0),
(42, 14, 14, 'Published Content', 'Only content that has a published status shows on the website', 47, 24, 1),
(43, 15, 15, 'Wineries page visibility', 'If the win_visible flag is set to ‘0’ for a specific winery,  the winery page  does not display for that winery.', 47, 25, 1),
(44, 16, 16, 'One published logo for winery', 'Only one logo image related to a winery can have a published status at the same time', 47, 26, 1),
(45, 17, 17, 'Winery default logo', 'Where the winery logo is displayed, if no published logo exists, a default logo displays instead.', 47, 27, 1),
(46, 18, 18, 'Shared Content', 'Tasting note uses the Winery, Label, Vintage as the Title and the url is to the Tasting Note Detail page using a hashed link that is bypasses the requirement for member login. E.g. www.winegenius.com/AX87JT6784.  This prevents users guessing URL’s to wine notes, and allows the shared content to be viewed by non-members.', 47, 28, 1),
(47, 19, 19, 'Remember Me', 'If a user selects ‘Remember Me’ on log in, their login will be stored locally for a maximum of 2 weeks.', 47, 29, 1),
(48, 20, 20, 'Login referrer URL', 'A user is returned to the page where they clicked the link to login after a successful login.', 47, 30, 1),
(49, 21, 21, 'My Account Link', 'When a member is logged in the Log In button on the header changes to become My Account.', 47, 31, 1),
(50, 22, 22, 'Login Credentials', 'User logs in with email and password.', 47, 32, 1),
(51, 23, 23, 'Ajax Search on typing', 'Ajax Site Search is made after each character is entered once there is more than one character entered.', 47, 33, 1),
(52, 24, 24, 'Ajax Site Search matching', 'Ajax Site Search matches against labels, wineries and wordpress content using a partial match on the entire string. Wines, wineries and content are displayed in Ajax Site Search Pane.', 47, 34, 1),
(53, 25, 25, 'Submit Site Search', 'Site search uses a partial AND match on the search string separated on spaces.', 47, 35, 1),
(54, 26, 26, 'Editable user content', 'User submitted content of types ‘note’, ‘points’, ‘drinking range’ and ‘images’', 47, 36, 1),
(55, 27, 27, 'Ajax Wine Search matching', 'Ajax Site Search matches against wineries, labels and vintages using a partial match on the entire string.  Up to 10 matching wines are displayed. Any filters selected on the wine page are applied to the Ajax search.', 47, 37, 1),
(56, 28, 28, 'Cursor to focus on search text field on page load.', 'On loading the Wine Search page focus is set to the search text entry field.', 47, 38, 1),
(57, 29, 29, 'Wine Search Results to display on same page ', 'Wine Search Results to display on same page in an Ajax loaded results pane.', 47, 39, 1),
(58, 30, 30, 'Logged in user display', 'When a user is logged in the log in link shows the username and a dropdown menu of user options.', 47, 40, 1),
(59, 31, 31, 'Member Only Content', 'Only logged in members can view wine notes unless the note is accessed via a content share .', 47, 41, 1),
(60, 32, 32, 'Order of Ajax Search Result display ', 'When displaying Ajax search dropdown results. Wine results will be listed first, wineries next and article results last. ', 47, 42, 1),
(61, 33, 33, 'Number of Ajax Search Results', 'When displaying Ajax search dropdown results. Up to six wines will be shown, up to three wineries will be shown and up to three articles will be shown.', 47, 43, 1),
(62, 34, 34, 'No Search Results', 'Should no results be returned from a search, ‘No Results Pop Up’ will appear.', 47, 44, 1),
(63, 35, 35, 'Ajax link targets', 'All ajax search results are clickable, when clicked:\r\n- Wine results take the user to the specific tasting note of that wine\r\n- Winery results take the user to the specific winery\r\n- Article results take the user to the specific article\r\n', 47, 45, 1),
(64, 36, 36, 'Password and Confirm must match', 'The password and confirm values entered must match', 47, 46, 1),
(65, 37, 37, 'No errors shown for incorrect username', 'If no matching account/email is found no error messages are displayed on the Lost Password Form.', 47, 47, 1),
(66, 38, 38, 'Banned words check', 'New posts will be checked automatically against a banned word list, posts including banned words will fail validation', 47, 48, 1),
(67, 39, 39, 'Sanitise user inputs', 'User inputs are sanitised to remove injection attacks or embedded scripts.', 47, 49, 1),
(68, 40, 40, 'Status is review', 'On creation user reviews are given a status of ‘Review’.', 47, 50, 1),
(69, 41, 41, 'Account Age Calculation', 'The age of the account is calculated as the number of days elapsed since the Account ‘Valid From’ value', 47, 51, 1),
(70, 42, 42, 'Member review image upload', 'Image upload allows a maximum size of 4mb to be uploaded.\r\nOnly png or jpg file types are allowed.\r\nImage will be automatically resized to a max width of 800 px on upload\r\n', 47, 52, 1),
(71, 43, 43, 'Order of Article search results', 'Article search results are show ordered by relevance.', 47, 53, 1),
(72, 44, 44, 'Display of Botrytis and Sparkling Wines', 'Wines in some retail categories show a suffix when their full Winery-Label-Vintage is displayed.  Eg.\r\nWinery-Label-(Suffix)-Vintage\r\nDessert Wine – suffix is ‘Botrytis’\r\nRose – suffix is ‘Rose’\r\nSweet Reds – suffix is ‘Dessert Red’\r\nSparkling White – suffix is ‘Sparkling’\r\nSparkling Rose – suffix is ‘Sparkling’\r\nSparkling Red – suffix is ‘Sparkling’\r\n', 47, 54, 1),
(73, 45, 45, 'Validation time frame', 'stub', 47, 56, 0),
(74, 45, 45, 'Validation time frame', 'The time limit in days for validation is stored as an ''option'' in the database.', 47, 57, 1);

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE IF NOT EXISTS `states` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `country_id` int(11) unsigned DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `timezone` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `state_id` (`country_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `step`
--

CREATE TABLE IF NOT EXISTS `step` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `flow_id` int(11) NOT NULL,
  `number` int(4) NOT NULL,
  `actor_id` int(11) NOT NULL,
  `text` text NOT NULL,
  `result` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `flow_id` (`flow_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=75 ;

--
-- Dumping data for table `step`
--

INSERT INTO `step` (`id`, `flow_id`, `number`, `actor_id`, `text`, `result`) VALUES
(54, 41, 1, 1, 'Actor selects ''Register'' link.', 'System displays the Register Page.'),
(55, 41, 2, 1, 'Actor completes Register form and submits.', 'System validates inputs.'),
(56, 41, 3, 1, 'No Action - form is valid', 'System creates membership and displays the Please Validate page.'),
(58, 42, 1, 1, 'Actor clicks the verify link in the Validation Email.', 'System matches the the requested URL to membership account and displays welcome page.'),
(59, 43, 3, 1, 'Actor action.', 'System result.'),
(60, 44, 3, 1, 'Actor action.', 'System result.'),
(61, 45, 3, 1, 'No action - Form fails validation', 'Form redisplays with errors highlighted.'),
(62, 42, 2, 1, 'System sends notification to System administrator account.', 'Email sent.'),
(63, 42, 3, 1, 'System sends Welcome Email to new member.', 'Email sent.'),
(64, 46, 3, 1, 'Validation link is not valid.', 'Sorry page displayed.'),
(65, 47, 3, 1, 'Actor action.', 'System result.'),
(66, 48, 3, 1, 'Actor action.', 'System result.'),
(67, 49, 3, 1, 'Actor action.', 'System result.'),
(68, 50, 1, 1, 'Actor action.', 'System result.'),
(69, 51, 1, 1, 'Actor action.', 'System result.'),
(70, 41, 4, 1, 'No action', 'System sends Validation email.'),
(74, 53, 1, 2, 'Actor action.', 'System result.');

-- --------------------------------------------------------

--
-- Table structure for table `stepform`
--

CREATE TABLE IF NOT EXISTS `stepform` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `step_id` int(11) NOT NULL,
  `form_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `form_id` (`form_id`),
  KEY `step_id` (`step_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `stepform`
--

INSERT INTO `stepform` (`id`, `step_id`, `form_id`) VALUES
(25, 55, 5);

-- --------------------------------------------------------

--
-- Table structure for table `stepiface`
--

CREATE TABLE IF NOT EXISTS `stepiface` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `step_id` int(11) NOT NULL,
  `iface_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `iface_id` (`iface_id`),
  KEY `step_id` (`step_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `stepiface`
--

INSERT INTO `stepiface` (`id`, `step_id`, `iface_id`) VALUES
(12, 54, 11),
(16, 58, 18),
(17, 58, 19),
(18, 62, 20),
(19, 63, 13),
(20, 64, 5),
(22, 70, 19),
(25, 56, 12),
(26, 61, 21);

-- --------------------------------------------------------

--
-- Table structure for table `steprule`
--

CREATE TABLE IF NOT EXISTS `steprule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `step_id` int(11) NOT NULL,
  `rule_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `rule_id` (`rule_id`),
  KEY `step_id` (`step_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `steprule`
--

INSERT INTO `steprule` (`id`, `step_id`, `rule_id`) VALUES
(19, 55, 22),
(20, 62, 23),
(21, 58, 24),
(22, 56, 73);

-- --------------------------------------------------------

--
-- Table structure for table `testcase`
--

CREATE TABLE IF NOT EXISTS `testcase` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usecase_id` int(11) DEFAULT NULL,
  `project_id` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `preparation` text NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=66 ;

--
-- Dumping data for table `testcase`
--

INSERT INTO `testcase` (`id`, `usecase_id`, `project_id`, `number`, `name`, `preparation`, `active`) VALUES
(64, 8, 47, 1, 'Create Membership(main)', 'None', 1),
(65, 8, 47, 2, 'Create Membership(A)', 'None', 1);

-- --------------------------------------------------------

--
-- Table structure for table `testcaseresult`
--

CREATE TABLE IF NOT EXISTS `testcaseresult` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `testcase_id` int(11) NOT NULL,
  `testrun_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `testcase_id` (`testcase_id`),
  KEY `testrun_id` (`testrun_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `testcaseresult`
--

INSERT INTO `testcaseresult` (`id`, `testcase_id`, `testrun_id`, `status`, `modified_date`, `user_id`) VALUES
(3, 64, 1, 1, '2013-12-24 05:20:53', 113),
(4, 65, 1, 1, '2013-12-24 05:20:53', 113);

-- --------------------------------------------------------

--
-- Table structure for table `testresult`
--

CREATE TABLE IF NOT EXISTS `testresult` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `testrun_id` int(11) NOT NULL,
  `teststep_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `result` tinyint(1) NOT NULL,
  `comments` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `teststep_id` (`teststep_id`),
  KEY `testrun_id` (`testrun_id`),
  KEY `date` (`date`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `testresult`
--

INSERT INTO `testresult` (`id`, `testrun_id`, `teststep_id`, `user_id`, `date`, `result`, `comments`) VALUES
(12, 1, 417, 113, '2013-12-24 05:24:50', 2, 'none'),
(13, 1, 418, 113, '2013-12-24 05:31:39', 2, 'none');

-- --------------------------------------------------------

--
-- Table structure for table `testrun`
--

CREATE TABLE IF NOT EXISTS `testrun` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `number` smallint(4) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `testrun`
--

INSERT INTO `testrun` (`id`, `project_id`, `number`, `status`) VALUES
(1, 47, 1, 2),
(2, 47, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `teststep`
--

CREATE TABLE IF NOT EXISTS `teststep` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `testcase_id` int(11) NOT NULL,
  `number` varchar(30) NOT NULL,
  `action` text NOT NULL,
  `result` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `testcase_id` (`testcase_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=435 ;

--
-- Dumping data for table `teststep`
--

INSERT INTO `teststep` (`id`, `testcase_id`, `number`, `action`, `result`) VALUES
(417, 64, '1', 'Actor selects ''Register'' link.', 'System displays the Register Page.'),
(418, 64, '2', 'Verify interface', 'UI-0005 Register Page'),
(419, 64, '3', 'Actor completes Register form and submits.', 'System validates inputs.'),
(420, 64, '4', 'Test Validation Rules', 'UF-0001 Registration Form - field: First Name'),
(421, 64, '5', 'Test Validation Rules', 'UF-0001 Registration Form - field: Last Name'),
(422, 64, '6', 'Test Validation Rules', 'UF-0001 Registration Form - field: Username'),
(423, 64, '7', 'Test Validation Rules', 'UF-0001 Registration Form - field: email address'),
(424, 64, '8', 'Verify rule', 'BR-0008 Password Complexity'),
(425, 64, '9', 'Form is valid', 'System creates membership and displays the Please Validate page.'),
(426, 64, '10', 'Verify interface', 'UI-0006 Please Validate'),
(427, 64, '11', 'No action', 'System sends Validation email.'),
(428, 64, '12', 'Verify interface', 'UI-0001 Validation Email'),
(429, 65, '1', 'Actor selects ''Register'' link.', 'System displays the Register Page.'),
(430, 65, '2', 'Actor completes Register form and submits.', 'System validates inputs.'),
(431, 65, '3', 'Form fails validation', 'Form redisplays with errors highlighted.'),
(432, 65, '4', 'Actor completes Register form and submits.', 'System validates inputs.'),
(433, 65, '5', 'Form is valid', 'System creates membership and displays the Please Validate page.'),
(434, 65, '6', 'No action', 'System sends Validation email.');

-- --------------------------------------------------------

--
-- Table structure for table `usecase`
--

CREATE TABLE IF NOT EXISTS `usecase` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `package_id` int(11) NOT NULL,
  `number` varchar(30) NOT NULL,
  `actor_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `preconditions` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `package_id` (`package_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `usecase`
--

INSERT INTO `usecase` (`id`, `package_id`, `number`, `actor_id`, `name`, `description`, `preconditions`) VALUES
(8, 693, '1', 1, 'Create Membership', 'This use case describes the process of a user registering to become a member.', 'None that I know of'),
(9, 693, '3', 1, 'Sign up with Facebook', 'Process of a user signing up with facebook.', 'None'),
(10, 693, '2', 1, 'Verify Membership', 'Process of a user verifying their email address as part of the sign up process', 'None'),
(11, 693, '6', 1, 'Browse Map', 'This use case describes a user browsing the winery map.', 'None'),
(12, 693, '4', 1, 'Search Wines', 'This use case describes how a User searches for a wine.', 'None'),
(13, 693, '5', 1, 'Search Content', 'This use case describes how a User searches the site content.', 'None'),
(14, 693, '7', 1, 'Request Member Only Content', 'This use case describes the process of a user trying to view member only content.', 'None'),
(15, 693, '8', 1, 'Log In', 'This use case describes the process of how a member logs in', 'None'),
(16, 693, '9', 1, 'Retrieve Password', 'This use case describes how a member retrieves their username and / or password from within the system.', 'None'),
(18, 694, '1', 2, 'Update profile', 'This use case describes the process of a Member updating their membership profile.', 'None');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address_id` int(11) DEFAULT NULL,
  `salt` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=public, 1=member, 2=staff ',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `company_id` int(11) DEFAULT NULL,
  `admin` tinyint(4) NOT NULL DEFAULT '0',
  `verify` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `address_id` (`address_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=114 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `email`, `password`, `address_id`, `salt`, `username`, `type`, `active`, `company_id`, `admin`, `verify`) VALUES
(113, 'twit', 'twitter', 'twit@test.com', '1a1dc91c907325c69271ddf0c944bc72', NULL, '52aa245e381000.34176327', 'twit@test.com', 1, 1, 505, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `uses`
--

CREATE TABLE IF NOT EXISTS `uses` (
  `uses` int(11) NOT NULL,
  `usedby` int(11) NOT NULL,
  PRIMARY KEY (`uses`),
  KEY `usedby` (`usedby`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `version`
--

CREATE TABLE IF NOT EXISTS `version` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` int(11) NOT NULL,
  `release` varchar(6) NOT NULL,
  `project_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `object` int(2) NOT NULL,
  `action` tinyint(1) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_user` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=58 ;

--
-- Dumping data for table `version`
--

INSERT INTO `version` (`id`, `number`, `release`, `project_id`, `status`, `object`, `action`, `create_date`, `create_user`) VALUES
(1, 1, '1', 47, 1, 1, 1, '2014-01-18 04:00:35', 113),
(2, 2, '1', 47, 1, 1, 2, '2014-01-16 01:44:48', 113),
(3, 3, '1', 47, 1, 1, 2, '2014-01-16 01:44:48', 113),
(4, 4, '1', 47, 1, 1, 2, '2014-01-16 01:44:48', 113),
(5, 5, '1', 47, 1, 1, 2, '2014-01-16 01:44:48', 113),
(6, 6, '1', 47, 1, 1, 2, '2014-01-16 01:44:48', 113),
(7, 7, '1', 47, 1, 1, 2, '2014-01-16 01:44:48', 113),
(8, 8, '1', 47, 1, 1, 2, '2014-01-16 01:44:48', 113),
(9, 9, '1', 47, 1, 1, 2, '2014-01-16 01:44:48', 113),
(10, 10, '1', 47, 1, 1, 2, '2014-01-16 01:44:48', 113),
(11, 11, '1', 47, 1, 1, 2, '2014-01-16 01:44:48', 113),
(12, 12, '1', 47, 1, 1, 2, '2014-01-16 01:44:48', 113),
(13, 13, '1', 47, 1, 1, 2, '2014-01-16 01:44:48', 113),
(14, 14, '1', 47, 1, 1, 2, '2014-01-16 01:44:09', 113),
(15, 15, '1', 47, 1, 1, 2, '2014-01-16 01:44:09', 113),
(16, 16, '1', 47, 1, 1, 2, '2014-01-16 01:41:52', 113),
(17, 17, '1', 47, 1, 1, 1, '2014-01-16 01:54:10', 113),
(18, 18, '1', 47, 1, 1, 2, '2014-01-16 01:49:20', 113),
(19, 19, '1', 47, 1, 1, 2, '2014-01-16 02:38:41', 113),
(20, 20, '1', 47, 1, 1, 3, '2014-01-16 04:32:51', 113),
(21, 21, '1', 47, 1, 1, 3, '2014-01-16 04:34:04', 113),
(22, 22, '1', 47, 1, 1, 3, '2014-01-16 04:34:11', 113),
(23, 23, '1', 47, 1, 1, 3, '2014-01-16 04:34:20', 113),
(24, 24, '1', 47, 1, 1, 1, '2014-01-16 04:38:04', 113),
(25, 25, '1', 47, 1, 1, 1, '2014-01-16 04:38:35', 113),
(26, 26, '1', 47, 1, 1, 1, '2014-01-16 04:38:58', 113),
(27, 27, '1', 47, 1, 1, 1, '2014-01-16 04:39:17', 113),
(28, 28, '1', 47, 1, 1, 1, '2014-01-16 04:39:40', 113),
(29, 29, '1', 47, 1, 1, 1, '2014-01-16 04:40:07', 113),
(30, 30, '1', 47, 1, 1, 1, '2014-01-16 04:40:30', 113),
(31, 31, '1', 47, 1, 1, 1, '2014-01-16 04:41:02', 113),
(32, 32, '1', 47, 1, 1, 1, '2014-01-16 04:41:25', 113),
(33, 33, '1', 47, 1, 1, 1, '2014-01-16 04:41:47', 113),
(34, 34, '1', 47, 1, 1, 1, '2014-01-16 04:42:07', 113),
(35, 35, '1', 47, 1, 1, 1, '2014-01-16 04:42:26', 113),
(36, 36, '1', 47, 1, 1, 1, '2014-01-16 04:42:44', 113),
(37, 37, '1', 47, 1, 1, 1, '2014-01-16 04:43:07', 113),
(38, 38, '1', 47, 1, 1, 1, '2014-01-16 04:43:36', 113),
(39, 39, '1', 47, 1, 1, 1, '2014-01-16 04:44:00', 113),
(40, 40, '1', 47, 1, 1, 1, '2014-01-16 04:44:20', 113),
(41, 41, '1', 47, 1, 1, 1, '2014-01-16 04:44:53', 113),
(42, 42, '1', 47, 1, 1, 1, '2014-01-16 04:45:20', 113),
(43, 43, '1', 47, 1, 1, 1, '2014-01-16 04:45:45', 113),
(44, 44, '1', 47, 1, 1, 1, '2014-01-16 04:46:05', 113),
(45, 45, '1', 47, 1, 1, 1, '2014-01-16 04:46:44', 113),
(46, 46, '1', 47, 1, 1, 1, '2014-01-16 04:47:22', 113),
(47, 47, '1', 47, 1, 1, 1, '2014-01-16 04:47:44', 113),
(48, 48, '1', 47, 1, 1, 1, '2014-01-16 04:49:13', 113),
(49, 49, '1', 47, 1, 1, 1, '2014-01-16 04:49:31', 113),
(50, 50, '1', 47, 1, 1, 1, '2014-01-16 04:49:47', 113),
(51, 51, '1', 47, 1, 1, 1, '2014-01-16 04:50:10', 113),
(52, 52, '1', 47, 1, 1, 1, '2014-01-16 04:50:59', 113),
(53, 53, '1', 47, 1, 1, 1, '2014-01-16 04:51:23', 113),
(54, 54, '1', 47, 1, 1, 1, '2014-01-16 04:51:51', 113),
(55, 55, '1', 47, 1, 1, 1, '2014-01-17 02:20:49', 113),
(56, 56, '1', 47, 1, 1, 1, '2014-01-17 02:21:19', 113),
(57, 57, '1', 47, 1, 1, 2, '2014-01-23 04:49:39', 113);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `actor`
--
ALTER TABLE `actor`
  ADD CONSTRAINT `actor_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `flow`
--
ALTER TABLE `flow`
  ADD CONSTRAINT `flow_ibfk_1` FOREIGN KEY (`usecase_id`) REFERENCES `usecase` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `formproperty`
--
ALTER TABLE `formproperty`
  ADD CONSTRAINT `formproperty_ibfk_1` FOREIGN KEY (`form_id`) REFERENCES `form` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `iface`
--
ALTER TABLE `iface`
  ADD CONSTRAINT `iface_ibfk_3` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `iface_ibfk_4` FOREIGN KEY (`type_id`) REFERENCES `interfacetype` (`id`);

--
-- Constraints for table `interfacetype`
--
ALTER TABLE `interfacetype`
  ADD CONSTRAINT `interfacetype_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `object`
--
ALTER TABLE `object`
  ADD CONSTRAINT `object_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `objectproperty`
--
ALTER TABLE `objectproperty`
  ADD CONSTRAINT `objectproperty_ibfk_1` FOREIGN KEY (`object_id`) REFERENCES `object` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `release`
--
ALTER TABLE `release`
  ADD CONSTRAINT `release_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `release_ibfk_2` FOREIGN KEY (`create_user`) REFERENCES `user` (`id`);

--
-- Constraints for table `rule`
--
ALTER TABLE `rule`
  ADD CONSTRAINT `rule_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `step`
--
ALTER TABLE `step`
  ADD CONSTRAINT `step_ibfk_1` FOREIGN KEY (`flow_id`) REFERENCES `flow` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `stepform`
--
ALTER TABLE `stepform`
  ADD CONSTRAINT `stepform_ibfk_1` FOREIGN KEY (`step_id`) REFERENCES `step` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stepform_ibfk_2` FOREIGN KEY (`form_id`) REFERENCES `form` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `stepiface`
--
ALTER TABLE `stepiface`
  ADD CONSTRAINT `stepiface_ibfk_1` FOREIGN KEY (`iface_id`) REFERENCES `iface` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stepiface_ibfk_2` FOREIGN KEY (`step_id`) REFERENCES `step` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `steprule`
--
ALTER TABLE `steprule`
  ADD CONSTRAINT `steprule_ibfk_2` FOREIGN KEY (`rule_id`) REFERENCES `rule` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `steprule_ibfk_3` FOREIGN KEY (`step_id`) REFERENCES `step` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `testcaseresult`
--
ALTER TABLE `testcaseresult`
  ADD CONSTRAINT `testcaseresult_ibfk_1` FOREIGN KEY (`testcase_id`) REFERENCES `testcase` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `testcaseresult_ibfk_2` FOREIGN KEY (`testrun_id`) REFERENCES `testrun` (`id`),
  ADD CONSTRAINT `testcaseresult_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `testresult`
--
ALTER TABLE `testresult`
  ADD CONSTRAINT `testresult_ibfk_1` FOREIGN KEY (`testrun_id`) REFERENCES `testrun` (`id`),
  ADD CONSTRAINT `testresult_ibfk_2` FOREIGN KEY (`teststep_id`) REFERENCES `teststep` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `testresult_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `teststep`
--
ALTER TABLE `teststep`
  ADD CONSTRAINT `teststep_ibfk_1` FOREIGN KEY (`testcase_id`) REFERENCES `testcase` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `usecase`
--
ALTER TABLE `usecase`
  ADD CONSTRAINT `usecase_ibfk_1` FOREIGN KEY (`package_id`) REFERENCES `package` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `uses`
--
ALTER TABLE `uses`
  ADD CONSTRAINT `uses_ibfk_2` FOREIGN KEY (`usedby`) REFERENCES `usecase` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `uses_ibfk_3` FOREIGN KEY (`uses`) REFERENCES `usecase` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
