<?php
include('../../app/config.php');
include('../../admin/layout/parte1.php');
?>
<!-- Content Wrapper -->
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
                                            <label for="grado">Grado y división:<b style="color:red">*</b></label>
                                            <select id="grado" class="form-control" required>
                                                <option value="" disabled selected>Seleccionar grado</option>
                                                <?php
                                                $grados = ['Primero', 'Segundo', 'Tercero', 'Cuarto', 'Quinto', 'Sexto'];
                                                $secciones = ['A', 'B', 'C', 'D'];
                                                foreach ($grados as $grado) {
                                                    foreach ($secciones as $seccion) {
                                                        echo "<option value='{$grado} {$seccion}'>{$grado} {$seccion}</option>";
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="ciclo">Ciclo Lectivo:<b style="color:red">*</b></label>
                                            <select id="ciclo" class="form-control" required>
                                                <option value="" disabled selected>Seleccionar ciclo lectivo</option>
                                                <option value="2024">2024</option>
                                                <option value="2023">2023</option>
                                                <option value="2022">2022</option>
                                                <option value="2021">2021</option>
                                                <option value="2020">2020</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="matriculados">Alumnos matriculados:<b style="color:red">*</b></label>
                                            <input type="number" id="matriculados" class="form-control" placeholder="Cantidad de alumnos" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="repetidores">Alumnos que debieron repetir:<b style="color:red">*</b></label>
                                            <input type="number" id="repetidores" class="form-control" placeholder="Cantidad de repetidores" required>
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
                                            <th>Grado</th>
                                            <th>Ciclo</th>
                                            <th>Matriculados</th>
                                            <th>Repetidores</th>
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
                            <a href="<?=APP_URL;?>/admin/estadisticas/index.php" class="btn btn-danger">Volver</a>
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

<script>document.addEventListener("DOMContentLoaded", function () {
    let datos = []; // Array para almacenar los datos ingresados
    let grafico; // Variable para el gráfico
    const tabla = document.getElementById('datosCargados');
    const canvas = document.getElementById('graficoRepetencia').getContext('2d');

    // Inicializa el gráfico vacío
    const inicializarGrafico = () => {
        grafico = new Chart(canvas, {
            type: 'line',
            data: {
                labels: [], // Etiquetas vacías (ciclos)
                datasets: [], // Sin datasets
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: true },
                    title: { display: true, text: 'Tasa de Repetencia por Ciclo Lectivo' },
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: { display: true, text: 'Tasa de Repetencia (%)' },
                    },
                    x: {
                        title: { display: true, text: 'Ciclo Lectivo' },
                    },
                },
            },
        });
    };

    document.getElementById('agregarDatos').addEventListener('click', function () {
        const grado = document.getElementById('grado').value;
        const ciclo = document.getElementById('ciclo').value;
        const matriculados = parseInt(document.getElementById('matriculados').value);
        const repetidores = parseInt(document.getElementById('repetidores').value);

        if (!grado || !ciclo || isNaN(matriculados) || isNaN(repetidores)) {
            alert('Por favor, completa todos los campos correctamente.');
            return;
        }

        if (repetidores > matriculados) {
            alert('El número de repetidores no puede ser mayor que los matriculados.');
            return;
        }

        const porcentajeRepetencia = ((repetidores / matriculados) * 100).toFixed(2);
        datos.push({ grado, ciclo, matriculados, repetidores, porcentajeRepetencia });

        actualizarTabla();
        actualizarGrafico();
        document.getElementById('formDatosRepetencia').reset();
    });

    const actualizarTabla = () => {
        tabla.innerHTML = '';
        datos.forEach((dato, index) => {
            tabla.innerHTML += `
                <tr>
                    <td>${dato.grado}</td>
                    <td>${dato.ciclo}</td>
                    <td>${dato.matriculados}</td>
                    <td>${dato.repetidores}</td>
                    <td>${dato.porcentajeRepetencia}%</td>
                    <td><button class="btn btn-danger btn-sm" onclick="eliminarDato(${index})">Eliminar</button></td>
                </tr>
            `;
        });
    };

    const actualizarGrafico = () => {
        const ciclos = [...new Set(datos.map(d => d.ciclo))].sort();
        const grados = [...new Set(datos.map(d => d.grado))];

        const datasets = grados.map(grado => {
            const data = ciclos.map(ciclo => {
                const item = datos.find(d => d.grado === grado && d.ciclo === ciclo);
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
            type: 'line',
            data: {
                labels: ciclos,
                datasets: datasets,
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: true },
                    title: { display: true, text: 'Tasa de Repetencia por Ciclo Lectivo' },
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: { display: true, text: 'Tasa de Repetencia (%)' },
                    },
                    x: {
                        title: { display: true, text: 'Ciclo Lectivo' },
                    },
                },
            },
        });
    };

    const getRandomColor = () => {
        const colores = ['#FF5733', '#33FF57', '#3357FF', '#FF33A8', '#33FFF5', '#F5FF33'];
        return colores[Math.floor(Math.random() * colores.length)];
    };

    // Llamar a la función para inicializar el gráfico vacío
    inicializarGrafico();
});

</script>
