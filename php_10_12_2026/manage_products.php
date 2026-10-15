
<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

require "db.php";

$message = "";
$editProduct = null;

// Delete product
if (isset($_GET["delete"])) {
    $id = filter_var($_GET["delete"], FILTER_VALIDATE_INT);

    if ($id) {
        $stmt = $pdo->prepare(
            "DELETE FROM products WHERE id = ?"
        );
        $stmt->execute([$id]);

        header("Location: manage_products.php");
        exit;
    }
}

// Get product for editing
if (isset($_GET["edit"])) {
    $id = filter_var($_GET["edit"], FILTER_VALIDATE_INT);

    if ($id) {
        $stmt = $pdo->prepare(
            "SELECT * FROM products WHERE id = ?"
        );
        $stmt->execute([$id]);
        $editProduct = $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

// Add or update product
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"] ?? "";
    $name = trim($_POST["name"] ?? "");
    $description = trim($_POST["description"] ?? "");
    $price = $_POST["price"] ?? "";
    $quantity = $_POST["quantity"] ?? "";

    if (
        $name === "" ||
        $price === "" ||
        $quantity === "" ||
        !is_numeric($price) ||
        !is_numeric($quantity) ||
        (float) $price < 0 ||
        (float) $price > 99999999.99 ||
        filter_var($quantity, FILTER_VALIDATE_INT) === false ||
        (int) $quantity < 0
    ) {
        $message = "Enter a valid name, price, and non-negative whole quantity.";
    } else {
        if ($id === "") {
            $stmt = $pdo->prepare(
                "INSERT INTO products
                 (name, description, price, quantity)
                 VALUES (?, ?, ?, ?)"
            );

            $stmt->execute([
                $name, $description, $price, $quantity
            ]);
        } else {
            $stmt = $pdo->prepare(
                "UPDATE products
                 SET name = ?, description = ?,
                     price = ?, quantity = ?
                 WHERE id = ?"
            );

            $stmt->execute([
                $name, $description, $price, $quantity, $id
            ]);
        }

        header("Location: manage_products.php");
        exit;
    }
}

$products = $pdo->query(
    "SELECT id, name, description, price, quantity, created_at
     FROM products ORDER BY id DESC"
)->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Products</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Manage Products</h1>
        <a href="dashboard.php">Dashboard</a>
    </header>

    <main>
        <p><?= htmlspecialchars($message) ?></p>

        <h2><?= $editProduct ? "Edit Product" : "Add Product" ?></h2>

        <form method="POST">
            <input type="hidden" name="id"
                value="<?= htmlspecialchars((string) ($editProduct["id"] ?? "")) ?>">

            <label>Product Name</label>
            <input type="text" name="name" required
                value="<?= htmlspecialchars($editProduct["name"] ?? "") ?>">

            <label>Description</label>
            <textarea name="description"><?= htmlspecialchars($editProduct["description"] ?? "") ?></textarea>

            <label>Price</label>
            <input type="number" name="price" min="0"
                max="99999999.99" step="0.01" required
                value="<?= htmlspecialchars((string) ($editProduct["price"] ?? "")) ?>">

            <label>Quantity</label>
            <input type="number" name="quantity" min="0" step="1" required
                value="<?= htmlspecialchars((string) ($editProduct["quantity"] ?? "")) ?>">

            <button type="submit">
                <?= $editProduct ? "Update Product" : "Add Product" ?>
            </button>

            <?php if ($editProduct): ?>
                <a href="manage_products.php">Cancel</a>
            <?php endif; ?>
        </form>

        <h2>All Products</h2>

        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>

            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?= $product["id"] ?></td>
                    <td><?= htmlspecialchars($product["name"]) ?></td>
                    <td><?= htmlspecialchars($product["description"] ?? "") ?></td>
                    <td><?= number_format((float) $product["price"], 2) ?></td>
                    <td><?= $product["quantity"] ?></td>
                    <td><?= htmlspecialchars($product["created_at"]) ?></td>
                    <td>
                        <a href="?edit=<?= $product["id"] ?>">Edit</a>
                        <a href="?delete=<?= $product["id"] ?>"
                           onclick="return confirm('Delete this product?')">
                            Delete
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </main>
</body>
</html>
