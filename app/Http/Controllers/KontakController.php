<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

use App\Models\Sekolah; // Untuk menampilkan info kontak sekolah

class KontakController extends Controller
{
    /**
     * Menampilkan halaman formulir kontak.
     */
    public function index()
    {
        $sekolah = Sekolah::firstOrFail(); // Untuk menampilkan alamat, telepon, email sekolah
        return View::make('kontak.index', compact('sekolah'));
    }

    /**
     * Memproses pengiriman formulir kontak.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subjek' => 'required|string|max:255',
            'pesan' => 'required|string',
            // Tambahkan validasi reCAPTCHA jika menggunakan
        ]);

        // Ambil email tujuan dari pengaturan sekolah
        $sekolah = Sekolah::first();
        $emailTujuan = $sekolah ? $sekolah->email : config('mail.from.address'); // Fallback ke default mail config

        try {
            // Kirim email (Anda perlu mengkonfigurasi Mail di Laravel)
            Mail::raw("Dari: {$request->nama} ({$request->email})\nSubjek: {$request->subjek}\nPesan:\n{$request->pesan}", function ($message) use ($request, $emailTujuan) {
                $message->to($emailTujuan)
                        ->subject('Pesan dari Formulir Kontak Website Sekolah');
                $message->from($request->email, $request->nama); // Menggunakan email pengirim sebagai "from"
            });

            return Redirect::back()->with('success', 'Pesan Anda berhasil terkirim. Terima kasih!');
        } catch (\Exception $e) {
            // Log error atau tampilkan pesan debug
            Log::error('Gagal mengirim email kontak: ' . $e->getMessage());
            return Redirect::back()->with('error', 'Terjadi kesalahan saat mengirim pesan. Silakan coba lagi nanti.')->withInput();
        }
    }
}