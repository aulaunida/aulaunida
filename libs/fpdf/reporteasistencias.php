<?php
require('fpdf.php');
require_once 'C:/wamp64/www/aulaunida/app/config.php';

// Función para traducir los estados de asistencia
function traducirAsistencia($estado) {
    $mapa_estados = [
        1 => 'P',  // Presente
        0 => 'A',  // Ausente
        '' => '-'   // Sin datos
    ];
    return $mapa_estados[$estado] ?? '-';
}

// Obtener parámetros de la consulta
$id_grado = $_GET['id_grado'] ?? null;
$id_docente = $_GET['id_docente'] ?? null;
$id_materia = $_GET['id_materia'] ?? null;
$mes = $_GET['mes'] ?? date('m'); // Por defecto, mes actual

// Configurar el idioma para mostrar el mes en español
$mes_intl = new IntlDateFormatter(
    'es_ES',                // Idioma y localización
    IntlDateFormatter::NONE, // Sin fecha completa
    IntlDateFormatter::NONE, // Sin tiempo
    null,                    // Sin zona horaria
    null,                    // Sin calendario especial
    'MMMM'                   // Formato: solo el nombre completo del mes
);

// Crear un objeto DateTime para el mes
$fecha = DateTime::createFromFormat('!m', $mes); // '!' asegura que solo se considera el mes
$nombre_mes = $mes_intl->format($fecha); // Obtener el nombre del mes en español

// Convertir a mayúsculas
$nombre_mes = mb_strtoupper($nombre_mes, 'UTF-8');


// Consulta SQL para las asistencias
$sql_asistencias = "SELECT 
    a.estudiante_id, 
    CONCAT(p.apellidos, ', ', p.nombres) AS estudiante, 
    m.nombre_materia AS materia, 
    DAY(a.fecha_asistencia) AS dia, 
    a.estado_asistencia
FROM 
    asistencias a
JOIN 
    estudiantes e ON a.estudiante_id = e.id_estudiante
JOIN 
    personas p ON e.persona_id = p.id_persona
JOIN 
    materias m ON a.materia_id = m.id_materia
WHERE 
    a.docente_id = :id_docente 
    AND a.materia_id = :id_materia 
    AND MONTH(a.fecha_asistencia) = :mes
ORDER BY 
    p.apellidos, p.nombres, a.fecha_asistencia";



    $query_asistencias = $pdo->prepare($sql_asistencias);
    $query_asistencias->execute([
        ':id_docente' => $id_docente,
        ':id_materia' => $id_materia,
        ':mes' => $mes
    ]);

    // Recuperar los datos
    $asistencias = $query_asistencias->fetchAll(PDO::FETCH_ASSOC);


// Organizar los datos por estudiante
$datos_organizados = [];
foreach ($asistencias as $asistencia) {
    $estudiante = $asistencia['estudiante'];
    $dia = $asistencia['dia'];
    $estado = traducirAsistencia($asistencia['estado_asistencia']);

    if (!isset($datos_organizados[$estudiante])) {
        $datos_organizados[$estudiante] = array_fill(1, 31, '-'); // Crear arreglo con todos los días vacíos
    }
    $datos_organizados[$estudiante][$dia] = $estado;
}

// Si no hay asistencias cargadas, llenar con "-"
foreach ($datos_organizados as $estudiante => $dias) {
    // Si el estudiante no tiene asistencias en algún día, completar con "-"
    foreach ($dias as $dia => $estado) {
        if ($estado === '-') {
            $datos_organizados[$estudiante][$dia] = '-'; // Asignar "-" para los días sin asistencia
        }
    }
}

// Clase personalizada para el PDF (no cambia)
class PDF extends FPDF {
    function Header() {
        $this->Image('logo_colegio.png', 10, 6, 30);
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 10, 'Instituto Primario Arturo Capdevila', 0, 1, 'C');
        $this->SetFont('Arial', '', 10);
        $this->Cell(0, 5, 'Reporte de Asistencias', 0, 1, 'C');
        $this->Ln(10);
    }

    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Instituto Primario Arturo Capdevila | Pagina ' . $this->PageNo(), 0, 0, 'C');
    }
}

// Crear el PDF
$pdf = new PDF('L', 'mm', 'A4');
$pdf->AddPage();
$pdf->SetFont('Arial', 'I', 9);
$pdf->Cell(0, 10, "Mes: $nombre_mes | Fecha: " . date('d/m/Y'), 0, 1, 'R');

// Encabezado de tabla
$pdf->SetFont('Arial', 'B', 8);
$pdf->SetFillColor(200, 220, 255);
$pdf->Cell(60, 10, 'Alumno', 1, 0, 'C', true);

// Reducimos el tamaño de las celdas de los días
for ($i = 1; $i <= 31; $i++) {
    $pdf->Cell(6, 10, $i, 1, 0, 'C', true); // Reducción del tamaño a 6mm
}
$pdf->Ln();

// Contenido de la tabla
$pdf->SetFont('Arial', '', 8);
$fill = false;
foreach ($datos_organizados as $estudiante => $dias) {
    $pdf->SetFillColor(240, 240, 240);
    $pdf->Cell(60, 10, mb_convert_encoding($estudiante, 'ISO-8859-1', 'UTF-8'), 1, 0, 'L', $fill);

    // Ajustar el contenido de los días
    foreach ($dias as $dia) {
        $pdf->Cell(6, 10, $dia, 1, 0, 'C', $fill); // Celdas más pequeñas para que quepan todos los días
    }
    $pdf->Ln();
    $fill = !$fill;
}

// Generar el PDF
$pdf->Output('I', 'reporte_asistencias.pdf');
