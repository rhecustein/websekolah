<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache; // Import Cache
use App\Models\Sekolah;

class PengaturanController extends Controller
{
    /**
     * Menampilkan halaman pengaturan umum situs.
     */
    public function index()
    {
        // Pengaturan selalu diambil dari entri pertama di tabel sekolah.
        // firstOrFail akan menampilkan error 404 jika data sekolah belum ada,
        // yang seharusnya tidak terjadi jika alur setup sudah benar.
        $pengaturan = Sekolah::firstOrFail();
        
        return View::make('admin.pengaturan.index', compact('pengaturan'));
    }

    /**
     * Memperbarui pengaturan umum situs.
     */
    public function update(Request $request)
    {
        $pengaturan = Sekolah::firstOrFail();

        $request->validate([
            'nama_sekolah' => 'required|string|max:255',
            // Gunakan 'email' agar konsisten dengan nama kolom di database
            'email' => 'required|email|unique:sekolahs,email,' . $pengaturan->id,
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
        ]);

        // Update hanya field yang relevan untuk halaman pengaturan ini
        $pengaturan->update($request->only([
            'nama_sekolah',
            'email',
            'meta_title',
            'meta_description',
            'meta_keywords'
        ]));

        // PENTING: Hapus cache 'sekolah' agar data baru dimuat oleh SekolahComposer
        Cache::forget('sekolah');

        return Redirect::route('admin.pengaturan.index')->with('success', 'Pengaturan berhasil diperbarui.');
    }

    /**
     * Menjalankan perintah untuk membersihkan cache aplikasi.
     */
    public function clearCache()
    {
        Artisan::call('cache:clear');
        Artisan::call('view:clear');
        Artisan::call('route:clear');
        Artisan::call('config:clear');

        // Hapus juga cache 'sekolah' untuk memastikan data terbaru ditampilkan
        Cache::forget('sekolah');

        return Redirect::route('admin.pengaturan.index')->with('success', 'Cache aplikasi berhasil dibersihkan.');
    }
}
