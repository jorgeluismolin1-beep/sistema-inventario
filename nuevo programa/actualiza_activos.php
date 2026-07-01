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
    include ('cone.php');
    $conexion = Conecta();

    if (isset($_POST['Envio'])) {
        $id          = $_POST['ID_Activos'];
        $descripcion = $_POST['descripcion'];
        $fecha       = $_POST['fecha'];
        $costo       = $_POST['costo'];
        $status      = $_POST['status'];

        $actualiza = "UPDATE activos 
                      SET descripcion='$descripcion',
                          fecha='$fecha',
                          costo=$costo,
                          status='$status'
                      WHERE ID_Activos=$id";

        $actualizasql = mysqli_query($conexion, $actualiza);

        if ($actualizasql) {
            echo "<script>
                swal({
                    title: 'Listo!',
                    text: '¡Se modificó con éxito!',
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
                    text: '¡Error al intentar guardar la información!',
                    type: 'error',
                    confirmButtonText: '¡Ok!'
                }, function() {
                    location.href = 'busca_activos.php';
                });
            </script>";
        }
    }
?>
</body>
</html>
