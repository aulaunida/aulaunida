<?php
require('fpdf.php');
require_once 'C:/wamp64/www/aulaunida/app/config.php';

// Función para convertir texto UTF-8 a ISO-8859-1
function convertEncoding($text) {
    return iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $text);
}

// Función para convertir HTML a texto plano para el PDF
function htmlToPdf($text, $pdf) {
    $text = html_entity_decode(trim($text), ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $text = convertEncoding($text);

    if (strpos($text, '<') !== false) {
        $text = strip_tags($text, '<b><i><u><strong><em><br><ul><li>');
        $text = preg_replace('/<strong>(.*?)<\/strong>/', '\\1', $text);
        $text = preg_replace('/<em>(.*?)<\/em>/', '\\1', $text);
        $text = preg_replace('/<li.*?>(.*?)<\/li>/', "- \\1", $text);
        $text = preg_replace('/<br\s*\/?>/', "\n", $text);
        $text = preg_replace('/<ul>|<\/ul>/', '', $text);
    }

    $lines = explode("\n", $text);
    foreach ($lines as $line) {
        $pdf->MultiCell(0, 5, $line, 0, 'L');
    }
}

// Consulta para obtener los datos del informe
$id_informe = $_GET['id'];
$sql_informe = "SELECT 
    i.fecha_informe, 
    m.nombre_materia, 
    i.observacion, 
    i.nota, 
    CONCAT(p.apellidos, ', ', p.nombres) AS estudiante,
    CONCAT(dp.apellidos, ', ', dp.nombres) AS docente
FROM informes i
JOIN estudiantes e ON i.estudiante_id = e.id_estudiante
JOIN personas p ON e.persona_id = p.id_persona
JOIN materias m ON i.materia_id = m.id_materia
JOIN docentes d ON i.docente_id = d.id_docente
JOIN personas dp ON d.persona_id = dp.id_persona
WHERE i.id_informe = :id_informe";

$query_informe = $pdo->prepare($sql_informe);
$query_informe->bindParam(':id_informe', $id_informe, PDO::PARAM_INT);
$query_informe->execute();
$informe = $query_informe->fetch(PDO::FETCH_ASSOC);

// Clase personalizada para el PDF
class PDF extends FPDF {
    function Header() {
        $this->Image('logo_colegio.png', 10, 6, 30);
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 10, 'Instituto Primario Arturo Capdevila', 0, 1, 'C');
        $this->SetFont('Arial', '', 10);
        $this->Cell(0, 5, 'Informe escolar', 0, 1, 'C');
        $this->Ln(10);
    }

    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Instituto Primario Arturo Capdevila | Pagina ' . $this->PageNo(), 0, 0, 'C');
    }
}

// Crear el PDF
$pdf = new PDF('P', 'mm', 'A4');
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);

// Fecha
$pdf->SetFont('Arial', 'I', 10);
$pdf->Cell(0, 10, 'Fecha: ' . date('d/m/Y'), 0, 1, 'R');
$pdf->Ln(5);

// Detalles del Informe
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, 'Detalle del Informe:', 0, 1, 'L');

// Subrayado (línea debajo del texto)
$x = $pdf->GetX(); // Coordenada X actual
$y = $pdf->GetY(); // Coordenada Y actual
$pdf->Line($x, $y - 2, $x + 40, $y - 2); // Línea ajustada debajo del texto
$pdf->Ln(5);

// Información del estudiante
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(50, 10, 'Alumno:', 0, 0, 'L');
$pdf->Cell(0, 10, convertEncoding($informe['estudiante']), 0, 1, 'L');

$pdf->Cell(50, 10, 'Fecha del Informe:', 0, 0, 'L');
$pdf->Cell(0, 10, $informe['fecha_informe'], 0, 1, 'L');

$pdf->Cell(50, 10, 'Materia:', 0, 0, 'L');
$pdf->Cell(0, 10, convertEncoding($informe['nombre_materia']), 0, 1, 'L');

$pdf->Cell(50, 10, 'Categoria:', 0, 0, 'L');
$pdf->Cell(0, 10, convertEncoding($informe['observacion']), 0, 1, 'L');

// Espacio
$pdf->Ln(5);

// Contenido principal del informe
$pdf->SetFont('Arial', '', 10);
htmlToPdf($informe['nota'], $pdf);

// Firma
$pdf->Ln(40);
$pdf->Cell(64);
$pdf->Cell(60, 0, '', 1, 1, 'C');
$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(0, 10, 'Firma del Docente Responsable', 0, 1, 'C');

// Generar el PDF
$pdf->Output('I', 'reporte_informe.pdf');
?>
