<?php 
include '../conexion/conexion.php';
$noControl = $_POST['noControl'];
$ide = $_POST['ide'];

date_default_timezone_set('America/Monterrey');
$fecha=date("Y-m-d"); 
$hora=date ("H:i:s");
	
		mysql_query('SET NAMES utf8');


	$cadena = mysql_query("INSERT INTO registros (id_alumno, matricula, fecha_ingreso, hora_ingreso, activo)
							VALUES ('$ide', '$noControl', '$fecha', '$hora', 1)",$conexion)or die(mysql_error()); 	


?>