<?php
/**
 * Archivo de inicio de sesión
 * Este archivo maneja la autenticación de usuarios
 * Permite a los usuarios iniciar sesión con sus credenciales
 */

// Iniciar sesión y conectar a la base de datos
session_start();
include 'db.php';

// Procesar el formulario cuando se envía
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener y sanitizar las credenciales
    $username = $_POST['username'];
    $password = md5($_POST['password']); // Encriptar la contraseña con MD5

    // Consultar la base de datos para verificar las credenciales
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    // Si se encuentra un usuario, iniciar sesión y redirigir
    if ($result->num_rows === 1) {
        $_SESSION['user'] = $username;
        header("Location: index.php");
    } else {
        $error = "Credenciales incorrectas";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <!-- Contenedor principal del formulario -->
    <div class="main-content">
        <h2>Iniciar Sesión</h2>
        
        <!-- Mostrar mensaje de error si existe -->
        <?php if(isset($error)): ?>
            <div class="error-message"><?= $error ?></div>
        <?php endif; ?>

        <!-- Formulario de inicio de sesión -->
        <form method="post">
            <!-- Campo de usuario -->
            <div class="form-group">
                <label for="username">Usuario</label>
                <input type="text" id="username" name="username" required>
            </div>
            <!-- Campo de contraseña -->
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" required>
            </div>
            <!-- Botones de acción -->
            <button type="submit" class="submit-btn">Iniciar Sesión</button>
            <a href="index.php" class="cancel-btn">Volver al inicio</a>
        </form>
    </div>
</body>
</html>