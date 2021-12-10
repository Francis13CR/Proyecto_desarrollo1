-- MySQL dump 10.13  Distrib 8.0.27, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: fototop
-- ------------------------------------------------------
-- Server version	8.0.27

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `images` (
  `id` int NOT NULL AUTO_INCREMENT,
  `autor` varchar(45) NOT NULL DEFAULT '0',
  `title` varchar(50) NOT NULL,
  `description` varchar(250) NOT NULL,
  `id_category` int NOT NULL DEFAULT '0',
  `main_image` varchar(50) NOT NULL,
  `pub_date` datetime NOT NULL,
  `status` tinyint NOT NULL DEFAULT '0',
  `id_admin_accept` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ID_Autor` (`autor`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `images`
--

LOCK TABLES `images` WRITE;
/*!40000 ALTER TABLE `images` DISABLE KEYS */;
INSERT INTO `images` VALUES (2,'Audry Quiros','Gonito','Chale',3,'a:5:{s:4:\"name\";s:15:\"foto perfil.png\";s:4:\"type\";','2021-12-09 00:17:46',0,0),(3,'Audry Quiros','Lindo','SOY LO MEJOR',1,'a:5:{s:4:\"name\";s:12:\"09-11-21.png\";s:4:\"type\";s:9','2021-12-09 00:18:55',0,0),(4,'Carlos','Bomnito','SOY LO MEJOR DEL MUNDO',1,'a:5:{s:4:\"name\";s:14:\"07-11-2021.png\";s:4:\"type\";s','2021-12-09 00:29:02',0,0);
/*!40000 ALTER TABLE `images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `images_likes`
--

DROP TABLE IF EXISTS `images_likes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `images_likes` (
  `id` int NOT NULL,
  `id_user` int NOT NULL,
  `id_place` int NOT NULL,
  `date_accepted` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `images_likes`
--

LOCK TABLES `images_likes` WRITE;
/*!40000 ALTER TABLE `images_likes` DISABLE KEYS */;
/*!40000 ALTER TABLE `images_likes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `places_category`
--

DROP TABLE IF EXISTS `places_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `places_category` (
  `id_category` int NOT NULL,
  `name_category` text NOT NULL,
  PRIMARY KEY (`id_category`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `places_category`
--

LOCK TABLES `places_category` WRITE;
/*!40000 ALTER TABLE `places_category` DISABLE KEYS */;
INSERT INTO `places_category` VALUES (1,'Montaña'),(2,'Animales'),(3,'Ciudad'),(4,'Playa');
/*!40000 ALTER TABLE `places_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_admin`
--

DROP TABLE IF EXISTS `user_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_admin` (
  `id_admin` int NOT NULL,
  `user_admin` varchar(50) NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `last_login` datetime NOT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_admin`
--

LOCK TABLES `user_admin` WRITE;
/*!40000 ALTER TABLE `user_admin` DISABLE KEYS */;
INSERT INTO `user_admin` VALUES (1,'audry.quiros','audryquiros@ucr.ac.cr','1234','2021-12-08 00:00:00');
/*!40000 ALTER TABLE `user_admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `full_name` varchar(150) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `last_login` datetime NOT NULL,
  `date_created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (15,'Audry Quiros','audry','maryquiros206@live.com','$2y$10$7VhmPrmaFPqo2worm90jveVf2hHciooO8xiJ59/Rfl1uOibQfxwZ.','0000-00-00 00:00:00','2021-12-08 02:08:30');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-12-09 15:49:19
