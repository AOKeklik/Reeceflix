<?php

class CategoryConteiner {
    private $db;
    
    public function __construct($database) {
        $this->db = $database;
    }
    public function displayAllCategorySections () {
        $data = $this->db->getAll("category");

        $html = "<section id='category-section'><div class='container'><div class='flex-column gap-3'>";

        foreach ($data as $val) {
            $html .= $this->getCategoryHtml ($val, [null, true, true]);
        }

        echo $html .= "</div></div></section>";
    }
    public function getCategoryHtml (object $data, array $rest=[]) {
        $title =  $rest[0] ?? $data->name;
        $tvShow =  $rest[1] ?? false;
        $movies =  $rest[2] ?? false;

        $categoryId = $data->id;

        // $enitities = $this->db->getManyRand("entity", 3);

        if ($tvShow && $movies)
            $enitities = $this->db->getManyRand("entity", 10, $categoryId);
        else if ($tvShow)
            echo "";
        else
            echo "";

        // if (sizeof($enitities) == 0)
        //     return;

        $entityHTML = "";

        foreach ($enitities as $entity)
            $entityHTML .= PreviewProvider::displayEntitySquare($entity);

       return <<<HTML
            <div class="js-slider flex-column md:flex gap-2" role="product">
                <div class="w-30">
                    <h3 class="text-3 mb-2">$title</h3>
                    <div class="js-slider-control">
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
}