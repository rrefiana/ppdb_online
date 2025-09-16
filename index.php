<?php require_once 'config.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PPDB Online</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <h2>Form Pendaftaran Siswa Baru</h2>
        <?php if(isset($_SESSION['alert'])): ?>
            <div class="alert"><?= $_SESSION['alert']; unset($_SESSION['alert']); ?></div>
        <?php endif; ?>
        <form action="proses_pendaftaran.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="csrf_token" value="<?= $csrf_token; ?>">
            
            <h3>Data Diri Siswa</h3>
            <div class="form-group">
                <label for="nama_lengkap">Nama Lengkap</label>
                <input type="text" id="nama_lengkap" name="nama_lengkap" required>
            </div>
            <div class="form-group">
                <label for="nisn">NISN</label>
                <input type="text" id="nisn" name="nisn" required>
            </div>
            <div class="form-group">
                <label for="jenis_kelamin">Jenis Kelamin</label>
                <select id="jenis_kelamin" name="jenis_kelamin" required>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>
            <div class="form-group">
                <label for="tempat_lahir">Tempat Lahir</label>
                <input type="text" id="tempat_lahir" name="tempat_lahir" required>
            </div>
            <div class="form-group">
                <label for="tanggal_lahir">Tanggal Lahir</label>
                <input type="date" id="tanggal_lahir" name="tanggal_lahir" required>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat Lengkap</label>
                <textarea id="alamat" name="alamat" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label for="asal_sekolah">Asal Sekolah</label>
                <input type="text" id="asal_sekolah" name="asal_sekolah" required>
            </div>
            <div class="form-group">
                <label for="pilihan_jurusan">Pilihan Jurusan</label>
                <select id="pilihan_jurusan" name="pilihan_jurusan" required>
                    <option value="IPA">IPA</option>
                    <option value="IPS">IPS</option>
                    <option value="Bahasa">Bahasa</option>
                </select>
            </div>

            <h3>Data Orang Tua</h3>
            <div class="form-group">
                <label for="nama_ayah">Nama Ayah</label>
                <input type="text" id="nama_ayah" name="nama_ayah" required>
            </div>
            <div class="form-group">
                <label for="nama_ibu">Nama Ibu</label>
                <input type="text" id="nama_ibu" name="nama_ibu" required>
            </div>
            <div class="form-group">
                <label for="no_hp_orangtua">No. HP Orang Tua</label>
                <input type="text" id="no_hp_orangtua" name="no_hp_orangtua" required>
            </div>

            <h3>Lampiran Dokumen</h3>
            <div class="form-group">
                <label for="dokumen">Upload Scan Ijazah/SKL (PDF, max 2MB)</label>
                <input type="file" id="dokumen" name="dokumen" accept=".pdf" required>
            </div>

            <button type="submit">Daftar Sekarang</button>
        </form>

        <div class="login-form">
            <h3>Login Admin</h3>
            <form action="proses_login.php" method="POST">
                <input type="hidden" name="csrf_token" value="<?= $csrf_token; ?>">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit">Login</button>
            </form>
        </div>
    </div>
</body>
</html>