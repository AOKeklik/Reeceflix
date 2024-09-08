<?php

class DatabaseVideo {    
    static function getSeasons ($pdo, $entityId) {
        $sql = "select * from videos where entityId=:id and isMovie=0 order by season, episode asc";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":id", $entityId, PDO::PARAM_INT);
        $stmt->execute();

        $seasons = [];
        $videos = [];
        $currentSeason = null;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            
            if (!is_null($currentSeason) && $currentSeason != $row["season"]) {
                $seasons[] = new Season ($currentSeason, $videos);
                $videos = [];
            }

            $currentSeason = $row["season"];
            $videos[] = new Video ($pdo, $row);
        }

        if (sizeof($videos) != 0)
            $seasons[] = new Season ($currentSeason, $videos);

        return $seasons;
    }
}