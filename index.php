<?php require_once("./includes/header.php")?>

<?php

$displayPreview = new DisplayPreview ($pdo, $userLoggedIn);
$displayCategory = new DisplayCategory ($pdo, $userLoggedIn);
$displaySeason = new DisplaySeason ($pdo, $userLoggedIn);

    if (!isset($_GET["page"])):
        header("Location: 404.php");
    else:
        if ($_GET["page"] == "home"): /* home page */

            $displayPreview->displayHeroSection();
            $displayCategory->displayCategoriesSection();

        else:

            $displayPreview->displayBreadcrumb();

            if ($_GET["page"] == "category"): /* category page */

                if (!isset($_GET["id"]) || empty($_GET["id"])) {
                    ErrorMessage::show("No id passed to page!");
                }

                $displayPreview->displayHeroSectionInCategoryPage($_GET["id"]);
                $displayCategory->displayCategorySection($_GET["id"]);

            elseif ($_GET["page"] == "entity"): /* entity page */

                if (!isset($_GET["id"]) || empty($_GET["id"])) {
                    ErrorMessage::show("Invalid id number!");
                }
                $entityId = $_GET["id"];
                $entity = new Entity ($pdo, $entityId);    
                
                $displayPreview->displayHeroSection($entity);
                $displaySeason->displaySeasonsSection($entity);
                $displayCategory->displayCategorySection($entity->getCategoryId(), "You might also like");

            elseif ($_GET["page"] == "watch"): /* watch page */

                if (!isset($_GET["id"]) || empty($_GET["id"])) {
                    ErrorMessage::show("Invalid id number!");
                }
                $videoId = $_GET["id"];
                
                $video = new Video ($pdo, $videoId);
                
                $video->updateIncreaseViews();
                $displayPreview->displayGoback();
                $displayPreview->displayWatchSection($video)?>
                
                <script>
                    const VIDEO_ID = "<?php echo $video->getId()?>"
                </script>

            <?php elseif ($_GET["page"] == "tv-shows"): /* tv shows page */

                $displayPreview->displayHeroSectionInShowPage();
                $displayCategory->displayTvShowsCategoriesSection();

            elseif ($_GET["page"] == "movies"): /* movies page */

                $displayPreview->displayHeroSectionInMoviesPage();
                $displayCategory->displayMoviesCategoriesSection();

            elseif ($_GET["page"] == "recently-added"): /* recently added page */

                echo "<h1>Recently Added</h1>";

            else:

                header("Location: 404.php");
            
    endif;endif;endif?>


<?php require_once("./includes/footer.php")?>