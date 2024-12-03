<?php

$id_grado_get = $_GET['id_grado'];
$id_docente_get = $_GET['id_docente'];
$id_indicador_get = $_GET['id_indicador'];
include('../../app/config.php');
include('../../admin/layout/parte1.php');

include('../../app/controllers/estudiantes/listado_de_estudiantes.php');
include('../../app/controllers/participaciones/listado_de_participaciones.php');
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
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <br>
    <div class="content">
        <div class="container">
            <div class="row">
                <!-- <h2>CARGAR participacionES<i class="bi bi-chevron-right"></i><?= $curso ?> "<?= $paralelo; ?>" - <?= $nombre_indicador; ?></h> -->
                <h2 style="margin-left: 20px;"><i class="bi bi-plus-square"></i> Cargar participaciones: <b><?= $curso ?> "<?= $paralelo; ?>" - <?= $nombre_indicador; ?></b></h2>
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
                                        <th text align="left">Alumno</th>
                                        <!-- <th><center>Integración<center></th> -->
                                        <th>
                                            <center>Actos</center>
                                        </th>
                                        <th>
                                            <center>Reuniones</center>
                                        </th>
                                        <th>
                                            <center>Actividades Extras</center>
                                        </th>

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
                                                $nota1 = "";
                                                $nota2 = "";
                                                $nota3 = "";
                                                foreach ($participaciones as $participacione) {
                                                    if (($participacione['docente_id'] == $id_docente_get) && ($participacione['estudiante_id'] == $id_estudiante) && ($participacione['indicador_id'] == $id_indicador_get)) {
                                                        $nota1 = $participacione['nota1'];
                                                        $nota2 = $participacione['nota2'];
                                                        $nota3 = $participacione['nota3'];
                                                    }
                                                }
                                                ?>

                                                <td>
                                                    <select id="nota1_<?= $contador_estudiantes; ?>" class="form-control" required>
                                                        <option type="number" value="" <?= ($nota1 == '') ? 'selected' : ''; ?>>-</option>
                                                        <option type="number" value="1" <?= ($nota1 == '1') ? 'selected' : ''; ?>>ACTIVA - ACEPTABLE</option>
                                                        <option type="number" value="2" <?= ($nota1 == '2') ? 'selected' : ''; ?>>BAJA - ESCASA</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select id="nota2_<?= $contador_estudiantes; ?>" class="form-control" required>
                                                        <option type="number" value="" <?= ($nota2 == '') ? 'selected' : ''; ?>>-</option>
                                                        <option type="number" value="1" <?= ($nota2 == '1') ? 'selected' : ''; ?>>ACTIVA - ACEPTABLE</option>
                                                        <option type="number" value="2" <?= ($nota2 == '2') ? 'selected' : ''; ?>>BAJA - ESCASA</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select id="nota3_<?= $contador_estudiantes; ?>" class="form-control" required>
                                                        <option type="number" value="" <?= ($nota3 == '') ? 'selected' : ''; ?>>-</option>
                                                        <option type="number" value="1" <?= ($nota3 == '1') ? 'selected' : ''; ?>>ACTIVA - ACEPTABLE</option>
                                                        <option type="number" value="2" <?= ($nota3 == '2') ? 'selected' : ''; ?>>BAJA - ESCASA</option>
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
                                                var id_indicador = '<?= $id_indicador_get; ?>';

                                                for (i = 1; i <= n; i++) {
                                                    var a = '#nota1_' + i;
                                                    var nota1 = $(a).val();

                                                    var b = '#nota2_' + i;
                                                    var nota2 = $(b).val();

                                                    var c = '#nota3_' + i;
                                                    var nota3 = $(c).val();

                                                    var k = '#estudiante_' + i;
                                                    var id_estudiante = $(k).val();


                                                    //alert("id_docente: "+ id_docente + "- id_estudiante: " + id_estudiante + "- id_indicador: " + id_indicador);
                                                    var url = "../../app/controllers/participaciones/create.php";
                                                    $.get(url, {
                                                        id_docente: id_docente,
                                                        id_estudiante: id_estudiante,
                                                        id_indicador: id_indicador,
                                                        nota1: nota1,
                                                        nota2: nota2,
                                                        nota3: nota3
                                                    }, function(datos) {
                                                        //alert("mando las notas");
                                                        $('#respuesta').html(datos);
                                                    });
                                                }
                                                Swal.fire({
                                                    position: "center",
                                                    icon: "success",
                                                    title: "Se registraron las participaciones de manera correcta.",
                                                    showConfirmButton: false,
                                                    timer: 6000, // Duración del mensaje en milisegundos (6 segundos)
                                                    timerProgressBar: true, // Barra de progreso visual del tiempo
                                                    showCloseButton: true // Mostrar la cruz de cierre
                                                });

                                            });
                                        </script>
                                        <div id="respuesta" hidden></div>
                                        <a href="<?= APP_URL; ?>/admin/participaciones" class="btn btn-danger">Volver</a>
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
                "info": "Mostrando _START_ - _END_ | _TOTAL_ estudiantes",
                "infoEmpty": "Mostrando 0 - 0 | 0 estudiantes",
                "infoFiltered": "(Filtrado de _MAX_ total estudiantes)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ estudiantes",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscar estudiante:",
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
                    text: 'Reportes',
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
                    text: 'Visor de columnas',
                    collectionLayout: 'fixed three-column'
                }
            ],
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>