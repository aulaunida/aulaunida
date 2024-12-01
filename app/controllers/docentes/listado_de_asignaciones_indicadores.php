<?php

$sql_asignaciones = "SELECT * FROM asignaciones_indicadores AS asi 
INNER JOIN docentes AS doc ON doc.id_docente = asi.docente_id
INNER JOIN personas AS per ON per.id_persona = doc.persona_id
INNER JOIN usuarios AS usu ON usu.id_usuario = per.usuario_id
INNER JOIN niveles AS niv ON niv.id_nivel = asi.nivel_id 
INNER JOIN grados AS gra ON gra.id_grado = asi.grado_id 
INNER JOIN indicadores AS mat ON mat.id_indicador = asi.indicador_id 
WHERE asi.estado='1'";
$query_asignaciones = $pdo->prepare($sql_asignaciones);
$query_asignaciones->execute();
$asignaciones = $query_asignaciones->fetchAll(PDO::FETCH_ASSOC);