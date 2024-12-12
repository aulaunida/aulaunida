<?php
include ('../../app/config.php');
include ('../../admin/layout/parte1.php');

include ('../../app/controllers/usuarios/listado_de_usuarios.php');

?>
<style>
.icono-blanco i {
    color: white;
}
.uppercase {
    text-transform: uppercase;
}
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <br>
    <div class="content">
        <div class="container">
            <div class="row">
            <h1 style="margin-left: 20px;"><i class="bi bi-people-fill"></i></i> Usuarios</h1>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Usuarios registrados</h3>
                            <div class="card-tools">
                                <a href="<?=APP_URL;?>/admin/administrativos/create.php" class="btn btn-primary"><i class="bi bi-plus-square"></i> Registrar usuario administrador</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-striped table-bordered table-hover table-sm">
                                <thead>
                                <tr>
                                    <!-- <th><center>Orden</center></th> -->
                                    <th style="text-align: left;">Apellido y nombre</th> 
                                    <th style="text-align: left;">Rol</th>
                                    <th style="text-align: left;">Correo electrónico</th>
                                    <!-- <th style="text-align: left;">Fecha de creación</th> -->
                                    <th style="text-align: center;">Estado</th>
                                    <th style="text-align: center;">Acciones</th>

                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $contador_usuarios = 0;
                                foreach ($usuarios as $usuario){
                                    $id_usuario = $usuario['id_usuario'];
                                    $contador_usuarios = $contador_usuarios +1; ?>
                                    <tr>
                                        <!-- <td style="text-align: center"><?=$contador_usuarios;?></td> -->
                                        <td style="text-align: left"><?=$usuario['apellidos'].' , '.$usuario['nombres'];?></td>
                                        <td style="text-align: left"><?=$usuario['nombre_rol'];?></td>
                                        <td class="uppercase" style="text-align: left"><?=$usuario['email'];?></td>
                                        <!-- <td>?=$usuario['fyh_creacion'];?></td> -->
                                        <!-- <td>?=$usuario['estado'] == '1' ? "Activo" : "Inactivo"; ?></td> -->
                                        <td class="text-center">
                                            <?php
                                            if($usuario['estado'] == "1"){ ?>
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
                                                <a href="show.php?id=<?=$id_usuario;?>" type="button" title="Consultar detalles" class="btn btn-info btn-sm"><i class="bi bi-eye"></i></a>
                                                <a href="edit.php?id=<?=$id_usuario;?>" type="button" title="Editar" class="btn btn-success btn-sm icono-blanco"><i class="bi bi-pencil-square"></i></a>
                                                <form action="<?=APP_URL;?>/app/controllers/usuarios/delete.php" onclick="preguntar<?=$id_usuario;?>(event)" method="post" id="miFormulario<?=$id_usuario;?>">
                                                    <input type="text" name="id_usuario" value="<?=$id_usuario;?>" hidden>
                                                    <button type="submit" title="Eliminar" class="btn btn-danger btn-sm" style="border-radius: 0px 5px 5px 0px"><i class="bi bi-trash"></i></button>
                                                </form>
                                                <script>
                            function preguntar<?=$id_usuario;?>(event) {
                                event.preventDefault();
                                Swal.fire({
                                    title: 'Eliminar usuario existente',
                                    text: '¿Desea eliminar este usuario?',
                                    icon: 'question',
                                    showDenyButton: true,
                                    confirmButtonText: 'Eliminar',
                                    confirmButtonColor: '#a5161d',
                                    denyButtonColor: '#270a0a',
                                    denyButtonText: 'Cancelar',
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        var form = $('#miFormulario<?=$id_usuario;?>');
                                        form.submit();
                                        Swal.fire('Eliminado', 'se eliminó el usuario correctamente', 'success');
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
            "pageLength": 10,
            "language": {
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ - _END_ | _TOTAL_ Usuarios",
                "infoEmpty": "Mostrando 0 - 0 | 0 Usuarios",
                "infoFiltered": "(Filtrado de _MAX_ total Usuarios)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Usuarios",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscar usuarios:",
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