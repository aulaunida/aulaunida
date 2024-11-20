<?php

include('../../app/config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recibimos la categoría y el archivo del formulario
    $categoria = $_POST['categoria'];
    $archivo = $_FILES['archivo'];

    // Mapa de categorías con sus nombres extendidos
    $categorias = [
        'manual' => 'Manual de usuario',
        'documentacion' => 'Documentación',
        'aula_unida' => 'Aula Unida',
    ];

    // Verificamos que la categoría existe en el mapa
    $nombreCategoria = isset($categorias[$categoria]) ? $categorias[$categoria] : $categoria; // Si no está en el mapa, usamos el valor original

    $nombreArchivo = $archivo['name'];
    $rutaTemporal = $archivo['tmp_name'];
    $directorio = "../../uploads/$categoria/";

    // Crear el directorio si no existe
    if (!file_exists($directorio)) {
        mkdir($directorio, 0777, true);
    }

    $rutaDestino = $directorio . $nombreArchivo;

    // Intentamos mover el archivo a la carpeta de destino
    if (move_uploaded_file($rutaTemporal, $rutaDestino)) {
        // Ahora usamos $nombreCategoria para la inserción en la base de datos
        $stmt = $pdo->prepare("INSERT INTO archivos (nombre_archivo, ruta_archivo, categoria) VALUES (?, ?, ?)");
        $stmt->execute([$nombreArchivo, $rutaDestino, $nombreCategoria]); // Usar el nombre extendido de la categoría
        echo "Archivo subido con éxito.";
    } else {
        echo "Error al subir el archivo.";
    }
}

?>

<form method="POST" enctype="multipart/form-data">
    <label>Seleccione un archivo:</label>
    <input type="file" name="archivo" required>
    <label>Categoría:</label>
    <select name="categoria" required>
        <option value="manual">Manual de usuario</option>
        <option value="documentacion">Documentación</option>
        <option value="aula_unida">Proyecto Aula unida</option>
    </select>
    <button type="submit">Subir</button>
</form>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <a href="<?=APP_URL;?>/admin/ayuda" class="btn btn-danger">Volver</a>
        </div>
    </div>
</div>
