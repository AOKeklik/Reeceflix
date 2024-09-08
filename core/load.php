<?php
include "config.php";
include "class/SiteConfig.php";
include "class/Constants.php";

include "class/db/User.php";
include "class/db/Entity.php";
include "class/db/EntityDB.php";
include "class/db/Video.php";
include "class/db/Season.php";

include "class/ErrorMessage.php";
include "class/FormValidator.php";

include "class/display/utilities.php";
include "class/display/DisplayPreview.php";
include "class/display/DisplayCategory.php";
include "class/display/DisplaySeason.php";

global $pdo;

$siteconfig = new SiteConfig($pdo);
$validator = new FormValidatior($pdo);



define("BASE_URL", "http://localhost/Reeceflix/");