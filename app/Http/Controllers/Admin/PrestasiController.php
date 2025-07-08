<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use App\Models\Prestasi;

class PrestasiController extends Controller
{
    /**
     * Menampilkan daftar prestasi.
     */
    public function index(Request $request)
    {
        $query = Prestasi::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('judul_prestasi', 'like', '%' . $request->search . '%')
                  ->orWhere('bidang_prestasi', 'like', '%' . $request->search . '%')
                  ->orWhere('pihak_pemberi', 'like', '%' . $request->search . '%');
        }
        if ($request->has('tingkat_prestasi') && $request->tingkat_prestasi != '') {
            $query->where('tingkat_prestasi', $request->tingkat_prestasi);
        }
        if ($request->has('tahun_perolehan') && $request->tahun_perolehan != '') {
            $query->where('tahun_perolehan', $request->tahun_perolehan);
        }

        $prestasis = $query->latest()->paginate(10);
        return View::make('admin.prestasi.index', compact('prestasis'));
    }

    /**
     * Menampilkan formulir untuk membuat prestasi baru.
     */
    public function create()
    {
        return View::make('admin.prestasi.create');
    }

    /**
     * Menyimpan prestasi baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul_prestasi' => 'required|string|max:255',
            'bidang_prestasi' => 'nullable|string|max:255',
            'tingkat_prestasi' => 'required|string|max:255',
            'tahun_perolehan' => 'nullable|integer|digits:4',
            'deskripsi' => 'nullable|string',
            'pihak_pemberi' => 'nullable|string|max:255',
            'gambar_penghargaan' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
        ]);

        $data = $request->except(['_token', 'gambar_penghargaan']);

        if ($request->hasFile('gambar_penghargaan')) {
            $data['gambar_penghargaan'] = $request->file('gambar_penghargaan')->store('public/prestasi');
        }

        Prestasi::create($data);

        return Redirect::route('admin.prestasi.index')->with('success', 'Prestasi berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail prestasi tertentu.
     */
    public function show(Prestasi $prestasi)
    {
        return View::make('admin.prestasi.show', compact('prestasi'));
    }

    /**
     * Menampilkan formulir untuk mengedit prestasi tertentu.
     */
    public function edit(Prestasi $prestasi)
    {
        return View::make('admin.prestasi.edit', compact('prestasi'));
    }

    /**
     * Memperbarui data prestasi di database.
     */
    public function update(Request $request, Prestasi $prestasi)
    {
        $request->validate([
            'judul_prestasi' => 'required|string|max:255',
            'bidang_prestasi' => 'nullable|string|max:255',
            'tingkat_prestasi' => 'required|string|max:255',
            'tahun_perolehan' => 'nullable|integer|digits:4',
            'deskripsi' => 'nullable|string',
            'pihak_pemberi' => 'nullable|string|max:255',
            'gambar_penghargaan' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
        ]);

        $data = $request->except(['_token', '_method', 'gambar_penghargaan']);

        if ($request->hasFile('gambar_penghargaan')) {
            if ($prestasi->gambar_penghargaan) {
                Storage::delete($prestasi->gambar_penghargaan);
            }
            $data['gambar_penghargaan'] = $request->file('gambar_penghargaan')->store('public/prestasi');
        }

        $prestasi->update($data);

        return Redirect::route('admin.prestasi.index')->with('success', 'Prestasi berhasil diperbarui.');
    }

    /**
     * Menghapus prestasi dari database.
     */
    public function destroy(Prestasi $prestasi)
    {
        if ($prestasi->gambar_penghargaan) {
            Storage::delete($prestasi->gambar_penghargaan);
        }
        $prestasi->delete();
        return Redirect::route('admin.prestasi.index')->with('success', 'Prestasi berhasil dihapus.');
    }
}