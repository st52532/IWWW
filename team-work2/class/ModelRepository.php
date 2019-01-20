<?php

class ModelRepository
{
    private $conn = null;

    /**
     * UserDao constructor.
     * @param PDO $conn
     */
    public function __construct($conn)
    {
        $this->conn = $conn;

    }

    public function getAllModel() {
        $stmt2 = $this->conn->prepare("SET NAMES 'utf8'");
        $stmt2->execute();

        $stmt = $this->conn->prepare("select * from brand_model");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function insertModel($name,$brand){
        $stmt2 = $this->conn->prepare("SET NAMES 'utf8'");
        $stmt2->execute();

        $stmt = $this->conn->prepare("INSERT INTO model (name,brand_idbrand) VALUES (:name2,:brand2)");
        $stmt->bindParam(':name2', $name);
        $stmt->bindParam(':brand2', $brand);
        $stmt->execute();
    }

    public function removeById($id){
        $stmt = $this->conn->prepare("DELETE from model where idmodel=:id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
    public function ifExist($name, $idbrand) {
        $stmt2 = $this->conn->prepare("SET NAMES 'utf8'");
        $stmt2->execute();

        $stmt = $this->conn->prepare("SELECT count(*) FROM model WHERE name =:name and brand_idbrand=:idbrand");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':idbrand', $idbrand);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function getIdByName($name) {
        $stmt2 = $this->conn->prepare("SET NAMES 'utf8'");
        $stmt2->execute();

        $stmt = $this->conn->prepare("select idbrand from brand where name =:name");
        $stmt->bindParam(':name', $name);
        $stmt->execute();
        return $stmt->fetch();
    }
}