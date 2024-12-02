<?php
$sql_abandonos = "SELECT * FROM abandonos WHERE estado = 1 AND abandono = 1";
$query_abandonos = $pdo->prepare($sql_abandonos);
$query_abandonos->execute();
$abandonos = $query_abandonos->fetchAll(PDO::FETCH_ASSOC);

foreach($abandonos as $abando){
    $abandono = $abando['abandono'];
    $motivo = $abando['motivo'];
    $fyh_creacion = $abando['fyh_creacion'];
    $estado = $abando['estado'];
}