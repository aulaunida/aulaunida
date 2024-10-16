<?php

$sql_docentes = "SELECT * FROM usuarios AS usu 
INNER JOIN roles AS rol ON rol.id_rol = usu.rol_id 
INNER JOIN personas AS per ON per.usuario_id = usu.id_usuario 
INNER JOIN docentes AS doc ON doc.persona_id = per.id_persona WHERE doc.estado='1' and doc.id_docente = '$id_docente' ORDER BY per.apellidos ASC";
$query_docentes = $pdo->prepare($sql_docentes);
$query_docentes->execute();
$docentes = $query_docentes->fetchAll(PDO::FETCH_ASSOC);

foreach($docentes as $docente){
    $id_docente = $docente['id_docente'];
    $id_usuario = $docente['id_usuario'];
    $id_persona = $docente['id_persona'];
    
    $nombres = $docente['nombres'];
    $apellidos = $docente['apellidos'];
    $nombre_rol = $docente['nombre_rol'];
    $email = $docente['email'];
    $dni = $docente['dni'];
    $fecha_nacimiento = $docente['fecha_nacimiento'];
    $celular = $docente['celular'];
    $profesion = $docente['profesion'];
    $direccion = $docente['direccion'];
    $integrador = $docente['integrador'];
    $tipo_cargo = $docente['tipo_cargo'];
    $fyh_creacion = $docente['fyh_creacion'];
    $estado = $docente['estado'];
}