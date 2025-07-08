<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use App\Models\Foto;
use App\Models\AlbumGaleri;

class FotoController extends Controller
{
    /**
     * Menampilkan daftar foto dalam album tertentu.
     */
    public function index(Request $request)
    {
        $albumId = $request->query('album_id');
        if (!$albumId) {
            return Redirect::route('admin.album-galeri.index')->with('error', 'Album ID tidak ditemukan.');
        }

        $album = AlbumGaleri::findOrFail($albumId);
        $fotos = Foto::where('album_galeri_id', $albumId)->latest()->paginate(10);

        return View::make('admin.galeri.photos', compact('fotos', 'album'));
    }

    /**
     * Menampilkan formulir untuk membuat foto baru.
     */
    public function create(Request $request)
    {
        $albumId = $request->query('album_id');
        if (!$albumId) {
            return Redirect::route('admin.album-galeri.index')->with('error', 'Album ID tidak ditemukan.');
        }
        $album = AlbumGaleri::findOrFail($albumId);
        return View::make('admin.galeri.create_photo', compact('album'));
    }

    /**
     * Menyimpan foto baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'album_galeri_id' => 'required|exists:album_galeris,id',
            'judul' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'path' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120', // Max 5MB
        ]);

        $data = $request->except(['_token', 'path']);
        $data['path'] = $request->file('path')->store('public/galeri/foto');

        Foto::create($data);

        return Redirect::route('admin.foto.index', ['album_id' => $request->album_galeri_id])->with('success', 'Foto berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail foto tertentu.
     */
    public function show(Foto $foto)
    {
        return View::make('admin.galeri.show_photo', compact('foto'));
    }

    /**
     * Menampilkan formulir untuk mengedit foto tertentu.
     */
    public function edit(Foto $foto)
    {
        $album = $foto->albumGaleri; // Ambil album terkait
        return View::make('admin.galeri.edit_photo', compact('foto', 'album'));
    }

    /**
     * Memperbarui data foto di database.
     */
    public function update(Request $request, Foto $foto)
    {
        $request->validate([
            'judul' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
        ]);

        $data = $request->except(['_token', '_method', 'path']);

        if ($request->hasFile('path')) {
            if ($foto->path) {
                Storage::delete($foto->path);
            }
            $data['path'] = $request->file('path')->store('public/galeri/foto');
        }

        $foto->update($data);

        return Redirect::route('admin.foto.index', ['album_id' => $foto->album_galeri_id])->with('success', 'Foto berhasil diperbarui.');
    }

    /**
     * Menghapus foto dari database.
     */
    public function destroy(Foto $foto)
    {
        if ($foto->path) {
            Storage::delete($foto->path);
        }
        $albumId = $foto->album_galeri_id;
        $foto->delete();
        return Redirect::route('admin.foto.index', ['album_id' => $albumId])->with('success', 'Foto berhasil dihapus.');
    }
}