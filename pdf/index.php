<?php
  
  include 'plantilla.php';
  include '../../conexion/conexion.php';

$consulta=mysql_query("SELECT
              CONCAT(ap_paterno,' ',ap_materno,' ',nombre) AS Persona,
              sexo,
              direccion,
              telefono,
              fecha_nacimiento,
              correo,
              tipo_persona,
              nombre,
              ap_paterno,
              ap_materno
            FROM
              personas",$conexion) or die (mysql_error());

	$resultado = mysql_query($conexion, $consulta);
  $i = 1;

  $pdf = new PDF('L');
  $pdf->AliasNbPages();
  $pdf->AddPage();

  $pdf->SetFillColor(56,199,244);
  $pdf->SetFont('Arial', 'B', 12);
  $pdf->Cell(15,6);
  $pdf->Cell(60, 6, 'Nombre', 1, 0, 'C', 1);
  $pdf->Cell(25, 6, 'Correo', 1, 0, 'C', 1);
  $pdf->Cell(40, 6, 'Telefono', 1, 0, 'C', 1);
  // $pdf->Cell(40, 6, 'Marca', 1, 0, 'C', 1);
  // $pdf->Cell(40, 6, utf8_decode('Categoría'), 1, 0, 'C', 1);
  // $pdf->Cell(40, 6, 'Color', 1, 1, 'C', 1);


$pdf->SetFont('Arial', '', 10);
  while ($row = $resultado->fetch_assoc()) {
    $pdf->Cell(15,6);
  	$pdf->Cell(60,6,utf8_decode($row[0]),1,0,'C');
  	$pdf->Cell(25,6,$row['cantidad'],1,0,'C');
  	$pdf->Cell(40,6,$row[5],1,0,'C');
  	// $pdf->Cell(40,6,utf8_decode($row[3]),1,0,'C');
  	// $pdf->Cell(40,6,utf8_decode($row['categoria']),1,0,'C');
  	// $pdf->Cell(40,6,$row['color'],1,1,'C');

    }


  $pdf->Output();





?>