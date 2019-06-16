<?php
  
  include 'plantilla.php';
  include '../../conexion/conexion.php';

$consulta=mysql_query("SELECT
              CONCAT(ap_paterno,' ',ap_materno,' ',nombre) AS Persona,
              telefono,
              correo,
              direccion
              
            FROM
              personas WHERE tipo_persona = 'Trabajador'",$conexion) or die (mysql_error());

	// $resultado = mysqli_query($conexion, $consulta);
  $i = 1;

  $pdf = new PDF('L');
  $pdf->AliasNbPages();
  $pdf->AddPage();

  $pdf->SetFillColor(56,199,244);
  $pdf->SetFont('Arial', 'B', 12);
  $pdf->Cell(2,6);
  $pdf->Cell(75, 6, 'Nombre', 1, 0, 'C', 1);
  $pdf->Cell(45, 6, 'Telefono', 1, 0, 'C', 1);
  $pdf->Cell(70, 6, 'Correo', 1, 0, 'C', 1);
  // $pdf->Cell(40, 6, 'Marca', 1, 0, 'C', 1);
  // $pdf->Cell(40, 6, utf8_decode('Categoría'), 1, 0, 'C', 1);
  $pdf->Cell(90, 6, 'Domicilio', 1, 1, 'C', 1);


$pdf->SetFont('Arial', '', 12);
  while ($row = mysql_fetch_array($consulta)) {
    $pdf->Cell(2,6);
  	$pdf->Cell(75,6,utf8_decode($row[0]),1,0,'C');
  	$pdf->Cell(45,6,$row[1],1,0,'C');
  	$pdf->Cell(70,6,$row[2],1,0,'C');
  	// $pdf->Cell(40,6,utf8_decode($row[3]),1,0,'C');
  	// $pdf->Cell(40,6,utf8_decode($row[2]),1,0,'C');
  	$pdf->Cell(90,6,$row[3],1,1,'C');

    }


  $pdf->Output();





?>