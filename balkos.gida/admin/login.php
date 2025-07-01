<?php

session_start();
require_once '../config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM admins WHERE username = ?");
    $stmt->execute([$username]);
    $admin = $stmt->fetch();

    if ($admin && password_verify($password, $admin['password'])) {
        $_SESSION['admin'] = $admin['username'];
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "❌ Kullanıcı adı veya şifre yanlış!";
    }
}
?>

<h2>Admin Giriş</h2>
<form method="POST">
    <input type="text" name="username" placeholder="Kullanıcı Adı" required><br><br>
    <input type="password" name="password" placeholder="Şifre" required><br><br>
    <button type="submit">Giriş Yap</button>
</form>

<?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
