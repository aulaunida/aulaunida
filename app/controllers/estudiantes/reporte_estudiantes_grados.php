<?php

$sql_estudiantes = "SELECT * FROM estudiantes AS est
WHERE est.estado='1'";
$query_estudiantes = $pdo->prepare($sql_estudiantes);
$query_estudiantes->execute();
$reporte_estudiantes = $query_estudiantes->fetchAll(PDO::FETCH_ASSOC);

$sql_estudiantes2 = "SELECT * FROM estudiantes AS est
WHERE est.estado='1' and est.integracion='SI'";
$query_estudiantes2 = $pdo->prepare($sql_estudiantes2);
$query_estudiantes2->execute();
$reporte_estudiantes2 = $query_estudiantes2->fetchAll(PDO::FETCH_ASSOC);
