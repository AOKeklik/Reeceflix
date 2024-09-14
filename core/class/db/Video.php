<?php 

class Video {
    private $table = "videos";
    private $pdo, $sqlData, $entity;

    public function __construct($pdo, $input) {
        $this->pdo = $pdo;

        if (is_array($input))
            $this->sqlData = $input;
        else {
            $sql = "select * from $this->table where id=:videoId";
            $stmt = $this->pdo->prepare ($sql);
            $stmt->bindValue (":videoId", $input, PDO::PARAM_INT);
            $stmt->execute();
            $this->sqlData = $stmt->fetch(PDO::FETCH_ASSOC);
        }

        $this->entity = new Entity($pdo, $this->sqlData["entityId"]);
    }

    /* get */
    public function isMovie () {
        return $this->sqlData["isMovie"] == 1;
    }
    public function isInProgress ($username) {
        $sql = "select * from videoProgress where videoId=:videoId and username=:username";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue (":videoId", $this->getId());
        $stmt->bindValue (":username", $username);
        $stmt->execute ();

        return $stmt->rowCount() != 0;
    }
    public function hasSeen ($username) {
        $sql = "select * from videoProgress where videoId=:videoId and username=:username and finished=1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue (":videoId", $this->getId());
        $stmt->bindValue (":username", $username);
        $stmt->execute ();

        return $stmt->rowCount() != 0;
    }
    public function getId () {
        return $this->sqlData["id"];
    }
    public function getEntityId () {
        return $this->sqlData["entityId"];
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
    public function getSeasonNumber () {
        return $this->sqlData["season"];
    }
    public function getSesAndEps () {
        $ses = $this->getSeasonNumber ();
        $eps = $this->getEpisodeNumber ();
        return "Season ".$ses.", Episode ".$eps;
    }

    /* update */
    public function updateIncreaseViews () {
        $sql = "update $this->table set views=views+1 where id=:id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue (":id", $this->getId(), PDO::PARAM_INT);
        $stmt->execute();
    }
}