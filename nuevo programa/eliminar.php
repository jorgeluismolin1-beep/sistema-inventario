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
    <title>Eliminar Pizza</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
</head>
<body>
<?php include('templates/header.php'); ?>

<?php
    include 'cone.php';
    $conexion = Conecta();
    $id = intval($_GET['id']);  // recibe el id de la pizza

    // busca en la base de datos
    $busca = "SELECT * FROM pizzas WHERE id = $id";  
    $buscasql = mysqli_query($conexion, $busca);

    if ($fila = mysqli_fetch_array($buscasql)) {                                  
        $nombre      = $fila["nombre"];
        $descripcion = $fila["descripcion"];
        $precio      = $fila["precio"];
    } else {
        echo "<div class='container mt-4'><div class='alert alert-danger'>No se encontró la pizza con ID $id</div></div>";
    }
?>

<div class="container mt-4">
    <form action="eliminar_pizzas.php" method="POST">
        <input type="hidden" name="idpizza" value="<?php echo $id;?>">

        <div class="mb-3">
            <label>Nombre Pizza</label>
            <input type="text" class="form-control" value="<?php echo $nombre;?>" disabled>
        </div>

        <div class="mb-3">
                <label>Descripción de pizza</label>
                <input type="text" class="form-control" name="descripcion" value="<?php echo $descripcion;?>" disabled>
            </div>


        <div class="mb-3">
            <label>Precio</label>
            <input type="number" step="0.01" class="form-control" value="<?php echo $precio;?>" disabled>
        </div>

        <div class="col-auto">
            <input type="submit" name="Envio" value="Eliminar" class="btn btn-danger btn-me" />
        </div>
    </form>
</div>

<?php include('templates/footer.php'); ?>
</body>
</html>
