<?php

class CarRepository
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

    public function getAllCars() {
        $stmt2 = $this->conn->prepare("SET NAMES 'utf8'");
        $stmt2->execute();

        $stmt = $this->conn->prepare("SELECT * FROM car_model_brand");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function insertCar($mileage,$year,$power,$gearbox,$fuel,$color,$price,$model_idmodel){
        $stmt2 = $this->conn->prepare("SET NAMES 'utf8'");
        $stmt2->execute();

        $stmt = $this->conn->prepare("INSERT INTO car (mileage,year,power,gearbox,fuel,color,price,model_idmodel,model_brand_idbrand)
    VALUES (:mileage,:year,:power,:gearbox,:fuel,:color,:price,:model_idmodel,(SELECT brand_idbrand from model where idmodel=:model_idmodel))");
        $stmt->bindParam(':mileage', $mileage);
        $stmt->bindParam(':year', $year);
        $stmt->bindParam(':power', $power);
        $stmt->bindParam(':gearbox', $gearbox);
        $stmt->bindParam(':fuel', $fuel);
        $stmt->bindParam(':color', $color);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':model_idmodel', $model_idmodel);
        $stmt->execute();
    }
    public function getCarByParameter($mileage,$year,$power,$gearbox,$fuel,$color,$price,$model_idmodel){
        $stmt2 = $this->conn->prepare("SET NAMES 'utf8'");
        $stmt2->execute();

        $stmt = $this->conn->prepare("INSERT INTO car (mileage,year,power,gearbox,fuel,color,price,model_idmodel,model_brand_idbrand)
    VALUES (:mileage,:year,:power,:gearbox,:fuel,:color,:price,:model_idmodel,(SELECT brand_idbrand from model where idmodel=:model_idmodel))");
        $stmt->bindParam(':mileage', $mileage);
        $stmt->bindParam(':year', $year);
        $stmt->bindParam(':power', $power);
        $stmt->bindParam(':gearbox', $gearbox);
        $stmt->bindParam(':fuel', $fuel);
        $stmt->bindParam(':color', $color);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':model_idmodel', $model_idmodel);
        $stmt->execute();
    }
    public function removeById($id){
        $stmt = $this->conn->prepare("DELETE from car where idcar=:id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}