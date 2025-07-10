<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Carbon;

// Import semua model yang dibutuhkan untuk statistik
use App\Models\User;
use App\Models\Berita;
use App\Models\PendaftarPpdb;
use App\Models\Guru;
use App\Models\Staf;
use App\Models\Pengumuman;
use App\Models\AlbumGaleri;
use App\Models\Dokumen;

// Import untuk Google Analytics
use Spatie\Analytics\Facades\Analytics;
use Spatie\Analytics\Period;
use Exception;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard admin dengan ringkasan data dan grafik.
     */
    public function index()
    {
        // Ambil semua data hitungan untuk kartu statistik
        $totalBerita = Berita::count();
        $totalPendaftarPpdb = PendaftarPpdb::count();
        $totalGuru = Guru::count();
        $totalUser = User::count();
        $totalPengumuman = Pengumuman::count();
        $totalAlbumGaleri = AlbumGaleri::count();
        $totalDokumen = Dokumen::count();
        $totalStaf = Staf::count();

        // Siapkan data untuk grafik pendaftar PPDB 7 hari terakhir
        $pendaftarLabels = [];
        $pendaftarData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $pendaftarLabels[] = $date->format('d M'); // Format tanggal (e.g., 11 Jul)
            $pendaftarData[] = PendaftarPpdb::whereDate('created_at', $date)->count();
        }
        
        // Data untuk tabel aktivitas terbaru
        $pendaftarTerbaru = PendaftarPpdb::latest()->take(5)->get();
        $beritaTerbaru = Berita::latest()->take(5)->get();

        // Inisialisasi variabel analytics untuk menghindari error jika fetch gagal
        $analyticsData = null;
        $topCities = null;
        $topReferrers = null;
        
        try {
            // Cek apakah konfigurasi analytics sudah ada sebelum mencoba fetch
            if (config('analytics.property_id') && config('analytics.credentials_path')) {
                 // Ambil data dari Google Analytics
                 $analyticsData = Analytics::fetchTotalUsersAndPageViews(Period::days(28));
                 $topCities = Analytics::fetchTopCities(Period::days(28));
                 $topReferrers = Analytics::fetchTopReferrers(Period::days(28));
            }
        } catch (Exception $e) {
            // Tangani error jika konfigurasi GA belum selesai atau ada masalah koneksi.
            // Biarkan variabel null, view akan menanganinya.
            // Anda bisa juga log error ini untuk debugging:
            // \Log::error("Google Analytics fetch failed: " . $e->getMessage());
        }

        // Kirim semua data ke view dashboard admin
        return view('dashboard', compact(
            'totalBerita',
            'totalPendaftarPpdb',
            'totalGuru',
            'totalUser',
            'totalPengumuman',
            'totalAlbumGaleri',
            'totalDokumen',
            'totalStaf',
            'pendaftarLabels',
            'pendaftarData',
            'pendaftarTerbaru',
            'beritaTerbaru',
            'analyticsData',
            'topCities',      // Variabel ini sekarang sudah ada
            'topReferrers'  // Variabel ini sekarang sudah ada
        ));
    }
}
