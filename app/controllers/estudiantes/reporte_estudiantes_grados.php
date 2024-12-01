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


$sql_estudiantes3 = "SELECT * FROM estudiantes AS est
INNER JOIN repitencias AS rep ON est.id_estudiante = rep.estudiante_id
WHERE est.estado='1' AND rep.nota1 = 1 AND est.grado_id = :grado_id";
$query_estudiantes3 = $pdo->prepare($sql_estudiantes3);
$query_estudiantes3->bindParam(':grado_id', $grado_id, PDO::PARAM_INT); // Vincula el parámetro del grado
$query_estudiantes3->execute();
$reporte_estudiantes3 = $query_estudiantes3->fetchAll(PDO::FETCH_ASSOC);