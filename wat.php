<?php require_once("./includes/header.php")?>

<?php
if (!isset($_GET["id"]) || empty($_GET["id"])) {
    ErrorMessage::show("Invalid id number!");
}
$videoId = $_GET["id"];

$video = new Video ($pdo, $videoId);
$displayPreview = new DisplayPreview ($pdo, $userLoggedIn);

$video->updateIncreaseViews();
$displayPreview->displayGoback();
$displayPreview->displayWatchSection($video);
?>

<script>
    const VIDEO_ID = "<?php echo $video->getId()?>"
</script>

<?php require_once("./includes/footer.php")?>