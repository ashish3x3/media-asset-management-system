-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2014 at 11:34 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `final_28`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `orgId` int(11) unsigned NOT NULL,
  PRIMARY KEY (`cat_id`,`orgId`),
  KEY `fk_category_organisation1_idx` (`orgId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `name`, `orgId`) VALUES
(1, 'asd', 529),
(2, 'asd', 529),
(3, 'sd', 529),
(4, 'jg', 529),
(5, 'jg', 529);

-- --------------------------------------------------------

--
-- Table structure for table `category_has_ou_structure`
--

CREATE TABLE IF NOT EXISTS `category_has_ou_structure` (
  `cat_id` int(11) NOT NULL,
  `id` int(11) unsigned NOT NULL,
  KEY `fk_category_has_ou_structure_ou_structure1_idx` (`id`),
  KEY `fk_category_has_ou_structure_category1_idx` (`cat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category_has_ou_structure`
--

INSERT INTO `category_has_ou_structure` (`cat_id`, `id`) VALUES
(5, 57);

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

CREATE TABLE IF NOT EXISTS `module` (
  `mid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  `orgId` int(11) NOT NULL,
  PRIMARY KEY (`mid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=59 ;

--
-- Dumping data for table `module`
--

INSERT INTO `module` (`mid`, `name`, `description`, `orgId`) VALUES
(54, 'Add asset', 'For adding assets', 529),
(55, 'Check in', 'Downloading requests enabled', 529),
(56, 'Check out', 'Uploading requests enabled', 529),
(57, 'Admin', 'CRUD for user, role, module, tag, category, permission', 529),
(58, 'sfsd', 'dasdasd', 0);

-- --------------------------------------------------------

--
-- Table structure for table `organisation`
--

CREATE TABLE IF NOT EXISTS `organisation` (
  `orgName` text NOT NULL,
  `noEmp` int(5) DEFAULT NULL,
  `phone` int(13) DEFAULT NULL,
  `email` varchar(26) DEFAULT NULL,
  `addr1` varchar(255) DEFAULT NULL,
  `addr2` varchar(255) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `country` varchar(30) DEFAULT NULL,
  `orgType` varchar(30) DEFAULT NULL,
  `description` text,
  `fax` int(10) DEFAULT NULL,
  `orgId` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `validity` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`orgId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=530 ;

--
-- Dumping data for table `organisation`
--

INSERT INTO `organisation` (`orgName`, `noEmp`, `phone`, `email`, `addr1`, `addr2`, `state`, `country`, `orgType`, `description`, `fax`, `orgId`, `validity`) VALUES
('vishnu', NULL, NULL, '', '', '', '', '', '0', '', NULL, 529, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ou_structure`
--

CREATE TABLE IF NOT EXISTS `ou_structure` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `root` int(10) unsigned DEFAULT NULL,
  `lft` int(10) unsigned NOT NULL,
  `rgt` int(10) unsigned NOT NULL,
  `level` smallint(5) unsigned NOT NULL,
  `name` varchar(128) NOT NULL,
  `description` text NOT NULL,
  `orgId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `lft` (`lft`),
  KEY `rgt` (`rgt`),
  KEY `level` (`level`),
  KEY `root` (`root`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=63 ;

--
-- Dumping data for table `ou_structure`
--

INSERT INTO `ou_structure` (`id`, `root`, `lft`, `rgt`, `level`, `name`, `description`, `orgId`) VALUES
(57, 1, 1, 10, 1, 'IITB', 'hello', 0),
(58, 1, 4, 9, 2, 'CDEEP', 'asd', 0),
(59, 1, 2, 3, 2, 'ekShiksha', 'asd', 0),
(61, 1, 5, 6, 3, 'Media Asset Management', '', 0),
(62, 1, 7, 8, 3, 'Concept Tutor', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE IF NOT EXISTS `permissions` (
  `pid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(65) NOT NULL,
  `desc` text,
  `mid` int(11) NOT NULL,
  PRIMARY KEY (`pid`),
  KEY `mid` (`mid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`pid`, `name`, `desc`, `mid`) VALUES
(27, 'asdasd', NULL, 56),
(28, 'asdas', NULL, 57),
(29, 'sadassadd', NULL, 55),
(30, 'asd', NULL, 54),
(31, 'safasf', 'sadasdasd', 56),
(32, 'asdasd', '', 56);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `rid` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `weight` mediumint(9) NOT NULL,
  PRIMARY KEY (`rid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`rid`, `name`, `weight`) VALUES
(31, 'asd', 1),
(32, 'jghj', 1);

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `rid` bigint(20) NOT NULL,
  `pid` int(11) NOT NULL,
  PRIMARY KEY (`pid`),
  KEY `fk_role_has_permissions_permissions1_idx` (`pid`),
  KEY `fk_role_has_permissions_role1_idx` (`rid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `tagId` int(11) NOT NULL AUTO_INCREMENT,
  `tagName` varchar(45) NOT NULL,
  `orgId` int(11) unsigned NOT NULL,
  PRIMARY KEY (`tagId`,`orgId`),
  KEY `fk_tags_organisation1_idx` (`orgId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=50 ;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`tagId`, `tagName`, `orgId`) VALUES
(44, 'sd', 529),
(45, 'sd', 529),
(46, 'sd', 529),
(47, 'dfg', 529),
(48, 'dfg', 529),
(49, 'dfdrg', 529);

-- --------------------------------------------------------

--
-- Table structure for table `tags_has_ou_structure`
--

CREATE TABLE IF NOT EXISTS `tags_has_ou_structure` (
  `id` int(11) unsigned NOT NULL,
  `tagId` int(11) NOT NULL,
  KEY `fk_ou_structure_has_tags_tags1_idx` (`tagId`),
  KEY `fk_ou_structure_has_tags_ou_structure1_idx` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tags_has_ou_structure`
--

INSERT INTO `tags_has_ou_structure` (`id`, `tagId`) VALUES
(59, 45),
(60, 45),
(57, 48),
(57, 49),
(58, 49);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `password` text NOT NULL,
  `email` varchar(60) NOT NULL,
  `login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `logout` timestamp NULL DEFAULT NULL,
  `status` varchar(60) DEFAULT NULL,
  `picture` blob,
  `mobile` varchar(45) DEFAULT NULL,
  `quota` int(11) DEFAULT NULL,
  `DateCreated` datetime NOT NULL,
  `LastUpdate` timestamp NULL DEFAULT NULL,
  `orgId` int(11) unsigned NOT NULL,
  PRIMARY KEY (`uid`),
  KEY `fk_users_organisation1_idx` (`orgId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=53 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `name`, `password`, `email`, `login`, `logout`, `status`, `picture`, `mobile`, `quota`, `DateCreated`, `LastUpdate`, `orgId`) VALUES
(48, 'vishnu', 'saPPmoXIbs91M', '', '2014-06-03 05:52:27', NULL, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', NULL, 529),
(49, 'vishnus', 'sadgC/1v9zmic', 'vish@gmail.com', '2014-06-03 09:10:13', NULL, '', NULL, 'dssadasd', NULL, '0000-00-00 00:00:00', NULL, 529),
(50, 'vishnus', 'sadgC/1v9zmic', 'vish@gmail.com', '2014-06-03 09:10:23', NULL, '', NULL, '98990809', NULL, '0000-00-00 00:00:00', NULL, 529),
(51, 'vishnus', 'sadgC/1v9zmic', 'vish@gmail.com', '2014-06-03 09:10:27', NULL, '0', NULL, '98990809', NULL, '0000-00-00 00:00:00', NULL, 529),
(52, 'vishnus', 'sadgC/1v9zmic', 'vish@gmail.com', '2014-06-03 09:10:28', NULL, '0', NULL, '98990809', NULL, '0000-00-00 00:00:00', NULL, 529);

-- --------------------------------------------------------

--
-- Table structure for table `users_has_role`
--

CREATE TABLE IF NOT EXISTS `users_has_role` (
  `users_uid` int(11) NOT NULL,
  `role_rid` bigint(20) NOT NULL,
  KEY `fk_users_has_role_role1_idx` (`role_rid`),
  KEY `fk_users_has_role_users_idx` (`users_uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_has_role`
--

INSERT INTO `users_has_role` (`users_uid`, `role_rid`) VALUES
(50, 31),
(51, 31),
(51, 32),
(52, 31),
(52, 32);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `fk_category_organisation1` FOREIGN KEY (`orgId`) REFERENCES `organisation` (`orgId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `fk_role_has_permissions_permissions1` FOREIGN KEY (`pid`) REFERENCES `permissions` (`pid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_role_has_permissions_role1` FOREIGN KEY (`rid`) REFERENCES `role` (`rid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tags`
--
ALTER TABLE `tags`
  ADD CONSTRAINT `fk_tags_organisation1` FOREIGN KEY (`orgId`) REFERENCES `organisation` (`orgId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_organisation1` FOREIGN KEY (`orgId`) REFERENCES `organisation` (`orgId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `users_has_role`
--
ALTER TABLE `users_has_role`
  ADD CONSTRAINT `fk_users_has_role_role1` FOREIGN KEY (`role_rid`) REFERENCES `role` (`rid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_has_role_users` FOREIGN KEY (`users_uid`) REFERENCES `users` (`uid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
