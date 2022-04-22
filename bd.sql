-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.4.24-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.0.0.6468
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para ezsoft
CREATE DATABASE IF NOT EXISTS `ezsoft` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `ezsoft`;

-- Volcando estructura para tabla ezsoft.clientes
CREATE TABLE IF NOT EXISTS `clientes` (
  `id_cliente` int(11) DEFAULT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `direccion` varchar(50) DEFAULT NULL,
  `provincia` varchar(50) DEFAULT NULL,
  `codpos` int(11) DEFAULT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla ezsoft.intentos_logueo
CREATE TABLE IF NOT EXISTS `intentos_logueo` (
  `id_usuario` int(11) NOT NULL,
  `hora` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla ezsoft.menu
CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user` varchar(50) DEFAULT NULL,
  `m1` varchar(50) DEFAULT NULL,
  `m2` varchar(50) DEFAULT NULL,
  `m3` varchar(50) DEFAULT NULL,
  `m4` varchar(50) DEFAULT NULL,
  `m5` varchar(50) DEFAULT NULL,
  `m6` varchar(50) DEFAULT NULL,
  `m7` varchar(50) DEFAULT NULL,
  `m8` varchar(50) DEFAULT NULL,
  `m9` varchar(50) DEFAULT NULL,
  `m10` varchar(50) DEFAULT NULL,
  `m11` varchar(50) DEFAULT NULL,
  `m12` varchar(50) DEFAULT NULL,
  `m13` varchar(50) DEFAULT NULL,
  `m14` varchar(50) DEFAULT NULL,
  `m15` varchar(50) DEFAULT NULL,
  UNIQUE KEY `user` (`user`) USING BTREE,
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla ezsoft.products
CREATE TABLE IF NOT EXISTS `products` (
  `id_prod` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL DEFAULT 0,
  `nomprod` varchar(50) DEFAULT NULL,
  `fileprod` int(11) DEFAULT NULL,
  `prevent` decimal(20,2) NOT NULL DEFAULT 0.00,
  PRIMARY KEY (`id_prod`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla ezsoft.prodvend
CREATE TABLE IF NOT EXISTS `prodvend` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_remito` int(11) NOT NULL DEFAULT 0,
  `id_prod` int(11) NOT NULL DEFAULT 0,
  `cant` int(11) NOT NULL DEFAULT 0,
  `preciou` int(11) NOT NULL DEFAULT 0,
  `precio` int(11) DEFAULT NULL,
  `nomprod` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla ezsoft.remitos
CREATE TABLE IF NOT EXISTS `remitos` (
  `id_remito` int(11) NOT NULL AUTO_INCREMENT,
  `id_usu` int(11) DEFAULT NULL,
  `id_cli` int(11) DEFAULT NULL,
  `fecha` varchar(50) DEFAULT NULL,
  `subtotal` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_remito`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla ezsoft.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `direccion` varchar(50) DEFAULT NULL,
  `provincia` varchar(50) DEFAULT NULL,
  `codpos` int(11) DEFAULT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla ezsoft.usuarios2
CREATE TABLE IF NOT EXISTS `usuarios2` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `cuil` varchar(20) NOT NULL,
  `nivel` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `nuevoemail` varchar(128) DEFAULT NULL,
  `password` char(128) NOT NULL,
  `salt` char(128) NOT NULL,
  `activo` int(11) NOT NULL,
  `activacion` char(32) DEFAULT NULL,
  `verificado` int(1) unsigned zerofill NOT NULL DEFAULT 0,
  `alta` datetime DEFAULT NULL,
  `datos_enviados` int(1) NOT NULL DEFAULT 0,
  `verificado2` int(10) unsigned NOT NULL DEFAULT 0,
  `denegado` int(1) NOT NULL DEFAULT 0,
  `darkmode` int(1) NOT NULL DEFAULT 0,
  `admin` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
