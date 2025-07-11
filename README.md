# WebSekolah - Sistem Manajemen Konten & Informasi Sekolah

![Logo Sekolah](https://placehold.co/600x300/38bdf8/ffffff?text=WebSekolah)

**WebSekolah** adalah sebuah aplikasi web lengkap yang dibangun menggunakan Laravel 11 untuk memenuhi kebutuhan website sekolah modern. Proyek ini menyediakan portal informasi publik yang elegan dan panel admin yang kuat untuk mengelola seluruh aspek konten, data akademik, dan pendaftaran siswa baru (PPDB).

## Fitur Utama

### 1. Sisi Publik (Frontend)
- **Halaman Dinamis:** Konten untuk halaman-halaman utama seperti Profil, Sambutan Kepala Sekolah, Visi & Misi, Fasilitas, dan lainnya dapat dikelola sepenuhnya melalui CMS di panel admin.
- **Berita & Artikel:** Publikasikan berita, artikel, atau kegiatan sekolah dengan sistem kategori.
- **Pengumuman:** Bagian khusus untuk menampilkan pengumuman penting bagi siswa dan orang tua.
- **Galeri Foto & Video:** Tampilkan momen-momen terbaik sekolah dalam album-album yang terorganisir.
- **Pusat Unduhan:** Sediakan file dan dokumen penting (formulir, brosur, materi ajar) untuk diunduh oleh publik.
- **Profil Guru & Staf:** Tampilkan daftar tenaga pengajar dan staf sekolah.
- **Penerimaan Peserta Didik Baru (PPDB):** Alur pendaftaran online yang lengkap, mulai dari pengisian formulir, upload berkas, hingga melihat status kelulusan.
- **Desain Responsif:** Tampilan yang optimal di berbagai perangkat, mulai dari desktop hingga mobile.

### 2. Panel Admin (Backend)
- **Dashboard Informatif:** Halaman utama yang menampilkan ringkasan data penting seperti jumlah pendaftar baru, berita, dan lainnya.
- **Manajemen Konten Halaman (CMS):**
    - **Page-Based Management:** Kelola konten untuk setiap halaman (Beranda, Sambutan, dll.) secara terpisah.
    - **Tipe Konten Fleksibel:** Mendukung berbagai jenis input seperti teks, paragraf, gambar, URL, angka, dan **Rich Text Editor (WYSIWYG)** untuk konten berformat.
    - **Repeater Fields:** Tambahkan item dinamis seperti daftar keunggulan atau fitur dengan mudah.
- **Manajemen Data Akademik:**
    - CRUD (Create, Read, Update, Delete) untuk data Guru, Staf, Kurikulum, Prestasi, dan Ekstrakurikuler.
- **Manajemen PPDB:**
    - Lihat dan kelola data pendaftar.
    - Atur informasi dan jadwal PPDB.
    - Kelola status pembayaran dan kelulusan.
- **Manajemen Pengguna:** Atur pengguna admin dengan sistem role dan permission (menggunakan `spatie/laravel-permission`).
- **Pengaturan Situs:** Kelola informasi global seperti nama sekolah, logo, favicon, kontak, dan meta tags untuk SEO dari satu tempat.

## Teknologi yang Digunakan
- **Backend:** Laravel 12
- **Frontend:** Blade, Tailwind CSS v3, Alpine.js v3
- **Database:** MySQL / MariaDB
- **Asset Bundling:** Vite
- **Paket Utama:**
    - `laravel/breeze` untuk otentikasi.
    - `spatie/laravel-permission` untuk manajemen hak akses.
    - `tinymce` untuk Rich Text Editor.

## Panduan Instalasi

Berikut adalah langkah-langkah untuk menjalankan proyek ini di lingkungan lokal.

### Prasyarat
- PHP >= 8.2
- Composer
- Node.js & NPM
- Database (MySQL/MariaDB direkomendasikan)

### Langkah-langkah Instalasi

1.  **Clone Repository**
    ```bash
    git clone [https://github.com/rhecustein/websekolah](https://github.com/rhecustein/websekolah)
    cd websekolah
    ```

2.  **Install Dependensi**
    ```bash
    composer install
    npm install
    ```

3.  **Konfigurasi Lingkungan (.env)**
    - Salin file `.env.example` menjadi `.env`.
      ```bash
      cp .env.example .env
      ```
    - Buka file `.env` dan sesuaikan konfigurasi database Anda (DB_DATABASE, DB_USERNAME, DB_PASSWORD).

4.  **Generate Application Key**
    ```bash
    php artisan key:generate
    ```

5.  **Jalankan Migrasi & Seeder**
    - Perintah ini akan membuat semua tabel database dan mengisinya dengan data awal (termasuk konten CMS dan akun admin).
    ```bash
    php artisan migrate --seed
    ```

6.  **Buat Symbolic Link untuk Storage**
    - Ini sangat penting agar file yang diunggah (logo, gambar, dokumen) dapat diakses dari web.
    ```bash
    php artisan storage:link
    ```

7.  **Compile Aset Frontend**
    - Jalankan build untuk production atau dev untuk pengembangan.
    ```bash
    # Untuk pengembangan (dengan hot-reload)
    npm run dev

    # Untuk production
    npm run build
    ```

8.  **Jalankan Server Lokal**
    ```bash
    php artisan serve
    ```
    Aplikasi sekarang akan berjalan di `http://127.0.0.1:8000`.

## Akun Admin Default

Setelah menjalankan seeder, Anda dapat login ke panel admin menggunakan kredensial berikut:
-   **URL Login:** `http://127.0.0.1:8000/login`
-   **Email:** `admin@example.com`
-   **Password:** `password`

## Lisensi

Proyek ini bersifat open-source di bawah [Lisensi MIT](https://opensource.org/licenses/MIT).
