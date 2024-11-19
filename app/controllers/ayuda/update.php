<?php

include ('../../../app/config.php');

// Obtener el id del archivo a actualizar
$id_archivo = $_POST['id_archivo'];

// Se recuperan los nuevos datos del formulario (si los hay)
$nombre_archivo = strtoupper($_POST['nombre_archivo']);  // Nuevos datos del archivo
$categoria = $_POST['categoria']; // Nueva categoría
$tipo_archivo = $_POST['tipo_archivo']; // Nuevo tipo de archivo

// Se prepara la consulta para actualizar el archivo
$sentencia = $pdo->prepare('UPDATE archivos
SET nombre_archivo=:nombre_archivo, 
    categoria=:categoria, 
    tipo_archivo=:tipo_archivo, 
    fecha_actualizacion=:fecha_actualizacion
WHERE id=:id_archivo');

// Se vinculan los parámetros
$sentencia->bindParam(':nombre_archivo', $nombre_archivo);
$sentencia->bindParam(':categoria', $categoria);
$sentencia->bindParam(':tipo_archivo', $tipo_archivo);
$sentencia->bindParam(':fecha_actualizacion', $fechaHora);
$sentencia->bindParam(':id_archivo', $id_archivo);

if ($sentencia->execute()) {
    // Si la ejecución fue exitosa, se muestra un mensaje y redirige
    session_start();
    $_SESSION['mensaje'] = "Se actualizó el archivo de manera correcta.";
    $_SESSION['icono'] = "success";
    $_SESSION['timer'] = 6000;  // Duración del mensaje en milisegundos (6 segundos)
    $_SESSION['timerProgressBar'] = true;
    $_SESSION['showCloseButton'] = true; // Agregar la cruz de cierre
    header('Location:'.APP_URL."/admin/ayuda");  // Redirige a la página de ayuda
} else {
    // Si hay un error, se muestra un mensaje de error y se regresa a la página anterior
    session_start();
    $_SESSION['mensaje'] = "Error al actualizar el archivo, comunicarse con el administrador.";
    $_SESSION['icono'] = "warning";
    $_SESSION['timer'] = 6000;  // Duración del mensaje en milisegundos (6 segundos)
    $_SESSION['timerProgressBar'] = true;
    $_SESSION['showCloseButton'] = true; // Agregar la cruz de cierre
    ?><script>window.history.back();</script><?php
}
