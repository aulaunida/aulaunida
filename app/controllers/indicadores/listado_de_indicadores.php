<?php

$sql_indicadores = "SELECT * FROM indicadores where estado = '1' ";
$query_indicadores = $pdo->prepare($sql_indicadores);
$query_indicadores->execute();
$indicadores = $query_indicadores->fetchAll(PDO::FETCH_ASSOC);