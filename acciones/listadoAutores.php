

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
  
    </nav>
<table>
    <tr>
        <th>Nombre</th>
        <th>Apellidos</th>
        <th>Pais</th>
    </tr>

    <?php
    require_once '../clases/libros.php';
    require_once '../conexion/conexion.php';
    require_once '../clases/autores.php';
    $autores = new autores(conexion::getConn(), 'autores');
    $listado = $autores->listar();
    foreach($listado as $autor){
        echo "<tr>";
        echo "<td>".$autor['Nombre']."</td>";
        echo "<td>".$autor['Apellidos']."</td>";
        echo "<td>".$autor['Pais']."</td>";
        echo "<td><a href='actualizarAutor.php?id=".$autor['id']."'>Actualizar</a></td>";///No funciona implementar
        echo "<td><a href='borrarAutor.php?id=".$autor['id']."'>Borrar</a></td>";///No funciona implementar
        echo "</tr>";
    }
    ?>
</table>
<footer>
    <p>Desarrollado por: <a href="">@mvaronc</a></p>    
</footer>
</body>
