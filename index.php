<?php
if (!file_exists("./conexion/config.php")) {
    header("Location: ./install/formularioDatos.php");
}else{
    include_once("./templates/templateUser.php");
    include_once("./templates/templateBibliotecario.php");
    include_once("./templates/templateAdmin.php");
    session_start();
    if (!isset($_SESSION["rol"])) {
        header("Location: ./auten/auten.php");
    }
    
    //Dependiendo del rol, asignamos un header y footer correspondiente.
    if($_SESSION["rol"] == "admin"){
        include_once("./templates/templateAdmin.php");
        $header = $headerAdmin;
        $footer = $footerAdmin;
    }
    //en caso de que sea usuario como solo puede ver los libros, redirección al listadoLibros.php
    if($_SESSION["rol"] == "user"){
        header("Location: ./acciones/listadoLibros.php");    
    }
    if($_SESSION["rol"] == "bibliotecario"){
        include_once("./templates/templateBibliotecario.php");
        $header = $headerBibliotecario;
        $footer = $footerBibliotecario;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca 1.0</title>
    <link rel="stylesheet" href="../ejercicios.css">
</head>
<body>
    <?php echo $header; ?>
    <?php echo $footer; ?>
</body>
</html>