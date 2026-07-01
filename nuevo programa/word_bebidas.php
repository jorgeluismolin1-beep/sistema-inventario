<?php
 include("cone.php");
  $conexion = Conecta();
   date_default_timezone_set('America/Los_Angeles');

$query = "SELECT * FROM bebidas";
$lista = mysqli_query($conexion, $query);

if (!$lista || mysqli_num_rows($lista) == 0) {
    echo "<script>alert('No existen datos para desplegar');history.back();</script>";
    exit;
}

header("Content-Disposition: attachment; filename=Listado_bebidas.doc");
header("Content-Type: application/msword; charset=utf-8");

echo "<html><head><meta charset='utf-8'></head><body>";
echo "<h2 style='text-align:center;'>Listado de Bebidas</h2>";
echo "<table border='1' cellspacing='0' cellpadding='5' style='width:100%; border-collapse:collapse;'>";
echo "<tr style='background-color:#f2f2f2; font-weight:bold;'>
        <td>descripcion</td>
         <td>tamano</td>
          <td>stock</td>
            <td>precio</td>
      </tr>";

while ($row = mysqli_fetch_assoc($lista)) {
    echo "<tr>
            <td>{$row['descripcion']}</td>
            <td>{$row['tamano']}</td>
            <td>{$row['stock']}</td>
            <td>".number_format($row['precio'],2)."</td>
          </tr>";
}

echo "</table>";
echo "<p style='text-align:right;'><i>Generado el ".date("d-m-Y H:i:s")."</i></p>";
echo "</body></html>";

mysqli_close($conexion);
?>
