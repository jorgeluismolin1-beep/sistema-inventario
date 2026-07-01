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
    <title>Modificación Bebida</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
</head>
<body>
    <?php include('templates/header.php');?>

    <?php
        include 'cone.php';
        $conexion = Conecta();

        if (isset($_GET['ID_Bebida'])) {
            $id = $_GET['ID_Bebida'];

            $busca = "SELECT * FROM bebidas WHERE ID_Bebida = $id";
            $buscasql = mysqli_query($conexion, $busca);

            if (!$buscasql) {
                die("Error en la consulta: " . mysqli_error($conexion));
            }

             
            while ($fila = mysqli_fetch_array($buscasql)) {                          
                $nombre      = $fila["ID_Bebida"];
                $descripcion = $fila["descripcion"];
                $precio      = $fila["precio"];
                $tamano      = $fila["tamano"];
                $stock       = $fila["stock"];
            }
        } else {
            die("No se recibió el ID de la bebida.");
        }
    ?>

    <div class="container mt-4">
      <form action="actualiza_Bebidas.php" method="POST">
        <input type="number" class="form-control" name="ID_Bebida" value="<?php echo $id;?>" hidden>


        <div class="mb-3">
          <label>Nombre Bebida</label>
          <input  type="text" class="form-control" name="descripcion" value="<?php echo $descripcion;?>">
        </div>

        <div class="mb-3">
          <label>Precio</label>
          <input type="number" step="0.01" class="form-control" name="precio" value="<?php echo $precio;?>">
        </div>

        <div class="mb-3">
          <label>Tamaño</label>
          <input type="text" class="form-control" name="tamano" value="<?php echo $tamano;?>">
        </div>

        <div class="mb-3">
          <label>Stock</label>
          <input type="number" step="1" class="form-control" name="stock" value="<?php echo $stock;?>">
        </div>

        <div class="col-auto">
          <input type="submit" name="Envio" value="Modificar" class="btn btn-primary btn-me" />
        </div>
      </form>
    </div>

    <?php include('templates/footer.php');?>
</body>
</html>
