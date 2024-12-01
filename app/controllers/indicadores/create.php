<?php

include ('../../../app/config.php');

$nombre_indicador = strtoupper($_POST['nombre_indicador']);

$sentencia = $pdo->prepare('INSERT INTO indicadores
(nombre_indicador, fyh_creacion, estado)
VALUES ( :nombre_indicador,:fyh_creacion,:estado)');


$sentencia->bindParam(':nombre_indicador',$nombre_indicador);
$sentencia->bindParam('fyh_creacion',$fechaHora);
$sentencia->bindParam('estado',$estado_de_registro);

if($sentencia->execute()){
    echo 'success';
    session_start();
    $_SESSION['mensaje'] = "Se registró el indicador de manera correcta.";
    $_SESSION['icono'] = "success";
    $_SESSION['timer'] = 6000;  // Duración del mensaje en milisegundos (6 segundos)
    $_SESSION['timerProgressBar'] = true;
    $_SESSION['showCloseButton'] = true; // Agregar la cruz de cierre
    header('Location:'.APP_URL."/admin/indicadores");
//header('Location:' .$URL.'/');
}else{
    echo 'Error al registrar indicador!';
    session_start();
    $_SESSION['mensaje'] = "Error al registrar indicador, comunicarse con el administrador";
    $_SESSION['icono'] = "warning";
    $_SESSION['timer'] = 6000;  // Duración del mensaje en milisegundos (6 segundos)
    $_SESSION['timerProgressBar'] = true;
    $_SESSION['showCloseButton'] = true; // Agregar la cruz de cierre
    ?><script>window.history.back();</script><?php
}