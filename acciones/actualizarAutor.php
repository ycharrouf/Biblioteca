<?php
require_once '../conexion/conexion.php';
require_once '../clases/autores.php';
$autores = new autores(conexion::getConn(), 'autores');
if (isset($_GET['id'])) {
    $autor = $autores->getAutor($_GET['id']);
}

$autor = $autores->getAutor($_GET['id']);
if (isset($_POST['Actualizar'])) {
    $autores->actualizar($_POST['id'], $_POST['Nombre'], $_POST['Apellidos'], $_POST['Pais']);
    header('Location: listadoAutores.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Autor</title>
    <link rel="stylesheet" href="../ejercicios.css">
</head>

<body>
    <h1>Actualizar Autor</h1>
    <nav id='menu'>
        <a href="./listadoLibros.php">Listado de libros</a>
        <a href="./listadoAutores.php">Listado de autores</a>
        <a href="./insertarLibro.php">Insertar libro</a>
        <a href="./insertarAutor.php">Insertar autores</a>
    </nav>

    <form action="actualizarAutor.php" method="post">
        <input type="hidden" name="id" value='<?php echo $autor['id']; ?>'>
        <label for="titulo">Nombre</label>
        <input type="text" name="Nombre" id="Nombre" value='<?php echo $autor['Nombre']; ?>'>
        <label for="autor">Apellidos</label>
        <input type="text" name="Apellidos" id="Apellidos" value='<?php echo $autor['Apellidos']; ?>'>
        <label for="nPaginas">Pais</label>
        <input type="text" name="Pais" id="Pais" value='<?php echo $autor['Pais']; ?>'>
        <input type="submit" value="Actualizar" name="Actualizar">
    </form>
    <?php
    if (isset($mensaje))
        echo "<p class='error'>" . $mensaje . "</p>";
    ?>
    <footer>
        <p>Desarrollado por: <a href="">@mvaronc</a></p>
    </footer>

</body>

</html>