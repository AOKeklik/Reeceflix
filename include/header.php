<?php require_once("./core/load.php")?>
<?php
    if (!isset($_SESSION["userLoggedIn"]))
    header("Location: register.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php SiteConfig::getSiteTitle();?></title>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet" href="./assets/style/style.css">
</head>
<body>
    <?php require_once("./include/nav.php")?>