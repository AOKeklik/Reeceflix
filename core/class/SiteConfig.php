<?php
class SiteConfig {
    static function getSiteTitle () {
        $filename = basename($_SERVER["SCRIPT_FILENAME"], ".php");
        $title = ucfirst(str_replace("-", " ", $filename));
        $sitetitle = $title." | ".Constants::$TITLE;

        if ($filename === "index")
            $sitetitle = "Home | ".Constants::$TITLE;
        
        echo $sitetitle;
    }
}