<?php
$id_grado = $_GET['id'];
include('../../app/config.php');
include('../../admin/layout/parte1.php');

include('../../app/controllers/grados/datos_grados.php');
include('../../app/controllers/niveles/listado_de_niveles.php');

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <br>
    <div class="content">
        <div class="container">
            <div class="row">
                <h2 style="margin-left: 20px;"><i class="bi bi-pencil-square"></i> Editar grado: <b><?=$curso;?></b> </h2>
            </div>
            <br>
            <div class="row">

                <div class="col-md-12">
                    <div class="card card-outline card-success">
                        <div class="card-header">
                         <h3 class="card-title">Editar los siguientes campos:</h3>
                        </div>
                        <div class="card-body">
                            <form action="<?=APP_URL;?>/app/controllers/grados/update.php" method="post">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Nivel y turno<b style="color:red">*</b></label>
                                            <input type="text" name="id_grado" value="<?=$id_grado;?>" hidden>
                                            <select name="nivel_id" id="" class="form-control">
                                                <?php
                                                foreach ($niveles as $nivele){
                                                ?>
                                                    <option value="<?=$nivele['id_nivel'];?>"<?=$nivel_id==$nivele['id_nivel'] ? 'selected' : ''?>><?=$nivele['nivel']." - ".$nivele['turno'];?></option>
                                                    <?php
                                                } 
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Grado<b style="color:red">*</b></label>
                                            <select name="curso" id="" class="form-control">
                                                <option value="PRIMER GRADO" <?=$curso=='PRIMER GRADO' ? 'selected' : ''?>>PRIMER GRADO</option>
                                                <option value="SEGUNDO GRADO" <?=$curso=='SEGUNDO GRADO' ? 'selected' : ''?>>SEGUNDO GRADO</option>
                                                <option value="TERCER GRADO" <?=$curso=='TERCER GRADO' ? 'selected' : ''?>>TERCER GRADO</option>
                                                <option value="CUARTO GRADO" <?=$curso=='CUARTO GRADO' ? 'selected' : ''?>>CUARTO GRADO</option>
                                                <option value="QUINTO GRADO" <?=$curso=='QUINTO GRADO' ? 'selected' : ''?>>QUINTO GRADO</option>
                                                <option value="SEXTO GRADO" <?=$curso=='SEXTO GRADO' ? 'selected' : ''?>>SEXTO GRADO</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">División<b style="color:red">*</b></label>
                                            <select name="paralelo" id="" class="form-control">
                                                <option value="A"<?=$paralelo=='A' ? 'selected' : ''?>>A</option>
                                                <option value="B"<?=$paralelo=='B' ? 'selected' : ''?>>B</option>
                                                <option value="C"<?=$paralelo=='C' ? 'selected' : ''?>>C</option>
                                                <option value="D"<?=$paralelo=='D' ? 'selected' : ''?>>D</option>
                                                <option value="E"<?=$paralelo=='E' ? 'selected' : ''?>>E</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success">Actualizar</button>
                                            <a href="<?=APP_URL;?>/admin/grados" class="btn btn-danger">Cancelar</a>
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
