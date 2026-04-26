<!DOCTYPE html>
<html lang="es-ES">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../src/assets/css/arduino_curso.css?v=5.0">
    <link rel="stylesheet" href="../../src/assets/css/fonts/fonts.css?v=1.0">
    <title>Arduino - Módulos</title>
</head>
<body>
    <div class="layout-container">
        <header class="mi-header">
            <h3>Electro <br>
                Arduino</h3>
                <div class="contenedor3">
                    <a href="">
                        <button type="submit">Arduino Software</button>
                    </a>
                    <a href="">
                        <button type="submit">Thinker Card</button>
                    </a>
                    <a href="">
                        <button type="submit">Wokwi</button>
                    </a>
                    <a href="../../auth/logout.php">
                        <button type="submit">Cerrar Sesion</button>
                    </a>
                </div>
        </header>
        <main class="mi-contenido">
            <div class="contenedor0">
                <div class="subcontenedor0">
                    <?php
                    session_start();
                    if(!isset($_SESSION['idUsuario'])){
                        header("Location: ../../pages/login/login.html");
                        exit();
                    }
                    ?>
                </div>
            </div>
            <div class="contenedor1">
                <h2>Curso de Programacion <br>
                    En Arduino</h2>
            </div>
            <div class="contenedor2">
                <a href="arduino/estructura/estructura.php">
                    <button type="submit">
                        <img class="bangbus" src="../../src/img/bangbus_zzz/Safety_Portrait.webp" alt="bangbo">
                        <br>
                        Estructura
                    </button>
                </a>
                <a href="arduino/variables/#">
                    <button type="submit">
                        <img class="bangbus" src="../../src/img/bangbus_zzz/Safety_Portrait.webp" alt="bangbo">
                        <br>
                        Variables
                    </button>
                </a>
                <a href="arduino/funciones/#">
                    <button type="submit">
                        <img class="bangbus" src="../../src/img/bangbus_zzz/Safety_Portrait.webp" alt="bangbo">
                        <br>
                        Funciones
                    </button>
                </a>
                <br>
                
                <!--<div class="zona-botones">
                    <button class="btn btn1">Botón 1</button>
                    <button class="btn btn2">Botón 2</button>
                </div>-->
            </div>
        </main>
        <footer class="mi-footer">
            <h3>Electro Arduino</h3>
            <p>© 2018 Gandalf</p>
        </footer>
    </div>
</body>
</html>