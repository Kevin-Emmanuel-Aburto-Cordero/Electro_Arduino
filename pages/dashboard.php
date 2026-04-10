<!DOCTYPE html>
<html lang="es-ES">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/assets/css/fonts/fonts.css?v=2.0">
    <title>Document</title>
</head>
<body>
    <?php
    session_start();
    if(!isset($_SESSION['idUsuario'])){
        header("Location: ../index.html");
        exit();
    }
    echo "Bienvenido, " . $_SESSION['usuario'] . "!<br>";
    ?>
    <br>
    <a href="../auth/logout.php">Cerrar Sesion</a>
</body>
</html>