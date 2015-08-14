-- phpMyAdmin SQL Dump
-- version 4.4.13
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 14, 2015 at 01:37 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pris_advanced`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_assignment`
--

CREATE TABLE IF NOT EXISTS `auth_assignment` (
  `item_name` varchar(64) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('deputy-director-genaral', 7, NULL),
('deputy-director-genaral', 8, NULL),
('divisional-head', 7, NULL),
('divisional-head', 9, NULL),
('engineer', 7, NULL),
('engineer', 10, NULL),
('sectional-head', 7, NULL),
('sectional-head', 11, NULL),
('sectional-staff', 7, NULL),
('sectional-staff', 12, NULL),
('system-admin', 6, NULL),
('system-admin', 7, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item`
--

CREATE TABLE IF NOT EXISTS `auth_item` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `rule_name` varchar(64) DEFAULT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('change-access-level', 1, 'allows system admin to change user access level', NULL, NULL, NULL, NULL),
('change-project-state', 1, 'allows ddg to change project state', NULL, NULL, NULL, NULL),
('create-auth-assignment', 1, 'allow user to create auth assignment', NULL, NULL, NULL, NULL),
('create-division', 1, 'allows system admin to create a new division', NULL, NULL, NULL, NULL),
('create-project', 1, 'allows an engineer to add a project', NULL, NULL, NULL, NULL),
('create-report', 1, 'allows sectional users to add sectional inputs', NULL, NULL, NULL, NULL),
('create-user', 1, 'allows system admin to create a new user', NULL, NULL, NULL, NULL),
('delete-auth-assignment', 1, 'allow user to delete auth assignment', NULL, NULL, NULL, NULL),
('delete-division', 1, 'allows user to delete division', NULL, NULL, NULL, NULL),
('delete-project', 1, 'allows user to delete a project', NULL, NULL, NULL, NULL),
('delete-report', 1, 'allows a user to delete a report', NULL, NULL, NULL, NULL),
('delete-user', 1, 'allows user to delete a user', NULL, NULL, NULL, NULL),
('deputy-director-genaral', 2, 'allows ddg to approve projects and to change project state', NULL, NULL, NULL, NULL),
('divisional-head', 2, 'allows divisional head to approve projects and approve project updates + create project and update', NULL, NULL, NULL, NULL),
('engineer', 2, 'allows user to create and update projects', NULL, NULL, NULL, NULL),
('mark-ddg-approval', 1, 'allows ddg to mark approval', NULL, NULL, NULL, NULL),
('mark-dh-approval', 1, 'allows the divisional head to mark approval', NULL, NULL, NULL, NULL),
('mark-report-approval', 1, 'allows sectional head to mark sectional input approval', NULL, NULL, NULL, NULL),
('mark-update-approval', 1, 'allows dh to mark approval for project updates', NULL, NULL, NULL, NULL),
('sectional-head', 2, 'allows user to approve and crud reports', NULL, NULL, NULL, NULL),
('sectional-staff', 2, 'allow user to crud reports', NULL, NULL, NULL, NULL),
('system-admin', 2, 'system admin can crud divisions, crud users, crud auth-assignment and change user access level', NULL, NULL, NULL, NULL),
('update-auth-assignment', 1, 'allow user to update auth assignment', NULL, NULL, NULL, NULL),
('update-division', 1, 'allows user to update division', NULL, NULL, NULL, NULL),
('update-project', 1, 'allows user to update project details', NULL, NULL, NULL, NULL),
('update-report', 1, 'allows user to update a report', NULL, NULL, NULL, NULL),
('update-user', 1, 'allows user to update a user', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item_child`
--

CREATE TABLE IF NOT EXISTS `auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('system-admin', 'change-access-level'),
('deputy-director-genaral', 'change-project-state'),
('system-admin', 'create-auth-assignment'),
('system-admin', 'create-division'),
('divisional-head', 'create-project'),
('engineer', 'create-project'),
('sectional-head', 'create-report'),
('sectional-staff', 'create-report'),
('system-admin', 'create-user'),
('system-admin', 'delete-auth-assignment'),
('system-admin', 'delete-division'),
('divisional-head', 'delete-project'),
('sectional-head', 'delete-report'),
('sectional-staff', 'delete-report'),
('system-admin', 'delete-user'),
('deputy-director-genaral', 'mark-ddg-approval'),
('divisional-head', 'mark-dh-approval'),
('sectional-head', 'mark-report-approval'),
('divisional-head', 'mark-update-approval'),
('system-admin', 'update-auth-assignment'),
('system-admin', 'update-division'),
('divisional-head', 'update-project'),
('sectional-head', 'update-report'),
('sectional-staff', 'update-report'),
('system-admin', 'update-user');

-- --------------------------------------------------------

--
-- Table structure for table `auth_rule`
--

CREATE TABLE IF NOT EXISTS `auth_rule` (
  `name` varchar(64) NOT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `division`
--

CREATE TABLE IF NOT EXISTS `division` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(600) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `division`
--

INSERT INTO `division` (`id`, `name`, `description`) VALUES
(1, 'Electronics & Microelectronics Division', 'Conduct research & development work related to electronics, telecommunications, robotics and automation'),
(2, 'Information Technology Division', 'Software translation, computer vision and assistance for e-governance'),
(3, 'Space Technologies Division', 'Research work on RS/GIS, Space Technology based National Capacity Development, Research work on Astronomy, Astronomy popularization programme'),
(4, 'Communication Division', 'Currently include activities of Robotics'),
(5, 'Industrial Services Division', 'Provide consultancy services to the electronic industry and perform repair & calibration  services of test and measuring instruments. '),
(6, 'Stores Section', ''),
(7, 'Logistics Division ', 'Transportation,'),
(8, 'Finance Division', '');

-- --------------------------------------------------------

--
-- Table structure for table `division_has_user`
--

CREATE TABLE IF NOT EXISTS `division_has_user` (
  `division_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `division_has_user`
--

INSERT INTO `division_has_user` (`division_id`, `user_id`) VALUES
(2, 6),
(1, 7),
(2, 7),
(3, 7),
(2, 9),
(1, 10),
(6, 11),
(6, 12);

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE IF NOT EXISTS `project` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `client` varchar(255) DEFAULT NULL,
  `state` enum('pending','active','suspended','finished') NOT NULL DEFAULT 'pending',
  `description` varchar(6000) DEFAULT NULL,
  `parent_project_id` int(11) DEFAULT NULL,
  `requested_user_id` int(11) NOT NULL,
  `approved_ddg_user_id` int(11) DEFAULT NULL,
  `approved_dh_user_id` int(11) DEFAULT NULL,
  `project_type_id` int(11) NOT NULL,
  `division_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `approval_date` datetime DEFAULT NULL,
  `quarterly_targets` varchar(4000) DEFAULT NULL,
  `team_leader` int(11) DEFAULT NULL,
  `starting_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`id`, `name`, `code`, `client`, `state`, `description`, `parent_project_id`, `requested_user_id`, `approved_ddg_user_id`, `approved_dh_user_id`, `project_type_id`, `division_id`, `created_at`, `approval_date`, `quarterly_targets`, `team_leader`, `starting_date`, `end_date`) VALUES
(4, 'Project 1', 'p1', 'client 1', 'pending', 'Description', NULL, 7, NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'Project 2', 'p2', 'client 2', 'pending', 'Description', NULL, 7, NULL, NULL, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'Project 1.1', 'p1.1', 'client 1', 'pending', 'Description', 4, 7, NULL, NULL, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `project_type`
--

CREATE TABLE IF NOT EXISTS `project_type` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(1023) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project_type`
--

INSERT INTO `project_type` (`id`, `name`, `description`) VALUES
(1, 'In-house Project', 'In-house Project'),
(2, 'Activity', 'Activity'),
(3, 'Client-based Project', 'Client-based Project'),
(4, 'Course', 'Course');

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE IF NOT EXISTS `report` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` varchar(10000) DEFAULT NULL,
  `submit_date` datetime DEFAULT NULL,
  `project_id` int(11) NOT NULL,
  `division_id` int(11) NOT NULL,
  `requested_user_id` int(11) NOT NULL,
  `approved_user_id` int(11) DEFAULT NULL,
  `file` varchar(45) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`id`, `title`, `content`, `submit_date`, `project_id`, `division_id`, `requested_user_id`, `approved_user_id`, `file`) VALUES
(6, 'Requisition form 1', 'Content', '2015-08-14 01:08:48', 6, 6, 7, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `team_member`
--

CREATE TABLE IF NOT EXISTS `team_member` (
  `project_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `epf_no` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `name`, `epf_no`) VALUES
(6, 'admin', 'hpWtVcw_ls2heKPtEryiW2mnxjzDmqCJ', '$2y$13$fvpXojBqXGmBGG2v46QuGelMIczOiwHgm0ZGzSpnQ6Egs1SWnIvJK', NULL, 'admin@accmt.ac.lk', 10, 1439485843, 1439485843, 'System Admin', '1'),
(7, 'allaccess', 'ehdxr0H17Qq2TQBjVmJO3dNXXttfoKXM', '$2y$13$OtV.Wpw4k7tr/WsFiU3WyOeOLBMdn879wf0YeiXbprhP2Pelyx51K', NULL, 'allaccess@accmt.ac.lk', 10, 1439485921, 1439485921, 'All access', '2'),
(8, 'ddg', 'x934lEjrDE0AI2cDYGI60I25xHBCwBWT', '$2y$13$v3IWyIJPsQzHV/J/Fdw8PuwkgZ0Rv2Gxf4Z5yIetwnmYAK4SxntGi', NULL, 'ddg@accmt.ac.lk', 10, 1439537403, 1439537403, 'Deputy Director Genaral', '3'),
(9, 'dhit', 'QzYe4SPpBTwMNdUP4B8w4OboT_ubkMVY', '$2y$13$oacLlArcS/xRdpzc9l1aIeSwq8LWlld9s0ebQjnuN/Uvpn5Lb9M76', NULL, 'dhit@accmt.ac.lk', 10, 1439537482, 1439537482, 'Divisional Head IT', '4'),
(10, 'Engineer', 'KxVCio72MBDdJcWdFOlRlPueOLKroqoQ', '$2y$13$9OGK/GTlkzV/KTliHOAB5ecBGK5ntTeKSirnxdvowcx9/VaFt.Ipa', NULL, 'engineer@accmt.ac.lk', 10, 1439538008, 1439538255, 'Engineer Electronics & Microelectronics Division', '5'),
(11, 'shstores', '3nvkXODdEmdFTaxdHj08vxonuMG8MCb0', '$2y$13$BUiXzvcpP7/t0IPnuO2GkeYBwE.ZYuupUW0omI/BkaKXhm/jkCWqy', NULL, 'shstores@accmt.ac.lk', 10, 1439538322, 1439538322, 'Sectional Head Stores', '6'),
(12, 'ssstores', 'MakUHrRv6PKGyS1w9fkyagzQ9nDRQ5IF', '$2y$13$q5joQ2JmPIdDF.hdPp1e6.BpQnHOh/8fPdRhf.XBigSt/EFyNvB1q', NULL, 'ssstaff@accmt.ac.lk', 10, 1439538386, 1439538386, 'Sectional Staff Stores', '7');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`),
  ADD KEY `fk_auth_item_has_user_user1_idx` (`user_id`),
  ADD KEY `fk_auth_item_has_user_auth_item1_idx` (`item_name`);

--
-- Indexes for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `type` (`type`);

--
-- Indexes for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `fk_auth_item_has_auth_item_auth_item2_idx` (`child`),
  ADD KEY `fk_auth_item_has_auth_item_auth_item1_idx` (`parent`);

--
-- Indexes for table `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `division`
--
ALTER TABLE `division`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`);

--
-- Indexes for table `division_has_user`
--
ALTER TABLE `division_has_user`
  ADD PRIMARY KEY (`division_id`,`user_id`),
  ADD KEY `fk_division_has_user_user1_idx` (`user_id`),
  ADD KEY `fk_division_has_user_division1_idx` (`division_id`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_project_project_idx` (`parent_project_id`),
  ADD KEY `fk_project_user1_idx` (`requested_user_id`),
  ADD KEY `fk_project_user2_idx` (`approved_ddg_user_id`),
  ADD KEY `fk_project_user3_idx` (`approved_dh_user_id`),
  ADD KEY `fk_project_project_type1_idx` (`project_type_id`),
  ADD KEY `fk_project_division1_idx` (`division_id`),
  ADD KEY `fk_project_user4_idx` (`team_leader`);

--
-- Indexes for table `project_type`
--
ALTER TABLE `project_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_report_project1_idx` (`project_id`),
  ADD KEY `fk_report_division1_idx` (`division_id`),
  ADD KEY `fk_report_user1_idx` (`requested_user_id`),
  ADD KEY `fk_report_user2_idx` (`approved_user_id`);

--
-- Indexes for table `team_member`
--
ALTER TABLE `team_member`
  ADD PRIMARY KEY (`project_id`,`user_id`),
  ADD KEY `fk_project_has_user_user1_idx` (`user_id`),
  ADD KEY `fk_project_has_user_project1_idx` (`project_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`),
  ADD UNIQUE KEY `edf_no_UNIQUE` (`epf_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `division`
--
ALTER TABLE `division`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `fk_auth_item_has_user_auth_item1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_auth_item_has_user_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `fk_auth_item_has_auth_item_auth_item1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_auth_item_has_auth_item_auth_item2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `division_has_user`
--
ALTER TABLE `division_has_user`
  ADD CONSTRAINT `fk_division_has_user_division1` FOREIGN KEY (`division_id`) REFERENCES `division` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_division_has_user_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `project`
--
ALTER TABLE `project`
  ADD CONSTRAINT `fk_project_division1` FOREIGN KEY (`division_id`) REFERENCES `division` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_project_project` FOREIGN KEY (`parent_project_id`) REFERENCES `project` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_project_project_type1` FOREIGN KEY (`project_type_id`) REFERENCES `project_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_project_user1` FOREIGN KEY (`requested_user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_project_user2` FOREIGN KEY (`approved_ddg_user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_project_user3` FOREIGN KEY (`approved_dh_user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_project_user4` FOREIGN KEY (`team_leader`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `report`
--
ALTER TABLE `report`
  ADD CONSTRAINT `fk_report_division1` FOREIGN KEY (`division_id`) REFERENCES `division` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_report_project1` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_report_user1` FOREIGN KEY (`requested_user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_report_user2` FOREIGN KEY (`approved_user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `team_member`
--
ALTER TABLE `team_member`
  ADD CONSTRAINT `fk_project_has_user_project1` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_project_has_user_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
