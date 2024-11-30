<?php
if(isset($_GET['id'])){
    require_once '../conexion/conexion.php';
    require_once '../clases/libros.php';
    $libros = new libros(conexion::getConn(),'libros');
    $libros->borrar($_GET['id']);
    header('Location: listadoLibros.php');
}
?>