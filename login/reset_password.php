<?php
// Configuración y conexión
include('../app/config.php');

// Iniciar sesión
session_start();

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

            // Mensaje de éxito
            $_SESSION['mensaje'] = 'Tu contraseña ha sido cambiada con éxito. Ahora puedes iniciar sesión.';
            $_SESSION['mensaje_tipo'] = 'success'; // Tipo de mensaje para SweetAlert2
            header('Location: index.php'); // Redirigir a la página de login
            exit;
        }
    } else {
        $_SESSION['mensaje'] = 'El enlace de recuperación es inválido o ha expirado.';
        $_SESSION['mensaje_tipo'] = 'error'; // Tipo de mensaje para SweetAlert2
        header('Location: index.php'); // Redirigir a la página de login si el enlace es inválido
        exit;
    }
} else {
    $_SESSION['mensaje'] = 'No se proporcionó un token válido.';
    $_SESSION['mensaje_tipo'] = 'error'; // Tipo de mensaje para SweetAlert2
    header('Location: index.php'); // Redirigir a la página de login si no se proporciona el token
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar contraseña</title>
    <link rel="stylesheet" href="<?= APP_URL; ?>/public/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?= APP_URL; ?>/public/dist/css/adminlte.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="hold-transition login-page">
    <div class="login-box">
        <div class="card">
            <div class="card-body login-card-body">
                <h4 class="login-box-msg">Restablecer contraseña</h4>
                <form method="POST" action="">
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Nueva contraseña" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Actualizar contraseña</button>
                        </div>
                    </div>
                </form>
                <hr>
                <a href="index.php" class="btn btn-link">Volver al inicio de sesión</a>
            </div>
        </div>
    </div>
    <script src="<?= APP_URL; ?>/public/plugins/jquery/jquery.min.js"></script>
    <script src="<?= APP_URL; ?>/public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= APP_URL; ?>/public/dist/js/adminlte.min.js"></script>
</body>
</html>
