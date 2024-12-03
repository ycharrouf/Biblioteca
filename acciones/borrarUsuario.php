<?php
if (isset($_GET['id'])) {
    require_once '../conexion/conexion.php';
    require_once '../clases/user.php';
    $user = new user(conexion::getConn(), 'usuarios');
    try {
        $user->borrar($_GET['id']);
        header('Location: listadoUsuarios.php');
    } catch (PDOException $e) {
        echo'Error al borrar el usuario: '. $e->getMessage();
        echo'<a href="listadoUsuario.php">clic para volver al listado de usuarios</a>';
    }
}