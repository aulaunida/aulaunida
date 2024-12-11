<?php
$id_docente = $_GET['id'];

include('../../app/config.php');
include('../../admin/layout/parte1.php');
include('../../app/controllers/docentes/datos_docentes.php');
include('../../app/controllers/roles/listado_de_roles.php');
?>
<?php
$profesiones = [
    "PROFESORADO EN EDUCACIÓN PRIMARIA",
    "PROFESORADO EN EDUCACIÓN ESPECIAL",
    "PROFESORADO EN EDUCACIÓN FÍSICA",
    "PROFESORADO EN LENGUAS EXTRANJERAS",
    "PROFESORADO EN MÚSICA",
    "PROFESORADO EN CIENCIAS",
    "PROFESORADO EN MATEMÁTICA",
    "LICENCIATURA EN CIENCIAS DE LA EDUCACIÓN",
    "DIPLOMATURAS EN EDUCACIÓN INCLUSIVA"
];
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <br>
    <div class="content">
        <div class="container">
            <div class="row">
                <h2 style="margin-left: 20px;"><i class="bi bi-pencil-square"></i> Editar docente: <b><?= $apellidos . ', ' .$nombres ; ?></b> </h2>
            </div>
            <br>
            <div class="row">

                <div class="col-md-12">
                    <div class="card card-outline card-success">
                        <div class="card-header">
                        <h3 class="card-title">Editar los siguientes campos:</h3>
                        </div>
                        <div class="card-body">
                            <form action="<?= APP_URL; ?>/app/controllers/docentes/update.php" method="post">
                                <div class="row">
                                    <div class="col-md-3" hidden>
                                        <div class="form-group">
                                            <input type="text" name="id_docente" value="<?= $id_docente ?>" hidden>
                                            <input type="text" name="id_usuario" value="<?= $id_usuario ?>" hidden>
                                            <input type="text" name="id_persona" value="<?= $id_persona ?>" hidden>

                                            <label for="">Nombre del rol</label>

                                            <select name="rol_id" id="" class="form-control">
                                                <?php
                                                foreach ($roles as $role) { ?>
                                                    <option value="<?= $role['id_rol']; ?>" <?= $role['nombre_rol'] == 'DOCENTE' ? 'selected' : '' ?>><?= $role['nombre_rol']; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Nro. de documento</label>
                                            <input type="number" name="dni" value="<?=$dni;?>"  class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Apellidos</label>
                                            <input type="text" name="apellidos" value="<?=$apellidos;?>"  class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Nombres</label>
                                            <input type="text" name="nombres" value="<?=$nombres;?>" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Fecha de nacimiento</label>
                                            <input type="date" name="fecha_nacimiento" value="<?=$fecha_nacimiento;?>"  class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Domicilio</label>
                                            <input type="address" name="direccion" value="<?=$direccion;?>"   class="form-control" style="text-transform: uppercase;" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                        <label for="">Correo electrónico</label>
                                        <input type="email" name="email" value="<?=$email;?>" class="form-control" style="text-transform: uppercase;" required>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Nro. de celular</label>
                                            <input type="number" name="celular" value="<?=$celular;?>" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Título</label>
                                            <select name="profesion" id="" class="form-control" required>
                                                <?php foreach ($profesiones as $opcion) { ?>
                                                    <option value="<?= $opcion; ?>" <?= ($profesion == $opcion) ? 'selected="selected"' : ''; ?>>
                                                        <?= $opcion; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Integrador</label>
                                                <select name="integrador" id="" class="form-control" required>
                                                <?php
                                                if($integrador == "SI"){ ?>
                                                <option value="SI" selected="selected">SI</option>
                                                <option value="NO">NO</option>
                                                <?php
                                                }else{ ?>
                                                    <option value="SI">SI</option>
                                                    <option value="NO" selected="selected">NO</option>
                                                <?php
                                                }?>
                                                 </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Tipo de cargo</label>
                                            <select name="tipo_cargo" id="" class="form-control" required>
                                                <?php
                                                if($tipo_cargo == "TITULAR"){ ?>
                                                <option value="TITULAR" selected="selected">TITULAR</option>
                                                <option value="SUPLENTE">SUPLENTE</option>
                                                <?php
                                                }else{ ?>
                                                    <option value="TITULAR">TITULAR</option>
                                                    <option value="SUPLENTE" selected="selected">SUPLENTE</option>
                                                <?php
                                                }?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success">Actualizar</button>
                                            <a href="<?= APP_URL; ?>/admin/docentes" class="btn btn-danger">Cancelar</a>
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

include('../../admin/layout/parte2.php');
include('../../layout/mensajes.php');

?>