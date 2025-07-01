<?php

session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
require_once '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];

    $stmt = $conn->prepare("INSERT INTO products (name, price, stock) VALUES (?, ?, ?)");
    $stmt->execute([$name, $price, $stock]);

    header("Location: dashboard.php");
    exit;
}
?>

<h2>Ürün Ekle</h2>
<form method="POST">
    <input type="text" name="name" placeholder="Ürün Adı" required><br><br>
    <input type="number" name="price" step="0.01" placeholder="Fiyat" required><br><br>
    <input type="number" name="stock" placeholder="Stok Miktarı" required><br><br>
    <button type="submit">Kaydet</button>
</form>
