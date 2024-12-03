<?php
require_once '../auten/seguridad.php';
session_start();
//comprobamos los roles
if (comprobarUsuario() || comprobarBibliotecario()) {
    header("Location: ../index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de libros</title>
    <link rel="stylesheet" href="../ejercicios.css">
</head>

<body>
    <h1>Listado</h1>
    <nav id='menu'>
        <a href="listadoLibros.php">Listado de libros</a>
        <a href="insertarAutor.php">Listado de autores</a>
        <a href="insertarLibro.php">Insertar libro</a>
        <a href="insertarUsuario.php">Insertar Usuario</a>

    </nav>
    <table>
        <tr>
            <th>id</th>
            <th>Login</th>
            <th>Nombre</th>
            <th>Salt</th>
            <th>Rol</th>
        </tr>

        <?php
        require_once '../conexion/conexion.php';
        require_once '../clases/user.php';
        $ususarios = new user(conexion::getConn(), 'usuarios');
        $listado = $ususarios->listar();
        foreach ($listado as $user) {
            echo "<tr>";
            echo "<td>" . $user['id'] . "</td>";
            echo "<td>" . $user['login'] . "</td>";
            echo "<td>" . $user['Nombre'] . "</td>";
            echo "<td>" . $user['salt'] . "</td>";
            echo "<td>" . $user['rol'] . "</td>";
            echo "<td><a href='actualizarUsuario.php?id=" . $user['id'] . "'>Actualizar</a></td>";
            echo "<td><a href='borrarUsuario.php?id=" . $user['id'] . "'>Borrar</a></td>";
            echo "</tr>";
        }
        ?>
    </table>
    <footer>
        <a href="../auten/cerrarSesion.php">Cerrar Sesion</a>
        <p>Desarrollado por: <a href="">@mvaronc</a></p>
    </footer>
</body>