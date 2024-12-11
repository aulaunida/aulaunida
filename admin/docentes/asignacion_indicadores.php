<?php
include('../../app/config.php');
include('../../admin/layout/parte1.php');
include('../../app/controllers/docentes/listado_de_docentes.php');
include('../../app/controllers/niveles/listado_de_niveles.php');
include('../../app/controllers/grados/listado_de_grados.php');
include('../../app/controllers/indicadores/listado_de_indicadores.php');
include('../../app/controllers/docentes/listado_de_asignaciones_indicadores.php');
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
            <h2 style="margin-left: 20px;"><i class="bi bi-file-earmark-plus"></i>  Asignar indicadores </h2>
            </div>
            <br>
            <div class="row">

                <div class="col-md-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Docentes registrados </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_asignacion"><i class="bi bi-plus-square"></i> Asignar indicador</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-striped table-bordered table-hover table-sm">
                                <thead>
                                    <tr>
                                        <th>Docente</th>
                                        <!-- <th><center>Rol</center></th> -->
                                        <!-- <th><center>DNI</center></th> -->
                                        <!-- <th><center>Fecha de nacimiento</center></th> -->
                                        <!-- <th><center>Correo electrónico</center></th> -->
                                        <th><center>Integrador</center></th>
                                        <th>
                                            <center>Estado</center>
                                        </th>
                                        <th>
                                            <center>Indicadores asignados</center>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $contador_docentes = 0;
                                    foreach ($docentes as $docente) {
                                        $id_docente = $docente['id_docente'];
                                        $contador_docentes = $contador_docentes + 1; ?>
                                        <tr>
                                            <!-- <td style="text-align: center"><?= $contador_docentes; ?></td> -->
                                            <td class="uppercase"><?= $docente['apellidos'] . ', ' . $docente['nombres']; ?></td>
                                            <!-- <td style="text-align: center"><?= $docente['nombre_rol']; ?></td> -->
                                            <!-- <td style="text-align: center"><?= $docente['dni']; ?></td> -->
                                            <!-- <td style="text-align: center"><?= $docente['fecha_nacimiento']; ?></td> -->
                                            <!-- <td style="text-align: center"><?= $docente['email']; ?></td> -->
                                            <td class="text-center"><?= $docente['integrador'] == 'NO' ? "NO" : "SI"; ?></td>
                                            <td class="text-center">
                                                <?php
                                                if ($docente['estado'] == "1") { ?>
                                                    <button class="btn btn-success btn-sm" style="border-radius: 20px">ACTIVO</button>
                                                <?php
                                                } else { ?>
                                                    <button class="btn btn-danger btn-sm" style="border-radius: 20px">INACTIVO</button>
                                                <?php
                                                }
                                                ?>
                                                <div class="modal fade" id="modal_indicador<?= $id_docente; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Indicadores asignados para:  <b><?= $docente['apellidos'] . ', ' . $docente['nombres']; ?></b></h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <table class="table table-bordered table-striped table-hover table-sm">
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
                                                                            <center>Indicador</center>
                                                                        </th>
                                                                        <th>
                                                                            <center>Acciones</center>
                                                                        </th>
                                                                    </tr>
                                                                    <?php
                                                                    $contador = 0;
                                                                    foreach ($asignaciones as $asignacione) {
                                                                        $id_asignacion = $asignacione['id_asignacion_indicadores'];
                                                                        if ($asignacione['docente_id'] == $id_docente) {
                                                                            $contador = $contador + 1; ?>
                                                                            <tr>
                                                                                <!-- <td><center><?= $contador; ?></center></td> -->
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
                                                                                    <center><?= $asignacione['nombre_indicador']; ?></center>
                                                                                </td>
                                                                                <td style="text-align: center">
                                                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                                                        <a data-toggle="modal" data-target="#modal_edicion<?= $id_asignacion; ?>" type="button" title="Editar" class="btn btn-success btn-sm icono-blanco"><i class="bi bi-pencil-square"></i></a>

                                                                                        <!-- INICIO MODAL EDICION -->

                                                                                        <div class="modal fade" id="modal_edicion<?= $id_asignacion; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                                            <div class="modal-dialog modal-dialog-centered">
                                                                                                <div class="modal-content">
                                                                                                    <div class="modal-header" style="background-color:#28a745; color:#FFFFFF">
                                                                                                        <h5 class="modal-title" id="exampleModalLabel"><b>Editar asignación de indicador</b></h5>
                                                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                            <span aria-hidden="true">&times;</span>
                                                                                                        </button>
                                                                                                    </div>
                                                                                                    <div class="modal-body">
                                                                                                        <form action="<?= APP_URL; ?>/app/controllers/docentes/update_asignaciones_indicadores.php" method="post">

                                                                                                            <div class="row">
                                                                                                                <div class="col-md-12">
                                                                                                                    <div class="form-group">
                                                                                                                        <input type="text" name="id_asignacion_indicadores" value="<?=$id_asignacion;?>" hidden>
                                                                                                                        <label for="">Seleccionar nivel y turno</label>
                                                                                                                        <select name="id_nivel" id="" class="form-control">
                                                                                                                            <?php
                                                                                                                            foreach ($niveles as $nivele) {
                                                                                                                                $id_nivel = $nivele['id_nivel']; ?>
                                                                                                                                <option value="<?= $id_nivel; ?>"<?= $nivele['id_nivel'] == $asignacione['nivel_id'] ? 'selected' : '' ?>><?= $nivele['nivel']; ?> - TURNO <?= $nivele['turno']; ?></option>
                                                                                                                            <?php
                                                                                                                            }
                                                                                                                            ?>
                                                                                                                        </select>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <div class="col-md-12">
                                                                                                                    <div class="form-group">
                                                                                                                        <label for="">Seleccionar grado y división</label>
                                                                                                                        <select name="id_grado" id="" class="form-control">
                                                                                                                            <?php
                                                                                                                            foreach ($grados as $grado) {
                                                                                                                                $id_grado = $grado['id_grado']; ?>
                                                                                                                                <option value="<?= $id_grado; ?>" <?= $grado['id_grado'] == $asignacione['grado_id'] ? 'selected' : '' ?>><?= $grado['curso']; ?> - DIVISIÓN <?= $grado['paralelo']; ?></option>
                                                                                                                            <?php
                                                                                                                            }
                                                                                                                            ?>
                                                                                                                        </select>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <div class="col-md-12">
                                                                                                                    <div class="form-group">
                                                                                                                        <label for="">Seleccionar indicador</label>
                                                                                                                        <select name="id_indicador" id="" class="form-control">
                                                                                                                            <?php
                                                                                                                            foreach ($indicadores as $indicadore) {
                                                                                                                                $id_indicador = $indicadore['id_indicador']; ?>
                                                                                                                                <option value="<?= $id_indicador; ?>" <?= $indicadore['id_indicador'] == $asignacione['indicador_id'] ? 'selected' : '' ?>><?= $indicadore['nombre_indicador']; ?></option>
                                                                                                                            <?php
                                                                                                                            }
                                                                                                                            ?>
                                                                                                                        </select>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <div class="modal-footer">
                                                                                                                <button type="submit" class="btn btn-success">Actualizar</button>
                                                                                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                                                                                            </div>
                                                                                                        </form>

                                                                                                    </div>

                                                                                                </div>
                                                                                            </div>
                                                                                        </div>

                                                                                        <form action="<?= APP_URL; ?>/app/controllers/docentes/delete_asignaciones_indicadores.php" onclick="preguntar<?= $id_asignacion; ?>(event)" method="post" id="miFormulario<?= $id_asignacion; ?>">
                                                                                            <input type="text" name="id_asignacion_indicadores" value="<?= $id_asignacion; ?>" hidden>
                                                                                            <button type="submit" title="Eliminar" class="btn btn-danger btn-sm" style="border-radius: 0px 5px 5px 0px"><i class="bi bi-trash"></i></button>
                                                                                        </form>
                                                                                        <script>
                                                                                            function preguntar<?= $id_asignacion; ?>(event) {
                                                                                                event.preventDefault();
                                                                                                Swal.fire({
                                                                                                    title: 'Eliminar asignación',
                                                                                                    text: '¿Desea eliminar esta asignación?',
                                                                                                    icon: 'question',
                                                                                                    showDenyButton: true,
                                                                                                    confirmButtonText: 'Eliminar',
                                                                                                    confirmButtonColor: '#a5161d',
                                                                                                    denyButtonColor: '#270a0a',
                                                                                                    denyButtonText: 'Cancelar',
                                                                                                }).then((result) => {
                                                                                                    if (result.isConfirmed) {
                                                                                                        var form = $('#miFormulario<?= $id_asignacion; ?>');
                                                                                                        form.submit();
                                                                                                        Swal.fire('Eliminado', 'Se eliminó la asignación de manera correcta.', 'success');
                                                                                                    }
                                                                                                });
                                                                                            }
                                                                                        </script>
                                                                                    </div>
                                                                                     <!-- FIN MODAL EDICION -->
                                                                                </td>
                                                                            </tr>
                                                                    <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                </table>

                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td style="text-align: center">
                                                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal_indicador<?= $id_docente; ?>"><i class="bi bi-card-checklist"> </i> Consultar detalle</button>
                                            </td>

                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
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

<script>
    $(function() {
        $("#example1").DataTable({
            "pageLength": 10    ,
            "language": {
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ - _END_ | _TOTAL_ docentes",
                "infoEmpty": "Mostrando 0 - 0 | 0 docentes",
                "infoFiltered": "(Filtrado de _MAX_ total docentes)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ docentes",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscar docentes:",
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

<div class="modal fade" id="modal_asignacion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#17a2b8">
                <h5 class="modal-title" id="exampleModalLabel"><b>Asignar indicador</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= APP_URL; ?>/app/controllers/docentes/create_asignaciones_indicadores.php" method="post">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Seleccionar docente</label>
                                <select name="id_docente" id="" class="form-control">
                                    <?php
                                    foreach ($docentes as $docente) {
                                        $id_docente = $docente['id_docente']; ?>
                                        <option value="<?= $id_docente; ?>"><?= $docente['apellidos']; ?>, <?= $docente['nombres']; ?> </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Seleccionar nivel y turno</label>
                                <select name="id_nivel" id="" class="form-control">
                                    <?php
                                    foreach ($niveles as $nivele) {
                                        $id_nivel = $nivele['id_nivel']; ?>
                                        <option value="<?= $id_nivel; ?>"><?= $nivele['nivel']; ?> - TURNO <?= $nivele['turno']; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Seleccionar grado y división</label>
                                <select name="id_grado" id="" class="form-control">
                                    <?php
                                    foreach ($grados as $grado) {
                                        $id_grado = $grado['id_grado']; ?>
                                        <option value="<?= $id_grado; ?>"><?= $grado['curso']; ?> - DIVISIÓN <?= $grado['paralelo']; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Seleccionar indicador</label>
                                <select name="id_indicador" id="" class="form-control">
                                    <?php
                                    foreach ($indicadores as $indicadore) {
                                        $id_indicador = $indicadore['id_indicador']; ?>
                                        <option value="<?= $id_indicador; ?>"><?= $indicadore['nombre_indicador']; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Asignar</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>