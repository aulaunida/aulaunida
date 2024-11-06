<?php
// $sql_usuarios = "SELECT * FROM usuarios as usu INNER JOIN roles as rol 
//                   ON rol.id_rol = usu.rol_id  where usu.estado = '1' and usu.id_usuario = '$id_usuario' ";


$sql_usuarios = "SELECT * FROM usuarios AS usu 
INNER JOIN roles AS rol ON rol.id_rol = usu.rol_id 
INNER JOIN personas AS per ON per.usuario_id = usu.id_usuario WHERE per.estado='1' and usu.id_usuario = '$id_usuario'";

$query_usuarios = $pdo->prepare($sql_usuarios);
$query_usuarios->execute();
$usuarios = $query_usuarios->fetchAll(PDO::FETCH_ASSOC);

foreach ($usuarios as $usuario){
    // $nombres = $usuario['nombres'];
    // $apellidos = $usuario['apellidos'];
    $nombre_rol = $usuario['nombre_rol'];
    $email = $usuario['email'];
    $password = $usuario['password'];
    $fyh_creacion = $usuario['fyh_creacion'];
    $estado = $usuario['estado'];
}