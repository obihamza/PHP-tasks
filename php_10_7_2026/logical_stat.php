<?php
$year = 2013;

if ($year % 400 == 0 || ($year % 4 == 0 && $year % 100 != 0)) {
    echo "This year is a leap year";
} else {
    echo "This year is not a leap year";
}

echo '<br>';
?>


<?php
$temperature = 27;

if ($temperature < 20) {
    echo "It is wintertime!";
} else {
    echo "It is summertime!";
}
echo '<br>';
?>


<?php
$firstInteger = 2;
$secondInteger = 2;

$sum = $firstInteger + $secondInteger;

if ($firstInteger == $secondInteger) {
    $sum *= 3;
}

echo $sum;
?>

