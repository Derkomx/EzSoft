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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;