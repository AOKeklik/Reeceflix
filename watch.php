<?php require_once("./include/header.php")?>

<?php

if (!isset($_GET["id"]) || empty($_GET["id"])) {
    ErrorMessage::show("Invalid id number!");
}
$videoId = $_GET["id"];
$video = new Video ($pdo, $videoId);
