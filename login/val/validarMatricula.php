<?php
	include '../conexion/conexion.php';

	$buscarMat = $_POST['matricula'];
	
	mysql_query("SET NAMES utf8");
	
	if (isset($buscarMat)) {
			$consulta=mysql_query("SELECT 
					   id_alumno,
					   id_persona,
					   id_carrera,
					   no_control,
					   activo,
					   (SELECT personas.nombre FROM personas WHERE personas.id_persona=alumnos.id_persona) AS nAlumno,
					   (SELECT personas.ap_paterno FROM personas WHERE personas.id_persona=alumnos.id_persona) AS pAlumno,
					   (SELECT personas.ap_materno FROM personas WHERE personas.id_persona=alumnos.id_persona) AS mAlumno,
					   (SELECT carreras.nombre FROM carreras WHERE carreras.id_carrera=alumnos.id_carrera) AS Carrera,
					   fecha_registro
					   FROM alumnos WHERE no_control = '$buscarMat' ",$conexion) or die (mysql_error());

		$row = mysql_num_rows($consulta);

		if ($row == 0) {
			
		} 

		else{
			

		//La variable $resultado contiene el array que se genera en la consulta, así que obtenemos los datos y los mostramos en un bucle
			while($resultados = mysql_fetch_array($consulta)) {
				$nombre = $resultados[6].' '.$resultados[7].' '.$resultados[5];
				// $carrera = $resultados[8];
				

				//Output
				$mensaje .= $nombre;
			
			};//Fin while $resultados
		}
	}


	echo $mensaje;

?>







