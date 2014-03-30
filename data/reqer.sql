-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 30, 2014 at 10:39 PM
-- Server version: 5.5.19
-- PHP Version: 5.3.8

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=127 ;

--
-- Dumping data for table `actor`
--

INSERT INTO `actor` (`id`, `actor_id`, `project_id`, `release_id`, `number`, `name`, `description`, `alias`, `inherits`) VALUES
(113, 1, 139, 104, '1', 'Actor', 'My First Actor', 'Placeholder', -1),
(114, 1, 139, 105, '1', 'Actor', 'My First Actor', 'Placeholder', -1),
(115, 1, 139, 105, '1', 'User', 'Updated now compare', 'Placeholder', -1),
(124, 1, 145, 110, '1', 'Actor', 'My First Actor', 'Placeholder', -1),
(125, 1, 139, 112, '1', 'User', 'Updated now compare', 'Placeholder', -1),
(126, 1, 139, 113, '1', 'User', 'Updated now compare', 'Placeholder', -1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=509 ;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `foreignid`, `name`, `description`, `owner_id`, `companyowner_id`, `type`, `organisationtype`, `trade_id`, `modified_date`) VALUES
(503, NULL, 'Test Company', 'Testing company', 113, -1, 1, 0, 0, '2013-12-12 21:06:54'),
(504, NULL, 'Test Company', 'ouoeuo', 113, 503, 1, 0, 0, '2013-12-12 21:10:26'),
(505, NULL, 'Test Company', 'ouoeuo', 113, 504, 1, 0, 0, '2013-12-12 21:10:57'),
(506, NULL, 'Knowlen Mowlen', 'aoeu', 113, 505, 2, 0, 0, '2013-12-20 06:00:13'),
(507, NULL, 'My Company', 'my company', 114, -1, 1, 0, 0, '2014-03-29 03:32:40'),
(508, NULL, 'Haddergash and Co', 'A company', 114, 507, 2, 1, 0, '2014-03-30 10:35:46');

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
(2, 'Tad', 'Haddergash', '989898989', '89898999', 'tad@billson.com', 0, 114, 507, 508);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=66 ;

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
(65, 507, 'General', 'General');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=218 ;

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
(2, 2, 1, 139, 0, 0, 0, '5337f3920948b1.79428995', 114, '2014-03-30 10:36:02');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=70 ;

--
-- Dumping data for table `form`
--

INSERT INTO `form` (`id`, `form_id`, `number`, `name`, `project_id`, `release_id`) VALUES
(56, 1, '1', 'Test', 139, 104),
(57, 1, '1', 'Test', 139, 105),
(58, 1, '1', 'Test updated.', 139, 105),
(67, 1, '1', 'Test', 145, 110),
(68, 1, '1', 'Test updated.', 139, 112),
(69, 1, '1', 'Test updated.', 139, 113);

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
  PRIMARY KEY (`id`),
  KEY `form_id` (`form_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=95 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=284 ;

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
(283, 3, '0', 'Email', 139, 113);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=827 ;

--
-- Dumping data for table `package`
--

INSERT INTO `package` (`id`, `package_id`, `name`, `stage`, `number`, `project_id`, `release_id`, `budget`, `contract_amount`, `extlink`) VALUES
(814, 1, 'System', 1, 1, 139, 104, '0.00', '0.00', NULL),
(815, 1, 'System', 1, 1, 139, 105, '0.00', '0.00', NULL),
(824, 1, 'System', 1, 1, 145, 110, '0.00', '0.00', NULL),
(825, 1, 'System', 1, 1, 139, 112, '0.00', '0.00', NULL),
(826, 1, 'System', 1, 1, 139, 113, '0.00', '0.00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `photo`
--

CREATE TABLE IF NOT EXISTS `photo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `photo_id` int(11) NOT NULL,
  `file` varchar(60) NOT NULL,
  `project_id` int(11) NOT NULL,
  `release_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `project_id` (`project_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `photo`
--

INSERT INTO `photo` (`id`, `photo_id`, `file`, `project_id`, `release_id`, `user_id`, `create_date`) VALUES
(3, 3, '52d74dda8a85e.png', 47, 0, 113, '2014-01-16 03:11:23');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=146 ;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`id`, `name`, `description`, `company_id`, `budget`, `stage`, `extlink`) VALUES
(139, 'Test', 'Test', 507, '0.00', 1, 'f4f94adf50acb46a9b3a72248afa7bdb'),
(145, 'Copy', 'Copied from ', 507, '0.00', 1, 'c3e047058f909136b4abbd7f1e987b63');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=114 ;

--
-- Dumping data for table `release`
--

INSERT INTO `release` (`id`, `number`, `status`, `project_id`, `create_date`, `create_user`) VALUES
(104, '0.1', 2, 139, '2014-03-30 06:49:21', 114),
(105, '1.1', 2, 139, '2014-03-30 06:49:21', 114),
(110, '0', 1, 145, '2014-03-30 11:11:30', 114),
(112, '2.1', 2, 139, '2014-03-30 06:49:21', 114),
(113, '3.1', 1, 139, '2014-03-30 06:49:21', 114);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=74 ;

--
-- Dumping data for table `rule`
--

INSERT INTO `rule` (`id`, `rule_id`, `number`, `title`, `text`, `project_id`, `release_id`) VALUES
(69, 1, 1, 'Test', 'stub', 139, 104),
(70, 1, 1, 'Test', 'stub', 139, 105),
(71, 1, 1, 'Changed in v2', 'stub aeo', 139, 105),
(72, 1, 1, 'Changed in v2', 'stub aeo', 139, 112),
(73, 1, 1, 'Changed in v2', 'stub aeo', 139, 113);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=316 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=52 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=72 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=53 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=50 ;

--
-- Dumping data for table `testrun`
--

INSERT INTO `testrun` (`id`, `project_id`, `number`, `status`) VALUES
(49, 139, 1, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=141 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=115 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `email`, `password`, `address_id`, `salt`, `username`, `type`, `active`, `company_id`, `admin`, `verify`) VALUES
(113, 'twit', 'twitter', 'twit@test.com', '1a1dc91c907325c69271ddf0c944bc72', NULL, '52aa245e381000.34176327', 'twit@test.com', 1, 1, 505, 0, 0),
(114, 'Bill', 'Other', 'bill@test.com', '1a1dc91c907325c69271ddf0c944bc72', NULL, '53363dae19c183.12004062', 'bill@test.com', 1, 1, 507, 0, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1528 ;

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
(1524, 0, '113', 139, 1, 5, 1, 826, 1, 1, '2014-03-30 11:23:34', 114),
(1525, 0, '113', 139, 1, 13, 1, 281, 1, 1, '2014-03-30 11:23:34', 114),
(1526, 0, '113', 139, 1, 13, 1, 282, 2, 1, '2014-03-30 11:23:35', 114),
(1527, 0, '113', 139, 1, 13, 1, 283, 3, 1, '2014-03-30 11:23:35', 114);

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
  ADD CONSTRAINT `library_ibfk_3` FOREIGN KEY (`release_id`) REFERENCES `release` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `library_ibfk_2` FOREIGN KEY (`owner_id`) REFERENCES `company` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
