<?php 
class Entity {
    private $pdo, $sqlData;
    public function __construct($pdo, $input) {
        $this->pdo = $pdo;

        if(is_array($input)) {
            $this->sqlData = $input;
        }
        else {
            $sql = "select * from entities where id=:videoId";
            $stmt = $this->pdo->prepare ($sql);
            $stmt->bindValue (":videoId", $input, PDO::PARAM_INT);
            $stmt->execute();
            $this->sqlData = $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }
    public function getId() {
        return $this->sqlData["id"];
    }
    public function getCategoryId() {
        return $this->sqlData["categoryId"];
    }
    public function getName() {
        return $this->sqlData["name"];
    }
    public function getPreview() {
        return $this->sqlData["preview"];
    }
    public function getThumbnail() {
        return $this->sqlData["thumbnail"];
    }
}