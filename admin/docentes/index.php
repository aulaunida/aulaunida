<?php
include ('../../app/config.php');
include ('../../admin/layout/parte1.php');
include ('../../app/controllers/docentes/listado_de_docentes.php');


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
            <h1 style="margin-left: 20px;"><i class="bi bi-person-video3"></i> Docentes</h1>
            </div>
            <br>
            <div class="row">

                <div class="col-md-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Docentes registrados</h3>
                            <div class="card-tools">
                                <a href="create.php" class="btn btn-primary"><i class="bi bi-plus-square"></i> Registrar docente</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-striped table-bordered table-hover table-sm">
                                <thead>
                                <tr> 
                                    <th><center>Docente</center></th>
                                    <!-- <th><center>Rol</center></th> -->
                                    <!-- <th><center>DNI</center></th> -->
                                    <!-- <th><center>Fecha de nacimiento</center></th> -->
                                    <th><center>Correo electrónico</center></th>
                                    <th><center>Integrador</center></th>
                                    <th><center>Tipo de cargo</center></th>
                                    <th><center>Estado</center></th>
                                    <th><center>Acciones</center></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $contador_docentes = 0;
                                foreach ($docentes as $docente){
                                    $id_docente = $docente['id_docente'];
                                    $contador_docentes = $contador_docentes +1; ?>
                                    <tr>
                                        <!-- <td style="text-align: center"><?=$contador_docentes;?></td> -->
                                        <td class="uppercase" style="text-align: center"><?=$docente['apellidos'] .', '. $docente['nombres'];?></td>
                                        <!-- <td style="text-align: center"><?=$docente['nombre_rol'];?></td> -->
                                        <!-- <td style="text-align: center"><?=$docente['dni'];?></td> -->
                                        <!-- <td style="text-align: center"><?=$docente['fecha_nacimiento'];?></td> -->
                                        <td class="uppercase" style="text-align: center"><?=$docente['email'];?></td>
                                        <td class="text-center"><?= $docente['integrador'] == 'NO' ? "NO" : "SI";?></td>
                                        <td class="text-center"><?= $docente['tipo_cargo'] == 'TITULAR' ? "TITULAR" : "SUPLENTE";?></td>
                                        <td class="text-center">
                                            <?php
                                            if($docente['estado'] == "1"){ ?>
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
                                                <a href="show.php?id=<?=$id_docente;?>" type="button" title="Consultar detalles" class="btn btn-info btn-sm"><i class="bi bi-eye"></i></a>
                                                <a href="edit.php?id=<?=$id_docente;?>" type="button" title="Editar" class="btn btn-success btn-sm icono-blanco"><i class="bi bi-pencil-square"></i></a>
                                                <form action="<?=APP_URL;?>/app/controllers/docentes/delete.php" onclick="preguntar<?=$id_docente;?>(event)" method="post" id="miFormulario<?=$id_docente;?>">
                                                    <input type="text" name="id_docente" value="<?=$id_docente;?>" hidden>
                                                    <button type="submit" title="Eliminar" class="btn btn-danger btn-sm" style="border-radius: 0px 5px 5px 0px"><i class="bi bi-trash"></i></button>
                                                </form>
                                                <script>
                            function preguntar<?=$id_docente;?>(event) {
                                event.preventDefault();
                                Swal.fire({
                                    title: 'Eliminar docente existente',
                                    text: '¿Desea eliminar este docente?',
                                    icon: 'question',
                                    showDenyButton: true,
                                    confirmButtonText: 'Eliminar',
                                    confirmButtonColor: '#a5161d',
                                    denyButtonColor: '#270a0a',
                                    denyButtonText: 'Cancelar',
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        var form = $('#miFormulario<?=$id_docente;?>');
                                        form.submit();
                                        Swal.fire('Eliminado', 'Se eliminó el docente correctamente', 'success');
                                    }
                                });
                            }
                            </script>
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
                        <div class="form-group ">
                        <a href="<?=APP_URL;?>/admin/index.php" class="btn btn-danger">Volver</a>
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
            "pageLength": 10,
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
            "responsive": true, "lengthChange": true, "autoWidth": false,
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
                    text: 'Visualizar',
                    collectionLayout: 'fixed three-column'
                }
            ],
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>