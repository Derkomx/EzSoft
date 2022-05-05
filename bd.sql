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

-- Volcando estructura para tabla ezsoft.cierredia
CREATE TABLE IF NOT EXISTS `cierredia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) DEFAULT NULL,
  `id_root` int(11) DEFAULT NULL,
  `fecha` varchar(50) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `caja` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla ezsoft.cierredia: ~3 rows (aproximadamente)
DELETE FROM `cierredia`;
INSERT INTO `cierredia` (`id`, `id_usuario`, `id_root`, `fecha`, `total`, `caja`) VALUES
	(25, 10, 7, '1651114800', 500, -100),
	(26, 8, 7, '1651201200', 2400, 1400),
	(29, 8, 7, '1651460400', 3600, 1700);

-- Volcando estructura para tabla ezsoft.clientes
CREATE TABLE IF NOT EXISTS `clientes` (
  `id_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `direccion` varchar(50) DEFAULT NULL,
  `provincia` varchar(50) DEFAULT NULL,
  `codpos` varchar(50) DEFAULT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  KEY `id_cliente` (`id_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla ezsoft.clientes: ~4 rows (aproximadamente)
DELETE FROM `clientes`;
INSERT INTO `clientes` (`id_cliente`, `nombre`, `direccion`, `provincia`, `codpos`, `telefono`, `email`, `id_usuario`) VALUES
	(26, 'Consumidor Final', '', '', '', '', '', 1),
	(28, 'Rolando', 'Pellegrini 888', 'Corrientes ', '3220', '777', 'rolando@hotmail.com', 8),
	(29, 'Pepe ', 'Alvear 300', 'Buenos Aires', '3220', '1156436509', 'pepe@gmail.com', 10),
	(42, 'Kevin', 'Gran malvina 84', 'Mte. Caseros', '3220', '828282', 'patacorta', 8),
	(43, 'Consumidor Final', '-', '-', '-', '-', '-', 7),
	(44, 'Betty', 'Entre Rios 914', 'Corrientes', '3220', '422595', 'betty-1234@gmail.com', 10);

-- Volcando estructura para tabla ezsoft.cuentaclientes
CREATE TABLE IF NOT EXISTS `cuentaclientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `saldo` decimal(20,2) NOT NULL DEFAULT 0.00,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla ezsoft.cuentaclientes: ~4 rows (aproximadamente)
DELETE FROM `cuentaclientes`;
INSERT INTO `cuentaclientes` (`id`, `id_cliente`, `id_usuario`, `saldo`) VALUES
	(9, 26, 1, 0.00),
	(11, 28, 8, 2600.00),
	(12, 29, 10, 0.00),
	(25, 42, 8, 2500.00),
	(26, 43, 7, 0.00),
	(27, 44, 10, 0.00);

-- Volcando estructura para tabla ezsoft.intentos_logueo
CREATE TABLE IF NOT EXISTS `intentos_logueo` (
  `id_usuario` int(11) NOT NULL,
  `hora` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla ezsoft.intentos_logueo: ~12 rows (aproximadamente)
DELETE FROM `intentos_logueo`;
INSERT INTO `intentos_logueo` (`id_usuario`, `hora`) VALUES
	(5, '1651104231'),
	(5, '1651104238'),
	(6, '1651104449'),
	(6, '1651104457'),
	(6, '1651104612'),
	(6, '1651104628'),
	(6, '1651104720'),
	(6, '1651104723'),
	(7, '1651105241'),
	(7, '1651105257'),
	(8, '1651109157'),
	(9, '1651158350'),
	(9, '1651158434'),
	(10, '1651178582');

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
DELETE FROM `menu`;

-- Volcando estructura para tabla ezsoft.movcuentaclientes
CREATE TABLE IF NOT EXISTS `movcuentaclientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) NOT NULL DEFAULT 0,
  `id_usuario` int(11) NOT NULL DEFAULT 0,
  `tmovimiento` varchar(50) NOT NULL DEFAULT '0',
  `valor` decimal(20,2) NOT NULL DEFAULT 0.00,
  `fecha` varchar(50) DEFAULT NULL,
  `modpago` varchar(50) DEFAULT NULL,
  `id_remito` varchar(50) DEFAULT NULL,
  `id_recibo` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla ezsoft.movcuentaclientes: ~12 rows (aproximadamente)
DELETE FROM `movcuentaclientes`;
INSERT INTO `movcuentaclientes` (`id`, `id_cliente`, `id_usuario`, `tmovimiento`, `valor`, `fecha`, `modpago`, `id_remito`, `id_recibo`) VALUES
	(55, 28, 8, 'COMPRA', 2400.00, '1651236170', NULL, NULL, NULL),
	(56, 28, 8, 'PAGO', 1000.00, '1651236170', 'TRANSFERENCIA', '104', NULL),
	(65, 28, 8, 'COMPRA', 1700.00, '1651525219', NULL, NULL, NULL),
	(66, 28, 8, 'PAGO', 1000.00, '1651525219', 'EFECTIVO', '113', NULL),
	(67, 42, 8, 'COMPRA', 1900.00, '1651525390', NULL, NULL, NULL),
	(68, 42, 8, 'PAGO', 900.00, '1651525390', 'EFECTIVO', '114', NULL),
	(79, 43, 7, 'COMPRA', 18000.00, '1651598846', NULL, NULL, NULL),
	(80, 43, 7, 'PAGO', 18000.00, '1651598846', 'EFECTIVO', '138', NULL),
	(81, 28, 8, 'COMPRA', 1000.00, '1651628150', NULL, NULL, NULL),
	(82, 28, 8, 'PAGO', 500.00, '1651628150', 'EFECTIVO', '140', NULL),
	(83, 42, 8, 'COMPRA', 3000.00, '1651628176', NULL, NULL, NULL),
	(84, 42, 8, 'PAGO', 1500.00, '1651628176', 'EFECTIVO', '141', NULL);

-- Volcando estructura para tabla ezsoft.products
CREATE TABLE IF NOT EXISTS `products` (
  `id_prod` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL DEFAULT 0,
  `nomprod` varchar(50) DEFAULT NULL,
  `fileprod` varchar(50) DEFAULT NULL,
  `prevent` decimal(20,2) NOT NULL DEFAULT 0.00,
  `codigo` varchar(50) DEFAULT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_prod`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla ezsoft.products: ~12 rows (aproximadamente)
DELETE FROM `products`;
INSERT INTO `products` (`id_prod`, `id_user`, `nomprod`, `fileprod`, `prevent`, `codigo`, `stock`) VALUES
	(14, 8, 'Crema', '14', 500.00, '0', 9),
	(15, 8, 'Champú ', '15', 400.00, '0', 70),
	(16, 8, 'shampoo', '16', 300.00, '0', 90),
	(18, 10, 'Yerba x kilo', '18', 1400.00, '0', 3),
	(19, 10, 'Azucar x kilo', '19', 400.00, '0', 0),
	(21, 8, 'Farol', '21', 1700.00, '0', 70),
	(22, 7, 'cubiertos', '22', 600.00, '0', 11),
	(23, 7, 'cama', '23', 18000.00, '0', 8),
	(24, 7, 'software', '24', 2000.00, '0', 10),
	(25, 7, 'recargo', '25', 200.00, '0', 10),
	(26, 7, 'figuras', '26', 200.00, '0', 200),
	(27, 10, 'Hamburguesa especial', '27', 400.00, '0', 0),
	(28, 10, 'Papas fritas', '28', 350.00, '0', 0);

-- Volcando estructura para tabla ezsoft.prodvend
CREATE TABLE IF NOT EXISTS `prodvend` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_remito` int(11) NOT NULL DEFAULT 0,
  `id_prod` int(11) NOT NULL DEFAULT 0,
  `cant` int(11) NOT NULL DEFAULT 0,
  `preciou` decimal(20,2) NOT NULL DEFAULT 0.00,
  `precio` decimal(20,2) DEFAULT NULL,
  `nomprod` varchar(50) DEFAULT NULL,
  `id_usuario` varchar(50) DEFAULT NULL,
  `concretado` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=139 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla ezsoft.prodvend: ~16 rows (aproximadamente)
DELETE FROM `prodvend`;
INSERT INTO `prodvend` (`id`, `id_remito`, `id_prod`, `cant`, `preciou`, `precio`, `nomprod`, `id_usuario`, `concretado`) VALUES
	(100, 1, 14, 2, 500.00, 1000.00, 'Crema', '8', 1),
	(101, 1, 15, 2, 400.00, 800.00, 'Champú ', '8', 1),
	(102, 1, 16, 2, 300.00, 600.00, 'shampoo', '8', 1),
	(103, 2, 14, 4, 500.00, 2000.00, 'Crema', '8', 1),
	(104, 2, 15, 3, 400.00, 1200.00, 'Champú ', '8', 1),
	(107, 2, 14, 3, 500.00, 1500.00, 'Crema', '8', 1),
	(108, 2, 15, 1, 400.00, 400.00, 'Champú ', '8', 1),
	(113, 3, 14, 2, 500.00, 1000.00, 'Crema', '8', 1),
	(114, 3, 15, 1, 400.00, 400.00, 'Champú ', '8', 1),
	(115, 3, 16, 1, 300.00, 300.00, 'shampoo', '8', 1),
	(116, 4, 14, 3, 500.00, 1500.00, 'Crema', '8', 1),
	(117, 4, 15, 1, 400.00, 400.00, 'Champú ', '8', 1),
	(133, 1, 23, 1, 18000.00, 18000.00, 'cama', '7', 1),
	(134, 2, 24, 1, 2000.00, 2000.00, 'software', '7', 0),
	(135, 5, 14, 2, 500.00, 1000.00, 'Crema', '8', 1),
	(136, 6, 14, 6, 500.00, 3000.00, 'Crema', '8', 1);

-- Volcando estructura para tabla ezsoft.recibo
CREATE TABLE IF NOT EXISTS `recibo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_recibo` varchar(50) DEFAULT NULL,
  `id_usuario` varchar(50) DEFAULT NULL,
  `id_cliente` varchar(50) DEFAULT NULL,
  `metodo` varchar(50) DEFAULT NULL,
  `valor` decimal(20,2) DEFAULT NULL,
  `fecha` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla ezsoft.recibo: ~0 rows (aproximadamente)
DELETE FROM `recibo`;

-- Volcando estructura para tabla ezsoft.remitos
CREATE TABLE IF NOT EXISTS `remitos` (
  `id_remito` int(11) NOT NULL,
  `id_usu` int(11) DEFAULT NULL,
  `id_cli` int(11) DEFAULT NULL,
  `fecha` varchar(50) DEFAULT NULL,
  `subtotal` decimal(20,2) DEFAULT NULL,
  `descuento` decimal(20,2) DEFAULT NULL,
  `total` decimal(20,2) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=143 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla ezsoft.remitos: ~9 rows (aproximadamente)
DELETE FROM `remitos`;
INSERT INTO `remitos` (`id_remito`, `id_usu`, `id_cli`, `fecha`, `subtotal`, `descuento`, `total`, `id`) VALUES
	(1, 8, 28, '1651236088', 2400.00, 0.00, 2400.00, 104),
	(2, 8, 28, '1651240021', 1900.00, NULL, NULL, 108),
	(3, 8, 28, '1651525201', 1700.00, 0.00, 1700.00, 113),
	(4, 8, 42, '1651525363', 1900.00, 0.00, 1900.00, 114),
	(1, 7, 43, '1651598839', 18000.00, 0.00, 18000.00, 138),
	(2, 7, 43, '1651598871', 2000.00, NULL, NULL, 139),
	(5, 8, 28, '1651628142', 1000.00, 0.00, 1000.00, 140),
	(6, 8, 42, '1651628166', 3000.00, 0.00, 3000.00, 141);

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

-- Volcando datos para la tabla ezsoft.usuarios: ~3 rows (aproximadamente)
DELETE FROM `usuarios`;
INSERT INTO `usuarios` (`id_usuario`, `nombre`, `direccion`, `provincia`, `codpos`, `telefono`, `email`) VALUES
	(7, 'Juan Manuel Armas', 'Uhsuaria 1688', 'Rio Negro', 8332, '20391896985', 'juanmaarmas698@gmail.com'),
	(8, 'Juan', 'Pellegrini 471', 'Mte. Caseros', 3220, '6666', 'jajajsgsysys'),
	(10, 'Ximena Ortiz', 'Entre Rios 914', 'Corrientes', 3220, '23375511614', 'xxiimmeeoo@gmail.com');

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla ezsoft.usuarios2: ~4 rows (aproximadamente)
DELETE FROM `usuarios2`;
INSERT INTO `usuarios2` (`id_usuario`, `cuil`, `nivel`, `email`, `nuevoemail`, `password`, `salt`, `activo`, `activacion`, `verificado`, `alta`, `datos_enviados`, `verificado2`, `denegado`, `darkmode`, `admin`) VALUES
	(7, 'juanma', 9, 'juanmaarmas698@gmail.com', NULL, 'feecde18d10149f66bc8a4feb209bd9518ef1095845dcb096aa0e993baceab2f097ea10e09b877cc642f7d92408a6bd83b0a8b4bb5f421e1c7674eee4903222e', 'a4d0a0339f1bcbc8ebde9f942dd23371a57d9d37d4b9d8f035bf5f57d9ad4696ce812df2cfa87e44d756e3b3425cabfe45dad8aa4f5417969e0eba43d05f7b61', 1, NULL, 0, '2022-04-27 21:18:08', 0, 1, 0, 0, NULL),
	(8, 'Juan', 3, 'juan_14_fra@hotmail.com', NULL, 'd3a180e0d8162e28a168e2014eb43d8a9c11f95611164053c71dd84e4edcec4bdef288b9bf76e812ff1caf10008da265e8c380a3fb7f3eb0e6de64fb1c003b77', 'd357b787f19e31ad40c02e89df123c57a77820e45c66580051a88c4b1df556bf2564ed2176ddf178a6c0e21e1c7184fa000602743d0ffa85ec6b56022525af5e', 1, NULL, 0, '2022-04-27 22:24:19', 0, 1, 0, 0, NULL),
	(9, 'Armashc', 3, 'armashc@gmail.com', NULL, '3460dab7319f3ba80690b3fd6b4ef7cf91d3a623e49478bdeea65a70077cd9543c9c82983a515f3c5267302305220ef09f0dee855e4b514585bce789ebe5ae9b', 'f612d01275ccf64d74c64e96077a781e7b8d96791763ff7e38d8de3fd491845d9504474425e85e7ec0139eaf6f569451a0a95cc27569eb67c6312a6930fefb72', 1, NULL, 0, '2022-04-28 12:05:34', 0, 1, 0, 0, NULL),
	(10, 'xime', 3, 'xxiimmeeoo@gmail.com', NULL, '640c3ebb02f505452488c8c8d2b2383c93db409dcea60d05426d4870c810ee614caece8e47243e38b7faa661855a196c4555ae635824c2fe543906477fe183cb', '5ab97ca991fb688822d5f0874bed04dd3a4383f541a3e21f28e81de1ceb06ef6dafe6f144f2766e3e0051aff8acd91358ca36494ce6745e136f3b8a9ccac2ea0', 1, NULL, 0, '2022-04-28 17:41:59', 0, 1, 0, 0, NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
