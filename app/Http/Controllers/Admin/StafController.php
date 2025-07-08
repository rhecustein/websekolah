<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use App\Models\Staf;

class StafController extends Controller
{
    /**
     * Menampilkan daftar staf.
     */
    public function index(Request $request)
    {
        $query = Staf::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('nama_lengkap', 'like', '%' . $request->search . '%')
                  ->orWhere('jabatan', 'like', '%' . $request->search . '%');
        }
        if ($request->has('jenis_kelamin') && $request->jenis_kelamin != '') {
            $query->where('jenis_kelamin', $request->jenis_kelamin);
        }
        if ($request->has('jabatan') && $request->jabatan != '') {
            $query->where('jabatan', $request->jabatan);
        }

        $stafs = $query->latest()->paginate(10);
        return View::make('admin.staf.index', compact('stafs'));
    }

    /**
     * Menampilkan formulir untuk membuat data staf baru.
     */
    public function create()
    {
        return View::make('admin.staf.create');
    }

    /**
     * Menyimpan data staf baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'jabatan' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'email' => 'nullable|email|unique:stafs,email',
            // Tambahkan validasi untuk kolom lainnya
        ]);

        $data = $request->except(['_token', 'foto']);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('public/staf');
        }

        Staf::create($data);

        return Redirect::route('admin.staf.index')->with('success', 'Data staf berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail staf tertentu.
     */
    public function show(Staf $staf)
    {
        return View::make('admin.staf.show', compact('staf'));
    }

    /**
     * Menampilkan formulir untuk mengedit staf tertentu.
     */
    public function edit(Staf $staf)
    {
        return View::make('admin.staf.edit', compact('staf'));
    }

    /**
     * Memperbarui data staf di database.
     */
    public function update(Request $request, Staf $staf)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'jabatan' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'email' => 'nullable|email|unique:stafs,email,' . $staf->id,
            // Tambahkan validasi untuk kolom lainnya
        ]);

        $data = $request->except(['_token', '_method', 'foto']);

        if ($request->hasFile('foto')) {
            if ($staf->foto) {
                Storage::delete($staf->foto);
            }
            $data['foto'] = $request->file('foto')->store('public/staf');
        }

        $staf->update($data);

        return Redirect::route('admin.staf.index')->with('success', 'Data staf berhasil diperbarui.');
    }

    /**
     * Menghapus staf dari database.
     */
    public function destroy(Staf $staf)
    {
        if ($staf->foto) {
            Storage::delete($staf->foto);
        }
        $staf->delete();
        return Redirect::route('admin.staf.index')->with('success', 'Data staf berhasil dihapus.');
    }
}