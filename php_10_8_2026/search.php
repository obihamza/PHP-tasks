<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
</head>
<body>

    <h1>Search</h1>

    <form method="GET" action="search.php">
        <input
            type="text"
            name="q"
            placeholder="Enter your search"
        >

        <button type="submit">Search</button>
    </form>

    <?php

    if (isset($_GET["q"])) {

        $search = $_GET["q"];

        echo "<h2>Search result for: " . $search . "</h2>";

    }

    ?>

</body>
</html>
