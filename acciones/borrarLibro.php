<?php
require_once '../auten/seguridad.php';
session_start();
//comprobamos los roles
if(comprobarUsuario()){
    header("Location: ../index.php");
}
if(isset($_GET['id'])){
    require_once '../conexion/conexion.php';
    require_once '../clases/libros.php';
    $libros = new libros(conexion::getConn(),'libros');
    $libros->borrar($_GET['id']);
    header('Location: listadoLibros.php');
}
?>