<?php

require_once("../config.php");

try {

    if (isset ($_POST["videoId"]) && isset ($_POST["userMail"]) && isset ($_POST["duration"])) {
        $sql = "update videoprogress set progress=:duration,dateModified=now() where username=:userMail and videoId=:videoId";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":userMail", $_POST["userMail"], PDO::PARAM_STR);
        $stmt->bindValue(":videoId", $_POST["videoId"], PDO::PARAM_INT);
        $stmt->bindValue(":duration", $_POST["duration"], PDO::PARAM_STR);
        $stmt->execute();
      
        echo $stmt->rowCount();

    } else {
        echo "Watch-Update-Duration: Error";
    }
} catch (PDOException $err) {
    echo "Watch-Update-Duration: ".$err->getMessage();
}


?>