-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 27-04-2017 a las 11:47:40
-- Versión del servidor: 10.0.30-MariaDB
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `systemix_alike`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aplicaciones_cobro_venta`
--

CREATE TABLE `aplicaciones_cobro_venta` (
  `id` bigint(20) NOT NULL,
  `ventaid` bigint(20) DEFAULT '0',
  `cobroid` bigint(20) NOT NULL DEFAULT '0',
  `monto` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(20) NOT NULL,
  `nombre` varchar(120) NOT NULL,
  `rubroid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` bigint(20) NOT NULL,
  `razon_social` varchar(255) NOT NULL,
  `tel_codigo_area` varchar(10) DEFAULT NULL,
  `tel_numero` varchar(20) DEFAULT NULL,
  `cel_numero` int(11) DEFAULT NULL,
  `direccion` varchar(120) NOT NULL,
  `localidadid` varchar(120) NOT NULL,
  `cp` int(11) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `dni` varchar(31) NOT NULL,
  `cuitcuil` varchar(40) DEFAULT NULL,
  `web` varchar(120) DEFAULT NULL,
  `password` varchar(31) NOT NULL,
  `ranking` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes_comentarios`
--

CREATE TABLE `clientes_comentarios` (
  `id` int(11) NOT NULL,
  `clienteid` int(11) DEFAULT '0',
  `puntaje` float DEFAULT '0',
  `comentario` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cobros`
--

CREATE TABLE `cobros` (
  `id` bigint(20) NOT NULL,
  `fecha` datetime NOT NULL,
  `monto` decimal(10,2) NOT NULL,
  `clienteid` bigint(20) NOT NULL,
  `metododepagoid` int(11) NOT NULL,
  `metodoid` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colores`
--

CREATE TABLE `colores` (
  `id` int(20) NOT NULL,
  `nombre` varchar(120) NOT NULL,
  `name` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `id` bigint(20) NOT NULL,
  `descripcion` varchar(120) NOT NULL,
  `metodo_pagoid` int(11) NOT NULL,
  `proveedorid` int(11) NOT NULL,
  `total` double NOT NULL,
  `fecha` datetime NOT NULL,
  `descuento` double DEFAULT NULL,
  `envioid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_compra`
--

CREATE TABLE `detalle_compra` (
  `id` bigint(20) NOT NULL,
  `compra_id` bigint(20) NOT NULL,
  `producto_id` bigint(20) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `cantidad_recibida` int(11) NOT NULL,
  `costo_unitario` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_devolucion`
--

CREATE TABLE `detalle_devolucion` (
  `id` bigint(20) NOT NULL,
  `stock_local_id` bigint(20) NOT NULL,
  `devolucion_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Detalle_transaccion`
--

CREATE TABLE `Detalle_transaccion` (
  `id` bigint(20) NOT NULL,
  `transaccion_id` bigint(20) NOT NULL,
  `stock_local_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `devoluciones`
--

CREATE TABLE `devoluciones` (
  `id` bigint(20) NOT NULL,
  `ventaid` bigint(20) NOT NULL,
  `fecha` datetime NOT NULL,
  `total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `devoluciones_renglones`
--

CREATE TABLE `devoluciones_renglones` (
  `id` int(11) NOT NULL,
  `venta_renglonid` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `devolucionid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entradas`
--

CREATE TABLE `entradas` (
  `id` bigint(20) NOT NULL,
  `clienteid` bigint(20) NOT NULL DEFAULT '0',
  `fecha` datetime NOT NULL,
  `monto` decimal(10,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `envios`
--

CREATE TABLE `envios` (
  `id` bigint(20) NOT NULL,
  `metodoenvio` int(11) NOT NULL DEFAULT '0',
  `envtablaid` bigint(20) NOT NULL DEFAULT '0',
  `fechaestimada` date NOT NULL,
  `operacion` int(11) NOT NULL,
  `recibe` varchar(80) DEFAULT NULL,
  `dni` varchar(20) DEFAULT NULL,
  `envtablaid2` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `env_motos`
--

CREATE TABLE `env_motos` (
  `id` bigint(20) NOT NULL,
  `costo` decimal(10,2) NOT NULL DEFAULT '0.00',
  `direccion` varchar(80) NOT NULL DEFAULT '0',
  `tracking` varchar(50) NOT NULL DEFAULT '0',
  `motoid` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `env_ocaexpress`
--

CREATE TABLE `env_ocaexpress` (
  `id` bigint(20) NOT NULL,
  `costo` decimal(10,2) NOT NULL DEFAULT '0.00',
  `direccion` varchar(80) NOT NULL DEFAULT '0',
  `tracking` varchar(50) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `env_ocas`
--

CREATE TABLE `env_ocas` (
  `id` bigint(20) NOT NULL,
  `costo` decimal(10,2) NOT NULL DEFAULT '0.00',
  `direccion` varchar(80) NOT NULL DEFAULT '0',
  `tracking` varchar(50) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `env_otros`
--

CREATE TABLE `env_otros` (
  `id` bigint(20) NOT NULL,
  `costo` decimal(10,2) NOT NULL DEFAULT '0.00',
  `direccion` varchar(80) NOT NULL DEFAULT '0',
  `tracking` varchar(50) NOT NULL DEFAULT '0',
  `nombreempresa` varchar(80) DEFAULT NULL,
  `direccionempresa` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `env_retiros`
--

CREATE TABLE `env_retiros` (
  `id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gastos`
--

CREATE TABLE `gastos` (
  `id` bigint(20) NOT NULL,
  `monto` double NOT NULL,
  `nombre` varchar(120) NOT NULL,
  `tipos_gastoid` bigint(20) NOT NULL,
  `fecha` datetime NOT NULL,
  `vendedorid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `locales`
--

CREATE TABLE `locales` (
  `id` bigint(20) NOT NULL,
  `nombre` varchar(120) NOT NULL,
  `direccion` varchar(120) NOT NULL,
  `telefono` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `localidades`
--

CREATE TABLE `localidades` (
  `id` int(11) NOT NULL,
  `provinciaid` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--

CREATE TABLE `marcas` (
  `id` bigint(20) NOT NULL,
  `nombre` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `metodos_envio`
--

CREATE TABLE `metodos_envio` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `metodos_pago`
--

CREATE TABLE `metodos_pago` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modelos`
--

CREATE TABLE `modelos` (
  `id` bigint(20) NOT NULL,
  `nombre` varchar(120) NOT NULL,
  `marcaid` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `motos`
--

CREATE TABLE `motos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL DEFAULT '0',
  `telefono` varchar(50) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mov_cheques`
--

CREATE TABLE `mov_cheques` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `numeracion` varchar(50) DEFAULT NULL,
  `vencimiento` date DEFAULT NULL,
  `banco` varchar(50) DEFAULT NULL,
  `operacion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=FIXED;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mov_cuentacorrientes`
--

CREATE TABLE `mov_cuentacorrientes` (
  `id` bigint(20) NOT NULL,
  `operacion` int(11) DEFAULT NULL,
  `saldo` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=FIXED;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mov_efectivos`
--

CREATE TABLE `mov_efectivos` (
  `id` bigint(20) NOT NULL,
  `operacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mov_mercadopagos`
--

CREATE TABLE `mov_mercadopagos` (
  `id` bigint(20) NOT NULL,
  `operacion` int(11) DEFAULT NULL,
  `codigomp` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=FIXED;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mov_panamas`
--

CREATE TABLE `mov_panamas` (
  `id` bigint(20) NOT NULL,
  `operacion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=FIXED;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mov_tarjetas`
--

CREATE TABLE `mov_tarjetas` (
  `id` bigint(20) NOT NULL,
  `titular` varchar(80) DEFAULT NULL,
  `operacion` int(11) DEFAULT NULL,
  `vencimiento` date DEFAULT NULL,
  `digitos` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=FIXED;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mov_transferencias`
--

CREATE TABLE `mov_transferencias` (
  `id` bigint(20) NOT NULL,
  `operacion` int(11) DEFAULT NULL,
  `banco` varchar(50) DEFAULT NULL,
  `titular` varchar(50) DEFAULT NULL,
  `codigo_operacion` varchar(50) DEFAULT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=FIXED;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nota_credito`
--

CREATE TABLE `nota_credito` (
  `id` bigint(20) NOT NULL,
  `cobroid` bigint(20) NOT NULL DEFAULT '0',
  `gastoid` int(11) NOT NULL,
  `monto` decimal(10,2) NOT NULL DEFAULT '0.00',
  `saldo` decimal(10,2) NOT NULL DEFAULT '0.00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` bigint(20) NOT NULL,
  `codigo` varchar(255) NOT NULL,
  `proveedorid` bigint(20) NOT NULL,
  `modeloid` bigint(20) NOT NULL,
  `subcategoriaid` bigint(20) NOT NULL,
  `marcaid2` bigint(20) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_colores`
--

CREATE TABLE `productos_colores` (
  `id` int(11) NOT NULL,
  `productoid` int(11) NOT NULL,
  `colorid` int(11) NOT NULL,
  `costo` float NOT NULL,
  `porcentaje1` float NOT NULL,
  `porcentaje2` float NOT NULL,
  `porcentaje3` float NOT NULL,
  `porcentaje4` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id` bigint(20) NOT NULL,
  `nombre` varchar(120) NOT NULL,
  `direccion` varchar(120) NOT NULL,
  `telefono` varchar(120) NOT NULL,
  `paisid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincias`
--

CREATE TABLE `provincias` (
  `id` int(10) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `RMA`
--

CREATE TABLE `RMA` (
  `id` bigint(20) NOT NULL,
  `stock_local_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rubros`
--

CREATE TABLE `rubros` (
  `id` int(20) NOT NULL,
  `nombre` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stock`
--

CREATE TABLE `stock` (
  `id` int(11) NOT NULL,
  `producto_colorid` int(11) NOT NULL,
  `localid` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcategorias`
--

CREATE TABLE `subcategorias` (
  `id` int(20) NOT NULL,
  `nombre` varchar(120) NOT NULL,
  `categoriaid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sueldo_pagos`
--

CREATE TABLE `sueldo_pagos` (
  `id` bigint(20) NOT NULL,
  `fecha` date NOT NULL,
  `monto` decimal(10,2) NOT NULL,
  `vendedorid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_gasto`
--

CREATE TABLE `tipos_gasto` (
  `id` bigint(20) NOT NULL,
  `nombre` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Transacciones`
--

CREATE TABLE `Transacciones` (
  `id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vendedores`
--

CREATE TABLE `vendedores` (
  `id` bigint(20) NOT NULL,
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
  `localid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` bigint(20) NOT NULL,
  `vendedorid` bigint(20) NOT NULL,
  `clienteid` bigint(20) NOT NULL,
  `fecha` datetime NOT NULL,
  `total2` decimal(10,2) NOT NULL DEFAULT '0.00',
  `envioid` int(11) DEFAULT NULL,
  `descuento` double DEFAULT '0',
  `metodo_pagoid` int(11) NOT NULL,
  `estado` int(11) DEFAULT NULL,
  `saldada` int(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas_envios`
--

CREATE TABLE `ventas_envios` (
  `id` int(11) NOT NULL,
  `envioid` int(11) NOT NULL DEFAULT '0',
  `ventaid` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas_estados`
--

CREATE TABLE `ventas_estados` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas_renglones`
--

CREATE TABLE `ventas_renglones` (
  `id` bigint(20) NOT NULL,
  `ventaid` bigint(20) NOT NULL,
  `stockid` bigint(20) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `cantidad_entregada` bigint(20) NOT NULL DEFAULT '0',
  `precio_unitario` decimal(10,2) NOT NULL,
  `total_renglon` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `aplicaciones_cobro_venta`
--
ALTER TABLE `aplicaciones_cobro_venta`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clientes_comentarios`
--
ALTER TABLE `clientes_comentarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cobros`
--
ALTER TABLE `cobros`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `colores`
--
ALTER TABLE `colores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_devolucion`
--
ALTER TABLE `detalle_devolucion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `Detalle_transaccion`
--
ALTER TABLE `Detalle_transaccion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `devoluciones`
--
ALTER TABLE `devoluciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `devoluciones_renglones`
--
ALTER TABLE `devoluciones_renglones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `entradas`
--
ALTER TABLE `entradas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `envios`
--
ALTER TABLE `envios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `env_motos`
--
ALTER TABLE `env_motos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `env_ocaexpress`
--
ALTER TABLE `env_ocaexpress`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `env_ocas`
--
ALTER TABLE `env_ocas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `env_otros`
--
ALTER TABLE `env_otros`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `env_retiros`
--
ALTER TABLE `env_retiros`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `gastos`
--
ALTER TABLE `gastos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `locales`
--
ALTER TABLE `locales`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `localidades`
--
ALTER TABLE `localidades`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `metodos_envio`
--
ALTER TABLE `metodos_envio`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `metodos_pago`
--
ALTER TABLE `metodos_pago`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `modelos`
--
ALTER TABLE `modelos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `motos`
--
ALTER TABLE `motos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mov_cheques`
--
ALTER TABLE `mov_cheques`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mov_cuentacorrientes`
--
ALTER TABLE `mov_cuentacorrientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mov_efectivos`
--
ALTER TABLE `mov_efectivos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mov_mercadopagos`
--
ALTER TABLE `mov_mercadopagos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mov_panamas`
--
ALTER TABLE `mov_panamas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mov_tarjetas`
--
ALTER TABLE `mov_tarjetas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mov_transferencias`
--
ALTER TABLE `mov_transferencias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `nota_credito`
--
ALTER TABLE `nota_credito`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos_colores`
--
ALTER TABLE `productos_colores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `provincias`
--
ALTER TABLE `provincias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `RMA`
--
ALTER TABLE `RMA`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `rubros`
--
ALTER TABLE `rubros`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`,`producto_colorid`,`localid`);

--
-- Indices de la tabla `subcategorias`
--
ALTER TABLE `subcategorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sueldo_pagos`
--
ALTER TABLE `sueldo_pagos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipos_gasto`
--
ALTER TABLE `tipos_gasto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `Transacciones`
--
ALTER TABLE `Transacciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `vendedores`
--
ALTER TABLE `vendedores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ventas_envios`
--
ALTER TABLE `ventas_envios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ventas_estados`
--
ALTER TABLE `ventas_estados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ventas_renglones`
--
ALTER TABLE `ventas_renglones`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `aplicaciones_cobro_venta`
--
ALTER TABLE `aplicaciones_cobro_venta`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `clientes_comentarios`
--
ALTER TABLE `clientes_comentarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT de la tabla `cobros`
--
ALTER TABLE `cobros`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;
--
-- AUTO_INCREMENT de la tabla `colores`
--
ALTER TABLE `colores`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `detalle_devolucion`
--
ALTER TABLE `detalle_devolucion`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `Detalle_transaccion`
--
ALTER TABLE `Detalle_transaccion`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `devoluciones`
--
ALTER TABLE `devoluciones`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `devoluciones_renglones`
--
ALTER TABLE `devoluciones_renglones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `entradas`
--
ALTER TABLE `entradas`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `envios`
--
ALTER TABLE `envios`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `env_motos`
--
ALTER TABLE `env_motos`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `env_ocaexpress`
--
ALTER TABLE `env_ocaexpress`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `env_ocas`
--
ALTER TABLE `env_ocas`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `env_otros`
--
ALTER TABLE `env_otros`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `env_retiros`
--
ALTER TABLE `env_retiros`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT de la tabla `gastos`
--
ALTER TABLE `gastos`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `locales`
--
ALTER TABLE `locales`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `localidades`
--
ALTER TABLE `localidades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2383;
--
-- AUTO_INCREMENT de la tabla `marcas`
--
ALTER TABLE `marcas`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de la tabla `metodos_envio`
--
ALTER TABLE `metodos_envio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `metodos_pago`
--
ALTER TABLE `metodos_pago`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `modelos`
--
ALTER TABLE `modelos`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;
--
-- AUTO_INCREMENT de la tabla `motos`
--
ALTER TABLE `motos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `mov_cheques`
--
ALTER TABLE `mov_cheques`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `mov_cuentacorrientes`
--
ALTER TABLE `mov_cuentacorrientes`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `mov_efectivos`
--
ALTER TABLE `mov_efectivos`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;
--
-- AUTO_INCREMENT de la tabla `mov_mercadopagos`
--
ALTER TABLE `mov_mercadopagos`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `mov_panamas`
--
ALTER TABLE `mov_panamas`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `mov_tarjetas`
--
ALTER TABLE `mov_tarjetas`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `mov_transferencias`
--
ALTER TABLE `mov_transferencias`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `nota_credito`
--
ALTER TABLE `nota_credito`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=191;
--
-- AUTO_INCREMENT de la tabla `productos_colores`
--
ALTER TABLE `productos_colores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=283;
--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `provincias`
--
ALTER TABLE `provincias`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT de la tabla `RMA`
--
ALTER TABLE `RMA`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `rubros`
--
ALTER TABLE `rubros`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=271;
--
-- AUTO_INCREMENT de la tabla `subcategorias`
--
ALTER TABLE `subcategorias`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT de la tabla `sueldo_pagos`
--
ALTER TABLE `sueldo_pagos`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `tipos_gasto`
--
ALTER TABLE `tipos_gasto`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `Transacciones`
--
ALTER TABLE `Transacciones`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `vendedores`
--
ALTER TABLE `vendedores`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT de la tabla `ventas_envios`
--
ALTER TABLE `ventas_envios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `ventas_renglones`
--
ALTER TABLE `ventas_renglones`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
