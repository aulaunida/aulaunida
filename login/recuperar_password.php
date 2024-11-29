<?php
// Configuración y PHPMailer
include('../app/config.php');
require '../libs/phpmailer/PHPMailer.php';
require '../libs/phpmailer/SMTP.php';
require '../libs/phpmailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Iniciar la sesión (si es necesario)
session_start();

// Verificar si se ha enviado el formulario de recuperación
$correoEnviado = false; // Variable para verificar si se envió el correo
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email'])) {
    $email = $_POST['email'];

    // Conectar a la base de datos y verificar si el email existe
    $sql = "SELECT * FROM usuarios WHERE email = :email AND estado = '1'";
    $query = $pdo->prepare($sql);
    $query->bindParam(':email', $email);
    $query->execute();
    $usuario = $query->fetch(PDO::FETCH_ASSOC);

    if ($usuario) {
        // Generar un token único y la URL de restablecimiento
        $token = bin2hex(random_bytes(50));
        $reset_url = APP_URL . "/login/reset_password.php?token=$token";

        // Guardar el token en la base de datos junto con una fecha de expiración
        $expiry = date('Y-m-d H:i:s', strtotime('+1 hour'));
        $sql = "UPDATE usuarios SET reset_token = :token, reset_expiration = :expiry WHERE id_usuario = :id";
        $query = $pdo->prepare($sql);
        $query->bindParam(':token', $token);
        $query->bindParam(':expiry', $expiry);
        $query->bindParam(':id', $usuario['id_usuario']);
        $query->execute();

        // Enviar el correo con PHPMailer
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'localhost'; // MailHog corre en localhost
            $mail->Port = 1025;        // Puerto por defecto de MailHog
            $mail->SMTPAuth = false;   // MailHog no requiere autenticación
            $mail->SMTPSecure = '';    // Sin cifrado

            $mail->setFrom('pablojcastillo.94@gmail.com', 'Aula Unida');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Recuperación de contraseña';
            $mail->Body = "Hola,<br><br>Recibimos una solicitud para restablecer tu contraseña. Haz clic en el enlace de abajo para continuar:<br><br><a href='$reset_url'>$reset_url</a><br><br>Si no solicitaste esto, ignora este mensaje.";

            $mail->send();
            $correoEnviado = true; // Indicar que el correo fue enviado exitosamente
        } catch (Exception $e) {
            echo "<div class='alert alert-danger'>No se pudo enviar el correo. Error: {$mail->ErrorInfo}</div>";
        }
    } else {
        echo '<div class="alert alert-warning">Este correo no está registrado o el usuario está inactivo.</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= APP_NAME; ?> - Recuperación de Contraseña</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= APP_URL; ?>/public/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= APP_URL; ?>/public/dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <center>
            <img src="<?= APP_URL; ?>/public/images/logoau.png" width="200px" alt="">
            <br>
        </center>
        <div class="login-logo">
            <h3><b>Recuperar Contraseña</b></h3>
        </div>
        <div class="card">
            <div class="card-body login-card-body">
                <?php if ($correoEnviado): ?>
                    <!-- Mensaje informativo después del envío del correo -->
                    <p class="login-box-msg">
                        Se ha enviado un enlace de recuperación a tu correo electrónico.<br>
                        Por favor, revisa tu bandeja de entrada en <strong>MailHog</strong> para continuar con el proceso.
                    </p>
                    <p class="text-center text-muted">
                        El enlace tiene una validez de <strong>1 hora</strong>.
                    </p>
                    <a href="index.php" class="btn btn-primary btn-block">Volver al Inicio</a>
                <?php else: ?>
                    <!-- Mostrar el formulario si aún no se ha enviado el correo -->
                    <p class="login-box-msg">Ingresa tu correo electrónico para recuperar tu contraseña</p>
                    <form method="POST" action="">
                        <div class="input-group mb-3">
                            <input type="email" name="email" class="form-control" placeholder="Correo electrónico" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-block" type="submit">Recuperar Contraseña</button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="<?= APP_URL; ?>/public/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= APP_URL; ?>/public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= APP_URL; ?>/public/dist/js/adminlte.min.js"></script>
</body>
</html>
