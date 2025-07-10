<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\Kurikulum;
use App\Models\Ekstrakurikuler;
use App\Models\Guru;
use App\Models\Staf;
use App\Models\Halaman; // Untuk informasi ujian/beasiswa jika berupa halaman statis

class AkademikController extends Controller
{
    /**
     * Menampilkan halaman kurikulum.
     */
    public function kurikulum()
    {
        $kurikulums = Kurikulum::latest()->get(); // Ambil semua data kurikulum
        return View::make('akademik.kurikulum', compact('kurikulums'));
    }

    /**
     * Menampilkan halaman program unggulan / ekstrakurikuler.
     */
    public function programUnggulanEkstrakurikuler()
    {
        $ekstrakurikulers = Ekstrakurikuler::latest()->get(); // Ambil semua data ekstrakurikuler
        // Jika ada program unggulan terpisah, bisa diambil juga
        // $programUnggulan = ProgramUnggulan::all();
        return View::make('akademik.program-unggulan', compact('ekstrakurikulers'));
    }

    /**
     * Menampilkan daftar guru dan staf.
     */
    public function guruStaf()
    {
        $gurus = Guru::latest()->get(); // Ambil semua data guru
        $stafs = Staf::latest()->get(); // Ambil semua data staf
        return View::make('akademik.guru-staf', compact('gurus', 'stafs'));
    }

    /**
     * Menampilkan informasi beasiswa (jika ada).
     */
    public function beasiswa()
    {
        // Asumsi informasi beasiswa adalah halaman statis
        $halamanBeasiswa = Halaman::where('slug', 'informasi-beasiswa')->first();
        return View::make('akademik.beasiswa', compact('halamanBeasiswa'));
    }

    /**
     * Menampilkan informasi ujian dan kelulusan.
     */
     public function ujianKelulusan(Request $request)
    {
        // Anda bisa mengambil data dinamis tentang ujian kelulusan dari database di sini.
        // Contoh data dummy untuk sementara:
        $ujianInfo = [
            'judul' => 'Ujian Kelulusan Tahun Ajaran 2025/2026',
            'deskripsi' => 'Informasi lengkap mengenai jadwal, persyaratan, dan materi ujian kelulusan untuk siswa tingkat akhir. Pastikan Anda mempersiapkan diri dengan baik!',
            'jadwal' => [
                'Ujian Tulis' => '10-15 Juli 2025',
                'Ujian Praktek' => '20-25 Juli 2025',
                'Pengumuman Kelulusan' => '5 Agustus 2025'
            ],
            'persyaratan' => [
                'Telah menyelesaikan seluruh mata pelajaran.',
                'Lulus ujian praktek dan ujian tulis.',
                'Mengumpulkan semua tugas akhir.'
            ],
            'dokumen_terkait' => [
                ['nama' => 'Panduan Ujian Kelulusan', 'link' => '#'],
                ['nama' => 'Materi Ujian Pokok', 'link' => '#']
            ]
        ];

        // Jika Anda menggunakan model, contohnya:
        // use App\Models\Ujian;
        // $ujianInfo = Ujian::where('jenis', 'kelulusan')->latest()->first();

        // Mengirim data ke view
        return View::make('akademik.ujian-kelulusan', compact('ujianInfo'));
    }   
}