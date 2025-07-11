<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PageController;

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
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\FrontContentController;
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
*/

// ========================================================================
// FRONTEND ROUTES (PUBLIC ACCESS)
// ========================================================================

Route::get('/', [HomeController::class, 'index'])->name('home');


// Tentang Kami
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
Route::get('pengumuman', [BeritaController::class, 'pengumumanIndex'])->name('pengumuman.index');
Route::get('pengumuman/{slug}', [BeritaController::class, 'pengumumanShow'])->name('pengumuman.show');

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

// Unduhan & Kontak
Route::get('unduhan', [UnduhanController::class, 'index'])->name('unduhan.index');
Route::get('unduhan/download/{id}', [UnduhanController::class, 'download'])->name('unduhan.download');
Route::get('kontak', [KontakController::class, 'index'])->name('kontak.index');
Route::post('kontak/kirim', [KontakController::class, 'store'])->name('kontak.store');


// ========================================================================
// AUTHENTICATION & PROFILE ROUTES
// ========================================================================

// Redirect /dashboard ke /admin/dashboard jika sudah login sebagai admin
Route::get('/dashboard', function () {
    if (auth()->check() && auth()->user()->hasRole('admin')) {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('home'); // Fallback ke halaman utama jika bukan admin
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


// ========================================================================
// ADMIN ROUTES (PROTECTED BY 'auth' AND 'role:admin' MIDDLEWARE)
// ========================================================================

Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    
    // Dashboard
    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Manajemen Tampilan Depan (CMS)
    Route::resource('banners', BannerController::class);
    Route::get('cms', [FrontContentController::class, 'index'])->name('cms.index');
    Route::post('cms', [FrontContentController::class, 'update'])->name('cms.update');

    // Manajemen Konten
    Route::resource('kategori-berita', AdminKategoriBeritaController::class);
    Route::resource('berita', AdminBeritaController::class);
     Route::post('berita/upload-image', [App\Http\Controllers\Admin\BeritaController::class, 'uploadImage'])->name('berita.upload-image');
    Route::resource('halaman', AdminHalamanController::class);
    Route::resource('pengumuman', AdminPengumumanController::class);
    
    // Manajemen Galeri
    Route::resource('album-galeri', AdminAlbumGaleriController::class);
    Route::resource('foto', AdminFotoController::class);
    Route::resource('video', AdminVideoController::class);

    // Manajemen Akademik
    Route::resource('guru', AdminGuruController::class);
    Route::resource('staf', AdminStafController::class);
    Route::resource('kurikulum', AdminKurikulumController::class);
    Route::resource('prestasi', AdminPrestasiController::class);
    Route::resource('ekstrakurikuler', AdminEkstrakurikulerController::class);

    // Manajemen PPDB
    Route::resource('ppdb-admin', AdminPpdbAdminController::class)->names('ppdb-admin');
    Route::resource('informasi-ppdb', AdminInformasiPpdbController::class);
    Route::resource('pembayaran-ppdb', AdminPembayaranPpdbController::class);

    // Manajemen File
    Route::resource('dokumen', AdminDokumenController::class);

    // Manajemen Sistem & Pengaturan
    Route::resource('users', AdminUserController::class);
    Route::resource('sekolah', AdminSekolahController::class)->except(['destroy']);
    Route::get('pengaturan', [AdminPengaturanController::class, 'index'])->name('pengaturan.index');
    Route::post('pengaturan', [AdminPengaturanController::class, 'update'])->name('pengaturan.update');
    Route::post('pengaturan/clear-cache', [AdminPengaturanController::class, 'clearCache'])->name('pengaturan.clear-cache');

    Route::get('/{pageSlug}', [PageController::class, 'show'])
    ->where('pageSlug', '^(?!admin|login|register|logout|storage)[a-zA-Z0-9_-]+$') // Opsi tambahan untuk keamanan
    ->name('page.show');

});