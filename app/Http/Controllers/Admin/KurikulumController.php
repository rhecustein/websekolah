<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Kurikulum;

class KurikulumController extends Controller
{
    /**
     * Menampilkan daftar kurikulum.
     */
    public function index(Request $request)
    {
        $query = Kurikulum::with('user');

        if ($request->has('search') && $request->search != '') {
            $query->where('nama_kurikulum', 'like', '%' . $request->search . '%')
                  ->orWhere('deskripsi', 'like', '%' . $request->search . '%');
        }
        if ($request->has('jenjang') && $request->jenjang != '') {
            $query->where('jenjang', $request->jenjang);
        }

        $kurikulums = $query->latest()->paginate(10);
        return View::make('admin.kurikulum.index', compact('kurikulums'));
    }

    /**
     * Menampilkan formulir untuk membuat kurikulum baru.
     */
    public function create()
    {
        return View::make('admin.kurikulum.create');
    }

    /**
     * Menyimpan kurikulum baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kurikulum' => 'required|string|max:255',
            'jenjang' => 'required|string|max:255', // Bisa diubah jadi array string jika multiple jenjang
            'deskripsi' => 'nullable|string',
            'file_panduan' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
        ]);

        $data = $request->except(['_token', 'file_panduan']);
        $data['user_id'] = Auth::id();

        if ($request->hasFile('file_panduan')) {
            $data['file_panduan'] = $request->file('file_panduan')->store('public/kurikulum');
        }

        Kurikulum::create($data);

        return Redirect::route('admin.kurikulum.index')->with('success', 'Kurikulum berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail kurikulum tertentu.
     */
    public function show(Kurikulum $kurikulum)
    {
        return View::make('admin.kurikulum.show', compact('kurikulum'));
    }

    /**
     * Menampilkan formulir untuk mengedit kurikulum tertentu.
     */
    public function edit(Kurikulum $kurikulum)
    {
        return View::make('admin.kurikulum.edit', compact('kurikulum'));
    }

    /**
     * Memperbarui data kurikulum di database.
     */
    public function update(Request $request, Kurikulum $kurikulum)
    {
        $request->validate([
            'nama_kurikulum' => 'required|string|max:255',
            'jenjang' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'file_panduan' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
        ]);

        $data = $request->except(['_token', '_method', 'file_panduan']);

        if ($request->hasFile('file_panduan')) {
            if ($kurikulum->file_panduan) {
                Storage::delete($kurikulum->file_panduan);
            }
            $data['file_panduan'] = $request->file('file_panduan')->store('public/kurikulum');
        }

        $kurikulum->update($data);

        return Redirect::route('admin.kurikulum.index')->with('success', 'Kurikulum berhasil diperbarui.');
    }

    /**
     * Menghapus kurikulum dari database.
     */
    public function destroy(Kurikulum $kurikulum)
    {
        if ($kurikulum->file_panduan) {
            Storage::delete($kurikulum->file_panduan);
        }
        $kurikulum->delete();
        return Redirect::route('admin.kurikulum.index')->with('success', 'Kurikulum berhasil dihapus.');
    }
}