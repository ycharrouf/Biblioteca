<?php
session_start();
    if(isset($_POST["enviar"])){
        //incluimos las clases y guardamos los campos para el login
        include_once("../conexion/conexion.php");
        include_once("../clases/user.php");
        include_once("funcionesAut.php");
        $userLogin = $_POST["login"];
        $userPass = $_POST["pass"];

        //Comprobamos que el usuario existe en la base de datos.
        if(login($userLogin, $userPass)){
            //Obtenemos el rol del usuario
            $classuser = new user(conexion::getConn(), "usuarios");
            $user = $classuser->getUserByUserName($userLogin);
            //guardamos en la sesion
            $_SESSION["rol"]= $user["rol"];
            header("Location: ../index.php");
        }else{
            header("Location: ./errorAuth/errorAuth.php");
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Usuario</title>
</head>
<body>
    <h1>Login del usuario</h1>
    <form action="auten.php" method="post">
        <fieldset>
            <legend>Introduce los datos de Sesión</legend>
            <label for="login">Nombre de usuario</label>
            <input type="text" name="login">
            <label for="pass">Password</label>
            <input type="password" name="pass" id="pass">
            <input type="submit" value="Enviar" name="enviar">
        </fieldset>
        <a href="./registro.php">Aquí para registrarte.</a>
    </form>
</body>
</html>