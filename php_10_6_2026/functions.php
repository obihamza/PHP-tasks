<?php

// 1. Check if a number is prime
function isPrime($number) {
    if ($number < 2) return false;

    for ($i = 2; $i < $number; $i++) {
        if ($number % $i == 0) return false;
    }

    return true;
}

$number = 3;

echo isPrime($number)
    ? "$number is a prime number<br>"
    : "$number is not a prime number<br>";


// 2. Reverse a string
function reverseString($string) {
    return strrev($string);
}

$string = "remove";

echo reverseString($string) . "<br>";


// 3. Swap two variables
function swap(&$x, &$y) {
    $temp = $x;
    $x = $y;
    $y = $temp;
}

$x = 12;
$y = 10;

swap($x, $y);

echo "y = $x<br>";
echo "x = $y<br>";


// 4. Check if a number is an Armstrong number
function isArmstrong($number) {
    $original = $number;
    $sum = 0;

    while ($number > 0) {
        $digit = $number % 10;
        $sum += $digit * $digit * $digit;
        $number = (int)($number / 10);
    }

    return $sum == $original;
}

$number = 407;

echo isArmstrong($number)
    ? "$number is Armstrong Number<br>"
    : "$number is not Armstrong Number<br>";


// 5. Check if a string is a palindrome
function isPalindrome($string) {
    $string = strtolower($string);
    $string = preg_replace("/[^a-z0-9]/", "", $string);

    return $string == strrev($string);
}

$string = "Eva, can I see bees in a cave?";

echo isPalindrome($string)
    ? "Yes it is a palindrome<br>"
    : "No it is not a palindrome<br>";


// 6. Remove duplicates from an array
function removeDuplicates($array) {
    return array_values(array_unique($array));
}

$array1 = array(2, 4, 7, 4, 8, 4);

$array1 = removeDuplicates($array1);

print_r($array1);

?>