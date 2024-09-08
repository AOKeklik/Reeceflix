<?php 

class Video {
    private $pdo, $sqlData, $entity;

    public function __construct($pdo, $input) {
        $this->pdo = $pdo;

        if (is_array($input))
            $this->sqlData = $input;
        else {
            $sql = "select * from videos where id=:videoId";
            $stmt = $this->pdo->prepare ($sql);
            $stmt->bindValue (":videoId", $input, PDO::PARAM_INT);
            $stmt->execute();
            $this->sqlData = $stmt->fetch(PDO::FETCH_ASSOC);
        }

        $this->entity = new Entity($pdo, $this->sqlData["entityId"]);
    }

    public function getId () {
        return $this->sqlData["id"];
    }
    public function getTitle () {
        return $this->sqlData["title"];
    }
    public function getDesc () {
        return $this->sqlData["description"];
    }
    public function getFilePath () {
        return $this->sqlData["filePath"];
    }
    public function getThumbnail () {
        return $this->entity->getThumbnail();
    }
    public function getEpisodeNumber () {
        return $this->sqlData["episode"];
    }
}