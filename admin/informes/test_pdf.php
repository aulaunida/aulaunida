<?php
require('../../admin/librerias/fpdf186/fpdf.php');

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(40, 10, 'Hola, mundo!');
$pdf->Output();
?>