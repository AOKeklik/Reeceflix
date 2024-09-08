<?php
include "config.php";
include "class/SiteConfig.php";
include "class/Constants.php";

include "class/db/Entity.php";
include "class/db/Video.php";
include "class/db/Season.php";
include "class/db/DatabaseUser.php";
include "class/db/DatabaseEntity.php";
include "class/db/DatabaseVideo.php";

include "class/ErrorMessage.php";
include "class/FormValidator.php";

include "class/display/utilities.php";
include "class/display/DisplayPreview.php";
include "class/display/DisplayCategory.php";
include "class/display/DisplaySeason.php";

global $pdo;
global $userLoggedIn;

$siteconfig = new SiteConfig($pdo);
$validator = new FormValidatior($pdo);

$displayPreview = new DisplayPreview ($pdo, $userLoggedIn);
$displayCategory = new DisplayCategory ($pdo, $userLoggedIn);
$displaySeason = new DisplaySeason ($pdo, $userLoggedIn);

define("BASE_URL", "http://localhost/Reeceflix/");