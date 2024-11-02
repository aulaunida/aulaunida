<?php

include('../../../app/config.php');

$id_docente = $_GET['id_docente'];
$id_estudiante = $_GET['id_estudiante'];
$id_materia = $_GET['id_materia'];
$estado_asistencia = $_GET['estado_asistencia'];
// $fecha_asistencia = $_GET['fecha_asistencia'];


$sql = "SELECT * FROM asistencias WHERE docente_id = '$id_docente' and estudiante_id = '$id_estudiante' and materia_id = '$id_materia'";
$query = $pdo->prepare($sql);
$query->execute();
$asistencias = $query->fetchAll(PDO::FETCH_ASSOC);
foreach($asistencias as $asistencia){
$id_asistencia = $asistencia['id_asistencia'];
}
if ($asistencias) {
    echo "si existe registro";

    $sentencia = $pdo->prepare('UPDATE asistencias
        SET estado_asistencia=:estado_asistencia,fecha_asistencia=:fecha_asistencia, fyh_actualizacion=:fyh_actualizacion WHERE id_asistencia =:id_asistencia');

    $sentencia->bindParam(':estado_asistencia', $estado_asistencia);
    $sentencia->bindParam(':fecha_asistencia', $fechaHora);
    $sentencia->bindParam('fyh_actualizacion', $fechaHora);
    $sentencia->bindParam('id_asistencia', $id_asistencia);
    $sentencia->execute();

} else {
    echo "no existe registro";

    $sentencia = $pdo->prepare('INSERT INTO asistencias
        (docente_id,estudiante_id,materia_id,estado_asistencia,fecha_asistencia,fyh_creacion, estado)
VALUES ( :docente_id,:estudiante_id,:materia_id,:estado_asistencia,:fecha_asistencia,:fyh_creacion,:estado)');

    $sentencia->bindParam(':docente_id', $id_docente);
    $sentencia->bindParam(':estudiante_id', $id_estudiante);
    $sentencia->bindParam(':materia_id', $id_materia);
    $sentencia->bindParam(':estado_asistencia', $estado_asistencia);
    $sentencia->bindParam(':fecha_asistencia', $fechaHora);
    $sentencia->bindParam('fyh_creacion', $fechaHora);
    $sentencia->bindParam('estado', $estado_de_registro);
    $sentencia->execute();
}
///////////////////////


