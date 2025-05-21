-- MySQL dump 10.14  Distrib 5.5.68-MariaDB, for Linux (x86_64)
--
-- Host: feenix-mariadb.swin.edu.au    Database: s100589839_db
-- ------------------------------------------------------
-- Server version	5.5.68-MariaDB

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
-- Table structure for table `cars`
--

DROP TABLE IF EXISTS `cars`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cars` (
  `car_ID` int(11) NOT NULL AUTO_INCREMENT,
  `make` varchar(25) NOT NULL,
  `model` varchar(40) NOT NULL,
  `price` float NOT NULL,
  `yom` int(11) NOT NULL,
  PRIMARY KEY (`car_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cars`
--

/*!40000 ALTER TABLE `cars` DISABLE KEYS */;
INSERT INTO `cars` VALUES (1,'BMW','X3',35000,2010),(2,'Holden','Astra',14000,2009),(3,'Ford','Falcon',39000,2013),(4,'Toyota','Corolla',20000,2012),(5,'Holden','Commodore',13500,2005),(6,'Holden','Astra',8000,2004),(7,'Holden','Commodore',28000,2009),(8,'Ford','Falcon',14000,2011),(9,'Ford','Falcon',7000,2003),(10,'Ford','Laser',10000,2010);
/*!40000 ALTER TABLE `cars` ENABLE KEYS */;

--
-- Table structure for table `eoi`
--

DROP TABLE IF EXISTS `eoi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `eoi` (
  `eoi_id` int(11) NOT NULL AUTO_INCREMENT,
  `job_ref` varchar(10) NOT NULL,
  `status` enum('New','Current','Final') NOT NULL DEFAULT 'New',
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(50) NOT NULL,
  `street_address` varchar(255) NOT NULL,
  `suburb_address` varchar(100) NOT NULL,
  `state_address` varchar(3) NOT NULL,
  `postcode` smallint(6) NOT NULL,
  `skill_1` varchar(100) DEFAULT NULL,
  `skill_2` varchar(100) DEFAULT NULL,
  `skill_3` varchar(100) DEFAULT NULL,
  `skill_4` varchar(100) DEFAULT NULL,
  `skill_5` varchar(100) DEFAULT NULL,
  `miscinfo` text,
  PRIMARY KEY (`eoi_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eoi`
--

/*!40000 ALTER TABLE `eoi` DISABLE KEYS */;
/*!40000 ALTER TABLE `eoi` ENABLE KEYS */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-05-07 10:41:30
