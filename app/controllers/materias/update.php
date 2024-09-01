<?php

include ('../../../app/config.php');

$id_materia = $_POST['id_materia'];
$nombre_materia = $_POST['nombre_materia'];

$sentencia = $pdo->prepare('UPDATE materias
SET nombre_materia=:nombre_materia, 
    fyh_actualizacion=:fyh_actualizacion
WHERE id_materia=:id_materia');


$sentencia->bindParam(':nombre_materia',$nombre_materia);
$sentencia->bindParam('fyh_actualizacion',$fechaHora);
$sentencia->bindParam('id_materia',$id_materia);

if($sentencia->execute()){
    echo 'success';
    session_start();
    $_SESSION['mensaje'] = "Materia actualizada de manera correcta en la base de datos";
    $_SESSION['icono'] = "success";
    $_SESSION['timer'] = 6000;  // Duración del mensaje en milisegundos (6 segundos)
    $_SESSION['timerProgressBar'] = true;
    $_SESSION['showCloseButton'] = true; // Agregar la cruz de cierre
    header('Location:'.APP_URL."/admin/materias");
//header('Location:' .$URL.'/');
}else{
    echo 'Error al registrar materia a la base de datos';
    session_start();
    $_SESSION['mensaje'] = "Error al actualizar materia en la base datos, comuníquese con el administrador";
    $_SESSION['icono'] = "warning";
    $_SESSION['timer'] = 6000;  // Duración del mensaje en milisegundos (6 segundos)
    $_SESSION['timerProgressBar'] = true;
    $_SESSION['showCloseButton'] = true; // Agregar la cruz de cierre
    ?><script>window.history.back();</script><?php
}