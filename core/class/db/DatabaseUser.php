<?php

class DatabaseUser {
    private $pdo;
    public function __construct($pdo) {
        $this->pdo = $pdo;        
    }
    public function getFormatedRegisterFromData (array $formData) {
        return [
            "firstName" => $formData["firstName"],
            "lastName" => $formData["lastName"],
            "userName" => $formData["userName"],
            "email" => $formData["email"],
            "password" => hash("sha512", $formData["password"])
        ];
    }
    public function login (array $formData) {
        $password = hash("sha512", $formData["password"]);
        $mail = $formData["email"];

        $sql = "select * from user where password=:pass and email=:mail";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":pass", $password);
        $stmt->bindValue(":mail", $mail);
        $stmt->execute();
        
        if ($stmt->rowCount() > 0) 
            return true;
        else 
            return false;
    }
}