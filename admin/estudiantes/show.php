<?php
$id_estudiante = $_GET['id'];

include('../../app/config.php');
include('../../admin/layout/parte1.php');
include('../../app/controllers/estudiantes/datos_estudiantes.php');

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
                <h2>CONSULTAR DETALLES <i class="bi bi-chevron-right"></i> <?= strtoupper($apellidos . ', ' . $nombres); ?></h2>
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
                                        <label for="">Género</label>
                                        <p class="uppercase"><?= $genero; ?></p>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Dirección</label>
                                        <p><?= $direccion; ?></p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Matrícula</label>
                                        <p><?= $matricula; ?></p>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Integración</label>

                                        <p><?= $integracion; ?></p>
                                    </div>
                                </div>



                            </div>
                            <div class="row">

                              





                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Nivel</label>
                                        <p class="uppercase"><?= $nivel; ?></p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Grado</label>
                                        <p><?= $curso; ?></p>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">División</label>

                                        <p class="uppercase"><?= $paralelo; ?></p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Turno</label>
                                        <p><?= $turno; ?></p>
                                    </div>
                                </div>
                            </div>


                            <div class="row">



                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Nombre del padre/madre/tutor</label>
                                        <p class="uppercase"><?= $nombres_apellidos_ppff; ?></p>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">DNI del padre/madre/tutor</label>
                                        <p class="uppercase"><?= $dni_ppff; ?></p>
                                    </div>
                                </div>


                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Celular del padre/madre/tutor</label>
                                        <p><?= $celular_ppff; ?></p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Ocupación del padre/madre/tutor</label>
                                        <p><?= $ocupacion_ppff; ?></p>
                                    </div>
                                </div>
                            </div>

                            <div class="row">



                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Contacto adicional emergencia</label>
                                        <p class="uppercase"><?= $ref_nombre; ?></p>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">N° de contacto emergencia</label>
                                        <p class="uppercase"><?= $ref_celular; ?></p>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Parentezco contacto emergencia</label>
                                        <p><?= $ref_parentezco; ?></p>
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

                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <a href="<?= APP_URL; ?>/admin/estudiantes" class="btn btn-secondary">Volver</a>
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