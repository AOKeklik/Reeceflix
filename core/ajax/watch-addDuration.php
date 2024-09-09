<?php

require_once("../config.php");

try {

    if (isset ($_POST["videoId"]) && isset ($_POST["userMail"]))
        echo "hello";
    else {
        echo "Watch-Add-Duration: Error";
    }
} catch (ErrorException $err) {
    echo "Watch-Add-Duration: ".$err->getMessage();
}


?>