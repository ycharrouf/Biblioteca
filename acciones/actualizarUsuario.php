<?php
require_once '../conexion/conexion.php';
require_once '../clases/user.php';
$usuarios = new user(conexion::getConn(), 'usuarios');
$user;
if (isset($_GET['id'])) {
    $user = $usuarios->getUserById($_GET['id']);
}

if (isset($_POST['Actualizar'])) {
    $usuarios->actualizar($_POST['id'], $_POST['nombre'], $_POST['login'], $_POST['password'], $_POST['rol']);
    header('Location: listadoUsuarios.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar usuario</title>
    <link rel="stylesheet" href="../ejercicios.css">
</head>

<body>
    <h1>Actualizar Usuario</h1>
    <nav id='menu'>
        <a href="./listadoLibros.php">Listado de libros</a>
        <a href="./listadoAutores.php">Listado de autores</a>
        <a href="./insertarLibro.php">Insertar libro</a>
        <a href="./insertarAutor.php">Insertar autores</a>
    </nav>

    <form action="actualizarUsuario.php" method="post">
        <input type="hidden" name="id" value='<?php echo $user['id']; ?>'>
        <label for="titulo">Nombre</label>
        <input type="text" name="nombre" id="Nombre" value='<?php echo $user['Nombre']; ?>'>
        <label for="autor">Login</label>
        <input type="text" name="login" id="login" value='<?php echo $user['login']; ?>'>
        <label for="nPaginas">Password</label>
        <input type="password" name="password" id="password">
        <label for="rol">Rol</label>
        <select name="rol" id="rol">
            <option value="user">Usuario</option>
            <option value="admin">Administrador</option>
            <option value="bibliotecario">Bibliotecario</option>
        </select>

        <input type="submit" value="Actualizar" name="Actualizar">
    </form>
    <?php
    if (isset($mensaje))
        echo "<p class='error'>" . $mensaje . "</p>";
    ?>
    <footer>
        <p>Desarrollado por: <a href="">@mvaronc</a></p>
    </footer>

</body>

</html>