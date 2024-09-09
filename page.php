<?php require_once("./includes/header.php")?>

<?php 
$displayPreview = new DisplayPreview ($pdo, $userLoggedIn);

$displayPreview->displayBreadcrumb();
?>

<h1><?php echo $_GET["page"]?></h1>


<?php require_once("./includes/footer.php")?>