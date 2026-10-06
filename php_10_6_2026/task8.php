<?php

function convertToUpper($colors) {

    foreach ($colors as &$color) {
        $color = strtoupper($color);
    }

    return $colors;
}

$colors = array("red", "blue", "white", "yellow");

$result = convertToUpper($colors);

print_r($result);

?>