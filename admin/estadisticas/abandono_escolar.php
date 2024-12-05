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
                <h1 style="margin-left: 20px;"><i class="bi bi-bar-chart-line"></i> Abandono escolar</h1>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header no-imprimir">
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
                                                <label for="matriculados">Alumnos matriculados:<b style="color:red">*</b></label>
                                                <input type="number" id="matriculados" class="form-control" placeholder="Cantidad de matriculados" required readonly>
                                            </div>
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
                                    <div class="row">

                                        <!-- Integrados -->
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="abandonos">Abandono escolar:<b style="color:red">*</b></label>
                                                <input type="number" id="abandonos" class="form-control" placeholder="Cantidad de abandonos" required readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <h6>Motivo de abandono:</h6>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="economico">Factores socioeconómicos:<b style="color:red">*</b></label>
                                                <input type="number" id="economico" class="form-control" placeholder="Cantidad de abandonos" required readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="personal">Factores personales:<b style="color:red">*</b></label>
                                                <input type="number" id="personal" class="form-control" placeholder="Cantidad de abandonos" required readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="educativo">Factores educativos:<b style="color:red">*</b></label>
                                                <input type="number" id="educativo" class="form-control" placeholder="Cantidad de abandonos" required readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="familia">Problemas familiares:<b style="color:red">*</b></label>
                                                <input type="number" id="familia" class="form-control" placeholder="Cantidad de abandonos" required readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="infraestructura">Falta de infraestructura:<b style="color:red">*</b></label>
                                                <input type="number" id="infraestructura" class="form-control" placeholder="Cantidad de abandonos" required readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="otros">Otros factores:<b style="color:red">*</b></label>
                                                <input type="number" id="otros" class="form-control" placeholder="Cantidad de abandonos" required readonly>
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
                                            <th>Turno</th>
                                            <th>Grado</th>
                                            <th>Total alumnos</th>
                                            <th>Abandono de alumnos</th>
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
                            <canvas id="graficoAbandono" style="max-width: 600px; max-height: 400px;"></canvas>
                        </div>
                        <div class="card-body centrar-grafico">
                            <canvas id="graficoAlumnos" style="max-width: 600px; max-height: 400px;"></canvas>
                        </div>

                        <hr>

                        <div class="card-body no-imprimir">
                            <div class="form-group text-center">
                                <button type="button" class="btn btn-info" onclick="imprimirPagina()">Exportar Reporte</button>

                            </div>
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
</div>

<!-- Incluye Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
        const abandonosInput = document.getElementById('abandonos');
        const economicoInput = document.getElementById('economico');
        const personalInput = document.getElementById('personal');
        const educativoInput = document.getElementById('educativo');
        const familiaInput = document.getElementById('familia');
        const infraestructuraInput = document.getElementById('infraestructura');
        const otrosInput = document.getElementById('otros');

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
                            text: 'Distribución de abandono por grado'
                        }
                    },
                    scales: {
                        x: {
                            stacked: true,
                            barThickness: 0.5, // Define un grosor específico para las barras
                            title: {
                                display: true,
                                text: 'Grado'
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

        // Obtener abandonos
        const obtenerAbandonos = () => {
            const grado = gradoSelect.value;
            if (grado) {
                const url = `<?= APP_URL; ?>/app/controllers/estadisticas/obtener_abandonos.php?grado=${grado}`;
                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        abandonosInput.value = data.total || 0;
                    })
                    .catch(error => {
                        console.error("Error al obtener abandonos:", error);
                        abandonosInput.value = 0;
                    });
            } else {
                abandonosInput.value = "";
            }
        };

        // Obtener economico
        const obtenerEconomico = () => {
            const grado = gradoSelect.value;
            if (grado) {
                const url = `<?= APP_URL; ?>/app/controllers/estadisticas/obtener_economico.php?grado=${grado}`;
                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        economicoInput.value = data.total || 0;
                    })
                    .catch(error => {
                        console.error("Error al obtener economico:", error);
                        economicoInput.value = 0;
                    });
            } else {
                economicoInput.value = "";
            }
        };

        // Obtener personal
        const obtenerPersonal = () => {
            const grado = gradoSelect.value;
            if (grado) {
                const url = `<?= APP_URL; ?>/app/controllers/estadisticas/obtener_personal.php?grado=${grado}`;
                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        personalInput.value = data.total || 0;
                    })
                    .catch(error => {
                        console.error("Error al obtener sordera:", error);
                        personalInput.value = 0;
                    });
            } else {
                personalInput.value = "";
            }
        };

        // Obtener educativo
        const obtenerEducativo = () => {
            const grado = gradoSelect.value;
            if (grado) {
                const url = `<?= APP_URL; ?>/app/controllers/estadisticas/obtener_educativo.php?grado=${grado}`;
                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        educativoInput.value = data.total || 0;
                    })
                    .catch(error => {
                        console.error("Error al obtener educativo:", error);
                        educativoInput.value = 0;
                    });
            } else {
                educativoInput.value = "";
            }
        };


        // Obtener familia
        const obtenerFamilia = () => {
            const grado = gradoSelect.value;
            if (grado) {
                const url = `<?= APP_URL; ?>/app/controllers/estadisticas/obtener_familia.php?grado=${grado}`;
                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        familiaInput.value = data.total || 0;
                    })
                    .catch(error => {
                        console.error("Error al obtener familia:", error);
                        familiaInput.value = 0;
                    });
            } else {
                familiaInput.value = "";
            }
        };

        // Obtener infraestructura
        const obtenerInfraestructura = () => {
            const grado = gradoSelect.value;
            if (grado) {
                const url = `<?= APP_URL; ?>/app/controllers/estadisticas/obtener_infraestructura.php?grado=${grado}`;
                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        infraestructuraInput.value = data.total || 0;
                    })
                    .catch(error => {
                        console.error("Error al obtener infraestructura:", error);
                        infraestructuraInput.value = 0;
                    });
            } else {
                infraestructuraInput.value = "";
            }
        };

        // Obtener otros
        const obtenerOtros = () => {
            const grado = gradoSelect.value;
            if (grado) {
                const url = `<?= APP_URL; ?>/app/controllers/estadisticas/obtener_otros.php?grado=${grado}`;
                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        otrosInput.value = data.total || 0;
                    })
                    .catch(error => {
                        console.error("Error al obtener otros:", error);
                        otrosInput.value = 0;
                    });
            } else {
                otrosInput.value = "";
            }
        };


        // Escuchar cambios en el select de grado
        gradoSelect.addEventListener('change', function() {
            const gradoValue = gradoSelect.value; // Usado para fetch
            const gradoText = gradoSelect.options[gradoSelect.selectedIndex].text; // Usado para mostrar


            obtenerMatriculados();
            obtenerAbandonos();
            obtenerEconomico();
            obtenerPersonal();
            obtenerEducativo();
            obtenerFamilia();
            obtenerInfraestructura();
            obtenerOtros();
        });

        document.getElementById('agregarDatos').addEventListener('click', function() {
            const grado = gradoSelect.value;
            const gradoValue = gradoSelect.value;
            const gradoText = gradoSelect.options[gradoSelect.selectedIndex].text;
            const turno = document.getElementById('turno').value;
            const cicloSelect = document.getElementById('ciclo'); // Selecciona el elemento ciclo
            const ciclo = cicloSelect.value; // ID del ciclo
            const cicloText = cicloSelect.options[cicloSelect.selectedIndex].text; // Texto del ciclo
            const matriculados = parseInt(matriculadosInput.value);
            const abandonos = parseInt(abandonosInput.value);
            const economico = parseInt(economicoInput.value);
            const personal = parseInt(personalInput.value);
            const educativo = parseInt(educativoInput.value);
            const familia = parseInt(familiaInput.value);
            const infraestructura = parseInt(infraestructuraInput.value);
            const otros = parseInt(otrosInput.value);

            if (!grado || !turno || !ciclo || isNaN(matriculados) || isNaN(abandonos) || isNaN(economico) ||
                isNaN(personal) || isNaN(educativo) || isNaN(familia) || isNaN(infraestructura) || isNaN(otros)) {
                alert('Por favor, completa todos los campos correctamente.');
                return;
            }

            const totalIntegrados = economico + personal + educativo + familia + infraestructura + otros;
            if (totalIntegrados > matriculados) {
                alert('La suma de los alumnos integrados no puede superar el total de alumnos.');
                return;
            }

            datos.push({
                ciclo: gradoText,
                turno,
                grado: gradoText, // Mostrar texto en la tabla
                matriculados,
                abandonos,
                economico,
                personal,
                educativo,
                familia,
                infraestructura,
                otros
            });

            actualizarTabla();
            actualizarGrafico();
            document.getElementById('formDatosAlumnos').reset();
        });

        const actualizarTabla = () => {
            tabla.innerHTML = '';
            datos.forEach((dato, index) => {
                const totalIntegrados = dato.economico + dato.personal + dato.educativo + dato.familia + dato.infraestructura + dato.otros;
                tabla.innerHTML += `
                <tr>
                    <td>${dato.ciclo}</td>
                    <td>${dato.turno}</td>
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
            "#FFB6C1", // Rosa pastel
            "#ADD8E6", // Azul pastel
            "#FFDAB9", // Durazno pastel
            "#DDA0DD", // Púrpura pastel
            "#98FB98", // Verde pastel
            "#FFFACD", // Amarillo pastel
            "#FFE4E1" // Rosa claro pastel
        ];

        const actualizarGrafico = () => {
            const grados = [...new Set(datos.map(dato => dato.grado))];
            const categorias = ['Economico', 'Personal', 'Educativo', 'Familia', 'Infraestructura', 'Otros factores'];

            const data = {
                'Economico': Array(grados.length).fill(0),
                'Personal': Array(grados.length).fill(0),
                'Educativo': Array(grados.length).fill(0),
                'Familia': Array(grados.length).fill(0),
                'Infraestructura': Array(grados.length).fill(0),
                'Otros factores': Array(grados.length).fill(0),
            };

            datos.forEach(dato => {
                const gradoIndex = grados.indexOf(dato.grado);
                data['Economico'][gradoIndex] += dato.economico;
                data['Personal'][gradoIndex] += dato.personal;
                data['Educativo'][gradoIndex] += dato.educativo;
                data['Familia'][gradoIndex] += dato.familia;
                data['Infraestructura'][gradoIndex] += dato.infraestructura;
                data['Otros factores'][gradoIndex] += dato.otros;
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
                            text: 'Distribución de abandonos por grado'
                        }
                    },
                    scales: {
                        x: {
                            stacked: true,
                            barThickness: 0.5, // Define un grosor específico para las barras
                            title: {
                                display: true,
                                text: 'Grado'
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
            const canvasCircular = document.getElementById('graficoAbandono').getContext('2d');
            graficoCircular = new Chart(canvasCircular, {
                type: 'pie',
                data: {
                    labels: ['Economico', 'Personal', 'Educativo', 'Familia', 'Infraestructura', 'Otros factores'],
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
                            text: 'Porcentaje  acumulado de los motivos'
                        },
                        datalabels: { // Configuración del plugin para etiquetas
                            color: '#fff', // Color del texto
                            font: {
                                size: 18, // Tamaño del texto
                                weight: 'bold'
                            },
                            formatter: (value, context) => {
                                // Mostrar nombre + porcentaje
                                const label = context.chart.data.labels[context.dataIndex];
                                return `${label}: ${value}%`;
                            }
                        }
                    }
                }
            });
        };


        const actualizarGraficoCircular = () => {
            // Calcular totales por categoría
            const totalPorCategoria = {
                'Economico': 0,
                'Personal': 0,
                'Educativo': 0,
                'Familia': 0,
                'Infraestructura': 0,
                'Otros factores': 0
            };

            let totalAbandonosGlobal = 0;

            datos.forEach(dato => {
                totalPorCategoria['Economico'] += dato.economico;
                totalPorCategoria['Personal'] += dato.personal;
                totalPorCategoria['Educativo'] += dato.educativo;
                totalPorCategoria['Familia'] += dato.familia;
                totalPorCategoria['Infraestructura'] += dato.infraestructura;
                totalPorCategoria['Otros factores'] += dato.otros;
                totalAbandonosGlobal += dato.economico + dato.personal + dato.educativo + dato.familia + dato.infraestructura + dato.otros;
            });

            const porcentajes = Object.values(totalPorCategoria).map(total => totalAbandonosGlobal > 0 ? (total / totalAbandonosGlobal * 100).toFixed(2) : 0);

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
</script>