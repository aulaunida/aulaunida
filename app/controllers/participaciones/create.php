<?php

include('../../../app/config.php');

$id_docente = $_GET['id_docente'];
$id_estudiante = $_GET['id_estudiante'];
$id_indicador = $_GET['id_indicador'];
$nota1 = $_GET['nota1'];
$nota2 = $_GET['nota2'];
$nota3 = $_GET['nota3'];

$sql = "SELECT * FROM participaciones WHERE docente_id = '$id_docente' and estudiante_id = '$id_estudiante' and indicador_id = '$id_indicador'";
$query = $pdo->prepare($sql);
$query->execute();
$notas = $query->fetchAll(PDO::FETCH_ASSOC);
foreach($notas as $nota){
$id_participacion = $nota['id_participacion'];
}
if ($notas) {
    echo "si existe registro";

    $sentencia = $pdo->prepare('UPDATE participaciones
        SET nota1=:nota1, nota2=:nota2, nota3=:nota3,fyh_actualizacion=:fyh_actualizacion WHERE id_participacion =:id_participacion');

    $sentencia->bindParam(':nota1', $nota1);
    $sentencia->bindParam(':nota2', $nota2);
    $sentencia->bindParam(':nota3', $nota3);
    $sentencia->bindParam('fyh_actualizacion', $fechaHora);
    $sentencia->bindParam('id_participacion', $id_participacion);
    $sentencia->execute();

} else {
    echo "no existe registro";

    $sentencia = $pdo->prepare('INSERT INTO participaciones
        (docente_id,estudiante_id,indicador_id,nota1,nota2,nota3,fyh_creacion,estado)
VALUES ( :docente_id,:estudiante_id,:indicador_id,:nota1,:nota2,:nota3,:fyh_creacion,:estado)');

    $sentencia->bindParam(':docente_id', $id_docente);
    $sentencia->bindParam(':estudiante_id', $id_estudiante);
    $sentencia->bindParam(':indicador_id', $id_indicador);
    $sentencia->bindParam(':nota1', $nota1);
    $sentencia->bindParam(':nota2', $nota2);
    $sentencia->bindParam(':nota3', $nota3);
    $sentencia->bindParam('fyh_creacion', $fechaHora);
    $sentencia->bindParam('estado', $estado_de_registro);
    $sentencia->execute();
}
///////////////////////


