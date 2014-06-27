-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 27, 2014 at 05:40 PM
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
  `number` int(6) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `pretest` text,
  `alias` text NOT NULL,
  `inherits` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `project_id` (`project_id`),
  KEY `release_id` (`release_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=323 ;

--
-- Dumping data for table `actor`
--

INSERT INTO `actor` (`id`, `type`, `actor_id`, `project_id`, `release_id`, `number`, `name`, `description`, `pretest`, `alias`, `inherits`) VALUES
(186, 0, 1, 184, 165, 1, 'Member', 'A user who has an account and can access the system.', 'Must be logged in as a member', 'Placeholder', -1),
(187, 0, 2, 184, 165, 2, 'User', 'A public user of the system', 'None', 'Public', -1),
(209, 0, 1, 193, 177, 1, 'Actor', 'My First Actor', NULL, 'Placeholder', -1),
(215, 0, 1, 193, 177, 1, 'Actor', 'My First Actor', NULL, 'Placeholder', -1),
(216, 0, 1, 193, 177, 1, 'Actor', 'My First Actor', NULL, 'Placeholder', -1),
(222, 0, 1, 199, 186, 1, 'Actor', 'My First Actor', NULL, 'Placeholder', -1),
(223, 0, 1, 199, 186, 1, 'User', 'A public user of the system', 'None', 'Placeholder', -1),
(224, 0, 2, 199, 186, 2, 'Member', 'A user with an account on the system', 'Log in as a member', 'Registered User, Account Holder', -1),
(225, 0, 1, 199, 187, 1, 'User', 'A public user of the system', 'None', 'Placeholder', -1),
(226, 0, 2, 199, 187, 2, 'Member', 'A user with an account on the system', 'Log in as a member', 'Registered User, Account Holder', -1),
(227, 0, 1, 184, 165, 1, 'Member', 'A user who has an account and can access the system.', 'Must be logged in as a member', 'Placeholder', -1),
(228, 0, 1, 184, 165, 1, 'Member', 'A user who has an account and can access the system.', 'Must be logged in as a member', 'Placeholder', -1),
(229, 0, 1, 184, 165, 1, 'Member', 'A user who has an account and can access the system.', 'Must be logged in as a member', 'Placeholder', -1),
(230, 0, 1, 184, 165, 1, 'Member', 'A user who has an account and can access the system.', 'Must be logged in as a member', 'Placeholder', -1),
(231, 0, 1, 184, 165, 1, 'Member', 'A user who has an account and can access the system.', 'Must be logged in as a member', 'Placeholder', -1),
(232, 0, 1, 184, 165, 1, 'Member', 'A user who has an account and can access the system.', 'Must be logged in as a member', 'Placeholder', -1),
(233, 0, 1, 184, 165, 1, 'Member', 'A user who has an account and can access the system.', 'Must be logged in as a member', 'Placeholder', -1),
(234, 0, 1, 184, 165, 1, 'Member', 'A user who has an account and can access the system.', 'Must be logged in as a member', 'Placeholder', -1),
(235, 0, 1, 184, 165, 1, 'Member', 'A user who has an account and can access the system.', 'Must be logged in as a member', 'Placeholder', -1),
(236, 0, 1, 184, 165, 1, 'Member', 'A user who has an account and can access the system.', 'Must be logged in as a member', 'Placeholder', 2),
(241, 0, 1, 201, 189, 1, 'Actor', 'My First Actor', NULL, 'Placeholder', -1),
(242, 0, 1, 202, 190, 1, 'Actor', 'My First Actor', NULL, 'Placeholder', -1),
(243, 0, 4, 202, 190, 1, 'User', 'A public user of the system', 'None', 'Placeholder', -1),
(244, 0, 5, 202, 190, 2, 'Member', 'A user with an account on the system', 'Log in as a member', 'Registered User, Account Holder', -1),
(245, 0, 2, 193, 178, 2, 'User', 'user', 'user', 'user', -1),
(249, 0, 1, 203, 192, 1, 'Actor', 'My First Actor', NULL, 'Placeholder', -1),
(250, 0, 1, 203, 193, 1, 'Actor', 'My First Actor', NULL, 'Placeholder', -1),
(251, 0, 2, 184, 194, 2, 'User', 'A public user of the system', 'None', 'Public', -1),
(252, 0, 1, 184, 194, 1, 'Member', 'A user who has an account and can access the system.', 'Must be logged in as a member', 'Placeholder', 2),
(308, 0, 1, 222, 243, 1, 'Actor', 'My First Actor', NULL, 'Placeholder', -1),
(309, 0, 1, 222, 244, 1, 'Actor', 'My First Actor', NULL, 'Placeholder', -1),
(310, 0, 1, 222, 245, 1, 'Actor', 'My First Actor', NULL, 'Placeholder', -1),
(311, 0, 1, 222, 246, 1, 'Actor', 'My First Actor', NULL, 'Placeholder', -1),
(312, 0, 8, 222, 243, 1, 'User', 'A public user of the system', 'None', 'Placeholder', -1),
(313, 0, 9, 222, 243, 2, 'Member', 'A user with an account on the system', 'Log in as a member', 'Registered User, Account Holder', -1),
(316, 0, 1, 226, 250, 1, 'Actor', 'My First Actor', NULL, 'Placeholder', -1),
(317, 0, 2, 226, 250, 2, 'Top', 'Top actor', 'aoeu', 'aoeu', -1),
(318, 0, 3, 226, 250, 3, 'middle', 'middle', 'middle', ' middle', -1),
(319, 0, 4, 226, 250, 4, 'Bottom', 'bottom', 'bottom', 'bottom', -1),
(320, 0, 3, 226, 250, 3, 'middle', 'middle', 'middle', ' middle', 2),
(321, 0, 4, 226, 250, 4, 'Bottom', 'bottom', 'bottom', 'bottom', 3),
(322, 0, 1, 227, 251, 1, 'Actor', 'My First Actor', NULL, 'Placeholder', -1);

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
  `description` text,
  `order` varchar(4) NOT NULL,
  `project_id` int(11) NOT NULL,
  `release_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `project_id` (`project_id`),
  KEY `category_id` (`category_id`),
  KEY `project_id_2` (`project_id`),
  KEY `release_id` (`release_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=64 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category_id`, `number`, `name`, `description`, `order`, `project_id`, `release_id`) VALUES
(48, 1, '1', 'Introduction', 'Introduction to the document', '1.5', 202, 190),
(49, 2, '2', 'Background', 'This is a test', '1.5', 202, 190),
(50, 1, '1', 'Introduction', 'Introduction to the document', '0.5', 202, 190),
(51, 1, '1', 'Introduction', 'Introduction to the document is now somewhat longer.', '0.5', 202, 190),
(52, 1, '1', 'Introduction', 'Introduction to the document again', '0.5', 202, 190),
(57, 1, '1', 'aoeu', '<p>aoeu</p>', '1.5', 184, 165),
(58, 2, '2', 'Introduction', '<p>OK, testing this redactor thing.</p><p>I need a bullet list:</p><p><ul><li><span style="line-height: 1.45em;">One&nbsp;</span><br></li><li><span style="line-height: 1.45em;">Two</span><br></li><li><span style="line-height: 1.45em;">Three</span><br></li></ul></p>', '1.5', 184, 165),
(59, 1, '1', 'aoeu', '<p>aoeu</p>', '1.5', 184, 194),
(60, 2, '2', 'Introduction', '<p>OK, testing this redactor thing.</p><p>I need a bullet list:</p><p><ul><li><span style="line-height: 1.45em;">One&nbsp;</span><br></li><li><span style="line-height: 1.45em;">Two</span><br></li><li><span style="line-height: 1.45em;">Three</span><br></li></ul></p>', '1.5', 184, 194),
(61, 2, '2', 'Introduction', '<p>OK, testing this redactor thing.</p><p>I need a bullet list:</p><p><ul><li><span style="line-height: 1.45em;">One&nbsp;</span><br></li><li><span style="line-height: 1.45em;">Two</span><br></li><li><span style="line-height: 1.45em;">Three</span><br></li></ul></p>', '0.5', 184, 194),
(62, 1, '1', 'aoeu', '<p>eoau</p>', '1.5', 226, 250),
(63, 1, '1', 'ouid', '<p>iuoeiueui</p>', '1.5', 222, 243);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=518 ;

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
(511, NULL, 'Haddergash consulting', 'second attempt to create', 117, -1, 3, 0, 0, '2014-04-16 11:16:43'),
(512, NULL, 'A new company', 'company', 118, -1, 1, 0, 0, '2014-05-05 05:32:08'),
(513, NULL, 'Lovely Co', 'Test if I''m admin', 120, -1, 1, 0, 0, '2014-05-05 10:25:53'),
(514, NULL, 'aoue', 'aoeu', 113, 505, 2, 1, 0, '2014-06-24 06:15:39'),
(515, NULL, 'BFC', 'An analysis and consulting company.', 140, -1, 1, 0, 0, '2014-06-25 23:14:34'),
(516, NULL, 'oeu', 'aoeu', 146, -1, 1, 0, 0, '2014-06-26 11:38:05'),
(517, NULL, 'ABC', 'aoeu', 140, 515, 2, 1, 0, '2014-06-26 23:42:41');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `firstname`, `lastname`, `phone`, `mobile`, `email`, `user_id`, `owner_id`, `companyowner_id`, `company_id`) VALUES
(1, 'Bill', 'Knowlen', '099090', '909090', 'bill@test.com', 114, 113, 505, 506),
(2, 'Tad', 'Haddergash', '989898989', '89898999', 'tad@billson.com', 117, 114, 507, 508),
(3, 'Test', 'Contact', '9989', '9090', 'testly@testing.co.uk', 0, 113, 505, 506),
(4, 'Testing', 'Invite', '99', '999', 'invite@test.com', 118, 113, 505, 506),
(5, 'No', 'account', 'aoue', 'aoue', 'no@account.com', 0, 113, 505, 514),
(6, 'Peter', ' Markham', '7070', '7809709', 'pmarkham@thes.cocm', 0, 140, 515, 517);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `document`
--

INSERT INTO `document` (`id`, `name`, `description`, `type`, `foreign_key`, `document_type`, `modified_date`, `modified`) VALUES
(1, 'Target Business Model', 'Plan do check act', 1, 139, 65, '2014-03-29 13:00:00', 114),
(2, 'oaeu', 'aoeuoeu', 1, 227, 91, '2014-06-26 14:00:00', 140);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=101 ;

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
(80, 511, 'General', 'General'),
(81, 512, 'Architectural', 'Architectural'),
(82, 512, 'Engineering', 'Engineering'),
(83, 512, 'Services', 'Services'),
(84, 512, 'Planning', 'Planning'),
(85, 512, 'General', 'General'),
(86, 513, 'Architectural', 'Architectural'),
(87, 513, 'Engineering', 'Engineering'),
(88, 513, 'Services', 'Services'),
(89, 513, 'Planning', 'Planning'),
(90, 513, 'General', 'General'),
(91, 515, 'Architectural', 'Architectural'),
(92, 515, 'Engineering', 'Engineering'),
(93, 515, 'Services', 'Services'),
(94, 515, 'Planning', 'Planning'),
(95, 515, 'General', 'General'),
(96, 516, 'Architectural', 'Architectural'),
(97, 516, 'Engineering', 'Engineering'),
(98, 516, 'Services', 'Services'),
(99, 516, 'Planning', 'Planning'),
(100, 516, 'General', 'General');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `documentversion`
--

INSERT INTO `documentversion` (`id`, `document_id`, `version`, `date`, `file`, `modified`, `modified_date`) VALUES
(1, 1, '1.0', '2014-03-04', '5337f3f7255fe.pdf', 114, '2014-03-29 13:00:00'),
(2, 2, '1.0', '2014-06-12', '53acaa258ec96.pdf', 140, '2014-06-26 14:00:00');

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
  KEY `flow_id` (`flow_id`),
  KEY `project_id` (`project_id`),
  KEY `release_id` (`release_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=516 ;

--
-- Dumping data for table `flow`
--

INSERT INTO `flow` (`id`, `flow_id`, `project_id`, `release_id`, `name`, `usecase_id`, `main`, `startstep_id`, `rejoinstep_id`) VALUES
(338, 1, 184, 165, 'Main', 1, 1, 0, 0),
(339, 2, 184, 165, 'Main', 2, 1, 0, 0),
(340, 3, 184, 165, 'Main', 3, 1, 0, 0),
(341, 4, 184, 165, 'Main', 4, 1, 0, 0),
(342, 5, 184, 165, 'Main', 5, 1, 0, 0),
(343, 6, 184, 165, 'Main', 6, 1, 0, 0),
(356, 1, 193, 177, 'Main', 1, 1, 0, 0),
(361, 1, 199, 186, 'Main', 1, 1, 0, 0),
(362, 2, 199, 186, 'Main', 2, 1, 0, 0),
(363, 3, 199, 186, 'Main', 3, 1, 0, 0),
(364, 4, 199, 186, 'Main', 4, 1, 0, 0),
(365, 5, 199, 186, 'Main', 5, 1, 0, 0),
(366, 1, 199, 187, 'Main', 1, 1, 0, 0),
(367, 2, 199, 187, 'Main', 2, 1, 0, 0),
(368, 3, 199, 187, 'Main', 3, 1, 0, 0),
(369, 4, 199, 187, 'Main', 4, 1, 0, 0),
(370, 5, 199, 187, 'Main', 5, 1, 0, 0),
(371, 7, 184, 165, 'Main', 7, 1, 0, 0),
(372, 8, 184, 165, 'Main', 8, 1, 0, 0),
(409, 6, 199, 187, 'Main', 6, 1, 0, 0),
(410, 7, 199, 187, 'Main', 7, 1, 0, 0),
(411, 8, 199, 187, 'Main', 8, 1, 0, 0),
(412, 4, 202, 190, 'Main', 4, 1, 3, 3),
(413, 5, 202, 190, 'Main', 5, 1, 3, 3),
(414, 6, 202, 190, 'Main', 6, 1, 3, 3),
(415, 7, 202, 190, 'Main', 7, 1, 3, 3),
(416, 8, 202, 190, 'Main', 8, 1, 3, 3),
(417, 9, 202, 190, 'Main', 9, 1, 0, 0),
(418, 10, 202, 190, 'Main', 10, 1, 0, 0),
(419, 11, 202, 190, 'Main', 11, 1, 0, 0),
(420, 12, 202, 190, 'Main', 12, 1, 0, 0),
(421, 13, 202, 190, 'Main', 13, 1, 0, 0),
(422, 2, 193, 178, 'Main', 2, 1, 0, 0),
(440, 1, 203, 192, 'Main', 1, 1, 0, 0),
(441, 2, 203, 192, 'Main', 2, 1, 0, 0),
(442, 3, 203, 192, 'Main', 3, 1, 0, 0),
(443, 4, 203, 192, 'A', 2, 0, 4, 4),
(444, 1, 203, 193, 'Main', 1, 1, 0, 0),
(445, 2, 203, 193, 'Main', 2, 1, 0, 0),
(446, 4, 203, 193, 'A', 2, 0, 4, 4),
(447, 3, 203, 193, 'Main', 3, 1, 0, 0),
(448, 5, 203, 193, 'Main', 4, 1, 0, 0),
(449, 1, 184, 194, 'Main', 1, 1, 0, 0),
(450, 2, 184, 194, 'Main', 2, 1, 0, 0),
(451, 3, 184, 194, 'Main', 3, 1, 0, 0),
(452, 4, 184, 194, 'Main', 4, 1, 0, 0),
(453, 5, 184, 194, 'Main', 5, 1, 0, 0),
(454, 6, 184, 194, 'Main', 6, 1, 0, 0),
(455, 7, 184, 194, 'Main', 7, 1, 0, 0),
(456, 8, 184, 194, 'Main', 8, 1, 0, 0),
(500, 1, 222, 243, 'Main', 1, 1, 0, 0),
(501, 2, 222, 243, 'Main', 2, 1, 0, 0),
(502, 1, 222, 246, 'Main', 1, 1, 0, 0),
(503, 2, 222, 246, 'Main', 2, 1, 0, 0),
(504, 3, 222, 243, 'Main', 3, 1, 0, 0),
(505, 8, 222, 243, 'Main', 8, 1, 7, 7),
(506, 9, 222, 243, 'Main', 9, 1, 7, 7),
(507, 10, 222, 243, 'Main', 10, 1, 7, 7),
(508, 11, 222, 243, 'Main', 11, 1, 7, 7),
(509, 12, 222, 243, 'Main', 12, 1, 7, 7),
(512, 1, 226, 250, 'Main', 1, 1, 0, 0),
(513, 2, 226, 250, 'Main', 2, 1, 0, 0),
(514, 13, 222, 243, 'Main', 13, 1, 0, 0),
(515, 1, 227, 251, 'Main', 1, 1, 0, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `follower`
--

INSERT INTO `follower` (`id`, `contact_id`, `type`, `foreign_key`, `confirmed`, `upload`, `tenderer`, `link`, `modified`, `modified_date`) VALUES
(4, 4, 1, 200, 1, 0, 0, '0', 113, '2014-05-05 05:19:33'),
(5, 1, 1, 222, 0, 0, 0, '53a910aec79c13.42382795', 113, '2014-06-24 05:46:22'),
(6, 4, 1, 222, 0, 0, 0, '53a91117eed3f7.11433809', 113, '2014-06-24 05:48:07'),
(7, 1, 1, 226, 1, 0, 0, '0', 113, '2014-06-24 06:14:28'),
(8, 5, 1, 226, 0, 0, 0, '53a9179d1f6211.07780188', 113, '2014-06-24 06:15:57'),
(9, 4, 1, 226, 1, 0, 0, '0', 113, '2014-06-26 11:35:07');

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
  KEY `form_id` (`form_id`),
  KEY `release_id` (`release_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=131 ;

--
-- Dumping data for table `form`
--

INSERT INTO `form` (`id`, `form_id`, `number`, `name`, `project_id`, `release_id`) VALUES
(94, 1, '1', 'Create Account', 199, 186),
(95, 1, '1', 'Create Account', 199, 187),
(96, 1, '1', 'Register Form', 184, 165),
(107, 2, '2', 'Forgot Password Form', 199, 187),
(108, 4, '1', 'Create Account', 202, 190),
(109, 5, '2', 'another', 202, 190),
(111, 3, '1', 'Member Account Form', 199, 187),
(112, 4, '1', 'Member Account Form', 199, 187),
(113, 5, '1', 'Member Account Form', 199, 187),
(114, 6, '1', 'Member Account Form', 199, 187),
(115, 7, '3', 'Member Account Form', 199, 187),
(116, 8, '4', 'aoeu Form', 199, 187),
(117, 9, '5', 'aoeu Form', 199, 187),
(118, 10, '6', 'aoeu Form', 199, 187),
(119, 11, '7', 'aoeu Form', 199, 187),
(122, 1, '1', 'My First Object Form', 203, 192),
(123, 1, '1', 'My First Object Form', 203, 193),
(124, 2, '2', 'New Form', 203, 193),
(125, 3, '3', 'Form', 203, 193),
(126, 3, '3', 'Form update', 203, 193),
(127, 2, '2', 'hnhnht', 184, 165),
(128, 1, '1', 'Register Form', 184, 194),
(129, 8, '1', 'Create Account', 222, 243),
(130, 1, '1', 'oau', 226, 250);

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
  KEY `form_id` (`form_id`),
  KEY `project_id` (`project_id`),
  KEY `release_id` (`release_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=76 ;

--
-- Dumping data for table `formproperty`
--

INSERT INTO `formproperty` (`id`, `formproperty_id`, `project_id`, `release_id`, `form_id`, `number`, `name`, `description`, `type`, `valid`, `required`) VALUES
(50, 1, 199, 187, 2, 1, 'Email or Username', 'The account email or username is entered for the account requesting a forgot password reset.', 'text', 'Username must be validated with the same rules as creating username. Email must be a valid email format.  Entry is not validated against accounts at the time of submission.', 1),
(51, 2, 199, 187, 1, 1, 'First Name', 'First name of account owner', 'Text', 'must be at least one character between a-z (upper or lower case)', 1),
(52, 3, 199, 187, 1, 2, 'Last Name', 'Account owners last name', 'Text', 'At least one character between a and z (either case)', 1),
(53, 4, 199, 187, 1, 3, 'Email', 'the account holders email address.', 'text', 'valid email address', 1),
(56, 5, 199, 187, 4, 4, 'First Name', 'First name of account owner', '', '', 0),
(57, 6, 199, 187, 4, 4, 'Last Name', 'Account owners last name', '', '', 0),
(58, 7, 199, 187, 4, 4, 'Email', 'the account holders email address.', '', '', 0),
(59, 8, 199, 187, 5, 2, 'Email or Username', 'The account email or username is entered for the account requesting a forgot password reset.', '', '', 0),
(60, 9, 199, 187, 6, 1, 'Email or Username', 'The account email or username is entered for the account requesting a forgot password reset.', '', '', 0),
(61, 10, 199, 187, 7, 1, 'Email or Username', 'The account email or username is entered for the account requesting a forgot password reset.', '', '', 0),
(62, 11, 199, 187, 8, 1, 'Email or Username', 'The account email or username is entered for the account requesting a forgot password reset.', '', '', 0),
(63, 12, 199, 187, 11, 1, 'First', 'the first', '', '', 0),
(64, 13, 199, 187, 11, 2, 'second', 'the second', '', '', 0),
(65, 14, 199, 187, 11, 3, 'third', 'the third', '', '', 0),
(66, 15, 199, 187, 11, 4, 'fourth', 'fourth thing', '', '', 0),
(71, 1, 203, 192, 1, 1, 'Name', 'the object name', '', '', 0),
(72, 2, 203, 192, 1, 2, 'Description', 'The object description', '', '', 0),
(73, 1, 203, 193, 1, 1, 'Name', 'the object name', '', '', 0),
(74, 2, 203, 193, 1, 2, 'Description', 'The object description', '', '', 0),
(75, 3, 203, 193, 3, 1, 'aoeu', 'eoau', 'aoeu', 'oeau', 0);

-- --------------------------------------------------------

--
-- Table structure for table `iface`
--

CREATE TABLE IF NOT EXISTS `iface` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iface_id` int(11) NOT NULL,
  `number` int(4) NOT NULL,
  `name` varchar(255) NOT NULL,
  `text` text,
  `photo_id` int(11) NOT NULL DEFAULT '0',
  `interfacetype_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `release_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `type_id` (`interfacetype_id`),
  KEY `project_id` (`project_id`),
  KEY `iface_id` (`iface_id`),
  KEY `release_id` (`release_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=243 ;

--
-- Dumping data for table `iface`
--

INSERT INTO `iface` (`id`, `iface_id`, `number`, `name`, `text`, `photo_id`, `interfacetype_id`, `project_id`, `release_id`) VALUES
(121, 1, 1, 'Project List', NULL, 0, 1, 184, 165),
(122, 1, 1, 'Create Account', NULL, 0, 1, 199, 186),
(123, 1, 1, 'Create Account', NULL, 0, 1, 199, 187),
(132, 2, 2, 'Login screen', NULL, 0, 1, 199, 187),
(133, 3, 3, 'Forgot Password Screen', NULL, 0, 1, 199, 187),
(134, 4, 4, 'Forgot Password Thank You Screen', NULL, 0, 1, 199, 187),
(135, 5, 5, 'Reset password email', NULL, 0, 1, 199, 187),
(136, 5, 5, 'Reset password email', NULL, 0, 3, 199, 187),
(137, 5, 5, 'Reset password email', 'This is a description of the interface.', 0, 3, 199, 187),
(138, 1, 1, 'Create Account', NULL, 0, 1, 199, 187),
(139, 2, 2, 'Login screen', NULL, 0, 1, 199, 187),
(140, 3, 3, 'Forgot Password Screen', NULL, 0, 1, 199, 187),
(141, 4, 4, 'Forgot Password Thank You Screen', NULL, 0, 1, 199, 187),
(142, 1, 1, 'Create Account', NULL, 0, 1, 199, 187),
(143, 2, 2, 'Login screen', NULL, 0, 1, 199, 187),
(146, 3, 3, 'Forgot Password Screen', NULL, 0, 1, 199, 187),
(147, 6, 6, 'Something odd', 'happened', 0, 1, 199, 187),
(148, 4, 4, 'Forgot Password Thank You Screen', NULL, 1, 1, 199, 187),
(149, 7, 7, 'Test', 'Test', 0, 2, 199, 187),
(150, 8, 8, 'test', 'test', 0, 2, 199, 187),
(151, 4, 1, 'Create Account', NULL, 3, 1, 202, 190),
(152, 5, 2, 'Another', 'another', 0, 1, 202, 190),
(157, 1, 1, 'Here', 'A thing here', 0, 2, 203, 192),
(158, 1, 1, 'Here', 'A thing here', 0, 2, 203, 193),
(159, 1, 1, 'Here edit one', '', 0, 2, 203, 193),
(160, 1, 1, 'Here edit two', '', 0, 2, 203, 193),
(161, 2, 2, 'hthhh', NULL, 0, 1, 184, 165),
(162, 1, 1, 'Project List', NULL, 0, 1, 184, 194),
(163, 3, 3, 'Actor List', NULL, 0, 1, 184, 194),
(164, 1, 1, 'Here edit two', NULL, 1, 2, 203, 193),
(165, 2, 2, 'test', 'test', 0, 2, 203, 193),
(217, 1, 1, 'Test 1', 'test', 0, 1, 222, 243),
(218, 1, 1, 'Test 1', NULL, 1, 1, 222, 243),
(219, 1, 1, 'Test 1', NULL, 1, 1, 222, 244),
(220, 1, 1, 'Test 1', NULL, 1, 1, 222, 245),
(221, 1, 1, 'Test 1', NULL, 1, 1, 222, 246),
(222, 2, 2, 'iueieui', NULL, 0, 1, 222, 243),
(223, 2, 2, 'iueieui', NULL, 4, 1, 222, 243),
(224, 8, 3, 'Create Account', NULL, 7, 1, 222, 243),
(226, 1, 1, 'Test 1', NULL, 1, 1, 226, 250),
(227, 2, 2, 'aoeuoe', 'uoeuoaeu', 0, 1, 226, 250),
(228, 2, 2, 'aoeuoe', NULL, 2, 1, 226, 250),
(229, 2, 2, 'aoeuoe', NULL, 0, 1, 226, 250),
(230, 2, 2, 'aoeuoe', NULL, 3, 1, 226, 250),
(231, 3, 3, 'aoeu oa o', 'u oae uoea u', 0, 1, 226, 250),
(232, 3, 3, 'aoeu oa o', NULL, 4, 1, 226, 250),
(233, 3, 3, 'aoeu oa o', NULL, 0, 1, 226, 250),
(234, 3, 3, 'aoeu oa o', NULL, 5, 1, 226, 250),
(235, 3, 3, 'aoeu oa o', NULL, 0, 1, 226, 250),
(236, 3, 3, 'aoeu oa o', NULL, 6, 1, 226, 250),
(237, 4, 4, 'test refactor', NULL, 0, 1, 226, 250),
(238, 4, 4, 'test refactor', NULL, 5, 1, 226, 250),
(239, 5, 5, 'a oeuaoeu', '<p>aoe uaoe u</p>', 0, 2, 226, 250),
(240, 4, 4, 'My New Interface', NULL, 0, 1, 184, 194),
(241, 5, 5, 'euoeu', '<p>oeuoeuoeu</p>', 0, 1, 184, 194),
(242, 4, 4, 'test refactor', '<p>oaeu</p>', 5, 1, 226, 250);

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
  KEY `interfacetype_id` (`interfacetype_id`),
  KEY `release_id` (`release_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=664 ;

--
-- Dumping data for table `interfacetype`
--

INSERT INTO `interfacetype` (`id`, `interfacetype_id`, `number`, `name`, `project_id`, `release_id`) VALUES
(363, 1, '1', 'Not Classified', 184, 165),
(364, 2, '2', 'Web interface', 184, 165),
(365, 3, '3', 'Email', 184, 165),
(408, 1, '1', 'Not Classified', 193, 177),
(409, 2, '2', 'Web interface', 193, 177),
(410, 3, '3', 'Email', 193, 177),
(441, 1, '1', 'Not Classified', 199, 186),
(442, 2, '2', 'Web interface', 199, 186),
(443, 3, '3', 'Email', 199, 186),
(444, 1, '1', 'Not Classified', 199, 187),
(445, 2, '2', 'Web interface', 199, 187),
(446, 3, '3', 'Email', 199, 187),
(453, 1, '1', 'Not Classified', 201, 189),
(454, 2, '2', 'Web interface', 201, 189),
(455, 3, '3', 'Email', 201, 189),
(456, 1, '1', 'Not Classified', 202, 190),
(457, 2, '2', 'Web interface', 202, 190),
(458, 3, '3', 'Email', 202, 190),
(459, 4, '4', 'Not Classified', 202, 190),
(460, 5, '5', 'Web interface', 202, 190),
(461, 6, '6', 'Email', 202, 190),
(468, 1, '1', 'Not Classified', 203, 192),
(469, 2, '2', 'Web interface', 203, 192),
(470, 3, '3', 'Email', 203, 192),
(471, 1, '1', 'Not Classified', 203, 193),
(472, 2, '2', 'Web interface', 203, 193),
(473, 3, '3', 'Email', 203, 193),
(474, 1, '1', 'Not Classified', 184, 194),
(475, 2, '2', 'Web interface', 184, 194),
(476, 3, '3', 'Email', 184, 194),
(637, 1, '1', 'Not Classified', 222, 243),
(638, 2, '2', 'Web interface', 222, 243),
(639, 3, '3', 'Email', 222, 243),
(640, 1, '1', 'Not Classified', 222, 244),
(641, 2, '2', 'Web interface', 222, 244),
(642, 3, '3', 'Email', 222, 244),
(643, 1, '1', 'Not Classified', 222, 245),
(644, 2, '2', 'Web interface', 222, 245),
(645, 3, '3', 'Email', 222, 245),
(646, 1, '1', 'Not Classified', 222, 246),
(647, 2, '2', 'Web interface', 222, 246),
(648, 3, '3', 'Email', 222, 246),
(649, 8, '4', 'Not Classified', 222, 243),
(650, 9, '5', 'Web interface', 222, 243),
(651, 10, '6', 'Email', 222, 243),
(658, 1, '1', 'Not Classified', 226, 250),
(659, 2, '2', 'Web interface', 226, 250),
(660, 3, '3', 'Email', 226, 250),
(661, 1, '1', 'Not Classified', 227, 251),
(662, 2, '2', 'Web interface', 227, 251),
(663, 3, '3', 'Email', 227, 251);

-- --------------------------------------------------------

--
-- Table structure for table `library`
--

CREATE TABLE IF NOT EXISTS `library` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `public` tinyint(1) NOT NULL DEFAULT '0',
  `release_id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `owner_id` (`owner_id`),
  KEY `release_id` (`release_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `library`
--

INSERT INTO `library` (`id`, `name`, `description`, `public`, `release_id`, `owner_id`) VALUES
(9, 'Module for import', 'A test module for import into an existing project.  Could by used to make a new project if you wanted.', 0, 177, 507),
(10, 'Membership Module', 'A Complete set of use cases for creating, managing and accessing a web member account.', 1, 186, 507),
(11, 'image copy test', 'copy test', 0, 246, 505);

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
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `scope` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `exclude` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `condition` text COLLATE utf8_unicode_ci,
  `show_once` tinyint(1) NOT NULL,
  `type` tinyint(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `message`, `scope`, `exclude`, `condition`, `show_once`, `type`) VALUES
(1, 'Please complete your profile', '*/*', '', '', 0, 0),
(2, 'new message goes in here', 'usecase/view', '', '', 1, 1),
(3, 'A message here.', 'contact/mycontacts', '', NULL, 1, 1),
(4, 'Test message multi show.', 'rule/view', '', '', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `note`
--

CREATE TABLE IF NOT EXISTS `note` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `meta_type` varchar(30) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `object` int(11) NOT NULL,
  `instance` int(11) NOT NULL,
  `release_id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `release_id` (`release_id`),
  KEY `owner_id` (`owner_id`),
  KEY `object` (`object`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `note`
--

INSERT INTO `note` (`id`, `meta_type`, `subject`, `text`, `object`, `instance`, `release_id`, `owner_id`, `create_date`) VALUES
(6, 'analyst', 'A new note', '<p>This is a new note</p>', 1, 1, 250, 113, '2014-06-18 01:17:17'),
(7, 'analyst', 'aoeu', '<p>oaeu</p>', 0, 0, 250, 113, '2014-06-18 07:09:59'),
(8, 'analyst', 'eou', '<p>eou</p>', 12, 1, 250, 113, '2014-06-18 11:52:59'),
(9, 'analyst', 'Test', '<p>test</p>', 6, 1, 250, 113, '2014-06-25 13:40:30'),
(10, 'analyst', 'oaeu', '<p>oaeuaoeuoaeu</p>', 11, 0, 250, 113, '2014-06-25 13:47:16'),
(11, 'analyst', 'oaeu', '<p>oeau</p>', 11, 0, 250, 113, '2014-06-25 13:56:06'),
(12, 'analyst', 'oaeu', '<p>oeau</p>', 11, 0, 250, 113, '2014-06-25 13:59:11'),
(13, 'analyst', 'oaeu', '<p>oeau</p>', 11, 0, 250, 113, '2014-06-25 13:59:31'),
(14, 'analyst', 'eo uoeu ', '<p>&nbsp;oeuoeu o uoeu oeu&nbsp;</p>', 17, 1, 250, 113, '2014-06-25 14:02:47'),
(15, 'analyst', 'uid', '<p>idu</p>', 17, 1, 250, 113, '2014-06-25 14:09:51'),
(16, 'analyst', 'oaeuoue', '<p>oeuoeuoeuaoeu</p>', 17, 1, 243, 113, '2014-06-25 14:13:30'),
(17, 'analyst', 'aoeuaoeu', '<p>aoeuaoe uaeo uoea uoae u</p>', 5, 1, 243, 113, '2014-06-25 14:16:48'),
(18, 'analyst', 'udieidu', '<p>uidueiduid</p>', 4, 8, 243, 113, '2014-06-25 14:26:01');

-- --------------------------------------------------------

--
-- Table structure for table `object`
--

CREATE TABLE IF NOT EXISTS `object` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `object_id` int(11) NOT NULL,
  `number` int(6) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `project_id` int(11) NOT NULL,
  `release_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `project_id` (`project_id`),
  KEY `object_id` (`object_id`),
  KEY `release_id` (`release_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=63 ;

--
-- Dumping data for table `object`
--

INSERT INTO `object` (`id`, `object_id`, `number`, `name`, `description`, `project_id`, `release_id`) VALUES
(19, 1, 1, 'Import test', 'e', 193, 177),
(21, 1, 1, 'Import test', 'e', 193, 177),
(22, 1, 1, 'Import test', 'e', 193, 177),
(26, 1, 1, 'Object', 'A model of a business object', 184, 165),
(27, 2, 2, 'Object Property', 'A property of a Business Object.', 184, 165),
(28, 3, 3, 'Rule', 'A business rule that can be applied to a usecase.', 184, 165),
(29, 4, 4, 'Actor', 'An actor who acts within use cases. May be a person or an external system.', 184, 165),
(30, 5, 5, 'Interface', 'An interface of the system defined with either text or an image.', 184, 165),
(31, 6, 6, 'Form', 'An input form with a number of fields and their associated validations and definitions', 184, 165),
(35, 1, 1, 'Member Account', 'A member account', 199, 187),
(36, 1, 1, 'oaeu', 'aoeu', 202, 190),
(37, 1, 1, 'Order', 'aoeu make a new version of this', 202, 190),
(38, 1, 2, 'Order', 'aoeu make a new version of this and another', 202, 190),
(39, 2, 3, 'Another', 'two of everything at least', 202, 190),
(40, 3, 1, 'Three', 'Three', 202, 190),
(41, 4, 4, 'Four', 'of', 202, 190),
(42, 5, 6, 'four', 'ou', 202, 190),
(43, 6, 5, 'ouath', 'oeuaoeu', 202, 190),
(44, 2, 2, 'aoeu', 'aoeu', 193, 178),
(45, 3, 3, 'iaeka', 'jeao', 193, 178),
(46, 2, 2, 'aoeu', 'oeau', 199, 187),
(47, 3, 3, 'Areallylongname', 'aoeu', 199, 187),
(49, 1, 1, 'My First Object', 'An object', 203, 192),
(50, 1, 1, 'My First Object', 'An object', 203, 193),
(51, 1, 1, 'Object', 'A model of a business object', 184, 194),
(52, 2, 2, 'Object Property', 'A property of a Business Object.', 184, 194),
(53, 3, 3, 'Rule', 'A business rule that can be applied to a usecase.', 184, 194),
(54, 4, 4, 'Actor', 'An actor who acts within use cases. May be a person or an external system.', 184, 194),
(55, 5, 5, 'Interface', 'An interface of the system defined with either text or an image.', 184, 194),
(56, 6, 6, 'Form', 'An input form with a number of fields and their associated validations and definitions', 184, 194),
(57, 7, 7, 'oaeu', '<p>aoeu</p>', 184, 194),
(58, 8, 8, 'ediu', '<p>idu</p>', 184, 194),
(59, 9, 9, 'uidh', '<p>iudh</p>', 184, 194),
(60, 10, 10, 'dbuibudib', '<p>duibdib</p>', 184, 194),
(61, 11, 10, 'idchidht', '<p>idhm</p>', 184, 194),
(62, 1, 1, 'aoeu', '<p>oaeu</p>', 226, 250);

-- --------------------------------------------------------

--
-- Table structure for table `objectproperty`
--

CREATE TABLE IF NOT EXISTS `objectproperty` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `objectproperty_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `release_id` int(11) NOT NULL,
  `number` int(6) NOT NULL,
  `object_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `object_id` (`object_id`),
  KEY `objectproperty_id` (`objectproperty_id`),
  KEY `release_id` (`release_id`),
  KEY `project_id` (`project_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=58 ;

--
-- Dumping data for table `objectproperty`
--

INSERT INTO `objectproperty` (`id`, `objectproperty_id`, `project_id`, `release_id`, `number`, `object_id`, `name`, `description`) VALUES
(16, 1, 184, 165, 1, 1, 'Name', 'Name of the Object Property'),
(17, 2, 184, 165, 2, 1, 'Description', 'Description of the Object Property'),
(18, 3, 184, 165, 1, 3, 'Name', 'Name of the Business Rule'),
(19, 4, 184, 165, 2, 3, 'Rule Text', 'The definition of the business rule in a text form.'),
(34, 1, 199, 187, 1, 1, 'Username', 'A string used to identify a user, each username is unique.'),
(35, 2, 199, 187, 2, 1, 'First Name', 'The user''s first name.'),
(36, 3, 199, 187, 3, 1, 'Last Name', 'The user''s last name.'),
(37, 4, 199, 187, 4, 1, 'email address', 'The user''s email address.'),
(38, 1, 202, 190, 1, 1, 'Property one', 'the first'),
(39, 2, 202, 190, 2, 1, 'Property two ', 'the second'),
(40, 2, 202, 190, 2, 1, 'Property two ', 'the second updated'),
(41, 1, 193, 178, 1, 2, 'aoeu', 'aoeu'),
(42, 5, 199, 187, 1, 2, 'First', 'the first'),
(43, 6, 199, 187, 2, 2, 'second', 'the second'),
(44, 7, 199, 187, 3, 2, 'third', 'the third'),
(45, 8, 199, 187, 4, 2, 'fourth', 'fourth thing'),
(48, 1, 203, 192, 1, 1, 'Name', 'the object name'),
(49, 2, 203, 192, 2, 1, 'Description', 'The object description'),
(50, 1, 203, 193, 1, 1, 'Name', 'the object name'),
(51, 2, 203, 193, 2, 1, 'Description', 'The object description'),
(52, 1, 184, 165, 1, 1, 'Name', 'Name of the Object Property'),
(53, 2, 184, 194, 2, 1, 'Description', 'Description of the Object Property'),
(54, 3, 184, 194, 1, 3, 'Name', 'Name of the Business Rule'),
(55, 4, 184, 194, 2, 3, 'Rule Text', 'The definition of the business rule in a text form.'),
(56, 1, 184, 194, 1, 1, 'Name', 'Name of the Object Property'),
(57, 1, 226, 250, 1, 1, 'aoeu', 'oeu');

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
  KEY `package_id` (`package_id`),
  KEY `release_id` (`release_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1013 ;

--
-- Dumping data for table `package`
--

INSERT INTO `package` (`id`, `package_id`, `name`, `stage`, `number`, `project_id`, `release_id`, `budget`, `contract_amount`, `extlink`) VALUES
(884, 1, 'Membership', 1, 1, 184, 165, '0.00', '0.00', NULL),
(885, 2, 'Requirements', 1, 2, 184, 165, '0.00', '0.00', NULL),
(886, 3, 'Library', 1, 3, 184, 165, '0.00', '0.00', NULL),
(887, 4, 'Testing', 1, 4, 184, 165, '0.00', '0.00', NULL),
(903, 1, 'System', 1, 1, 193, 177, '0.00', '0.00', NULL),
(909, 1, 'System', 1, 1, 193, 177, '0.00', '0.00', NULL),
(910, 1, 'System', 1, 1, 193, 177, '0.00', '0.00', NULL),
(915, 1, 'System', 1, 1, 199, 186, '0.00', '0.00', NULL),
(916, 2, 'Membership', 1, 1, 199, 186, '0.00', '0.00', NULL),
(917, 2, 'Membership', 1, 1, 199, 187, '0.00', '0.00', NULL),
(933, 1, 'System', 1, 1, 201, 189, '0.00', '0.00', NULL),
(934, 1, 'System', 1, 1, 202, 190, '0.00', '0.00', NULL),
(935, 5, 'Membership', 1, 2, 202, 190, '0.00', '0.00', NULL),
(936, 6, 'Numbers', 1, 3, 202, 190, '0.00', '0.00', NULL),
(937, 2, 'Stuff', 1, 2, 193, 178, '0.00', '0.00', NULL),
(941, 1, 'System', 1, 1, 203, 192, '0.00', '0.00', NULL),
(942, 1, 'System', 1, 1, 203, 193, '0.00', '0.00', NULL),
(943, 2, 'Package Two', 1, 2, 203, 193, '0.00', '0.00', NULL),
(944, 3, 'Three', 1, 3, 203, 193, '0.00', '0.00', NULL),
(945, 1, 'Membership', 1, 1, 184, 194, '0.00', '0.00', NULL),
(946, 2, 'Requirements', 1, 2, 184, 194, '0.00', '0.00', NULL),
(947, 3, 'Library', 1, 3, 184, 194, '0.00', '0.00', NULL),
(948, 4, 'Testing', 1, 4, 184, 194, '0.00', '0.00', NULL),
(1003, 1, 'System', 1, 1, 222, 243, '0.00', '0.00', NULL),
(1004, 1, 'System', 1, 1, 222, 244, '0.00', '0.00', NULL),
(1005, 1, 'System', 1, 1, 222, 245, '0.00', '0.00', NULL),
(1006, 1, 'System', 1, 1, 222, 246, '0.00', '0.00', NULL),
(1007, 9, 'Membership', 1, 2, 222, 243, '0.00', '0.00', NULL),
(1010, 1, 'System', 1, 1, 226, 250, '0.00', '0.00', NULL),
(1011, 5, 'aoeu', 1, 5, 184, 194, '0.00', '0.00', NULL),
(1012, 1, 'System', 1, 1, 227, 251, '0.00', '0.00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `photo`
--

CREATE TABLE IF NOT EXISTS `photo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `photo_id` int(11) NOT NULL,
  `file` varchar(60) NOT NULL,
  `description` text,
  `project_id` int(11) NOT NULL,
  `release_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `project_id` (`project_id`),
  KEY `user_id` (`user_id`),
  KEY `release_id` (`release_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=63 ;

--
-- Dumping data for table `photo`
--

INSERT INTO `photo` (`id`, `photo_id`, `file`, `description`, `project_id`, `release_id`, `user_id`, `create_date`) VALUES
(22, 1, '5366d29252d6e.png', 'Uploaded file with filename freeway_tunnel.png', 199, 187, 114, '2014-05-04 23:51:47'),
(23, 1, '5391101b7a582.jpg', 'Uploaded file with filename login_popup.jpg', 203, 193, 113, '2014-06-06 00:49:31'),
(47, 1, 'xxxxxxxx53998d6c1b6b0.jpg', 'Test 1 checkee', 222, 243, 113, '2014-06-12 11:22:20'),
(48, 2, 'xxxxxxxx53998d6e54e08.jpg', 'Uploaded file with filename login_popup.jpg', 222, 243, 113, '2014-06-12 11:22:22'),
(49, 3, 'xxxxxxxx53998d70cc532.jpg', 'Uploaded file with filename register_form.jpg', 222, 243, 113, '2014-06-12 11:22:25'),
(50, 1, '0000024453998d6c1b6b0.jpg', 'Test 1', 222, 244, 113, '2014-06-12 11:22:20'),
(51, 2, '0000024453998d6e54e08.jpg', 'Uploaded file with filename login_popup.jpg', 222, 244, 113, '2014-06-12 11:22:22'),
(52, 3, '0000024453998d70cc532.jpg', 'Uploaded file with filename register_form.jpg', 222, 244, 113, '2014-06-12 11:22:25'),
(53, 1, '0000024553998d6c1b6b0.jpg', 'Test 1', 222, 245, 113, '2014-06-12 11:22:20'),
(54, 1, '0000024653998d6c1b6b0.jpg', 'Test 1 checkee', 222, 246, 113, '2014-06-12 11:22:20'),
(55, 4, 'image_upload.jpg', 'Uploaded file with filename image_upload.jpg', 222, 243, 113, '2014-06-12 14:02:24'),
(57, 1, '0000025053998d6c1b6b0.jpg', 'Test 1 checkee', 226, 250, 113, '2014-06-12 11:22:20'),
(58, 2, 'Membership main Trial Expired.jpg', 'Uploaded file with filename Membership main Trial Expired.jpg', 226, 250, 113, '2014-06-16 03:26:15'),
(59, 3, 'xxxxxxxx539e6416b8d11.jpg', 'Uploaded file with filename Membership main Trial Expired.jpg', 226, 250, 113, '2014-06-16 03:27:19'),
(60, 4, 'ingram.jpg', 'Uploaded file with filename ingram.jpg', 226, 250, 113, '2014-06-16 03:28:34'),
(61, 5, 'Clipboard01.jpg', 'Uploaded file with filename Clipboard01.jpg', 226, 250, 113, '2014-06-16 03:29:06'),
(62, 6, 'xxxxxxxx539e684e23aad.jpg', 'Uploaded file with filename whale_shark.jpg', 226, 250, 113, '2014-06-16 03:45:18');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=228 ;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`id`, `name`, `description`, `company_id`, `budget`, `stage`, `extlink`) VALUES
(184, 'Reqrap', 'A cloud system for rapidly developing web application requirements.', 505, '0.00', 1, '3fb2cbb25041c763f8a81f07914dd981'),
(193, 'Module', 'import', 507, '0.00', 1, '8492734542034b33a87db95d2fa8c10f'),
(199, 'Membership Module', 'A web member module for inclusion in other projects', 507, '0.00', 1, '5d5ae9f427f2315403eaffae87c22658'),
(201, 'aoeu', 'aoeu', 512, '0.00', 1, '2ba2ac9a53d0960d3df3df188725f5f5'),
(202, 'Test', 'Test', 513, '0.00', 1, '2d28de7f84b042ddeb3548ecc60b5544'),
(203, 'Test Project', 'This is a test', 505, '0.00', 1, '64b6b2f13a28c0010bf5d725e1e24ce2'),
(222, 'Images', 'Images', 505, '0.00', 1, '2911e9dc0fed24513288d4b79fc2aa62'),
(226, 'Copy of Images', 'Copied from Images.', 505, '0.00', 1, '9a11679d1e19453f5b01f276f4a102ce'),
(227, 'Test', 'test iueiu eu u', 515, '0.00', 1, '763b166466ab81c5f9b018f0ebb19f19');

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
  `number` decimal(8,4) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `project_id` int(11) NOT NULL,
  `offset` int(6) NOT NULL DEFAULT '0',
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_user` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `create_user` (`create_user`),
  KEY `project_id` (`project_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=252 ;

--
-- Dumping data for table `release`
--

INSERT INTO `release` (`id`, `number`, `status`, `project_id`, `offset`, `create_date`, `create_user`) VALUES
(165, '1.0000', 2, 184, 0, '2014-05-21 08:17:44', 113),
(177, '1.0000', 2, 193, 0, '2014-04-28 03:38:33', 114),
(178, '1.0007', 1, 193, 0, '2014-05-17 02:59:12', 114),
(186, '1.0000', 2, 199, 0, '2014-04-28 07:35:54', 114),
(187, '1.0099', 1, 199, 0, '2014-05-16 12:19:08', 114),
(189, '0.0004', 1, 201, 0, '2014-05-05 05:31:22', 118),
(190, '0.0059', 1, 202, 0, '2014-05-07 05:06:32', 120),
(192, '1.0000', 2, 203, 0, '2014-05-18 04:19:39', 113),
(193, '1.0023', 1, 203, 0, '2014-06-06 04:38:11', 113),
(194, '1.0014', 1, 184, 0, '2014-06-24 02:34:32', 113),
(243, '3.0029', 1, 222, 17, '2014-06-25 14:13:14', 113),
(244, '1.0000', 2, 222, 9, '2014-06-12 11:24:27', 113),
(245, '2.0000', 2, 222, 11, '2014-06-12 11:25:44', 113),
(246, '3.0000', 2, 222, 17, '2014-06-12 12:03:36', 113),
(250, '0.0061', 1, 226, 0, '2014-06-25 13:28:09', 113),
(251, '0.0007', 1, 227, 0, '2014-06-26 04:58:47', 140);

-- --------------------------------------------------------

--
-- Table structure for table `rule`
--

CREATE TABLE IF NOT EXISTS `rule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rule_id` int(11) NOT NULL,
  `number` smallint(4) NOT NULL,
  `name` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `project_id` int(11) NOT NULL,
  `release_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `project_id` (`project_id`),
  KEY `rule_id` (`rule_id`),
  KEY `release_id` (`release_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=141 ;

--
-- Dumping data for table `rule`
--

INSERT INTO `rule` (`id`, `rule_id`, `number`, `name`, `text`, `project_id`, `release_id`) VALUES
(101, 1, 1, 'Version control', 'All requirements are version controlled. When a requirement is updated, an updated copy of the requirement is saved and set to be ''active'', and the previous version is set to ''inactive''.', 184, 165),
(102, 2, 2, 'Test delete rule', 'This is a sacrificial rule', 184, 165),
(103, 3, 3, 'Number of log on attempts', 'stub', 184, 165),
(109, 1, 1, 'No confirmation message on forgot password thank you.', 'stub', 199, 187),
(110, 1, 1, 'No confirmation message on forgot password thank you.', 'No confirmation message that the email account/user account requested in the password confirmation is correct or not correct is displayed.  The same message is displayed whether or not the details entered are correct.', 199, 187),
(111, 2, 2, 'Password Complexity', 'Passwords must be at least 8 characters with at least one of each of: lower case alphabetic character, upper case alphabetic character and a special character or number.', 199, 187),
(112, 1, 1, 'one', 'one', 202, 190),
(113, 2, 2, 'two', 'two', 202, 190),
(120, 1, 1, 'My First Rule', 'A Business Rule goes here', 203, 192),
(121, 1, 1, 'My First Rule', 'A Business Rule goes here', 203, 193),
(122, 2, 2, 'New Rule', 'stub', 203, 193),
(123, 3, 3, 'Test', 'stub', 203, 193),
(124, 3, 3, 'Test', 'stub aeuaeo ueo uaoe u', 203, 193),
(125, 3, 3, 'Test updated.', 'stub aeuaeo ueo uaoe u', 203, 193),
(126, 4, 4, 'aoeu', 'stub', 184, 165),
(127, 5, 5, ' eo uaoe uoea u', 'stub', 184, 165),
(128, 6, 6, 'hdtnhtdn', 'stub', 184, 165),
(129, 7, 7, 'aoeuaoeu', 'stub', 184, 165),
(130, 8, 8, 'aoeuoeau', 'stub', 184, 165),
(131, 9, 9, 'diuuid', 'stub', 184, 165),
(132, 10, 10, 'hhhnn', 'stub', 184, 165),
(133, 1, 1, 'Version control', 'All requirements are version controlled. When a requirement is updated, an updated copy of the requirement is saved and set to be ''active'', and the previous version is set to ''inactive''.', 184, 165),
(134, 3, 3, 'Number of log on attempts', 'There can only be 3 log on attempts before the account is locked out.', 184, 165),
(135, 1, 1, 'Version control', 'All requirements are version controlled. When a requirement is updated, an updated copy of the requirement is saved and set to be ''active'', and the previous version is set to ''inactive''.', 184, 194),
(136, 3, 3, 'Number of log on attempts', 'There can only be 3 log on attempts before the account is locked out.', 184, 194),
(137, 1, 1, 'oaeu', '<p>oeu</p>', 226, 250),
(138, 2, 2, 'iue', '<p>aoe uaoeuoaeu</p>', 226, 250),
(139, 1, 1, 'oueou', '<p>jeojoej</p>', 222, 243),
(140, 1, 1, 'oaeu', '<p>Not sure why the p''s are showing up.</p>\r\n', 226, 250);

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
  KEY `category_id` (`category_id`),
  KEY `project_id` (`project_id`),
  KEY `release_id` (`release_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=43 ;

--
-- Dumping data for table `simple`
--

INSERT INTO `simple` (`id`, `simple_id`, `project_id`, `release_id`, `number`, `category_id`, `name`, `description`) VALUES
(33, 1, 202, 190, '2', 1, 'Background', 'This is the background for the project.'),
(34, 2, 202, 190, '1', 1, 'Introduction', 'The number is wrong and so totally meaningless.'),
(35, 3, 202, 190, '2', 1, 'The number is correct.', 'But what happens if we delete an item and then add another.'),
(36, 4, 202, 190, '2', 1, 'ok number is not correct', 'whats up'),
(37, 5, 202, 190, '2', 1, 'they will be correct', 'again'),
(38, 6, 202, 190, '2', 1, 'aoeu', 'aeuo'),
(39, 2, 202, 190, '1', 1, 'Introduction', 'The number is wrong and so totally meaningless. Its a new version.'),
(40, 2, 202, 190, '1', 1, 'Introduction ha', 'The number is wrong and so totally meaningless. Its a new version.'),
(41, 7, 202, 190, '1', 1, 'aeuo', 'aeu'),
(42, 8, 202, 190, '3', 1, 'A third one just for fun', 'This is the the third one');

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
  KEY `actor_id` (`actor_id`),
  KEY `project_id` (`project_id`),
  KEY `release_id` (`release_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=820 ;

--
-- Dumping data for table `step`
--

INSERT INTO `step` (`id`, `step_id`, `project_id`, `release_id`, `flow_id`, `number`, `actor_id`, `text`, `result`) VALUES
(509, 1, 184, 165, 1, 1, 2, 'Actor action.', 'System result.'),
(510, 2, 184, 165, 2, 1, 1, 'Actor action.', 'System result.'),
(511, 3, 184, 165, 3, 1, 1, 'Actor action.', 'System result.'),
(512, 4, 184, 165, 4, 1, 1, 'Actor action.', 'System result.'),
(513, 5, 184, 165, 5, 1, 1, 'Actor action.', 'System result.'),
(514, 6, 184, 165, 6, 1, 1, 'Actor action.', 'System result.'),
(515, 5, 184, 165, 5, 1, 1, 'Actor views project list.', 'System displays project list'),
(528, 1, 193, 177, 1, 1, 1, 'Actor action.', 'System result.'),
(533, 1, 199, 186, 1, 1, 1, 'Actor action.', 'System result.'),
(534, 2, 199, 186, 2, 1, 2, 'Actor action.', 'System result.'),
(535, 3, 199, 186, 3, 1, 2, 'Actor action.', 'System result.'),
(536, 4, 199, 186, 4, 1, 1, 'Actor action.', 'System result.'),
(537, 5, 199, 186, 5, 1, 2, 'Actor action.', 'System result.'),
(538, 1, 199, 186, 1, 1, 1, 'Actor clicks on ''Join'' button.', 'System displays Create Account page.'),
(539, 6, 199, 186, 1, 3, 1, 'New step', 'Result'),
(540, 6, 199, 186, 1, 3, 1, 'Actor completes the Create Account Form and submits.', 'System validates form and displays the home page with the logged in status bar.'),
(541, 1, 199, 187, 1, 1, 1, 'Actor clicks on ''Join'' button.', 'System displays Create Account page.'),
(542, 6, 199, 187, 1, 3, 1, 'Actor completes the Create Account Form and submits.', 'System validates form and displays the home page with the logged in status bar.'),
(543, 2, 199, 187, 2, 1, 2, 'Actor action.', 'System result.'),
(544, 3, 199, 187, 3, 1, 2, 'Actor action.', 'System result.'),
(545, 4, 199, 187, 4, 1, 1, 'Actor action.', 'System result.'),
(546, 5, 199, 187, 5, 1, 2, 'Actor action.', 'System result.'),
(547, 7, 184, 165, 7, 1, 1, 'Actor action.', 'System result.'),
(548, 8, 184, 165, 8, 1, 1, 'Actor action.', 'System result.'),
(591, 7, 199, 187, 6, 1, 1, 'Actor action.', 'System result.'),
(592, 8, 199, 187, 7, 1, 1, 'Actor action.', 'System result.'),
(593, 9, 199, 187, 8, 1, 1, 'Actor action.', 'System result.'),
(594, 7, 199, 187, 6, 1, 1, 'Actor selects the Forgot Password link on the login screen.', 'System displays the Forgot Password form.'),
(595, 10, 199, 187, 6, 2, 1, 'New step', 'Result'),
(596, 10, 199, 187, 6, 2, 1, 'Actor completes the Forgot Password Form and submits', 'System displays the Forgot Password Thankyou screen'),
(597, 10, 199, 187, 6, 2, 1, 'Actor completes the Forgot Password Form and submits', 'System displays the Forgot Password Thank You screen'),
(598, 10, 199, 187, 6, 2, 1, 'Actor completes the Forgot Password Form and submits', 'System sends the reset password email and displays the Forgot Password Thank You screen'),
(599, 4, 202, 190, 4, 1, 4, 'Actor clicks on ''Join'' button.', 'System displays Create Account page.'),
(600, 9, 202, 190, 4, 2, 4, 'Actor completes the Create Account Form and submits.', 'System validates form and displays the home page with the logged in status bar.'),
(601, 5, 202, 190, 5, 1, 5, 'Actor action.', 'System result.'),
(602, 6, 202, 190, 6, 1, 5, 'Actor action.', 'System result.'),
(603, 7, 202, 190, 7, 1, 4, 'Actor action.', 'System result.'),
(604, 8, 202, 190, 8, 1, 5, 'Actor action.', 'System result.'),
(605, 10, 202, 190, 9, 1, 4, 'Actor action.', 'System result.'),
(606, 11, 202, 190, 10, 1, 4, 'Actor action.', 'System result.'),
(607, 12, 202, 190, 11, 1, 4, 'Actor action.', 'System result.'),
(608, 13, 202, 190, 12, 1, 4, 'Actor action.', 'System result.'),
(609, 14, 202, 190, 13, 1, 4, 'Actor action.', 'System result.'),
(610, 2, 193, 178, 2, 1, 2, 'Actor action.', 'System result.'),
(694, 1, 203, 192, 1, 1, 1, 'Actor action.', 'System result.'),
(695, 2, 203, 192, 2, 1, 1, 'Actor action.', 'System result.'),
(696, 3, 203, 192, 3, 1, 1, 'Actor action.', 'System result.'),
(697, 2, 203, 192, 2, 1, 1, 'Actor does this first thing.', 'System responds as predicted.'),
(698, 4, 203, 192, 2, 2, 1, 'New step', 'Result'),
(699, 4, 203, 192, 2, 2, 1, 'Then a second thing is done.', 'And another result is produced.'),
(700, 5, 203, 192, 2, 3, 1, 'New step', 'Result'),
(701, 5, 203, 192, 2, 3, 1, 'Finally, we are getting sick of the whole thin.', 'But there is a result'),
(702, 6, 203, 192, 4, 1, 1, 'New step.', 'Result'),
(703, 6, 203, 192, 4, 1, 1, 'An alternative path is possible, forking here', 'and then moving on here'),
(704, 7, 203, 192, 4, 2, 1, 'New step', 'Result'),
(705, 7, 203, 192, 4, 2, 1, 'Finally this happens', 'and then we re-join'),
(706, 1, 203, 193, 1, 1, 1, 'Actor action.', 'System result.'),
(707, 2, 203, 193, 2, 1, 1, 'Actor does this first thing.', 'System responds as predicted.'),
(708, 4, 203, 193, 2, 2, 1, 'Then a second thing is done.', 'And another result is produced.'),
(709, 5, 203, 193, 2, 3, 1, 'Finally, we are getting sick of the whole thin.', 'But there is a result'),
(710, 3, 203, 193, 3, 1, 1, 'Actor action.', 'System result.'),
(711, 6, 203, 193, 4, 1, 1, 'An alternative path is possible, forking here', 'and then moving on here'),
(712, 7, 203, 193, 4, 2, 1, 'Finally this happens', 'and then we re-join'),
(713, 8, 203, 193, 5, 1, 1, 'Actor action.', 'System result.'),
(714, 1, 184, 194, 1, 1, 2, 'Actor action.', 'System result.'),
(715, 2, 184, 194, 2, 1, 1, 'Actor action.', 'System result.'),
(716, 3, 184, 194, 3, 1, 1, 'Actor action.', 'System result.'),
(717, 4, 184, 194, 4, 1, 1, 'Actor action.', 'System result.'),
(718, 5, 184, 194, 5, 1, 1, 'Actor views project list.', 'System displays project list'),
(719, 6, 184, 194, 6, 1, 1, 'Actor action.', 'System result.'),
(720, 7, 184, 194, 7, 1, 1, 'Actor action.', 'System result.'),
(721, 8, 184, 194, 8, 1, 1, 'Actor action.', 'System result.'),
(722, 8, 184, 194, 8, 1, 1, 'Actor action.', 'System result.'),
(793, 1, 222, 243, 1, 1, 1, 'Actor action.', 'System result.'),
(794, 2, 222, 243, 2, 1, 1, 'Actor action.', 'System result.'),
(795, 1, 222, 246, 1, 1, 1, 'Actor action.', 'System result.'),
(796, 2, 222, 246, 2, 1, 1, 'Actor action.', 'System result.'),
(797, 3, 222, 243, 1, 2, 1, 'New step', 'Result'),
(798, 3, 222, 243, 1, 2, 1, 'New step', 'Result'),
(799, 4, 222, 243, 1, 3, 1, 'New step', 'Result'),
(800, 4, 222, 243, 1, 3, 1, 'New step', 'Result'),
(801, 5, 222, 243, 1, 4, 1, 'New step', 'Result'),
(802, 5, 222, 243, 1, 4, 1, 'New step', 'Result'),
(803, 6, 222, 243, 1, 5, 1, 'New step', 'Result'),
(804, 6, 222, 243, 1, 5, 1, 'New step', 'Result'),
(805, 7, 222, 243, 3, 1, 1, 'Actor action.', 'System result.'),
(806, 9, 222, 243, 9, 1, 9, 'Actor action.', 'System result.'),
(807, 10, 222, 243, 10, 1, 9, 'Actor action.', 'System result.'),
(808, 11, 222, 243, 11, 1, 8, 'Actor action.', 'System result.'),
(809, 12, 222, 243, 12, 1, 9, 'Actor action.', 'System result.'),
(810, 8, 222, 243, 8, 1, 8, 'Actor clicks on ''Join'' button.', 'System displays Create Account page.'),
(811, 13, 222, 243, 8, 3, 8, 'Actor completes the Create Account Form and submits.', 'System validates form and displays the home page with the logged in status bar.'),
(814, 1, 226, 250, 1, 1, 1, 'Actor action.', 'System result.'),
(815, 2, 226, 250, 2, 1, 1, 'Actor action.', 'System result.'),
(816, 14, 222, 243, 13, 1, 1, 'Actor action.', 'System result.'),
(817, 3, 226, 250, 1, 2, 1, 'Actor ...', 'System ...'),
(818, 4, 226, 250, 1, 3, 1, 'Actor ...', 'System ...'),
(819, 1, 227, 251, 1, 1, 1, 'Actor action.', 'System result.');

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
  KEY `step_id` (`step_id`),
  KEY `project_id` (`project_id`),
  KEY `release_id` (`release_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=94 ;

--
-- Dumping data for table `stepform`
--

INSERT INTO `stepform` (`id`, `stepform_id`, `project_id`, `release_id`, `step_id`, `form_id`) VALUES
(59, 1, 199, 186, 1, 1),
(60, 2, 199, 186, 6, 1),
(61, 1, 199, 187, 1, 1),
(62, 2, 199, 187, 6, 1),
(76, 3, 199, 187, 10, 2),
(77, 4, 202, 190, 4, 4),
(78, 5, 202, 190, 9, 4),
(83, 1, 203, 192, 2, 1),
(84, 1, 203, 193, 2, 1),
(85, 2, 203, 193, 8, 2),
(86, 3, 203, 193, 8, 3),
(87, 1, 184, 165, 1, 2),
(88, 8, 222, 243, 8, 8),
(89, 9, 222, 243, 13, 8),
(90, 1, 226, 250, 2, 1),
(91, 2, 226, 250, 2, 1),
(92, 3, 226, 250, 1, 1),
(93, 4, 226, 250, 4, 1);

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
  KEY `step_id` (`step_id`),
  KEY `project_id` (`project_id`),
  KEY `release_id` (`release_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=134 ;

--
-- Dumping data for table `stepiface`
--

INSERT INTO `stepiface` (`id`, `stepiface_id`, `project_id`, `release_id`, `step_id`, `iface_id`) VALUES
(85, 1, 184, 165, 5, 1),
(86, 1, 199, 186, 1, 1),
(87, 1, 199, 187, 1, 1),
(95, 2, 199, 187, 7, 2),
(96, 3, 199, 187, 7, 3),
(97, 4, 199, 187, 10, 4),
(98, 5, 199, 187, 10, 5),
(99, 4, 202, 190, 4, 4),
(101, 6, 199, 187, 1, 2),
(104, 1, 203, 192, 2, 1),
(105, 1, 203, 193, 2, 1),
(106, 2, 203, 193, 8, 1),
(107, 2, 184, 165, 1, 2),
(108, 1, 184, 194, 5, 1),
(109, 3, 184, 194, 8, 3),
(123, 1, 222, 243, 2, 2),
(124, 2, 222, 243, 1, 1),
(125, 3, 222, 243, 1, 1),
(126, 4, 222, 243, 7, 1),
(127, 8, 222, 243, 8, 8),
(128, 1, 226, 250, 1, 4),
(129, 4, 184, 194, 3, 4),
(130, 2, 226, 250, 2, 1),
(131, 3, 226, 250, 2, 1),
(132, 4, 226, 250, 4, 1),
(133, 5, 226, 250, 2, 4);

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
  KEY `step_id` (`step_id`),
  KEY `project_id` (`project_id`),
  KEY `release_id` (`release_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=92 ;

--
-- Dumping data for table `steprule`
--

INSERT INTO `steprule` (`id`, `steprule_id`, `project_id`, `release_id`, `step_id`, `rule_id`) VALUES
(66, 1, 184, 165, 2, 3),
(68, 1, 199, 187, 10, 1),
(73, 1, 203, 192, 2, 1),
(74, 1, 203, 193, 2, 1),
(75, 2, 203, 193, 8, 2),
(76, 3, 203, 193, 8, 3),
(77, 2, 184, 165, 1, 4),
(78, 3, 184, 165, 1, 5),
(79, 4, 184, 165, 1, 6),
(80, 5, 184, 165, 1, 7),
(81, 6, 184, 165, 1, 8),
(82, 7, 184, 165, 1, 9),
(83, 8, 184, 165, 1, 10),
(84, 1, 184, 194, 2, 3),
(85, 1, 226, 250, 1, 2),
(86, 2, 226, 250, 1, 2),
(87, 3, 226, 250, 1, 1),
(88, 4, 226, 250, 2, 1),
(89, 5, 226, 250, 2, 1),
(90, 6, 226, 250, 1, 1),
(91, 7, 226, 250, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `testcase`
--

CREATE TABLE IF NOT EXISTS `testcase` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usecase_id` int(11) DEFAULT NULL,
  `release_id` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `preparation` text NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `release_id` (`release_id`),
  KEY `usecase_id` (`usecase_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=95 ;

--
-- Dumping data for table `testcase`
--

INSERT INTO `testcase` (`id`, `usecase_id`, `release_id`, `number`, `name`, `preparation`, `active`) VALUES
(77, 318, 192, 1, 'My First Use Case(main)', 'None', 1),
(78, 318, 192, 2, 'My First Use Case(main)', 'None', 1),
(79, 318, 192, 3, 'My First Use Case(A)', 'None', 1),
(80, 318, 192, 4, 'My First Use Case(main)', 'None', 1),
(81, 318, 192, 5, 'My First Use Case(A)', 'None', 1),
(82, 319, 192, 6, 'Usecase Number Two(main)', 'None', 1),
(83, 222, 165, 1, 'Become a member(main)', 'None', 1),
(84, 259, 165, 2, 'Log in(main)', 'None', 1),
(85, 224, 165, 3, 'Create simple requirement category(main)', 'None', 1),
(86, 226, 165, 4, 'Create simple requirement(main)', 'None', 1),
(87, 256, 165, 5, 'Create actor(main)', 'None', 1),
(88, 258, 165, 6, 'Actor inheritance(main)', 'None', 1),
(89, 227, 165, 7, 'Create a library item(main)', 'None', 1),
(90, 228, 165, 8, 'Import a library project(main)', 'None', 1),
(93, 388, 246, 1, 'Test this(main)', 'None', 1),
(94, 389, 246, 2, 'Test that(main)', 'None', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `testresult`
--

INSERT INTO `testresult` (`id`, `testrun_id`, `teststep_id`, `user_id`, `date`, `result`, `comments`) VALUES
(1, 74, 325, 113, '2014-05-19 12:57:00', 4, 'Is this number 2?'),
(2, 74, 326, 113, '2014-05-19 12:57:00', 4, 'None'),
(3, 74, 327, 113, '2014-05-19 12:57:00', 4, 'None'),
(4, 74, 328, 113, '2014-05-19 12:57:00', 4, 'None'),
(5, 74, 329, 113, '2014-05-19 12:57:00', 4, 'None'),
(6, 74, 330, 113, '2014-05-19 12:57:00', 4, 'None'),
(7, 74, 331, 113, '2014-05-19 12:57:00', 4, 'None'),
(8, 75, 332, 113, '2014-05-19 13:12:00', 4, 'None'),
(9, 75, 333, 113, '2014-05-19 13:12:00', 4, 'None'),
(10, 75, 334, 113, '2014-05-19 13:12:00', 4, 'None'),
(11, 75, 335, 113, '2014-05-19 13:12:00', 4, 'None'),
(12, 75, 336, 113, '2014-05-19 13:12:00', 4, 'None'),
(13, 75, 337, 113, '2014-05-19 13:12:00', 4, 'None'),
(14, 75, 338, 113, '2014-05-19 13:12:00', 4, 'None'),
(15, 76, 359, 113, '2014-05-21 11:13:52', 1, 'None'),
(16, 77, 360, 113, '2014-05-21 11:14:19', 2, 'Try this puppy'),
(17, 77, 361, 113, '2014-05-21 11:14:19', 2, 'None'),
(18, 78, 362, 113, '2014-05-21 13:43:02', 4, 'None'),
(19, 79, 362, 113, '2014-05-21 13:44:25', 4, 'None'),
(20, 80, 359, 113, '2014-05-21 14:08:00', 4, 'None'),
(21, 81, 359, 113, '2014-05-22 09:41:51', 4, 'None'),
(22, 82, 359, 113, '2014-05-22 10:06:51', 4, 'None'),
(23, 83, 363, 113, '2014-05-22 11:59:51', 2, 'None'),
(24, 84, 363, 113, '2014-05-22 12:00:48', 4, 'None'),
(25, 85, 364, 113, '2014-05-27 11:25:19', 2, 'None'),
(26, 86, 364, 113, '2014-05-27 11:28:26', 2, 'None'),
(27, 87, 365, 113, '2014-05-27 11:53:50', 1, 'None'),
(28, 88, 365, 113, '2014-05-27 11:54:12', 2, 'None'),
(30, 90, 373, 113, '2014-06-12 12:03:46', 2, 'None'),
(31, 91, 374, 113, '2014-06-12 12:03:58', 1, 'this is bollocks'),
(32, 92, 373, 113, '2014-06-23 11:21:13', 4, 'None');

-- --------------------------------------------------------

--
-- Table structure for table `testrun`
--

CREATE TABLE IF NOT EXISTS `testrun` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `release_id` int(11) NOT NULL,
  `number` smallint(4) NOT NULL,
  `testcase_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `project_id` (`release_id`),
  KEY `testcase_id` (`testcase_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=93 ;

--
-- Dumping data for table `testrun`
--

INSERT INTO `testrun` (`id`, `release_id`, `number`, `testcase_id`, `status`) VALUES
(74, 192, 1, 77, 1),
(75, 192, 1, 78, 1),
(76, 165, 1, 83, 3),
(77, 165, 1, 84, 3),
(78, 165, 1, 85, 1),
(79, 165, 1, 85, 2),
(80, 165, 1, 83, 2),
(81, 165, 1, 83, 2),
(82, 165, 1, 83, 2),
(83, 165, 1, 86, 3),
(84, 165, 1, 86, 2),
(85, 165, 1, 87, 3),
(86, 165, 1, 87, 3),
(87, 165, 1, 88, 3),
(88, 165, 2, 88, 3),
(90, 246, 1, 93, 3),
(91, 246, 1, 94, 3),
(92, 246, 2, 93, 2);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=375 ;

--
-- Dumping data for table `teststep`
--

INSERT INTO `teststep` (`id`, `testcase_id`, `number`, `action`, `result`) VALUES
(325, 77, '1', 'Actor does this first thing.', 'System responds as predicted.'),
(326, 77, '1', 'Confirm Form Property', 'UF-0001 My First Object Form - field: Name'),
(327, 77, '2', 'Confirm Form Property', 'UF-0001 My First Object Form - field: Description'),
(328, 77, '1', 'Validate Business Rule', 'BR-0001 My First Rule'),
(329, 77, '1', 'Confirm User Interface', 'IF-0001 Here'),
(330, 77, '2', 'Then a second thing is done.', 'And another result is produced.'),
(331, 77, '3', 'Finally, we are getting sick of the whole thin.', 'But there is a result'),
(332, 78, '1', 'Actor does this first thing.', 'System responds as predicted.'),
(333, 78, '1', 'Confirm Form Property', 'UF-0001 My First Object Form - field: Name'),
(334, 78, '2', 'Confirm Form Property', 'UF-0001 My First Object Form - field: Description'),
(335, 78, '1', 'Validate Business Rule', 'BR-0001 My First Rule'),
(336, 78, '1', 'Confirm User Interface', 'IF-0001 Here'),
(337, 78, '2', 'Then a second thing is done.', 'And another result is produced.'),
(338, 78, '3', 'Finally, we are getting sick of the whole thin.', 'But there is a result'),
(339, 79, '3', 'Actor does this first thing.', 'System responds as predicted.'),
(340, 79, '3', 'Then a second thing is done.', 'And another result is produced.'),
(341, 79, '4', 'An alternative path is possible, forking here', 'and then moving on here'),
(342, 79, '5', 'Finally this happens', 'and then we re-join'),
(343, 79, '5', 'Then a second thing is done.', 'And another result is produced.'),
(344, 79, '5', 'Finally, we are getting sick of the whole thin.', 'But there is a result'),
(345, 80, '1', 'Actor does this first thing.', 'System responds as predicted.'),
(346, 80, '1', 'Confirm Form Property', 'UF-0001 My First Object Form - field: Name'),
(347, 80, '2', 'Confirm Form Property', 'UF-0001 My First Object Form - field: Description'),
(348, 80, '1', 'Validate Business Rule', 'BR-0001 My First Rule'),
(349, 80, '1', 'Confirm User Interface', 'IF-0001 Here'),
(350, 80, '2', 'Then a second thing is done.', 'And another result is produced.'),
(351, 80, '3', 'Finally, we are getting sick of the whole thin.', 'But there is a result'),
(352, 81, '3', 'Actor does this first thing.', 'System responds as predicted.'),
(353, 81, '3', 'Then a second thing is done.', 'And another result is produced.'),
(354, 81, '4', 'An alternative path is possible, forking here', 'and then moving on here'),
(355, 81, '5', 'Finally this happens', 'and then we re-join'),
(356, 81, '5', 'Then a second thing is done.', 'And another result is produced.'),
(357, 81, '5', 'Finally, we are getting sick of the whole thin.', 'But there is a result'),
(358, 82, '1', 'Actor action.', 'System result.'),
(359, 83, '1', 'Actor action.', 'System result.'),
(360, 84, '1', 'Actor action.', 'System result.'),
(361, 84, '1', 'Validate Business Rule', 'BR-0003 Number of log on attempts'),
(362, 85, '1', 'Actor action.', 'System result.'),
(363, 86, '1', 'Actor action.', 'System result.'),
(364, 87, '1', 'Actor action.', 'System result.'),
(365, 88, '1', 'Actor action.', 'System result.'),
(366, 89, '1', 'Actor views project list.', 'System displays project list'),
(367, 89, '1', 'Confirm User Interface', 'IF-0001 Project List'),
(368, 90, '1', 'Actor action.', 'System result.'),
(373, 93, '1', 'Actor action.', 'System result.'),
(374, 94, '1', 'Actor action.', 'System result.');

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
  KEY `usecase_id` (`usecase_id`),
  KEY `release_id` (`release_id`),
  KEY `project_id` (`project_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=408 ;

--
-- Dumping data for table `usecase`
--

INSERT INTO `usecase` (`id`, `usecase_id`, `project_id`, `release_id`, `package_id`, `number`, `actor_id`, `name`, `description`, `preconditions`) VALUES
(222, 1, 184, 165, 1, '1', 2, 'Become a member', 'This usecase describes the process of member of the public registering for the account.', 'None'),
(223, 2, 184, 165, 1, '2', 1, 'Log in', 'This usecase describes the process of registered member logging into the system', 'None'),
(224, 3, 184, 165, 2, '1', 1, 'Create simple requirement category', 'This usecase describes the process of a user creating a category of simple requirements that will form a section in the requirements document.', 'A project must be created, user must have edit permission.'),
(225, 4, 184, 165, 2, '2', 1, 'Create simple requiremen', 'This usecase describes the process of creating a text or image requirement within a Simple Requirement Category.', 'None'),
(226, 4, 184, 165, 2, '2', 1, 'Create simple requirement', 'This usecase describes the process of creating a text or image requirement within a Simple Requirement Category.', 'None'),
(227, 5, 184, 165, 3, '1', 1, 'Create a library item', 'This usecase describes the process of ...', 'None'),
(228, 6, 184, 165, 3, '2', 1, 'Import a library project', 'This usecase describes the process of a user copying a library project into another project.', 'None'),
(241, 1, 193, 177, 1, '3', 1, 'Import a module', 'This usecase describes the process of ...', 'None'),
(246, 1, 199, 186, 2, '3', 1, 'Become a member', 'This usecase describes the process of registering an account on the system and becoming a member', 'None'),
(247, 2, 199, 186, 2, '4', 2, 'Log in', 'This usecase describes the process of a member authenticating themselves and logging on to their account.', 'User must have an account'),
(248, 3, 199, 186, 2, '5', 2, 'Update profile', 'This usecase describes the process of updating their account profile', 'None'),
(249, 4, 199, 186, 2, '6', 1, 'View member only content', 'This usecase describes the process of a user viewing content that is access controlled.', 'None'),
(250, 5, 199, 186, 2, '7', 2, 'Log out', 'This usecase describes the process of member completing their session and logging out of their account.', 'Member must be logged in.'),
(251, 1, 199, 187, 2, '1', 1, 'Become a member', 'This usecase describes the process of registering an account on the system and becoming a member', 'None'),
(252, 2, 199, 187, 2, '4', 2, 'Log in', 'This usecase describes the process of a member authenticating themselves and logging on to their account.', 'User must have an account'),
(253, 3, 199, 187, 2, '5', 2, 'Update profile', 'This usecase describes the process of updating their account profile', 'None'),
(254, 4, 199, 187, 2, '3', 1, 'View member only content', 'This usecase describes the process of a user viewing content that is access controlled.', 'None'),
(255, 5, 199, 187, 2, '6', 2, 'Log out', 'This usecase describes the process of member completing their session and logging out of their account.', 'Member must be logged in.'),
(256, 7, 184, 165, 2, '8', 1, 'Create actor', 'This usecase describes the process of a member defining an actor for a project.', 'None'),
(257, 8, 184, 165, 2, '9', 1, 'Actor inheritance', 'This usecase describes the process of ...', 'None'),
(258, 8, 184, 165, 2, '9', 1, 'Actor inheritance', 'This usecase describes the process of defining an inheritance relationship between two actors.', 'None'),
(259, 2, 184, 165, 1, '2', 1, 'Log in', 'This usecase describes the process of registered member logging into the system.', 'None'),
(296, 6, 199, 187, 2, '2', 1, 'Retrieve Forgotten Password', 'This usecase describes the process of a user resetting their password.', 'None'),
(297, 7, 199, 187, 2, '10', 1, 'sacrifice', 'This usecase describes the process of ...', 'None'),
(298, 8, 199, 187, 2, '10', 1, 'test', 'This usecase describes the process of ...', 'None'),
(299, 4, 202, 190, 5, '1', 4, 'Become a member', 'This usecase describes the process of registering an account on the system and becoming a member', 'None'),
(300, 5, 202, 190, 5, '2', 5, 'Log in', 'This usecase describes the process of a member authenticating themselves and logging on to their account.', 'User must have an account'),
(301, 6, 202, 190, 5, '3', 5, 'Update profile', 'This usecase describes the process of updating their account profile', 'None'),
(302, 7, 202, 190, 5, '4', 4, 'View member only content', 'This usecase describes the process of a user viewing content that is access controlled.', 'None'),
(303, 8, 202, 190, 5, '5', 5, 'Log out', 'This usecase describes the process of member completing their session and logging out of their account.', 'Member must be logged in.'),
(304, 9, 202, 190, 1, '1', 4, 'Test', 'This usecase describes the process of ...', 'None'),
(305, 10, 202, 190, 5, '8', 4, 'curious offset number', 'This usecase describes the process of ...', 'None'),
(306, 11, 202, 190, 6, '1', 4, 'First one', 'This usecase describes the process of ...', 'None'),
(307, 12, 202, 190, 5, '9', 4, 'weird numbers', 'This usecase describes the process of ...', 'None'),
(308, 13, 202, 190, 1, '5', 4, 'post renumber', 'This usecase describes the process of ...', 'None'),
(309, 9, 202, 190, 1, '1', 4, 'Test', 'This usecase describes the process of testing the roll back', 'None'),
(310, 2, 193, 178, 2, '10', 2, 'Test usecase', 'This usecase describes the process of ...', 'None'),
(317, 1, 203, 192, 1, '6', 1, 'My First Use Case', 'This usecase describes the process of nothing in particular', 'None'),
(318, 2, 203, 192, 1, '1', 1, 'My First Use Case', 'This usecase describes the process of Nuthin', 'None'),
(319, 3, 203, 192, 1, '2', 1, 'Usecase Number Two', 'This usecase describes the process of sumthin', 'None'),
(320, 2, 203, 193, 1, '1', 1, 'My First Use Case', 'This usecase describes the process of Nuthin', 'None'),
(321, 3, 203, 193, 1, '2', 1, 'Usecase Number Two', 'This usecase describes the process of sumthin', 'None'),
(322, 4, 203, 193, 2, '3', 1, 'Test the number', 'This usecase describes the process of ...', 'None'),
(323, 1, 184, 194, 1, '1', 2, 'Become a member', 'This usecase describes the process of member of the public registering for the account.', 'None'),
(324, 2, 184, 194, 1, '2', 1, 'Log in', 'This usecase describes the process of registered member logging into the system.', 'None'),
(325, 3, 184, 194, 2, '1', 1, 'Create simple requirement category', 'This usecase describes the process of a user creating a category of simple requirements that will form a section in the requirements document.', 'A project must be created, user must have edit permission.'),
(326, 4, 184, 194, 2, '2', 1, 'Create simple requirement', 'This usecase describes the process of creating a text or image requirement within a Simple Requirement Category.', 'None'),
(327, 7, 184, 194, 2, '8', 1, 'Create actor', 'This usecase describes the process of a member defining an actor for a project.', 'None'),
(328, 8, 184, 194, 2, '9', 1, 'Actor inheritance', 'This usecase describes the process of defining an inheritance relationship between two actors.', 'None'),
(329, 5, 184, 194, 3, '1', 1, 'Create a library item', 'This usecase describes the process of ...', 'None'),
(330, 6, 184, 194, 3, '2', 1, 'Import a library project', 'This usecase describes the process of a user copying a library project into another project.', 'None'),
(386, 1, 222, 243, 1, '1', 1, 'Test this', 'This usecase describes the process of ...', 'None'),
(387, 2, 222, 243, 1, '2', 1, 'Test that', 'This usecase describes the process of ...', 'None'),
(388, 1, 222, 246, 1, '1', 1, 'Test this', 'This usecase describes the process of ...', 'None'),
(389, 2, 222, 246, 1, '2', 1, 'Test that', 'This usecase describes the process of ...', 'None'),
(390, 3, 222, 243, 1, '3', 1, 'this is the one', 'This usecase describes the process of ...', 'None'),
(391, 8, 222, 243, 9, '1', 8, 'Become a member', 'This usecase describes the process of registering an account on the system and becoming a member', 'None'),
(392, 9, 222, 243, 9, '2', 9, 'Log in', 'This usecase describes the process of a member authenticating themselves and logging on to their account.', 'User must have an account'),
(393, 10, 222, 243, 9, '3', 9, 'Update profile', 'This usecase describes the process of updating their account profile', 'None'),
(394, 11, 222, 243, 9, '4', 8, 'View member only content', 'This usecase describes the process of a user viewing content that is access controlled.', 'None'),
(395, 12, 222, 243, 9, '5', 9, 'Log out', 'This usecase describes the process of member completing their session and logging out of their account.', 'Member must be logged in.'),
(398, 1, 226, 250, 1, '1', 1, 'Test this', 'This usecase describes the process of ...', 'None'),
(399, 2, 226, 250, 1, '2', 1, 'Test that', 'This usecase describes the process of ...', 'None'),
(400, 13, 222, 243, 1, '4', 1, 'aoeuaoeu oeaueoa u', 'This usecase describes the process of ...', 'None'),
(401, 13, 222, 243, 9, '4', 1, 'aoeuaoeu oeaueoa u', 'This usecase describes the process of ...', 'None'),
(402, 13, 222, 243, 1, '4', 1, 'aoeuaoeu oeaueoa u', 'This usecase describes the process of ...', 'None'),
(403, 13, 222, 243, 1, '4', 1, 'aoeuaoeu oeaueoa u', 'This usecase describes the process of ...', 'None'),
(404, 13, 222, 243, 1, '4', 1, 'aoeuaoeu oeaueoa u', 'This usecase describes the process of ...', 'None'),
(405, 13, 222, 243, 1, '4', 1, 'aoeuaoeu oeaueoa u', 'This usecase describes the process of ...', 'None'),
(406, 13, 222, 243, 9, '4', 1, 'aoeuaoeu oeaueoa u', 'This usecase describes the process of ...', 'None'),
(407, 1, 227, 251, 1, '1', 1, 'eou', 'This usecase describes the process of ...', 'None');

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
  `verification_code` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `address_id` (`address_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=157 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `email`, `password`, `address_id`, `salt`, `username`, `type`, `active`, `company_id`, `admin`, `verify`, `verification_code`) VALUES
(113, 'twit', 'twitter', 'twit@test.com', '1a1dc91c907325c69271ddf0c944bc72', NULL, '52aa245e381000.34176327', 'twit@test.com', 1, 1, 505, 1, 0, ''),
(114, 'Bill', 'Other', 'bill@test.com', '1a1dc91c907325c69271ddf0c944bc72', NULL, '53363dae19c183.12004062', 'bill@test.com', 1, 1, 507, 0, 0, ''),
(115, 'abhishek', 'saini', 'abhishek.saini@enukesoftware.com', '3ec22ea7499a4a4f33b2a25ccc925f1e', NULL, '53453125ee0632.72686363', 'abhishek.saini@enukesoftware.com', 1, 1, 509, 0, 0, ''),
(116, 'Ted', 'Haddergash', 'ted@test.com', '1a1dc91c907325c69271ddf0c944bc72', NULL, '534e63289394c3.37189685', 'ted@test.com', 1, 1, 510, 0, 0, ''),
(117, 'Tad', 'Haddergash', 'tad@billson.com', '1a1dc91c907325c69271ddf0c944bc72', NULL, '534e667188da20.00200784', 'tad@billson.com', 1, 1, 511, 0, 0, ''),
(118, 'STH', 'shosreoj', 'invite@test.com', '1a1dc91c907325c69271ddf0c944bc72', NULL, '536706021252e9.84388793', 'invite@test.com', 1, 1, 512, 1, 0, ''),
(119, 'Mark', 'Birglaw', 'employee@test.com', '3d801aa532c1cec3ee82d87a99fdf63f', NULL, '536749af9d0c11.22948007', 'employee@test.com', 0, 1, 512, 0, 0, ''),
(120, 'Admin', 'Check', 'adcheck@test.com', '35f504164d5a963d6a820e71614a4009', NULL, '53674b114862d1.87916714', 'adcheck@test.com', 1, 1, 513, 1, 0, ''),
(140, 'James', 'Billson', 'james@billson.com', '1a1dc91c907325c69271ddf0c944bc72', NULL, '53ab4e2b361b23.76203420', 'james@billson.com', 1, 1, 515, 1, 0, NULL),
(156, 'aoaoeu', 'oaeuaoeu', 'aoeu@aeou.com.au', '05f60ba25a20f67f442f4127e4d6c4dd', NULL, '53ac0da68a31e2.27930034', 'aoeu@aeou.com.au', 1, 1, 515, 0, 0, '4da2fad103');

-- --------------------------------------------------------

--
-- Table structure for table `user_meta`
--

CREATE TABLE IF NOT EXISTS `user_meta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `has_viewed` tinyint(1) NOT NULL,
  `has_acknowledged` tinyint(1) NOT NULL,
  `alert_messages_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `alert_messages_id` (`alert_messages_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=23 ;

--
-- Dumping data for table `user_meta`
--

INSERT INTO `user_meta` (`id`, `user_id`, `has_viewed`, `has_acknowledged`, `alert_messages_id`) VALUES
(1, 115, 0, 0, 1),
(2, 115, 0, 0, 2),
(3, 113, 1, 1, 1),
(4, 113, 1, 0, 2),
(5, 113, 1, 0, 3),
(6, 113, 0, 0, 4),
(7, 114, 1, 1, 1),
(8, 114, 0, 0, 2),
(9, 114, 0, 0, 3),
(10, 114, 0, 0, 4),
(11, 140, 1, 1, 1),
(12, 140, 1, 0, 2),
(13, 140, 1, 0, 3),
(14, 140, 0, 0, 4);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4210 ;

--
-- Dumping data for table `version`
--

INSERT INTO `version` (`id`, `number`, `release`, `project_id`, `status`, `object`, `action`, `foreign_key`, `foreign_id`, `active`, `create_date`, `create_user`) VALUES
(2325, 0, '165', 184, 1, 4, 1, 186, 1, 0, '2014-04-29 06:30:06', 113),
(2326, 0, '165', 184, 1, 4, 1, 187, 2, 1, '2014-04-27 08:37:13', 113),
(2327, 0, '165', 184, 1, 5, 1, 884, 1, 1, '2014-04-27 08:37:14', 113),
(2328, 0, '165', 184, 1, 5, 1, 885, 2, 1, '2014-04-27 08:37:16', 113),
(2329, 0, '165', 184, 1, 5, 1, 886, 3, 1, '2014-04-27 08:37:18', 113),
(2330, 0, '165', 184, 1, 5, 1, 887, 4, 1, '2014-04-27 08:37:19', 113),
(2331, 0, '165', 184, 1, 8, 1, 338, 1, 1, '2014-04-27 08:37:20', 113),
(2332, 0, '165', 184, 1, 8, 1, 339, 2, 1, '2014-04-27 08:37:22', 113),
(2333, 0, '165', 184, 1, 8, 1, 340, 3, 1, '2014-04-27 08:37:23', 113),
(2334, 0, '165', 184, 1, 9, 1, 509, 1, 1, '2014-04-27 08:37:24', 113),
(2335, 0, '165', 184, 1, 9, 1, 510, 2, 1, '2014-04-27 08:37:27', 113),
(2336, 0, '165', 184, 1, 9, 1, 511, 3, 1, '2014-04-27 08:37:28', 113),
(2337, 0, '165', 184, 1, 10, 1, 222, 1, 1, '2014-04-27 08:37:28', 113),
(2338, 0, '165', 184, 1, 10, 1, 223, 2, 0, '2014-04-29 19:16:41', 113),
(2339, 0, '165', 184, 1, 10, 1, 224, 3, 1, '2014-04-27 08:37:31', 113),
(2340, 0, '165', 184, 1, 13, 1, 363, 1, 1, '2014-04-27 08:37:32', 113),
(2341, 0, '165', 184, 1, 13, 1, 364, 2, 1, '2014-04-27 08:37:35', 113),
(2342, 0, '165', 184, 1, 13, 1, 365, 3, 1, '2014-04-27 08:37:38', 113),
(2343, 1, '165', 184, 1, 10, 1, 225, 4, 0, '2014-04-27 08:42:58', 113),
(2344, 2, '165', 184, 1, 8, 1, 341, 4, 1, '2014-04-27 08:42:42', 113),
(2345, 3, '165', 184, 1, 9, 1, 512, 4, 1, '2014-04-27 08:42:43', 113),
(2346, 4, '165', 184, 1, 10, 2, 226, 4, 1, '2014-04-27 08:42:58', 113),
(2347, 5, '165', 184, 1, 10, 1, 227, 5, 1, '2014-04-27 09:18:30', 113),
(2348, 6, '165', 184, 1, 8, 1, 342, 5, 1, '2014-04-27 09:18:31', 113),
(2349, 7, '165', 184, 1, 9, 1, 513, 5, 0, '2014-04-28 00:20:48', 113),
(2350, 8, '165', 184, 1, 10, 1, 228, 6, 1, '2014-04-27 09:20:08', 113),
(2351, 9, '165', 184, 1, 8, 1, 343, 6, 1, '2014-04-27 09:20:08', 113),
(2352, 10, '165', 184, 1, 9, 1, 514, 6, 1, '2014-04-27 09:20:08', 113),
(2358, 11, '165', 184, 1, 9, 2, 515, 5, 1, '2014-04-28 00:20:48', 113),
(2359, 12, '165', 184, 1, 12, 1, 121, 1, 1, '2014-04-28 00:21:55', 113),
(2360, 13, '165', 184, 1, 15, 1, 85, 1, 1, '2014-04-28 00:21:55', 113),
(2470, 0, '177', 193, 1, 13, 1, 408, 1, 1, '2014-04-28 03:37:57', 114),
(2471, 1, '177', 193, 1, 13, 1, 409, 2, 1, '2014-04-28 03:37:57', 114),
(2472, 2, '177', 193, 1, 13, 1, 410, 3, 1, '2014-04-28 03:37:57', 114),
(2473, 3, '177', 193, 1, 4, 1, 209, 1, 1, '2014-04-28 03:37:58', 114),
(2474, 4, '177', 193, 1, 5, 1, 903, 1, 1, '2014-04-28 03:37:58', 114),
(2475, 5, '177', 193, 1, 10, 1, 241, 1, 1, '2014-04-28 03:38:21', 114),
(2476, 6, '177', 193, 1, 8, 1, 356, 1, 1, '2014-04-28 03:38:21', 114),
(2477, 7, '177', 193, 1, 9, 1, 528, 1, 1, '2014-04-28 03:38:21', 114),
(2478, 8, '177', 193, 1, 6, 1, 19, 1, 1, '2014-04-28 03:38:33', 114),
(2545, 0, '186', 199, 1, 13, 1, 441, 1, 1, '2014-04-28 07:23:11', 114),
(2546, 1, '186', 199, 1, 13, 1, 442, 2, 1, '2014-04-28 07:23:11', 114),
(2547, 2, '186', 199, 1, 13, 1, 443, 3, 1, '2014-04-28 07:23:11', 114),
(2548, 3, '186', 199, 1, 4, 1, 222, 1, 0, '2014-04-28 07:24:00', 114),
(2549, 4, '186', 199, 1, 5, 1, 915, 1, 0, '2014-04-28 07:25:23', 114),
(2550, 5, '186', 199, 1, 4, 2, 223, 1, 1, '2014-04-28 07:24:00', 114),
(2551, 6, '186', 199, 1, 4, 1, 224, 2, 1, '2014-04-28 07:24:54', 114),
(2552, 7, '186', 199, 1, 5, 3, 915, 1, 0, '2014-04-28 07:25:23', 114),
(2553, 8, '186', 199, 1, 5, 1, 916, 2, 1, '2014-04-28 07:25:34', 114),
(2554, 9, '186', 199, 1, 10, 1, 246, 1, 1, '2014-04-28 07:26:37', 114),
(2555, 10, '186', 199, 1, 8, 1, 361, 1, 1, '2014-04-28 07:26:37', 114),
(2556, 11, '186', 199, 1, 9, 1, 533, 1, 0, '2014-04-28 07:34:33', 114),
(2557, 12, '186', 199, 1, 10, 1, 247, 2, 1, '2014-04-28 07:27:24', 114),
(2558, 13, '186', 199, 1, 8, 1, 362, 2, 1, '2014-04-28 07:27:25', 114),
(2559, 14, '186', 199, 1, 9, 1, 534, 2, 1, '2014-04-28 07:27:25', 114),
(2560, 15, '186', 199, 1, 10, 1, 248, 3, 1, '2014-04-28 07:27:52', 114),
(2561, 16, '186', 199, 1, 8, 1, 363, 3, 1, '2014-04-28 07:27:54', 114),
(2562, 17, '186', 199, 1, 9, 1, 535, 3, 1, '2014-04-28 07:27:55', 114),
(2563, 18, '186', 199, 1, 10, 1, 249, 4, 1, '2014-04-28 07:29:26', 114),
(2564, 19, '186', 199, 1, 8, 1, 364, 4, 1, '2014-04-28 07:29:26', 114),
(2565, 20, '186', 199, 1, 9, 1, 536, 4, 1, '2014-04-28 07:29:26', 114),
(2566, 21, '186', 199, 1, 10, 1, 250, 5, 1, '2014-04-28 07:30:23', 114),
(2567, 22, '186', 199, 1, 8, 1, 365, 5, 1, '2014-04-28 07:30:23', 114),
(2568, 23, '186', 199, 1, 9, 1, 537, 5, 1, '2014-04-28 07:30:23', 114),
(2569, 24, '186', 199, 1, 12, 1, 122, 1, 1, '2014-04-28 07:31:48', 114),
(2570, 25, '186', 199, 1, 15, 1, 86, 1, 1, '2014-04-28 07:31:49', 114),
(2571, 26, '186', 199, 1, 2, 1, 94, 1, 1, '2014-04-28 07:32:17', 114),
(2572, 27, '186', 199, 1, 14, 1, 59, 1, 1, '2014-04-28 07:32:17', 114),
(2573, 28, '186', 199, 1, 9, 2, 538, 1, 1, '2014-04-28 07:34:33', 114),
(2574, 29, '186', 199, 1, 9, 1, 539, 6, 0, '2014-04-28 07:35:42', 114),
(2575, 30, '186', 199, 1, 9, 2, 540, 6, 1, '2014-04-28 07:35:42', 114),
(2576, 31, '186', 199, 1, 14, 1, 60, 2, 1, '2014-04-28 07:35:54', 114),
(2577, 0, '187', 199, 1, 2, 1, 95, 1, 1, '2014-04-28 07:36:51', 114),
(2578, 0, '187', 199, 1, 4, 1, 225, 1, 1, '2014-04-28 07:36:53', 114),
(2579, 0, '187', 199, 1, 4, 1, 226, 2, 1, '2014-04-28 07:36:54', 114),
(2580, 0, '187', 199, 1, 5, 1, 917, 2, 1, '2014-04-28 07:36:56', 114),
(2581, 0, '187', 199, 1, 8, 1, 366, 1, 1, '2014-04-28 07:36:58', 114),
(2582, 0, '187', 199, 1, 8, 1, 367, 2, 1, '2014-04-28 07:36:59', 114),
(2583, 0, '187', 199, 1, 8, 1, 368, 3, 1, '2014-04-28 07:37:00', 114),
(2584, 0, '187', 199, 1, 8, 1, 369, 4, 1, '2014-04-28 07:37:01', 114),
(2585, 0, '187', 199, 1, 8, 1, 370, 5, 1, '2014-04-28 07:37:02', 114),
(2586, 0, '187', 199, 1, 9, 1, 541, 1, 1, '2014-04-28 07:37:03', 114),
(2587, 0, '187', 199, 1, 9, 1, 542, 6, 1, '2014-04-28 07:37:04', 114),
(2588, 0, '187', 199, 1, 9, 1, 543, 2, 1, '2014-04-28 07:37:05', 114),
(2589, 0, '187', 199, 1, 9, 1, 544, 3, 1, '2014-04-28 07:37:06', 114),
(2590, 0, '187', 199, 1, 9, 1, 545, 4, 1, '2014-04-28 07:37:07', 114),
(2591, 0, '187', 199, 1, 9, 1, 546, 5, 1, '2014-04-28 07:37:10', 114),
(2592, 0, '187', 199, 1, 10, 1, 251, 1, 1, '2014-04-28 07:37:12', 114),
(2593, 0, '187', 199, 1, 10, 1, 252, 2, 1, '2014-04-28 07:37:13', 114),
(2594, 0, '187', 199, 1, 10, 1, 253, 3, 1, '2014-04-28 07:37:14', 114),
(2595, 0, '187', 199, 1, 10, 1, 254, 4, 1, '2014-04-28 07:37:15', 114),
(2596, 0, '187', 199, 1, 10, 1, 255, 5, 1, '2014-04-28 07:37:16', 114),
(2597, 0, '187', 199, 1, 12, 1, 123, 1, 0, '2014-05-02 03:03:09', 114),
(2598, 0, '187', 199, 1, 13, 1, 444, 1, 1, '2014-04-28 07:37:19', 114),
(2599, 0, '187', 199, 1, 13, 1, 445, 2, 1, '2014-04-28 07:37:20', 114),
(2600, 0, '187', 199, 1, 13, 1, 446, 3, 1, '2014-04-28 07:37:22', 114),
(2601, 0, '187', 199, 1, 14, 1, 61, 1, 1, '2014-04-28 07:37:23', 114),
(2602, 0, '187', 199, 1, 14, 1, 62, 2, 1, '2014-04-28 07:37:25', 114),
(2603, 0, '187', 199, 1, 15, 1, 87, 1, 1, '2014-04-28 07:37:26', 114),
(2604, 14, '165', 184, 1, 10, 1, 256, 7, 1, '2014-04-29 02:37:34', 113),
(2605, 15, '165', 184, 1, 8, 1, 371, 7, 1, '2014-04-29 02:37:35', 113),
(2606, 16, '165', 184, 1, 9, 1, 547, 7, 1, '2014-04-29 02:37:35', 113),
(2607, 17, '165', 184, 1, 10, 1, 257, 8, 0, '2014-04-29 02:51:11', 113),
(2608, 18, '165', 184, 1, 8, 1, 372, 8, 1, '2014-04-29 02:39:14', 113),
(2609, 19, '165', 184, 1, 9, 1, 548, 8, 1, '2014-04-29 02:39:14', 113),
(2610, 20, '165', 184, 1, 10, 2, 258, 8, 1, '2014-04-29 02:51:11', 113),
(2611, 21, '165', 184, 1, 4, 2, 227, 1, 0, '2014-04-29 06:45:16', 113),
(2612, 22, '165', 184, 1, 4, 2, 228, 1, 0, '2014-04-29 06:46:39', 113),
(2613, 23, '165', 184, 1, 4, 2, 229, 1, 0, '2014-04-29 06:47:34', 113),
(2614, 24, '165', 184, 1, 4, 2, 230, 1, 0, '2014-04-29 06:51:34', 113),
(2615, 25, '165', 184, 1, 4, 2, 231, 1, 0, '2014-04-29 06:56:12', 113),
(2616, 26, '165', 184, 1, 4, 2, 232, 1, 0, '2014-04-29 07:00:12', 113),
(2617, 27, '165', 184, 1, 4, 2, 233, 1, 0, '2014-04-29 07:02:32', 113),
(2618, 28, '165', 184, 1, 4, 2, 234, 1, 0, '2014-04-29 07:04:11', 113),
(2619, 29, '165', 184, 1, 4, 2, 235, 1, 0, '2014-04-29 07:05:03', 113),
(2620, 30, '165', 184, 1, 4, 2, 236, 1, 1, '2014-04-29 07:05:03', 113),
(2621, 31, '165', 184, 1, 1, 1, 101, 1, 0, '2014-05-21 08:16:48', 113),
(2622, 32, '165', 184, 1, 1, 1, 102, 2, 0, '2014-04-29 07:26:36', 113),
(2623, 33, '165', 184, 1, 1, 3, 102, 2, 0, '2014-04-29 07:26:36', 113),
(2624, 34, '165', 184, 1, 1, 1, 103, 3, 0, '2014-05-21 08:17:44', 113),
(2625, 35, '165', 184, 1, 16, 1, 66, 1, 1, '2014-04-29 19:15:58', 113),
(2626, 36, '165', 184, 1, 10, 2, 259, 2, 1, '2014-04-29 19:16:41', 113),
(2627, 37, '165', 184, 1, 6, 1, 26, 1, 1, '2014-04-29 19:34:37', 113),
(2628, 38, '165', 184, 1, 6, 1, 27, 2, 1, '2014-04-29 19:37:14', 113),
(2629, 39, '165', 184, 1, 7, 1, 16, 1, 0, '2014-05-21 08:02:28', 113),
(2630, 40, '165', 184, 1, 7, 1, 17, 2, 1, '2014-04-29 20:22:14', 113),
(2631, 41, '165', 184, 1, 6, 1, 28, 3, 1, '2014-04-29 20:23:28', 113),
(2632, 42, '165', 184, 1, 6, 1, 29, 4, 1, '2014-04-29 20:24:22', 113),
(2633, 43, '165', 184, 1, 7, 1, 18, 3, 1, '2014-04-29 20:38:53', 113),
(2634, 44, '165', 184, 1, 7, 1, 19, 4, 1, '2014-04-29 20:41:21', 113),
(2635, 45, '165', 184, 1, 6, 1, 30, 5, 1, '2014-04-29 20:45:04', 113),
(2636, 46, '165', 184, 1, 6, 1, 31, 6, 1, '2014-04-29 20:46:19', 113),
(2637, 47, '165', 184, 1, 2, 1, 96, 1, 1, '2014-04-29 20:46:50', 113),
(2923, 1, '187', 199, 1, 10, 1, 296, 6, 1, '2014-04-30 22:45:29', 114),
(2924, 2, '187', 199, 1, 8, 1, 409, 6, 1, '2014-04-30 22:45:29', 114),
(2925, 3, '187', 199, 1, 9, 1, 591, 7, 0, '2014-04-30 23:16:06', 114),
(2926, 4, '187', 199, 1, 10, 1, 297, 7, 0, '2014-04-30 22:46:42', 114),
(2927, 5, '187', 199, 1, 8, 1, 410, 7, 1, '2014-04-30 22:46:16', 114),
(2928, 6, '187', 199, 1, 9, 1, 592, 8, 1, '2014-04-30 22:46:17', 114),
(2929, 7, '187', 199, 1, 10, 3, 297, 7, 0, '2014-04-30 22:46:42', 114),
(2930, 8, '187', 199, 1, 10, 1, 298, 8, 0, '2014-04-30 22:47:41', 114),
(2931, 9, '187', 199, 1, 8, 1, 411, 8, 1, '2014-04-30 22:47:18', 114),
(2932, 10, '187', 199, 1, 9, 1, 593, 9, 1, '2014-04-30 22:47:18', 114),
(2933, 11, '187', 199, 1, 10, 3, 298, 8, 0, '2014-04-30 22:47:41', 114),
(2934, 12, '187', 199, 1, 9, 2, 594, 7, 1, '2014-04-30 23:16:06', 114),
(2935, 13, '187', 199, 1, 12, 1, 132, 2, 0, '2014-05-02 05:18:53', 114),
(2936, 14, '187', 199, 1, 15, 1, 95, 2, 1, '2014-04-30 23:16:22', 114),
(2937, 15, '187', 199, 1, 12, 1, 133, 3, 0, '2014-05-03 01:15:13', 114),
(2938, 16, '187', 199, 1, 15, 1, 96, 3, 1, '2014-04-30 23:16:42', 114),
(2939, 17, '187', 199, 1, 9, 1, 595, 10, 0, '2014-04-30 23:18:01', 114),
(2940, 18, '187', 199, 1, 9, 2, 596, 10, 0, '2014-04-30 23:18:21', 114),
(2941, 19, '187', 199, 1, 9, 2, 597, 10, 0, '2014-05-01 06:49:51', 114),
(2942, 20, '187', 199, 1, 12, 1, 134, 4, 0, '2014-05-04 07:15:25', 114),
(2943, 21, '187', 199, 1, 15, 1, 97, 4, 1, '2014-04-30 23:18:48', 114),
(2944, 22, '187', 199, 1, 2, 1, 107, 2, 1, '2014-04-30 23:19:01', 114),
(2945, 23, '187', 199, 1, 14, 1, 76, 3, 1, '2014-04-30 23:19:02', 114),
(2946, 24, '187', 199, 1, 1, 1, 109, 1, 0, '2014-04-30 23:20:49', 114),
(2947, 25, '187', 199, 1, 16, 1, 68, 1, 1, '2014-04-30 23:19:33', 114),
(2948, 26, '187', 199, 1, 1, 2, 110, 1, 1, '2014-04-30 23:20:49', 114),
(2949, 27, '187', 199, 1, 3, 1, 50, 1, 1, '2014-04-30 23:24:20', 114),
(2950, 28, '187', 199, 1, 6, 1, 35, 1, 1, '2014-04-30 23:55:06', 114),
(2951, 29, '187', 199, 1, 3, 1, 51, 2, 1, '2014-05-01 06:37:50', 114),
(2952, 30, '187', 199, 1, 3, 1, 52, 3, 1, '2014-05-01 06:39:48', 114),
(2953, 31, '187', 199, 1, 3, 1, 53, 4, 1, '2014-05-01 06:40:51', 114),
(2954, 32, '187', 199, 1, 12, 1, 135, 5, 0, '2014-05-01 06:50:12', 114),
(2955, 33, '187', 199, 1, 15, 1, 98, 5, 1, '2014-05-01 06:49:35', 114),
(2956, 34, '187', 199, 1, 9, 2, 598, 10, 1, '2014-05-01 06:49:51', 114),
(2957, 35, '187', 199, 1, 12, 2, 136, 5, 0, '2014-05-02 00:09:31', 114),
(2958, 36, '187', 199, 1, 12, 2, 137, 5, 1, '2014-05-02 00:09:31', 114),
(2959, 37, '187', 199, 1, 1, 1, 111, 2, 1, '2014-05-02 01:15:10', 114),
(2960, 38, '187', 199, 1, 7, 1, 34, 1, 1, '2014-05-02 01:48:54', 114),
(2961, 39, '187', 199, 1, 7, 1, 35, 2, 1, '2014-05-02 01:49:12', 114),
(2962, 40, '187', 199, 1, 7, 1, 36, 3, 1, '2014-05-02 01:49:27', 114),
(2963, 41, '187', 199, 1, 7, 1, 37, 4, 1, '2014-05-02 01:49:47', 114),
(2964, 42, '187', 199, 1, 12, 2, 138, 1, 0, '2014-05-04 07:53:03', 114),
(2965, 43, '187', 199, 1, 12, 2, 139, 2, 0, '2014-05-04 08:35:31', 114),
(2967, 45, '187', 199, 1, 12, 2, 140, 3, 0, '2014-05-04 09:12:23', 114),
(2973, 51, '187', 199, 1, 12, 2, 141, 4, 0, '2014-05-04 23:53:49', 114),
(2978, 56, '187', 199, 1, 12, 2, 142, 1, 1, '2014-05-04 07:53:03', 114),
(2979, 57, '187', 199, 1, 12, 2, 143, 2, 1, '2014-05-04 08:35:31', 114),
(2983, 58, '187', 199, 1, 12, 2, 146, 3, 1, '2014-05-04 09:12:23', 114),
(2984, 59, '187', 199, 1, 11, 1, 22, 1, 1, '2014-05-04 23:51:47', 114),
(2985, 60, '187', 199, 1, 12, 1, 147, 6, 0, '2014-05-05 00:32:33', 114),
(2986, 61, '187', 199, 1, 12, 2, 148, 4, 1, '2014-05-04 23:53:49', 114),
(2987, 62, '187', 199, 1, 12, 3, 147, 6, 0, '2014-05-05 00:32:33', 114),
(2988, 63, '187', 199, 1, 12, 1, 149, 7, 0, '2014-05-05 00:37:12', 114),
(2989, 64, '187', 199, 1, 12, 3, 149, 7, 0, '2014-05-05 00:37:12', 114),
(2990, 65, '187', 199, 1, 12, 1, 150, 8, 0, '2014-05-05 00:38:31', 114),
(2991, 66, '187', 199, 1, 12, 3, 150, 8, 0, '2014-05-05 00:38:31', 114),
(2992, 0, '189', 201, 1, 13, 1, 453, 1, 1, '2014-05-05 05:31:22', 118),
(2993, 1, '189', 201, 1, 13, 1, 454, 2, 1, '2014-05-05 05:31:22', 118),
(2994, 2, '189', 201, 1, 13, 1, 455, 3, 1, '2014-05-05 05:31:22', 118),
(2995, 3, '189', 201, 1, 4, 1, 241, 1, 1, '2014-05-05 05:31:22', 118),
(2996, 4, '189', 201, 1, 5, 1, 933, 1, 1, '2014-05-05 05:31:22', 118),
(2997, 0, '190', 202, 1, 13, 1, 456, 1, 1, '2014-05-05 11:14:44', 120),
(2998, 1, '190', 202, 1, 13, 1, 457, 2, 1, '2014-05-05 11:14:45', 120),
(2999, 2, '190', 202, 1, 13, 1, 458, 3, 1, '2014-05-05 11:14:45', 120),
(3000, 3, '190', 202, 1, 4, 1, 242, 1, 1, '2014-05-05 11:14:45', 120),
(3001, 4, '190', 202, 1, 5, 1, 934, 1, 1, '2014-05-05 11:14:46', 120),
(3002, 0, '190', 202, 1, 2, 1, 108, 4, 1, '2014-05-05 11:15:01', 120),
(3003, 0, '190', 202, 1, 4, 1, 243, 4, 1, '2014-05-05 11:15:03', 120),
(3004, 0, '190', 202, 1, 4, 1, 244, 5, 1, '2014-05-05 11:15:05', 120),
(3005, 0, '190', 202, 1, 5, 1, 935, 5, 1, '2014-05-05 11:15:07', 120),
(3006, 0, '190', 202, 1, 8, 1, 412, 4, 1, '2014-05-05 11:15:08', 120),
(3007, 0, '190', 202, 1, 8, 1, 413, 5, 1, '2014-05-05 11:15:10', 120),
(3008, 0, '190', 202, 1, 8, 1, 414, 6, 1, '2014-05-05 11:15:11', 120),
(3009, 0, '190', 202, 1, 8, 1, 415, 7, 1, '2014-05-05 11:15:14', 120),
(3010, 0, '190', 202, 1, 8, 1, 416, 8, 1, '2014-05-05 11:15:16', 120),
(3011, 0, '190', 202, 1, 9, 1, 599, 4, 1, '2014-05-05 11:15:18', 120),
(3012, 0, '190', 202, 1, 9, 1, 600, 9, 1, '2014-05-05 11:15:19', 120),
(3013, 0, '190', 202, 1, 9, 1, 601, 5, 1, '2014-05-05 11:15:20', 120),
(3014, 0, '190', 202, 1, 9, 1, 602, 6, 1, '2014-05-05 11:15:22', 120),
(3015, 0, '190', 202, 1, 9, 1, 603, 7, 1, '2014-05-05 11:15:23', 120),
(3016, 0, '190', 202, 1, 9, 1, 604, 8, 1, '2014-05-05 11:15:26', 120),
(3017, 0, '190', 202, 1, 10, 1, 299, 4, 1, '2014-05-05 11:15:27', 120),
(3018, 0, '190', 202, 1, 10, 1, 300, 5, 1, '2014-05-05 11:15:28', 120),
(3019, 0, '190', 202, 1, 10, 1, 301, 6, 1, '2014-05-05 11:15:30', 120),
(3020, 0, '190', 202, 1, 10, 1, 302, 7, 1, '2014-05-05 11:15:31', 120),
(3021, 0, '190', 202, 1, 10, 1, 303, 8, 1, '2014-05-05 11:15:33', 120),
(3022, 0, '190', 202, 1, 12, 1, 151, 4, 1, '2014-05-05 11:15:35', 120),
(3023, 0, '190', 202, 1, 13, 1, 459, 4, 1, '2014-05-05 11:15:37', 120),
(3024, 0, '190', 202, 1, 13, 1, 460, 5, 1, '2014-05-05 11:15:38', 120),
(3025, 0, '190', 202, 1, 13, 1, 461, 6, 1, '2014-05-05 11:15:41', 120),
(3026, 0, '190', 202, 1, 14, 1, 77, 4, 1, '2014-05-05 11:15:43', 120),
(3027, 0, '190', 202, 1, 14, 1, 78, 5, 1, '2014-05-05 11:15:45', 120),
(3028, 0, '190', 202, 1, 15, 1, 99, 4, 1, '2014-05-05 11:15:46', 120),
(3029, 5, '190', 202, 1, 10, 1, 304, 9, 0, '2014-05-07 05:10:45', 120),
(3030, 6, '190', 202, 1, 8, 1, 417, 9, 1, '2014-05-05 11:18:05', 120),
(3031, 7, '190', 202, 1, 9, 1, 605, 10, 1, '2014-05-05 11:18:06', 120),
(3032, 8, '190', 202, 1, 10, 1, 305, 10, 0, '2014-05-05 11:20:27', 120),
(3033, 9, '190', 202, 1, 8, 1, 418, 10, 1, '2014-05-05 11:18:43', 120),
(3034, 10, '190', 202, 1, 9, 1, 606, 11, 1, '2014-05-05 11:18:43', 120),
(3035, 11, '190', 202, 1, 5, 1, 936, 6, 1, '2014-05-05 11:19:11', 120),
(3036, 12, '190', 202, 1, 10, 1, 306, 11, 1, '2014-05-05 11:19:29', 120),
(3037, 13, '190', 202, 1, 8, 1, 419, 11, 1, '2014-05-05 11:19:29', 120),
(3038, 14, '190', 202, 1, 9, 1, 607, 12, 1, '2014-05-05 11:19:29', 120),
(3039, 15, '190', 202, 1, 10, 3, 305, 10, 0, '2014-05-05 11:20:27', 120),
(3040, 16, '190', 202, 1, 10, 1, 307, 12, 1, '2014-05-05 11:20:48', 120),
(3041, 17, '190', 202, 1, 8, 1, 420, 12, 1, '2014-05-05 11:20:50', 120),
(3042, 18, '190', 202, 1, 9, 1, 608, 13, 1, '2014-05-05 11:20:50', 120),
(3043, 19, '190', 202, 1, 10, 1, 308, 13, 1, '2014-05-05 11:21:31', 120),
(3044, 20, '190', 202, 1, 8, 1, 421, 13, 1, '2014-05-05 11:21:31', 120),
(3045, 21, '190', 202, 1, 9, 1, 609, 14, 1, '2014-05-05 11:21:31', 120),
(3046, 22, '190', 202, 1, 6, 1, 36, 1, 0, '2014-05-07 00:13:27', 120),
(3047, 23, '190', 202, 1, 17, 1, 48, 1, 0, '2014-05-05 13:04:25', 120),
(3048, 24, '190', 202, 1, 17, 1, 49, 2, 0, '2014-05-05 11:43:39', 120),
(3049, 25, '190', 202, 1, 17, 3, 49, 2, 0, '2014-05-05 11:43:39', 120),
(3050, 26, '190', 202, 1, 18, 1, 33, 1, 0, '2014-05-05 12:01:00', 120),
(3051, 27, '190', 202, 1, 17, 2, 50, 1, 0, '2014-05-07 04:19:40', 120),
(3052, 28, '190', 202, 1, 18, 1, 34, 2, 0, '2014-05-05 23:01:54', 120),
(3053, 29, '190', 202, 1, 7, 1, 38, 1, 1, '2014-05-05 11:49:18', 120),
(3054, 30, '190', 202, 1, 7, 1, 39, 2, 0, '2014-05-07 00:17:39', 120),
(3055, 31, '190', 202, 1, 18, 1, 35, 3, 0, '2014-05-05 12:01:36', 120),
(3056, 32, '190', 202, 1, 18, 3, 33, 1, 0, '2014-05-05 12:01:00', 120),
(3057, 33, '190', 202, 1, 18, 1, 36, 4, 0, '2014-05-05 12:03:06', 120),
(3058, 34, '190', 202, 1, 18, 3, 35, 3, 0, '2014-05-05 12:01:36', 120),
(3059, 35, '190', 202, 1, 18, 1, 37, 5, 0, '2014-05-05 12:03:42', 120),
(3060, 36, '190', 202, 1, 18, 3, 36, 4, 0, '2014-05-05 12:03:06', 120),
(3061, 37, '190', 202, 1, 18, 1, 38, 6, 0, '2014-05-05 12:03:51', 120),
(3062, 38, '190', 202, 1, 18, 3, 37, 5, 0, '2014-05-05 12:03:42', 120),
(3063, 39, '190', 202, 1, 18, 3, 38, 6, 0, '2014-05-05 12:03:51', 120),
(3064, 40, '190', 202, 1, 17, 2, 51, 1, 0, '2014-05-06 00:55:59', 120),
(3065, 41, '190', 202, 1, 18, 2, 39, 2, 0, '2014-05-07 00:11:14', 120),
(3066, 42, '190', 202, 1, 18, 2, 40, 2, 1, '2014-05-07 02:05:14', 120),
(3067, 43, '190', 202, 1, 18, 1, 41, 7, 1, '2014-05-05 23:13:57', 120),
(3068, 44, '190', 202, 1, 17, 2, 52, 1, 1, '2014-05-06 18:05:41', 120),
(3069, 45, '190', 202, 1, 6, 2, 37, 1, 0, '2014-05-07 00:15:15', 120),
(3070, 46, '190', 202, 1, 6, 2, 38, 1, 1, '2014-05-07 02:05:15', 120),
(3071, 47, '190', 202, 1, 7, 2, 40, 2, 1, '2014-05-07 02:05:39', 120),
(3072, 48, '190', 202, 1, 18, 1, 42, 8, 1, '2014-05-07 01:13:28', 120),
(3073, 49, '190', 202, 1, 6, 1, 39, 2, 1, '2014-05-07 01:32:42', 120),
(3074, 50, '190', 202, 1, 6, 1, 40, 3, 1, '2014-05-07 01:40:48', 120),
(3075, 51, '190', 202, 1, 6, 1, 41, 4, 0, '2014-05-07 01:41:09', 120),
(3076, 52, '190', 202, 1, 6, 3, 41, 4, 0, '2014-05-07 01:41:09', 120),
(3077, 53, '190', 202, 1, 6, 1, 42, 5, 1, '2014-05-07 01:45:31', 120),
(3078, 54, '190', 202, 1, 6, 1, 43, 6, 1, '2014-05-07 01:45:45', 120),
(3079, 55, '190', 202, 1, 1, 1, 112, 1, 1, '2014-05-07 04:21:02', 120),
(3080, 56, '190', 202, 1, 1, 1, 113, 2, 1, '2014-05-07 04:21:16', 120),
(3081, 57, '190', 202, 1, 2, 1, 109, 5, 1, '2014-05-07 04:21:54', 120),
(3082, 58, '190', 202, 1, 12, 1, 152, 5, 1, '2014-05-07 04:22:12', 120),
(3083, 59, '190', 202, 1, 10, 2, 309, 9, 1, '2014-05-06 19:05:45', 120),
(3100, 0, '178', 193, 1, 6, 1, 44, 2, 1, '2014-05-15 02:48:02', 114),
(3101, 1, '178', 193, 1, 7, 1, 41, 1, 1, '2014-05-15 02:59:33', 114),
(3102, 2, '178', 193, 1, 6, 1, 45, 3, 1, '2014-05-15 03:01:03', 114),
(3103, 67, '187', 199, 1, 15, 1, 101, 6, 1, '2014-05-16 06:43:38', 114),
(3104, 68, '187', 199, 1, 6, 1, 46, 2, 1, '2014-05-16 07:00:40', 114),
(3105, 69, '187', 199, 1, 6, 1, 47, 3, 1, '2014-05-16 07:01:01', 114),
(3107, 70, '187', 199, 1, 2, 1, 112, 4, 0, '2014-05-16 11:43:20', 114),
(3108, 71, '187', 199, 1, 3, 1, 56, 5, 1, '2014-05-16 08:45:50', 114),
(3109, 72, '187', 199, 1, 3, 1, 57, 6, 1, '2014-05-16 08:45:50', 114),
(3110, 73, '187', 199, 1, 3, 1, 58, 7, 1, '2014-05-16 08:45:50', 114),
(3111, 74, '187', 199, 1, 7, 1, 42, 5, 1, '2014-05-16 11:40:39', 114),
(3112, 75, '187', 199, 1, 7, 1, 43, 6, 1, '2014-05-16 11:40:48', 114),
(3113, 76, '187', 199, 1, 7, 1, 44, 7, 1, '2014-05-16 11:40:59', 114),
(3114, 77, '187', 199, 1, 7, 1, 45, 8, 1, '2014-05-16 11:41:26', 114),
(3115, 78, '187', 199, 1, 2, 1, 113, 5, 0, '2014-05-16 11:43:17', 114),
(3116, 79, '187', 199, 1, 3, 1, 59, 8, 1, '2014-05-16 11:41:36', 114),
(3117, 80, '187', 199, 1, 2, 3, 113, 5, 0, '2014-05-16 11:43:17', 114),
(3118, 81, '187', 199, 1, 2, 3, 112, 4, 0, '2014-05-16 11:43:20', 114),
(3119, 82, '187', 199, 1, 2, 1, 114, 6, 0, '2014-05-16 11:46:10', 114),
(3120, 83, '187', 199, 1, 3, 1, 60, 9, 1, '2014-05-16 11:43:26', 114),
(3121, 84, '187', 199, 1, 2, 1, 115, 7, 0, '2014-05-16 11:46:06', 114),
(3122, 85, '187', 199, 1, 3, 1, 61, 10, 1, '2014-05-16 11:45:43', 114),
(3123, 86, '187', 199, 1, 2, 3, 115, 7, 0, '2014-05-16 11:46:06', 114),
(3124, 87, '187', 199, 1, 2, 3, 114, 6, 0, '2014-05-16 11:46:10', 114),
(3125, 88, '187', 199, 1, 2, 1, 116, 8, 0, '2014-05-16 12:19:00', 114),
(3126, 89, '187', 199, 1, 3, 1, 62, 11, 1, '2014-05-16 11:58:21', 114),
(3127, 90, '187', 199, 1, 2, 1, 117, 9, 0, '2014-05-16 12:18:57', 114),
(3128, 91, '187', 199, 1, 2, 1, 118, 10, 0, '2014-05-16 12:18:54', 114),
(3129, 92, '187', 199, 1, 2, 3, 118, 10, 0, '2014-05-16 12:18:54', 114),
(3130, 93, '187', 199, 1, 2, 3, 117, 9, 0, '2014-05-16 12:18:57', 114),
(3131, 94, '187', 199, 1, 2, 3, 116, 8, 0, '2014-05-16 12:19:00', 114),
(3132, 95, '187', 199, 1, 2, 1, 119, 11, 1, '2014-05-16 12:19:08', 114),
(3133, 96, '187', 199, 1, 3, 1, 63, 12, 1, '2014-05-16 12:19:08', 114),
(3134, 97, '187', 199, 1, 3, 1, 64, 13, 1, '2014-05-16 12:19:08', 114),
(3135, 98, '187', 199, 1, 3, 1, 65, 14, 1, '2014-05-16 12:19:08', 114),
(3136, 99, '187', 199, 1, 3, 1, 66, 15, 1, '2014-05-16 12:19:08', 114),
(3137, 3, '178', 193, 1, 5, 1, 937, 2, 1, '2014-05-17 02:58:33', 114),
(3138, 4, '178', 193, 1, 4, 1, 245, 2, 1, '2014-05-17 02:58:59', 114),
(3139, 5, '178', 193, 1, 10, 1, 310, 2, 1, '2014-05-17 02:59:12', 114),
(3140, 6, '178', 193, 1, 8, 1, 422, 2, 1, '2014-05-17 02:59:12', 114),
(3141, 7, '178', 193, 1, 9, 1, 610, 2, 1, '2014-05-17 02:59:12', 114),
(3313, 0, '192', 203, 1, 13, 1, 468, 1, 1, '2014-05-18 03:58:25', 113),
(3314, 1, '192', 203, 1, 13, 1, 469, 2, 1, '2014-05-18 03:58:25', 113),
(3315, 2, '192', 203, 1, 13, 1, 470, 3, 1, '2014-05-18 03:58:25', 113),
(3316, 3, '192', 203, 1, 4, 1, 249, 1, 1, '2014-05-18 03:58:25', 113),
(3317, 4, '192', 203, 1, 5, 1, 941, 1, 1, '2014-05-18 03:58:25', 113),
(3318, 5, '192', 203, 1, 6, 1, 49, 1, 1, '2014-05-18 03:58:41', 113),
(3319, 6, '192', 203, 1, 7, 1, 48, 1, 1, '2014-05-18 03:58:56', 113),
(3320, 7, '192', 203, 1, 7, 1, 49, 2, 1, '2014-05-18 03:59:09', 113),
(3321, 8, '192', 203, 1, 2, 1, 122, 1, 1, '2014-05-18 03:59:19', 113),
(3322, 9, '192', 203, 1, 3, 1, 71, 1, 1, '2014-05-18 03:59:19', 113),
(3323, 10, '192', 203, 1, 3, 1, 72, 2, 1, '2014-05-18 03:59:20', 113),
(3324, 11, '192', 203, 1, 1, 1, 120, 1, 1, '2014-05-18 04:09:26', 113),
(3325, 12, '192', 203, 1, 12, 1, 157, 1, 1, '2014-05-18 04:09:50', 113),
(3326, 13, '192', 203, 1, 10, 1, 317, 1, 0, '2014-05-18 04:15:51', 113),
(3327, 14, '192', 203, 1, 8, 1, 440, 1, 1, '2014-05-18 04:10:24', 113),
(3328, 15, '192', 203, 1, 9, 1, 694, 1, 1, '2014-05-18 04:10:25', 113),
(3329, 16, '192', 203, 1, 10, 3, 317, 1, 0, '2014-05-18 04:15:51', 113),
(3330, 17, '192', 203, 1, 10, 1, 318, 2, 1, '2014-05-18 04:16:10', 113),
(3331, 18, '192', 203, 1, 8, 1, 441, 2, 1, '2014-05-18 04:16:10', 113),
(3332, 19, '192', 203, 1, 9, 1, 695, 2, 0, '2014-05-18 04:17:28', 113),
(3333, 20, '192', 203, 1, 10, 1, 319, 3, 1, '2014-05-18 04:16:42', 113),
(3334, 21, '192', 203, 1, 8, 1, 442, 3, 1, '2014-05-18 04:16:43', 113),
(3335, 22, '192', 203, 1, 9, 1, 696, 3, 1, '2014-05-18 04:16:43', 113),
(3336, 23, '192', 203, 1, 9, 2, 697, 2, 1, '2014-05-18 04:17:28', 113),
(3337, 24, '192', 203, 1, 15, 1, 104, 1, 1, '2014-05-18 04:17:38', 113),
(3338, 25, '192', 203, 1, 16, 1, 73, 1, 1, '2014-05-18 04:17:42', 113),
(3339, 26, '192', 203, 1, 14, 1, 83, 1, 1, '2014-05-18 04:17:46', 113),
(3340, 27, '192', 203, 1, 9, 1, 698, 4, 0, '2014-05-18 04:18:15', 113),
(3341, 28, '192', 203, 1, 9, 2, 699, 4, 1, '2014-05-18 04:18:15', 113),
(3342, 29, '192', 203, 1, 9, 1, 700, 5, 0, '2014-05-18 04:18:36', 113),
(3343, 30, '192', 203, 1, 9, 2, 701, 5, 1, '2014-05-18 04:18:36', 113),
(3344, 31, '192', 203, 1, 8, 1, 443, 4, 1, '2014-05-18 04:18:45', 113),
(3345, 32, '192', 203, 1, 9, 1, 702, 6, 0, '2014-05-18 04:19:13', 113),
(3346, 33, '192', 203, 1, 9, 2, 703, 6, 1, '2014-05-18 04:19:13', 113),
(3347, 34, '192', 203, 1, 9, 1, 704, 7, 0, '2014-05-18 04:19:39', 113),
(3348, 35, '192', 203, 1, 9, 2, 705, 7, 1, '2014-05-18 04:19:39', 113),
(3349, 0, '193', 203, 1, 1, 1, 121, 1, 1, '2014-05-18 04:20:11', 113),
(3350, 0, '193', 203, 1, 2, 1, 123, 1, 1, '2014-05-18 04:20:11', 113),
(3351, 0, '193', 203, 1, 3, 1, 73, 1, 1, '2014-05-18 04:20:12', 113),
(3352, 0, '193', 203, 1, 3, 1, 74, 2, 1, '2014-05-18 04:20:12', 113),
(3353, 0, '193', 203, 1, 4, 1, 250, 1, 1, '2014-05-18 04:20:12', 113),
(3354, 0, '193', 203, 1, 5, 1, 942, 1, 1, '2014-05-18 04:20:12', 113),
(3355, 0, '193', 203, 1, 6, 1, 50, 1, 1, '2014-05-18 04:20:13', 113),
(3356, 0, '193', 203, 1, 7, 1, 50, 1, 1, '2014-05-18 04:20:13', 113),
(3357, 0, '193', 203, 1, 7, 1, 51, 2, 1, '2014-05-18 04:20:13', 113),
(3358, 0, '193', 203, 1, 8, 1, 444, 1, 1, '2014-05-18 04:20:13', 113),
(3359, 0, '193', 203, 1, 8, 1, 445, 2, 1, '2014-05-18 04:20:14', 113),
(3360, 0, '193', 203, 1, 8, 1, 446, 4, 1, '2014-05-18 04:20:14', 113),
(3361, 0, '193', 203, 1, 8, 1, 447, 3, 1, '2014-05-18 04:20:14', 113),
(3362, 0, '193', 203, 1, 9, 1, 706, 1, 1, '2014-05-18 04:20:14', 113),
(3363, 0, '193', 203, 1, 9, 1, 707, 2, 1, '2014-05-18 04:20:14', 113),
(3364, 0, '193', 203, 1, 9, 1, 708, 4, 1, '2014-05-18 04:20:15', 113),
(3365, 0, '193', 203, 1, 9, 1, 709, 5, 1, '2014-05-18 04:20:15', 113),
(3366, 0, '193', 203, 1, 9, 1, 710, 3, 1, '2014-05-18 04:20:15', 113),
(3367, 0, '193', 203, 1, 9, 1, 711, 6, 1, '2014-05-18 04:20:15', 113),
(3368, 0, '193', 203, 1, 9, 1, 712, 7, 1, '2014-05-18 04:20:15', 113),
(3369, 0, '193', 203, 1, 10, 1, 320, 2, 1, '2014-05-18 04:20:16', 113),
(3370, 0, '193', 203, 1, 10, 1, 321, 3, 1, '2014-05-18 04:20:16', 113),
(3371, 0, '193', 203, 1, 12, 1, 158, 1, 0, '2014-05-19 08:55:25', 113),
(3372, 0, '193', 203, 1, 13, 1, 471, 1, 1, '2014-05-18 04:20:16', 113),
(3373, 0, '193', 203, 1, 13, 1, 472, 2, 1, '2014-05-18 04:20:17', 113),
(3374, 0, '193', 203, 1, 13, 1, 473, 3, 1, '2014-05-18 04:20:17', 113),
(3375, 0, '193', 203, 1, 14, 1, 84, 1, 1, '2014-05-18 04:20:17', 113),
(3376, 0, '193', 203, 1, 15, 1, 105, 1, 1, '2014-05-18 04:20:17', 113),
(3377, 0, '193', 203, 1, 16, 1, 74, 1, 1, '2014-05-18 04:20:17', 113),
(3378, 1, '193', 203, 1, 5, 1, 943, 2, 1, '2014-05-18 12:40:22', 113),
(3379, 2, '193', 203, 1, 10, 1, 322, 4, 1, '2014-05-18 12:40:38', 113),
(3380, 3, '193', 203, 1, 8, 1, 448, 5, 1, '2014-05-18 12:40:38', 113),
(3381, 4, '193', 203, 1, 9, 1, 713, 8, 1, '2014-05-18 12:40:38', 113),
(3382, 5, '193', 203, 1, 5, 1, 944, 3, 1, '2014-05-18 12:43:24', 113),
(3383, 6, '193', 203, 1, 15, 1, 106, 2, 1, '2014-05-19 08:55:11', 113),
(3384, 7, '193', 203, 1, 12, 2, 159, 1, 0, '2014-05-19 08:55:35', 113),
(3385, 8, '193', 203, 1, 12, 2, 160, 1, 0, '2014-06-06 00:49:55', 113),
(3386, 9, '193', 203, 1, 1, 3, 122, 2, 0, '2014-05-19 08:56:09', 113),
(3387, 10, '193', 203, 1, 16, 1, 75, 2, 1, '2014-05-19 08:56:10', 113),
(3388, 11, '193', 203, 1, 2, 3, 124, 2, 0, '2014-05-19 08:56:17', 113),
(3389, 12, '193', 203, 1, 14, 1, 85, 2, 1, '2014-05-19 08:56:18', 113),
(3390, 13, '193', 203, 1, 1, 1, 123, 3, 0, '2014-05-19 09:06:34', 113),
(3391, 14, '193', 203, 1, 16, 1, 76, 3, 1, '2014-05-19 09:06:03', 113),
(3392, 15, '193', 203, 1, 2, 1, 125, 3, 0, '2014-05-19 09:07:20', 113),
(3393, 16, '193', 203, 1, 14, 1, 86, 3, 1, '2014-05-19 09:06:11', 113),
(3394, 17, '193', 203, 1, 1, 2, 124, 3, 0, '2014-05-19 09:06:48', 113),
(3395, 18, '193', 203, 1, 1, 2, 125, 3, 1, '2014-05-19 09:06:48', 113),
(3396, 19, '193', 203, 1, 3, 1, 75, 3, 1, '2014-05-19 09:07:06', 113),
(3397, 20, '193', 203, 1, 2, 2, 126, 3, 1, '2014-05-19 09:07:20', 113),
(3398, 48, '165', 184, 1, 1, 1, 126, 4, 0, '2014-05-21 06:51:11', 113),
(3399, 49, '165', 184, 1, 16, 1, 77, 2, 0, '2014-05-21 06:35:32', 113),
(3400, 50, '165', 184, 1, 16, 3, 77, 2, 0, '2014-05-21 06:35:32', 113),
(3401, 51, '165', 184, 1, 1, 1, 127, 5, 0, '2014-05-21 06:51:14', 113),
(3402, 52, '165', 184, 1, 16, 1, 78, 3, 0, '2014-05-21 06:37:58', 113),
(3403, 53, '165', 184, 1, 16, 3, 78, 3, 0, '2014-05-21 06:37:58', 113),
(3404, 54, '165', 184, 1, 1, 1, 128, 6, 0, '2014-05-21 06:51:17', 113),
(3405, 55, '165', 184, 1, 16, 1, 79, 4, 0, '2014-05-21 06:38:54', 113),
(3406, 56, '165', 184, 1, 16, 3, 79, 4, 0, '2014-05-21 06:38:54', 113),
(3407, 57, '165', 184, 1, 1, 1, 129, 7, 0, '2014-05-21 06:51:21', 113),
(3408, 58, '165', 184, 1, 16, 1, 80, 5, 0, '2014-05-21 06:39:43', 113),
(3409, 59, '165', 184, 1, 16, 3, 80, 5, 0, '2014-05-21 06:39:43', 113),
(3410, 60, '165', 184, 1, 1, 1, 130, 8, 0, '2014-05-21 06:51:24', 113),
(3411, 61, '165', 184, 1, 16, 1, 81, 6, 0, '2014-05-21 06:41:23', 113),
(3412, 62, '165', 184, 1, 16, 3, 81, 6, 0, '2014-05-21 06:41:23', 113),
(3413, 63, '165', 184, 1, 1, 1, 131, 9, 0, '2014-05-21 06:51:08', 113),
(3414, 64, '165', 184, 1, 16, 1, 82, 7, 0, '2014-05-21 06:43:09', 113),
(3415, 65, '165', 184, 1, 16, 3, 82, 7, 0, '2014-05-21 06:43:09', 113),
(3416, 66, '165', 184, 1, 12, 1, 161, 2, 0, '2014-05-21 06:51:36', 113),
(3417, 67, '165', 184, 1, 15, 1, 107, 2, 0, '2014-05-21 06:46:16', 113),
(3418, 68, '165', 184, 1, 1, 1, 132, 10, 0, '2014-05-21 06:51:05', 113),
(3419, 69, '165', 184, 1, 16, 1, 83, 8, 0, '2014-05-21 06:46:19', 113),
(3420, 70, '165', 184, 1, 2, 1, 127, 2, 0, '2014-05-21 06:51:31', 113),
(3421, 71, '165', 184, 1, 14, 1, 87, 1, 0, '2014-05-21 06:46:21', 113),
(3422, 72, '165', 184, 1, 15, 3, 107, 2, 0, '2014-05-21 06:46:16', 113),
(3423, 73, '165', 184, 1, 16, 3, 83, 8, 0, '2014-05-21 06:46:19', 113),
(3424, 74, '165', 184, 1, 14, 3, 87, 1, 0, '2014-05-21 06:46:21', 113),
(3425, 75, '165', 184, 1, 1, 3, 132, 10, 0, '2014-05-21 06:51:06', 113),
(3426, 76, '165', 184, 1, 1, 3, 131, 9, 0, '2014-05-21 06:51:08', 113),
(3427, 77, '165', 184, 1, 1, 3, 126, 4, 0, '2014-05-21 06:51:11', 113),
(3428, 78, '165', 184, 1, 1, 3, 127, 5, 0, '2014-05-21 06:51:14', 113),
(3429, 79, '165', 184, 1, 1, 3, 128, 6, 0, '2014-05-21 06:51:17', 113),
(3430, 80, '165', 184, 1, 1, 3, 129, 7, 0, '2014-05-21 06:51:21', 113),
(3431, 81, '165', 184, 1, 1, 3, 130, 8, 0, '2014-05-21 06:51:24', 113),
(3432, 82, '165', 184, 1, 2, 3, 127, 2, 0, '2014-05-21 06:51:31', 113),
(3433, 83, '165', 184, 1, 12, 3, 161, 2, 0, '2014-05-21 06:51:36', 113),
(3434, 84, '165', 184, 1, 17, 1, 57, 1, 1, '2014-05-21 07:48:22', 113),
(3435, 85, '165', 184, 1, 17, 1, 58, 2, 1, '2014-05-21 07:49:42', 113),
(3436, 86, '165', 184, 1, 7, 2, 52, 1, 1, '2014-05-21 08:02:28', 113),
(3437, 87, '165', 184, 1, 1, 2, 133, 1, 1, '2014-05-21 08:16:48', 113),
(3438, 88, '165', 184, 1, 1, 2, 134, 3, 1, '2014-05-21 08:17:44', 113),
(3439, 0, '194', 184, 1, 1, 1, 135, 1, 1, '2014-05-21 11:13:12', 113),
(3440, 0, '194', 184, 1, 1, 1, 136, 3, 1, '2014-05-21 11:13:12', 113),
(3441, 0, '194', 184, 1, 2, 1, 128, 1, 1, '2014-05-21 11:13:13', 113),
(3442, 0, '194', 184, 1, 4, 1, 251, 2, 1, '2014-05-21 11:13:13', 113),
(3443, 0, '194', 184, 1, 4, 1, 252, 1, 1, '2014-05-21 11:13:14', 113),
(3444, 0, '194', 184, 1, 5, 1, 945, 1, 1, '2014-05-21 11:13:14', 113),
(3445, 0, '194', 184, 1, 5, 1, 946, 2, 1, '2014-05-21 11:13:15', 113),
(3446, 0, '194', 184, 1, 5, 1, 947, 3, 1, '2014-05-21 11:13:15', 113),
(3447, 0, '194', 184, 1, 5, 1, 948, 4, 1, '2014-05-21 11:13:16', 113),
(3448, 0, '194', 184, 1, 6, 1, 51, 1, 1, '2014-05-21 11:13:16', 113),
(3449, 0, '194', 184, 1, 6, 1, 52, 2, 1, '2014-05-21 11:13:17', 113),
(3450, 0, '194', 184, 1, 6, 1, 53, 3, 1, '2014-05-21 11:13:17', 113),
(3451, 0, '194', 184, 1, 6, 1, 54, 4, 1, '2014-05-21 11:13:17', 113),
(3452, 0, '194', 184, 1, 6, 1, 55, 5, 1, '2014-05-21 11:13:18', 113),
(3453, 0, '194', 184, 1, 6, 1, 56, 6, 1, '2014-05-21 11:13:18', 113),
(3454, 0, '194', 184, 1, 7, 1, 53, 2, 1, '2014-05-21 11:13:18', 113),
(3455, 0, '194', 184, 1, 7, 1, 54, 3, 1, '2014-05-21 11:13:19', 113),
(3456, 0, '194', 184, 1, 7, 1, 55, 4, 1, '2014-05-21 11:13:19', 113),
(3457, 0, '194', 184, 1, 7, 1, 56, 1, 1, '2014-05-21 11:13:19', 113),
(3458, 0, '194', 184, 1, 8, 1, 449, 1, 1, '2014-05-21 11:13:20', 113),
(3459, 0, '194', 184, 1, 8, 1, 450, 2, 1, '2014-05-21 11:13:21', 113),
(3460, 0, '194', 184, 1, 8, 1, 451, 3, 1, '2014-05-21 11:13:21', 113),
(3461, 0, '194', 184, 1, 8, 1, 452, 4, 1, '2014-05-21 11:13:21', 113),
(3462, 0, '194', 184, 1, 8, 1, 453, 5, 1, '2014-05-21 11:13:22', 113),
(3463, 0, '194', 184, 1, 8, 1, 454, 6, 1, '2014-05-21 11:13:23', 113),
(3464, 0, '194', 184, 1, 8, 1, 455, 7, 1, '2014-05-21 11:13:23', 113),
(3465, 0, '194', 184, 1, 8, 1, 456, 8, 1, '2014-05-21 11:13:23', 113),
(3466, 0, '194', 184, 1, 9, 1, 714, 1, 1, '2014-05-21 11:13:23', 113),
(3467, 0, '194', 184, 1, 9, 1, 715, 2, 1, '2014-05-21 11:13:24', 113),
(3468, 0, '194', 184, 1, 9, 1, 716, 3, 1, '2014-05-21 11:13:24', 113),
(3469, 0, '194', 184, 1, 9, 1, 717, 4, 1, '2014-05-21 11:13:24', 113),
(3470, 0, '194', 184, 1, 9, 1, 718, 5, 1, '2014-05-21 11:13:25', 113),
(3471, 0, '194', 184, 1, 9, 1, 719, 6, 1, '2014-05-21 11:13:25', 113),
(3472, 0, '194', 184, 1, 9, 1, 720, 7, 1, '2014-05-21 11:13:25', 113),
(3473, 0, '194', 184, 1, 9, 1, 721, 8, 0, '2014-05-22 12:40:27', 113),
(3474, 0, '194', 184, 1, 10, 1, 323, 1, 1, '2014-05-21 11:13:26', 113),
(3475, 0, '194', 184, 1, 10, 1, 324, 2, 1, '2014-05-21 11:13:26', 113),
(3476, 0, '194', 184, 1, 10, 1, 325, 3, 1, '2014-05-21 11:13:27', 113),
(3477, 0, '194', 184, 1, 10, 1, 326, 4, 1, '2014-05-21 11:13:27', 113),
(3478, 0, '194', 184, 1, 10, 1, 327, 7, 1, '2014-05-21 11:13:28', 113),
(3479, 0, '194', 184, 1, 10, 1, 328, 8, 1, '2014-05-21 11:13:28', 113),
(3480, 0, '194', 184, 1, 10, 1, 329, 5, 1, '2014-05-21 11:13:28', 113),
(3481, 0, '194', 184, 1, 10, 1, 330, 6, 1, '2014-05-21 11:13:28', 113),
(3482, 0, '194', 184, 1, 12, 1, 162, 1, 0, '2014-06-24 02:34:06', 113),
(3483, 0, '194', 184, 1, 13, 1, 474, 1, 1, '2014-05-21 11:13:29', 113),
(3484, 0, '194', 184, 1, 13, 1, 475, 2, 1, '2014-05-21 11:13:29', 113),
(3485, 0, '194', 184, 1, 13, 1, 476, 3, 1, '2014-05-21 11:13:30', 113),
(3486, 0, '194', 184, 1, 15, 1, 108, 1, 1, '2014-05-21 11:13:30', 113),
(3487, 0, '194', 184, 1, 16, 1, 84, 1, 1, '2014-05-21 11:13:31', 113),
(3488, 0, '194', 184, 1, 17, 1, 59, 1, 1, '2014-05-21 11:13:31', 113),
(3489, 0, '194', 184, 1, 17, 1, 60, 2, 0, '2014-05-23 11:22:12', 113),
(3490, 1, '194', 184, 1, 6, 1, 57, 7, 1, '2014-05-22 06:23:50', 113),
(3491, 2, '194', 184, 1, 6, 1, 58, 8, 1, '2014-05-22 06:23:58', 113),
(3492, 3, '194', 184, 1, 6, 1, 59, 9, 1, '2014-05-22 06:24:04', 113),
(3493, 4, '194', 184, 1, 6, 1, 60, 10, 1, '2014-05-22 06:24:11', 113),
(3494, 5, '194', 184, 1, 6, 1, 61, 11, 1, '2014-05-22 06:24:20', 113),
(3495, 6, '194', 184, 1, 12, 1, 163, 3, 1, '2014-05-22 12:40:23', 113),
(3496, 7, '194', 184, 1, 15, 1, 109, 3, 1, '2014-05-22 12:40:23', 113),
(3497, 8, '194', 184, 1, 9, 2, 722, 8, 1, '2014-05-22 12:40:27', 113),
(3498, 9, '194', 184, 1, 17, 2, 61, 2, 1, '2014-05-23 11:22:12', 113),
(3499, 21, '193', 203, 1, 11, 1, 23, 1, 1, '2014-06-06 00:49:32', 113),
(3500, 22, '193', 203, 1, 12, 2, 164, 1, 1, '2014-06-06 00:49:55', 113),
(3501, 23, '193', 203, 1, 12, 1, 165, 2, 1, '2014-06-06 04:38:11', 113),
(4002, 0, '243', 222, 1, 13, 1, 637, 1, 1, '2014-06-12 08:36:14', 113),
(4003, 1, '243', 222, 1, 13, 1, 638, 2, 1, '2014-06-12 08:36:14', 113),
(4004, 2, '243', 222, 1, 13, 1, 639, 3, 1, '2014-06-12 08:36:14', 113),
(4005, 3, '243', 222, 1, 4, 1, 308, 1, 1, '2014-06-12 08:36:14', 113),
(4006, 4, '243', 222, 1, 5, 1, 1003, 1, 1, '2014-06-12 08:36:15', 113),
(4007, 5, '243', 222, 1, 11, 1, 47, 1, 1, '2014-06-12 11:22:20', 113),
(4008, 6, '243', 222, 1, 11, 1, 48, 2, 0, '2014-06-12 11:25:27', 113),
(4009, 7, '243', 222, 1, 11, 1, 49, 3, 0, '2014-06-12 11:25:29', 113),
(4010, 8, '243', 222, 1, 12, 1, 217, 1, 0, '2014-06-12 11:23:39', 113),
(4011, 9, '243', 222, 1, 12, 2, 218, 1, 1, '2014-06-12 11:23:39', 113),
(4012, 0, '244', 222, 1, 4, 1, 309, 1, 1, '2014-06-12 11:24:24', 113),
(4013, 0, '244', 222, 1, 5, 1, 1004, 1, 1, '2014-06-12 11:24:25', 113),
(4014, 0, '244', 222, 1, 11, 1, 50, 1, 1, '2014-06-12 11:24:25', 113),
(4015, 0, '244', 222, 1, 11, 1, 51, 2, 1, '2014-06-12 11:24:25', 113),
(4016, 0, '244', 222, 1, 11, 1, 52, 3, 1, '2014-06-12 11:24:25', 113),
(4017, 0, '244', 222, 1, 12, 1, 219, 1, 1, '2014-06-12 11:24:26', 113),
(4018, 0, '244', 222, 1, 13, 1, 640, 1, 1, '2014-06-12 11:24:26', 113),
(4019, 0, '244', 222, 1, 13, 1, 641, 2, 1, '2014-06-12 11:24:26', 113),
(4020, 0, '244', 222, 1, 13, 1, 642, 3, 1, '2014-06-12 11:24:26', 113),
(4021, 10, '243', 222, 1, 11, 3, 48, 2, 0, '2014-06-12 11:25:27', 113),
(4022, 11, '243', 222, 1, 11, 3, 49, 3, 0, '2014-06-12 11:25:29', 113),
(4023, 0, '245', 222, 1, 4, 1, 310, 1, 1, '2014-06-12 11:25:43', 113),
(4024, 0, '245', 222, 1, 5, 1, 1005, 1, 1, '2014-06-12 11:25:43', 113),
(4025, 0, '245', 222, 1, 11, 1, 53, 1, 1, '2014-06-12 11:25:43', 113),
(4026, 0, '245', 222, 1, 12, 1, 220, 1, 1, '2014-06-12 11:25:43', 113),
(4027, 0, '245', 222, 1, 13, 1, 643, 1, 1, '2014-06-12 11:25:43', 113),
(4028, 0, '245', 222, 1, 13, 1, 644, 2, 1, '2014-06-12 11:25:44', 113),
(4029, 0, '245', 222, 1, 13, 1, 645, 3, 1, '2014-06-12 11:25:44', 113),
(4030, 12, '243', 222, 1, 10, 1, 386, 1, 1, '2014-06-12 12:03:10', 113),
(4031, 13, '243', 222, 1, 8, 1, 500, 1, 1, '2014-06-12 12:03:10', 113),
(4032, 14, '243', 222, 1, 9, 1, 793, 1, 1, '2014-06-12 12:03:11', 113),
(4033, 15, '243', 222, 1, 10, 1, 387, 2, 1, '2014-06-12 12:03:24', 113),
(4034, 16, '243', 222, 1, 8, 1, 501, 2, 1, '2014-06-12 12:03:24', 113),
(4035, 17, '243', 222, 1, 9, 1, 794, 2, 1, '2014-06-12 12:03:24', 113),
(4036, 0, '246', 222, 1, 4, 1, 311, 1, 1, '2014-06-12 12:03:33', 113),
(4037, 0, '246', 222, 1, 5, 1, 1006, 1, 1, '2014-06-12 12:03:33', 113),
(4038, 0, '246', 222, 1, 8, 1, 502, 1, 1, '2014-06-12 12:03:33', 113),
(4039, 0, '246', 222, 1, 8, 1, 503, 2, 1, '2014-06-12 12:03:34', 113),
(4040, 0, '246', 222, 1, 9, 1, 795, 1, 1, '2014-06-12 12:03:34', 113),
(4041, 0, '246', 222, 1, 9, 1, 796, 2, 1, '2014-06-12 12:03:34', 113),
(4042, 0, '246', 222, 1, 10, 1, 388, 1, 1, '2014-06-12 12:03:34', 113),
(4043, 0, '246', 222, 1, 10, 1, 389, 2, 1, '2014-06-12 12:03:34', 113),
(4044, 0, '246', 222, 1, 11, 1, 54, 1, 1, '2014-06-12 12:03:35', 113),
(4045, 0, '246', 222, 1, 12, 1, 221, 1, 1, '2014-06-12 12:03:35', 113),
(4046, 0, '246', 222, 1, 13, 1, 646, 1, 1, '2014-06-12 12:03:35', 113),
(4047, 0, '246', 222, 1, 13, 1, 647, 2, 1, '2014-06-12 12:03:35', 113),
(4048, 0, '246', 222, 1, 13, 1, 648, 3, 1, '2014-06-12 12:03:36', 113),
(4049, 18, '243', 222, 1, 9, 1, 797, 3, 0, '2014-06-12 13:33:07', 113),
(4050, 19, '243', 222, 1, 9, 2, 798, 3, 1, '2014-06-12 13:33:07', 113),
(4051, 20, '243', 222, 1, 9, 1, 799, 4, 0, '2014-06-12 13:33:17', 113),
(4052, 21, '243', 222, 1, 9, 2, 800, 4, 1, '2014-06-12 13:33:17', 113),
(4053, 22, '243', 222, 1, 9, 1, 801, 5, 0, '2014-06-12 13:33:25', 113),
(4054, 23, '243', 222, 1, 9, 2, 802, 5, 1, '2014-06-12 13:33:25', 113),
(4055, 24, '243', 222, 1, 9, 1, 803, 6, 0, '2014-06-12 13:33:32', 113),
(4056, 25, '243', 222, 1, 9, 2, 804, 6, 1, '2014-06-12 13:33:32', 113),
(4057, 26, '243', 222, 1, 10, 1, 390, 3, 1, '2014-06-12 13:34:10', 113),
(4058, 27, '243', 222, 1, 8, 1, 504, 3, 1, '2014-06-12 13:34:11', 113),
(4059, 28, '243', 222, 1, 9, 1, 805, 7, 1, '2014-06-12 13:34:11', 113),
(4060, 29, '243', 222, 1, 12, 1, 222, 2, 0, '2014-06-12 14:02:24', 113),
(4061, 30, '243', 222, 1, 15, 1, 123, 1, 1, '2014-06-12 14:01:49', 113),
(4062, 31, '243', 222, 1, 11, 1, 55, 4, 1, '2014-06-12 14:02:24', 113),
(4063, 32, '243', 222, 1, 12, 2, 223, 2, 1, '2014-06-12 14:02:24', 113),
(4064, 33, '243', 222, 1, 1, 15, 124, 2, 1, '2014-06-12 14:42:26', 113),
(4065, 34, '243', 222, 1, 1, 15, 125, 3, 1, '2014-06-12 14:42:31', 113),
(4066, 35, '243', 222, 1, 15, 1, 126, 4, 1, '2014-06-12 14:44:03', 113),
(4067, 0, '243', 222, 1, 2, 1, 129, 8, 1, '2014-06-15 23:07:41', 113),
(4068, 0, '243', 222, 1, 4, 1, 312, 8, 1, '2014-06-15 23:07:41', 113),
(4069, 0, '243', 222, 1, 4, 1, 313, 9, 1, '2014-06-15 23:07:42', 113),
(4070, 0, '243', 222, 1, 5, 1, 1007, 9, 1, '2014-06-15 23:07:42', 113),
(4071, 0, '243', 222, 1, 8, 1, 505, 8, 1, '2014-06-15 23:07:42', 113),
(4072, 0, '243', 222, 1, 8, 1, 506, 9, 1, '2014-06-15 23:07:43', 113),
(4073, 0, '243', 222, 1, 8, 1, 507, 10, 1, '2014-06-15 23:07:43', 113),
(4074, 0, '243', 222, 1, 8, 1, 508, 11, 1, '2014-06-15 23:07:43', 113),
(4075, 0, '243', 222, 1, 8, 1, 509, 12, 1, '2014-06-15 23:07:43', 113),
(4076, 0, '243', 222, 1, 9, 1, 806, 9, 1, '2014-06-15 23:07:44', 113),
(4077, 0, '243', 222, 1, 9, 1, 807, 10, 1, '2014-06-15 23:07:44', 113),
(4078, 0, '243', 222, 1, 9, 1, 808, 11, 1, '2014-06-15 23:07:44', 113),
(4079, 0, '243', 222, 1, 9, 1, 809, 12, 1, '2014-06-15 23:07:45', 113),
(4080, 0, '243', 222, 1, 9, 1, 810, 8, 1, '2014-06-15 23:07:45', 113),
(4081, 0, '243', 222, 1, 9, 1, 811, 13, 1, '2014-06-15 23:07:45', 113),
(4082, 0, '243', 222, 1, 10, 1, 391, 8, 1, '2014-06-15 23:07:46', 113),
(4083, 0, '243', 222, 1, 10, 1, 392, 9, 1, '2014-06-15 23:07:46', 113),
(4084, 0, '243', 222, 1, 10, 1, 393, 10, 1, '2014-06-15 23:07:46', 113),
(4085, 0, '243', 222, 1, 10, 1, 394, 11, 1, '2014-06-15 23:07:46', 113),
(4086, 0, '243', 222, 1, 10, 1, 395, 12, 1, '2014-06-15 23:07:47', 113),
(4087, 0, '243', 222, 1, 12, 1, 224, 8, 1, '2014-06-15 23:07:47', 113),
(4088, 0, '243', 222, 1, 13, 1, 649, 8, 1, '2014-06-15 23:07:47', 113),
(4089, 0, '243', 222, 1, 13, 1, 650, 9, 1, '2014-06-15 23:07:48', 113),
(4090, 0, '243', 222, 1, 13, 1, 651, 10, 1, '2014-06-15 23:07:48', 113),
(4091, 0, '243', 222, 1, 14, 1, 88, 8, 1, '2014-06-15 23:07:48', 113),
(4092, 0, '243', 222, 1, 14, 1, 89, 9, 1, '2014-06-15 23:07:48', 113),
(4093, 0, '243', 222, 1, 15, 1, 127, 8, 1, '2014-06-15 23:07:49', 113),
(4112, 0, '250', 226, 1, 4, 1, 316, 1, 1, '2014-06-16 00:22:46', 113),
(4113, 0, '250', 226, 1, 5, 1, 1010, 1, 1, '2014-06-16 00:22:46', 113),
(4114, 0, '250', 226, 1, 8, 1, 512, 1, 1, '2014-06-16 00:22:46', 113),
(4115, 0, '250', 226, 1, 8, 1, 513, 2, 1, '2014-06-16 00:22:46', 113),
(4116, 0, '250', 226, 1, 9, 1, 814, 1, 1, '2014-06-16 00:22:47', 113),
(4117, 0, '250', 226, 1, 9, 1, 815, 2, 1, '2014-06-16 00:22:47', 113),
(4118, 0, '250', 226, 1, 10, 1, 398, 1, 1, '2014-06-16 00:22:47', 113),
(4119, 0, '250', 226, 1, 10, 1, 399, 2, 1, '2014-06-16 00:22:47', 113),
(4120, 0, '250', 226, 1, 11, 1, 57, 1, 1, '2014-06-16 00:22:48', 113),
(4121, 0, '250', 226, 1, 12, 1, 226, 1, 1, '2014-06-16 00:22:48', 113),
(4122, 0, '250', 226, 1, 13, 1, 658, 1, 1, '2014-06-16 00:22:48', 113),
(4123, 0, '250', 226, 1, 13, 1, 659, 2, 1, '2014-06-16 00:22:49', 113),
(4124, 0, '250', 226, 1, 13, 1, 660, 3, 1, '2014-06-16 00:22:49', 113),
(4125, 1, '250', 226, 1, 12, 1, 227, 2, 0, '2014-06-16 03:26:15', 113),
(4126, 2, '250', 226, 1, 11, 1, 58, 2, 1, '2014-06-16 03:26:15', 113),
(4127, 3, '250', 226, 1, 12, 2, 228, 2, 0, '2014-06-16 03:27:33', 113),
(4128, 4, '250', 226, 1, 11, 1, 59, 3, 1, '2014-06-16 03:27:19', 113),
(4129, 5, '250', 226, 1, 12, 2, 229, 2, 0, '2014-06-16 03:27:39', 113),
(4130, 6, '250', 226, 1, 12, 2, 230, 2, 1, '2014-06-16 03:27:39', 113),
(4131, 7, '250', 226, 1, 12, 1, 231, 3, 0, '2014-06-16 03:28:34', 113),
(4132, 8, '250', 226, 1, 11, 1, 60, 4, 1, '2014-06-16 03:28:34', 113),
(4133, 9, '250', 226, 1, 12, 2, 232, 3, 0, '2014-06-16 03:28:57', 113),
(4134, 10, '250', 226, 1, 12, 2, 233, 3, 0, '2014-06-16 03:29:06', 113),
(4135, 11, '250', 226, 1, 11, 1, 61, 5, 1, '2014-06-16 03:29:06', 113),
(4136, 12, '250', 226, 1, 12, 2, 234, 3, 0, '2014-06-16 03:29:16', 113),
(4137, 13, '250', 226, 1, 12, 2, 235, 3, 0, '2014-06-16 03:45:18', 113),
(4138, 14, '250', 226, 1, 11, 1, 62, 6, 1, '2014-06-16 03:45:18', 113),
(4139, 15, '250', 226, 1, 12, 2, 236, 3, 1, '2014-06-16 03:45:18', 113),
(4140, 16, '250', 226, 1, 4, 1, 317, 2, 1, '2014-06-16 12:27:46', 113),
(4141, 17, '250', 226, 1, 4, 1, 318, 3, 0, '2014-06-16 13:32:06', 113),
(4142, 18, '250', 226, 1, 4, 1, 319, 4, 0, '2014-06-16 13:32:18', 113),
(4143, 19, '250', 226, 1, 4, 2, 320, 3, 1, '2014-06-16 13:32:06', 113),
(4144, 20, '250', 226, 1, 4, 2, 321, 4, 1, '2014-06-16 13:32:18', 113),
(4145, 21, '250', 226, 1, 1, 1, 137, 1, 0, '2014-06-25 13:28:08', 113),
(4146, 22, '250', 226, 1, 1, 1, 138, 2, 1, '2014-06-17 02:26:40', 113),
(4147, 23, '250', 226, 1, 16, 1, 85, 1, 0, '2014-06-24 12:28:04', 113),
(4148, 24, '250', 226, 1, 16, 1, 86, 2, 0, '2014-06-24 12:29:29', 113),
(4149, 25, '250', 226, 1, 16, 1, 87, 3, 0, '2014-06-24 12:27:26', 113),
(4150, 26, '250', 226, 1, 2, 1, 130, 1, 1, '2014-06-18 07:24:06', 113),
(4151, 27, '250', 226, 1, 6, 1, 62, 1, 1, '2014-06-18 07:33:55', 113),
(4152, 28, '250', 226, 1, 7, 1, 57, 1, 1, '2014-06-18 07:34:34', 113),
(4153, 29, '250', 226, 1, 17, 1, 62, 1, 1, '2014-06-18 07:37:21', 113),
(4154, 30, '250', 226, 1, 12, 1, 237, 4, 0, '2014-06-18 13:49:46', 113),
(4155, 31, '250', 226, 1, 15, 1, 128, 1, 0, '2014-06-25 12:54:50', 113),
(4156, 32, '250', 226, 1, 12, 2, 238, 4, 0, '2014-06-25 12:51:36', 113),
(4157, 33, '250', 226, 1, 12, 1, 239, 5, 1, '2014-06-18 13:50:46', 113),
(4158, 10, '194', 184, 1, 5, 1, 1011, 5, 1, '2014-06-23 10:58:09', 113),
(4159, 36, '243', 222, 1, 10, 1, 400, 13, 0, '2014-06-23 23:46:37', 113),
(4160, 37, '243', 222, 1, 8, 1, 514, 13, 1, '2014-06-23 13:57:14', 113),
(4161, 38, '243', 222, 1, 9, 1, 816, 14, 1, '2014-06-23 13:57:14', 113),
(4162, 39, '243', 222, 1, 10, 2, 401, 13, 0, '2014-06-23 23:51:28', 113),
(4163, 40, '243', 222, 1, 10, 2, 402, 13, 0, '2014-06-24 00:57:32', 113),
(4164, 41, '243', 222, 1, 10, 2, 403, 13, 0, '2014-06-24 01:00:35', 113),
(4165, 42, '243', 222, 1, 10, 2, 404, 13, 0, '2014-06-24 01:02:17', 113),
(4166, 43, '243', 222, 1, 10, 2, 405, 13, 0, '2014-06-24 01:03:01', 113),
(4167, 44, '243', 222, 1, 10, 2, 406, 13, 1, '2014-06-24 01:03:01', 113),
(4168, 11, '194', 184, 1, 12, 1, 240, 4, 1, '2014-06-24 02:33:41', 113),
(4169, 12, '194', 184, 1, 15, 1, 129, 4, 1, '2014-06-24 02:33:41', 113),
(4170, 13, '194', 184, 1, 12, 3, 162, 1, 0, '2014-06-24 02:34:06', 113),
(4171, 14, '194', 184, 1, 12, 1, 241, 5, 1, '2014-06-24 02:34:32', 113),
(4172, 34, '250', 226, 1, 16, 3, 87, 3, 0, '2014-06-24 12:27:26', 113),
(4173, 35, '250', 226, 1, 16, 3, 85, 1, 0, '2014-06-24 12:28:04', 113),
(4174, 36, '250', 226, 1, 16, 3, 86, 2, 0, '2014-06-24 12:29:29', 113),
(4175, 37, '250', 226, 1, 16, 1, 88, 4, 0, '2014-06-24 13:13:14', 113),
(4176, 38, '250', 226, 1, 15, 1, 130, 2, 0, '2014-06-24 13:10:30', 113),
(4177, 39, '250', 226, 1, 14, 1, 90, 1, 0, '2014-06-24 13:13:08', 113),
(4178, 40, '250', 226, 1, 15, 3, 130, 2, 0, '2014-06-24 13:10:30', 113),
(4179, 41, '250', 226, 1, 14, 3, 90, 1, 0, '2014-06-24 13:13:08', 113),
(4180, 42, '250', 226, 1, 16, 3, 88, 4, 0, '2014-06-24 13:13:14', 113),
(4181, 43, '250', 226, 1, 15, 1, 131, 3, 0, '2014-06-24 13:14:44', 113),
(4182, 44, '250', 226, 1, 16, 1, 89, 5, 0, '2014-06-24 13:14:40', 113),
(4183, 45, '250', 226, 1, 14, 1, 91, 2, 0, '2014-06-24 13:14:49', 113),
(4184, 46, '250', 226, 1, 16, 3, 89, 5, 0, '2014-06-24 13:14:40', 113),
(4185, 47, '250', 226, 1, 15, 3, 131, 3, 0, '2014-06-24 13:14:44', 113),
(4186, 48, '250', 226, 1, 14, 3, 91, 2, 0, '2014-06-24 13:14:49', 113),
(4187, 45, '243', 222, 1, 1, 1, 139, 1, 1, '2014-06-25 11:34:07', 113),
(4188, 49, '250', 226, 1, 16, 1, 90, 6, 0, '2014-06-25 12:54:37', 113),
(4189, 50, '250', 226, 1, 14, 1, 92, 3, 0, '2014-06-25 12:55:12', 113),
(4190, 51, '250', 226, 1, 12, 2, 242, 4, 1, '2014-06-25 12:51:36', 113),
(4191, 52, '250', 226, 1, 16, 3, 90, 6, 0, '2014-06-25 12:54:37', 113),
(4192, 53, '250', 226, 1, 15, 3, 128, 1, 0, '2014-06-25 12:54:50', 113),
(4193, 54, '250', 226, 1, 14, 3, 92, 3, 0, '2014-06-25 12:55:12', 113),
(4194, 55, '250', 226, 1, 9, 1, 817, 3, 1, '2014-06-25 12:55:17', 113),
(4195, 56, '250', 226, 1, 9, 1, 818, 4, 1, '2014-06-25 12:55:18', 113),
(4196, 57, '250', 226, 1, 15, 1, 132, 4, 1, '2014-06-25 12:55:28', 113),
(4197, 58, '250', 226, 1, 16, 1, 91, 7, 1, '2014-06-25 12:55:33', 113),
(4198, 59, '250', 226, 1, 14, 1, 93, 4, 1, '2014-06-25 12:55:37', 113),
(4199, 60, '250', 226, 1, 15, 1, 133, 5, 1, '2014-06-25 13:25:09', 113),
(4200, 61, '250', 226, 1, 1, 2, 140, 1, 1, '2014-06-25 13:28:09', 113),
(4201, 46, '243', 222, 1, 17, 1, 63, 1, 1, '2014-06-25 14:13:14', 113),
(4202, 0, '251', 227, 1, 13, 1, 661, 1, 1, '2014-06-25 23:14:49', 140),
(4203, 1, '251', 227, 1, 13, 1, 662, 2, 1, '2014-06-25 23:14:49', 140),
(4204, 2, '251', 227, 1, 13, 1, 663, 3, 1, '2014-06-25 23:14:49', 140),
(4205, 3, '251', 227, 1, 4, 1, 322, 1, 1, '2014-06-25 23:14:49', 140),
(4206, 4, '251', 227, 1, 5, 1, 1012, 1, 1, '2014-06-25 23:14:49', 140),
(4207, 5, '251', 227, 1, 10, 1, 407, 1, 1, '2014-06-26 04:58:47', 140),
(4208, 6, '251', 227, 1, 8, 1, 515, 1, 1, '2014-06-26 04:58:47', 140),
(4209, 7, '251', 227, 1, 9, 1, 819, 1, 1, '2014-06-26 04:58:47', 140);

-- --------------------------------------------------------

--
-- Table structure for table `walkthrupath`
--

CREATE TABLE IF NOT EXISTS `walkthrupath` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usecase_id` int(11) DEFAULT NULL,
  `release_id` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `preparation` text NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `release_id` (`release_id`),
  KEY `usecase_id` (`usecase_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=97 ;

--
-- Dumping data for table `walkthrupath`
--

INSERT INTO `walkthrupath` (`id`, `usecase_id`, `release_id`, `number`, `name`, `preparation`, `active`) VALUES
(95, 407, 251, 1, 'eou(main)', 'None', 1),
(96, 407, 251, 2, 'eou(main)', 'None', 1);

-- --------------------------------------------------------

--
-- Table structure for table `walkthruresult`
--

CREATE TABLE IF NOT EXISTS `walkthruresult` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `walkthrupath_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `result` tinyint(1) NOT NULL,
  `comments` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `date` (`date`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=33 ;

-- --------------------------------------------------------

--
-- Table structure for table `walkthrustep`
--

CREATE TABLE IF NOT EXISTS `walkthrustep` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `walkthrupath_id` int(11) NOT NULL,
  `number` varchar(30) NOT NULL,
  `action` text NOT NULL,
  `result` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `walkthrupath_id` (`walkthrupath_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=377 ;

--
-- Dumping data for table `walkthrustep`
--

INSERT INTO `walkthrustep` (`id`, `walkthrupath_id`, `number`, `action`, `result`) VALUES
(375, 95, '1', 'Actor action.', 'System result.'),
(376, 96, '1', 'Actor action.', 'System result.');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `actor`
--
ALTER TABLE `actor`
  ADD CONSTRAINT `actor_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `actor_ibfk_2` FOREIGN KEY (`release_id`) REFERENCES `release` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `category_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `category_ibfk_2` FOREIGN KEY (`release_id`) REFERENCES `release` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `flow`
--
ALTER TABLE `flow`
  ADD CONSTRAINT `flow_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `flow_ibfk_2` FOREIGN KEY (`release_id`) REFERENCES `release` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `form`
--
ALTER TABLE `form`
  ADD CONSTRAINT `form_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `form_ibfk_2` FOREIGN KEY (`release_id`) REFERENCES `release` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `formproperty`
--
ALTER TABLE `formproperty`
  ADD CONSTRAINT `formproperty_ibfk_3` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `formproperty_ibfk_4` FOREIGN KEY (`release_id`) REFERENCES `release` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `iface`
--
ALTER TABLE `iface`
  ADD CONSTRAINT `iface_ibfk_3` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `iface_ibfk_4` FOREIGN KEY (`release_id`) REFERENCES `release` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `interfacetype`
--
ALTER TABLE `interfacetype`
  ADD CONSTRAINT `interfacetype_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `interfacetype_ibfk_2` FOREIGN KEY (`release_id`) REFERENCES `release` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `library`
--
ALTER TABLE `library`
  ADD CONSTRAINT `library_ibfk_2` FOREIGN KEY (`owner_id`) REFERENCES `company` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `library_ibfk_3` FOREIGN KEY (`release_id`) REFERENCES `release` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `note`
--
ALTER TABLE `note`
  ADD CONSTRAINT `note_ibfk_1` FOREIGN KEY (`release_id`) REFERENCES `release` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `note_ibfk_2` FOREIGN KEY (`owner_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `object`
--
ALTER TABLE `object`
  ADD CONSTRAINT `object_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `object_ibfk_2` FOREIGN KEY (`release_id`) REFERENCES `release` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `objectproperty`
--
ALTER TABLE `objectproperty`
  ADD CONSTRAINT `objectproperty_ibfk_2` FOREIGN KEY (`release_id`) REFERENCES `release` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `objectproperty_ibfk_3` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `package`
--
ALTER TABLE `package`
  ADD CONSTRAINT `package_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `package_ibfk_2` FOREIGN KEY (`release_id`) REFERENCES `release` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `rule_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rule_ibfk_2` FOREIGN KEY (`release_id`) REFERENCES `release` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `simple`
--
ALTER TABLE `simple`
  ADD CONSTRAINT `simple_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `simple_ibfk_2` FOREIGN KEY (`release_id`) REFERENCES `release` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `step`
--
ALTER TABLE `step`
  ADD CONSTRAINT `step_ibfk_5` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `step_ibfk_6` FOREIGN KEY (`release_id`) REFERENCES `release` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `stepform`
--
ALTER TABLE `stepform`
  ADD CONSTRAINT `stepform_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stepform_ibfk_2` FOREIGN KEY (`release_id`) REFERENCES `release` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `stepiface`
--
ALTER TABLE `stepiface`
  ADD CONSTRAINT `stepiface_ibfk_3` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stepiface_ibfk_4` FOREIGN KEY (`release_id`) REFERENCES `release` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `steprule`
--
ALTER TABLE `steprule`
  ADD CONSTRAINT `steprule_ibfk_6` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `steprule_ibfk_7` FOREIGN KEY (`release_id`) REFERENCES `release` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `testcase`
--
ALTER TABLE `testcase`
  ADD CONSTRAINT `testcase_ibfk_1` FOREIGN KEY (`usecase_id`) REFERENCES `usecase` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `testcase_ibfk_2` FOREIGN KEY (`release_id`) REFERENCES `release` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `testrun_ibfk_1` FOREIGN KEY (`release_id`) REFERENCES `release` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `testrun_ibfk_3` FOREIGN KEY (`testcase_id`) REFERENCES `testcase` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `teststep`
--
ALTER TABLE `teststep`
  ADD CONSTRAINT `teststep_ibfk_1` FOREIGN KEY (`testcase_id`) REFERENCES `testcase` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `usecase`
--
ALTER TABLE `usecase`
  ADD CONSTRAINT `usecase_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usecase_ibfk_2` FOREIGN KEY (`release_id`) REFERENCES `release` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_meta`
--
ALTER TABLE `user_meta`
  ADD CONSTRAINT `user_meta_ibfk_1` FOREIGN KEY (`alert_messages_id`) REFERENCES `messages` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `user_meta_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

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
