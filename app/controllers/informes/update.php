<?php

include ('../../../app/config.php');

$id_informe = $_POST['id_informe'];
$docente_id = $_POST['docente_id'];
$estudiante_id = $_POST['estudiante_id'];
$materia_id = $_POST['materia_id'];
$fecha_informe = $_POST['fecha_informe'];
$observacion = $_POST['observacion'];
$nota = $_POST['nota'];

$sentencia = $pdo->prepare('UPDATE informes
SET docente_id=:docente_id, 
    estudiante_id=:estudiante_id,
    materia_id=:materia_id,
    fecha_informe=:fecha_informe,
    observacion=:observacion,
    nota=:nota,
    fyh_actualizacion=:fyh_actualizacion
WHERE id_informe=:id_informe');

$sentencia->bindParam(':docente_id',$docente_id);
$sentencia->bindParam(':estudiante_id',$estudiante_id);
$sentencia->bindParam(':materia_id',$materia_id);
$sentencia->bindParam(':fecha_informe',$fecha_informe);
$sentencia->bindParam(':observacion',$observacion);
$sentencia->bindParam(':nota',$nota);
$sentencia->bindParam('fyh_actualizacion',$fechaHora);
$sentencia->bindParam('id_informe',$id_informe);

if($sentencia->execute()){
    echo 'success';
    session_start();
    $_SESSION['mensaje'] = "Se actualizó el informe de manera correcta.";
    $_SESSION['icono'] = "success";
    $_SESSION['timer'] = 6000;  // Duración del mensaje en milisegundos (6 segundos)
    $_SESSION['timerProgressBar'] = true;
    $_SESSION['showCloseButton'] = true; // Agregar la cruz de cierre
    header('Location:'.APP_URL."/admin/informes");
//header('Location:' .$URL.'/');
}else{
    echo 'Error al registrar materia a la base de datos';
    session_start();
    $_SESSION['mensaje'] = "Error al actualizar informe, comunicarse con el administrador";
    $_SESSION['icono'] = "warning";
    $_SESSION['timer'] = 6000;  // Duración del mensaje en milisegundos (6 segundos)
    $_SESSION['timerProgressBar'] = true;
    $_SESSION['showCloseButton'] = true; // Agregar la cruz de cierre
    ?><script>window.history.back();</script><?php
}