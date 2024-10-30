<?php

include('../../../app/config.php');


$id_usuario = strtoupper($_POST['id_usuario']);
$id_persona = strtoupper($_POST['id_persona']);
$id_estudiante = strtoupper($_POST['id_estudiante']);
$id_ppff = strtoupper($_POST['id_ppff']);

$rol_id = $_POST['rol_id'];
$nombres = strtoupper($_POST['nombres']);
$apellidos = strtoupper($_POST['apellidos']);
$dni = $_POST['dni'];
$fecha_nacimiento = $_POST['fecha_nacimiento'];
$genero = $_POST['genero'];
$direccion = strtoupper($_POST['direccion']);
$email = strtoupper($_POST['email']);
$nivel_id = $_POST['nivel_id'];
$grado_id = $_POST['grado_id'];
$matricula = $_POST['matricula'];
$integracion = $_POST['integracion'];
$nombres_apellidos_ppff = strtoupper($_POST['nombres_apellidos_ppff']);
$dni_ppff = $_POST['dni_ppff'];
$celular_ppff = $_POST['celular_ppff'];
$ocupacion_ppff = strtoupper($_POST['ocupacion_ppff']);
$ref_nombre = strtoupper($_POST['ref_nombre']);
$ref_celular = $_POST['ref_celular'];
$ref_parentezco = strtoupper($_POST['ref_parentezco']);
$profesion = "ESTUDIANTE";
$celular = 0;


$pdo->beginTransaction();

/////////// ACTUALIZAR A LA TABLA USUARIOS
$password = password_hash($dni, PASSWORD_DEFAULT); //para encriptar contraseña

$sentencia = $pdo->prepare('UPDATE usuarios
SET rol_id =:rol_id,
    email = :email,
    password = :password, 
    fyh_actualizacion =:fyh_actualizacion
WHERE id_usuario=:id_usuario');

$sentencia->bindParam(':rol_id', $rol_id);
$sentencia->bindParam(':email', $email);
$sentencia->bindParam(':password', $password);
$sentencia->bindParam('fyh_actualizacion', $fechaHora);
$sentencia->bindParam('id_usuario', $id_usuario);
$sentencia->execute();

/////////// ACTUALIZAR A LA TABLA PERSONAS

$sentencia = $pdo->prepare('UPDATE personas
SET       nombres=:nombres, 
        apellidos=:apellidos, 
        dni=:dni, 
        fecha_nacimiento=:fecha_nacimiento, 
        profesion=:profesion, 
        direccion=:direccion, 
        celular=:celular, 
        fyh_actualizacion=:fyh_actualizacion
WHERE id_persona=:id_persona');

$sentencia->bindParam(':nombres', $nombres);
$sentencia->bindParam(':apellidos', $apellidos);
$sentencia->bindParam(':dni', $dni);
$sentencia->bindParam(':fecha_nacimiento', $fecha_nacimiento);
$sentencia->bindParam(':profesion', $profesion);
$sentencia->bindParam(':direccion', $direccion);
$sentencia->bindParam(':celular', $celular);
$sentencia->bindParam('fyh_actualizacion', $fechaHora);
$sentencia->bindParam('id_persona', $id_persona);

$sentencia->execute();

/////////// ACTUALIZAR A LA TABLA ESTUDIANTES

$sentencia = $pdo->prepare('UPDATE estudiantes
SET       nivel_id=:nivel_id, 
        grado_id=:grado_id, 
        matricula=:matricula, 
        integracion=:integracion, 
        genero=:genero, 
        fyh_actualizacion=:fyh_actualizacion
WHERE id_estudiante=:id_estudiante');

$sentencia->bindParam(':nivel_id', $nivel_id);
$sentencia->bindParam(':grado_id', $grado_id);
$sentencia->bindParam(':matricula', $matricula);
$sentencia->bindParam(':integracion', $integracion);
$sentencia->bindParam(':genero', $genero);
$sentencia->bindParam('fyh_actualizacion', $fechaHora);
$sentencia->bindParam('id_estudiante', $id_estudiante);

$sentencia->execute();

/////////// ACTUALIZAR A LA TABLA PPFFS

$sentencia = $pdo->prepare('UPDATE ppffs
SET      nombres_apellidos_ppff=:nombres_apellidos_ppff, 
        dni_ppff=:dni_ppff, 
        celular_ppff=:celular_ppff, 
        ocupacion_ppff=:ocupacion_ppff, 
        ref_nombre=:ref_nombre, 
        ref_parentezco=:ref_parentezco, 
        ref_celular=:ref_celular, 
        fyh_actualizacion=:fyh_actualizacion
WHERE id_ppff=:id_ppff');

$sentencia->bindParam(':nombres_apellidos_ppff', $nombres_apellidos_ppff);
$sentencia->bindParam(':dni_ppff', $dni_ppff);
$sentencia->bindParam(':celular_ppff', $celular_ppff);
$sentencia->bindParam(':ocupacion_ppff', $ocupacion_ppff);
$sentencia->bindParam(':ref_nombre', $ref_nombre);
$sentencia->bindParam(':ref_parentezco', $ref_parentezco);
$sentencia->bindParam(':ref_celular', $ref_celular);
$sentencia->bindParam('fyh_actualizacion', $fechaHora);
$sentencia->bindParam('id_ppff', $id_ppff);


if ($sentencia->execute()) {
    echo 'success';
    $pdo->commit();
    session_start();
    $_SESSION['mensaje'] = "Se actualizó al alumno de manera correcta.";
    $_SESSION['icono'] = "success";
    $_SESSION['timer'] = 3000;  // Duración del mensaje en milisegundos 
    $_SESSION['timerProgressBar'] = true;
    $_SESSION['showCloseButton'] = true; // Agregar la cruz de cierre
    header('Location:' . APP_URL . "/admin/estudiantes");
} else {
    echo 'error al registrar a la base de datos';
    $pdo->rollBack();
    session_start();
    $_SESSION['mensaje'] = "Error al actualizar alumno, comunicarse con el administrador";
    $_SESSION['icono'] = "error";
    $_SESSION['timer'] = 3000;  // Duración del mensaje en milisegundos 
    $_SESSION['timerProgressBar'] = true;
    $_SESSION['showCloseButton'] = true; // Agregar la cruz de cierre
?><script>
        window.history.back();
    </script><?php
            }
