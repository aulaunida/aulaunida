<?php

$sql_participaciones = "SELECT * FROM participaciones WHERE estado = 1";
$query_participaciones = $pdo->prepare($sql_participaciones);
$query_participaciones->execute();
$participaciones = $query_participaciones->fetchAll(PDO::FETCH_ASSOC);