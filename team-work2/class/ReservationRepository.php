<?php

class ReservationRepository
{
    private $conn = null;

    public function __construct($conn)
    {
        $this->conn = $conn;

    }

    public function getAllReservations()
    {
        $stmt2 = $this->conn->prepare("SET NAMES 'utf8'");
        $stmt2->execute();

        $stmt = $this->conn->prepare("select idreservation, name_surname, email, phone, c.idcar as carid, b.name as brandname, m.name as modelname from reservation join car c on reservation.car_idcar = c.idcar join model m on c.model_idmodel = m.idmodel and c.model_brand_idbrand = m.brand_idbrand join brand b on m.brand_idbrand = b.idbrand;");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getCarId($idCar)
    {
        $stmt2 = $this->conn->prepare("SET NAMES 'utf8'");
        $stmt2->execute();

        $stmt = $this->conn->prepare("Select car_idcar from reservation where idreservation =:idCar");
        $stmt->bindParam(':idCar', $idCar);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function insertReservation($idCar, $name, $email, $phone)
    {
        $stmt2 = $this->conn->prepare("SET NAMES 'utf8'");
        $stmt2->execute();

        $stmt = $this->conn->prepare("INSERT INTO reservation (car_idcar, name_surname, email, phone)
    VALUES (:idCar, :name, :email, :phone)");
        $stmt->bindParam(':idCar', $idCar);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone', $phone);
        $stmt->execute();
    }

    public function removeById($id)
    {
        $stmt = $this->conn->prepare("DELETE from reservation where idreservation=:id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function updateReservation($idReservation, $idCar, $name, $email, $phone)
    {
        $stmt2 = $this->conn->prepare("SET NAMES 'utf8'");
        $stmt2->execute();

        $stmt = $this->conn->prepare("UPDATE reservation SET car_idcar=:idCar, name_surname=:name, email=:email, phone=:phone where idreservation=:idReservation");
        $stmt->bindParam(':idReservation', $idReservation);
        $stmt->bindParam(':idCar', $idCar);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone', $phone);
        $stmt->execute();
    }
}