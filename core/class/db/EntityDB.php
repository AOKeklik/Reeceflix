<?php

class EntityDB {
    static function getEntities ($pdo, $categoryId, $limit) {
        $sql = "SELECT * FROM entities ";

        if($categoryId != null) {
            $sql .= "WHERE categoryId=:categoryId ";
        }

        $sql .= "ORDER BY RAND() LIMIT :limit";
        $query = $pdo->prepare($sql);

        if($categoryId != null) {
            $query->bindValue(":categoryId", $categoryId);
        }

        $query->bindValue(":limit", $limit, PDO::PARAM_INT);
        $query->execute();

        $result = array();
        while($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $result[] = new Entity($pdo, $row);
        }

        return $result;
    }
    static function getRandomEntity ($pdo) {
        $entity = EntityDB::getEntities($pdo, null, 1);
        
        return $entity[0];
    }
    static function getRandomEntities ($pdo, $carId) {
        $entities = EntityDB::getEntities($pdo, $carId, 30);
        
        return $entities;
    }

}