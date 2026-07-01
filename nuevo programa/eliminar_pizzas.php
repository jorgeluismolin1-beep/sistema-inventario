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
    <title>Eliminando...</title>
    <script src="assets/js/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/js/sweetalert.css">
</head>
<body>

<?php
    include ('cone.php');
    $conexion = Conecta();

    if (isset($_POST['Envio'])) {    
        // nombre del campo debe coincidir con el input hidden del formulario
        $id = intval($_POST['idpizza']);  

        // elimina de la base de datos
        $elimina = "DELETE FROM pizzas WHERE id = $id";  
        $eliminasql = mysqli_query($conexion, $elimina);

        if (mysqli_affected_rows($conexion) != 0) {
            echo "<script>
                swal({
                    title: 'Listo!',
                    text: '¡Se eliminó la pizza con éxito!',
                    type: 'success',
                    confirmButtonText: '¡Ok!'
                }, function() {
                    location.href = 'busca_pizzas.php';
                });
            </script>";
        } else {
            echo "<script>
                swal({
                    title: 'Error',
                    text: '¡Error al intentar eliminar la pizza!',
                    type: 'error',
                    confirmButtonText: '¡Ok!'
                }, function() {
                    location.href = 'busca_pizzas.php';
                });
            </script>";
        }
    }
?>
</body>
</html>
