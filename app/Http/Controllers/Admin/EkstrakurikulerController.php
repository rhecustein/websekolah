<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use App\Models\Ekstrakurikuler;

class EkstrakurikulerController extends Controller
{
    /**
     * Menampilkan daftar ekstrakurikuler.
     */
    public function index(Request $request)
    {
        $query = Ekstrakurikuler::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('nama', 'like', '%' . $request->search . '%')
                  ->orWhere('deskripsi', 'like', '%' . $request->search . '%')
                  ->orWhere('pembimbing', 'like', '%' . $request->search . '%');
        }

        $ekstrakurikulers = $query->latest()->paginate(10);
        return View::make('admin.ekstrakurikuler.index', compact('ekstrakurikulers'));
    }

    /**
     * Menampilkan formulir untuk membuat ekstrakurikuler baru.
     */
    public function create()
    {
        return View::make('admin.ekstrakurikuler.create');
    }

    /**
     * Menyimpan ekstrakurikuler baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'jadwal' => 'nullable|string|max:255',
            'pembimbing' => 'nullable|string|max:255',
            'gambar_ikon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->except(['_token', 'gambar_ikon']);

        if ($request->hasFile('gambar_ikon')) {
            $data['gambar_ikon'] = $request->file('gambar_ikon')->store('public/ekstrakurikuler');
        }

        Ekstrakurikuler::create($data);

        return Redirect::route('admin.ekstrakurikuler.index')->with('success', 'Ekstrakurikuler berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail ekstrakurikuler tertentu.
     */
    public function show(Ekstrakurikuler $ekstrakurikuler)
    {
        return View::make('admin.ekstrakurikuler.show', compact('ekstrakurikuler'));
    }

    /**
     * Menampilkan formulir untuk mengedit ekstrakurikuler tertentu.
     */
    public function edit(Ekstrakurikuler $ekstrakurikuler)
    {
        return View::make('admin.ekstrakurikuler.edit', compact('ekstrakurikuler'));
    }

    /**
     * Memperbarui data ekstrakurikuler di database.
     */
    public function update(Request $request, Ekstrakurikuler $ekstrakurikuler)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'jadwal' => 'nullable|string|max:255',
            'pembimbing' => 'nullable|string|max:255',
            'gambar_ikon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->except(['_token', '_method', 'gambar_ikon']);

        if ($request->hasFile('gambar_ikon')) {
            if ($ekstrakurikuler->gambar_ikon) {
                Storage::delete($ekstrakurikuler->gambar_ikon);
            }
            $data['gambar_ikon'] = $request->file('gambar_ikon')->store('public/ekstrakurikuler');
        }

        $ekstrakurikuler->update($data);

        return Redirect::route('admin.ekstrakurikuler.index')->with('success', 'Ekstrakurikuler berhasil diperbarui.');
    }

    /**
     * Menghapus ekstrakurikuler dari database.
     */
    public function destroy(Ekstrakurikuler $ekstrakurikuler)
    {
        if ($ekstrakurikuler->gambar_ikon) {
            Storage::delete($ekstrakurikuler->gambar_ikon);
        }
        $ekstrakurikuler->delete();
        return Redirect::route('admin.ekstrakurikuler.index')->with('success', 'Ekstrakurikuler berhasil dihapus.');
    }
}