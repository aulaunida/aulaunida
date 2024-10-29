<?php

include ('../../../app/config.php');

$id_docente = strtoupper($_POST['id_docente']);
$id_usuario = strtoupper($_POST['id_usuario']);
$id_persona = strtoupper($_POST['id_persona']);

$rol_id = $_POST['rol_id'];
$nombres = strtoupper($_POST['nombres']);
$apellidos = strtoupper($_POST['apellidos']);
$email = strtoupper($_POST['email']);
$dni = $_POST['dni'];
$fecha_nacimiento = $_POST['fecha_nacimiento'];
$celular = $_POST['celular'];
$profesion = strtoupper($_POST['profesion']);
$direccion = strtoupper($_POST['direccion']);

$integrador = $_POST['integrador'];
$tipo_cargo = strtoupper($_POST['tipo_cargo']);

$pdo->beginTransaction();

/////////// ACTUALIZAR A LA TABLA USUARIOS
$password = password_hash($dni, PASSWORD_DEFAULT); //para encriptar contraseña

$sentencia = $pdo->prepare('UPDATE usuarios
SET rol_id=:rol_id,
email=:email,
password=:password, 
fyh_actualizacion=:fyh_actualizacion
WHERE id_usuario=:id_usuario');

$sentencia->bindParam(':rol_id',$rol_id);
$sentencia->bindParam(':email',$email);
$sentencia->bindParam(':password',$password);
$sentencia->bindParam('fyh_actualizacion',$fechaHora);
$sentencia->bindParam('id_usuario',$id_usuario);
$sentencia->execute();


/////////// ACTUALIZAR A LA TABLA PERSONAS

$sentencia = $pdo->prepare('UPDATE personas
SET  nombres=:nombres, 
    apellidos=:apellidos, 
    dni=:dni, 
    fecha_nacimiento=:fecha_nacimiento, 
    profesion=:profesion, 
    direccion=:direccion, 
    celular=:celular, 
    fyh_actualizacion=:fyh_actualizacion
WHERE id_persona=:id_persona');

$sentencia->bindParam(':nombres',$nombres);
$sentencia->bindParam(':apellidos',$apellidos);
$sentencia->bindParam(':dni',$dni);
$sentencia->bindParam(':fecha_nacimiento',$fecha_nacimiento);
$sentencia->bindParam(':profesion',$profesion);
$sentencia->bindParam(':direccion',$direccion);
$sentencia->bindParam(':celular',$celular);
$sentencia->bindParam('fyh_actualizacion',$fechaHora);
$sentencia->bindParam('id_persona',$id_persona);

$sentencia->execute();


/////////// ACTUALIZAR A LA TABLA DOCENTES

$sentencia = $pdo->prepare('UPDATE docentes
SET integrador=:integrador, 
    tipo_cargo=:tipo_cargo, 
    fyh_actualizacion=:fyh_actualizacion
WHERE id_docente=:id_docente');

$sentencia->bindParam('integrador',$integrador);
$sentencia->bindParam('tipo_cargo',$tipo_cargo);
$sentencia->bindParam('fyh_actualizacion',$fechaHora);
$sentencia->bindParam('id_docente',$id_docente);


if($sentencia->execute()){
echo 'success';
$pdo->commit();
session_start();
         $_SESSION['mensaje'] = "Se actualizó al docente de manera correcta.";
         $_SESSION['icono'] = "success";
         $_SESSION['timer'] = 3000;  // Duración del mensaje en milisegundos 
         $_SESSION['timerProgressBar'] = true;
         $_SESSION['showCloseButton'] = true; // Agregar la cruz de cierre
         header('Location:'.APP_URL."/admin/docentes");
}else{
echo 'Error al actualizar docente';
$pdo->rollBack();
session_start();
$_SESSION['mensaje'] = "Error al actualizar docente, comunicarse con el administrador";
$_SESSION['icono'] = "error";
$_SESSION['timer'] = 3000;  // Duración del mensaje en milisegundos 
$_SESSION['timerProgressBar'] = true;
$_SESSION['showCloseButton'] = true; // Agregar la cruz de cierre
?><script>window.history.back();</script><?php
}

