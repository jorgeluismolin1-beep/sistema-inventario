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

    <?php
        include 'cone.php';
        $conexion = Conecta();

        // usar GET (corregido)
        $id = isset($_GET['id']) ? $_GET['id'] : 0;
        $id = (int)$id;

        // valores por defecto
        $nombre = "";
        $detalle = "";
        $precio = "";

        // busca en la base de datos
        $busca = "SELECT * FROM pizzas WHERE id=$id";
        $buscasql = mysqli_query($conexion, $busca);

        // cargar valores
        while ($fila = mysqli_fetch_array($buscasql)) {                          
            $nombre = $fila["id"];
            $detalle = $fila["descripcion"];
            $precio = $fila["precio"];
        }
    ?>
 
   <!--llebar el formulario con los valores del registro!-->
<div class="container">
  <form action="actualiza_pizza.php" method="POST">

    <!-- Campo oculto con el ID correcto -->
    <input type="hidden" name="idpizza" value="<?php echo $id; ?>">

    <div class="mb-3">
      <label>Nombre Pizza</label>
      <input type="text" class="form-control" name="descripcion" value="<?php echo $detalle; ?>" autofocus>
    </div>

    <div class="mb-3">
      <label>Descripcion Pizza</label>
      <input type="text" class="form-control" name="detalle" value="<?php echo $detalle; ?>" autofocus>
    </div>

    <div class="mb-3">
      <label>Precio</label>
      <input type="number" step="0.01" class="form-control" name="precio" value="<?php echo $precio; ?>">
    </div>

    <div class="col-auto">
      <input type="submit" name="Envio" value="Modificar" class="btn btn-primary btn-me" />
    </div>

  </form>
</div>
