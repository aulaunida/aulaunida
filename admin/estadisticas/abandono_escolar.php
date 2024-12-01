<?php
include('../../app/config.php');
include('../../admin/layout/parte1.php');
include('../../app/controllers/roles/listado_de_roles.php');
include('../../app/controllers/usuarios/listado_de_usuarios.php');
include('../../app/controllers/niveles/listado_de_niveles.php');
include('../../app/controllers/grados/listado_de_grados.php');
include('../../app/controllers/materias/listado_de_materias.php');
include('../../app/controllers/docentes/listado_de_docentes.php');
include('../../app/controllers/estudiantes/listado_de_estudiantes.php');
include('../../app/controllers/docentes/listado_de_asignaciones.php');
include('../../app/controllers/estudiantes/reporte_estudiantes_grados.php');
include('../../app/controllers/configuraciones/gestion/listado_de_gestiones.php');
?>
<!-- Content Wrapper -->
<div class="content-wrapper">
    <br>
    <div class="content">
        <div class="container">
            <div class="row">
                <h1 style="margin-left: 20px;"><i class="bi bi-bar-chart-line"></i> Abandono escolar</h1>
            </div>
            <br>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Ingresar datos:</h3>
                        </div>
                        <div class="card-body">
                            <form id="formDatosAbandono">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="ciclo">Ciclo Lectivo:<b style="color:red">*</b></label>
                                            <select name="id_gestion" id="ciclo" class="form-control" required>
                                                <option value="" disabled selected>Seleccionar ciclo lectivo</option>
                                                <?php
                                                foreach ($gestiones as $gestione) {
                                                    $id_gestion = $gestione['id_gestion']; ?>
                                                    <option value="<?= $gestione['gestion']; ?>"><?= $gestione['gestion']; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="turno">Turno:<b style="color:red">*</b></label>
                                            <select name="id_nivel" id="turno" class="form-control" required>
                                                <option value="" disabled selected>Seleccionar turno</option>
                                                <?php
                                                foreach ($niveles as $nivele) {
                                                    $id_nivel = $nivele['id_nivel']; ?>
                                                    <option value="<?= $nivele['nivel'];?> - TURNO <?= $nivele['turno']; ?>"><?= $nivele['nivel']; ?> - TURNO <?= $nivele['turno']; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="grado">Grado y división:<b style="color:red">*</b></label>
                                            <select name="grado" id="selectGrado" class="form-control" required>
                                                <option value="" disabled selected>Seleccionar grado</option>
                                                <?php
                                                foreach ($grados as $grado) {
                                                    $id_grado = $grado['id_grado']; ?>
                                                    <option value="<?= $id_grado; ?>" data-display="<?= $grado['curso']; ?> - DIVISIÓN <?= $grado['paralelo']; ?>"><?= $grado['curso']; ?> - DIVISIÓN <?= $grado['paralelo']; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>

                                        </div>
                                    </div>



                                    <?php
                                    $contador = 0;
                                    $contador_primergrado_a = 0;
                                    $contador_segundogrado_a = 0;
                                    $contador_tercergrado_a = 0;
                                    $contador_cuartogrado_a = 0;
                                    $contador_quintogrado_a = 0;
                                    $contador_sextogrado_a = 0;
                                    $contador_primergrado_b = 0;
                                    $contador_segundogrado_b = 0;
                                    $contador_tercergrado_b = 0;
                                    $contador_cuartogrado_b = 0;
                                    $contador_quintogrado_b = 0;
                                    $contador_sextogrado_b = 0;


                                    foreach ($reporte_estudiantes as $reporte_estudiante) {
                                        if ($reporte_estudiante['grado_id'] == "1") $contador_primergrado_a = $contador_primergrado_a + 1;
                                        if ($reporte_estudiante['grado_id'] == "2") $contador_primergrado_b = $contador_primergrado_b + 1;
                                        if ($reporte_estudiante['grado_id'] == "8") $contador_segundogrado_a = $contador_segundogrado_a + 1;
                                        if ($reporte_estudiante['grado_id'] == "9") $contador_segundogrado_b = $contador_segundogrado_b + 1;
                                        if ($reporte_estudiante['grado_id'] == "10") $contador_tercergrado_a = $contador_tercergrado_a + 1;
                                        if ($reporte_estudiante['grado_id'] == "11") $contador_tercergrado_b = $contador_tercergrado_b + 1;
                                        if ($reporte_estudiante['grado_id'] == "12") $contador_cuartogrado_a = $contador_cuartogrado_a + 1;
                                        if ($reporte_estudiante['grado_id'] == "13") $contador_cuartogrado_b = $contador_cuartogrado_b + 1;
                                        if ($reporte_estudiante['grado_id'] == "14") $contador_quintogrado_a = $contador_quintogrado_a + 1;
                                        if ($reporte_estudiante['grado_id'] == "15") $contador_quintogrado_b = $contador_quintogrado_b + 1;
                                        if ($reporte_estudiante['grado_id'] == "16") $contador_sextogrado_a = $contador_sextogrado_a + 1;
                                        if ($reporte_estudiante['grado_id'] == "17") $contador_sextogrado_b = $contador_sextogrado_b + 1;
                                    }
                                    $datos_reportes_estudiantes =
                                        $contador_primergrado_a . "," .
                                        $contador_primergrado_b . "," .
                                        $contador_segundogrado_a . "," .
                                        $contador_segundogrado_b . "," .
                                        $contador_tercergrado_a . "," .
                                        $contador_tercergrado_b . "," .
                                        $contador_cuartogrado_a . "," .
                                        $contador_cuartogrado_b . "," .
                                        $contador_quintogrado_a . "," .
                                        $contador_quintogrado_b . "," .
                                        $contador_sextogrado_a . "," .
                                        $contador_sextogrado_b;
                                    ?>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="matriculados">Alumnos Matriculados:<b style="color:red">*</b></label>
                                            <input type="number" id="matriculados" value="" name="matriculados" class="form-control" placeholder="" disabled required>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <h6>Motivos de Abandono:</h6>
                                <hr>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="economico">Factores socioeconómicos:<b style="color:red">*</b></label>
                                            <input type="number" id="economico" class="form-control" value="0" placeholder="Cantidad de abandonos" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="personal">Factores personales:<b style="color:red">*</b></label>
                                            <input type="number" id="personal" class="form-control" value="0" placeholder="Cantidad de abandonos" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="educativo">Factores educativos:<b style="color:red">*</b></label>
                                            <input type="number" id="educativo" class="form-control" value="0" placeholder="Cantidad de abandonos" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="familia">Problemas familiares:<b style="color:red">*</b></label>
                                            <input type="number" id="familia" class="form-control" value="0" placeholder="Cantidad de abandonos" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="infraestructura">Falta de infraestructura:<b style="color:red">*</b></label>
                                            <input type="number" id="infraestructura" class="form-control" value="0" placeholder="Cantidad de abandonos" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="otros">Otros factores:<b style="color:red">*</b></label>
                                            <input type="number" id="otros" class="form-control" value="0" placeholder="Cantidad de abandonos" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="button" class="btn btn-primary" id="agregarDatos">Agregar</button>
                                </div>
                            </form>
                            <hr>
                            <div id="tablaDatos">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Ciclo</th>
                                            <th>Turno</th>
                                            <th>Grado</th>
                                            <th>Matriculados</th>
                                            <th>Total abandonos</th>
                                            <th>% Abandono</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody id="datosCargados">
                                        <!-- Aquí se añadirán los datos -->
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="card-body">
                            <canvas id="graficoPareto" width="400" height="200"></canvas>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group text-center">
                                    <a href="<?= APP_URL; ?>/admin/estadisticas/index.php" class="btn btn-danger">Volver</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include('../../admin/layout/parte2.php');
?>


<!-- Incluye Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        let datos = []; // Array para almacenar los datos ingresados
        let grafico; // Variable para el gráfico
        const tabla = document.getElementById('datosCargados');
        const canvas = document.getElementById('graficoPareto').getContext('2d');

        // Manejar clic del botón "Agregar"
        document.getElementById('agregarDatos').addEventListener('click', function() {
            const gradoElement = document.getElementById('selectGrado');
            const grado = gradoElement.value; // Esto sigue siendo el `value` para validaciones
            const gradoDisplay = gradoElement.options[gradoElement.selectedIndex].getAttribute('data-display'); // Obtiene el texto para mostrar en la tabla
            const turno = document.getElementById('turno').value;
            const ciclo = document.getElementById('ciclo').value;
            const matriculados = parseInt(document.getElementById('matriculados').value);
            const economico = parseInt(document.getElementById('economico').value);
            const familia = parseInt(document.getElementById('familia').value);
            const educativo = parseInt(document.getElementById('educativo').value);
            const personal = parseInt(document.getElementById('personal').value);
            const infraestructura = parseInt(document.getElementById('infraestructura').value);
            const otros = parseInt(document.getElementById('otros').value);

            if (!grado || !turno || !ciclo || isNaN(matriculados) || isNaN(economico) || isNaN(familia) ||
                isNaN(educativo) || isNaN(personal) || isNaN(infraestructura) || isNaN(otros)) {
                alert('Por favor, completa todos los campos correctamente.');
                return;
            }

            const totalAbandono = economico + familia + educativo + personal + infraestructura + otros;

            if (totalAbandono > matriculados) {
                alert('El total de abandonos no puede ser mayor que los matriculados.');
                return;
            }

            const porcentajeAbandono = ((totalAbandono / matriculados) * 100).toFixed(2);

            datos.push({
                grado, // Para validaciones
                gradoDisplay, // Para mostrar en la tabla
                turno,
                ciclo,
                matriculados,
                totalAbandono,
                porcentajeAbandono,
                economico,
                familia,
                educativo,
                personal,
                infraestructura,
                otros
            });

            actualizarTabla();
            actualizarGraficoPareto();
            document.getElementById('formDatosAbandono').reset();
        });

        const actualizarTabla = () => {
            tabla.innerHTML = ''; // Limpiar la tabla
            datos.forEach((dato, index) => {
                tabla.innerHTML += `
        <tr>
            <td>${dato.ciclo}</td>
            <td>${dato.turno}</td>
            <td>${dato.gradoDisplay}</td>
            <td>${dato.matriculados}</td>
            <td>${dato.totalAbandono}</td>
            <td>${dato.porcentajeAbandono}%</td>
            <td><button class="btn btn-danger btn-sm" onclick="eliminarDato(${index})">Eliminar</button></td>
        </tr>
    `;
            });
        };


        window.eliminarDato = (index) => {
            datos.splice(index, 1);
            actualizarTabla();
            actualizarGraficoPareto();
        };

        const actualizarGraficoPareto = () => {
            const razones = ['Socioeconómico', 'Familiar', 'Educativo', 'Personal', 'Infraestructura', 'Otros'];
            const colores = ['rgba(255, 99, 132, 0.7)', 'rgba(54, 162, 235, 0.7)', 'rgba(255, 206, 86, 0.7)', 'rgba(75, 192, 192, 0.7)', 'rgba(153, 102, 255, 0.7)', 'rgba(255, 159, 64, 0.7)']; // Colores con opacidad
            const totalesPorGrupo = {};

            datos.forEach((dato, index) => {
                const grupo = `${dato.grado} (${dato.turno})`;
                if (!totalesPorGrupo[grupo]) {
                    totalesPorGrupo[grupo] = Array(6).fill(0);
                }
                totalesPorGrupo[grupo][0] += dato.economico;
                totalesPorGrupo[grupo][1] += dato.familia;
                totalesPorGrupo[grupo][2] += dato.educativo;
                totalesPorGrupo[grupo][3] += dato.personal;
                totalesPorGrupo[grupo][4] += dato.infraestructura;
                totalesPorGrupo[grupo][5] += dato.otros;
            });

            const etiquetas = razones;
            const datasets = Object.keys(totalesPorGrupo).map((grupo, idx) => ({
                label: grupo,
                data: totalesPorGrupo[grupo],
                backgroundColor: colores[idx % colores.length],
                borderWidth: 1,
                barThickness: 50, // Ancho de las barras reducido
                yAxisID: 'y',
            }));

            const totalesGlobales = razones.map((_, idx) =>
                Object.values(totalesPorGrupo).reduce((acc, grupo) => acc + grupo[idx], 0)
            );

            const totalGeneral = totalesGlobales.reduce((a, b) => a + b, 0);
            let acumulado = 0;
            const porcentajesAcumulados = totalesGlobales.map(total => {
                acumulado += total;
                return ((acumulado / totalGeneral) * 100).toFixed(2);
            });

            if (grafico) grafico.destroy();

            grafico = new Chart(canvas, {
                type: 'bar',
                data: {
                    labels: etiquetas,
                    datasets: [
                        ...datasets,
                        {
                            label: 'Porcentaje Acumulado',
                            data: porcentajesAcumulados,
                            type: 'line',
                            borderColor: '#0000FF',
                            borderWidth: 2,
                            pointRadius: 3,
                            fill: false,
                            yAxisID: 'y1',
                            order: 2, // Línea renderizada después de las barras
                        },
                    ],
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            type: 'linear',
                            position: 'left',
                            title: {
                                display: true,
                                text: 'Cantidad de Abandonos'
                            },
                            beginAtZero: true,
                        },
                        y1: {
                            type: 'linear',
                            position: 'right',
                            title: {
                                display: true,
                                text: 'Porcentaje Acumulado (%)'
                            },
                            grid: {
                                drawOnChartArea: false
                            },
                            ticks: {
                                callback: value => `${value}%`,
                            },
                            beginAtZero: true,
                        },
                    },
                    plugins: {
                        legend: {
                            display: true
                        },
                        title: {
                            display: true,
                            text: 'Gráfico Pareto de Abandonos'
                        },
                    },
                },
            });
        };
    });
</script>

<script>
    // Datos de los contadores por grado
    const contadoresPorGrado = {
        1: <?= $contador_primergrado_a; ?>,
        2: <?= $contador_primergrado_b; ?>,
        8: <?= $contador_segundogrado_a; ?>,
        9: <?= $contador_segundogrado_b; ?>,
        10: <?= $contador_tercergrado_a; ?>,
        11: <?= $contador_tercergrado_b; ?>,
        12: <?= $contador_cuartogrado_a; ?>,
        13: <?= $contador_cuartogrado_b; ?>,
        14: <?= $contador_quintogrado_a; ?>,
        15: <?= $contador_quintogrado_b; ?>,
        16: <?= $contador_sextogrado_a; ?>,
        17: <?= $contador_sextogrado_b; ?>
    };

    // Referencia al select y al input
    const selectGrado = document.getElementById('selectGrado');
    const inputMatriculados = document.getElementById('matriculados');

    // Escuchar cambios en el select
    selectGrado.addEventListener('change', (event) => {
        const gradoSeleccionado = event.target.value;
        // Actualizar el input con el valor correspondiente
        inputMatriculados.value = contadoresPorGrado[gradoSeleccionado] || '';
    });
</script>