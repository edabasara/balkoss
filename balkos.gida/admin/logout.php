<?php

session_start();
session_destroy(); // Oturumu bitir
header("Location: login.php"); // Giriş sayfasına yönlendir
exit;
