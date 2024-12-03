<?php
    if (isset($_POST["registro"])) {
        $nombre = $_POST["nombre"];
        $login = $_POST["login"];
        $pass = $_POST["pass"];

        include_once("../conexion/conexion.php");
        include_once("../clases/user.php");
        $user = new user(conexion::getConn(), "usuarios");
        $result = $user->insertar($nombre, $login, $pass, "user");
        if ($result) {
            $mensaje="Usuario registrado con éxito\n<a href='auten.php'>Login</a>";
        } else {
            $mensaje= "Error al registrar el usuario";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Registro Usuario</title>
</head>
<body>
    <h1>Registro de usuario</h1>
    <form action="registro.php" method="post">
        <fieldset>
            <legend>Rellene los campos</legend>
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre">
            <br>
            <label for="login">Login</label>
            <input type="text" name="login" id="login">
            <br>
            <label for="pass">Contraseña</label>
            <input type="password" name="pass" id="pass">
            <input type="submit" value="Registro" name="registro">
        </fieldset>
    </form>
    <?php
    echo $mensaje;
    ?>
</body>
</html>