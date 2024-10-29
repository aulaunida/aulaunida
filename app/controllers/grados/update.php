<?php

include ('../../../app/config.php');

$id_grado = $_POST['id_grado'];
$nivel_id = $_POST['nivel_id'];
$curso = $_POST['curso'];
$paralelo = $_POST['paralelo'];

$sentencia = $pdo->prepare('UPDATE grados
SET nivel_id=:nivel_id,
    curso=:curso,
    paralelo=:paralelo, 
    fyh_actualizacion=:fyh_actualizacion
WHERE id_grado=:id_grado');

$sentencia->bindParam(':nivel_id',$nivel_id);
$sentencia->bindParam(':curso',$curso);
$sentencia->bindParam(':paralelo',$paralelo);
$sentencia->bindParam('fyh_actualizacion',$fechaHora);
$sentencia->bindParam('id_grado',$id_grado);

if($sentencia->execute()){
    echo 'success';
    session_start();
    $_SESSION['mensaje'] = "Se actualizó el grado de manera correcta.";
    $_SESSION['icono'] = "success";
    $_SESSION['timer'] = 6000;  // Duración del mensaje en milisegundos (6 segundos)
    $_SESSION['timerProgressBar'] = true;
    $_SESSION['showCloseButton'] = true; // Agregar la cruz de cierre
    header('Location:'.APP_URL."/admin/grados");
//header('Location:' .$URL.'/');
}else{
    echo 'Error al actualizar grado!';
    session_start();
    $_SESSION['mensaje'] = "Error al actualizar grado, comunicarse con el administrador";
    $_SESSION['icono'] = "warning";
    $_SESSION['timer'] = 6000;  // Duración del mensaje en milisegundos (6 segundos)
    $_SESSION['timerProgressBar'] = true;
    $_SESSION['showCloseButton'] = true; // Agregar la cruz de cierre
    ?><script>window.history.back();</script><?php
}
