<?php

$sql_asistencias = "SELECT * FROM asistencias WHERE estado = 1";
$query_asistencias = $pdo->prepare($sql_asistencias);
$query_asistencias->execute();
$asistencias = $query_asistencias->fetchAll(PDO::FETCH_ASSOC);