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
    // Conexión a la BD
    include ('cone.php');
    $conexion = Conecta();

    // Recibe parámetros del formulario  
    if (isset($_POST['Envio'])) {    
        $id          = $_POST['ID_Bebida'];          
        $nombre      = $_POST['nombre'];   
        $descripcion = $_POST['descripcion'];
        $precio      = $_POST['precio'];
        $tamano      = $_POST['tamano'];
        $stock       = $_POST['stock'];

        // Actualiza en la base de datos
        $actualiza = "UPDATE bebidas 
                      SET nombre='$nombre',
                          descripcion='$descripcion',
                          precio=$precio,
                          tamano='$tamano',
                          stock=$stock
                      WHERE ID_Bebida=$id";  

        $actualizasql = mysqli_query($conexion, $actualiza);

        if (mysqli_affected_rows($conexion) != 0) {
            echo "<script>
                swal({
                    title: 'Listo!',
                    text: '¡Se modificó con éxito!',
                    type: 'success',
                    confirmButtonText: '¡Ok!'
                }, function() {
                    location.href = 'busca_bebida.php';
                });
            </script>";
        } else {
            echo "<script>
                swal({
                    title: 'Error',
                    text: '¡Error al intentar guardar la información!',
                    type: 'error',
                    confirmButtonText: '¡Ok!'
                }, function() {
                    location.href = 'busca_bebida.php';
                });
            </script>";
        }
    }
?>
</body>
</html>
