-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2014 at 09:21 AM
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
-- Table structure for table `asset`
--
-- Creation: Jun 14, 2014 at 10:17 AM
--

CREATE TABLE IF NOT EXISTS `asset` (
  `file` text NOT NULL,
  `assetId` int(11) NOT NULL AUTO_INCREMENT,
  `assetName` varchar(45) NOT NULL,
  `createDate` timestamp NULL DEFAULT NULL,
  `description` text,
  `comment` text,
  `status` int(11) DEFAULT NULL,
  `publication` tinyint(1) NOT NULL,
  `onlineEditable` tinyint(1) NOT NULL,
  `size` int(11) DEFAULT NULL,
  `type` varchar(18) DEFAULT NULL,
  `reviewer` int(11) DEFAULT NULL,
  `reviewerComments` text,
  `ownerId` int(11) NOT NULL,
  `categoryId` int(11) NOT NULL,
  `departmentId` int(11) unsigned NOT NULL,
  PRIMARY KEY (`assetId`),
  KEY `fk_asset_users_idx` (`ownerId`),
  KEY `categoryId` (`categoryId`),
  KEY `departmentId` (`departmentId`),
  KEY `reviewer` (`reviewer`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- RELATIONS FOR TABLE `asset`:
--   `reviewer`
--       `users` -> `uid`
--   `categoryId`
--       `category` -> `cat_id`
--   `departmentId`
--       `ou_structure` -> `id`
--   `ownerId`
--       `users` -> `uid`
--

--
-- Dumping data for table `asset`
--

INSERT INTO `asset` (`file`, `assetId`, `assetName`, `createDate`, `description`, `comment`, `status`, `publication`, `onlineEditable`, `size`, `type`, `reviewer`, `reviewerComments`, `ownerId`, `categoryId`, `departmentId`) VALUES
('1.jpg', 4, 'file1', '2014-06-16 22:37:34', 'description :P', '', 5, 1, 0, 14117, 'image/jpeg', 8, NULL, 8, 2, 6),
('2.jpg', 5, 'file2', '2014-06-16 22:39:04', '', '', 2, 0, 0, 17422, 'image/jpeg', 8, NULL, 8, 2, 6),
('11.jpg', 7, 'three', '2014-06-17 03:21:04', '', '', 0, 0, 0, 13014, 'image/jpeg', 10, NULL, 10, 2, 6),
('5.jpg', 8, 'fourth', '2014-06-17 08:39:37', 'this is the fourth asset in this', 'hehehe', 2, 0, 0, 16288, 'image/jpeg', 8, NULL, 8, 2, 6),
('mvp resume.docx', 9, 'resume', '2014-06-17 08:55:34', 'asasasasas', 'asasa', 0, 0, 0, 13615, 'application/vnd.op', 10, NULL, 10, 4, 6),
('permission.php', 11, '', '2014-06-17 14:47:27', '', '', 0, 0, 0, 1303, 'application/x-php', 10, NULL, 8, 2, 6),
('Doc2.docx', 12, '', '2014-06-17 14:52:35', '', '', 0, 0, 0, 218323, 'application/vnd.op', 8, NULL, 8, 2, 6),
('AMIP38175499_2013-06-28_22-12-05.pdf', 13, '', '2014-06-18 05:29:01', '', '', 0, 0, 0, 33975, 'application/pdf', 8, NULL, 8, 2, 6),
('9.jpg', 14, '', '2014-06-18 06:55:18', '', '', 3, 0, 0, 17927, 'image/jpeg', 8, NULL, 8, 2, 6);

-- --------------------------------------------------------

--
-- Table structure for table `asset_ou_filep`
--
-- Creation: Jun 14, 2014 at 10:17 AM
--

CREATE TABLE IF NOT EXISTS `asset_ou_filep` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `assetId` int(11) NOT NULL,
  `ouId` int(11) unsigned NOT NULL,
  `fpId` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `assetId` (`assetId`,`ouId`,`fpId`),
  KEY `ouId` (`ouId`),
  KEY `fpId` (`fpId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- RELATIONS FOR TABLE `asset_ou_filep`:
--   `assetId`
--       `asset` -> `assetId`
--   `ouId`
--       `ou_structure` -> `id`
--   `fpId`
--       `filepermission` -> `fpId`
--

-- --------------------------------------------------------

--
-- Table structure for table `asset_revision`
--
-- Creation: Jun 15, 2014 at 02:56 PM
--

CREATE TABLE IF NOT EXISTS `asset_revision` (
  `assetId` int(11) NOT NULL,
  `modifiedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modifiedBy` int(11) NOT NULL,
  `note` text NOT NULL,
  `revision` varchar(10) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  KEY `assetId` (`assetId`),
  KEY `modifiedOn` (`modifiedOn`),
  KEY `modifiedOn_2` (`modifiedOn`),
  KEY `modifiedOn_3` (`modifiedOn`),
  KEY `modifiedBy` (`modifiedBy`),
  KEY `modifiedBy_2` (`modifiedBy`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- RELATIONS FOR TABLE `asset_revision`:
--   `assetId`
--       `asset` -> `assetId`
--   `modifiedBy`
--       `users` -> `uid`
--

--
-- Dumping data for table `asset_revision`
--

INSERT INTO `asset_revision` (`assetId`, `modifiedOn`, `modifiedBy`, `note`, `revision`, `id`) VALUES
(4, '2014-06-18 14:07:23', 7, 'note1', ' 0', 7),
(4, '2014-06-18 14:07:28', 7, 'note', ' current', 8);

-- --------------------------------------------------------

--
-- Table structure for table `asset_tags`
--
-- Creation: Jun 14, 2014 at 10:17 AM
--

CREATE TABLE IF NOT EXISTS `asset_tags` (
  `assetId` int(11) NOT NULL,
  `tagId` int(11) NOT NULL,
  KEY `tagId` (`tagId`),
  KEY `assetId` (`assetId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `asset_tags`:
--   `assetId`
--       `asset` -> `assetId`
--   `tagId`
--       `tags` -> `tagId`
--

--
-- Dumping data for table `asset_tags`
--

INSERT INTO `asset_tags` (`assetId`, `tagId`) VALUES
(4, 3),
(4, 5),
(4, 7),
(5, 4),
(5, 5),
(5, 7),
(7, 3);

-- --------------------------------------------------------

--
-- Table structure for table `asset_user_filep`
--
-- Creation: Jun 17, 2014 at 02:37 PM
--

CREATE TABLE IF NOT EXISTS `asset_user_filep` (
  `id` int(11) NOT NULL,
  `assetId` int(11) NOT NULL,
  `uId` int(11) NOT NULL,
  `fpId` int(11) NOT NULL,
  KEY `assetId` (`assetId`),
  KEY `uId` (`uId`),
  KEY `fpId` (`fpId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `asset_user_filep`:
--   `assetId`
--       `asset` -> `assetId`
--   `uId`
--       `users` -> `uid`
--   `fpId`
--       `filepermission` -> `fpId`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--
-- Creation: Jun 14, 2014 at 10:17 AM
--

CREATE TABLE IF NOT EXISTS `category` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `orgId` int(11) unsigned NOT NULL,
  PRIMARY KEY (`cat_id`,`orgId`),
  KEY `fk_category_organisation1_idx` (`orgId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- RELATIONS FOR TABLE `category`:
--   `orgId`
--       `organisation` -> `orgId`
--

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `name`, `orgId`) VALUES
(1, 'Codinf', 1),
(2, 'koding', 4),
(3, 'logic design', 4),
(4, 'computer organisation', 4);

-- --------------------------------------------------------

--
-- Table structure for table `category_has_ou_structure`
--
-- Creation: Jun 14, 2014 at 10:17 AM
--

CREATE TABLE IF NOT EXISTS `category_has_ou_structure` (
  `cat_id` int(11) NOT NULL,
  `id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`cat_id`,`id`),
  KEY `fk_category_has_ou_structure_ou_structure1_idx` (`id`),
  KEY `fk_category_has_ou_structure_category1_idx` (`cat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELATIONS FOR TABLE `category_has_ou_structure`:
--   `cat_id`
--       `category` -> `cat_id`
--   `id`
--       `ou_structure` -> `id`
--

--
-- Dumping data for table `category_has_ou_structure`
--

INSERT INTO `category_has_ou_structure` (`cat_id`, `id`) VALUES
(1, 1),
(2, 6),
(3, 7),
(4, 8);

-- --------------------------------------------------------

--
-- Table structure for table `fileaccesslog`
--
-- Creation: Jun 14, 2014 at 10:17 AM
--

CREATE TABLE IF NOT EXISTS `fileaccesslog` (
  `timeStamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `action` varchar(3) NOT NULL,
  `fileAccessLogId` int(11) NOT NULL AUTO_INCREMENT,
  `assetId` int(11) NOT NULL,
  `uId` int(11) NOT NULL,
  PRIMARY KEY (`fileAccessLogId`),
  KEY `fk_fileAccessLog_asset1_idx` (`assetId`),
  KEY `uId` (`uId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

--
-- RELATIONS FOR TABLE `fileaccesslog`:
--   `uId`
--       `users` -> `uid`
--   `assetId`
--       `asset` -> `assetId`
--

--
-- Dumping data for table `fileaccesslog`
--

INSERT INTO `fileaccesslog` (`timeStamp`, `action`, `fileAccessLogId`, `assetId`, `uId`) VALUES
('2014-06-16 22:40:11', 'V', 3, 4, 8),
('2014-06-16 22:40:11', 'CI', 4, 4, 8),
('2014-06-18 12:24:24', 'CI', 7, 4, 8),
('2014-06-18 12:33:49', 'CI', 8, 5, 8),
('2014-06-18 12:35:25', 'CI', 9, 4, 8),
('2014-06-18 12:37:25', 'CI', 10, 4, 8),
('2014-06-18 12:39:16', 'CI', 11, 4, 8),
('2014-06-18 12:41:05', 'CI', 12, 4, 8),
('2014-06-18 12:42:48', 'CI', 13, 4, 8),
('2014-06-18 12:45:48', 'CI', 14, 4, 8),
('2014-06-18 12:51:52', 'CI', 15, 4, 8),
('2014-06-18 12:54:17', 'CI', 16, 4, 8),
('2014-06-18 13:00:04', 'CI', 17, 4, 8),
('2014-06-18 13:01:10', 'CI', 18, 4, 8),
('2014-06-18 13:02:02', 'CI', 19, 4, 8),
('2014-06-18 13:54:20', 'CI', 20, 4, 8),
('2014-06-18 13:56:11', 'CI', 21, 4, 8),
('2014-06-18 14:04:07', 'CI', 22, 4, 8),
('2014-06-18 14:04:28', 'CI', 23, 4, 8),
('2014-06-18 14:04:58', 'CI', 24, 4, 8),
('2014-06-18 14:05:31', 'CI', 25, 4, 8),
('2014-06-18 14:06:12', 'CI', 26, 4, 8),
('2014-06-18 14:06:54', 'CI', 27, 4, 8),
('2014-06-18 14:07:42', 'CI', 28, 4, 8),
('2014-06-18 14:08:05', 'CI', 29, 4, 8),
('2014-06-18 14:13:23', 'CI', 30, 4, 8),
('2014-06-18 14:13:50', 'CI', 31, 4, 8);

-- --------------------------------------------------------

--
-- Table structure for table `filepermission`
--
-- Creation: Jun 14, 2014 at 10:17 AM
--

CREATE TABLE IF NOT EXISTS `filepermission` (
  `fpId` int(11) NOT NULL,
  `fpName` varchar(45) NOT NULL,
  PRIMARY KEY (`fpId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `filepermission`
--

INSERT INTO `filepermission` (`fpId`, `fpName`) VALUES
(0, 'read'),
(1, 'write'),
(2, 'edit'),
(3, 'delete');

-- --------------------------------------------------------

--
-- Table structure for table `module`
--
-- Creation: Jun 14, 2014 at 10:17 AM
--

CREATE TABLE IF NOT EXISTS `module` (
  `mid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`mid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=60 ;

--
-- Dumping data for table `module`
--

INSERT INTO `module` (`mid`, `name`, `description`) VALUES
(54, 'add asset', ''),
(55, 'check in', NULL),
(56, 'check out', NULL),
(57, 'admin', NULL),
(58, 'module12', ''),
(59, 'module13', '');

-- --------------------------------------------------------

--
-- Table structure for table `module_organisation`
--
-- Creation: Jun 14, 2014 at 10:17 AM
--

CREATE TABLE IF NOT EXISTS `module_organisation` (
  `mid` int(11) NOT NULL,
  `orgId` int(11) NOT NULL,
  KEY `mid` (`mid`),
  KEY `orgId` (`orgId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `module_organisation`
--

INSERT INTO `module_organisation` (`mid`, `orgId`) VALUES
(54, 1),
(55, 1),
(56, 1),
(57, 1),
(54, 2),
(55, 2),
(56, 2),
(57, 2),
(54, 4),
(55, 4),
(56, 4),
(57, 4),
(54, 5),
(55, 5),
(56, 5),
(57, 5);

-- --------------------------------------------------------

--
-- Table structure for table `organisation`
--
-- Creation: Jun 14, 2014 at 10:17 AM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `organisation`
--

INSERT INTO `organisation` (`orgName`, `noEmp`, `phone`, `email`, `addr1`, `addr2`, `state`, `country`, `orgType`, `description`, `fax`, `orgId`, `validity`) VALUES
('IIT Bombay', NULL, NULL, '', '', '', '', '', '0', '', NULL, 1, 1),
('IITBOO', NULL, NULL, '', '', '', '', '', '0', '', NULL, 2, 1),
('IITBOO', NULL, NULL, '', '', '', '', '', '0', '', NULL, 3, 1),
('IITB1', NULL, NULL, '', '', '', '', '', '0', '', NULL, 4, 1),
('iitb2', 299, 2147483647, 'aks@gmail.com', 'asas', 'asasas', 'asasa', 'asasas', '1', 'asasa', 121212121, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ou_structure`
--
-- Creation: Jun 14, 2014 at 10:17 AM
--

CREATE TABLE IF NOT EXISTS `ou_structure` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `root` int(11) unsigned DEFAULT NULL,
  `lft` int(11) unsigned NOT NULL,
  `rgt` int(11) unsigned NOT NULL,
  `level` smallint(5) unsigned NOT NULL,
  `name` varchar(128) NOT NULL,
  `description` text NOT NULL,
  `orgId` int(11) NOT NULL,
  `dept_code` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `lft` (`lft`),
  KEY `rgt` (`rgt`),
  KEY `level` (`level`),
  KEY `root` (`root`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `ou_structure`
--

INSERT INTO `ou_structure` (`id`, `root`, `lft`, `rgt`, `level`, `name`, `description`, `orgId`, `dept_code`) VALUES
(1, 1, 1, 6, 1, 'IIT Bombay', 'hello', 1, ''),
(2, 1, 2, 3, 2, 'dept1', 'dept1', 0, 'dept1'),
(3, 1, 4, 5, 2, 'dept2', 'dept2\n', 0, 'dept2'),
(4, 4, 1, 2, 1, 'IITBOO', 'hello', 2, ''),
(5, 5, 1, 2, 1, 'IITBOO', 'hello', 3, ''),
(6, 6, 1, 8, 1, 'IITB1', 'hello', 4, ''),
(7, 6, 2, 3, 2, 'IITB12', 'iitbombay\n', 0, 'IITB'),
(8, 6, 4, 7, 2, 'IITB22', 'sffsad', 0, 'iitb22'),
(9, 9, 1, 2, 1, 'iitb2', 'hello', 5, ''),
(10, 6, 5, 6, 3, 'cse', 'cse', 0, '3');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--
-- Creation: Jun 14, 2014 at 10:17 AM
--

CREATE TABLE IF NOT EXISTS `permissions` (
  `pid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(65) NOT NULL,
  `desc` text NOT NULL,
  `mid` int(11) NOT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`pid`, `name`, `desc`, `mid`) VALUES
(1, 'abcd', '', 1),
(2, 'abcd2', '', 1),
(3, 'permission1', '', 54),
(4, 'permission2', '', 56),
(5, 'permission1', '', 54);

-- --------------------------------------------------------

--
-- Table structure for table `reviewer_oustructure`
--
-- Creation: Jun 19, 2014 at 02:15 AM
--

CREATE TABLE IF NOT EXISTS `reviewer_oustructure` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ouId` int(11) unsigned NOT NULL,
  `uId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ouId` (`ouId`,`uId`),
  KEY `uId` (`uId`),
  KEY `ouId_2` (`ouId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- RELATIONS FOR TABLE `reviewer_oustructure`:
--   `uId`
--       `users` -> `uid`
--   `ouId`
--       `ou_structure` -> `id`
--

--
-- Dumping data for table `reviewer_oustructure`
--

INSERT INTO `reviewer_oustructure` (`id`, `ouId`, `uId`) VALUES
(2, 6, 10),
(1, 7, 12),
(3, 8, 14),
(4, 9, 11),
(5, 10, 16);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--
-- Creation: Jun 14, 2014 at 10:17 AM
--

CREATE TABLE IF NOT EXISTS `role` (
  `rid` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `weight` mediumint(9) NOT NULL,
  `orgId` int(11) unsigned NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`rid`),
  KEY `orgId` (`orgId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- RELATIONS FOR TABLE `role`:
--   `orgId`
--       `organisation` -> `orgId`
--

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`rid`, `name`, `weight`, `orgId`, `description`) VALUES
(2, 'role1', 2, 4, 'dvdf'),
(3, 'role2', 0, 4, 'dgfsd');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--
-- Creation: Jun 14, 2014 at 10:17 AM
--

CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `rid` bigint(20) NOT NULL,
  `pid` int(11) NOT NULL,
  UNIQUE KEY `pid` (`pid`),
  KEY `fk_role_has_permissions_permissions1_idx` (`pid`),
  KEY `fk_role_has_permissions_role1_idx` (`rid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELATIONS FOR TABLE `role_has_permissions`:
--   `pid`
--       `permissions` -> `pid`
--   `rid`
--       `role` -> `rid`
--

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`rid`, `pid`) VALUES
(3, 3),
(3, 4);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--
-- Creation: Jun 14, 2014 at 10:17 AM
--

CREATE TABLE IF NOT EXISTS `tags` (
  `tagId` int(11) NOT NULL AUTO_INCREMENT,
  `tagName` varchar(45) NOT NULL,
  `orgId` int(11) unsigned NOT NULL,
  PRIMARY KEY (`tagId`,`orgId`),
  KEY `fk_tags_organisation1_idx` (`orgId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- RELATIONS FOR TABLE `tags`:
--   `orgId`
--       `organisation` -> `orgId`
--

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`tagId`, `tagName`, `orgId`) VALUES
(1, 'C++', 1),
(2, 'JAVA', 1),
(3, 'tag1', 4),
(4, 'tag2', 4),
(5, 'tag3', 4),
(6, 'tagABC', 4),
(7, 'tagABC', 4);

-- --------------------------------------------------------

--
-- Table structure for table `tags_has_ou_structure`
--
-- Creation: Jun 14, 2014 at 10:17 AM
--

CREATE TABLE IF NOT EXISTS `tags_has_ou_structure` (
  `id` int(11) unsigned NOT NULL,
  `tagId` int(11) NOT NULL,
  PRIMARY KEY (`tagId`,`id`),
  KEY `fk_ou_structure_has_tags_tags1_idx` (`tagId`),
  KEY `fk_ou_structure_has_tags_ou_structure1_idx` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELATIONS FOR TABLE `tags_has_ou_structure`:
--   `id`
--       `ou_structure` -> `id`
--   `tagId`
--       `tags` -> `tagId`
--

--
-- Dumping data for table `tags_has_ou_structure`
--

INSERT INTO `tags_has_ou_structure` (`id`, `tagId`) VALUES
(6, 3),
(7, 4),
(8, 5);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--
-- Creation: Jun 14, 2014 at 10:17 AM
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
  `ouId` int(11) unsigned NOT NULL,
  PRIMARY KEY (`uid`),
  KEY `fk_users_organisation1_idx` (`orgId`),
  KEY `orgId` (`orgId`),
  KEY `ouId` (`ouId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- RELATIONS FOR TABLE `users`:
--   `orgId`
--       `organisation` -> `orgId`
--   `ouId`
--       `ou_structure` -> `id`
--

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `name`, `password`, `email`, `login`, `logout`, `status`, `picture`, `mobile`, `quota`, `DateCreated`, `LastUpdate`, `orgId`, `ouId`) VALUES
(7, 'IITBOO', 'saPPmoXIbs91M', '', '2014-06-16 22:01:56', NULL, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', NULL, 2, 5),
(8, 'IITB1', 'saPPmoXIbs91M', '', '2014-06-16 22:02:40', NULL, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', NULL, 4, 6),
(10, 'vishnu17061', 'saEZ6MlWYV9nQ', 'vishnu@gmail.com', '2014-06-16 22:15:00', NULL, '0', NULL, '', NULL, '2014-06-17 03:45:00', NULL, 4, 6),
(11, 'iitb2', 'saPPmoXIbs91M', 'aks@gmail.com', '2014-06-17 08:48:04', NULL, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', NULL, 5, 9),
(12, 'abcd', 'saEZ6MlWYV9nQ', 'asd@gmail.com', '2014-06-17 13:16:15', NULL, '0', NULL, '', NULL, '2014-06-17 18:46:15', NULL, 4, 7),
(13, 'abcd2', 'saEZ6MlWYV9nQ', 'asd@gmail.com', '2014-06-17 13:16:57', NULL, '1', NULL, '8769898', NULL, '2014-06-17 18:46:57', NULL, 4, 7),
(14, 'hjk1', 'saEZ6MlWYV9nQ', 'djh@gmail.com', '2014-06-17 13:17:34', NULL, '0', NULL, '', NULL, '2014-06-17 18:47:34', NULL, 4, 8),
(15, 'cseuser', 'saEZ6MlWYV9nQ', 'cse@gmail.com', '2014-06-19 03:19:29', NULL, '0', NULL, '', NULL, '2014-06-19 08:49:29', NULL, 4, 6),
(16, 'cseuser1', 'saEZ6MlWYV9nQ', 'cse@gmail.com', '2014-06-19 03:20:05', NULL, '0', NULL, '', NULL, '2014-06-19 08:50:05', NULL, 4, 10);

-- --------------------------------------------------------

--
-- Table structure for table `users_department`
--
-- Creation: Jun 14, 2014 at 10:17 AM
--

CREATE TABLE IF NOT EXISTS `users_department` (
  `uid` int(11) NOT NULL,
  `id` int(11) unsigned NOT NULL,
  KEY `uid` (`uid`,`id`),
  KEY `id` (`id`),
  KEY `id_2` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `users_department`:
--   `uid`
--       `users` -> `uid`
--   `id`
--       `ou_structure` -> `id`
--

-- --------------------------------------------------------

--
-- Table structure for table `users_has_asset`
--
-- Creation: Jun 14, 2014 at 10:17 AM
--

CREATE TABLE IF NOT EXISTS `users_has_asset` (
  `uid` int(11) NOT NULL,
  `assetId` int(11) NOT NULL,
  `userAssetId` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`userAssetId`,`uid`,`assetId`),
  KEY `fk_users_has_asset_asset1_idx` (`assetId`),
  KEY `fk_users_has_asset_users1_idx` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- RELATIONS FOR TABLE `users_has_asset`:
--   `assetId`
--       `asset` -> `assetId`
--   `uid`
--       `users` -> `uid`
--

-- --------------------------------------------------------

--
-- Table structure for table `users_has_role`
--
-- Creation: Jun 14, 2014 at 10:17 AM
--

CREATE TABLE IF NOT EXISTS `users_has_role` (
  `users_uid` int(11) NOT NULL,
  `role_rid` bigint(20) NOT NULL,
  KEY `fk_users_has_role_role1_idx` (`role_rid`),
  KEY `fk_users_has_role_users_idx` (`users_uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELATIONS FOR TABLE `users_has_role`:
--   `role_rid`
--       `role` -> `rid`
--   `users_uid`
--       `users` -> `uid`
--

--
-- Dumping data for table `users_has_role`
--

INSERT INTO `users_has_role` (`users_uid`, `role_rid`) VALUES
(10, 2),
(12, 2),
(13, 2),
(14, 2),
(15, 2),
(16, 2);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `asset`
--
ALTER TABLE `asset`
  ADD CONSTRAINT `asset_ibfk_3` FOREIGN KEY (`reviewer`) REFERENCES `users` (`uid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `asset_ibfk_1` FOREIGN KEY (`categoryId`) REFERENCES `category` (`cat_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `asset_ibfk_2` FOREIGN KEY (`departmentId`) REFERENCES `ou_structure` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_asset_users` FOREIGN KEY (`ownerId`) REFERENCES `users` (`uid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `asset_ou_filep`
--
ALTER TABLE `asset_ou_filep`
  ADD CONSTRAINT `asset_ou_filep_ibfk_1` FOREIGN KEY (`assetId`) REFERENCES `asset` (`assetId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `asset_ou_filep_ibfk_2` FOREIGN KEY (`ouId`) REFERENCES `ou_structure` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `asset_ou_filep_ibfk_3` FOREIGN KEY (`fpId`) REFERENCES `filepermission` (`fpId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `asset_revision`
--
ALTER TABLE `asset_revision`
  ADD CONSTRAINT `asset_revision_ibfk_1` FOREIGN KEY (`assetId`) REFERENCES `asset` (`assetId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `asset_revision_ibfk_2` FOREIGN KEY (`modifiedBy`) REFERENCES `users` (`uid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `asset_tags`
--
ALTER TABLE `asset_tags`
  ADD CONSTRAINT `asset_tags_ibfk_1` FOREIGN KEY (`assetId`) REFERENCES `asset` (`assetId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `asset_tags_ibfk_2` FOREIGN KEY (`tagId`) REFERENCES `tags` (`tagId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `asset_user_filep`
--
ALTER TABLE `asset_user_filep`
  ADD CONSTRAINT `asset_user_filep_ibfk_1` FOREIGN KEY (`assetId`) REFERENCES `asset` (`assetId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `asset_user_filep_ibfk_2` FOREIGN KEY (`uId`) REFERENCES `users` (`uid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `asset_user_filep_ibfk_3` FOREIGN KEY (`fpId`) REFERENCES `filepermission` (`fpId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `fk_category_organisation1` FOREIGN KEY (`orgId`) REFERENCES `organisation` (`orgId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `category_has_ou_structure`
--
ALTER TABLE `category_has_ou_structure`
  ADD CONSTRAINT `fk_category_has_ou_structure_category1` FOREIGN KEY (`cat_id`) REFERENCES `category` (`cat_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_category_has_ou_structure_ou_structure1` FOREIGN KEY (`id`) REFERENCES `ou_structure` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `fileaccesslog`
--
ALTER TABLE `fileaccesslog`
  ADD CONSTRAINT `fileaccesslog_ibfk_1` FOREIGN KEY (`uId`) REFERENCES `users` (`uid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_fileAccessLog_asset1` FOREIGN KEY (`assetId`) REFERENCES `asset` (`assetId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `reviewer_oustructure`
--
ALTER TABLE `reviewer_oustructure`
  ADD CONSTRAINT `reviewer_oustructure_ibfk_2` FOREIGN KEY (`uId`) REFERENCES `users` (`uid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `reviewer_oustructure_ibfk_1` FOREIGN KEY (`ouId`) REFERENCES `ou_structure` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `role`
--
ALTER TABLE `role`
  ADD CONSTRAINT `role_ibfk_1` FOREIGN KEY (`orgId`) REFERENCES `organisation` (`orgId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
-- Constraints for table `tags_has_ou_structure`
--
ALTER TABLE `tags_has_ou_structure`
  ADD CONSTRAINT `fk_ou_structure_has_tags_ou_structure1` FOREIGN KEY (`id`) REFERENCES `ou_structure` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ou_structure_has_tags_tags1` FOREIGN KEY (`tagId`) REFERENCES `tags` (`tagId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_organisation1` FOREIGN KEY (`orgId`) REFERENCES `organisation` (`orgId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`ouId`) REFERENCES `ou_structure` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `users_department`
--
ALTER TABLE `users_department`
  ADD CONSTRAINT `users_department_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`uid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `users_department_ibfk_2` FOREIGN KEY (`id`) REFERENCES `ou_structure` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `users_has_asset`
--
ALTER TABLE `users_has_asset`
  ADD CONSTRAINT `fk_users_has_asset_asset1` FOREIGN KEY (`assetId`) REFERENCES `asset` (`assetId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_has_asset_users1` FOREIGN KEY (`uid`) REFERENCES `users` (`uid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `users_has_role`
--
ALTER TABLE `users_has_role`
  ADD CONSTRAINT `fk_users_has_role_role1` FOREIGN KEY (`role_rid`) REFERENCES `role` (`rid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_has_role_users` FOREIGN KEY (`users_uid`) REFERENCES `users` (`uid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
