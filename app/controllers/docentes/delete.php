<?php

include ('../../../app/config.php');

$id_docente = $_POST['id_docente'];


$sentencia = $pdo->prepare("DELETE FROM docentes where id_docente=:id_docente ");

$sentencia->bindParam('id_docente',$id_docente);


if($sentencia->execute()){
    session_start();
    $_SESSION['mensaje'] = "Se eliminó el docente de manera correcta.";
    $_SESSION['icono'] = "success";
    $_SESSION['timer'] = 6000;  // Duración del mensaje en milisegundos (6 segundos)
    $_SESSION['timerProgressBar'] = true;
    $_SESSION['showCloseButton'] = true; // Agregar la cruz de cierre
    header('Location:'.APP_URL."/admin/docentes");
}else{
    echo 'Error al eliminar materia!';
    session_start();
    $_SESSION['mensaje'] = "Error al eliminar docente, comunicarse con el administrador";
    $_SESSION['icono'] = "warning";
    $_SESSION['timer'] = 6000;  // Duración del mensaje en milisegundos (6 segundos)
    $_SESSION['timerProgressBar'] = true;
    $_SESSION['showCloseButton'] = true; // Agregar la cruz de cierre
    ?><script>window.history.back();</script><?php
}
