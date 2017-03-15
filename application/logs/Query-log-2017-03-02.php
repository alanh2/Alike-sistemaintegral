SELECT `ventas`.*, `vendedores`.`nombre` as `vendedor`, `ventas_estados`.`nombre` as `estado_nombre`, `clientes`.`razon_social` as `cliente`, `clientes`.`tel_codigo_area`, `clientes`.`tel_numero`, `clientes`.`cel_numero`, `clientes`.`direccion`, `clientes`.`localidad`, `clientes`.`cp`, `clientes`.`email`, `clientes`.`dni`, `clientes`.`cuil`, `clientes`.`cuit`, `clientes`.`ranking`
FROM `ventas`
JOIN `clientes` ON `clientes`.`id` = `ventas`.`clienteid`
JOIN `vendedores` ON `vendedores`.`id` = `ventas`.`vendedorid`
JOIN `ventas_estados` ON `ventas_estados`.`id` = `ventas`.`estado`
WHERE `ventas`.`id` = '5' 
 Execution Time:0.00117993354797

SELECT SUM(total_renglon) as total
FROM `ventas_renglones`
WHERE `ventaid` = '5'
GROUP BY `ventaid` 
 Execution Time:0.000761032104492

SELECT `cobros`.`fecha` as `fecha`, `aplicaciones_cobro_venta`.`monto` as `monto`, `metodos_pago`.`nombre` as `metodo_cobro_nombre`
FROM `aplicaciones_cobro_venta`
JOIN `cobros` ON `cobros`.`id` = `aplicaciones_cobro_venta`.`cobroid`
JOIN `metodos_pago` ON `metodos_pago`.`id` = `cobros`.`metododepagoid`
WHERE `ventaid` = '5'
ORDER BY `fecha` DESC 
 Execution Time:0.0012571811676

SELECT `ventas_renglones`.*, `productos`.`nombre` as `producto`, `colores`.`nombre` as `color`
FROM `ventas_renglones`
JOIN `stock` ON `ventas_renglones`.`stockid`= `stock`.`id`
JOIN `productos_colores` ON `stock`.`producto_colorid`= `productos_colores`.`id`
JOIN `colores` ON `productos_colores`.`colorid`= `colores`.`id`
JOIN `productos` ON `productos_colores`.`productoid`= `productos`.`id`
WHERE `ventaid` = '5'
ORDER BY `id` DESC 
 Execution Time:0.00127100944519

SELECT COUNT(*) AS `numrows`
FROM `ventas_renglones`
WHERE `ventaid` = '5' 
 Execution Time:0.000262975692749

SELECT `ventas_renglones`.*, `productos`.`nombre` as `producto`, `colores`.`nombre` as `color`
FROM `ventas_renglones`
JOIN `stock` ON `ventas_renglones`.`stockid`= `stock`.`id`
JOIN `productos_colores` ON `stock`.`producto_colorid`= `productos_colores`.`id`
JOIN `colores` ON `productos_colores`.`colorid`= `colores`.`id`
JOIN `productos` ON `productos_colores`.`productoid`= `productos`.`id`
WHERE `ventaid` = '5'
ORDER BY `id` DESC 
 Execution Time:8.98838043213E-5

SELECT `productos`.*, `marcas`.`nombre` as `marca`, `subcategorias`.`nombre` as `subcategoria`, `proveedores`.`nombre` as `proveedor`, `modelos`.`nombre` as `modelo`, `modelos`.`marcaid`
FROM `productos`
JOIN `subcategorias` ON `subcategorias`.`id` = `productos`.`subcategoriaid`
JOIN `proveedores` ON `proveedores`.`id` = `productos`.`proveedorid`
JOIN `modelos` ON `modelos`.`id` = `productos`.`modeloid`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid`
ORDER BY `id` DESC 
 Execution Time:0.00172400474548

SELECT *
FROM `clientes`
ORDER BY `id` DESC 
 Execution Time:0.000802040100098

SELECT *
FROM `vendedores`
ORDER BY `id` DESC 
 Execution Time:0.00065016746521

SELECT *
FROM `clientes_comentarios`
WHERE `clienteid` = '5'
ORDER BY `id` DESC 
 Execution Time:0.000726938247681

INSERT INTO `ventas` (`clienteid`, `vendedorid`, `fecha`, `estado`) VALUES ('5', '1', '2017-03-02 01:56:21', 'iniciada') 
 Execution Time:0.00071120262146

SELECT *
FROM `clientes`
ORDER BY `id` DESC 
 Execution Time:0.000166893005371

SELECT `productos`.*, `marcas`.`nombre` as `marca`, `subcategorias`.`nombre` as `subcategoria`, `proveedores`.`nombre` as `proveedor`, `modelos`.`nombre` as `modelo`, `modelos`.`marcaid`
FROM `productos`
JOIN `subcategorias` ON `subcategorias`.`id` = `productos`.`subcategoriaid`
JOIN `proveedores` ON `proveedores`.`id` = `productos`.`proveedorid`
JOIN `modelos` ON `modelos`.`id` = `productos`.`modeloid`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid`
ORDER BY `id` DESC 
 Execution Time:0.000220060348511

SELECT *
FROM `vendedores`
ORDER BY `id` DESC 
 Execution Time:0.000138998031616

SELECT *
FROM `clientes_comentarios`
WHERE `clienteid` = '5'
ORDER BY `id` DESC 
 Execution Time:0.000123977661133

SELECT `productos`.*, `marcas`.`nombre` as `marca`, `subcategorias`.`nombre` as `subcategoria`, `proveedores`.`nombre` as `proveedor`, `modelos`.`nombre` as `modelo`, `modelos`.`marcaid`
FROM `productos`
JOIN `subcategorias` ON `subcategorias`.`id` = `productos`.`subcategoriaid`
JOIN `proveedores` ON `proveedores`.`id` = `productos`.`proveedorid`
JOIN `modelos` ON `modelos`.`id` = `productos`.`modeloid`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid`
ORDER BY `id` DESC 
 Execution Time:0.000145196914673

SELECT *
FROM `clientes`
ORDER BY `id` DESC 
 Execution Time:0.000164031982422

SELECT *
FROM `vendedores`
ORDER BY `id` DESC 
 Execution Time:0.000149011611938

SELECT *
FROM `clientes_comentarios`
WHERE `clienteid` = '5'
ORDER BY `id` DESC 
 Execution Time:9.60826873779E-5

INSERT INTO `ventas` (`clienteid`, `vendedorid`, `fecha`, `estado`) VALUES ('5', '1', '2017-03-02 01:56:37', 'iniciada') 
 Execution Time:0.00062108039856

SELECT `ventas`.*, `clientes`.`razon_social` as `cliente`, `clientes`.`tel_codigo_area`, `clientes`.`tel_numero`, `clientes`.`cel_numero`, `clientes`.`direccion`, `clientes`.`localidad`, `clientes`.`cp`, `clientes`.`email`, `clientes`.`dni`, `clientes`.`cuil`, `clientes`.`cuit`, `clientes`.`ranking`, `vendedores`.`nombre` as `vendedor`
FROM `ventas`
JOIN `clientes` ON `clientes`.`id` = `ventas`.`clienteid`
JOIN `vendedores` ON `vendedores`.`id` = `ventas`.`vendedorid`
WHERE `ventas`.`id` = '8' 
 Execution Time:0.00100708007812

SELECT `ventas`.*, `clientes`.`razon_social` as `cliente`, `clientes`.`tel_codigo_area`, `clientes`.`tel_numero`, `clientes`.`cel_numero`, `clientes`.`direccion`, `clientes`.`localidad`, `clientes`.`cp`, `clientes`.`email`, `clientes`.`dni`, `clientes`.`cuil`, `clientes`.`cuit`, `clientes`.`ranking`, `vendedores`.`nombre` as `vendedor`
FROM `ventas`
JOIN `clientes` ON `clientes`.`id` = `ventas`.`clienteid`
JOIN `vendedores` ON `vendedores`.`id` = `ventas`.`vendedorid`
WHERE `ventas`.`id` = '9' 
 Execution Time:0.000634908676147

SELECT `ventas`.*, `clientes`.`razon_social` as `cliente`, `clientes`.`tel_codigo_area`, `clientes`.`tel_numero`, `clientes`.`cel_numero`, `clientes`.`direccion`, `clientes`.`localidad`, `clientes`.`cp`, `clientes`.`email`, `clientes`.`dni`, `clientes`.`cuil`, `clientes`.`cuit`, `clientes`.`ranking`, `vendedores`.`nombre` as `vendedor`
FROM `ventas`
JOIN `clientes` ON `clientes`.`id` = `ventas`.`clienteid`
JOIN `vendedores` ON `vendedores`.`id` = `ventas`.`vendedorid`
WHERE `ventas`.`id` = '10' 
 Execution Time:0.000633955001831

SELECT `ventas`.*, `clientes`.`razon_social` as `cliente`, `clientes`.`tel_codigo_area`, `clientes`.`tel_numero`, `clientes`.`cel_numero`, `clientes`.`direccion`, `clientes`.`localidad`, `clientes`.`cp`, `clientes`.`email`, `clientes`.`dni`, `clientes`.`cuil`, `clientes`.`cuit`, `clientes`.`ranking`, `vendedores`.`nombre` as `vendedor`
FROM `ventas`
JOIN `clientes` ON `clientes`.`id` = `ventas`.`clienteid`
JOIN `vendedores` ON `vendedores`.`id` = `ventas`.`vendedorid`
WHERE `ventas`.`id` = '7' 
 Execution Time:0.000665903091431

SELECT `productos`.*, `marcas`.`nombre` as `marca`, `subcategorias`.`nombre` as `subcategoria`, `proveedores`.`nombre` as `proveedor`, `modelos`.`nombre` as `modelo`, `modelos`.`marcaid`
FROM `productos`
JOIN `subcategorias` ON `subcategorias`.`id` = `productos`.`subcategoriaid`
JOIN `proveedores` ON `proveedores`.`id` = `productos`.`proveedorid`
JOIN `modelos` ON `modelos`.`id` = `productos`.`modeloid`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid`
ORDER BY `id` DESC 
 Execution Time:0.00162291526794

SELECT `ventas_renglones`.*, `productos`.`nombre` as `producto`, `colores`.`nombre` as `color`
FROM `ventas_renglones`
JOIN `stock` ON `ventas_renglones`.`stockid`= `stock`.`id`
JOIN `productos_colores` ON `stock`.`producto_colorid`= `productos_colores`.`id`
JOIN `colores` ON `productos_colores`.`colorid`= `colores`.`id`
JOIN `productos` ON `productos_colores`.`productoid`= `productos`.`id`
WHERE `ventaid` = '7'
ORDER BY `id` DESC 
 Execution Time:0.00157594680786

SELECT COUNT(*) AS `numrows`
FROM `ventas_renglones`
WHERE `ventaid` = '7' 
 Execution Time:0.000278949737549

SELECT `ventas_renglones`.*, `productos`.`nombre` as `producto`, `colores`.`nombre` as `color`
FROM `ventas_renglones`
JOIN `stock` ON `ventas_renglones`.`stockid`= `stock`.`id`
JOIN `productos_colores` ON `stock`.`producto_colorid`= `productos_colores`.`id`
JOIN `colores` ON `productos_colores`.`colorid`= `colores`.`id`
JOIN `productos` ON `productos_colores`.`productoid`= `productos`.`id`
WHERE `ventaid` = '7'
ORDER BY `id` DESC 
 Execution Time:0.000149011611938

SELECT `ventas`.*, `clientes`.`razon_social` as `cliente`, `clientes`.`tel_codigo_area`, `clientes`.`tel_numero`, `clientes`.`cel_numero`, `clientes`.`direccion`, `clientes`.`localidad`, `clientes`.`cp`, `clientes`.`email`, `clientes`.`dni`, `clientes`.`cuil`, `clientes`.`cuit`, `clientes`.`ranking`, `vendedores`.`nombre` as `vendedor`
FROM `ventas`
JOIN `clientes` ON `clientes`.`id` = `ventas`.`clienteid`
JOIN `vendedores` ON `vendedores`.`id` = `ventas`.`vendedorid`
WHERE `ventas`.`id` = '5' 
 Execution Time:0.000668048858643

SELECT `productos`.*, `marcas`.`nombre` as `marca`, `subcategorias`.`nombre` as `subcategoria`, `proveedores`.`nombre` as `proveedor`, `modelos`.`nombre` as `modelo`, `modelos`.`marcaid`
FROM `productos`
JOIN `subcategorias` ON `subcategorias`.`id` = `productos`.`subcategoriaid`
JOIN `proveedores` ON `proveedores`.`id` = `productos`.`proveedorid`
JOIN `modelos` ON `modelos`.`id` = `productos`.`modeloid`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid`
ORDER BY `id` DESC 
 Execution Time:0.000157117843628

SELECT *
FROM `clientes`
ORDER BY `id` DESC 
 Execution Time:0.000566005706787

SELECT *
FROM `vendedores`
ORDER BY `id` DESC 
 Execution Time:0.000419855117798

SELECT *
FROM `clientes_comentarios`
WHERE `clienteid` = '5'
ORDER BY `id` DESC 
 Execution Time:0.000776052474976

