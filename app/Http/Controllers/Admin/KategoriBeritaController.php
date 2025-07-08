<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use App\Models\KategoriBerita;

class KategoriBeritaController extends Controller
{
    /**
     * Menampilkan daftar kategori berita.
     */
    public function index(Request $request)
    {
        $query = KategoriBerita::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('nama', 'like', '%' . $request->search . '%')
                  ->orWhere('deskripsi', 'like', '%' . $request->search . '%');
        }

        $kategoris = $query->latest()->paginate(10);
        return View::make('admin.kategori-berita.index', compact('kategoris'));
    }

    /**
     * Menampilkan formulir untuk membuat kategori berita baru.
     */
    public function create()
    {
        return View::make('admin.kategori-berita.create');
    }

    /**
     * Menyimpan kategori berita baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:kategori_beritas,nama',
            'deskripsi' => 'nullable|string',
        ]);

        $data = $request->except(['_token']);
        $data['slug'] = Str::slug($request->nama);

        KategoriBerita::create($data);

        return Redirect::route('admin.kategori-berita.index')->with('success', 'Kategori berita berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail kategori berita tertentu.
     */
    public function show(KategoriBerita $kategoriBeritum) // Variabel otomatis diubah Laravel
    {
        return View::make('admin.kategori-berita.show', compact('kategoriBeritum'));
    }

    /**
     * Menampilkan formulir untuk mengedit kategori berita tertentu.
     */
    public function edit(KategoriBerita $kategoriBeritum)
    {
        return View::make('admin.kategori-berita.edit', compact('kategoriBeritum'));
    }

    /**
     * Memperbarui data kategori berita di database.
     */
    public function update(Request $request, KategoriBerita $kategoriBeritum)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:kategori_beritas,nama,' . $kategoriBeritum->id,
            'deskripsi' => 'nullable|string',
        ]);

        $data = $request->except(['_token', '_method']);
        $data['slug'] = Str::slug($request->nama);

        $kategoriBeritum->update($data);

        return Redirect::route('admin.kategori-berita.index')->with('success', 'Kategori berita berhasil diperbarui.');
    }

    /**
     * Menghapus kategori berita dari database.
     */
    public function destroy(KategoriBerita $kategoriBeritum)
    {
        $kategoriBeritum->delete();
        return Redirect::route('admin.kategori-berita.index')->with('success', 'Kategori berita berhasil dihapus.');
    }
}