<?php

class BrandRepository
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

    public function getAllBrands() {
        $stmt2 = $this->conn->prepare("SET NAMES 'utf8'");
        $stmt2->execute();

        $stmt = $this->conn->prepare("SELECT * FROM brand order by name");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function insertBrand($name){
        $stmt2 = $this->conn->prepare("SET NAMES 'utf8'");
        $stmt2->execute();

        $stmt = $this->conn->prepare("INSERT INTO brand (name)
    VALUES (:name)");
        $stmt->bindParam(':name', $name);
        $stmt->execute();
    }

    public function removeById($id){
        $stmt = $this->conn->prepare("DELETE from brand where idbrand=:id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function getBrandById($id) {
        $stmt2 = $this->conn->prepare("SET NAMES 'utf8'");
        $stmt2->execute();

        $stmt = $this->conn->prepare("SELECT * FROM brand where idbrand=:id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function update($idbrand, $name){
        $stmt2 = $this->conn->prepare("SET NAMES 'utf8'");
        $stmt2->execute();

        $stmt = $this->conn->prepare(" UPDATE brand SET name=:name where idbrand=:idbrand");
        $stmt->bindParam(':idbrand', $idbrand);
        $stmt->bindParam(':name', $name);
        $stmt->execute();
    }
}