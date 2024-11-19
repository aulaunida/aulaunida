<?php

include ('../../../app/config.php');

$id_archivo = $_POST['id_archivo'];

// Primero, obtenemos la ruta del archivo para eliminarlo del sistema
$consulta_ruta = $pdo->prepare("SELECT ruta_archivo FROM archivos WHERE id = :id");
$consulta_ruta->bindParam(':id', $id_archivo);

try {
    $consulta_ruta->execute();
    $resultado = $consulta_ruta->fetch(PDO::FETCH_ASSOC);

    if ($resultado) {
        $rutaArchivo = $resultado['ruta_archivo'];

        // Intentamos eliminar el archivo del sistema
        if (file_exists($rutaArchivo)) {
            unlink($rutaArchivo);
        }

        // Eliminamos el registro de la base de datos
        $sentencia = $pdo->prepare("DELETE FROM archivos WHERE id = :id");
        $sentencia->bindParam(':id', $id_archivo);

        if ($sentencia->execute()) {
            // Éxito
            session_start();
            $_SESSION['mensaje'] = "Archivo eliminado correctamente.";
            $_SESSION['icono'] = "success";
            $_SESSION['timer'] = 6000;
            $_SESSION['timerProgressBar'] = true;
            $_SESSION['showCloseButton'] = true;
            header('Location:' . APP_URL . "/admin/ayuda");
        } else {
            // Error al eliminar en la base de datos
            session_start();
            $_SESSION['mensaje'] = "Error al eliminar el archivo de la base de datos.";
            $_SESSION['icono'] = "warning";
            ?><script>window.history.back();</script><?php
        }
    } else {
        // Archivo no encontrado en la base de datos
        session_start();
        $_SESSION['mensaje'] = "Archivo no encontrado.";
        $_SESSION['icono'] = "warning";
        ?><script>window.history.back();</script><?php
    }
} catch (Exception $exception) {
    // Error general
    session_start();
    $_SESSION['mensaje'] = "Error al intentar eliminar el archivo. Detalles: " . $exception->getMessage();
    $_SESSION['icono'] = "warning";
    ?><script>window.history.back();</script><?php
}
?>
