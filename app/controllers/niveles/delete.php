<?php

include ('../../../app/config.php');

$id_nivel = $_POST['id_nivel'];


$sentencia = $pdo->prepare("DELETE FROM niveles where id_nivel=:id_nivel ");

$sentencia->bindParam('id_nivel',$id_nivel);


if($sentencia->execute()){
    session_start();
    $_SESSION['mensaje'] = "Se eliminó el ciclo lectivo de manera correcta.";
    $_SESSION['icono'] = "success";
    $_SESSION['timer'] = 6000;  // Duración del mensaje en milisegundos (6 segundos)
    $_SESSION['timerProgressBar'] = true;
    $_SESSION['showCloseButton'] = true; // Agregar la cruz de cierre
    header('Location:'.APP_URL."/admin/niveles");
}else{
    echo 'Error al eliminar ciclo lectivo!';
    session_start();
    $_SESSION['mensaje'] = "Error al eliminar ciclo lectivo, comunicarse con el administrador";
    $_SESSION['icono'] = "warning";
    $_SESSION['timer'] = 6000;  // Duración del mensaje en milisegundos (6 segundos)
    $_SESSION['timerProgressBar'] = true;
    $_SESSION['showCloseButton'] = true; // Agregar la cruz de cierre
    ?><script>window.history.back();</script><?php
}
