<?php

class DisplayPreview {
    private $pdo, $usermail;

    public function __construct($pdo, $usermail) {
        $this->pdo = $pdo; 
        $this->usermail = $pdo; 
    }
    public function displayHeroSection (object $entity=null) {
        try {
            if (is_null($entity)) 
                $entity = EntityDB::getRandomEntity($this->pdo);
                
            $id = $entity->getId();
            $name = $entity->getName();
            $preview = BASE_URL.$entity->getPreview();
            $thumbnail = BASE_URL.$entity->getThumbnail();

            echo <<<HTML
                <section id="hero-section" class="relative bg-gradinet-primary w-100% calc:h-100vh-12rem mb-10">
                    <img id="hero-image" class="h-100% none opacity-05" src="$thumbnail" alt="" />
                    <video id="hero-video" class="h-100% opacity-05" autoplay muted >
                        <source src="$preview" type="video/mp4" />
                    </video>
                    <div class="text-white absolute y-50% -translate-50% md:-translateY-50% md:x-10 x-50% z-5">
                        <h1 class="text-5 md:text-7 mb-1">$name</h1>
                        <p class="mb-2 text-2.5">Session 1, Episode 1</p>
                        <div class="flex align-center gap-1">
                            <button id="hero-play-btn"  class="flex align-center gap-1 py-1 px-3 bg-gray-950-05 radius-03 hover:bg-white hover:text-gray-950">
                                <i class="bi bi-play-fill text-3"></i>
                                <span class="text-2">Play</span>
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

            echo <<<HTML
                <section id="watch-section" class="relative w-100% h-100vh">
                    <video id="watch-video" class="h-100%" controls autoplay>
                        <source src="$filePath" type="video/mp4" />
                    </video>
                    <div id="watch-goback" class="text-white absolute xy-0 z-5 flex align-center gap-3 text-3 text-white bg-gray-950-05 w-100% p-3 pointer">
                        <i class="bi bi-arrow-left"></i>
                        <span>Go Back</span>
                    </div>
                    <div class="text-white absolute y-50% -translate-50% md:-translateY-50% md:x-10 x-50% z-5">
                        <h1 class="text-5 md:text-7 mb-1">$title</h1>
                        <p class="mb-2 text-2.5">Session 1, Episode 1</p>
                        <div class="flex align-center gap-1">
                            <button id="watch-play-btn"  class="flex align-center gap-1 py-1 px-3 bg-gray-950-05 radius-03 hover:bg-white hover:text-gray-950">
                                <i class="bi bi-play-fill text-3"></i>
                                <span class="text-2">Play</span>
                            </button>
                            <button id="watch-mute-btn" class="py-1 px-3 bg-gray-950-05 radius-03 hover:bg-white hover:text-gray-950">
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
    function displayGoback() {        
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
    function displayBreadcrumb() {
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