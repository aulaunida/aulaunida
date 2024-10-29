<?php
/**
 * Created by PhpStorm.
 * User: HILARIWEB
 * Date: 8/1/2024
 * Time: 20:35
 */
include ('../../../../app/config.php');

$id_gestion = $_POST['id_gestion'];


$sentencia = $pdo->prepare("DELETE FROM gestiones where id_gestion=:id_gestion ");

$sentencia->bindParam('id_gestion',$id_gestion);

try{
    if($sentencia->execute()){
        session_start();
        $_SESSION['mensaje'] = "El ciclo lectivo se ha eliminado correctamente de la base de datos.";
        $_SESSION['icono'] = "success";
        $_SESSION['timer'] = 6000;  // Duración del mensaje en milisegundos (6 segundos)
        $_SESSION['timerProgressBar'] = true;
        $_SESSION['showCloseButton'] = true; // Agregar la cruz de cierre
        header('Location:'.APP_URL."/admin/configuraciones/gestion");
    }else{
        session_start();
        $_SESSION['mensaje'] = "No se pudo eliminar el ciclo lectivo. Por favor, comuníquese con el administrador.";
        $_SESSION['icono'] = "warning";
        $_SESSION['timer'] = 6000;  // Duración del mensaje en milisegundos (6 segundos)
        $_SESSION['timerProgressBar'] = true;
        $_SESSION['showCloseButton'] = true; // Agregar la cruz de cierre
        ?><script>window.history.back();</script><?php
    }
}
catch (Exception $exception){
    session_start();
        $_SESSION['mensaje'] = "No es posible eliminar el ciclo lectivo, tiene registros dependientes.";
        $_SESSION['icono'] = "warning";
        $_SESSION['timer'] = 6000;  // Duración del mensaje en milisegundos (6 segundos)
        $_SESSION['timerProgressBar'] = true;
        $_SESSION['showCloseButton'] = true; // Agregar la cruz de cierre
        ?><script>window.history.back();</script><?php
}
