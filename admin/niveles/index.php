<?php
include ('../../app/config.php');
include ('../../admin/layout/parte1.php');

include ('../../app/controllers/niveles/listado_de_niveles.php');

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <br>
    <div class="content">
        <div class="container">
            <div class="row">
            <h2 style="margin-left: 20px;"><i class="bi bi-file-earmark-plus"></i>  Asignar ciclos lectivos </h2>
            </div>
            <br>
            <div class="row">

                <div class="col-md-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Ciclos lectivos registrados</h3>
                            <div class="card-tools">
                                <a href="create.php" class="btn btn-primary"><i class="bi bi-plus-square"></i> Asignar ciclo lectivo</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-striped table-bordered table-hover table-sm">
                                <thead>
                                <tr>
                                    <!-- <th><center>Nro</center></th> -->
                                    <th>Ciclo lectivo</th>
                                    <th><center>Nivel</center></th>
                                    <th><center>Turno</center></th>
                                    <th><center>Estado</center></th>
                                    <th><center>Acciones</center></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $contador_niveles = 0;
                                foreach ($niveles as $nivele){
                                    $id_nivel = $nivele['id_nivel'];
                                    $contador_niveles = $contador_niveles +1; ?>
                                    <tr>
                                        <!-- <td style="text-align: center"><?=$contador_niveles;?></td> -->
                                        <td style=""><?=$nivele['gestion'];?></td>
                                        <td style="text-align: center"><?=$nivele['nivel'];?></td>
                                        <td style="text-align: center"><?=$nivele['turno'];?></td>
                                        <td style="text-align: center">
                                            <?php
                                            if($nivele['estado'] == "1"){ ?>
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
                                                <a href="show.php?id=<?=$id_nivel;?>" type="button" title="Consultar detalles" class="btn btn-info btn-sm"><i class="bi bi-eye"></i></a>
                                                <a href="edit.php?id=<?=$id_nivel;?>" type="button" title="Editar" class="btn btn-success btn-sm"><i class="bi bi-pencil"></i></a>
                                                <form action="<?=APP_URL;?>/app/controllers/niveles/delete.php" onclick="preguntar<?=$id_nivel;?>(event)" method="post" id="miFormulario<?=$id_nivel;?>">
                                                    <input type="text" name="id_nivel" value="<?=$id_nivel;?>" hidden>
                                                    <button type="submit" title="Eliminar" class="btn btn-danger btn-sm" style="border-radius: 0px 5px 5px 0px"><i class="bi bi-trash"></i></button>
                                                </form>
                                                <script>
                                                    function preguntar<?=$id_nivel;?>(event) {
                                                        event.preventDefault();
                                                        Swal.fire({
                                                            title: 'Eliminar ciclo lectivo',
                                                            text: '¿Desea eliminar este registro?',
                                                            icon: 'question',
                                                            showDenyButton: true,
                                                            confirmButtonText: 'Eliminar',
                                                            confirmButtonColor: '#a5161d',
                                                            denyButtonColor: '#270a0a',
                                                            denyButtonText: 'Cancelar',
                                                        }).then((result) => {
                                                            if (result.isConfirmed) {
                                                                var form = $('#miFormulario<?=$id_nivel;?>');
                                                                form.submit();
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
                                        <a href="<?= APP_URL; ?>/admin" class="btn btn-danger">Volver</a>
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
                "info": "Mostrando _START_ - _END_ | _TOTAL_ Ciclos lectivos",
                "infoEmpty": "Mostrando 0 - 0 | 0 Ciclos lectivos",
                "infoFiltered": "(Filtrado de _MAX_ total Niveles)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Ciclos lectivos",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscar ciclos lectivos:",
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
                    text: 'Copiar todo el texto',
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
                    text: 'Visualizar ',
                    collectionLayout: 'fixed three-column'
                }
            ],
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>