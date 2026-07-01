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
<?php
 
//conexcion a la BD
include("cone.php");
$conexion = Conecta();
date_default_timezone_set('America/Los_Angeles');
$query = "SELECT * FROM activos WHERE status=1 ORDER BY descripcion";
$lista = mysqli_query($conexion,$query);

if (mysqli_num_rows($lista)==0)//condiciono para saber si no hay resultados
{
        echo "<script>alert('NO Existe datos para desplegar!!');</script>";
        echo "<script>history.back()</script>";
        exit;
}
else
{            

        // lista activos
        require('fpdf.php');
        class PDF extends FPDF
        {
            // Cabecera de página
            function Header()
            {
                // imagenes a desplegar en los lados    
                $this->Image("templates/R.jpg",10,8,33);
                $this->Image("templates/R.jpg",150,8,33);
                    $this->Ln(4);

                $this->SetFont('Helvetica','B',8.5);
                $this->Ln(4);
                // Título
                $this->Cell(0,6,'Pizza Pizza',0,0,'C');
                $this->Ln(5);
                $this->Cell(0,6,'Listado De Activos ',0,0,'C');
                $this->Ln(5);

                $this->SetFont('Helvetica','B',8);

                $this->Cell(10,10,'Id ');
                $this->Cell(50,10,'Descripcion');
                $this->Cell(40,10,'Fecha');
                $this->Cell(30,10,'Costo');
                $this->Cell(30,10,'Status');
                $this->Ln(8);
            }

            // Pie de página
            function Footer()
            {
                // Posición: a 1,5 cm del final
                $this->SetY(-15);
                $this->SetFont('helvetica','I',8);
                $this->cell(160,10,date("d-m-Y H:i:s"));
                $this->ln(4);
            }
        }

        // Creación del objeto de la clase heredada
        $pdf = new PDF('P','mm','A4'); 
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('helvetica','',6);

        //Consulta de tablas
        while ($row=mysqli_fetch_array($lista))
        {
                $id       = $row['ID_Activos'];
                $desc     = $row['descripcion'];
                $fecha    = $row['fecha'];
                $costo    = $row['costo'];
                $status   = $row['status'];

                // Imprime detalle del query
                $pdf->SetFont('Arial','',8);
                $pdf->Cell(10,10,$id,2,0);
                $pdf->Cell(50,10,$desc,2,0);
                $pdf->Cell(40,10,$fecha,2,0);
                $pdf->Cell(30,10,$costo,2,0);
                $pdf->Cell(30,10,$status,2,0);
                $pdf->ln(5);
        }

        $pdf->Output();    
        mysqli_close($conexion);  
}
?>
