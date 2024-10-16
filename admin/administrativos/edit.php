<?php
$id_administrativo = $_GET['id'];
include('../../app/config.php');
include('../../admin/layout/parte1.php');
include('../../app/controllers/administrativos/datos_administrativos.php');
include('../../app/controllers/roles/listado_de_roles.php');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <br>
    <div class="content">
        <div class="container">
            <div class="row">
                <h2>EDITAR ADMINISTRATIVO <i class="bi bi-chevron-right"></i> <?=$nombres.' '.$apellidos;?></h2>
            </div>
            <br>
            <div class="row">

                <div class="col-md-12">
                    <div class="card card-outline card-success">
                        <div class="card-header">
                            <h3 class="card-title">Datos registrados</h3>
                        </div>
                        <div class="card-body">
                            <form action="<?= APP_URL; ?>/app/controllers/administrativos/update.php" method="post">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="text" name="id_administrativo" value="<?=$id_administrativo?>" hidden>
                                            <input type="text" name="id_usuario" value="<?=$id_usuario?>" hidden>
                                            <input type="text" name="id_persona" value="<?=$id_persona?>" hidden>
                                            <label for="">Nombre del rol</label>
                                            <div class="form-inline">
                                                <select name="rol_id" id="" class="form-control">
                                                    <?php
                                                    foreach ($roles as $role) { ?>
                                                        <option value="<?= $role['id_rol']; ?>" <?=$nombre_rol==$role['nombre_rol'] ? 'selected' : ''?>><?= $role['nombre_rol']; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                                <a href="<?= APP_URL; ?>/admin/roles/create.php" style="margin-left: 5px" class="btn btn-primary btn-sm"><i class="bi bi-file-plus"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Nombre</label>
                                            <input type="text" name="nombres" value="<?=$nombres;?>" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Apellido</label>
                                            <input type="text" name="apellidos" value="<?=$apellidos;?>" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Correo Electrónico</label>
                                            <input type="email" name="email" value="<?=$email;?>" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">DNI</label>
                                            <input type="number" name="dni" value="<?=$dni;?>" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Fecha de Nacimiento</label>
                                            <input type="date" name="fecha_nacimiento" value="<?=$fecha_nacimiento;?>" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Celular</label>
                                            <input type="number" name="celular" value="<?=$celular;?>" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Profesión</label>
                                            <input type="text" name="profesion" value="<?=$profesion;?>" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Dirección</label>
                                            <input type="address" name="direccion" value="<?=$direccion;?>" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success">Actualizar</button>
                                            <a href="<?= APP_URL; ?>/admin/administrativos" class="btn btn-secondary">Cancelar</a>
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

include('../../admin/layout/parte2.php');
include('../../layout/mensajes.php');

?>