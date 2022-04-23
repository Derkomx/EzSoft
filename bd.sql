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
  `id_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `direccion` varchar(50) DEFAULT NULL,
  `provincia` varchar(50) DEFAULT NULL,
  `codpos` varchar(50) DEFAULT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  KEY `id_cliente` (`id_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla ezsoft.clientes: ~3 rows (aproximadamente)
INSERT INTO `clientes` (`id_cliente`, `nombre`, `direccion`, `provincia`, `codpos`, `telefono`, `email`, `id_usuario`) VALUES
	(6, 'Pato', 'algo', 'corrientes', '3220', '123151', 'adsfasdf@asdfadfs.com', 1),
	(7, 'ranom', 'asdfadsf', 'Misiones', '652123', '2146523', 'asdjfhadsf@gmail.com', 1),
	(8, 'Juan Manuel Armas', 'Ushuaia 1688', 'Rio Negro ', '8332', '1125820013', 'juanmaarmas698@gmail.com', 1);

-- Volcando estructura para tabla ezsoft.intentos_logueo
CREATE TABLE IF NOT EXISTS `intentos_logueo` (
  `id_usuario` int(11) NOT NULL,
  `hora` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla ezsoft.intentos_logueo: ~0 rows (aproximadamente)

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

-- Volcando datos para la tabla ezsoft.menu: ~0 rows (aproximadamente)

-- Volcando estructura para tabla ezsoft.products
CREATE TABLE IF NOT EXISTS `products` (
  `id_prod` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL DEFAULT 0,
  `nomprod` varchar(50) DEFAULT NULL,
  `fileprod` int(11) DEFAULT NULL,
  `prevent` decimal(20,2) NOT NULL DEFAULT 0.00,
  PRIMARY KEY (`id_prod`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla ezsoft.products: ~3 rows (aproximadamente)
INSERT INTO `products` (`id_prod`, `id_user`, `nomprod`, `fileprod`, `prevent`) VALUES
	(1, 1, 'tintura', NULL, 25.00),
	(2, 1, 'lapices', NULL, 500.00),
	(3, 1, 'libros', NULL, 500.00);

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
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla ezsoft.prodvend: ~3 rows (aproximadamente)
INSERT INTO `prodvend` (`id`, `id_remito`, `id_prod`, `cant`, `preciou`, `precio`, `nomprod`) VALUES
	(51, 61, 1, 1, 25, 25, 'tintura'),
	(52, 61, 2, 1, 500, 500, 'lapices'),
	(53, 61, 3, 1, 500, 500, 'libros');

-- Volcando estructura para tabla ezsoft.remitos
CREATE TABLE IF NOT EXISTS `remitos` (
  `id_remito` int(11) NOT NULL AUTO_INCREMENT,
  `id_usu` int(11) DEFAULT NULL,
  `id_cli` int(11) DEFAULT NULL,
  `fecha` varchar(50) DEFAULT NULL,
  `subtotal` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_remito`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla ezsoft.remitos: ~1 rows (aproximadamente)
INSERT INTO `remitos` (`id_remito`, `id_usu`, `id_cli`, `fecha`, `subtotal`, `total`) VALUES
	(61, 1, 6, '1650658824', 1025, NULL);

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

-- Volcando datos para la tabla ezsoft.usuarios: ~1 rows (aproximadamente)
INSERT INTO `usuarios` (`id_usuario`, `nombre`, `direccion`, `provincia`, `codpos`, `telefono`, `email`) VALUES
	(1, 'EzSoft Juanma', 'Ushuaia 1688', 'Rio Negro', 8332, '112582013', 'juanmaarmas698@gmail.com');

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

-- Volcando datos para la tabla ezsoft.usuarios2: ~0 rows (aproximadamente)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
