<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use App\Models\Video;
use App\Models\AlbumGaleri;

class VideoController extends Controller
{
    /**
     * Menampilkan daftar video dalam album tertentu.
     */
    public function index(Request $request)
    {
        $albumId = $request->query('album_id');
        if (!$albumId) {
            return Redirect::route('admin.album-galeri.index')->with('error', 'Album ID tidak ditemukan.');
        }

        $album = AlbumGaleri::findOrFail($albumId);
        $videos = Video::where('album_galeri_id', $albumId)->latest()->paginate(10);

        return View::make('admin.galeri.videos', compact('videos', 'album'));
    }

    /**
     * Menampilkan formulir untuk membuat video baru.
     */
    public function create(Request $request)
    {
        $albumId = $request->query('album_id');
        if (!$albumId) {
            return Redirect::route('admin.album-galeri.index')->with('error', 'Album ID tidak ditemukan.');
        }
        $album = AlbumGaleri::findOrFail($albumId);
        return View::make('admin.galeri.create_video', compact('album'));
    }

    /**
     * Menyimpan video baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'album_galeri_id' => 'required|exists:album_galeris,id',
            'judul' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'url' => 'required|url', // URL video (misal YouTube, Vimeo)
            'thumbnail' => 'nullable|url', // URL thumbnail video
        ]);

        Video::create($request->all());

        return Redirect::route('admin.video.index', ['album_id' => $request->album_galeri_id])->with('success', 'Video berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail video tertentu.
     */
    public function show(Video $video)
    {
        return View::make('admin.galeri.show_video', compact('video'));
    }

    /**
     * Menampilkan formulir untuk mengedit video tertentu.
     */
    public function edit(Video $video)
    {
        $album = $video->albumGaleri;
        return View::make('admin.galeri.edit_video', compact('video', 'album'));
    }

    /**
     * Memperbarui data video di database.
     */
    public function update(Request $request, Video $video)
    {
        $request->validate([
            'judul' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'url' => 'required|url',
            'thumbnail' => 'nullable|url',
        ]);

        $video->update($request->all());

        return Redirect::route('admin.video.index', ['album_id' => $video->album_galeri_id])->with('success', 'Video berhasil diperbarui.');
    }

    /**
     * Menghapus video dari database.
     */
    public function destroy(Video $video)
    {
        $albumId = $video->album_galeri_id;
        $video->delete();
        return Redirect::route('admin.video.index', ['album_id' => $albumId])->with('success', 'Video berhasil dihapus.');
    }
}