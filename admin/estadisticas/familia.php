<?php
include('../../app/config.php');
include('../../admin/layout/parte1.php');
include('../../app/controllers/estudiantes/reporte_estudiantes_grados.php');

// Consultar grados y divisiones directamente desde la base de datos
$queryGrados = "SELECT id_grado, curso, paralelo FROM grados WHERE estado = '1'";
$stmtGrados = $pdo->prepare($queryGrados);
$stmtGrados->execute();
$grados = $stmtGrados->fetchAll(PDO::FETCH_ASSOC);

// Consultar gestiones (ciclo lectivo)
$queryGestiones = "SELECT id_gestion, gestion FROM gestiones WHERE estado = '1'";
$stmtGestiones = $pdo->prepare($queryGestiones);
$stmtGestiones->execute();
$gestiones = $stmtGestiones->fetchAll(PDO::FETCH_ASSOC);

// Consultar niveles (turno)
$queryNiveles = "SELECT id_nivel, nivel, turno FROM niveles WHERE estado = '1'";
$stmtNiveles = $pdo->prepare($queryNiveles);
$stmtNiveles->execute();
$niveles = $stmtNiveles->fetchAll(PDO::FETCH_ASSOC);
?>


<div class="content-wrapper">
    <br>
    <div class="content">
        <div class="container">
            <div class="row">
                <h1 style="margin-left: 20px;"><i class="bi bi-bar-chart-line"></i> Participación familiar</h1>
            </div>
            <link rel="stylesheet" href="ruta/del/archivo/bootstrap.css">
            <style>
                #contenedorGraficos {
                    display: flex;
                    flex-direction: column;
                    gap: 40px;
                    /* Espaciado entre los contenedores de gráficos */
                }

                #contenedorGraficos h4 {
                    text-align: center;
                    margin-bottom: 20px;
                }

                #contenedorGraficos .row {
                    margin-bottom: 20px;
                }

                #contenedorGraficos div {
                    text-align: center;
                }
            </style>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Ingresar datos:</h3>
                        </div>
                        <div class="card-body">
                            <form id="formParticipacion">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="ciclo">Ciclo Lectivo:<b style="color:red">*</b></label>
                                            <select name="id_gestion" id="ciclo" class="form-control" required>
                                                <option value="" disabled selected>Seleccionar ciclo lectivo</option>
                                                <?php foreach ($gestiones as $gestione): ?>
                                                    <option value="<?= $gestione['gestion']; ?>">
                                                        <?= $gestione['gestion']; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="turno">Turno:<b style="color:red">*</b></label>
                                            <select name="id_nivel" id="turno" class="form-control" required>
                                                <option value="" disabled selected>Seleccionar turno</option>
                                                <?php foreach ($niveles as $nivele): ?>
                                                    <option value="<?= $nivele['turno']; ?>">
                                                        <?= $nivele['turno']; ?> <!-- Solo imprime el turno -->
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="grado">Grado y división:<b style="color:red">*</b></label>
                                            <!-- Grado y División -->
                                            <select id="grado" name="id_grado" class="form-control" required>
                                                <option value="" disabled selected>Seleccionar grado</option>
                                                <?php foreach ($grados as $grado): ?>
                                                    <option value="<?= $grado['id_grado']; ?>">
                                                        <?= $grado['curso'] . " " . $grado['paralelo']; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- Matriculados -->
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="matriculados">Alumnos matriculados:<b
                                                    style="color:red">*</b></label>
                                            <input type="number" id="matriculados" class="form-control"
                                                placeholder="Cantidad de matriculados" required readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="actos_asistieron">Actos: Participación Activa - Aceptable<b
                                                style="color:red">*</b></label>
                                        <input type="number" id="actos_asistieron" class="form-control" required readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="actos_noasistieron">Actos: Participación Baja - Escasa<b
                                                style="color:red">*</b></label>
                                        <input type="number" id="actos_noasistieron" class="form-control" required readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="reuniones_asistieron">Reuniones: Participación Activa - Aceptable<b
                                                style="color:red">*</b></label>
                                        <input type="number" id="reuniones_asistieron" class="form-control" required readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="reuniones_noasistieron">Reuniones: Participación Baja - Escasa<b
                                                style="color:red">*</b></label>
                                        <input type="number" id="reuniones_noasistieron" class="form-control" required readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="extras_asistieron">Actividades Extras: Participación Activa - Aceptable<b
                                                style="color:red">*</b></label>
                                        <input type="number" id="extras_asistieron" class="form-control" required readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="extras_noasistieron">Actividades Extras: Participación Baja - Escasa<b
                                                style="color:red">*</b></label>
                                        <input type="number" id="extras_noasistieron" class="form-control" required readonly>
                                    </div>
                                </div>
                                <br>
                                <button type="button" class="btn btn-primary" id="guardarRegistro">Agregar</button>
                            </form>
                        </div>
                        <div class="card-body">
                            <h3>Porcentaje de participación</h3>
                            <div id="contenedorGraficos" class="container">
                                <!-- Aquí se generarán los contenedores de gráficos -->
                            </div>
                            <!-- <table class="table table-bordered mt-4" id="tablaParticipacion">
                                <thead>
                                    <tr>
                                        <th>Grado</th>
                                        <th>Turno</th>
                                        <th>Actos: Asistieron</th>
                                        <th>Actos: No Asistieron</th>
                                        <th>Reuniones: Asistieron</th>
                                        <th>Reuniones: No Asistieron</th>
                                        <th>Actividades Extras: Asistieron</th>
                                        <th>Actividades Extras: No Asistieron</th>
                                    </tr>
                                </thead> -->
                            <tbody>
                                <!-- Registros dinámicos -->
                            </tbody>
                            <!-- </table> -->
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group text-center">
                                    <a href="<?= APP_URL; ?>/admin/estadisticas/index.php"
                                        class="btn btn-danger">Volver</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('../../admin/layout/parte2.php'); ?>



<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const contenedorGraficos = document.getElementById('contenedorGraficos');
        const gradoSelect = document.getElementById('grado');
        const matriculadosInput = document.getElementById('matriculados');
        const actos_asistieronInput = document.getElementById('actos_asistieron');
        const actos_noasistieronInput = document.getElementById('actos_noasistieron');
        const reuniones_asistieronInput = document.getElementById('reuniones_asistieron');
        const reuniones_noasistieronInput = document.getElementById('reuniones_noasistieron');
        const extras_asistieronInput = document.getElementById('extras_asistieron');
        const extras_noasistieronInput = document.getElementById('extras_noasistieron');

        function limpiarCampos() {
            document.getElementById('grado').value = '';
            document.getElementById('ciclo').value = '';
            document.getElementById('turno').value = '';
            document.getElementById('matriculados').value = '';
            document.getElementById('actos_asistieron').value = '';
            document.getElementById('actos_noasistieron').value = '';
            document.getElementById('reuniones_asistieron').value = '';
            document.getElementById('reuniones_noasistieron').value = '';
            document.getElementById('extras_asistieron').value = '';
            document.getElementById('extras_noasistieron').value = '';
        }

        // Obtener matriculados
        const obtenerMatriculados = () => {
            const grado = gradoSelect.value;
            if (grado) {
                const url = `<?= APP_URL; ?>/app/controllers/estadisticas/obtener_matriculados.php?grado=${grado}`;
                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        matriculadosInput.value = data.total || 0;
                    })
                    .catch(error => {
                        console.error("Error al obtener matriculados:", error);
                        matriculadosInput.value = 0;
                    });
            } else {
                matriculadosInput.value = "";
            }
        };

        // Obtener actos_asistieron
        const obtenerActos_asistieron = () => {
            const grado = gradoSelect.value;
            if (grado) {
                const url = `<?= APP_URL; ?>/app/controllers/estadisticas/obtener_actos_asistieron.php?grado=${grado}`;
                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        actos_asistieronInput.value = data.total || 0;
                    })
                    .catch(error => {
                        console.error("Error al obtener actos que asistieron:", error);
                        actos_asistieronInput.value = 0;
                    });
            } else {
                actos_asistieronInput.value = "";
            }
        };

        // Obtener actos_noasistieron
        const obtenerActos_noasistieron = () => {
            const grado = gradoSelect.value;
            if (grado) {
                const url = `<?= APP_URL; ?>/app/controllers/estadisticas/obtener_actos_noasistieron.php?grado=${grado}`;
                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        actos_noasistieronInput.value = data.total || 0;
                    })
                    .catch(error => {
                        console.error("Error al obtener actos que no asistieron:", error);
                        actos_noasistieronInput.value = 0;
                    });
            } else {
                actos_noasistieronInput.value = "";
            }
        };

        // Obtener reuniones_asistieron
        const obtenerReuniones_asistieron = () => {
            const grado = gradoSelect.value;
            if (grado) {
                const url = `<?= APP_URL; ?>/app/controllers/estadisticas/obtener_reuniones_asistieron.php?grado=${grado}`;
                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        reuniones_asistieronInput.value = data.total || 0;
                    })
                    .catch(error => {
                        console.error("Error al obtener reuniones que asistieron:", error);
                        reuniones_asistieronInput.value = 0;
                    });
            } else {
                reuniones_asistieronInput.value = "";
            }
        };

        // Obtener reuniones_noasistieron
        const obtenerReuniones_noasistieron = () => {
            const grado = gradoSelect.value;
            if (grado) {
                const url = `<?= APP_URL; ?>/app/controllers/estadisticas/obtener_reuniones_noasistieron.php?grado=${grado}`;
                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        reuniones_noasistieronInput.value = data.total || 0;
                    })
                    .catch(error => {
                        console.error("Error al obtener reuniones que no asistieron:", error);
                        reuniones_noasistieronInput.value = 0;
                    });
            } else {
                reuniones_noasistieronInput.value = "";
            }
        };

        // Obtener extras_asistieron
        const obtenerExtras_asistieron = () => {
            const grado = gradoSelect.value;
            if (grado) {
                const url = `<?= APP_URL; ?>/app/controllers/estadisticas/obtener_extras_asistieron.php?grado=${grado}`;
                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        extras_asistieronInput.value = data.total || 0;
                    })
                    .catch(error => {
                        console.error("Error al obtener extras que asistieron:", error);
                        extras_asistieronInput.value = 0;
                    });
            } else {
                extras_asistieronInput.value = "";
            }
        };

        // Obtener extras_noasistieron
        const obtenerExtras_noasistieron = () => {
            const grado = gradoSelect.value;
            if (grado) {
                const url = `<?= APP_URL; ?>/app/controllers/estadisticas/obtener_extras_noasistieron.php?grado=${grado}`;
                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        extras_noasistieronInput.value = data.total || 0;
                    })
                    .catch(error => {
                        console.error("Error al obtener extras que no asistieron:", error);
                        extras_noasistieronInput.value = 0;
                    });
            } else {
                extras_noasistieronInput.value = "";
            }
        };

        // Escuchar cambios en el select de grado
        gradoSelect.addEventListener('change', function () {
            const gradoValue = gradoSelect.value; // Usado para fetch
            const gradoText = gradoSelect.options[gradoSelect.selectedIndex].text; // Usado para mostrar


            obtenerMatriculados();
            obtenerActos_asistieron();
            obtenerActos_noasistieron();
            obtenerReuniones_asistieron();
            obtenerReuniones_noasistieron();
            obtenerExtras_asistieron();
            obtenerExtras_noasistieron();
        });

        function calcularPorcentajes(asistieron, noAsistieron) {
            const total = asistieron + noAsistieron;
            if (total === 0) return [0, 0];
            const asistieronPorcentaje = ((asistieron / total) * 100).toFixed(2);
            const noAsistieronPorcentaje = ((noAsistieron / total) * 100).toFixed(2);
            return [asistieronPorcentaje, noAsistieronPorcentaje];
        }

        function crearTabla(grado, ciclo, turno, actos, reuniones, extras) {
            const tabla = document.createElement('table');
            tabla.style.width = "40%";
            tabla.style.borderCollapse = "collapse";
            tabla.style.fontSize = "12px";
            tabla.style.margin = "5px";

            const thead = document.createElement('thead');
            thead.innerHTML = `
            <tr>
                <th style="border: 1px solid #ccc; padding: 4px; text-align: left;">Grado</th>
                <th style="border: 1px solid #ccc; padding: 4px; text-align: left;">Ciclo</th>
                <th style="border: 1px solid #ccc; padding: 4px; text-align: left;">Participación</th>
                <th style="border: 1px solid #ccc; padding: 4px; text-align: left;">Aceptable</th>
                <th style="border: 1px solid #ccc; padding: 4px; text-align: left;">Escasa</th>
                <th style="border: 1px solid #ccc; padding: 4px; text-align: left;">%</th>
            </tr>
        `;
            tabla.appendChild(thead);

            const tbody = document.createElement('tbody');
            const actividades = [
                { nombre: 'Actos', valores: actos },
                { nombre: 'Reuniones', valores: reuniones },
                { nombre: 'Extras', valores: extras }
            ];

            actividades.forEach(actividad => {
                const total = actividad.valores[0] + actividad.valores[1];
                const participacion = total > 0
                    ? ((actividad.valores[0] / total) * 100).toFixed(2) + '%'
                    : '0%';

                const fila = document.createElement('tr');
                fila.innerHTML = `
                <td style="border: 1px solid #ccc; padding: 4px;">${grado}</td>
                <td style="border: 1px solid #ccc; padding: 4px;">${ciclo}</td>
                <td style="border: 1px solid #ccc; padding: 4px;">${actividad.nombre}</td>
                <td style="border: 1px solid #ccc; padding: 4px;">${actividad.valores[0]}</td>
                <td style="border: 1px solid #ccc; padding: 4px;">${actividad.valores[1]}</td>
                <td style="border: 1px solid #ccc; padding: 4px;">${participacion}</td>
            `;
                tbody.appendChild(fila);
            });

            tabla.appendChild(tbody);
            return tabla;
        }

        function crearGrafico(data, labels, colores, container, titulo) {
            const contenedorGrafico = document.createElement('div');
            contenedorGrafico.style.flex = "1";
            contenedorGrafico.style.marginLeft = "5px";
            contenedorGrafico.style.textAlign = "center";

            const tituloGrafico = document.createElement('div');
            tituloGrafico.textContent = titulo;
            tituloGrafico.style.fontSize = "12px";
            tituloGrafico.style.marginBottom = "5px";
            tituloGrafico.style.color = "#333";
            contenedorGrafico.appendChild(tituloGrafico);

            const canvas = document.createElement('canvas');
            canvas.width = 200; // Tamaño reducido
            canvas.height = 200;
            contenedorGrafico.appendChild(canvas);

            new Chart(canvas, {
                type: 'doughnut',
                data: {
                    labels: labels,
                    datasets: [{
                        data: data,
                        backgroundColor: colores,
                    }]
                },
                options: {
                    responsive: false,
                    plugins: {
                        legend: { display: false },
                    }
                }
            });

            container.appendChild(contenedorGrafico);
        }

        function agregarRegistro() {
            const grado = document.getElementById('grado').value;
            const ciclo = document.getElementById('ciclo').value;
            const turno = document.getElementById('turno').value;

            const actos = [
                parseInt(document.getElementById('actos_asistieron').value) || 0,
                parseInt(document.getElementById('actos_noasistieron').value) || 0
            ];
            const reuniones = [
                parseInt(document.getElementById('reuniones_asistieron').value) || 0,
                parseInt(document.getElementById('reuniones_noasistieron').value) || 0
            ];
            const extras = [
                parseInt(document.getElementById('extras_asistieron').value) || 0,
                parseInt(document.getElementById('extras_noasistieron').value) || 0
            ];

            const contenedor = document.createElement('div');
            contenedor.style.display = "flex";
            contenedor.style.marginBottom = "10px";
            contenedor.style.alignItems = "center";

            const tabla = crearTabla(grado, ciclo, turno, actos, reuniones, extras);
            contenedor.appendChild(tabla);

            const contenedorGraficos = document.createElement('div');
            contenedorGraficos.style.display = "flex";
            contenedorGraficos.style.flexDirection = "row";

            const labels = ['Asistieron', 'No Asistieron'];
            const colores = ['#A8D5BA', '#FFB1B1'];

            crearGrafico(calcularPorcentajes(...actos), labels, colores, contenedorGraficos, `Actos`);
            crearGrafico(calcularPorcentajes(...reuniones), labels, colores, contenedorGraficos, `Reuniones`);
            crearGrafico(calcularPorcentajes(...extras), labels, colores, contenedorGraficos, `Extras`);

            contenedor.appendChild(contenedorGraficos);
            document.getElementById('contenedorGraficos').appendChild(contenedor);

            limpiarCampos(); // Limpiar los campos al finalizar
        }

        document.getElementById('guardarRegistro').addEventListener('click', agregarRegistro);
    });
</script>