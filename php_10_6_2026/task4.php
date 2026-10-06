<?php

$array = [1, 2, 3, 4, 5];

$location = 4;
$newItem = '$';

array_splice($array, $location - 1, 0, $newItem);

foreach ($array as $item) {
    echo $item . " ";
}

?>