<?php

define('SERVIDOR','localhost');
define('USUARIO','root');
define('PASSWORD','');
define('BD','dbaulaunida');

define('APP_NAME','Aula Unida®');
define('APP_URL','http://localhost/aulaunida');
define('KEY_API_MAPS','');

$servidor = "mysql:dbname=".BD.";host=".SERVIDOR;

try{
    $pdo = new PDO($servidor,USUARIO,PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8"));
    //echo "conexión existosa a la base de datos";
}catch (PDOException $e){
    print_r($e);
    echo "error no se pudo conectar a la base de datos";
}

date_default_timezone_set("America/Argentina/Cordoba");
$fechaHora = date('Y-m-d');

$fecha_actual = date('Y-m-d');
$dia_actual = date('d');
$mes_actual = date('m');
$ano_actual = date('Y');

$estado_de_registro = '1';



