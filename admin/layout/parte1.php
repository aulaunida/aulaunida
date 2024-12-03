<?php
session_start();

if (isset($_SESSION['sesion_email'])) {
    // echo "el usuarios paso por el login";
    $email_sesion = $_SESSION['sesion_email'];
    $query_sesion = $pdo->prepare("SELECT * FROM usuarios as usu 
    INNER JOIN personas AS per ON per.usuario_id = usu.id_usuario
    INNER JOIN roles AS rol ON rol.id_rol = usu.rol_id 
    WHERE usu.email = '$email_sesion' 
    AND usu.estado = '1' ");
    $query_sesion->execute();

    $datos_sesion_usuarios = $query_sesion->fetchAll(PDO::FETCH_ASSOC);
    foreach ($datos_sesion_usuarios as $datos_sesion_usuario) {
        $nombre_sesion_usuario =   $datos_sesion_usuario['apellidos'] . ', ' . $datos_sesion_usuario['nombres'];
        $rol_sesion_usuario = $datos_sesion_usuario['nombre_rol'];
    }
} else {
    //echo "el usuario no paso por el login";
    header('Location:' . APP_URL . "/login");
}


?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= APP_NAME; ?></title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?= APP_URL; ?>/public/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= APP_URL; ?>/public/dist/css/adminlte.min.css">

    <!-- jQuery -->
    <script src="<?= APP_URL; ?>/public/plugins/jquery/jquery.min.js"></script>

    <!-- Sweetaler2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <!-- Iconos de bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Datatables -->
    <link rel="stylesheet" href="<?= APP_URL; ?>/public/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= APP_URL; ?>/public/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= APP_URL; ?>/public/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

    <!-- CHART -->

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

     <!-- Place the first <script> tag in your HTML's <head> -->
     <script src="https://cdn.tiny.cloud/1/7bc9bpvjffgio737txzw1xbe5vzipzqaald4o4ol8n6xue0f/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>


   

</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <script>
            <?php if (isset($_SESSION['mensaje']) && isset($_SESSION['icono']) && isset($_SESSION['timer'])): ?>
                Swal.fire({
                    icon: '<?php echo $_SESSION['icono']; ?>',
                    title: '<?php echo $_SESSION['mensaje']; ?>',
                    showConfirmButton: false,
                    timer: <?php echo $_SESSION['timer']; ?>,
                    timerProgressBar: <?php echo $_SESSION['timerProgressBar']; ?>,
                    <?php if (isset($_SESSION['showCloseButton']) && $_SESSION['showCloseButton']): ?>showCloseButton: true
                <?php endif; ?>
                });
                <?php
                unset($_SESSION['mensaje'], $_SESSION['icono'], $_SESSION['timer'], $_SESSION['showCloseButton']);
                ?>
            <?php endif; ?>
        </script>
</body>

</html>

<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="<?= APP_URL; ?>/admin" class="nav-link"><i class="bi bi-house-fill"></i>  Instituto Primario <b>Arturo Capdevila</b></a>

        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
    </ul>
</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= APP_URL; ?>/admin" class="brand-link">
        <img src="<?= APP_URL; ?>/public/images/logoau.png" alt="AulaUnida Logo" class="brand-image" style="width: 36px;">
        <span class="brand-text d-none d-sm-inline">Aula Unida®</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="https://cdn-icons-png.flaticon.com/512/6073/6073873.png" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?= $nombre_sesion_usuario; ?></a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->


                <!-- INICIO VISTA DOCENTE -->

                <?php
                if ($rol_sesion_usuario == 'DOCENTE') { ?>
                    <li class="nav-item">
                        <a href="#" class="nav-link active">
                            <i class="nav-icon fas"><i class="bi bi-graph-up-arrow"></i></i>
                            <p>
                                Indicadores

                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= APP_URL; ?>/admin/estadisticas/index.php" class="nav-link active">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Consultar indicadores</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= APP_URL; ?>/admin/repitencias" class="nav-link active">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Registrar repitencia</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= APP_URL; ?>/admin/abandonos" class="nav-link active">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Registrar abandono</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= APP_URL; ?>/admin/participaciones" class="nav-link active">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Registrar participaciones</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link active">
                            <i class="nav-icon fas"><i class="bi bi-clipboard-data"></i></i>
                            <p>
                                Calificaciones
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>

                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= APP_URL; ?>/admin/calificaciones" class="nav-link active">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Consultar calificaciones</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link active">
                            <i class="nav-icon fas"><i class="bi bi-journal-check"></i></i>
                            <p>
                                Informes
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>

                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= APP_URL; ?>/admin/informes" class="nav-link active">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Consultar informes</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link active">
                            <i class="nav-icon fas"><i class="bi bi-calendar2-check"></i></i>
                            <p>
                                Asistencias
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>

                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= APP_URL; ?>/admin/asistencias" class="nav-link active">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Consultar asistencias</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link active">
                            <i class="nav-icon fas"><i class="bi bi-question-square"></i></i>
                            <p>
                                Ayuda
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= APP_URL; ?>/admin/ayuda" class="nav-link active">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Ver información</p>
                                </a>
                            </li>
                        </ul>
                    </li>


                    <!-- Botón de Cerrar Sesión -->
                    <li class="nav-item">
                        <a href="<?= APP_URL; ?>/login/logout.php" class="nav-link" style="background-color: #c52510;color:white" class="btn btn-danger btn-block" onclick="return confirmarCierreSesion();" >
                           <i class="nav-icon fas"><i class="bi bi-door-open"></i></i>
                            <p>Cerrar Sesión </p>
                    </a>
                    </li>


                <?php
                }
                ?>

                <!-- FIN VISTA DOCENTE -->

                <!-- INICIO VISTA ADMINISTRATIVO -->

                <?php
                if ($rol_sesion_usuario == 'ADMINISTRADOR') { ?>
                    <!-- <li class="nav-item">
                        <a href="#" class="nav-link active">
                            <i class="nav-icon fas"><i class="bi bi-graph-up-arrow"></i></i>
                            <p>
                            Indicadores 
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= APP_URL; ?>/admin/estadisticas/index.php" class="nav-link active">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Consultar indicadores</p>
                                </a>
                            </li>
                        </ul>
                    </li> -->

                    <li class="nav-item">
                        <a href="#" class="nav-link active">
                            <i class="nav-icon fas"><i class="bi bi-calendar4-week"></i></i>
                            <p>
                                Ciclos lectivos
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= APP_URL; ?>/admin/configuraciones/gestion" class="nav-link active">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Consultar ciclos lectivos</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= APP_URL; ?>/admin/niveles" class="nav-link active">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Asignar ciclos lectivos</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link active">
                            <i class="nav-icon fas"><i class="bi bi-bar-chart-steps"></i></i></i>
                            <p>
                                Grados
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= APP_URL; ?>/admin/grados" class="nav-link active">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Consultar grados</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link active">
                            <i class="nav-icon fas"><i class="bi bi-journal-bookmark"></i></i></i>
                            <p>
                                Materias
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= APP_URL; ?>/admin/materias" class="nav-link active">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Consultar materias</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link active">
                            <i class="nav-icon fas"><i class="bi bi-journal-bookmark"></i></i></i>
                            <p>
                                Indicadores
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= APP_URL; ?>/admin/indicadores" class="nav-link active">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Consultar indicadores</p>
                                </a>
                            </li>
                        </ul>
                    </li>


                    <li class="nav-item">
                        <a href="#" class="nav-link active">
                            <i class="nav-icon fas"><i class="bi bi-person-video3"></i></i>
                            <p>
                                Docentes
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= APP_URL; ?>/admin/docentes" class="nav-link active">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Consultar docentes</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= APP_URL; ?>/admin/docentes/asignacion.php" class="nav-link active">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Asignar materias</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= APP_URL; ?>/admin/docentes/asignacion_indicadores.php" class="nav-link active">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Asignar indicadores</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link active">
                            <i class="nav-icon fas"><i class="bi bi-person-square"></i></i>
                            <p>
                                Alumnos
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>

                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= APP_URL; ?>/admin/estudiantes" class="nav-link active">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Consultar alumnos</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link active">
                            <i class="nav-icon fas"><i class="bi bi-people-fill"></i></i>
                            <p>
                                Usuarios
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= APP_URL; ?>/admin/administrativos" class="nav-link active">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Consultar usuarios</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= APP_URL; ?>/admin/roles" class="nav-link active">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Consultar roles</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- <li class="nav-item">
                        <a href="#" class="nav-link active">
                            <i class="nav-icon fas"><i class="bi bi-gear"></i></i>
                            <p>
                                Configuraciones
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= APP_URL; ?>/admin/configuraciones" class="nav-link active">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Ver ajustes</p>
                                </a>
                            </li>
                        </ul>
                    </li> -->
                    <li class="nav-item">
                        <a href="#" class="nav-link active">
                            <i class="nav-icon fas"><i class="bi bi-question-square"></i></i>
                            <p>
                                Ayuda
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= APP_URL; ?>/admin/ayuda" class="nav-link active">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Ver información</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- Botón de Cerrar Sesión -->
                    <li class="nav-item">
                        <a href="<?= APP_URL; ?>/login/logout.php" class="nav-link" style="background-color: #c52510;color:white" class="btn btn-danger btn-block" onclick="return confirmarCierreSesion();" >
                           <i class="nav-icon fas"><i class="bi bi-door-open"></i></i>
                            <p>Cerrar Sesión </p>
                    </a>
                    </li>
                    

                    


                <?php
                }
                ?>

                <!-- FIN VISTA ADMINISTRATIVO -->




            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

