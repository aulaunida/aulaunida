<?php
include('../../config.php');

$id = $_GET['id'] ?? '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $categoria = $_POST['categoria'];
    $stmt = $pdo->prepare("UPDATE ayuda SET categoria = ? WHERE id = ?");
    $stmt->execute([$categoria, $id]);
    header("Location: ../../admin/ayuda/index.php?mensaje=Archivo actualizado con éxito.");
}

$stmt = $pdo->prepare("SELECT * FROM ayuda WHERE id = ?");
$stmt->execute([$id]);
$archivo = $stmt->fetch();

?>

<form method="POST">
    <label>Categoría:</label>
    <select name="categoria" required>
        <option value="manual" <?= $archivo['categoria'] == 'manual' ? 'selected' : '' ?>>Manual de Usuario</option>
        <option value="documentacion" <?= $archivo['categoria'] == 'documentacion' ? 'selected' : '' ?>>Documentación</option>
        <option value="aula_unida" <?= $archivo['categoria'] == 'aula_unida' ? 'selected' : '' ?>>Proyecto Aula Unida</option>
    </select>
    <button type="submit">Actualizar</button>
</form>
