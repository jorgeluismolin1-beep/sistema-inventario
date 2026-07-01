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
    <title>Modificar Activo</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
</head>
<body>
    <?php include('templates/header.php');?>

    <?php
        include 'cone.php';
        $conexion = Conecta();

        // Recibe el ID desde busca_activos.php
        $id = isset($_POST['ID_Activos']) ? $_POST['ID_Activos'] : (isset($_GET['ID_Activos']) ? $_GET['ID_Activos'] : null);

        $descripcion = $fecha = $costo = $status = "";

        if ($id) {
            $busca = "SELECT * FROM activos WHERE ID_Activos = $id"; 
            $buscasql = mysqli_query($conexion, $busca);

            if ($buscasql && mysqli_num_rows($buscasql) > 0) {
                $fila = mysqli_fetch_array($buscasql);
                $descripcion = $fila["descripcion"];
                $fecha       = $fila["fecha"];
                $costo       = $fila["costo"];
                $status      = $fila["status"];
            } else {
                echo "<div class='container mt-3'><div class='alert alert-danger'>No se encontró el activo con ID $id</div></div>";
            }
        } else {
            echo "<div class='container mt-3'><div class='alert alert-warning'>No se proporcionó un ID válido.</div></div>";
        }
    ?>

    <div class="container mt-4">
        <h3>Modificar Activo</h3>
        <!-- ✅ ahora apunta a actualiza_activos.php -->
        <form action="actualiza_activos.php" method="POST">
            <input type="hidden" name="ID_Activos" value="<?php echo $id; ?>">

            <div class="mb-3">
                <label>Descripción</label>
                <input type="text" class="form-control" name="descripcion" value="<?php echo $descripcion; ?>" autofocus>
            </div>

            <div class="mb-3">
                <label>Fecha</label>
                <input type="date" class="form-control" name="fecha" value="<?php echo $fecha; ?>">
            </div>

            <div class="mb-3">
                <label>Costo</label>
                <input type="number" step="0.01" class="form-control" name="costo" value="<?php echo $costo; ?>">
            </div>

            <div class="mb-3">
                <label>Status</label>
                <input type="text" class="form-control" name="status" value="<?php echo $status; ?>">
            </div>

            <div class="col-auto">
                <input type="submit" name="Envio" value="Modificar" class="btn btn-primary btn-me" />
            </div>
        </form>
    </div>

    <?php include('templates/footer.php');?>

    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
