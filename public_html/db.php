/**
 * Archivo de configuración y conexión a la base de datos
 * Este archivo establece la conexión con la base de datos MySQL
 * utilizando los parámetros de conexión definidos
 */

<?php
// Parámetros de conexión a la base de datos
$host = "localhost";      // Servidor de la base de datos
$usuario = "admin";       // Usuario de la base de datos
$contrasena = "123456";   // Contraseña del usuario
$base_datos = "portafolio"; // Nombre de la base de datos

// Crear la conexión usando mysqli
$conn = new mysqli($host, $usuario, $contrasena, $base_datos);

// Verificar si hay error de conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>