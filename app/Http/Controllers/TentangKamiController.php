<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\Sekolah;
use App\Models\Halaman;
use App\Models\Prestasi;
use Illuminate\Database\Eloquent\ModelNotFoundException; // Import Exception ini
use Illuminate\Support\Facades\Log; // Untuk logging error

class TentangkamiController extends Controller
{
    /**
     * Menampilkan halaman profil sekolah (Sejarah, Visi & Misi, Struktur Organisasi).
     */
    public function profil()
    {
        try {
            // firstOrFail() akan melempar ModelNotFoundException jika tidak ada data
            $sekolah = Sekolah::firstOrFail();
            // Anda bisa juga mengambil konten dari model Halaman jika profil dibuat dinamis
            // $halamanProfil = Halaman::where('slug', 'profil-sekolah')->first();

            return View::make('tentangkami.profil', compact('sekolah'));
        } catch (ModelNotFoundException $e) {
            // Log the error for debugging purposes
            Log::error("TentangKamiController@profil: Data Sekolah tidak ditemukan. Error: " . $e->getMessage());
            // Abort with a 404, providing a custom message
            abort(404, 'Halaman tidak ditemukan. Data profil sekolah belum tersedia.');
        } catch (\Throwable $e) {
            // Catch any other unexpected errors
            Log::error("TentangKamiController@profil: Terjadi kesalahan tak terduga. Error: " . $e->getMessage());
            abort(500, 'Terjadi kesalahan server. Mohon coba lagi nanti.');
        }
    }

    /**
     * Menampilkan halaman sambutan kepala sekolah/pimpinan pondok.
     */
    public function sambutan()
    {
        try {
            $sekolah = Sekolah::firstOrFail();
            // Asumsi sambutan disimpan di kolom 'deskripsi' atau 'sambutan_kepala_sekolah' di tabel Sekolah
            // Atau bisa juga dari model Halaman: $sambutan = Halaman::where('slug', 'sambutan-kepala-sekolah')->firstOrFail();

            return View::make('tentangkami.sambutan', compact('sekolah'));
        } catch (ModelNotFoundException $e) {
            Log::error("TentangKamiController@sambutan: Data Sekolah atau Sambutan Kepala Sekolah tidak ditemukan. Error: " . $e->getMessage());
            abort(404, 'Halaman tidak ditemukan. Data sambutan kepala sekolah belum tersedia.');
        } catch (\Throwable $e) {
            Log::error("TentangKamiController@sambutan: Terjadi kesalahan tak terduga. Error: " . $e->getMessage());
            abort(500, 'Terjadi kesalahan server. Mohon coba lagi nanti.');
        }
    }

    /**
     * Menampilkan halaman fasilitas sekolah.
     */
    public function fasilitas()
    {
        try {
            // Fetch the 'Halaman' model where the 'slug' column is 'fasilitas-sekolah'.
            // If no matching record is found, firstOrFail() will throw a ModelNotFoundException.
            $halamanFasilitas = Halaman::where('slug', 'fasilitas-sekolah')->firstOrFail();

            // Return the view, passing the fetched 'halamanFasilitas' data.
            // Ensure 'tentangkami.fasilitas' is the correct path to your Blade view file.
            return View::make('tentangkami.fasilitas', compact('halamanFasilitas'));

        } catch (ModelNotFoundException $e) {
            // Log a specific error when the 'fasilitas-sekolah' page is not found.
            Log::error("TentangKamiController@fasilitas: Halaman Fasilitas Sekolah (slug: fasilitas-sekolah) tidak ditemukan. Error: " . $e->getMessage());

            // Abort with a 404 Not Found error and a user-friendly message.
            abort(404, 'Halaman tidak ditemukan. Informasi fasilitas sekolah belum tersedia atau salah.');

        } catch (\Throwable $e) {
            // Catch any other unexpected errors during the process.
            Log::error("TentangKamiController@fasilitas: Terjadi kesalahan tak terduga. Error: " . $e->getMessage());

            // Abort with a 500 Internal Server Error and a generic message.
            abort(500, 'Terjadi kesalahan server. Mohon coba lagi nanti.');
        }
        return View::make('tentangkami.fasilitas', compact('halamanFasilitas'));
    }

    /**
     * Menampilkan halaman akreditasi dan prestasi.
     */
    public function akreditasiPrestasi()
    {
        try {
            $sekolah = Sekolah::firstOrFail(); // Untuk informasi akreditasi utama
            $prestasi = Prestasi::latest()->get(); // Ambil semua prestasi

            return View::make('tentangkami.akreditasi-prestasi', compact('sekolah', 'prestasi'));
        } catch (ModelNotFoundException $e) {
            Log::error("TentangKamiController@akreditasiPrestasi: Data Sekolah tidak ditemukan untuk halaman akreditasi/prestasi. Error: " . $e->getMessage());
            abort(404, 'Halaman tidak ditemukan. Data akreditasi atau prestasi sekolah belum tersedia.');
        } catch (\Throwable $e) {
            Log::error("TentangKamiController@akreditasiPrestasi: Terjadi kesalahan tak terduga. Error: " . $e->getMessage());
            abort(500, 'Terjadi kesalahan server. Mohon coba lagi nanti.');
        }
    }

    /**
     * Menampilkan halaman lokasi dan kontak.
     */
    public function lokasiKontak()
    {
        try {
            $sekolah = Sekolah::firstOrFail(); // Untuk alamat, telepon, email

            return View::make('tentangkami.lokasi-kontak', compact('sekolah'));
        } catch (ModelNotFoundException $e) {
            Log::error("TentangKamiController@lokasiKontak: Data Sekolah tidak ditemukan untuk halaman lokasi/kontak. Error: " . $e->getMessage());
            abort(404, 'Halaman tidak ditemukan. Informasi lokasi dan kontak sekolah belum tersedia.');
        } catch (\Throwable $e) {
            Log::error("TentangKamiController@lokasiKontak: Terjadi kesalahan tak terduga. Error: " . $e->getMessage());
            abort(500, 'Terjadi kesalahan server. Mohon coba lagi nanti.');
        }
    }
}