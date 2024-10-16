<?php
include('../../app/config.php');
include('../../admin/layout/parte1.php');

?>
<style>
    .icono-blanco i {
        color: white;
        /* Cambia el color del icono a blanco */
    }

    .uppercase {
        text-transform: uppercase;
        /* Convierte el texto a mayúsculas */
    }
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <br>
    <div class="content">
        <div class="container">
            <div class="row">
                <h2>INSCRIPCIONES <i class="bi bi-chevron-right"></i> AÑO <?= $ano_actual ?></h2>
            </div>
            <br>
            <div class="row">

                <div class="info-box col-md-3 col-sm-6 col-12">
                    <span class="info-box-icon bg-primary"><i class="bi bi-person-lines-fill"></i></span>
                    <v class="info-box-content">
                        <span class="info-box-text">Generar Inscripción</span>
                        <a href="create.php" class="btn btn-primary btn-sm">Nuevo estudiante</a>

                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php

include('../../admin/layout/parte2.php');
include('../../layout/mensajes.php');

?>