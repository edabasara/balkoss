<?php

require_once 'config/db.php';
$products = $conn->query("SELECT * FROM products")->fetchAll();
?>

<h1>Balkos Gıda Ürünleri</h1>

<ul>
<?php foreach ($products as $urun): ?>
    <li><?= $urun['name'] ?> - <?= $urun['price'] ?>₺ - Stok: <?= $urun['stock'] ?></li>
<?php endforeach; ?>
</ul>
