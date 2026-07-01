<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>pizzeria</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="assets/js/sweetalert.min.js"></script>
   <link rel="stylesheet" type="text/css" href="assets/js/sweetalert.css">
</head>
<body>
    <?php include('templates/header.php');?>
    <div class="container">
        <form action="agregar_pizza.php" method="post">
    <div class="mb-3">
        <label >Nombre_de_la_pizza</label>
        <imput type="text" class="form-control" name="pizza">
   </div>

<div class="mb-3">
    <label>Descripcion pizza</label>
    <textarea name="detalle"  row="3"></textarea>
</div> 
    </form>
    </div>
    
</body>
</html>
