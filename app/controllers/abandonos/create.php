<?php

include('../../../app/config.php');

$id_docente = $_GET['id_docente'];
$id_estudiante = $_GET['id_estudiante'];
$id_indicador = $_GET['id_indicador'];
$abandono = $_GET['abandono'];
$motivo = $_GET['motivo'];


////////////////////////NOTA 1

$sql = "SELECT * FROM abandonos WHERE docente_id = '$id_docente' and estudiante_id = '$id_estudiante' and indicador_id = '$id_indicador'";
$query = $pdo->prepare($sql);
$query->execute();
$abandonos = $query->fetchAll(PDO::FETCH_ASSOC);
foreach($abandonos as $abando){
$id_abandono = $abando['id_abandono'];
}
if ($abandonos) {
    echo "si existe registro";

    $sentencia = $pdo->prepare('UPDATE abandonos
        SET abandono=:abandono, motivo=:motivo,fyh_actualizacion=:fyh_actualizacion WHERE id_abandono =:id_abandono');

    $sentencia->bindParam(':abandono', $abandono);
    $sentencia->bindParam(':motivo', $motivo);
    $sentencia->bindParam('fyh_actualizacion', $fechaHora);
    $sentencia->bindParam('id_abandono', $id_abandono);
    $sentencia->execute();

} else {
    echo "no existe registro";

    $sentencia = $pdo->prepare('INSERT INTO abandonos
        (docente_id,estudiante_id,indicador_id,abandono,motivo,fyh_creacion, estado)
VALUES ( :docente_id,:estudiante_id,:indicador_id,:abandono,:motivo,:fyh_creacion,:estado)');

    $sentencia->bindParam(':docente_id', $id_docente);
    $sentencia->bindParam(':estudiante_id', $id_estudiante);
    $sentencia->bindParam(':indicador_id', $id_indicador);
    $sentencia->bindParam(':abandono', $abandono);
    $sentencia->bindParam(':motivo', $motivo);
    $sentencia->bindParam('fyh_creacion', $fechaHora);
    $sentencia->bindParam('estado', $estado_de_registro);
    $sentencia->execute();
}
///////////////////////


