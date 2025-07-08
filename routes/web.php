<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

// Frontend Controllers
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TentangKamiController;
use App\Http\Controllers\AkademikController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\PpdbController;
use App\Http\Controllers\UnduhanController;
use App\Http\Controllers\KontakController;

// Admin Controllers
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\SekolahController as AdminSekolahController;
use App\Http\Controllers\Admin\BeritaController as AdminBeritaController;
use App\Http\Controllers\Admin\HalamanController as AdminHalamanController;
use App\Http\Controllers\Admin\KategoriBeritaController as AdminKategoriBeritaController;
use App\Http\Controllers\Admin\AlbumGaleriController as AdminAlbumGaleriController;
use App\Http\Controllers\Admin\FotoController as AdminFotoController;
use App\Http\Controllers\Admin\VideoController as AdminVideoController;
use App\Http\Controllers\Admin\DokumenController as AdminDokumenController;
use App\Http\Controllers\Admin\PengumumanController as AdminPengumumanController;
use App\Http\Controllers\Admin\PpdbAdminController as AdminPpdbAdminController;
use App\Http\Controllers\Admin\PembayaranPpdbController as AdminPembayaranPpdbController;
use App\Http\Controllers\Admin\InformasiPpdbController as AdminInformasiPpdbController;
use App\Http\Controllers\Admin\GuruController as AdminGuruController;
use App\Http\Controllers\Admin\StafController as AdminStafController;
use App\Http\Controllers\Admin\KurikulumController as AdminKurikulumController;
use App\Http\Controllers\Admin\EkstrakurikulerController as AdminEkstrakurikulerController;
use App\Http\Controllers\Admin\PrestasiController as AdminPrestasiController;
use App\Http\Controllers\Admin\PengaturanController as AdminPengaturanController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// ========================================================================
// FRONTEND ROUTES (PUBLIC ACCESS)
// ========================================================================

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');


Route::group(['prefix' => 'tentang-kami', 'as' => 'tentangkami.'], function () {
    Route::get('profil', [TentangKamiController::class, 'profil'])->name('profil');
    Route::get('sambutan', [TentangKamiController::class, 'sambutan'])->name('sambutan');
    Route::get('fasilitas', [TentangKamiController::class, 'fasilitas'])->name('fasilitas');
    Route::get('akreditasi-prestasi', [TentangKamiController::class, 'akreditasiPrestasi'])->name('akreditasi-prestasi');
    Route::get('lokasi-kontak', [TentangKamiController::class, 'lokasiKontak'])->name('lokasi-kontak');
});

// Akademik
Route::prefix('akademik')->name('akademik.')->group(function () {
    Route::get('kurikulum', [AkademikController::class, 'kurikulum'])->name('kurikulum');
    Route::get('program-unggulan', [AkademikController::class, 'programUnggulanEkstrakurikuler'])->name('program-unggulan');
    Route::get('guru-staf', [AkademikController::class, 'guruStaf'])->name('guru-staf');
    Route::get('beasiswa', [AkademikController::class, 'beasiswa'])->name('beasiswa');
    Route::get('ujian-kelulusan', [AkademikController::class, 'ujianKelulusan'])->name('ujian-kelulusan');
});

// Berita & Pengumuman
Route::get('berita', [BeritaController::class, 'index'])->name('berita.index');
Route::get('berita/{slug}', [BeritaController::class, 'show'])->name('berita.show');

Route::get('pengumuman', [BeritaController::class, 'pengumumanIndex'])->name('pengumuman.index'); // Menggunakan BeritaController untuk pengumuman
Route::get('pengumuman/{slug}', [BeritaController::class, 'pengumumanShow'])->name('pengumuman.show'); // Menggunakan BeritaController untuk pengumuman

// Galeri
Route::get('galeri', [GaleriController::class, 'index'])->name('galeri.index');
Route::get('galeri/{slug}', [GaleriController::class, 'show'])->name('galeri.show');

// PPDB (Penerimaan Peserta Didik Baru)
Route::prefix('ppdb')->name('ppdb.')->group(function () {
    Route::get('/', [PpdbController::class, 'index'])->name('index');
    Route::get('daftar', [PpdbController::class, 'daftar'])->name('daftar');
    Route::post('daftar', [PpdbController::class, 'store'])->name('daftar.store');
    Route::get('daftar/sukses', [PpdbController::class, 'daftarSukses'])->name('daftar.sukses');
    Route::get('cek-status', [PpdbController::class, 'cekStatus'])->name('cek-status');
    Route::post('cek-status', [PpdbController::class, 'prosesCekStatus'])->name('cek-status.proses');
    Route::get('hasil', [PpdbController::class, 'hasil'])->name('hasil');
    Route::get('daftar-ulang', [PpdbController::class, 'daftarUlang'])->name('daftar-ulang');
    Route::get('bukti-daftar/{nomor_pendaftaran}', [PpdbController::class, 'buktiDaftar'])->name('bukti-daftar');
});

// Unduhan
Route::get('unduhan', [UnduhanController::class, 'index'])->name('unduhan.index');
Route::get('unduhan/download/{id}', [UnduhanController::class, 'download'])->name('unduhan.download');

// Kontak
Route::get('kontak', [KontakController::class, 'index'])->name('kontak.index');
Route::post('kontak/kirim', [KontakController::class, 'store'])->name('kontak.store');


// ========================================================================
// AUTHENTICATION & PROFILE ROUTES (Laravel Breeze/UI Defaults)
// ========================================================================

Route::get('/dashboard', function () {
    return view('dashboard'); // Ini bisa diubah ke dashboard admin jika user adalah admin
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


// ========================================================================
// ADMIN ROUTES (PROTECTED)
// Pastikan user memiliki role 'admin' untuk mengakses rute ini
// Anda perlu mengkonfigurasi middleware 'role' dari spatie/laravel-permission
// di app/Http/Kernel.php jika belum.
// Contoh: 'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
// ========================================================================

Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    // Dashboard Admin
    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Manajemen Pengguna (Admin)
    Route::resource('users', AdminUserController::class);

    // Informasi Sekolah (Admin)
    // Karena biasanya hanya ada satu entri, bisa jadi bukan resource penuh
    Route::get('sekolah', [AdminSekolahController::class, 'index'])->name('sekolah.index');
    Route::get('sekolah/create', [AdminSekolahController::class, 'create'])->name('sekolah.create');
    Route::post('sekolah', [AdminSekolahController::class, 'store'])->name('sekolah.store');
    Route::get('sekolah/{sekolah}/edit', [AdminSekolahController::class, 'edit'])->name('sekolah.edit');
    Route::put('sekolah/{sekolah}', [AdminSekolahController::class, 'update'])->name('sekolah.update');
    Route::delete('sekolah/{sekolah}', [AdminSekolahController::class, 'destroy'])->name('sekolah.destroy'); // Opsional
    Route::get('sekolah/{sekolah}', [AdminSekolahController::class, 'show'])->name('sekolah.show');


    // Manajemen Berita
    Route::resource('berita', AdminBeritaController::class);

    // Manajemen Halaman Statis
    Route::resource('halaman', AdminHalamanController::class);

    // Manajemen Kategori Berita
    Route::resource('kategori-berita', AdminKategoriBeritaController::class);

    // Manajemen Album Galeri
    Route::resource('album-galeri', AdminAlbumGaleriController::class);

    // Manajemen Foto (nested under album or standalone)
    // Menggunakan parameter 'album_id' untuk konteks
    Route::resource('foto', AdminFotoController::class)->except(['index']); // Index akan custom
    Route::get('foto', [AdminFotoController::class, 'index'])->name('foto.index'); // Custom index untuk filter by album

    // Manajemen Video (nested under album or standalone)
    // Menggunakan parameter 'album_id' untuk konteks
    Route::resource('video', AdminVideoController::class)->except(['index']); // Index akan custom
    Route::get('video', [AdminVideoController::class, 'index'])->name('video.index'); // Custom index untuk filter by album

    // Manajemen Dokumen
    Route::resource('dokumen', AdminDokumenController::class);

    // Manajemen Pengumuman
    Route::resource('pengumuman', AdminPengumumanController::class);

    // Manajemen PPDB (Admin Panel)
    Route::resource('ppdb-admin', AdminPpdbAdminController::class);

    // Manajemen Pembayaran PPDB
    Route::resource('pembayaran-ppdb', AdminPembayaranPpdbController::class);

    // Manajemen Informasi PPDB (Jadwal, Persyaratan)
    Route::resource('informasi-ppdb', AdminInformasiPpdbController::class);

    // Manajemen Guru
    Route::resource('guru', AdminGuruController::class);

    // Manajemen Staf
    Route::resource('staf', AdminStafController::class);

    // Manajemen Kurikulum
    Route::resource('kurikulum', AdminKurikulumController::class);

    // Manajemen Ekstrakurikuler
    Route::resource('ekstrakurikuler', AdminEkstrakurikulerController::class);

    // Manajemen Prestasi
    Route::resource('prestasi', AdminPrestasiController::class);

    // Pengaturan Umum Situs
    Route::get('pengaturan', [AdminPengaturanController::class, 'index'])->name('pengaturan.index');
    Route::post('pengaturan', [AdminPengaturanController::class, 'update'])->name('pengaturan.update');
});