<?php
require_once 'config.php';

// Validasi CSRF Token
if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    $_SESSION['alert'] = 'Error: Aksi tidak diizinkan.';
    header('Location: index.php');
    exit;
}

// Validasi input dasar
$required_fields = ['nama_lengkap', 'nisn', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir', 'alamat', 'asal_sekolah', 'pilihan_jurusan', 'nama_ayah', 'nama_ibu', 'no_hp_orangtua'];
foreach ($required_fields as $field) {
    if (empty($_POST[$field])) {
        $_SESSION['alert'] = "Error: Semua field wajib diisi.";
        header('Location: index.php');
        exit;
    }
}

// Proses upload file
if (isset($_FILES['dokumen']) && $_FILES['dokumen']['error'] == 0) {
    $file = $_FILES['dokumen'];
    $allowed_ext = ['pdf'];
    $max_size = 2 * 1024 * 1024; // 2MB

    $file_ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

    if (!in_array($file_ext, $allowed_ext)) {
        $_SESSION['alert'] = 'Error: Hanya file PDF yang diizinkan.';
        header('Location: index.php');
        exit;
    }

    if ($file['size'] > $max_size) {
        $_SESSION['alert'] = 'Error: Ukuran file maksimal adalah 2MB.';
        header('Location: index.php');
        exit;
    }

    // Buat nama file unik
    $new_filename = uniqid('doc_', true) . '.' . $file_ext;
    $upload_path = 'uploads/' . $new_filename;

    if (!move_uploaded_file($file['tmp_name'], $upload_path)) {
        $_SESSION['alert'] = 'Error: Gagal mengupload file.';
        header('Location: index.php');
        exit;
    }
} else {
    $_SESSION['alert'] = 'Error: File dokumen wajib diupload.';
    header('Location: index.php');
    exit;
}

// Ambil data dari form dan sanitasi
$nama_lengkap = htmlspecialchars($_POST['nama_lengkap']);
$nisn = htmlspecialchars($_POST['nisn']);
$jenis_kelamin = htmlspecialchars($_POST['jenis_kelamin']);
$tempat_lahir = htmlspecialchars($_POST['tempat_lahir']);
$tanggal_lahir = htmlspecialchars($_POST['tanggal_lahir']);
$alamat = htmlspecialchars($_POST['alamat']);
$asal_sekolah = htmlspecialchars($_POST['asal_sekolah']);
$pilihan_jurusan = htmlspecialchars($_POST['pilihan_jurusan']);
$nama_ayah = htmlspecialchars($_POST['nama_ayah']);
$nama_ibu = htmlspecialchars($_POST['nama_ibu']);
$no_hp_orangtua = htmlspecialchars($_POST['no_hp_orangtua']);
$path_dokumen = $upload_path;

// Gunakan prepared statement untuk mencegah SQL Injection
$stmt = $conn->prepare("INSERT INTO calon_siswa (nama_lengkap, nisn, jenis_kelamin, tempat_lahir, tanggal_lahir, alamat, asal_sekolah, pilihan_jurusan, nama_ayah, nama_ibu, no_hp_orangtua, path_dokumen) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssssssss", $nama_lengkap, $nisn, $jenis_kelamin, $tempat_lahir, $tanggal_lahir, $alamat, $asal_sekolah, $pilihan_jurusan, $nama_ayah, $nama_ibu, $no_hp_orangtua, $path_dokumen);

if ($stmt->execute()) {
    $_SESSION['alert'] = "Pendaftaran berhasil! Terima kasih telah mendaftar.";
} else {
    // Cek jika error karena duplikat NISN
    if ($conn->errno == 1062) {
        $_SESSION['alert'] = "Error: NISN sudah terdaftar. Silakan gunakan NISN lain.";
    } else {
        $_SESSION['alert'] = "Error: Terjadi kesalahan saat menyimpan data. " . $stmt->error;
    }
}

$stmt->close();
$conn->close();

header('Location: index.php');
exit;
?>