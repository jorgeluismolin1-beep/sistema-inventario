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
<html>
    <head>
    <meta charset="UTF-8">
    <title>Guardando...</title>
    <script src="assets/js/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/js/sweetalert.css">
    </head>
    <body>

<?php

            //conexcion a la BD
            include ('cone.php');
            $conexion = Conecta();
        //recibe parametros del formulario  
    if (isset($_POST['Envio']))
        {    
        
            $id=$_POST['id'];
            $descripcion=$_POST['descripcion'];
            $precio=$_POST['precio'];
            $id=$_POST['id'];
            
         // iActualiza a la base de datos
            $actualiza="update pizzas set nombre='$pizza',descripcion='$descripcion',precio=$precio where id=$id";  
            $actualizasql=mysqli_query($conexion,$actualiza) ;

            if (mysqli_affected_rows($conexion) != 0)
            {
                echo "<script>swal({title: 'Listo!',text: '¡Se modifico con exito!',type: 'success',confirmButtonText: '¡Ok!'},function() {location.href = 'busca_pizzas.php';});</script>";
            }
    
        
            else
            {
                echo "<script>swal({title: 'Error',text: '¡Error al intentar guardar la informacion!',type: 'error',confirmButtonText: '¡Ok!'},function() {location.href = 'busca_pizzas.php';});</script>";
            }

        }
        ?>
        </body>