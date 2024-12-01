<?php
include('../../app/config.php');
include('../../admin/layout/parte1.php');
include('../../app/controllers/estudiantes/reporte_estudiantes_grados.php');
include('../../app/controllers/repitencias/listado_de_repitencias.php');


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
                <h1 style="margin-left: 20px;"><i class="bi bi-bar-chart-line"></i> Repitencia</h1>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Ingresar datos:</h3>
                        </div>
                        <div class="card-body">
                            <form id="formDatosRepetencia">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="ciclo">Ciclo Lectivo:<b style="color:red">*</b></label>
                                            <select name="id_gestion" id="ciclo" class="form-control" required>
                                                <option value="" disabled selected>Seleccionar ciclo lectivo</option>
                                                <?php foreach ($gestiones as $gestione): ?>
                                                    <option value="<?= $gestione['id_gestion']; ?>">
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
                                                    <option value="<?= $nivele['id_nivel']; ?>">
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
                                    <!-- Repetidores -->
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="repetidores">Alumnos que debieron repetir:<b style="color:red">*</b></label>
                                            <input type="number" id="repetidores" class="form-control" placeholder="Cantidad de repitentes" required readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <button type="button" class="btn btn-primary" id="agregarDatos">Agregar</button>
                                </div>
                            </form>
                            <hr>
                            <div id="tablaDatos">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Ciclo lectivo</th>
                                            <th>Turno</th>
                                            <th>Grado y división</th>
                                            <th>Matriculados</th>
                                            <th>Repitentes</th>
                                            <th>% Repitencia</th>
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
                            <canvas id="graficoRepetencia" width="400" height="200"></canvas>
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
        // Variables y elementos del DOM
        const cicloSelect = document.getElementById("ciclo");
        const turnoSelect = document.getElementById("turno");
        const gradoSelect = document.getElementById("grado");
        const matriculadosInput = document.getElementById("matriculados");
        const repetidoresInput = document.getElementById("repetidores"); // Nuevo input para repetidores

        // Función para obtener alumnos matriculados
        const obtenerMatriculados = () => {
            const grado = gradoSelect.value;

            if (grado) {
                // Construye la URL con el parámetro grado
                const url = `<?= APP_URL; ?>/app/controllers/estadisticas/obtener_matriculados.php?grado=${grado}`;
                fetch(url)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error("Error en la solicitud");
                        }
                        return response.json();
                    })
                    .then(data => {
                        // Si todo va bien, actualiza el campo de matriculados
                        console.log("Datos recibidos (matriculados):", data); // Para depuración
                        matriculadosInput.value = data.total || 0; // Si no hay datos, coloca 0
                    })
                    .catch(error => {
                        console.error("Error al obtener los matriculados:", error);
                        matriculadosInput.value = 0; // Valor predeterminado en caso de error
                    });
            } else {
                // Si no hay grado seleccionado, limpia el campo
                matriculadosInput.value = "";
            }
        };

        // Función para obtener repetidores
        const obtenerRepetidores = () => {
            const grado = gradoSelect.value;

            if (grado) {
                // Construye la URL con el parámetro grado
                const url = `<?= APP_URL; ?>/app/controllers/estadisticas/obtener_repetidores.php?grado=${grado}`;
                fetch(url)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error("Error en la solicitud");
                        }
                        return response.json();
                    })
                    .then(data => {
                        // Si todo va bien, actualiza el campo de repetidores
                        console.log("Datos recibidos (repitentes):", data); // Para depuración
                        repetidoresInput.value = data.total || 0; // Si no hay datos, coloca 0
                    })
                    .catch(error => {
                        console.error("Error al obtener los repitentes:", error);
                        repetidoresInput.value = 0; // Valor predeterminado en caso de error
                    });
            } else {
                // Si no hay grado seleccionado, limpia el campo
                repetidoresInput.value = "";
            }
        };

        // Escuchar cambios en el select de grado
        gradoSelect.addEventListener("change", function() {
            obtenerMatriculados(); // Actualiza los matriculados
            obtenerRepetidores(); // Actualiza los repetidores
        });

        // Manejo del gráfico y datos
        let datos = []; // Almacena los datos ingresados
        let grafico; // Variable para el gráfico
        const tabla = document.getElementById("datosCargados");
        const canvas = document.getElementById("graficoRepetencia").getContext("2d");

        // Inicializa el gráfico vacío
        const inicializarGrafico = () => {
            grafico = new Chart(canvas, {
                type: "line",
                data: {
                    labels: [], // Etiquetas iniciales vacías
                    datasets: [], // Sin datasets inicialmente
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: true
                        },
                        title: {
                            display: true,
                            text: "Tasa de Repitencia por Grado"
                        },
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: "Tasa de Repitencia (%)"
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: "Grado"
                            }
                        },
                    },
                },
            });
        };

        document.getElementById("agregarDatos").addEventListener("click", function() {
            const ciclo = cicloSelect.options[cicloSelect.selectedIndex]?.text || "";
            const turno = turnoSelect.options[turnoSelect.selectedIndex]?.text || "";
            const grado = gradoSelect.options[gradoSelect.selectedIndex]?.text || "";
            const matriculados = parseInt(matriculadosInput.value);
            const repetidores = parseInt(repetidoresInput.value);

            if (!ciclo || !turno || !grado || isNaN(matriculados) || isNaN(repetidores)) {
                alert("Por favor, completa todos los campos correctamente.");
                return;
            }

            if (repetidores > matriculados) {
                alert("El número de repetidores no puede ser mayor que los matriculados.");
                return;
            }

            const porcentajeRepetencia = ((repetidores / matriculados) * 100).toFixed(2);
            datos.push({
                ciclo,
                turno,
                grado,
                matriculados,
                repetidores,
                porcentajeRepetencia
            });

            actualizarTabla();
            actualizarGrafico();
            document.getElementById("formDatosRepetencia").reset();
        });

        const actualizarTabla = () => {
            tabla.innerHTML = "";
            datos.forEach((dato, index) => {
                tabla.innerHTML += `
                <tr>
                    <td>${dato.ciclo}</td>
                    <td>${dato.turno}</td>
                    <td>${dato.grado}</td>
                    <td>${dato.matriculados}</td>
                    <td>${dato.repetidores}</td>
                    <td>${dato.porcentajeRepetencia}%</td>
                    <td><button class="btn btn-danger btn-sm" onclick="eliminarDato(${index})">Eliminar</button></td>
                </tr>
            `;
            });
        };

        const actualizarGrafico = () => {
            const grados = [...new Set(datos.map(d => d.grado))];

            const datasets = grados.map(grado => {
                const data = grados.map(g => {
                    const item = datos.find(d => d.grado === g);
                    return item ? parseFloat(item.porcentajeRepetencia) : 0;
                });

                return {
                    label: grado,
                    data: data,
                    borderColor: getRandomColor(),
                    fill: false,
                    tension: 0.1,
                };
            });

            if (grafico) {
                grafico.destroy();
            }

            grafico = new Chart(canvas, {
                type: "line",
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
                            text: "Tasa de Repitencia por Grado"
                        },
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: "Tasa de Repitencia (%)"
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: "Grado"
                            }
                        },
                    },
                },
            });
        };

        const getRandomColor = () => {
            const colores = ["#FF5733", "#33FF57", "#3357FF", "#FF33A1", "#F4FF33"];
            return colores[Math.floor(Math.random() * colores.length)];
        };

        // Eliminar dato
        window.eliminarDato = (index) => {
            datos.splice(index, 1);
            actualizarTabla();
            actualizarGrafico();
        };

        inicializarGrafico();
    });
</script>