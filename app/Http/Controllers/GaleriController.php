<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\AlbumGaleri;
use App\Models\Foto;
use App\Models\Video;

class GaleriController extends Controller
{
    /**
     * Menampilkan daftar semua album galeri.
     */
    public function index(Request $request)
    {
        $query = AlbumGaleri::query();

        if ($request->has('tipe') && $request->tipe != '') {
            $query->where('tipe', $request->tipe);
        }

        $albums = $query->latest()->paginate(12); // Tampilkan 12 album per halaman
        return View::make('galeri.index', compact('albums'));
    }

    /**
     * Menampilkan isi dari album galeri tertentu (foto dan/atau video).
     */
    public function show($slug)
    {
        $album = AlbumGaleri::where('slug', $slug)->firstOrFail();

        $fotos = collect();
        $videos = collect();

        // Ambil foto jika tipe album adalah 'foto' atau 'campuran'
        if (in_array($album->tipe, ['foto', 'campuran'])) {
            $fotos = Foto::where('album_galeri_id', $album->id)->latest()->get();
        }

        // Ambil video jika tipe album adalah 'video' atau 'campuran'
        if (in_array($album->tipe, ['video', 'campuran'])) {
            $videos = Video::where('album_galeri_id', $album->id)->latest()->get();
        }

        return View::make('galeri.album', compact('album', 'fotos', 'videos'));
    }
}