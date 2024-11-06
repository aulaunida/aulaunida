<?php

include ('../../../app/config.php');

$id_usuario = $_POST['id_usuario'];
// $nombres = $_POST['nombres'];
$rol_id = $_POST['rol_id'];
$email = strtoupper($_POST['email']);
$password = $_POST['password'];
$password_repet = $_POST['password_repet'];

if($password == ""){
    
        $sentencia = $pdo->prepare("UPDATE usuarios
        SET rol_id=:rol_id,
            email=:email,
            fyh_actualizacion=:fyh_actualizacion
        WHERE id_usuario=:id_usuario ");
        
        // $sentencia->bindParam(':nombres',$nombres);
        $sentencia->bindParam(':rol_id',$rol_id);
        $sentencia->bindParam(':email',$email);
        $sentencia->bindParam('fyh_actualizacion',$fechaHora);
        $sentencia->bindParam('id_usuario',$id_usuario);
    
        try{
            if($sentencia->execute()){
            session_start();
            $_SESSION['mensaje'] = "Se actualizó el usuario de manera correcta";
            $_SESSION['icono'] = "success";
            $_SESSION['timer'] = 3000;  // Duración del mensaje en milisegundos 
            $_SESSION['timerProgressBar'] = true;
            $_SESSION['showCloseButton'] = true; // Agregar la cruz de cierre
            header('Location:'.APP_URL."/admin/usuarios");
            }else {
                session_start();
            $_SESSION['mensaje'] = "Error, no se pudo actualizar el usuario. Comunicarse con el administrador";
            $_SESSION['icono'] = "error";
            $_SESSION['timer'] = 3000;  // Duración del mensaje en milisegundos 
            $_SESSION['timerProgressBar'] = true;
            $_SESSION['showCloseButton'] = true; // Agregar la cruz de cierre
            ?><script>window.history.back();</script><?php
            }
        }catch (Exception $exception){
            session_start();
            $_SESSION['mensaje'] = "El correo electrónico de este usuario ya existe";
            $_SESSION['icono'] = "error";
            $_SESSION['timer'] = 3000;  // Duración del mensaje en milisegundos 
            $_SESSION['timerProgressBar'] = true;
            $_SESSION['showCloseButton'] = true; // Agregar la cruz de cierre
            ?><script>window.history.back();</script><?php
        }
}else {
    if ($password == $password_repet) {
        // echo "Las contraseñas coinciden";
        $password = password_hash($password, PASSWORD_DEFAULT); //para encriptar contraseña
    
        $sentencia = $pdo->prepare("UPDATE usuarios
        SET rol_id=:rol_id,
            email=:email,
            password=:password,
            fyh_actualizacion=:fyh_actualizacion
        WHERE id_usuario=:id_usuario ");
        
        // $sentencia->bindParam(':nombres',$nombres);
        $sentencia->bindParam(':rol_id',$rol_id);
        $sentencia->bindParam(':email',$email);
        $sentencia->bindParam(':password',$password);
        $sentencia->bindParam('fyh_actualizacion',$fechaHora);
        $sentencia->bindParam('id_usuario',$id_usuario);
    
        try{
            if ($sentencia->execute()){
            session_start();
            $_SESSION['mensaje'] = "Se actualizó correctamente el usuario";
            $_SESSION['icono'] = "success";
            $_SESSION['timer'] = 3000;  // Duración del mensaje en milisegundos 
            $_SESSION['timerProgressBar'] = true;
            $_SESSION['showCloseButton'] = true; // Agregar la cruz de cierre
            header('Location:'.APP_URL."/admin/usuarios");
            }else {
                session_start();
            $_SESSION['mensaje'] = "Error al actualizar el usuario. Comunicarse con el administrador";
            $_SESSION['icono'] = "error";
            $_SESSION['timer'] = 3000;  // Duración del mensaje en milisegundos 
            $_SESSION['timerProgressBar'] = true;
            $_SESSION['showCloseButton'] = true; // Agregar la cruz de cierre
            ?><script>window.history.back();</script><?php
            }
        }catch (Exception $exception){
            session_start();
            $_SESSION['mensaje'] = "El correo electrónico de este usuario ya existe";
            $_SESSION['icono'] = "error";
            $_SESSION['timer'] = 3000;  // Duración del mensaje en milisegundos 
            $_SESSION['timerProgressBar'] = true;
            $_SESSION['showCloseButton'] = true; // Agregar la cruz de cierre
            ?><script>window.history.back();</script><?php
        }
       
    
    }else{
        echo "Las contraseñas no coinciden";
        session_start();
      $_SESSION['mensaje'] = "Las contraseñas no coinciden, inténtelo nuevamente";
      $_SESSION['icono'] = "error";
      $_SESSION['timer'] = 3000;  // Duración del mensaje en milisegundos 
      $_SESSION['timerProgressBar'] = true;
      $_SESSION['showCloseButton'] = true; // Agregar la cruz de cierre
      ?><script>window.history.back();</script><?php
    }
}







