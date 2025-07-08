<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Pengumuman;

class PengumumanController extends Controller
{
    /**
     * Menampilkan daftar pengumuman.
     */
    public function index(Request $request)
    {
        $query = Pengumuman::with('user');

        if ($request->has('search') && $request->search != '') {
            $query->where('judul', 'like', '%' . $request->search . '%')
                  ->orWhere('konten', 'like', '%' . $request->search . '%');
        }
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $pengumumans = $query->latest()->paginate(10);
        return View::make('admin.pengumuman.index', compact('pengumumans'));
    }

    /**
     * Menampilkan formulir untuk membuat pengumuman baru.
     */
    public function create()
    {
        return View::make('admin.pengumuman.create');
    }

    /**
     * Menyimpan pengumuman baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'status' => 'required|in:draft,published,archived',
            'published_at' => 'nullable|date',
        ]);

        $data = $request->except(['_token']);
        $data['slug'] = Str::slug($request->judul);
        $data['user_id'] = Auth::id();

        Pengumuman::create($data);

        return Redirect::route('admin.pengumuman.index')->with('success', 'Pengumuman berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail pengumuman tertentu.
     */
    public function show(Pengumuman $pengumuman)
    {
        return View::make('admin.pengumuman.show', compact('pengumuman'));
    }

    /**
     * Menampilkan formulir untuk mengedit pengumuman tertentu.
     */
    public function edit(Pengumuman $pengumuman)
    {
        return View::make('admin.pengumuman.edit', compact('pengumuman'));
    }

    /**
     * Memperbarui data pengumuman di database.
     */
    public function update(Request $request, Pengumuman $pengumuman)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'status' => 'required|in:draft,published,archived',
            'published_at' => 'nullable|date',
        ]);

        $data = $request->except(['_token', '_method']);
        $data['slug'] = Str::slug($request->judul);

        $pengumuman->update($data);

        return Redirect::route('admin.pengumuman.index')->with('success', 'Pengumuman berhasil diperbarui.');
    }

    /**
     * Menghapus pengumuman dari database.
     */
    public function destroy(Pengumuman $pengumuman)
    {
        $pengumuman->delete();
        return Redirect::route('admin.pengumuman.index')->with('success', 'Pengumuman berhasil dihapus.');
    }
}