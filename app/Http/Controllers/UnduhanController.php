<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use App\Models\Dokumen;

class UnduhanController extends Controller
{
    /**
     * Menampilkan daftar dokumen yang bisa diunduh.
     */
    public function index(Request $request)
    {
        $query = Dokumen::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('nama', 'like', '%' . $request->search . '%')
                  ->orWhere('deskripsi', 'like', '%' . $request->search . '%');
        }
        if ($request->has('tipe_file') && $request->tipe_file != '') {
            $query->where('tipe_file', $request->tipe_file);
        }

        $dokumens = $query->latest()->paginate(10);
        return View::make('unduhan.index', compact('dokumens'));
    }

    /**
     * Mengunduh file dokumen.
     */
    public function download($id)
    {
        $dokumen = Dokumen::findOrFail($id);

        // Pastikan file ada di storage
        if (Storage::exists($dokumen->path)) {
            return Storage::download($dokumen->path, $dokumen->nama . '.' . $dokumen->tipe_file);
        } else {
            return Redirect::back()->with('error', 'File tidak ditemukan.');
        }
    }
}