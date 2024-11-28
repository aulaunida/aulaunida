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
                            <form id="formDatosAlumnos">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="grado">Grado y división:<b style="color:red">*</b></label>
                                            <select id="grado" class="form-control" required>
                                                <option value="" disabled selected>Seleccionar grado</option>
                                                <?php
                                                $secciones = ['A', 'B', 'C', 'D'];
                                                $grados = ['Primero', 'Segundo', 'Tercero', 'Cuarto', 'Quinto', 'Sexto'];
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
                                            <label for="turno">Turno:<b style="color:red">*</b></label>
                                            <select id="turno" class="form-control" required>
                                                <option value="" disabled selected>Seleccionar turno</option>
                                                <option value="Mañana">Mañana</option>
                                                <option value="Tarde">Tarde</option>
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
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="matriculados">Total alumnos:<b style="color:red">*</b></label>
                                            <input type="number" id="matriculados" class="form-control" placeholder="Cantidad de alumnos" required>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <h6>Motivo de integración:</h6>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="intelectual">Discapacidad intelectual:<b style="color:red">*</b></label>
                                            <input type="number" id="intelectual" class="form-control" placeholder="Cantidad" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="sordera">Sordera o Hipoacusia:<b style="color:red">*</b></label>
                                            <input type="number" id="sordera" class="form-control" placeholder="Cantidad" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="ceguera">Ceguera o Disminución visual:<b style="color:red">*</b></label>
                                            <input type="number" id="ceguera" class="form-control" placeholder="Cantidad" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="motora">Motora o Neuromotora:<b style="color:red">*</b></label>
                                            <input type="number" id="motora" class="form-control" placeholder="Cantidad" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="tgd">TGD o TEA:<b style="color:red">*</b></label>
                                            <input type="number" id="tgd" class="form-control" placeholder="Cantidad" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="multiples">Más de una discapacidad:<b style="color:red">*</b></label>
                                            <input type="number" id="multiples" class="form-control" placeholder="Cantidad" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="otras">Otro motivo:<b style="color:red">*</b></label>
                                            <input type="number" id="otras" class="form-control" placeholder="Cantidad" required>
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
                                            <th>Grado</th>
                                            <th>Turno</th>
                                            <th>Ciclo</th>
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
                        <div class="card-body">
                            <canvas id="graficoAlumnos" width="400" height="200"></canvas>
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
<script>
document.addEventListener("DOMContentLoaded", function () {
    let datos = [];
    let grafico;
    const tabla = document.getElementById('datosCargados');
    const canvas = document.getElementById('graficoAlumnos').getContext('2d');

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
                    legend: { display: true },
                    title: { display: true, text: 'Distribución de Alumnos Integrados' }
                },
                scales: {
                    x: {
                        stacked: true,
                        title: { display: true, text: 'Grado' }
                    },
                    y: {
                        stacked: true,
                        beginAtZero: true,
                        title: { display: true, text: 'Cantidad de Alumnos' }
                    }
                }
            }
        });
    };

    document.getElementById('agregarDatos').addEventListener('click', function () {
        const grado = document.getElementById('grado').value;
        const turno = document.getElementById('turno').value;
        const ciclo = document.getElementById('ciclo').value;
        const matriculados = parseInt(document.getElementById('matriculados').value);
        const intelectual = parseInt(document.getElementById('intelectual').value);
        const sordera = parseInt(document.getElementById('sordera').value);
        const ceguera = parseInt(document.getElementById('ceguera').value);
        const motora = parseInt(document.getElementById('motora').value);
        const tgd = parseInt(document.getElementById('tgd').value);
        const multiples = parseInt(document.getElementById('multiples').value);
        const otras = parseInt(document.getElementById('otras').value);

        if (!grado || !turno || !ciclo || isNaN(matriculados) || isNaN(intelectual) || isNaN(sordera) || isNaN(ceguera) ||
            isNaN(motora) || isNaN(tgd) || isNaN(multiples) || isNaN(otras)) {
            alert('Por favor, debes completar todos los campos.');
            return;
        }

        const totalIntegrados = intelectual + sordera + ceguera + motora + tgd + multiples + otras;
        if (totalIntegrados > matriculados) {
            alert('La suma de los alumnos integrados no puede superar el total de alumnos.');
            return;
        }

        datos.push({ grado, turno, ciclo, matriculados, intelectual, sordera, ceguera, motora, tgd, multiples, otras });

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
                    <td>${dato.grado}</td>
                    <td>${dato.turno}</td>
                    <td>${dato.ciclo}</td>
                    <td>${dato.matriculados}</td>
                    <td>${totalIntegrados}</td>
                    <td><button class="btn btn-danger btn-sm" onclick="eliminarDato(${index})">Eliminar</button></td>
                </tr>
            `;
        });
    };

    const actualizarGrafico = () => {
        const grados = [...new Set(datos.map(dato => dato.grado))];
        const categorias = ['Intelectual', 'Sordera', 'Ceguera', 'Motora', 'TGD', 'Más de una', 'Otras', 'Sin Plan Integrado'];

        const data = {
            'Intelectual': Array(grados.length).fill(0),
            'Sordera': Array(grados.length).fill(0),
            'Ceguera': Array(grados.length).fill(0),
            'Motora': Array(grados.length).fill(0),
            'TGD': Array(grados.length).fill(0),
            'Más de una': Array(grados.length).fill(0),
            'Otras': Array(grados.length).fill(0),
            'Sin Plan Integrado': Array(grados.length).fill(0),
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

            const totalIntegrados = dato.intelectual + dato.sordera + dato.ceguera + dato.motora + dato.tgd + dato.multiples + dato.otras;
            data['Sin Plan Integrado'][gradoIndex] += dato.matriculados - totalIntegrados;
        });

        if (grafico) grafico.destroy();

        grafico = new Chart(canvas, {
            type: 'bar',
            data: {
                labels: grados,
                datasets: categorias.map(categoria => ({
                    label: categoria,
                    data: data[categoria],
                    backgroundColor: getBackgroundColor(categoria)
                }))
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: true },
                    title: { display: true, text: 'Distribución de Alumnos Integrados' }
                },
                scales: {
                    x: { stacked: true },
                    y: { stacked: true, beginAtZero: true }
                }
            }
        });
    };

    const getBackgroundColor = (categoria) => {
        const colores = {
            'Intelectual': 'rgba(75, 192, 192, 0.6)',
            'Sordera': 'rgba(153, 102, 255, 0.6)',
            'Ceguera': 'rgba(255, 159, 64, 0.6)',
            'Motora': 'rgba(255, 99, 132, 0.6)',
            'TGD': 'rgba(54, 162, 235, 0.6)',
            'Más de una': 'rgba(201, 203, 207, 0.6)',
            'Otras': 'rgba(255, 205, 86, 0.6)',
            'Sin Plan Integrado': 'rgba(0, 128, 0, 0.6)'
        };
        return colores[categoria] || 'rgba(0, 0, 0, 0.6)';
    };

    window.eliminarDato = (index) => {
        datos.splice(index, 1);
        actualizarTabla();
        actualizarGrafico();
    };

    // Llama a la función para inicializar el gráfico vacío
    inicializarGrafico();
});
</script>
