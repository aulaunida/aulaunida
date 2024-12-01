<?php

$sql_repitencias = "SELECT * FROM repitencias WHERE estado = 1 AND nota1 = 1";
$query_repitencias = $pdo->prepare($sql_repitencias);
$query_repitencias->execute();
$repitencias = $query_repitencias->fetchAll(PDO::FETCH_ASSOC);