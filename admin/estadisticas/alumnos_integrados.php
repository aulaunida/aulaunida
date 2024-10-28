<?php
include('../../app/config.php');
include('../../admin/layout/parte1.php');
include('../../app/controllers/usuarios/listado_de_usuarios.php');

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
                <div class="col-md-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Gráficos</h3>
                        </div>
                        <div class="card-body">
                            <div class="card-header">
                                <h3 class="card-title">Alumnos integrados</h3>
                            </div>
                            <div class="card-body">
                                <canvas id="myComparisonChart" width="400" height="200"></canvas>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <<div class="form-group text-center">
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

<script>
    document.addEventListener("DOMContentLoaded", function () {
        var ctx = document.getElementById('myComparisonChart').getContext('2d');
        var myComparisonChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Primer Grado', 'Segundo Grado', 'Tercer Grado', 'Cuarto Grado', 'Quinto Grado', 'Sexto Grado'],
                datasets: [
                    {
                        label: 'Total de Estudiantes por Grado',
                        data: [30, 28, 32, 35, 30, 33],
                        backgroundColor: 'rgba(54, 162, 235, 0.7)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Estudiantes Integrados por Grado',
                        data: [5, 2, 1, 2, 6, 1],
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