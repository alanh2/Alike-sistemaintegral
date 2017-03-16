-- --------------------------------------------------------
-- Host:                         systemix.com.ar
-- Versión del servidor:         10.0.30-MariaDB - MariaDB Server
-- SO del servidor:              Linux
-- HeidiSQL Versión:             9.4.0.5154
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para systemix_alike
CREATE DATABASE IF NOT EXISTS `systemix_alike` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `systemix_alike`;

-- Volcando estructura para tabla systemix_alike.aplicaciones_cobro_venta
CREATE TABLE IF NOT EXISTS `aplicaciones_cobro_venta` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `ventaid` bigint(20) DEFAULT '0',
  `cobroid` bigint(20) NOT NULL DEFAULT '0',
  `monto` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla systemix_alike.aplicaciones_cobro_venta: ~8 rows (aproximadamente)
/*!40000 ALTER TABLE `aplicaciones_cobro_venta` DISABLE KEYS */;
REPLACE INTO `aplicaciones_cobro_venta` (`id`, `ventaid`, `cobroid`, `monto`) VALUES
	(11, 5, 13, 157379.60),
	(21, 0, 23, 0.00),
	(22, 0, 24, 0.00),
	(23, 12, 25, 23.00),
	(24, 12, 26, 23.00),
	(25, 11, 27, 68.00),
	(26, 13, 28, 1150.00),
	(27, 5, 29, 757599.60);
/*!40000 ALTER TABLE `aplicaciones_cobro_venta` ENABLE KEYS */;

-- Volcando estructura para tabla systemix_alike.categorias
CREATE TABLE IF NOT EXISTS `categorias` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(120) NOT NULL,
  `rubroid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla systemix_alike.categorias: ~11 rows (aproximadamente)
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
REPLACE INTO `categorias` (`id`, `nombre`, `rubroid`) VALUES
	(1, 'Templadas', 1),
	(2, 'Cables', 1),
	(3, 'Fundas', 1),
	(5, 'Parlantes', 1),
	(6, 'Power Bank', 1),
	(7, 'Pantallas', 2),
	(8, 'Microfono', 2),
	(9, 'Mid frame (borde)', 2),
	(10, 'Baterias', 2),
	(11, 'Tap Transfer ( Back Cover )', 2),
	(16, 'Camaras', 2);
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;

-- Volcando estructura para tabla systemix_alike.clientes
CREATE TABLE IF NOT EXISTS `clientes` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `razon_social` varchar(255) NOT NULL,
  `tel_codigo_area` varchar(10) DEFAULT NULL,
  `tel_numero` varchar(20) DEFAULT NULL,
  `cel_numero` int(11) DEFAULT NULL,
  `direccion` varchar(120) NOT NULL,
  `localidad` varchar(120) NOT NULL,
  `cp` int(11) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `dni` varchar(31) NOT NULL,
  `cuil` varchar(31) DEFAULT NULL,
  `cuit` varchar(31) DEFAULT NULL,
  `password` varchar(31) NOT NULL,
  `ranking` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla systemix_alike.clientes: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
REPLACE INTO `clientes` (`id`, `razon_social`, `tel_codigo_area`, `tel_numero`, `cel_numero`, `direccion`, `localidad`, `cp`, `email`, `dni`, `cuil`, `cuit`, `password`, `ranking`) VALUES
	(1, 'Cell Fix', '59411', '12345678', NULL, 'blablabla', '', NULL, 'asd@asd.com', '148239476', '148239476', '148239476', '123456', 9),
	(5, 'PC DOCTOR', '011', '44444444', NULL, 'fake 134', '', NULL, 'a@a.com', '33333333', '12333333337', '12333333337', '', 0);
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;

-- Volcando estructura para tabla systemix_alike.clientes_comentarios
CREATE TABLE IF NOT EXISTS `clientes_comentarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `clienteid` int(11) DEFAULT '0',
  `puntaje` float DEFAULT '0',
  `comentario` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla systemix_alike.clientes_comentarios: ~6 rows (aproximadamente)
/*!40000 ALTER TABLE `clientes_comentarios` DISABLE KEYS */;
REPLACE INTO `clientes_comentarios` (`id`, `clienteid`, `puntaje`, `comentario`) VALUES
	(1, 1, 5, 'lalala'),
	(4, 5, 4, 'Que buen cliente, ningun problema'),
	(11, 5, 5, 'Todo perfecto'),
	(18, 5, 5, 'Paga a tiempo'),
	(45, 1, 1, 'popo'),
	(50, 5, 1, 'dsfsdf');
/*!40000 ALTER TABLE `clientes_comentarios` ENABLE KEYS */;

-- Volcando estructura para tabla systemix_alike.cobros
CREATE TABLE IF NOT EXISTS `cobros` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `fecha` datetime NOT NULL,
  `monto` decimal(10,2) NOT NULL,
  `clienteid` bigint(20) NOT NULL,
  `metododepagoid` int(11) NOT NULL,
  `metodoid` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla systemix_alike.cobros: ~8 rows (aproximadamente)
/*!40000 ALTER TABLE `cobros` DISABLE KEYS */;
REPLACE INTO `cobros` (`id`, `fecha`, `monto`, `clienteid`, `metododepagoid`, `metodoid`) VALUES
	(13, '2017-03-01 09:17:27', 157379.60, 1, 1, 18),
	(23, '2017-03-02 07:35:49', 0.00, 0, 1, 22),
	(24, '2017-03-02 07:37:27', 0.00, 0, 6, 2),
	(25, '2017-03-02 08:10:44', 23.00, 5, 1, 23),
	(26, '2017-03-02 08:11:02', 23.00, 5, 6, 3),
	(27, '2017-03-02 09:56:13', 68.00, 1, 1, 24),
	(28, '2017-03-03 09:44:18', 1150.00, 1, 1, 25),
	(29, '2017-03-06 19:03:30', 757599.60, 1, 1, 26);
/*!40000 ALTER TABLE `cobros` ENABLE KEYS */;

-- Volcando estructura para tabla systemix_alike.colores
CREATE TABLE IF NOT EXISTS `colores` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(120) NOT NULL,
  `name` varchar(120) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla systemix_alike.colores: ~8 rows (aproximadamente)
/*!40000 ALTER TABLE `colores` DISABLE KEYS */;
REPLACE INTO `colores` (`id`, `nombre`, `name`) VALUES
	(1, 'Blanco', 'White'),
	(2, 'Negro', 'Black'),
	(3, 'Azul', 'Blue'),
	(4, 'Dorado', 'Gold'),
	(5, 'Cafe', 'Coffee'),
	(6, 'Azul metalizado', 'Light Blue'),
	(7, 'Naranja', 'Orange'),
	(9, 'Amarillo', 'Yellow');
/*!40000 ALTER TABLE `colores` ENABLE KEYS */;

-- Volcando estructura para tabla systemix_alike.compras
CREATE TABLE IF NOT EXISTS `compras` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(120) NOT NULL,
  `metodo_pagoid` int(11) NOT NULL,
  `proveedorid` int(11) NOT NULL,
  `total` double NOT NULL,
  `fecha` datetime NOT NULL,
  `descuento` double DEFAULT NULL,
  `envioid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla systemix_alike.compras: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `compras` DISABLE KEYS */;
/*!40000 ALTER TABLE `compras` ENABLE KEYS */;

-- Volcando estructura para tabla systemix_alike.detalle_compra
CREATE TABLE IF NOT EXISTS `detalle_compra` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `compra_id` bigint(20) NOT NULL,
  `producto_id` bigint(20) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `cantidad_recibida` int(11) NOT NULL,
  `costo_unitario` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla systemix_alike.detalle_compra: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `detalle_compra` DISABLE KEYS */;
/*!40000 ALTER TABLE `detalle_compra` ENABLE KEYS */;

-- Volcando estructura para tabla systemix_alike.detalle_devolucion
CREATE TABLE IF NOT EXISTS `detalle_devolucion` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `stock_local_id` bigint(20) NOT NULL,
  `devolucion_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla systemix_alike.detalle_devolucion: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `detalle_devolucion` DISABLE KEYS */;
/*!40000 ALTER TABLE `detalle_devolucion` ENABLE KEYS */;

-- Volcando estructura para tabla systemix_alike.Detalle_transaccion
CREATE TABLE IF NOT EXISTS `Detalle_transaccion` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `transaccion_id` bigint(20) NOT NULL,
  `stock_local_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla systemix_alike.Detalle_transaccion: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `Detalle_transaccion` DISABLE KEYS */;
/*!40000 ALTER TABLE `Detalle_transaccion` ENABLE KEYS */;

-- Volcando estructura para tabla systemix_alike.Devoluciones
CREATE TABLE IF NOT EXISTS `Devoluciones` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `venta_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla systemix_alike.Devoluciones: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `Devoluciones` DISABLE KEYS */;
/*!40000 ALTER TABLE `Devoluciones` ENABLE KEYS */;

-- Volcando estructura para tabla systemix_alike.entradas
CREATE TABLE IF NOT EXISTS `entradas` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `clienteid` bigint(20) NOT NULL DEFAULT '0',
  `fecha` datetime NOT NULL,
  `monto` decimal(10,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla systemix_alike.entradas: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `entradas` DISABLE KEYS */;
/*!40000 ALTER TABLE `entradas` ENABLE KEYS */;

-- Volcando estructura para tabla systemix_alike.envios
CREATE TABLE IF NOT EXISTS `envios` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `metodoenvio` int(11) NOT NULL DEFAULT '0',
  `metodoenvioid` bigint(20) NOT NULL DEFAULT '0',
  `fechaestimada` date NOT NULL,
  `operacion` int(11) NOT NULL,
  `recibe` varchar(80) DEFAULT NULL,
  `dni` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla systemix_alike.envios: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `envios` DISABLE KEYS */;
REPLACE INTO `envios` (`id`, `metodoenvio`, `metodoenvioid`, `fechaestimada`, `operacion`, `recibe`, `dni`) VALUES
	(1, 1, 19, '2017-03-13', 1, 'pablo', '34893478'),
	(2, 2, 1, '2017-03-13', 1, 'Ariel', '12787654'),
	(3, 1, 4, '2017-03-13', 1, NULL, NULL),
	(4, 1, 3, '2017-03-13', 1, NULL, NULL),
	(5, 3, 1, '2017-03-22', 1, 'Juan', '12787651');
/*!40000 ALTER TABLE `envios` ENABLE KEYS */;

-- Volcando estructura para tabla systemix_alike.env_motos
CREATE TABLE IF NOT EXISTS `env_motos` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `costo` decimal(10,2) NOT NULL DEFAULT '0.00',
  `direccion` varchar(80) NOT NULL DEFAULT '0',
  `tracking` varchar(50) NOT NULL DEFAULT '0',
  `motoid` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Volcando datos para la tabla systemix_alike.env_motos: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `env_motos` DISABLE KEYS */;
/*!40000 ALTER TABLE `env_motos` ENABLE KEYS */;

-- Volcando estructura para tabla systemix_alike.env_ocaexpress
CREATE TABLE IF NOT EXISTS `env_ocaexpress` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `costo` decimal(10,2) NOT NULL DEFAULT '0.00',
  `direccion` varchar(80) NOT NULL DEFAULT '0',
  `tracking` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Volcando datos para la tabla systemix_alike.env_ocaexpress: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `env_ocaexpress` DISABLE KEYS */;
REPLACE INTO `env_ocaexpress` (`id`, `costo`, `direccion`, `tracking`) VALUES
	(1, 88.00, 'Corrientes 1112', '454353111');
/*!40000 ALTER TABLE `env_ocaexpress` ENABLE KEYS */;

-- Volcando estructura para tabla systemix_alike.env_ocas
CREATE TABLE IF NOT EXISTS `env_ocas` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `costo` decimal(10,2) NOT NULL DEFAULT '0.00',
  `direccion` varchar(80) NOT NULL DEFAULT '0',
  `tracking` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla systemix_alike.env_ocas: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `env_ocas` DISABLE KEYS */;
REPLACE INTO `env_ocas` (`id`, `costo`, `direccion`, `tracking`) VALUES
	(1, 23.00, 'dierccion de prueba', '1342131234'),
	(4, 45.00, 'hfghjg', '4563563456');
/*!40000 ALTER TABLE `env_ocas` ENABLE KEYS */;

-- Volcando estructura para tabla systemix_alike.env_otros
CREATE TABLE IF NOT EXISTS `env_otros` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `costo` decimal(10,2) NOT NULL DEFAULT '0.00',
  `direccion` varchar(80) NOT NULL DEFAULT '0',
  `tracking` varchar(50) NOT NULL DEFAULT '0',
  `nombreempresa` varchar(80) DEFAULT NULL,
  `direccionempresa` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Volcando datos para la tabla systemix_alike.env_otros: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `env_otros` DISABLE KEYS */;
REPLACE INTO `env_otros` (`id`, `costo`, `direccion`, `tracking`, `nombreempresa`, `direccionempresa`) VALUES
	(6, 45.00, 'gfgfh', '56456', 'ttrtr', 'trtr');
/*!40000 ALTER TABLE `env_otros` ENABLE KEYS */;

-- Volcando estructura para tabla systemix_alike.env_retiros
CREATE TABLE IF NOT EXISTS `env_retiros` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla systemix_alike.env_retiros: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `env_retiros` DISABLE KEYS */;
REPLACE INTO `env_retiros` (`id`) VALUES
	(3),
	(4),
	(16),
	(19);
/*!40000 ALTER TABLE `env_retiros` ENABLE KEYS */;

-- Volcando estructura para tabla systemix_alike.locales
CREATE TABLE IF NOT EXISTS `locales` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(120) NOT NULL,
  `direccion` varchar(120) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla systemix_alike.locales: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `locales` DISABLE KEYS */;
REPLACE INTO `locales` (`id`, `nombre`, `direccion`, `telefono`) VALUES
	(6, 'Principal', ' ', ' ');
/*!40000 ALTER TABLE `locales` ENABLE KEYS */;

-- Volcando estructura para tabla systemix_alike.localidades
CREATE TABLE IF NOT EXISTS `localidades` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `provinciaid` bigint(20) NOT NULL,
  `nombre` varchar(120) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla systemix_alike.localidades: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `localidades` DISABLE KEYS */;
REPLACE INTO `localidades` (`id`, `provinciaid`, `nombre`) VALUES
	(1, 1, 'Capital');
/*!40000 ALTER TABLE `localidades` ENABLE KEYS */;

-- Volcando estructura para tabla systemix_alike.marcas
CREATE TABLE IF NOT EXISTS `marcas` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(120) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla systemix_alike.marcas: ~10 rows (aproximadamente)
/*!40000 ALTER TABLE `marcas` DISABLE KEYS */;
REPLACE INTO `marcas` (`id`, `nombre`) VALUES
	(1, 'LG'),
	(3, 'iPhone'),
	(4, 'Samsung'),
	(5, 'Motorola'),
	(6, 'Nokia'),
	(7, 'Alcatel'),
	(8, 'Huawei'),
	(10, 'Blu'),
	(14, 'Asus'),
	(15, 'Kin vale');
/*!40000 ALTER TABLE `marcas` ENABLE KEYS */;

-- Volcando estructura para tabla systemix_alike.metodos_envio
CREATE TABLE IF NOT EXISTS `metodos_envio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla systemix_alike.metodos_envio: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `metodos_envio` DISABLE KEYS */;
REPLACE INTO `metodos_envio` (`id`, `nombre`) VALUES
	(1, 'Retira el cliente'),
	(2, 'OCA'),
	(3, 'OCA Express'),
	(4, 'Moto'),
	(5, 'Otros');
/*!40000 ALTER TABLE `metodos_envio` ENABLE KEYS */;

-- Volcando estructura para tabla systemix_alike.metodos_pago
CREATE TABLE IF NOT EXISTS `metodos_pago` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla systemix_alike.metodos_pago: ~7 rows (aproximadamente)
/*!40000 ALTER TABLE `metodos_pago` DISABLE KEYS */;
REPLACE INTO `metodos_pago` (`id`, `nombre`) VALUES
	(1, 'Efectivo'),
	(2, 'Cheque'),
	(3, 'Mercado Pago'),
	(4, 'Transferencia'),
	(5, 'Cuenta Corriente'),
	(6, 'Panama'),
	(7, 'Tarjeta');
/*!40000 ALTER TABLE `metodos_pago` ENABLE KEYS */;

-- Volcando estructura para tabla systemix_alike.modelos
CREATE TABLE IF NOT EXISTS `modelos` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(120) NOT NULL,
  `marcaid` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla systemix_alike.modelos: ~12 rows (aproximadamente)
/*!40000 ALTER TABLE `modelos` DISABLE KEYS */;
REPLACE INTO `modelos` (`id`, `nombre`, `marcaid`) VALUES
	(1, '4S', 3),
	(2, '4G 1432', 3),
	(3, '5S', 3),
	(4, '5C', 0),
	(5, '5C', 0),
	(6, '5C', 0),
	(7, '5C', 3),
	(8, 'One Touch', 7),
	(9, 'S4 123456', 4),
	(10, 'S4 456789', 4),
	(11, 'A1349 A1332', 3),
	(12, 'J1 ACE', 4);
/*!40000 ALTER TABLE `modelos` ENABLE KEYS */;

-- Volcando estructura para tabla systemix_alike.motos
CREATE TABLE IF NOT EXISTS `motos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL DEFAULT '0',
  `telefono` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla systemix_alike.motos: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `motos` DISABLE KEYS */;
REPLACE INTO `motos` (`id`, `nombre`, `telefono`) VALUES
	(1, 'Claudio', '4444442'),
	(2, 'Alan', '34534534');
/*!40000 ALTER TABLE `motos` ENABLE KEYS */;

-- Volcando estructura para tabla systemix_alike.mov_cheques
CREATE TABLE IF NOT EXISTS `mov_cheques` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `numeracion` varchar(50) DEFAULT NULL,
  `vencimiento` date DEFAULT NULL,
  `banco` varchar(50) DEFAULT NULL,
  `operacion` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=FIXED;

-- Volcando datos para la tabla systemix_alike.mov_cheques: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `mov_cheques` DISABLE KEYS */;
/*!40000 ALTER TABLE `mov_cheques` ENABLE KEYS */;

-- Volcando estructura para tabla systemix_alike.mov_cuentacorrientes
CREATE TABLE IF NOT EXISTS `mov_cuentacorrientes` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `operacion` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=FIXED;

-- Volcando datos para la tabla systemix_alike.mov_cuentacorrientes: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `mov_cuentacorrientes` DISABLE KEYS */;
/*!40000 ALTER TABLE `mov_cuentacorrientes` ENABLE KEYS */;

-- Volcando estructura para tabla systemix_alike.mov_efectivos
CREATE TABLE IF NOT EXISTS `mov_efectivos` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `operacion` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla systemix_alike.mov_efectivos: ~9 rows (aproximadamente)
/*!40000 ALTER TABLE `mov_efectivos` DISABLE KEYS */;
REPLACE INTO `mov_efectivos` (`id`, `operacion`) VALUES
	(18, 1),
	(22, 1),
	(23, 1),
	(24, 1),
	(25, 1),
	(26, 1),
	(27, 1),
	(28, 1),
	(29, 1);
/*!40000 ALTER TABLE `mov_efectivos` ENABLE KEYS */;

-- Volcando estructura para tabla systemix_alike.mov_mercadopagos
CREATE TABLE IF NOT EXISTS `mov_mercadopagos` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `operacion` int(11) DEFAULT NULL,
  `codigomp` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=FIXED;

-- Volcando datos para la tabla systemix_alike.mov_mercadopagos: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `mov_mercadopagos` DISABLE KEYS */;
/*!40000 ALTER TABLE `mov_mercadopagos` ENABLE KEYS */;

-- Volcando estructura para tabla systemix_alike.mov_panamas
CREATE TABLE IF NOT EXISTS `mov_panamas` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `operacion` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 ROW_FORMAT=FIXED;

-- Volcando datos para la tabla systemix_alike.mov_panamas: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `mov_panamas` DISABLE KEYS */;
REPLACE INTO `mov_panamas` (`id`, `operacion`) VALUES
	(2, 1),
	(3, 1);
/*!40000 ALTER TABLE `mov_panamas` ENABLE KEYS */;

-- Volcando estructura para tabla systemix_alike.mov_tarjetas
CREATE TABLE IF NOT EXISTS `mov_tarjetas` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `titular` varchar(80) DEFAULT NULL,
  `operacion` int(11) DEFAULT NULL,
  `vencimiento` date DEFAULT NULL,
  `digitos` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=FIXED;

-- Volcando datos para la tabla systemix_alike.mov_tarjetas: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `mov_tarjetas` DISABLE KEYS */;
/*!40000 ALTER TABLE `mov_tarjetas` ENABLE KEYS */;

-- Volcando estructura para tabla systemix_alike.mov_transferencias
CREATE TABLE IF NOT EXISTS `mov_transferencias` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `operacion` int(11) DEFAULT NULL,
  `banco` varchar(50) DEFAULT NULL,
  `titular` varchar(50) DEFAULT NULL,
  `codigo_operacion` varchar(50) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=FIXED;

-- Volcando datos para la tabla systemix_alike.mov_transferencias: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `mov_transferencias` DISABLE KEYS */;
/*!40000 ALTER TABLE `mov_transferencias` ENABLE KEYS */;

-- Volcando estructura para tabla systemix_alike.productos
CREATE TABLE IF NOT EXISTS `productos` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(255) NOT NULL,
  `proveedorid` bigint(20) NOT NULL,
  `modeloid` bigint(20) NOT NULL,
  `subcategoriaid` bigint(20) NOT NULL,
  `marcaid2` bigint(20) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla systemix_alike.productos: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
REPLACE INTO `productos` (`id`, `codigo`, `proveedorid`, `modeloid`, `subcategoriaid`, `marcaid2`, `nombre`) VALUES
	(79, '', 3, 9, 21, 0, 'S4'),
	(80, '', 3, 1, 18, 0, '4G');
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;

-- Volcando estructura para tabla systemix_alike.productos_colores
CREATE TABLE IF NOT EXISTS `productos_colores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `productoid` int(11) NOT NULL,
  `colorid` int(11) NOT NULL,
  `costo` float NOT NULL,
  `porcentaje1` float NOT NULL,
  `porcentaje2` float NOT NULL,
  `porcentaje3` float NOT NULL,
  `porcentaje4` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla systemix_alike.productos_colores: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `productos_colores` DISABLE KEYS */;
REPLACE INTO `productos_colores` (`id`, `productoid`, `colorid`, `costo`, `porcentaje1`, `porcentaje2`, `porcentaje3`, `porcentaje4`) VALUES
	(55, 80, 2, 1200, 108.333, 125, 125, 133),
	(56, 79, 9, 80, 125, 625, 750, 875);
/*!40000 ALTER TABLE `productos_colores` ENABLE KEYS */;

-- Volcando estructura para tabla systemix_alike.proveedores
CREATE TABLE IF NOT EXISTS `proveedores` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(120) NOT NULL,
  `direccion` varchar(120) NOT NULL,
  `telefono` varchar(120) NOT NULL,
  `paisid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla systemix_alike.proveedores: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `proveedores` DISABLE KEYS */;
REPLACE INTO `proveedores` (`id`, `nombre`, `direccion`, `telefono`, `paisid`) VALUES
	(1, 'China', '', '', 0),
	(2, 'Panama', '1', '1', 0),
	(3, 'abc', '2', '2', 1);
/*!40000 ALTER TABLE `proveedores` ENABLE KEYS */;

-- Volcando estructura para tabla systemix_alike.provincias
CREATE TABLE IF NOT EXISTS `provincias` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(120) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla systemix_alike.provincias: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `provincias` DISABLE KEYS */;
REPLACE INTO `provincias` (`id`, `nombre`) VALUES
	(1, 'Buenos Aires');
/*!40000 ALTER TABLE `provincias` ENABLE KEYS */;

-- Volcando estructura para tabla systemix_alike.RMA
CREATE TABLE IF NOT EXISTS `RMA` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `stock_local_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla systemix_alike.RMA: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `RMA` DISABLE KEYS */;
/*!40000 ALTER TABLE `RMA` ENABLE KEYS */;

-- Volcando estructura para tabla systemix_alike.rubros
CREATE TABLE IF NOT EXISTS `rubros` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(120) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla systemix_alike.rubros: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `rubros` DISABLE KEYS */;
REPLACE INTO `rubros` (`id`, `nombre`) VALUES
	(1, 'Accesorios'),
	(2, 'Repuestos'),
	(3, 'Extras');
/*!40000 ALTER TABLE `rubros` ENABLE KEYS */;

-- Volcando estructura para tabla systemix_alike.stock
CREATE TABLE IF NOT EXISTS `stock` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `producto_colorid` int(11) NOT NULL,
  `localid` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  PRIMARY KEY (`id`,`producto_colorid`,`localid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla systemix_alike.stock: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `stock` DISABLE KEYS */;
REPLACE INTO `stock` (`id`, `producto_colorid`, `localid`, `cantidad`) VALUES
	(1, 55, 1, 10);
/*!40000 ALTER TABLE `stock` ENABLE KEYS */;

-- Volcando estructura para tabla systemix_alike.subcategorias
CREATE TABLE IF NOT EXISTS `subcategorias` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(120) NOT NULL,
  `categoriaid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla systemix_alike.subcategorias: ~12 rows (aproximadamente)
/*!40000 ALTER TABLE `subcategorias` DISABLE KEYS */;
REPLACE INTO `subcategorias` (`id`, `nombre`, `categoriaid`) VALUES
	(17, 'LCD', 7),
	(18, 'MODULO (LCD+TOUCH)', 7),
	(19, 'TOUCH', 7),
	(21, 'DATOS', 2),
	(22, 'AUX', 2),
	(23, '3 IN ONE', 2),
	(24, 'CON LUZ', 3),
	(25, 'TRANSPARENTE', 3),
	(26, 'RIGIDA', 3),
	(27, 'ANTIGRAVEDAD', 3),
	(28, 'LITIO', 10),
	(29, 'MODULO (LCD+TOUCH+HOME)', 7);
/*!40000 ALTER TABLE `subcategorias` ENABLE KEYS */;

-- Volcando estructura para tabla systemix_alike.sueldo_pagos
CREATE TABLE IF NOT EXISTS `sueldo_pagos` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `monto` decimal(10,2) NOT NULL,
  `vendedorid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla systemix_alike.sueldo_pagos: ~7 rows (aproximadamente)
/*!40000 ALTER TABLE `sueldo_pagos` DISABLE KEYS */;
REPLACE INTO `sueldo_pagos` (`id`, `fecha`, `monto`, `vendedorid`) VALUES
	(1, '2017-03-06', 150000.00, 1),
	(2, '2017-02-09', 23323.00, 1),
	(3, '2017-02-28', 22222.00, 1),
	(4, '2017-02-23', 8778.00, 1),
	(5, '2017-03-06', 123.00, 1),
	(6, '2017-02-16', 88888.00, 1),
	(7, '2017-03-13', 99.00, 1);
/*!40000 ALTER TABLE `sueldo_pagos` ENABLE KEYS */;

-- Volcando estructura para tabla systemix_alike.Transacciones
CREATE TABLE IF NOT EXISTS `Transacciones` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla systemix_alike.Transacciones: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `Transacciones` DISABLE KEYS */;
/*!40000 ALTER TABLE `Transacciones` ENABLE KEYS */;

-- Volcando estructura para tabla systemix_alike.vendedores
CREATE TABLE IF NOT EXISTS `vendedores` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(120) NOT NULL,
  `apellido` varchar(120) NOT NULL,
  `direccion` varchar(120) NOT NULL,
  `usuario` varchar(120) NOT NULL,
  `clave` varchar(31) NOT NULL,
  `sueldo` bigint(20) DEFAULT NULL,
  `fecha_pago_sueldo` datetime DEFAULT NULL,
  `comision` float NOT NULL,
  `jerarquia` int(7) NOT NULL,
  `email` varchar(120) NOT NULL,
  `dni` varchar(120) NOT NULL,
  `localid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla systemix_alike.vendedores: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `vendedores` DISABLE KEYS */;
REPLACE INTO `vendedores` (`id`, `nombre`, `apellido`, `direccion`, `usuario`, `clave`, `sueldo`, `fecha_pago_sueldo`, `comision`, `jerarquia`, `email`, `dni`, `localid`) VALUES
	(1, 'Leandro', 'Golda', '', 'Chaco', 'sinfrazada', NULL, NULL, 0, 0, 'lgolda@orshicell.com.ar', '123456789', NULL);
/*!40000 ALTER TABLE `vendedores` ENABLE KEYS */;

-- Volcando estructura para tabla systemix_alike.ventas
CREATE TABLE IF NOT EXISTS `ventas` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `vendedorid` bigint(20) NOT NULL,
  `clienteid` bigint(20) NOT NULL,
  `fecha` datetime NOT NULL,
  `total2` decimal(10,2) NOT NULL DEFAULT '0.00',
  `envioid` int(11) DEFAULT NULL,
  `descuento` double DEFAULT '0',
  `metodo_pagoid` int(11) NOT NULL,
  `estado` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla systemix_alike.ventas: ~15 rows (aproximadamente)
/*!40000 ALTER TABLE `ventas` DISABLE KEYS */;
REPLACE INTO `ventas` (`id`, `vendedorid`, `clienteid`, `fecha`, `total2`, `envioid`, `descuento`, `metodo_pagoid`, `estado`) VALUES
	(1, 1, 5, '2017-02-07 17:21:17', 2653.00, NULL, 0, 1, 0),
	(2, 1, 5, '2017-02-07 17:21:22', 7765.00, NULL, 0, 1, 0),
	(3, 1, 5, '2017-02-08 19:42:27', 3345.00, NULL, 0, 1, 0),
	(4, 1, 1, '2017-02-08 19:42:34', 1556.00, NULL, 0, 4, 0),
	(5, 1, 1, '2017-02-16 04:27:27', 1233.00, NULL, 0, 0, 1),
	(6, 1, 5, '2017-03-02 01:56:21', 0.00, NULL, 0, 0, 0),
	(7, 1, 5, '2017-03-02 01:56:37', 0.00, NULL, 0, 0, 0),
	(8, 1, 1, '2017-03-02 07:28:58', 0.00, NULL, 0, 0, 0),
	(9, 1, 5, '2017-03-02 07:33:43', 0.00, NULL, 0, 0, 0),
	(10, 1, 5, '2017-03-02 07:35:16', 0.00, NULL, 0, 0, 0),
	(11, 1, 1, '2017-03-02 07:35:34', 0.00, NULL, 0, 0, 0),
	(12, 1, 5, '2017-03-02 07:45:28', 0.00, NULL, 0, 0, 0),
	(13, 1, 1, '2017-03-02 18:10:11', 0.00, NULL, 0, 0, 0),
	(14, 1, 1, '2017-03-10 19:43:08', 0.00, NULL, 0, 0, 0),
	(15, 1, 5, '2017-03-15 19:21:13', 0.00, NULL, 0, 0, 0);
/*!40000 ALTER TABLE `ventas` ENABLE KEYS */;

-- Volcando estructura para tabla systemix_alike.ventas_envios
CREATE TABLE IF NOT EXISTS `ventas_envios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `envioid` int(11) NOT NULL DEFAULT '0',
  `ventaid` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla systemix_alike.ventas_envios: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `ventas_envios` DISABLE KEYS */;
REPLACE INTO `ventas_envios` (`id`, `envioid`, `ventaid`) VALUES
	(2, 2, 12),
	(4, 1, 5),
	(5, 3, 13),
	(6, 5, 11);
/*!40000 ALTER TABLE `ventas_envios` ENABLE KEYS */;

-- Volcando estructura para tabla systemix_alike.ventas_estados
CREATE TABLE IF NOT EXISTS `ventas_estados` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla systemix_alike.ventas_estados: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `ventas_estados` DISABLE KEYS */;
REPLACE INTO `ventas_estados` (`id`, `nombre`) VALUES
	(0, 'Abierta'),
	(1, 'Finalizada'),
	(2, 'En proceso');
/*!40000 ALTER TABLE `ventas_estados` ENABLE KEYS */;

-- Volcando estructura para tabla systemix_alike.ventas_renglones
CREATE TABLE IF NOT EXISTS `ventas_renglones` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `ventaid` bigint(20) NOT NULL,
  `stockid` bigint(20) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `cantidad_entregada` bigint(20) NOT NULL DEFAULT '0',
  `precio_unitario` decimal(10,2) NOT NULL,
  `total_renglon` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla systemix_alike.ventas_renglones: ~13 rows (aproximadamente)
/*!40000 ALTER TABLE `ventas_renglones` DISABLE KEYS */;
REPLACE INTO `ventas_renglones` (`id`, `ventaid`, `stockid`, `cantidad`, `cantidad_entregada`, `precio_unitario`, `total_renglon`) VALUES
	(1, 1, 1, 1, 1, 1.00, 1.00),
	(2, 5, 1, 1, 0, 12.00, 12.00),
	(3, 5, 1, 7, 0, 33.00, 233.00),
	(4, 5, 1, 1000, 0, 99.00, 99000.00),
	(6, 5, 1, 22, 0, 1212.00, 26664.00),
	(8, 5, 1, 20, 0, 1500.00, 30000.00),
	(9, 5, 1, 43, 0, 34.20, 1470.60),
	(10, 5, 1, 2, 0, 3000.00, 6000.00),
	(11, 11, 1, 2, 0, 34.00, 68.00),
	(12, 12, 1, 23, 0, 1.00, 23.00),
	(13, 13, 1, 25, 0, 46.00, 1150.00),
	(14, 5, 1, 10, 0, 22.00, 220.00),
	(15, 4, 1, 1, 0, 12.00, 12.00);
/*!40000 ALTER TABLE `ventas_renglones` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
