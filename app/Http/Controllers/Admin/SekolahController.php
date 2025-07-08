<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use App\Models\Sekolah;
use Illuminate\Support\Facades\Storage; // Untuk upload file

class SekolahController extends Controller
{
    /**
     * Menampilkan daftar informasi sekolah (biasanya hanya ada satu).
     */
    public function index()
    {
        $sekolah = Sekolah::first(); // Ambil data sekolah pertama (asumsi hanya ada satu entri)
        if (!$sekolah) {
            // Jika belum ada data sekolah, arahkan ke halaman pembuatan
            return Redirect::route('admin.sekolah.create');
        }
        return View::make('admin.sekolah.show', compact('sekolah'));
    }

    /**
     * Menampilkan formulir untuk membuat informasi sekolah baru.
     */
    public function create()
    {
        // Pencegahan agar tidak membuat lebih dari satu entri
        if (Sekolah::count() > 0) {
            return Redirect::route('admin.sekolah.index')->with('warning', 'Data sekolah sudah ada. Silakan edit.');
        }
        return View::make('admin.sekolah.create');
    }

    /**
     * Menyimpan informasi sekolah baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_sekolah' => 'required|string|max:255',
            'jenjang' => 'required|string|max:255',
            'alamat' => 'required|string',
            'kota' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
            'email' => 'required|email|unique:sekolahs,email',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'favicon' => 'nullable|image|mimes:ico,png|max:2048',
            // Tambahkan validasi untuk kolom lain
        ]);

        $data = $request->except(['_token', 'logo', 'favicon']);

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('public/sekolah');
        }
        if ($request->hasFile('favicon')) {
            $data['favicon'] = $request->file('favicon')->store('public/sekolah');
        }

        Sekolah::create($data);

        return Redirect::route('admin.sekolah.index')->with('success', 'Informasi sekolah berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail informasi sekolah.
     */
    public function show(Sekolah $sekolah)
    {
        return View::make('admin.sekolah.show', compact('sekolah'));
    }

    /**
     * Menampilkan formulir untuk mengedit informasi sekolah.
     */
    public function edit(Sekolah $sekolah)
    {
        return View::make('admin.sekolah.edit', compact('sekolah'));
    }

    /**
     * Memperbarui informasi sekolah di database.
     */
    public function update(Request $request, Sekolah $sekolah)
    {
        $request->validate([
            'nama_sekolah' => 'required|string|max:255',
            'jenjang' => 'required|string|max:255',
            'alamat' => 'required|string',
            'kota' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
            'email' => 'required|email|unique:sekolahs,email,' . $sekolah->id,
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'favicon' => 'nullable|image|mimes:ico,png|max:2048',
            // Tambahkan validasi untuk kolom lain
        ]);

        $data = $request->except(['_token', '_method', 'logo', 'favicon']);

        if ($request->hasFile('logo')) {
            if ($sekolah->logo) {
                Storage::delete($sekolah->logo);
            }
            $data['logo'] = $request->file('logo')->store('public/sekolah');
        }
        if ($request->hasFile('favicon')) {
            if ($sekolah->favicon) {
                Storage::delete($sekolah->favicon);
            }
            $data['favicon'] = $request->file('favicon')->store('public/sekolah');
        }

        $sekolah->update($data);

        return Redirect::route('admin.sekolah.index')->with('success', 'Informasi sekolah berhasil diperbarui.');
    }

    /**
     * Menghapus informasi sekolah dari database (jarang dilakukan untuk data sekolah utama).
     */
    public function destroy(Sekolah $sekolah)
    {
        // Opsional: Hapus file terkait jika ada
        if ($sekolah->logo) {
            Storage::delete($sekolah->logo);
        }
        if ($sekolah->favicon) {
            Storage::delete($sekolah->favicon);
        }
        $sekolah->delete();
        return Redirect::route('admin.sekolah.index')->with('success', 'Informasi sekolah berhasil dihapus.');
    }
}