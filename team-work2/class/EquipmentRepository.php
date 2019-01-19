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

    public function getAllEquipment()
    {
        $stmt2 = $this->conn->prepare("SET NAMES 'utf8'");
        $stmt2->execute();

        $stmt = $this->conn->prepare("SELECT * FROM equipment order by value");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getEquipmentById($id)
    {
        $stmt2 = $this->conn->prepare("SET NAMES 'utf8'");
        $stmt2->execute();

        $stmt = $this->conn->prepare("SELECT e.value, e.idequipment as id FROM car_has_equipment join equipment e on car_has_equipment.equipment_idequipment = e.idequipment where car_idcar=:id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function insertCarEquipment($equipment_idequipment, $car_idcar)
    {
        $stmt2 = $this->conn->prepare("SET NAMES 'utf8'");
        $stmt2->execute();

        $stmt = $this->conn->prepare("INSERT INTO nova.car_has_equipment (car_idcar, equipment_idequipment) values (:car_idcar, :equipment_idequipment)");
        $stmt->bindParam(':car_idcar', $car_idcar);
        $stmt->bindParam(':equipment_idequipment', $equipment_idequipment);
        $stmt->execute();
    }

    public function delete($car_idcar)
    {
        $stmt = $this->conn->prepare("Delete from car_has_equipment where car_idcar =:car_idcar");
        $stmt->bindParam(':car_idcar', $car_idcar);
        $stmt->execute();
    }
}