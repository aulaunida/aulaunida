<?php

include ('../../../app/config.php');

$id_materia = $_POST['id_materia'];


$sentencia = $pdo->prepare("DELETE FROM materias where id_materia=:id_materia ");

$sentencia->bindParam('id_materia',$id_materia);

try{
    if($sentencia->execute()){
        session_start();
        $_SESSION['mensaje'] = "Se eliminó la materia de manera correcta.";
        $_SESSION['icono'] = "success";
        $_SESSION['timer'] = 6000;  // Duración del mensaje en milisegundos (6 segundos)
        $_SESSION['timerProgressBar'] = true;
        $_SESSION['showCloseButton'] = true; // Agregar la cruz de cierre
        header('Location:'.APP_URL."/admin/materias");
    }else{
        echo 'Error al eliminar materia!';
        session_start();
        $_SESSION['mensaje'] = "Error al eliminar materia, comunicarse con el administrador";
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



