<?php

$temperatures = [
    78, 60, 62, 68, 71, 68, 73, 85, 66, 64,
    76, 63, 75, 76, 73, 68, 62, 73, 72, 65,
    74, 62, 62, 65, 64, 68, 73, 75, 79, 73
];

// Calculate average
$average = array_sum($temperatures) / count($temperatures);

// Sort temperatures from lowest to highest
sort($temperatures);

// Get the five lowest
$lowest = array_slice($temperatures, 0, 5);

// Get the five highest
$highest = array_slice($temperatures, -5);

echo "Average Temperature is: " . $average . "<br>";

echo "List of five lowest temperatures: ";
echo implode(", ", $lowest);

echo "<br>";

echo "List of five highest temperatures: ";
echo implode(", ", $highest);

?>