<?php
session_start();

if(isset($_SESSION['sesion_email'])){
   // echo "el usuarios paso por el login";
    $email_sesion = $_SESSION['sesion_email'];
    $query_sesion = $pdo->prepare("SELECT * FROM usuarios WHERE email = '$email_sesion' AND estado = '1' ");
    $query_sesion->execute();

    $datos_sesion_usuarios = $query_sesion->fetchAll(PDO::FETCH_ASSOC);
    foreach ($datos_sesion_usuarios as $datos_sesion_usuario){
       $nombre_sesion_usuario = $datos_sesion_usuario['nombres'];
    }
}else{
    //echo "el usuario no paso por el login";
    header('Location:'.APP_URL."/login");
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
    <title><?=APP_NAME;?>®</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?=APP_URL;?>/public/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?=APP_URL;?>/public/dist/css/adminlte.min.css">

    <!-- Sweetaler2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   

    <!-- Iconos de bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Datatables -->
    <link rel="stylesheet" href="<?=APP_URL;?>/public/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?=APP_URL;?>/public/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?=APP_URL;?>/public/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

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
            <a href="<?=APP_URL;?>/admin" class="nav-link">Instituto Primario <b>Arturo Capdevila</b></a>

            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">

            <!-- Notifications Dropdown Menu -->
            <!-- <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-bell"></i>
                    <span class="badge badge-success navbar-badge">7</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-header">7 Notificaciones</span>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-envelope mr-2"></i> 4 nuevos mensajes
                        <span class="float-right text-muted text-sm">3 mins</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-file mr-2"></i> 3 nuevos reportes
                        <span class="float-right text-muted text-sm">2 días</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer">Ver todas las notificaciones</a>
                </div>
            </li> -->
            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
            <!-- <li class="nav-item">
                <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                    <i class="fas fa-th-large"></i>
                </a>
            </li> -->
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="<?=APP_URL;?>/admin" class="brand-link">
            <img src="<?= APP_URL; ?>/public/images/logoau.png" alt="AulaUnida Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">Aula Unida®</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="https://cdn-icons-png.flaticon.com/512/6073/6073873.png" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block"><?=$nombre_sesion_usuario;?></a>
                </div>
            </div>


            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->

                         <li class="nav-item">
                        <a href="#" class="nav-link active">
                            <i class="nav-icon fas"><i class="bi bi-graph-up-arrow"></i></i>
                            <p>
                                Informes
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?=APP_URL;?>/admin/informes/asistencia.php" class="nav-link active">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Asistencia</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?=APP_URL;?>/admin/informes/inasistencia.php" class="nav-link active">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Inasistencia</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?=APP_URL;?>/admin/informes/alumnos_integrados.php" class="nav-link active">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Alumnos integrados</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?=APP_URL;?>/admin/informes/gantt.php" class="nav-link active">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Diagrama de Gantt</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?=APP_URL;?>/admin/informes/spiderchart.php" class="nav-link active">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Gráfico de Radar</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?=APP_URL;?>/admin/informes/scatterplot.php" class="nav-link active">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Gráfico de Dispersión</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?=APP_URL;?>/admin/informes/donut3d.php" class="nav-link active">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Gráfico de Donut 3D</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link active">
                            <i class="nav-icon fas"><i class="bi bi-gear"></i></i>
                        <p>
                            Configuraciones
                            <i class="right fas fa-angle-left"></i>
                        </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?=APP_URL;?>/admin/configuraciones" class="nav-link active">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Administrador</p>
                                </a>
                            </li>
                        </ul>
                    </li>


                    <li class="nav-item">
                        <a href="#" class="nav-link active">
                            <i class="nav-icon fas"><i class="bi bi-bookshelf"></i></i>
                            <p>
                                Niveles educativos
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?=APP_URL;?>/admin/niveles" class="nav-link active">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Listado de niveles</p>
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
                                <a href="<?=APP_URL;?>/admin/grados" class="nav-link active">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Listado de grados</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link active">
                            <i class="nav-icon fas"><i class="bi bi-bookmarks"></i></i>
                            <p>
                                Roles de usuario
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?=APP_URL;?>/admin/roles" class="nav-link active">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Listado de roles</p>
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
                                <a href="<?=APP_URL;?>/admin/usuarios" class="nav-link active">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Listado de usuarios</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                <a href="<?=APP_URL;?>/login/logout.php" class="nav-link" style="background-color: #c52510;color:white">
                  <i class="nav-icon fas"><i class="bi bi-door-open"></i></i>
                    <p>
                      Cerrar sesión
                    </p>
                </a>
            </li> 


                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>