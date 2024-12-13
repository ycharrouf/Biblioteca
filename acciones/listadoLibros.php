<?php
session_start();
require_once '../clases/libros.php';
require_once '../conexion/conexion.php';
require_once '../clases/autores.php';
require_once '../auten/seguridad.php';
require_once '../templates/templateAdmin.php';
require_once '../templates/templateBibliotecario.php';
require_once '../templates/templateUser.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de libros</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <h1>Listado</h1>
    <?php
    if(comprobarAdmin()){
        echo $menuAdmin;
    }else if(comprobarBibliotecario()){
        echo $menuBibliotecario;
    }else{
        echo $menuUser;
    }
    ?>
    <table>
        <tr>
            <th>Titulo</th>
            <th>Genero</th>
            <th>Autor</th>
            <th>Número de páginas</th>
            <th>Número de ejemplares</th>
        </tr>

        <?php
        $libros = new libros(conexion::getConn(), 'libros');
        $autores = new autores(conexion::getConn(), 'autores');
        $listado = $libros->listar();
        foreach ($listado as $libro) {
            $autor = $autores->getAutor($libro['idAutor']);
            echo "<tr>";
            echo "<td>" . $libro['Titulo'] . "</td>";
            echo "<td>" . $libro['Genero'] . "</td>";
            echo "<td>$autor[Nombre] $autor[Apellidos]</td>";
            echo "<td>" . $libro['NumeroPaginas'] . "</td>";
            echo "<td>" . $libro['NumeroEjemplares'] . "</td>";
            if (!comprobarUsuario()) {//si es un usuario no puede Actualizar o Borrar.
                echo "<td><a href='actualizarLibro.php?id=" . $libro['id'] . "'>Actualizar</a></td>";
                echo "<td><a href='borrarLibro.php?id=" . $libro['id'] . "'>Borrar</a></td>";
            }
            echo "</tr>";
        }
        ?>
    </table>
    <footer>
        <a href="../auten/cerrarSesion.php">Cerrar Sesion</a>
        <p>Desarrollado por: <a href="">@mvaronc</a></p>
    </footer>
</body>