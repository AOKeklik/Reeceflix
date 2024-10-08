<?php

class DisplaySeason {
    private $pdo, $usermail;

    public function __construct($pdo, $usermail) {
        $this->pdo = $pdo;
        $this->usermail = $usermail;
    }

    public function displaySeasonsSection (object $entity) {
        $seasons = $entity->getSeasons($this->pdo);
        
        $html = "<section id='season-section' class='mb-10'><div class='container'><div class='flex-column gap-3'>";

        foreach ($seasons as $season) {
            $seasonNum = $season->getSeasonNumber(); 

            $vidoHtml = "";

            foreach ($season->getVideos() as $vido) {
                $vidoHtml .= $this->getVideoSquareHtml ($vido);
            }

            $html .= $this->getSeasonHtml ($seasonNum, $vidoHtml);

        }
        $html .= "</section>";

        echo $html;
    }
    public function getSeasonHtml ($num, $vidosHtml) {
        return <<<HTML
            <div class="js-slider flex-column gap-2" role="product">
                <div class="w-30 bg-gray-100 flex justify-center align-center gap-1 p-1">
                    <h3 class="text-3 text-center">$num Season</h3>
                    <div class="js-slider-control bold">
                        <i class="js-slider-control-right bi bi-chevron-left text-3"></i>
                        <i class="js-slider-control-left bi bi-chevron-right text-3"></i>
                    </div>
                </div>
                <div class="js-slider-wrapper">
                    <div class="js-slider-slides gap-3">
                        $vidosHtml
                    </div>
                </div>
            </div>
        HTML;
    }
    public function getVideoSquareHtml ($video) {
        $id = $video->getId();
        $thumbnail = BASE_URL.$video->getThumbnail();
        $title = $video->getTitle();
        $desc = Utilities::limitString($video->getDesc(), 60);
        $hasSeen = $video->hasSeen($this->usermail) ? '<i class="bi bi-check-square-fill text-white text-5 absolute xy-0 p-1"></i>' : "";

        return <<<HTML
            <a href="/Reeceflix/watch/$id" class="js-slider-slide">
                <div class="relative">
                    $hasSeen
                    <img class="" src="$thumbnail" alt="$title">
                    <h3 class="py-1 text-2">$title</h3>
                    <p>$desc</p>
                </div>
            </a>
        HTML;
    }
}