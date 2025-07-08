<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\InformasiPpdb;

class InformasiPpdbController extends Controller
{
    /**
     * Menampilkan daftar informasi PPDB (jadwal, persyaratan, dll.).
     */
    public function index(Request $request)
    {
        $query = InformasiPpdb::with('user');

        if ($request->has('search') && $request->search != '') {
            $query->where('judul', 'like', '%' . $request->search . '%')
                  ->orWhere('konten', 'like', '%' . $request->search . '%');
        }

        $informasi = $query->latest()->paginate(10);
        return View::make('admin.ppdb.info.index', compact('informasi'));
    }

    /**
     * Menampilkan formulir untuk membuat informasi PPDB baru.
     */
    public function create()
    {
        return View::make('admin.ppdb.info.create');
    }

    /**
     * Menyimpan informasi PPDB baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'tanggal_mulai' => 'nullable|date',
            'tanggal_akhir' => 'nullable|date|after_or_equal:tanggal_mulai',
        ]);

        $data = $request->except(['_token']);
        $data['slug'] = Str::slug($request->judul);
        $data['user_id'] = Auth::id();

        InformasiPpdb::create($data);

        return Redirect::route('admin.informasi-ppdb.index')->with('success', 'Informasi PPDB berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail informasi PPDB tertentu.
     */
    public function show(InformasiPpdb $informasiPpdb)
    {
        return View::make('admin.ppdb.info.show', compact('informasiPpdb'));
    }

    /**
     * Menampilkan formulir untuk mengedit informasi PPDB tertentu.
     */
    public function edit(InformasiPpdb $informasiPpdb)
    {
        return View::make('admin.ppdb.info.edit', compact('informasiPpdb'));
    }

    /**
     * Memperbarui data informasi PPDB di database.
     */
    public function update(Request $request, InformasiPpdb $informasiPpdb)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'tanggal_mulai' => 'nullable|date',
            'tanggal_akhir' => 'nullable|date|after_or_equal:tanggal_mulai',
        ]);

        $data = $request->except(['_token', '_method']);
        $data['slug'] = Str::slug($request->judul);

        $informasiPpdb->update($data);

        return Redirect::route('admin.informasi-ppdb.index')->with('success', 'Informasi PPDB berhasil diperbarui.');
    }

    /**
     * Menghapus informasi PPDB dari database.
     */
    public function destroy(InformasiPpdb $informasiPpdb)
    {
        $informasiPpdb->delete();
        return Redirect::route('admin.informasi-ppdb.index')->with('success', 'Informasi PPDB berhasil dihapus.');
    }
}