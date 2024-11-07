<?php
/**
 * Created by PhpStorm.
 * User: HILARIWEB
 * Date: 8/1/2024
 * Time: 20:17
 */
include ('../../../../app/config.php');

$logo = $_POST['logo'];
$nombre_institucion = strtoupper($_POST['nombre_institucion']);
$direccion = strtoupper($_POST['direccion']);
$telefono = $_POST['telefono'];
$celular = $_POST['celular'];
$correo = strtoupper($_POST['correo']);
$id_config_institucion = strtoupper($_POST['id_config_institucion']);


if($_FILES['file']['name'] != null){
    //echo "existe una imagen";
    $nombre_del_archivo =  date('Y-m-d-H-i-s').$_FILES['file']['name'];
    $location = "../../../../public/images/configuracion/".$nombre_del_archivo;
    move_uploaded_file($_FILES['file']['tmp_name'],$location);
    $logo = $nombre_del_archivo;
}else{
    //echo "no existe imagen";
    if($logo == ""){
        $logo = "";
    }else{
        $logo = $_POST['logo'];
    }
}


$sentencia = $pdo->prepare('UPDATE configuracion_instituciones 
          SET nombre_institucion=:nombre_institucion,
              logo=:logo,
              direccion=:direccion,
              telefono=:telefono,
              celular=:celular,
              correo=:correo, 
              fyh_actualizacion=:fyh_actualizacion
          WHERE id_config_institucion=:id_config_institucion');

$sentencia->bindParam(':nombre_institucion',$nombre_institucion);
$sentencia->bindParam(':logo',$logo);
$sentencia->bindParam(':direccion',$direccion);
$sentencia->bindParam(':telefono',$telefono);
$sentencia->bindParam(':celular',$celular);
$sentencia->bindParam(':correo',$correo);
$sentencia->bindParam('fyh_actualizacion',$fechaHora);
$sentencia->bindParam('id_config_institucion',$id_config_institucion);

if($sentencia->execute()){
    echo 'success';
    session_start();
    $_SESSION['mensaje'] = "Se actualizó la institución de manera correcta.";
    $_SESSION['icono'] = "success";
    $_SESSION['timer'] = 6000;  // Duración del mensaje en milisegundos (6 segundos)
    $_SESSION['timerProgressBar'] = true;
    $_SESSION['showCloseButton'] = true; // Agregar la cruz de cierre
    header('Location:'.APP_URL."/admin/configuraciones/institucion");
//header('Location:' .$URL.'/');
}else{
    //echo 'error al registrar a la base de datos';
    session_start();
    $_SESSION['mensaje'] = "Error al actualizar materia, comunicarse con el administrador";
    $_SESSION['icono'] = "warning";
    $_SESSION['timer'] = 6000;  // Duración del mensaje en milisegundos (6 segundos)
    $_SESSION['timerProgressBar'] = true;
    $_SESSION['showCloseButton'] = true; // Agregar la cruz de cierre
    ?><script>window.history.back();</script><?php
}
