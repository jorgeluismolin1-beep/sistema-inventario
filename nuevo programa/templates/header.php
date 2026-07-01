<!-- Barra de navegación -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">


<!-- Contenedor -->
        <div class="container-fluid">
            <!-- Marca -->
            <a class="navbar-brand" href="#"> Tienda  </a>
            <!-- Botón de navegación para pantallas pequeñas -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>


            <!-- Menú de navegación -->
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Inicio</a>
                    </li>


                    <!-- Menú desplegable "Adultos" -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="index.php" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Usuario
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="libros.php">Usuario</a></li>
                            <li><a class="dropdown-item" href="alta_pizzas.php">Agregar Usuario </a></li>
                            <li><a class="dropdown-item" href="busca_pizzas.php">Modificar Usuario listado</a></li>

                        </ul>
                    </li>


                    <!-- Menú desplegable "Menu" -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Administrador
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="excel.php"  target="_blank">Excel</a></li>
                            <li><a class="dropdown-item" href="pdf.php" target="_blank">PDF</a></li>

                        </ul>
                    </li>


                    <!-- Menú desplegable de bebidas -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="index.php" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Empleado
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="agregar_bebidas.php">Agregar Empleado </a></li>
                            <li><a class="dropdown-item" href="busca_bebidas.php">Modificar Empleado  listado</a></li>
                        </ul>
                    </li>


                    <!-- Menú desplegable bebidas -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Producto
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="excel_bebidas.php"  target="_blank">Excel</a></li>
                            <li><a class="dropdown-item" href="pdf_bebidas.php" target="_blank">PDF</a></li>

                        </ul>
                    </li>


                 <!-- Menú desplegable Activos -->
                         <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="index.php" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Movimiento
                        </a>
                         <ul class="dropdown-menu">
                         <li><a class="dropdown-item" href="agregar_activos.php">Agregar Activo</a></li>
                         <li><a class="dropdown-item" href="busca_activos.php">Modificar Activo listado</a></li>
                        <li><a class="dropdown-item" href="busca_activos_habilitados.php">Habilitados</a></li>
                        <li><a class="dropdown-item" href="busca_activos_deshabilitados.php">Deshabilitados</a></li>


                    </ul>
                 </li>


                    <!-- Menú desplegable bebidas -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Reporte
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="excel_activos.php"  target="_blank">Excel</a></li>
                            <li><a class="dropdown-item" href="pdf_activos.php" target="_blank">PDF</a></li>
                        </ul>
                    </li>


                 <li class="nav-item">
                  <a class="nav-link text-navbar-dark" href="logout.php">Cerrar Sesion</a>
</li>



                </ul>
            </div>
        </div>
    </nav>


    <div class="container mb-7 scroll-banner">
        <div class="p-5 text-center bg-image rounded-3"
             style="background-image:url('templates/tienda2.jpg');
height:600px;
background-repeat:no-repeat;
background-size:cover;
background-position:center;">
                </div>
            </div>
        </div>
    </div>


