<?php
// Mulai session
session_start();

// Konfigurasi Database
$db_host = 'localhost';
$db_user = 'root'; // Sesuaikan dengan username database Anda
$db_pass = ''; // Sesuaikan dengan password database Anda
$db_name = 'ppdb';

// Buat koneksi
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi Gagal: " . $conn->connect_error);
}

// Buat token CSRF jika belum ada
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$csrf_token = $_SESSION['csrf_token'];

?>