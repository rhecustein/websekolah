<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\Berita;
use App\Models\KategoriBerita;
use App\Models\Pengumuman; // Untuk menampilkan pengumuman di sidebar berita

class BeritaController extends Controller
{
    /**
     * Menampilkan daftar semua berita yang sudah dipublikasikan.
     */
    public function index(Request $request)
    {
        $query = Berita::where('status', 'published')->with('kategoriBerita', 'user');

        // Filter berdasarkan kategori
        if ($request->has('kategori') && $request->kategori != '') {
            $kategori = KategoriBerita::where('slug', $request->kategori)->first();
            if ($kategori) {
                $query->where('kategori_berita_id', $kategori->id);
            }
        }

        // Filter pencarian
        if ($request->has('search') && $request->search != '') {
            $query->where(function($q) use ($request) {
                $q->where('judul', 'like', '%' . $request->search . '%')
                  ->orWhere('konten', 'like', '%' . $request->search . '%');
            });
        }

        $beritas = $query->latest('published_at')->paginate(9); // Tampilkan 9 berita per halaman
        $kategoris = KategoriBerita::all(); // Untuk filter kategori di sidebar
        $pengumumanTerbaru = Pengumuman::where('status', 'published')->latest('published_at')->take(5)->get(); // Pengumuman di sidebar

        return View::make('berita.index', compact('beritas', 'kategoris', 'pengumumanTerbaru'));
    }

    /**
     * Menampilkan detail berita tertentu.
     */
    public function show($slug)
    {
        $berita = Berita::where('slug', $slug)
                        ->where('status', 'published')
                        ->with('kategoriBerita', 'user')
                        ->firstOrFail();

        // Tambah jumlah views (opsional)
        $berita->increment('views_count');

        $beritaTerkait = Berita::where('kategori_berita_id', $berita->kategori_berita_id)
                               ->where('id', '!=', $berita->id)
                               ->where('status', 'published')
                               ->latest('published_at')
                               ->take(3)
                               ->get();

        $kategoris = KategoriBerita::all(); // Untuk sidebar
        $pengumumanTerbaru = Pengumuman::where('status', 'published')->latest('published_at')->take(5)->get(); // Pengumuman di sidebar

        return View::make('berita.show', compact('berita', 'beritaTerkait', 'kategoris', 'pengumumanTerbaru'));
    }

    /**
     * Menampilkan daftar semua pengumuman yang sudah dipublikasikan.
     */
    public function pengumumanIndex(Request $request)
    {
        $query = Pengumuman::where('status', 'published')->with('user');

        if ($request->has('search') && $request->search != '') {
            $query->where('judul', 'like', '%' . $request->search . '%')
                  ->orWhere('konten', 'like', '%' . $request->search . '%');
        }

        $pengumumans = $query->latest('published_at')->paginate(10);
        $kategoris = KategoriBerita::all(); // Untuk konsistensi sidebar
        $beritaTerbaru = Berita::where('status', 'published')->latest('published_at')->take(5)->get(); // Berita di sidebar

        return View::make('pengumuman.index', compact('pengumumans', 'kategoris', 'beritaTerbaru'));
    }

    /**
     * Menampilkan detail pengumuman tertentu.
     */
    public function pengumumanShow($slug)
    {
        $pengumuman = Pengumuman::where('slug', $slug)
                                ->where('status', 'published')
                                ->with('user')
                                ->firstOrFail();

        $kategoris = KategoriBerita::all(); // Untuk sidebar
        $beritaTerbaru = Berita::where('status', 'published')->latest('published_at')->take(5)->get(); // Berita di sidebar

        return View::make('pengumuman.show', compact('pengumuman', 'kategoris', 'beritaTerbaru'));
    }
}