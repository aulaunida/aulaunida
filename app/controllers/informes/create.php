<?php

include ('../../../app/config.php');

$docente_id = $_POST['docente_id'];
$fecha_informe = $_POST['fecha_informe'];
$estudiante_id = $_POST['estudiante_id'];
$materia_id = $_POST['materia_id'];
$observacion = $_POST['observacion'];
$nota = $_POST['nota'];

$sentencia = $pdo->prepare('INSERT INTO informes
(docente_id,estudiante_id,materia_id,fecha_informe,observacion,nota, fyh_creacion, estado)
VALUES (:docente_id,:estudiante_id,:materia_id,:fecha_informe,:observacion,:nota, :fyh_creacion, :estado)');


$sentencia->bindParam(':docente_id',$docente_id);
$sentencia->bindParam(':estudiante_id',$estudiante_id);
$sentencia->bindParam(':materia_id',$materia_id);
$sentencia->bindParam(':fecha_informe',$fecha_informe);
$sentencia->bindParam(':observacion',$observacion);
$sentencia->bindParam(':nota',$nota);
$sentencia->bindParam('fyh_creacion',$fechaHora);
$sentencia->bindParam('estado',$estado_de_registro);

if($sentencia->execute()){
    echo 'success';
    session_start();
    $_SESSION['mensaje'] = "Se registró el informe de manera correcta.";
    $_SESSION['icono'] = "success";
    $_SESSION['timer'] = 6000;  // Duración del mensaje en milisegundos (6 segundos)
    $_SESSION['timerProgressBar'] = true;
    $_SESSION['showCloseButton'] = true; // Agregar la cruz de cierre
    header('Location:'.APP_URL."/admin/informes");
//header('Location:' .$URL.'/');
}else{
    echo 'Error al registrar informe a la base de datos';
    session_start();
    $_SESSION['mensaje'] = "Error al registrar informe, comunicarse con el administrador";
    $_SESSION['icono'] = "warning";
    $_SESSION['timer'] = 6000;  // Duración del mensaje en milisegundos (6 segundos)
    $_SESSION['timerProgressBar'] = true;
    $_SESSION['showCloseButton'] = true; // Agregar la cruz de cierre
    ?><script>window.history.back();</script><?php
}