<?php

class SaleRepository
{
    private $conn = null;

    public function __construct($conn)
    {
        $this->conn = $conn;

    }

    public function getAllSale()
    {
        $stmt2 = $this->conn->prepare("SET NAMES 'utf8'");
        $stmt2->execute();

        $stmt = $this->conn->prepare("select idsale,c.idcar as carid,b.name as brandname, m.name as modelname, c.price as price from sale join car c on sale.car_idcar = c.idcar join model m on c.model_idmodel = m.idmodel and c.model_brand_idbrand = m.brand_idbrand join brand b on m.brand_idbrand = b.idbrand");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function insertSale($id)
    {
        $stmt2 = $this->conn->prepare("SET NAMES 'utf8'");
        $stmt2->execute();

        $stmt = $this->conn->prepare("INSERT INTO sale (car_idcar)
    VALUES (:id)");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

}