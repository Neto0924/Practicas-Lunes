<?php
//se manda llamar la conexion
include("../conexion/conexion.php");

$nombre    = $_POST["nombre"];
$abreviatura   = $_POST["abreviatura"];
$ide       = $_POST["ide"];

$nombre    =trim($nombre);
$abreviatura   =trim($abreviatura);

$fecha=date("Y-m-d"); 
$hora=date ("H:i:s");

mysql_query("SET NAMES utf8");
 $insertar = mysql_query("UPDATE carreras SET
							nombre='$nombre',
							abreviatura='$abreviatura',
							fecha_registro='$fecha',
							hora_registro='$hora',
							id_registro='1'
						WHERE id_carrera='$ide'
							 ",$conexion)or die(mysql_error());

?>