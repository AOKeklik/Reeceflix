<?php require_once("./include/header.php")?>

<?php
$userLoggedIn = $_SESSION["userLoggedIn"];

$previewProvider->displayHeroSection();
$categoryContainer->displayAllCategorySections();

?>

<?php require_once("./include/footer.php")?>
