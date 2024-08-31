<?php
include "config.php";
include "class/Constants.php";
include "class/Database.php";
include "class/FormValidator.php";

include "class/User.php";

global $pdo;

$database = new Database($pdo);
$validator = new FormValidatior($pdo);
$user = new User($pdo);

define("BASE_URL", "http://localhost/Reeceflix/");