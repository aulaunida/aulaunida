<?php

$sql_informes = "SELECT * FROM informes AS inf 
INNER JOIN docentes AS doc ON doc.id_docente = inf.docente_id
INNER JOIN personas AS per ON per.id_persona = doc.persona_id 
INNER JOIN usuarios AS usu ON usu.id_usuario = per.usuario_id  
INNER JOIN materias AS mat ON mat.id_materia = inf.materia_id  
INNER JOIN estudiantes AS est ON est.id_estudiante = inf.estudiante_id  
WHERE inf.estado = '1' ORDER BY per.apellidos ASC";
$query_informes = $pdo->prepare($sql_informes);
$query_informes->execute();
$informes = $query_informes->fetchAll(PDO::FETCH_ASSOC);