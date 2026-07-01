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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Activos</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="assets/js/sweetalert.min.js"></script>
   <link rel="stylesheet" type="text/css" href="assets/js/sweetalert.css">
</head>
<body>
    <?php include('templates/header.php');?>
    <div class="container">
        <form action="alta_activos.php" method="post">
            <div class="md-3">
                <label>Nombre activos</label>
                <input type="text" class="form-control" name="descripcion" autofocus>
                    <div >

                    <label>Fecha</label>
                   <input type="date" class="form-control" name="fecha">
                    </div>
                        <label>Costo</label>
                        <input type="number" class="form-control" name="costo" step="0.01" required>
                    </div>
                   
                    <div class="mb-3">
                        <input type="submit" name="Envio" value="agregar" class="btn btn-primary btn-me">
                    </div>
                </div>
            </div>

        </form>
</div>
     <?php include('templates/footer.php');?>    
</body>
</html>