<?php
require_once '../config.php';
require_once 'auth_check.php';

// Logika Pencarian
$search_query = "";
$search_term = "";
if (isset($_GET['search'])) {
    $search_term = htmlspecialchars($_GET['search']);
    $search_query = " WHERE nama_lengkap LIKE ? OR nisn LIKE ?";
}

$sql = "SELECT * FROM calon_siswa" . $search_query . " ORDER BY tanggal_pendaftaran DESC";
$stmt = $conn->prepare($sql);

if ($search_query) {
    $search_param = "%{$search_term}%";
    $stmt->bind_param("ss", $search_param, $search_param);
}

$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - PPDB Online</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Admin Dashboard</h2>
            <div>
                <a href="export.php" class="btn btn-export">Export ke CSV</a>
                <a href="../logout.php" class="btn btn-logout">Logout</a>
            </div>
        </div>

        <div class="search-form">
            <form action="dashboard.php" method="GET">
                <input type="text" name="search" placeholder="Cari Nama atau NISN..." value="<?= $search_term; ?>">
                <button type="submit">Cari</button>
            </form>
        </div>

        <div class="table-responsive-wrapper">
            <table class="dashboard-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Lengkap</th>
                    <th>NISN</th>
                    <th>Jurusan</th>
                    <th>Asal Sekolah</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row['id']; ?></td>
                            <td><?= htmlspecialchars($row['nama_lengkap']); ?></td>
                            <td><?= htmlspecialchars($row['nisn']); ?></td>
                            <td><?= htmlspecialchars($row['pilihan_jurusan']); ?></td>
                            <td><?= htmlspecialchars($row['asal_sekolah']); ?></td>
                            <td><strong class="status-<?= $row['status_pendaftaran']; ?>"><?= ucfirst($row['status_pendaftaran']); ?></strong></td>
                            <td class="action-links">
                                <a href="update_status.php?id=<?= $row['id']; ?>&status=diterima" class="btn-action action-terima">Terima</a>
                                <a href="update_status.php?id=<?= $row['id']; ?>&status=ditolak" class="btn-action action-tolak">Tolak</a>
                                <a href="update_status.php?id=<?= $row['id']; ?>&status=pending" class="btn-action action-pending">Pending</a>
                                <a href="../<?= htmlspecialchars($row['path_dokumen']); ?>" target="_blank" class="btn-action action-dokumen">Dokumen</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" style="text-align:center;">Tidak ada data pendaftar.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
<?php
$stmt->close();
$conn->close();
?>