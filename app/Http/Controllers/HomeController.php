<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\Berita;
use App\Models\Pengumuman;
use App\Models\Sekolah; // Untuk informasi umum sekolah di homepage

class HomeController extends Controller
{
    /**
     * Menampilkan halaman beranda (homepage).
     * Akan menampilkan ringkasan berita, pengumuman, dan informasi utama sekolah.
     */
    public function index()
    {
        // Ambil berita terbaru yang sudah dipublikasikan
        $beritaTerbaru = Berita::where('status', 'published')
                               ->latest('published_at')
                               ->take(3) // Ambil 3 berita terbaru
                               ->get();

        // Ambil pengumuman terbaru yang sudah dipublikasikan
        $pengumumanTerbaru = Pengumuman::where('status', 'published')
                                      ->latest('published_at')
                                      ->take(3) // Ambil 3 pengumuman terbaru
                                      ->get();

        // Ambil data sekolah (misal untuk tagline atau deskripsi singkat)
        $sekolahInfo = Sekolah::first(); // Asumsi hanya ada satu entri sekolah

        return View::make('home.index', compact('beritaTerbaru', 'pengumumanTerbaru', 'sekolahInfo'));
    }
}