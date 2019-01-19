<?php

class SpecEquipmentRepository
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

        $stmt = $this->conn->prepare("SELECT * FROM specific_equipment order by name");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function insertEquipment($idcar,$idequip,$value){
        $stmt2 = $this->conn->prepare("SET NAMES 'utf8'");
        $stmt2->execute();

        $stmt = $this->conn->prepare("INSERT INTO car_has_specific_equipment (car_idcar, specific_equipment_idspecific_equipment, value) VALUES (:idcar,:idequip,:value)");
        $stmt->bindParam(':idcar', $idcar);
        $stmt->bindParam(':idequip', $idequip);
        $stmt->bindParam(':value', $value);
        $stmt->execute();
    }

    public function getEquipmentById($id) {
        $stmt2 = $this->conn->prepare("SET NAMES 'utf8'");
        $stmt2->execute();

        $stmt = $this->conn->prepare("select se.name as name, se.idspecific_equipment as id, car_has_specific_equipment.value as value from car_has_specific_equipment join specific_equipment se on car_has_specific_equipment.specific_equipment_idspecific_equipment = se.idspecific_equipment where car_idcar=:id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function delete($car_idcar)
    {
        $stmt = $this->conn->prepare("Delete from car_has_specific_equipment where car_idcar =:car_idcar");
        $stmt->bindParam(':car_idcar', $car_idcar);
        $stmt->execute();
    }
}