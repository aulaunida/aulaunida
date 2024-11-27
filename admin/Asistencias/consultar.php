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

// Obtener datos del curso y materia
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

// Obtener el mes seleccionado y los días hábiles del mes
$mes_actual = isset($_GET['mes']) ? $_GET['mes'] : date('n'); // Mes seleccionado o el mes actual
$año_actual = date('Y');
$dias_del_mes = cal_days_in_month(CAL_GREGORIAN, $mes_actual, $año_actual); // Número de días del mes

// Generar una lista de días hábiles (lunes a viernes)
$dias_habiles = [];
for ($dia = 1; $dia <= $dias_del_mes; $dia++) {
    $timestamp = mktime(0, 0, 0, $mes_actual, $dia, $año_actual);
    $numero_dia = date('N', $timestamp); // 1 (lunes) - 7 (domingo)
    if ($numero_dia >= 1 && $numero_dia <= 5) { // Solo lunes a viernes
        $dias_habiles[] = $dia;
    }
}

// Mapa de los días de la semana en inglés a español
$dias_en_espanol = [
    'Mon' => 'Lun',
    'Tue' => 'Mar',
    'Wed' => 'Mié',
    'Thu' => 'Jue',
    'Fri' => 'Vie',
    'Sat' => 'Sáb',
    'Sun' => 'Dom'
];

?>

<style>
    .icono-blanco i {
        color: white;
    }

    .uppercase {
        text-transform: uppercase;
    }
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <br>
    <div class="content">
        <div class="container">
            <div class="row">
                <h2 style="margin-left: 20px;">
                    <i class="bi bi-eye"></i> Consultar asistencia:
                    <b><?= $curso ?> "<?= $paralelo; ?>" - <?= $nombre_materia; ?></b>
                </h2>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-info">
                        <div class="card-header">
                            <h3 class="card-title">Asistencia de alumnos</h3>
                        </div>
                        <div class="card-body">

                            <!-- Formulario para seleccionar el mes -->
                            <form method="GET" action="" class="mb-4">
                                <input type="hidden" name="id_grado" value="<?= $id_grado_get; ?>">
                                <input type="hidden" name="id_docente" value="<?= $id_docente_get; ?>">
                                <input type="hidden" name="id_materia" value="<?= $id_materia_get; ?>">
                                <div class="row">
                                    <div class="col-md-3">
                                        <select name="mes" class="form-control" id="mes_seleccionado">
                                            <?php
                                            $meses = [
                                                1 => "ENERO",
                                                2 => "FEBRERO",
                                                3 => "MARZO",
                                                4 => "ABRIL",
                                                5 => "MAYO",
                                                6 => "JUNIO",
                                                7 => "JULIO",
                                                8 => "AGOSTO",
                                                9 => "SEPTIEMBRE",
                                                10 => "OCTUBRE",
                                                11 => "NOVIEMBRE",
                                                12 => "DICIEMBRE"
                                            ];
                                            foreach ($meses as $key => $nombre_mes) {
                                                $selected = ($key == $mes_actual) ? "selected" : "";
                                                echo "<option value='$key' $selected>$nombre_mes</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-primary">Consultar</button>
                                    </div>

                                    <div class="col-md-4">
                                    <!-- <h4 class="text-center">Estadística General de Asistencias</h4> -->
                                    <canvas id="asistenciaChart" height="100"></canvas>
                                </div>
                                </div>
                            </form>
                            <!-- Fin del formulario -->

                            <!-- Tabla de asistencias -->
                            <table id="example1" class="table table-striped table-bordered table-hover table-sm">
                                <thead>
                                    <tr>
                                        <th>Alumno</th>
                                        <?php foreach ($dias_habiles as $dia) : ?>
                                            <?php
                                            $timestamp = mktime(0, 0, 0, $mes_actual, $dia, $año_actual);
                                            $nombre_dia_ingles = date('D', $timestamp); // Obtiene el nombre abreviado del día en inglés
                                            $nombre_dia_espanol = $dias_en_espanol[$nombre_dia_ingles]; // Mapea al español
                                            ?>
                                            <th><?= $dia ?> <small>(<?= $nombre_dia_espanol ?>)</small></th>
                                        <?php endforeach; ?>
                                        <th>Total Inasistencias</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $total_inasistencias_curso = 0; // Contador total de inasistencias para el curso
                                    $total_asistencias_curso = 0; // Contador total de asistencias para el curso
                                    foreach ($estudiantes as $estudiante) :
                                        if ($id_grado_get == $estudiante['id_grado']) :
                                            $id_estudiante = $estudiante['id_estudiante'];
                                            $inasistencias_por_alumno = 0; // Contador individual de inasistencias
                                    ?>
                                            <tr>
                                                <td class="uppercase"><?= $estudiante['apellidos'] . ', ' . $estudiante['nombres']; ?></td>
                                                <?php
                                                foreach ($dias_habiles as $dia) :
                                                    $fecha_actual = sprintf('%04d-%02d-%02d', $año_actual, $mes_actual, $dia);
                                                    $asistencia_dia = '';
                                                    foreach ($asistencias as $asistencia) {
                                                        if (
                                                            $asistencia['docente_id'] == $id_docente_get &&
                                                            $asistencia['estudiante_id'] == $id_estudiante &&
                                                            $asistencia['materia_id'] == $id_materia_get &&
                                                            $asistencia['fecha_asistencia'] == $fecha_actual
                                                        ) {
                                                            $asistencia_dia = ($asistencia['estado_asistencia'] == 1) ? 'P' : 'A';
                                                        }
                                                    }
                                                    if ($asistencia_dia == 'A') {
                                                        $inasistencias_por_alumno++;
                                                    } else if ($asistencia_dia == 'P') {
                                                        $total_asistencias_curso++; // Sumar asistencia
                                                    }
                                                ?>
                                                    <td class="text-center">
                                                        <?php
                                                        if ($asistencia_dia == 'P') {
                                                            echo "<span style='color: green;'>P</span>";
                                                        } else if ($asistencia_dia == 'A') {
                                                            echo "<span style='color: red;'>A</span>";
                                                        }
                                                        ?>
                                                    </td>
                                                <?php endforeach; ?>
                                                <td class="text-center">
                                                    <b><?= $inasistencias_por_alumno; ?></b>
                                                </td>
                                            </tr>
                                    <?php
                                            $total_inasistencias_curso += $inasistencias_por_alumno; // Acumular en el total del curso
                                        endif;
                                    endforeach;
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="<?= count($dias_habiles) + 1; ?>" class="text-right"><b>Total Inasistencias del Curso:</b></td>
                                        <td class="text-center"><b><?= $total_inasistencias_curso; ?></b></td>
                                    </tr>
                                </tfoot>
                            </table>
                            <!-- Fin de la tabla -->

                            <hr>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <a href="<?= APP_URL; ?>/admin/asistencias" class="btn btn-danger">Volver</a>
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

<!-- Librería Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('asistenciaChart').getContext('2d');
    const asistenciaChart = new Chart(ctx, {
        type: 'bar', // Cambiar a 'bar' si prefieres barras
        data: {
            labels: ['Asistencias', 'Inasistencias'],
            datasets: [{
                label: 'Asistencias vs Inasistencias',
                data: [<?= $total_asistencias_curso; ?>, <?= $total_inasistencias_curso; ?>],
                backgroundColor: ['#4CAF50', '#F44336'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
            }
        }
    });
</script>

<?php include('../../admin/layout/parte2.php'); ?>