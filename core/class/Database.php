<?php

class Database {
    private $pdo;
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function create (string $table, array $data=[]) {
        try {
            $fields = implode(", ", array_keys($data));
            $placeholders = ":".implode(",:", array_keys($data));
            $sql = "insert into $table ($fields) values ($placeholders)";
            
            if ($stmt = $this->pdo->prepare($sql)) {

                foreach ($data as $name => $value)
                    $stmt->bindValue(":$name", $value);

                $stmt->execute();
                return $this->pdo->lastInsertId();
            }            
        } catch (PDOException $err) {
            echo "Createing error: ".$err->getMessage();
        }
    }
}