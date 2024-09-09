<?php require_once("./includes/header.php")?>

<?php
if (!isset($_GET["id"]) || empty($_GET["id"])) {
    ErrorMessage::show("Invalid id number!");
}
$entityId = $_GET["id"];
$entity = new Entity ($pdo, $entityId);

$displayPreview = new DisplayPreview ($pdo, $userLoggedIn);
$displaySeason = new DisplaySeason ($pdo, $userLoggedIn);
$displayCategory = new DisplayCategory ($pdo, $userLoggedIn);


$displayPreview->displayGoback();
$displayPreview->displayHeroSection($entity);
$displaySeason->displaySeasonsSection($entity);
$displayCategory->displayCategorySection($entity->getCategoryId());

?>

<?php require_once("./includes/footer.php")?>