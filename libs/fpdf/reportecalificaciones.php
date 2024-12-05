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
    return $mapa_notas[$nota] ?? '-'; // Cuando no haya nota cargada
}

// Recoger los parámetros de la URL
$id_grado = $_GET['id_grado'] ?? null;
$id_docente = $_GET['id_docente'] ?? null;
$id_materia = $_GET['id_materia'] ?? null;

// Verificar que los parámetros no sean nulos
if (!$id_grado || !$id_docente || !$id_materia) {
    die("Faltan parámetros necesarios para generar el reporte.");
}

$sql_calificaciones = "SELECT 
    c.id_calificacion, 
    c.estudiante_id, 
    c.materia_id, 
    CONCAT(p.apellidos, ', ', p.nombres) AS estudiante, 
    m.nombre_materia AS materia, 
    g.curso AS grado, 
    g.paralelo AS division, 
    c.nota1, c.nota2, c.nota3, c.nota4, c.nota5, 
    c.nota6, c.nota7, c.nota8, c.nota9, c.nota10
FROM 
    calificaciones c
JOIN 
    estudiantes e ON c.estudiante_id = e.id_estudiante
JOIN 
    personas p ON e.persona_id = p.id_persona
JOIN 
    grados g ON e.grado_id = g.id_grado
JOIN 
    materias m ON c.materia_id = m.id_materia
WHERE 
    c.estado = '1'
    AND g.id_grado = :id_grado
    AND c.docente_id = :id_docente
    AND c.materia_id = :id_materia
ORDER BY 
    p.apellidos, p.nombres";

$query_calificaciones = $pdo->prepare($sql_calificaciones);
$query_calificaciones->execute([
    ':id_grado' => $id_grado,
    ':id_docente' => $id_docente,
    ':id_materia' => $id_materia,
]);
$calificaciones = $query_calificaciones->fetchAll(PDO::FETCH_ASSOC);

// Clase personalizada para el PDF
class PDF extends FPDF {
    public $grado;
    public $division;
    public $nombreMateria;

    public function __construct($orientation = 'L', $unit = 'mm', $size = 'A4') {
        parent::__construct($orientation, $unit, $size);
    }

    function Header() {
        $this->Image('logo_colegio.png', 10, 6, 30);
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 10, 'Instituto Primario Arturo Capdevila', 0, 1, 'C');
        $this->SetFont('Arial', '', 10);
        $this->Cell(0, 5, 'Reporte de Calificaciones', 0, 1, 'C');
        $this->Ln(10);
    }

    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Instituto Primario Arturo Capdevila | Pagina ' . $this->PageNo(), 0, 0, 'C');
    }
}

// Crear el PDF
$pdf = new PDF();
$pdf->grado = $id_grado ?: 'Sin grado';
$pdf->division = '-';
$pdf->nombreMateria = 'Sin materia';
$pdf->AddPage();

$pdf->SetFont('Arial', '', 8);

// Fecha
$pdf->SetFont('Arial', 'I', 9);
$pdf->Cell(0, 10, 'Fecha: ' . date('d/m/Y'), 0, 1, 'R');

// Verificar si hay calificaciones
if (count($calificaciones) > 0) {
    // Encabezado de tabla
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->SetFillColor(200, 220, 255);
    $pdf->Cell(60, 10, 'Alumno', 1, 0, 'C', true);
    $pdf->Cell(40, 10, 'Materia', 1, 0, 'C', true);
    for ($i = 1; $i <= 10; $i++) {
        $titulo = ($i == 5 || $i == 10) ? "Final" : "Nota $i";
        $pdf->Cell(15, 10, $titulo, 1, 0, 'C', true);
    }
    $pdf->Ln();

    // Contenido de la tabla
    $pdf->SetFont('Arial', '', 8);
    $fill = false;
    foreach ($calificaciones as $calificacion) {
        $pdf->SetFillColor(240, 240, 240);
        $pdf->Cell(60, 10, mb_convert_encoding($calificacion['estudiante'], 'ISO-8859-1', 'UTF-8'), 1, 0, 'L', $fill);
        $pdf->Cell(40, 10, mb_convert_encoding($calificacion['materia'], 'ISO-8859-1', 'UTF-8'), 1, 0, 'C', $fill);
        for ($i = 1; $i <= 10; $i++) {
            $nota = traducirNota($calificacion["nota$i"]);
            $pdf->Cell(15, 10, $nota, 1, 0, 'C', $fill);
        }
        $pdf->Ln();
        $fill = !$fill;
    }
} else {
    // Mensaje si no hay datos
    $pdf->Ln(20);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 10, 'No se encontraron calificaciones para los filtros aplicados.', 0, 1, 'C');
}

// Generar el PDF
$pdf->Output('I', 'reporte_calificaciones.pdf');
