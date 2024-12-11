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
<style>
    .centrar-grafico {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    @media print {
        .no-imprimir {
            display: none;
        }
    }
</style>

<!-- Content Wrapper -->
<div class="content-wrapper">
    <br>
    <div class="content">
        <div class="container">
            <div class="row">
                <h1 style="margin-left: 20px;"><i class="bi bi-bar-chart-line"></i> Alumnos integrados</h1>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Ingresar datos:</h3>
                        </div>
                        <div class="card-body">
                            <div class="card-body no-imprimir">
                                <form id="formDatosAlumnos">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="ciclo">Ciclo Lectivo:<b style="color:red">*</b></label>
                                                <select name="id_gestion" id="ciclo" class="form-control" required>
                                                    <option value="" disabled selected>Seleccionar ciclo lectivo</option>
                                                    <?php
                                                    foreach ($gestiones as $gestione) {
                                                        if ($gestione['gestion'] == 'CICLO LECTIVO 2024') { // Verifica si id_rol es igual a 1
                                                    ?>
                                                            <option value="<?= $gestione['id_gestion']; ?>"><?= $gestione['gestion']; ?></option>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3" hidden>
                                            <!-- <div class="form-group">
                                                <label for="turno">Turno:<b style="color:red">*</b></label>
                                                <select name="id_nivel" id="turno" class="form-control">
                                                    <option value="" disabled selected>Seleccionar turno</option>
                                                    <?php foreach ($niveles as $nivele): ?>
                                                        <option value="<?= $nivele['turno']; ?>">
                                                            <?= $nivele['turno']; ?>  Solo imprime el turno -->
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
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
                                                <label for="matriculados">Alumnos matriculados:<b style="color:red">*</b></label>
                                                <input type="number" id="matriculados" class="form-control" placeholder="Cantidad de matriculados" required readonly>
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


                                    $contador = 0;
                                    $contador_primergrado_a_r = 0;
                                    $contador_segundogrado_a_r = 0;
                                    $contador_tercergrado_a_r = 0;
                                    $contador_cuartogrado_a_r = 0;
                                    $contador_quintogrado_a_r = 0;
                                    $contador_sextogrado_a_r = 0;
                                    $contador_primergrado_b_r = 0;
                                    $contador_segundogrado_b_r = 0;
                                    $contador_tercergrado_b_r = 0;
                                    $contador_cuartogrado_b_r = 0;
                                    $contador_quintogrado_b_r = 0;
                                    $contador_sextogrado_b_r = 0;


                                    foreach ($reporte_estudiantes3 as $reporte_estudiante3) {
                                        if ($reporte_estudiante3['grado_id'] == "1") $contador_primergrado_a_r = $contador_primergrado_a_r + 1;
                                        if ($reporte_estudiante3['grado_id'] == "2") $contador_primergrado_b_r = $contador_primergrado_b_r + 1;
                                        if ($reporte_estudiante3['grado_id'] == "8") $contador_segundogrado_a_r = $contador_segundogrado_a_r + 1;
                                        if ($reporte_estudiante3['grado_id'] == "9") $contador_segundogrado_b_r = $contador_segundogrado_b_r + 1;
                                        if ($reporte_estudiante3['grado_id'] == "10") $contador_tercergrado_a_r = $contador_tercergrado_a_r + 1;
                                        if ($reporte_estudiante3['grado_id'] == "11") $contador_tercergrado_b_r = $contador_tercergrado_b_r + 1;
                                        if ($reporte_estudiante3['grado_id'] == "12") $contador_cuartogrado_a_r = $contador_cuartogrado_a_r + 1;
                                        if ($reporte_estudiante3['grado_id'] == "13") $contador_cuartogrado_b_r = $contador_cuartogrado_b_r + 1;
                                        if ($reporte_estudiante3['grado_id'] == "14") $contador_quintogrado_a_r = $contador_quintogrado_a_r + 1;
                                        if ($reporte_estudiante3['grado_id'] == "15") $contador_quintogrado_b_r = $contador_quintogrado_b_r + 1;
                                        if ($reporte_estudiante3['grado_id'] == "16") $contador_sextogrado_a_r = $contador_sextogrado_a_r + 1;
                                        if ($reporte_estudiante3['grado_id'] == "17") $contador_sextogrado_b_r = $contador_sextogrado_b_r + 1;
                                    }
                                    $datos_reportes_estudiantes_r =
                                        $contador_primergrado_a_r . "," .
                                        $contador_primergrado_b_r . "," .
                                        $contador_segundogrado_a_r . "," .
                                        $contador_segundogrado_b_r . "," .
                                        $contador_tercergrado_a_r . "," .
                                        $contador_tercergrado_b_r . "," .
                                        $contador_cuartogrado_a_r . "," .
                                        $contador_cuartogrado_b_r . "," .
                                        $contador_quintogrado_a_r . "," .
                                        $contador_quintogrado_b_r . "," .
                                        $contador_sextogrado_a_r . "," .
                                        $contador_sextogrado_b_r;
                                    ?>
                                    <!-- Alumnos Matriculados -->
                                        <!-- Integrados -->
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="repetidores">Alumnos integrados:<b style="color:red">*</b></label>
                                                <input type="number" id="repetidores" class="form-control" placeholder="Cantidad de alumnos integrados" required readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <h6>Motivo de integración:</h6>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="intelectual">Discapacidad intelectual:<b style="color:red">*</b></label>
                                                <input type="number" id="intelectual" class="form-control" placeholder="Cantidad" required readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="sordera">Sordera o Hipoacusia:<b style="color:red">*</b></label>
                                                <input type="number" id="sordera" class="form-control" placeholder="Cantidad" required readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="ceguera">Ceguera o Disminución visual:<b style="color:red">*</b></label>
                                                <input type="number" id="ceguera" class="form-control" placeholder="Cantidad" required readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="motora">Motora o Neuromotora:<b style="color:red">*</b></label>
                                                <input type="number" id="motora" class="form-control" placeholder="Cantidad" required readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="tgd">TGD o TEA:<b style="color:red">*</b></label>
                                                <input type="number" id="tgd" class="form-control" placeholder="Cantidad" required readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="multiples">Más de una discapacidad:<b style="color:red">*</b></label>
                                                <input type="number" id="multiples" class="form-control" placeholder="Cantidad" required readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="otras">Otro motivo:<b style="color:red">*</b></label>
                                                <input type="number" id="otras" class="form-control" placeholder="Cantidad" required readonly>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <div class="form-group">
                                    <button type="button" class="btn btn-primary" id="agregarDatos">Agregar</button>
                                </div>
                                <hr>
                            </div>
                            <div id="tablaDatos">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Ciclo</th>
                                            <!-- <th>Turno</th> -->
                                            <th>Grado</th>
                                            <th>Total alumnos</th>
                                            <th>Alumnos integrados</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody id="datosCargados">
                                        <!-- Aquí se añadirán los datos -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-body centrar-grafico">
                            <canvas id="graficoDiscapacidades" style="max-width: 600px; max-height: 400px;"></canvas>
                        </div>
                        <div class="card-body centrar-grafico">
                            <canvas id="graficoAlumnos" style="max-width: 600px; max-height: 400px;"></canvas>
                        </div>
                        <div class="card-body no-imprimir">
                            <div class="form-group text-center">
                                <button type="button" class="btn btn-info" onclick="imprimirPagina()">Exportar Reporte</button>

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
</div>
<?php
include('../../admin/layout/parte2.php');
?>
<!-- Incluye Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>

<!-- jsPDF y html2canvas -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
<script>
    function imprimirPagina() {
        window.print();
    }
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        let datos = [];
        let grafico;
        const tabla = document.getElementById('datosCargados');
        const canvas = document.getElementById('graficoAlumnos').getContext('2d');
        const gradoSelect = document.getElementById('grado');
        const matriculadosInput = document.getElementById('matriculados');
        const repetidoresInput = document.getElementById('repetidores');
        const intelectualInput = document.getElementById('intelectual');
        const sorderaInput = document.getElementById('sordera');
        const cegueraInput = document.getElementById('ceguera');
        const motoraInput = document.getElementById('motora');
        const tgdInput = document.getElementById('tgd');
        const multiplesInput = document.getElementById('multiples');
        const otrasInput = document.getElementById('otras');
        // Inicializa el gráfico vacío
        const inicializarGrafico = () => {
            grafico = new Chart(canvas, {
                type: 'bar',
                data: {
                    labels: [], // Etiquetas vacías
                    datasets: [] // Sin datasets
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: true
                        },
                        title: {
                            display: true,
                            text: 'Distribución de Alumnos Integrados'
                        }
                    },
                    scales: {
                        x: {
                            stacked: true,
                            barThickness: 0.5, // Define un grosor específico para las barras
                            title: {
                                display: true,
                                text: 'Grados'
                            }
                        },
                        y: {
                            stacked: true,
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Cantidad de Alumnos'
                            }
                        }
                    }
                }
            });
        };
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
        // Obtener repetidores
        const obtenerRepetidores = () => {
            const grado = gradoSelect.value;
            if (grado) {
                const url = `<?= APP_URL; ?>/app/controllers/estadisticas/obtener_integrados.php?grado=${grado}`;
                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        repetidoresInput.value = data.total || 0;
                    })
                    .catch(error => {
                        console.error("Error al obtener repetidores:", error);
                        repetidoresInput.value = 0;
                    });
            } else {
                repetidoresInput.value = "";
            }
        };
        // Obtener intelectual
        const obtenerIntelectual = () => {
            const grado = gradoSelect.value;
            if (grado) {
                const url = `<?= APP_URL; ?>/app/controllers/estadisticas/obtener_intelectual.php?grado=${grado}`;
                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        intelectualInput.value = data.total || 0;
                    })
                    .catch(error => {
                        console.error("Error al obtener intelectual:", error);
                        intelectualInput.value = 0;
                    });
            } else {
                intelectualInput.value = "";
            }
        };
        // Obtener sordera
        const obtenerSordera = () => {
            const grado = gradoSelect.value;
            if (grado) {
                const url = `<?= APP_URL; ?>/app/controllers/estadisticas/obtener_sordera.php?grado=${grado}`;
                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        sorderaInput.value = data.total || 0;
                    })
                    .catch(error => {
                        console.error("Error al obtener sordera:", error);
                        sorderaInput.value = 0;
                    });
            } else {
                sorderaInput.value = "";
            }
        };
        // Obtener ceguera
        const obtenerCeguera = () => {
            const grado = gradoSelect.value;
            if (grado) {
                const url = `<?= APP_URL; ?>/app/controllers/estadisticas/obtener_ceguera.php?grado=${grado}`;
                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        cegueraInput.value = data.total || 0;
                    })
                    .catch(error => {
                        console.error("Error al obtener ceguera:", error);
                        cegueraInput.value = 0;
                    });
            } else {
                cegueraInput.value = "";
            }
        };
        // Obtener motora
        const obtenerMotora = () => {
            const grado = gradoSelect.value;
            if (grado) {
                const url = `<?= APP_URL; ?>/app/controllers/estadisticas/obtener_motora.php?grado=${grado}`;
                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        motoraInput.value = data.total || 0;
                    })
                    .catch(error => {
                        console.error("Error al obtener motora:", error);
                        motoraInput.value = 0;
                    });
            } else {
                motoraInput.value = "";
            }
        };
        // Obtener tgd
        const obtenerTgd = () => {
            const grado = gradoSelect.value;
            if (grado) {
                const url = `<?= APP_URL; ?>/app/controllers/estadisticas/obtener_tgd.php?grado=${grado}`;
                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        tgdInput.value = data.total || 0;
                    })
                    .catch(error => {
                        console.error("Error al obtener tgd:", error);
                        tgdInput.value = 0;
                    });
            } else {
                tgdInput.value = "";
            }
        };
        // Obtener multiples
        const obtenerMultiples = () => {
            const grado = gradoSelect.value;
            if (grado) {
                const url = `<?= APP_URL; ?>/app/controllers/estadisticas/obtener_multiples.php?grado=${grado}`;
                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        multiplesInput.value = data.total || 0;
                    })
                    .catch(error => {
                        console.error("Error al obtener multiples:", error);
                        multiplesInput.value = 0;
                    });
            } else {
                multiplesInput.value = "";
            }
        };
        // Obtener otras
        const obtenerOtras = () => {
            const grado = gradoSelect.value;
            if (grado) {
                const url = `<?= APP_URL; ?>/app/controllers/estadisticas/obtener_otras.php?grado=${grado}`;
                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        otrasInput.value = data.total || 0;
                    })
                    .catch(error => {
                        console.error("Error al obtener multiples:", error);
                        otrasInput.value = 0;
                    });
            } else {
                otrasInput.value = "";
            }
        };
        // Escuchar cambios en el select de grado
        gradoSelect.addEventListener('change', function() {
            const gradoValue = gradoSelect.value; // Usado para fetch
            const gradoText = gradoSelect.options[gradoSelect.selectedIndex].text; // Usado para mostrar
            obtenerMatriculados();
            obtenerRepetidores();
            obtenerIntelectual();
            obtenerSordera();
            obtenerCeguera();
            obtenerMotora();
            obtenerTgd();
            obtenerMultiples();
            obtenerOtras();
        });
        document.getElementById('agregarDatos').addEventListener('click', function() {
            const grado = gradoSelect.value;
            const gradoValue = gradoSelect.value;
            const gradoText = gradoSelect.options[gradoSelect.selectedIndex].text;
            // const turno = document.getElementById('turno').value;
            const cicloSelect = document.getElementById('ciclo'); // Selecciona el elemento ciclo
            const ciclo = cicloSelect.value; // ID del ciclo
            const cicloText = cicloSelect.options[cicloSelect.selectedIndex].text; // Texto del ciclo
            const matriculados = parseInt(matriculadosInput.value);
            const repetidores = parseInt(repetidoresInput.value);
            const intelectual = parseInt(intelectualInput.value);
            const sordera = parseInt(sorderaInput.value);
            const ceguera = parseInt(cegueraInput.value);
            const motora = parseInt(motoraInput.value);
            const tgd = parseInt(tgdInput.value);
            const multiples = parseInt(multiplesInput.value);
            const otras = parseInt(otrasInput.value);

            if (!grado || !ciclo || isNaN(matriculados) || isNaN(repetidores) || isNaN(intelectual) ||
                isNaN(sordera) || isNaN(ceguera) || isNaN(motora) || isNaN(tgd) || isNaN(multiples) || isNaN(otras)) {
                alert('Por favor, completa todos los campos correctamente.');
                return;
            }
            const totalIntegrados = intelectual + sordera + ceguera + motora + tgd + multiples + otras;
            if (totalIntegrados > matriculados) {
                alert('La suma de los alumnos integrados no puede superar el total de alumnos.');
                return;
            }
            datos.push({
                ciclo: gradoText,
                // turno,
                grado: gradoText, // Mostrar texto en la tabla
                matriculados,
                repetidores,
                intelectual,
                sordera,
                ceguera,
                motora,
                tgd,
                multiples,
                otras
            });

            actualizarTabla();
            actualizarGrafico();
            document.getElementById('formDatosAlumnos').reset();
        });

        const actualizarTabla = () => {
            tabla.innerHTML = '';
            datos.forEach((dato, index) => {
                const totalIntegrados = dato.intelectual + dato.sordera + dato.ceguera + dato.motora + dato.tgd + dato.multiples + dato.otras;
                tabla.innerHTML += `
                <tr>
                    <td>${dato.ciclo}</td>
                    <td>${dato.grado}</td>
                    <td>${dato.matriculados}</td>
                    <td>${totalIntegrados}</td>
                    <td><button class="btn btn-danger btn-sm" onclick="eliminarDato(${index})">Eliminar</button></td>
                </tr>
            `;
            });
        };
        // Definir colores fijos
        const coloresFijos = [
            "#FF6384", // Rosa pastel
            "#36A2EB", // Azul pastel
            "#FFCE56", // Durazno pastel
            "#4BC0C0", // Púrpura pastel
            "#9966FF", // Verde pastel
            "#FF9F40", // Amarillo pastel
            "#FF5733"  // Naranja oscuro pastel
        ];

        const actualizarGrafico = () => {
            const grados = [...new Set(datos.map(dato => dato.grado))];
            const categorias = ['Intelectual', 'Sordera', 'Ceguera', 'Motora', 'TGD', 'Más de una', 'Otras'];
            const data = {
                'Intelectual': Array(grados.length).fill(0),
                'Sordera': Array(grados.length).fill(0),
                'Ceguera': Array(grados.length).fill(0),
                'Motora': Array(grados.length).fill(0),
                'TGD': Array(grados.length).fill(0),
                'Más de una': Array(grados.length).fill(0),
                'Otras': Array(grados.length).fill(0),
            };
            datos.forEach(dato => {
                const gradoIndex = grados.indexOf(dato.grado);
                data['Intelectual'][gradoIndex] += dato.intelectual;
                data['Sordera'][gradoIndex] += dato.sordera;
                data['Ceguera'][gradoIndex] += dato.ceguera;
                data['Motora'][gradoIndex] += dato.motora;
                data['TGD'][gradoIndex] += dato.tgd;
                data['Más de una'][gradoIndex] += dato.multiples;
                data['Otras'][gradoIndex] += dato.otras;
            });
            const datasets = Object.keys(data).map((categoria, index) => ({
                label: categoria,
                data: data[categoria],
                backgroundColor: coloresFijos[index] // Usar colores fijos correctamente
            }));

            if (grafico) {
                grafico.destroy();
            }
            grafico = new Chart(canvas, {
                type: 'bar',
                data: {
                    labels: grados,
                    datasets: datasets
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: true
                        },
                        title: {
                            display: true,
                            text: 'Distribución de alumnos integrados por grados'
                        }
                    },
                    scales: {
                        x: {
                            stacked: true,
                            barThickness: 0.5, // Define un grosor específico para las barras
                            title: {
                                display: true,
                                text: 'Grados'
                            }
                        },
                        y: {
                            stacked: true,
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Cantidad de Alumnos'
                            }
                        }
                    }
                }
            });
        };

        window.eliminarDato = (index) => {
            datos.splice(index, 1);
            actualizarTabla();
            actualizarGrafico();
        };

        let graficoCircular;

        const inicializarGraficoCircular = () => {
            const canvasCircular = document.getElementById('graficoDiscapacidades').getContext('2d');
            graficoCircular = new Chart(canvasCircular, {
                type: 'pie',
                data: {
                    labels: ['Discapacidad intelectual', 'Sordera o Hipoacusia', 'Ceguera o Disminución visual', 'Motora o Neuromotora', 'TGD o TEA', 'Más de una', 'Otro motivo'],
                    datasets: [{
                        data: [], // Se llenará dinámicamente
                        backgroundColor: coloresFijos
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: true // Mantiene la leyenda habitual
                        },
                        title: {
                            display: true,
                            text: 'Porcentaje de los motivos de integración'
                        },
                        datalabels: { // Configuración del plugin para etiquetas
                            color: '#000', // Color de las etiquetas
                            font: {
                            size: 14,
                            weight: 'normal'
                            },
                            formatter: (value, context) => {
                                // Mostrar solo si el valor es mayor que 0
                                if (value > 0) {
                                    const label = context.chart.data.labels[context.dataIndex];
                                    return ` ${value}%`; // porcentaje
                                }
                                return null; // Ocultar etiquetas con valor 0
                            }
                        }
                    }
                },
                plugins: [ChartDataLabels] // Asegúrate de que está registrado
            });
        };

        const actualizarGraficoCircular = () => {
            // Calcular totales por categoría
            const totalPorCategoria = {
                'Intelectual': 0,
                'Sordera': 0,
                'Ceguera': 0,
                'Motora': 0,
                'TGD': 0,
                'Más de una': 0,
                'Otras': 0
            };

            let totalIntegradosGlobal = 0;

            datos.forEach(dato => {
                totalPorCategoria['Intelectual'] += dato.intelectual;
                totalPorCategoria['Sordera'] += dato.sordera;
                totalPorCategoria['Ceguera'] += dato.ceguera;
                totalPorCategoria['Motora'] += dato.motora;
                totalPorCategoria['TGD'] += dato.tgd;
                totalPorCategoria['Más de una'] += dato.multiples;
                totalPorCategoria['Otras'] += dato.otras;
                totalIntegradosGlobal += dato.intelectual + dato.sordera + dato.ceguera + dato.motora + dato.tgd + dato.multiples + dato.otras;
            });

            const porcentajes = Object.values(totalPorCategoria).map(total => totalIntegradosGlobal > 0 ? (total / totalIntegradosGlobal * 100).toFixed(2) : 0);
            // Actualizar datos del gráfico circular
            graficoCircular.data.datasets[0].data = porcentajes;
            graficoCircular.update();
        };
        // Llamar esta función tras agregar datos o eliminarlos
        document.getElementById('agregarDatos').addEventListener('click', () => {
            actualizarGraficoCircular();
        });

        window.eliminarDato = (index) => {
            datos.splice(index, 1);
            actualizarTabla();
            actualizarGrafico();
            actualizarGraficoCircular();
        };

        // Inicializar el gráfico circular al cargar la página
        inicializarGraficoCircular();

        inicializarGrafico();
    });

    document.getElementById('exportarPDF').addEventListener('click', function() {
        // Capturar el segundo gráfico (graficoDiscapacidades)
        html2canvas(document.getElementById('graficoDiscapacidades'), {
            onrendered: function(canvas2) {
                const imgData2 = canvas2.toDataURL('image/png');

                // Capturar el primer gráfico (graficoAlumnos)
                html2canvas(document.getElementById('graficoAlumnos'), {
                    onrendered: function(canvas1) {
                        const imgData1 = canvas1.toDataURL('image/png');

                        // Crear el documento PDF
                        const {
                            jsPDF
                        } = window.jspdf;
                        const doc = new jsPDF();

                        // Añadir la imagen del gráfico de discapacidades (ubicado en la parte superior)
                        doc.addImage(imgData2, 'PNG', 10, 10, 180, 90); // Ajusta el tamaño y las coordenadas si es necesario

                        // Añadir la imagen del gráfico de alumnos (ubicado debajo del primero)
                        doc.addImage(imgData1, 'PNG', 10, 100, 180, 90); // Ajusta las coordenadas para que no se sobrepongan

                        // Guardar el PDF
                        doc.save('graficos_completos.pdf');
                    }
                });
            }
        });
    });
</script>