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
            <h2 style="margin-left: 20px;"><i class="bi bi-plus-square"></i> Registrar asistencia: <b><?= $curso ?> "<?= $paralelo; ?>" - <?= $nombre_materia; ?></h></b>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Alumnos registrados</h3>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-striped table-bordered table-hover table-sm">
                                <thead>
                                    <tr>
                                        <th>Alumnos</th>
                                        <th><center>Fecha Asistencia</center></th>
                                        <th><center>Asistencia</center></th>
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
                                                <!-- <td style="text-align: center"><?= $contador_estudiantes; ?></td> -->
                                                <td class="uppercase"><input type="text" value="<?= $id_estudiante; ?>" name="" id="estudiante_<?= $contador_estudiantes; ?>" hidden><?= $estudiante['apellidos'] . ', ' . $estudiante['nombres']; ?></td>
                                                <!-- <td class="text-center" style="text-align: center"><?= $estudiante['integracion'] == 'NO' ? "NO" : "SI"; ?></td> -->
                                                <?php
                                                $estado_asistencia = "";
                                                $fecha_asistencia = "";
                                                foreach ($asistencias as $asistencia) {
                                                    if (($asistencia['docente_id'] == $id_docente_get) && ($asistencia['estudiante_id'] == $id_estudiante) && ($asistencia['materia_id'] == $id_materia_get)) {
                                                        $estado_asistencia = $asistencia['estado_asistencia'];
                                                        $fecha_asistencia = $asistencia['fecha_asistencia'];
                                                    }
                                                }
                                                ?>
                                                <td class="text-center" type="date" id="fecha_asistencia_<?= $contador_estudiantes; ?>" class="form-control" style="text-align: center"><?= $fecha_asistencia = $fechaHora; ?></td>
                                                <td>
                                                    <select id="estado_asistencia_<?= $contador_estudiantes; ?>" class="form-control" required>
                                                        <option type="number" class="text-center" value="1" <?= ($estado_asistencia == '1') ? 'selected' : ''; ?>>PRESENTE</option>
                                                        <option type="number" class="text-center" value="0" <?= ($estado_asistencia == '0') ? 'selected' : ''; ?>>AUSENTE</option>
                                                    </select>
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    }
                                    $contador_estudiantes;
                                    ?>
                                </tbody>
                            </table>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group text-center">
                                        <button class="btn btn-primary" id="btn_guardar">Guardar</button>
                                        <script>
                                            $('#btn_guardar').click(function() {
                                                var n = '<?= $contador_estudiantes; ?>';
                                                var i = 1;
                                                var id_docente = '<?= $id_docente_get; ?>';
                                                var id_materia = '<?= $id_materia_get; ?>';

                                                for (i = 1; i <= n; i++) {
                                                    var a = '#fecha_asistencia_' + i;
                                                    var fecha_asistencia = $(a).val();

                                                    var b = '#estado_asistencia_' + i;
                                                    var estado_asistencia = $(b).val();

                                                    var k = '#estudiante_' + i;
                                                    var id_estudiante = $(k).val();

                                                    //alert("id_docente: "+ id_docente + "- id_estudiante: " + id_estudiante + "- id_materia: " + id_materia);
                                                    var url = "../../app/controllers/asistencias/create.php";
                                                    $.get(url, {
                                                        id_docente: id_docente,
                                                        id_estudiante: id_estudiante,
                                                        id_materia: id_materia,
                                                        fecha_asistencia: fecha_asistencia,
                                                        estado_asistencia: estado_asistencia
                                                    }, function(datos) {
                                                        //alert("mando las notas");
                                                        $('#respuesta').html(datos);
                                                    });
                                                }
                                                Swal.fire({
                                                    position: "center",
                                                    icon: "success",
                                                    title: "Se registraron las asistencias de manera correcta.",
                                                    showConfirmButton: false,
                                                    timer: 6000, // Duración del mensaje en milisegundos (6 segundos)
                                                    timerProgressBar: true, // Barra de progreso visual del tiempo
                                                    showCloseButton: true // Mostrar la cruz de cierre
                                                });

                                            });
                                        </script>
                                        <div id="respuesta" hidden></div>
                                        <a href="<?= APP_URL; ?>/admin/asistencias" class="btn btn-danger">Volver</a>
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