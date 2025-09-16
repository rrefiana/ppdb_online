<?php
require_once '../config.php';
require_once 'auth_check.php';

if (isset($_GET['id']) && isset($_GET['status'])) {
    $id = intval($_GET['id']);
    $status = $_GET['status'];

    // Validasi status
    $allowed_statuses = ['pending', 'diterima', 'ditolak'];
    if (in_array($status, $allowed_statuses)) {
        $stmt = $conn->prepare("UPDATE calon_siswa SET status_pendaftaran = ? WHERE id = ?");
        $stmt->bind_param("si", $status, $id);
        $stmt->execute();
        $stmt->close();
    }
}

$conn->close();
header("Location: dashboard.php");
exit;
?>