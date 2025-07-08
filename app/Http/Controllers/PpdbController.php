<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\PendaftarPpdb;
use App\Models\InformasiPpdb;
use App\Models\PembayaranPpdb; // Untuk konfirmasi pembayaran

class PpdbController extends Controller
{
    /**
     * Menampilkan halaman informasi PPDB (jadwal, persyaratan, prosedur).
     */
    public function index()
    {
        $informasiPpdb = InformasiPpdb::latest()->get(); // Ambil semua informasi PPDB
        return View::make('ppdb.index', compact('informasiPpdb'));
    }

    /**
     * Menampilkan formulir pendaftaran PPDB online.
     */
    public function daftar()
    {
        return View::make('ppdb.daftar');
    }

    /**
     * Menyimpan data pendaftaran PPDB dari calon siswa.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'agama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'telepon_siswa' => 'nullable|string|max:20',
            'email_siswa' => 'nullable|email|unique:pendaftar_ppdbs,email_siswa',
            'asal_sekolah_sebelumnya' => 'required|string|max:255',
            'jurusan_diminati' => 'nullable|string|max:255',
            'nama_ayah' => 'required|string|max:255',
            'pekerjaan_ayah' => 'nullable|string|max:255',
            'telepon_ayah' => 'required|string|max:20',
            'nama_ibu' => 'required|string|max:255',
            'pekerjaan_ibu' => 'nullable|string|max:255',
            'telepon_ibu' => 'required|string|max:20',
            'dokumen_kk' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'dokumen_akta_lahir' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'dokumen_ijazah_skl' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'dokumen_foto_siswa' => 'required|file|mimes:jpg,jpeg,png|max:1024',
        ]);

        $data = $request->except(['_token']);
        $data['nomor_pendaftaran'] = 'PPDB-' . date('Ymd') . '-' . Str::random(6); // Contoh format nomor pendaftaran

        // Proses upload dokumen
        $dokumenFields = ['dokumen_kk', 'dokumen_akta_lahir', 'dokumen_ijazah_skl', 'dokumen_foto_siswa'];
        foreach ($dokumenFields as $field) {
            if ($request->hasFile($field)) {
                $data[$field] = $request->file($field)->store('public/ppdb/dokumen');
            }
        }

        $pendaftar = PendaftarPpdb::create($data);

        // Redirect ke halaman sukses dengan nomor pendaftaran
        return Redirect::route('ppdb.daftar.sukses')->with([
            'success' => 'Pendaftaran Anda berhasil! Mohon catat nomor pendaftaran Anda.',
            'nomor_pendaftaran' => $pendaftar->nomor_pendaftaran
        ]);
    }

    /**
     * Menampilkan halaman sukses pendaftaran.
     */
    public function daftarSukses(Request $request)
    {
        $nomorPendaftaran = $request->session()->get('nomor_pendaftaran');
        return View::make('ppdb.daftar-sukses', compact('nomorPendaftaran'));
    }

    /**
     * Menampilkan formulir untuk cek status pendaftaran.
     */
    public function cekStatus()
    {
        return View::make('ppdb.status');
    }

    /**
     * Memproses cek status pendaftaran.
     */
    public function prosesCekStatus(Request $request)
    {
        $request->validate([
            'nomor_pendaftaran' => 'required|string|max:255',
        ]);

        $pendaftar = PendaftarPpdb::where('nomor_pendaftaran', $request->nomor_pendaftaran)->first();

        if (!$pendaftar) {
            return Redirect::back()->with('error', 'Nomor pendaftaran tidak ditemukan.');
        }

        // Ambil juga informasi pembayaran terkait
        $pembayaran = PembayaranPpdb::where('pendaftar_ppdb_id', $pendaftar->id)->get();

        return View::make('ppdb.status_hasil', compact('pendaftar', 'pembayaran'));
    }

    /**
     * Menampilkan halaman pengumuman hasil seleksi.
     */
    public function hasil()
    {
        // Anda bisa menampilkan daftar pendaftar yang lulus (jika diizinkan publik)
        // Atau arahkan ke halaman cek status
        return View::make('ppdb.hasil');
    }

    /**
     * Menampilkan halaman daftar ulang.
     */
    public function daftarUlang()
    {
        // Informasi dan formulir daftar ulang
        return View::make('ppdb.daftar-ulang');
    }

    /**
     * Menampilkan bukti pendaftaran (setelah pendaftaran berhasil).
     */
    public function buktiDaftar($nomor_pendaftaran)
    {
        $pendaftar = PendaftarPpdb::where('nomor_pendaftaran', $nomor_pendaftaran)->firstOrFail();
        // Anda bisa menggunakan barryvdh/laravel-dompdf di sini untuk generate PDF
        // return PDF::loadView('ppdb.bukti-daftar-pdf', compact('pendaftar'))->download('bukti-pendaftaran-' . $nomor_pendaftaran . '.pdf');
        return View::make('ppdb.bukti-daftar', compact('pendaftar'));
    }
}