<?php
session_start();
require_once("conexion.php");

// Si ya hay sesión activa, redirige al index
if (isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit;
}

// Procesar el formulario de login
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usuario = $_POST['username'];
    $clave   = $_POST['password'];

    // Validar usuario y contraseña en la BD
    $sql = "SELECT * FROM usuarios WHERE usuario='$usuario' AND clave='$clave'";

    $resultado = mysqli_query($conexion, $sql);

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        // Usuario válido → crear sesión
        $_SESSION['usuario'] = $usuario;
        $session_id = session_id();

        // Guardar el session_id en la BD
        $sql_update = "UPDATE usuarios SET session_id='$session_id' WHERE usuario='$usuario'";
        mysqli_query($conexion, $sql_update);


        header("Location: index.php");
        exit();
    } else {
        $error = "Usuario o contraseña incorrectos.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <style>
        body {
            background: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            width: 350px;
        }
        .login-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #444;
        }
    </style>
</head>
<body>
<div class="login-container">
    <h2>Iniciar Sesión</h2>
    <?php if (!empty($error)) : ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>
    <form action="" method="POST">
        <div class="mb-3">
            <label for="username" class="form-label">Usuario</label>
            <input type="text" id="username" name="username" class="form-control" placeholder="Ingresa tu usuario" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" id="password" name="password" class="form-control" placeholder="Ingresa tu contraseña" required minlength="3">
        </div>

        <button type="submit" class="btn btn-primary w-100">Entrar</button>
    </form>
</div>
</body>
</html>
