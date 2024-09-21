<?php

class FormSanitizer {
    static function sanitizeFromString ($inputText) {
        $inputText = strip_tags($inputText);
        $inputText = str_replace(" ", "", $inputText);
        $inputText = strtolower($inputText);
        // $inputText = ucfirst($inputText);
        return $inputText;
    }
    static function sanitizeFromUsername ($inputText) {
        $inputText = strip_tags($inputText);
        $inputText = str_replace(" ","",$inputText);
        return $inputText;
    }
    static function sanitizeFromPassword ($inputText) {
        $inputText = strip_tags($inputText);
        return $inputText;
    }
    static function sanitizeFromEmail ($inputText) {
        $inputText = strip_tags($inputText);
        $inputText = str_replace(" ","",$inputText);
        return $inputText;
    }
}