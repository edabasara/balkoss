<?php

session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
require_once '../config/db.php';

$products = $conn->query("SELECT * FROM products")->fetchAll();
?>

<h2>Admin Panel - Ürün Listesi</h2>
<a href="add_product.php">➕ Yeni Ürün Ekle</a> | <a href="logout.php">Çıkış Yap</a>
<hr>

<table border="1" cellpadding="8">
    <tr>
        <th>ID</th>
        <th>İsim</th>
        <th>Fiyat</th>
        <th>Stok</th>
        <th>İşlem</th>
    </tr>
    <?php foreach ($products as $urun): ?>
    <tr>
        <td><?= $urun['id'] ?></td>
        <td><?= $urun['name'] ?></td>
        <td><?= $urun['price'] ?> ₺</td>
        <td><?= $urun['stock'] ?></td>
        <td>
            <a href="edit_product.php?id=<?= $urun['id'] ?>">✏️</a> |
            <a href="delete_product.php?id=<?= $urun['id'] ?>" onclick="return confirm('Silmek istediğine emin misin?')">🗑️</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

