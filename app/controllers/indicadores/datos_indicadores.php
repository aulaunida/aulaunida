<?php

$sql_indicadores = "SELECT * FROM indicadores where estado = '1' and id_indicador = '$id_indicador'";
$query_indicadores = $pdo->prepare($sql_indicadores);
$query_indicadores->execute();
$indicadores = $query_indicadores->fetchAll(PDO::FETCH_ASSOC);

foreach($indicadores as $indicadore){
    $nombre_indicador = $indicadore['nombre_indicador'];
    $fyh_creacion = $indicadore['fyh_creacion'];
    $estado = $indicadore['estado'];
}