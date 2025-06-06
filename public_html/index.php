<?php
/**
 * Archivo principal del portafolio
 * Este archivo muestra la página principal que contiene los proyectos
 * organizados por categorías: evaluaciones, talleres y tareas autónomas
 */

// Incluir archivos necesarios
include 'auth.php';  // Verificación de autenticación
include 'db.php';    // Conexión a la base de datos

// Inicializar arrays para almacenar proyectos por categoría
$evaluaciones = [];
$talleres = [];
$autonomas = [];

// Consultar todos los proyectos ordenados por fecha de creación
$result = $conn->query("SELECT * FROM proyectos ORDER BY created_at DESC");

// Clasificar los proyectos en sus respectivas categorías
while($row = $result->fetch_assoc()) {
    if ($row['categoria'] === 'evaluacion') {
        $evaluaciones[] = $row;
    } elseif ($row['categoria'] === 'taller') {
        $talleres[] = $row;
    } elseif ($row['categoria'] === 'autonoma') {
        $autonomas[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio • Nicolas Huenchullan</title>
    <!-- Enlaces a hojas de estilo -->
    <link rel="stylesheet" href="assets/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Encabezado con navegación -->
    <header class="main-header" style="padding: 1rem; background: var(--gradient); display: flex; justify-content: space-between; align-items: center;">
        <h1 style="color: var(--text-color); margin: 0;">Portafolio</h1>
        <nav>
            <a href="add.php" class="add-btn">+ Agregar Proyecto</a>
            <a href="logout.php" class="delete-btn">Cerrar sesión</a>
        </nav>
    </header>

    <!-- Contenido principal -->
    <main class="main-content">
        <!-- Sección de Evaluaciones -->
        <section>
            <h2>Evaluaciones</h2>
            <?php include 'carrusel.php'; mostrar_carrusel($evaluaciones, 'evaluaciones'); ?>
        </section>
        <!-- Sección de Talleres -->
        <section>
            <h2>Talleres</h2>
            <?php mostrar_carrusel($talleres, 'talleres'); ?>
        </section>
        <!-- Sección de Tareas Autónomas -->
        <section>
            <h2>Tareas Autónomas</h2>
            <?php mostrar_carrusel($autonomas, 'autonomas'); ?>
        </section>
    </main>

    <!-- Scripts necesarios -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>