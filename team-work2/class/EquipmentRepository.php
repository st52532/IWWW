<?php

class EquipmentRepository
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

    public function getAllEquipment() {
        $stmt2 = $this->conn->prepare("SET NAMES 'utf8'");
        $stmt2->execute();

        $stmt = $this->conn->prepare("SELECT * FROM equipment order by value");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getEquipmentById($id) {
        $stmt2 = $this->conn->prepare("SET NAMES 'utf8'");
        $stmt2->execute();

        $stmt = $this->conn->prepare("SELECT e.value FROM car_has_equipment join equipment e on car_has_equipment.equipment_idequipment = e.idequipment where car_idcar=:id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}