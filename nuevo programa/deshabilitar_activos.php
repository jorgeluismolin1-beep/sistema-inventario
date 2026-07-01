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
    <title>Deshabilitar Activo</title>
    <script src="assets/js/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/js/sweetalert.css">
</head>
<body>
<?php
    include ('cone.php');
    $conexion = Conecta();

    if (isset($_GET['ID_Activos'])) {
        $id = $_GET['ID_Activos'];

        
        $sql = "UPDATE activos SET status=0 WHERE ID_Activos=$id";
        $query = mysqli_query($conexion, $sql);

        if ($query) {
            echo "<script>
                swal({
                    title: 'Listo!',
                    text: '¡Activo deshabilitado con éxito!',
                    type: 'success',
                    confirmButtonText: '¡Ok!'
                }, function() {
                    location.href = 'busca_activos_habilitados.php';
                });
            </script>";
        } else {
            echo "<script>
                swal({
                    title: 'Error',
                    text: 'No se pudo deshabilitar el activo.',
                    type: 'error',
                    confirmButtonText: '¡Ok!'
                }, function() {
                    location.href = 'busca_activos_habilitados.php';
                });
            </script>";
        }
    } else {
        echo "<script>
            swal({
                title: 'Error',
                text: 'No se recibió el ID del activo.',
                type: 'error',
                confirmButtonText: '¡Ok!'
            }, function() {
                location.href = 'busca_activos_habilitados.php';
            });
        </script>";
    }
?>
</body>
</html>
