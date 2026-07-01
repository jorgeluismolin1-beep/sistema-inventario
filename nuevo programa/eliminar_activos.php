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

    // Recibe parámetros del formulario o enlace
    if (isset($_POST['Envio'])) {    
        $id = $_POST['ID_Activos'];
    } elseif (isset($_GET['ID_Activos'])) {
        $id = $_GET['ID_Activos'];
    } else {
        $id = null;
    }

    if ($id) {
        // Elimina de la base de datos
        $elimina = "DELETE FROM activos WHERE ID_Activos = $id";  
        $eliminasql = mysqli_query($conexion, $elimina);

        if (mysqli_affected_rows($conexion) != 0) {
            echo "<script>
                swal({
                    title: 'Listo!',
                    text: '¡Se eliminó con éxito!',
                    type: 'success',
                    confirmButtonText: '¡Ok!'
                }, function() {
                    location.href = 'busca_activos.php';
                });
            </script>";
        } else {
            echo "<script>
                swal({
                    title: 'Error',
                    text: '¡Error al intentar eliminar la información!',
                    type: 'error',
                    confirmButtonText: '¡Ok!'
                }, function() {
                    location.href = 'busca_activos.php';
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
                location.href = 'busca_activos.php';
            });
        </script>";
    }
?>
</body>
</html>
