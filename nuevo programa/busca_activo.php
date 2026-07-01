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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Activo</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="assets/js/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/js/sweetalert.css">
</head>
<body>
    <?php include('templates/header.php');?>

    <div class="container mt-4">
        <div class="row">
            <form name="activos" action="modi_activos.php" method="POST">
                <div class="col-6">
                    <label class="form-control-label">Activos</label>
                    <select class="form-control" name="idactivo">
                        <?php
                           
                            include 'cone.php';
                            $conexion = Conecta();
                            $sqlquery = "SELECT * FROM activos ORDER BY descripcion";
                            $results = mysqli_query($conexion, $sqlquery) or die("Error al verificar existencia de registros");

                            while($fila = mysqli_fetch_array($results)) {
                                echo '<option value='.$fila["ID_Activo"].'>'
                                    .utf8_encode($fila["descripcion"]).'</option>';  
                            }
                        ?>
                    </select>
                    <br>
                    <input type="submit" name="Envio" value="Buscar" class="btn btn-primary" />
                </div>
            </form>
        </div>
    </div>

    <?php include('templates/footer.php');?>

    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
