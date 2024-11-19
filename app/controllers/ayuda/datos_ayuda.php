<?php

// Consulta para obtener los datos del archivo basado en su ID
$sql_archivos = "SELECT * FROM archivos WHERE id = :id";
$query_archivos = $pdo->prepare($sql_archivos);
$query_archivos->bindParam(':id', $id_archivo); // `id_archivo` debería definirse antes de incluir este archivo
$query_archivos->execute();
$archivos = $query_archivos->fetchAll(PDO::FETCH_ASSOC);

// Extraer los datos del archivo si existe
foreach ($archivos as $archivo) {
    $nombre_archivo = $archivo['nombre_archivo'];
    $tipo_archivo = $archivo['tipo_archivo'];
    $ruta_archivo = $archivo['ruta_archivo'];
    $categoria = $archivo['categoria'];
    $fecha_subida = $archivo['fecha_subida'];
}
?>
