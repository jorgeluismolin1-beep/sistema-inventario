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
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pizzería</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
</head>

<body>

<?php include('templates/header.php'); ?>


<?php include('templates/footer.php'); ?>

<script src="bootstrap/js/bootstrap.bundle.min.js"></script>
/
<script>

    const tabID = sessionStorage.getItem("tabID") || Date.now();
    sessionStorage.setItem("tabID", tabID);


    const activeTab = localStorage.getItem("activeTab");



    localStorage.setItem("activeTab", tabID);


    window.addEventListener("beforeunload", function(){
        if(localStorage.getItem("activeTab") === tabID){
            localStorage.removeItem("activeTab");
        }
    });

</script>

</body>
</html>