<?php

session_start();
require_once '../config/db.php';
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];
$stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
$stmt->execute([$id]);

header("Location: dashboard.php");
exit;
