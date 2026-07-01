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
    <title>Eliminar Bebida</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
</head>
<body>
    <?php include('templates/header.php');?>

    <?php
        include 'cone.php';
        $conexion = Conecta();
        $id = $_GET['ID_Bebida'];  // recibe el id de bebida

        // busca en la base de datos
        $busca = "SELECT * FROM bebidas WHERE ID_Bebida = $id";  
        $buscasql = mysqli_query($conexion, $busca);

        // carga los valores del registro a variables temporales    
        while ($fila = mysqli_fetch_array($buscasql)) {                                  
            $descripcion = $fila["descripcion"];
            $precio      = $fila["precio"];
            $tamano      = $fila["tamano"];
            $stock       = $fila["stock"];
        }
    ?>

    <!-- llenar el formulario con los valores del registro -->
    <div class="container mt-4">
        <form action="elimina_bebidas.php" method="POST">
            <input type="number" class="form-control" name="ID_Bebida" value="<?php echo $id;?>" hidden>

            <div class="mb-3">
                <label>Descripción Bebida</label>
                <input type="text" class="form-control" name="descripcion" value="<?php echo $descripcion;?>" disabled>
            </div>

            <div class="mb-3">
                <label>Precio</label>
                <input type="number" step="0.01" class="form-control" name="precio" value="<?php echo $precio;?>" disabled>
            </div>

            <div class="mb-3">
                <label>Tamaño</label>
                <input type="text" class="form-control" name="tamano" value="<?php echo $tamano;?>" disabled>
            </div>

            <div class="mb-3">
                <label>Stock</label>
                <input type="number" class="form-control" name="stock" value="<?php echo $stock;?>" disabled>
            </div>

            <div class="col-auto">
                <input type="submit" name="Envio" value="Eliminar" class="btn btn-danger btn-me" />
            </div>
        </form>
    </div>

    <?php include('templates/footer.php');?>
</body>
</html>
