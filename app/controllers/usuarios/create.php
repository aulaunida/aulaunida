<?php
include ('../../../app/config.php');

//  $nombres = $_POST['nombres'];
 $rol_id = $_POST['rol_id'];
 $email = strtoupper($_POST['email']);
 $password = $_POST['password'];
 $password_repet = $_POST['password_repet'];
 
 if ($password == $password_repet) {
     // echo "Las contraseñas coinciden";
     $password = password_hash($password, PASSWORD_DEFAULT); //para encriptar contraseña
 
     $sentencia = $pdo->prepare('INSERT INTO usuarios
     (rol_id,email,password, fyh_creacion, estado)
     VALUES (:rol_id,:email,:password,:fyh_creacion,:estado)');
     
    //  $sentencia->bindParam(':nombres',$nombres);
     $sentencia->bindParam(':rol_id',$rol_id);
     $sentencia->bindParam(':email',$email);
     $sentencia->bindParam(':password',$password);
     $sentencia->bindParam('fyh_creacion',$fechaHora);
     $sentencia->bindParam('estado',$estado_de_registro);
 
     try{
         if ($sentencia->execute()){
         session_start();
         $_SESSION['mensaje'] = "Se registró el usuario de manera correcta";
         $_SESSION['icono'] = "success";
         $_SESSION['timer'] = 3000;  // Duración del mensaje en milisegundos 
         $_SESSION['timerProgressBar'] = true;
         $_SESSION['showCloseButton'] = true; // Agregar la cruz de cierre
         header('Location:'.APP_URL."/admin/usuarios");
         }else {
             session_start();
         $_SESSION['mensaje'] = "Error al registrar usuario, comunicarse con el administrador";
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






