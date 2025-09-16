# Aplikasi Pendaftaran Siswa Baru (PPDB Online)

Sebuah aplikasi web sederhana yang dibangun menggunakan PHP native dan database MySQL untuk mengelola proses pendaftaran siswa baru secara online.

## Fitur Utama

### Untuk Calon Siswa
- Mendaftar melalui form online yang lengkap (data diri, data orang tua, pilihan jurusan, dll).
- Mengunggah dokumen persyaratan dalam format PDF.
- Mendapatkan notifikasi status pendaftaran langsung di halaman.

### Untuk Admin
- Login aman ke dashboard admin.
- Melihat, mencari, dan memfilter data semua pendaftar berdasarkan Nama atau NISN.
- Mengubah status pendaftaran siswa (pending, diterima, ditolak).
- Melihat dokumen yang diunggah oleh pendaftar.
- Mengekspor seluruh data pendaftar ke dalam format file CSV untuk pelaporan.

## Teknologi yang Digunakan
- **Backend**: PHP 8+
- **Database**: MySQL
- **Frontend**: HTML & CSS (dengan Google Fonts)
- **Server Lokal**: XAMPP

## Cara Menjalankan Aplikasi

1.  **Clone atau Unduh Repository**
    - Unduh atau clone repository ini ke komputer lokal Anda.

2.  **Pindahkan Folder Proyek**
    - Salin folder `ppdb_online` ke dalam direktori `htdocs` di instalasi XAMPP Anda (contoh path: `C:\xampp\htdocs\`).

3.  **Jalankan XAMPP**
    - Buka XAMPP Control Panel dan jalankan service **Apache** dan **MySQL**.

4.  **Buat dan Impor Database**
    - Buka browser dan akses `http://localhost/phpmyadmin`.
    - Buat database baru dengan nama `ppdb`.
    - Pilih database `ppdb` yang baru dibuat, lalu masuk ke tab "Import".
    - Klik "Choose File" dan pilih file `database.sql` yang ada di dalam folder proyek ini.
    - Klik "Import" untuk memulai proses.

5.  **Buka Aplikasi**
    - Buka browser dan akses alamat berikut: `http://localhost/ppdb_online/`
    - Aplikasi siap digunakan.

## Kredensial Login Admin

-   **Username**: `admin`
-   **Password**: `admin`
