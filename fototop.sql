-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         5.7.33 - MySQL Community Server (GPL)
-- SO del servidor:              Win64
-- HeidiSQL Versión:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para fototop
CREATE DATABASE IF NOT EXISTS `fototop` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `fototop`;

-- Volcando estructura para tabla fototop.images
CREATE TABLE IF NOT EXISTS `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `autor` varchar(45) NOT NULL DEFAULT '0',
  `title` varchar(50) NOT NULL,
  `description` varchar(250) NOT NULL,
  `id_category` int(11) NOT NULL DEFAULT '0',
  `main_image` varchar(50) NOT NULL,
  `pub_date` datetime NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `id_admin_accept` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ID_Autor` (`autor`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla fototop.images: ~10 rows (aproximadamente)
/*!40000 ALTER TABLE `images` DISABLE KEYS */;
/*!40000 ALTER TABLE `images` ENABLE KEYS */;

-- Volcando estructura para tabla fototop.images_likes
CREATE TABLE IF NOT EXISTS `images_likes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_place` int(11) NOT NULL,
  `date_accepted` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla fototop.images_likes: ~6 rows (aproximadamente)
/*!40000 ALTER TABLE `images_likes` DISABLE KEYS */;
/*!40000 ALTER TABLE `images_likes` ENABLE KEYS */;

-- Volcando estructura para tabla fototop.places_category
CREATE TABLE IF NOT EXISTS `places_category` (
  `id_category` int(11) NOT NULL AUTO_INCREMENT,
  `name_category` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id_category`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla fototop.places_category: ~8 rows (aproximadamente)
/*!40000 ALTER TABLE `places_category` DISABLE KEYS */;
INSERT INTO `places_category` (`id_category`, `name_category`) VALUES
	(1, 'Montaña'),
	(2, 'Animales'),
	(3, 'Ciudad'),
	(4, 'Playa'),
	(11, 'Cultura'),
	(12, 'Deporte'),
	(13, 'Naturaleza'),
	(14, 'Otros');
/*!40000 ALTER TABLE `places_category` ENABLE KEYS */;

-- Volcando estructura para tabla fototop.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(150) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `last_login` datetime NOT NULL,
  `date_created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla fototop.users: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `full_name`, `username`, `email`, `password`, `last_login`, `date_created`) VALUES
	(17, '1234', '1234', 'ssssw@gmail.com', '$2y$10$r5MMuQp5CzzqMBDhwfjJZOMbhbe5R8G10XPO2JfuVCwWuL19770eS', '2021-12-14 19:48:45', '2021-12-10 19:49:47');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Volcando estructura para tabla fototop.user_admin
CREATE TABLE IF NOT EXISTS `user_admin` (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `user_admin` varchar(50) NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `last_login` datetime NOT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla fototop.user_admin: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `user_admin` DISABLE KEYS */;
INSERT INTO `user_admin` (`id_admin`, `user_admin`, `email`, `password`, `last_login`) VALUES
	(1, '123', '123@ucr.ac.cr', '12', '2021-12-14 19:40:42');
/*!40000 ALTER TABLE `user_admin` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
