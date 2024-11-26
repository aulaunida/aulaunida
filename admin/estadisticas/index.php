<?php
include('../../app/config.php');
include('../../admin/layout/parte1.php');
include('../../app/controllers/roles/listado_de_roles.php');
include('../../app/controllers/usuarios/listado_de_usuarios.php');
include('../../app/controllers/niveles/listado_de_niveles.php');
include('../../app/controllers/grados/listado_de_grados.php');
include('../../app/controllers/materias/listado_de_materias.php');
include('../../app/controllers/docentes/listado_de_docentes.php');
include('../../app/controllers/estudiantes/listado_de_estudiantes.php');
include('../../app/controllers/docentes/listado_de_asignaciones.php');
?>
 <style>
        .small-box {
    border-radius: 500%; /* Redondea los bordes para que sea circular u ovalado */
    width: 300px; /* Ajusta el ancho */
    height: 150px; /* Ajusta la altura para mantener la forma circular */
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
}
.bg-pastel-blue {
    background-color: #a8d0e6;
}

.bg-pastel-green {
    background-color: #b8e994;
}

.bg-pastel-yellow {
    background-color: #ffdd94;
}

.bg-pastel-pink {
    background-color: #ffcbc1;
}

.bg-pastel-purple {
    background-color: #d4a5a5;
}

.bg-pastel-mint {
    background-color: #a4deaa;
}
    </style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   
    <br>
    <div class="container">
        <div class="container">
            <div class="row">
                <h1 style="margin-left: 20px;"><i class="bi bi-graph-up-arrow"></i> Estadísticas</h1>
            </div>
            <br>
            <div class="row">
                <div class="col-lg-4 col-4">
                        <div class="small-box bg-pastel-blue">
                            <div class="inner">
                                <?php
                                $contador_repitencia = 1;
                                ?>
                                <h3><?= $contador_repitencia; ?></h3>
                                <p>Repitencia</p>
                            </div>
                            <div style="color: white;" class="icon">
                                <i class="fas"></i>
                            </div>
                            <a href="<?= APP_URL; ?>/admin/estadisticas/repitencia.php" class="small-box-footer">
                            Ver gráfico <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                <div class="col-lg-4 col-4">
                    <div class="small-box bg-pastel-green">
                        <div class="inner">
                            <?php
                            $contador_integrados = 2;
                            ?>
                            <h3><?= $contador_integrados; ?></h3>
                            <p>Alumnos integrados</p>
                        </div>
                        <div class="icon">
                            <i class="fas"></i>
                        </div>
                        <a href="<?= APP_URL; ?>/admin/estadisticas/integrados.php" class="small-box-footer">
                        Ver gráfico <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-4">
                    <div class="small-box bg-pastel-yellow">
                        <div class="inner">
                            <?php
                            $contador_calificaciones = 3;
                            ?>
                            <h3><?= $contador_calificaciones; ?></h3>
                            <p>Progreso escolar</p>
                        </div>
                        <div class="icon">
                            <i class="fas"></i>
                        </div>
                        <a href="<?= APP_URL; ?>/admin/estadisticas/progreso.php" class="small-box-footer">
                        Ver gráfico <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                    <div class="col-lg-4 col-4">
                        <div class="small-box bg-pastel-pink">
                            <div class="inner">
                                <?php
                                $contador_tiempo = 4;
                                ?>
                                <h3><?= $contador_tiempo; ?></h3>
                                <p>Participación de la familia</p>
                            </div>
                            <div class="icon">
                                <i class="fas"></i>
                            </div>
                            <a href="<?= APP_URL; ?>/admin/estadisticas/familia.php" class="small-box-footer">
                                Ver gráfico <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-4">
                        <div class="small-box bg-pastel-purple">
                            <div class="inner">
                                <?php
                                $contador_abandono = 5;
                                ?>
                                <h3><?= $contador_abandono; ?></h3>
                                <p>Abandono escolar</p>
                            </div>
                            <a href="<?= APP_URL; ?>/admin/estadisticas/abandono_escolar.php" class="small-box-footer">
                            Ver gráfico <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <!-- <div class="col-lg-4 col-4">
                        <div class="small-box bg-pastel-mint">
                            <div class="inner">
                                <?php
                                $contador_habilidades = 6;
                                ?>
                                <h3><?= $contador_habilidades; ?></h3>
                                <p>Dias sin clases</p>
                            </div>
                            <a href="<?= APP_URL; ?>/admin/estadisticas/donut3d.php" class="small-box-footer">
                            Ver gráfico <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div> -->
                </div>
                <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group ">
                                        <a href="<?= APP_URL; ?>/admin/index.php" class="btn btn-danger">Volver</a>
                                    </div>
                                </div>
                            </div>

            <!-- FIN VISTA PARA EL ADMINISTRADOR -->
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