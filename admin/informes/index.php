<?php
include('../../app/config.php');
include('../../admin/layout/parte1.php');

include('../../app/controllers/docentes/listado_de_asignaciones.php');
include('../../app/controllers/estudiantes/listado_de_estudiantes.php');
include('../../app/controllers/informes/listado_de_informes.php');


?>
<style>
    .icono-blanco i {
        color: white;
        /* Cambia el color del icono a blanco */
    }

    .uppercase {
        text-transform: uppercase;
        /* Convierte el texto a mayúsculas */
    }
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <br>
    <div class="content">
        <div class="container">
            <div class="row">
                <h1 style="margin-left: 20px;"><i class="bi bi-journal-check"></i> Informes</h1>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-info">
                        <div class="card-body">
                            <!-- <?= $email_sesion; ?> -->
                            <table id="example2" class="table table-striped table-bordered table-hover table-sm">
                                <thead>
                                    <tr>
                                        <th>Materia</th>
                                        <th>Turno</th>
                                        <th>Grado</th>
                                        <th>
                                            <center>División</center>
                                        </th>
                                        <th>
                                            <center>Acciones</center>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $contador = 0;
                                    foreach ($asignaciones as $asignacione) {
                                        $id_grado = $asignacione['id_grado'];
                                        if ($email_sesion == $asignacione['email']) {
                                            $id_asignacion = $asignacione['id_asignacion'];
                                            $docente_id = $asignacione['docente_id'];
                                            $contador = $contador + 1; ?>
                                            <tr>
                                                <td><?= $asignacione['nombre_materia']; ?></td>
                                                <td><?= $asignacione['turno']; ?></td>
                                                <td><?= $asignacione['curso']; ?></td>
                                                <td>
                                                    <center><?= $asignacione['paralelo']; ?></center>
                                                </td>
                                                <td style="text-align: center">
                                                    <a class="btn btn-info btn-sm" data-toggle="modal"
                                                        data-target="#exampleModal<?= $id_asignacion; ?>">
                                                        <i class="bi bi-plus"></i> Redactar informe</a>


                                                    <!-- INICIO DEL MODAL REGISTRAR INFORME  -->
                                                    <div class="modal fade" id="exampleModal<?= $id_asignacion; ?>"
                                                        tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header"
                                                                    style="background-color:#17a2b8; color:#FFFFFF">
                                                                    <h5 class="modal-title" id="exampleModalLabel"><i
                                                                            class="bi bi-plus-square"></i> Redactar informe:
                                                                        </i><b><?= $asignacione['curso']; ?>
                                                                            "<?= $asignacione['paralelo']; ?>" -
                                                                            <?= $asignacione['nombre_materia']; ?></b>
                                                                    </h5>
                                                                    <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <form
                                                                    action="<?= APP_URL; ?>/app/controllers/informes/create.php"
                                                                    method="post">
                                                                    <div class="modal-body">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <div class="form-group"
                                                                                    style="text-align: left">
                                                                                    <label for="" class="text-align-left">Fecha
                                                                                        de informe</label>
                                                                                    <input type="text" name="docente_id"
                                                                                        value="<?= $docente_id; ?>" hidden>
                                                                                    <input type="date" name="fecha_informe"
                                                                                        class="form-control" name="" id="">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <div class="form-group"
                                                                                    style="text-align: left">
                                                                                    <label for="estudiantes-select"
                                                                                        class="text-align-left">Alumno</label>
                                                                                    <select name="estudiante_id"
                                                                                        class="form-control uppercase"
                                                                                        id="estudiantes-select"
                                                                                        onchange="actualizarIntegracion()">
                                                                                        <option value="" disabled selected>
                                                                                            Seleccione un alumno</option>
                                                                                        <?php
                                                                                        foreach ($estudiantes as $estudiante) {
                                                                                            if ($estudiante['id_grado'] == $asignacione['grado_id']) {
                                                                                                $id_estudiante = $estudiante['id_estudiante']; ?>
                                                                                                <option value="<?= $id_estudiante; ?>"
                                                                                                    data-integracion="<?= $estudiante['integracion']; ?>">
                                                                                                    <?= strtoupper($estudiante['apellidos'] . ", " . $estudiante['nombres']); ?>
                                                                                                </option>
                                                                                                <?php
                                                                                            }
                                                                                        }
                                                                                        ?>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <script>
                                                                            function actualizarIntegracion() {
                                                                                // Obtener el select de estudiantes
                                                                                const selectEstudiantes = document.getElementById('estudiantes-select');

                                                                                // Obtener la opción seleccionada
                                                                                const estudianteSeleccionado = selectEstudiantes.options[selectEstudiantes.selectedIndex];

                                                                                // Obtener el valor de integración de la opción seleccionada (usamos data-integracion)
                                                                                const integracion = estudianteSeleccionado.getAttribute('data-integracion');

                                                                                // Obtener el input donde se mostrará la integración
                                                                                const inputIntegracion = document.getElementById('integracion-input');

                                                                                // Aplicar la lógica para mostrar "SI" o "NO"
                                                                                inputIntegracion.value = integracion === 'NO' ? "NO" : "SI";
                                                                            }
                                                                        </script>

                                                                        <!-- Aquí agregamos el input para mostrar la integración automáticamente -->
                                                                        <div class="row" hidden>
                                                                            <div class="col-md-12">
                                                                                <div class="form-group"
                                                                                    style="text-align: left">
                                                                                    <label for="integracion-input"
                                                                                        class="text-align-left">Integración</label>
                                                                                    <input type="text" class="form-control"
                                                                                        id="integracion-input" readonly
                                                                                        required>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="row" hidden>
                                                                            <div class="col-md-12">
                                                                                <div class="form-group"
                                                                                    style="text-align: left">
                                                                                    <label for=""
                                                                                        class="text-align-left">Materia</label>
                                                                                    <input type="text" name="materia_id"
                                                                                        value="<?= $asignacione['id_materia']; ?>">
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <div class="form-group"
                                                                                    style="text-align: left">
                                                                                    <label for=""
                                                                                        class="text-align-left">Categoria</label>
                                                                                    <select name="observacion"
                                                                                        class="form-control uppercase" id="">
                                                                                        <option value="" disabled selected>
                                                                                            Seleccione una categoria</option>
                                                                                        <option
                                                                                            value="COMPORTAMIENTO Y DISCIPLINA">
                                                                                            COMPORTAMIENTO Y DISCIPLINA</option>
                                                                                        <option
                                                                                            value="COMUNICACIÓN Y PARTICIPACIÓN">
                                                                                            COMUNICACIÓN Y PARTICIPACIÓN
                                                                                        </option>
                                                                                        <option value="DIAGNÓSTICO INICIAL">
                                                                                            DIAGNÓSTICO INICIAL</option>
                                                                                        <option
                                                                                            value="EVOLUCIÓN Y PROGRESO GENERAL">
                                                                                            EVOLUCIÓN Y PROGRESO GENERAL
                                                                                        </option>
                                                                                        <option
                                                                                            value="OBSERVACIONES ESPECÍFICAS">
                                                                                            OBSERVACIONES ESPECÍFICAS</option>
                                                                                        <option
                                                                                            value="RETOS Y ESTRATEGIAS DE APOYO">
                                                                                            RETOS Y ESTRATEGIAS DE APOYO
                                                                                        </option>
                                                                                        <option
                                                                                            value="TRABAJO EN GRUPO Y COLABORACIÓN">
                                                                                            TRABAJO EN GRUPO Y COLABORACIÓN
                                                                                        </option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <div class="form-group"
                                                                                    style="text-align: left">
                                                                                    <label for=""
                                                                                        class="text-align-left">Observaciones</label>
                                                                                    <textarea name="nota" rows="10"
                                                                                        class="form-control" id=""></textarea>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="submit"
                                                                            class="btn btn-info">Registrar</button>
                                                                        <button type="button" class="btn btn-danger"
                                                                            data-dismiss="modal">Cancelar</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <!-- <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group text-center">
                                        <a href="<?= APP_URL; ?>/admin/index.php" class="btn btn-danger">Volver</a>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
            <br>

            <!-- INICIO SEGUNDA PARTE DEL MAIN -->

            <div class="row">

                <div class="col-md-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Informes cargados</h3>
                        </div>
                        <div class="card-body">
                            <!-- <?= $email_sesion; ?> -->
                            <table id="example1" class="table table-striped table-bordered table-hover table-sm">
                                <thead>
                                    <tr>
                                        <th>Alumno</th>
                                        <th>Materia</th>
                                        <th>Categoria</th>
                                        <!-- <th>
                                            <center>Observación</center>
                                        </th> -->
                                        <th>
                                            <center>Fecha de informe</center>
                                        </th>
                                        <th>
                                            <center>Acciones</center>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $contador_informes = 0;
                                    foreach ($informes as $informe) {
                                        if ($email_sesion == $informe['email']) {
                                            $id_informe = $informe['id_informe'];
                                            $estudiante_id = $informe['estudiante_id'];
                                            $grado_id = $informe['grado_id'];
                                            $contador_informes = $contador_informes + 1; ?>
                                            <tr>
                                                <?php
                                                foreach ($estudiantes as $estudiante) {
                                                    if ($estudiante['id_estudiante'] == $estudiante_id) { ?>
                                                        <td><?= strtoupper($estudiante['apellidos'] . ", " . $estudiante['nombres']); ?>
                                                        </td>
                                                        <td><?= $informe['nombre_materia']; ?></td>
                                                        <td><?= $informe['observacion']; ?></td>
                                                        <td>
                                                            <center><?= $informe['fecha_informe']; ?></center>
                                                        </td>
                                                        <!-- <td>
                                                            <center><?= $informe['nota']; ?></center>
                                                        </td> -->
                                                        <?php
                                                    }
                                                }
                                                ?>
                                                <td style="text-align: center">
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                        <a href="show.php?id=<?= $id_informe; ?>" type="button"
                                                            title="Consultar informe" class="btn btn-primary btn-sm"><i
                                                                class="bi bi-eye"></i></a>
                                                        <a type="button" title="Editar" data-toggle="modal"
                                                            data-target="#modal_editar<?= $id_informe; ?>"
                                                            class="btn btn-success btn-sm icono-blanco"><i
                                                                class="bi bi-pencil-square"></i></a>

                                                        <!-- INICIO DEL MODAL EDITAR INFORME  -->
                                                        <div class="modal fade" id="modal_editar<?= $id_informe; ?>"
                                                            tabindex="-1" aria-labelledby="exampleModalLabel"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog modal-lg">
                                                                <div class="modal-content">
                                                                    <div class="modal-header"
                                                                        style="background-color:#28a745; color:#FFFFFF">
                                                                        <h5 class="modal-title" id="exampleModalLabel">EDITAR
                                                                            INFORME <i class="bi bi-chevron-right"></i>
                                                                            <?= $informe['nombre_materia']; ?>
                                                                        </h5>
                                                                        <button type="button" class="close" data-dismiss="modal"
                                                                            aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <form
                                                                        action="<?= APP_URL; ?>/app/controllers/informes/update.php"
                                                                        method="post">
                                                                        <div class="modal-body">
                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group"
                                                                                        style="text-align: left">
                                                                                        <label for=""
                                                                                            class="text-align-left">Fecha de
                                                                                            Informe</label>
                                                                                        <input type="text" name="id_informe"
                                                                                            value="<?= $id_informe; ?>" hidden>
                                                                                        <input type="text" name="docente_id"
                                                                                            value="<?= $docente_id; ?>" hidden>
                                                                                        <input type="date"
                                                                                            value="<?= $informe['fecha_informe']; ?>"
                                                                                            name="fecha_informe"
                                                                                            class="form-control" name="" id="">
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group"
                                                                                        style="text-align: left">
                                                                                        <label for="estudiantes-select"
                                                                                            class="text-align-left">Estudiante</label>
                                                                                        <select name="estudiante_id"
                                                                                            class="form-control uppercase"
                                                                                            id="estudiantes-select">
                                                                                            <option value="" disabled selected>
                                                                                                Seleccione un estudiante
                                                                                            </option>
                                                                                            <?php
                                                                                            foreach ($estudiantes as $estudiante) {
                                                                                                if ($estudiante['id_grado'] == $grado_id) {
                                                                                                    $id_estudiante = $estudiante['id_estudiante']; ?>
                                                                                                    <option
                                                                                                        value="<?= $id_estudiante; ?>"
                                                                                                        <?= $id_estudiante == $estudiante_id ? 'selected' : '' ?>>
                                                                                                        <?= strtoupper($estudiante['apellidos'] . ", " . $estudiante['nombres']); ?>
                                                                                                    </option>
                                                                                                    <?php
                                                                                                }
                                                                                            }
                                                                                            ?>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row" hidden>
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group"
                                                                                        style="text-align: left">
                                                                                        <label for=""
                                                                                            class="text-align-left">Materia</label>
                                                                                        <input type="text"
                                                                                            value="<?= $informe['nombre_materia']; ?>">
                                                                                        <input type="text" name="materia_id"
                                                                                            value="<?= $informe['id_materia']; ?>"
                                                                                            hidden>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group"
                                                                                        style="text-align: left">
                                                                                        <label for=""
                                                                                            class="text-align-left">Categorización</label>
                                                                                        <select name="observacion"
                                                                                            class="form-control uppercase"
                                                                                            id="">
                                                                                            <option value="" disabled selected>
                                                                                                Seleccione una categoria
                                                                                            </option>
                                                                                            <option
                                                                                                value="COMPORTAMIENTO Y DISCIPLINA"
                                                                                                <?= $informe['observacion'] == "COMPORTAMIENTO Y DISCIPLINA" ? 'selected' : '' ?>>COMPORTAMIENTO Y DISCIPLINA
                                                                                            </option>
                                                                                            <option
                                                                                                value="COMUNICACIÓN Y PARTICIPACIÓN"
                                                                                                <?= $informe['observacion'] == "COMUNICACIÓN Y PARTICIPACIÓN" ? 'selected' : '' ?>>COMUNICACIÓN Y
                                                                                                PARTICIPACIÓN</option>
                                                                                            <option value="DIAGNÓSTICO INICIAL"
                                                                                                <?= $informe['observacion'] == "DIAGNÓSTICO INICIAL" ? 'selected' : '' ?>>
                                                                                                DIAGNÓSTICO INICIAL</option>
                                                                                            <option
                                                                                                value="EVOLUCIÓN Y PROGRESO GENERAL"
                                                                                                <?= $informe['observacion'] == "EVOLUCIÓN Y PROGRESO GENERAL" ? 'selected' : '' ?>>EVOLUCIÓN Y PROGRESO
                                                                                                GENERAL</option>
                                                                                            <option
                                                                                                value="OBSERVACIONES ESPECÍFICAS"
                                                                                                <?= $informe['observacion'] == "OBSERVACIONES ESPECÍFICAS" ? 'selected' : '' ?>>OBSERVACIONES ESPECÍFICAS
                                                                                            </option>
                                                                                            <option
                                                                                                value="RETOS Y ESTRATEGIAS DE APOYO"
                                                                                                <?= $informe['observacion'] == "RETOS Y ESTRATEGIAS DE APOYO" ? 'selected' : '' ?>>RETOS Y
                                                                                                ESTRATEGIAS DE APOYO</option>
                                                                                            <option
                                                                                                value="TRABAJO EN GRUPO Y COLABORACIÓN"
                                                                                                <?= $informe['observacion'] == "TRABAJO EN GRUPO Y COLABORACIÓN" ? 'selected' : '' ?>>TRABAJO EN
                                                                                                GRUPO Y COLABORACIÓN</option>

                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>


                                                                            <!-- Place the following <script> and <textarea> tags your HTML's <body> -->
                                                                            <script>
                                                                                tinymce.init({
                                                                                    selector: 'textarea',
                                                                                    language: 'es',
                                                                                    plugins: [
                                                                                        // Core editing features
                                                                                        'anchor', 'autolink', 'charmap', 'codesample', 'emoticons', 'image', 'link', 'lists', 'media', 'searchreplace', 'table', 'visualblocks', 'wordcount',
                                                                                        // Your account includes a free trial of TinyMCE premium features
                                                                                        // Try the most popular premium features until Dec 26, 2024:
                                                                                        'checklist', 'mediaembed', 'casechange', 'export', 'formatpainter', 'pageembed', 'a11ychecker', 'tinymcespellchecker', 'permanentpen', 'powerpaste', 'advtable', 'advcode', 'editimage', 'advtemplate', 'ai', 'mentions', 'tinycomments', 'tableofcontents', 'footnotes', 'mergetags', 'autocorrect', 'typography', 'inlinecss', 'markdown', 'importword', 'exportword', 'exportpdf'
                                                                                    ],
                                                                                    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
                                                                                    tinycomments_mode: 'embedded',
                                                                                    tinycomments_author: 'Author name',
                                                                                    mergetags_list: [
                                                                                        { value: 'First.Name', title: 'First Name' },
                                                                                        { value: 'Email', title: 'Email' },
                                                                                    ],
                                                                                    ai_request: (request, respondWith) => respondWith.string(() => Promise.reject('See docs to implement AI Assistant')),
                                                                                });
                                                                            </script>

                                                                            <!-- <script>
                                                                                tinymce.init({
                                                                                    selector: 'textarea',
                                                                                    language: 'es',
                                                                                    min_height: 350,
                                                                                    skin: "oxide",
                                                                                    icons: 'material',
                                                                                    preview_styles: 'font-size color',
                                                                                    resize: 'both',
                                                                                    plugins: 'link image media code autolink lists media table',
                                                                                    toolbar: 'undo redo | styleselect| forecolor  | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | link image media| code table',
                                                                                    toolbar_mode: 'floating',
                                                                                    /* enable title field in the Image dialog*/
                                                                                    image_title: true,
                                                                                    /* enable automatic uploads of images represented by blob or data URIs*/
                                                                                    automatic_uploads: true,
                                                                                    images_upload_url: 'postAcceptor.php',
                                                                                    file_picker_types: 'image',

                                                                                    tinycomments_mode: 'embedded',
                                                                                    tinycomments_author: 'Author name'

                                                                                });
                                                                            </script> -->

                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group"
                                                                                        style="text-align: left">
                                                                                        <label for=""
                                                                                            class="text-align-left">Observaciones</label>
                                                                                        <textarea name="nota" rows="10"
                                                                                            class="form-control"
                                                                                            id=""><?= $informe['nota']; ?></textarea>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="submit"
                                                                                class="btn btn-success">Actualizar</button>
                                                                            <button type="button" class="btn btn-danger"
                                                                                data-dismiss="modal">Cancelar</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <form action="<?= APP_URL; ?>/app/controllers/informes/delete.php"
                                                            onclick="preguntar<?= $id_informe; ?>(event)" method="post"
                                                            id="miFormulario<?= $id_informe; ?>">
                                                            <input type="text" name="id_informe" value="<?= $id_informe; ?>"
                                                                hidden>
                                                            <button type="submit" title="Eliminar" class="btn btn-danger btn-sm"
                                                                style="border-radius: 0px 5px 5px 0px"><i
                                                                    class="bi bi-trash"></i></button>
                                                        </form>
                                                        <script>
                                                            function preguntar<?= $id_informe; ?>(event) {
                                                                event.preventDefault();
                                                                Swal.fire({
                                                                    title: 'Eliminar informe existente',
                                                                    text: '¿Desea eliminar este informe?',
                                                                    icon: 'question',
                                                                    showDenyButton: true,
                                                                    confirmButtonText: 'Eliminar',
                                                                    confirmButtonColor: '#a5161d',
                                                                    denyButtonColor: '#270a0a',
                                                                    denyButtonText: 'Cancelar',
                                                                }).then((result) => {
                                                                    if (result.isConfirmed) {
                                                                        var form = $('#miFormulario<?= $id_informe; ?>');
                                                                        form.submit();
                                                                        Swal.fire('Eliminado', 'Se eliminó el informe correctamente', 'success');
                                                                    }
                                                                });
                                                            }
                                                        </script>
                                                    </div>
                                                </td>


                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group text-center">
                                        <a href="<?= APP_URL; ?>/admin/index.php" class="btn btn-danger">Volver</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php

include('../../admin/layout/parte2.php');
include('../../layout/mensajes.php');

?>

<script>
    $(function () {
        $("#example2").DataTable({
            "pageLength": 10,
            "language": {
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ - _END_ | _TOTAL_ grados",
                "infoEmpty": "Mostrando 0 - 0 | 0 grados",
                "infoFiltered": "(Filtrado de _MAX_ total grados)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ grados",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscar grados:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            buttons: [{
                extend: 'collection',
                text: 'Exportar',
                orientation: 'landscape',
                buttons: [{
                    text: 'Copiar Texto',
                    extend: 'copy',
                }, {
                    text: 'Descargar en PDF',
                    extend: 'pdf'
                }, {
                    text: 'Descargar en CSV',
                    extend: 'csv'
                }, {
                    text: 'Descargar en Excel',
                    extend: 'excel'
                }, {
                    text: 'Imprimir Reporte',
                    extend: 'print'
                }]
            },
            {
                extend: 'colvis',
                text: 'Visualizar',
                collectionLayout: 'fixed three-column'
            }
            ],
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>

<script>
    $(function () {
        $("#example1").DataTable({
            "pageLength": 10,
            "language": {
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ - _END_ | _TOTAL_ informes",
                "infoEmpty": "Mostrando 0 - 0 | 0 informes",
                "infoFiltered": "(Filtrado de _MAX_ total informes)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ informes",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscar informes:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            buttons: [{
                extend: 'collection',
                text: 'Exportar',
                orientation: 'landscape',
                buttons: [{
                    text: 'Copiar Texto',
                    extend: 'copy',
                }, {
                    text: 'Descargar en PDF',
                    extend: 'pdf'
                }, {
                    text: 'Descargar en CSV',
                    extend: 'csv'
                }, {
                    text: 'Descargar en Excel',
                    extend: 'excel'
                }, {
                    text: 'Imprimir Reporte',
                    extend: 'print'
                }]
            },
            {
                extend: 'colvis',
                text: 'Visualizar',
                collectionLayout: 'fixed three-column'
            }
            ],
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>