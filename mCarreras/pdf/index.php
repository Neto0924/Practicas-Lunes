<?php
  
  include 'plantilla.php';
  include '../../conexion/conexion.php';

$consulta=mysql_query("SELECT
              id_carrera,
              carreras.nombre,
              abreviatura,
              (SELECT usuarios.usuario FROM usuarios WHERE usuarios.id_usuario = carreras.id_registro)
            FROM
              carreras
               WHERE carreras.activo = 1",$conexion) or die (mysql_error());


  $i = 1;

  $pdf = new PDF('L');
  $pdf->AliasNbPages();
  $pdf->AddPage();

  $pdf->SetFillColor(56,199,244);
  $pdf->SetFont('Arial', 'B', 12);
  $pdf->Cell(35,6);
  $pdf->Cell(80, 6, 'Nombre Carrera', 1, 0, 'C', 1);
  $pdf->Cell(45, 6, 'Abreviatura', 1, 0, 'C', 1);
  $pdf->Cell(90, 6, 'Usuario Registro', 1, 1, 'C', 1);



$pdf->SetFont('Arial', '', 12);
  while ($row = mysql_fetch_array($consulta)) {
    $pdf->Cell(35,6);
  	$pdf->Cell(80,8,utf8_decode($row[1]),1,0,'C');
  	$pdf->Cell(45,8,$row[2],1,0,'C');
  	$pdf->Cell(90,8,utf8_decode($row[3]),1,1,'C');

  	

    }


  $pdf->Output();





?>