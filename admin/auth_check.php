<?php
// File ini disertakan di setiap halaman admin untuk memastikan hanya admin yang login yang bisa mengakses
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: ../index.php");
    exit;
}
?>