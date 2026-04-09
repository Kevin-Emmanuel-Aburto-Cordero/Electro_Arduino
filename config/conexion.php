<?php
$servidor ="localhost";
$usuario = "root";
$contraseña = "022#";
$db = "Electro_Arduino";

$conn = new mysqli($servidor, $usuario, $contraseña, $db);

if($conn->connect_error){
    die("Conexión fallida: ". $connect_error);
}
$conn->set_charset("utf8");
?>