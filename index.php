<?php require_once("./include/header.php")?>

<?php
$userLoggedIn = $_SESSION["userLoggedIn"];

$displayPreview->displayHeroSection();
$displayCategory->displayCategoriesSection();

?>

<?php require_once("./include/footer.php")?>
