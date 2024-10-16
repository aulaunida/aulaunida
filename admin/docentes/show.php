<?php
$id_docente = $_GET['id'];

include('../../app/config.php');
include('../../admin/layout/parte1.php');
include('../../app/controllers/docentes/datos_docentes.php');

?>

<style>
    .icono-blanco i {
        color: white;
        /* Cambia el color del icono a blanco */
    }

    .uppercase {
        text-transform: uppercase;
        /* Convierte el texto a mayúsculas */
    }
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <br>
    <div class="content">
        <div class="container">
            <div class="row">
                <h2>CONSULTAR DETALLES <i class="bi bi-chevron-right"></i> <?= $apellidos . ', ' .$nombres ; ?></h2>
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
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">DNI</label>
                                        <p><?= $dni; ?></p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Apellido</label>
                                        <p class="uppercase"><?= $apellidos; ?></p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Nombre</label>
                                        <p class="uppercase"><?= $nombres; ?></p>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Fecha de Nacimiento</label>
                                        <p><?= $fecha_nacimiento; ?></p>
                                    </div>
                                </div>


                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Dirección</label>
                                        <p class="uppercase"><?= $direccion; ?></p>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Correo Electrónico</label>
                                        <p><?= $email; ?></p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Celular</label>
                                        <p><?= $celular; ?></p>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Estado</label>
                                        <p>
                                            <?php
                                            if ($estado == "1") echo "ACTIVO";
                                            else echo "INACTIVO";
                                            ?>
                                        </p>
                                    </div>
                                </div>

                            </div>
                            <div class="row">

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Nombre del rol</label>

                                        <p class="uppercase"><?= $nombre_rol; ?></p>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Profesión</label>
                                        <p class="uppercase"><?= $profesion; ?></p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Integrador</label>
                                        <p><?= $integrador; ?></p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Tipo de cargo</label>
                                        <p><?= $tipo_cargo; ?></p>
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Fecha de creación</label>

                                        <p><?= $fyh_creacion; ?></p>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <a href="<?= APP_URL; ?>/admin/docentes" class="btn btn-secondary">Volver</a>
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