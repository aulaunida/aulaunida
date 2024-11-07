<?php


include ('../../../app/config.php');

$nombre_rol = $_POST['nombre_rol'];
$nombre_rol = mb_strtoupper($nombre_rol,'UTF-8'); // Para convertir el nombre del rol en mayúscula

if($nombre_rol == ""){
    session_start();
    $_SESSION['mensaje'] = "Debe completar el campo con un nombre válido";
    $_SESSION['icono'] = "error";
    $_SESSION['timer'] = 3000;  // Duración del mensaje en milisegundos 
    $_SESSION['timerProgressBar'] = true;
    $_SESSION['showCloseButton'] = false; // Agregar la cruz de cierre
    header('Location:'.APP_URL."/admin/roles/create.php"); // redireccionar
}else{
  $sentencia = $pdo->prepare( "INSERT INTO roles
        ( nombre_rol, fyh_creacion, estado) 
VALUES  (:nombre_rol,:fyh_creacion,:estado)");

$sentencia->bindParam('nombre_rol', $nombre_rol);
$sentencia->bindParam('fyh_creacion', $fechaHora);
$sentencia->bindParam('estado', $estado_de_registro);

try{
    if($sentencia->execute()){ 
    session_start();
    $_SESSION['mensaje'] = "Se registró el rol de manera correcta";
    $_SESSION['icono'] = "success";
    $_SESSION['timer'] = 3000;  // Duración del mensaje en milisegundos 
    $_SESSION['timerProgressBar'] = true;
    $_SESSION['showCloseButton'] = true; // Agregar la cruz de cierre
    header('Location:'.APP_URL."/admin/roles"); // redireccionar
  }else{
    session_start();
        $_SESSION['mensaje'] = "Error al registrar rol, comunicarse con el administrador";
        $_SESSION['icono'] = "error";
        $_SESSION['timer'] = 3000;  // Duración del mensaje en milisegundos
        $_SESSION['timerProgressBar'] = true;
        $_SESSION['showCloseButton'] = false; // Agregar la cruz de cierre
        header('Location:'.APP_URL."/admin/roles/create.php"); // redireccionar
  }
}catch(Exception $exception) {
    session_start();
    $_SESSION['mensaje'] = "El nombre de rol ya existe";
    $_SESSION['icono'] = "error";
    $_SESSION['timer'] = 3000;  // Duración del mensaje en milisegundos 
    $_SESSION['timerProgressBar'] = true;
    $_SESSION['showCloseButton'] = true; // Agregar la cruz de cierre
        header('Location:'.APP_URL."/admin/roles/create.php");
    }


  }  

