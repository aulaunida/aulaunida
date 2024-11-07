<?php

include ('../../../../app/config.php');

$id_gestion = $_POST['id_gestion'];


$sentencia = $pdo->prepare("DELETE FROM gestiones where id_gestion=:id_gestion ");

$sentencia->bindParam('id_gestion',$id_gestion);

try{
    if($sentencia->execute()){
        session_start();
        $_SESSION['mensaje'] = "Se eliminó el ciclo lectivo de manera correcta.";
        $_SESSION['icono'] = "success";
        $_SESSION['timer'] = 6000;  // Duración del mensaje en milisegundos (6 segundos)
        $_SESSION['timerProgressBar'] = true;
        $_SESSION['showCloseButton'] = true; // Agregar la cruz de cierre
        header('Location:'.APP_URL."/admin/configuraciones/gestion");
    }else{
        session_start();
        $_SESSION['mensaje'] = "Error al eliminar ciclo lectivo, comunicarse con el administrador";
        $_SESSION['icono'] = "warning";
        $_SESSION['timer'] = 6000;  // Duración del mensaje en milisegundos (6 segundos)
        $_SESSION['timerProgressBar'] = true;
        $_SESSION['showCloseButton'] = true; // Agregar la cruz de cierre
        ?><script>window.history.back();</script><?php
    }
}
catch (Exception $exception){
    session_start();
        $_SESSION['mensaje'] = "No es posible eliminar la materia, tiene registros dependientes.";
        $_SESSION['icono'] = "warning";
        $_SESSION['timer'] = 6000;  // Duración del mensaje en milisegundos (6 segundos)
        $_SESSION['timerProgressBar'] = true;
        $_SESSION['showCloseButton'] = true; // Agregar la cruz de cierre
        ?><script>window.history.back();</script><?php
}
