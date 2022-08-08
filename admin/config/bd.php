<?php
$host="localhost";
$bd="sitio-mucho";
$usuario="root";
$password="";

try {
    $conexion = new PDO("mysql:host=$host;dbname=$bd", $usuario, $password);
} catch ( Exception $ex) {
    echo $ex->getMessage();
}
?>