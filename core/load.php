<?php
include "config.php";
include "class/SiteConfig.php";
include "class/Constants.php";

include "class/db/User.php";
include "class/db/Account.php";
include "class/db/Entity.php";
include "class/db/Video.php";
include "class/db/Season.php";
include "class/db/UserDB.php";
include "class/db/EntityDB.php";
include "class/db/VideoDB.php";
include "class/db/SearchDB.php";

include "class/ErrorMessage.php";
include "class/form/FormValidator.php";
include "class/form/FormSanitizer.php";

include "class/display/utilities.php";
include "class/display/DisplayPreview.php";
include "class/display/DisplayCategory.php";
include "class/display/DisplaySeason.php";

global $pdo;

$siteconfig = new SiteConfig($pdo);
$validator = new FormValidatior($pdo);
$account = new Account($pdo);



define("BASE_URL", "http://localhost/Reeceflix/");