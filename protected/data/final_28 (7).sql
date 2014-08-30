-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 05, 2014 at 06:30 AM
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `name`, `orgId`) VALUES
(1, 'asd', 529),
(2, 'hg', 529),
(3, 'hg', 529),
(4, 'sa', 529),
(5, 'sdf', 529),
(6, 'sfffsf', 529);

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

-- --------------------------------------------------------

--
-- Table structure for table `document`
--

CREATE TABLE IF NOT EXISTS `document` (
  `docId` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(70) NOT NULL,
  `ownerId` int(11) NOT NULL,
  `departmentId` int(11) NOT NULL,
  `categoryId` int(11) NOT NULL,
  `description` text NOT NULL,
  `comment` text NOT NULL,
  PRIMARY KEY (`docId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=62 ;

--
-- Dumping data for table `module`
--

INSERT INTO `module` (`mid`, `name`, `description`, `orgId`) VALUES
(54, 'Add asset', 'For adding assets', 529),
(55, 'Check in', 'Downloading requests enabled', 529),
(56, 'Check out', 'Uploading requests enabled', 529),
(57, 'Admin', 'CRUD for user, role, module, tag, category, permission', 529),
(58, 'Add asset', 'For adding assets', 529),
(59, 'Check in', 'Downloading requests enabled', 529),
(60, 'Check out', 'Uploading requests enabled', 529),
(61, 'Admin', 'CRUD for user, role, module, tag, category, permission', 529);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=535 ;

--
-- Dumping data for table `organisation`
--

INSERT INTO `organisation` (`orgName`, `noEmp`, `phone`, `email`, `addr1`, `addr2`, `state`, `country`, `orgType`, `description`, `fax`, `orgId`, `validity`) VALUES
('vishnu', NULL, NULL, '', '', '', '', '', '0', '', NULL, 529, 1),
('vishnu', NULL, NULL, '', '', '', '', '', '0', '', NULL, 530, 1),
('abc', NULL, NULL, '', '', '', '', '', '0', '', NULL, 531, 1),
('abc', NULL, NULL, '', '', '', '', '', '0', '', NULL, 532, 1),
('abc', NULL, NULL, '', '', '', '', '', '0', '', NULL, 533, 1),
('abhi', NULL, NULL, '', '', '', '', '', '0', '', NULL, 534, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ou_structure`
--

CREATE TABLE IF NOT EXISTS `ou_structure` (
  `id` int(11) unsigned NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ou_structure`
--

INSERT INTO `ou_structure` (`id`, `root`, `lft`, `rgt`, `level`, `name`, `description`, `orgId`) VALUES
(0, 1, 1, 4, 1, 'abc', 'hello', 530),
(1, 1, 2, 3, 2, 'vishnu', 'hello', 530);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`pid`, `name`, `desc`, `mid`) VALUES
(20, 'hfhnv', 'ngf', 54);

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
(32, 'xcczc', 2);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=56 ;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`tagId`, `tagName`, `orgId`) VALUES
(44, 'sad', 529),
(45, 'ggh', 529),
(46, 'gv', 529),
(47, 'sd', 529),
(48, 'asd', 529),
(49, 'asd', 529),
(50, 'asd', 529),
(51, 'xccc', 529),
(52, 'xccc', 529),
(53, 'xccc', 529),
(54, 'tag1', 529),
(55, 'sad', 529);

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
(0, 54),
(1, 54),
(0, 55),
(1, 55);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=101 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `name`, `password`, `email`, `login`, `logout`, `status`, `picture`, `mobile`, `quota`, `DateCreated`, `LastUpdate`, `orgId`) VALUES
(48, 'vishnu', 'saPPmoXIbs91M', '', '2014-06-04 04:35:22', NULL, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', NULL, 529),
(49, 'vishnuas', 'saEZ6MlWYV9nQ', 'vishnu@gmail.com', '2014-06-04 06:05:45', NULL, '', NULL, '', NULL, '0000-00-00 00:00:00', NULL, 529),
(50, 'vishnuas', 'saEZ6MlWYV9nQ', 'vishnu@gmail.com', '2014-06-04 06:06:23', NULL, '0', NULL, '', NULL, '0000-00-00 00:00:00', NULL, 529),
(51, 'vishnuas', 'saEZ6MlWYV9nQ', 'vishnu@gmail.com', '2014-06-04 06:07:27', NULL, '0', NULL, '', NULL, '0000-00-00 00:00:00', NULL, 529),
(52, 'vishnuas', 'saEZ6MlWYV9nQ', 'vishnu@gmail.com', '2014-06-04 06:07:28', NULL, '0', NULL, '', NULL, '0000-00-00 00:00:00', NULL, 529),
(53, 'vishnuz', 'saEZ6MlWYV9nQ', 'vishnu@gmail.com', '2014-06-04 06:13:15', NULL, '0', NULL, '', NULL, '0000-00-00 00:00:00', NULL, 529),
(54, 'vishnuz', 'saEZ6MlWYV9nQ', 'vishnu@gmail.com', '2014-06-04 06:13:16', NULL, '0', NULL, '', NULL, '0000-00-00 00:00:00', NULL, 529),
(55, 'vishnuz', 'saEZ6MlWYV9nQ', 'vishnu@gmail.com', '2014-06-04 06:13:32', NULL, '0', NULL, '', NULL, '0000-00-00 00:00:00', NULL, 529),
(56, 'vishnuz', 'saEZ6MlWYV9nQ', 'vishnu@gmail.com', '2014-06-04 06:13:47', NULL, '0', NULL, '', NULL, '0000-00-00 00:00:00', NULL, 529),
(57, 'vishnuz', 'saEZ6MlWYV9nQ', 'vishnu@gmail.com', '2014-06-04 06:14:04', NULL, '0', NULL, '', NULL, '0000-00-00 00:00:00', NULL, 529),
(58, 'vishnuz', 'saEZ6MlWYV9nQ', 'vishnu@gmail.com', '2014-06-04 06:14:07', NULL, '0', NULL, '', NULL, '0000-00-00 00:00:00', NULL, 529),
(59, 'vishnuz', 'saEZ6MlWYV9nQ', 'vishnu@gmail.com', '2014-06-04 06:14:24', NULL, '0', NULL, '', NULL, '0000-00-00 00:00:00', NULL, 529),
(60, 'vishnuz', 'saEZ6MlWYV9nQ', 'vishnu@gmail.com', '2014-06-04 06:17:44', NULL, '0', NULL, '', NULL, '0000-00-00 00:00:00', NULL, 529),
(61, 'vishnu', 'saPPmoXIbs91M', '', '2014-06-04 09:27:35', NULL, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', NULL, 529),
(62, 'vishnu', 'saEZ6MlWYV9nQ', 'vishnu@gmail.com', '2014-06-04 11:18:06', NULL, '0', NULL, '', NULL, '0000-00-00 00:00:00', NULL, 529),
(63, 'vishnu', 'saEZ6MlWYV9nQ', 'vishnu@gmail.com', '2014-06-04 11:18:07', NULL, '0', NULL, '', NULL, '0000-00-00 00:00:00', NULL, 529),
(64, 'vishnu1', 'saEZ6MlWYV9nQ', 'vishnu@gmail.com', '2014-06-04 11:19:11', NULL, '1', NULL, '', NULL, '0000-00-00 00:00:00', NULL, 529),
(65, 'vishnu1', 'saaxYsW01BSOg', 'vishnu@gmail.com', '2014-06-04 11:19:28', NULL, '', NULL, '', NULL, '0000-00-00 00:00:00', NULL, 529),
(66, 'vishnu', 'saEZ6MlWYV9nQ', 'vishnu@gmail.com', '2014-06-04 11:38:10', NULL, '0', NULL, '', NULL, '0000-00-00 00:00:00', NULL, 529),
(67, 'vishnu', 'saEZ6MlWYV9nQ', 'vishnu@gmail.com', '2014-06-04 11:38:15', NULL, '0', NULL, '', NULL, '0000-00-00 00:00:00', NULL, 529),
(68, 'asd', 'saEZ6MlWYV9nQ', 'asd@gmail.com', '2014-06-05 02:20:36', NULL, '0', NULL, '', NULL, '0000-00-00 00:00:00', NULL, 529),
(69, 'asd', 'saEZ6MlWYV9nQ', 'asd@gmail.com', '2014-06-05 02:20:37', NULL, '0', NULL, '', NULL, '0000-00-00 00:00:00', NULL, 529),
(70, 'asd', 'saEZ6MlWYV9nQ', 'asd@gmail.com', '2014-06-05 02:25:32', NULL, '0', NULL, '', NULL, '0000-00-00 00:00:00', NULL, 529),
(71, 'asd', 'saEZ6MlWYV9nQ', 'asd@gmail.com', '2014-06-05 02:26:45', NULL, '0', NULL, '', NULL, '0000-00-00 00:00:00', NULL, 529),
(72, 'dffsf', 'salXp/ctDdCtQ', 'dffd@gmail.com', '2014-06-05 02:32:08', NULL, '0', NULL, '', NULL, '0000-00-00 00:00:00', NULL, 529),
(73, 'dffsf', 'salXp/ctDdCtQ', 'dffd@gmail.com', '2014-06-05 02:32:09', NULL, '0', NULL, '', NULL, '0000-00-00 00:00:00', NULL, 529),
(74, 'dffsf', 'salXp/ctDdCtQ', 'dffd@gmail.com', '2014-06-05 02:32:38', NULL, '0', NULL, '', NULL, '0000-00-00 00:00:00', NULL, 529),
(75, 'dffsf', 'salXp/ctDdCtQ', 'dffd@gmail.com', '2014-06-05 02:33:31', NULL, '0', NULL, '', NULL, '0000-00-00 00:00:00', NULL, 529),
(76, 'asd', 'saEZ6MlWYV9nQ', 'asd@gmail.com', '2014-06-05 02:34:46', NULL, '', NULL, '', NULL, '0000-00-00 00:00:00', NULL, 529),
(77, 'fd', 'saEZ6MlWYV9nQ', 'sd@gmail.com', '2014-06-05 02:39:59', NULL, '', NULL, '', NULL, '0000-00-00 00:00:00', NULL, 529),
(78, 'errrr', 'saEZ6MlWYV9nQ', 'asd@gmail.com', '2014-06-05 02:41:26', NULL, '', NULL, '', NULL, '0000-00-00 00:00:00', NULL, 529),
(79, 'errrr', 'saEZ6MlWYV9nQ', 'asd@gmail.com', '2014-06-05 02:42:01', NULL, '', NULL, '', NULL, '0000-00-00 00:00:00', NULL, 529),
(80, 'vishnu', 'saEZ6MlWYV9nQ', 'vishnu@gmail.com', '2014-06-05 02:46:13', NULL, '', NULL, '', NULL, '0000-00-00 00:00:00', NULL, 529),
(81, 'vishnu', 'saEZ6MlWYV9nQ', 'vishnu@gmail.com', '2014-06-05 02:48:31', NULL, '', NULL, '', NULL, '0000-00-00 00:00:00', NULL, 529),
(82, 'vishnu', 'saEZ6MlWYV9nQ', 'vishnu@gmail.com', '2014-06-05 02:49:10', NULL, '', NULL, '', NULL, '0000-00-00 00:00:00', NULL, 529),
(83, 'vishnu', 'saEZ6MlWYV9nQ', 'vishnu@gmail.com', '2014-06-05 02:49:32', NULL, '', NULL, '', NULL, '0000-00-00 00:00:00', NULL, 529),
(84, 'vishnu', 'saEZ6MlWYV9nQ', 'vishnu@gmail.com', '2014-06-05 02:55:07', NULL, '', NULL, '', NULL, '0000-00-00 00:00:00', NULL, 529),
(85, 'vishnu', 'saEZ6MlWYV9nQ', 'vishnu@gmail.com', '2014-06-05 02:55:21', NULL, '', NULL, '', NULL, '0000-00-00 00:00:00', NULL, 529),
(86, 'vishnu', 'saEZ6MlWYV9nQ', 'vishnu@gmail.com', '2014-06-05 02:55:25', NULL, '', NULL, '', NULL, '0000-00-00 00:00:00', NULL, 529),
(87, 'vishnu', 'saEZ6MlWYV9nQ', 'vishnu@gmail.com', '2014-06-05 02:55:44', NULL, '', NULL, '', NULL, '0000-00-00 00:00:00', NULL, 529),
(88, 'vishnu', 'saEZ6MlWYV9nQ', 'vishnu@gmail.com', '2014-06-05 02:56:04', NULL, '', NULL, '', NULL, '0000-00-00 00:00:00', NULL, 529),
(89, 'vishnu', 'saEZ6MlWYV9nQ', 'vishnu@gmail.com', '2014-06-05 02:57:08', NULL, '', NULL, '', NULL, '0000-00-00 00:00:00', NULL, 529),
(90, 'vishnu', '123', 'vishnu@gmail.com', '2014-06-05 02:58:18', NULL, '', NULL, '', NULL, '0000-00-00 00:00:00', NULL, 529),
(91, 'vishnu2', 'saEZ6MlWYV9nQ', 'sdf@gmail.com', '2014-06-05 03:16:59', NULL, '0', NULL, '', NULL, '0000-00-00 00:00:00', NULL, 529),
(92, 'vishnu2', 'saEZ6MlWYV9nQ', 'sdf@gmail.com', '2014-06-05 03:17:00', NULL, '0', NULL, '', NULL, '0000-00-00 00:00:00', NULL, 529),
(93, 'vishnu2', 'saEZ6MlWYV9nQ', 'sdf@gmail.com', '2014-06-05 03:17:47', NULL, '0', NULL, '', NULL, '0000-00-00 00:00:00', NULL, 529),
(94, 'vishnu2', 'saEZ6MlWYV9nQ', 'sdf@gmail.com', '2014-06-05 03:18:03', NULL, '0', NULL, '', NULL, '0000-00-00 00:00:00', NULL, 529),
(95, 'sfdsfd', 'saEZ6MlWYV9nQ', 'sdf@gmail.com', '2014-06-05 03:21:39', NULL, '0', NULL, '', NULL, '0000-00-00 00:00:00', NULL, 529),
(96, 'sfdsfd', 'saEZ6MlWYV9nQ', 'sdf@gmail.com', '2014-06-05 03:21:41', NULL, '0', NULL, '', NULL, '0000-00-00 00:00:00', NULL, 529),
(97, 'sfdsfd', 'saEZ6MlWYV9nQ', 'sd@gmail.com', '2014-06-05 03:25:09', NULL, '', NULL, '', NULL, '0000-00-00 00:00:00', NULL, 529),
(98, 'ads', 'saEZ6MlWYV9nQ', 'mvpnov1994@gmail.com', '2014-06-05 03:27:02', NULL, '', NULL, '7736217996', NULL, '0000-00-00 00:00:00', NULL, 529),
(99, 'sd', 'saEZ6MlWYV9nQ', 'sdf@gmail.com', '2014-06-05 03:28:41', NULL, '0', NULL, '', NULL, '0000-00-00 00:00:00', NULL, 529),
(100, 'sd', 'saEZ6MlWYV9nQ', 'sdf@gmail.com', '2014-06-05 03:28:42', NULL, '0', NULL, '', NULL, '0000-00-00 00:00:00', NULL, 529);

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
(51, 31),
(52, 31),
(62, 31),
(62, 32),
(63, 31),
(63, 32),
(65, 31),
(67, 31),
(71, 31),
(75, 31),
(76, 31),
(77, 31),
(79, 31),
(89, 31),
(90, 31),
(98, 31),
(99, 31),
(100, 31);

--
-- Constraints for dumped tables
--

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
-- Constraints for table `users_has_role`
--
ALTER TABLE `users_has_role`
  ADD CONSTRAINT `fk_users_has_role_role1` FOREIGN KEY (`role_rid`) REFERENCES `role` (`rid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_has_role_users` FOREIGN KEY (`users_uid`) REFERENCES `users` (`uid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
