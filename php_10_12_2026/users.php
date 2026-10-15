
<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

require "db.php";

$stmt = $pdo->query(
    "SELECT id, name, email, created_at
     FROM users
     ORDER BY id ASC"
);

$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registered Users</title>
</head>
<body>
    <h2>Welcome, <?= htmlspecialchars($_SESSION["user_name"]) ?>!</h2>

    <h3>All Registered Users</h3>

    <table border="1" cellpadding="8">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Registration Date</th>
        </tr>

        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= htmlspecialchars((string) $user["id"]) ?></td>
                <td><?= htmlspecialchars($user["name"]) ?></td>
                <td><?= htmlspecialchars($user["email"]) ?></td>
                <td><?= htmlspecialchars($user["created_at"]) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <br>
    <a href="logout.php">Logout</a>
</body>
</html>
