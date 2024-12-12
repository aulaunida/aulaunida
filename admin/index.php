<?php
include('../app/config.php');
include('../admin/layout/parte1.php');
include('../app/controllers/roles/listado_de_roles.php');
include('../app/controllers/usuarios/listado_de_usuarios.php');
include('../app/controllers/niveles/listado_de_niveles.php');
include('../app/controllers/grados/listado_de_grados.php');
include('../app/controllers/materias/listado_de_materias.php');
include('../app/controllers/docentes/listado_de_docentes.php');
include('../app/controllers/estudiantes/listado_de_estudiantes.php');
include('../app/controllers/docentes/listado_de_asignaciones.php');
include('../app/controllers/docentes/listado_de_asignaciones_indicadores.php');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <br>
    <div class="container">
        <div class="container">
            <div class="row">
                <h1 style="margin-left: 20px;"><i class="bi bi-house-fill"></i>  Inicio </h1>
            </div>
            <br>

            <!-- INICIO VISTA PARA EL DOCENTE -->
            <?php
            if ($rol_sesion_usuario == 'DOCENTE') {
                foreach ($docentes as $docente) {
                    if ($email_sesion == $docente['email']) {
                        $integrador = $docente['integrador'];
                        $tipo_cargo = $docente['tipo_cargo'];
                        $nombres = $docente['nombres'];
                        $apellidos = $docente['apellidos'];
                        $dni = $docente['dni'];
                        $fecha_nacimiento = $docente['fecha_nacimiento'];
                        $direccion = $docente['direccion'];
                        $celular = $docente['celular'];
                        $email = $docente['email'];
                    }
                }

            ?>
                <style> /* Aplica flexbox para que ambas tarjetas tengan la misma altura */
                    .row.equal-height {
                        display: flex;
                    }
                    .equal-height .col-md-6 {
                        display: flex;
                        flex-direction: column;
                    }
                    .equal-height .card {
                        flex: 1;
                    }
                </style>
                <div class="row equal-height">
                    <div class="col-md-6">
                        <div class="card card-outline card-success">
                            <div class="card-header">
                                <h3 class="card-title"><i class="bi bi-card-list"></i><b> Mis datos personales</b></h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-sm table-hover table-striped table-bordered">
                                    <tr>
                                            <td><b>Apellido y Nombres</b></td>
                                            <td><?= $nombre_sesion_usuario; ?></td>
                                        </tr>    
                                    <tr>
                                        <td><b>Nro. de documento</b></td>
                                        <td><?= $dni; ?></td>
                                    </tr>
                                   
                                    <tr>
                                        <td><b>Fecha de nacimiento</b></td>
                                        <td><?= $fecha_nacimiento; ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Nro. de celular</b></td>
                                        <td><?= $celular; ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Correo electrónico</b></td>
                                        <td style="text-transform: uppercase;"><?= $email_sesion; ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Domicilio</b></td>
                                        <td style="text-transform: uppercase;"><?= $direccion; ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Barrio</b></td>
                                        <td style="text-transform: uppercase;">Marqués de sobremonte</td>
                                    </tr>
                                    <tr>
                                        <td><b>Localidad</b></td>
                                        <td style="text-transform: uppercase;">Córdoba</td>
                                    </tr>
                                    <tr>
                                        <td><b>Tipo de cargo</b></td>
                                        <td><?= $tipo_cargo; ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Docente integrador</b></td>
                                        <td><?= $integrador; ?></td>
                                    </tr>

                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card card-outline card-warning">
                            <div class="card-header">
                                <h3 class="card-title"><i class="bi bi-megaphone"></i><b> Avisos y novedades</b></h3>
                            </div>
                            <div class="card-body">
                            <style>
                                .carousel-control-prev-icon,
                                .carousel-control-next-icon {
                                    background-color: transparent; /* Fondo transparente */
                                    width: 20px; /* Ajusta el tamaño según necesites */
                                    height: 20px; /* Ajusta el tamaño según necesites */
                                }
                                .carousel-control-prev-icon {
                                    filter: brightness(0) saturate(100%) invert(50%); /* Ajusta el color de la flecha */
                                }
                                .carousel-control-next-icon {
                                    filter: brightness(0) saturate(100%) invert(50%); /* Ajusta el color de la flecha */
                                }
                                .carousel-indicators li {
                                    background-color: gray; /* Color de la barrita (gris) */
                                }
                                .carousel-indicators .active {
                                    background-color: darkgray; /* Color de la barrita activa */
                                }
                            </style>
                                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                    <ol class="carousel-indicators">
                                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                                        <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                                    </ol>
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <img src="../public/images/imagen1.png" class="d-block w-100" alt="...">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="../public/images/imagen2.png" class="d-block w-100" alt="...">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="../public/images/imagen3.png" class="d-block w-100" alt="...">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="../public/images/imagen4.png" class="d-block w-100" alt="...">
                                        </div>
                                    </div>
                                    <button class="carousel-control-prev" type="button" data-target="#carouselExampleIndicators" data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-target="#carouselExampleIndicators" data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            <?php
            }

            ?>

            <!-- FIN VISTA PARA EL DOCENTE -->


            <!-- INICIO VISTA PARA EL ADMINISTRADOR -->
            <?php
            if ($rol_sesion_usuario == 'ADMINISTRADOR') { ?>
                <div class="row">
                    <div class="col-lg-3 col-3">
                        <div class="small-box bg-blue">
                            <div class="inner">
                                <?php
                                $contador_niveles = 0;
                                foreach ($niveles as $nivele) {
                                    $contador_niveles = $contador_niveles + 1;
                                }
                                ?>
                                <h3><?= $contador_niveles; ?></h3>
                                <p>Ciclos lectivos</p>
                            </div>
                            <div class="icon">
                                <i class="fas"><i class="bi bi-calendar4-week"></i></i></i>
                            </div>
                            <a href="<?= APP_URL; ?>/admin/niveles" class="small-box-footer">
                                Más información <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-3">
                        <div class="small-box bg-warning ">
                            <div class="inner">
                                <?php
                                $contador_grados = 0;
                                foreach ($grados as $grado) {
                                    $contador_grados = $contador_grados + 1;
                                }
                                ?>
                                <h3><?= $contador_grados; ?></h3>
                                <p>Grados</p>
                            </div>
                            <div class="icon">
                                <i class="fas"><i class="bi bi-bar-chart-steps"></i></i>
                            </div>
                            <a href="<?= APP_URL; ?>/admin/grados" class="small-box-footer">
                                Más información <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-3">
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <?php
                                $contador_materias = 0;
                                foreach ($materias as $materia) {
                                    $contador_materias = $contador_materias + 1;
                                }
                                ?>
                                <h3><?= $contador_materias; ?></h3>
                                <p>Materias</p>
                            </div>
                            <div class="icon">
                                <i class="fas"><i class="bi bi-journal-bookmark"></i></i>
                            </div>
                            <a href="<?= APP_URL; ?>/admin/materias" class="small-box-footer">
                                Más información <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-3">
                        <div class="small-box bg-green">
                            <div class="inner">
                            <?php
                                $contador_indicadores = 4;
                                ?>
                                <h3><?= $contador_indicadores; ?></h3>
                                <p>Indicadores </p>
                            </div>
                            <div style="color: white;" class="icon">
                                <i class="fas"><i class="bi bi-graph-up-arrow"></i></i>
                            </div>
                            <a href="<?= APP_URL; ?>/admin/indicadores/" class="small-box-footer">
                                Más información <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-3">
                        <div class="small-box bg-indigo   ">
                            <div class="inner">
                                <?php
                                $contador_docentes = 0;
                                foreach ($docentes as $docente) {
                                    $contador_docentes = $contador_docentes + 1;
                                }
                                ?>
                                <h3><?= $contador_docentes; ?></h3>
                                <p>Docentes</p>
                            </div>
                            <div class="icon">
                                <i class="fas"><i class="bi bi-person-video3"></i></i>
                            </div>
                            <a href="<?= APP_URL; ?>/admin/docentes" class="small-box-footer">
                                Más información <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-3">
                        <div class="small-box bg-olive ">
                            <div class="inner">
                                <?php
                                $contador_estudiantes = 0;
                                foreach ($estudiantes as $estudiante) {
                                    $contador_estudiantes = $contador_estudiantes + 1;
                                }
                                ?>
                                <h3><?= $contador_estudiantes; ?></h3>
                                <p>Alumnos</p>
                            </div>
                            <div style="color: white;" class="icon">
                                <i class="fas"><i class="bi bi-person-square"></i></i>
                            </div>
                            <a href="<?= APP_URL; ?>/admin/estudiantes" class="small-box-footer">
                                Más información <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                <div class="col-lg-3 col-3">
                        <div class="small-box bg-orange">
                            <div class="inner">
                                <?php
                                $contador_usuarios = 0;
                                foreach ($usuarios as $usuario) {
                                    $contador_usuarios = $contador_usuarios + 1;
                                }
                                ?>
                                <h3><?= $contador_usuarios; ?></h3>
                                <p>Usuarios</p>
                            </div>
                            <div class="icon">
                                <i class="fas"><i class="bi bi-people-fill"></i></i>
                            </div>
                            <a href="<?= APP_URL; ?>/admin/usuarios" class="small-box-footer">
                                Más información <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-3">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <?php
                                $contador_roles = 0;
                                foreach ($roles as $role) {
                                    $contador_roles = $contador_roles + 1;
                                }
                                ?>
                                <h3><?= $contador_roles; ?></h3>
                                <p>Ayuda</p>
                            </div>
                            <div class="icon">
                                <i class="fas"><i class="bi bi-question-square"></i></i>
                            </div>
                            <a href="<?= APP_URL; ?>/admin/ayuda/" class="small-box-footer">
                                Más información <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    

                    

                    

                    

                    

                    


                </div>
            <?php
            }

            ?>

            <!-- FIN VISTA PARA EL ADMINISTRADOR -->





            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php

include('../admin/layout/parte2.php');
include('../layout/mensajes.php');

?>