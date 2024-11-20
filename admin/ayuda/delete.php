<?php
include('../../app/config.php');

$id = $_GET['id'] ?? '';
$stmt = $pdo->prepare("SELECT * FROM archivos WHERE id = ?");
$stmt->execute([$id]);
$archivo = $stmt->fetch();

if ($archivo) {
    unlink($archivo['ruta_archivo']);
    $stmt = $pdo->prepare("DELETE FROM archivos WHERE id = ?");
    $stmt->execute([$id]);
    echo "Archivo eliminado.";
} else {
    echo "Archivo no encontrado.";
}
?>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <a href="<?=APP_URL;?>/admin/ayuda" class="btn btn-danger">Volver</a>
        </div>
    </div>
</div>