<?php
require_once '../auten/seguridad.php';
session_start();
//comprobamos los roles
if (comprobarUsuario() || comprobarBibliotecario()) {
    header("Location: ../index.php");
}
require_once '../clases/user.php';
require_once '../conexion/conexion.php';
$usuarios = new user(conexion::getConn(), 'usuarios');
if (isset($_POST['Insertar'])) {
    $nombre = $_POST['nombre'];
    $login = $_POST['login'];
    $password = $_POST['password'];
    $idUser = $usuarios->insertar($nombre, $login, $password, "user");
    if ($idUser) {
        header('Location: listadoUsuarios.php');
    } else {
        $mensaje = "Error al insertar el autor" .
            "<br>" . conexion::getConn()->errorInfo()[2];
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar Usuario</title>
    <link rel="stylesheet" href="../ejercicios.css">
</head>

<body>
    <h1>Insertar autor</h1>
    <nav id='menu'>
        <a href="listadoLibros.php">Listado de libros</a>
        <a href="listadoAutores.php">Listado de autores</a>
        <a href="insertarLibro.php">Insertar libro</a>
    </nav>
    <form action="insertarUsuario.php" method="post">
        <label for="login">Login</label>
        <input type="text" name="login" id="login">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre">
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
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