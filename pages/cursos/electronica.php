<!DOCTYPE html>
<html lang="es-ES">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../src/assets/css/fonts/fonts.css?v=1.0">
    <title>Electronica</title>
</head>
<body>
    <?php
    session_start();
    if(!isset($_SESSION['idUsuario'])){
        header("Location: ../../pages/login/login.html");
        exit();
    }
    ?>
    UWU
</body>
</html>