<?php
include ('../../app/config.php');
include ('../../admin/layout/parte1.php');

include ('../../app/controllers/administrativos/listado_de_administrativos.php');


?>
<style>
.icono-blanco i {
    color: white; /* Cambia el color del icono a blanco */
}
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <br>
    <div class="content">
        <div class="container">
            <div class="row">
                <h1>Administrativos <i class="bi bi-chevron-right"></i> Ver listado de personal administrativo</h1>
            </div>
            <br>
            <div class="row">

                <div class="col-md-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Administrativos registrados</h3>
                            <div class="card-tools">
                                <a href="create.php" class="btn btn-primary"><i class="bi bi-plus-square"></i> Crear nuevo administrativo</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-striped table-bordered table-hover table-sm">
                                <thead>
                                <tr> 
                                    <th><center>Nombre del usuario</center></th>
                                    <th><center>Rol</center></th>
                                    <th><center>DNI</center></th>
                                    <th><center>Fecha de nacimiento</center></th>
                                    <th><center>Correo electrónico</center></th>
                                    <th><center>Estado</center></th>
                                    <th><center>Acciones</center></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $contador_administrativos = 0;
                                foreach ($administrativos as $administrativo){
                                    $id_administrativo = $administrativo['id_administrativo'];
                                    $contador_administrativos = $contador_administrativos +1; ?>
                                    <tr>
                                        <!-- <td style="text-align: center"><?=$contador_administrativos;?></td> -->
                                        <td style="text-align: center"><?=$administrativo['nombres'] .' '. $administrativo['apellidos'];?></td>
                                        <td style="text-align: center"><?=$administrativo['nombre_rol'];?></td>
                                        <td style="text-align: center"><?=$administrativo['dni'];?></td>
                                        <td style="text-align: center"><?=$administrativo['fecha_nacimiento'];?></td>
                                        <td style="text-align: center"><?=$administrativo['email'];?></td>
                                        <td class="text-center">
                                            <?php
                                            if($administrativo['estado'] == "1"){ ?>
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
                                                <a href="show.php?id=<?=$id_administrativo;?>" type="button" title="Ver" class="btn btn-info btn-sm"><i class="bi bi-eye"></i></a>
                                                <a href="edit.php?id=<?=$id_administrativo;?>" type="button" title="Editar" class="btn btn-success btn-sm icono-blanco"><i class="bi bi-pencil-square"></i></a>
                                                <!-- <form action="<?=APP_URL;?>/app/controllers/administrativos/delete.php" onclick="preguntar<?=$id_administrativo;?>(event)" method="post" id="miFormulario<?=$id_administrativo;?>">
                                                    <input type="text" name="id_administrativo" value="<?=$id_administrativo;?>" hidden>
                                                    <button type="submit" title="Eliminar" class="btn btn-danger btn-sm" style="border-radius: 0px 5px 5px 0px"><i class="bi bi-trash"></i></button>
                                                </form>
                                                <script>
                            function preguntar<?=$id_administrativo;?>(event) {
                                event.preventDefault();
                                Swal.fire({
                                    title: 'Eliminar administrativo existente',
                                    text: '¿Desea eliminar este administrativo?',
                                    icon: 'question',
                                    showDenyButton: true,
                                    confirmButtonText: 'Eliminar',
                                    confirmButtonColor: '#a5161d',
                                    denyButtonColor: '#270a0a',
                                    denyButtonText: 'Cancelar',
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        var form = $('#miFormulario<?=$id_administrativo;?>');
                                        form.submit();
                                        Swal.fire('Eliminado', 'Se eliminó el administrativo correctamente', 'success');
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
            "pageLength": 25,
            "language": {
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ - _END_ | _TOTAL_ Administrativos",
                "infoEmpty": "Mostrando 0 - 0 | 0 Administrativos",
                "infoFiltered": "(Filtrado de _MAX_ total Administrativos)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Administrativos",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscar administrativo:",
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