<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\AlbumGaleri;

class AlbumGaleriController extends Controller
{
    /**
     * Menampilkan daftar album galeri.
     */
    public function index(Request $request)
    {
        $query = AlbumGaleri::with('user');

        if ($request->has('search') && $request->search != '') {
            $query->where('nama', 'like', '%' . $request->search . '%')
                  ->orWhere('deskripsi', 'like', '%' . $request->search . '%');
        }
        if ($request->has('tipe') && $request->tipe != '') {
            $query->where('tipe', $request->tipe);
        }

        $albums = $query->latest()->paginate(10);
        return View::make('admin.galeri.index', compact('albums'));
    }

    /**
     * Menampilkan formulir untuk membuat album galeri baru.
     */
    public function create()
    {
        return View::make('admin.galeri.create');
    }

    /**
     * Menyimpan album galeri baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:album_galeris,nama',
            'deskripsi' => 'nullable|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'tipe' => 'required|in:foto,video,campuran',
        ]);

        $data = $request->except(['_token', 'thumbnail']);
        $data['slug'] = Str::slug($request->nama);
        $data['user_id'] = Auth::id();

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('public/galeri/thumbnails');
        }

        AlbumGaleri::create($data);

        return Redirect::route('admin.album-galeri.index')->with('success', 'Album galeri berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail album galeri tertentu.
     */
    public function show(AlbumGaleri $albumGaleri)
    {
        // Di sini Anda bisa menampilkan daftar foto/video di dalam album
        return View::make('admin.galeri.show', compact('albumGaleri'));
    }

    /**
     * Menampilkan formulir untuk mengedit album galeri tertentu.
     */
    public function edit(AlbumGaleri $albumGaleri)
    {
        return View::make('admin.galeri.edit', compact('albumGaleri'));
    }

    /**
     * Memperbarui data album galeri di database.
     */
    public function update(Request $request, AlbumGaleri $albumGaleri)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:album_galeris,nama,' . $albumGaleri->id,
            'deskripsi' => 'nullable|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'tipe' => 'required|in:foto,video,campuran',
        ]);

        $data = $request->except(['_token', '_method', 'thumbnail']);
        $data['slug'] = Str::slug($request->nama);

        if ($request->hasFile('thumbnail')) {
            if ($albumGaleri->thumbnail) {
                Storage::delete($albumGaleri->thumbnail);
            }
            $data['thumbnail'] = $request->file('thumbnail')->store('public/galeri/thumbnails');
        }

        $albumGaleri->update($data);

        return Redirect::route('admin.album-galeri.index')->with('success', 'Album galeri berhasil diperbarui.');
    }

    /**
     * Menghapus album galeri dari database.
     */
    public function destroy(AlbumGaleri $albumGaleri)
    {
        if ($albumGaleri->thumbnail) {
            Storage::delete($albumGaleri->thumbnail);
        }
        // Pastikan juga menghapus semua foto/video terkait jika tidak menggunakan Spatie MediaLibrary
        // Jika menggunakan Spatie MediaLibrary, relasi dan penghapusan media akan otomatis
        $albumGaleri->delete();
        return Redirect::route('admin.album-galeri.index')->with('success', 'Album galeri berhasil dihapus.');
    }
}