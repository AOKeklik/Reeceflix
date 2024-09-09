<?php

class DisplayCategory {
    private $pdo, $usermail;

    public function __construct($pdo, $usermail) {
        $this->pdo = $pdo; 
        $this->usermail = $usermail; 
    }

    public function displayCategoriesSection () {
        $sql = "select * from categories";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        $html = "<section id='category-section'><div class='container'><div class='flex-column gap-3'>";

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
            $html .= $this->getCategoryHtml ($row, [null, true, true]);

        echo $html .= "</div></div></section>";
    }
    public function displayCategorySection (int $entityId) {
        $sql = "select * from categories where id=:id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":id", $entityId, PDO::PARAM_INT);
        $stmt->execute();

        $html = "<section id='category-section'><div class='container'><div class='flex-column gap-3'>";

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
            $html .= $this->getCategoryHtml ($row, ["You might also like", true, true]);

        echo $html .= "</div></div></section>";
    }
    public function getCategoryHtml ($row, array $rest=[]) {
        $title =  $rest[0] ?? $row["name"];
        $tvShow =  $rest[1] ?? false;
        $movies =  $rest[2] ?? false;

        $categoryId = $row["id"];

        if ($tvShow && $movies)
            $enitities = EntityDB::getRandomEntities($this->pdo, $categoryId);
        else if ($tvShow)
            echo "";
        else
            echo "";

        if (sizeof($enitities) == 0)
            return;

        $entityHTML = "";

        foreach ($enitities as $entity)
            $entityHTML .= $this->getEntitySquareHtml($entity);

       return <<<HTML
            <div class="js-slider flex-column sm:flex gap-2" role="product">
                <div class="w-30 bg-gray-100 flex-column justify-center">
                    <h3 class="text-3 mb-2 text-center">$title</h3>
                    <div class="js-slider-control bold">
                        <i class="bi bi-chevron-left text-3"></i>
                        <i class="bi bi-chevron-right text-3"></i>
                    </div>
                </div>
                <div class="js-slider-wrapper">
                    <div class="js-slider-slides gap-1">
                        $entityHTML
                    </div>
                </div>
            </div>
       
       HTML;
    }
    public function getEntitySquareHtml ($entity) {
        $id = $entity->getId();
        $thumbnail = BASE_URL.$entity->getThumbnail();
        $name = $entity->getName();
        
        return <<<HTML
            <a href="/Reeceflix/entity/$id" class="js-slider-slide">
                <div class="h-100%">
                    <img class="h-100%" src="$thumbnail" alt="$name">
                </div>
            </a>
        HTML;
    }
}