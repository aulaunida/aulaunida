<?php
include('../../app/config.php');
include('../../admin/layout/parte1.php');
include('../../app/controllers/roles/listado_de_roles.php');
include('../../app/controllers/usuarios/listado_de_usuarios.php');
include('../../app/controllers/niveles/listado_de_niveles.php');
include('../../app/controllers/grados/listado_de_grados.php');
include('../../app/controllers/materias/listado_de_materias.php');
include('../../app/controllers/docentes/listado_de_docentes.php');
include('../../app/controllers/estudiantes/listado_de_estudiantes.php');
include('../../app/controllers/docentes/listado_de_asignaciones.php');
include('../../app/controllers/estudiantes/reporte_estudiantes_grados.php');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <br>
    <div class="content">
        <div class="container">
            <div class="row">
                <h2>ESTADÍSTICAS</h2>
            </div>
            <br>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Gráficos</h3>
                        </div>
                        <div class="card-body">
                            <div class="card-header">
                                <h3 class="card-title">Estudiantes por grados</h3>
                            </div>
                            <div class="card-body">
                                <canvas id="myComparisonChart" width="400" height="200"></canvas>
                            </div>
                            <?php
                            $contador = 0;
                            $contador_primergrado_a = 0;
                            $contador_segundogrado_a = 0;
                            $contador_tercergrado_a = 0;
                            $contador_cuartogrado_a = 0;
                            $contador_quintogrado_a = 0;
                            $contador_sextogrado_a = 0;
                            $contador_primergrado_b = 0;
                            $contador_segundogrado_b = 0;
                            $contador_tercergrado_b = 0;
                            $contador_cuartogrado_b = 0;
                            $contador_quintogrado_b = 0;
                            $contador_sextogrado_b = 0;


                            foreach ($reporte_estudiantes as $reporte_estudiante) {
                                if ($reporte_estudiante['grado_id'] == "1") $contador_primergrado_a = $contador_primergrado_a + 1;
                                if ($reporte_estudiante['grado_id'] == "2") $contador_primergrado_b = $contador_primergrado_b + 1;
                                if ($reporte_estudiante['grado_id'] == "8") $contador_segundogrado_a = $contador_segundogrado_a + 1;
                                if ($reporte_estudiante['grado_id'] == "9") $contador_segundogrado_b = $contador_segundogrado_b + 1;
                                if ($reporte_estudiante['grado_id'] == "10") $contador_tercergrado_a = $contador_tercergrado_a + 1;
                                if ($reporte_estudiante['grado_id'] == "11") $contador_tercergrado_b = $contador_tercergrado_b + 1;
                                if ($reporte_estudiante['grado_id'] == "12") $contador_cuartogrado_a = $contador_cuartogrado_a + 1;
                                if ($reporte_estudiante['grado_id'] == "13") $contador_cuartogrado_b = $contador_cuartogrado_b + 1;
                                if ($reporte_estudiante['grado_id'] == "14") $contador_quintogrado_a = $contador_quintogrado_a + 1;
                                if ($reporte_estudiante['grado_id'] == "15") $contador_quintogrado_b = $contador_quintogrado_b + 1;
                                if ($reporte_estudiante['grado_id'] == "16") $contador_sextogrado_a = $contador_sextogrado_a + 1;
                                if ($reporte_estudiante['grado_id'] == "17") $contador_sextogrado_b = $contador_sextogrado_b + 1;
                            }
                            $datos_reportes_estudiantes =
                                $contador_primergrado_a . "," .
                                $contador_primergrado_b . "," .
                                $contador_segundogrado_a . "," .
                                $contador_segundogrado_b . "," .
                                $contador_tercergrado_a . "," .
                                $contador_tercergrado_b . "," .
                                $contador_cuartogrado_a . "," .
                                $contador_cuartogrado_b . "," .
                                $contador_quintogrado_a . "," .
                                $contador_quintogrado_b . "," .
                                $contador_sextogrado_a . "," .
                                $contador_sextogrado_b;


                            // CONTADOR ALUMNOS INTEGRADOS

                            $contador_i = 0;
                            $contador_primergrado_a_i = 0;
                            $contador_segundogrado_a_i = 0;
                            $contador_tercergrado_a_i = 0;
                            $contador_cuartogrado_a_i = 0;
                            $contador_quintogrado_a_i = 0;
                            $contador_sextogrado_a_i = 0;
                            $contador_primergrado_b_i = 0;
                            $contador_segundogrado_b_i = 0;
                            $contador_tercergrado_b_i = 0;
                            $contador_cuartogrado_b_i = 0;
                            $contador_quintogrado_b_i = 0;
                            $contador_sextogrado_b_i = 0;


                            foreach ($reporte_estudiantes2 as $reporte_estudiante2) {
                                if ($reporte_estudiante2['grado_id'] == "1") $contador_primergrado_a_i = $contador_primergrado_a_i + 1;
                                if ($reporte_estudiante2['grado_id'] == "2") $contador_primergrado_b_i = $contador_primergrado_b_i + 1;
                                if ($reporte_estudiante2['grado_id'] == "8") $contador_segundogrado_a_i = $contador_segundogrado_a_i + 1;
                                if ($reporte_estudiante2['grado_id'] == "9") $contador_segundogrado_b_i = $contador_segundogrado_b_i + 1;
                                if ($reporte_estudiante2['grado_id'] == "10") $contador_tercergrado_a_i = $contador_tercergrado_a_i + 1;
                                if ($reporte_estudiante2['grado_id'] == "11") $contador_tercergrado_b_i = $contador_tercergrado_b_i + 1;
                                if ($reporte_estudiante2['grado_id'] == "12") $contador_cuartogrado_a_i = $contador_cuartogrado_a_i + 1;
                                if ($reporte_estudiante2['grado_id'] == "13") $contador_cuartogrado_b_i = $contador_cuartogrado_b_i + 1;
                                if ($reporte_estudiante2['grado_id'] == "14") $contador_quintogrado_a_i = $contador_quintogrado_a_i + 1;
                                if ($reporte_estudiante2['grado_id'] == "15") $contador_quintogrado_b_i = $contador_quintogrado_b_i + 1;
                                if ($reporte_estudiante2['grado_id'] == "16") $contador_sextogrado_a_i = $contador_sextogrado_a_i + 1;
                                if ($reporte_estudiante2['grado_id'] == "17") $contador_sextogrado_b_i = $contador_sextogrado_b_i + 1;
                            }
                            $datos_reportes_estudiantes2 =
                                $contador_primergrado_a_i . "," .
                                $contador_primergrado_b_i . "," .
                                $contador_segundogrado_a_i . "," .
                                $contador_segundogrado_b_i . "," .
                                $contador_tercergrado_a_i . "," .
                                $contador_tercergrado_b_i . "," .
                                $contador_cuartogrado_a_i . "," .
                                $contador_cuartogrado_b_i . "," .
                                $contador_quintogrado_a_i . "," .
                                $contador_quintogrado_b_i . "," .
                                $contador_sextogrado_a_i . "," .
                                $contador_sextogrado_b_i;
                            ?>
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

<!-- <script>
    var grados = ['Primer Grado A', 'Primer Grado B', 'Segundo Grado A', 'Segundo Grado B', 'Tercer Grado A', 'Tercer Grado B',
        'Cuarto Grado A', 'Cuarto Grado B', 'Quinto Grado A', 'Quinto Grado B', 'Sexto Grado A', 'Sexto Grado B'
    ];
    var datos = [<?= $datos_reportes_estudiantes ?>];
    var datos2 = [<?= $datos_reportes_estudiantes2 ?>];
    const ctx = document.getElementById('myChart');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: grados,
            datasets: [{
                    label: 'Cantidad de estudiantes',
                    data: datos,
                    borderWidth: 1
                },
                {
                    label: 'Estudiantes integrados',
                    data: datos2,
                    borderWidth: 1
                }
            ]
        },
        options: {
            maintainAspectRatio: false,
            responsive: true,
            scales: {
                x: {
                    grid: {
                        display: false,
                    }
                },
                y: {
                    beginAtZero: true,
                    grid: {
                        display: true,
                    }
                }
            }
        }
    });
</script> -->


<script>
    document.addEventListener("DOMContentLoaded", function() {
        var grados = ['Primer Grado A', 'Primer Grado B', 'Segundo Grado A', 'Segundo Grado B', 'Tercer Grado A', 'Tercer Grado B',
            'Cuarto Grado A', 'Cuarto Grado B', 'Quinto Grado A', 'Quinto Grado B', 'Sexto Grado A', 'Sexto Grado B'];
        var datos = [<?= $datos_reportes_estudiantes ?>];
        var datos2 = [<?= $datos_reportes_estudiantes2 ?>];
        var ctx = document.getElementById('myComparisonChart').getContext('2d');
        var myComparisonChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: grados,
                datasets: [{
                        label: 'Total de Estudiantes',
                        data: datos,
                        backgroundColor: 'rgba(54, 162, 235, 0.7)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Estudiantes Integrados',
                        data: datos2,
                        backgroundColor: 'rgba(255, 99, 132, 0.7)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                maintainAspectRatio: false,
                responsive: true,
                scales: {
                    x: {
                        grid: {
                            display: false,
                        }
                    },
                    y: {
                        beginAtZero: true,
                        grid: {
                            display: true,
                        }
                    }
                }
            }
        });
    });
</script>