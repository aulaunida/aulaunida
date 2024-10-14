<?php
include('../../app/config.php');
include('../../admin/layout/parte1.php');

include('../../app/controllers/docentes/listado_de_asignaciones.php');


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
                <h1>Calificaciones <i class="bi bi-chevron-right"></i> Cargar calificaciones</h1>
            </div>
            <br>
            <div class="row">

                <div class="col-md-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Calificaciones por grados</h3>
                        </div>
                        <div class="card-body">
                            <!-- <?= $email_sesion; ?> -->
                            <table class="table table-striped table-bordered table-hover table-sm">
                                <thead>
                                    <tr>
                                        <th>
                                            <center>Nivel</center>
                                        </th>
                                        <th>
                                            <center>Turno</center>
                                        </th>
                                        <th>
                                            <center>Grado</center>
                                        </th>
                                        <th>
                                            <center>División</center>
                                        </th>
                                        <th>
                                            <center>Materia</center>
                                        </th>
                                        <th>
                                            <center>Acciones</center>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $contador = 0;
                                    foreach ($asignaciones as $asignacione) {
                                        $id_grado = $asignacione['id_grado'];
                                        if ($email_sesion == $asignacione['email']) {
                                            $id_asignacion = $asignacione['id_asignacion'];
                                            $contador = $contador + 1; ?>
                                            <tr>
                                                <td>
                                                    <center><?= $asignacione['nivel']; ?></center>
                                                </td>
                                                <td>
                                                    <center><?= $asignacione['turno']; ?></center>
                                                </td>
                                                <td>
                                                    <center><?= $asignacione['curso']; ?></center>
                                                </td>
                                                <td>
                                                    <center><?= $asignacione['paralelo']; ?></center>
                                                </td>
                                                <td>
                                                    <center><?= $asignacione['nombre_materia']; ?></center>
                                                </td>
                                                <td style="text-align: center">
                                                    
                                                        <a href="create.php?id_grado=<?= $id_grado?>&&id_docente=<?= $asignacione['docente_id'];?>&&id_materia=<?= $asignacione['materia_id'];?>" type="button" title="Cargar calificaciones" class="btn btn-primary btn-sm"><i class="bi bi-clipboard-data"></i> Cargar calificaciones</a>
                                                    
                                                </td>
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