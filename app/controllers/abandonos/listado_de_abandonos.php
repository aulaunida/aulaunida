<?php

$sql_abandonos = "SELECT * FROM abandonos WHERE estado = 1 AND abandono = 1";
$query_abandonos = $pdo->prepare($sql_abandonos);
$query_abandonos->execute();
$abandonos = $query_abandonos->fetchAll(PDO::FETCH_ASSOC);