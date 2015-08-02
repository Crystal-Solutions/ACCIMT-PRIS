-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.6.21


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema pris
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ pris;
USE pris;

--
-- Table structure for table `pris`.`division`
--

DROP TABLE IF EXISTS `division`;
CREATE TABLE `division` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pris`.`division`
--

/*!40000 ALTER TABLE `division` DISABLE KEYS */;
/*!40000 ALTER TABLE `division` ENABLE KEYS */;


--
-- Table structure for table `pris`.`privilege`
--

DROP TABLE IF EXISTS `privilege`;
CREATE TABLE `privilege` (
  `role_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`role_id`,`user_id`),
  KEY `fk_role_has_user_user1_idx` (`user_id`),
  KEY `fk_role_has_user_role1_idx` (`role_id`),
  CONSTRAINT `fk_role_has_user_role1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_role_has_user_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pris`.`privilege`
--

/*!40000 ALTER TABLE `privilege` DISABLE KEYS */;
/*!40000 ALTER TABLE `privilege` ENABLE KEYS */;


--
-- Table structure for table `pris`.`project`
--

DROP TABLE IF EXISTS `project`;
CREATE TABLE `project` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `project_type_id` int(11) NOT NULL,
  `division_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`project_type_id`,`division_id`),
  KEY `fk_project_project_type_idx` (`project_type_id`),
  KEY `fk_project_division1_idx` (`division_id`),
  CONSTRAINT `fk_project_division1` FOREIGN KEY (`division_id`) REFERENCES `division` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_project_project_type` FOREIGN KEY (`project_type_id`) REFERENCES `project_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pris`.`project`
--

/*!40000 ALTER TABLE `project` DISABLE KEYS */;
/*!40000 ALTER TABLE `project` ENABLE KEYS */;


--
-- Table structure for table `pris`.`project_type`
--

DROP TABLE IF EXISTS `project_type`;
CREATE TABLE `project_type` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pris`.`project_type`
--

/*!40000 ALTER TABLE `project_type` DISABLE KEYS */;
/*!40000 ALTER TABLE `project_type` ENABLE KEYS */;


--
-- Table structure for table `pris`.`report`
--

DROP TABLE IF EXISTS `report`;
CREATE TABLE `report` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `state` int(11) NOT NULL DEFAULT '0',
  `name` varchar(45) NOT NULL,
  `time` datetime NOT NULL,
  `project_id` int(11) NOT NULL,
  `project_project_type_id1` int(11) NOT NULL,
  `division_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`project_id`,`project_project_type_id1`,`division_id`,`user_id`),
  KEY `fk_report_project2_idx` (`project_id`,`project_project_type_id1`),
  KEY `fk_report_division1_idx` (`division_id`),
  KEY `fk_report_user1_idx` (`user_id`),
  CONSTRAINT `fk_report_division1` FOREIGN KEY (`division_id`) REFERENCES `division` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_report_project2` FOREIGN KEY (`project_id`, `project_project_type_id1`) REFERENCES `project` (`id`, `project_type_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_report_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pris`.`report`
--

/*!40000 ALTER TABLE `report` DISABLE KEYS */;
/*!40000 ALTER TABLE `report` ENABLE KEYS */;


--
-- Table structure for table `pris`.`role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `division_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`division_id`),
  KEY `fk_role_division1_idx` (`division_id`),
  CONSTRAINT `fk_role_division1` FOREIGN KEY (`division_id`) REFERENCES `division` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pris`.`role`
--

/*!40000 ALTER TABLE `role` DISABLE KEYS */;
/*!40000 ALTER TABLE `role` ENABLE KEYS */;


--
-- Table structure for table `pris`.`user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(100) DEFAULT NULL,
  `auth_key` varchar(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(45) NOT NULL,
  `username` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pris`.`user`
--

/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`,`token`,`auth_key`,`name`,`email`,`password`,`username`) VALUES 
 (1,'afdafad','afadfa','Janaka Chathuranga','bjchathuranga@gmail.com','1234','janakact');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
