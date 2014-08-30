-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2014 at 07:49 AM
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

CREATE TABLE IF NOT EXISTS `asset` (
  `assetId` int(11) NOT NULL,
  `assetName` varchar(45) NOT NULL,
  `createDate` timestamp NULL DEFAULT NULL,
  `description` text,
  `comment` text,
  `status` int(11) DEFAULT NULL,
  `publication` tinyint(1) NOT NULL,
  `onlineEditable` tinyint(1) NOT NULL,
  `size` int(11) DEFAULT NULL,
  `type` varchar(10) DEFAULT NULL,
  `reviewer` varchar(45) DEFAULT NULL,
  `reviewerComments` text,
  `ownerId` int(11) NOT NULL,
  PRIMARY KEY (`assetId`),
  KEY `fk_asset_users_idx` (`ownerId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `name`, `orgId`) VALUES
(1, 'gfd', 535),
(2, 'as', 535);

-- --------------------------------------------------------

--
-- Table structure for table `category_has_ou_structure`
--

CREATE TABLE IF NOT EXISTS `category_has_ou_structure` (
  `cat_id` int(11) NOT NULL,
  `id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`cat_id`,`id`),
  KEY `fk_category_has_ou_structure_ou_structure1_idx` (`id`),
  KEY `fk_category_has_ou_structure_category1_idx` (`cat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category_has_ou_structure`
--

INSERT INTO `category_has_ou_structure` (`cat_id`, `id`) VALUES
(2, 7),
(2, 8);

-- --------------------------------------------------------

--
-- Table structure for table `filepermission`
--

CREATE TABLE IF NOT EXISTS `filepermission` (
  `fpId` int(11) NOT NULL,
  `fpName` varchar(45) NOT NULL,
  PRIMARY KEY (`fpId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `filepermission_has_ou_asset`
--

CREATE TABLE IF NOT EXISTS `filepermission_has_ou_asset` (
  `fpId` int(11) NOT NULL,
  `ouAssetId` int(11) NOT NULL,
  PRIMARY KEY (`fpId`,`ouAssetId`),
  KEY `fk_filePermission_has_ou_structure_has_asset_ou_structure_h_idx` (`ouAssetId`),
  KEY `fk_filePermission_has_ou_structure_has_asset_filePermission_idx` (`fpId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `filepermission_has_ou_structure`
--

CREATE TABLE IF NOT EXISTS `filepermission_has_ou_structure` (
  `fpId` int(11) NOT NULL,
  `ouId` int(11) unsigned NOT NULL,
  PRIMARY KEY (`fpId`,`ouId`),
  KEY `fk_filePermission_has_ou_structure_ou_structure1_idx` (`ouId`),
  KEY `fk_filePermission_has_ou_structure_filePermission1_idx` (`fpId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `filepermission_has_users_asset`
--

CREATE TABLE IF NOT EXISTS `filepermission_has_users_asset` (
  `fpId` int(11) NOT NULL,
  `userAssetId` int(11) NOT NULL,
  PRIMARY KEY (`fpId`,`userAssetId`),
  KEY `fk_filePermission_has_users_has_asset_users_has_asset1_idx` (`userAssetId`),
  KEY `fk_filePermission_has_users_has_asset_filePermission1_idx` (`fpId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=74 ;

--
-- Dumping data for table `module`
--

INSERT INTO `module` (`mid`, `name`, `description`, `orgId`) VALUES
(62, 'Add asset', 'For adding assets', 535),
(63, 'Check in', 'Downloading requests enabled', 535),
(64, 'Check out', 'Uploading requests enabled', 535),
(65, 'Admin', 'CRUD for user, role, module, tag, category, permission', 535),
(66, 'Add asset', 'For adding assets', 536),
(67, 'Check in', 'Downloading requests enabled', 536),
(68, 'Check out', 'Uploading requests enabled', 536),
(69, 'Admin', 'CRUD for user, role, module, tag, category, permission', 536),
(70, 'Add asset', 'For adding assets', 536),
(71, 'Check in', 'Downloading requests enabled', 536),
(72, 'Check out', 'Uploading requests enabled', 536),
(73, 'Admin', 'CRUD for user, role, module, tag, category, permission', 536);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=539 ;

--
-- Dumping data for table `organisation`
--

INSERT INTO `organisation` (`orgName`, `noEmp`, `phone`, `email`, `addr1`, `addr2`, `state`, `country`, `orgType`, `description`, `fax`, `orgId`, `validity`) VALUES
('abc1', NULL, NULL, '', '', '', '', '', '0', '', NULL, 535, 1),
('vishnu', NULL, NULL, '', '', '', '', '', '0', '', NULL, 536, 1),
('vishnu', NULL, NULL, '', '', '', '', '', '0', '', NULL, 537, 1),
('vishnu', NULL, NULL, '', '', '', '', '', '0', '', NULL, 538, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ou_structure`
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
  PRIMARY KEY (`id`),
  KEY `lft` (`lft`),
  KEY `rgt` (`rgt`),
  KEY `level` (`level`),
  KEY `root` (`root`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `ou_structure`
--

INSERT INTO `ou_structure` (`id`, `root`, `lft`, `rgt`, `level`, `name`, `description`, `orgId`) VALUES
(1, 1, 1, 8, 1, 'abc1', 'hello', 535),
(2, 2, 1, 10, 1, 'vishnu', 'hello', 537),
(3, 3, 1, 2, 1, 'vishnu', 'hello', 538),
(4, 2, 2, 5, 2, 'vx', 'das', 0),
(5, 2, 3, 4, 3, 'jhagc', 'ajdg', 0),
(6, 2, 6, 7, 2, ' c ', '', 0),
(7, 1, 2, 5, 2, 'g', '', 0),
(8, 1, 6, 7, 2, 'ad', '', 0),
(9, 2, 8, 9, 2, 'sf', '', 0),
(10, 1, 3, 4, 3, 'asd', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ou_structure_has_asset`
--

CREATE TABLE IF NOT EXISTS `ou_structure_has_asset` (
  `ouId` int(11) unsigned NOT NULL,
  `assetId` int(11) NOT NULL,
  `ouAssetId` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`ouAssetId`,`ouId`,`assetId`),
  KEY `fk_ou_structure_has_asset_asset1_idx` (`assetId`),
  KEY `fk_ou_structure_has_asset_ou_structure1_idx` (`ouId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE IF NOT EXISTS `permissions` (
  `pid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(65) NOT NULL,
  `desc` text NOT NULL,
  `mid` int(11) NOT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `rid` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `weight` mediumint(9) NOT NULL,
  PRIMARY KEY (`rid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`rid`, `name`, `weight`) VALUES
(33, 'asd', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`tagId`, `tagName`, `orgId`) VALUES
(1, 'ads', 535);

-- --------------------------------------------------------

--
-- Table structure for table `tags_has_ou_structure`
--

CREATE TABLE IF NOT EXISTS `tags_has_ou_structure` (
  `id` int(11) unsigned NOT NULL,
  `tagId` int(11) NOT NULL,
  PRIMARY KEY (`tagId`,`id`),
  KEY `fk_ou_structure_has_tags_tags1_idx` (`tagId`),
  KEY `fk_ou_structure_has_tags_ou_structure1_idx` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tags_has_ou_structure`
--

INSERT INTO `tags_has_ou_structure` (`id`, `tagId`) VALUES
(7, 1),
(8, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=118 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `name`, `password`, `email`, `login`, `logout`, `status`, `picture`, `mobile`, `quota`, `DateCreated`, `LastUpdate`, `orgId`) VALUES
(71, 'abc1', 'saEZ6MlWYV9nQ', 'abc1@gmail.com', '2014-06-05 05:40:42', NULL, '0', NULL, '', NULL, '0000-00-00 00:00:00', NULL, 535),
(72, 'abc1', 'saEZ6MlWYV9nQ', 'abc1@gmail.com', '2014-06-05 05:40:43', NULL, '0', NULL, '', NULL, '0000-00-00 00:00:00', NULL, 535),
(75, '123', 'saEZ6MlWYV9nQ', 'dsfs@gmail.com', '2014-06-05 08:35:25', NULL, '0', NULL, '', NULL, '0000-00-00 00:00:00', NULL, 535),
(76, '123', 'saEZ6MlWYV9nQ', 'dsfs@gmail.com', '2014-06-05 08:35:26', NULL, '0', NULL, '', NULL, '0000-00-00 00:00:00', NULL, 535),
(77, 'fgh', 'saEZ6MlWYV9nQ', 'dsfs@gmail.com', '2014-06-05 08:36:50', NULL, '', NULL, '', NULL, '0000-00-00 00:00:00', NULL, 535),
(78, 'sd', 'sauzCRMR02r1U', 'asd@gmail.com', '2014-06-05 08:37:42', NULL, '0', NULL, '', NULL, '0000-00-00 00:00:00', NULL, 535),
(79, 'sd', 'sauzCRMR02r1U', 'asd@gmail.com', '2014-06-05 08:37:42', NULL, '0', NULL, '', NULL, '0000-00-00 00:00:00', NULL, 535),
(80, 'sddd', 'saEZ6MlWYV9nQ', 'asd@gmail.com', '2014-06-05 08:50:57', NULL, '', NULL, '', NULL, '0000-00-00 00:00:00', NULL, 535),
(81, 'afterwards1234', '123', 'asd1234@gmail.com', '2014-06-05 08:51:22', NULL, '0', NULL, '', NULL, '0000-00-00 00:00:00', NULL, 535),
(82, 'vishnu', 'saPPmoXIbs91M', '', '2014-06-05 11:13:51', NULL, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', NULL, 536),
(83, 'vishnu', 'saPPmoXIbs91M', '', '2014-06-05 11:13:51', NULL, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', NULL, 536),
(84, 'ash', 'sadgC/1v9zmic', 'asd@gmail.com', '2014-06-06 04:55:48', NULL, '', NULL, '917736217996', NULL, '0000-00-00 00:00:00', NULL, 535),
(85, 'ash', 'sadgC/1v9zmic', 'asd@gmail.com', '2014-06-06 04:56:11', NULL, '1', NULL, '917736217996', NULL, '0000-00-00 00:00:00', NULL, 535),
(86, 'ash', 'sadgC/1v9zmic', 'asd@gmail.com', '2014-06-06 04:56:14', NULL, '1', NULL, '917736217996', NULL, '0000-00-00 00:00:00', NULL, 535),
(87, 'ash', 'sadgC/1v9zmic', 'asd@gmail.com', '2014-06-06 04:58:03', NULL, '1', NULL, '917736217996', NULL, '0000-00-00 00:00:00', NULL, 535),
(88, 'vishnu123', 'saEZ6MlWYV9nQ', 'vishnu@gmail.com', '2014-06-06 05:00:01', NULL, '1', NULL, '', NULL, '0000-00-00 00:00:00', NULL, 535),
(89, 'vishnu123', 'saEZ6MlWYV9nQ', 'vishnu@gmail.com', '2014-06-06 05:00:02', NULL, '1', NULL, '', NULL, '0000-00-00 00:00:00', NULL, 535),
(90, 'vishnuABC', 'saFLGt/QKS6yw', 'asd@gmail.com', '2014-06-06 05:03:26', NULL, '', NULL, '', NULL, '0000-00-00 00:00:00', NULL, 535),
(91, 'vishnuABC', 'saEZ6MlWYV9nQ', 'asd@gmail.com', '2014-06-06 05:03:41', NULL, '', NULL, '', NULL, '0000-00-00 00:00:00', NULL, 535),
(92, 'vishnuABC', 'saEZ6MlWYV9nQ', 'asd@gmail.com', '2014-06-06 05:03:42', NULL, '1', NULL, '', NULL, '0000-00-00 00:00:00', NULL, 535),
(93, 'vishnuABC', 'saEZ6MlWYV9nQ', 'asd@gmail.com', '2014-06-06 05:03:43', NULL, '1', NULL, '', NULL, '0000-00-00 00:00:00', NULL, 535),
(94, 'asda', 'saFLGt/QKS6yw', 'asd@gmail.com', '2014-06-06 05:04:22', NULL, '', NULL, '', NULL, '0000-00-00 00:00:00', NULL, 535),
(95, 'shjdgf', 'saFLGt/QKS6yw', 'dsfs@gmail.com', '2014-06-06 05:06:19', NULL, '', NULL, '', NULL, '0000-00-00 00:00:00', NULL, 535),
(96, 'shjdgf', 'saEZ6MlWYV9nQ', 'dsfs@gmail.com', '2014-06-06 05:06:25', NULL, '0', NULL, '', NULL, '0000-00-00 00:00:00', NULL, 535),
(97, 'shjdgf', 'saEZ6MlWYV9nQ', 'dsfs@gmail.com', '2014-06-06 05:06:26', NULL, '0', NULL, '', NULL, '0000-00-00 00:00:00', NULL, 535),
(98, 'ashish', 'saFLGt/QKS6yw', 'ashi@gmail.com', '2014-06-06 05:13:40', NULL, '', NULL, '', NULL, '0000-00-00 00:00:00', NULL, 535),
(99, 'ashish', 'saEZ6MlWYV9nQ', 'ashi@gmail.com', '2014-06-06 05:13:49', NULL, '1', NULL, '', NULL, '0000-00-00 00:00:00', NULL, 535),
(100, 'ashish', 'saEZ6MlWYV9nQ', 'ashi@gmail.com', '2014-06-06 05:13:50', NULL, '1', NULL, '', NULL, '0000-00-00 00:00:00', NULL, 535),
(101, 'abhi', 'saFLGt/QKS6yw', 'abhi@gmail.com', '2014-06-06 05:15:03', NULL, '', NULL, '', NULL, '0000-00-00 00:00:00', NULL, 535),
(102, 'abhi', 'saEZ6MlWYV9nQ', 'abhi@gmail.com', '2014-06-06 05:15:14', NULL, '', NULL, '', NULL, '0000-00-00 00:00:00', NULL, 535),
(103, 'abhi', 'saEZ6MlWYV9nQ', 'abhi@gmail.com', '2014-06-06 05:15:15', NULL, '0', NULL, '', NULL, '0000-00-00 00:00:00', NULL, 535),
(104, 'abhi', 'saEZ6MlWYV9nQ', 'abhi@gmail.com', '2014-06-06 05:15:17', NULL, '0', NULL, '', NULL, '0000-00-00 00:00:00', NULL, 535),
(105, 'asd', 'saFLGt/QKS6yw', 'asd@gmail.com', '2014-06-06 05:16:16', NULL, '', NULL, '', NULL, '0000-00-00 00:00:00', NULL, 535),
(106, 'asd', 'saEZ6MlWYV9nQ', 'asd@gmail.com', '2014-06-06 05:16:24', NULL, '0', NULL, '', NULL, '0000-00-00 00:00:00', NULL, 535),
(107, 'asd', 'saEZ6MlWYV9nQ', 'asd@gmail.com', '2014-06-06 05:16:25', NULL, '0', NULL, '', NULL, '0000-00-00 00:00:00', NULL, 535),
(108, 'swati', 'saFLGt/QKS6yw', 'swati@gmail.com', '2014-06-06 05:17:01', NULL, '', NULL, '', NULL, '0000-00-00 00:00:00', NULL, 535),
(109, 'swati', 'saEZ6MlWYV9nQ', 'swati@gmail.com', '2014-06-06 05:17:12', NULL, '', NULL, '', NULL, '0000-00-00 00:00:00', NULL, 535),
(110, 'swati', 'saEZ6MlWYV9nQ', 'swati@gmail.com', '2014-06-06 05:17:13', NULL, '0', NULL, '', NULL, '0000-00-00 00:00:00', NULL, 535),
(111, 'swati', 'saEZ6MlWYV9nQ', 'swati@gmail.com', '2014-06-06 05:17:14', NULL, '0', NULL, '', NULL, '0000-00-00 00:00:00', NULL, 535),
(112, 'swaati', 'saFLGt/QKS6yw', 'swati@gmail.com', '2014-06-06 05:18:27', NULL, '', NULL, '', NULL, '0000-00-00 00:00:00', NULL, 535),
(113, 'swaati', 'saEZ6MlWYV9nQ', 'swati@gmail.com', '2014-06-06 05:18:34', NULL, '0', NULL, '', NULL, '0000-00-00 00:00:00', NULL, 535),
(114, 'swaati', 'saEZ6MlWYV9nQ', 'swati@gmail.com', '2014-06-06 05:18:35', NULL, '0', NULL, '', NULL, '0000-00-00 00:00:00', NULL, 535),
(115, 'rakhi', 'saEZ6MlWYV9nQ', 'rakhi@gmail.com', '2014-06-06 05:22:23', NULL, '0', NULL, '', NULL, '0000-00-00 00:00:00', NULL, 535),
(116, 'mansi', 'saFLGt/QKS6yw', 'm@gmail.com', '2014-06-06 05:26:41', NULL, '', NULL, '', NULL, '0000-00-00 00:00:00', NULL, 535),
(117, 'mansi', 'saEZ6MlWYV9nQ', 'm@gmail.com', '2014-06-06 05:27:05', NULL, '1', NULL, '', NULL, '0000-00-00 00:00:00', NULL, 535);

-- --------------------------------------------------------

--
-- Table structure for table `users_has_asset`
--

CREATE TABLE IF NOT EXISTS `users_has_asset` (
  `uid` int(11) NOT NULL,
  `assetId` int(11) NOT NULL,
  `userAssetId` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`userAssetId`,`uid`,`assetId`),
  KEY `fk_users_has_asset_asset1_idx` (`assetId`),
  KEY `fk_users_has_asset_users1_idx` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
(71, 33),
(72, 33),
(75, 33),
(76, 33),
(77, 33),
(78, 33),
(79, 33),
(80, 33),
(81, 33),
(87, 33),
(88, 33),
(89, 33),
(91, 33),
(92, 33),
(93, 33),
(96, 33),
(97, 33),
(99, 33),
(100, 33),
(102, 33),
(103, 33),
(104, 33),
(106, 33),
(107, 33),
(109, 33),
(110, 33),
(111, 33),
(113, 33),
(114, 33),
(115, 33),
(117, 33);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `asset`
--
ALTER TABLE `asset`
  ADD CONSTRAINT `fk_asset_users` FOREIGN KEY (`ownerId`) REFERENCES `users` (`uid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
-- Constraints for table `filepermission_has_ou_asset`
--
ALTER TABLE `filepermission_has_ou_asset`
  ADD CONSTRAINT `fk_filePermission_has_ou_structure_has_asset_filePermission1` FOREIGN KEY (`fpId`) REFERENCES ``.`filepermission` (`fpId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_filePermission_has_ou_structure_has_asset_ou_structure_has1` FOREIGN KEY (`ouAssetId`) REFERENCES `ou_structure_has_asset` (`ouAssetId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `filepermission_has_ou_structure`
--
ALTER TABLE `filepermission_has_ou_structure`
  ADD CONSTRAINT `fk_filePermission_has_ou_structure_filePermission1` FOREIGN KEY (`fpId`) REFERENCES ``.`filepermission` (`fpId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_filePermission_has_ou_structure_ou_structure1` FOREIGN KEY (`ouId`) REFERENCES `ou_structure` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `filepermission_has_users_asset`
--
ALTER TABLE `filepermission_has_users_asset`
  ADD CONSTRAINT `fk_filePermission_has_users_has_asset_filePermission1` FOREIGN KEY (`fpId`) REFERENCES ``.`filepermission` (`fpId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_filePermission_has_users_has_asset_users_has_asset1` FOREIGN KEY (`userAssetId`) REFERENCES `users_has_asset` (`userAssetId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ou_structure_has_asset`
--
ALTER TABLE `ou_structure_has_asset`
  ADD CONSTRAINT `fk_ou_structure_has_asset_asset1` FOREIGN KEY (`assetId`) REFERENCES ``.`asset` (`assetId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ou_structure_has_asset_ou_structure1` FOREIGN KEY (`ouId`) REFERENCES `ou_structure` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
  ADD CONSTRAINT `fk_users_organisation1` FOREIGN KEY (`orgId`) REFERENCES `organisation` (`orgId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `users_has_asset`
--
ALTER TABLE `users_has_asset`
  ADD CONSTRAINT `fk_users_has_asset_asset1` FOREIGN KEY (`assetId`) REFERENCES ``.`asset` (`assetId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
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
