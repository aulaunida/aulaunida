
<?php
include('../../app/config.php');

// Obtener categoría de la URL
$categoria = $_GET['categoria'] ?? '';

// Mapa de categorías con sus nombres extendidos
$categorias = [
    'manual' => 'Manual de usuario',
    'documentacion' => 'Documentación',
    'aula_unida' => 'Aula unida',
];

// Verificamos si la categoría existe en el mapa
$tituloCategoria = isset($categorias[$categoria]) ? $categorias[$categoria] : $categoria; // Si no existe, mostramos la categoría original

// Ahora buscamos con el nombre extendido de la categoría
$stmt = $pdo->prepare("SELECT * FROM archivos WHERE categoria = ?");
$stmt->execute([$tituloCategoria]); // Usamos el título extendido de la categoría
$archivos = $stmt->fetchAll();

// Incluir el encabezado
include('../../admin/layout/parte1.php');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <br>
    <div class="content">
        <div class="container">
            <div class="row">
                <h2 style="margin-left: 20px;"><i class="bi bi-folder"></i> Archivos: <b><?= htmlspecialchars($tituloCategoria); ?></b></h2>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-info">
                        <div class="card-header">
                            <h3 class="card-title">Archivos disponibles:</h3>
                        </div>
                        <div class="card-body">
                            <?php
                            if (count($archivos) > 0) {
                                foreach ($archivos as $archivo) {
                                    echo "<div class='form-group'>
                                                <b><a href='{$archivo['ruta_archivo']}' target='_blank'>{$archivo['nombre_archivo']}</a></b>
                                              <div class='btn-group'>
                                                <a href='delete.php?id={$archivo['id']}' class='btn btn-danger btn-sm'><i class='bi bi-trash'></i></a>
                                              </div>
                                          </div>";
                                }
                            } else {
                                echo "<p>No se han encontrado archivos en esta categoría.</p>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <a href="<?= APP_URL; ?>/admin/ayuda" class="btn btn-danger">Volver</a>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div><!-- /.content -->
</div><!-- /.content-wrapper -->

<?php
// Incluir el pie de página y los mensajes
include('../../admin/layout/parte2.php');
include('../../layout/mensajes.php');
?>
