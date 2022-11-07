<?php

$host = "localhost";
$bd = "CrunchyUsm"; //nombre de la base de datos
$usuario = "root";
$contrasenia = "";

try {
    $conexion = new PDO("mysql:host=$host;dbname=$bd", $usuario, $contrasenia);
} catch (Exception $ex) {
    echo $ex->getMessage;
}

?>