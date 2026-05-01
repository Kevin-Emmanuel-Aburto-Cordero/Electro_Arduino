<!DOCTYPE html>
<html lang="es-ES">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../src/assets/css/pages/cursos/arduino_curso.css?v=6.0">
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
                <button type="button" onclick="abrirModal(this)" class="btn-leccion" data-url="../cursos/arduino/estructura/estructura.php">
                    <img class="bangbus" src="../../src/img/bangbus_zzz/Safety_Portrait.webp" alt="bangbo">
                    <br>
                    Estructura
                </button>
                <div id="modal" class="modal">
                    <div class="modal-contenido">
                        <p>¿Quiere iniciar esta leccion?</p>
                        <div class="botones">
                            <button onclick="aceptar()">Aceptar</button>
                            <button onclick="cerrarModal()">Cancelar</button>
                        </div>
                    </div>
                </div>


                <button type="button" onclick="abrirModal(this)" class="btn-leccion" data-url="../cursos/arduino/variables/variables.php">
                    <img class="bangbus" src="../../src/img/bangbus_zzz/Safety_Portrait.webp" alt="bangbo">
                    <br>
                    Variables
                </button>
                <div id="modal" class="modal">
                    <div class="modal-contenido">
                        <p>¿Quiere iniciar esta leccion?</p>
                        <div class="botones">
                            <button onclick="aceptar()">Aceptar</button>
                            <button onclick="cerrarModal()">Cancelar</button>
                        </div>
                    </div>
                </div>

                
                <button type="button" onclick="abrirModal(this)" class="btn-leccion" data-url="../cursos/arduino/funciones/funciones.php">
                    <img class="bangbus" src="../../src/img/bangbus_zzz/Safety_Portrait.webp" alt="bangbo">
                    <br>
                    Funciones
                </button>
                <div id="modal" class="modal">
                    <div class="modal-contenido">
                        <p>¿Quiere iniciar esta leccion?</p>
                        <div class="botones">
                            <button onclick="aceptar()">Aceptar</button>
                            <button onclick="cerrarModal()">Cancelar</button>
                        </div>
                    </div>
                </div>

                <br>
            </div>
        </main>
        <script src="../../src/assets/js/notificaciones/cursos/Arduino/notificacion.js?v=4.0"></script>
        <footer class="mi-footer">
            <h3>Electro Arduino</h3>
            <p>© 2018 Gandalf</p>
        </footer>
    </div>
</body>
</html>