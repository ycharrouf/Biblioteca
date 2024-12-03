<?php
include_once("../conexion/conexion.php");

//funcion para comprobar el el login del usuario existe en la base de datos

function login($login, $password){
    $conexion = new Conexion();
    $conex = $conexion::getConn();
    //Obtenemos las filas del usuario indicaro en el logín.
    $stmt = $conex->prepare("SELECT * FROM usuarios WHERE login = :login");
    $stmt->bindParam(":login", $login);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    //comprobamos que existe el login
    if(isset($result["login"])){
        //Contraseña de la base de datos con hash y salt
        $loginPassDB = $result["password"];
        //salt del usuario
        $loginSaltDB = $result["salt"];
        //hazemos un hash a la contraseña obtenida del formulario.
        $passwordFrom = hash("sha256", $password. $loginSaltDB);
        //comparalos los hash
        return hash_equals($loginPassDB, $passwordFrom);
    }else{
        return false;
    }
}