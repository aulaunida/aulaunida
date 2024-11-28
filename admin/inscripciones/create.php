<?php
include('../../app/config.php');
include('../../admin/layout/parte1.php');
include('../../app/controllers/roles/listado_de_roles.php');
include('../../app/controllers/niveles/listado_de_niveles.php');
include('../../app/controllers/grados/listado_de_grados.php');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <br>
    <div class="content">
        <div class="container">
            <div class="row">
                <h2 style="margin-left: 20px;"><i class="bi bi-plus-square"></i> Registrar alumno </h2>
            </div>
            <br>
            <form action="<?= APP_URL; ?>/app/controllers/inscripciones/create.php" method="post">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-outline card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Completar los datos personales:</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3" hidden>
                                        <div class="form-group">
                                            <label for="">Nombre del rol<b style="color:red">*</b></label>
                                            <select name="rol_id" id="" class="form-control">
                                                <?php
                                                foreach ($roles as $role) { ?>
                                                    <option value="<?= $role['id_rol']; ?>"
                                                        <?= $role['nombre_rol'] == 'ESTUDIANTE' ? 'selected' : '' ?>>
                                                        <?= $role['nombre_rol']; ?>
                                                    </option>
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-outline card-warning">
                            <div class="card-header">
                                <h3 class="card-title">Completar los datos académicos:</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Nro. de matrícula<b style="color:red">*</b></label>
                                            <input type="text" name="matricula" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Nivel y turno<b style="color:red">*</b></label>
                                            <select name="nivel_id" id="" class="form-control">
                                                <?php
                                                foreach ($niveles as $nivele) { ?>
                                                    <option value="<?= $nivele['id_nivel']; ?>">
                                                        <?= $nivele['nivel'] . ' ' . '- TURNO' . ' ' . $nivele['turno']; ?>
                                                    </option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Grado y división<b style="color:red">*</b></label>
                                            <select name="grado_id" id="" class="form-control">
                                                <?php
                                                foreach ($grados as $grado) { ?>
                                                    <option value="<?= $grado['id_grado']; ?>">
                                                        <?= $grado['curso'] . ' - ' . $grado['paralelo']; ?>
                                                    </option>
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
                                            <label for="">Integración<b style="color:red">*</b></label>
                                            <select name="integracion" id="" class="form-control" required>
                                                <option value="NO">NO</option>
                                                <option value="SI">SI</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Motivo de Integración<b style="color:red"></b></label>
                                            <select name="genero" id="" class="form-control">
                                                <option value=""></option>
                                                <option value="DISCAPACIDAD INTELECTUAL">DISCAPACIDAD INTELECTUAL</option>
                                                <option value="SORDERA O HIPOACUSIA">SORDERA O HIPOACUSIA</option>
                                                <option value="CEGUERA O DISMINUCION VISUAL">CEGUERA O DISMINUCIÓN VISUAL</option>
                                                <option value="MOTORA O NEUMOMOTORA">MOTORA O NEUMOMOTORA</option>
                                                <option value="TGD O TEA">TGD O TEA</option>
                                                <option value="OTRO MOTIVO">OTRO MOTIVO</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-12">
                        <div class="card card-outline card-danger">
                            <div class="card-header">
                                <h3 class="card-title">Completar los datos del padre/madre/tutor:</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Apellido y nombre<b style="color:red">*</b></label>
                                            <input type="text" name="nombres_apellidos_ppff" class="form-control"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Nro. de documento<b style="color:red">*</b></label>
                                            <input type="number" name="dni_ppff" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Nro. de celular<b style="color:red">*</b></label>
                                            <input type="number" name="celular_ppff" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Correo electrónico<b style="color:red">*</b></label>
                                            <input type="email" name="email" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Ocupación<b style="color:red">*</b></label>
                                            <input type="text" name="ocupacion_ppff" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Nombre contacto de emergencia<b style="color:red">*</b></label>
                                            <input type="text" name="ref_nombre" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Nro. contacto de emergencia<b style="color:red">*</b></label>
                                            <input type="number" name="ref_celular" class="form-control" required>
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Parentesco de contacto emergencia<b style="color:red">*</b></label>
                                            <input type="text" name="ref_parentezco" class="form-control" required>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Registrar</button>
                            <a href="<?= APP_URL; ?>/admin/estudiantes" class="btn btn-danger">Cancelar</a>
                        </div>
                    </div>
                </div>
            </form>


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