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
            "password" => password_hash($formData["password"], PASSWORD_BCRYPT)
        ];
    }
}