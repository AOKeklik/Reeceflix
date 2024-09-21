<?php

class User {
    private $pdo,$sqlData;
    public function __construct($pdo, $input) {
        $this->pdo = $pdo;        
        
        if (is_array($input)) {
            $this->sqlData = $input;
        } else {
            try {
                $sql = "select * from users where email=:email";
                $stmt = $this->pdo->prepare ($sql);
                $stmt->bindValue (":email", $input);
                $stmt->execute ();
                $this->sqlData = $stmt->fetch (PDO::FETCH_ASSOC);
            } catch(PDOException $err) {
                echo "User: ".$err->getMessage ();
            }
        }
    }
    public function firstName () {
        return $this->sqlData["firstName"];
    }
    public function lastName () {
        return $this->sqlData["lastName"];
    }
    public function fullName () {
        return $this->sqlData["firstName"]." ".$this->sqlData["lastName"];
    }
    public function userName () {
        return $this->sqlData["userName"];
    }
    public function email () {
        return $this->sqlData["email"];
    }
    
}