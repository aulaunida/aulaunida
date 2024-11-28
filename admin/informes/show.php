<?php
$id_informe = $_GET['id'];

include('../../app/config.php');
include('../../admin/layout/parte1.php');
include('../../app/controllers/informes/datos_informes.php');
include('../../app/controllers/estudiantes/listado_de_estudiantes.php');
require('../../admin/librerias/fpdf186/fpdf.php');


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
            <h2 style="margin-left: 20px;"><i class="bi bi-eye"></i> Consultar informe: 
                <?php
                                                foreach ($estudiantes as $estudiante) {
                                                    if ($estudiante['id_estudiante'] == $estudiante_id) { ?>
                                                           <b> <?=  strtoupper ($estudiante['apellidos'] . ", " . $estudiante['nombres']); ?></b>
                                                <?php
                                                    }
                                                }
                                                ?>
            </h2>
            </div>
            <br>
            <div class="row">

                <div class="col-md-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Datos registrados:</h3>
                        </div>
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Fecha del informe</label>
                                        <p><?= $fecha_informe; ?></p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Materia</label>
                                        <p><?= $nombre_materia; ?></p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Categoria</label>
                                        <p class="uppercase"><?= $observacion; ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Informe</label>
                                        <p><?= $nota; ?></p>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                            <div class="form-group">
                            <a href="<?= APP_URL; ?>/admin/informes" class="btn btn-danger">Volver</a>
                            <a href="generar_pdf.php?id=<?= $id_informe; ?>" class="btn btn-primary" target="_blank">Exportar PDF</a>
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