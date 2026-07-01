<?php
session_start();
require_once("conexion.php");

// Verificar que exista un usuario en sesión
if (isset($_SESSION['usuario'])) {
    $usuario = $_SESSION['usuario'];

    // Limpiar el session_id en la BD
    $sql = "UPDATE usuarios SET session_id=NULL WHERE usuario='$usuario'";
    mysqli_query($conexion, $sql);
}

// Destruir la sesión
session_unset();   // limpia todas las variables de sesión
session_destroy(); // destruye la sesión

// Redirigir al login
header("Location: iniciar_sesion.php");
exit();
?>
