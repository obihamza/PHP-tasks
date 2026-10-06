<?php

// ============================================================
// PHP String and String Functions
// ============================================================


// 1. String transformations
// ------------------------------------------------------------

$string = "hello world from orange coding academy";

// a. Convert to uppercase
echo "Uppercase: " . strtoupper($string) . "<br>";

// b. Convert to lowercase
echo "Lowercase: " . strtolower($string) . "<br>";

// c. Make the first letter uppercase
echo "First letter uppercase: " . ucfirst($string) . "<br>";

// d. Make the first letter of each word uppercase
echo "Each word uppercase: " . ucwords($string) . "<br>";

echo "<br>";


// 2. Convert numeric string to time format
// ------------------------------------------------------------

$time = "085119";

$formattedTime =
    substr($time, 0, 2) . ":" .
    substr($time, 2, 2) . ":" .
    substr($time, 4, 2);

echo "Time: " . $formattedTime . "<br>";

echo "<br>";


// 3. Check whether a sentence contains a specific word
// ------------------------------------------------------------

$sentence = "I am a full stack developer at orange coding academy";
$word = "Orange";

if (stripos($sentence, $word) !== false) {
    echo "Word Found!<br>";
} else {
    echo "Word Not Found!<br>";
}

echo "<br>";


// 4. Extract the file name from a URL
// ------------------------------------------------------------

$url = "www.orange.com/index.php";

echo "File name: " . basename($url) . "<br>";

echo "<br>";


// 5. Extract username from an email address
// ------------------------------------------------------------

$email = "info@orange.com";

echo "Username: " . strstr($email, "@", true) . "<br>";

echo "<br>";


// 6. Get the last three characters from a string
// ------------------------------------------------------------

$string = "info@orange.com";

echo "Last three characters: " . substr($string, -3) . "<br>";

echo "<br>";


// 7. Generate a random password without rand()
// ------------------------------------------------------------

$characters =
    "1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";

$password = "";

for ($i = 0; $i < 10; $i++) {
    $password .= $characters[random_int(0, strlen($characters) - 1)];
}

echo "Random Password: " . $password . "<br>";

echo "<br>";


// 8. Replace the first word of a sentence
// ------------------------------------------------------------

$sentence = "Our new trainee is so genius.";
$newWord = "The";

$sentence = preg_replace(
    "/^\w+/",
    $newWord,
    $sentence,
    1
);

echo "New sentence: " . $sentence;

?>