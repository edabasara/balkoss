<?php

session_start(); // Oturum başlat

require_once '../config/db.php'; // Veritabanına bağlan

// Form gönderildiyse:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username']; // Formdaki kullanıcı adı
    $password = $_POST['password']; // Formdaki şifre

    // Veritabanında kullanıcıyı ara
    $stmt = $conn->prepare("SELECT * FROM admins WHERE username = ?");
    $stmt->execute([$username]);
    $admin = $stmt->fetch();

    // Eğer kullanıcı bulunduysa ve şifre doğruysa
    if ($admin && password_verify($password, $admin['password'])) {
        $_SESSION['admin'] = $admin['username']; // Oturumu başlat
        header("Location: dashboard.php"); // Admin paneline yönlendir
        exit;
    } else {
        $error = "❌ Kullanıcı adı veya şifre yanlış!";
    }
}
?>

<!-- HTML Giriş Formu -->
<h2>Admin Giriş</h2>
<form method="POST">
<input type="text" name="username" placeholder="Kullanıcı Adı" required><br><br>
<input type="password" name="password" placeholder="Şifre" required><br><br>
<button type="submit">Giriş Yap</button>
</form>

<?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
