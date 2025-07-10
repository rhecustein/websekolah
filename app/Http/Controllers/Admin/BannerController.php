<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil semua banner, diurutkan berdasarkan kolom 'order'
        $banners = Banner::orderBy('order', 'asc')->get();
        return view('admin.banners.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Menampilkan view untuk membuat banner baru
        return view('admin.banners.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string',
            'image_path' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'link_url' => 'nullable|url',
            'link_text' => 'nullable|string|max:50',
            'order' => 'required|integer',
            'is_active' => 'required|boolean',
        ]);

        $data = $request->all();

        // Handle unggahan file gambar
        if ($request->hasFile('image_path')) {
            $data['image_path'] = $request->file('image_path')->store('banners', 'public');
        }

        // Buat record baru di database
        Banner::create($data);

        return redirect()->route('admin.banners.index')->with('success', 'Banner berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     * (Not typically used in admin panels, redirecting to edit is a good practice)
     */
    public function show(Banner $banner)
    {
        return redirect()->route('admin.banners.edit', $banner);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Banner $banner)
    {
        // Menampilkan form edit dengan data banner yang ada
        return view('admin.banners.edit', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Banner $banner)
    {
        // Validasi input dari form edit
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048', // Gambar tidak wajib diisi saat update
            'link_url' => 'nullable|url',
            'link_text' => 'nullable|string|max:50',
            'order' => 'required|integer',
            'is_active' => 'required|boolean',
        ]);

        $data = $request->all();

        // Handle jika ada file gambar baru yang diunggah
        if ($request->hasFile('image_path')) {
            // Hapus gambar lama jika ada
            if ($banner->image_path) {
                Storage::disk('public')->delete($banner->image_path);
            }
            // Simpan gambar baru
            $data['image_path'] = $request->file('image_path')->store('banners', 'public');
        }

        // Perbarui record di database
        $banner->update($data);

        return redirect()->route('admin.banners.index')->with('success', 'Banner berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Banner $banner)
    {
        // Hapus file gambar dari storage sebelum menghapus record
        if ($banner->image_path) {
            Storage::disk('public')->delete($banner->image_path);
        }

        // Hapus record dari database
        $banner->delete();

        return redirect()->route('admin.banners.index')->with('success', 'Banner berhasil dihapus.');
    }
}
