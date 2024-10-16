<?php
include ('../../app/config.php');
include ('../../admin/layout/parte1.php');

include ('../../app/controllers/estudiantes/listado_de_estudiantes.php');


?>
<style>
.icono-blanco i {
    color: white; /* Cambia el color del icono a blanco */
}

.uppercase {
    text-transform: uppercase; /* Convierte el texto a mayúsculas */
}
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <br>
    <div class="content">
        <div class="container">
            <div class="row">
                <h2>ESTUDIANTES <i class="bi bi-chevron-right"></i> CONSULTAR ESTUDIANTES</h2>
            </div>
            <br>
            <div class="row">

                <div class="col-md-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Estudiantes registrados</h3>
                            <div class="card-tools">
                                <a href="../inscripciones/create.php" class="btn btn-primary"><i class="bi bi-plus-square"></i> Registrar estudiante</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-striped table-bordered table-hover table-sm">
                                <thead>
                                <tr> 
                                    <th><center>Estudiante</center></th>
                                    <th><center>Nivel</center></th>
                                    <th><center>Grado</center></th>
                                    <th><center>Turno</center></th>
                                    <th><center>Integración</center></th>
                                    <th><center>Estado</center></th>
                                    <th><center>Acciones</center></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $contador_estudiantes = 0;
                                foreach ($estudiantes as $estudiante){
                                    $id_estudiante = $estudiante['id_estudiante'];
                                    $contador_estudiantes = $contador_estudiantes +1; ?>
                                    <tr>
                                        <!-- <td style="text-align: center"><?=$contador_estudiantes;?></td> -->
                                        <td class="uppercase" style="text-align: center"><?=$estudiante['apellidos'] .', '. $estudiante['nombres'];?></td>
                                        <td style="text-align: center"><?=$estudiante['nivel'];?></td>
                                        <td class="uppercase" style="text-align: center"><?=$estudiante['curso'] .' - '. $estudiante['paralelo'];?></td>
                                        <td class="text-center"><?= $estudiante['turno'];?></td>
                                        <td class="text-center"><?= $estudiante['integracion'] == 'NO' ? "NO" : "SI";?></td>
                                        <td class="text-center">
                                            <?php
                                            if($estudiante['estado'] == "1"){ ?>
                                                <button class="btn btn-success btn-sm" style="border-radius: 20px">ACTIVO</button>
                                            <?php
                                            }else{ ?>
                                                <button class="btn btn-danger btn-sm" style="border-radius: 20px">INACTIVO</button>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                        <td style="text-align: center">
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="show.php?id=<?=$id_estudiante;?>" type="button" title="Consultar detalles" class="btn btn-info btn-sm"><i class="bi bi-eye"></i></a>
                                                <a href="edit.php?id=<?=$id_estudiante;?>" type="button" title="Editar" class="btn btn-success btn-sm icono-blanco"><i class="bi bi-pencil-square"></i></a>
                                                <!-- <form action="<?=APP_URL;?>/app/controllers/estudiantes/delete.php" onclick="preguntar<?=$id_estudiante;?>(event)" method="post" id="miFormulario<?=$id_estudiante;?>">
                                                    <input type="text" name="id_estudiante" value="<?=$id_estudiante;?>" hidden>
                                                    <button type="submit" title="Eliminar" class="btn btn-danger btn-sm" style="border-radius: 0px 5px 5px 0px"><i class="bi bi-trash"></i></button>
                                                </form>
                                                <script>
                            function preguntar<?=$id_estudiante;?>(event) {
                                event.preventDefault();
                                Swal.fire({
                                    title: 'Eliminar estudiante existente',
                                    text: '¿Desea eliminar este estudiante?',
                                    icon: 'question',
                                    showDenyButton: true,
                                    confirmButtonText: 'Eliminar',
                                    confirmButtonColor: '#a5161d',
                                    denyButtonColor: '#270a0a',
                                    denyButtonText: 'Cancelar',
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        var form = $('#miFormulario<?=$id_estudiante;?>');
                                        form.submit();
                                        Swal.fire('Eliminado', 'Se eliminó el estudiante correctamente', 'success');
                                    }
                                });
                            }
                            </script> -->
                                            </div>
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
                        <div class="form-group text-center">
                        <a href="<?=APP_URL;?>/admin/estudiantes/index.php" class="btn btn-danger">Volver</a>
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

include ('../../admin/layout/parte2.php');
include ('../../layout/mensajes.php');

?>

<script>
    $(function () {
        $("#example1").DataTable({
            "pageLength": 25,
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
            "responsive": true, "lengthChange": true, "autoWidth": false,
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
                },{
                    text: 'Descargar en CSV',
                    extend: 'csv'
                },{
                    text: 'Descargar en Excel',
                    extend: 'excel'
                },{
                    text: 'Imprimir Reporte',
                    extend: 'print'
                }
                ]
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