<?php

class Database {
    private $pdo;
    private $data;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    /* getter */
    public function get ($key) {
        if (!$this->data) 
            return "No Result!";
        else if ($key == "all")
            return $this->data;
        else
            return $this->data->$key;
    }
    /* crud */
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
    public function getOneById (string $table, int $id) {
        try {
            $sql = "select * from $table where id=:id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(":id", $id);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_OBJ);
            
            if ($result)
                $this->data = $result;

            return $this;
        } catch (PDOException $err) {
            echo "GetOneById: ".$err->getMessage();
        }
    }
    public function getOneRand (string $table) {
        try {
            $sql = "select * from $table order by rand() limit 1";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_OBJ);

            if ($result) 
                $this->data = $result;

            return $this;
        } catch (PDOException $err) {
            echo "GetRandomEntity: ".$err->getMessage();
        }
    }
}