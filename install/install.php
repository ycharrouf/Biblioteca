<?php
///Este archivo crear la conexion y crear la bases de datos.
include_once("../conexion/conexion.php");
$conexion = conexion::getConn();
echo "obtiene la conexion";
//variable con sentencia sql para crear la tabla de autores.
$tablaAutor = <<<_autor
        CREATE TABLE autores (
        id INT AUTO_INCREMENT PRIMARY KEY,
        Nombre VARCHAR(255) NOT NULL,
        Apellidos VARCHAR(255) NOT NULL,
        Pais VARCHAR(100) NOT NULL
        );
        _autor;

//variable con sentencia sql para crear la tabla de libros.
$tablaLibro = <<<_libro
        CREATE TABLE libros (
        id INT AUTO_INCREMENT PRIMARY KEY,
        Titulo VARCHAR(255) NOT NULL,
        Genero VARCHAR(100) NOT NULL,
        idAutor INT NOT NULL,
        NumeroPaginas INT NOT NULL,
        NumeroEjemplares INT NOT NULL,
        FOREIGN KEY (idAutor) REFERENCES autores(id)
        );
        _libro;

//tabla de usuarios
$usuarios = <<<_user
        CREATE TABLE usuarios (
        id INT AUTO_INCREMENT PRIMARY KEY,  
        login VARCHAR(255) NOT NULL UNIQUE,
        Nombre VARCHAR(255) NOT NULL,
        salt VARCHAR(255) NOT NULL,
        password VARCHAR(255) NOT NULL,
        rol ENUM('admin', 'user') NOT NULL
        );
        _user;

$paso = false;

//Crea la tabla autores
$stmtAutor = $conexion->prepare($tablaAutor);
try {
    $stmtAutor->execute();
    $paso = true;
} catch (PDOException $e) {
    echo "Error al intentar crear la tabla autor: " . $e->getMessage();
    $paso = false;
}

//crear la tabla libro 
$stmtLibro = $conexion->prepare($tablaLibro);
try {
    $stmtLibro->execute();
    $paso = true;
} catch (PDOException $e) {
    echo "Error al intentar crear la tabla libro: " . $e->getMessage();
    $paso = false;
}

//crear la tabla usuarios 
$stmtUsuarios = $conexion->prepare($usuarios);
try {
    $stmtUsuarios->execute();
    $paso = true;
} catch (PDOException $e) {
    echo "Error al intentar crear la tabla libro: " . $e->getMessage();
    $paso = false;
}

//crear el usuario administrador
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recibimos los datos enviados por POST
    $adminName = $_POST['adminName'];
    $adminUser = $_POST['adminUser'];
    $adminPass = $_POST['adminPass'];
    //Creamos el salt y hasheamso la contraseña
    $salt = random_int(10000000, 99999999);
    $hasPass = hash("sha256", $pass . $salt);

    $user = "INSERT INTO usuarios (login, Nombre, salt, password, rol) VALUES (:login, :Nombre, :salt, :password, 'admin')";
    $stmtUser = $conexion->prepare($user);
    $stmtUser->bindParam(':login', $adminUser);
    $stmtUser->bindParam(':Nombre', $adminName);
    $stmtUser->bindParam(':salt', $salt);
    $stmtUser->bindParam(':password', $hasPass);

    try {
        $stmtUser->execute();
        $paso = true;
    } catch (PDOException $e) {
        echo "Error al intentar crear la tabla libro: " . $e->getMessage();
        $paso = false;
    }
}
if ($paso) {
    echo "<h1>La instalacion se a hecho correctamente.</h1>";
    echo "<a href=\"../index.php\">Clic aquí para volver a la página principal</a>";
} else {
    echo "<h1>La instalacion no se a podido completar. Por favor rellene los datos del formulario correctamente</h1>";
    echo "<a href=\"./formularioDatos.php\">Clic aquí para volver a la página principal</a>";
}
