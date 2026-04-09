<?php 
session_start();
include("../config/conexion.php");

if($_SERVER["REQUEST_METHOD"] !== "POST"){
    header("Location: ../pages/signup/signup.html");
    exit();
}

$usuario = trim($_POST['usuario'] ?? '');
$contraseña = trim($_POST['contraseña'] ?? '');
$pais = trim($_POST['pais'] ?? '');

if($usuario == "" || strlen($usuario) < 4){
    echo "<script> alert('Error: El usuario debe tener al menos 4 caracteres.'); window.location.href='../pages/signup/signup.html'; </script>";
    exit;
}

if($contraseña == "" || strlen($contraseña) < 6){
    echo "<script> alert('Error: La contraseña debe tener al menos 6 caracteres'); window.location.href='../pages/signup/signup.html'; </script>";
    exit;
}

if($pais == ""){
    echo "<script> alert('Error: Todos los campos son obligatorios'); window.location.href='../pages/signup/signup.html'; </script>";
    exit;
}

$query = "SELECT * FROM Usuarios WHERE usuario = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $usuario);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows > 0){
    echo "<script> alert('Error: Este usuario ya está registrado.'); window.location.href='../pages/signup/signup.html'; </script>";
    exit;
}

$contraseña_hash = password_hash($contraseña, PASSWORD_DEFAULT);

$insert = "INSERT INTO Usuarios (usuario, contraseña, pais) VALUES (?, ?, ?)";
$stmt2 = $conn->prepare($insert);
$stmt2->bind_param("sss", $usuario, $contraseña_hash, $pais);

if($stmt2->execute()){
    header("Location: ../pages/signup/signup.html?registro=exitoso");
    exit();
}else{
    exit("Error al registrar: " . $conn->error);
}

$stmt2->close();
$stmt->close();
$conn->close();
?>