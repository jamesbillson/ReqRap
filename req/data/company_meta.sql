-- phpMyAdmin SQL Dump
-- version 4.0.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 31, 2014 at 04:50 PM
-- Server version: 5.5.33
-- PHP Version: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `req`
--

-- --------------------------------------------------------

--
-- Table structure for table `company_meta`
--

CREATE TABLE `company_meta` (
  `company_id` bigint(20) unsigned NOT NULL,
  `meta_name` varchar(250) NOT NULL,
  `meta_value` text NOT NULL,
  KEY `ikEntity` (`company_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
