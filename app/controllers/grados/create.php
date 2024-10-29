<?php

include ('../../../app/config.php');

$nivel_id = $_POST['nivel_id'];
$curso = $_POST['curso'];
$paralelo = $_POST['paralelo'];

$sentencia = $pdo->prepare('INSERT INTO grados
(nivel_id,curso,paralelo, fyh_creacion, estado)
VALUES ( :nivel_id,:curso,:paralelo,:fyh_creacion,:estado)');

$sentencia->bindParam(':nivel_id',$nivel_id);
$sentencia->bindParam(':curso',$curso);
$sentencia->bindParam(':paralelo',$paralelo);
$sentencia->bindParam('fyh_creacion',$fechaHora);
$sentencia->bindParam('estado',$estado_de_registro);

if($sentencia->execute()){
    echo 'success';
    session_start();
    $_SESSION['mensaje'] = "Se registró el grado de manera correcta.";
    $_SESSION['icono'] = "success";
    $_SESSION['timer'] = 6000;  // Duración del mensaje en milisegundos (6 segundos)
    $_SESSION['timerProgressBar'] = true;
    $_SESSION['showCloseButton'] = true; // Agregar la cruz de cierre
    header('Location:'.APP_URL."/admin/grados");
//header('Location:' .$URL.'/');
}else{
    echo 'Error al registrar grado!';
    session_start();
    $_SESSION['mensaje'] = "Error al registrar grado, comunicarse con el administrador";
    $_SESSION['icono'] = "warning";
    $_SESSION['timer'] = 6000;  // Duración del mensaje en milisegundos (6 segundos)
    $_SESSION['timerProgressBar'] = true;
    $_SESSION['showCloseButton'] = true; // Agregar la cruz de cierre
    ?><script>window.history.back();</script><?php
}