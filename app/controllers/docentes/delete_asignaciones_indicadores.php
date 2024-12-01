<?php

include ('../../../app/config.php');

$id_asignacion_indicadores = $_POST['id_asignacion_indicadores'];

$sentencia = $pdo->prepare("DELETE FROM asignaciones_indicadores where id_asignacion_indicadores=:id_asignacion_indicadores ");

$sentencia->bindParam('id_asignacion_indicadores',$id_asignacion_indicadores);


if($sentencia->execute()){
    session_start();
    $_SESSION['mensaje'] = "Se eliminó la asignación de manera correcta.";
    $_SESSION['icono'] = "success";
    $_SESSION['timer'] = 6000;  // Duración del mensaje en milisegundos (6 segundos)
    $_SESSION['timerProgressBar'] = true;
    $_SESSION['showCloseButton'] = true; // Agregar la cruz de cierre
    header('Location:'.APP_URL."/admin/docentes/asignacion_indicadores.php");
}else{
    session_start();
    $_SESSION['mensaje'] = "Error al asignar indicador, comunicarse con el administrador";
    $_SESSION['icono'] = "warning";
    $_SESSION['timer'] = 6000;  // Duración del mensaje en milisegundos (6 segundos)
    $_SESSION['timerProgressBar'] = true;
    $_SESSION['showCloseButton'] = true; // Agregar la cruz de cierre
    ?><script>window.history.back();</script><?php
}