<?php
/**
 * Created by PhpStorm.
 * User: Petr
 * Date: 12.11.2018
 * Time: 8:29
 */

class UserDao
{
private $conn = null;

public function __construct(PDO $conn)
{
    $this->conn=$conn;
}

public function getAllUsers(){
    $stmt=$this->conn->prepare("SELECT * from users");
    $stmt->execute();
    return $stmt->fetchAll();
}

public function getByEmail($mail){
    $stmt = $this->conn->prepare("Select * from users where email like concat('%' email '%')");
    $stmt->bindParam("email",$mail);
    $stmt->execute();
    return $stmt->fetchAll();
}
}