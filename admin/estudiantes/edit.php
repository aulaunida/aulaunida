<?php
$id_estudiante = $_GET['id'];

include('../../app/config.php');
include('../../admin/layout/parte1.php');
include('../../app/controllers/estudiantes/datos_estudiantes.php');
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
                <h2 style="margin-left: 20px;"><i class="bi bi-pencil-square"></i> Editar alumno: <b><?= strtoupper($apellidos . ', ' . $nombres); ?></b> </h2>
            </div>
            <br>

            <form action="<?= APP_URL; ?>/app/controllers/estudiantes/update.php" method="post">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card card-outline card-success">
                            <div class="card-header">
                                <h3 class="card-title">Editar datos personales:</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3" hidden>
                                        <div class="form-group">
                                            <input type="text" name="id_usuario" value="<?= $id_usuario ?>" hidden>
                                            <input type="text" name="id_persona" value="<?= $id_persona ?>" hidden>
                                            <input type="text" name="id_estudiante" value="<?= $id_estudiante ?>" hidden>
                                            <input type="text" name="id_ppff" value="<?= $id_ppff ?>" hidden>
                                            <label for="">Nombre del rol<b style="color:red">*</b></label>

                                            <select name="rol_id" id="" class="form-control">
                                                <?php
                                                foreach ($roles as $role) { ?>
                                                    <option value="<?= $role['id_rol']; ?>" <?= $role['nombre_rol'] == 'ESTUDIANTE' ? 'selected' : '' ?>><?= $role['nombre_rol']; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Nro. de documento<b style="color:red">*</b></label>
                                            <input type="number" name="dni" value="<?= $dni; ?>" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Apellidos<b style="color:red">*</b></label>
                                            <input type="text" name="apellidos" value="<?= strtoupper($apellidos); ?>" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Nombres<b style="color:red">*</b></label>
                                            <input type="text" name="nombres" value="<?= strtoupper($nombres); ?>" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Fecha de nacimiento<b style="color:red">*</b></label>
                                            <input type="date" name="fecha_nacimiento" value="<?= $fecha_nacimiento; ?>" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Domicilio<b style="color:red">*</b></label>
                                            <input type="address" name="direccion" value="<?= $direccion; ?>" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-outline card-success">
                            <div class="card-header">
                                <h3 class="card-title">Editar datos académicos:</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Nro. de matrícula<b style="color:red">*</b></label>
                                            <input type="text" name="matricula" value="<?= $matricula; ?>" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Nivel y turno<b style="color:red">*</b></label>
                                            <select name="nivel_id" id="" class="form-control">
                                                <?php
                                                foreach ($niveles as $nivele) { ?>
                                                    <option value="<?= $nivele['id_nivel']; ?>" <?= $nivele['id_nivel'] == $nivel_id ? 'selected' : '' ?>><?= $nivele['nivel'] . ' ' . '- TURNO' . ' ' . $nivele['turno']; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                            <!-- <select name="nivel" id="" class="form-control">
                                                <option value="INICIAL" <?php if ($nivel == 'INICIAL') { ?> selected="selected" <?php } ?>>INICIAL</option>
                                                <option value="PRIMARIA" <?php if ($nivel == 'PRIMARIA') { ?> selected="selected" <?php } ?>>PRIMARIA</option>
                                                <option value="SECUNDARIA" <?php if ($nivel == 'SECUNDARIA') { ?> selected="selected" <?php } ?>>SECUNDARIA</option>
                                            </select> -->
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Grado y división<b style="color:red">*</b></label>
                                            <select name="grado_id" id="" class="form-control">
                                                <?php
                                                foreach ($grados as $grado) { ?>
                                                    <option value="<?= $grado['id_grado']; ?>" <?= $grado['id_grado'] == $grado_id ? 'selected' : '' ?>>
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
                                                <option value="NO" <?php if ($integracion == 'NO') { ?> selected="selected" <?php } ?>>NO</option>
                                                <option value="SI" <?php if ($integracion == 'SI') { ?> selected="selected" <?php } ?>>SI</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Motivo de Integración<b style="color:red"></b></label>
                                        <select name="genero" id="" class="form-control">
                                            <option value="" <?php if ($genero == '') { ?> selected="selected" <?php } ?>></option>
                                            <option value="DISCAPACIDAD INTELECTUAL" <?php if ($genero == 'DISCAPACIDAD INTELECTUAL') { ?> selected="selected" <?php } ?>>DISCAPACIDAD INTELECTUAL</option>
                                            <option value="SORDERA O HIPOACUSIA" <?php if ($genero == 'SORDERA O HIPOACUSIA') { ?> selected="selected" <?php } ?>>SORDERA O HIPOACUSIA</option>
                                            <option value="CEGUERA O DISMINUCION VISUAL" <?php if ($genero == 'CEGUERA O DISMINUCION VISUAL') { ?> selected="selected" <?php } ?>>CEGUERA O DISMINUCIÓN VISUAL</option>
                                            <option value="MOTORA O NEUMOMOTORA" <?php if ($genero == 'MOTORA O NEUMOMOTORA') { ?> selected="selected" <?php } ?>>MOTORA O NEUMOMOTORA</option>
                                            <option value="TGD O TEA" <?php if ($genero == 'TGD O TEA') { ?> selected="selected" <?php } ?>>TGD O TEA</option>
                                            <option value="MAS DE UNA DISCAPACIDAD" <?php if ($genero == 'MAS DE UNA DISCAPACIDAD') { ?> selected="selected" <?php } ?>>MÁS DE UNA DISCAPACIDAD</option>
                                            <option value="OTRO MOTIVO" <?php if ($genero == 'OTRO MOTIVO') { ?> selected="selected" <?php } ?>>OTRO MOTIVO</option>
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
                        <div class="card card-outline card-success">
                            <div class="card-header">
                                <h3 class="card-title">Editar datos del padre/madre/tutor:</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Tutor 1 (Apellido y nombre)<b style="color:red">*</b></label>
                                            <input type="text" name="nombres_apellidos_ppff" value="<?= strtoupper($nombres_apellidos_ppff); ?>" class="form-control"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Nro. de documento<b style="color:red">*</b></label>
                                            <input type="number" name="dni_ppff" value="<?= $dni_ppff; ?>" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Nro. de celular<b style="color:red">*</b></label>
                                            <input type="number" name="celular_ppff" value="<?= $celular_ppff; ?>" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Correo electrónico<b style="color:red">*</b></label>
                                            <input type="email" name="email" value="<?= $email; ?>" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Tutor 2 (Apellido y nombre)<b style="color:red">*</b></label>
                                            <input type="text" name="ref_nombre" value="<?= strtoupper($ref_nombre); ?>" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Nro. de documento<b style="color:red">*</b></label>
                                            <input type="text" name="ocupacion_ppff" value="<?= $ocupacion_ppff; ?>" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Nro. de celular<b style="color:red">*</b></label>
                                            <input type="number" name="ref_celular" value="<?= $ref_celular; ?>" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Correo electrónico<b style="color:red">*</b></label>
                                            <input type="text" name="ref_parentezco" value="<?= $ref_parentezco; ?>" class="form-control" required>
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
                            <button type="submit" class="btn btn-success">Actualizar</button>
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