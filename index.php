<?php require_once("./includes/header.php")?>

<?php

$displayPreview = new DisplayPreview ($pdo, $userLoggedIn);
$displayCategory = new DisplayCategory ($pdo, $userLoggedIn);

$displayPreview->displayHeroSection();
$displayCategory->displayCategoriesSection();

?>

<?php require_once("./includes/footer.php")?>
