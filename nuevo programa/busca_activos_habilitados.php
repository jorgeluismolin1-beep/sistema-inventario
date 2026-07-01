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
    <title>Habilitados</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
</head>
<body>
<?php include('templates/header.php');?>

<div class="container">
    <h3>Habilitados</h3>
    <div class="row fw-bold">
        <div class="col-1">Id</div>
        <div class="col-3">Descripción</div>
        <div class="col-2">Fecha</div>
        <div class="col-2">Costo</div>
        <div class="col-2">Status</div>
        <div class="col-2">Opciones</div>
    </div>
</div>

<div class="container">
<?php
    include 'cone.php';
    $conexion = Conecta();

    // Mostrar solo habilitados (status=1)
    $sqlquery = "SELECT * FROM activos WHERE status=1 ORDER BY descripcion";
    $results = mysqli_query($conexion, $sqlquery);

    if ($results && mysqli_num_rows($results) > 0) {
        while ($fila = mysqli_fetch_assoc($results)) {
            $videntificador = $fila['ID_Activos'];

            echo "<div class='row mt-2'>";
            echo "<div class='col-1'>".$fila['ID_Activos']."</div>";
            echo "<div class='col-3'>".$fila['descripcion']."</div>";
            echo "<div class='col-2'>".$fila['fecha']."</div>";
            echo "<div class='col-2'>".$fila['costo']."</div>";
            echo "<div class='col-2'>1</div>";
            echo "<div class='col-2'>
                    <a href='deshabilitar_activos.php?ID_Activos=$videntificador'>
                        <img src='assets/img/habilitar.png' width='30' height='30' title='Deshabilitar'>
                    </a>
                  </div>";
            echo "</div>";
        }
    } else {
        echo "<div class='row mt-2'><div class='col'>No hay activos habilitados.</div></div>";
    }

    mysqli_close($conexion);
?>
</div>

<?php include('templates/footer.php');?>
<script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
