<?php 

class Account {
    private $pdo,$errorArray = [];

    public function __construct ($pdo)  {
        $this->pdo = $pdo;
    }

    public function updateUser ($fn, $ln, $un, $un2, $em) {
        $this->validateFirstName($fn);
        $this->validateLastName($ln);
        $this->validateNewUserName($un, $un2, $em);

        if (empty ($this->errorArray)) {
            $sql = "update users set firstName=:fn,lastName=:ln,userName=:un where email=:em";
            $stmt = $this->pdo->prepare ($sql);
            $stmt->bindValue (":fn", $fn);
            $stmt->bindValue (":ln", $ln);
            $stmt->bindValue (":un", $un);
            $stmt->bindValue (":em", $em);
            return $stmt->execute ();
        }

        return false;
    }
    public function updatePassword ($op, $pw, $pw2, $em) {
        $this->validatePassword($pw, $pw2);
        $this->validateOldPassword($op, $em);

        if (empty ($this->errorArray)) {
            $sql = "update users set password=:np where email=:em";
            $stmt = $this->pdo->prepare ($sql);
            $stmt->bindValue(":np", hash("sha512", $pw));
            $stmt->bindValue(":em", $em);
            return $stmt->execute ();
        }

        return false;
    }

    public function validateFirstName ($fn) {
        if (strlen($fn) < 2 || strlen($fn) > 25) 
            array_push($this->errorArray, Constants::$FIRST_NAME_CHARACTERS);
    }
    public function validateLastName ($ln) {
        if (strlen($ln) < 2 || strlen($ln) > 25) 
            array_push($this->errorArray, Constants::$LAST_NAME_CHARACTERS);
    }
    public function validatePassword ($pw, $pw2) {
        if ($pw != $pw2) {
            array_push ($this->errorArray, Constants::$PASSWORD_MATCH);
            return;
        }
        if (strlen($pw) < 5 || strlen($pw) > 25) {
            array_push($this->errorArray, Constants::$PASSWORD_LENGTH);
            return;
        }
    }
    public function validateOldPassword ($op, $em) {
        $pw = hash("sha512", $op);
        $sql = "select * from users where password=:op and email=:em";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":op", $pw);
        $stmt->bindValue(":em", $em);
        $stmt->execute ();

        if ($stmt->rowCount () == 0) {
            array_push($this->errorArray, Constants::$PASSWORD_INCORRECT);
        }
    }
    public function validateNewUserName ($un, $un2, $em) {
        if (strlen($un) < 2 || strlen($un) > 25) {
            array_push($this->errorArray, Constants::$USER_NAME_CHARACTERS);
            return;
        }

        if ($un != $un2) {
            array_push($this->errorArray, Constants::$USER_NAME_MATCH);
            return;
        }


        $stmt = $this->pdo->prepare ("select * from users where userName=:un and email!=:em");
        $stmt->bindValue (":un", $un);
        $stmt->bindValue (":em", $em);
        $stmt->execute ();
        
        if ($stmt->rowCount () != 0)  
            array_push (self::$errorArray, Constants::$VALID_USER_NAME);

    }


    public function getFirstError () {
        if (!empty ($this->errorArray))
            return $this->errorArray[0];
    }
}