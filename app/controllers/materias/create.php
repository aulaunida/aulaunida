<?php

include ('../../../app/config.php');

$nombre_materia = strtoupper($_POST['nombre_materia']);

$sentencia = $pdo->prepare('INSERT INTO materias
(nombre_materia, fyh_creacion, estado)
VALUES ( :nombre_materia,:fyh_creacion,:estado)');


$sentencia->bindParam(':nombre_materia',$nombre_materia);
$sentencia->bindParam('fyh_creacion',$fechaHora);
$sentencia->bindParam('estado',$estado_de_registro);

if($sentencia->execute()){
    echo 'success';
    session_start();
    $_SESSION['mensaje'] = "Se registró la materia de manera correcta.";
    $_SESSION['icono'] = "success";
    $_SESSION['timer'] = 6000;  // Duración del mensaje en milisegundos (6 segundos)
    $_SESSION['timerProgressBar'] = true;
    $_SESSION['showCloseButton'] = true; // Agregar la cruz de cierre
    header('Location:'.APP_URL."/admin/materias");
//header('Location:' .$URL.'/');
}else{
    echo 'Error al registrar materia!';
    session_start();
    $_SESSION['mensaje'] = "Error al registrar materia, comunicarse con el administrador";
    $_SESSION['icono'] = "warning";
    $_SESSION['timer'] = 6000;  // Duración del mensaje en milisegundos (6 segundos)
    $_SESSION['timerProgressBar'] = true;
    $_SESSION['showCloseButton'] = true; // Agregar la cruz de cierre
    ?><script>window.history.back();</script><?php
}