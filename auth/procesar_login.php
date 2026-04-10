<?php
session_start();
session_regenerate_id(true);
include("../config/conexion.php");

$usuario = $_POST['usuario'];
$contraseña = $_POST['contraseña'];

$sql = "SELECT idUsuario, usuario, contraseña FROM Usuarios WHERE usuario = ? LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $usuario);
$stmt->execute();
$resultado=$stmt->get_result();

if($resultado->num_rows > 0){
    $row = $resultado->fetch_assoc();

    if(password_verify($contraseña, $row['contraseña'])){
        $_SESSION['idUsuario'] = $row['idUsuario'];
        $_SESSION['usuario'] = $row['usuario'];

        header("Location: ../pages/dashboard.php");
        exit();
    }else{
        echo "<script>alert('Contraseña incorrecta.'); window.location.href='../pages/login/login.html'; </script>";
    }
}else{
    echo "<script>alert('Usuario no entrado.'); window.location.href='../pages/login/login.html'; </script>";
}

$stmt->close();
$conn->close();
?>