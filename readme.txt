Actualización de carpeta - 06-06-24 // 09:01
Reinstalación de GIT - Leo 07-08-24 // 20:41


-----------------------

<style>
    .background-image {
        background-image: url('https://img.freepik.com/vector-gratis/diseno-fondo-abstracto-blanco_23-2148825582.jpg?t=st=1716700950~exp=1716704550~hmac=3dbbdf12f9260e273185f1224a8183de89f6ce29773da4d170e01f3d39d8f551&w=1380');
        background-size: cover;
        background-position: center;
    }
</style>

<body class="hold-transition login-page background-image">
<div class="login-box">
        <center><img src="<?= APP_URL; ?>/public/images/capdevila.png" width="200px" alt="">
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
                        <input type="email" name="email" class="form-control" placeholder="Correo electrónico" value="admin@admin.com">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Contraseña" value="12345678">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
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
