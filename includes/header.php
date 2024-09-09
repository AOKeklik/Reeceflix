<?php require_once("./core/load.php")?>
<?php
    if (!isset($_SESSION["userLoggedIn"]))
    header("Location: register.php");
    $userLoggedIn = $_SESSION["userLoggedIn"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php SiteConfig::getSiteTitle();?></title>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo BASE_URL?>assets/style/style.css">
</head>
<body>
    <script>
        const ROOT_DIR = "<?php echo BASE_URL?>"
        const USER_MAIL = "<?php echo $userLoggedIn?>"
    </script>

    <?php require_once("./includes/nav.php")?>