<?php
session_start();
require_once("conexion.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $usuario = mysqli_real_escape_string($conexion, $_POST['username']);
    $clave   = mysqli_real_escape_string($conexion, $_POST['password']);


    $sql = "SELECT * FROM usuarios WHERE usuario='$usuario' AND clave='$clave'";
    $resultado = mysqli_query($conexion, $sql);

    if ($resultado && mysqli_num_rows($resultado) > 0) {


        $_SESSION['usuario'] = $usuario;


        $session_id = session_id();
        $update = "UPDATE usuarios SET session_id='$session_id' WHERE usuario='$usuario'";
        mysqli_query($conexion, $update);


        header("Location: index.php");
        exit();

    } else {
        echo "<script>alert('Usuario o contraseña incorrectos');history.back();</script>";
    }
}
?>
