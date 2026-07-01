<?php

// Conexión a la BD
include("cone.php");
$conexion = Conecta();
date_default_timezone_set('America/Los_Angeles');

$query="select * from activos";
$lista = mysqli_query($conexion,$query);

if (mysqli_num_rows($lista)==0)
{
        echo "<script>alert('NO Existe datos para desplegar!!');</script>";
        echo "<script>history.back()</script>";
        exit;
}
else
{
        // Forzar descarga como Word
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=Listado_Activos.doc");
        header("Content-Type: application/msword; charset=utf-8");

        echo "<html>";
        echo "<head><meta charset='utf-8'></head>";
        echo "<body>";
        echo "<h2 style='text-align:center;'>Listado De Activos</h2>";

        echo "<table border='1' cellspacing='0' cellpadding='5' style='width:100%; border-collapse:collapse;'>";

        echo "<tr style='background-color:#f2f2f2; font-weight:bold;'>
                <td width='50'>Id</td>
                <td width='200'>Descripcion</td>
                <td width='120'>Fecha</td>
                <td width='100'>Costo</td>
                <td width='100'>Status</td>
              </tr>";

        while ($row=mysqli_fetch_array($lista))
        {
                $id       = $row['ID_Activos'];
                $desc     = $row['descripcion'];
                $fecha    = $row['fecha'];
                $costo    = $row['costo'];
                $status   = $row['status'];

                echo "<tr>
                        <td>$id</td>
                        <td>$desc</td>
                        <td>$fecha</td>
                        <td>$costo</td>
                        <td>$status</td>
                      </tr>";
        }

        echo "</table>";
        echo "<p style='text-align:right;'><i>Generado el ".date("d-m-Y H:i:s")."</i></p>";
        echo "</body></html>";

        mysqli_close($conexion);
}
?>
