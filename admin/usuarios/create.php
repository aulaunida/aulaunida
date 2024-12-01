<?php
include ('../../app/config.php');
include ('../../admin/layout/parte1.php');
include ('../../app/controllers/roles/listado_de_roles.php');

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <br>
    <div class="content">
        <div class="container">
            <div class="row">
            <h2 style="margin-left: 20px;"><i class="bi bi-plus-square"></i>  Registrar usuario administrador</h2>
            </div>
            <br>
            <div class="row">

                <div class="col-md-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                        <h3 class="card-title">Completar los siguientes datos:</h3>
                        </div>
                        <div class="card-body">
                        <form action="<?=APP_URL;?>/app/controllers/usuarios/create.php" method="post">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="">Rol<b style="color:red">*</b></label>
                <div class="form-inline">
                    <!-- Mostrar el rol como texto y pasar el valor con un campo oculto -->
                    <input type="hidden" name="rol_id" value="1">
                    <span class="form-control" readonly>Administrador</span>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="">Correo electrónico<b style="color:red">*</b></label>
                <input type="email" name="email" class="form-control" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="">Contraseña<b style="color:red">*</b></label>
                <input type="password" name="password" class="form-control" required>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="">Repetir contraseña<b style="color:red">*</b></label>
                <input type="password" name="password_repet" class="form-control" required>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Registrar</button>
                <a href="<?=APP_URL;?>/admin/usuarios" class="btn btn-danger">Cancelar</a>
            </div>
        </div>
    </div>
</form>

                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php

include ('../../admin/layout/parte2.php');
include ('../../layout/mensajes.php');

?>
