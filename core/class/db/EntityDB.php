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
    static function getTvShowEntities ($pdo, $categoryId, $limit) {
        $sql = "SELECT distinct entities.id FROM entities inner join videos on entities.id=videos.entityId where videos.isMovie=0 ";

        if($categoryId != null) {
            $sql .= "and categoryId=:categoryId ";
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
            $result[] = new Entity($pdo, $row["id"]);
        }

        return $result;
    }
    static function getMovieEntities ($pdo, $categoryId, $limit) {
        $sql = "SELECT distinct entities.id FROM entities inner join videos on entities.id=videos.entityId where videos.isMovie=1 ";

        if($categoryId != null) {
            $sql .= "and categoryId=:categoryId ";
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
            $result[] = new Entity($pdo, $row["id"]);
        }

        return $result;
    }
    static function getRandomEntity ($pdo) {
        $entity = EntityDB::getEntities($pdo, null, 1);
        
        return $entity[0];
    }
}