<?php
// Algo bastante simple y muy util. Espero les sirva.

$server = "localhost"; // Aca escriban la ruta de la ubicacion de su servidor.
$user = "root";  // Escribir aqui el nombre de usuario que utilizan.
$pass = "";  // Aqui escribir el password que utilizan para conectarse.
$db = "localidades";  // Aqui escriban el nombre de su base de datos.

$login = mysql_connect($server, $user, $pass);
$seldb = mysql_select_db($db);

	if (!$login){
		echo "No se conecto al servidor";
	} 
	if (!$seldb){
		echo "No selecciono la base";
	}
?>
