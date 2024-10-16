<?php
include('../../app/config.php');
include('../../admin/layout/parte1.php');

include('../../app/controllers/docentes/listado_de_asignaciones.php');
include('../../app/controllers/estudiantes/listado_de_estudiantes.php');


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
                <h2>INFORMES <i class="bi bi-chevron-right"></i> CONSULTAR INFORMES</h2>
            </div>
            <br>
            <div class="row">

                <div class="col-md-12">
                    <div class="card card-outline card-info">
                        <div class="card-header">
                            <h3 class="card-title">Informes por grados</h3>
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

                                                    <a class="btn btn-info btn-sm" data-toggle="modal"
                                                        data-target="#exampleModal<?= $id_asignacion; ?>"><i
                                                            class="bi bi-journals"></i> Redactar informe</a>
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="exampleModal<?= $id_asignacion; ?>"
                                                        tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header"
                                                                    style="background-color:#17a2b8; color:#FFFFFF">
                                                                    <h5 class="modal-title" id="exampleModalLabel">REDACTAR INFORME <i
                                                                            class="bi bi-chevron-right"></i><?= $asignacione['curso']; ?>
                                                                        "<?= $asignacione['paralelo']; ?>" -
                                                                        <?= $asignacione['nombre_materia']; ?>
                                                                    </h5>
                                                                    <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group" style="text-align: left">
                                                                                <label for="" class="text-align-left">Fecha de
                                                                                    Informe</label>
                                                                                <input type="date" class="form-control" name=""
                                                                                    id="">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group" style="text-align: left">
                                                                                <label for=""
                                                                                    class="text-align-left">Estudiante</label>
                                                                                <select name="" class="form-control" id="">
                                                                                    <?php
                                                                                    foreach ($estudiantes as $estudiante) {
                                                                                        if($estudiante['id_grado']==$asignacione['grado_id']){
                                                                                        $id_estudiante = $estudiante['id_estudiante'];?>
                                                                                        <option value="<?= $id_estudiante; ?>">
                                                                                            <?= strtoupper($estudiante['apellidos'] . ", " . $estudiante['nombres']); ?>
                                                                                        </option>
                                                                                        <?php    
                                                                                        }
                                                                                    }
                                                                                    $id_estudiante;
                                                                                    ?>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit"
                                                                        class="btn btn-primary">Registrar</button>
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Cancelar</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
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