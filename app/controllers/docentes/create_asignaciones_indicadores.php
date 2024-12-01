<?php

include ('../../../app/config.php');

$id_docente = $_POST['id_docente'];
$id_nivel = $_POST['id_nivel'];
$id_grado = $_POST['id_grado'];
$id_indicador = $_POST['id_indicador'];

$sentencia = $pdo->prepare('INSERT INTO asignaciones_indicadores
        (docente_id,nivel_id,grado_id,indicador_id,fyh_creacion, estado)
VALUES ( :docente_id,:nivel_id,:grado_id,:indicador_id,:fyh_creacion,:estado)');


$sentencia->bindParam(':docente_id',$id_docente);
$sentencia->bindParam(':nivel_id',$id_nivel);
$sentencia->bindParam(':grado_id',$id_grado);
$sentencia->bindParam(':indicador_id',$id_indicador);
$sentencia->bindParam('fyh_creacion',$fechaHora);
$sentencia->bindParam('estado',$estado_de_registro);

if($sentencia->execute()){
    echo 'success';
    session_start();
    $_SESSION['mensaje'] = "Se asignó el indicador de manera correcta.";
    $_SESSION['icono'] = "success";
    $_SESSION['timer'] = 6000;  // Duración del mensaje en milisegundos (6 segundos)
    $_SESSION['timerProgressBar'] = true;
    $_SESSION['showCloseButton'] = true; // Agregar la cruz de cierre
    header('Location:'.APP_URL."/admin/docentes/asignacion_indicadores.php");
//header('Location:' .$URL.'/');
}else{
    echo 'Error al asignar indicador!';
    session_start();
    $_SESSION['mensaje'] = "Error al asignar indicador, comunicarse con el administrador";
    $_SESSION['icono'] = "warning";
    $_SESSION['timer'] = 6000;  // Duración del mensaje en milisegundos (6 segundos)
    $_SESSION['timerProgressBar'] = true;
    $_SESSION['showCloseButton'] = true; // Agregar la cruz de cierre
    ?><script>window.history.back();</script><?php
}