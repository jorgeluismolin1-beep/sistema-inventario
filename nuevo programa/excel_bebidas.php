<?php
session_start();
require_once("conexion.php");

if (!isset($_SESSION['usuario'])) {
    header("Location: iniciar_sesion.php");
    exit();
}

include("cone.php");
$conexion = Conecta();


header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
header("Content-Disposition: attachment; filename=bebidas.xls");


$query = "SELECT * FROM bebidas ORDER BY descripcion";
$result = mysqli_query($conexion, $query);


echo "<table border='1'>";
echo "<tr>
        <th>ID</th>
        <th>Descripcion</th>
        <th>Tamano</th>
        <th>Stock</th>
        <th>Precio</th>
      </tr>";

while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>".$row['ID_Bebida']."</td>";        
    echo "<td>".strtolower($row['descripcion'])."</td>"; 
    echo "<td>".strtolower($row['tamano'])."</td>";      
    echo "<td>".$row['stock']."</td>";           
    echo "<td>".number_format($row['precio'],2)."</td>";
    echo "</tr>";
}

echo "</table>";
exit;
?>
