<?php
session_start();
require_once '../auten/seguridad.php';
require_once '../clases/libros.php';
require_once '../conexion/conexion.php';
require_once '../clases/autores.php';
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
    <nav id='menu'>
    <?php
    if(comprobarAdmin()){
        echo $menuAdmin;
    }else if(comprobarBibliotecario()){
        echo $menuBibliotecario;
    }else{
        echo $menuUser;
    }
    ?>
        
    </nav>
    <table>
    
        <tr>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Pais</th>
        </tr>

        <?php
        $autores = new autores(conexion::getConn(), 'autores');
        $listado = $autores->listar();
        foreach ($listado as $autor) {
            echo "<tr>";
            echo "<td>" . $autor['Nombre'] . "</td>";
            echo "<td>" . $autor['Apellidos'] . "</td>";
            echo "<td>" . $autor['Pais'] . "</td>";
            if (!comprobarUsuario()) {
                echo "<td><a href='actualizarAutor.php?id=" . $autor['id'] . "'>Actualizar</a></td>";
                echo "<td><a href='borrarAutor.php?id=" . $autor['id'] . "'>Borrar</a></td>";
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