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
    <link rel="stylesheet" type="text/css" href="assets/js/sweetalert.css">
</head>
<body>

<?php
// conexión a la BD
include ('cone.php');
$conexion = Conecta();

// recibe parámetros del formulario
if (isset($_POST['Envio'])) {

    $idpizza    = intval($_POST['idpizza']);   // corresponde a la columna id
    $nombre     = $_POST['descripcion'];       // Nombre Pizza
    $detalle    = $_POST['detalle'];           // Descripción Pizza
    $precio     = floatval($_POST['precio']);  // Precio

    // consulta UPDATE al estilo bebidas
    $actualiza = "UPDATE pizzas 
                  SET nombre='$nombre', descripcion='$detalle', precio=$precio 
                  WHERE id=$idpizza";  
    $actualizasql = mysqli_query($conexion, $actualiza);

    if (mysqli_affected_rows($conexion) != 0) {
        echo "<script>
            swal(
                {title: 'Listo!', text: '¡Se modificó con éxito!', type: 'success', confirmButtonText: '¡Ok!'},
                function() { location.href = 'busca_pizzas.php'; }
            );
        </script>";
    } else {
        echo "<script>
            swal(
                {title: 'Error', text: '¡Error al intentar guardar la información!', type: 'error', confirmButtonText: '¡Ok!'},
                function() { location.href = 'busca_pizzas.php'; }
            );
        </script>";
    }
}
?>

</body>
</html>
