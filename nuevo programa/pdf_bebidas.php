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
 

include("cone.php");
 $conexion = Conecta();
 date_default_timezone_set('America/Los_Angeles');
  $query="select * from bebidas";
    $lista = mysqli_query($conexion,$query);
 
            if (mysqli_num_rows($lista)==0)
                {
                        echo "<script>alert('NO Existe datos para desplegar!!');</script>";
                        echo "<script>history.back()</script>";
                        exit;
                }
            else
                {            
                                     
                                   
 
        
            require('fpdf.php');
            class PDF extends FPDF
            {
            
                function Header()
                       
                {
                  $this->Image("templates/R.jpg",10,8,33);
                  $this->Image("templates/R.jpg",150,8,33);
                     $this->Ln(4);

                    $this->SetFont('Helvetica','B',8.5);
                    $this->Ln(4);
                   
                    $this->Cell(0,6,'Bebidas',0,0,'C');
                    $this->Ln(5);
                    $this->Cell(0,6,'Listado De Bebidas ',0,0,'C');
                    $this->Ln(5);
                     
                                           
                        $this->SetFont('Helvetica','B',8);
                         
                   
                        $this->Cell(50,10,'Descripcion');                      
                        $this->Cell(30,10,'Tamano');
                        $this->Cell(20,10,'Stock');
                        $this->Cell(30,10,'Precio');
                        $this->Ln(8);
                        
                     
                     
                     
                }
 
           
                function Footer()
                {
                   
                    $this->SetY(-15);                    
                    $this->SetFont('helvetica','I',8);                  
                    $this->cell(160,10,date("d-m-Y H:i:s"));                    
                     
                    $this->ln(4);
                }
            }
 
     
           $pdf = new PDF('P','mm','A4'); $pdf->AliasNbPages();
           $pdf->AddPage();
           $pdf->SetFont('helvetica','',6);
           
           
           
            
                           
                           
                        while ($row=mysqli_fetch_array($lista))
                             {
                                                   
                                               
                                $descripcion=$row['descripcion'];
                                $tamano=$row['tamano'];
                                $stock=$row['stock'];
                                $precio=$row['precio'];
                                                
                                                 
                                                         
                                $pdf->SetFont('Arial','',8);
                                $pdf->Cell(50,10,$descripcion,2,0);
                                $pdf->Cell(30,10,$tamano,2,0);
                                $pdf->Cell(20,10,$stock,2,0);
                                $pdf->Cell(30,10,number_format($precio,2),2,0);
                                $pdf->ln(5);                
                        
                                   
                                }
                                    $pdf->Output();    
                        mysqli_close($conexion);  
                       
        }
?>
