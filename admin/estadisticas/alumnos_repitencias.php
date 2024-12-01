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
include('../../app/controllers/repitencias/listado_de_repitencias.php');
include('../../app/controllers/repitencias/datos_repitencias.php');
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
                            <h3 class="card-title">Ciclo Lectivo 2024</h3>
                        </div>
                        <div class="card-body">
                            <div class="card-header">
                                <h3 class="card-title">Estudiantes no aptos para avanzar</h3>
                            </div>
                            <div class="card-body">
                                <canvas id="myComparisonChart" width="400" height="200"></canvas>
                            </div>
                            <?php
                            
                             $contador_estudiantes = 0;
                             foreach ($estudiantes as $estudiante) {
                                 $contador_estudiantes = $contador_estudiantes + 1;
                             }


                            // CONTADOR ALUMNOS REPITENTES

                            $contador_repitentes = 0;
                            foreach ($repitencias as $repitencia) {
                                $contador_repitentes = $contador_repitentes + 1;
                            }
                            ?>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group text-center">
                                        <a href="<?= APP_URL; ?>/admin/estadisticas/index.php" class="btn btn-danger">Volver</a>
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
        var grados = [''];
        var datos = [<?=$contador_estudiantes; ?>];
        var datos2 = [<?= $contador_repitentes ?>];
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
                        label: 'Estudiantes Repitentes',
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