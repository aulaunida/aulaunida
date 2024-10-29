<?php

$id_materia = $_GET['id'];
include('../../app/config.php');
include('../../admin/layout/parte1.php');

include('../../app/controllers/materias/datos_materias.php');

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <br>
    <div class="content">
        <div class="container">
            <div class="row">
                <h2 style="margin-left: 20px;"><i class="bi bi-pencil-square"></i> Editar materia: <b><?=$nombre_materia;?></b> </h2>
            </div>
            <br>
            <div class="row">

                <div class="col-md-12">
                    <div class="card card-outline card-success">
                        <div class="card-header">
                            <h3 class="card-title">Editar los siguientes campos:</h3>
                        </div>
                        <div class="card-body">
                            <form action="<?=APP_URL;?>/app/controllers/materias/update.php" method="post">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                        <input type="text" name="id_materia" value="<?=$id_materia;?>" hidden>
                                            <label for="">Nombre materia<b style="color:red">*</b></label>
                                            <input type="text" value="<?=$nombre_materia;?>" name="nombre_materia" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success">Actualizar</button>
                                            <a href="<?=APP_URL;?>/admin/materias" class="btn btn-danger">Cancelar</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
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
