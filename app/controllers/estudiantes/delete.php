<?php

include ('../../../app/config.php');

$id_estudiante = $_POST['id_estudiante'];

$sentencia = $pdo->prepare("UPDATE estudiantes SET estado = :estado WHERE id_estudiante = :id_estudiante");

$estado = 0; // Estado 0 para deshabilitar

$sentencia->bindParam('estado', $estado);
$sentencia->bindParam('id_estudiante', $id_estudiante);

try {
    if($sentencia->execute()) {
        session_start();
        $_SESSION['mensaje'] = "Se eliminó el alumno de manera correcta.";
        $_SESSION['icono'] = "success";
        $_SESSION['timer'] = 6000;  // Duración del mensaje en milisegundos (6 segundos)
        $_SESSION['timerProgressBar'] = true;
        $_SESSION['showCloseButton'] = true; // Agregar la cruz de cierre
        header('Location:'.APP_URL."/admin/estudiantes");
    } else {
        echo 'Error al deshabilitar alumno!';
        session_start();
        $_SESSION['mensaje'] = "Error al eliminar alumno, comunicarse con el administrador.";
        $_SESSION['icono'] = "warning";
        $_SESSION['timer'] = 6000;  // Duración del mensaje en milisegundos (6 segundos)
        $_SESSION['timerProgressBar'] = true;
        $_SESSION['showCloseButton'] = true; // Agregar la cruz de cierre
        ?><script>window.history.back();</script><?php
    }
} catch (Exception $exception) {
    session_start();
    $_SESSION['mensaje'] = "No es posible eliminar alumno, tiene registros dependientes.";
    $_SESSION['icono'] = "warning";
    $_SESSION['timer'] = 6000;  // Duración del mensaje en milisegundos (6 segundos)
    $_SESSION['timerProgressBar'] = true;
    $_SESSION['showCloseButton'] = true; // Agregar la cruz de cierre
    ?><script>window.history.back();</script><?php
}




