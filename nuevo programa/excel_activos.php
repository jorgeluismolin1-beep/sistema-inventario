<?php
session_start();
require_once("conexion.php");

if (!isset($_SESSION['usuario'])) {
    header("Location: iniciar_sesion.php");
    exit();
}

include("cone.php");
$conexion = Conecta();


$query = "SELECT * FROM activos WHERE status=1 ORDER BY descripcion";
$result = mysqli_query($conexion, $query);

if (!$result || mysqli_num_rows($result) == 0) {
    echo "<script>alert('No existen datos para desplegar!!');history.back();</script>";
    exit;
}


header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
header("Content-Disposition: attachment; filename=Listado_Activos.xls");
header("Pragma: no-cache");
header("Expires: 0");

echo "<table border='1'>";
echo "<tr>
        <th>ID</th>
        <th>Descripcion</th>
        <th>Fecha</th>
        <th>Costo</th>
        <th>Status</th>
      </tr>";

while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>".$row['ID_Activos']."</td>";
    echo "<td>".strtolower($row['descripcion'])."</td>";
echo "<td>".date("Y-m-d", strtotime($row['fecha']))."</td>";
    echo "<td>".number_format($row['costo'],2)."</td>";
    echo "<td>".$row['status']."</td>";
    echo "</tr>";
}


echo "</table>";
mysqli_close($conexion);
exit;
?>
