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

if ($resultado) {
    $fila = mysqli_fetch_assoc($resultado);
    if ($fila['session_id'] != $session_id) {
        session_unset();
        session_destroy();
        header("Location: iniciar_sesion.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Practica de bootstrap</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
</head>
<body>
    <?php include('templates/header.php');?>

    <div class="container">
        <div class="row">
            <div class="col-1">Id</div>
            <div class="col-3">Nombre</div>
            <div class="col-3">Descripción</div>
            <div class="col-2">Precio</div>
            <div class="col-2">Opciones</div>
        </div>
    </div>  

    <div class="container">
        <?php 
            include 'cone.php';
            $conexion = Conecta();
            $sqlquery = "SELECT * FROM pizzas ORDER BY descripcion";
            $results = mysqli_query($conexion, $sqlquery);

           while ($fila = mysqli_fetch_array($results)) {
    $videntificador = $fila['id']; // usar 'id' si así se llama en la tabla

    echo "<div class='row mt-2'>"; 
    echo "<div class='col-1'>".$fila['id']."</div>";
    echo "<div class='col-3'>".$fila['nombre']."</div>"; 
    echo "<div class='col-3'>".$fila['descripcion']."</div>";
    echo "<div class='col-2'>".$fila['precio']."</div>";
    echo "<div class='col-2'>
            <a href='modi_pizza.php?id=$videntificador'>
                <img src='assets/img/lapiz.png' width='30' height='20'>
            </a> 
            <a href='eliminar.php?id=$videntificador'>
                <img src='assets/img/borrar.png' width='30' height='20'>
            </a>
          </div>";
    echo "</div>";
}


       ?>
    </div>

    <?php include('templates/footer.php');?>
</body>
<script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</html>


