<?php
$headerAdmin=<<<_header
<head>
    <h1>Bienvenido a la biblioteca 1.0</h1>
    <nav id='menu'>
        <a href="./acciones/listadoLibros.php">Listado de libros</a>
        <a href="./acciones/listadoAutores.php">Listado de autores</a>
        <a href="./acciones/listadoUsuarios.php">Listar usuarios</a>
        <a href="./acciones/insertarLibro.php">Insertar libro</a>
        <a href="./acciones/insertarAutor.php">Insertar autores</a>
        <a href="./acciones/insertarUsuario.php">Insertar Usuario</a>
    </nav>
</head>
_header;
$footerAdmin=<<<_footer
<footer>
    <p>
        <a href="./auten/cerrarSesion.php">Cerrar sesion</a>
        Desarrollado por: <a href="">@mvaronc</a>
    </p>
</footer>
_footer;
