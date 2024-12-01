<?php

include ('../../../app/config.php');

$id_indicador = $_POST['id_indicador'];
$nombre_indicador = strtoupper($_POST['nombre_indicador']);

$sentencia = $pdo->prepare('UPDATE indicadores
SET nombre_indicador=:nombre_indicador, 
    fyh_actualizacion=:fyh_actualizacion
WHERE id_indicador=:id_indicador');


$sentencia->bindParam(':nombre_indicador',$nombre_indicador);
$sentencia->bindParam('fyh_actualizacion',$fechaHora);
$sentencia->bindParam('id_indicador',$id_indicador);

if($sentencia->execute()){
    echo 'success';
    session_start();
    $_SESSION['mensaje'] = "Se actualizó el indicador de manera correcta.";
    $_SESSION['icono'] = "success";
    $_SESSION['timer'] = 6000;  // Duración del mensaje en milisegundos (6 segundos)
    $_SESSION['timerProgressBar'] = true;
    $_SESSION['showCloseButton'] = true; // Agregar la cruz de cierre
    header('Location:'.APP_URL."/admin/indicadores");
//header('Location:' .$URL.'/');
}else{
    echo 'Error al actualizar indicador';
    session_start();
    $_SESSION['mensaje'] = "Error al actualizar indicador, comunicarse con el administrador";
    $_SESSION['icono'] = "warning";
    $_SESSION['timer'] = 6000;  // Duración del mensaje en milisegundos (6 segundos)
    $_SESSION['timerProgressBar'] = true;
    $_SESSION['showCloseButton'] = true; // Agregar la cruz de cierre
    ?><script>window.history.back();</script><?php
}