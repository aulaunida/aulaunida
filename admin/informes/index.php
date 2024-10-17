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
                                            $docente_id = $asignacione['docente_id'];
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


                                                    <!-- INICIO DEL MODAL REGISTRAR INFORME  -->
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
                                                                <form action="<?=APP_URL;?>/app/controllers/informes/create.php" method="post">
                                                                    <div class="modal-body">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <div class="form-group" style="text-align: left">
                                                                                    <label for="" class="text-align-left">Fecha de
                                                                                        Informe</label>
                                                                                        <input type="text" name="docente_id" value="<?=$docente_id;?>" hidden>
                                                                                    <input type="date" name="fecha_informe" class="form-control" name=""
                                                                                        id="">
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <div class="form-group" style="text-align: left">
                                                                                    <label for="estudiantes-select" class="text-align-left">Estudiante</label>
                                                                                    <select name="estudiante_id" class="form-control uppercase" id="estudiantes-select" onchange="actualizarIntegracion()">
                                                                                        <option value="" disabled selected>Seleccione un estudiante</option>
                                                                                        <?php
                                                                                        foreach ($estudiantes as $estudiante) {
                                                                                            if ($estudiante['id_grado'] == $asignacione['grado_id']) {
                                                                                                $id_estudiante = $estudiante['id_estudiante']; ?>
                                                                                                <option value="<?= $id_estudiante; ?>"
                                                                                                    data-integracion="<?= $estudiante['integracion']; ?>">
                                                                                                    <?= strtoupper($estudiante['apellidos'] . ", " . $estudiante['nombres']); ?>
                                                                                                </option>
                                                                                        <?php
                                                                                            }
                                                                                        }
                                                                                        ?>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <script>
                                                                            function actualizarIntegracion() {
                                                                                // Obtener el select de estudiantes
                                                                                const selectEstudiantes = document.getElementById('estudiantes-select');

                                                                                // Obtener la opción seleccionada
                                                                                const estudianteSeleccionado = selectEstudiantes.options[selectEstudiantes.selectedIndex];

                                                                                // Obtener el valor de integración de la opción seleccionada (usamos data-integracion)
                                                                                const integracion = estudianteSeleccionado.getAttribute('data-integracion');

                                                                                // Obtener el input donde se mostrará la integración
                                                                                const inputIntegracion = document.getElementById('integracion-input');

                                                                                // Aplicar la lógica para mostrar "SI" o "NO"
                                                                                inputIntegracion.value = integracion === 'NO' ? "NO" : "SI";
                                                                            }
                                                                        </script>

                                                                        <!-- Aquí agregamos el input para mostrar la integración automáticamente -->
                                                                        <div class="row" hidden>
                                                                            <div class="col-md-12">
                                                                                <div class="form-group" style="text-align: left">
                                                                                    <label for="integracion-input" class="text-align-left">Integración</label>
                                                                                    <input type="text" class="form-control" id="integracion-input" readonly required>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="row" hidden>
                                                                            <div class="col-md-12">
                                                                                <div class="form-group" style="text-align: left">
                                                                                    <label for="" class="text-align-left">Materia</label>
                                                                                    <input type="text" name="materia_id" value="<?=$asignacione['id_materia'];?>">
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <div class="form-group" style="text-align: left">
                                                                                    <label for="" class="text-align-left">Categorización</label>
                                                                                    <select name="observacion" class="form-control uppercase" id="">
                                                                                        <option value="" disabled selected>Seleccione una categorización</option>
                                                                                        <option value="comportamiento_y_disciplina">COMPORTAMIENTO Y DISCIPLINA</option>
                                                                                        <option value="comunicacion_y_participacion">COMUNICACIÓN Y PARTICIPACIÓN</option>
                                                                                        <option value="diagnostico_inicial">DIAGNÓSTICO INICIAL</option>
                                                                                        <option value="evolucion_y_progreso_general">EVOLUCIÓN Y PROGRESO GENERAL</option>
                                                                                        <option value="observaciones_especificas">OBSERVACIONES ESPECÍFICAS</option>
                                                                                        <option value="retos_y_estrategias_de_apoyo">RETOS Y ESTRATEGIAS DE APOYO</option>
                                                                                        <option value="trabajo_en_grupo_y_colaboracion">TRABAJO EN GRUPO Y COLABORACIÓN</option>

                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <div class="form-group" style="text-align: left">
                                                                                    <label for="" class="text-align-left">Observaciones</label>
                                                                                    <textarea name="nota" rows="10" class="form-control" id=""></textarea>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="submit" class="btn btn-info">Registrar</button>
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                                    </div>
                                                                </form>
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