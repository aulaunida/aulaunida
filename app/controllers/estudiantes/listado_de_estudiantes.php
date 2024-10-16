<?php

$sql_estudiantes = "SELECT * FROM usuarios AS usu 
INNER JOIN roles AS rol ON rol.id_rol = usu.rol_id 
INNER JOIN personas AS per ON per.usuario_id = usu.id_usuario 
INNER JOIN estudiantes AS est ON est.persona_id = per.id_persona 
INNER JOIN niveles AS niv ON niv.id_nivel = est.nivel_id 
INNER JOIN grados AS gra ON gra.id_grado = est.grado_id 
INNER JOIN ppffs AS ppf ON ppf.estudiante_id = est.id_estudiante
WHERE est.estado='1' ORDER BY per.apellidos ASC";
$query_estudiantes = $pdo->prepare($sql_estudiantes);
$query_estudiantes->execute();
$estudiantes = $query_estudiantes->fetchAll(PDO::FETCH_ASSOC);