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
<?php


session_start();
require_once("conexion.php");

if (!isset($_SESSION['usuario'])) {
    header("Location: iniciar_sesion.php");
    exit();
}

$usuario = $_SESSION['usuario'];
$session_id = session_id();

// Validar contra la base de datos
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


<html>
    <head>
    <meta charset="UTF-8">
    <title>Guardando...</title>
    <script src="assets/js/sweetalert.min.js"></script>
   <link rel="stylesheet" type="text/css" href="assets/js/sweetalert.css"></head>
    <body>
 
<?php
            //conexcion a la BD
            include ('cone.php');
            $conexion = Conecta();
        //recibe parametros del formulario  
    if (isset($_POST['Envio']))
        {    
           
            $pizza=$_POST['pizza'];
            $descripcion=$_POST['descripcion'];
            $precio=$_POST['precio'];
         // inserta a la base de datos
            $insertar="insert into pizzas (nombre,descripcion,precio) values ('$pizza','$descripcion',$precio)";    
        // Ejecutar query  
            $insertasql=mysqli_query($conexion,$insertar) ;
 
                   
           
            if ($insertasql)
            {
                  echo "<script>swal({title: 'Listo!',text: '¡Se guardo con exito!',type: 'success',confirmButtonText: '¡Ok!'},function() {location.href = 'alta_pizza.php';});</script>";
            }
           
           
            else
            {
                echo "<script>swal({title: 'Error',text: '¡Error al intentar guardar la informacion!',type: 'error',confirmButtonText: '¡Ok!'},function() {location.href = 'alta_pizza.php';});</script>";
            }
 
        }
        ?>
        </body>
        <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
/
<script>
//javaaaa screipt
const tabID = sessionStorage.getItem("tabID") || Date.now();
sessionStorage.setItem("tabID", tabID);


const activeTab = localStorage.getItem("activeTab");


// registrar pestaña actual
localStorage.setItem("activeTab", tabID);

// cerrar pesttalla
window.addEventListener("beforeunload", function(){
    if(localStorage.getItem("activeTab") === tabID){
        localStorage.removeItem("activeTab");
    }
});

</script>

</body>
</html>