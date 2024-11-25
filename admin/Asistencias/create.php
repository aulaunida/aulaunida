<?php
$id_grado_get = $_GET['id_grado'];
$id_docente_get = $_GET['id_docente'];
$id_materia_get = $_GET['id_materia'];
include('../../app/config.php');
include('../../admin/layout/parte1.php');

include('../../app/controllers/estudiantes/listado_de_estudiantes.php');
include('../../app/controllers/asistencias/listado_de_asistencias.php');
include('../../app/controllers/materias/listado_de_materias.php');

$curso = "";
$paralelo = "";

foreach ($estudiantes as $estudiante) {
    if ($id_grado_get == $estudiante['id_grado']) {
        $curso = $estudiante['curso'];
        $paralelo = $estudiante['paralelo'];
    }
}

foreach ($materias as $materia) {
    if ($id_materia_get == $materia['id_materia']) {
        $nombre_materia = $materia['nombre_materia'];
    }
}
?>

<style>
    .icono-blanco i {
        color: white;
    }

    .uppercase {
        text-transform: uppercase;
    }
</style>

<div class="content-wrapper">
    <br>
    <div class="content">
        <div class="container">
            <div class="row">
                <h2 style="margin-left: 20px;"><i class="bi bi-plus-square"></i> Registrar asistencia: <b><?= $curso ?> "<?= $paralelo; ?>" - <?= $nombre_materia; ?></b></h2>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Seleccionar Fecha</h3>
                        </div>
                        <div class="card-body">
                            <form id="form_asistencias">
                                <div class="form-group col-md-3">
                                    <label for="fecha_asistencia">Fecha:</label>
                                    <input type="date" id="fecha_asistencia" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="alumnos">Alumnos registrados</label>
                                    <table id="example1" class="table table-striped table-bordered table-hover table-sm">
                                        <thead>
                                            <tr>
                                                <th>Alumnos</th>
                                                <th>Asistencia</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $contador_estudiantes = 0;
                                            foreach ($estudiantes as $estudiante) {
                                                if ($id_grado_get == $estudiante['id_grado']) {
                                                    $id_estudiante = $estudiante['id_estudiante'];
                                                    $contador_estudiantes++; ?>
                                                    <tr>
                                                        <td class="uppercase">
                                                            <input type="text" value="<?= $id_estudiante; ?>" name="" id="estudiante_<?= $contador_estudiantes; ?>" hidden>
                                                            <?= $estudiante['apellidos'] . ', ' . $estudiante['nombres']; ?>
                                                        </td>
                                                        <td>
                                                            <select id="estado_asistencia_<?= $contador_estudiantes; ?>" class="form-control" required>
                                                                <option value="1">PRESENTE</option>
                                                                <option value="0">AUSENTE</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                            <?php }
                                            } ?>
                                        </tbody>
                                    </table>
                                    <input type="hidden" id="total_estudiantes" value="<?= $contador_estudiantes; ?>">
                                </div>
                                <div class="text-center">
                                    <button type="button" id="btn_guardar" class="btn btn-primary">Guardar</button>
                                    <a href="<?= APP_URL; ?>/admin/asistencias" class="btn btn-danger">Volver</a>
                                </div>

                            </form>
                            <script>
                                $('#btn_guardar').click(function() {
                                    var fecha_asistencia = $('#fecha_asistencia').val();
                                    var total_estudiantes = $('#total_estudiantes').val();
                                    var id_docente = '<?= $id_docente_get; ?>';
                                    var id_materia = '<?= $id_materia_get; ?>';
                                    var asistencias = [];

                                    for (var i = 1; i <= total_estudiantes; i++) {
                                        var id_estudiante = $('#estudiante_' + i).val();
                                        var estado_asistencia = $('#estado_asistencia_' + i).val();
                                        asistencias.push({
                                            id_estudiante: id_estudiante,
                                            estado_asistencia: estado_asistencia
                                        });
                                    }

                                    $.post('../../app/controllers/asistencias/create.php', {
                                        id_docente: id_docente,
                                        id_materia: id_materia,
                                        fecha_asistencia: fecha_asistencia,
                                        asistencias: asistencias
                                    }, function(response) {
                                        Swal.fire({
                                            position: "center",
                                            icon: "success",
                                            title: response.message,
                                            showConfirmButton: false,
                                            timer: 6000,
                                            timerProgressBar: true,
                                            showCloseButton: true
                                        });
                                    }, 'json');
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('../../admin/layout/parte2.php'); ?>