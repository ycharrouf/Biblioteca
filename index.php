<?php
include_once("./templates/templateUser.php");
include_once("./templates/templateBibliotecario.php");
include_once("./templates/templateAdmin.php");
session_start();
if (!file_exists("./conexion/config.php")) {
    echo "<h1>No existe el archivo de configuración con la base de datos</h1>";
    echo "<a href=\"./install/formularioDatos.php\">Para crear la conexion pulse aquí<a>";
}
if (!isset($_SESSION["rol"])) {
    header("Location: ./auten/auten.php");
}
if($_SESSION["rol"] == "admin"){
    include_once("./templates/templateAdmin.php");
    $header = $headerAdmin;
    $footer = $footerAdmin;
}
if($_SESSION["rol"] == "user"){
    include_once("./templates/templateUser.php");
    $header = $headerUser;
    $footer = $footerUser;
}
if($_SESSION["rol"] == "bibliotecario"){
    include_once("./templates/templateBibliotecario.php");
    $header = $headerBibliotecario;
    $footer = $footerBibliotecario;
}
echo $_SESSION["rol"];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca 1.0</title>
    <link rel="stylesheet" href="../ejercicios.css">
</head>

<body>
    <!-- <h1>Bienvenido a la biblioteca 1.0</h1>
    <nav id='menu'>
        <a href="./acciones/listadoLibros.php">Listado de libros</a>
        <a href="./acciones/listadoAutores.php">Listado de autores</a>
        <a href="./acciones/insertarLibro.php">Insertar libro</a>
        <a href="./acciones/insertarLibro.php">Insertar autores</a>
    </nav> -->
    <?php echo $header; ?>
    <?php echo $footer; ?>
</body>

</html>