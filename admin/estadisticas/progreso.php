<?php 
include('../../app/config.php');
include('../../admin/layout/parte1.php');
?>
<div class="content-wrapper">
<br>
    <div class="content">
        <div class="container">
            <div class="row">
                <h1 style="margin-left: 20px;"><i class="bi bi-bar-chart-line"></i> Progreso escolar</h1>
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
                            <form id="formDatosInclusion">
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
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="alumno">Alumno:<b style="color:red">*</b></label>
                                            <input type="text" id="alumno" class="form-control" placeholder="Nombre del alumno" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                        <label for="integracion">Integración<b style="color:red">*</b></label>
                                        <select id="integracion" class="form-control" required>
                                            <option value="" disabled selected>Seleccionar</option>
                                            <option value="SI">SI</option>
                                            <option value="NO">NO</option>
                                        </select>
                                        </div>
                                    </div>  
                                </div>
                                <div class="card-body">
    <div class="alert text-center" style="background-color: #fdf7e3; color: #000; font-weight: bold; width: 100%; margin: 0 auto; padding: 5px; border: 1px solid #e0d6b8; border-radius: 5px;">
        <h6 style="margin-bottom: 5px; font-size: 14px;">Escala de Calificaciones</h6>
        <table class="table table-bordered table-sm" style="font-size: 15px; margin-bottom: 0; background-color: #fff;">
            <thead>
                <tr style="background-color: #f3ecd8;">
                    <th style="width: 50%; text-align: center;">Porcentaje</th>
                    <th style="text-align: center;">Calificación</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="text-align: center;">90 - 100</td>
                    <td style="text-align: center;">E (Excelente)</td>
                </tr>
                <tr>
                    <td style="text-align: center;">75 - 89</td>
                    <td style="text-align: center;">MB (Muy Bueno)</td>
                </tr>
                <tr>
                    <td style="text-align: center;">60 - 74</td>
                    <td style="text-align: center;">B (Bueno)</td>
                </tr>
                <tr>
                    <td style="text-align: center;">40 - 59</td>
                    <td style="text-align: center;">S (Satisfactorio)</td>
                </tr>
                <tr>
                    <td style="text-align: center;">0 - 39</td>
                    <td style="text-align: center;">NS (No Satisfactorio)</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>


                                <h6>Materias:</h6>
                                <hr>
                                <div class="row">
                                <?php
                                    $materias = [
                                        'ciencias naturales',
                                        'ciencias sociales',
                                        'ciudadania y participacion',
                                        'educacion artistica',
                                        'educacion fisica',
                                        'educacion tecnologica',
                                        'lengua y literatura',
                                        'matematica',
                                        'lengua extranjera',
                                        'literatura y tic'
                                    ];
                                    foreach ($materias as $materia) {
                                        // Reemplazar caracteres problemáticos
                                        $id = strtolower(str_replace(
                                            [' ', 'á', 'é', 'í', 'ó', 'ú', 'ñ'],
                                            ['_', 'a', 'e', 'i', 'o', 'u', 'n'],
                                            $materia
                                        ));
                                        echo "
                                        <div class='col-md-3'>
                                            <div class='form-group'>
                                                <label for='$id'>" . ucwords(strtolower($materia)) . ":<b style='color:red'>*</b></label>
                                                <input type='number' id='$id' class='form-control' placeholder='Nota (0-100)' required>
                                            </div>
                                        </div>";
                                    }
                                    ?>

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
                                    <th>Ciclo</th>
                                    <th>Alumno</th>
                                    <th>Notas</th>
                                    <th>Promedio</th>
                                    <th>Integración</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody id="datosCargados"></tbody>
                            </table>
                            </div>
                        </div>
                        <div class="card-body">
                          <canvas id="graficoRadar" width="400" height="400"></canvas>
                        </div>
                        
                        <hr>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <a href="<?= APP_URL; ?>/admin/estadisticas/index.php" class="btn btn-danger">Volver</a>
                        </div>
                    </div>
                    <br>
                    </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


<?php 
include('../../admin/layout/parte2.php'); 
?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="script.js"></script>




<script>

document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('graficoRadar').getContext('2d');

    const materias = [
        'ciencias_naturales',
        'ciencias_sociales',
        'ciudadania_y_participacion',
        'educacion_artistica',
        'educacion_fisica',
        'educacion_tecnologica',
        'lengua_y_literatura',
        'matematica',
        'lengua_extranjera',
        'literatura_y_tic'
    ];

    const graficoRadar = new Chart(ctx, {
        type: 'radar',
        data: {
            labels: [
                'ciencias naturales',
                'ciencias sociales',
                'ciudadania y participacion',
                'educacion artistica',
                'educacion fisica',
                'educacion tecnologica',
                'lengua y literatura',
                'matematica',
                'lengua extranjera',
                'literatura y tic'
            ],
            datasets: []
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                r: {
                    beginAtZero: true,
                    max: 100
                }
            }
        }
    });

    function obtenerValores() {
        return materias.map(id => {
            const input = document.getElementById(id);
            return input && input.value ? parseInt(input.value, 10) : 0;
        });
    }

    function limpiarCampos() {
        materias.forEach(id => {
            const input = document.getElementById(id);
            if (input) input.value = '';
        });
        document.getElementById('grado').value = '';
        document.getElementById('ciclo').value = '';
        document.getElementById('alumno').value = '';
        document.getElementById('integracion').value = '';
    }

    function calcularPromedio(notas) {
    const suma = notas.reduce((acc, nota) => acc + nota, 0);
    const promedio = Math.round(suma / notas.length); // Redondear al entero más cercano
    return `% ${promedio}`; // Añadir el signo porcentaje al inicio
}


    function agregarFilaTabla(grado, ciclo, alumno, notas, integracion) {
        const tbody = document.getElementById('datosCargados');
        const tr = document.createElement('tr');

        const promedio = calcularPromedio(notas);

        tr.innerHTML = `
            <td>${grado}</td>
            <td>${ciclo}</td>
            <td>${alumno}</td>
            <td>${notas.join(', ')}</td>
            <td>${promedio}</td>
            <td>${integracion}</td>
            <td>
                <button class="btn btn-danger btn-sm" onclick="this.closest('tr').remove()">Eliminar</button>
            </td>
        `;

        tbody.appendChild(tr);
    }

    document.getElementById('agregarDatos').addEventListener('click', () => {
        const grado = document.getElementById('grado').value;
        const ciclo = document.getElementById('ciclo').value;
        const alumno = document.getElementById('alumno').value;
        const integracion = document.getElementById('integracion').value;

        if (!grado || !ciclo || !alumno || !integracion) {
            alert('Por favor, completa todos los campos requeridos.');
            return;
        }

        const notas = obtenerValores();

        if (notas.some(nota => nota < 0 || nota > 100)) {
            alert('Todas las notas deben estar entre 0 y 100.');
            return;
        }

        graficoRadar.data.datasets.push({
            label: alumno,
            data: notas,
            backgroundColor: `rgba(${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, 0.2)`,
            borderColor: `rgba(${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, 1)`,
            borderWidth: 2
        });

        graficoRadar.update();

        agregarFilaTabla(grado, ciclo, alumno, notas, integracion);

        limpiarCampos();
    });
});

</script>




