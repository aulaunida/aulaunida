<?php

$sql_docentes = "SELECT * FROM usuarios AS usu 
INNER JOIN roles AS rol ON rol.id_rol = usu.rol_id 
INNER JOIN personas AS per ON per.usuario_id = usu.id_usuario 
INNER JOIN docentes AS doc ON doc.persona_id = per.id_persona WHERE doc.estado='1' ORDER BY per.apellidos ASC";
$query_docentes = $pdo->prepare($sql_docentes);
$query_docentes->execute();
$docentes = $query_docentes->fetchAll(PDO::FETCH_ASSOC);