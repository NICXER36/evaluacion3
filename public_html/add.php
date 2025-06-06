<?php
/**
 * Archivo para agregar nuevos proyectos
 * Este archivo maneja el formulario y la lógica para agregar
 * nuevos proyectos al portafolio, incluyendo la subida de imágenes
 */

// Incluir archivos necesarios
include 'auth.php';  // Verificación de autenticación
include 'db.php';    // Conexión a la base de datos

// Procesar el formulario cuando se envía
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener y sanitizar los datos del formulario
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $url_github = $_POST['url_github'];
    $url_produccion = $_POST['url_produccion'];
    $categoria = $_POST['categoria'];

    // Procesar la imagen subida
    $imagen = $_FILES['imagen']['name'];
    $tmp = $_FILES['imagen']['tmp_name'];
    move_uploaded_file($tmp, "uploads/$imagen");

    // Insertar el nuevo proyecto en la base de datos
    $sql = "INSERT INTO proyectos (titulo, descripcion, url_github, url_produccion, imagen, categoria) 
            VALUES ('$titulo', '$descripcion', '$url_github', '$url_produccion', '$imagen', '$categoria')";

    $conn->query($sql);
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Agregar Proyecto</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <!-- Contenedor principal del formulario -->
    <div class="main-content">
        <h2>Agregar Nuevo Proyecto</h2>
        <!-- Formulario para agregar proyecto -->
        <form method="post" enctype="multipart/form-data">
            <!-- Campo de título -->
            <div class="form-group">
                <label for="titulo">Título</label>
                <input type="text" id="titulo" name="titulo" required>
            </div>
            <!-- Campo de descripción -->
            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea id="descripcion" name="descripcion" required></textarea>
            </div>
            <!-- Selector de categoría -->
            <div class="form-group">
                <label for="categoria">Categoría</label>
                <select id="categoria" name="categoria" required>
                    <option value="evaluacion">Evaluación</option>
                    <option value="taller">Taller</option>
                    <option value="autonoma">Tarea Autónoma</option>
                </select>
            </div>
            <!-- Campo para URL de GitHub -->
            <div class="form-group">
                <label for="url_github">URL GitHub</label>
                <input type="url" id="url_github" name="url_github">
            </div>
            <!-- Campo para URL de producción -->
            <div class="form-group">
                <label for="url_produccion">URL Producción</label>
                <input type="url" id="url_produccion" name="url_produccion">
            </div>
            <!-- Campo para subir imagen -->
            <div class="form-group">
                <label for="imagen">Imagen</label>
                <input type="file" id="imagen" name="imagen" required>
            </div>
            <!-- Botones de acción -->
            <button type="submit" class="submit-btn">Guardar Proyecto</button>
            <a href="index.php" class="cancel-btn">Cancelar</a>
        </form>
    </div>
</body>
</html>