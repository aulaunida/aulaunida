<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
        <h5>Title</h5>
        <p>Sidebar content</p>
    </div>
</aside>
<!-- /.control-sidebar -->

<!-- Main Footer -->
<footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
        V. 1.0.
    </div>
    <!-- Default to the left -->
    <strong><a href="#">Aula Unida®</a></strong> Todos los derechos reservados.
</footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->


<!-- Bootstrap 4 -->
<script src="<?=APP_URL;?>/public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Datatables -->
<script src="<?=APP_URL;?>/public/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=APP_URL;?>/public/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?=APP_URL;?>/public/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?=APP_URL;?>/public/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?=APP_URL;?>/public/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?=APP_URL;?>/public/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?=APP_URL;?>/public/plugins/jszip/jszip.min.js"></script>
<script src="<?=APP_URL;?>/public/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?=APP_URL;?>/public/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?=APP_URL;?>/public/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?=APP_URL;?>/public/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?=APP_URL;?>/public/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> <!-- AdminLTE CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/css/adminlte.min.css"><!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- AdminLTE App -->
<script src="<?=APP_URL;?>/public/dist/js/adminlte.min.js"></script>

<link rel="stylesheet" href="https://unpkg.com/frappe-gantt/dist/frappe-gantt.css">
<script src="https://unpkg.com/frappe-gantt/dist/frappe-gantt.min.js"></script>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        var ctx = document.getElementById('myAreaChart').getContext('2d');
        var myAreaChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio','Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                datasets: [{
                    label: 'Inasistencia',
                    data: [1, 12, 3, 14, 5, 16, 7, 18 , 9, 11, 12, 2],
                    backgroundColor: 'rgba(60,141,188,0.2)',
                    borderColor: 'rgba(60,141,188,1)',
                    pointBackgroundColor: 'rgba(60,141,188,1)',
                    pointBorderColor: '#3b8bba',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgba(60,141,188,1)'
                }]
            },
            options: {
                maintainAspectRatio: false,
                responsive: true,
                scales: {
                    x: {
                        grid: {
                            display: false,
                        }
                    },
                    y: {
                        grid: {
                            display: false,
                        }
                    }
                }
            }
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var ctx = document.getElementById('myBarChart').getContext('2d');
        var myBarChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                datasets: [{
                    label: 'Asistencia',
                    data: [28, 20, 25, 18, 30, 22, 27, 26, 24, 29, 23, 25],
                    backgroundColor: 'rgba(40,167,69,0.7)',
                    borderColor: 'rgba(40,167,69,1)',
                    borderWidth: 1
                }]
            },
            options: {
                maintainAspectRatio: false,
                responsive: true,
                scales: {
                    x: {
                        grid: {
                            display: false,
                        }
                    },
                    y: {
                        beginAtZero: true,
                        grid: {
                            display: true,
                        }
                    }
                }
            }
        });
    });
</script>


<script>
    document.addEventListener("DOMContentLoaded", function () {
        var tasks = [
            {
                id: 'Task 1',
                name: 'Preparación',
                start: '2024-08-01',
                end: '2024-08-07',
                progress: 100,
                dependencies: ''
            },
            {
                id: 'Task 2',
                name: 'Desarrollo',
                start: '2024-08-08',
                end: '2024-08-20',
                progress: 75,
                dependencies: 'Task 1'
            },
            {
                id: 'Task 3',
                name: 'Pruebas',
                start: '2024-08-21',
                end: '2024-08-27',
                progress: 50,
                dependencies: 'Task 2'
            },
            {
                id: 'Task 4',
                name: 'Implementación',
                start: '2024-08-28',
                end: '2024-08-31',
                progress: 25,
                dependencies: 'Task 3'
            }
        ];

        var gantt = new Gantt("#ganttChart", tasks, {
            view_mode: 'Day',  // Puedes cambiar a 'Week', 'Month', etc.
            bar_height: 30,
            padding: 18
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var ctx = document.getElementById('myRadarChart').getContext('2d');
        var myRadarChart = new Chart(ctx, {
            type: 'radar',
            data: {
                labels: ['Matemáticas', 'Ciencias Naturales', 'Ciencias Sociales', 'Lengua', 'Arte', 'Educación Física'],
                datasets: [
                    {
                        label: 'Alumno ',
                        data: [85, 90, 75, 80, 70, 95],
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        pointBackgroundColor: 'rgba(255, 99, 132, 1)',
                    },
                    {
                        label: 'Alumno integrado',
                        data: [78, 85, 80, 85, 75, 80],
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        pointBackgroundColor: 'rgba(54, 162, 235, 1)',
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scale: {
                    ticks: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var ctx = document.getElementById('myScatterChart').getContext('2d');
        var myScatterChart = new Chart(ctx, {
            type: 'scatter',
            data: {
                datasets: [{
                    label: 'Horas de estudio vs Calificación',
                    data: [
                        {x: 2, y: 60},
                        {x: 3, y: 70},
                        {x: 4, y: 75},
                        {x: 5, y: 80},
                        {x: 6, y: 85},
                        {x: 7, y: 90},
                        {x: 8, y: 95},
                    ],
                    backgroundColor: 'rgba(75, 192, 192, 1)',
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        type: 'linear',
                        position: 'bottom',
                        title: {
                            display: true,
                            text: 'Horas de Estudio'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Calificación'
                        },
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        Highcharts.chart('myDonutChart', {
            chart: {
                type: 'pie',
                options3d: {
                    enabled: true,
                    alpha: 45
                }
            },
            title: {
                text: 'Alumnos aprobados y desaprobados'
            },
            plotOptions: {
                pie: {
                    innerSize: 100,
                    depth: 45
                }
            },
            series: [{
                name: 'Alumnos',
                data: [
                    ['Aprobados', 75],
                    ['Desaprobados', 25]
                ]
            }]
        });
    });
</script>

</body>
</html>