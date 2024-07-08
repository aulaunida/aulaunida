<?php
/**
 * Created by PhpStorm.
 * User: HILARIWEB
 * Date: 4/1/2024
 * Time: 20:39
 */

include ('../../../app/config.php');

$nombres = $_POST['nombres'];
$rol_id = $_POST['rol_id'];
$email = $_POST['email'];
$password = $_POST['password'];
$password_repet = $_POST['password_repet'];

if($password == $password_repet){
    //echo "las contraseñas son iguales";
    $password = password_hash($password, PASSWORD_DEFAULT);

    $sentencia = $pdo->prepare('INSERT INTO usuarios
(nombres,rol_id,email,password, fyh_creacion, estado)
VALUES ( :nombres,:rol_id,:email,:password,:fyh_creacion,:estado)');

    $sentencia->bindParam(':nombres',$nombres);
    $sentencia->bindParam(':rol_id',$rol_id);
    $sentencia->bindParam(':email',$email);
    $sentencia->bindParam(':password',$password);
    $sentencia->bindParam('fyh_creacion',$fechaHora);
    $sentencia->bindParam('estado',$estado_de_registro);

    try{
        if($sentencia->execute()){
            session_start();
            $_SESSION['mensaje'] = "Se registro el usuario de manera correcta en la base de datos";
            $_SESSION['icono'] = "success";
            $_SESSION['timer'] = 6000;  // Duración del mensaje en milisegundos (6 segundos)
            $_SESSION['timerProgressBar'] = true;
            $_SESSION['showCloseButton'] = true; // Agregar la cruz de cierre
            header('Location:'.APP_URL."/admin/usuarios");
        }else {
            session_start();
            $_SESSION['mensaje'] = "Error no se pudo registrar en la base datos, comuniquese con el administrador";
            $_SESSION['icono'] = "warning";
            $_SESSION['timer'] = 6000;  // Duración del mensaje en milisegundos (6 segundos)
            $_SESSION['timerProgressBar'] = true;
            $_SESSION['showCloseButton'] = true; // Agregar la cruz de cierre
            ?><script>window.history.back();</script><?php
        }
    }catch (Exception $exception){
        session_start();
        $_SESSION['mensaje'] = "El email de este usuario, ya existe en la base de datos";
        $_SESSION['icono'] = "warning";
        $_SESSION['timer'] = 6000;  // Duración del mensaje en milisegundos (6 segundos)
        $_SESSION['timerProgressBar'] = true;
        $_SESSION['showCloseButton'] = true; // Agregar la cruz de cierre
        ?><script>window.history.back();</script><?php
    }


}else{
    echo "Las contraseñas introducidas no coinciden";
    session_start();
    $_SESSION['mensaje'] = "Las contraseñas introducidas no coinciden";
    $_SESSION['icono'] = "warning";
    $_SESSION['timer'] = 6000;  // Duración del mensaje en milisegundos (6 segundos)
    $_SESSION['timerProgressBar'] = true;
    $_SESSION['showCloseButton'] = true; // Agregar la cruz de cierre
    ?><script>window.history.back();</script><?php
}






