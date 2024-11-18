<?php
// Configuración y PHPMailer
include('../app/config.php');
require '../libs/phpmailer/PHPMailer.php';
require '../libs/phpmailer/SMTP.php';
require '../libs/phpmailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


// Verificar si se ha enviado el formulario de recuperación
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
      // Generar la URL de restablecimiento incluyendo la carpeta "login"
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
  

            // Configurar el remitente y destinatario
            $mail->setFrom('pablojcastillo.94@gmail.com', 'Aula Unida'); // Aquí pones tu correo de envío
            $mail->addAddress($email); // El correo al que se le enviará la recuperación

            // Contenido del correo
            $mail->isHTML(true);
            $mail->Subject = 'Recuperación de contraseña';
            $mail->Body    = "Hola, <br><br>Recibimos una solicitud para restablecer tu contraseña. Haz clic en el enlace de abajo para continuar:<br><br><a href='$reset_url'>$reset_url</a><br><br>Si no solicitaste esto, ignora este mensaje.";

            $mail->send();
            echo 'Correo de recuperación enviado. Revisa tu bandeja de entrada.';
        } catch (Exception $e) {
            echo "No se pudo enviar el correo. Error: {$mail->ErrorInfo}";
        }
    } else {
        echo 'Este correo no está registrado o el usuario está inactivo.';
    }
}

?>

<!-- Formulario de recuperación -->
<form method="POST" action="">
    <label for="email">Ingresa tu correo electrónico:</label>
    <input type="email" name="email" required>
    <button type="submit">Recuperar contraseña</button>
</form>
<div class="row">
<div class="col-md-12">
    <div class="form-group">
        <a href="<?= APP_URL; ?>/admin" class="btn btn-danger">Volver</a>
    </div>
</div>
</div>
