<?php
	include '../conexion/conexion.php';

	$buscarMat = $_POST['matricula'];
	
	// mysql_query("SET NAMES utf8");
	
	if (isset($buscarMat)) {
			$consulta=mysql_query("SELECT 
								id_alumno, 
								CONCAT(p.nombre,' ',p.ap_paterno,' ',p.ap_materno) AS Persona,
								(SELECT carreras.nombre FROM carreras WHERE carreras.id_carrera = alumnos.id_carrera) AS Carrera,
								no_control,
								p.sexo
								FROM alumnos
								INNER JOIN personas p ON p.id_persona = alumnos.id_persona
								WHERE no_control = '$buscarMat'",$conexion) or die (mysql_error());

		$row = mysql_fetch_array($consulta);
		$validar = mysql_num_rows($consulta);

		if ($validar == 0) {
			
		} 

		else{
			$foto ='../images/'.$row[3].'.jpg';
		if (file_exists($foto)){
			$imagen=$foto;
		}else{
			if ($row[4]=='M') {
				$imagen='../images/hombre.jpg';
			}else{
				$imagen='../images/mujer.jpg';
			}
		}

	
				$ide = $row[0];
				$nombre = $row[1];
				$carrera = $row[2];
				//Output
				$mensaje = array($ide,$nombre,$carrera,$imagen);  
				 

							
			
		}
	}


	echo json_encode($mensaje);

?>







