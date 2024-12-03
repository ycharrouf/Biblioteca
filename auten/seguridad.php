<?php
session_start();
//comprobamos los roles de la sesion(admin, user, bibliotecario).
function comprobarAdmin(){
    if(isset($_SESSION["rol"])){
        if($_SESSION["rol"] == "admin"){
            return true;
        }else{
            return false;
        }
    }else{
        return false;
    }
}
function comprobarBibliotecario(){
    if(isset($_SESSION["rol"])){
        if($_SESSION["rol"] == "bibliotecario"){
            return true;
        }else{
            return false;
        }
    }else{
        return false;
    }
}
function comprobarUsuario(){
    if(isset($_SESSION["rol"])){
        if($_SESSION["rol"] == "user"){
            return true;
        }else{
            return false;
        }
    }else{
        return false;
    }
}