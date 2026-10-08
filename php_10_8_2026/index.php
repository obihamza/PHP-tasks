<?php
session_start();

$name = "";
$email = "";
$mobile = "";
$governorate = "";
$track = "";
$skills = [];
$message = "";
$agree = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $mobile = trim($_POST["mobile"]);
    $governorate = trim($_POST["governorate"]);
    $track = trim($_POST["track"] ?? "");
    $skills = $_POST["skills"] ?? [];
    $message = trim($_POST["message"]);
    $agree = $_POST["agree"] ?? "";

    $isValid = true;

    if ($name === "") {
        echo "Full Name is required.";
        $isValid = false;
    }

    if ($email === "") {
        echo "Email is required.";
        $isValid = false;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Please enter a valid email.";
        $isValid = false;
    }

    if ($mobile === "") {
        echo "Mobile is required.";
        $isValid = false;
    } elseif (!preg_match("/^07[789][0-9]{7}$/", $mobile)) {
        echo "Please enter a valid mobile number.";
        $isValid = false;
    }

    if ($governorate === "") {
        echo "Governorate must be selected.";
        $isValid = false;
    }

    if ($track === "") {
        echo "Track must be selected.";
        $isValid = false;
    }

    if (empty($skills)) {
        echo "At least one skill must be selected.";
        $isValid = false;
    }

    if ($agree === "") {
        echo "You must accept the terms.";
        $isValid = false;
    }

    if ($isValid) {

        $registration = (object) [
            "name" => $name,
            "email" => $email,
            "mobile" => $mobile,
            "governorate" => $governorate,
            "track" => $track,
            "skills" => $skills,
            "message" => $message
        ];

        $_SESSION["registration"] = $registration;

        setcookie("name", $name, time() + 86400 * 30);
        
        header("Location: profile.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
   <form action="index.php" method="post">

  <label for="name">Full Name</label>
  <input type="text" id="name" name="name" value="<?= $name ?>">

  <label for="email">Email</label>
  <input type="email" id="email" name="email" value="<?= $email ?>">

  <label for="mobile">Mobile</label>
  <input type="tel" id="mobile" name="mobile" placeholder="0791234567" value="<?= $mobile ?>">

  <label for="governorate">Governorate</label>
  <select id="governorate" name="governorate">
    <option value="">Choose a governorate</option>
    <option value="Amman" <?= $governorate === "Amman" ? "selected" : "" ?>>Amman</option>
    <option value="Irbid" <?= $governorate === "Irbid" ? "selected" : "" ?>>Irbid</option>
    <option value="Aqaba" <?= $governorate === "Aqaba" ? "selected" : "" ?>>Aqaba</option>
    <option value="Zarqa" <?= $governorate === "Zarqa" ? "selected" : "" ?>>Zarqa</option>
  </select>

  <label>Track</label>

  <label class="inline">
    <input type="radio" name="track" value="Full Stack" <?= $track === "Full Stack" ? "checked" : "" ?>>
    Full Stack
  </label>

  <label class="inline">
    <input type="radio" name="track" value="Frontend" <?= $track === "Frontend" ? "checked" : "" ?>>
    Frontend
  </label>

  <label class="inline">
    <input type="radio" name="track" value="Backend" <?= $track === "Backend" ? "checked" : "" ?>>
    Backend
  </label>

  <label>Skills you already have</label>

  <label class="inline">
    <input type="checkbox" name="skills[]" value="HTML" <?= in_array("HTML", $skills) ? "checked" : "" ?>>
    HTML
  </label>

  <label class="inline">
    <input type="checkbox" name="skills[]" value="CSS" <?= in_array("CSS", $skills) ? "checked" : "" ?>>
    CSS
  </label>

  <label class="inline">
    <input type="checkbox" name="skills[]" value="JavaScript" <?= in_array("JavaScript", $skills) ? "checked" : "" ?>>
    JavaScript
  </label>

  <label for="message">Why do you want to join? (optional)</label>
  <textarea id="message" name="message" rows="4"><?= $message ?></textarea>

  <label class="inline terms">
    <input type="checkbox" name="agree" <?= $agree !== "" ? "checked" : "" ?>>
    I agree to the academy terms
  </label>

  <button type="submit">Register</button>

</form> 
</body>
</html>