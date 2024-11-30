<?php
if (isset($_GET['id'])) {
    require_once '../conexion/conexion.php';
    require_once '../clases/autores.php';
    $autor = new autores(conexion::getConn(), 'autores');
    try {
        $autor->borrar($_GET['id']);
        header('Location: listadoAutores.php');
    } catch (PDOException $e) {
        echo'Error al borrar el autor: '. $e->getMessage();
        echo'<a href="listadoAutores.php">clic para volver al listado de autores</a>';
    }
}