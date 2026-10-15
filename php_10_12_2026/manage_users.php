
<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

require "db.php";

$message = "";
$editUser = null;

// Delete user
if (isset($_GET["delete"])) {
    $id = filter_var($_GET["delete"], FILTER_VALIDATE_INT);

    if ($id && $id != $_SESSION["user_id"]) {
        $stmt = $pdo->prepare(
            "DELETE FROM users WHERE id = ?"
        );
        $stmt->execute([$id]);

        header("Location: manage_users.php");
        exit;
    } else {
        $message = "You cannot delete your own account here.";
    }
}

// Get user for editing
if (isset($_GET["edit"])) {
    $id = filter_var($_GET["edit"], FILTER_VALIDATE_INT);

    if ($id) {
        $stmt = $pdo->prepare(
            "SELECT id, name, email FROM users WHERE id = ?"
        );
        $stmt->execute([$id]);
        $editUser = $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

// Add or update user
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"] ?? "";
    $name = trim($_POST["name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $password = $_POST["password"] ?? "";

    if ($name === "" || $email === "") {
        $message = "Name and email are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Enter a valid email address.";
    } else {
        try {
            if ($id === "") {
                if ($password === "") {
                    $message = "Password is required for a new user.";
                } else {
                    $hash = password_hash(
                        $password,
                        PASSWORD_DEFAULT
                    );

                    $stmt = $pdo->prepare(
                        "INSERT INTO users (name, email, password)
                         VALUES (?, ?, ?)"
                    );
                    $stmt->execute([$name, $email, $hash]);

                    header("Location: manage_users.php");
                    exit;
                }
            } else {
                if ($password !== "") {
                    $hash = password_hash(
                        $password,
                        PASSWORD_DEFAULT
                    );

                    $stmt = $pdo->prepare(
                        "UPDATE users
                         SET name = ?, email = ?, password = ?
                         WHERE id = ?"
                    );
                    $stmt->execute([$name, $email, $hash, $id]);
                } else {
                    $stmt = $pdo->prepare(
                        "UPDATE users
                         SET name = ?, email = ?
                         WHERE id = ?"
                    );
                    $stmt->execute([$name, $email, $id]);
                }

                header("Location: manage_users.php");
                exit;
            }
        } catch (PDOException $e) {
            if ($e->getCode() == "23000") {
                $message = "This email is already registered.";
            } else {
                $message = "Database operation failed.";
            }
        }
    }
}

$users = $pdo->query(
    "SELECT id, name, email, created_at
     FROM users ORDER BY id DESC"
)->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Users</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Manage Users</h1>
        <a href="dashboard.php">Dashboard</a>
    </header>

    <main>
        <p><?= htmlspecialchars($message) ?></p>

        <h2><?= $editUser ? "Edit User" : "Add User" ?></h2>

        <form method="POST">
            <input type="hidden" name="id"
                value="<?= htmlspecialchars((string) ($editUser["id"] ?? "")) ?>">

            <label>Name</label>
            <input type="text" name="name" required
                value="<?= htmlspecialchars($editUser["name"] ?? "") ?>">

            <label>Email</label>
            <input type="email" name="email" required
                value="<?= htmlspecialchars($editUser["email"] ?? "") ?>">

            <label>Password
                <?= $editUser ? "(leave blank to keep current password)" : "" ?>
            </label>
            <input type="password" name="password"
                <?= $editUser ? "" : "required" ?>>

            <button type="submit">
                <?= $editUser ? "Update User" : "Add User" ?>
            </button>

            <?php if ($editUser): ?>
                <a href="manage_users.php">Cancel</a>
            <?php endif; ?>
        </form>

        <h2>All Users</h2>

        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>

            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= $user["id"] ?></td>
                    <td><?= htmlspecialchars($user["name"]) ?></td>
                    <td><?= htmlspecialchars($user["email"]) ?></td>
                    <td><?= htmlspecialchars($user["created_at"]) ?></td>
                    <td>
                        <a href="?edit=<?= $user["id"] ?>">Edit</a>

                        <?php if ($user["id"] != $_SESSION["user_id"]): ?>
                            <a href="?delete=<?= $user["id"] ?>"
                               onclick="return confirm('Delete this user?')">
                                Delete
                            </a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </main>
</body>
</html>
