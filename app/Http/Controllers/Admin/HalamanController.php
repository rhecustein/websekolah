<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Halaman;

class HalamanController extends Controller
{
    /**
     * Menampilkan daftar halaman statis.
     */
    public function index(Request $request)
    {
        $query = Halaman::with('user');

        if ($request->has('search') && $request->search != '') {
            $query->where('judul', 'like', '%' . $request->search . '%')
                  ->orWhere('konten', 'like', '%' . $request->search . '%');
        }
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $halamans = $query->latest()->paginate(10);
        return View::make('admin.halaman.index', compact('halamans'));
    }

    /**
     * Menampilkan formulir untuk membuat halaman baru.
     */
    public function create()
    {
        return View::make('admin.halaman.create');
    }

    /**
     * Menyimpan halaman baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'status' => 'required|in:draft,published',
        ]);

        $data = $request->except(['_token']);
        $data['slug'] = Str::slug($request->judul);
        $data['user_id'] = Auth::id();

        Halaman::create($data);

        return Redirect::route('admin.halaman.index')->with('success', 'Halaman berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail halaman tertentu.
     */
    public function show(Halaman $halaman)
    {
        return View::make('admin.halaman.show', compact('halaman'));
    }

    /**
     * Menampilkan formulir untuk mengedit halaman tertentu.
     */
    public function edit(Halaman $halaman)
    {
        return View::make('admin.halaman.edit', compact('halaman'));
    }

    /**
     * Memperbarui data halaman di database.
     */
    public function update(Request $request, Halaman $halaman)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'status' => 'required|in:draft,published',
        ]);

        $data = $request->except(['_token', '_method']);
        $data['slug'] = Str::slug($request->judul);

        $halaman->update($data);

        return Redirect::route('admin.halaman.index')->with('success', 'Halaman berhasil diperbarui.');
    }

    /**
     * Menghapus halaman dari database.
     */
    public function destroy(Halaman $halaman)
    {
        $halaman->delete();
        return Redirect::route('admin.halaman.index')->with('success', 'Halaman berhasil dihapus.');
    }
}