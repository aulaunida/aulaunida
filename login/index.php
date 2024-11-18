<?php
include ('../app/config.php');
require '../libs/phpmailer/PHPMailer.php';
require '../libs/phpmailer/SMTP.php';
require '../libs/phpmailer/Exception.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?=APP_NAME;?></title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?=APP_URL;?>/public/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?=APP_URL;?>/public/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?=APP_URL;?>/public/dist/css/adminlte.min.css">
    <!-- Sweetalert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<style>
    .background-image {
        background-image: url('https://img.freepik.com/vector-gratis/diseno-fondo-abstracto-blanco_23-2148825582.jpg?t=st=1716700950~exp=1716704550~hmac=3dbbdf12f9260e273185f1224a8183de89f6ce29773da4d170e01f3d39d8f551&w=1380');
        background-size: cover;
        background-position: center;
    }
</style>

<body class="hold-transition login-page">

<video autoplay muted loop class="background-video">
    <source src="<?= APP_URL; ?>/public/images/loginvideo.mp4" type="video/mp4">
    Your browser does not support the video tag.
</video>

<style>
    .background-video {
        position: fixed;
        right: 0;
        bottom: 0;
        min-width: 100%;
        min-height: 100%;
        z-index: -1;
    }
</style>

<div class="login-box">
    <center>
        <img src="<?= APP_URL; ?>/public/images/logoau.png" width="200px" alt="">
        <br>
    </center>
    <div class="login-logo">
        <h3>Acceso a <b>Aula Unida®</b></h3>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Iniciar sesión</p>
            <hr>
            <form action="controller_login.php" method="post">
                <div class="input-group mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Correo electrónico" value="">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Contraseña" value="">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <a href="recuperar_password.php"><center>¿Olvidaste tu contraseña?</center></a>
                <hr>
                <div class="input-group mb-3">
                    <button class="btn btn-primary btn-block" type="submit">Acceder</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.login-box -->

<?php
session_start();
if (isset($_SESSION['mensaje'])) {
    $mensaje = $_SESSION['mensaje'];
?>
    <script>
          Swal.fire({
            position: "center",
            icon: "warning",
            title: "<?=$mensaje;?>",
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: true,
            showCloseButton: true
        });
    </script>
<?php
    session_destroy();
}
?>

<!-- jQuery -->
<script src="<?=APP_URL;?>/public/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?=APP_URL;?>/public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=APP_URL;?>/public/dist/js/adminlte.min.js"></script>
</body>
</html>
