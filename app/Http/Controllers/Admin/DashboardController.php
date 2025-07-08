<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\Berita; // Contoh model yang mungkin dihitung
use App\Models\PendaftarPpdb; // Contoh model yang mungkin dihitung

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard admin.
     * Di sini Anda bisa menampilkan ringkasan statistik, pengumuman terbaru, dll.
     */
    public function index()
    {
        // Contoh: Ambil data untuk ringkasan dashboard
        $totalBerita = Berita::count();
        $totalPendaftarPpdb = PendaftarPpdb::count();
        $pendaftarTerbaru = PendaftarPpdb::latest()->take(5)->get();
        $beritaTerbaru = Berita::latest()->take(5)->get();

        return View::make('admin.dashboard.index', compact(
            'totalBerita',
            'totalPendaftarPpdb',
            'pendaftarTerbaru',
            'beritaTerbaru'
        ));
    }
}