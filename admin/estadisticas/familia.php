<?php 
include('../../app/config.php');
include('../../admin/layout/parte1.php');
?>
<div class="content-wrapper">
    <br>
    <div class="content">
        <div class="container">
            <div class="row">
                <h1 style="margin-left: 20px;"><i class="bi bi-bar-chart-line"></i> Participación de las Familias</h1>
            </div>
            <link rel="stylesheet" href="ruta/del/archivo/bootstrap.css">
            <style>
                #contenedorGraficos {
                    display: flex;
                    flex-direction: column;
                    gap: 40px; /* Espaciado entre los contenedores de gráficos */
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
                                    <div class="col-md-4">
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
                                    <div class="col-md-4">
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
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="turno">Turno:<b style="color:red">*</b></label>
                                            <select id="turno" class="form-control" required>
                                                <option value="" disabled selected>Seleccionar turno</option>
                                                <option value="Mañana">Mañana</option>
                                                <option value="Tarde">Tarde</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="actos_asistieron">Actos: Asistieron<b style="color:red">*</b></label>
                                        <input type="number" id="actos_asistieron" class="form-control" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="actos_noasistieron">Actos: No Asistieron<b style="color:red">*</b></label>
                                        <input type="number" id="actos_noasistieron" class="form-control" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="reuniones_asistieron">Reuniones: Asistieron<b style="color:red">*</b></label>
                                        <input type="number" id="reuniones_asistieron" class="form-control" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="reuniones_noasistieron">Reuniones: No Asistieron<b style="color:red">*</b></label>
                                        <input type="number" id="reuniones_noasistieron" class="form-control" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="extras_asistieron">Actividades Extras: Asistieron<b style="color:red">*</b></label>
                                        <input type="number" id="extras_asistieron" class="form-control" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="extras_noasistieron">Actividades Extras: No Asistieron<b style="color:red">*</b></label>
                                        <input type="number" id="extras_noasistieron" class="form-control" required>
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
<?php include('../../admin/layout/parte2.php'); ?>



<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const contenedorGraficos = document.getElementById('contenedorGraficos');

    function limpiarCampos() {
        document.getElementById('grado').value = '';
        document.getElementById('ciclo').value = '';
        document.getElementById('turno').value = '';
        document.getElementById('actos_asistieron').value = '';
        document.getElementById('actos_noasistieron').value = '';
        document.getElementById('reuniones_asistieron').value = '';
        document.getElementById('reuniones_noasistieron').value = '';
        document.getElementById('extras_asistieron').value = '';
        document.getElementById('extras_noasistieron').value = '';
    }

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
                <th style="border: 1px solid #ccc; padding: 4px; text-align: left;">Actividad</th>
                <th style="border: 1px solid #ccc; padding: 4px; text-align: left;">Asistieron</th>
                <th style="border: 1px solid #ccc; padding: 4px; text-align: left;">No asistieron</th>
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








