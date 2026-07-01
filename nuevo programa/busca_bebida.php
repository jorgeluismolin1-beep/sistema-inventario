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
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="assets/js/sweetalert.min.js"></script>
   <link rel="stylesheet" type="text/css" href="assets/js/sweetalert.css">

</head>
<body>
    <?php include('templates/header.php');?>
 
    <div class="container">
        <div class="row">
            <FORM name="bebidas" action="modi_bebida.php" method="POST">
                    <div class="col-6">
                           
                    <label class=" form-control-label" >Bebida </label>
                     
                    <select class="form-control" name="ID_Bebida">
                        <?php
                                                 
                       
                         include 'cone.php';
                         $conexion = Conecta();
                          $sqlquery="SELECT * from bebidas order by nombre";
                         $results=mysqli_query($conexion,$sqlquery) or die ("Error al verificar Existencia de registro");
                         while($fila=mysqli_fetch_array($results))
                            {
                                echo '<option value='.$fila["ID_Bebida"].'>'
                                    .utf8_encode($fila["nombre"]).'</option>';  
                            }  
                        ?>
                    </select>
           
        <br>
                                   
                                       
    <input type="submit"  name="Envio" value="Buscar" />
                                 
    </div>
                               
    </div>
                 
    </form>
    </div>
         
    <?php include('templates/footer.php');?>
 
</body>
   <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</html>