<?php

$id_administrativo = $_GET['id'];
include('../../app/config.php');
include('../../admin/layout/parte1.php');
include('../../app/controllers/administrativos/datos_administrativos.php');

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <br>
    <div class="content">
        <div class="container">
            <div class="row">
                <h2 style="margin-left: 20px;"><i class="bi bi-eye"></i> Consultar detalles: </i><b><?=$nombres.' '.$apellidos;?></b>  </h2>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-info">
                        <div class="card-header">
                            <h3 class="card-title">Datos registrados</h3>
                        </div>
                        <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Rol</label>
                                            <div class="form-inline">
                                                <p><?=$nombre_rol;?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Nombres</label>
                                            <p><?=$nombres;?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Apellidos</label>
                                            <p><?=$apellidos;?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Correo electrónico</label>
                                            <p style="text-transform: uppercase;"><?=$email;?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Nro. de documento</label>
                                            <p><?=$dni;?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Fecha de nacimiento</label>
                                            <p><?=$fecha_nacimiento;?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Nro. de celular</label>
                                            <p><?=$celular;?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4" hidden>
                                        <div class="form-group">
                                            <label for="">Profesión</label>
                                            <p class="uppercase"><?=$profesion;?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Domicilio</label>
                                            <p style="text-transform: uppercase;"><?=$direccion;?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Fecha de creación</label>
                                            <p><?=$fyh_creacion;?></p>
                                        </div>
                                    </div>
                                </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Estado</label>
                                            <p style="text-transform: uppercase;">
                                                <?php if($estado=='1') echo "Activo"; else echo "Inactivo"; ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group text-center">
                                            <a href="<?= APP_URL; ?>/admin/administrativos" class="btn btn-danger">Volver</a>
                                        </div>
                                    </div>
                                </div>
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