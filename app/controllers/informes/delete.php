<?php

include ('../../../app/config.php');

$id_informe = $_POST['id_informe'];


$sentencia = $pdo->prepare("DELETE FROM informes where id_informe=:id_informe ");

$sentencia->bindParam('id_informe',$id_informe);


if($sentencia->execute()){
    session_start();
    $_SESSION['mensaje'] = "Se eliminó el informe de manera correcta.";
    $_SESSION['icono'] = "success";
    $_SESSION['timer'] = 6000;  // Duración del mensaje en milisegundos (6 segundos)
    $_SESSION['timerProgressBar'] = true;
    $_SESSION['showCloseButton'] = true; // Agregar la cruz de cierre
    header('Location:'.APP_URL."/admin/informes");
}else{
    session_start();
    $_SESSION['mensaje'] = "Error al eliminar informe, comunicarse con el administrador";
    $_SESSION['icono'] = "warning";
    $_SESSION['timer'] = 6000;  // Duración del mensaje en milisegundos (6 segundos)
    $_SESSION['timerProgressBar'] = true;
    $_SESSION['showCloseButton'] = true; // Agregar la cruz de cierre
    ?><script>window.history.back();</script><?php
}