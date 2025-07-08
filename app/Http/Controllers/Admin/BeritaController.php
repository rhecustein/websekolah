<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str; // Untuk slug
use Illuminate\Support\Facades\Auth; // Untuk mendapatkan user yang sedang login
use Illuminate\Support\Facades\Storage; // Untuk upload file
use App\Models\Berita;
use App\Models\KategoriBerita;

class BeritaController extends Controller
{
    /**
     * Menampilkan daftar berita.
     */
    public function index(Request $request)
    {
        $query = Berita::with('kategoriBerita', 'user');

        // Filter pencarian
        if ($request->has('search') && $request->search != '') {
            $query->where('judul', 'like', '%' . $request->search . '%')
                  ->orWhere('konten', 'like', '%' . $request->search . '%');
        }
        // Filter kategori
        if ($request->has('kategori') && $request->kategori != '') {
            $query->where('kategori_berita_id', $request->kategori);
        }
        // Filter status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $beritas = $query->latest()->paginate(10);
        $kategoris = KategoriBerita::all(); // Untuk filter di view

        return View::make('admin.berita.index', compact('beritas', 'kategoris'));
    }

    /**
     * Menampilkan formulir untuk membuat berita baru.
     */
    public function create()
    {
        $kategoris = KategoriBerita::all();
        return View::make('admin.berita.create', compact('kategoris'));
    }

    /**
     * Menyimpan berita baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori_berita_id' => 'required|exists:kategori_beritas,id',
            'konten' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|in:draft,published,archived',
            'published_at' => 'nullable|date',
        ]);

        $data = $request->except(['_token', 'thumbnail']);
        $data['slug'] = Str::slug($request->judul);
        $data['user_id'] = Auth::id(); // Otomatis ambil ID user yang login

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('public/berita/thumbnails');
        }

        Berita::create($data);

        return Redirect::route('admin.berita.index')->with('success', 'Berita berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail berita tertentu.
     */
    public function show(Berita $berita)
    {
        return View::make('admin.berita.show', compact('berita'));
    }

    /**
     * Menampilkan formulir untuk mengedit berita tertentu.
     */
    public function edit(Berita $berita)
    {
        $kategoris = KategoriBerita::all();
        return View::make('admin.berita.edit', compact('berita', 'kategoris'));
    }

    /**
     * Memperbarui data berita di database.
     */
    public function update(Request $request, Berita $berita)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori_berita_id' => 'required|exists:kategori_beritas,id',
            'konten' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|in:draft,published,archived',
            'published_at' => 'nullable|date',
        ]);

        $data = $request->except(['_token', '_method', 'thumbnail']);
        $data['slug'] = Str::slug($request->judul); // Perbarui slug jika judul berubah

        if ($request->hasFile('thumbnail')) {
            if ($berita->thumbnail) {
                Storage::delete($berita->thumbnail);
            }
            $data['thumbnail'] = $request->file('thumbnail')->store('public/berita/thumbnails');
        }

        $berita->update($data);

        return Redirect::route('admin.berita.index')->with('success', 'Berita berhasil diperbarui.');
    }

    /**
     * Menghapus berita dari database.
     */
    public function destroy(Berita $berita)
    {
        if ($berita->thumbnail) {
            Storage::delete($berita->thumbnail);
        }
        $berita->delete();
        return Redirect::route('admin.berita.index')->with('success', 'Berita berhasil dihapus.');
    }
}