<?php

require_once ("../load.php");

try {
    $inputJSON = file_get_contents('php://input');
    $input = json_decode($inputJSON, true); 

    if (isset($input["username"]) && isset($input["vals"])) {
        $search = new SearchDB($pdo, $input["username"]);
        echo $search->getResults($input["vals"]);
    } else {
        echo "Result key not found.";
    }
} catch (ErrorException $err) {
    echo "SearchReasult: ".$err->getMessage();
}