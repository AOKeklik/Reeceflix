<?php
include "config.php";
include "class/SiteConfig.php";
include "class/Constants.php";
include "class/Database.php";
include "class/FormValidator.php";

include "class/User.php";
include "class/PreviewProvider.php";

global $pdo;

$siteconfig = new SiteConfig($pdo);
$database = new Database($pdo);
$validator = new FormValidatior($pdo);
$user = new User($pdo);
$preview = new PreviewProvider($pdo);

define("BASE_URL", "http://localhost/Reeceflix/");