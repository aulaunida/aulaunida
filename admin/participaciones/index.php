<?php
include('../../app/config.php');
include('../../admin/layout/parte1.php');
include('../../app/controllers/docentes/listado_de_asignaciones_indicadores.php');


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
                <h1 style="margin-left: 20px;"><i class="bi bi-clipboard-data"></i> Participación familiar</h1>
            </div>
            <br>
            <div class="row">

                <div class="col-md-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Parámetros posibles: <b>Activa</b> (Aceptable); <b>Baja</b> (Escasa)</h3>
                        </div>
                        <div class="card-body">
                            <!-- <?= $email_sesion; ?> -->
                            <table class="table table-striped table-bordered table-hover table-sm">
                                <thead>
                                    <tr>
                                        <!-- <th>Indicador</th> -->
                                        <th>Turno</th>
                                        <th>Grado</th>
                                        <th>División</th>
                                        <th><center>Acciones</center></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $contador = 0;
                                    foreach ($asignaciones as $asignacione) {
                                        $id_grado = $asignacione['id_grado'];
                                        if ($email_sesion == $asignacione['email'] && $asignacione['nombre_indicador'] == 'PARTICIPACION FAMILIAR') {
                                            $id_asignacion_indicadores = $asignacione['id_asignacion_indicadores'];
                                            $contador = $contador + 1; ?>
                                            <tr>
                                                <!-- <td><?= $asignacione['nombre_indicador']; ?></td>  -->
                                                <td><?= $asignacione['curso']; ?></td>
                                                <td><?= $asignacione['paralelo']; ?></td>
                                                <td><?= $asignacione['turno']; ?></td>
                                                <td style="text-align: center"><a href="create.php?id_grado=<?= $id_grado ?>&&id_docente=<?= $asignacione['docente_id']; ?>&&id_indicador=<?= $asignacione['indicador_id']; ?>" type="button" title="Cargar registros" class="btn btn-primary btn-sm"><i class="bi bi-plus"></i> Cargar registros</a></td>
                                            </tr>
                                    <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group text-center">
                                        <a href="<?= APP_URL; ?>/admin/index.php" class="btn btn-danger">Volver</a>
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