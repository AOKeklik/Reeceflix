<?php require_once("./includes/header.php")?>

<?php
$displayPreview = new DisplayPreview ($pdo, $userLoggedIn);

$displayPreview->displayBreadcrumb();
?>

    <div class="container">
        <h1>404</h1>
        <h2>Page Not Found</h2>
        <p>Sorry, the page you're looking for doesn't exist.</p>
        <p><a href="/Reeceflix/home">Go back to Home</a></p>
    </div>


<?php require_once("./includes/footer.php")?>