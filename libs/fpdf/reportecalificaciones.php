<?php
require('fpdf.php');
require_once 'C:/wamp64/www/aulaunida/app/config.php';

// Función para traducir las notas
function traducirNota($nota) {
    $mapa_notas = [
        100 => 'E',  // Excelente
        80  => 'MB', // Muy Bueno
        60  => 'B',  // Bueno
        40  => 'S',  // Suficiente
        20  => 'NS', // No Suficiente
        ''   => '-'  // Vacío
    ];
    return $mapa_notas[$nota] ?? 'ND'; // ND: Nota desconocida
}

// Consulta SQL ordenada alfabéticamente
$sql_calificaciones = "SELECT 
    c.id_calificacion, 
    c.estudiante_id, 
    c.materia_id, 
    CONCAT(p.apellidos, ', ', p.nombres) AS estudiante, 
    m.nombre_materia AS materia, 
    c.nota1, c.nota2, c.nota3, c.nota4, c.nota5, 
    c.nota6, c.nota7, c.nota8, c.nota9, c.nota10
FROM 
    calificaciones c
JOIN 
    estudiantes e ON c.estudiante_id = e.id_estudiante
JOIN 
    personas p ON e.persona_id = p.id_persona
JOIN 
    materias m ON c.materia_id = m.id_materia
WHERE 
    c.estado = '1'
ORDER BY 
    p.apellidos, p.nombres";

$query_calificaciones = $pdo->prepare($sql_calificaciones);
$query_calificaciones->execute();
$calificaciones = $query_calificaciones->fetchAll(PDO::FETCH_ASSOC);

// Clase personalizada para el PDF
class PDF extends FPDF {
    function Header() {
        // Logo
        $this->Image('logo_colegio.png', 10, 6, 30);
        // Título del Colegio
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 10, 'Instituto Primario Arturo Capdevila', 0, 1, 'C');
        $this->SetFont('Arial', '', 10);
        $this->Cell(0, 5, 'Reporte de Calificaciones' , 0, 1, 'C');
        $this->Ln(10); // Espacio
    }

    function Footer() {
        // Posición al final
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Instituto Primario Arturo Capdevila | Pagina ' . $this->PageNo(), 0, 0, 'C');
    }
}

// Crear el PDF en orientación horizontal
$pdf = new PDF('L', 'mm', 'A4');
$pdf->AddPage();
$pdf->SetFont('Arial', '', 8);

// Fecha
$pdf->SetFont('Arial', 'I', 9);
$pdf->Cell(0, 10, 'Fecha: ' . date('d/m/Y'), 0, 1, 'R');

// Encabezado de tabla
$pdf->SetFont('Arial', 'B', 8);
$pdf->SetFillColor(200, 220, 255);
$pdf->Cell(60, 10, 'Alumno', 1, 0, 'C', true); // Más ancho
$pdf->Cell(40, 10, 'Materia', 1, 0, 'C', true);
for ($i = 1; $i <= 10; $i++) {
    $titulo = ($i == 5 || $i == 10) ? "Final" : "Nota $i";
    $colorNotaFinal = ($i == 5 || $i == 10) ? [150, 200, 255] : [200, 220, 255];
    $pdf->SetFillColor(...$colorNotaFinal);
    $pdf->Cell(15, 10, $titulo, 1, 0, 'C', true); // Reducido para caber mejor
}
$pdf->Ln(); // Salto de línea

// Contenido de la tabla
$pdf->SetFont('Arial', '', 8);
$fill = false;
foreach ($calificaciones as $calificacion) {
    $pdf->SetFillColor(240, 240, 240); // Color de fondo alternado
    $pdf->Cell(60, 10, mb_convert_encoding($calificacion['estudiante'], 'ISO-8859-1', 'UTF-8'), 1, 0, 'L', $fill);
    $pdf->Cell(40, 10, mb_convert_encoding($calificacion['materia'], 'ISO-8859-1', 'UTF-8'), 1, 0, 'C', $fill);
    for ($i = 1; $i <= 10; $i++) {
        $nota = traducirNota($calificacion["nota$i"]);
        $pdf->SetFillColor($i == 5 || $i == 10 ? 220 : 240, 240, 240); // Color diferenciado para "Nota Final"
        $pdf->Cell(15, 10, $nota, 1, 0, 'C', $fill);
    }
    $pdf->Ln();
    $fill = !$fill; // Alternar filas
}

// Leyenda de notas
$pdf->Ln(5);
$pdf->SetFont('Arial', 'I', 8);
$pdf->Cell(0, 10, 'Notas posibles: E = Excelente, MB = Muy Bueno, B = Bueno, S = Satisfactorio, NS = No Satisfactorio.', 0, 1, 'L');





// Generar el PDF
$pdf->Output('I', 'reporte_calificaciones_horizontal.pdf');
?>
