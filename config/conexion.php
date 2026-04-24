<?php
// Reportar todos los errores para saber qué falla
/*ini_set('display_errors', 1);
error_reporting(E_ALL);*/

$host = "localhost";
$user = "kevin";
$pass = "killzonE117*";
$db   = "Electro_Arduino";

// Intentar conectar
$conn = new mysqli($host, $user, $pass, $db);

// Si hay error, mostrarlo y detenerse
if ($conn->connect_error) {
    die("Fallo de conexión: " . $conn->connect_error);
}

echo "¡Conexión establecida correctamente!";
?>
