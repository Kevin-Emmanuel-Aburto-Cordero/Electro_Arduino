<!DOCTYPE html>
<html lang="es-ES">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/assets/css/dashboard.css?v=3.0">
    <link rel="stylesheet" href="../src/assets/css/fonts/fonts.css?v=2.0">
    <title>Document</title>
</head>
<body>
    <div class="layout-containder">
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
                    <a href="../auth/logout.php">
                        <button type="submit">Cerrar Sesion</button>
                    </a>
                </div>
        </header>
        <main class="mi-contenedor">
            <div class="contenedor0">
                <div class="subcontenedor0">
                    <?php
                    session_start();
                    if(!isset($_SESSION['idUsuario'])){
                    header("Location: ../index.html");
                    exit();
                    }
                    echo "Bienvenido, " . $_SESSION['usuario'] . "!<br>";
                    ?>
                    <br>
                </div>
            </div>
            <div class="contenedor1">

                
                <button type="button" onclick="abrirModal(this)" class="btn-leccion" data-url="cursos/electronica.php">Electronica</button>
                <div id="modal" class="modal">
                    <div class="modal-contenido">
                        <p>¿Quieres iniciar el curso de Electronica?</p>
                        <div class="botones">
                            <button onclick="aceptar()">Aceptar</button>
                            <button onclick="cerrarModal()">Cancelar</button>
                        </div>
                    </div>
                </div>
                


                <button type="submit" onclick="abrirModal(this)" class="btn-leccion" data-url="cursos/arduino.php">Arduino</button>
                <div id="modal" class="modal">
                    <div class="modal-contenido">
                        <p>¿Quieres inicar el curso de Arduino?</p>
                        <div class="botones">
                            <button onclick="aceptar()">Aceptar</button>
                            <button onclick="cerrarModal()">Cancelar</button>
                        </div>
                    </div>
                </div>


                
                <button type="submit" onclick="abrirModal(this)" class="btn-leccion" data-url="">DevOps</button>
                <div id="modal" class="modal">
                    <div class="modal-contenido">
                        <p>¿Quieres inicar el curso de DevOps?</p>
                        <div class="botones">
                            <button onclick="aceptar()">Aceptar</button>
                            <button onclick="cerrarModal()">Cancelar</button>
                        </div>
                    </div>
                </div>

            </div>
        </main>
        <script src="../src/assets/js/notificaciones/dashboard/notificacion_acceder_a_curso.js?v=1.0"></script>
        <footer class="mi-footer">
            <h3>Electro Arduino</h3>
            <p>© 2018 Gandalf</p>
        </footer>
    </div>
</body>
</html>