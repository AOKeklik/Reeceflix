<?php

class PreviewProvider {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;        
    }
    public function displayHeroSection ($entity=null) {
        try {
            if (is_null($entity)) return null;
            $id = $entity->get("id");
            $name = $entity->get("name");
            $preview = $entity->get("preview");
            $thumbnail = $entity->get("thumbnail");

            echo <<<HTML
                <section id="hero-section" class="p-2 relative bg-gradinet-primary w-100% calc:h-100vh-12rem">
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
}