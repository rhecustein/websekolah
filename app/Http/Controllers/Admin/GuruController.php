<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use App\Models\Guru;

class GuruController extends Controller
{
    /**
     * Menampilkan daftar guru.
     */
    public function index(Request $request)
    {
        $query = Guru::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('nama_lengkap', 'like', '%' . $request->search . '%')
                  ->orWhere('jabatan', 'like', '%' . $request->search . '%')
                  ->orWhere('bidang_studi', 'like', '%' . $request->search . '%');
        }
        if ($request->has('jenis_kelamin') && $request->jenis_kelamin != '') {
            $query->where('jenis_kelamin', $request->jenis_kelamin);
        }
        if ($request->has('jabatan') && $request->jabatan != '') {
            $query->where('jabatan', $request->jabatan);
        }

        $gurus = $query->latest()->paginate(10);
        return View::make('admin.guru.index', compact('gurus'));
    }

    /**
     * Menampilkan formulir untuk membuat data guru baru.
     */
    public function create()
    {
        return View::make('admin.guru.create');
    }

    /**
     * Menyimpan data guru baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'jabatan' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'email' => 'nullable|email|unique:gurus,email',
            // Tambahkan validasi untuk kolom lainnya
        ]);

        $data = $request->except(['_token', 'foto']);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('public/guru');
        }

        Guru::create($data);

        return Redirect::route('admin.guru.index')->with('success', 'Data guru berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail guru tertentu.
     */
    public function show(Guru $guru)
    {
        return View::make('admin.guru.show', compact('guru'));
    }

    /**
     * Menampilkan formulir untuk mengedit guru tertentu.
     */
    public function edit(Guru $guru)
    {
        return View::make('admin.guru.edit', compact('guru'));
    }

    /**
     * Memperbarui data guru di database.
     */
    public function update(Request $request, Guru $guru)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'jabatan' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'email' => 'nullable|email|unique:gurus,email,' . $guru->id,
            // Tambahkan validasi untuk kolom lainnya
        ]);

        $data = $request->except(['_token', '_method', 'foto']);

        if ($request->hasFile('foto')) {
            if ($guru->foto) {
                Storage::delete($guru->foto);
            }
            $data['foto'] = $request->file('foto')->store('public/guru');
        }

        $guru->update($data);

        return Redirect::route('admin.guru.index')->with('success', 'Data guru berhasil diperbarui.');
    }

    /**
     * Menghapus guru dari database.
     */
    public function destroy(Guru $guru)
    {
        if ($guru->foto) {
            Storage::delete($guru->foto);
        }
        $guru->delete();
        return Redirect::route('admin.guru.index')->with('success', 'Data guru berhasil dihapus.');
    }
}