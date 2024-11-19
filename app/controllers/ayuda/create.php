<?php
include ('../../../app/config.php');

$categoria = $_POST['categoria'];
$archivo = $_FILES['archivo'];

// Validar que se haya cargado un archivo
if ($archivo['error'] == UPLOAD_ERR_OK) {
    $nombreArchivo = $archivo['name'];
    $tipoArchivo = $archivo['type'];
    $rutaTemporal = $archivo['tmp_name'];

    // Crear la ruta de destino basada en la categoría
    $directorio = "../../../uploads/$categoria/";

    // Crear el directorio si no existe
    if (!file_exists($directorio)) {
        mkdir($directorio, 0777, true);
    }

    // Ruta final del archivo
    $rutaArchivo = $directorio . $nombreArchivo;

    // Mover el archivo a la carpeta correspondiente
    if (move_uploaded_file($rutaTemporal, $rutaArchivo)) {
        // Guardar en la base de datos
        $sentencia = $pdo->prepare('INSERT INTO archivos 
            (nombre_archivo, tipo_archivo, ruta_archivo, categoria, fecha_creacion) 
            VALUES (:nombre_archivo, :tipo_archivo, :ruta_archivo, :categoria, :fecha_creacion)');
        
        $sentencia->bindParam(':nombre_archivo', $nombreArchivo);
        $sentencia->bindParam(':tipo_archivo', $tipoArchivo);
        $sentencia->bindParam(':ruta_archivo', $rutaArchivo);
        $sentencia->bindParam(':categoria', $categoria);
        $fechaActual = date('Y-m-d H:i:s');
        $sentencia->bindParam(':fecha_creacion', $fechaActual);

        if ($sentencia->execute()) {
            // Éxito
            session_start();
            $_SESSION['mensaje'] = "Archivo subido correctamente.";
            $_SESSION['icono'] = "success";
            $_SESSION['timer'] = 6000;
            $_SESSION['timerProgressBar'] = true;
            $_SESSION['showCloseButton'] = true; // Agregar la cruz de cierre
            header('Location:' . APP_URL . "/admin/ayuda");
        } else {
            // Error al guardar en la base de datos
            session_start();
            $_SESSION['mensaje'] = "Error al registrar el archivo en la base de datos.";
            $_SESSION['icono'] = "warning";
            ?><script>window.history.back();</script><?php
        }
    } else {
        // Error al mover el archivo
        session_start();
        $_SESSION['mensaje'] = "Error al mover el archivo al servidor.";
        $_SESSION['icono'] = "warning";
        ?><script>window.history.back();</script><?php
    }
} else {
    // Error al cargar el archivo
    session_start();
    $_SESSION['mensaje'] = "No se pudo cargar el archivo. Por favor, intente nuevamente.";
    $_SESSION['icono'] = "warning";
    ?><script>window.history.back();</script><?php
}
?>
