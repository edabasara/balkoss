<?php


require_once 'config/db.php';

$username = "admin";
$password = password_hash("admin123", PASSWORD_DEFAULT);

$sql = "INSERT INTO admins (username, password) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->execute([$username, $password]);

echo "✅ Admin başarıyla oluşturuldu!";

