<?php

session_start();
require_once '../config/db.php';
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];

    $update = $conn->prepare("UPDATE products SET name = ?, price = ?, stock = ? WHERE id = ?");
    $update->execute([$name, $price, $stock, $id]);

    header("Location: dashboard.php");
    exit;
}
?>

<h2>Ürünü Güncelle</h2>
<form method="POST">
    <input type="text" name="name" value="<?= $product['name'] ?>"><br><br>
    <input type="number" name="price" step="0.01" value="<?= $product['price'] ?>"><br><br>
    <input type="number" name="stock" value="<?= $product['stock'] ?>"><br><br>
    <button type="submit">Güncelle</button>
</form>
