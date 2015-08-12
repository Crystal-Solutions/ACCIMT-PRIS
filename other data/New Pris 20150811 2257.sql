-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.6.21




--
-- Create schema pris_advanced
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ pris_advanced;
USE pris_advanced;

--
-- Table structure for table `pris_advanced`.`auth_assignment`
--

DROP TABLE IF EXISTS `auth_assignment`;
CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  KEY `fk_auth_item_has_user_user1_idx` (`user_id`),
  KEY `fk_auth_item_has_user_auth_item1_idx` (`item_name`),
  CONSTRAINT `fk_auth_item_has_user_auth_item1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_auth_item_has_user_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pris_advanced`.`auth_assignment`
--

/*!40000 ALTER TABLE `auth_assignment` DISABLE KEYS */;
INSERT INTO `auth_assignment` (`item_name`,`user_id`,`created_at`) VALUES 
 ('divisional-head',1,NULL),
 ('divisional-head',5,NULL),
 ('engineer',2,NULL),
 ('engineer',5,NULL),
 ('system-admin',3,NULL);
/*!40000 ALTER TABLE `auth_assignment` ENABLE KEYS */;


--
-- Table structure for table `pris_advanced`.`auth_item`
--

DROP TABLE IF EXISTS `auth_item`;
CREATE TABLE `auth_item` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `rule_name` varchar(64) DEFAULT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pris_advanced`.`auth_item`
--

/*!40000 ALTER TABLE `auth_item` DISABLE KEYS */;
INSERT INTO `auth_item` (`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) VALUES 
 ('change-access-level',1,'allows system admin to change user access level',NULL,NULL,NULL,NULL),
 ('change-project-state',1,'allows ddg to change project state',NULL,NULL,NULL,NULL),
 ('create-auth-assignment',1,'allow user to create auth assignment',NULL,NULL,NULL,NULL),
 ('create-division',1,'allows system admin to create a new division',NULL,NULL,NULL,NULL),
 ('create-project',1,'allows an engineer to add a project',NULL,NULL,NULL,NULL),
 ('create-report',1,'allows sectional users to add sectional inputs',NULL,NULL,NULL,NULL),
 ('create-user',1,'allows system admin to create a new user',NULL,NULL,NULL,NULL),
 ('delete-auth-assignment',1,'allow user to delete auth assignment',NULL,NULL,NULL,NULL),
 ('delete-division',1,'allows user to delete division',NULL,NULL,NULL,NULL),
 ('delete-project',1,'allows user to delete a project',NULL,NULL,NULL,NULL),
 ('delete-report',1,'allows a user to delete a report',NULL,NULL,NULL,NULL),
 ('delete-user',1,'allows user to delete a user',NULL,NULL,NULL,NULL);
INSERT INTO `auth_item` (`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) VALUES 
 ('deputy-director-genaral',2,'allows ddg to approve projects and to change project state',NULL,NULL,NULL,NULL),
 ('divisional-head',2,'allows divisional head to approve projects and approve project updates + create project and update',NULL,NULL,NULL,NULL),
 ('engineer',2,'allows user to create and update projects',NULL,NULL,NULL,NULL),
 ('mark-ddg-approval',1,'allows ddg to mark approval',NULL,NULL,NULL,NULL),
 ('mark-dh-approval',1,'allows the divisional head to mark approval',NULL,NULL,NULL,NULL),
 ('mark-report-approval',1,'allows sectional head to mark sectional input approval',NULL,NULL,NULL,NULL),
 ('mark-update-approval',1,'allows dh to mark approval for project updates',NULL,NULL,NULL,NULL),
 ('sectional-head',2,'allows user to approve and crud reports',NULL,NULL,NULL,NULL),
 ('sectional-staff',2,'allow user to crud reports',NULL,NULL,NULL,NULL),
 ('system-admin',2,'system admin can crud divisions, crud users, crud auth-assignment and change user access level',NULL,NULL,NULL,NULL),
 ('update-auth-assignment',1,'allow user to update auth assignment',NULL,NULL,NULL,NULL);
INSERT INTO `auth_item` (`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) VALUES 
 ('update-division',1,'allows user to update division',NULL,NULL,NULL,NULL),
 ('update-project',1,'allows user to update project details',NULL,NULL,NULL,NULL),
 ('update-report',1,'allows user to update a report',NULL,NULL,NULL,NULL),
 ('update-user',1,'allows user to update a user',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `auth_item` ENABLE KEYS */;


--
-- Table structure for table `pris_advanced`.`auth_item_child`
--

DROP TABLE IF EXISTS `auth_item_child`;
CREATE TABLE `auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `fk_auth_item_has_auth_item_auth_item2_idx` (`child`),
  KEY `fk_auth_item_has_auth_item_auth_item1_idx` (`parent`),
  CONSTRAINT `fk_auth_item_has_auth_item_auth_item1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_auth_item_has_auth_item_auth_item2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pris_advanced`.`auth_item_child`
--

/*!40000 ALTER TABLE `auth_item_child` DISABLE KEYS */;
INSERT INTO `auth_item_child` (`parent`,`child`) VALUES 
 ('system-admin','change-access-level'),
 ('deputy-director-genaral','change-project-state'),
 ('system-admin','create-auth-assignment'),
 ('system-admin','create-division'),
 ('divisional-head','create-project'),
 ('engineer','create-project'),
 ('sectional-head','create-report'),
 ('sectional-staff','create-report'),
 ('system-admin','create-user'),
 ('system-admin','delete-auth-assignment'),
 ('system-admin','delete-division'),
 ('divisional-head','delete-project'),
 ('sectional-head','delete-report'),
 ('sectional-staff','delete-report'),
 ('system-admin','delete-user'),
 ('deputy-director-genaral','mark-ddg-approval'),
 ('divisional-head','mark-dh-approval'),
 ('sectional-head','mark-report-approval'),
 ('divisional-head','mark-update-approval'),
 ('system-admin','update-auth-assignment'),
 ('system-admin','update-division'),
 ('divisional-head','update-project'),
 ('engineer','update-project'),
 ('sectional-head','update-report'),
 ('sectional-staff','update-report');
INSERT INTO `auth_item_child` (`parent`,`child`) VALUES 
 ('system-admin','update-user');
/*!40000 ALTER TABLE `auth_item_child` ENABLE KEYS */;


--
-- Table structure for table `pris_advanced`.`auth_rule`
--

DROP TABLE IF EXISTS `auth_rule`;
CREATE TABLE `auth_rule` (
  `name` varchar(64) NOT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pris_advanced`.`auth_rule`
--

/*!40000 ALTER TABLE `auth_rule` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_rule` ENABLE KEYS */;


--
-- Table structure for table `pris_advanced`.`division`
--

DROP TABLE IF EXISTS `division`;
CREATE TABLE `division` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(600) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pris_advanced`.`division`
--

/*!40000 ALTER TABLE `division` DISABLE KEYS */;
INSERT INTO `division` (`id`,`name`,`description`) VALUES 
 (1,'Electronics & Microelectronics Division','Conduct research & development work related to electronics, telecommunications, robotics and automation'),
 (2,'Information Technology Division','Software translation, computer vision and assistance for e-governance'),
 (3,'Space Technologies Division','Research work on RS/GIS, Space Technology based National Capacity Development, Research work on Astronomy, Astronomy popularization programme');
/*!40000 ALTER TABLE `division` ENABLE KEYS */;


--
-- Table structure for table `pris_advanced`.`division_has_user`
--

DROP TABLE IF EXISTS `division_has_user`;
CREATE TABLE `division_has_user` (
  `division_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`division_id`,`user_id`),
  KEY `fk_division_has_user_user1_idx` (`user_id`),
  KEY `fk_division_has_user_division1_idx` (`division_id`),
  CONSTRAINT `fk_division_has_user_division1` FOREIGN KEY (`division_id`) REFERENCES `division` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_division_has_user_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pris_advanced`.`division_has_user`
--

/*!40000 ALTER TABLE `division_has_user` DISABLE KEYS */;
INSERT INTO `division_has_user` (`division_id`,`user_id`) VALUES 
 (2,2),
 (3,4),
 (1,5),
 (2,5);
/*!40000 ALTER TABLE `division_has_user` ENABLE KEYS */;


--
-- Table structure for table `pris_advanced`.`migration`
--

DROP TABLE IF EXISTS `migration`;
CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pris_advanced`.`migration`
--

/*!40000 ALTER TABLE `migration` DISABLE KEYS */;
/*!40000 ALTER TABLE `migration` ENABLE KEYS */;


--
-- Table structure for table `pris_advanced`.`project`
--

DROP TABLE IF EXISTS `project`;
CREATE TABLE `project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`id`),
  KEY `fk_project_project_idx` (`parent_project_id`),
  KEY `fk_project_user1_idx` (`requested_user_id`),
  KEY `fk_project_user2_idx` (`approved_ddg_user_id`),
  KEY `fk_project_user3_idx` (`approved_dh_user_id`),
  KEY `fk_project_project_type1_idx` (`project_type_id`),
  CONSTRAINT `fk_project_project` FOREIGN KEY (`parent_project_id`) REFERENCES `project` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_project_project_type1` FOREIGN KEY (`project_type_id`) REFERENCES `project_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_project_user1` FOREIGN KEY (`requested_user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_project_user2` FOREIGN KEY (`approved_ddg_user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_project_user3` FOREIGN KEY (`approved_dh_user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pris_advanced`.`project`
--

/*!40000 ALTER TABLE `project` DISABLE KEYS */;
/*!40000 ALTER TABLE `project` ENABLE KEYS */;


--
-- Table structure for table `pris_advanced`.`project_type`
--

DROP TABLE IF EXISTS `project_type`;
CREATE TABLE `project_type` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(1023) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pris_advanced`.`project_type`
--

/*!40000 ALTER TABLE `project_type` DISABLE KEYS */;
/*!40000 ALTER TABLE `project_type` ENABLE KEYS */;


--
-- Table structure for table `pris_advanced`.`report`
--

DROP TABLE IF EXISTS `report`;
CREATE TABLE `report` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `content` varchar(10000) DEFAULT NULL,
  `submit_date` datetime DEFAULT NULL,
  `project_id` int(11) NOT NULL,
  `division_id` int(11) NOT NULL,
  `requested_user_id` int(11) NOT NULL,
  `approved_user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_report_project1_idx` (`project_id`),
  KEY `fk_report_division1_idx` (`division_id`),
  KEY `fk_report_user1_idx` (`requested_user_id`),
  KEY `fk_report_user2_idx` (`approved_user_id`),
  CONSTRAINT `fk_report_division1` FOREIGN KEY (`division_id`) REFERENCES `division` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_report_project1` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_report_user1` FOREIGN KEY (`requested_user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_report_user2` FOREIGN KEY (`approved_user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pris_advanced`.`report`
--

/*!40000 ALTER TABLE `report` DISABLE KEYS */;
/*!40000 ALTER TABLE `report` ENABLE KEYS */;


--
-- Table structure for table `pris_advanced`.`user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `epf_no` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`),
  UNIQUE KEY `edf_no_UNIQUE` (`epf_no`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pris_advanced`.`user`
--

/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`,`username`,`auth_key`,`password_hash`,`password_reset_token`,`email`,`status`,`created_at`,`updated_at`,`name`,`epf_no`) VALUES 
 (1,'Janakact','A2IENsEgyzLc3wP79aSJiKWZa0k8OGoM','$2y$13$RHj9lf7I771ffK551ikHvO.JfnH6ds0cqGbKk2WOevmFKVmIx5iJ6',NULL,'janaka.13@cse.mrt.ac.lk',10,1438938614,1438938614,NULL,NULL),
 (2,'Shanika','xXJFyB_uaHxyR77RjPiQ2hx93To603Yp','$2y$13$uEQd1NhJaXAa0By6i9hiSuKejeyXRlnmgDzs2rt4vVxylozKhSylC',NULL,'shanika.13@cse.mrt.ac.lk',10,1438938687,1439311261,'Shanika Ediriweera','epf8888'),
 (3,'Rasika','X867c1omKqOyPTOg-ziND3e2jMFqW6k8','$2y$13$0to6y1NFIkHeJHr1K4TDM.PyuigPbasoHV1t4nf3k5P7MLjuvl/ti',NULL,'rasika@accmt.ac.lk',10,1438947706,1438947706,NULL,NULL),
 (4,'Ravindu','22uL-MOiwJXAL7GVFPQA-MjnEMjgYu3z','$2y$13$J1cU2fRc.Cj1m3A4D6u2K.axn8kH1YlHYBap7ugvUHMGx6lku.KiC',NULL,'ravindu.13@cse.mrt.ac.lk',10,1439311210,1439311210,'Ravindu Hasantha','epf9999'),
 (5,'ksajfdljalfasl','ll-0PuaGf0PxaP0XBYsDncIUjVMYe2F9','$2y$13$VDA..I0l97cregO4HtG57eZ1McwGXG7pYlM8gEnSEyoOW0ad20Tva',NULL,'asd@asd.com',10,1439313976,1439313976,'Sameera','kadjfls');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
