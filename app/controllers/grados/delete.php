<?php

include ('../../../app/config.php');

$id_grado = $_POST['id_grado'];


$sentencia = $pdo->prepare("DELETE FROM grados where id_grado=:id_grado ");

$sentencia->bindParam('id_grado',$id_grado);

try{
    if($sentencia->execute()){
        session_start();
        $_SESSION['mensaje'] = "Se eliminó el grado de manera correcta.";
        $_SESSION['icono'] = "success";
        $_SESSION['timer'] = 6000;  // Duración del mensaje en milisegundos (6 segundos)
        $_SESSION['timerProgressBar'] = true;
        $_SESSION['showCloseButton'] = true; // Agregar la cruz de cierre
        header('Location:'.APP_URL."/admin/grados");
    }else{
        echo 'Error al eliminar grado!';
        session_start();
        $_SESSION['mensaje'] = "Error al eliminar grado, comunicarse con el administrador";
        $_SESSION['icono'] = "warning";
        $_SESSION['timer'] = 6000;  // Duración del mensaje en milisegundos (6 segundos)
        $_SESSION['timerProgressBar'] = true;
        $_SESSION['showCloseButton'] = true; // Agregar la cruz de cierre
        ?><script>window.history.back();</script><?php
    }
}
catch (Exception $exception){
    session_start();
        $_SESSION['mensaje'] = "No es posible eliminar el grado, tiene registros dependientes.";
        $_SESSION['icono'] = "warning";
        $_SESSION['timer'] = 6000;  // Duración del mensaje en milisegundos (6 segundos)
        $_SESSION['timerProgressBar'] = true;
        $_SESSION['showCloseButton'] = true; // Agregar la cruz de cierre
        ?><script>window.history.back();</script><?php
}


