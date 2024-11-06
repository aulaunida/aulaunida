<?php

include ('../../../app/config.php');

$id_usuario = $_POST['id_usuario'];

$sentencia = $pdo->prepare("UPDATE usuarios SET estado = :estado WHERE id_usuario = :id_usuario");

$estado = 0; // Estado 0 para deshabilitar

$sentencia->bindParam('estado', $estado);
$sentencia->bindParam('id_usuario', $id_usuario);

try{
    if($sentencia->execute()){
        session_start();
        $_SESSION['mensaje'] = "Se eliminó el usuario de manera correcta.";
        $_SESSION['icono'] = "success";
        $_SESSION['timer'] = 6000;  // Duración del mensaje en milisegundos (6 segundos)
        $_SESSION['timerProgressBar'] = true;
        $_SESSION['showCloseButton'] = true; // Agregar la cruz de cierre
        header('Location:'.APP_URL."/admin/usuarios");
    }else{
        session_start();
        $_SESSION['mensaje'] = "Error al eliminar usuario, comunicarse con el administrador.";
        $_SESSION['icono'] = "warning";
        $_SESSION['timer'] = 6000;  // Duración del mensaje en milisegundos (6 segundos)
        $_SESSION['timerProgressBar'] = true;
        $_SESSION['showCloseButton'] = true; // Agregar la cruz de cierre
        header('Location:'.APP_URL."/admin/usuarios");
    }
} catch (Exception $exception){
    session_start();
    $_SESSION['mensaje'] = "No es posible eliminar el usuario, tiene registros dependientes.";
    $_SESSION['icono'] = "warning";
    $_SESSION['timer'] = 6000;  // Duración del mensaje en milisegundos (6 segundos)
    $_SESSION['timerProgressBar'] = true;
    $_SESSION['showCloseButton'] = true; // Agregar la cruz de cierre
    ?><script>window.history.back();</script><?php
}







