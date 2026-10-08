<?php

session_start();

$registration = $_SESSION["registration"] ?? null;

if ($registration === null) {
    echo "No registration data found.";
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registered Information</title>
</head>
<body>

<h2>Registered Information</h2>

<p>Name: <?= $registration->name ?></p>

<p>Email: <?= $registration->email ?></p>

<p>Mobile: <?= $registration->mobile ?></p>

<p>Governorate: <?= $registration->governorate ?></p>

<p>Track: <?= $registration->track ?></p>

<p>Skills: <?= implode(", ", $registration->skills) ?></p>

<p>Message: <?= $registration->message ?></p>

</body>
</html>