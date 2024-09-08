<?php

class Database {
    private $pdo;
    public $data;

    public function __construct($pdo) {
        $this->pdo = $pdo;
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
    public function getOneRand (string $table, int $catId=null) {
        try {
            $sql = "select * from $table";
            if (!is_null($catId))
                $sql .= " where categoryId=:catId";
            $sql .= " order by rand() limit 1";
            $stmt = $this->pdo->prepare($sql);
            if (!is_null($catId))
                $stmt->bindValue(":catId", (int)$catId, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_OBJ);

            if ($result) 
                $this->data = $result;

            return $this;
        } catch (PDOException $err) {
            echo "GetOneRand: ".$err->getMessage();
        }
    }
    public function getManyRand (string $table, int $limit=10, int $catId=null) {
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
            $where = $rest["W"] ?? null;             /* [id,season] */
            $orderDirection = $rest["Od"] ?? "asc";  /* asc/desc */
            $orderBy = $rest["Ob"] ?? "id";         /* id,season */
            $limit = $rest["L"] ?? null;            /* limit */
            $offset = $rest["Lx"] ?? null;          /* limit end */

            $sql = "select * from $table";

            if (!is_null($where)) {
                $conditions = [];
                foreach ($where as $name => $val) 
                    array_push($conditions, "$name =:".$name);
                $sql .= " where ".implode(" and ", $conditions);
            }

            $sql .= " order by $orderBy $orderDirection";
            
            if (!is_null($limit)) $sql .= " limit :limit";
            if (!is_null($offset)) $sql .= " offset :offset";

            // echo $sql;

            $stmt = $this->pdo->prepare($sql);

            if (!is_null($limit)) $stmt->bindValue(":limit", (int)$limit, PDO::PARAM_INT);
            if (!is_null($offset)) $stmt->bindValue(":offset", (int)$offset, PDO::PARAM_INT);
            if (!is_null($where)) {
                foreach ($where as $name => $val) 
                    $stmt->bindValue(":$name", $val);
            }

            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $results;
        } catch (PDOException $err) {
            echo "GetAllData: ".$err->getMessage();
        }
    }
}