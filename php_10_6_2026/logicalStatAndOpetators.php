<?php

// ============================================================
// 1. Check if the sum of two numbers equals 30
// ============================================================

function checkSum($firstInteger, $secondInteger) {
    $sum = $firstInteger + $secondInteger;

    return $sum == 30 ? $sum : false;
}

$firstInteger = 10;
$secondInteger = 10;

$result = checkSum($firstInteger, $secondInteger);

echo "1. ";
echo $result === false ? "false<br>" : "$result<br>";


// ============================================================
// 2. Check if a number is a multiple of 3
// ============================================================

function isMultipleOfThree($number) {
    return $number % 3 == 0;
}

$number = 20;

echo "2. ";
echo isMultipleOfThree($number) ? "true<br>" : "false<br>";


// ============================================================
// 3. Check if a number is between 20 and 50 inclusive
// ============================================================

function isInRange($number) {
    return $number >= 20 && $number <= 50;
}

$number = 50;

echo "3. ";
echo isInRange($number) ? "true<br>" : "false<br>";


// ============================================================
// 4. Find the largest number between three integers
// ============================================================

function findLargest($a, $b, $c) {
    return max($a, $b, $c);
}

echo "4. " . findLargest(1, 5, 9) . "<br>";


// ============================================================
// 5. Calculate monthly electricity bill
// ============================================================

function calculateElectricityBill($units) {

    if ($units <= 50) {
        return $units * 2.50;
    }

    if ($units <= 150) {
        return (50 * 2.50) + (($units - 50) * 5.00);
    }

    if ($units <= 250) {
        return (50 * 2.50)
             + (100 * 5.00)
             + (($units - 150) * 6.20);
    }

    return (50 * 2.50)
         + (100 * 5.00)
         + (100 * 6.20)
         + (($units - 250) * 7.50);
}

$units = 200;

echo "5. Electricity Bill: "
     . calculateElectricityBill($units)
     . " JOD<br>";


// ============================================================
// 6. Calculator
// ============================================================

function calculator($number1, $number2, $operator) {

    switch ($operator) {

        case "+":
            return $number1 + $number2;

        case "-":
            return $number1 - $number2;

        case "*":
            return $number1 * $number2;

        case "/":
            return $number2 != 0
                ? $number1 / $number2
                : "Cannot divide by zero";

        default:
            return "Invalid operator";
    }
}

echo "6. " . calculator(10, 5, "+") . "<br>";
echo "   " . calculator(10, 5, "-") . "<br>";
echo "   " . calculator(10, 5, "*") . "<br>";
echo "   " . calculator(10, 5, "/") . "<br>";


// ============================================================
// 7. Check voting eligibility
// ============================================================

function canVote($age) {
    return $age >= 18;
}

$age = 15;

echo "7. ";
echo canVote($age)
    ? "is eligible to vote<br>"
    : "is not eligible to vote<br>";


// ============================================================
// 8. Check if a number is positive, negative, or zero
// ============================================================

function checkNumber($number) {

    if ($number > 0) {
        return "Positive";
    }

    if ($number < 0) {
        return "Negative";
    }

    return "Zero";
}

echo "8. " . checkNumber(-60) . "<br>";


// ============================================================
// 9. Calculate student's average and grade
// ============================================================

function calculateGrade($scores) {

    $average = array_sum($scores) / count($scores);

    if ($average >= 90) {
        return "A";
    } elseif ($average >= 80) {
        return "B";
    } elseif ($average >= 70) {
        return "C";
    } elseif ($average >= 60) {
        return "D";
    } else {
        return "F";
    }
}

$scores = [60, 86, 95, 63, 55, 74, 79, 62, 50];

echo "9. " . calculateGrade($scores);

?>