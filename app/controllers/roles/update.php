<?php

include ('../../../app/config.php');

$id_rol = $_POST['id_rol'];
$nombre_rol = $_POST['nombre_rol'];
$nombre_rol = mb_strtoupper($nombre_rol,'UTF-8');

if($nombre_rol == ""){
    session_start();
    $_SESSION['mensaje'] = "Debe completar el campo con un nombre válido";
    $_SESSION['icono'] = "error";
    $_SESSION['timer'] = 3000;  // Duración del mensaje en milisegundos 
    $_SESSION['timerProgressBar'] = true;
    $_SESSION['showCloseButton'] = true; // Agregar la cruz de cierre
    header('Location:'.APP_URL."/admin/roles/edit.php?id=".$id_rol); // redireccionar
}else{
    $sentencia = $pdo->prepare("UPDATE roles 
    SET nombre_rol=:nombre_rol,
        fyh_actualizacion=:fyh_actualizacion
    WHERE id_rol=:id_rol ");

$sentencia->bindParam('nombre_rol',$nombre_rol);
$sentencia->bindParam('fyh_actualizacion',$fechaHora);
$sentencia->bindParam('id_rol',$id_rol);

try{
  if($sentencia->execute()){ 
  session_start();
  $_SESSION['mensaje'] = "Se actualizó el rol de manera correcta";
  $_SESSION['icono'] = "success";
  $_SESSION['timer'] = 3000;  // Duración del mensaje en milisegundos 
  $_SESSION['timerProgressBar'] = true;
  $_SESSION['showCloseButton'] = true; // Agregar la cruz de cierre
  header('Location:'.APP_URL."/admin/roles"); // redireccionar
}else{
  session_start();
      $_SESSION['mensaje'] = "Error, no se pudo actualizar el rol. Comunicarse con el administrador";
      $_SESSION['icono'] = "error";
      $_SESSION['timer'] = 3000;  // Duración del mensaje en milisegundos
      $_SESSION['timerProgressBar'] = true;
      $_SESSION['showCloseButton'] = true; // Agregar la cruz de cierre
      header('Location:'.APP_URL."/admin/roles/edit.php?id=".$id_rol); // redireccionar
}
}catch(Exception $exception) {
  session_start();
  $_SESSION['mensaje'] = "Error, este rol ya existe";
  $_SESSION['icono'] = "error";
  $_SESSION['timer'] = 3000;  // Duración del mensaje en milisegundos 
  $_SESSION['timerProgressBar'] = true;
  $_SESSION['showCloseButton'] = true; // Agregar la cruz de cierre
  header('Location:'.APP_URL."/admin/roles/edit.php?id=".$id_rol); // redireccionar

}
}


