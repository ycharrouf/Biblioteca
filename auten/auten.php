<?php
    if(isset($_POST["enviar"])){
        include_once("../conexion/conexion.php");
        include_once("../clases/user.php");
        $userLogin = $_POST["login"];
        $userPass = $_POST["pass"];

        $conexion = new conexion();
        $user = new user($conexion, "usuarios");
        if($user->login($userLogin, $userPass)){
            session_start();
            $nowUser = $user->getUserByUserName($userLogin);
            $_SESSION['login'] = $nowUser["Login"];
            $_SESSION['nombre'] = $nowUser["Name"];
            header("Location: ../index.php");
        }else{
            header("Location: ./auten.php");
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
    </form>
</body>
</html>