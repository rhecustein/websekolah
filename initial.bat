@echo off
setlocal

REM Pindah ke direktori root proyek Laravel (opsional, pastikan Anda menjalankannya di root)
REM cd /d "C:\path\to\your\laravel\project"

echo.
echo ===========================================
echo   Membuat Struktur Folder dan File Views
echo ===========================================
echo.

REM Membuat folder utama untuk layout
echo Membuat folder: resources\views\layouts
mkdir resources\views\layouts
echo. > resources\views\layouts\app.blade.php
echo. > resources\views\layouts\admin.blade.php
echo. > resources\views\layouts\auth.blade.php

echo.
echo Membuat folder dan file untuk bagian publik (frontend)...

REM Home
echo Membuat folder: resources\views\home
mkdir resources\views\home
echo. > resources\views\home\index.blade.php

REM Tentang Kami
echo Membuat folder: resources\views\tentangkami
mkdir resources\views\tentangkami
echo. > resources\views\tentangkami\profil.blade.php
echo. > resources\views\tentangkami\sambutan.blade.php
echo. > resources\views\tentangkami\fasilitas.blade.php
echo. > resources\views\tentangkami\akreditasi-prestasi.blade.php
echo. > resources\views\tentangkami\lokasi-kontak.blade.php

REM Akademik
echo Membuat folder: resources\views\akademik
mkdir resources\views\akademik
echo. > resources\views\akademik\kurikulum.blade.php
echo. > resources\views\akademik\program-unggulan.blade.php
echo. > resources\views\akademik\guru-staf.blade.php
echo. > resources\views\akademik\beasiswa.blade.php
echo. > resources\views\akademik\ujian-kelulusan.blade.php

REM Berita
echo Membuat folder: resources\views\berita
mkdir resources\views\berita
echo. > resources\views\berita\index.blade.php
echo. > resources\views\berita\show.blade.php

REM Pengumuman (jika terpisah dari berita di frontend)
echo Membuat folder: resources\views\pengumuman
mkdir resources\views\pengumuman
echo. > resources\views\pengumuman\index.blade.php
echo. > resources\views\pengumuman\show.blade.php

REM Galeri
echo Membuat folder: resources\views\galeri
mkdir resources\views\galeri
echo. > resources\views\galeri\index.blade.php
echo. > resources\views\galeri\album.blade.php

REM PPDB
echo Membuat folder: resources\views\ppdb
mkdir resources\views\ppdb
echo. > resources\views\ppdb\index.blade.php
echo. > resources\views\ppdb\daftar.blade.php
echo. > resources\views\ppdb\daftar-sukses.blade.php
echo. > resources\views\ppdb\status.blade.php
echo. > resources\views\ppdb\status_hasil.blade.php
echo. > resources\views\ppdb\hasil.blade.php
echo. > resources\views\ppdb\daftar-ulang.blade.php
echo. > resources\views\ppdb\bukti-daftar.blade.php

REM Unduhan
echo Membuat folder: resources\views\unduhan
mkdir resources\views\unduhan
echo. > resources\views\unduhan\index.blade.php

REM Kontak
echo Membuat folder: resources\views\kontak
mkdir resources\views\kontak
echo. > resources\views\kontak\index.blade.php

echo.
echo Membuat folder dan file untuk bagian admin (backend)...

REM Admin Dashboard
echo Membuat folder: resources\views\admin\dashboard
mkdir resources\views\admin\dashboard
echo. > resources\views\admin\dashboard\index.blade.php

REM Admin Users
echo Membuat folder: resources\views\admin\users
mkdir resources\views\admin\users
echo. > resources\views\admin\users\index.blade.php
echo. > resources\views\admin\users\create.blade.php
echo. > resources\views\admin\users\edit.blade.php
echo. > resources\views\admin\users\show.blade.php

REM Admin Sekolah Info
echo Membuat folder: resources\views\admin\sekolah
mkdir resources\views\admin\sekolah
echo. > resources\views\admin\sekolah\show.blade.php
echo. > resources\views\admin\sekolah\create.blade.php
echo. > resources\views\admin\sekolah\edit.blade.php

REM Admin Berita
echo Membuat folder: resources\views\admin\berita
mkdir resources\views\admin\berita
echo. > resources\views\admin\berita\index.blade.php
echo. > resources\views\admin\berita\create.blade.php
echo. > resources\views\admin\berita\edit.blade.php
echo. > resources\views\admin\berita\show.blade.php

REM Admin Halaman
echo Membuat folder: resources\views\admin\halaman
mkdir resources\views\admin\halaman
echo. > resources\views\admin\halaman\index.blade.php
echo. > resources\views\admin\halaman\create.blade.php
echo. > resources\views\admin\halaman\edit.blade.php
echo. > resources\views\admin\halaman\show.blade.php

REM Admin Kategori Berita
echo Membuat folder: resources\views\admin\kategori-berita
mkdir resources\views\admin\kategori-berita
echo. > resources\views\admin\kategori-berita\index.blade.php
echo. > resources\views\admin\kategori-berita\create.blade.php
echo. > resources\views\admin\kategori-berita\edit.blade.php
echo. > resources\views\admin\kategori-berita\show.blade.php

REM Admin Galeri (Album, Foto, Video)
echo Membuat folder: resources\views\admin\galeri
mkdir resources\views\admin\galeri
echo. > resources\views\admin\galeri\index.blade.php
echo. > resources\views\admin\galeri\create.blade.php
echo. > resources\views\admin\galeri\edit.blade.php
echo. > resources\views\admin\galeri\show.blade.php

echo Membuat sub-folder dan file galeri (foto & video)
echo. > resources\views\admin\galeri\photos.blade.php
echo. > resources\views\admin\galeri\create_photo.blade.php
echo. > resources\views\admin\galeri\edit_photo.blade.php
echo. > resources\views\admin\galeri\show_photo.blade.php

echo. > resources\views\admin\galeri\videos.blade.php
echo. > resources\views\admin\galeri\create_video.blade.php
echo. > resources\views\admin\galeri\edit_video.blade.php
echo. > resources\views\admin\galeri\show_video.blade.php

REM Admin Dokumen
echo Membuat folder: resources\views\admin\dokumen
mkdir resources\views\admin\dokumen
echo. > resources\views\admin\dokumen\index.blade.php
echo. > resources\views\admin\dokumen\create.blade.php
echo. > resources\views\admin\dokumen\edit.blade.php
echo. > resources\views\admin\dokumen\show.blade.php

REM Admin Pengumuman
echo Membuat folder: resources\views\admin\pengumuman
mkdir resources\views\admin\pengumuman
echo. > resources\views\admin\pengumuman\index.blade.php
echo. > resources\views\admin\pengumuman\create.blade.php
echo. > resources\views\admin\pengumuman\edit.blade.php
echo. > resources\views\admin\pengumuman\show.blade.php

REM Admin PPDB
echo Membuat folder: resources\views\admin\ppdb
mkdir resources\views\admin\ppdb
echo. > resources\views\admin\ppdb\index.blade.php
echo. > resources\views\admin\ppdb\create.blade.php
echo. > resources\views\admin\ppdb\edit.blade.php
echo. > resources\views\admin\ppdb\show.blade.php

REM Admin PPDB - Pembayaran
echo Membuat folder: resources\views\admin\ppdb\pembayaran
mkdir resources\views\admin\ppdb\pembayaran
echo. > resources\views\admin\ppdb\pembayaran\index.blade.php
echo. > resources\views\admin\ppdb\pembayaran\create.blade.php
echo. > resources\views\admin\ppdb\pembayaran\edit.blade.php
echo. > resources\views\admin\ppdb\pembayaran\show.blade.php

REM Admin PPDB - Informasi (Jadwal, Persyaratan)
echo Membuat folder: resources\views\admin\ppdb\info
mkdir resources\views\admin\ppdb\info
echo. > resources\views\admin\ppdb\info\index.blade.php
echo. > resources\views\admin\ppdb\info\create.blade.php
echo. > resources\views\admin\ppdb\info\edit.blade.php
echo. > resources\views\admin\ppdb\info\show.blade.php

REM Admin Guru
echo Membuat folder: resources\views\admin\guru
mkdir resources\views\admin\guru
echo. > resources\views\admin\guru\index.blade.php
echo. > resources\views\admin\guru\create.blade.php
echo. > resources\views\admin\guru\edit.blade.php
echo. > resources\views\admin\guru\show.blade.php

REM Admin Staf
echo Membuat folder: resources\views\admin\staf
mkdir resources\views\admin\staf
echo. > resources\views\admin\staf\index.blade.php
echo. > resources\views\admin\staf\create.blade.php
echo. > resources\views\admin\staf\edit.blade.php
echo. > resources\views\admin\staf\show.blade.php

REM Admin Kurikulum
echo Membuat folder: resources\views\admin\kurikulum
mkdir resources\views\admin\kurikulum
echo. > resources\views\admin\kurikulum\index.blade.php
echo. > resources\views\admin\kurikulum\create.blade.php
echo. > resources\views\admin\kurikulum\edit.blade.php
echo. > resources\views\admin\kurikulum\show.blade.php

REM Admin Ekstrakurikuler
echo Membuat folder: resources\views\admin\ekstrakurikuler
mkdir resources\views\admin\ekstrakurikuler
echo. > resources\views\admin\ekstrakurikuler\index.blade.php
echo. > resources\views\admin\ekstrakurikuler\create.blade.php
echo. > resources\views\admin\ekstrakurikuler\edit.blade.php
echo. > resources\views\admin\ekstrakurikuler\show.blade.php

REM Admin Prestasi
echo Membuat folder: resources\views\admin\prestasi
mkdir resources\views\admin\prestasi
echo. > resources\views\admin\prestasi\index.blade.php
echo. > resources\views\admin\prestasi\create.blade.php
echo. > resources\views\admin\prestasi\edit.blade.php
echo. > resources\views\admin\prestasi\show.blade.php

REM Admin Pengaturan
echo Membuat folder: resources\views\admin\pengaturan
mkdir resources\views\admin\pengaturan
echo. > resources\views\admin\pengaturan\index.blade.php

echo.
echo ===========================================
echo   Pembuatan Struktur Views Selesai!
echo ===========================================
echo.
pause