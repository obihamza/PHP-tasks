<?php
$string = "Twinkle, twinkle, little star.";

$array = explode(" ", $string);

var_dump($array);
?>

<?php
$char = 'a';

if ($char === 'z') {
    echo 'a';
} else {
    echo ++$char;
}

echo '<br>';
?>

<?php
$string = "The brown fox";
$insert = "quick ";

$result = substr_replace($string, $insert, 4, 0);

echo $result;
?>

<?php
$string = "0000657022.24";

$result = ltrim($string, "0");

echo $result;
echo '<br>';
?>

<?php
$string = "The quick brown fox jumps over the lazy dog---";

$result = rtrim($string, "-");

echo $result;
echo '<br>';
?>

<?php
$string = "The quick brown fox jumps over the lazy dog";

$words = explode(" ", $string);

$result = array_slice($words, 0, 5);

echo implode(" ", $result);
echo '<br>';
?>

<?php
$string = "2,543.12";

$result = str_replace(",", "", $string);

echo $result;
echo '<br>';
?>