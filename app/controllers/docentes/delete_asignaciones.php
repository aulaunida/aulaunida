<?php

include ('../../../app/config.php');

$id_asignacion = $_POST['id_asignacion'];

$sentencia = $pdo->prepare("DELETE FROM asignaciones where id_asignacion=:id_asignacion ");

$sentencia->bindParam('id_asignacion',$id_asignacion);


if($sentencia->execute()){
    session_start();
    $_SESSION['mensaje'] = "Se eliminó la asignación de manera correcta.";
    $_SESSION['icono'] = "success";
    $_SESSION['timer'] = 6000;  // Duración del mensaje en milisegundos (6 segundos)
    $_SESSION['timerProgressBar'] = true;
    $_SESSION['showCloseButton'] = true; // Agregar la cruz de cierre
    header('Location:'.APP_URL."/admin/docentes/asignacion.php");
}else{
    session_start();
    $_SESSION['mensaje'] = "Error al asignar materia, comunicarse con el administrador";
    $_SESSION['icono'] = "warning";
    $_SESSION['timer'] = 6000;  // Duración del mensaje en milisegundos (6 segundos)
    $_SESSION['timerProgressBar'] = true;
    $_SESSION['showCloseButton'] = true; // Agregar la cruz de cierre
    ?><script>window.history.back();</script><?php
}