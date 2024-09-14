<?php

require_once("../config.php");

try {

    if (isset ($_POST["videoId"]) && isset ($_POST["userMail"])) {
        $sql = "select * from videoprogress where username=:userMail and videoId=:videoId";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":userMail", $_POST["userMail"], PDO::PARAM_STR);
        $stmt->bindValue(":videoId", $_POST["videoId"], PDO::PARAM_INT);
        $stmt->execute();
      
        if ($stmt->rowCount() > 0) {
            // echo "Data has already been saved.";
            echo null;
        } else {
            $sql = "insert into videoprogress (username,videoId) values (:userMail,:videoId)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(":userMail", $_POST["userMail"], PDO::PARAM_STR);
            $stmt->bindValue(":videoId", (int)$_POST["videoId"], PDO::PARAM_INT);
            $stmt->execute();
            
            echo $pdo->lastInsertId ();
        }
    } else {
        echo "Watch-Add-Duration: Error";
    }
} catch (PDOException $err) {
    echo "Watch-Add-Duration: ".$err->getMessage();
}


?>