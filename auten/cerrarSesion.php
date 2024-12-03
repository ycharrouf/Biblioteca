<?php
//Archivo para cerrar la sesión
session_start();
if(isset($_SESSION["rol"])){
    session_destroy();
    echo "Sesión cerrada correctamente";
    header("Location: ../auten/auten.php");
} else {
    echo "No hay sesión activa";
    header("Location: ../auten/auten.php");
}