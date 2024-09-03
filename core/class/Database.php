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
            echo "GetOneRand: ".$err->getMessage();
        }
    }
    public function getManyRand (string $table, int $limit=10, int $catId=null,) {
        try {
            $sql = "select * from $table";
            if (!is_null($catId)) $sql .= " where categoryId=:catId";
            $sql .= " order by rand() limit :limit";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(":limit", (int)$limit, PDO::PARAM_INT);
            if (!is_null($catId)) $stmt->bindValue(":catId", (int)$catId, PDO::PARAM_INT);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $results;
        } catch (PDOException $err) {
            echo "GetManyRand: ".$err->getMessage();
        }
    }
    public function getAll (string $table, array $rest=[]) {
        try {
            $order = $rest[0] ?? "asc";
            $limit = $rest[1] ?? null;
            $offset = $rest[2] ?? null;

            $sql = "select * from $table";

            switch(strtolower($order)) {
                case "desc": $sql .= " order by id desc"; break;
                default: $sql .= " order by id asc"; break;
            }
            
            if (!is_null($limit)) $sql .= " limit :limit";
            if (!is_null($offset)) $sql .= " offset :offset";

            $stmt = $this->pdo->prepare($sql);

            if (!is_null($limit)) $stmt->bindValue(":limit", (int)$limit, PDO::PARAM_INT);
            if (!is_null($offset)) $stmt->bindValue(":offset", (int)$offset, PDO::PARAM_INT);

            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $results;
        } catch (PDOException $err) {
            echo "GetAllData: ".$err->getMessage();
        }
    }
}