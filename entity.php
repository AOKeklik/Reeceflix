<?php require_once("./include/header.php")?>

<?php

if (!isset($_GET["id"]) || empty($_GET["id"])) {
    ErrorMessage::show("Invalid id number!");
}
$entityId = $_GET["id"];
$displayPreview->displayHeroSection($entityId);
$displaySeason->displaySeasonsSection($entityId);
$displayCategory->displayCategorySection($entityId);

?>

<?php require_once("./include/footer.php")?>