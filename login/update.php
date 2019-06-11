<?php 
	include ("../conexion/conexion.php");

	$pass_actual = $_POST["pass"];
	$contra1 = $_POST['vContra1'];
	$contra2 = $_POST["vContra2"];
	$passMD5 = md5($contra1);
	$idE = $_POST["usuario"];


date_default_timezone_set('America/Monterrey');

$fecha=date("Y-m-d"); 
$hora=date ("H:i:s");

	mysql_query('SET NAMES utf8');


	$cadena_actualizar = mysql_query("UPDATE usuarios SET 
									contra = '$passMD5', 
									id_registro = '1', 
									fecha_registro = '$fecha', 
									hora_registro = '$hora'
							WHERE usuario = '$idE'",$conexion)or die(mysql_error());
	
 ?>