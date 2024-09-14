<?php

class DisplayPreview {
    private $pdo, $usermail;

    public function __construct($pdo, $usermail) {
        $this->pdo = $pdo; 
        $this->usermail = $usermail; 
    }
    public function displayHeroSectionInCategoryPage ($categoryId) {
        $entityArray = EntityDB::getEntities ($this->pdo, $categoryId, 1);

        if (sizeof($entityArray) == 0) 
            ErrorMessage::show("No Tv Shows to Display..");

        $this->displayHeroSection($entityArray[0]);
    }
    public function displayHeroSectionInShowPage () {
        $entityArray = EntityDB::getTvShowEntities ($this->pdo, null, 1);

        if (sizeof($entityArray) == 0) 
            ErrorMessage::show("No Tv Shows to Display..");

        $this->displayHeroSection($entityArray[0]);
    }
    public function displayHeroSectionInMoviesPage () {
        $entityArray = EntityDB::getMovieEntities ($this->pdo, null, 1);

        if (sizeof($entityArray) == 0) 
            ErrorMessage::show("No Movies to Display..");

        $this->displayHeroSection($entityArray[0]);
    }
    public function displayHeroSection (object $entity=null) {
        try {
            if (is_null($entity)) 
                $entity = EntityDB::getRandomEntity($this->pdo);
                
            $id = $entity->getId();
            $name = $entity->getName();
            $preview = BASE_URL.$entity->getPreview();
            $thumbnail = BASE_URL.$entity->getThumbnail();

            $videoId = VideoDB::getEntityVideoForUser($this->pdo, $id, $this->usermail);
            $video = new Video ($this->pdo, $videoId);
            $info = $video->isMovie() ? "" : $video->getSesAndEps();
            $isInProgress = $video->isInProgress($this->usermail) ? "Continue to Watch" : "Play";

            echo <<<HTML
                <section id="hero-section" class="relative bg-gradinet-primary w-100% calc:h-100vh-12rem mb-10" data-videoid="$videoId">
                    <img id="hero-image" class="h-100% none opacity-05" src="$thumbnail" alt="" />
                    <video id="hero-video" class="h-100% opacity-05" autoplay muted >
                        <source src="$preview" type="video/mp4" />
                    </video>
                    <div class="text-white absolute y-50% -translate-50% md:-translateY-50% md:x-10 x-50% z-5">
                        <h1 class="text-5 md:text-7 mb-1">$name</h1>
                        <p class="mb-2 text-2.5">$info</p>
                        <div class="flex align-center gap-1">
                            <button id="hero-play-btn"  class="flex align-center gap-1 py-1 px-3 bg-gray-950-05 radius-03 hover:bg-white hover:text-gray-950">
                                <i class="bi bi-play-fill text-3"></i>
                                <span class="text-2">$isInProgress</span>
                            </button>
                            <button id="hero-mute-btn" class="py-1 px-3 bg-gray-950-05 radius-03 hover:bg-white hover:text-gray-950">
                                <i class="bi bi-volume-mute-fill text-3"></i>
                            </button>
                        </div>
                    </div>
                </section>
            HTML;
        } catch (ErrorException $err) {
            echo "CreatePreviewVideo: ".$err->getMessage();
        }
    }
    public function displayWatchSection (object $video=null) {
        try {                            
            $id = $video->getId();
            $title = $video->getTitle();
            $filePath = BASE_URL.$video->getFilePath();

            $upNextVideo = VideoDB::getUpNextVideo ($this->pdo, $video);

            echo <<<HTML
                <section id="watch-section" class="relative w-100% h-100vh">
                    <video id="watch-video" class="h-100%" controls autoplay>
                        <source src="$filePath" type="video/mp4" />
                    </video>
                    <a onclick="window.history.back(); return false;" id="watch-goback" class="text-white absolute xy-0 z-5 flex align-center gap-3 text-3 text-white bg-gray-950-05 w-100% p-3 pointer">
                        <i class="bi bi-arrow-left"></i>
                        <span>$title</span>
                    </a>
                    <div id="watch-upnext" style="display: none;" class="bg-gray-950-05 text-white absolute y-50% -translate-50% md:-translateY-50% md:x-10 x-50% z-5 p-2">
                        <p class="text-2.5">Up Next:</p>
                        <h1 class="text-5 md:text-7 mb-1">{$upNextVideo->getTitle()}</h1>
                        <p class="mb-2 text-2.5">Episode {$upNextVideo->getSeasonNumber()}, Episode {$upNextVideo->getEpisodeNumber()}</p>
                        <div class="flex align-center gap-1">
                            <button data-id="{$upNextVideo->getId()}" id="watch-play-btn"  class="flex align-center gap-1 py-1 px-3 bg-gray-950-05 radius-03 hover:bg-white hover:text-gray-950">
                                <i class="bi bi-play-fill text-3"></i>
                                <span class="text-2">Play</span>
                            </button>
                            <button id="watch-replay-btn" class="py-1 px-3 bg-gray-950-05 radius-03 hover:bg-white hover:text-gray-950">
                                <i class="bi bi-arrow-clockwise text-3"></i>
                                <span class="text-2">Replay</span>
                            </button>
                        </div>
                    </div>
                </section>
            HTML;
        } catch (ErrorException $err) {
            echo "CreatePreviewVideo: ".$err->getMessage();
        }
    }
    public function displayGoback() {        
        echo <<<HTML
            <nav aria-label="goback">
                <ul class="goback">
                    <li class="goback-item active"><a href="" onclick="window.history.back(); return false;">
                        <i class="bi bi-arrow-left"></i>
                        <span>Go Back</span>
                    </a></li>
                </ul>
            </nav>
        HTML;
    }
    public function displayBreadcrumb() {
        $currentUrl = $_SERVER['REQUEST_URI'];

        $urlParts = array_filter(explode("/", trim($currentUrl, "/")));

        $filteredArray = array_filter($urlParts, function($value) {
            return !is_numeric($value);
        });
        
        $breadcrumb = '<nav aria-label="breadcrumb">';
        $breadcrumb .= '<ul class="breadcrumb">';
        $breadcrumb .= '<li class="breadcrumb-item"><a href="/Reeceflix/">Home</a></li>';
        
        $path = "";
        for ($i = 0; $i < count($filteredArray); $i++) {
            $path .= "/" . $filteredArray[$i];
            
            if (strpos($filteredArray[$i], "Reeceflix") !== false) continue;

            if ($i < count($filteredArray) - 1) {
                $breadcrumb .= '<li class="breadcrumb-item"><a href="' . $path . '">' . ucfirst($urlParts[$i]) . '</a></li>';
            } else {
                $breadcrumb .= '<li class="breadcrumb-item active" aria-current="page">' . ucfirst($urlParts[$i]) . '</li>';
            }

        }

        $breadcrumb .= '</ul>';
        $breadcrumb .= '</nav>';
        
        echo $breadcrumb;
    }
}