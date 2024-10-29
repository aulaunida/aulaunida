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
            <h2 style="margin-left: 20px;"><i class="bi bi-plus-square"></i>  Registrar grado </h2>
            </div>
            <br>
            <div class="row">

                <div class="col-md-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Completar los siguientes datos:</h3>
                        </div>
                        <div class="card-body">
                            <form action="<?=APP_URL;?>/app/controllers/grados/create.php" method="post">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Nivel y turno<b style="color:red">*</b></label>
                                            <select name="nivel_id" id="" class="form-control">
                                                <?php
                                                foreach ($niveles as $nivele){
                                                ?>
                                                    <option value="<?=$nivele['id_nivel'];?>"><?=$nivele['nivel']." - ".$nivele['turno'];?></option>
                                                    <?php
                                                } 
                                                ?>
                                                
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
                                                <option value="PRIMER GRADO">PRIMER GRADO</option>
                                                <option value="SEGUNDO GRADO">SEGUNDO GRADO</option>
                                                <option value="TERCER GRADO">TERCER GRADO</option>
                                                <option value="CUARTO GRADO">CUARTO GRADO</option>
                                                <option value="QUINTO GRADO">QUINTO GRADO</option>
                                                <option value="SEXTO GRADO">SEXTO GRADO</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">División<b style="color:red">*</b></label>
                                            <select name="paralelo" id="" class="form-control">
                                                <option value="A">A</option>
                                                <option value="B">B</option>
                                                <option value="C">C</option>
                                                <option value="D">D</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Registrar</button>
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
