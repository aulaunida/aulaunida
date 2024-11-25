<?php
include('../../../app/config.php');

$id_docente = $_POST['id_docente'];
$id_materia = $_POST['id_materia'];
$fecha_asistencia = $_POST['fecha_asistencia'];
$asistencias = $_POST['asistencias'];

foreach ($asistencias as $asistencia) {
    $id_estudiante = $asistencia['id_estudiante'];
    $estado_asistencia = $asistencia['estado_asistencia'];

    $sql = "SELECT * FROM asistencias 
            WHERE docente_id = :docente_id AND estudiante_id = :estudiante_id 
            AND materia_id = :materia_id AND fecha_asistencia = :fecha_asistencia";
    $query = $pdo->prepare($sql);
    $query->execute([
        ':docente_id' => $id_docente,
        ':estudiante_id' => $id_estudiante,
        ':materia_id' => $id_materia,
        ':fecha_asistencia' => $fecha_asistencia
    ]);
    $existing = $query->fetch(PDO::FETCH_ASSOC);

    if ($existing) {
        $sql = "UPDATE asistencias SET estado_asistencia = :estado_asistencia, fyh_actualizacion = :fyh_actualizacion 
                WHERE id_asistencia = :id_asistencia";
        $query = $pdo->prepare($sql);
        $query->execute([
            ':estado_asistencia' => $estado_asistencia,
            ':fyh_actualizacion' => $fechaHora,
            ':id_asistencia' => $existing['id_asistencia']
        ]);
    } else {
        $sql = "INSERT INTO asistencias 
                (docente_id, estudiante_id, materia_id, estado_asistencia, fecha_asistencia, fyh_creacion, estado) 
                VALUES (:docente_id, :estudiante_id, :materia_id, :estado_asistencia, :fecha_asistencia, :fyh_creacion, 1)";
        $query = $pdo->prepare($sql);
        $query->execute([
            ':docente_id' => $id_docente,
            ':estudiante_id' => $id_estudiante,
            ':materia_id' => $id_materia,
            ':estado_asistencia' => $estado_asistencia,
            ':fecha_asistencia' => $fecha_asistencia,
            ':fyh_creacion' => $fechaHora
        ]);
    }
}

echo json_encode(['message' => 'Asistencias registradas correctamente.']);



