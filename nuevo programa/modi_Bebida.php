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
    <title>modificar bebida</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

</head>
<body>
    <?php include('templates/header.php');?>

    <?php
        include 'cone.php';
        $conexion=Conecta();
        $id=$_POST['idbebidas'];
 
        
      // busca a la base de datos
          $busca="select * from bebidas where idbebida=$id";
        $buscasql=mysqli_query($conexion,$busca) ;
      // carga los valores del registro a variables temporales    
    while( $fila = mysqli_fetch_array($buscasql))
            {                          
             $nombre=$fila["nombre"];
            $detalle=$fila["detalle"];
            $precio=$fila["precio"];
            $stock=$fila["stock"];
            $tamano=$fila["tamano"];
            
            }
    
    ?>

    <!--llebar el formulario con  los valores del registro!-->
    <div class="container">
    <form action="actualiza_Bebidas.php" method="POST">
      <div class="mb-3">
          <label>Nombre Bebida</label>
          <input type="text" class="form-control" name="nombre" value="<?php echo $nombre;?>" autofocus>
        </div>
        <input type="text" class="form-control" name="descripcion" value="<?php echo $descripcion;?> "autofocus>
        </div>
        <div class="mb-3">
        <label> precio</label>
        <textarea class="form-control" name="precio" rows="3"><?php echo $precio;?></textarea>
        </div>
        <div class="mb-3">
        <label>tamaño</label>
        <input type="text" class="form-control" name="tamano"  value="<?php echo $tamano;?>">
        </div>
        <div class="mb-3">
        <label>stock</label>
        <input type="number" class="form-control" name="stock"  value="<?php echo $stock;?>">
        </div>
        <div class="col-auto">
        <input type="submit"  name="Envio" value="Modificar"class="btn btn-primary btn-me" />
        </div>
    </form>

    </div>
    <?php include('templates/footer.php');?>

</body>

</html>