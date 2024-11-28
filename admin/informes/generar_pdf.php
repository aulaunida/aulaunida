<?php
require('C:/wamp64/www/aulaunida/admin/librerias/fpdf186/fpdf.php');
require('../../app/config.php');
require('../../app/controllers/informes/datos_informes.php');
require('../../app/controllers/estudiantes/listado_de_estudiantes.php');

$id_informe = $_GET['id'];

class PDF extends FPDF {
    function Header() {
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, 'Informe Detallado', 0, 1, 'C');
        $this->Ln(10);
    }

    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Pagina ' . $this->PageNo(), 0, 0, 'C');
    }
}

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);

// Agregar los datos al PDF
$pdf->Cell(0, 10, 'Fecha del informe: ' . $fecha_informe, 0, 1);
$pdf->Cell(0, 10, 'Materia: ' . $nombre_materia, 0, 1);
$pdf->Cell(0, 10, 'Categoria: ' . strtoupper($observacion), 0, 1);
$pdf->Ln(10);
$pdf->MultiCell(0, 10, 'Nota: ' . $nota);

// Output del archivo
$pdf->Output('I', 'informe.pdf'); // 'I' para mostrarlo en el navegador, 'D' para forzar la descarga
?>
