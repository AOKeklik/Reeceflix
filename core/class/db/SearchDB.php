<?php

class SearchDB {
    private $pdo,$username;
    public function __construct ($pdo, $username) {
        $this->pdo = $pdo;        
        $this->username = $username;        
    }
    public function getResults ($inputText) {
        $entities = EntityDB::getSearchEntities ($this->pdo, $inputText);
        echo $this->getResultsHtml ($entities);
    }   
    public function getResultsHtml ($entities) {
        if (sizeof($entities) == 0)
            return;

        $entityHTML = "";

        foreach ($entities as $entity)
            $entityHTML .= $this->getEntitySquareHtml($entity);

        return <<<HTML
                <div class="flex flex-wrap gap-2 justify-center">
                    $entityHTML
                </div>
        
        HTML;
    }
    public function getEntitySquareHtml ($entity) {
        $id = $entity->getId();
        $thumbnail = BASE_URL.$entity->getThumbnail();
        $name = $entity->getName();
        
        return <<<HTML
            <a href="/Reeceflix/entity/$id" class="w-40">
                <img class="h-100%" src="$thumbnail" alt="$name">
            </a>
        HTML;
    }
}