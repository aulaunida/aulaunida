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
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <br>
    <div class="container">
        <div class="container">
            <div class="row">
                <h1>MENÚ PRINCIPAL</h1>
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

                <div class="row">
                    <!-- <div class="col-md-2"></div> -->
                    <div class="col-md-6">
                        <div class="card card-outline card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Mis Datos Personales</h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-sm table-hover table-striped table-bordered">
                                    <tr>
                                        <td><b>DNI</b></td>
                                        <td><?= $dni; ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Apellido y Nombre</b></td>
                                        <td><?= $nombre_sesion_usuario; ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Fecha de Nacimiento</b></td>
                                        <td><?= $fecha_nacimiento; ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Teléfono</b></td>
                                        <td><?= $celular; ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Email</b></td>
                                        <td><?= $email_sesion; ?></td>
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
                        <div class="card card-outline card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Avisos y Novedades</h3>
                            </div>
                            <div class="card-body">
                                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                    <ol class="carousel-indicators">
                                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                    </ol>
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <img src="../public/images/imagen1.jpg" class="d-block w-100" alt="...">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="../public/images/imagen2.jpg" class="d-block w-100" alt="...">
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
                        <div class="small-box bg-primary">
                            <div class="inner">
                                <?php
                                $contador_roles = 0;
                                foreach ($roles as $role) {
                                    $contador_roles = $contador_roles + 1;
                                }
                                ?>
                                <h3><?= $contador_roles; ?></h3>
                                <p>Roles</p>
                            </div>
                            <div class="icon">
                                <i class="fas"><i class="bi bi-bookmarks"></i></i>
                            </div>
                            <a href="<?= APP_URL; ?>/admin/roles" class="small-box-footer">
                                Más información <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-3">
                        <div class="small-box bg-info">
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
                        <div class="small-box bg-success">
                            <div class="inner">
                                <?php
                                $contador_niveles = 0;
                                foreach ($niveles as $nivele) {
                                    $contador_niveles = $contador_niveles + 1;
                                }
                                ?>
                                <h3><?= $contador_niveles; ?></h3>
                                <p>Niveles</p>
                            </div>
                            <div class="icon">
                                <i class="fas"><i class="bi bi-bookshelf"></i></i></i>
                            </div>
                            <a href="<?= APP_URL; ?>/admin/niveles" class="small-box-footer">
                                Más información <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-3">
                        <div class="small-box bg-warning">
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
                                <i class="fas"><i class="bi bi-book-half"></i></i>
                            </div>
                            <a href="<?= APP_URL; ?>/admin/materias" class="small-box-footer">
                                Más información <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-3">
                        <div class="small-box bg-light">
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
                        <div class="small-box bg-dark">
                            <div class="inner">
                                <?php
                                $contador_estudiantes = 0;
                                foreach ($estudiantes as $estudiante) {
                                    $contador_estudiantes = $contador_estudiantes + 1;
                                }
                                ?>
                                <h3><?= $contador_estudiantes; ?></h3>
                                <p>Estudiantes</p>
                            </div>
                            <div style="color: white;" class="icon">
                                <i class="fas"><i class="bi bi-person-lines-fill"></i></i>
                            </div>
                            <a href="<?= APP_URL; ?>/admin/estudiantes" class="small-box-footer">
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