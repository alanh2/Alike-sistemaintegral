SELECT `ventas`.*, `clientes`.`razon_social` as `cliente`, `clientes`.`tel_codigo_area`, `clientes`.`tel_numero`, `clientes`.`cel_numero`, `clientes`.`direccion`, `clientes`.`localidad`, `clientes`.`cp`, `clientes`.`email`, `clientes`.`dni`, `clientes`.`cuil`, `clientes`.`cuit`, `clientes`.`ranking`, `vendedores`.`nombre` as `vendedor`
FROM `ventas`
JOIN `clientes` ON `clientes`.`id` = `ventas`.`clienteid`
JOIN `vendedores` ON `vendedores`.`id` = `ventas`.`vendedorid`
WHERE `ventas`.`id` = '5' 
 Execution Time:0.0016610622406

SELECT `productos`.*, `marcas`.`nombre` as `marca`, `subcategorias`.`nombre` as `subcategoria`, `proveedores`.`nombre` as `proveedor`, `modelos`.`nombre` as `modelo`, `modelos`.`marcaid`
FROM `productos`
JOIN `subcategorias` ON `subcategorias`.`id` = `productos`.`subcategoriaid`
JOIN `proveedores` ON `proveedores`.`id` = `productos`.`proveedorid`
JOIN `modelos` ON `modelos`.`id` = `productos`.`modeloid`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid`
ORDER BY `id` DESC 
 Execution Time:0.00214815139771

SELECT `ventas_renglones`.*, `productos`.`nombre` as `producto`, `colores`.`nombre` as `color`
FROM `ventas_renglones`
JOIN `stock` ON `ventas_renglones`.`stockid`= `stock`.`id`
JOIN `productos_colores` ON `stock`.`producto_colorid`= `productos_colores`.`id`
JOIN `colores` ON `productos_colores`.`colorid`= `colores`.`id`
JOIN `productos` ON `productos_colores`.`productoid`= `productos`.`id`
WHERE `ventaid` = '5'
ORDER BY `id` DESC 
 Execution Time:0.00202608108521

SELECT COUNT(*) AS `numrows`
FROM `ventas_renglones`
WHERE `ventaid` = '5' 
 Execution Time:0.000333070755005

SELECT `ventas_renglones`.*, `productos`.`nombre` as `producto`, `colores`.`nombre` as `color`
FROM `ventas_renglones`
JOIN `stock` ON `ventas_renglones`.`stockid`= `stock`.`id`
JOIN `productos_colores` ON `stock`.`producto_colorid`= `productos_colores`.`id`
JOIN `colores` ON `productos_colores`.`colorid`= `colores`.`id`
JOIN `productos` ON `productos_colores`.`productoid`= `productos`.`id`
WHERE `ventaid` = '5'
ORDER BY `id` DESC 
 Execution Time:0.000169992446899

SELECT `ventas`.*, `clientes`.`razon_social` as `cliente`, `clientes`.`tel_codigo_area`, `clientes`.`tel_numero`, `clientes`.`cel_numero`, `clientes`.`direccion`, `clientes`.`localidad`, `clientes`.`cp`, `clientes`.`email`, `clientes`.`dni`, `clientes`.`cuil`, `clientes`.`cuit`, `clientes`.`ranking`, `vendedores`.`nombre` as `vendedor`
FROM `ventas`
JOIN `clientes` ON `clientes`.`id` = `ventas`.`clienteid`
JOIN `vendedores` ON `vendedores`.`id` = `ventas`.`vendedorid`
WHERE `ventas`.`id` = '5' 
 Execution Time:0.00191903114319

SELECT `productos`.*, `marcas`.`nombre` as `marca`, `subcategorias`.`nombre` as `subcategoria`, `proveedores`.`nombre` as `proveedor`, `modelos`.`nombre` as `modelo`, `modelos`.`marcaid`
FROM `productos`
JOIN `subcategorias` ON `subcategorias`.`id` = `productos`.`subcategoriaid`
JOIN `proveedores` ON `proveedores`.`id` = `productos`.`proveedorid`
JOIN `modelos` ON `modelos`.`id` = `productos`.`modeloid`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid`
ORDER BY `id` DESC 
 Execution Time:0.00203204154968

SELECT `ventas_renglones`.*, `productos`.`nombre` as `producto`, `colores`.`nombre` as `color`
FROM `ventas_renglones`
JOIN `stock` ON `ventas_renglones`.`stockid`= `stock`.`id`
JOIN `productos_colores` ON `stock`.`producto_colorid`= `productos_colores`.`id`
JOIN `colores` ON `productos_colores`.`colorid`= `colores`.`id`
JOIN `productos` ON `productos_colores`.`productoid`= `productos`.`id`
WHERE `ventaid` = '5'
ORDER BY `id` DESC 
 Execution Time:0.0014328956604

SELECT COUNT(*) AS `numrows`
FROM `ventas_renglones`
WHERE `ventaid` = '5' 
 Execution Time:0.000246047973633

SELECT `ventas_renglones`.*, `productos`.`nombre` as `producto`, `colores`.`nombre` as `color`
FROM `ventas_renglones`
JOIN `stock` ON `ventas_renglones`.`stockid`= `stock`.`id`
JOIN `productos_colores` ON `stock`.`producto_colorid`= `productos_colores`.`id`
JOIN `colores` ON `productos_colores`.`colorid`= `colores`.`id`
JOIN `productos` ON `productos_colores`.`productoid`= `productos`.`id`
WHERE `ventaid` = '5'
ORDER BY `id` DESC 
 Execution Time:0.000107049942017

