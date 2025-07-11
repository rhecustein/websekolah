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
            'telepon' => 'nullable|string|max:20',
            'website' => 'nullable|url',
            'kepala_sekolah' => 'nullable|string|max:255',
            'akreditasi' => 'nullable|string|max:50',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'favicon' => 'nullable|image|mimes:ico,png|max:2048',
            'foto_sekolah' => 'nullable|image|mimes:jpeg,png,jpg|max:4096',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'link_facebook' => 'nullable|url',
            'link_instagram' => 'nullable|url',
            'link_twitter' => 'nullable|url',
            'link_youtube' => 'nullable|url',
        ]);

        $data = $request->except(['_token', 'logo', 'favicon', 'foto_sekolah']);

        // Handle upload file dengan menentukan disk 'public' secara eksplisit
        // File akan disimpan di 'storage/app/public/sekolah'
        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('sekolah', 'public');
        }
        if ($request->hasFile('favicon')) {
            $data['favicon'] = $request->file('favicon')->store('sekolah', 'public');
        }
        if ($request->hasFile('foto_sekolah')) {
            $data['foto_sekolah'] = $request->file('foto_sekolah')->store('sekolah', 'public');
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
            'telepon' => 'nullable|string|max:20',
            'website' => 'nullable|url',
            'kepala_sekolah' => 'nullable|string|max:255',
            'akreditasi' => 'nullable|string|max:50',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'favicon' => 'nullable|image|mimes:ico,png|max:2048',
            'foto_sekolah' => 'nullable|image|mimes:jpeg,png,jpg|max:4096',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'link_facebook' => 'nullable|url',
            'link_instagram' => 'nullable|url',
            'link_twitter' => 'nullable|url',
            'link_youtube' => 'nullable|url',
        ]);

        $data = $request->except(['_token', '_method', 'logo', 'favicon', 'foto_sekolah']);

        // Handle update file logo
        if ($request->hasFile('logo')) {
            // Hapus file lama jika ada, dengan menyebutkan disk 'public'
            if ($sekolah->logo) {
                Storage::disk('public')->delete($sekolah->logo);
            }
            // Simpan file baru di disk 'public' dan dapatkan path-nya
            $data['logo'] = $request->file('logo')->store('sekolah', 'public');
        }

        // Handle update file favicon
        if ($request->hasFile('favicon')) {
            if ($sekolah->favicon) {
                Storage::disk('public')->delete($sekolah->favicon);
            }
            $data['favicon'] = $request->file('favicon')->store('sekolah', 'public');
        }

        // Handle update file foto sekolah
        if ($request->hasFile('foto_sekolah')) {
            if ($sekolah->foto_sekolah) {
                Storage::disk('public')->delete($sekolah->foto_sekolah);
            }
            $data['foto_sekolah'] = $request->file('foto_sekolah')->store('sekolah', 'public');
        }

        $sekolah->update($data);

        return Redirect::route('admin.sekolah.index')->with('success', 'Informasi sekolah berhasil diperbarui.');
    }

    /**
     * Menghapus informasi sekolah dari database.
     */
    public function destroy(Sekolah $sekolah)
    {
        // Hapus file terkait dari disk 'public'
        if ($sekolah->logo) {
            Storage::disk('public')->delete($sekolah->logo);
        }
        if ($sekolah->favicon) {
            Storage::disk('public')->delete($sekolah->favicon);
        }
        if ($sekolah->foto_sekolah) {
            Storage::disk('public')->delete($sekolah->foto_sekolah);
        }

        $sekolah->delete();
        return Redirect::route('admin.sekolah.index')->with('success', 'Informasi sekolah berhasil dihapus.');
    }
}
