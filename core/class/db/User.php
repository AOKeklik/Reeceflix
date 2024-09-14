<?php

class User {
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
        try {
            $password = hash("sha512", $formData["password"]);
            $mail = $formData["email"];

            $sql = "select * from users where password=:pass and email=:mail";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(":pass", $password);
            $stmt->bindValue(":mail", $mail);
            $stmt->execute();
            
            if ($stmt->rowCount() > 0) 
                return true;
            else 
                return false;
        } catch (PDOException $err) {
            echo "Login: ".$err->getMessage();
        }
    }
    public function createUser ($formData) {
        $formData = $this->getFormatedRegisterFromData($formData);

        $sql = "insert into users ";
        $sql.= "(".implode(", ", array_keys($formData)).")";
        $sql.= "values";
        $sql.= "(:".implode(", :", array_keys($formData)).")";

        if ($stmt = $this->pdo->prepare($sql))
            foreach ($formData as $key=>$val)
                $stmt->bindValue (":".$key, $val);

        $stmt->execute ();
        return $this->pdo->lastInsertId();
    }
}