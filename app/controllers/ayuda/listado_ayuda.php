
<?php
// Consulta para obtener todos los archivos
$sql_ayuda = "SELECT * FROM archivos"; // Sin filtro, obtiene todos los archivos
$query_ayuda = $pdo->prepare($sql_ayuda);
$query_ayuda->execute();
$archivos = $query_ayuda->fetchAll(PDO::FETCH_ASSOC);

