<?php
include('../../app/config.php');
include('../../admin/layout/parte1.php');
include('../../app/controllers/roles/listado_de_roles.php');

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <br>
    <div class="content">
        <div class="container">
            <div class="row">
            <h2 style="margin-left: 20px;"><i class="bi bi-plus-square"></i>  Registrar docente </h2>
            </div>
            <br>
            <div class="row">

                <div class="col-md-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Completar los siguientes datos:</h3>
                        </div>
                        <div class="card-body">
                            <form action="<?= APP_URL; ?>/app/controllers/docentes/create.php" method="post">
                                <div class="row">
                                    <div class="col-md-3" hidden>
                                        <div class="form-group">
                                            <label for="">Nombre del rol<b style="color:red">*</b></label>
                                            
                                                <select name="rol_id" id="" class="form-control">
                                                    <?php
                                                    foreach ($roles as $role) { ?>
                                                        <option value="<?= $role['id_rol']; ?>" <?=$role['nombre_rol']=='DOCENTE' ? 'selected' : ''?>><?= $role['nombre_rol']; ?></option>
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
                                            <label for="">Nro. de documento<b style="color:red">*</b></label>
                                            <input type="number" name="dni" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Apellidos<b style="color:red">*</b></label>
                                            <input type="text" name="apellidos" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Nombres<b style="color:red">*</b></label>
                                            <input type="text" name="nombres" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Fecha de nacimiento<b style="color:red">*</b></label>
                                            <input type="date" name="fecha_nacimiento" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Domicilio<b style="color:red">*</b></label>
                                            <input type="address" name="direccion" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Correo electrónico<b style="color:red">*</b></label>
                                            <input type="email" name="email" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Nro. de celular<b style="color:red">*</b></label>
                                            <input type="number" name="celular" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                        <label for="">Título<b style="color:red">*</b></label>
                                            <select name="profesion" id="" class="form-control" required>
                                                <option value="PROFESORADO EN EDUCACIÓN PRIMARIA">PROFESORADO EN EDUCACIÓN PRIMARIA</option>
                                                <option value="PROFESORADO EN EDUCACIÓN ESPECIAL">PROFESORADO EN EDUCACIÓN ESPECIAL</option>
                                                <option value="PROFESORADO EN EDUCACIÓN FÍSICA">PROFESORADO EN EDUCACIÓN FÍSICA</option>
                                                <option value="PROFESORADO EN LENGUAS EXTRANJERAS">PROFESORADO EN LENGUAS EXTRANJERAS</option>
                                                <option value="PROFESORADO EN MÚSICA">PROFESORADO EN MÚSICA</option>
                                                <option value="PROFESORADO EN CIENCIAS">PROFESORADO EN CIENCIAS</option>
                                                <option value="PROFESORADO EN MATEMÁTICA">PROFESORADO EN CIENCIAS</option>
                                                <option value="LICENCIATURA EN CIENCIAS DE LA EDUCACIÓN">LICENCIATURA EN CIENCIAS DE LA EDUCACIÓN</option>
                                                <option value="DIPLOMATURAS EN EDUCACIÓN INCLUSIVA">DIPLOMATURAS EN EDUCACIÓN INCLUSIVA</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Integrador<b style="color:red">*</b></label>
                                            <select name="integrador" id="" class="form-control" required>
                                                <option value="NO">NO</option>
                                                <option value="SI">SI</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Tipo de cargo<b style="color:red">*</b></label>
                                            <select name="tipo_cargo" id="" class="form-control" required>
                                                <option value="TITULAR">TITULAR</option>
                                                <option value="SUPLENTE">SUPLENTE</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Registrar</button>
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