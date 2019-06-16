<?php
  
  include 'plantilla.php';
  include '../../conexion/conexion.php';

$consulta=mysql_query("SELECT
              id_alumno,
              CONCAT(p.ap_paterno,' ',p.ap_materno,' ',p.nombre) AS Persona,
              (SELECT carreras.nombre FROM carreras WHERE carreras.id_carrera = alumnos.id_carrera) AS Carrera,
              no_control
            FROM
              alumnos
              INNER JOIN personas p ON p.id_persona = alumnos.id_persona
               WHERE alumnos.activo = 1",$conexion) or die (mysql_error());

	// $resultado = mysqli_query($conexion, $consulta);
  $i = 1;

  $pdf = new PDF('L');
  $pdf->AliasNbPages();
  $pdf->AddPage();

  $pdf->SetFillColor(56,199,244);
  $pdf->SetFont('Arial', 'B', 12);
  $pdf->Cell(35,6);
  $pdf->Cell(75, 6, 'Alumno', 1, 0, 'C', 1);
  $pdf->Cell(45, 6, 'Matricula', 1, 0, 'C', 1);
  $pdf->Cell(90, 6, 'Carrera', 1, 1, 'C', 1);
  // $pdf->Cell(40, 6, 'Marca', 1, 0, 'C', 1);
  // $pdf->Cell(40, 6, utf8_decode('Categoría'), 1, 0, 'C', 1);
  
  // $pdf->Cell(2,6);


$pdf->SetFont('Arial', '', 12);
  while ($row = mysql_fetch_array($consulta)) {
    $pdf->Cell(35,6);
  	$pdf->Cell(75,8,utf8_decode($row[1]),1,0,'C');
  	$pdf->Cell(45,8,$row[3],1,0,'C');
  	$pdf->Cell(90,8,utf8_decode($row[2]),1,1,'C');
  	// $pdf->Cell(40,6,utf8_decode($row[3]),1,0,'C');
  	// $pdf->Cell(40,6,utf8_decode($row[2]),1,0,'C');
  	

    }


  $pdf->Output();





?>