<?php
/**
 * Created by PhpStorm.
 * User: HILARIWEB
 * Date: 4/1/2024
 * Time: 16:04
 */
include ('../../../app/config.php');

$id_rol = $_POST['id_rol'];

$sql_usuarios = "SELECT * FROM usuarios where estado = '1' and rol_id = '$id_rol' ";
$query_usuarios = $pdo->prepare($sql_usuarios);
$query_usuarios->execute();
$usuarios = $query_usuarios->fetchAll(PDO::FETCH_ASSOC);
$contador = 0;
foreach ($usuarios as $usuario){
    $contador = $contador + 1;
}
if($contador>0){
    //echo "existe este rol en otra tabla, no se puede eliminar";
    session_start();
    $_SESSION['mensaje'] = "No es posible eliminar el rol, tiene registros dependientes.";
    $_SESSION['icono'] = "error";
    $_SESSION['timer'] = 6000;  // Duración del mensaje en milisegundos (6 segundos)
    $_SESSION['timerProgressBar'] = true;
    $_SESSION['showCloseButton'] = true; // Agregar la cruz de cierre
    header('Location:'.APP_URL."/admin/roles");
}else{
    //echo "no existe registros con este rol, se puede eliminar";
    $sentencia = $pdo->prepare("DELETE FROM roles where id_rol=:id_rol ");

    $sentencia->bindParam('id_rol',$id_rol);


    if($sentencia->execute()){
            session_start();
            $_SESSION['mensaje'] = "Se eliminó el rol de manera correcta en la base de datos";
            $_SESSION['icono'] = "success";
            $_SESSION['timer'] = 6000;  // Duración del mensaje en milisegundos (6 segundos)
            $_SESSION['timerProgressBar'] = true;
            $_SESSION['showCloseButton'] = true; // Agregar la cruz de cierre
            header('Location:'.APP_URL."/admin/roles");
        }else{
            session_start();
            $_SESSION['mensaje'] = "Error, no se pudo eliminar el rol. Comuníquese con el administrador";
            $_SESSION['icono'] = "warning";
            $_SESSION['timer'] = 6000;  // Duración del mensaje en milisegundos (6 segundos)
            $_SESSION['timerProgressBar'] = true;
            $_SESSION['showCloseButton'] = true; // Agregar la cruz de cierre
            header('Location:'.APP_URL."/admin/roles");
        }

}








