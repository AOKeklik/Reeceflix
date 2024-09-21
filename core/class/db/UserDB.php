<?php

class UserDB {
    static function login ($pdo, array $formData) {
        try {
            $password = hash("sha512", $formData["password"]);
            $mail = $formData["email"];

            $sql = "select * from users where password=:pass and email=:mail";
            $stmt = $pdo->prepare($sql);
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
    static function createUser ($pdo, $formData) {
        $formData = self::getFormatedRegisterFromData($formData);

        $sql = "insert into users ";
        $sql.= "(".implode(", ", array_keys($formData)).")";
        $sql.= "values";
        $sql.= "(:".implode(", :", array_keys($formData)).")";

        if ($stmt = $pdo->prepare($sql))
            foreach ($formData as $key=>$val)
                $stmt->bindValue (":".$key, $val);

        $stmt->execute ();
        return $pdo->lastInsertId();
    }
    static function getFormatedRegisterFromData (array $formData) {
        return [
            "firstName" => $formData["firstName"],
            "lastName" => $formData["lastName"],
            "userName" => $formData["userName"],
            "email" => $formData["email"],
            "password" => hash("sha512", $formData["password"])
        ];
    }
}

?>