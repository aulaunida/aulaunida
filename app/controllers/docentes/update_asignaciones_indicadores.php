<?php

include ('../../../app/config.php');

$id_asignacion_indicadores = strtoupper($_POST['id_asignacion_indicadores']);
$id_nivel = strtoupper($_POST['id_nivel']);
$id_grado = strtoupper($_POST['id_grado']);
$id_indicador = strtoupper($_POST['id_indicador']);

/////////// ACTUALIZAR A LA TABLA ASIGNACIONES INDICADORES

$sentencia = $pdo->prepare('UPDATE asignaciones_indicadores
SET nivel_id=:nivel_id,
grado_id=:grado_id,
indicador_id=:indicador_id, 
fyh_actualizacion=:fyh_actualizacion
WHERE id_asignacion_indicadores=:id_asignacion_indicadores');

$sentencia->bindParam(':nivel_id',$id_nivel);
$sentencia->bindParam(':grado_id',$id_grado);
$sentencia->bindParam(':indicador_id',$id_indicador);
$sentencia->bindParam('fyh_actualizacion',$fechaHora);
$sentencia->bindParam('id_asignacion_indicadores',$id_asignacion_indicadores);


if($sentencia->execute()){
echo 'success';
session_start();
         $_SESSION['mensaje'] = "Se actualizó la asignación de manera correcta.";
         $_SESSION['icono'] = "success";
         $_SESSION['timer'] = 3000;  // Duración del mensaje en milisegundos 
         $_SESSION['timerProgressBar'] = true;
         $_SESSION['showCloseButton'] = true; // Agregar la cruz de cierre
         header('Location:'.APP_URL."/admin/docentes/asignacion_indicadores.php");
}else{
echo 'Error al asignar indicador';
session_start();
$_SESSION['mensaje'] = "Error al actualizar asignación, comunicarse con el administrador";
$_SESSION['icono'] = "error";
$_SESSION['timer'] = 3000;  // Duración del mensaje en milisegundos 
$_SESSION['timerProgressBar'] = true;
$_SESSION['showCloseButton'] = true; // Agregar la cruz de cierre
?><script>window.history.back();</script><?php
}