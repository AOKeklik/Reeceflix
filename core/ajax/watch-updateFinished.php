<?php

require_once("../config.php");

try {

    if (isset ($_POST["videoId"]) && isset ($_POST["userMail"])) {
        $sql = "update videoprogress set progress=:duration,finished=:finished,dateModified=now() where username=:userMail and videoId=:videoId";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":userMail", $_POST["userMail"], PDO::PARAM_STR);
        $stmt->bindValue(":videoId", (int)$_POST["videoId"], PDO::PARAM_INT);
        $stmt->bindValue(":duration", 0, PDO::PARAM_INT);
        $stmt->bindValue(":finished", 1, PDO::PARAM_INT);
        $stmt->execute();
      
        echo $stmt->rowCount();

    } else {
        echo "Watch-Update-Finished: Error";
    }
} catch (PDOException $err) {
    echo "Watch-Update-Finished: ".$err->getMessage();
}


?>