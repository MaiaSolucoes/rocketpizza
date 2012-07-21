CREATE DATABASE  IF NOT EXISTS `rocketpizza` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `rocketpizza`;
-- MySQL dump 10.13  Distrib 5.5.16, for Win32 (x86)
--
-- Host: localhost    Database: rocketpizza
-- ------------------------------------------------------
-- Server version	5.5.16

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
-- Table structure for table `site_menu`
--

DROP TABLE IF EXISTS `site_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `site_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `href` varchar(250) COLLATE utf8_bin NOT NULL,
  `description` varchar(50) COLLATE utf8_bin NOT NULL,
  `position` set('nav','left','right','bot') COLLATE utf8_bin NOT NULL,
  `is_active` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `site_menu`
--

LOCK TABLES `site_menu` WRITE;
/*!40000 ALTER TABLE `site_menu` DISABLE KEYS */;
INSERT INTO `site_menu` VALUES (1,'http://www.google.com.br','Google','nav',''),(2,'http://www.facebook.com','Facebook','nav',''),(3,'http://www.uol.com.br','UOL','nav','');
/*!40000 ALTER TABLE `site_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `avaiable_layout`
--

DROP TABLE IF EXISTS `avaiable_layout`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `avaiable_layout` (
  `id_layout` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_bin NOT NULL,
  `css_source_folder` varchar(45) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id_layout`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `avaiable_layout`
--

LOCK TABLES `avaiable_layout` WRITE;
/*!40000 ALTER TABLE `avaiable_layout` DISABLE KEYS */;
INSERT INTO `avaiable_layout` VALUES (1,'default','default');
/*!40000 ALTER TABLE `avaiable_layout` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `site_config`
--

DROP TABLE IF EXISTS `site_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `site_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `head_logo_path` varchar(250) COLLATE utf8_bin NOT NULL,
  `description` varchar(250) COLLATE utf8_bin NOT NULL,
  `is_active` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `site_config`
--

LOCK TABLES `site_config` WRITE;
/*!40000 ALTER TABLE `site_config` DISABLE KEYS */;
INSERT INTO `site_config` VALUES (1,'uploads/1.jpg','Maia SC','');
/*!40000 ALTER TABLE `site_config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `site_layout_config`
--

DROP TABLE IF EXISTS `site_layout_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `site_layout_config` (
  `idsite_layout_config` int(11) NOT NULL AUTO_INCREMENT,
  `id_selected_layout` int(11) NOT NULL,
  `body_background_color` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`idsite_layout_config`),
  KEY `FK_layout_config_avaiable_layout` (`id_selected_layout`),
  CONSTRAINT `FK_layout_config_avaiable_layout` FOREIGN KEY (`id_selected_layout`) REFERENCES `avaiable_layout` (`id_layout`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `site_layout_config`
--

LOCK TABLES `site_layout_config` WRITE;
/*!40000 ALTER TABLE `site_layout_config` DISABLE KEYS */;
INSERT INTO `site_layout_config` VALUES (1,1,'#000000');
/*!40000 ALTER TABLE `site_layout_config` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-07-14  2:16:35
