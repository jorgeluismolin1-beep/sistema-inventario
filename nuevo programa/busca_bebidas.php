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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Practica de bootstrap</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
</head>
<body>
    <?php include('templates/header.php');?>

    <div class="container">
        <div class="row">
            <div class="col-1">Id</div>
            <div class="col-3">Descripción</div>
            <div class="col-2">Precio</div>
            <div class="col-2">Tamaño</div>
            <div class="col-2">Stock</div>
            <div class="col-2">Opciones</div>
        </div>
    </div>  

    <div class="container">
        <?php 
            include 'cone.php';
            $conexion = Conecta();

            // Consulta ordenada por descripción
            $sqlquery = "SELECT * FROM bebidas ORDER BY Descripcion";
            $results = mysqli_query($conexion, $sqlquery);

            while ($fila = mysqli_fetch_array($results)) {
    $videntificador = $fila['ID_Bebida'];

    echo "<div class='row mt-2'>";
    echo "<div class='col-1'>".$fila['ID_Bebida']."</div>";
    echo "<div class='col-3'>".$fila['descripcion']."</div>"; 
    echo "<div class='col-2'>".$fila['precio']."</div>";
    echo "<div class='col-2'>".$fila['tamano']."</div>";
    echo "<div class='col-2'>".$fila['stock']."</div>";
    echo "<div class='col-2'>
            <a href='modi_Bebidas.php?ID_Bebida=$videntificador'>
                <img src='assets/img/lapiz.png' width='30' height='20'>
            </a> 
            <a href='eliminar2.php?ID_Bebida=$videntificador'>
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
