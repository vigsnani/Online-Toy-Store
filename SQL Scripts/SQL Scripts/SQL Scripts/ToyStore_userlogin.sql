-- MySQL dump 10.13  Distrib 5.6.24, for osx10.8 (x86_64)
--
-- Host: localhost    Database: ToyStore
-- ------------------------------------------------------
-- Server version	5.6.28

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
-- Table structure for table `userlogin`
--

DROP TABLE IF EXISTS `userlogin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `userlogin` (
  `User_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Fullname` varchar(150) NOT NULL,
  `Email` varchar(150) NOT NULL,
  `Password` varchar(80) NOT NULL,
  `salt` varchar(50) NOT NULL,
  `UserRole` int(11) NOT NULL DEFAULT '1',
  `confirmcode` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`User_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userlogin`
--

LOCK TABLES `userlogin` WRITE;
/*!40000 ALTER TABLE `userlogin` DISABLE KEYS */;
INSERT INTO `userlogin` VALUES (1,'John Doe','john.doe@email.com','R7EHXekK/Ycjksbup+Si1bbULDk4MzU2MTIzZWQ2','8356123ed6',1,'4a36af6ce92f85893c9f7d44bda9bd9c'),(2,'John Smith','john.smith@email.com','YRYQ1LlKOAguV0/6E7y3suLTUWo0Y2VmZWViMTE1','4cefeeb115',1,'c11d2c8bb8ee7ff59c8aee793cd6de5f'),(3,'Regular Customer 1','regular.customer1@email.com','CThkyDRKTl5BToPmUm80Y/0c5XplOTcxZGU2NGFk','e971de64ad',1,'dcb34a9ada855e14ff05b596366729e7'),(4,'Regular Customer 2','regular.customer2@email.com','G0VHgK6O2hbsZpFKhH8QLSbCWlc4MTNjMmJjNmQ2','813c2bc6d6',1,'7fddfa69d95cbfd1390d33757216cb3a'),(5,'Administrator','admin.user@admin.com','WqfPRbjTv3j93ZqKqqDeqJ/11JplN2ZkY2QyNmQx','e7fdcd26d1',10,'ff81cc56a1a709f72f23d15a387b634d'),(6,'Regular Customer 3','regular.customer3@email.com','PysUR5W5+4HGIaz/NmPOkcjGlt0yOWZkNGMwYjZi','29fd4c0b6b',1,'aa404f266f469b4827df2634298ca595'),(7,'priyaa','aaa@gmail.com','7Hj+H40scXRVkrXs4oseDwXluAZkN2I0NjQ5MmM1','d7b46492c5',1,'ba7b5e62c378c9c80ac434580f0f239a');
/*!40000 ALTER TABLE `userlogin` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-12-07 12:21:17
