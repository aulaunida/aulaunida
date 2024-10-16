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
                <h2>EDITAR ESTUDIANTE <i class="bi bi-chevron-right"></i> <?= strtoupper($apellidos . ', ' . $nombres); ?></h2>
            </div>
            <br>

            <form action="<?= APP_URL; ?>/app/controllers/estudiantes/update.php" method="post">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card card-outline card-success">
                            <div class="card-header">
                                <h3 class="card-title">Datos personales registrados</h3>
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
                                                    <option value="<?= $role['id_rol']; ?>"<?= $role['nombre_rol'] == 'ESTUDIANTE' ? 'selected' : '' ?>><?= $role['nombre_rol']; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">DNI<b style="color:red">*</b></label>
                                            <input type="number" name="dni" value="<?= $dni; ?>" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Apellido<b style="color:red">*</b></label>
                                            <input type="text" name="apellidos" value="<?= strtoupper($apellidos); ?>" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Nombre<b style="color:red">*</b></label>
                                            <input type="text" name="nombres" value="<?= strtoupper($nombres); ?>" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">



                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Fecha de Nacimiento<b style="color:red">*</b></label>
                                            <input type="date" name="fecha_nacimiento" value="<?= $fecha_nacimiento; ?>" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-md-3">


                                        <div class="form-group">
                                            <label for="">Género<b style="color:red">*</b></label>
                                            <select name="genero" id="" class="form-control" required>
                                                <option value="MASCULINO" <?php if ($genero == 'MASCULINO') { ?> selected="selected" <?php } ?>>MASCULINO</option>
                                                <option value="FEMENINO" <?php if ($genero == 'FEMENINO') { ?> selected="selected" <?php } ?>>FEMENINO</option>
                                                <option value="NO BINARIO" <?php if ($genero == 'NO BINARIO') { ?> selected="selected" <?php } ?>>NO BINARIO</option>
                                                <option value="PREFIERO NO DECIRLO" <?php if ($genero == 'PREFIERO NO DECIRLO') { ?> selected="selected" <?php } ?>>PREFIERO NO DECIRLO</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Dirección<b style="color:red">*</b></label>
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
                                <h3 class="card-title">Datos académicos registrados</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Nivel<b style="color:red">*</b></label>

                                            <select name="nivel_id" id="" class="form-control">
                                                <?php
                                                foreach ($niveles as $nivele) { ?>
                                                    <option value="<?= $nivele['id_nivel']; ?>" <?= $nivele['id_nivel'] ==$nivel_id ? 'selected' : '' ?>><?= $nivele['nivel'] . ' ' . '- TURNO' . ' ' . $nivele['turno']; ?></option>
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
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Grado<b style="color:red">*</b></label>
                                            <select name="grado_id" id="" class="form-control">
                                                <?php
                                                foreach ($grados as $grado) { ?>
                                                    <option value="<?= $grado['id_grado']; ?>" <?= $grado['id_grado'] ==$grado_id ? 'selected' : '' ?>>
                                                        <?= $grado['curso'] . ' - ' . $grado['paralelo']; ?>
                                                    </option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Matricula<b style="color:red">*</b></label>
                                            <input type="text" name="matricula" value="<?= $matricula; ?>" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Integración<b style="color:red">*</b></label>
                                            <select name="integracion" id="" class="form-control" required>
                                                <option value="NO">NO</option>
                                                <option value="SI">SI</option>
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
                                <h3 class="card-title">Datos registrados del padre/madre/tutor</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Nombre y Apellido<b style="color:red">*</b></label>
                                            <input type="text" name="nombres_apellidos_ppff" value="<?= strtoupper($nombres_apellidos_ppff);?>" class="form-control"
                                                required>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">DNI<b style="color:red">*</b></label>
                                            <input type="number" name="dni_ppff" value="<?= $dni_ppff; ?>" class="form-control" required>
                                        </div>
                                    </div>


                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Celular<b style="color:red">*</b></label>
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
                                            <label for="">Ocupación<b style="color:red">*</b></label>
                                            <input type="text" name="ocupacion_ppff" value="<?= $ocupacion_ppff; ?>" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Contacto adicional emergencia<b style="color:red">*</b></label>
                                            <input type="text" name="ref_nombre" value="<?= strtoupper($ref_nombre);?>" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">N° de contacto emergencia<b style="color:red">*</b></label>
                                            <input type="number" name="ref_celular" value="<?= $ref_celular; ?>" class="form-control" required>
                                        </div>
                                    </div>


                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Parentezco contacto emergencia<b style="color:red">*</b></label>
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
                            <a href="<?= APP_URL; ?>/admin/estudiantes" class="btn btn-secondary">Cancelar</a>
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