<?php

include ('../../../app/config.php');

$id_indicador = $_POST['id_indicador'];


$sentencia = $pdo->prepare("DELETE FROM indicadores where id_indicador=:id_indicador ");

$sentencia->bindParam('id_indicador',$id_indicador);

try{
    if($sentencia->execute()){
        session_start();
        $_SESSION['mensaje'] = "Se eliminó el indicador de manera correcta.";
        $_SESSION['icono'] = "success";
        $_SESSION['timer'] = 6000;  // Duración del mensaje en milisegundos (6 segundos)
        $_SESSION['timerProgressBar'] = true;
        $_SESSION['showCloseButton'] = true; // Agregar la cruz de cierre
        header('Location:'.APP_URL."/admin/indicadores");
    }else{
        echo 'Error al eliminar indicador!';
        session_start();
        $_SESSION['mensaje'] = "Error al eliminar indicador, comunicarse con el administrador";
        $_SESSION['icono'] = "warning";
        $_SESSION['timer'] = 6000;  // Duración del mensaje en milisegundos (6 segundos)
        $_SESSION['timerProgressBar'] = true;
        $_SESSION['showCloseButton'] = true; // Agregar la cruz de cierre
        ?><script>window.history.back();</script><?php
    }
}
catch (Exception $exception){
    session_start();
        $_SESSION['mensaje'] = "No es posible eliminar el indicador, tiene registros dependientes.";
        $_SESSION['icono'] = "warning";
        $_SESSION['timer'] = 6000;  // Duración del mensaje en milisegundos (6 segundos)
        $_SESSION['timerProgressBar'] = true;
        $_SESSION['showCloseButton'] = true; // Agregar la cruz de cierre
        ?><script>window.history.back();</script><?php
}



