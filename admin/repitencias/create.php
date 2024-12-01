<?php

$id_grado_get = $_GET['id_grado'];
$id_docente_get = $_GET['id_docente'];
$id_indicador_get = $_GET['id_indicador'];
include('../../app/config.php');
include('../../admin/layout/parte1.php');

include('../../app/controllers/estudiantes/listado_de_estudiantes.php');
include('../../app/controllers/repitencias/listado_de_repitencias.php');
include('../../app/controllers/indicadores/listado_de_indicadores.php');


$curso = "";
$paralelo = "";

foreach ($estudiantes as $estudiante) {
    if ($id_grado_get == $estudiante['id_grado']) {
        $curso = $estudiante['curso'];
        $paralelo = $estudiante['paralelo'];
    }
}

foreach ($indicadores as $indicadore) {
    if ($id_indicador_get == $indicadore['id_indicador']) {
        $nombre_indicador = $indicadore['nombre_indicador'];
    }
}



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

    .grafico-container {
        text-align: center;
        margin-bottom: 20px;
        /* Espaciado debajo del gráfico */
    }
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <br>
    <div class="content">
        <div class="container">
            <div class="row align-items-center">
                <!-- Título de la página -->
                <div class="col-md-9">
                    <h2 style="margin-left: 20px;"><i class="bi bi-plus-square"></i> Cargar repitencias: <b><?= $curso ?> "<?= $paralelo; ?>" - <?= $nombre_indicador; ?></b></h2>
                </div>
                <!-- Gráfico -->
                <div class="col-md-3 grafico-container text-center">
                    <canvas id="graficoComparativo" width="400" height="200"></canvas>
                </div>
            </div>

            <br>

            <!-- Fila del gráfico -->
            <!-- <div class="row">
                
                
            </div> -->

            <!-- Fila de la tabla -->
            <div class="row">
                <!-- <div class="col-md-3 grafico-container" hidden>
                    <canvas id="graficoComparativo" width="400" height="200"></canvas>
                </div> -->
                <div class="col-md-12 table-container">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Alumnos registrados</h3>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-striped table-bordered table-hover table-sm">
                                <thead>
                                    <tr>
                                        <th text align="left">Alumno</th>
                                        <th>
                                            <center>Integración</center>
                                        </th>
                                        <th>
                                            <center>Observación</center>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $contador_estudiantes = 0;
                                    $total_no_aptos = 0; // Inicializa el contador para no aptos

                                    foreach ($estudiantes as $estudiante) {
                                        if ($id_grado_get == $estudiante['id_grado']) {
                                            $id_estudiante = $estudiante['id_estudiante'];
                                            $contador_estudiantes++;
                                            $nota1 = "";

                                            foreach ($repitencias as $repitencia) {
                                                if (($repitencia['docente_id'] == $id_docente_get) &&
                                                    ($repitencia['estudiante_id'] == $id_estudiante) &&
                                                    ($repitencia['indicador_id'] == $id_indicador_get)
                                                ) {
                                                    $nota1 = $repitencia['nota1'];
                                                }
                                            }

                                            if ($nota1 == '1') { // Verifica si la nota1 corresponde a "NO APTO PARA AVANZAR DE GRADO"
                                                $total_no_aptos++;
                                            }
                                    ?>
                                            <tr>
                                                <td class="uppercase"><input type="text" value="<?= $id_estudiante; ?>" name="" id="estudiante_<?= $contador_estudiantes; ?>" hidden><?= $estudiante['apellidos'] . ', ' . $estudiante['nombres']; ?></td>
                                                <td class="text-center"><?= $estudiante['integracion'] == 'NO' ? "NO" : "SI"; ?></td>
                                                <td>
                                                    <select id="nota1_<?= $contador_estudiantes; ?>" class="form-control" required>
                                                        <option value="" <?= ($nota1 == '') ? 'selected' : ''; ?>>-</option>
                                                        <option value="1" <?= ($nota1 == '1') ? 'selected' : ''; ?>>NO APTO PARA AVANZAR DE GRADO</option>
                                                    </select>
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    }
                                    ?>
                                </tbody>

                                <tfoot>
                                    <?php
                                    $porcentaje_no_aptos = ($total_no_aptos / $contador_estudiantes) * 100;
                                    ?>
                                    <tr>
                                        <td colspan="2"><b>Total de alumnos no aptos para avanzar de grado:</b></td>
                                        <td><b><?= $total_no_aptos; ?> (<?= number_format($porcentaje_no_aptos, 2); ?>%)</b></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <hr>

            <!-- Botón para guardar repitencias -->
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group text-center">
                        <button class="btn btn-primary" id="btn_guardar_repitencias">Guardar</button>
                        <script>
                            $('#btn_guardar_repitencias').click(function() {
                                var n = '<?= $contador_estudiantes; ?>';
                                var i = 1;
                                var id_docente = '<?= $id_docente_get; ?>';
                                var id_indicador = '<?= $id_indicador_get; ?>';

                                for (i = 1; i <= n; i++) {
                                    var a = '#nota1_' + i;
                                    var nota1 = $(a).val();

                                    var k = '#estudiante_' + i;
                                    var id_estudiante = $(k).val();

                                    var url = "../../app/controllers/repitencias/create.php";
                                    $.get(url, {
                                        id_docente: id_docente,
                                        id_estudiante: id_estudiante,
                                        id_indicador: id_indicador,
                                        nota1: nota1
                                    }, function(datos) {
                                        $('#respuesta').html(datos);
                                    });
                                }
                                Swal.fire({
                                    position: "center",
                                    icon: "success",
                                    title: "Se registraron las repitencias de manera correcta.",
                                    showConfirmButton: false,
                                    timer: 6000,
                                    timerProgressBar: true,
                                    showCloseButton: true
                                }).then(() => {
                                    location.reload(); // Recarga la página para ver los cambios
                                });
                            });
                        </script>
                        <div id="respuesta" hidden></div>
                        <a href="<?= APP_URL; ?>/admin/repitencias" class="btn btn-danger">Volver</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.content-wrapper -->

<?php

include('../../admin/layout/parte2.php');
include('../../layout/mensajes.php');

?>

<script>
    $(function() {
        $("#example1").DataTable({
            "pageLength": 50,
            "language": {
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ - _END_ | _TOTAL_ alumnos",
                "infoEmpty": "Mostrando 0 - 0 | 0 alumnos",
                "infoFiltered": "(Filtrado de _MAX_ total alumnos)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ alumnos",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscar alumnos:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            buttons: [{
                    extend: 'collection',
                    text: 'Exportar',
                    orientation: 'landscape',
                    buttons: [{
                        text: 'Copiar Texto',
                        extend: 'copy',
                    }, {
                        text: 'Descargar en PDF',
                        extend: 'pdf'
                    }, {
                        text: 'Descargar en CSV',
                        extend: 'csv'
                    }, {
                        text: 'Descargar en Excel',
                        extend: 'excel'
                    }, {
                        text: 'Imprimir Reporte',
                        extend: 'print'
                    }]
                },
                {
                    extend: 'colvis',
                    text: 'Visualizar',
                    collectionLayout: 'fixed three-column'
                }
            ],
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Obtén los datos necesarios del backend
        const totalEstudiantes = <?= $contador_estudiantes; ?>;
        const totalNoAptos = <?= $total_no_aptos; ?>;
        const totalAptos = totalEstudiantes - totalNoAptos;

        // Configuración del gráfico
        const ctx = document.getElementById('graficoComparativo').getContext('2d');
        const graficoComparativo = new Chart(ctx, {
            type: 'doughnut', // También puedes usar 'bar', 'doughnut', etc.
            data: {
                labels: ['Aptos para avanzar', 'No aptos para avanzar'],
                datasets: [{
                    data: [totalAptos, totalNoAptos],
                    backgroundColor: ['#28a745', '#dc3545'], // Colores del gráfico
                    borderColor: ['#ffffff', '#ffffff'], // Bordes
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top'
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const label = context.label || '';
                                const value = context.raw || 0;
                                const total = context.chart.data.datasets[0].data.reduce((a, b) => a + b, 0);
                                const percentage = ((value / total) * 100).toFixed(2) + '%';
                                return `${label}: ${value} (${percentage})`;
                            }
                        }
                    }
                }
            }
        });
    });
</script>