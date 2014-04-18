-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 18, 2014 at 10:51 AM
-- Server version: 5.6.17
-- PHP Version: 5.4.27

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `req`
--

-- --------------------------------------------------------

--
-- Table structure for table `actor`
--

CREATE TABLE IF NOT EXISTS `actor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `actor_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `release_id` int(11) NOT NULL,
  `number` varchar(30) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `alias` text NOT NULL,
  `inherits` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `project_id` (`project_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=132 ;

--
-- Dumping data for table `actor`
--

INSERT INTO `actor` (`id`, `type`, `actor_id`, `project_id`, `release_id`, `number`, `name`, `description`, `alias`, `inherits`) VALUES
(113, 0, 1, 139, 104, '1', 'Actor', 'My First Actor', 'Placeholder', -1),
(114, 0, 1, 139, 105, '1', 'Actor', 'My First Actor', 'Placeholder', -1),
(115, 0, 1, 139, 105, '1', 'User', 'Updated now compare', 'Placeholder', -1),
(124, 0, 1, 145, 110, '1', 'Actor', 'My First Actor', 'Placeholder', -1),
(125, 0, 1, 139, 112, '1', 'User', 'Updated now compare', 'Placeholder', -1),
(126, 0, 1, 139, 113, '1', 'User', 'Updated now compare', 'Placeholder', -1),
(127, 0, 1, 146, 114, '1', 'Actor', 'My First Actor', 'Placeholder', -1),
(128, 0, 1, 146, 114, '1', 'User', 'A public user who does not have a member account', 'Public user', -1),
(129, 0, 1, 146, 115, '1', 'User', 'A public user who does not have a member account', 'Public user', -1),
(130, 0, 2, 139, 113, '2', 'Member', 'this is a member', 'account holder', -1),
(131, 1, 3, 139, 113, '3', 'PayPal', 'a new actor', 'aoeu', -1);

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
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `number` varchar(30) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `project_id` int(11) NOT NULL,
  `release_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `project_id` (`project_id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category_id`, `number`, `name`, `description`, `project_id`, `release_id`) VALUES
(16, 2, '1', 'Test', 'test', 139, 113),
(17, 2, '2', 'Introduction', 'Introduction section', 139, 113);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=512 ;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `foreignid`, `name`, `description`, `owner_id`, `companyowner_id`, `type`, `organisationtype`, `trade_id`, `modified_date`) VALUES
(503, NULL, 'Test Company', 'Testing company', 113, -1, 1, 0, 0, '2013-12-12 21:06:54'),
(504, NULL, 'Test Company', 'ouoeuo', 113, 503, 1, 0, 0, '2013-12-12 21:10:26'),
(505, NULL, 'Test Company', 'ouoeuo', 113, 504, 1, 0, 0, '2013-12-12 21:10:57'),
(506, NULL, 'Knowlen Mowlen', 'aoeu', 113, 505, 2, 0, 0, '2013-12-20 06:00:13'),
(507, NULL, 'My Company', 'my company', 114, -1, 1, 0, 0, '2014-03-29 03:32:40'),
(508, NULL, 'Haddergash and Co', 'A company', 114, 507, 2, 1, 0, '2014-03-30 10:35:46'),
(509, NULL, 'test', 'test', 115, -1, 1, 0, 0, '2014-04-09 11:45:28'),
(510, NULL, 'Haddergash consulting', 'A consulting company', 116, -1, 3, 0, 0, '2014-04-16 11:02:53'),
(511, NULL, 'Haddergash consulting', 'second attempt to create', 117, -1, 3, 0, 0, '2014-04-16 11:16:43');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `firstname`, `lastname`, `phone`, `mobile`, `email`, `user_id`, `owner_id`, `companyowner_id`, `company_id`) VALUES
(1, 'Bill', 'Knowlen', '099090', '909090', 'bill@test.com', 0, 113, 505, 506),
(2, 'Tad', 'Haddergash', '989898989', '89898999', 'tad@billson.com', 117, 114, 507, 508);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `document`
--

INSERT INTO `document` (`id`, `name`, `description`, `type`, `foreign_key`, `document_type`, `modified_date`, `modified`) VALUES
(1, 'Target Business Model', 'Plan do check act', 1, 139, 65, '2014-03-29 13:00:00', 114);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=81 ;

--
-- Dumping data for table `documenttype`
--

INSERT INTO `documenttype` (`id`, `company_id`, `name`, `description`) VALUES
(56, 505, 'Architectural', 'Architectural'),
(57, 505, 'Engineering', 'Engineering'),
(58, 505, 'Services', 'Services'),
(59, 505, 'Planning', 'Planning'),
(60, 505, 'General', 'General'),
(61, 507, 'Architectural', 'Architectural'),
(62, 507, 'Engineering', 'Engineering'),
(63, 507, 'Services', 'Services'),
(64, 507, 'Planning', 'Planning'),
(65, 507, 'General', 'General'),
(66, 509, 'Architectural', 'Architectural'),
(67, 509, 'Engineering', 'Engineering'),
(68, 509, 'Services', 'Services'),
(69, 509, 'Planning', 'Planning'),
(70, 509, 'General', 'General'),
(71, 510, 'Architectural', 'Architectural'),
(72, 510, 'Engineering', 'Engineering'),
(73, 510, 'Services', 'Services'),
(74, 510, 'Planning', 'Planning'),
(75, 510, 'General', 'General'),
(76, 511, 'Architectural', 'Architectural'),
(77, 511, 'Engineering', 'Engineering'),
(78, 511, 'Services', 'Services'),
(79, 511, 'Planning', 'Planning'),
(80, 511, 'General', 'General');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `documentversion`
--

INSERT INTO `documentversion` (`id`, `document_id`, `version`, `date`, `file`, `modified`, `modified_date`) VALUES
(1, 1, '1.0', '2014-03-04', '5337f3f7255fe.pdf', 114, '2014-03-29 13:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `flow`
--

CREATE TABLE IF NOT EXISTS `flow` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `flow_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `release_id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `usecase_id` int(11) NOT NULL,
  `main` tinyint(1) NOT NULL,
  `startstep_id` int(11) NOT NULL,
  `rejoinstep_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `usecase_id` (`usecase_id`),
  KEY `startstep_id` (`startstep_id`),
  KEY `rejoinstep_id` (`rejoinstep_id`),
  KEY `flow_id` (`flow_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=234 ;

--
-- Dumping data for table `flow`
--

INSERT INTO `flow` (`id`, `flow_id`, `project_id`, `release_id`, `name`, `usecase_id`, `main`, `startstep_id`, `rejoinstep_id`) VALUES
(218, 1, 139, 113, 'Main', 1, 1, 0, 0),
(219, 1, 146, 114, 'Main', 1, 1, 0, 0),
(220, 2, 146, 114, 'A', 1, 0, 2, 2),
(221, 2, 139, 113, 'Main', 2, 1, 0, 0),
(222, 3, 146, 114, 'B', 1, 0, 1, 1),
(223, 1, 146, 115, 'Main', 1, 1, 0, 0),
(224, 2, 146, 115, 'A', 1, 0, 2, 2),
(225, 3, 146, 115, 'B', 1, 0, 1, 1),
(226, 3, 139, 113, 'Main', 3, 1, 0, 0),
(227, 4, 139, 113, 'Main', 4, 1, 0, 0),
(228, 5, 139, 113, 'A', 3, 0, 5, 5),
(229, 6, 139, 113, 'B', 3, 0, 5, 5),
(230, 7, 139, 113, 'Main', 5, 1, 0, 0),
(231, 8, 139, 113, 'Main', 6, 1, 0, 0),
(232, 9, 139, 113, 'Main', 7, 1, 0, 0),
(233, 10, 139, 113, 'Main', 8, 1, 0, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `follower`
--

INSERT INTO `follower` (`id`, `contact_id`, `type`, `foreign_key`, `confirmed`, `upload`, `tenderer`, `link`, `modified`, `modified_date`) VALUES
(1, 1, 1, 47, 0, 0, 0, '52b3dd5bd16cb7.20027190', 113, '2013-12-20 06:02:03'),
(2, 2, 1, 139, 1, 0, 0, '0', 114, '2014-03-30 10:36:02');

-- --------------------------------------------------------

--
-- Table structure for table `form`
--

CREATE TABLE IF NOT EXISTS `form` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `form_id` int(11) NOT NULL,
  `number` varchar(30) NOT NULL,
  `name` varchar(255) NOT NULL,
  `project_id` int(11) NOT NULL,
  `release_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `project_id` (`project_id`),
  KEY `form_id` (`form_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=72 ;

--
-- Dumping data for table `form`
--

INSERT INTO `form` (`id`, `form_id`, `number`, `name`, `project_id`, `release_id`) VALUES
(56, 1, '1', 'Test', 139, 104),
(57, 1, '1', 'Test', 139, 105),
(58, 1, '1', 'Test updated.', 139, 105),
(67, 1, '1', 'Test', 145, 110),
(68, 1, '1', 'Test updated.', 139, 112),
(69, 1, '1', 'Test updated.', 139, 113),
(70, 1, '1', 'Username and password form', 146, 114),
(71, 1, '1', 'Username and password form', 146, 115);

-- --------------------------------------------------------

--
-- Table structure for table `formproperty`
--

CREATE TABLE IF NOT EXISTS `formproperty` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `formproperty_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `release_id` int(11) NOT NULL,
  `form_id` int(11) NOT NULL,
  `number` int(5) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `type` varchar(80) DEFAULT NULL,
  `valid` text,
  `required` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `form_id` (`form_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=45 ;

--
-- Dumping data for table `formproperty`
--

INSERT INTO `formproperty` (`id`, `formproperty_id`, `project_id`, `release_id`, `form_id`, `number`, `name`, `description`, `type`, `valid`, `required`) VALUES
(18, 1, 146, 114, 1, 1, 'First Name', 'User''s First Name.  Pre-populated from database.', '', '', 0),
(19, 2, 146, 114, 1, 2, 'Last Name', 'User''s Last Name. Prepopulated from Database.', '', '', 0),
(20, 3, 146, 114, 1, 3, 'Country', 'Country select list.  Required.', '', '', 0),
(21, 1, 146, 114, 1, 1, 'First Name', 'User''s First Name.  Pre-populated from database. Must contain at least one character.', '', '', 0),
(22, 2, 146, 114, 1, 2, 'Last Name', 'User''s Last Name. Prepopulated from Database. Must contain at least one character.', '', '', 0),
(23, 4, 146, 114, 1, 4, 'Username', 'Unique username. Must contain at least one character.', '', '', 0),
(24, 5, 146, 114, 1, 5, 'Password', 'Password type field.  Password to confirm to existing password validation requirements.', '', '', 0),
(25, 6, 146, 114, 1, 6, 'Confirm Password', 'Password confirmation must match Password.', '', '', 0),
(26, 1, 146, 114, 1, 1, 'First Name', 'User''s First Name.  Pre-populated from database. ', 'Text', NULL, 1),
(27, 1, 146, 114, 1, 1, 'First Name', 'User''s First Name.  Pre-populated from database. ', 'Text', NULL, 1),
(28, 1, 146, 114, 1, 1, 'First Name', 'User''s First Name.  Pre-populated from database. ', 'Text', NULL, 1),
(29, 1, 146, 114, 1, 1, 'First Name', 'User''s First Name.  Pre-populated from database. ', 'Text', NULL, 1),
(30, 1, 146, 114, 1, 1, 'First Name', 'User''s First Name.  Pre-populated from database. ', 'Text', NULL, 1),
(31, 1, 146, 114, 1, 1, 'First Name', 'User''s First Name.  Pre-populated from database. ', 'Text', 'id', 1),
(32, 1, 146, 114, 1, 1, 'First Name', 'User''s First Name.  Pre-populated from database. ', 'Text', 'Must contain at least one character', 1),
(33, 2, 146, 114, 1, 2, 'Last Name', 'User''s Last Name. Prepopulated from Database. ', 'Text', 'Must contain at least one character.', 1),
(34, 3, 146, 114, 1, 3, 'Country', 'Users country', 'Select List', 'none', 1),
(35, 4, 146, 114, 1, 4, 'Username', 'WordPress Username', 'Text', NULL, 1),
(36, 5, 146, 114, 1, 5, 'Password', 'Password', 'Password ', 'Password to confirm to existing password validation requirements', 1),
(37, 6, 146, 114, 1, 6, 'Confirm Password', 'Confirmation of password', 'Password ', 'Password confirmation must match Password.', 1),
(38, 4, 146, 114, 1, 4, 'Username', 'WordPress Username', 'Text', 'Unique and at least one character', 1),
(39, 1, 146, 115, 1, 1, 'First Name', 'User''s First Name.  Pre-populated from database. ', 'Text', 'Must contain at least one character', 1),
(40, 2, 146, 115, 1, 2, 'Last Name', 'User''s Last Name. Prepopulated from Database. ', 'Text', 'Must contain at least one character.', 1),
(41, 3, 146, 115, 1, 3, 'Country', 'Users country', 'Select List', 'none', 1),
(42, 5, 146, 115, 1, 5, 'Password', 'Password', 'Password ', 'Password to confirm to existing password validation requirements', 1),
(43, 6, 146, 115, 1, 6, 'Confirm Password', 'Confirmation of password', 'Password ', 'Password confirmation must match Password.', 1),
(44, 4, 146, 115, 1, 4, 'Username', 'WordPress Username', 'Text', 'Unique and at least one character', 1);

-- --------------------------------------------------------

--
-- Table structure for table `iface`
--

CREATE TABLE IF NOT EXISTS `iface` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iface_id` int(11) NOT NULL,
  `number` int(4) NOT NULL,
  `name` varchar(255) NOT NULL,
  `photo_id` int(11) NOT NULL DEFAULT '0',
  `type_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `release_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `type_id` (`type_id`),
  KEY `project_id` (`project_id`),
  KEY `iface_id` (`iface_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=117 ;

--
-- Dumping data for table `iface`
--

INSERT INTO `iface` (`id`, `iface_id`, `number`, `name`, `photo_id`, `type_id`, `project_id`, `release_id`) VALUES
(95, 1, 1, 'Log-in pop-up', 0, 1, 139, 113),
(96, 1, 1, 'Log-in pop-up', 0, 2, 139, 113),
(97, 1, 1, 'Log-in pop-up', 0, 2, 139, 113),
(98, 1, 1, 'Log-in pop-up', 0, 2, 139, 113),
(99, 1, 1, 'Log-in pop-up', 0, 2, 139, 113),
(100, 1, 1, 'Log-in pop-up', 4, 2, 139, 113),
(101, 2, 2, 'Welcome Page', 0, 2, 139, 113),
(102, 2, 2, 'Welcome Page', 6, 2, 139, 113),
(103, 1, 1, 'Username and Password Reset', 0, 1, 146, 114),
(104, 2, 2, 'Home Page', 0, 1, 146, 114),
(105, 3, 3, 'Error highlight style', 0, 1, 146, 114),
(106, 1, 1, 'Username and Password Reset', 7, 1, 146, 114),
(107, 1, 1, 'Username and Password Reset', 0, 2, 146, 114),
(108, 1, 1, 'Username and Password Reset', 9, 2, 146, 114),
(109, 2, 2, 'Home Page', 0, 2, 146, 114),
(110, 3, 3, 'Error highlight style', 8, 2, 146, 114),
(111, 4, 4, 'Sorry Page', 0, 1, 146, 114),
(112, 4, 4, 'Sorry Page', 10, 2, 146, 114),
(113, 1, 1, 'Username and Password Reset', 9, 2, 146, 115),
(114, 2, 2, 'Home Page', 0, 2, 146, 115),
(115, 3, 3, 'Error highlight style', 8, 2, 146, 115),
(116, 4, 4, 'Sorry Page', 10, 2, 146, 115);

-- --------------------------------------------------------

--
-- Table structure for table `interfacetype`
--

CREATE TABLE IF NOT EXISTS `interfacetype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `interfacetype_id` int(11) NOT NULL,
  `number` varchar(30) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL,
  `project_id` int(11) NOT NULL,
  `release_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `project_id` (`project_id`),
  KEY `interfacetype_id` (`interfacetype_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=290 ;

--
-- Dumping data for table `interfacetype`
--

INSERT INTO `interfacetype` (`id`, `interfacetype_id`, `number`, `name`, `project_id`, `release_id`) VALUES
(245, 1, '0', 'Not Classified', 139, 104),
(246, 2, '0', 'Web interface', 139, 104),
(247, 3, '0', 'Email', 139, 104),
(248, 1, '0', 'Not Classified', 139, 105),
(249, 2, '0', 'Web interface', 139, 105),
(250, 3, '0', 'Email', 139, 105),
(275, 1, '0', 'Not Classified', 145, 110),
(276, 2, '0', 'Web interface', 145, 110),
(277, 3, '0', 'Email', 145, 110),
(278, 1, '0', 'Not Classified', 139, 112),
(279, 2, '0', 'Web interface', 139, 112),
(280, 3, '0', 'Email', 139, 112),
(281, 1, '0', 'Not Classified', 139, 113),
(282, 2, '0', 'Web interface', 139, 113),
(283, 3, '0', 'Email', 139, 113),
(284, 1, '0', 'Not Classified', 146, 114),
(285, 2, '0', 'Web interface', 146, 114),
(286, 3, '0', 'Email', 146, 114),
(287, 1, '0', 'Not Classified', 146, 115),
(288, 2, '0', 'Web interface', 146, 115),
(289, 3, '0', 'Email', 146, 115);

-- --------------------------------------------------------

--
-- Table structure for table `library`
--

CREATE TABLE IF NOT EXISTS `library` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `release_id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `owner_id` (`owner_id`),
  KEY `release_id` (`release_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `library`
--

INSERT INTO `library` (`id`, `name`, `description`, `release_id`, `owner_id`) VALUES
(3, 'TEst release', 'tesert', 104, 507);

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
  `object_id` int(11) NOT NULL,
  `number` varchar(30) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `project_id` int(11) NOT NULL,
  `release_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `project_id` (`project_id`),
  KEY `object_id` (`object_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `object`
--

INSERT INTO `object` (`id`, `object_id`, `number`, `name`, `description`, `project_id`, `release_id`) VALUES
(13, 1, '1', 'Account', 'Membership Account', 139, 113),
(14, 1, '1', 'User', 'Word Press User stored in the wp_user table', 146, 114),
(15, 1, '1', 'User', 'Word Press User stored in the wp_user table', 146, 115);

-- --------------------------------------------------------

--
-- Table structure for table `objectproperty`
--

CREATE TABLE IF NOT EXISTS `objectproperty` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `objectproperty_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `release_id` int(11) NOT NULL,
  `number` varchar(30) NOT NULL,
  `object_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `object_id` (`object_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `objectproperty`
--

INSERT INTO `objectproperty` (`id`, `objectproperty_id`, `project_id`, `release_id`, `number`, `object_id`, `name`, `description`) VALUES
(10, 1, 139, 113, '1', 1, 'Name', 'Name of account'),
(11, 1, 146, 114, '2', 1, 'activation_key', 'Unused field in wp_user where the random link string is stored'),
(12, 1, 146, 115, '2', 1, 'activation_key', 'Unused field in wp_user where the random link string is stored');

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
  `package_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `stage` tinyint(1) NOT NULL DEFAULT '1',
  `number` int(6) NOT NULL,
  `project_id` int(11) NOT NULL,
  `release_id` int(11) NOT NULL,
  `budget` decimal(10,2) NOT NULL DEFAULT '0.00',
  `contract_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `extlink` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `project_id` (`project_id`),
  KEY `package_id` (`package_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=840 ;

--
-- Dumping data for table `package`
--

INSERT INTO `package` (`id`, `package_id`, `name`, `stage`, `number`, `project_id`, `release_id`, `budget`, `contract_amount`, `extlink`) VALUES
(814, 1, 'System', 1, 1, 139, 104, '0.00', '0.00', NULL),
(815, 1, 'System', 1, 1, 139, 105, '0.00', '0.00', NULL),
(824, 1, 'System', 1, 1, 145, 110, '0.00', '0.00', NULL),
(825, 1, 'System', 1, 1, 139, 112, '0.00', '0.00', NULL),
(826, 1, 'System', 1, 1, 139, 113, '0.00', '0.00', NULL),
(827, 1, 'System', 1, 1, 146, 114, '0.00', '0.00', NULL),
(828, 1, 'Membership', 1, 1, 146, 114, '0.00', '0.00', NULL),
(829, 1, 'old', 1, 1, 146, 114, '0.00', '0.00', NULL),
(830, 1, 'Package', 1, 1, 146, 114, '0.00', '0.00', NULL),
(831, 1, 'Membership', 1, 1, 146, 114, '0.00', '0.00', NULL),
(832, 1, 'Systemd', 1, 1, 146, 114, '0.00', '0.00', NULL),
(833, 1, 'System.', 1, 1, 146, 114, '0.00', '0.00', NULL),
(834, 2, 'test package', 1, 2, 139, 113, '0.00', '0.00', NULL),
(835, 1, 'Membership', 1, 1, 146, 114, '0.00', '0.00', NULL),
(836, 1, 'Membership', 1, 1, 146, 115, '0.00', '0.00', NULL),
(837, 1, 'Requirements', 1, 1, 139, 113, '0.00', '0.00', NULL),
(838, 2, 'Library', 1, 2, 139, 113, '0.00', '0.00', NULL),
(839, 3, 'Membership', 1, 3, 139, 113, '0.00', '0.00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `photo`
--

CREATE TABLE IF NOT EXISTS `photo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file` varchar(60) NOT NULL,
  `project_id` int(11) NOT NULL,
  `release_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `project_id` (`project_id`),
  KEY `user_id` (`user_id`),
  KEY `release_id` (`release_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `photo`
--

INSERT INTO `photo` (`id`, `file`, `project_id`, `release_id`, `user_id`, `create_date`) VALUES
(4, '533a497263f911.png', 139, 113, 114, '2014-04-01 05:06:58'),
(5, '533a4997042111sedan.png', 139, 113, 114, '2014-04-01 05:07:35'),
(6, '533bf1f341adb.png', 139, 113, 114, '2014-04-02 11:18:12'),
(7, '533c9923a7ac7.png', 146, 114, 114, '2014-04-02 23:11:32'),
(8, '5341f372631ec.png', 146, 114, 114, '2014-04-07 00:38:10'),
(9, '5341f37497b9a.png', 146, 114, 114, '2014-04-07 00:38:13'),
(10, '5341f6a5aa298.png', 146, 114, 114, '2014-04-07 00:51:50');

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
  `stage` int(4) NOT NULL DEFAULT '1' COMMENT '1=bidding, 2=const, 3=finish, 4=tender',
  `extlink` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `extlink` (`extlink`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=148 ;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`id`, `name`, `description`, `company_id`, `budget`, `stage`, `extlink`) VALUES
(139, 'ReqRap Requirements', 'Requirements for this system', 507, '0.00', 1, 'f4f94adf50acb46a9b3a72248afa7bdb'),
(145, 'Copy', 'Copied from ', 507, '0.00', 1, 'c3e047058f909136b4abbd7f1e987b63'),
(146, 'Wine Genius - member transfer', 'Transfer new members to site using external data', 507, '0.00', 1, '7775839b3c80b0abaedc9ebb431bc174'),
(147, 'mmmmmm', 'kkkkkkk', 509, '1000.00', 1, '1440e15fdb2b546b320c83a7389626d2');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=118 ;

--
-- Dumping data for table `release`
--

INSERT INTO `release` (`id`, `number`, `status`, `project_id`, `create_date`, `create_user`) VALUES
(104, '0.1', 2, 139, '2014-03-30 06:49:21', 114),
(105, '1.1', 2, 139, '2014-03-30 06:49:21', 114),
(110, '0', 1, 145, '2014-03-30 11:11:30', 114),
(112, '2.1', 2, 139, '2014-03-30 06:49:21', 114),
(113, '3.1', 1, 139, '2014-03-30 06:49:21', 114),
(114, '0', 2, 146, '2014-04-02 22:47:43', 114),
(115, '1', 1, 146, '2014-04-02 22:47:43', 114),
(116, '0', 2, 147, '2014-04-09 11:47:07', 115),
(117, '1', 1, 147, '2014-04-09 11:47:07', 115);

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
  `release_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `project_id` (`project_id`),
  KEY `rule_id` (`rule_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=87 ;

--
-- Dumping data for table `rule`
--

INSERT INTO `rule` (`id`, `rule_id`, `number`, `title`, `text`, `project_id`, `release_id`) VALUES
(69, 1, 1, 'Test', 'stub', 139, 104),
(70, 1, 1, 'Test', 'stub', 139, 105),
(71, 1, 1, 'Changed in v2', 'stub aeo', 139, 105),
(72, 1, 1, 'Changed in v2', 'stub aeo', 139, 112),
(73, 1, 1, 'Changed in v2', 'stub aeo', 139, 113),
(74, 1, 1, 'Unique email link', 'stub', 146, 114),
(75, 2, 2, 'User logged in after form submission.', 'stub', 146, 114),
(76, 1, 1, 'Unique email link', 'The email sent to the user contains a long unique string in the link that is generated outside this system. e.g. www.winegenius.com/newmember/8T89HE3HE&88ee.\r\nThe link will be imported into the database prior to sending the emails. ', 146, 114),
(77, 2, 2, 'User logged in after form submission.', 'When the password and username form is successfully submitted the user will be logged in as that account.', 146, 114),
(78, 3, 3, 'Single form submission', 'stub', 146, 114),
(79, 3, 3, 'Single form submission', 'The Username and Password reset form can only be submitted successfully once.  ', 146, 114),
(80, 3, 3, 'Single form submission', 'The Username and Password reset form can only be submitted successfully once.  The wp_user activation_key should be set to empty once the form is successfully submitted.', 146, 114),
(81, 4, 4, 'Use existing validation rules', 'stub', 146, 114),
(82, 4, 4, 'Use existing validation rules', 'All fields will be validated with the existing rules.', 146, 114),
(83, 1, 1, 'Unique email link', 'The email sent to the user contains a long unique string in the link that is generated outside this system. e.g. www.winegenius.com/newmember/8T89HE3HE&88ee.\r\nThe link will be imported into the database prior to sending the emails. ', 146, 115),
(84, 2, 2, 'User logged in after form submission.', 'When the password and username form is successfully submitted the user will be logged in as that account.', 146, 115),
(85, 3, 3, 'Single form submission', 'The Username and Password reset form can only be submitted successfully once.  The wp_user activation_key should be set to empty once the form is successfully submitted.', 146, 115),
(86, 4, 4, 'Use existing validation rules', 'All fields will be validated with the existing rules.', 146, 115);

-- --------------------------------------------------------

--
-- Table structure for table `simple`
--

CREATE TABLE IF NOT EXISTS `simple` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `simple_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `release_id` int(11) NOT NULL,
  `number` varchar(30) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `simple`
--

INSERT INTO `simple` (`id`, `simple_id`, `project_id`, `release_id`, `number`, `category_id`, `name`, `description`) VALUES
(13, 1, 139, 113, '1', 2, 'test icles', 'testing'),
(14, 1, 139, 113, '1', 2, 'A content item', 'This is a content item its a simple requirement with lots of stuff. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'),
(15, 2, 139, 113, '2', 2, 'Another one here', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');

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
  `step_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `release_id` int(11) NOT NULL,
  `flow_id` int(11) NOT NULL,
  `number` int(4) NOT NULL,
  `actor_id` int(11) NOT NULL,
  `text` text NOT NULL,
  `result` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `flow_id` (`flow_id`),
  KEY `step_id` (`step_id`),
  KEY `number` (`number`),
  KEY `actor_id` (`actor_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=359 ;

--
-- Dumping data for table `step`
--

INSERT INTO `step` (`id`, `step_id`, `project_id`, `release_id`, `flow_id`, `number`, `actor_id`, `text`, `result`) VALUES
(316, 1, 139, 113, 1, 1, 1, 'Actor action.', 'System result.'),
(317, 1, 139, 113, 1, 1, 1, 'Actor does something', 'System responds with a result.'),
(318, 1, 146, 114, 1, 1, 1, 'Actor action.', 'System result.'),
(319, 1, 146, 114, 1, 1, 1, 'User clicks link in email', 'System displays username and password reset page.'),
(320, 2, 146, 114, 1, 2, 1, 'New step', 'Result'),
(321, 2, 146, 114, 1, 2, 1, 'User completes Username and password reset form', 'System validates form input and redisplays the home page.'),
(322, 3, 146, 114, 2, 1, 1, 'New step.', 'Result'),
(323, 3, 146, 114, 2, 1, 1, 'Form validation fails.', 'Form is redisplayed with errors highlighted.'),
(324, 2, 139, 113, 2, 1, 1, 'Actor action.', 'System result.'),
(325, 4, 146, 114, 3, 1, 1, 'New step.', 'Result'),
(326, 4, 146, 114, 3, 1, 1, 'User clicks a link that has been used before.', 'System shows ''sorry page'''),
(327, 1, 146, 115, 1, 1, 1, 'User clicks link in email', 'System displays username and password reset page.'),
(328, 2, 146, 115, 1, 2, 1, 'User completes Username and password reset form', 'System validates form input and redisplays the home page.'),
(329, 3, 146, 115, 2, 1, 1, 'Form validation fails.', 'Form is redisplayed with errors highlighted.'),
(330, 4, 146, 115, 3, 1, 1, 'User clicks a link that has been used before.', 'System shows ''sorry page'''),
(331, 3, 139, 113, 3, 1, 1, 'Actor action.', 'System result.'),
(332, 3, 139, 113, 3, 1, 2, 'Actor action.', 'System result.'),
(333, 4, 139, 113, 1, 2, 1, 'New step', 'Result'),
(334, 4, 139, 113, 1, 2, 2, 'New step', 'Result'),
(335, 5, 139, 113, 3, 3, 1, 'New step', 'Result'),
(336, 5, 139, 113, 3, 3, 3, 'New step', 'Result'),
(337, 6, 139, 113, 4, 1, 3, 'Actor action.', 'System result.'),
(338, 7, 139, 113, 5, 1, 1, 'New step.', 'Result'),
(339, 7, 139, 113, 5, 1, 1, 'New step.', 'Result'),
(340, 8, 139, 113, 6, 1, 1, 'New step.', 'Result'),
(341, 8, 139, 113, 6, 1, 1, 'New step.', 'Result'),
(342, 9, 139, 113, 3, 2, 1, 'Inserted new step', 'Result'),
(343, 9, 139, 113, 3, 2, 1, 'Inserted new step', 'Result'),
(344, 10, 139, 113, 7, 1, 1, 'Actor action.', 'System result.'),
(345, 11, 139, 113, 8, 1, 2, 'Actor action.', 'System result.'),
(346, 9, 139, 113, 3, 2, 2, 'Inserted new step', 'Result'),
(347, 3, 139, 113, 3, 1, 2, 'Actor action.', 'System result.'),
(348, 5, 139, 113, 3, 3, 2, 'New step', 'Result'),
(349, 6, 139, 113, 4, 1, 2, 'Actor action.', 'System result.'),
(350, 12, 139, 113, 9, 1, 2, 'Actor action.', 'System result.'),
(351, 13, 139, 113, 10, 1, 2, 'Actor action.', 'System result.'),
(352, 13, 139, 113, 10, 1, 2, 'Actor views library items', 'System shows available projects and packages.'),
(353, 14, 139, 113, 10, 2, 2, 'New step', 'Result'),
(354, 14, 139, 113, 10, 2, 2, 'Actor selects project to copy', 'System creates a new project and copies the active version of all the project objects into the new project'),
(355, 1, 139, 113, 1, 1, 2, 'Actor does something', 'System responds with a result.'),
(356, 15, 139, 113, 2, 2, 1, 'New step', 'Result'),
(357, 15, 139, 113, 2, 2, 2, 'New step', 'Result'),
(358, 2, 139, 113, 2, 1, 2, 'Actor action.', 'System result.');

-- --------------------------------------------------------

--
-- Table structure for table `stepform`
--

CREATE TABLE IF NOT EXISTS `stepform` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stepform_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `release_id` int(11) NOT NULL,
  `step_id` int(11) NOT NULL,
  `form_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `form_id` (`form_id`),
  KEY `step_id` (`step_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=54 ;

--
-- Dumping data for table `stepform`
--

INSERT INTO `stepform` (`id`, `stepform_id`, `project_id`, `release_id`, `step_id`, `form_id`) VALUES
(52, 1, 146, 114, 2, 1),
(53, 1, 146, 115, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `stepiface`
--

CREATE TABLE IF NOT EXISTS `stepiface` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stepiface_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `release_id` int(11) NOT NULL,
  `step_id` int(11) NOT NULL,
  `iface_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `iface_id` (`iface_id`),
  KEY `step_id` (`step_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=81 ;

--
-- Dumping data for table `stepiface`
--

INSERT INTO `stepiface` (`id`, `stepiface_id`, `project_id`, `release_id`, `step_id`, `iface_id`) VALUES
(72, 1, 139, 113, 1, 1),
(73, 1, 146, 114, 1, 1),
(74, 2, 146, 114, 2, 2),
(75, 3, 146, 114, 3, 3),
(76, 4, 146, 114, 4, 4),
(77, 1, 146, 115, 1, 1),
(78, 2, 146, 115, 2, 2),
(79, 3, 146, 115, 3, 3),
(80, 4, 146, 115, 4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `steprule`
--

CREATE TABLE IF NOT EXISTS `steprule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `steprule_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `release_id` int(11) NOT NULL,
  `step_id` int(11) NOT NULL,
  `rule_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `rule_id` (`rule_id`),
  KEY `step_id` (`step_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=61 ;

--
-- Dumping data for table `steprule`
--

INSERT INTO `steprule` (`id`, `steprule_id`, `project_id`, `release_id`, `step_id`, `rule_id`) VALUES
(53, 1, 146, 114, 1, 1),
(54, 2, 146, 114, 2, 2),
(55, 3, 146, 114, 2, 3),
(56, 4, 146, 114, 1, 4),
(57, 1, 146, 115, 1, 1),
(58, 2, 146, 115, 2, 2),
(59, 3, 146, 115, 2, 3),
(60, 4, 146, 115, 1, 4);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `testrun`
--

CREATE TABLE IF NOT EXISTS `testrun` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `number` smallint(4) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `project_id` (`project_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=51 ;

--
-- Dumping data for table `testrun`
--

INSERT INTO `testrun` (`id`, `project_id`, `number`, `status`) VALUES
(49, 139, 1, 1),
(50, 146, 1, 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `usecase`
--

CREATE TABLE IF NOT EXISTS `usecase` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usecase_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `release_id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `number` varchar(30) NOT NULL,
  `actor_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `preconditions` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `package_id` (`package_id`),
  KEY `usecase_id` (`usecase_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=158 ;

--
-- Dumping data for table `usecase`
--

INSERT INTO `usecase` (`id`, `usecase_id`, `project_id`, `release_id`, `package_id`, `number`, `actor_id`, `name`, `description`, `preconditions`) VALUES
(141, 1, 139, 113, 1, '1', 1, 'oeu', 'oeu', 'None'),
(142, 1, 146, 114, 1, '1', 1, 'Create Account', 'This use case describes the process of a user following a link to create their new account', 'User has been sent an email with a unique link'),
(143, 2, 139, 113, 2, '1', 1, 'test', 'aoue', 'None'),
(144, 1, 146, 115, 1, '1', 1, 'Create Account', 'This use case describes the process of a user following a link to create their new account', 'User has been sent an email with a unique link'),
(145, 3, 139, 113, 1, '2', 1, 'a second one', 'two', 'None'),
(146, 4, 139, 113, 1, '3', 3, 'thhdt', 'itedui', 'None'),
(147, 1, 146, 115, 1, '1', 1, 'Create Account', 'This use case describes the process of a user following a link to create their new account', 'None'),
(148, 2, 139, 113, 2, '1', 1, 'Import library into project', 'This use case describes the process of a Member importing a package into an existing project.', 'Must have an existing project'),
(149, 1, 139, 113, 1, '1', 2, 'Create unstructured requirement', 'This use case describes the process of creating an unstructured requirement that consists of paragraphs of text and or diagrams.', 'None'),
(150, 5, 139, 113, 3, '1', 1, 'Create Account', 'This use case describes the process of a user creating a membership account on the system.', 'None'),
(151, 3, 139, 113, 1, '2', 2, 'Create Project', 'This usecase describes the process of creating a project in the system', 'None'),
(152, 4, 139, 113, 1, '3', 2, 'Create Actor', 'This usecase describes the process of creating an actor in a project', 'None'),
(153, 6, 139, 113, 3, '2', 2, 'Buy Subscription', 'This usecase describes the process of a member purchasing a subscription.', 'None'),
(154, 1, 139, 113, 1, '1', 2, 'Create simple requirement', 'This use case describes the process of creating an unstructured requirement that consists of paragraphs of text and or diagrams.', 'None'),
(155, 7, 139, 113, 1, '4', 2, 'Create Object', 'This usecase describes the process of a user creating an Object within a project', 'None'),
(156, 8, 139, 113, 2, '2', 2, 'Copy library project', 'This usecase describes the process of creating a new project by copying a library project', 'None'),
(157, 8, 139, 113, 2, '2', 2, 'Create project from library', 'This usecase describes the process of creating a new project by copying a library project', 'None');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=118 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `email`, `password`, `address_id`, `salt`, `username`, `type`, `active`, `company_id`, `admin`, `verify`) VALUES
(113, 'twit', 'twitter', 'twit@test.com', '1a1dc91c907325c69271ddf0c944bc72', NULL, '52aa245e381000.34176327', 'twit@test.com', 1, 1, 505, 0, 0),
(114, 'Bill', 'Other', 'bill@test.com', '1a1dc91c907325c69271ddf0c944bc72', NULL, '53363dae19c183.12004062', 'bill@test.com', 1, 1, 507, 0, 0),
(115, 'abhishek', 'saini', 'abhishek.saini@enukesoftware.com', '3ec22ea7499a4a4f33b2a25ccc925f1e', NULL, '53453125ee0632.72686363', 'abhishek.saini@enukesoftware.com', 1, 1, 509, 0, 0),
(116, 'Ted', 'Haddergash', 'ted@test.com', '1a1dc91c907325c69271ddf0c944bc72', NULL, '534e63289394c3.37189685', 'ted@test.com', 1, 1, 510, 0, 0),
(117, 'Tad', 'Haddergash', 'tad@billson.com', '1a1dc91c907325c69271ddf0c944bc72', NULL, '534e667188da20.00200784', 'tad@billson.com', 1, 1, 511, 0, 0);

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
  `number` int(11) NOT NULL DEFAULT '1',
  `release` varchar(6) NOT NULL,
  `project_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `object` int(2) NOT NULL,
  `action` tinyint(1) NOT NULL,
  `foreign_key` int(11) NOT NULL,
  `foreign_id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_user` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `project_id` (`project_id`),
  KEY `create_user` (`create_user`),
  KEY `active` (`active`),
  KEY `object` (`object`),
  KEY `action` (`action`),
  KEY `foreign_key` (`foreign_key`),
  KEY `foreign_id` (`foreign_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1727 ;

--
-- Dumping data for table `version`
--

INSERT INTO `version` (`id`, `number`, `release`, `project_id`, `status`, `object`, `action`, `foreign_key`, `foreign_id`, `active`, `create_date`, `create_user`) VALUES
(1374, 0, '104', 139, 1, 13, 1, 245, 1, 1, '2014-03-30 06:49:21', 114),
(1375, 1, '104', 139, 1, 13, 1, 246, 2, 1, '2014-03-30 06:49:21', 114),
(1376, 2, '104', 139, 1, 13, 1, 247, 3, 1, '2014-03-30 06:49:21', 114),
(1377, 3, '104', 139, 1, 4, 1, 113, 1, 1, '2014-03-30 09:55:20', 114),
(1378, 4, '104', 139, 1, 5, 1, 814, 1, 1, '2014-03-30 06:49:22', 114),
(1379, 5, '104', 139, 1, 10, 1, 132, 1, 1, '2014-03-30 07:19:12', 114),
(1380, 6, '104', 139, 1, 8, 1, 209, 1, 1, '2014-03-30 07:19:12', 114),
(1381, 7, '104', 139, 1, 9, 1, 305, 1, 1, '2014-03-30 07:19:12', 114),
(1382, 8, '104', 139, 1, 12, 1, 84, 1, 1, '2014-03-30 07:20:53', 114),
(1383, 9, '104', 139, 1, 15, 1, 62, 1, 1, '2014-03-30 07:20:53', 114),
(1384, 10, '104', 139, 1, 1, 1, 69, 1, 0, '2014-03-30 07:24:20', 114),
(1385, 11, '104', 139, 1, 16, 1, 44, 1, 1, '2014-03-30 07:20:58', 114),
(1386, 12, '104', 139, 1, 2, 1, 56, 1, 1, '2014-03-30 07:21:03', 114),
(1387, 13, '104', 139, 1, 14, 1, 43, 1, 1, '2014-03-30 07:21:03', 114),
(1388, 0, '105', 139, 1, 1, 1, 70, 1, 0, '2014-03-30 07:24:20', 114),
(1389, 0, '105', 139, 1, 2, 1, 57, 1, 0, '2014-03-30 09:56:17', 114),
(1390, 0, '105', 139, 1, 4, 1, 114, 1, 0, '2014-03-30 07:31:04', 114),
(1391, 0, '105', 139, 1, 5, 1, 815, 1, 1, '2014-03-30 07:22:01', 114),
(1392, 0, '105', 139, 1, 8, 1, 210, 1, 1, '2014-03-30 07:22:03', 114),
(1393, 0, '105', 139, 1, 9, 1, 306, 1, 1, '2014-03-30 07:22:04', 114),
(1394, 0, '105', 139, 1, 10, 1, 133, 1, 1, '2014-03-30 07:22:04', 114),
(1395, 0, '105', 139, 1, 12, 1, 85, 1, 0, '2014-03-30 10:24:07', 114),
(1396, 0, '105', 139, 1, 13, 1, 248, 1, 1, '2014-03-30 07:22:05', 114),
(1397, 0, '105', 139, 1, 13, 1, 249, 2, 1, '2014-03-30 07:22:05', 114),
(1398, 0, '105', 139, 1, 13, 1, 250, 3, 1, '2014-03-30 07:22:08', 114),
(1399, 0, '105', 139, 1, 14, 1, 44, 1, 1, '2014-03-30 07:22:14', 114),
(1400, 0, '105', 139, 1, 15, 1, 63, 1, 1, '2014-03-30 07:22:15', 114),
(1401, 0, '105', 139, 1, 16, 1, 45, 1, 1, '2014-03-30 07:22:17', 114),
(1402, 14, '105', 139, 1, 1, 2, 71, 1, 1, '2014-03-30 07:24:20', 114),
(1403, 15, '105', 139, 1, 3, 1, 17, 1, 1, '2014-03-30 07:30:18', 114),
(1404, 16, '105', 139, 1, 4, 2, 115, 1, 1, '2014-03-30 07:31:04', 114),
(1405, 17, '105', 139, 1, 2, 2, 58, 1, 1, '2014-03-30 09:56:17', 114),
(1406, 18, '105', 139, 1, 9, 1, 307, 2, 0, '2014-03-30 10:19:46', 114),
(1407, 19, '105', 139, 1, 12, 1, 86, 2, 1, '2014-03-30 10:19:28', 114),
(1408, 20, '105', 139, 1, 15, 1, 64, 2, 1, '2014-03-30 10:19:28', 114),
(1409, 21, '105', 139, 1, 9, 2, 308, 2, 1, '2014-03-30 10:19:46', 114),
(1410, 22, '105', 139, 1, 12, 2, 87, 1, 1, '2014-03-30 10:24:07', 114),
(1508, 0, '110', 145, 1, 2, 1, 67, 1, 1, '2014-03-30 11:11:30', 114),
(1509, 0, '110', 145, 1, 4, 1, 124, 1, 1, '2014-03-30 11:11:30', 114),
(1510, 0, '110', 145, 1, 5, 1, 824, 1, 1, '2014-03-30 11:11:30', 114),
(1511, 0, '110', 145, 1, 13, 1, 275, 1, 1, '2014-03-30 11:11:31', 114),
(1512, 0, '110', 145, 1, 13, 1, 276, 2, 1, '2014-03-30 11:11:31', 114),
(1513, 0, '110', 145, 1, 13, 1, 277, 3, 1, '2014-03-30 11:11:31', 114),
(1514, 0, '112', 139, 1, 1, 1, 72, 1, 1, '2014-03-30 11:19:29', 114),
(1515, 0, '112', 139, 1, 2, 1, 68, 1, 1, '2014-03-30 11:19:29', 114),
(1516, 0, '112', 139, 1, 4, 1, 125, 1, 1, '2014-03-30 11:19:29', 114),
(1517, 0, '112', 139, 1, 5, 1, 825, 1, 1, '2014-03-30 11:19:30', 114),
(1518, 0, '112', 139, 1, 13, 1, 278, 1, 1, '2014-03-30 11:19:30', 114),
(1519, 0, '112', 139, 1, 13, 1, 279, 2, 1, '2014-03-30 11:19:30', 114),
(1520, 0, '112', 139, 1, 13, 1, 280, 3, 1, '2014-03-30 11:19:30', 114),
(1521, 0, '113', 139, 1, 1, 1, 73, 1, 1, '2014-03-30 11:23:34', 114),
(1522, 0, '113', 139, 1, 2, 1, 69, 1, 1, '2014-03-30 11:23:34', 114),
(1523, 0, '113', 139, 1, 4, 1, 126, 1, 1, '2014-03-30 11:23:34', 114),
(1524, 0, '113', 139, 1, 5, 1, 826, 1, 0, '2014-04-13 13:29:48', 114),
(1525, 0, '113', 139, 1, 13, 1, 281, 1, 1, '2014-03-30 11:23:34', 114),
(1526, 0, '113', 139, 1, 13, 1, 282, 2, 1, '2014-03-30 11:23:35', 114),
(1527, 0, '113', 139, 1, 13, 1, 283, 3, 1, '2014-03-30 11:23:35', 114),
(1528, 23, '113', 139, 1, 10, 1, 141, 1, 0, '2014-04-13 13:32:48', 114),
(1529, 24, '113', 139, 1, 8, 1, 218, 1, 1, '2014-04-01 04:09:01', 114),
(1530, 25, '113', 139, 1, 9, 1, 316, 1, 0, '2014-04-01 04:09:34', 114),
(1531, 26, '113', 139, 1, 9, 2, 317, 1, 0, '2014-04-13 13:51:12', 114),
(1532, 27, '113', 139, 1, 12, 1, 95, 1, 0, '2014-04-01 04:18:41', 114),
(1533, 28, '113', 139, 1, 15, 1, 72, 1, 1, '2014-04-01 04:10:06', 114),
(1534, 29, '113', 139, 1, 12, 2, 96, 1, 0, '2014-04-01 04:19:58', 114),
(1535, 30, '113', 139, 1, 12, 2, 97, 1, 0, '2014-04-01 04:23:02', 114),
(1536, 31, '113', 139, 1, 12, 2, 98, 1, 0, '2014-04-01 11:21:08', 114),
(1537, 32, '113', 139, 1, 12, 2, 99, 1, 0, '2014-04-01 11:30:45', 114),
(1538, 33, '113', 139, 1, 12, 2, 100, 1, 1, '2014-04-01 11:30:45', 114),
(1539, 34, '113', 139, 1, 12, 1, 101, 2, 0, '2014-04-02 11:18:57', 114),
(1540, 35, '113', 139, 1, 12, 2, 102, 2, 1, '2014-04-02 11:18:57', 114),
(1541, 36, '113', 139, 1, 6, 1, 13, 1, 1, '2014-04-02 11:29:35', 114),
(1542, 37, '113', 139, 1, 7, 1, 10, 1, 1, '2014-04-02 11:30:07', 114),
(1543, 0, '113', 146, 1, 13, 1, 284, 1, 1, '2014-04-02 22:47:43', 114),
(1544, 1, '113', 146, 1, 13, 1, 285, 2, 1, '2014-04-02 22:47:43', 114),
(1545, 2, '113', 146, 1, 13, 1, 286, 3, 1, '2014-04-02 22:47:43', 114),
(1546, 3, '113', 146, 1, 4, 1, 127, 1, 1, '2014-04-02 22:47:43', 114),
(1547, 4, '113', 146, 1, 5, 1, 827, 1, 1, '2014-04-02 22:47:43', 114),
(1548, 5, '114', 146, 1, 4, 2, 128, 1, 1, '2014-04-02 22:50:01', 114),
(1549, 6, '114', 146, 1, 5, 2, 828, 1, 0, '2014-04-06 03:33:33', 114),
(1550, 7, '114', 146, 1, 10, 1, 142, 1, 1, '2014-04-02 22:51:41', 114),
(1551, 8, '114', 146, 1, 8, 1, 219, 1, 1, '2014-04-02 22:51:42', 114),
(1552, 9, '114', 146, 1, 9, 1, 318, 1, 0, '2014-04-02 22:52:41', 114),
(1553, 10, '114', 146, 1, 9, 2, 319, 1, 1, '2014-04-02 22:52:41', 114),
(1554, 11, '114', 146, 1, 12, 1, 103, 1, 0, '2014-04-02 23:11:56', 114),
(1555, 12, '114', 146, 1, 15, 1, 73, 1, 1, '2014-04-02 22:52:49', 114),
(1556, 13, '114', 146, 1, 1, 1, 74, 1, 0, '2014-04-02 22:58:03', 114),
(1557, 14, '114', 146, 1, 16, 1, 53, 1, 1, '2014-04-02 22:53:03', 114),
(1558, 15, '114', 146, 1, 9, 1, 320, 2, 0, '2014-04-02 22:54:00', 114),
(1559, 16, '114', 146, 1, 9, 2, 321, 2, 1, '2014-04-02 22:54:00', 114),
(1560, 17, '114', 146, 1, 1, 1, 75, 2, 0, '2014-04-02 22:58:51', 114),
(1561, 18, '114', 146, 1, 16, 1, 54, 2, 1, '2014-04-02 22:54:23', 114),
(1562, 19, '114', 146, 1, 2, 1, 70, 1, 1, '2014-04-02 22:54:43', 114),
(1563, 20, '114', 146, 1, 14, 1, 52, 1, 1, '2014-04-02 22:54:43', 114),
(1564, 21, '114', 146, 1, 12, 1, 104, 2, 0, '2014-04-02 23:14:25', 114),
(1565, 22, '114', 146, 1, 15, 1, 74, 2, 1, '2014-04-02 22:54:56', 114),
(1566, 23, '114', 146, 1, 8, 1, 220, 2, 1, '2014-04-02 22:55:04', 114),
(1567, 24, '114', 146, 1, 9, 1, 322, 3, 0, '2014-04-02 22:55:32', 114),
(1568, 25, '114', 146, 1, 9, 2, 323, 3, 1, '2014-04-02 22:55:32', 114),
(1569, 26, '114', 146, 1, 12, 1, 105, 3, 0, '2014-04-02 23:14:43', 114),
(1570, 27, '114', 146, 1, 15, 1, 75, 3, 1, '2014-04-02 22:55:49', 114),
(1571, 28, '114', 146, 1, 1, 2, 76, 1, 1, '2014-04-02 22:58:03', 114),
(1572, 29, '114', 146, 1, 1, 2, 77, 2, 1, '2014-04-02 22:58:51', 114),
(1573, 30, '114', 146, 1, 12, 2, 106, 1, 0, '2014-04-02 23:12:06', 114),
(1574, 31, '114', 146, 1, 12, 2, 107, 1, 0, '2014-04-02 23:12:29', 114),
(1575, 32, '114', 146, 1, 12, 2, 108, 1, 1, '2014-04-02 23:12:29', 114),
(1576, 33, '114', 146, 1, 12, 2, 109, 2, 1, '2014-04-02 23:14:25', 114),
(1577, 34, '114', 146, 1, 12, 2, 110, 3, 1, '2014-04-02 23:14:43', 114),
(1578, 35, '114', 146, 1, 3, 1, 18, 1, 0, '2014-04-02 23:31:24', 114),
(1579, 36, '114', 146, 1, 3, 1, 19, 2, 0, '2014-04-02 23:31:38', 114),
(1580, 37, '114', 146, 1, 3, 1, 20, 3, 0, '2014-04-06 05:28:00', 114),
(1581, 38, '114', 146, 1, 3, 2, 21, 1, 0, '2014-04-06 04:29:55', 114),
(1582, 39, '114', 146, 1, 3, 2, 22, 2, 0, '2014-04-06 05:26:32', 114),
(1583, 40, '114', 146, 1, 3, 1, 23, 4, 0, '2014-04-06 05:29:19', 114),
(1584, 41, '114', 146, 1, 3, 1, 24, 5, 0, '2014-04-06 05:33:39', 114),
(1585, 42, '114', 146, 1, 3, 1, 25, 6, 0, '2014-04-06 05:34:00', 114),
(1586, 43, '114', 146, 1, 1, 1, 78, 3, 0, '2014-04-03 00:02:49', 114),
(1587, 44, '114', 146, 1, 16, 1, 55, 3, 1, '2014-04-03 00:02:07', 114),
(1588, 45, '114', 146, 1, 1, 2, 79, 3, 0, '2014-04-07 00:29:16', 114),
(1589, 46, '114', 146, 1, 5, 2, 829, 1, 0, '2014-04-06 03:34:03', 114),
(1590, 47, '114', 146, 1, 5, 2, 830, 1, 0, '2014-04-06 03:40:45', 114),
(1591, 48, '114', 146, 1, 5, 2, 831, 1, 0, '2014-04-06 03:47:05', 114),
(1592, 49, '114', 146, 1, 5, 2, 832, 1, 0, '2014-04-06 03:47:32', 114),
(1593, 50, '114', 146, 1, 5, 2, 833, 1, 0, '2014-04-06 13:34:14', 114),
(1594, 38, '113', 139, 1, 5, 1, 834, 2, 0, '2014-04-13 13:30:06', 114),
(1595, 39, '113', 139, 1, 10, 1, 143, 2, 0, '2014-04-13 13:31:31', 114),
(1596, 40, '113', 139, 1, 8, 1, 221, 2, 1, '2014-04-06 03:58:17', 114),
(1597, 41, '113', 139, 1, 9, 1, 324, 2, 0, '2014-04-13 13:52:05', 114),
(1598, 51, '114', 146, 1, 3, 2, 26, 1, 0, '2014-04-06 05:17:42', 114),
(1599, 52, '114', 146, 1, 3, 2, 27, 1, 0, '2014-04-06 05:19:17', 114),
(1600, 53, '114', 146, 1, 3, 2, 28, 1, 0, '2014-04-06 05:21:08', 114),
(1601, 54, '114', 146, 1, 3, 2, 29, 1, 0, '2014-04-06 05:21:36', 114),
(1602, 55, '114', 146, 1, 3, 2, 30, 1, 0, '2014-04-06 05:25:16', 114),
(1603, 56, '114', 146, 1, 3, 2, 31, 1, 0, '2014-04-06 05:26:13', 114),
(1604, 57, '114', 146, 1, 3, 2, 32, 1, 1, '2014-04-06 05:26:13', 114),
(1605, 58, '114', 146, 1, 3, 2, 33, 2, 1, '2014-04-06 05:26:32', 114),
(1606, 59, '114', 146, 1, 3, 2, 34, 3, 1, '2014-04-06 05:28:00', 114),
(1607, 60, '114', 146, 1, 3, 2, 35, 4, 0, '2014-04-06 05:35:30', 114),
(1608, 61, '114', 146, 1, 3, 2, 36, 5, 1, '2014-04-06 05:33:39', 114),
(1609, 62, '114', 146, 1, 3, 2, 37, 6, 1, '2014-04-06 05:34:00', 114),
(1610, 63, '114', 146, 1, 3, 2, 38, 4, 1, '2014-04-06 05:35:30', 114),
(1611, 64, '114', 146, 1, 13, 1, 284, 1, 1, '2014-04-06 10:45:59', 114),
(1612, 64, '114', 146, 1, 13, 1, 285, 2, 1, '2014-04-06 10:46:27', 114),
(1613, 64, '114', 146, 1, 13, 1, 286, 3, 1, '2014-04-06 10:46:39', 114),
(1614, 65, '114', 146, 1, 5, 2, 835, 1, 1, '2014-04-06 13:34:14', 114),
(1615, 66, '114', 146, 1, 6, 1, 14, 1, 1, '2014-04-07 00:20:07', 114),
(1616, 67, '114', 146, 1, 7, 1, 11, 1, 1, '2014-04-07 00:20:53', 114),
(1617, 68, '114', 146, 1, 1, 2, 80, 3, 1, '2014-04-07 00:29:16', 114),
(1618, 69, '114', 146, 1, 1, 1, 81, 4, 0, '2014-04-07 00:34:44', 114),
(1619, 70, '114', 146, 1, 16, 1, 56, 4, 1, '2014-04-07 00:30:27', 114),
(1620, 71, '114', 146, 1, 8, 1, 222, 3, 1, '2014-04-07 00:31:00', 114),
(1621, 72, '114', 146, 1, 9, 1, 325, 4, 0, '2014-04-07 00:31:41', 114),
(1622, 73, '114', 146, 1, 9, 2, 326, 4, 1, '2014-04-07 00:31:41', 114),
(1623, 74, '114', 146, 1, 12, 1, 111, 4, 0, '2014-04-07 00:35:12', 114),
(1624, 75, '114', 146, 1, 15, 1, 76, 4, 1, '2014-04-07 00:31:54', 114),
(1625, 76, '114', 146, 1, 1, 2, 82, 4, 1, '2014-04-07 00:34:44', 114),
(1626, 77, '114', 146, 1, 12, 2, 112, 4, 1, '2014-04-07 00:35:12', 114),
(1627, 0, '115', 146, 1, 1, 1, 83, 1, 1, '2014-04-07 00:55:34', 114),
(1628, 0, '115', 146, 1, 1, 1, 84, 2, 1, '2014-04-07 00:55:34', 114),
(1629, 0, '115', 146, 1, 1, 1, 85, 3, 1, '2014-04-07 00:55:34', 114),
(1630, 0, '115', 146, 1, 1, 1, 86, 4, 1, '2014-04-07 00:55:35', 114),
(1631, 0, '115', 146, 1, 2, 1, 71, 1, 1, '2014-04-07 00:55:35', 114),
(1632, 0, '115', 146, 1, 3, 1, 39, 1, 1, '2014-04-07 00:55:36', 114),
(1633, 0, '115', 146, 1, 3, 1, 40, 2, 1, '2014-04-07 00:55:36', 114),
(1634, 0, '115', 146, 1, 3, 1, 41, 3, 1, '2014-04-07 00:55:37', 114),
(1635, 0, '115', 146, 1, 3, 1, 42, 5, 1, '2014-04-07 00:55:37', 114),
(1636, 0, '115', 146, 1, 3, 1, 43, 6, 1, '2014-04-07 00:55:38', 114),
(1637, 0, '115', 146, 1, 3, 1, 44, 4, 1, '2014-04-07 00:55:39', 114),
(1638, 0, '115', 146, 1, 4, 1, 129, 1, 1, '2014-04-07 00:55:39', 114),
(1639, 0, '115', 146, 1, 5, 1, 836, 1, 1, '2014-04-07 00:55:39', 114),
(1640, 0, '115', 146, 1, 6, 1, 15, 1, 1, '2014-04-07 00:55:40', 114),
(1641, 0, '115', 146, 1, 7, 1, 12, 1, 1, '2014-04-07 00:55:40', 114),
(1642, 0, '115', 146, 1, 8, 1, 223, 1, 1, '2014-04-07 00:55:40', 114),
(1643, 0, '115', 146, 1, 8, 1, 224, 2, 1, '2014-04-07 00:55:40', 114),
(1644, 0, '115', 146, 1, 8, 1, 225, 3, 1, '2014-04-07 00:55:41', 114),
(1645, 0, '115', 146, 1, 9, 1, 327, 1, 1, '2014-04-07 00:55:41', 114),
(1646, 0, '115', 146, 1, 9, 1, 328, 2, 1, '2014-04-07 00:55:41', 114),
(1647, 0, '115', 146, 1, 9, 1, 329, 3, 1, '2014-04-07 00:55:42', 114),
(1648, 0, '115', 146, 1, 9, 1, 330, 4, 1, '2014-04-07 00:55:42', 114),
(1649, 0, '115', 146, 1, 10, 1, 144, 1, 0, '2014-04-13 05:08:31', 114),
(1650, 0, '115', 146, 1, 12, 1, 113, 1, 1, '2014-04-07 00:55:46', 114),
(1651, 0, '115', 146, 1, 12, 1, 114, 2, 1, '2014-04-07 00:55:48', 114),
(1652, 0, '115', 146, 1, 12, 1, 115, 3, 1, '2014-04-07 00:55:49', 114),
(1653, 0, '115', 146, 1, 12, 1, 116, 4, 1, '2014-04-07 00:55:49', 114),
(1654, 0, '115', 146, 1, 13, 1, 287, 1, 1, '2014-04-07 00:55:50', 114),
(1655, 0, '115', 146, 1, 13, 1, 288, 2, 1, '2014-04-07 00:55:50', 114),
(1656, 0, '115', 146, 1, 13, 1, 289, 3, 1, '2014-04-07 00:55:50', 114),
(1657, 0, '115', 146, 1, 14, 1, 53, 1, 1, '2014-04-07 00:55:51', 114),
(1658, 0, '115', 146, 1, 15, 1, 77, 1, 1, '2014-04-07 00:55:51', 114),
(1659, 0, '115', 146, 1, 15, 1, 78, 2, 1, '2014-04-07 00:55:51', 114),
(1660, 0, '115', 146, 1, 15, 1, 79, 3, 1, '2014-04-07 00:55:52', 114),
(1661, 0, '115', 146, 1, 15, 1, 80, 4, 1, '2014-04-07 00:55:52', 114),
(1662, 0, '115', 146, 1, 16, 1, 57, 1, 1, '2014-04-07 00:55:52', 114),
(1663, 0, '115', 146, 1, 16, 1, 58, 2, 1, '2014-04-07 00:55:53', 114),
(1664, 0, '115', 146, 1, 16, 1, 59, 3, 1, '2014-04-07 00:55:53', 114),
(1665, 0, '115', 146, 1, 16, 1, 60, 4, 1, '2014-04-07 00:55:53', 114),
(1666, 42, '113', 139, 1, 10, 1, 145, 3, 0, '2014-04-13 13:35:46', 114),
(1667, 43, '113', 139, 1, 8, 1, 226, 3, 1, '2014-04-07 14:15:32', 114),
(1668, 44, '113', 139, 1, 9, 1, 331, 3, 0, '2014-04-08 11:35:39', 114),
(1669, 45, '113', 139, 1, 4, 1, 130, 2, 1, '2014-04-08 11:35:14', 114),
(1670, 46, '113', 139, 1, 9, 2, 332, 3, 0, '2014-04-13 13:40:21', 114),
(1671, 47, '113', 139, 1, 9, 1, 333, 4, 0, '2014-04-08 12:02:25', 114),
(1672, 48, '113', 139, 1, 9, 2, 334, 4, 1, '2014-04-08 12:02:25', 114),
(1673, 49, '113', 139, 1, 4, 1, 131, 3, 1, '2014-04-08 12:11:11', 114),
(1674, 50, '113', 139, 1, 9, 1, 335, 5, 0, '2014-04-08 12:22:21', 114),
(1675, 51, '113', 139, 1, 9, 2, 336, 5, 0, '2014-04-13 13:40:28', 114),
(1676, 52, '113', 139, 1, 10, 1, 146, 4, 0, '2014-04-13 13:37:06', 114),
(1677, 53, '113', 139, 1, 8, 1, 227, 4, 1, '2014-04-08 12:44:56', 114),
(1678, 54, '113', 139, 1, 9, 1, 337, 6, 0, '2014-04-13 13:41:26', 114),
(1679, 55, '113', 139, 1, 8, 1, 228, 5, 0, '2014-04-13 13:40:42', 114),
(1680, 56, '113', 139, 1, 9, 1, 338, 7, 0, '2014-04-09 23:01:12', 114),
(1681, 57, '113', 139, 1, 9, 2, 339, 7, 1, '2014-04-09 23:01:12', 114),
(1682, 58, '113', 139, 1, 8, 1, 229, 6, 0, '2014-04-13 13:40:39', 114),
(1683, 59, '113', 139, 1, 9, 1, 340, 8, 0, '2014-04-09 23:01:23', 114),
(1684, 60, '113', 139, 1, 9, 2, 341, 8, 1, '2014-04-09 23:01:23', 114),
(1685, 61, '113', 139, 1, 9, 1, 342, 9, 0, '2014-04-09 23:01:38', 114),
(1686, 62, '113', 139, 1, 9, 2, 343, 9, 0, '2014-04-13 13:40:16', 114),
(1687, 78, '115', 146, 1, 10, 2, 147, 1, 1, '2014-04-13 05:08:31', 114),
(1688, 63, '113', 139, 1, 5, 2, 837, 1, 1, '2014-04-13 13:29:48', 114),
(1689, 64, '113', 139, 1, 5, 2, 838, 2, 1, '2014-04-13 13:30:06', 114),
(1690, 65, '113', 139, 1, 10, 2, 148, 2, 1, '2014-04-13 13:31:31', 114),
(1691, 66, '113', 139, 1, 10, 2, 149, 1, 0, '2014-04-13 13:44:23', 114),
(1692, 67, '113', 139, 1, 5, 1, 839, 3, 1, '2014-04-13 13:33:08', 114),
(1693, 68, '113', 139, 1, 10, 1, 150, 5, 1, '2014-04-13 13:33:59', 114),
(1694, 69, '113', 139, 1, 8, 1, 230, 7, 1, '2014-04-13 13:33:59', 114),
(1695, 70, '113', 139, 1, 9, 1, 344, 10, 1, '2014-04-13 13:33:59', 114),
(1696, 71, '113', 139, 1, 10, 2, 151, 3, 1, '2014-04-13 13:35:46', 114),
(1697, 72, '113', 139, 1, 10, 2, 152, 4, 1, '2014-04-13 13:37:06', 114),
(1698, 73, '113', 139, 1, 10, 1, 153, 6, 1, '2014-04-13 13:39:23', 114),
(1699, 74, '113', 139, 1, 8, 1, 231, 8, 1, '2014-04-13 13:39:23', 114),
(1700, 75, '113', 139, 1, 9, 1, 345, 11, 1, '2014-04-13 13:39:23', 114),
(1701, 76, '113', 139, 1, 9, 2, 346, 9, 1, '2014-04-13 13:40:16', 114),
(1702, 77, '113', 139, 1, 9, 2, 347, 3, 1, '2014-04-13 13:40:22', 114),
(1703, 78, '113', 139, 1, 9, 2, 348, 5, 1, '2014-04-13 13:40:28', 114),
(1704, 79, '113', 139, 1, 8, 3, 229, 6, 0, '2014-04-13 13:40:39', 114),
(1705, 80, '113', 139, 1, 8, 3, 228, 5, 0, '2014-04-13 13:40:42', 114),
(1706, 81, '113', 139, 1, 9, 2, 349, 6, 1, '2014-04-13 13:41:26', 114),
(1707, 82, '113', 139, 1, 10, 2, 154, 1, 1, '2014-04-13 13:44:23', 114),
(1708, 83, '113', 139, 1, 10, 1, 155, 7, 1, '2014-04-13 13:45:08', 114),
(1709, 84, '113', 139, 1, 8, 1, 232, 9, 1, '2014-04-13 13:45:08', 114),
(1710, 85, '113', 139, 1, 9, 1, 350, 12, 1, '2014-04-13 13:45:08', 114),
(1711, 86, '113', 139, 1, 10, 1, 156, 8, 0, '2014-04-13 13:47:30', 114),
(1712, 87, '113', 139, 1, 8, 1, 233, 10, 1, '2014-04-13 13:47:05', 114),
(1713, 88, '113', 139, 1, 9, 1, 351, 13, 0, '2014-04-13 13:48:38', 114),
(1714, 89, '113', 139, 1, 10, 2, 157, 8, 1, '2014-04-13 13:47:30', 114),
(1715, 90, '113', 139, 1, 9, 2, 352, 13, 1, '2014-04-13 13:48:38', 114),
(1716, 91, '113', 139, 1, 9, 1, 353, 14, 0, '2014-04-13 13:49:40', 114),
(1717, 92, '113', 139, 1, 9, 2, 354, 14, 1, '2014-04-13 13:49:40', 114),
(1718, 93, '113', 139, 1, 9, 2, 355, 1, 1, '2014-04-13 13:51:12', 114),
(1719, 94, '113', 139, 1, 9, 1, 356, 15, 0, '2014-04-13 13:51:54', 114),
(1720, 95, '113', 139, 1, 9, 2, 357, 15, 1, '2014-04-13 13:51:54', 114),
(1721, 96, '113', 139, 1, 9, 2, 358, 2, 1, '2014-04-13 13:52:05', 114),
(1722, 97, '113', 139, 1, 17, 1, 16, 2, 1, '2014-04-16 23:17:33', 114),
(1723, 98, '113', 139, 1, 17, 1, 17, 2, 1, '2014-04-16 23:16:46', 114),
(1724, 99, '113', 139, 1, 18, 1, 13, 1, 0, '2014-04-17 09:13:02', 114),
(1725, 100, '113', 139, 1, 18, 2, 14, 1, 1, '2014-04-17 09:13:02', 114),
(1726, 101, '113', 139, 1, 18, 1, 15, 2, 1, '2014-04-17 09:14:19', 114);

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
  ADD CONSTRAINT `flow_ibfk_3` FOREIGN KEY (`usecase_id`) REFERENCES `usecase` (`usecase_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `form`
--
ALTER TABLE `form`
  ADD CONSTRAINT `form_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `formproperty`
--
ALTER TABLE `formproperty`
  ADD CONSTRAINT `formproperty_ibfk_2` FOREIGN KEY (`form_id`) REFERENCES `form` (`form_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `iface`
--
ALTER TABLE `iface`
  ADD CONSTRAINT `iface_ibfk_3` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `iface_ibfk_4` FOREIGN KEY (`type_id`) REFERENCES `interfacetype` (`interfacetype_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `interfacetype`
--
ALTER TABLE `interfacetype`
  ADD CONSTRAINT `interfacetype_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `library`
--
ALTER TABLE `library`
  ADD CONSTRAINT `library_ibfk_2` FOREIGN KEY (`owner_id`) REFERENCES `company` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `library_ibfk_3` FOREIGN KEY (`release_id`) REFERENCES `release` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `object`
--
ALTER TABLE `object`
  ADD CONSTRAINT `object_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `objectproperty`
--
ALTER TABLE `objectproperty`
  ADD CONSTRAINT `objectproperty_ibfk_1` FOREIGN KEY (`object_id`) REFERENCES `object` (`object_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `package`
--
ALTER TABLE `package`
  ADD CONSTRAINT `package_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `photo`
--
ALTER TABLE `photo`
  ADD CONSTRAINT `photo_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `photo_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `photo_ibfk_3` FOREIGN KEY (`release_id`) REFERENCES `release` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `step_ibfk_2` FOREIGN KEY (`flow_id`) REFERENCES `flow` (`flow_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `stepform`
--
ALTER TABLE `stepform`
  ADD CONSTRAINT `stepform_ibfk_3` FOREIGN KEY (`step_id`) REFERENCES `step` (`step_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stepform_ibfk_4` FOREIGN KEY (`form_id`) REFERENCES `form` (`form_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `stepiface`
--
ALTER TABLE `stepiface`
  ADD CONSTRAINT `stepiface_ibfk_1` FOREIGN KEY (`step_id`) REFERENCES `step` (`step_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stepiface_ibfk_2` FOREIGN KEY (`iface_id`) REFERENCES `iface` (`iface_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `steprule`
--
ALTER TABLE `steprule`
  ADD CONSTRAINT `steprule_ibfk_4` FOREIGN KEY (`rule_id`) REFERENCES `rule` (`rule_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `steprule_ibfk_5` FOREIGN KEY (`step_id`) REFERENCES `step` (`step_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `testrun`
--
ALTER TABLE `testrun`
  ADD CONSTRAINT `testrun_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `teststep`
--
ALTER TABLE `teststep`
  ADD CONSTRAINT `teststep_ibfk_1` FOREIGN KEY (`testcase_id`) REFERENCES `testcase` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `usecase`
--
ALTER TABLE `usecase`
  ADD CONSTRAINT `usecase_ibfk_1` FOREIGN KEY (`package_id`) REFERENCES `package` (`package_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `uses`
--
ALTER TABLE `uses`
  ADD CONSTRAINT `uses_ibfk_2` FOREIGN KEY (`usedby`) REFERENCES `usecase` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `uses_ibfk_3` FOREIGN KEY (`uses`) REFERENCES `usecase` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `version`
--
ALTER TABLE `version`
  ADD CONSTRAINT `version_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `version_ibfk_2` FOREIGN KEY (`create_user`) REFERENCES `user` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
