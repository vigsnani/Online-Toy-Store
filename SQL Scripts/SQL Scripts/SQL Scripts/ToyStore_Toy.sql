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
-- Table structure for table `Toy`
--

DROP TABLE IF EXISTS `Toy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Toy` (
  `toy_id` int(50) NOT NULL AUTO_INCREMENT,
  `toy_name` varchar(50) NOT NULL,
  `description` varchar(500) NOT NULL,
  `price` float NOT NULL,
  `total_available` int(10) NOT NULL,
  `image` varchar(50) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`toy_id`)
) ENGINE=InnoDB AUTO_INCREMENT=135 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Toy`
--

LOCK TABLES `Toy` WRITE;
/*!40000 ALTER TABLE `Toy` DISABLE KEYS */;
INSERT INTO `Toy` VALUES (101,'Craft Kits','This is a test product description.\r\nQixels S3 3D Maker',39.99,19,'2.jpg',1),(103,'easles','Step2 Easel with Bonus Magnetic Letters/Numbers',58.9,45,'39.jpg',1),(104,'Aqua beads','AquaBeads Ultimate Design Studio Playset',89.12,230,'41.jpg',1),(105,'Black and Whiteboards','Deluxe Standing-Chalkboard & Number Magnets',45.88,50,'42.jpg',1),(106,'Scienctific Microscope','Beginner Microscope Kit. 100x 200x 450x Includes 23 Piece',19.99,56,'43.jpg',1),(107,'reading & writing','VTech Write and Learn Creative Center',25.99,78,'44.jpg',1),(108,'Early Development','Lewo Wooden Toddler Toys Circle Bead Maze for Boys Girls',29.99,90,'45.jpg',1),(109,'Electronic Learning','RockJam 54-Key Portable Electronic Keyboard with Interactive LCD Screen & Includes Piano Maestro Teaching App with 30 Songs',50.99,100,'46.jpg',1),(110,'Basic LifeSkills','Alesis CompactKit 7 | Portable 7-Pad Tabletop Electronic Drum Kit with Drumsticks & Footswitch Pedals',157.99,10,'47.jpg',1),(111,'Life Skills','Little Tikes Count \'n Play Cash Register Playset',12.99,89,'48.jpg',1),(112,'Mathematics','Melissa & Doug Stack & Count Parking Garage',16,150,'49.jpg',1),(113,'3-D Puzzles','aGreatLife 3x3x3 Carbon Fiber Sticker Speed Cube: Expand Your Mind With Hours of Logical Fun – Easily Twist With Superior Cornering - Hand-Held Games That Educate',14.2,80,'50.jpg',1),(114,'Brain Teasers','Dreampark Pyraminx Pyramid Speed Cube, Black',10.99,149,'51.jpg',1),(115,'Floor Puzzles','Disney Minnie 25-piece Floor Foam Puzzle Mat',12.65,200,'52.jpg',1),(116,'Pegged Puzzles','Melissa & Doug First Shapes Jumbo Knob Wooden Puzzle',6.99,120,'53.jpg',1),(117,'Jigsaw Puzzles','Bits and Pieces - Foldaway Jigsaw Puzzle Table - Set Up Puzzle Fun Anywhere - Folds Flat for Easy Storage When Not In Use - Puzzle Accessories',149.99,60,'54.jpg',1),(118,' Puzzle Accessories','Lewo Wooden Educational Toys Magnetic Art Easel Animals Puzzle Games for Kids',11.99,99,'55.jpg',1),(119,'Ride-On Toys','bikestar 25.4cm (10 Inch) Kids Learner Balance Running Bike - Wooden - Princess',55.99,190,'56.jpg',1),(120,'Plush Interactives','FurReal Friends Baby Cuddles My Giggly Monkey Pet Plush',60.89,250,'57.jpg',1),(121,'Play Trains ','Electric Toy Train. Battery Powered with Music and Lights. Gift for kids and toddlers.',25.99,45,'58.jpg',1),(122,' Plush Puppets','Ty Boo Buddy Slush Dog',6.99,95,'59.jpg',1),(123,'Toy RC Vehicles','Air Hogs Star Wars Remote Control Millennium Falcon Quad',24.99,140,'60.jpg',1),(124,'Die-Cast Vehicles','Hot Wheels City Blastin\' Rig',26.99,69,'61.jpg',1),(125,'PlayStation 4','Madden NFL 17 - Standard Edition - PlayStation 4',45.99,30,'62.jpg',1),(126,'Xbox One','FIFA 17 - Xbox One',39.99,79,'63.jpg',1),(127,' Wii','Skylanders Imaginators Magic Creation Crystal',11.98,200,'64.jpg',1),(128,'Star Wars','Disney Infinity 3.0 Edition: Star Wars Yoda Figure',3.99,120,'65.jpg',1),(129,'Barbie','Barbie Chelsea Dreamtopia Vehicle',36.89,130,'7.jpg',1),(130,'DreamHouses','Barbie Glam Getaway House',19.98,300,'66.jpg',1),(132,'Lionel Polar Express Ready to Play Train Set OLD',' This year, showcase the magic of Christmas with the iconic Polar Express train set.\r\nDimensions: 50\" x 73.2\" oval of Ready-to-Play track. 24 pieces of curved and 8 straight plastic track pieces\r\nRemo',69.99,10,'Lionel Train Set.jpeg',1),(133,'Test New Product','this is atest/',10,10,'',1),(134,'Lionel Polar Express Ready to Play Train Set',' This year, showcase the magic of Christmas with the iconic Polar Express train set.\r\nDimensions: 50\" x 73.2\" oval of Ready-to-Play track. 24 pieces of curved and 8 straight plastic track pieces\r\nRemo',1000,21,'Lionel Train Set.jpeg',1);
/*!40000 ALTER TABLE `Toy` ENABLE KEYS */;
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
