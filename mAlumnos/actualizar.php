<?php
//se manda llamar la conexion
include("../conexion/conexion.php");

// $idCarrera    = $_POST["id_carrera"];
$nombre   = $_POST["alumno"];
$noControl   = $_POST["noControl"];
$carrera = $_POST["carrera"];
$ide       = $_POST["ide"];

$nombre    =trim($nombre);
$noControl   =trim($noControl);
$carrera   =trim($carrera);


$fecha=date("Y-m-d"); 
$hora=date ("H:i:s");

mysql_query("SET NAMES utf8");
 $insertar = mysql_query("UPDATE alumnos SET
							id_persona='$nombre',
							no_control='$noControl',
							id_carrera='$carrera',
							id_registro='1'
						WHERE id_alumno='$ide'
							 ",$conexion)or die(mysql_error());

?>