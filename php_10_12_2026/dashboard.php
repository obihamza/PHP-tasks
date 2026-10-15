
<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

require "db.php";

$userCount = $pdo->query(
    "SELECT COUNT(*) FROM users"
)->fetchColumn();

$productCount = $pdo->query(
    "SELECT COUNT(*) FROM products"
)->fetchColumn();

$users = $pdo->query(
    "SELECT id, name, email, created_at
     FROM users ORDER BY id DESC"
)->fetchAll(PDO::FETCH_ASSOC);

$products = $pdo->query(
    "SELECT id, name, description, price, quantity, created_at
     FROM products ORDER BY id DESC"
)->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <h1>Admin Dashboard</h1>
    <p>
        Welcome,
        <?= htmlspecialchars($_SESSION["user_name"]) ?>
    </p>
    <a href="logout.php">Logout</a>
</header>

<nav>
    <a href="#users">Users</a>
    <a href="#products">Products</a>
</nav>

<main>
    <section class="stats">
        <div class="stat-card">
            <h2>Total Users</h2>
            <p><?= $userCount ?></p>
        </div>

        <div class="stat-card">
            <h2>Total Products</h2>
            <p><?= $productCount ?></p>
        </div>
    </section>

    <section id="users">
        <h2>Users</h2>
        <p><a href="manage_users.php">Manage Users</a></p>

        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Created At</th>
            </tr>

            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= $user["id"] ?></td>
                    <td><?= htmlspecialchars($user["name"]) ?></td>
                    <td><?= htmlspecialchars($user["email"]) ?></td>
                    <td><?= htmlspecialchars($user["created_at"]) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </section>

    <section id="products">
        <h2>Products</h2>
        <p><a href="manage_products.php">Manage Products</a></p>

        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Created At</th>
            </tr>

            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?= $product["id"] ?></td>
                    <td><?= htmlspecialchars($product["name"]) ?></td>
                    <td><?= htmlspecialchars($product["description"] ?? "") ?></td>
                    <td><?= number_format((float) $product["price"], 2) ?></td>
                    <td><?= $product["quantity"] ?></td>
                    <td><?= htmlspecialchars($product["created_at"]) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </section>
</main>

</body>
</html>
