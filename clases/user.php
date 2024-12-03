<?php
class user
{
    protected $conexion;
    protected $tabla;
    public function __construct(PDO $conex, $tabla)
    {
        $this->conexion = $conex;
        $this->tabla = $tabla;

    }
    public function añadir($nombre, $login, $password)
    {
        $sql = "INSERT INTO $this->tabla (login, nombre, salt, password) VALUES (:login, :nombre, :salt, :password)";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':login', $login);
        //password
        $salt = random_int(10000000, 99999999);
        $password = hash("sha256", $password . $salt);
        //añadimos
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':salt', $salt);

        try {
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error al insertar usuario: " . $e->getMessage();
        }
        return $this->conexion->lastInsertId();
    }
    public function borrar($id)
    {
        $sql = "DELETE FROM $this->tabla WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
    public function actualizar($id, $nombre, $login, $password)
    {
        $sql = "UPDATE $this->tabla SET nombre = :nombre, login = :login, password = :password, salt = :salt WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':login', $login);
        //password
        $salt = random_int(10000000, 99999999);
        $password = hash("sha256", $password . $salt);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':salt', $salt);
        $stmt->bindParam(':id', $id);
        try {
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error al actualizar el usuario: " . $e->getMessage();
        }
    }
    public function listar()
    {
        $sql = "SELECT * FROM $this->tabla";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function getUserId($id)
    {
        $sql = "SELECT * FROM $this->tabla WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }
    public function getUserByUserName($UserName)
    {
        $sql = "SELECT * FROM $this->tabla WHERE login = :login";
        $stmt = $this->conexion->prepare($sql);

        $stmt->bindParam(':login', $UserName);
        $stmt->execute();

        return $stmt->fetch();
    }
}
?>