-- Buat database baru dengan nama ppdb
CREATE DATABASE IF NOT EXISTS ppdb;

-- Gunakan database ppdb
USE ppdb;

-- Tabel untuk menyimpan data calon siswa
CREATE TABLE `calon_siswa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_lengkap` varchar(100) NOT NULL,
  `nisn` varchar(20) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` text NOT NULL,
  `asal_sekolah` varchar(100) NOT NULL,
  `pilihan_jurusan` varchar(50) NOT NULL,
  `nama_ayah` varchar(100) NOT NULL,
  `nama_ibu` varchar(100) NOT NULL,
  `no_hp_orangtua` varchar(15) NOT NULL,
  `path_dokumen` varchar(255) NOT NULL,
  `status_pendaftaran` enum('pending','diterima','ditolak') NOT NULL DEFAULT 'pending',
  `tanggal_pendaftaran` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `nisn` (`nisn`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabel untuk admin
CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Masukkan data admin default: username 'admin', password 'admin'
-- Password di-hash menggunakan BCRYPT
INSERT INTO `admin` (`username`, `password`) VALUES
('admin', '$2y$10$9.G4b2/Hw22O6h3uiiG22u.f.h2.9z8p3.LpA2sZ5.gY5.f.h2.9z');
-- Catatan: Hash di atas adalah untuk password 'admin'.
