CREATE DATABASE  IF NOT EXISTS `social` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `social`;
-- MySQL dump 10.13  Distrib 5.6.13, for Win32 (x86)
--
-- Host: localhost    Database: social
-- ------------------------------------------------------
-- Server version	5.6.14

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `reply`
--

DROP TABLE IF EXISTS `reply`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reply` (
  `Rid` int(11) NOT NULL AUTO_INCREMENT,
  `Pid` int(11) DEFAULT NULL,
  `Uid` char(30) DEFAULT NULL,
  `content` text,
  `time` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`Rid`),
  KEY `Uid` (`Uid`),
  KEY `Pid` (`Pid`),
  CONSTRAINT `reply_ibfk_1` FOREIGN KEY (`Uid`) REFERENCES `userinfo` (`Uid`) ON DELETE CASCADE,
  CONSTRAINT `reply_ibfk_2` FOREIGN KEY (`Pid`) REFERENCES `post` (`Pid`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reply`
--

LOCK TABLES `reply` WRITE;
/*!40000 ALTER TABLE `reply` DISABLE KEYS */;
INSERT INTO `reply` VALUES (33,37,'hehe','omg!!!','2015-07-01 12:04:04'),(34,36,'hehe','hahaha','2015-07-01 12:04:12'),(35,40,'loli','haha','2015-07-01 12:06:49'),(36,39,'loli','I wanna buy one!','2015-07-01 12:07:14'),(37,42,'Tom','LG watch? quite nice!','2015-07-01 14:36:33'),(38,41,'Tom','Looks like real!','2015-07-01 14:36:46'),(39,40,'Tom','I\'ve got a black&white version of pebble,find it nice and wanna get a new one!','2015-07-01 14:37:17'),(40,39,'Tom','There\'s nothing better than getting a view in the sky!','2015-07-01 14:37:44'),(41,38,'Tom','Computer stick?!','2015-07-01 14:37:54'),(42,36,'Tom','Oh great!','2015-07-01 14:38:13'),(43,27,'Tom','Control my tuns?','2015-07-01 14:38:31'),(44,32,'Tom','HaHa!','2015-07-01 14:38:46'),(47,48,'tim','欢迎！','2015-07-01 20:59:59'),(48,48,'tim','换个头像啊','2015-07-01 21:00:14');
/*!40000 ALTER TABLE `reply` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-07-01 21:29:31
