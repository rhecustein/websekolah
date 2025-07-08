<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Artisan; // Untuk clear cache dll.
use Illuminate\Support\Facades\Config; // Untuk mengubah konfigurasi runtime
use App\Models\Sekolah; // Mungkin ada beberapa pengaturan di tabel Sekolah

class PengaturanController extends Controller
{
    /**
     * Menampilkan halaman pengaturan umum situs.
     */
    public function index()
    {
        // Ambil data pengaturan dari tabel Sekolah atau dari file config
        $sekolah = Sekolah::first(); // Asumsi pengaturan utama ada di sini

        return View::make('admin.pengaturan.index', compact('sekolah'));
    }

    /**
     * Memperbarui pengaturan umum situs.
     */
    public function update(Request $request)
    {
        $request->validate([
            'nama_sekolah' => 'required|string|max:255',
            'email_kontak' => 'required|email',
            // Tambahkan validasi untuk pengaturan lain
        ]);

        // Contoh: Memperbarui data di tabel Sekolah
        $sekolah = Sekolah::firstOrNew([]); // Ambil atau buat baru jika belum ada
        $sekolah->nama_sekolah = $request->nama_sekolah;
        $sekolah->email = $request->email_kontak; // Contoh: mengupdate email kontak di tabel sekolah
        // ... update kolom lain
        $sekolah->save();

        // Contoh: Clear cache setelah perubahan pengaturan
        Artisan::call('cache:clear');
        Artisan::call('view:clear');
        Artisan::call('route:clear');

        return Redirect::route('admin.pengaturan.index')->with('success', 'Pengaturan berhasil diperbarui.');
    }

    // Anda bisa menambahkan metode lain di sini untuk pengaturan spesifik,
    // seperti pengaturan SEO, pengaturan media sosial, dll.
}