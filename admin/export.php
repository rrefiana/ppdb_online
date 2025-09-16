<?php
require_once '../config.php';
require_once 'auth_check.php';

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=laporan_pendaftaran_siswa.csv');

$output = fopen('php://output', 'w');

// Header kolom
fputcsv($output, [
    'ID', 'Nama Lengkap', 'NISN', 'Jenis Kelamin', 'Tempat Lahir', 'Tanggal Lahir', 
    'Alamat', 'Asal Sekolah', 'Pilihan Jurusan', 'Nama Ayah', 'Nama Ibu', 'No HP Ortu', 
    'Status Pendaftaran', 'Tanggal Pendaftaran'
]);

$result = $conn->query("SELECT * FROM calon_siswa ORDER BY id ASC");

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        fputcsv($output, $row);
    }
}

fclose($output);
$conn->close();
exit;
?>