<?php
/**
 * Created by PhpStorm.
 * User: HILARIWEB
 * Date: 4/1/2024
 * Time: 20:31
 */
// $sql_usuarios = "SELECT * FROM usuarios as usu 
// INNER JOIN roles as rol ON rol.id_rol = usu.rol_id  where usu.estado = '1' ";

$sql_usuarios = "SELECT * FROM usuarios AS usu 
INNER JOIN roles AS rol ON rol.id_rol = usu.rol_id 
INNER JOIN personas AS per ON per.usuario_id = usu.id_usuario WHERE usu.estado='1' AND rol.nombre_rol !='ESTUDIANTE'";

$query_usuarios = $pdo->prepare($sql_usuarios);
$query_usuarios->execute();
$usuarios = $query_usuarios->fetchAll(PDO::FETCH_ASSOC);

