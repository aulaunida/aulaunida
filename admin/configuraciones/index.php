<?php
include ('../../app/config.php');
include ('../../admin/layout/parte1.php');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <br>
    <div class="content">
        <div class="container">
            <div class="row">
            <h1 style="margin-left: 20px;"><i class="bi bi-gear"></i></i> Configuraciones</h1>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4 col-sm-4 col-4">
                    <div class="info-box">
                        <span class="info-box-icon bg-primary"><i class="bi bi-hospital"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text"><b>Instituciones educativas</b></span>
                            <a href="institucion" class="btn btn-primary btn-sm">Configurar</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-4">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="bi bi-calendar-range"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text"><b>Ciclos lectivos</b></span>
                            <a href="gestion" class="btn btn-info btn-sm">Configurar</a>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group ">
                        <a href="<?= APP_URL; ?>/admin" class="btn btn-danger">Volver</a>
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

