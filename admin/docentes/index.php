<?php
include ('../../app/config.php');
include ('../../admin/layout/parte1.php');
include ('../../app/controllers/docentes/listado_de_docentes.php');

?>

<style>
.icono-blanco i {
    color: white;
}
.uppercase {
    text-transform: uppercase;
}
</style>

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
                            <!-- Mostrar mensajes de la sesión si existen -->
                            <?php if (isset($_SESSION['mensaje'])) { ?>
                                <script>
                                    Swal.fire({
                                        icon: '<?=$_SESSION['icono'];?>',
                                        title: '<?=$_SESSION['mensaje'];?>',
                                        timer: <?=$_SESSION['timer'];?>,
                                        timerProgressBar: <?=$_SESSION['timerProgressBar'] ? 'true' : 'false';?>,
                                        showCloseButton: <?=$_SESSION['showCloseButton'] ? 'true' : 'false';?>
                                    });
                                </script>
                            <?php
                                unset($_SESSION['mensaje'], $_SESSION['icono'], $_SESSION['timer'], $_SESSION['timerProgressBar'], $_SESSION['showCloseButton']);
                            } ?>
                            <table id="example1" class="table table-striped table-bordered table-hover table-sm">
                                <thead>
                                <tr>
                                    <th>Docente</th>
                                    <th>Correo electrónico</th>
                                    <th><center>Integrador</center></th>
                                    <th><center>Tipo de cargo</center></th>
                                    <th><center>Estado</center></th>
                                    <th><center>Acciones</center></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $contador_docentes = 0;
                                foreach ($docentes as $docente) {
                                    $id_docente = $docente['id_docente'];
                                    $contador_docentes++; ?>
                                    <tr>
                                        <td class="uppercase"><?=$docente['apellidos'] . ', ' . $docente['nombres'];?></td>
                                        <td class="uppercase"><?=$docente['email'];?></td>
                                        <td class="text-center"><?=$docente['integrador'] == 'NO' ? "NO" : "SI";?></td>
                                        <td class="text-center"><?=$docente['tipo_cargo'] == 'TITULAR' ? "TITULAR" : "SUPLENTE";?></td>
                                        <td class="text-center">
                                            <?php if ($docente['estado'] == "1") { ?>
                                                <button class="btn btn-success btn-sm" style="border-radius: 20px">ACTIVO</button>
                                            <?php } else { ?>
                                                <button class="btn btn-danger btn-sm" style="border-radius: 20px">INACTIVO</button>
                                            <?php } ?>
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group" role="group">
                                                <a href="show.php?id=<?=$id_docente;?>" class="btn btn-info btn-sm" title="Consultar detalles"><i class="bi bi-eye"></i></a>
                                                <a href="edit.php?id=<?=$id_docente;?>" class="btn btn-success btn-sm icono-blanco" title="Editar"><i class="bi bi-pencil-square"></i></a>
                                                <button class="btn btn-danger btn-sm" style="border-radius: 0px 5px 5px 0px" title="Eliminar" onclick="eliminarDocente(<?=$id_docente;?>)">
                                                    <i class="bi bi-trash"></i>
                                                </button>
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
                                <div class="col-md-12 text-center">
                                    <a href="<?=APP_URL;?>/admin/index.php" class="btn btn-danger">Volver</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include ('../../admin/layout/parte2.php');
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
                "lengthMenu": "Mostrar _MENU_ docentes",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscar docentes:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Último",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false
        });
    });

    function eliminarDocente(id) {
        Swal.fire({
            title: 'Eliminar docente',
            text: '¿Desea eliminar este docente?',
            icon: 'question',
            showDenyButton: true,
            confirmButtonText: 'Eliminar',
            confirmButtonColor: '#a5161d',
            denyButtonText: 'Cancelar',
            denyButtonColor: '#6c757d'
        }).then((result) => {
            if (result.isConfirmed) {
                let form = document.createElement('form');
                form.method = 'POST';
                form.action = '<?=APP_URL;?>/app/controllers/docentes/delete.php';
                let input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'id_docente';
                input.value = id;
                form.appendChild(input);
                document.body.appendChild(form);
                form.submit();
            }
        });
    }
</script>
