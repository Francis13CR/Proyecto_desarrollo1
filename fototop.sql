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
  `ID` int(11) NOT NULL,
  `Title` varchar(50) NOT NULL,
  `Description` varchar(250) NOT NULL,
  `id_category` int(11) NOT NULL DEFAULT '0',
  `pub_date` datetime NOT NULL,
  `ID_Autor` int(11) NOT NULL DEFAULT '0',
  `link` varchar(50) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `date_created` datetime NOT NULL,
  `id_admin_accept` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `ID_Autor` (`ID_Autor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla fototop.images_likes
CREATE TABLE IF NOT EXISTS `images_likes` (
  `ID` int(10) NOT NULL,
  `ID_user` int(10) NOT NULL,
  `id_place` int(10) NOT NULL,
  `Date_accepted` datetime NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla fototop.places_category
CREATE TABLE IF NOT EXISTS `places_category` (
  `id_category` int(11) NOT NULL,
  `name_category` text NOT NULL,
  PRIMARY KEY (`id_category`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla fototop.users
CREATE TABLE IF NOT EXISTS `users` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Full_name` varchar(150) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` text NOT NULL,
  `Password` text NOT NULL,
  `last_login` datetime NOT NULL,
  `Date_created` datetime NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla fototop.user_admin
CREATE TABLE IF NOT EXISTS `user_admin` (
  `id_admin` int(11) NOT NULL,
  `user_admin` varchar(50) NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `last_login` datetime NOT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
