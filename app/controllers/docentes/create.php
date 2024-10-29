<?php

include ('../../../app/config.php');

$rol_id = $_POST['rol_id'];
$nombres = strtoupper($_POST['nombres']);
$apellidos = strtoupper($_POST['apellidos']);
$dni = $_POST['dni'];
$fecha_nacimiento = $_POST['fecha_nacimiento'];
$direccion = strtoupper($_POST['direccion']);
$email = strtoupper($_POST['email']);
$celular = $_POST['celular'];
$profesion = strtoupper($_POST['profesion']);
$integrador = $_POST['integrador'];
$tipo_cargo = strtoupper($_POST['tipo_cargo']);

$pdo->beginTransaction();

/////////// INSERTAR A LA TABLA USUARIOS
$password = password_hash($dni, PASSWORD_DEFAULT); //para encriptar contraseña
 
$sentencia = $pdo->prepare('INSERT INTO usuarios
(rol_id,email,password, fyh_creacion, estado)
VALUES ( :rol_id,:email,:password,:fyh_creacion,:estado)');

$sentencia->bindParam(':rol_id',$rol_id);
$sentencia->bindParam(':email',$email);
$sentencia->bindParam(':password',$password);
$sentencia->bindParam('fyh_creacion',$fechaHora);
$sentencia->bindParam('estado',$estado_de_registro);
$sentencia->execute();

$id_usuario = $pdo->lastInsertId();


/////////// INSERTAR A LA TABLA PERSONAS

$sentencia = $pdo->prepare('INSERT INTO personas
        (usuario_id, nombres, apellidos, dni, fecha_nacimiento, profesion, direccion, celular, fyh_creacion, estado)
VALUES ( :usuario_id, :nombres, :apellidos, :dni, :fecha_nacimiento, :profesion, :direccion, :celular, :fyh_creacion, :estado)');

$sentencia->bindParam(':usuario_id',$id_usuario);
$sentencia->bindParam(':nombres',$nombres);
$sentencia->bindParam(':apellidos',$apellidos);
$sentencia->bindParam(':dni',$dni);
$sentencia->bindParam(':fecha_nacimiento',$fecha_nacimiento);
$sentencia->bindParam(':profesion',$profesion);
$sentencia->bindParam(':direccion',$direccion);
$sentencia->bindParam(':celular',$celular);
$sentencia->bindParam('fyh_creacion',$fechaHora);
$sentencia->bindParam('estado',$estado_de_registro);

$sentencia->execute();

$id_persona = $pdo->lastInsertId();

/////////// INSERTAR A LA TABLA DOCENTES

$sentencia = $pdo->prepare('INSERT INTO docentes
        (persona_id,integrador,tipo_cargo, fyh_creacion, estado)
VALUES ( :persona_id,:integrador,:tipo_cargo,:fyh_creacion,:estado)');

$sentencia->bindParam(':persona_id',$id_persona);
$sentencia->bindParam(':integrador',$integrador);
$sentencia->bindParam(':tipo_cargo',$tipo_cargo);
$sentencia->bindParam('fyh_creacion',$fechaHora);
$sentencia->bindParam('estado',$estado_de_registro);


if($sentencia->execute()){
echo 'success';
$pdo->commit();
session_start();
         $_SESSION['mensaje'] = "Se registró el docente de manera correcta.";
         $_SESSION['icono'] = "success";
         $_SESSION['timer'] = 3000;  // Duración del mensaje en milisegundos 
         $_SESSION['timerProgressBar'] = true;
         $_SESSION['showCloseButton'] = true; // Agregar la cruz de cierre
         header('Location:'.APP_URL."/admin/docentes");
}else{
echo 'error al registrar a la base de datos';
$pdo->rollBack();
session_start();
$_SESSION['mensaje'] = "Error al registrar docente, comunicarse con el administrador";
$_SESSION['icono'] = "error";
$_SESSION['timer'] = 3000;  // Duración del mensaje en milisegundos 
$_SESSION['timerProgressBar'] = true;
$_SESSION['showCloseButton'] = true; // Agregar la cruz de cierre
?><script>window.history.back();</script><?php
}
