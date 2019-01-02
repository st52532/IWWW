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

    public function getAllCars()
    {
        $stmt2 = $this->conn->prepare("SET NAMES 'utf8'");
        $stmt2->execute();

        $stmt = $this->conn->prepare("SELECT * FROM car_model_brand");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function insertCar($mileage, $year, $power, $gearbox, $fuel, $color, $price, $model_idmodel, $image, $folder)
    {
        $stmt2 = $this->conn->prepare("SET NAMES 'utf8'");
        $stmt2->execute();

        $stmt = $this->conn->prepare("INSERT INTO car (mileage,year,power,gearbox,fuel,color,price,model_idmodel,model_brand_idbrand,image,folder)
    VALUES (:mileage,:year,:power,:gearbox,:fuel,:color,:price,:model_idmodel,(SELECT brand_idbrand from model where idmodel=:model_idmodel),:image,:folder)");
        $stmt->bindParam(':mileage', $mileage);
        $stmt->bindParam(':year', $year);
        $stmt->bindParam(':power', $power);
        $stmt->bindParam(':gearbox', $gearbox);
        $stmt->bindParam(':fuel', $fuel);
        $stmt->bindParam(':color', $color);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':model_idmodel', $model_idmodel);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':folder', $folder);
        $stmt->execute();
    }

    public function getCarByParameter($idBrand, $idModel, $yearFrom, $yearTo, $mileageFrom, $mileageTo, $priceFrom, $priceTo)
    {
        $stmt2 = $this->conn->prepare("SET NAMES 'utf8'");
        $stmt2->execute();

        $stmt = $this->conn->prepare("select * from car_model_brand
where idbrand like :idbrand2
  and idmodel like :idmodel2
  and year between :yearFrom and :yearTo
  and mileage between :mileageFrom and :mileageTo
  and price between :priceFrom and :priceTo;");
        $stmt->bindParam(':idbrand2', $idBrand);
        $stmt->bindParam(':idmodel2', $idModel);

        $stmt->bindParam(':yearFrom', $yearFrom);
        $stmt->bindParam(':yearTo', $yearTo);

        $stmt->bindParam(':priceFrom', $priceFrom);
        $stmt->bindParam(':priceTo', $priceTo);

        $stmt->bindParam(':mileageFrom', $mileageFrom);
        $stmt->bindParam(':mileageTo', $mileageTo);

        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function removeById($id)
    {
        $stmt = $this->conn->prepare("DELETE from car where idcar=:id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function getCarById($id)
    {
        $stmt2 = $this->conn->prepare("SET NAMES 'utf8'");
        $stmt2->execute();

        $stmt = $this->conn->prepare("SELECT * FROM car_model_brand where id=:id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }
}