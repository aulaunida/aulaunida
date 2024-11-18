<?php
// Configuración y conexión
include('../app/config.php');

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Verificar el token y la expiración
    $sql = "SELECT * FROM usuarios WHERE reset_token = :token AND reset_expiration > NOW()";
    $query = $pdo->prepare($sql);
    $query->bindParam(':token', $token);
    $query->execute();
    $usuario = $query->fetch(PDO::FETCH_ASSOC);

    if ($usuario) {
        // Mostrar el formulario de nueva contraseña si el token es válido
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['password'])) {
            $new_password = password_hash($_POST['password'], PASSWORD_BCRYPT);

            // Actualizar la contraseña en la base de datos y limpiar el token
            $sql = "UPDATE usuarios SET password = :new_password, reset_token = NULL, reset_expiration = NULL WHERE id_usuario = :id";
            $query = $pdo->prepare($sql);
            $query->bindParam(':new_password', $new_password);
            $query->bindParam(':id', $usuario['id_usuario']);
            $query->execute();

            echo 'Contraseña actualizada correctamente. Ahora puedes <a href="index.php">iniciar sesión</a>.';
            exit;
        }
    } else {
        echo 'El enlace de recuperación es inválido o ha expirado.';
        exit;
    }
} else {
    echo 'Token no proporcionado.';
    exit;
}
?>

<!-- Formulario para ingresar nueva contraseña -->
<form method="POST" action="">
    <label for="password">Nueva contraseña:</label>
    <input type="password" name="password" required>
    <button type="submit">Actualizar contraseña</button>
</form>
<div class="row">
<div class="col-md-12">
    <div class="form-group">
        <a href="<?= APP_URL; ?>/admin" class="btn btn-danger">Volver</a>
    </div>
</div>
</div>
