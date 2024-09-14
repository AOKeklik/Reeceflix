<?php 

class VideoDB {
    static function getUpNextVideo ($pdo, $currentVideo) {
        $sql = "select * from videos where entityId=:entityId and id!=:videoId and ((season=:season and episode>:episode) or season>:season) order by season, episode asc limit 1";

        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":entityId", $currentVideo->getEntityId());
        $stmt->bindValue(":videoId", $currentVideo->getId());
        $stmt->bindValue(":season", $currentVideo->getSeasonNumber());
        $stmt->bindValue(":episode", $currentVideo->getEpisodeNumber());
        $stmt->execute();

        if ($stmt->rowCount() == 0) {
            $sql = "select * from videos where season<=1 and episode<=1 and id!=:videoId order by views desc limit 1";

            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(":videoId", $currentVideo->getId());
            $stmt->execute();
        }

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return new Video($pdo, $row);
    }
    static function getEntityVideoForUser ($pdo, $entityId, $username) {
        $sql = "select videoId from videoprogress inner join videos on videoprogress.videoId=videos.id where videoprogress.username=:username and videos.entityId=:entityId order by videoprogress.dateModified desc limit 1";

        $stmt = $pdo->prepare($sql);
        $stmt->bindValue (":username", $username, PDO::PARAM_STR);
        $stmt->bindValue (":entityId", $entityId, PDO::PARAM_INT);
        $stmt->execute ();

        if ($stmt->rowCount() == 0) {
            $sql = "select id from videos where entityId=:entityId order by season,episode asc limit 1";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue (":entityId", $entityId, PDO::PARAM_INT);
            $stmt->execute ();

        }

        return $stmt->fetchColumn();
    }
}