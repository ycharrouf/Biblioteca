<?php
require_once '../auten/seguridad.php';
require_once '../templates/templateAdmin.php';
require_once '../templates/templateBibliotecario.php';
session_start();
//comprobamos los roles
if (comprobarUsuario()) {
    header("Location: ../index.php");
}
require_once '../clases/libros.php';
require_once '../conexion/conexion.php';
$libros = new libros(conexion::getConn(), 'libros');
if (isset($_POST['Insertar'])) {
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $genero = $_POST['genero'];
    $nPaginas = $_POST['nPaginas'];
    $nEjemplares = $_POST['nEjemplares'];
    $idLibro = $libros->insertar($titulo, $genero, $autor, $nPaginas, $nEjemplares);
    if ($idLibro) {
        header('Location: listadoLibros.php');
    } else {
        $mensaje = "Error al insertar el libro" .
            "<br>" . conexion::getConn()->errorInfo()[2];
    }
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar Libro</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <h1>Insertar libro</h1>
    <?php
    if(comprobarAdmin()){
        echo $menuAdmin;
    }else{
        echo $menuBibliotecario;
    }
    ?>
    <form action="insertarLibro.php" method="post">
        <label for="titulo">Título</label>
        <input type="text" name="titulo" id="titulo">
        <label for="autor">Autor</label>
        <select id="autor" name="autor" style="display: inline;">
            <?php
            require_once '../clases/autores.php';
            $autores = new autores(conexion::getConn(), 'autores');
            $listado = $autores->listar();
            foreach ($listado as $autor) {
                echo "<option value='" . $autor['id'] . "'>" . $autor['Nombre'] . " " . $autor['Apellidos'] . "</option>";
            }
            ?>
        </select><button style="display:inline;"><a href="insertarAutor.php">*</a></button>
        <label for="genero">Genero</label>
        <select id="genero" name="genero">
            <option value="Narrativa">Narrativa</option>
            <option value="Lírica">Lírica</option>
            <option value="Teatro">Teatro</option>
            <option value="Científico-Técnico">Científico-Técnico</option>
        </select>

        <label for="nPaginas">Número de páginas</label>
        <input type="number" name="nPaginas" id="nPaginas">
        <label for="nEjemplares">Número de ejemplares</label>
        <input type="number" name="nEjemplares" id="nEjemplares">
        <input type="submit" name="Insertar" value="Insertar">

    </form>
    <?php
    if (isset($mensaje))
        echo "<p class='error'>" . $mensaje . "</p>";
    ?>
    <footer>
        <a href="../auten/cerrarSesion.php">Cerrar Sesion</a>
        <p>Desarrollado por: <a href="">@mvaronc</a></p>
    </footer>

</body>

</html>