-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 11, 2014 at 03:54 PM
-- Server version: 5.6.12
-- PHP Version: 5.4.16

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
  `pretest` text,
  `alias` text NOT NULL,
  `inherits` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `project_id` (`project_id`),
  KEY `release_id` (`release_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=245 ;

--
-- Dumping data for table `actor`
--

INSERT INTO `actor` (`id`, `type`, `actor_id`, `project_id`, `release_id`, `number`, `name`, `description`, `pretest`, `alias`, `inherits`) VALUES
(186, 0, 1, 184, 165, '1', 'Member', 'A user who has an account and can access the system.', 'Must be logged in as a member', 'Placeholder', -1),
(187, 0, 2, 184, 165, '2', 'User', 'A public user of the system', 'None', 'Public', -1),
(209, 0, 1, 193, 177, '1', 'Actor', 'My First Actor', NULL, 'Placeholder', -1),
(215, 0, 1, 193, 177, '1', 'Actor', 'My First Actor', NULL, 'Placeholder', -1),
(216, 0, 1, 193, 177, '1', 'Actor', 'My First Actor', NULL, 'Placeholder', -1),
(222, 0, 1, 199, 186, '1', 'Actor', 'My First Actor', NULL, 'Placeholder', -1),
(223, 0, 1, 199, 186, '1', 'User', 'A public user of the system', 'None', 'Placeholder', -1),
(224, 0, 2, 199, 186, '2', 'Member', 'A user with an account on the system', 'Log in as a member', 'Registered User, Account Holder', -1),
(225, 0, 1, 199, 187, '1', 'User', 'A public user of the system', 'None', 'Placeholder', -1),
(226, 0, 2, 199, 187, '2', 'Member', 'A user with an account on the system', 'Log in as a member', 'Registered User, Account Holder', -1),
(227, 0, 1, 184, 165, '1', 'Member', 'A user who has an account and can access the system.', 'Must be logged in as a member', 'Placeholder', -1),
(228, 0, 1, 184, 165, '1', 'Member', 'A user who has an account and can access the system.', 'Must be logged in as a member', 'Placeholder', -1),
(229, 0, 1, 184, 165, '1', 'Member', 'A user who has an account and can access the system.', 'Must be logged in as a member', 'Placeholder', -1),
(230, 0, 1, 184, 165, '1', 'Member', 'A user who has an account and can access the system.', 'Must be logged in as a member', 'Placeholder', -1),
(231, 0, 1, 184, 165, '1', 'Member', 'A user who has an account and can access the system.', 'Must be logged in as a member', 'Placeholder', -1),
(232, 0, 1, 184, 165, '1', 'Member', 'A user who has an account and can access the system.', 'Must be logged in as a member', 'Placeholder', -1),
(233, 0, 1, 184, 165, '1', 'Member', 'A user who has an account and can access the system.', 'Must be logged in as a member', 'Placeholder', -1),
(234, 0, 1, 184, 165, '1', 'Member', 'A user who has an account and can access the system.', 'Must be logged in as a member', 'Placeholder', -1),
(235, 0, 1, 184, 165, '1', 'Member', 'A user who has an account and can access the system.', 'Must be logged in as a member', 'Placeholder', -1),
(236, 0, 1, 184, 165, '1', 'Member', 'A user who has an account and can access the system.', 'Must be logged in as a member', 'Placeholder', 2),
(237, 0, 1, 200, 188, '1', 'Actor', 'My First Actor', NULL, 'Placeholder', -1),
(238, 0, 1, 200, 188, '1', 'Existing actor', 'My First Actor', '', 'Placeholder', -1),
(239, 0, 4, 200, 188, '1', 'User', 'A public user of the system', 'None', 'Placeholder', -1),
(240, 0, 5, 200, 188, '2', 'Member', 'A user with an account on the system', 'Log in as a member', 'Registered User, Account Holder', -1),
(241, 0, 1, 201, 189, '1', 'Actor', 'My First Actor', NULL, 'Placeholder', -1),
(242, 0, 1, 202, 190, '1', 'Actor', 'My First Actor', NULL, 'Placeholder', -1),
(243, 0, 4, 202, 190, '1', 'User', 'A public user of the system', 'None', 'Placeholder', -1),
(244, 0, 5, 202, 190, '2', 'Member', 'A user with an account on the system', 'Log in as a member', 'Registered User, Account Holder', -1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=53 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category_id`, `number`, `name`, `description`, `order`, `project_id`, `release_id`) VALUES
(47, 1, '1', 'Here is a category', 'Its a category', '1.5', 200, 188),
(48, 1, '1', 'Introduction', 'Introduction to the document', '1.5', 202, 190),
(49, 2, '2', 'Background', 'This is a test', '1.5', 202, 190),
(50, 1, '1', 'Introduction', 'Introduction to the document', '0.5', 202, 190),
(51, 1, '1', 'Introduction', 'Introduction to the document is now somewhat longer.', '0.5', 202, 190),
(52, 1, '1', 'Introduction', 'Introduction to the document again', '0.5', 202, 190);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=514 ;

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
(513, NULL, 'Lovely Co', 'Test if I''m admin', 120, -1, 1, 0, 0, '2014-05-05 10:25:53');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `firstname`, `lastname`, `phone`, `mobile`, `email`, `user_id`, `owner_id`, `companyowner_id`, `company_id`) VALUES
(1, 'Bill', 'Knowlen', '099090', '909090', 'bill@test.com', 0, 113, 505, 506),
(2, 'Tad', 'Haddergash', '989898989', '89898999', 'tad@billson.com', 117, 114, 507, 508),
(3, 'Test', 'Contact', '9989', '9090', 'testly@testing.co.uk', 0, 113, 505, 506),
(4, 'Testing', 'Invite', '99', '999', 'invite@test.com', 118, 113, 505, 506);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=91 ;

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
(90, 513, 'General', 'General');

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
  KEY `flow_id` (`flow_id`),
  KEY `project_id` (`project_id`),
  KEY `release_id` (`release_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=422 ;

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
(374, 1, 200, 188, 'Main', 1, 1, 0, 0),
(375, 4, 200, 188, 'Main', 4, 1, 3, 3),
(376, 5, 200, 188, 'Main', 5, 1, 3, 3),
(377, 6, 200, 188, 'Main', 6, 1, 3, 3),
(378, 7, 200, 188, 'Main', 7, 1, 3, 3),
(379, 8, 200, 188, 'Main', 8, 1, 3, 3),
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
(421, 13, 202, 190, 'Main', 13, 1, 0, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `follower`
--

INSERT INTO `follower` (`id`, `contact_id`, `type`, `foreign_key`, `confirmed`, `upload`, `tenderer`, `link`, `modified`, `modified_date`) VALUES
(4, 4, 1, 200, 1, 0, 0, '0', 113, '2014-05-05 05:19:33');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=110 ;

--
-- Dumping data for table `form`
--

INSERT INTO `form` (`id`, `form_id`, `number`, `name`, `project_id`, `release_id`) VALUES
(94, 1, '1', 'Create Account', 199, 186),
(95, 1, '1', 'Create Account', 199, 187),
(96, 1, '1', 'Register Form', 184, 165),
(99, 4, '1', 'Create Account', 200, 188),
(107, 2, '2', 'Forgot Password Form', 199, 187),
(108, 4, '1', 'Create Account', 202, 190),
(109, 5, '2', 'another', 202, 190);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=54 ;

--
-- Dumping data for table `formproperty`
--

INSERT INTO `formproperty` (`id`, `formproperty_id`, `project_id`, `release_id`, `form_id`, `number`, `name`, `description`, `type`, `valid`, `required`) VALUES
(50, 1, 199, 187, 2, 1, 'Email or Username', 'The account email or username is entered for the account requesting a forgot password reset.', 'text', 'Username must be validated with the same rules as creating username. Email must be a valid email format.  Entry is not validated against accounts at the time of submission.', 1),
(51, 2, 199, 187, 1, 1, 'First Name', 'First name of account owner', 'Text', 'must be at least one character between a-z (upper or lower case)', 1),
(52, 3, 199, 187, 1, 2, 'Last Name', 'Account owners last name', 'Text', 'At least one character between a and z (either case)', 1),
(53, 4, 199, 187, 1, 3, 'Email', 'the account holders email address.', 'text', 'valid email address', 1);

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
  `type_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `release_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `type_id` (`type_id`),
  KEY `project_id` (`project_id`),
  KEY `iface_id` (`iface_id`),
  KEY `release_id` (`release_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=155 ;

--
-- Dumping data for table `iface`
--

INSERT INTO `iface` (`id`, `iface_id`, `number`, `name`, `text`, `photo_id`, `type_id`, `project_id`, `release_id`) VALUES
(121, 1, 1, 'Project List', NULL, 0, 1, 184, 165),
(122, 1, 1, 'Create Account', NULL, 0, 1, 199, 186),
(123, 1, 1, 'Create Account', NULL, 0, 1, 199, 187),
(126, 4, 1, 'Create Account', NULL, 0, 1, 200, 188),
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
(144, 5, 2, 'test', 'test', 0, 1, 200, 188),
(145, 4, 1, 'Create Account', NULL, 0, 1, 200, 188),
(146, 3, 3, 'Forgot Password Screen', NULL, 0, 1, 199, 187),
(147, 6, 6, 'Something odd', 'happened', 0, 1, 199, 187),
(148, 4, 4, 'Forgot Password Thank You Screen', NULL, 1, 1, 199, 187),
(149, 7, 7, 'Test', 'Test', 0, 2, 199, 187),
(150, 8, 8, 'test', 'test', 0, 2, 199, 187),
(151, 4, 1, 'Create Account', NULL, 3, 1, 202, 190),
(152, 5, 2, 'Another', 'another', 0, 1, 202, 190),
(153, 4, 1, 'Create Account', NULL, 1, 1, 200, 188),
(154, 4, 1, 'Create Account', NULL, 2, 1, 200, 188);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=462 ;

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
(447, 1, '1', 'Not Classified', 200, 188),
(448, 2, '2', 'Web interface', 200, 188),
(449, 3, '3', 'Email', 200, 188),
(450, 4, '1', 'Not Classified', 200, 188),
(451, 5, '2', 'Web interface', 200, 188),
(452, 6, '3', 'Email', 200, 188),
(453, 1, '1', 'Not Classified', 201, 189),
(454, 2, '2', 'Web interface', 201, 189),
(455, 3, '3', 'Email', 201, 189),
(456, 1, '1', 'Not Classified', 202, 190),
(457, 2, '2', 'Web interface', 202, 190),
(458, 3, '3', 'Email', 202, 190),
(459, 4, '4', 'Not Classified', 202, 190),
(460, 5, '5', 'Web interface', 202, 190),
(461, 6, '6', 'Email', 202, 190);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `library`
--

INSERT INTO `library` (`id`, `name`, `description`, `public`, `release_id`, `owner_id`) VALUES
(9, 'Module for import', 'A test module for import into an existing project.  Could by used to make a new project if you wanted.', 0, 177, 507),
(10, 'Membership Module', 'A Complete set of use cases for creating, managing and accessing a web member account.', 1, 186, 507);

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
  KEY `object_id` (`object_id`),
  KEY `release_id` (`release_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=44 ;

--
-- Dumping data for table `object`
--

INSERT INTO `object` (`id`, `object_id`, `number`, `name`, `description`, `project_id`, `release_id`) VALUES
(19, 1, '1', 'Import test', 'e', 193, 177),
(21, 1, '1', 'Import test', 'e', 193, 177),
(22, 1, '1', 'Import test', 'e', 193, 177),
(26, 1, '1', 'Object', 'A model of a business object', 184, 165),
(27, 2, '2', 'Object Property', 'A property of a Business Object.', 184, 165),
(28, 3, '3', 'Rule', 'A business rule that can be applied to a usecase.', 184, 165),
(29, 4, '4', 'Actor', 'An actor who acts within use cases. May be a person or an external system.', 184, 165),
(30, 5, '5', 'Interface', 'An interface of the system defined with either text or an image.', 184, 165),
(31, 6, '6', 'Form', 'An input form with a number of fields and their associated validations and definitions', 184, 165),
(32, 1, '1', 'Test object', 'Testing', 200, 188),
(35, 1, '1', 'Member Account', 'A member account', 199, 187),
(36, 1, '1', 'oaeu', 'aoeu', 202, 190),
(37, 1, '1', 'Order', 'aoeu make a new version of this', 202, 190),
(38, 1, '2', 'Order', 'aoeu make a new version of this and another', 202, 190),
(39, 2, '3', 'Another', 'two of everything at least', 202, 190),
(40, 3, '1', 'Three', 'Three', 202, 190),
(41, 4, '4', 'Four', 'of', 202, 190),
(42, 5, '6', 'four', 'ou', 202, 190),
(43, 6, '5', 'ouath', 'oeuaoeu', 202, 190);

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
  KEY `object_id` (`object_id`),
  KEY `objectproperty_id` (`objectproperty_id`),
  KEY `release_id` (`release_id`),
  KEY `project_id` (`project_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `objectproperty`
--

INSERT INTO `objectproperty` (`id`, `objectproperty_id`, `project_id`, `release_id`, `number`, `object_id`, `name`, `description`) VALUES
(16, 1, 184, 165, '1', 1, 'Name', 'Name of the Object Property'),
(17, 2, 184, 165, '2', 1, 'Description', 'Description of the Object Property'),
(18, 3, 184, 165, '1', 3, 'Name', 'Name of the Business Rule'),
(19, 4, 184, 165, '2', 3, 'Rule Text', 'The definition of the business rule in a text form.'),
(30, 1, 200, 188, '1', 1, 'First property', 'of the test object'),
(31, 2, 200, 188, '2', 1, 'Two', 'And now there are two'),
(34, 1, 199, 187, '1', 1, 'Username', 'A string used to identify a user, each username is unique.'),
(35, 2, 199, 187, '2', 1, 'First Name', 'The user''s first name.'),
(36, 3, 199, 187, '3', 1, 'Last Name', 'The user''s last name.'),
(37, 4, 199, 187, '4', 1, 'email address', 'The user''s email address.'),
(38, 1, 202, 190, '1', 1, 'Property one', 'the first'),
(39, 2, 202, 190, '2', 1, 'Property two ', 'the second'),
(40, 2, 202, 190, '2', 1, 'Property two ', 'the second updated');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=937 ;

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
(921, 1, 'System', 1, 1, 200, 188, '0.00', '0.00', NULL),
(922, 1, 'Test system', 1, 1, 200, 188, '0.00', '0.00', NULL),
(923, 5, 'Membership', 1, 1, 200, 188, '0.00', '0.00', NULL),
(924, 5, 'Membership import', 1, 1, 200, 188, '0.00', '0.00', NULL),
(925, 5, 'Membership test', 1, 1, 200, 188, '0.00', '0.00', NULL),
(926, 5, 'Membershipaoeu', 1, 1, 200, 188, '0.00', '0.00', NULL),
(927, 5, 'Membershiphh', 1, 1, 200, 188, '0.00', '0.00', NULL),
(928, 1, 'Test system et', 1, 1, 200, 188, '0.00', '0.00', NULL),
(929, 5, 'Membership hhth', 1, 1, 200, 188, '0.00', '0.00', NULL),
(930, 5, 'Membership hhth eeeeee', 1, 1, 200, 188, '0.00', '0.00', NULL),
(931, 5, 'Membership .....aoueaeou', 1, 1, 200, 188, '0.00', '0.00', NULL),
(932, 5, 'Membershipeoueou', 1, 1, 200, 188, '0.00', '0.00', NULL),
(933, 1, 'System', 1, 1, 201, 189, '0.00', '0.00', NULL),
(934, 1, 'System', 1, 1, 202, 190, '0.00', '0.00', NULL),
(935, 5, 'Membership', 1, 2, 202, 190, '0.00', '0.00', NULL),
(936, 6, 'Numbers', 1, 3, 202, 190, '0.00', '0.00', NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `photo`
--

INSERT INTO `photo` (`id`, `photo_id`, `file`, `description`, `project_id`, `release_id`, `user_id`, `create_date`) VALUES
(22, 1, '5366d29252d6e.png', 'Uploaded file with filename freeway_tunnel.png', 199, 187, 114, '2014-05-04 23:51:47'),
(23, 1, '536c93793fbbe.png', 'Uploaded file with filename WG-wine_note2.png', 200, 188, 113, '2014-05-09 08:36:10'),
(24, 2, '536c93c6abbfc.png', 'Uploaded file with filename smart_part.png', 200, 188, 113, '2014-05-09 08:37:27');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=203 ;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`id`, `name`, `description`, `company_id`, `budget`, `stage`, `extlink`) VALUES
(184, 'Reqrap', 'A cloud system for rapidly developing web application requirements.', 505, '0.00', 1, '3fb2cbb25041c763f8a81f07914dd981'),
(193, 'Module', 'import', 507, '0.00', 1, '8492734542034b33a87db95d2fa8c10f'),
(199, 'Membership Module', 'A web member module for inclusion in other projects', 507, '0.00', 1, '5d5ae9f427f2315403eaffae87c22658'),
(200, 'Testing Project', 'Project for testing', 505, '0.00', 1, '3c173720914aace24a7ad9cf63940a6e'),
(201, 'aoeu', 'aoeu', 512, '0.00', 1, '2ba2ac9a53d0960d3df3df188725f5f5'),
(202, 'Test', 'Test', 513, '0.00', 1, '2d28de7f84b042ddeb3548ecc60b5544');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=191 ;

--
-- Dumping data for table `release`
--

INSERT INTO `release` (`id`, `number`, `status`, `project_id`, `create_date`, `create_user`) VALUES
(165, '0.0047', 1, 184, '2014-04-29 20:46:50', 113),
(177, '1', 2, 193, '2014-04-28 03:38:33', 114),
(178, '1.0001', 1, 193, '2014-04-28 03:38:33', 114),
(186, '1', 2, 199, '2014-04-28 07:35:54', 114),
(187, '1.0066', 1, 199, '2014-05-05 00:38:31', 114),
(188, '0.0035', 1, 200, '2014-05-09 08:37:43', 113),
(189, '0.0004', 1, 201, '2014-05-05 05:31:22', 118),
(190, '0.0059', 1, 202, '2014-05-07 05:06:32', 120);

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
  KEY `rule_id` (`rule_id`),
  KEY `release_id` (`release_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=114 ;

--
-- Dumping data for table `rule`
--

INSERT INTO `rule` (`id`, `rule_id`, `number`, `title`, `text`, `project_id`, `release_id`) VALUES
(101, 1, 1, 'Version control', 'All requirements are version controlled. When a requirement is updated, an updated copy of the requirement is saved and set to be ''active'', and the previous version is set to ''inactive''.', 184, 165),
(102, 2, 2, 'Test delete rule', 'This is a sacrificial rule', 184, 165),
(103, 3, 3, 'Number of log on attempts', 'stub', 184, 165),
(109, 1, 1, 'No confirmation message on forgot password thank you.', 'stub', 199, 187),
(110, 1, 1, 'No confirmation message on forgot password thank you.', 'No confirmation message that the email account/user account requested in the password confirmation is correct or not correct is displayed.  The same message is displayed whether or not the details entered are correct.', 199, 187),
(111, 2, 2, 'Password Complexity', 'Passwords must be at least 8 characters with at least one of each of: lower case alphabetic character, upper case alphabetic character and a special character or number.', 199, 187),
(112, 1, 1, 'one', 'one', 202, 190),
(113, 2, 2, 'two', 'two', 202, 190);

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
(31, 1, 200, 188, '1', 1, 'Here''s a requirement', 'Its a requirement'),
(32, 2, 200, 188, '2', 1, 'Another one', 'here'),
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=610 ;

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
(539, 6, 199, 186, 1, 2, 1, 'New step', 'Result'),
(540, 6, 199, 186, 1, 2, 1, 'Actor completes the Create Account Form and submits.', 'System validates form and displays the home page with the logged in status bar.'),
(541, 1, 199, 187, 1, 1, 1, 'Actor clicks on ''Join'' button.', 'System displays Create Account page.'),
(542, 6, 199, 187, 1, 2, 1, 'Actor completes the Create Account Form and submits.', 'System validates form and displays the home page with the logged in status bar.'),
(543, 2, 199, 187, 2, 1, 2, 'Actor action.', 'System result.'),
(544, 3, 199, 187, 3, 1, 2, 'Actor action.', 'System result.'),
(545, 4, 199, 187, 4, 1, 1, 'Actor action.', 'System result.'),
(546, 5, 199, 187, 5, 1, 2, 'Actor action.', 'System result.'),
(547, 7, 184, 165, 7, 1, 1, 'Actor action.', 'System result.'),
(548, 8, 184, 165, 8, 1, 1, 'Actor action.', 'System result.'),
(550, 1, 200, 188, 1, 1, 1, 'Actor action.', 'System result.'),
(551, 4, 200, 188, 4, 1, 4, 'Actor clicks on ''Join'' button.', 'System displays Create Account page.'),
(552, 9, 200, 188, 4, 2, 4, 'Actor completes the Create Account Form and submits.', 'System validates form and displays the home page with the logged in status bar.'),
(553, 5, 200, 188, 5, 1, 5, 'Actor action.', 'System result.'),
(554, 6, 200, 188, 6, 1, 5, 'Actor action.', 'System result.'),
(555, 7, 200, 188, 7, 1, 4, 'Actor action.', 'System result.'),
(556, 8, 200, 188, 8, 1, 5, 'Actor action.', 'System result.'),
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
(609, 14, 202, 190, 13, 1, 4, 'Actor action.', 'System result.');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=79 ;

--
-- Dumping data for table `stepform`
--

INSERT INTO `stepform` (`id`, `stepform_id`, `project_id`, `release_id`, `step_id`, `form_id`) VALUES
(59, 1, 199, 186, 1, 1),
(60, 2, 199, 186, 6, 1),
(61, 1, 199, 187, 1, 1),
(62, 2, 199, 187, 6, 1),
(64, 4, 200, 188, 4, 4),
(65, 5, 200, 188, 9, 4),
(76, 3, 199, 187, 10, 2),
(77, 4, 202, 190, 4, 4),
(78, 5, 202, 190, 9, 4);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=100 ;

--
-- Dumping data for table `stepiface`
--

INSERT INTO `stepiface` (`id`, `stepiface_id`, `project_id`, `release_id`, `step_id`, `iface_id`) VALUES
(85, 1, 184, 165, 5, 1),
(86, 1, 199, 186, 1, 1),
(87, 1, 199, 187, 1, 1),
(89, 4, 200, 188, 4, 4),
(95, 2, 199, 187, 7, 2),
(96, 3, 199, 187, 7, 3),
(97, 4, 199, 187, 10, 4),
(98, 5, 199, 187, 10, 5),
(99, 4, 202, 190, 4, 4);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=69 ;

--
-- Dumping data for table `steprule`
--

INSERT INTO `steprule` (`id`, `steprule_id`, `project_id`, `release_id`, `step_id`, `rule_id`) VALUES
(66, 1, 184, 165, 2, 3),
(68, 1, 199, 187, 10, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=73 ;

--
-- Dumping data for table `testrun`
--

INSERT INTO `testrun` (`id`, `project_id`, `number`, `status`) VALUES
(63, 193, 1, 1),
(69, 199, 1, 1),
(70, 200, 1, 1),
(71, 201, 1, 1),
(72, 202, 1, 1);

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
  KEY `usecase_id` (`usecase_id`),
  KEY `release_id` (`release_id`),
  KEY `project_id` (`project_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=310 ;

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
(261, 1, 200, 188, 1, '4', 1, 'My first use case', 'This usecase describes the process of ...', 'None'),
(262, 4, 200, 188, 5, '3', 1, 'Become a member', 'This usecase describes the process of registering an account on the system and becoming a member', 'None'),
(263, 5, 200, 188, 5, '4', 2, 'Log in', 'This usecase describes the process of a member authenticating themselves and logging on to their account.', 'User must have an account'),
(264, 6, 200, 188, 5, '5', 2, 'Update profile', 'This usecase describes the process of updating their account profile', 'None'),
(265, 7, 200, 188, 5, '6', 1, 'View member only content', 'This usecase describes the process of a user viewing content that is access controlled.', 'None'),
(266, 8, 200, 188, 5, '7', 2, 'Log out', 'This usecase describes the process of member completing their session and logging out of their account.', 'Member must be logged in.'),
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
(309, 9, 202, 190, 1, '1', 4, 'Test', 'This usecase describes the process of testing the roll back', 'None');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=121 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `email`, `password`, `address_id`, `salt`, `username`, `type`, `active`, `company_id`, `admin`, `verify`) VALUES
(113, 'twit', 'twitter', 'twit@test.com', '1a1dc91c907325c69271ddf0c944bc72', NULL, '52aa245e381000.34176327', 'twit@test.com', 1, 1, 505, 0, 0),
(114, 'Bill', 'Other', 'bill@test.com', '1a1dc91c907325c69271ddf0c944bc72', NULL, '53363dae19c183.12004062', 'bill@test.com', 1, 1, 507, 0, 0),
(115, 'abhishek', 'saini', 'abhishek.saini@enukesoftware.com', '3ec22ea7499a4a4f33b2a25ccc925f1e', NULL, '53453125ee0632.72686363', 'abhishek.saini@enukesoftware.com', 1, 1, 509, 0, 0),
(116, 'Ted', 'Haddergash', 'ted@test.com', '1a1dc91c907325c69271ddf0c944bc72', NULL, '534e63289394c3.37189685', 'ted@test.com', 1, 1, 510, 0, 0),
(117, 'Tad', 'Haddergash', 'tad@billson.com', '1a1dc91c907325c69271ddf0c944bc72', NULL, '534e667188da20.00200784', 'tad@billson.com', 1, 1, 511, 0, 0),
(118, 'STH', 'shosreoj', 'invite@test.com', '1a1dc91c907325c69271ddf0c944bc72', NULL, '536706021252e9.84388793', 'invite@test.com', 1, 1, 512, 1, 0),
(119, 'Mark', 'Birglaw', 'employee@test.com', '3d801aa532c1cec3ee82d87a99fdf63f', NULL, '536749af9d0c11.22948007', 'employee@test.com', 0, 1, 512, 0, 0),
(120, 'Admin', 'Check', 'adcheck@test.com', '35f504164d5a963d6a820e71614a4009', NULL, '53674b114862d1.87916714', 'adcheck@test.com', 1, 1, 513, 1, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3088 ;

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
(2621, 31, '165', 184, 1, 1, 1, 101, 1, 1, '2014-04-29 07:25:47', 113),
(2622, 32, '165', 184, 1, 1, 1, 102, 2, 0, '2014-04-29 07:26:36', 113),
(2623, 33, '165', 184, 1, 1, 3, 102, 2, 0, '2014-04-29 07:26:36', 113),
(2624, 34, '165', 184, 1, 1, 1, 103, 3, 1, '2014-04-29 19:15:58', 113),
(2625, 35, '165', 184, 1, 16, 1, 66, 1, 1, '2014-04-29 19:15:58', 113),
(2626, 36, '165', 184, 1, 10, 2, 259, 2, 1, '2014-04-29 19:16:41', 113),
(2627, 37, '165', 184, 1, 6, 1, 26, 1, 1, '2014-04-29 19:34:37', 113),
(2628, 38, '165', 184, 1, 6, 1, 27, 2, 1, '2014-04-29 19:37:14', 113),
(2629, 39, '165', 184, 1, 7, 1, 16, 1, 1, '2014-04-29 20:21:33', 113),
(2630, 40, '165', 184, 1, 7, 1, 17, 2, 1, '2014-04-29 20:22:14', 113),
(2631, 41, '165', 184, 1, 6, 1, 28, 3, 1, '2014-04-29 20:23:28', 113),
(2632, 42, '165', 184, 1, 6, 1, 29, 4, 1, '2014-04-29 20:24:22', 113),
(2633, 43, '165', 184, 1, 7, 1, 18, 3, 1, '2014-04-29 20:38:53', 113),
(2634, 44, '165', 184, 1, 7, 1, 19, 4, 1, '2014-04-29 20:41:21', 113),
(2635, 45, '165', 184, 1, 6, 1, 30, 5, 1, '2014-04-29 20:45:04', 113),
(2636, 46, '165', 184, 1, 6, 1, 31, 6, 1, '2014-04-29 20:46:19', 113),
(2637, 47, '165', 184, 1, 2, 1, 96, 1, 1, '2014-04-29 20:46:50', 113),
(2677, 0, '188', 200, 1, 13, 1, 447, 1, 1, '2014-04-30 00:17:36', 113),
(2678, 1, '188', 200, 1, 13, 1, 448, 2, 1, '2014-04-30 00:17:36', 113),
(2679, 2, '188', 200, 1, 13, 1, 449, 3, 1, '2014-04-30 00:17:36', 113),
(2680, 3, '188', 200, 1, 4, 1, 237, 1, 0, '2014-04-30 00:22:05', 113),
(2681, 4, '188', 200, 1, 5, 1, 921, 1, 0, '2014-04-30 00:22:23', 113),
(2682, 5, '188', 200, 1, 6, 1, 32, 1, 1, '2014-04-30 00:17:52', 113),
(2683, 6, '188', 200, 1, 7, 1, 30, 1, 1, '2014-04-30 00:18:15', 113),
(2684, 7, '188', 200, 1, 7, 1, 31, 2, 1, '2014-04-30 00:19:29', 113),
(2685, 8, '188', 200, 1, 17, 1, 47, 1, 1, '2014-04-30 00:20:10', 113),
(2686, 9, '188', 200, 1, 18, 1, 31, 1, 1, '2014-04-30 00:20:37', 113),
(2687, 10, '188', 200, 1, 18, 1, 32, 2, 1, '2014-04-30 00:20:53', 113),
(2688, 11, '188', 200, 1, 10, 1, 261, 1, 1, '2014-04-30 00:21:35', 113),
(2689, 12, '188', 200, 1, 8, 1, 374, 1, 1, '2014-04-30 00:21:35', 113),
(2690, 13, '188', 200, 1, 9, 1, 550, 1, 1, '2014-04-30 00:21:35', 113),
(2691, 14, '188', 200, 1, 4, 2, 238, 1, 1, '2014-04-30 00:22:05', 113),
(2692, 15, '188', 200, 1, 5, 2, 922, 1, 0, '2014-04-30 00:47:44', 113),
(2693, 0, '188', 200, 1, 2, 1, 99, 7, 1, '2014-04-30 00:22:44', 113),
(2694, 0, '188', 200, 1, 4, 1, 239, 7, 1, '2014-04-30 00:22:45', 113),
(2695, 0, '188', 200, 1, 4, 1, 240, 8, 1, '2014-04-30 00:22:46', 113),
(2696, 0, '188', 200, 1, 5, 1, 923, 8, 1, '2014-04-30 00:22:48', 113),
(2697, 0, '188', 200, 1, 8, 1, 375, 7, 1, '2014-04-30 00:22:49', 113),
(2698, 0, '188', 200, 1, 8, 1, 376, 8, 1, '2014-04-30 00:22:51', 113),
(2699, 0, '188', 200, 1, 8, 1, 377, 9, 1, '2014-04-30 00:22:53', 113),
(2700, 0, '188', 200, 1, 8, 1, 378, 10, 1, '2014-04-30 00:22:55', 113),
(2701, 0, '188', 200, 1, 8, 1, 379, 11, 1, '2014-04-30 00:22:56', 113),
(2702, 0, '188', 200, 1, 9, 1, 551, 7, 1, '2014-04-30 00:22:56', 113),
(2703, 0, '188', 200, 1, 9, 1, 552, 12, 1, '2014-04-30 00:22:57', 113),
(2704, 0, '188', 200, 1, 9, 1, 553, 8, 1, '2014-04-30 00:23:00', 113),
(2705, 0, '188', 200, 1, 9, 1, 554, 9, 1, '2014-04-30 00:23:01', 113),
(2706, 0, '188', 200, 1, 9, 1, 555, 10, 1, '2014-04-30 00:23:02', 113),
(2707, 0, '188', 200, 1, 9, 1, 556, 11, 1, '2014-04-30 00:23:03', 113),
(2708, 0, '188', 200, 1, 10, 1, 262, 7, 1, '2014-04-30 00:23:04', 113),
(2709, 0, '188', 200, 1, 10, 1, 263, 8, 1, '2014-04-30 00:23:05', 113),
(2710, 0, '188', 200, 1, 10, 1, 264, 9, 1, '2014-04-30 00:23:07', 113),
(2711, 0, '188', 200, 1, 10, 1, 265, 10, 1, '2014-04-30 00:23:08', 113),
(2712, 0, '188', 200, 1, 10, 1, 266, 11, 1, '2014-04-30 00:23:09', 113),
(2713, 0, '188', 200, 1, 12, 1, 126, 7, 1, '2014-04-30 00:23:10', 113),
(2714, 0, '188', 200, 1, 13, 1, 450, 7, 1, '2014-04-30 00:23:11', 113),
(2715, 0, '188', 200, 1, 13, 1, 451, 8, 1, '2014-04-30 00:23:12', 113),
(2716, 0, '188', 200, 1, 13, 1, 452, 9, 1, '2014-04-30 00:23:14', 113),
(2717, 0, '188', 200, 1, 14, 1, 64, 7, 1, '2014-04-30 00:23:16', 113),
(2718, 0, '188', 200, 1, 14, 1, 65, 8, 1, '2014-04-30 00:23:19', 113),
(2719, 0, '188', 200, 1, 15, 1, 89, 7, 1, '2014-04-30 00:23:21', 113),
(2720, 16, '188', 200, 1, 5, 2, 924, 5, 0, '2014-04-30 00:23:54', 113),
(2721, 17, '188', 200, 1, 5, 2, 925, 5, 0, '2014-04-30 00:24:38', 113),
(2722, 18, '188', 200, 1, 5, 3, 923, 5, 0, '2014-04-30 00:24:38', 113),
(2723, 19, '188', 200, 1, 5, 2, 926, 5, 0, '2014-04-30 00:25:03', 113),
(2724, 20, '188', 200, 1, 5, 3, 926, 5, 0, '2014-04-30 00:25:03', 113),
(2725, 21, '188', 200, 1, 5, 2, 927, 5, 0, '2014-04-30 00:45:24', 113),
(2726, 22, '188', 200, 1, 5, 3, 927, 5, 0, '2014-04-30 00:45:24', 113),
(2727, 23, '188', 200, 1, 5, 2, 928, 1, 1, '2014-04-30 00:47:44', 113),
(2728, 24, '188', 200, 1, 5, 2, 929, 5, 0, '2014-04-30 00:51:22', 113),
(2729, 25, '188', 200, 1, 5, 2, 930, 5, 0, '2014-04-30 00:51:40', 113),
(2730, 26, '188', 200, 1, 5, 2, 931, 5, 0, '2014-04-30 00:59:34', 113),
(2731, 27, '188', 200, 1, 5, 3, 931, 5, 0, '2014-04-30 00:59:34', 113),
(2732, 28, '188', 200, 1, 5, 2, 932, 5, 1, '2014-04-30 00:59:43', 113),
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
(2980, 29, '188', 200, 1, 12, 1, 144, 5, 1, '2014-05-04 08:40:20', 113),
(2982, 31, '188', 200, 1, 12, 2, 145, 4, 0, '2014-05-09 08:36:54', 113),
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
(3084, 32, '188', 200, 1, 11, 1, 23, 1, 1, '2014-05-09 08:36:10', 113),
(3085, 33, '188', 200, 1, 12, 2, 153, 4, 0, '2014-05-09 08:37:42', 113),
(3086, 34, '188', 200, 1, 11, 1, 24, 2, 1, '2014-05-09 08:37:29', 113),
(3087, 35, '188', 200, 1, 12, 2, 154, 4, 1, '2014-05-09 08:37:43', 113);

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
  ADD CONSTRAINT `usecase_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usecase_ibfk_2` FOREIGN KEY (`release_id`) REFERENCES `release` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
