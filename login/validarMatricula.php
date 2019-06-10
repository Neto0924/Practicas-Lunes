<?php
	include '../conexion/conexion.php';

	$matricula = $_POST['noControl'];
	


	
	mysql_query("SET NAMES utf8");
	$consulta = mysql_query("SELECT
						 no_control FROM alumnos WHERE no_control = '$matricula' ",$conexion)or die(mysql_error());
	
?>





