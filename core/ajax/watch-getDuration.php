<?php

require_once("../config.php");

try {

    if (isset ($_POST["videoId"]) && isset ($_POST["userMail"])) {
        $sql = "select progress from videoprogress where username=:userMail and videoId=:videoId";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":userMail", $_POST["userMail"], PDO::PARAM_STR);
        $stmt->bindValue(":videoId", (int)$_POST["videoId"], PDO::PARAM_INT);
        $stmt->execute();
      
        echo $stmt->fetchColumn();

    } else {
        echo "Watch-Update-Finished: Error";
    }
} catch (PDOException $err) {
    echo "Watch-Update-Finished: ".$err->getMessage();
}


?>