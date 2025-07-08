<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Dokumen;

class DokumenController extends Controller
{
    /**
     * Menampilkan daftar dokumen.
     */
    public function index(Request $request)
    {
        $query = Dokumen::with('user');

        if ($request->has('search') && $request->search != '') {
            $query->where('nama', 'like', '%' . $request->search . '%')
                  ->orWhere('deskripsi', 'like', '%' . $request->search . '%');
        }
        if ($request->has('tipe_file') && $request->tipe_file != '') {
            $query->where('tipe_file', $request->tipe_file);
        }

        $dokumens = $query->latest()->paginate(10);
        return View::make('admin.dokumen.index', compact('dokumens'));
    }

    /**
     * Menampilkan formulir untuk membuat dokumen baru.
     */
    public function create()
    {
        return View::make('admin.dokumen.create');
    }

    /**
     * Menyimpan dokumen baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:10240', // Max 10MB
        ]);

        $data = $request->except(['_token', 'file']);
        $data['user_id'] = Auth::id();

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $data['path'] = $file->store('public/dokumen');
            $data['tipe_file'] = $file->getClientOriginalExtension();
            $data['ukuran_file'] = $file->getSize(); // Ukuran dalam byte
        }

        Dokumen::create($data);

        return Redirect::route('admin.dokumen.index')->with('success', 'Dokumen berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail dokumen tertentu.
     */
    public function show(Dokumen $dokuman) // Variabel otomatis diubah Laravel
    {
        return View::make('admin.dokumen.show', compact('dokuman'));
    }

    /**
     * Menampilkan formulir untuk mengedit dokumen tertentu.
     */
    public function edit(Dokumen $dokuman)
    {
        return View::make('admin.dokumen.edit', compact('dokuman'));
    }

    /**
     * Memperbarui data dokumen di database.
     */
    public function update(Request $request, Dokumen $dokuman)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:10240',
        ]);

        $data = $request->except(['_token', '_method', 'file']);

        if ($request->hasFile('file')) {
            if ($dokuman->path) {
                Storage::delete($dokuman->path);
            }
            $file = $request->file('file');
            $data['path'] = $file->store('public/dokumen');
            $data['tipe_file'] = $file->getClientOriginalExtension();
            $data['ukuran_file'] = $file->getSize();
        }

        $dokuman->update($data);

        return Redirect::route('admin.dokumen.index')->with('success', 'Dokumen berhasil diperbarui.');
    }

    /**
     * Menghapus dokumen dari database.
     */
    public function destroy(Dokumen $dokuman)
    {
        if ($dokuman->path) {
            Storage::delete($dokuman->path);
        }
        $dokuman->delete();
        return Redirect::route('admin.dokumen.index')->with('success', 'Dokumen berhasil dihapus.');
    }
}