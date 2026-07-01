<?php
session_start();
require_once("conexion.php");

if (!isset($_SESSION['usuario'])) {
    header("Location: iniciar_sesion.php");
    exit();
}

$usuario = $_SESSION['usuario'];
$session_id = session_id();

$sql = "SELECT session_id FROM usuarios WHERE usuario='$usuario'";
$resultado = mysqli_query($conexion, $sql);

if($resultado){
    $fila = mysqli_fetch_assoc($resultado);

    if ($fila['session_id'] != $session_id) {
        session_destroy();
        header("Location: iniciar_sesion.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pizzería</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="assets/js/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/js/sweetalert.css">
</head>
<body>
    <?php include('templates/header.php');?>

    <div class="container mt-5">
        <form action="agregar_pizzas.php" method="post">
            
            <div class="mb-3">
                <label>Nombre</label>
                <input type="text" class="form-control" name="nombre" required autofocus>
            </div>

             <div class="mb-3">
                <label>Descripcion</label>
                <input type="text" class="form-control" name="descripcion" required autofocus>
            </div>

            <div class="mb-3">
                <label>Precio</label>
                <input type="number" step="0.01" class="form-control" name="precio" required>
            </div>

            <button type="submit" class="btn btn-primary btn-me" name="Envio">Agregar pizza</button>
        </form>
    </div>

    <?php include('templates/footer.php');?>
</body>
</html>
