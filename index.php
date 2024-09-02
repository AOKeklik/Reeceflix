<?php require_once("./include/header.php")?>

<?php
$userLoggedIn = $_SESSION["userLoggedIn"];

$data = $database->getOneRand("entity");
$preview->displayHeroSection($data);

?>

<?php require_once("./include/footer.php")?>
