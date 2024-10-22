<?php

$sql_informes = "SELECT * FROM usuarios AS usu 
INNER JOIN roles AS rol ON rol.id_rol = usu.rol_id 
INNER JOIN personas AS per ON per.usuario_id = usu.id_usuario 
INNER JOIN docentes AS doc ON doc.persona_id = per.id_persona
INNER JOIN informes AS inf ON inf.docente_id = doc.id_docente
INNER JOIN materias AS mat ON mat.id_materia = inf.materia_id
WHERE inf.estado = '1' ORDER BY per.apellidos ASC";
$query_informes = $pdo->prepare($sql_informes);
$query_informes->execute();
$informes = $query_informes->fetchAll(PDO::FETCH_ASSOC);