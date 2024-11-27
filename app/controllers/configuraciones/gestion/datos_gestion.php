<?php

$sql_gestiones = "SELECT * FROM gestiones WHERE id_gestion = '$id_gestion' ";
$query_gestiones = $pdo->prepare($sql_gestiones);
$query_gestiones->execute();
$gestiones = $query_gestiones->fetchAll(PDO::FETCH_ASSOC);

foreach ($gestiones as $gestione){
    $id_gestion = $gestione['id_gestion'];
    $gestion= $gestione['gestion'];
    $fyh_creacion = $gestione['fyh_creacion'];
    $estado = $gestione['estado'];
}