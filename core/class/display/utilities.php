<?php 

class Utilities {
    static function limitString ($str, $limit = 30) {
        if (strlen ($str) > $limit)
            return substr($str, 0, $limit) . "...";

        return $str;
    }
}