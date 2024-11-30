<?php
if (isset($_POST["enviar"])) {
    //guardamos los datos del formulario en variables
    $host = $_POST["DBHost"];
    $name = $_POST["DBName"];
    $user = $_POST["DBUser"];
    $pass = $_POST["DBPass"];

    //datos el usuario en un array

    //guardamos las variables en el archivo
    $archivo = "../conexion/config.php";
    $fp = fopen($archivo, "w");
    if ($fp) {

        $texto = <<<_texto
            <?php
            define('DB_SERVER', '$host');
            define('DB_USERNAME', '$user');
            define('DB_PASSWORD', '$pass');
            define('DB_DATABASE', '$name');
            define('DB_PORT', 3306);
            define('DB_PREFIX', ''); 
            define('DB_DRIVER', 'mysql');
            _texto;

        //Escribimos el texto en le archivo
        fwrite($fp, $texto);
        fclose($fp);
    }
    if (file_exists("../conexion/config.php")) {
        //pocedemos al install y también pasamos el array con los datos el usuario Adminitrador
        $mensaje = <<<_texto
        <h1>Se ha guardado correctamente los datos.</h1>\n
        <form action='./install.php' method='post'>
        <input type='hidden' name='adminName' value="{$_POST['adminName']}">
        <input type='hidden' name='adminUser' value="{$_POST['adminUser']}">
        <input type='hidden' name='adminPass' value="{$_POST['adminPass']}">
        <input type="submit" value="Enviar" name="enviar">
        </form>
        _texto;
    } else {
        $mensaje = "<h1>No se a podido guardar los cambios.</h1>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario para crear Tablas</title>
</head>
<form action="formularioDatos.php" method="post">
    <fieldset>
        <legend>Introduzca los datos de la base de datos</legend>
        <label for="DBHost">IP del server: </label>
        <input type="text" name="DBHost" required>
        <br>
        <label for="DBHost">Nombre de la base de datos: </label>
        <input type="text" name="DBName" required>
        <br>
        <label for="DBHost">Nombre de usuario: </label>
        <input type="text" name="DBUser" required>
        <br>
        <label for="DBHost">Contraseña: </label>
        <input type="password" name="DBPass" required>
        <br>
    </fieldset>
    <fieldset>
        <legend>Datos el administrador</legend>
        <label for="adminName">Nombre </label>
        <input type="text" name="adminName">
        <label for="adminUser">User</label>
        <input type="text" name="adminUser">
        <label for="adminPass">Password</label>
        <input type="password" name="adminPass">
    </fieldset>
    <input type="submit" value="Enviar" name="enviar">
</form>
<?php
echo $mensaje;
?>
</body>

</html>