<?php
// Incluye la configuración de la base de datos
include('../../config.php');

// Verifica si se ha recibido el parámetro 'grado'
if (isset($_GET['grado'])) {
    $grado = $_GET['grado'];

    try {
        // Prepara la consulta para contar los estudiantes integrados en el grado seleccionado
        $query = "SELECT COUNT(*) AS total FROM estudiantes as est INNER JOIN participaciones AS par ON est.id_estudiante = par.estudiante_id INNER JOIN grados AS gra ON gra.id_grado = est.grado_id WHERE grado_id = :grado AND par.nota2 = 1";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':grado', $grado, PDO::PARAM_INT);
        $stmt->execute();

        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        // Devuelve el resultado como JSON
        echo json_encode([
            'success' => true,
            'total' => $resultado['total']
        ]);
    } catch (PDOException $e) {
        // En caso de error, devuelve un mensaje de error
        echo json_encode([
            'success' => false,
            'message' => 'Error al consultar la base de datos: ' . $e->getMessage()
        ]);
    }
} else {
    // Devuelve un error si no se envía el parámetro requerido
    echo json_encode([
        'success' => false,
        'message' => 'El parámetro "grado" es obligatorio.'
    ]);
}
