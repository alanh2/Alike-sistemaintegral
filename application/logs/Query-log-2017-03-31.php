SELECT `ventas`.*, `clientes`.`razon_social` as `cliente`, `vendedores`.`nombre` as `vendedor`, IFNULL(SUM(  `total_renglon` ), 0) AS total
FROM `ventas`
JOIN `clientes` ON `clientes`.`id` = `ventas`.`clienteid`
JOIN `vendedores` ON `vendedores`.`id` = `ventas`.`vendedorid`
LEFT JOIN `ventas_renglones` ON `ventas_renglones`.`ventaid` = `ventas`.`id`
WHERE   (
`clientes`.`razon_social` LIKE '%%' ESCAPE '!'
OR  `fecha` LIKE '%%' ESCAPE '!'
 )
GROUP BY `ventas`.`id`
ORDER BY `id` DESC
 LIMIT 10 
 Execution Time:0.293366909027

SELECT COUNT(*) AS `numrows`
FROM `ventas` 
 Execution Time:0.000240087509155

SELECT `ventas`.*, `clientes`.`razon_social` as `cliente`, `vendedores`.`nombre` as `vendedor`, IFNULL(SUM(  `total_renglon` ), 0) AS total
FROM `ventas`
JOIN `clientes` ON `clientes`.`id` = `ventas`.`clienteid`
JOIN `vendedores` ON `vendedores`.`id` = `ventas`.`vendedorid`
LEFT JOIN `ventas_renglones` ON `ventas_renglones`.`ventaid` = `ventas`.`id`
WHERE   (
`clientes`.`razon_social` LIKE '%%' ESCAPE '!'
OR  `fecha` LIKE '%%' ESCAPE '!'
 )
GROUP BY `ventas`.`id`
ORDER BY `id` DESC 
 Execution Time:0.00150895118713

SELECT `ventas`.*, `clientes`.`razon_social` as `cliente`, `vendedores`.`nombre` as `vendedor`, IFNULL(SUM(  `total_renglon` ), 0) AS total
FROM `ventas`
JOIN `clientes` ON `clientes`.`id` = `ventas`.`clienteid`
JOIN `vendedores` ON `vendedores`.`id` = `ventas`.`vendedorid`
LEFT JOIN `ventas_renglones` ON `ventas_renglones`.`ventaid` = `ventas`.`id`
WHERE   (
`clientes`.`razon_social` LIKE '%p%' ESCAPE '!'
OR  `fecha` LIKE '%p%' ESCAPE '!'
 )
GROUP BY `ventas`.`id`
ORDER BY `id` DESC
 LIMIT 10 
 Execution Time:0.00155115127563

SELECT COUNT(*) AS `numrows`
FROM `ventas` 
 Execution Time:0.000113010406494

SELECT `ventas`.*, `clientes`.`razon_social` as `cliente`, `vendedores`.`nombre` as `vendedor`, IFNULL(SUM(  `total_renglon` ), 0) AS total
FROM `ventas`
JOIN `clientes` ON `clientes`.`id` = `ventas`.`clienteid`
JOIN `vendedores` ON `vendedores`.`id` = `ventas`.`vendedorid`
LEFT JOIN `ventas_renglones` ON `ventas_renglones`.`ventaid` = `ventas`.`id`
WHERE   (
`clientes`.`razon_social` LIKE '%p%' ESCAPE '!'
OR  `fecha` LIKE '%p%' ESCAPE '!'
 )
GROUP BY `ventas`.`id`
ORDER BY `id` DESC 
 Execution Time:0.000792980194092

SELECT `ventas`.*, `clientes`.`razon_social` as `cliente`, `vendedores`.`nombre` as `vendedor`, IFNULL(SUM(  `total_renglon` ), 0) AS total
FROM `ventas`
JOIN `clientes` ON `clientes`.`id` = `ventas`.`clienteid`
JOIN `vendedores` ON `vendedores`.`id` = `ventas`.`vendedorid`
LEFT JOIN `ventas_renglones` ON `ventas_renglones`.`ventaid` = `ventas`.`id`
WHERE   (
`clientes`.`razon_social` LIKE '%pc%' ESCAPE '!'
OR  `fecha` LIKE '%pc%' ESCAPE '!'
 )
GROUP BY `ventas`.`id`
ORDER BY `id` DESC
 LIMIT 10 
 Execution Time:0.00114917755127

SELECT COUNT(*) AS `numrows`
FROM `ventas` 
 Execution Time:0.000176906585693

SELECT `ventas`.*, `clientes`.`razon_social` as `cliente`, `vendedores`.`nombre` as `vendedor`, IFNULL(SUM(  `total_renglon` ), 0) AS total
FROM `ventas`
JOIN `clientes` ON `clientes`.`id` = `ventas`.`clienteid`
JOIN `vendedores` ON `vendedores`.`id` = `ventas`.`vendedorid`
LEFT JOIN `ventas_renglones` ON `ventas_renglones`.`ventaid` = `ventas`.`id`
WHERE   (
`clientes`.`razon_social` LIKE '%pc%' ESCAPE '!'
OR  `fecha` LIKE '%pc%' ESCAPE '!'
 )
GROUP BY `ventas`.`id`
ORDER BY `id` DESC 
 Execution Time:0.00083589553833

SELECT `ventas`.*, `clientes`.`razon_social` as `cliente`, `vendedores`.`nombre` as `vendedor`, IFNULL(SUM(  `total_renglon` ), 0) AS total
FROM `ventas`
JOIN `clientes` ON `clientes`.`id` = `ventas`.`clienteid`
JOIN `vendedores` ON `vendedores`.`id` = `ventas`.`vendedorid`
LEFT JOIN `ventas_renglones` ON `ventas_renglones`.`ventaid` = `ventas`.`id`
WHERE   (
`clientes`.`razon_social` LIKE '%p%' ESCAPE '!'
OR  `fecha` LIKE '%p%' ESCAPE '!'
 )
GROUP BY `ventas`.`id`
ORDER BY `id` DESC
 LIMIT 10 
 Execution Time:0.000217199325562

SELECT COUNT(*) AS `numrows`
FROM `ventas` 
 Execution Time:0.000103950500488

SELECT `ventas`.*, `clientes`.`razon_social` as `cliente`, `vendedores`.`nombre` as `vendedor`, IFNULL(SUM(  `total_renglon` ), 0) AS total
FROM `ventas`
JOIN `clientes` ON `clientes`.`id` = `ventas`.`clienteid`
JOIN `vendedores` ON `vendedores`.`id` = `ventas`.`vendedorid`
LEFT JOIN `ventas_renglones` ON `ventas_renglones`.`ventaid` = `ventas`.`id`
WHERE   (
`clientes`.`razon_social` LIKE '%p%' ESCAPE '!'
OR  `fecha` LIKE '%p%' ESCAPE '!'
 )
GROUP BY `ventas`.`id`
ORDER BY `id` DESC 
 Execution Time:0.000104904174805

SELECT `ventas`.*, `clientes`.`razon_social` as `cliente`, `vendedores`.`nombre` as `vendedor`, IFNULL(SUM(  `total_renglon` ), 0) AS total
FROM `ventas`
JOIN `clientes` ON `clientes`.`id` = `ventas`.`clienteid`
JOIN `vendedores` ON `vendedores`.`id` = `ventas`.`vendedorid`
LEFT JOIN `ventas_renglones` ON `ventas_renglones`.`ventaid` = `ventas`.`id`
WHERE   (
`clientes`.`razon_social` LIKE '%fi%' ESCAPE '!'
OR  `fecha` LIKE '%fi%' ESCAPE '!'
 )
GROUP BY `ventas`.`id`
ORDER BY `id` DESC
 LIMIT 10 
 Execution Time:0.00104689598083

SELECT COUNT(*) AS `numrows`
FROM `ventas` 
 Execution Time:0.000189781188965

SELECT `ventas`.*, `clientes`.`razon_social` as `cliente`, `vendedores`.`nombre` as `vendedor`, IFNULL(SUM(  `total_renglon` ), 0) AS total
FROM `ventas`
JOIN `clientes` ON `clientes`.`id` = `ventas`.`clienteid`
JOIN `vendedores` ON `vendedores`.`id` = `ventas`.`vendedorid`
LEFT JOIN `ventas_renglones` ON `ventas_renglones`.`ventaid` = `ventas`.`id`
WHERE   (
`clientes`.`razon_social` LIKE '%fi%' ESCAPE '!'
OR  `fecha` LIKE '%fi%' ESCAPE '!'
 )
GROUP BY `ventas`.`id`
ORDER BY `id` DESC 
 Execution Time:0.000741004943848

SELECT `ventas`.*, `clientes`.`razon_social` as `cliente`, `vendedores`.`nombre` as `vendedor`, IFNULL(SUM(  `total_renglon` ), 0) AS total
FROM `ventas`
JOIN `clientes` ON `clientes`.`id` = `ventas`.`clienteid`
JOIN `vendedores` ON `vendedores`.`id` = `ventas`.`vendedorid`
LEFT JOIN `ventas_renglones` ON `ventas_renglones`.`ventaid` = `ventas`.`id`
WHERE   (
`clientes`.`razon_social` LIKE '%fix%' ESCAPE '!'
OR  `fecha` LIKE '%fix%' ESCAPE '!'
 )
GROUP BY `ventas`.`id`
ORDER BY `id` DESC
 LIMIT 10 
 Execution Time:0.00104999542236

SELECT COUNT(*) AS `numrows`
FROM `ventas` 
 Execution Time:6.29425048828E-5

SELECT `ventas`.*, `clientes`.`razon_social` as `cliente`, `vendedores`.`nombre` as `vendedor`, IFNULL(SUM(  `total_renglon` ), 0) AS total
FROM `ventas`
JOIN `clientes` ON `clientes`.`id` = `ventas`.`clienteid`
JOIN `vendedores` ON `vendedores`.`id` = `ventas`.`vendedorid`
LEFT JOIN `ventas_renglones` ON `ventas_renglones`.`ventaid` = `ventas`.`id`
WHERE   (
`clientes`.`razon_social` LIKE '%fix%' ESCAPE '!'
OR  `fecha` LIKE '%fix%' ESCAPE '!'
 )
GROUP BY `ventas`.`id`
ORDER BY `id` DESC 
 Execution Time:0.00062108039856

SELECT `ventas`.*, `clientes`.`razon_social` as `cliente`, `vendedores`.`nombre` as `vendedor`, IFNULL(SUM(  `total_renglon` ), 0) AS total
FROM `ventas`
JOIN `clientes` ON `clientes`.`id` = `ventas`.`clienteid`
JOIN `vendedores` ON `vendedores`.`id` = `ventas`.`vendedorid`
LEFT JOIN `ventas_renglones` ON `ventas_renglones`.`ventaid` = `ventas`.`id`
WHERE   (
`clientes`.`razon_social` LIKE '%%' ESCAPE '!'
OR  `fecha` LIKE '%%' ESCAPE '!'
 )
GROUP BY `ventas`.`id`
ORDER BY `id` DESC
 LIMIT 10 
 Execution Time:0.000159025192261

SELECT COUNT(*) AS `numrows`
FROM `ventas` 
 Execution Time:8.51154327393E-5

SELECT `ventas`.*, `clientes`.`razon_social` as `cliente`, `vendedores`.`nombre` as `vendedor`, IFNULL(SUM(  `total_renglon` ), 0) AS total
FROM `ventas`
JOIN `clientes` ON `clientes`.`id` = `ventas`.`clienteid`
JOIN `vendedores` ON `vendedores`.`id` = `ventas`.`vendedorid`
LEFT JOIN `ventas_renglones` ON `ventas_renglones`.`ventaid` = `ventas`.`id`
WHERE   (
`clientes`.`razon_social` LIKE '%%' ESCAPE '!'
OR  `fecha` LIKE '%%' ESCAPE '!'
 )
GROUP BY `ventas`.`id`
ORDER BY `id` DESC 
 Execution Time:0.000126123428345

SELECT `ventas`.*, `clientes`.`razon_social` as `cliente`, `vendedores`.`nombre` as `vendedor`, IFNULL(SUM(  `total_renglon` ), 0) AS total
FROM `ventas`
JOIN `clientes` ON `clientes`.`id` = `ventas`.`clienteid`
JOIN `vendedores` ON `vendedores`.`id` = `ventas`.`vendedorid`
LEFT JOIN `ventas_renglones` ON `ventas_renglones`.`ventaid` = `ventas`.`id`
WHERE   (
`clientes`.`razon_social` LIKE '%%' ESCAPE '!'
OR  `fecha` LIKE '%%' ESCAPE '!'
 )
GROUP BY `ventas`.`id`
ORDER BY `id` DESC
 LIMIT 10 
 Execution Time:0.000197172164917

SELECT COUNT(*) AS `numrows`
FROM `ventas` 
 Execution Time:0.000123023986816

SELECT `ventas`.*, `clientes`.`razon_social` as `cliente`, `vendedores`.`nombre` as `vendedor`, IFNULL(SUM(  `total_renglon` ), 0) AS total
FROM `ventas`
JOIN `clientes` ON `clientes`.`id` = `ventas`.`clienteid`
JOIN `vendedores` ON `vendedores`.`id` = `ventas`.`vendedorid`
LEFT JOIN `ventas_renglones` ON `ventas_renglones`.`ventaid` = `ventas`.`id`
WHERE   (
`clientes`.`razon_social` LIKE '%%' ESCAPE '!'
OR  `fecha` LIKE '%%' ESCAPE '!'
 )
GROUP BY `ventas`.`id`
ORDER BY `id` DESC 
 Execution Time:0.000138998031616

SELECT `ventas`.*, `clientes`.`razon_social` as `cliente`, `vendedores`.`nombre` as `vendedor`, IFNULL(SUM(  `total_renglon` ), 0) AS total
FROM `ventas`
JOIN `clientes` ON `clientes`.`id` = `ventas`.`clienteid`
JOIN `vendedores` ON `vendedores`.`id` = `ventas`.`vendedorid`
LEFT JOIN `ventas_renglones` ON `ventas_renglones`.`ventaid` = `ventas`.`id`
WHERE   (
`clientes`.`razon_social` LIKE '%%' ESCAPE '!'
OR  `fecha` LIKE '%%' ESCAPE '!'
 )
GROUP BY `ventas`.`id`
ORDER BY `id` DESC
 LIMIT 10 
 Execution Time:0.000210046768188

SELECT COUNT(*) AS `numrows`
FROM `ventas` 
 Execution Time:0.000147819519043

SELECT `ventas`.*, `clientes`.`razon_social` as `cliente`, `vendedores`.`nombre` as `vendedor`, IFNULL(SUM(  `total_renglon` ), 0) AS total
FROM `ventas`
JOIN `clientes` ON `clientes`.`id` = `ventas`.`clienteid`
JOIN `vendedores` ON `vendedores`.`id` = `ventas`.`vendedorid`
LEFT JOIN `ventas_renglones` ON `ventas_renglones`.`ventaid` = `ventas`.`id`
WHERE   (
`clientes`.`razon_social` LIKE '%%' ESCAPE '!'
OR  `fecha` LIKE '%%' ESCAPE '!'
 )
GROUP BY `ventas`.`id`
ORDER BY `id` DESC 
 Execution Time:0.000188827514648

SELECT *
FROM `metodos_pago` 
 Execution Time:0.0127902030945

SELECT `clientes`.*, `localidades`.`nombre` as `localidad`
FROM `clientes`
JOIN `localidades` ON `localidades`.`id` = `clientes`.`localidadid`
ORDER BY `id` DESC 
 Execution Time:0.0296819210052

SELECT `cobros`.*, `metodos_pago`.`nombre` as `metodo_pago`
FROM `cobros`
JOIN `metodos_pago` ON `metodos_pago`.`id` = `cobros`.`metododepagoid`
WHERE   (
`cobros`.`monto` LIKE '%%' ESCAPE '!'
OR  `cobros`.`fecha` LIKE '%%' ESCAPE '!'
OR  `metodos_pago`.`nombre` LIKE '%%' ESCAPE '!'
 )
ORDER BY `id` DESC
 LIMIT 10 
 Execution Time:0.00185799598694

SELECT COUNT(*) AS `numrows`
FROM `cobros` 
 Execution Time:0.000221014022827

SELECT `cobros`.*, `metodos_pago`.`nombre` as `metodo_pago`
FROM `cobros`
JOIN `metodos_pago` ON `metodos_pago`.`id` = `cobros`.`metododepagoid`
WHERE   (
`cobros`.`monto` LIKE '%%' ESCAPE '!'
OR  `cobros`.`fecha` LIKE '%%' ESCAPE '!'
OR  `metodos_pago`.`nombre` LIKE '%%' ESCAPE '!'
 )
ORDER BY `id` DESC 
 Execution Time:0.00102114677429

SELECT `cobros`.*, `metodos_pago`.`nombre` as `metodo_pago`
FROM `cobros`
JOIN `metodos_pago` ON `metodos_pago`.`id` = `cobros`.`metododepagoid`
WHERE   (
`cobros`.`monto` LIKE '%6%' ESCAPE '!'
OR  `cobros`.`fecha` LIKE '%6%' ESCAPE '!'
OR  `metodos_pago`.`nombre` LIKE '%6%' ESCAPE '!'
 )
ORDER BY `id` DESC
 LIMIT 10 
 Execution Time:0.00160813331604

SELECT COUNT(*) AS `numrows`
FROM `cobros` 
 Execution Time:9.08374786377E-5

SELECT `cobros`.*, `metodos_pago`.`nombre` as `metodo_pago`
FROM `cobros`
JOIN `metodos_pago` ON `metodos_pago`.`id` = `cobros`.`metododepagoid`
WHERE   (
`cobros`.`monto` LIKE '%6%' ESCAPE '!'
OR  `cobros`.`fecha` LIKE '%6%' ESCAPE '!'
OR  `metodos_pago`.`nombre` LIKE '%6%' ESCAPE '!'
 )
ORDER BY `id` DESC 
 Execution Time:0.000339031219482

SELECT `cobros`.*, `metodos_pago`.`nombre` as `metodo_pago`
FROM `cobros`
JOIN `metodos_pago` ON `metodos_pago`.`id` = `cobros`.`metododepagoid`
WHERE   (
`cobros`.`monto` LIKE '%68%' ESCAPE '!'
OR  `cobros`.`fecha` LIKE '%68%' ESCAPE '!'
OR  `metodos_pago`.`nombre` LIKE '%68%' ESCAPE '!'
 )
ORDER BY `id` DESC
 LIMIT 10 
 Execution Time:0.000586032867432

SELECT COUNT(*) AS `numrows`
FROM `cobros` 
 Execution Time:8.60691070557E-5

SELECT `cobros`.*, `metodos_pago`.`nombre` as `metodo_pago`
FROM `cobros`
JOIN `metodos_pago` ON `metodos_pago`.`id` = `cobros`.`metododepagoid`
WHERE   (
`cobros`.`monto` LIKE '%68%' ESCAPE '!'
OR  `cobros`.`fecha` LIKE '%68%' ESCAPE '!'
OR  `metodos_pago`.`nombre` LIKE '%68%' ESCAPE '!'
 )
ORDER BY `id` DESC 
 Execution Time:0.000345945358276

SELECT `cobros`.*, `metodos_pago`.`nombre` as `metodo_pago`
FROM `cobros`
JOIN `metodos_pago` ON `metodos_pago`.`id` = `cobros`.`metododepagoid`
WHERE   (
`cobros`.`monto` LIKE '%68 %' ESCAPE '!'
OR  `cobros`.`fecha` LIKE '%68 %' ESCAPE '!'
OR  `metodos_pago`.`nombre` LIKE '%68 %' ESCAPE '!'
 )
ORDER BY `id` DESC
 LIMIT 10 
 Execution Time:0.000560998916626

SELECT COUNT(*) AS `numrows`
FROM `cobros` 
 Execution Time:0.000210046768188

SELECT `cobros`.*, `metodos_pago`.`nombre` as `metodo_pago`
FROM `cobros`
JOIN `metodos_pago` ON `metodos_pago`.`id` = `cobros`.`metododepagoid`
WHERE   (
`cobros`.`monto` LIKE '%68 %' ESCAPE '!'
OR  `cobros`.`fecha` LIKE '%68 %' ESCAPE '!'
OR  `metodos_pago`.`nombre` LIKE '%68 %' ESCAPE '!'
 )
ORDER BY `id` DESC 
 Execution Time:0.000257015228271

SELECT `cobros`.*, `metodos_pago`.`nombre` as `metodo_pago`
FROM `cobros`
JOIN `metodos_pago` ON `metodos_pago`.`id` = `cobros`.`metododepagoid`
WHERE   (
`cobros`.`monto` LIKE '%68 ç%' ESCAPE '!'
OR  `cobros`.`fecha` LIKE '%68 ç%' ESCAPE '!'
OR  `metodos_pago`.`nombre` LIKE '%68 ç%' ESCAPE '!'
 )
ORDER BY `id` DESC
 LIMIT 10 
 Execution Time:0.0187799930573

SELECT COUNT(*) AS `numrows`
FROM `cobros` 
 Execution Time:0.000108003616333

SELECT `cobros`.*, `metodos_pago`.`nombre` as `metodo_pago`
FROM `cobros`
JOIN `metodos_pago` ON `metodos_pago`.`id` = `cobros`.`metododepagoid`
WHERE   (
`cobros`.`monto` LIKE '%68 ç%' ESCAPE '!'
OR  `cobros`.`fecha` LIKE '%68 ç%' ESCAPE '!'
OR  `metodos_pago`.`nombre` LIKE '%68 ç%' ESCAPE '!'
 )
ORDER BY `id` DESC 
 Execution Time:0.000709056854248

SELECT `cobros`.*, `metodos_pago`.`nombre` as `metodo_pago`
FROM `cobros`
JOIN `metodos_pago` ON `metodos_pago`.`id` = `cobros`.`metododepagoid`
WHERE   (
`cobros`.`monto` LIKE '%68 %' ESCAPE '!'
OR  `cobros`.`fecha` LIKE '%68 %' ESCAPE '!'
OR  `metodos_pago`.`nombre` LIKE '%68 %' ESCAPE '!'
 )
ORDER BY `id` DESC
 LIMIT 10 
 Execution Time:0.000113010406494

SELECT COUNT(*) AS `numrows`
FROM `cobros` 
 Execution Time:6.00814819336E-5

SELECT `cobros`.*, `metodos_pago`.`nombre` as `metodo_pago`
FROM `cobros`
JOIN `metodos_pago` ON `metodos_pago`.`id` = `cobros`.`metododepagoid`
WHERE   (
`cobros`.`monto` LIKE '%68 %' ESCAPE '!'
OR  `cobros`.`fecha` LIKE '%68 %' ESCAPE '!'
OR  `metodos_pago`.`nombre` LIKE '%68 %' ESCAPE '!'
 )
ORDER BY `id` DESC 
 Execution Time:7.60555267334E-5

SELECT `cobros`.*, `metodos_pago`.`nombre` as `metodo_pago`
FROM `cobros`
JOIN `metodos_pago` ON `metodos_pago`.`id` = `cobros`.`metododepagoid`
WHERE   (
`cobros`.`monto` LIKE '%68 E%' ESCAPE '!'
OR  `cobros`.`fecha` LIKE '%68 E%' ESCAPE '!'
OR  `metodos_pago`.`nombre` LIKE '%68 E%' ESCAPE '!'
 )
ORDER BY `id` DESC
 LIMIT 10 
 Execution Time:0.000607967376709

SELECT COUNT(*) AS `numrows`
FROM `cobros` 
 Execution Time:7.10487365723E-5

SELECT `cobros`.*, `metodos_pago`.`nombre` as `metodo_pago`
FROM `cobros`
JOIN `metodos_pago` ON `metodos_pago`.`id` = `cobros`.`metododepagoid`
WHERE   (
`cobros`.`monto` LIKE '%68 E%' ESCAPE '!'
OR  `cobros`.`fecha` LIKE '%68 E%' ESCAPE '!'
OR  `metodos_pago`.`nombre` LIKE '%68 E%' ESCAPE '!'
 )
ORDER BY `id` DESC 
 Execution Time:0.000272035598755

SELECT `cobros`.*, `metodos_pago`.`nombre` as `metodo_pago`
FROM `cobros`
JOIN `metodos_pago` ON `metodos_pago`.`id` = `cobros`.`metododepagoid`
WHERE   (
`cobros`.`monto` LIKE '%68 Ef%' ESCAPE '!'
OR  `cobros`.`fecha` LIKE '%68 Ef%' ESCAPE '!'
OR  `metodos_pago`.`nombre` LIKE '%68 Ef%' ESCAPE '!'
 )
ORDER BY `id` DESC
 LIMIT 10 
 Execution Time:0.000580072402954

SELECT COUNT(*) AS `numrows`
FROM `cobros` 
 Execution Time:6.50882720947E-5

SELECT `cobros`.*, `metodos_pago`.`nombre` as `metodo_pago`
FROM `cobros`
JOIN `metodos_pago` ON `metodos_pago`.`id` = `cobros`.`metododepagoid`
WHERE   (
`cobros`.`monto` LIKE '%68 Ef%' ESCAPE '!'
OR  `cobros`.`fecha` LIKE '%68 Ef%' ESCAPE '!'
OR  `metodos_pago`.`nombre` LIKE '%68 Ef%' ESCAPE '!'
 )
ORDER BY `id` DESC 
 Execution Time:0.000368118286133

SELECT `cobros`.*, `metodos_pago`.`nombre` as `metodo_pago`
FROM `cobros`
JOIN `metodos_pago` ON `metodos_pago`.`id` = `cobros`.`metododepagoid`
WHERE   (
`cobros`.`monto` LIKE '%68 Efe%' ESCAPE '!'
OR  `cobros`.`fecha` LIKE '%68 Efe%' ESCAPE '!'
OR  `metodos_pago`.`nombre` LIKE '%68 Efe%' ESCAPE '!'
 )
ORDER BY `id` DESC
 LIMIT 10 
 Execution Time:0.0005202293396

SELECT COUNT(*) AS `numrows`
FROM `cobros` 
 Execution Time:0.00014591217041

SELECT `cobros`.*, `metodos_pago`.`nombre` as `metodo_pago`
FROM `cobros`
JOIN `metodos_pago` ON `metodos_pago`.`id` = `cobros`.`metododepagoid`
WHERE   (
`cobros`.`monto` LIKE '%68 Efe%' ESCAPE '!'
OR  `cobros`.`fecha` LIKE '%68 Efe%' ESCAPE '!'
OR  `metodos_pago`.`nombre` LIKE '%68 Efe%' ESCAPE '!'
 )
ORDER BY `id` DESC 
 Execution Time:0.000516891479492

SELECT `cobros`.*, `metodos_pago`.`nombre` as `metodo_pago`
FROM `cobros`
JOIN `metodos_pago` ON `metodos_pago`.`id` = `cobros`.`metododepagoid`
WHERE   (
`cobros`.`monto` LIKE '%68 Efec%' ESCAPE '!'
OR  `cobros`.`fecha` LIKE '%68 Efec%' ESCAPE '!'
OR  `metodos_pago`.`nombre` LIKE '%68 Efec%' ESCAPE '!'
 )
ORDER BY `id` DESC
 LIMIT 10 
 Execution Time:0.000540018081665

SELECT COUNT(*) AS `numrows`
FROM `cobros` 
 Execution Time:0.000104904174805

SELECT `cobros`.*, `metodos_pago`.`nombre` as `metodo_pago`
FROM `cobros`
JOIN `metodos_pago` ON `metodos_pago`.`id` = `cobros`.`metododepagoid`
WHERE   (
`cobros`.`monto` LIKE '%68 Efec%' ESCAPE '!'
OR  `cobros`.`fecha` LIKE '%68 Efec%' ESCAPE '!'
OR  `metodos_pago`.`nombre` LIKE '%68 Efec%' ESCAPE '!'
 )
ORDER BY `id` DESC 
 Execution Time:0.000308990478516

SELECT `cobros`.*, `metodos_pago`.`nombre` as `metodo_pago`
FROM `cobros`
JOIN `metodos_pago` ON `metodos_pago`.`id` = `cobros`.`metododepagoid`
WHERE   (
`cobros`.`monto` LIKE '%68 Efect%' ESCAPE '!'
OR  `cobros`.`fecha` LIKE '%68 Efect%' ESCAPE '!'
OR  `metodos_pago`.`nombre` LIKE '%68 Efect%' ESCAPE '!'
 )
ORDER BY `id` DESC
 LIMIT 10 
 Execution Time:0.00171780586243

SELECT COUNT(*) AS `numrows`
FROM `cobros` 
 Execution Time:8.39233398438E-5

SELECT `cobros`.*, `metodos_pago`.`nombre` as `metodo_pago`
FROM `cobros`
JOIN `metodos_pago` ON `metodos_pago`.`id` = `cobros`.`metododepagoid`
WHERE   (
`cobros`.`monto` LIKE '%68 Efect%' ESCAPE '!'
OR  `cobros`.`fecha` LIKE '%68 Efect%' ESCAPE '!'
OR  `metodos_pago`.`nombre` LIKE '%68 Efect%' ESCAPE '!'
 )
ORDER BY `id` DESC 
 Execution Time:0.000394105911255

SELECT `cobros`.*, `metodos_pago`.`nombre` as `metodo_pago`
FROM `cobros`
JOIN `metodos_pago` ON `metodos_pago`.`id` = `cobros`.`metododepagoid`
WHERE   (
`cobros`.`monto` LIKE '%68 Efectiv%' ESCAPE '!'
OR  `cobros`.`fecha` LIKE '%68 Efectiv%' ESCAPE '!'
OR  `metodos_pago`.`nombre` LIKE '%68 Efectiv%' ESCAPE '!'
 )
ORDER BY `id` DESC
 LIMIT 10 
 Execution Time:0.000597953796387

SELECT COUNT(*) AS `numrows`
FROM `cobros` 
 Execution Time:8.41617584229E-5

SELECT `cobros`.*, `metodos_pago`.`nombre` as `metodo_pago`
FROM `cobros`
JOIN `metodos_pago` ON `metodos_pago`.`id` = `cobros`.`metododepagoid`
WHERE   (
`cobros`.`monto` LIKE '%68 Efectiv%' ESCAPE '!'
OR  `cobros`.`fecha` LIKE '%68 Efectiv%' ESCAPE '!'
OR  `metodos_pago`.`nombre` LIKE '%68 Efectiv%' ESCAPE '!'
 )
ORDER BY `id` DESC 
 Execution Time:0.000370025634766

SELECT `cobros`.*, `metodos_pago`.`nombre` as `metodo_pago`
FROM `cobros`
JOIN `metodos_pago` ON `metodos_pago`.`id` = `cobros`.`metododepagoid`
WHERE   (
`cobros`.`monto` LIKE '%68 Efectivo%' ESCAPE '!'
OR  `cobros`.`fecha` LIKE '%68 Efectivo%' ESCAPE '!'
OR  `metodos_pago`.`nombre` LIKE '%68 Efectivo%' ESCAPE '!'
 )
ORDER BY `id` DESC
 LIMIT 10 
 Execution Time:0.000637054443359

SELECT COUNT(*) AS `numrows`
FROM `cobros` 
 Execution Time:0.000416994094849

SELECT `cobros`.*, `metodos_pago`.`nombre` as `metodo_pago`
FROM `cobros`
JOIN `metodos_pago` ON `metodos_pago`.`id` = `cobros`.`metododepagoid`
WHERE   (
`cobros`.`monto` LIKE '%68 Efectivo%' ESCAPE '!'
OR  `cobros`.`fecha` LIKE '%68 Efectivo%' ESCAPE '!'
OR  `metodos_pago`.`nombre` LIKE '%68 Efectivo%' ESCAPE '!'
 )
ORDER BY `id` DESC 
 Execution Time:0.00039005279541

SELECT `cobros`.*, `metodos_pago`.`nombre` as `metodo_pago`
FROM `cobros`
JOIN `metodos_pago` ON `metodos_pago`.`id` = `cobros`.`metododepagoid`
WHERE   (
`cobros`.`monto` LIKE '%Efectivo%' ESCAPE '!'
OR  `cobros`.`fecha` LIKE '%Efectivo%' ESCAPE '!'
OR  `metodos_pago`.`nombre` LIKE '%Efectivo%' ESCAPE '!'
 )
ORDER BY `id` DESC
 LIMIT 10 
 Execution Time:0.000627040863037

SELECT COUNT(*) AS `numrows`
FROM `cobros` 
 Execution Time:8.39233398438E-5

SELECT `cobros`.*, `metodos_pago`.`nombre` as `metodo_pago`
FROM `cobros`
JOIN `metodos_pago` ON `metodos_pago`.`id` = `cobros`.`metododepagoid`
WHERE   (
`cobros`.`monto` LIKE '%Efectivo%' ESCAPE '!'
OR  `cobros`.`fecha` LIKE '%Efectivo%' ESCAPE '!'
OR  `metodos_pago`.`nombre` LIKE '%Efectivo%' ESCAPE '!'
 )
ORDER BY `id` DESC 
 Execution Time:0.000381946563721

SELECT `cobros`.*, `metodos_pago`.`nombre` as `metodo_pago`
FROM `cobros`
JOIN `metodos_pago` ON `metodos_pago`.`id` = `cobros`.`metododepagoid`
WHERE   (
`cobros`.`monto` LIKE '%%' ESCAPE '!'
OR  `cobros`.`fecha` LIKE '%%' ESCAPE '!'
OR  `metodos_pago`.`nombre` LIKE '%%' ESCAPE '!'
 )
ORDER BY `id` DESC
 LIMIT 10 
 Execution Time:0.000172853469849

SELECT COUNT(*) AS `numrows`
FROM `cobros` 
 Execution Time:0.000107049942017

SELECT `cobros`.*, `metodos_pago`.`nombre` as `metodo_pago`
FROM `cobros`
JOIN `metodos_pago` ON `metodos_pago`.`id` = `cobros`.`metododepagoid`
WHERE   (
`cobros`.`monto` LIKE '%%' ESCAPE '!'
OR  `cobros`.`fecha` LIKE '%%' ESCAPE '!'
OR  `metodos_pago`.`nombre` LIKE '%%' ESCAPE '!'
 )
ORDER BY `id` DESC 
 Execution Time:0.00252509117126

SELECT `cobros`.*, `metodos_pago`.`nombre` as `metodo_pago`
FROM `cobros`
JOIN `metodos_pago` ON `metodos_pago`.`id` = `cobros`.`metododepagoid`
WHERE   (
`cobros`.`monto` LIKE '%c%' ESCAPE '!'
OR  `cobros`.`fecha` LIKE '%c%' ESCAPE '!'
OR  `metodos_pago`.`nombre` LIKE '%c%' ESCAPE '!'
 )
ORDER BY `id` DESC
 LIMIT 10 
 Execution Time:0.0693118572235

SELECT COUNT(*) AS `numrows`
FROM `cobros` 
 Execution Time:0.000155925750732

SELECT `cobros`.*, `metodos_pago`.`nombre` as `metodo_pago`
FROM `cobros`
JOIN `metodos_pago` ON `metodos_pago`.`id` = `cobros`.`metododepagoid`
WHERE   (
`cobros`.`monto` LIKE '%c%' ESCAPE '!'
OR  `cobros`.`fecha` LIKE '%c%' ESCAPE '!'
OR  `metodos_pago`.`nombre` LIKE '%c%' ESCAPE '!'
 )
ORDER BY `id` DESC 
 Execution Time:0.000373125076294

SELECT `cobros`.*, `metodos_pago`.`nombre` as `metodo_pago`
FROM `cobros`
JOIN `metodos_pago` ON `metodos_pago`.`id` = `cobros`.`metododepagoid`
WHERE   (
`cobros`.`monto` LIKE '%cu%' ESCAPE '!'
OR  `cobros`.`fecha` LIKE '%cu%' ESCAPE '!'
OR  `metodos_pago`.`nombre` LIKE '%cu%' ESCAPE '!'
 )
ORDER BY `id` DESC
 LIMIT 10 
 Execution Time:0.000800132751465

SELECT COUNT(*) AS `numrows`
FROM `cobros` 
 Execution Time:0.000139951705933

SELECT `cobros`.*, `metodos_pago`.`nombre` as `metodo_pago`
FROM `cobros`
JOIN `metodos_pago` ON `metodos_pago`.`id` = `cobros`.`metododepagoid`
WHERE   (
`cobros`.`monto` LIKE '%cu%' ESCAPE '!'
OR  `cobros`.`fecha` LIKE '%cu%' ESCAPE '!'
OR  `metodos_pago`.`nombre` LIKE '%cu%' ESCAPE '!'
 )
ORDER BY `id` DESC 
 Execution Time:0.000392913818359

SELECT `cobros`.*, `metodos_pago`.`nombre` as `metodo_pago`
FROM `cobros`
JOIN `metodos_pago` ON `metodos_pago`.`id` = `cobros`.`metododepagoid`
WHERE   (
`cobros`.`monto` LIKE '%cuen%' ESCAPE '!'
OR  `cobros`.`fecha` LIKE '%cuen%' ESCAPE '!'
OR  `metodos_pago`.`nombre` LIKE '%cuen%' ESCAPE '!'
 )
ORDER BY `id` DESC
 LIMIT 10 
 Execution Time:0.000593185424805

SELECT COUNT(*) AS `numrows`
FROM `cobros` 
 Execution Time:7.10487365723E-5

SELECT `cobros`.*, `metodos_pago`.`nombre` as `metodo_pago`
FROM `cobros`
JOIN `metodos_pago` ON `metodos_pago`.`id` = `cobros`.`metododepagoid`
WHERE   (
`cobros`.`monto` LIKE '%cuen%' ESCAPE '!'
OR  `cobros`.`fecha` LIKE '%cuen%' ESCAPE '!'
OR  `metodos_pago`.`nombre` LIKE '%cuen%' ESCAPE '!'
 )
ORDER BY `id` DESC 
 Execution Time:0.000308990478516

SELECT `cobros`.*, `metodos_pago`.`nombre` as `metodo_pago`
FROM `cobros`
JOIN `metodos_pago` ON `metodos_pago`.`id` = `cobros`.`metododepagoid`
WHERE   (
`cobros`.`monto` LIKE '%%' ESCAPE '!'
OR  `cobros`.`fecha` LIKE '%%' ESCAPE '!'
OR  `metodos_pago`.`nombre` LIKE '%%' ESCAPE '!'
 )
ORDER BY `id` DESC
 LIMIT 10 
 Execution Time:0.000200033187866

SELECT COUNT(*) AS `numrows`
FROM `cobros` 
 Execution Time:0.0001380443573

SELECT `cobros`.*, `metodos_pago`.`nombre` as `metodo_pago`
FROM `cobros`
JOIN `metodos_pago` ON `metodos_pago`.`id` = `cobros`.`metododepagoid`
WHERE   (
`cobros`.`monto` LIKE '%%' ESCAPE '!'
OR  `cobros`.`fecha` LIKE '%%' ESCAPE '!'
OR  `metodos_pago`.`nombre` LIKE '%%' ESCAPE '!'
 )
ORDER BY `id` DESC 
 Execution Time:0.000153064727783

SELECT `cobros`.*, `metodos_pago`.`nombre` as `metodo_pago`
FROM `cobros`
JOIN `metodos_pago` ON `metodos_pago`.`id` = `cobros`.`metododepagoid`
WHERE   (
`cobros`.`monto` LIKE '%p%' ESCAPE '!'
OR  `cobros`.`fecha` LIKE '%p%' ESCAPE '!'
OR  `metodos_pago`.`nombre` LIKE '%p%' ESCAPE '!'
 )
ORDER BY `id` DESC
 LIMIT 10 
 Execution Time:0.0596828460693

SELECT COUNT(*) AS `numrows`
FROM `cobros` 
 Execution Time:0.000661134719849

SELECT `cobros`.*, `metodos_pago`.`nombre` as `metodo_pago`
FROM `cobros`
JOIN `metodos_pago` ON `metodos_pago`.`id` = `cobros`.`metododepagoid`
WHERE   (
`cobros`.`monto` LIKE '%p%' ESCAPE '!'
OR  `cobros`.`fecha` LIKE '%p%' ESCAPE '!'
OR  `metodos_pago`.`nombre` LIKE '%p%' ESCAPE '!'
 )
ORDER BY `id` DESC 
 Execution Time:0.000379085540771

SELECT `cobros`.*, `metodos_pago`.`nombre` as `metodo_pago`
FROM `cobros`
JOIN `metodos_pago` ON `metodos_pago`.`id` = `cobros`.`metododepagoid`
WHERE   (
`cobros`.`monto` LIKE '%pana%' ESCAPE '!'
OR  `cobros`.`fecha` LIKE '%pana%' ESCAPE '!'
OR  `metodos_pago`.`nombre` LIKE '%pana%' ESCAPE '!'
 )
ORDER BY `id` DESC
 LIMIT 10 
 Execution Time:0.000967979431152

SELECT COUNT(*) AS `numrows`
FROM `cobros` 
 Execution Time:7.39097595215E-5

SELECT `cobros`.*, `metodos_pago`.`nombre` as `metodo_pago`
FROM `cobros`
JOIN `metodos_pago` ON `metodos_pago`.`id` = `cobros`.`metododepagoid`
WHERE   (
`cobros`.`monto` LIKE '%pana%' ESCAPE '!'
OR  `cobros`.`fecha` LIKE '%pana%' ESCAPE '!'
OR  `metodos_pago`.`nombre` LIKE '%pana%' ESCAPE '!'
 )
ORDER BY `id` DESC 
 Execution Time:0.000462055206299

SELECT `cobros`.*, `metodos_pago`.`nombre` as `metodo_pago`
FROM `cobros`
JOIN `metodos_pago` ON `metodos_pago`.`id` = `cobros`.`metododepagoid`
WHERE   (
`cobros`.`monto` LIKE '%panama%' ESCAPE '!'
OR  `cobros`.`fecha` LIKE '%panama%' ESCAPE '!'
OR  `metodos_pago`.`nombre` LIKE '%panama%' ESCAPE '!'
 )
ORDER BY `id` DESC
 LIMIT 10 
 Execution Time:0.00107002258301

SELECT COUNT(*) AS `numrows`
FROM `cobros` 
 Execution Time:7.91549682617E-5

SELECT `cobros`.*, `metodos_pago`.`nombre` as `metodo_pago`
FROM `cobros`
JOIN `metodos_pago` ON `metodos_pago`.`id` = `cobros`.`metododepagoid`
WHERE   (
`cobros`.`monto` LIKE '%panama%' ESCAPE '!'
OR  `cobros`.`fecha` LIKE '%panama%' ESCAPE '!'
OR  `metodos_pago`.`nombre` LIKE '%panama%' ESCAPE '!'
 )
ORDER BY `id` DESC 
 Execution Time:0.00030517578125

SELECT `cobros`.*, `metodos_pago`.`nombre` as `metodo_pago`
FROM `cobros`
JOIN `metodos_pago` ON `metodos_pago`.`id` = `cobros`.`metododepagoid`
WHERE   (
`cobros`.`monto` LIKE '%%' ESCAPE '!'
OR  `cobros`.`fecha` LIKE '%%' ESCAPE '!'
OR  `metodos_pago`.`nombre` LIKE '%%' ESCAPE '!'
 )
ORDER BY `id` DESC
 LIMIT 10 
 Execution Time:0.000993967056274

SELECT COUNT(*) AS `numrows`
FROM `cobros` 
 Execution Time:9.3936920166E-5

SELECT `cobros`.*, `metodos_pago`.`nombre` as `metodo_pago`
FROM `cobros`
JOIN `metodos_pago` ON `metodos_pago`.`id` = `cobros`.`metododepagoid`
WHERE   (
`cobros`.`monto` LIKE '%%' ESCAPE '!'
OR  `cobros`.`fecha` LIKE '%%' ESCAPE '!'
OR  `metodos_pago`.`nombre` LIKE '%%' ESCAPE '!'
 )
ORDER BY `id` DESC 
 Execution Time:0.000483989715576

SELECT `cobros`.*, `metodos_pago`.`nombre` as `metodo_pago`
FROM `cobros`
JOIN `metodos_pago` ON `metodos_pago`.`id` = `cobros`.`metododepagoid`
WHERE   (
`cobros`.`monto` LIKE '%%' ESCAPE '!'
OR  `cobros`.`fecha` LIKE '%%' ESCAPE '!'
OR  `metodos_pago`.`nombre` LIKE '%%' ESCAPE '!'
 )
 LIMIT 10 
 Execution Time:0.0299098491669

SELECT COUNT(*) AS `numrows`
FROM `cobros` 
 Execution Time:0.000102043151855

SELECT `cobros`.*, `metodos_pago`.`nombre` as `metodo_pago`
FROM `cobros`
JOIN `metodos_pago` ON `metodos_pago`.`id` = `cobros`.`metododepagoid`
WHERE   (
`cobros`.`monto` LIKE '%%' ESCAPE '!'
OR  `cobros`.`fecha` LIKE '%%' ESCAPE '!'
OR  `metodos_pago`.`nombre` LIKE '%%' ESCAPE '!'
 ) 
 Execution Time:0.000555992126465

SELECT `cobros`.*, `metodos_pago`.`nombre` as `metodo_pago`
FROM `cobros`
JOIN `metodos_pago` ON `metodos_pago`.`id` = `cobros`.`metododepagoid`
WHERE   (
`cobros`.`monto` LIKE '%%' ESCAPE '!'
OR  `cobros`.`fecha` LIKE '%%' ESCAPE '!'
OR  `metodos_pago`.`nombre` LIKE '%%' ESCAPE '!'
 )
ORDER BY `fecha` ASC
 LIMIT 10 
 Execution Time:0.0384378433228

SELECT COUNT(*) AS `numrows`
FROM `cobros` 
 Execution Time:0.000102043151855

SELECT `cobros`.*, `metodos_pago`.`nombre` as `metodo_pago`
FROM `cobros`
JOIN `metodos_pago` ON `metodos_pago`.`id` = `cobros`.`metododepagoid`
WHERE   (
`cobros`.`monto` LIKE '%%' ESCAPE '!'
OR  `cobros`.`fecha` LIKE '%%' ESCAPE '!'
OR  `metodos_pago`.`nombre` LIKE '%%' ESCAPE '!'
 )
ORDER BY `fecha` ASC 
 Execution Time:0.000447988510132

SELECT `cobros`.*, `metodos_pago`.`nombre` as `metodo_pago`
FROM `cobros`
JOIN `metodos_pago` ON `metodos_pago`.`id` = `cobros`.`metododepagoid`
WHERE   (
`cobros`.`monto` LIKE '%%' ESCAPE '!'
OR  `cobros`.`fecha` LIKE '%%' ESCAPE '!'
OR  `metodos_pago`.`nombre` LIKE '%%' ESCAPE '!'
 )
ORDER BY `fecha` DESC
 LIMIT 10 
 Execution Time:0.0588369369507

SELECT COUNT(*) AS `numrows`
FROM `cobros` 
 Execution Time:0.000111818313599

SELECT `cobros`.*, `metodos_pago`.`nombre` as `metodo_pago`
FROM `cobros`
JOIN `metodos_pago` ON `metodos_pago`.`id` = `cobros`.`metododepagoid`
WHERE   (
`cobros`.`monto` LIKE '%%' ESCAPE '!'
OR  `cobros`.`fecha` LIKE '%%' ESCAPE '!'
OR  `metodos_pago`.`nombre` LIKE '%%' ESCAPE '!'
 )
ORDER BY `fecha` DESC 
 Execution Time:0.000603914260864

SELECT `cobros`.*, `metodos_pago`.`nombre` as `metodo_pago`
FROM `cobros`
JOIN `metodos_pago` ON `metodos_pago`.`id` = `cobros`.`metododepagoid`
WHERE   (
`cobros`.`monto` LIKE '%%' ESCAPE '!'
OR  `cobros`.`fecha` LIKE '%%' ESCAPE '!'
OR  `metodos_pago`.`nombre` LIKE '%%' ESCAPE '!'
 )
ORDER BY `fecha` ASC
 LIMIT 10 
 Execution Time:0.000213861465454

SELECT COUNT(*) AS `numrows`
FROM `cobros` 
 Execution Time:0.00485301017761

SELECT `cobros`.*, `metodos_pago`.`nombre` as `metodo_pago`
FROM `cobros`
JOIN `metodos_pago` ON `metodos_pago`.`id` = `cobros`.`metododepagoid`
WHERE   (
`cobros`.`monto` LIKE '%%' ESCAPE '!'
OR  `cobros`.`fecha` LIKE '%%' ESCAPE '!'
OR  `metodos_pago`.`nombre` LIKE '%%' ESCAPE '!'
 )
ORDER BY `fecha` ASC 
 Execution Time:0.000119924545288

SELECT `cobros`.*, `metodos_pago`.`nombre` as `metodo_pago`
FROM `cobros`
JOIN `metodos_pago` ON `metodos_pago`.`id` = `cobros`.`metododepagoid`
WHERE   (
`cobros`.`monto` LIKE '%%' ESCAPE '!'
OR  `cobros`.`fecha` LIKE '%%' ESCAPE '!'
OR  `metodos_pago`.`nombre` LIKE '%%' ESCAPE '!'
 )
ORDER BY `monto` ASC
 LIMIT 10 
 Execution Time:0.00159001350403

SELECT COUNT(*) AS `numrows`
FROM `cobros` 
 Execution Time:0.000158786773682

SELECT `cobros`.*, `metodos_pago`.`nombre` as `metodo_pago`
FROM `cobros`
JOIN `metodos_pago` ON `metodos_pago`.`id` = `cobros`.`metododepagoid`
WHERE   (
`cobros`.`monto` LIKE '%%' ESCAPE '!'
OR  `cobros`.`fecha` LIKE '%%' ESCAPE '!'
OR  `metodos_pago`.`nombre` LIKE '%%' ESCAPE '!'
 )
ORDER BY `monto` ASC 
 Execution Time:0.000514984130859

SELECT `cobros`.*, `metodos_pago`.`nombre` as `metodo_pago`
FROM `cobros`
JOIN `metodos_pago` ON `metodos_pago`.`id` = `cobros`.`metododepagoid`
WHERE   (
`cobros`.`monto` LIKE '%%' ESCAPE '!'
OR  `cobros`.`fecha` LIKE '%%' ESCAPE '!'
OR  `metodos_pago`.`nombre` LIKE '%%' ESCAPE '!'
 )
ORDER BY `fecha` ASC
 LIMIT 10 
 Execution Time:0.000182867050171

SELECT COUNT(*) AS `numrows`
FROM `cobros` 
 Execution Time:8.9168548584E-5

SELECT `cobros`.*, `metodos_pago`.`nombre` as `metodo_pago`
FROM `cobros`
JOIN `metodos_pago` ON `metodos_pago`.`id` = `cobros`.`metododepagoid`
WHERE   (
`cobros`.`monto` LIKE '%%' ESCAPE '!'
OR  `cobros`.`fecha` LIKE '%%' ESCAPE '!'
OR  `metodos_pago`.`nombre` LIKE '%%' ESCAPE '!'
 )
ORDER BY `fecha` ASC 
 Execution Time:0.000117063522339

SELECT `cobros`.*, `metodos_pago`.`nombre` as `metodo_pago`
FROM `cobros`
JOIN `metodos_pago` ON `metodos_pago`.`id` = `cobros`.`metododepagoid`
WHERE   (
`cobros`.`monto` LIKE '%%' ESCAPE '!'
OR  `cobros`.`fecha` LIKE '%%' ESCAPE '!'
OR  `metodos_pago`.`nombre` LIKE '%%' ESCAPE '!'
 )
ORDER BY `fecha` DESC
 LIMIT 10 
 Execution Time:0.000192880630493

SELECT COUNT(*) AS `numrows`
FROM `cobros` 
 Execution Time:0.000118970870972

SELECT `cobros`.*, `metodos_pago`.`nombre` as `metodo_pago`
FROM `cobros`
JOIN `metodos_pago` ON `metodos_pago`.`id` = `cobros`.`metododepagoid`
WHERE   (
`cobros`.`monto` LIKE '%%' ESCAPE '!'
OR  `cobros`.`fecha` LIKE '%%' ESCAPE '!'
OR  `metodos_pago`.`nombre` LIKE '%%' ESCAPE '!'
 )
ORDER BY `fecha` DESC 
 Execution Time:0.000143051147461

SELECT `cobros`.*, `metodos_pago`.`nombre` as `metodo_pago`
FROM `cobros`
JOIN `metodos_pago` ON `metodos_pago`.`id` = `cobros`.`metododepagoid`
WHERE   (
`cobros`.`monto` LIKE '%%' ESCAPE '!'
OR  `cobros`.`fecha` LIKE '%%' ESCAPE '!'
OR  `metodos_pago`.`nombre` LIKE '%%' ESCAPE '!'
 )
ORDER BY `monto` ASC
 LIMIT 10 
 Execution Time:0.000195980072021

SELECT COUNT(*) AS `numrows`
FROM `cobros` 
 Execution Time:0.000177145004272

SELECT `cobros`.*, `metodos_pago`.`nombre` as `metodo_pago`
FROM `cobros`
JOIN `metodos_pago` ON `metodos_pago`.`id` = `cobros`.`metododepagoid`
WHERE   (
`cobros`.`monto` LIKE '%%' ESCAPE '!'
OR  `cobros`.`fecha` LIKE '%%' ESCAPE '!'
OR  `metodos_pago`.`nombre` LIKE '%%' ESCAPE '!'
 )
ORDER BY `monto` ASC 
 Execution Time:0.000193119049072

SELECT `cobros`.*, `metodos_pago`.`nombre` as `metodo_pago`
FROM `cobros`
JOIN `metodos_pago` ON `metodos_pago`.`id` = `cobros`.`metododepagoid`
WHERE   (
`cobros`.`monto` LIKE '%%' ESCAPE '!'
OR  `cobros`.`fecha` LIKE '%%' ESCAPE '!'
OR  `metodos_pago`.`nombre` LIKE '%%' ESCAPE '!'
 )
ORDER BY `monto` DESC
 LIMIT 10 
 Execution Time:0.0014328956604

SELECT COUNT(*) AS `numrows`
FROM `cobros` 
 Execution Time:0.000165939331055

SELECT `cobros`.*, `metodos_pago`.`nombre` as `metodo_pago`
FROM `cobros`
JOIN `metodos_pago` ON `metodos_pago`.`id` = `cobros`.`metododepagoid`
WHERE   (
`cobros`.`monto` LIKE '%%' ESCAPE '!'
OR  `cobros`.`fecha` LIKE '%%' ESCAPE '!'
OR  `metodos_pago`.`nombre` LIKE '%%' ESCAPE '!'
 )
ORDER BY `monto` DESC 
 Execution Time:0.000379085540771

SELECT `cobros`.*, `metodos_pago`.`nombre` as `metodo_pago`
FROM `cobros`
JOIN `metodos_pago` ON `metodos_pago`.`id` = `cobros`.`metododepagoid`
WHERE   (
`cobros`.`monto` LIKE '%%' ESCAPE '!'
OR  `cobros`.`fecha` LIKE '%%' ESCAPE '!'
OR  `metodos_pago`.`nombre` LIKE '%%' ESCAPE '!'
 )
 LIMIT 10 
 Execution Time:0.000174999237061

SELECT COUNT(*) AS `numrows`
FROM `cobros` 
 Execution Time:0.000255107879639

SELECT `cobros`.*, `metodos_pago`.`nombre` as `metodo_pago`
FROM `cobros`
JOIN `metodos_pago` ON `metodos_pago`.`id` = `cobros`.`metododepagoid`
WHERE   (
`cobros`.`monto` LIKE '%%' ESCAPE '!'
OR  `cobros`.`fecha` LIKE '%%' ESCAPE '!'
OR  `metodos_pago`.`nombre` LIKE '%%' ESCAPE '!'
 ) 
 Execution Time:0.000302076339722

SELECT `cobros`.*, `metodos_pago`.`nombre` as `metodo_pago`
FROM `cobros`
JOIN `metodos_pago` ON `metodos_pago`.`id` = `cobros`.`metododepagoid`
WHERE   (
`cobros`.`monto` LIKE '%%' ESCAPE '!'
OR  `cobros`.`fecha` LIKE '%%' ESCAPE '!'
OR  `metodos_pago`.`nombre` LIKE '%%' ESCAPE '!'
 )
 LIMIT 10 
 Execution Time:0.000134944915771

SELECT COUNT(*) AS `numrows`
FROM `cobros` 
 Execution Time:9.41753387451E-5

SELECT `cobros`.*, `metodos_pago`.`nombre` as `metodo_pago`
FROM `cobros`
JOIN `metodos_pago` ON `metodos_pago`.`id` = `cobros`.`metododepagoid`
WHERE   (
`cobros`.`monto` LIKE '%%' ESCAPE '!'
OR  `cobros`.`fecha` LIKE '%%' ESCAPE '!'
OR  `metodos_pago`.`nombre` LIKE '%%' ESCAPE '!'
 ) 
 Execution Time:0.000159025192261

SELECT `cobros`.*, `metodos_pago`.`nombre` as `metodo_pago`
FROM `cobros`
JOIN `metodos_pago` ON `metodos_pago`.`id` = `cobros`.`metododepagoid`
WHERE   (
`cobros`.`monto` LIKE '%%' ESCAPE '!'
OR  `cobros`.`fecha` LIKE '%%' ESCAPE '!'
OR  `metodos_pago`.`nombre` LIKE '%%' ESCAPE '!'
 )
 LIMIT 10 
 Execution Time:0.000285148620605

SELECT COUNT(*) AS `numrows`
FROM `cobros` 
 Execution Time:8.20159912109E-5

SELECT `cobros`.*, `metodos_pago`.`nombre` as `metodo_pago`
FROM `cobros`
JOIN `metodos_pago` ON `metodos_pago`.`id` = `cobros`.`metododepagoid`
WHERE   (
`cobros`.`monto` LIKE '%%' ESCAPE '!'
OR  `cobros`.`fecha` LIKE '%%' ESCAPE '!'
OR  `metodos_pago`.`nombre` LIKE '%%' ESCAPE '!'
 ) 
 Execution Time:0.000103950500488

SELECT `ventas`.*, `clientes`.`razon_social` as `cliente`, `vendedores`.`nombre` as `vendedor`, IFNULL(SUM(  `total_renglon` ), 0) AS total
FROM `ventas`
JOIN `clientes` ON `clientes`.`id` = `ventas`.`clienteid`
JOIN `vendedores` ON `vendedores`.`id` = `ventas`.`vendedorid`
LEFT JOIN `ventas_renglones` ON `ventas_renglones`.`ventaid` = `ventas`.`id`
WHERE   (
`clientes`.`razon_social` LIKE '%%' ESCAPE '!'
OR  `fecha` LIKE '%%' ESCAPE '!'
 )
GROUP BY `ventas`.`id`
ORDER BY `id` DESC
 LIMIT 10 
 Execution Time:0.00370717048645

SELECT COUNT(*) AS `numrows`
FROM `ventas` 
 Execution Time:0.000269889831543

SELECT `ventas`.*, `clientes`.`razon_social` as `cliente`, `vendedores`.`nombre` as `vendedor`, IFNULL(SUM(  `total_renglon` ), 0) AS total
FROM `ventas`
JOIN `clientes` ON `clientes`.`id` = `ventas`.`clienteid`
JOIN `vendedores` ON `vendedores`.`id` = `ventas`.`vendedorid`
LEFT JOIN `ventas_renglones` ON `ventas_renglones`.`ventaid` = `ventas`.`id`
WHERE   (
`clientes`.`razon_social` LIKE '%%' ESCAPE '!'
OR  `fecha` LIKE '%%' ESCAPE '!'
 )
GROUP BY `ventas`.`id`
ORDER BY `id` DESC 
 Execution Time:0.000949859619141

SELECT *
FROM `colores`
WHERE   (
`nombre` LIKE '%%' ESCAPE '!'
 )
ORDER BY `id` DESC
 LIMIT 10 
 Execution Time:0.00293111801147

SELECT *
FROM `productos_colores`
WHERE `colorid` = '15' 
 Execution Time:0.00205588340759

SELECT *
FROM `productos_colores`
WHERE `colorid` = '14' 
 Execution Time:0.000517129898071

SELECT *
FROM `productos_colores`
WHERE `colorid` = '13' 
 Execution Time:0.000396013259888

SELECT *
FROM `productos_colores`
WHERE `colorid` = '12' 
 Execution Time:0.000454902648926

SELECT *
FROM `productos_colores`
WHERE `colorid` = '11' 
 Execution Time:0.000417947769165

SELECT *
FROM `productos_colores`
WHERE `colorid` = '10' 
 Execution Time:0.000434875488281

SELECT *
FROM `productos_colores`
WHERE `colorid` = '9' 
 Execution Time:0.000546932220459

SELECT *
FROM `productos_colores`
WHERE `colorid` = '7' 
 Execution Time:0.000418901443481

SELECT *
FROM `productos_colores`
WHERE `colorid` = '6' 
 Execution Time:0.000482082366943

SELECT *
FROM `productos_colores`
WHERE `colorid` = '5' 
 Execution Time:0.000381946563721

SELECT COUNT(*) AS `numrows`
FROM `colores` 
 Execution Time:0.000198125839233

SELECT *
FROM `colores`
WHERE   (
`nombre` LIKE '%%' ESCAPE '!'
 )
ORDER BY `id` DESC 
 Execution Time:0.000284910202026

SELECT *
FROM `colores`
WHERE   (
`nombre` LIKE '%%' ESCAPE '!'
 )
ORDER BY `id` DESC
 LIMIT 10 
 Execution Time:0.000242948532104

SELECT *
FROM `productos_colores`
WHERE `colorid` = '15' 
 Execution Time:0.000218868255615

SELECT *
FROM `productos_colores`
WHERE `colorid` = '14' 
 Execution Time:0.000138998031616

SELECT *
FROM `productos_colores`
WHERE `colorid` = '13' 
 Execution Time:9.98973846436E-5

SELECT *
FROM `productos_colores`
WHERE `colorid` = '12' 
 Execution Time:9.17911529541E-5

SELECT *
FROM `productos_colores`
WHERE `colorid` = '11' 
 Execution Time:9.10758972168E-5

SELECT *
FROM `productos_colores`
WHERE `colorid` = '10' 
 Execution Time:7.79628753662E-5

SELECT *
FROM `productos_colores`
WHERE `colorid` = '9' 
 Execution Time:8.01086425781E-5

SELECT *
FROM `productos_colores`
WHERE `colorid` = '7' 
 Execution Time:7.82012939453E-5

SELECT *
FROM `productos_colores`
WHERE `colorid` = '6' 
 Execution Time:9.20295715332E-5

SELECT *
FROM `productos_colores`
WHERE `colorid` = '5' 
 Execution Time:7.48634338379E-5

SELECT COUNT(*) AS `numrows`
FROM `colores` 
 Execution Time:6.29425048828E-5

SELECT *
FROM `colores`
WHERE   (
`nombre` LIKE '%%' ESCAPE '!'
 )
ORDER BY `id` DESC 
 Execution Time:7.60555267334E-5

SELECT *
FROM `colores`
WHERE   (
`nombre` LIKE '%%' ESCAPE '!'
 )
ORDER BY `id` DESC
 LIMIT 10 
 Execution Time:0.000201940536499

SELECT *
FROM `productos_colores`
WHERE `colorid` = '15' 
 Execution Time:0.000133991241455

SELECT *
FROM `productos_colores`
WHERE `colorid` = '14' 
 Execution Time:0.00012993812561

SELECT *
FROM `productos_colores`
WHERE `colorid` = '13' 
 Execution Time:0.000108957290649

SELECT *
FROM `productos_colores`
WHERE `colorid` = '12' 
 Execution Time:0.00014591217041

SELECT *
FROM `productos_colores`
WHERE `colorid` = '11' 
 Execution Time:0.000133037567139

SELECT *
FROM `productos_colores`
WHERE `colorid` = '10' 
 Execution Time:0.000127077102661

SELECT *
FROM `productos_colores`
WHERE `colorid` = '9' 
 Execution Time:6.103515625E-5

SELECT *
FROM `productos_colores`
WHERE `colorid` = '7' 
 Execution Time:5.29289245605E-5

SELECT *
FROM `productos_colores`
WHERE `colorid` = '6' 
 Execution Time:6.103515625E-5

SELECT *
FROM `productos_colores`
WHERE `colorid` = '5' 
 Execution Time:5.29289245605E-5

SELECT COUNT(*) AS `numrows`
FROM `colores` 
 Execution Time:5.00679016113E-5

SELECT *
FROM `colores`
WHERE   (
`nombre` LIKE '%%' ESCAPE '!'
 )
ORDER BY `id` DESC 
 Execution Time:6.103515625E-5

SELECT *
FROM `colores`
WHERE   (
`nombre` LIKE '%%' ESCAPE '!'
 )
ORDER BY `id` DESC
 LIMIT 10 
 Execution Time:0.000185966491699

SELECT *
FROM `productos_colores`
WHERE `colorid` = '15' 
 Execution Time:9.89437103271E-5

SELECT *
FROM `productos_colores`
WHERE `colorid` = '14' 
 Execution Time:0.000108003616333

SELECT *
FROM `productos_colores`
WHERE `colorid` = '13' 
 Execution Time:8.29696655273E-5

SELECT *
FROM `productos_colores`
WHERE `colorid` = '12' 
 Execution Time:8.98838043213E-5

SELECT *
FROM `productos_colores`
WHERE `colorid` = '11' 
 Execution Time:7.39097595215E-5

SELECT *
FROM `productos_colores`
WHERE `colorid` = '10' 
 Execution Time:7.60555267334E-5

SELECT *
FROM `productos_colores`
WHERE `colorid` = '9' 
 Execution Time:6.69956207275E-5

SELECT *
FROM `productos_colores`
WHERE `colorid` = '7' 
 Execution Time:8.48770141602E-5

SELECT *
FROM `productos_colores`
WHERE `colorid` = '6' 
 Execution Time:0.0001220703125

SELECT *
FROM `productos_colores`
WHERE `colorid` = '5' 
 Execution Time:6.98566436768E-5

SELECT COUNT(*) AS `numrows`
FROM `colores` 
 Execution Time:6.48498535156E-5

SELECT *
FROM `colores`
WHERE   (
`nombre` LIKE '%%' ESCAPE '!'
 )
ORDER BY `id` DESC 
 Execution Time:0.000123977661133

SELECT *
FROM `colores`
WHERE   (
`nombre` LIKE '%%' ESCAPE '!'
 )
ORDER BY `id` DESC
 LIMIT 10 
 Execution Time:0.000125885009766

SELECT *
FROM `productos_colores`
WHERE `colorid` = '15' 
 Execution Time:7.9870223999E-5

SELECT *
FROM `productos_colores`
WHERE `colorid` = '14' 
 Execution Time:6.8187713623E-5

SELECT *
FROM `productos_colores`
WHERE `colorid` = '13' 
 Execution Time:5.57899475098E-5

SELECT *
FROM `productos_colores`
WHERE `colorid` = '12' 
 Execution Time:5.69820404053E-5

SELECT *
FROM `productos_colores`
WHERE `colorid` = '11' 
 Execution Time:5.41210174561E-5

SELECT *
FROM `productos_colores`
WHERE `colorid` = '10' 
 Execution Time:5.29289245605E-5

SELECT *
FROM `productos_colores`
WHERE `colorid` = '9' 
 Execution Time:7.00950622559E-5

SELECT *
FROM `productos_colores`
WHERE `colorid` = '7' 
 Execution Time:5.31673431396E-5

SELECT *
FROM `productos_colores`
WHERE `colorid` = '6' 
 Execution Time:5.29289245605E-5

SELECT *
FROM `productos_colores`
WHERE `colorid` = '5' 
 Execution Time:5.07831573486E-5

SELECT COUNT(*) AS `numrows`
FROM `colores` 
 Execution Time:4.00543212891E-5

SELECT *
FROM `colores`
WHERE   (
`nombre` LIKE '%%' ESCAPE '!'
 )
ORDER BY `id` DESC 
 Execution Time:5.41210174561E-5

SELECT *
FROM `colores`
WHERE   (
`nombre` LIKE '%%' ESCAPE '!'
 )
ORDER BY `id` DESC
 LIMIT 10 
 Execution Time:0.000216007232666

SELECT *
FROM `productos_colores`
WHERE `colorid` = '15' 
 Execution Time:0.000316858291626

SELECT *
FROM `productos_colores`
WHERE `colorid` = '14' 
 Execution Time:0.000157833099365

SELECT *
FROM `productos_colores`
WHERE `colorid` = '13' 
 Execution Time:0.000134944915771

SELECT *
FROM `productos_colores`
WHERE `colorid` = '12' 
 Execution Time:0.000138998031616

SELECT *
FROM `productos_colores`
WHERE `colorid` = '11' 
 Execution Time:0.000138998031616

SELECT *
FROM `productos_colores`
WHERE `colorid` = '10' 
 Execution Time:0.000257015228271

SELECT *
FROM `productos_colores`
WHERE `colorid` = '9' 
 Execution Time:0.000123023986816

SELECT *
FROM `productos_colores`
WHERE `colorid` = '7' 
 Execution Time:0.000124931335449

SELECT *
FROM `productos_colores`
WHERE `colorid` = '6' 
 Execution Time:0.000128984451294

SELECT *
FROM `productos_colores`
WHERE `colorid` = '5' 
 Execution Time:0.000132083892822

SELECT COUNT(*) AS `numrows`
FROM `colores` 
 Execution Time:8.29696655273E-5

SELECT *
FROM `colores`
WHERE   (
`nombre` LIKE '%%' ESCAPE '!'
 )
ORDER BY `id` DESC 
 Execution Time:8.60691070557E-5

SELECT *
FROM `colores`
WHERE   (
`nombre` LIKE '%%' ESCAPE '!'
 )
ORDER BY `id` DESC
 LIMIT 10 
 Execution Time:0.000169992446899

SELECT *
FROM `productos_colores`
WHERE `colorid` = '15' 
 Execution Time:0.000194072723389

SELECT *
FROM `productos_colores`
WHERE `colorid` = '14' 
 Execution Time:0.000133037567139

SELECT *
FROM `productos_colores`
WHERE `colorid` = '13' 
 Execution Time:0.000176906585693

SELECT *
FROM `productos_colores`
WHERE `colorid` = '12' 
 Execution Time:0.000108957290649

SELECT *
FROM `productos_colores`
WHERE `colorid` = '11' 
 Execution Time:0.00016713142395

SELECT *
FROM `productos_colores`
WHERE `colorid` = '10' 
 Execution Time:0.000174999237061

SELECT *
FROM `productos_colores`
WHERE `colorid` = '9' 
 Execution Time:0.0001380443573

SELECT *
FROM `productos_colores`
WHERE `colorid` = '7' 
 Execution Time:8.01086425781E-5

SELECT *
FROM `productos_colores`
WHERE `colorid` = '6' 
 Execution Time:6.29425048828E-5

SELECT *
FROM `productos_colores`
WHERE `colorid` = '5' 
 Execution Time:5.19752502441E-5

SELECT COUNT(*) AS `numrows`
FROM `colores` 
 Execution Time:4.41074371338E-5

SELECT *
FROM `colores`
WHERE   (
`nombre` LIKE '%%' ESCAPE '!'
 )
ORDER BY `id` DESC 
 Execution Time:9.29832458496E-5

SELECT *
FROM `proveedores`
WHERE   (
`id` LIKE '%%' ESCAPE '!'
OR  `nombre` LIKE '%%' ESCAPE '!'
OR  `direccion` LIKE '%%' ESCAPE '!'
OR  `telefono` LIKE '%%' ESCAPE '!'
OR  `paisid` LIKE '%%' ESCAPE '!'
 )
ORDER BY `id` DESC
 LIMIT 10 
 Execution Time:0.00329995155334

SELECT COUNT(*) AS `numrows`
FROM `proveedores` 
 Execution Time:0.000224113464355

SELECT *
FROM `proveedores`
WHERE   (
`id` LIKE '%%' ESCAPE '!'
OR  `nombre` LIKE '%%' ESCAPE '!'
OR  `direccion` LIKE '%%' ESCAPE '!'
OR  `telefono` LIKE '%%' ESCAPE '!'
OR  `paisid` LIKE '%%' ESCAPE '!'
 )
ORDER BY `id` DESC 
 Execution Time:0.000308036804199

SELECT *
FROM `colores`
WHERE   (
`nombre` LIKE '%%' ESCAPE '!'
 )
ORDER BY `id` DESC
 LIMIT 10 
 Execution Time:0.000485181808472

SELECT *
FROM `productos_colores`
WHERE `colorid` = '15' 
 Execution Time:0.000131845474243

SELECT *
FROM `productos_colores`
WHERE `colorid` = '14' 
 Execution Time:0.000102996826172

SELECT *
FROM `productos_colores`
WHERE `colorid` = '13' 
 Execution Time:0.00010085105896

SELECT *
FROM `productos_colores`
WHERE `colorid` = '12' 
 Execution Time:0.000102043151855

SELECT *
FROM `productos_colores`
WHERE `colorid` = '11' 
 Execution Time:9.79900360107E-5

SELECT *
FROM `productos_colores`
WHERE `colorid` = '10' 
 Execution Time:9.08374786377E-5

SELECT *
FROM `productos_colores`
WHERE `colorid` = '9' 
 Execution Time:9.51290130615E-5

SELECT *
FROM `productos_colores`
WHERE `colorid` = '7' 
 Execution Time:9.48905944824E-5

SELECT *
FROM `productos_colores`
WHERE `colorid` = '6' 
 Execution Time:0.000101804733276

SELECT *
FROM `productos_colores`
WHERE `colorid` = '5' 
 Execution Time:9.3936920166E-5

SELECT COUNT(*) AS `numrows`
FROM `colores` 
 Execution Time:7.20024108887E-5

SELECT *
FROM `colores`
WHERE   (
`nombre` LIKE '%%' ESCAPE '!'
 )
ORDER BY `id` DESC 
 Execution Time:0.000112056732178

SELECT `modelos`.*, `marcas`.`nombre` as `marca`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid`
WHERE   (
`modelos`.`id` LIKE '%%' ESCAPE '!'
OR  `modelos`.`nombre` LIKE '%%' ESCAPE '!'
OR  `marcas`.`nombre` LIKE '%%' ESCAPE '!'
 )
ORDER BY `id` DESC
 LIMIT 10 
 Execution Time:0.0040340423584

SELECT COUNT(*) AS `numrows`
FROM `modelos` 
 Execution Time:0.00110507011414

SELECT `modelos`.*, `marcas`.`nombre` as `marca`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid`
WHERE   (
`modelos`.`id` LIKE '%%' ESCAPE '!'
OR  `modelos`.`nombre` LIKE '%%' ESCAPE '!'
OR  `marcas`.`nombre` LIKE '%%' ESCAPE '!'
 )
ORDER BY `id` DESC 
 Execution Time:0.000693082809448

SELECT *
FROM `marcas`
ORDER BY `id` DESC 
 Execution Time:0.000334978103638

SELECT `modelos`.*, `marcas`.`nombre` as `marca`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid`
WHERE   (
`modelos`.`id` LIKE '%%' ESCAPE '!'
OR  `modelos`.`nombre` LIKE '%%' ESCAPE '!'
OR  `marcas`.`nombre` LIKE '%%' ESCAPE '!'
 )
ORDER BY `id` DESC
 LIMIT 10 
 Execution Time:0.00123000144958

SELECT COUNT(*) AS `numrows`
FROM `modelos` 
 Execution Time:0.000216007232666

SELECT `modelos`.*, `marcas`.`nombre` as `marca`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid`
WHERE   (
`modelos`.`id` LIKE '%%' ESCAPE '!'
OR  `modelos`.`nombre` LIKE '%%' ESCAPE '!'
OR  `marcas`.`nombre` LIKE '%%' ESCAPE '!'
 )
ORDER BY `id` DESC 
 Execution Time:0.000185012817383

SELECT *
FROM `marcas`
ORDER BY `id` DESC 
 Execution Time:0.000160932540894

SELECT *
FROM `marcas`
ORDER BY `id` DESC 
 Execution Time:0.000213146209717

SELECT `modelos`.*, `marcas`.`nombre` as `marca`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid`
WHERE   (
`modelos`.`id` LIKE '%%' ESCAPE '!'
OR  `modelos`.`nombre` LIKE '%%' ESCAPE '!'
OR  `marcas`.`nombre` LIKE '%%' ESCAPE '!'
 )
ORDER BY `id` DESC
 LIMIT 10 
 Execution Time:0.000194072723389

SELECT COUNT(*) AS `numrows`
FROM `modelos` 
 Execution Time:0.000113964080811

SELECT `modelos`.*, `marcas`.`nombre` as `marca`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid`
WHERE   (
`modelos`.`id` LIKE '%%' ESCAPE '!'
OR  `modelos`.`nombre` LIKE '%%' ESCAPE '!'
OR  `marcas`.`nombre` LIKE '%%' ESCAPE '!'
 )
ORDER BY `id` DESC 
 Execution Time:0.0001540184021

SELECT `modelos`.*, `marcas`.`nombre` as `marca`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid`
WHERE   (
`modelos`.`id` LIKE '%%' ESCAPE '!'
OR  `modelos`.`nombre` LIKE '%%' ESCAPE '!'
OR  `marcas`.`nombre` LIKE '%%' ESCAPE '!'
 )
ORDER BY `id` DESC
 LIMIT 10 
 Execution Time:0.000132083892822

SELECT COUNT(*) AS `numrows`
FROM `modelos` 
 Execution Time:0.000126123428345

SELECT `modelos`.*, `marcas`.`nombre` as `marca`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid`
WHERE   (
`modelos`.`id` LIKE '%%' ESCAPE '!'
OR  `modelos`.`nombre` LIKE '%%' ESCAPE '!'
OR  `marcas`.`nombre` LIKE '%%' ESCAPE '!'
 )
ORDER BY `id` DESC 
 Execution Time:0.000166893005371

SELECT *
FROM `marcas`
ORDER BY `id` DESC 
 Execution Time:0.000139951705933

SELECT `modelos`.*, `marcas`.`nombre` as `marca`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid`
WHERE   (
`modelos`.`id` LIKE '%%' ESCAPE '!'
OR  `modelos`.`nombre` LIKE '%%' ESCAPE '!'
OR  `marcas`.`nombre` LIKE '%%' ESCAPE '!'
 )
ORDER BY `id` DESC
 LIMIT 10 
 Execution Time:0.000120878219604

SELECT COUNT(*) AS `numrows`
FROM `modelos` 
 Execution Time:8.98838043213E-5

SELECT `modelos`.*, `marcas`.`nombre` as `marca`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid`
WHERE   (
`modelos`.`id` LIKE '%%' ESCAPE '!'
OR  `modelos`.`nombre` LIKE '%%' ESCAPE '!'
OR  `marcas`.`nombre` LIKE '%%' ESCAPE '!'
 )
ORDER BY `id` DESC 
 Execution Time:0.000123023986816

SELECT *
FROM `marcas`
ORDER BY `id` DESC 
 Execution Time:0.000110149383545

SELECT `modelos`.*, `marcas`.`nombre` as `marca`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid`
WHERE   (
`modelos`.`id` LIKE '%%' ESCAPE '!'
OR  `modelos`.`nombre` LIKE '%%' ESCAPE '!'
OR  `marcas`.`nombre` LIKE '%%' ESCAPE '!'
 )
ORDER BY `id` DESC
 LIMIT 10 
 Execution Time:0.000211954116821

SELECT COUNT(*) AS `numrows`
FROM `modelos` 
 Execution Time:0.000124931335449

SELECT `modelos`.*, `marcas`.`nombre` as `marca`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid`
WHERE   (
`modelos`.`id` LIKE '%%' ESCAPE '!'
OR  `modelos`.`nombre` LIKE '%%' ESCAPE '!'
OR  `marcas`.`nombre` LIKE '%%' ESCAPE '!'
 )
ORDER BY `id` DESC 
 Execution Time:0.000156164169312

SELECT *
FROM `marcas`
ORDER BY `id` DESC 
 Execution Time:0.000175952911377

SELECT `modelos`.*, `marcas`.`nombre` as `marca`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid`
WHERE   (
`modelos`.`id` LIKE '%%' ESCAPE '!'
OR  `modelos`.`nombre` LIKE '%%' ESCAPE '!'
OR  `marcas`.`nombre` LIKE '%%' ESCAPE '!'
 )
ORDER BY `id` DESC
 LIMIT 10 
 Execution Time:0.000180006027222

SELECT COUNT(*) AS `numrows`
FROM `modelos` 
 Execution Time:0.000204086303711

SELECT `modelos`.*, `marcas`.`nombre` as `marca`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid`
WHERE   (
`modelos`.`id` LIKE '%%' ESCAPE '!'
OR  `modelos`.`nombre` LIKE '%%' ESCAPE '!'
OR  `marcas`.`nombre` LIKE '%%' ESCAPE '!'
 )
ORDER BY `id` DESC 
 Execution Time:0.000158071517944

SELECT *
FROM `marcas`
ORDER BY `id` DESC 
 Execution Time:0.000169992446899

SELECT `modelos`.*, `marcas`.`nombre` as `marca`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid`
WHERE   (
`modelos`.`id` LIKE '%%' ESCAPE '!'
OR  `modelos`.`nombre` LIKE '%%' ESCAPE '!'
OR  `marcas`.`nombre` LIKE '%%' ESCAPE '!'
 )
ORDER BY `id` DESC
 LIMIT 10 
 Execution Time:0.000211954116821

SELECT COUNT(*) AS `numrows`
FROM `modelos` 
 Execution Time:8.98838043213E-5

SELECT `modelos`.*, `marcas`.`nombre` as `marca`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid`
WHERE   (
`modelos`.`id` LIKE '%%' ESCAPE '!'
OR  `modelos`.`nombre` LIKE '%%' ESCAPE '!'
OR  `marcas`.`nombre` LIKE '%%' ESCAPE '!'
 )
ORDER BY `id` DESC 
 Execution Time:0.0001380443573

SELECT *
FROM `marcas`
ORDER BY `id` DESC 
 Execution Time:0.000109910964966

SELECT `modelos`.*, `marcas`.`nombre` as `marca`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid`
WHERE   (
`modelos`.`id` LIKE '%%' ESCAPE '!'
OR  `modelos`.`nombre` LIKE '%%' ESCAPE '!'
OR  `marcas`.`nombre` LIKE '%%' ESCAPE '!'
 )
ORDER BY `id` DESC
 LIMIT 10 
 Execution Time:0.000180006027222

SELECT COUNT(*) AS `numrows`
FROM `modelos` 
 Execution Time:0.000108957290649

SELECT `modelos`.*, `marcas`.`nombre` as `marca`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid`
WHERE   (
`modelos`.`id` LIKE '%%' ESCAPE '!'
OR  `modelos`.`nombre` LIKE '%%' ESCAPE '!'
OR  `marcas`.`nombre` LIKE '%%' ESCAPE '!'
 )
ORDER BY `id` DESC 
 Execution Time:0.000110864639282

SELECT *
FROM `marcas`
ORDER BY `id` DESC 
 Execution Time:0.000141859054565

SELECT *
FROM `marcas`
ORDER BY `id` DESC 
 Execution Time:0.000208854675293

SELECT `modelos`.*, `marcas`.`nombre` as `marca`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid`
WHERE   (
`modelos`.`id` LIKE '%%' ESCAPE '!'
OR  `modelos`.`nombre` LIKE '%%' ESCAPE '!'
OR  `marcas`.`nombre` LIKE '%%' ESCAPE '!'
 )
ORDER BY `id` DESC
 LIMIT 10 
 Execution Time:0.000119924545288

SELECT COUNT(*) AS `numrows`
FROM `modelos` 
 Execution Time:7.29560852051E-5

SELECT `modelos`.*, `marcas`.`nombre` as `marca`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid`
WHERE   (
`modelos`.`id` LIKE '%%' ESCAPE '!'
OR  `modelos`.`nombre` LIKE '%%' ESCAPE '!'
OR  `marcas`.`nombre` LIKE '%%' ESCAPE '!'
 )
ORDER BY `id` DESC 
 Execution Time:0.000123977661133

SELECT `modelos`.*, `marcas`.`nombre` as `marca`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid`
WHERE   (
`modelos`.`id` LIKE '%%' ESCAPE '!'
OR  `modelos`.`nombre` LIKE '%%' ESCAPE '!'
OR  `marcas`.`nombre` LIKE '%%' ESCAPE '!'
 )
ORDER BY `id` DESC
 LIMIT 10 
 Execution Time:0.0001540184021

SELECT COUNT(*) AS `numrows`
FROM `modelos` 
 Execution Time:8.51154327393E-5

SELECT `modelos`.*, `marcas`.`nombre` as `marca`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid`
WHERE   (
`modelos`.`id` LIKE '%%' ESCAPE '!'
OR  `modelos`.`nombre` LIKE '%%' ESCAPE '!'
OR  `marcas`.`nombre` LIKE '%%' ESCAPE '!'
 )
ORDER BY `id` DESC 
 Execution Time:0.000172138214111

SELECT *
FROM `marcas`
ORDER BY `id` DESC 
 Execution Time:0.000136137008667

SELECT *
FROM `marcas`
ORDER BY `id` DESC 
 Execution Time:0.00161004066467

SELECT `modelos`.*, `marcas`.`nombre` as `marca`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid`
WHERE   (
`modelos`.`id` LIKE '%Initial search%' ESCAPE '!'
OR  `modelos`.`nombre` LIKE '%Initial search%' ESCAPE '!'
OR  `marcas`.`nombre` LIKE '%Initial search%' ESCAPE '!'
 )
ORDER BY `id` DESC
 LIMIT 10 
 Execution Time:0.00107216835022

SELECT COUNT(*) AS `numrows`
FROM `modelos` 
 Execution Time:0.000210046768188

SELECT `modelos`.*, `marcas`.`nombre` as `marca`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid`
WHERE   (
`modelos`.`id` LIKE '%Initial search%' ESCAPE '!'
OR  `modelos`.`nombre` LIKE '%Initial search%' ESCAPE '!'
OR  `marcas`.`nombre` LIKE '%Initial search%' ESCAPE '!'
 )
ORDER BY `id` DESC 
 Execution Time:0.000350952148438

SELECT `modelos`.*, `marcas`.`nombre` as `marca`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid`
WHERE   (
`modelos`.`id` LIKE '%cliente%' ESCAPE '!'
OR  `modelos`.`nombre` LIKE '%cliente%' ESCAPE '!'
OR  `marcas`.`nombre` LIKE '%cliente%' ESCAPE '!'
 )
ORDER BY `id` DESC
 LIMIT 10 
 Execution Time:0.388654947281

SELECT COUNT(*) AS `numrows`
FROM `modelos` 
 Execution Time:0.00013279914856

SELECT `modelos`.*, `marcas`.`nombre` as `marca`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid`
WHERE   (
`modelos`.`id` LIKE '%cliente%' ESCAPE '!'
OR  `modelos`.`nombre` LIKE '%cliente%' ESCAPE '!'
OR  `marcas`.`nombre` LIKE '%cliente%' ESCAPE '!'
 )
ORDER BY `id` DESC 
 Execution Time:0.000427961349487

SELECT *
FROM `marcas`
ORDER BY `id` DESC 
 Execution Time:0.000203847885132

SELECT *
FROM `marcas`
ORDER BY `id` DESC 
 Execution Time:0.000169038772583

SELECT `modelos`.*, `marcas`.`nombre` as `marca`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid`
WHERE   (
`modelos`.`id` LIKE '%motorola%' ESCAPE '!'
OR  `modelos`.`nombre` LIKE '%motorola%' ESCAPE '!'
OR  `marcas`.`nombre` LIKE '%motorola%' ESCAPE '!'
 )
ORDER BY `id` DESC
 LIMIT 10 
 Execution Time:0.000827074050903

SELECT COUNT(*) AS `numrows`
FROM `modelos` 
 Execution Time:8.79764556885E-5

SELECT `modelos`.*, `marcas`.`nombre` as `marca`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid`
WHERE   (
`modelos`.`id` LIKE '%motorola%' ESCAPE '!'
OR  `modelos`.`nombre` LIKE '%motorola%' ESCAPE '!'
OR  `marcas`.`nombre` LIKE '%motorola%' ESCAPE '!'
 )
ORDER BY `id` DESC 
 Execution Time:0.000571012496948

SELECT `modelos`.*, `marcas`.`nombre` as `marca`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid`
WHERE   (
`modelos`.`id` LIKE '%motorola%' ESCAPE '!'
OR  `modelos`.`nombre` LIKE '%motorola%' ESCAPE '!'
OR  `marcas`.`nombre` LIKE '%motorola%' ESCAPE '!'
 )
ORDER BY `id` DESC
 LIMIT 10 
 Execution Time:0.000225067138672

SELECT COUNT(*) AS `numrows`
FROM `modelos` 
 Execution Time:0.000131845474243

SELECT `modelos`.*, `marcas`.`nombre` as `marca`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid`
WHERE   (
`modelos`.`id` LIKE '%motorola%' ESCAPE '!'
OR  `modelos`.`nombre` LIKE '%motorola%' ESCAPE '!'
OR  `marcas`.`nombre` LIKE '%motorola%' ESCAPE '!'
 )
ORDER BY `id` DESC 
 Execution Time:0.000150203704834

SELECT *
FROM `marcas`
ORDER BY `id` DESC 
 Execution Time:0.000196933746338

SELECT `modelos`.*, `marcas`.`nombre` as `marca`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid`
WHERE   (
`modelos`.`id` LIKE '%%' ESCAPE '!'
OR  `modelos`.`nombre` LIKE '%%' ESCAPE '!'
OR  `marcas`.`nombre` LIKE '%%' ESCAPE '!'
 )
ORDER BY `id` DESC
 LIMIT 10 
 Execution Time:0.00194501876831

SELECT COUNT(*) AS `numrows`
FROM `modelos` 
 Execution Time:0.000138998031616

SELECT `modelos`.*, `marcas`.`nombre` as `marca`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid`
WHERE   (
`modelos`.`id` LIKE '%%' ESCAPE '!'
OR  `modelos`.`nombre` LIKE '%%' ESCAPE '!'
OR  `marcas`.`nombre` LIKE '%%' ESCAPE '!'
 )
ORDER BY `id` DESC 
 Execution Time:0.000464916229248

SELECT *
FROM `marcas`
ORDER BY `id` DESC 
 Execution Time:0.000205993652344

SELECT `modelos`.*, `marcas`.`nombre` as `marca`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid`
WHERE   (
`modelos`.`id` LIKE '%%' ESCAPE '!'
OR  `modelos`.`nombre` LIKE '%%' ESCAPE '!'
OR  `marcas`.`nombre` LIKE '%%' ESCAPE '!'
 )
ORDER BY `id` DESC
 LIMIT 10 
 Execution Time:0.000138998031616

SELECT COUNT(*) AS `numrows`
FROM `modelos` 
 Execution Time:7.60555267334E-5

SELECT `modelos`.*, `marcas`.`nombre` as `marca`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid`
WHERE   (
`modelos`.`id` LIKE '%%' ESCAPE '!'
OR  `modelos`.`nombre` LIKE '%%' ESCAPE '!'
OR  `marcas`.`nombre` LIKE '%%' ESCAPE '!'
 )
ORDER BY `id` DESC 
 Execution Time:0.000109910964966

SELECT *
FROM `marcas`
ORDER BY `id` DESC 
 Execution Time:0.000164985656738

SELECT `modelos`.*, `marcas`.`nombre` as `marca`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid`
WHERE   (
`modelos`.`id` LIKE '%%' ESCAPE '!'
OR  `modelos`.`nombre` LIKE '%%' ESCAPE '!'
OR  `marcas`.`nombre` LIKE '%%' ESCAPE '!'
 )
ORDER BY `id` ASC
 LIMIT 10 
 Execution Time:0.00185990333557

SELECT COUNT(*) AS `numrows`
FROM `modelos` 
 Execution Time:0.000398874282837

SELECT `modelos`.*, `marcas`.`nombre` as `marca`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid`
WHERE   (
`modelos`.`id` LIKE '%%' ESCAPE '!'
OR  `modelos`.`nombre` LIKE '%%' ESCAPE '!'
OR  `marcas`.`nombre` LIKE '%%' ESCAPE '!'
 )
ORDER BY `id` ASC 
 Execution Time:0.000378131866455

SELECT `modelos`.*, `marcas`.`nombre` as `marca`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid`
WHERE   (
`modelos`.`id` LIKE '%%' ESCAPE '!'
OR  `modelos`.`nombre` LIKE '%%' ESCAPE '!'
OR  `marcas`.`nombre` LIKE '%%' ESCAPE '!'
 )
ORDER BY `id` DESC
 LIMIT 10 
 Execution Time:0.00180006027222

SELECT COUNT(*) AS `numrows`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid` 
 Execution Time:0.000401020050049

SELECT `modelos`.*, `marcas`.`nombre` as `marca`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid`
WHERE   (
`modelos`.`id` LIKE '%%' ESCAPE '!'
OR  `modelos`.`nombre` LIKE '%%' ESCAPE '!'
OR  `marcas`.`nombre` LIKE '%%' ESCAPE '!'
 )
ORDER BY `id` DESC 
 Execution Time:0.000581026077271

SELECT *
FROM `marcas`
ORDER BY `id` DESC 
 Execution Time:0.000247001647949

SELECT `modelos`.*, `marcas`.`nombre` as `marca`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid`
WHERE   (
`modelos`.`id` LIKE '%i%' ESCAPE '!'
OR  `modelos`.`nombre` LIKE '%i%' ESCAPE '!'
OR  `marcas`.`nombre` LIKE '%i%' ESCAPE '!'
 )
ORDER BY `id` DESC
 LIMIT 10 
 Execution Time:0.219271183014

SELECT COUNT(*) AS `numrows`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid` 
 Execution Time:0.000400066375732

SELECT `modelos`.*, `marcas`.`nombre` as `marca`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid`
WHERE   (
`modelos`.`id` LIKE '%i%' ESCAPE '!'
OR  `modelos`.`nombre` LIKE '%i%' ESCAPE '!'
OR  `marcas`.`nombre` LIKE '%i%' ESCAPE '!'
 )
ORDER BY `id` DESC 
 Execution Time:0.000539064407349

SELECT `modelos`.*, `marcas`.`nombre` as `marca`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid`
WHERE   (
`modelos`.`id` LIKE '%iphone%' ESCAPE '!'
OR  `modelos`.`nombre` LIKE '%iphone%' ESCAPE '!'
OR  `marcas`.`nombre` LIKE '%iphone%' ESCAPE '!'
 )
ORDER BY `id` DESC
 LIMIT 10 
 Execution Time:0.000531911849976

SELECT COUNT(*) AS `numrows`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid` 
 Execution Time:7.41481781006E-5

SELECT `modelos`.*, `marcas`.`nombre` as `marca`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid`
WHERE   (
`modelos`.`id` LIKE '%iphone%' ESCAPE '!'
OR  `modelos`.`nombre` LIKE '%iphone%' ESCAPE '!'
OR  `marcas`.`nombre` LIKE '%iphone%' ESCAPE '!'
 )
ORDER BY `id` DESC 
 Execution Time:0.000373125076294

SELECT `modelos`.*, `marcas`.`nombre` as `marca`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid`
WHERE   (
`modelos`.`id` LIKE '%iphone %' ESCAPE '!'
OR  `modelos`.`nombre` LIKE '%iphone %' ESCAPE '!'
OR  `marcas`.`nombre` LIKE '%iphone %' ESCAPE '!'
 )
ORDER BY `id` DESC
 LIMIT 10 
 Execution Time:0.000792026519775

SELECT COUNT(*) AS `numrows`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid` 
 Execution Time:8.08238983154E-5

SELECT `modelos`.*, `marcas`.`nombre` as `marca`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid`
WHERE   (
`modelos`.`id` LIKE '%iphone %' ESCAPE '!'
OR  `modelos`.`nombre` LIKE '%iphone %' ESCAPE '!'
OR  `marcas`.`nombre` LIKE '%iphone %' ESCAPE '!'
 )
ORDER BY `id` DESC 
 Execution Time:0.000378131866455

SELECT `modelos`.*, `marcas`.`nombre` as `marca`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid`
WHERE   (
`modelos`.`id` LIKE '%iphone a%' ESCAPE '!'
OR  `modelos`.`nombre` LIKE '%iphone a%' ESCAPE '!'
OR  `marcas`.`nombre` LIKE '%iphone a%' ESCAPE '!'
 )
ORDER BY `id` DESC
 LIMIT 10 
 Execution Time:0.00067400932312

SELECT COUNT(*) AS `numrows`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid` 
 Execution Time:9.41753387451E-5

SELECT `modelos`.*, `marcas`.`nombre` as `marca`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid`
WHERE   (
`modelos`.`id` LIKE '%iphone a%' ESCAPE '!'
OR  `modelos`.`nombre` LIKE '%iphone a%' ESCAPE '!'
OR  `marcas`.`nombre` LIKE '%iphone a%' ESCAPE '!'
 )
ORDER BY `id` DESC 
 Execution Time:0.000566959381104

SELECT `modelos`.*, `marcas`.`nombre` as `marca`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid`
WHERE   (
`modelos`.`id` LIKE '%iphone %' ESCAPE '!'
OR  `modelos`.`nombre` LIKE '%iphone %' ESCAPE '!'
OR  `marcas`.`nombre` LIKE '%iphone %' ESCAPE '!'
 )
ORDER BY `id` DESC
 LIMIT 10 
 Execution Time:0.000138998031616

SELECT COUNT(*) AS `numrows`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid` 
 Execution Time:7.60555267334E-5

SELECT `modelos`.*, `marcas`.`nombre` as `marca`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid`
WHERE   (
`modelos`.`id` LIKE '%iphone %' ESCAPE '!'
OR  `modelos`.`nombre` LIKE '%iphone %' ESCAPE '!'
OR  `marcas`.`nombre` LIKE '%iphone %' ESCAPE '!'
 )
ORDER BY `id` DESC 
 Execution Time:7.9870223999E-5

SELECT `modelos`.*, `marcas`.`nombre` as `marca`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid`
WHERE   (
`modelos`.`id` LIKE '%iphone%' ESCAPE '!'
OR  `modelos`.`nombre` LIKE '%iphone%' ESCAPE '!'
OR  `marcas`.`nombre` LIKE '%iphone%' ESCAPE '!'
 )
ORDER BY `id` DESC
 LIMIT 10 
 Execution Time:0.000123023986816

SELECT COUNT(*) AS `numrows`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid` 
 Execution Time:0.000113964080811

SELECT `modelos`.*, `marcas`.`nombre` as `marca`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid`
WHERE   (
`modelos`.`id` LIKE '%iphone%' ESCAPE '!'
OR  `modelos`.`nombre` LIKE '%iphone%' ESCAPE '!'
OR  `marcas`.`nombre` LIKE '%iphone%' ESCAPE '!'
 )
ORDER BY `id` DESC 
 Execution Time:0.000107049942017

SELECT `modelos`.*, `marcas`.`nombre` as `marca`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid`
WHERE   (
`modelos`.`id` LIKE '%%' ESCAPE '!'
OR  `modelos`.`nombre` LIKE '%%' ESCAPE '!'
OR  `marcas`.`nombre` LIKE '%%' ESCAPE '!'
 )
ORDER BY `id` DESC
 LIMIT 10 
 Execution Time:0.000829935073853

SELECT COUNT(*) AS `numrows`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid` 
 Execution Time:0.000153064727783

SELECT `modelos`.*, `marcas`.`nombre` as `marca`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid`
WHERE   (
`modelos`.`id` LIKE '%%' ESCAPE '!'
OR  `modelos`.`nombre` LIKE '%%' ESCAPE '!'
OR  `marcas`.`nombre` LIKE '%%' ESCAPE '!'
 )
ORDER BY `id` DESC 
 Execution Time:0.000509023666382

SELECT `modelos`.*, `marcas`.`nombre` as `marca`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid`
WHERE   (
`modelos`.`id` LIKE '%a%' ESCAPE '!'
OR  `modelos`.`nombre` LIKE '%a%' ESCAPE '!'
OR  `marcas`.`nombre` LIKE '%a%' ESCAPE '!'
 )
ORDER BY `id` DESC
 LIMIT 10 
 Execution Time:0.000511884689331

SELECT COUNT(*) AS `numrows`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid` 
 Execution Time:0.000133037567139

SELECT `modelos`.*, `marcas`.`nombre` as `marca`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid`
WHERE   (
`modelos`.`id` LIKE '%a%' ESCAPE '!'
OR  `modelos`.`nombre` LIKE '%a%' ESCAPE '!'
OR  `marcas`.`nombre` LIKE '%a%' ESCAPE '!'
 )
ORDER BY `id` DESC 
 Execution Time:0.000482082366943

SELECT `modelos`.*, `marcas`.`nombre` as `marca`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid`
WHERE   (
`modelos`.`id` LIKE '%a1%' ESCAPE '!'
OR  `modelos`.`nombre` LIKE '%a1%' ESCAPE '!'
OR  `marcas`.`nombre` LIKE '%a1%' ESCAPE '!'
 )
ORDER BY `id` DESC
 LIMIT 10 
 Execution Time:0.000545024871826

SELECT COUNT(*) AS `numrows`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid` 
 Execution Time:0.000372886657715

SELECT `modelos`.*, `marcas`.`nombre` as `marca`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid`
WHERE   (
`modelos`.`id` LIKE '%a1%' ESCAPE '!'
OR  `modelos`.`nombre` LIKE '%a1%' ESCAPE '!'
OR  `marcas`.`nombre` LIKE '%a1%' ESCAPE '!'
 )
ORDER BY `id` DESC 
 Execution Time:0.000473976135254

SELECT `modelos`.*, `marcas`.`nombre` as `marca`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid`
WHERE   (
`modelos`.`id` LIKE '%a16%' ESCAPE '!'
OR  `modelos`.`nombre` LIKE '%a16%' ESCAPE '!'
OR  `marcas`.`nombre` LIKE '%a16%' ESCAPE '!'
 )
ORDER BY `id` DESC
 LIMIT 10 
 Execution Time:0.000509977340698

SELECT COUNT(*) AS `numrows`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid` 
 Execution Time:7.41481781006E-5

SELECT `modelos`.*, `marcas`.`nombre` as `marca`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid`
WHERE   (
`modelos`.`id` LIKE '%a16%' ESCAPE '!'
OR  `modelos`.`nombre` LIKE '%a16%' ESCAPE '!'
OR  `marcas`.`nombre` LIKE '%a16%' ESCAPE '!'
 )
ORDER BY `id` DESC 
 Execution Time:0.000753164291382

SELECT `modelos`.*, `marcas`.`nombre` as `marca`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid`
WHERE   (
`modelos`.`id` LIKE '%a163%' ESCAPE '!'
OR  `modelos`.`nombre` LIKE '%a163%' ESCAPE '!'
OR  `marcas`.`nombre` LIKE '%a163%' ESCAPE '!'
 )
ORDER BY `id` DESC
 LIMIT 10 
 Execution Time:0.0231420993805

SELECT COUNT(*) AS `numrows`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid` 
 Execution Time:0.000124931335449

SELECT `modelos`.*, `marcas`.`nombre` as `marca`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid`
WHERE   (
`modelos`.`id` LIKE '%a163%' ESCAPE '!'
OR  `modelos`.`nombre` LIKE '%a163%' ESCAPE '!'
OR  `marcas`.`nombre` LIKE '%a163%' ESCAPE '!'
 )
ORDER BY `id` DESC 
 Execution Time:0.000411033630371

SELECT `modelos`.*, `marcas`.`nombre` as `marca`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid`
WHERE   (
`modelos`.`id` LIKE '%a1633%' ESCAPE '!'
OR  `modelos`.`nombre` LIKE '%a1633%' ESCAPE '!'
OR  `marcas`.`nombre` LIKE '%a1633%' ESCAPE '!'
 )
ORDER BY `id` DESC
 LIMIT 10 
 Execution Time:0.00065803527832

SELECT COUNT(*) AS `numrows`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid` 
 Execution Time:6.89029693604E-5

SELECT `modelos`.*, `marcas`.`nombre` as `marca`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid`
WHERE   (
`modelos`.`id` LIKE '%a1633%' ESCAPE '!'
OR  `modelos`.`nombre` LIKE '%a1633%' ESCAPE '!'
OR  `marcas`.`nombre` LIKE '%a1633%' ESCAPE '!'
 )
ORDER BY `id` DESC 
 Execution Time:0.000355958938599

SELECT `modelos`.*, `marcas`.`nombre` as `marca`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid`
WHERE   (
`modelos`.`id` LIKE '%%' ESCAPE '!'
OR  `modelos`.`nombre` LIKE '%%' ESCAPE '!'
OR  `marcas`.`nombre` LIKE '%%' ESCAPE '!'
 )
ORDER BY `id` DESC
 LIMIT 10 
 Execution Time:0.0898001194

SELECT COUNT(*) AS `numrows`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid` 
 Execution Time:0.000416040420532

SELECT `modelos`.*, `marcas`.`nombre` as `marca`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid`
WHERE   (
`modelos`.`id` LIKE '%%' ESCAPE '!'
OR  `modelos`.`nombre` LIKE '%%' ESCAPE '!'
OR  `marcas`.`nombre` LIKE '%%' ESCAPE '!'
 )
ORDER BY `id` DESC 
 Execution Time:0.00043797492981

SELECT *
FROM `marcas`
ORDER BY `id` DESC 
 Execution Time:0.00043797492981

SELECT `modelos`.*, `marcas`.`nombre` as `marca`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid`
WHERE   (
`modelos`.`id` LIKE '%xt%' ESCAPE '!'
OR  `modelos`.`nombre` LIKE '%xt%' ESCAPE '!'
OR  `marcas`.`nombre` LIKE '%xt%' ESCAPE '!'
 )
ORDER BY `id` DESC
 LIMIT 10 
 Execution Time:0.0593411922455

SELECT COUNT(*) AS `numrows`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid` 
 Execution Time:9.20295715332E-5

SELECT `modelos`.*, `marcas`.`nombre` as `marca`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid`
WHERE   (
`modelos`.`id` LIKE '%xt%' ESCAPE '!'
OR  `modelos`.`nombre` LIKE '%xt%' ESCAPE '!'
OR  `marcas`.`nombre` LIKE '%xt%' ESCAPE '!'
 )
ORDER BY `id` DESC 
 Execution Time:0.000480890274048

SELECT *
FROM `marcas`
ORDER BY `id` DESC 
 Execution Time:0.000221014022827

SELECT `modelos`.*, `marcas`.`nombre` as `marca`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid`
WHERE   (
`modelos`.`id` LIKE '%a%' ESCAPE '!'
OR  `modelos`.`nombre` LIKE '%a%' ESCAPE '!'
OR  `marcas`.`nombre` LIKE '%a%' ESCAPE '!'
 )
ORDER BY `id` DESC
 LIMIT 10 
 Execution Time:0.0584018230438

SELECT COUNT(*) AS `numrows`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid` 
 Execution Time:0.000125885009766

SELECT `modelos`.*, `marcas`.`nombre` as `marca`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid`
WHERE   (
`modelos`.`id` LIKE '%a%' ESCAPE '!'
OR  `modelos`.`nombre` LIKE '%a%' ESCAPE '!'
OR  `marcas`.`nombre` LIKE '%a%' ESCAPE '!'
 )
ORDER BY `id` DESC 
 Execution Time:0.000798225402832

SELECT `modelos`.*, `marcas`.`nombre` as `marca`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid`
WHERE   (
`modelos`.`id` LIKE '%a1%' ESCAPE '!'
OR  `modelos`.`nombre` LIKE '%a1%' ESCAPE '!'
OR  `marcas`.`nombre` LIKE '%a1%' ESCAPE '!'
 )
ORDER BY `id` DESC
 LIMIT 10 
 Execution Time:0.000960111618042

SELECT COUNT(*) AS `numrows`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid` 
 Execution Time:0.000324010848999

SELECT `modelos`.*, `marcas`.`nombre` as `marca`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid`
WHERE   (
`modelos`.`id` LIKE '%a1%' ESCAPE '!'
OR  `modelos`.`nombre` LIKE '%a1%' ESCAPE '!'
OR  `marcas`.`nombre` LIKE '%a1%' ESCAPE '!'
 )
ORDER BY `id` DESC 
 Execution Time:0.000399112701416

SELECT `modelos`.*, `marcas`.`nombre` as `marca`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid`
WHERE   (
`modelos`.`id` LIKE '%a16%' ESCAPE '!'
OR  `modelos`.`nombre` LIKE '%a16%' ESCAPE '!'
OR  `marcas`.`nombre` LIKE '%a16%' ESCAPE '!'
 )
ORDER BY `id` DESC
 LIMIT 10 
 Execution Time:0.00612998008728

SELECT COUNT(*) AS `numrows`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid` 
 Execution Time:8.29696655273E-5

SELECT `modelos`.*, `marcas`.`nombre` as `marca`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid`
WHERE   (
`modelos`.`id` LIKE '%a16%' ESCAPE '!'
OR  `modelos`.`nombre` LIKE '%a16%' ESCAPE '!'
OR  `marcas`.`nombre` LIKE '%a16%' ESCAPE '!'
 )
ORDER BY `id` DESC 
 Execution Time:0.000638961791992

SELECT `modelos`.*, `marcas`.`nombre` as `marca`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid`
WHERE   (
`modelos`.`id` LIKE '%a16 %' ESCAPE '!'
OR  `modelos`.`nombre` LIKE '%a16 %' ESCAPE '!'
OR  `marcas`.`nombre` LIKE '%a16 %' ESCAPE '!'
 )
ORDER BY `id` DESC
 LIMIT 10 
 Execution Time:0.00192403793335

SELECT COUNT(*) AS `numrows`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid` 
 Execution Time:0.000290870666504

SELECT `modelos`.*, `marcas`.`nombre` as `marca`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid`
WHERE   (
`modelos`.`id` LIKE '%a16 %' ESCAPE '!'
OR  `modelos`.`nombre` LIKE '%a16 %' ESCAPE '!'
OR  `marcas`.`nombre` LIKE '%a16 %' ESCAPE '!'
 )
ORDER BY `id` DESC 
 Execution Time:0.000378131866455

SELECT `modelos`.*, `marcas`.`nombre` as `marca`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid`
WHERE   (
`modelos`.`id` LIKE '%a16 i%' ESCAPE '!'
OR  `modelos`.`nombre` LIKE '%a16 i%' ESCAPE '!'
OR  `marcas`.`nombre` LIKE '%a16 i%' ESCAPE '!'
 )
ORDER BY `id` DESC
 LIMIT 10 
 Execution Time:0.000468969345093

SELECT COUNT(*) AS `numrows`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid` 
 Execution Time:7.08103179932E-5

SELECT `modelos`.*, `marcas`.`nombre` as `marca`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid`
WHERE   (
`modelos`.`id` LIKE '%a16 i%' ESCAPE '!'
OR  `modelos`.`nombre` LIKE '%a16 i%' ESCAPE '!'
OR  `marcas`.`nombre` LIKE '%a16 i%' ESCAPE '!'
 )
ORDER BY `id` DESC 
 Execution Time:0.00033712387085

SELECT `modelos`.*, `marcas`.`nombre` as `marca`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid`
WHERE   (
`modelos`.`id` LIKE '%a16 iphone%' ESCAPE '!'
OR  `modelos`.`nombre` LIKE '%a16 iphone%' ESCAPE '!'
OR  `marcas`.`nombre` LIKE '%a16 iphone%' ESCAPE '!'
 )
ORDER BY `id` DESC
 LIMIT 10 
 Execution Time:0.000627994537354

SELECT COUNT(*) AS `numrows`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid` 
 Execution Time:6.19888305664E-5

SELECT `modelos`.*, `marcas`.`nombre` as `marca`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid`
WHERE   (
`modelos`.`id` LIKE '%a16 iphone%' ESCAPE '!'
OR  `modelos`.`nombre` LIKE '%a16 iphone%' ESCAPE '!'
OR  `marcas`.`nombre` LIKE '%a16 iphone%' ESCAPE '!'
 )
ORDER BY `id` DESC 
 Execution Time:0.000310182571411

SELECT *
FROM `marcas`
ORDER BY `id` DESC 
 Execution Time:0.00103807449341

SELECT *
FROM `marcas`
ORDER BY `id` DESC 
 Execution Time:0.000158071517944

SELECT `modelos`.*, `marcas`.`nombre` as `marca`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid`
ORDER BY `id` DESC 
 Execution Time:0.00166201591492

SELECT COUNT(*) AS `numrows`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid` 
 Execution Time:0.000401973724365

SELECT `modelos`.*, `marcas`.`nombre` as `marca`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid`
ORDER BY `id` DESC 
 Execution Time:0.000118970870972

SELECT *
FROM `marcas`
ORDER BY `id` DESC 
 Execution Time:0.178719997406

SELECT *
FROM `marcas`
ORDER BY `id` DESC 
 Execution Time:0.000200986862183

SELECT `modelos`.*, `marcas`.`nombre` as `marca`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid`
WHERE   (
`modelos`.`id` LIKE '%xt%' ESCAPE '!'
OR  `modelos`.`nombre` LIKE '%xt%' ESCAPE '!'
OR  `marcas`.`nombre` LIKE '%xt%' ESCAPE '!'
 )
ORDER BY `id` DESC
 LIMIT 10 
 Execution Time:0.00137495994568

SELECT COUNT(*) AS `numrows`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid` 
 Execution Time:0.00032901763916

SELECT `modelos`.*, `marcas`.`nombre` as `marca`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid`
WHERE   (
`modelos`.`id` LIKE '%xt%' ESCAPE '!'
OR  `modelos`.`nombre` LIKE '%xt%' ESCAPE '!'
OR  `marcas`.`nombre` LIKE '%xt%' ESCAPE '!'
 )
ORDER BY `id` DESC 
 Execution Time:0.000412940979004

SELECT `modelos`.*, `marcas`.`nombre` as `marca`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid`
WHERE   (
`modelos`.`id` LIKE '%xt%' ESCAPE '!'
OR  `modelos`.`nombre` LIKE '%xt%' ESCAPE '!'
OR  `marcas`.`nombre` LIKE '%xt%' ESCAPE '!'
 )
ORDER BY `id` DESC
 LIMIT 10 
 Execution Time:0.00261998176575

SELECT COUNT(*) AS `numrows`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid` 
 Execution Time:0.000515937805176

SELECT `modelos`.*, `marcas`.`nombre` as `marca`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid`
WHERE   (
`modelos`.`id` LIKE '%xt%' ESCAPE '!'
OR  `modelos`.`nombre` LIKE '%xt%' ESCAPE '!'
OR  `marcas`.`nombre` LIKE '%xt%' ESCAPE '!'
 )
ORDER BY `id` DESC 
 Execution Time:0.00106406211853

SELECT *
FROM `marcas`
ORDER BY `id` DESC 
 Execution Time:0.000720977783203

SELECT `modelos`.*, `marcas`.`nombre` as `marca`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid`
WHERE   (
`modelos`.`id` LIKE '%iphone%' ESCAPE '!'
OR  `modelos`.`nombre` LIKE '%iphone%' ESCAPE '!'
OR  `marcas`.`nombre` LIKE '%iphone%' ESCAPE '!'
 )
ORDER BY `id` DESC
 LIMIT 10 
 Execution Time:0.000905990600586

SELECT COUNT(*) AS `numrows`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid` 
 Execution Time:0.000159025192261

SELECT `modelos`.*, `marcas`.`nombre` as `marca`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid`
WHERE   (
`modelos`.`id` LIKE '%iphone%' ESCAPE '!'
OR  `modelos`.`nombre` LIKE '%iphone%' ESCAPE '!'
OR  `marcas`.`nombre` LIKE '%iphone%' ESCAPE '!'
 )
ORDER BY `id` DESC 
 Execution Time:0.000542163848877

SELECT *
FROM `marcas`
ORDER BY `id` DESC 
 Execution Time:0.00017786026001

SELECT `modelos`.*, `marcas`.`nombre` as `marca`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid`
WHERE   (
`modelos`.`id` LIKE '%iphone%' ESCAPE '!'
OR  `modelos`.`nombre` LIKE '%iphone%' ESCAPE '!'
OR  `marcas`.`nombre` LIKE '%iphone%' ESCAPE '!'
 )
ORDER BY `nombre` ASC
 LIMIT 10 
 Execution Time:0.00146007537842

SELECT COUNT(*) AS `numrows`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid` 
 Execution Time:0.000175952911377

SELECT `modelos`.*, `marcas`.`nombre` as `marca`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid`
WHERE   (
`modelos`.`id` LIKE '%iphone%' ESCAPE '!'
OR  `modelos`.`nombre` LIKE '%iphone%' ESCAPE '!'
OR  `marcas`.`nombre` LIKE '%iphone%' ESCAPE '!'
 )
ORDER BY `nombre` ASC 
 Execution Time:0.000527143478394

SELECT `modelos`.*, `marcas`.`nombre` as `marca`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid`
WHERE   (
`modelos`.`id` LIKE '%iphone%' ESCAPE '!'
OR  `modelos`.`nombre` LIKE '%iphone%' ESCAPE '!'
OR  `marcas`.`nombre` LIKE '%iphone%' ESCAPE '!'
 )
ORDER BY `nombre` DESC
 LIMIT 10 
 Execution Time:0.000784873962402

SELECT COUNT(*) AS `numrows`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid` 
 Execution Time:6.79492950439E-5

SELECT `modelos`.*, `marcas`.`nombre` as `marca`
FROM `modelos`
JOIN `marcas` ON `marcas`.`id` = `modelos`.`marcaid`
WHERE   (
`modelos`.`id` LIKE '%iphone%' ESCAPE '!'
OR  `modelos`.`nombre` LIKE '%iphone%' ESCAPE '!'
OR  `marcas`.`nombre` LIKE '%iphone%' ESCAPE '!'
 )
ORDER BY `nombre` DESC 
 Execution Time:0.000404119491577

