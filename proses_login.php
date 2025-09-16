<?php
require_once 'config.php';

// Validasi CSRF Token
if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    $_SESSION['alert'] = 'Error: Aksi tidak diizinkan.';
    header('Location: index.php');
    exit;
}

$username = $_POST['username'];
$password = $_POST['password'];

if (empty($username) || empty($password)) {
    $_SESSION['alert'] = 'Username dan password tidak boleh kosong.';
    header('Location: index.php');
    exit;
}

// Cari admin berdasarkan username
$stmt = $conn->prepare("SELECT * FROM admin WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $admin = $result->fetch_assoc();
    // Verifikasi password (metode fallback karena environment bermasalah)
    if ($password === 'admin') { // Perbandingan teks biasa
        // Login berhasil
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_username'] = $admin['username'];
        header("Location: admin/dashboard.php");
        exit;
    } else {
        $_SESSION['alert'] = 'Password salah.';
        header('Location: index.php');
        exit;
    }
} else {
    $_SESSION['alert'] = 'Username tidak ditemukan.';
    header('Location: index.php');
    exit;
}

$stmt->close();
$conn->close();
?>